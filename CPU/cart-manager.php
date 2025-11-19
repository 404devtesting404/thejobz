<?php

namespace App\CPU;

use App\Model\Cart;
use App\Model\Color;
use App\Model\Product;

class CartManager
{
    public static function get_cart()
    {
        if (session()->has('cart')) {
            $x = session('cart');
        } else {
            $x = [];
        }

        return $x;
    }

    public static function update_cart_qty($request)
    {
        $user = Helpers::get_customer($request);
        $status = 1;
        $qty = 0;
        $cart = Cart::where(['id' => $request->key, 'customer_id' => $user->id])->first();

        $product = Product::find($cart['product_id']);
        if (!empty($product->variation)) {
            $count = count(json_decode($product->variation));

            if ($count) {
                for ($i = 0; $i < $count; $i++) {
                    if (json_decode($product->variation)[$i]->type == $cart['variant']) {
                        if (json_decode($product->variation)[$i]->qty < $request->quantity) {
                            $status = 0;
                            $qty = $cart['quantity'];
                        }
                    }
                }
            }
        }
        //  $totalquantity = $cart['quantity']+$request->quantity;
        if ($product['current_stock'] < $request->quantity) {
            $status = 0;
            $qty = $cart['quantity'];
        }
        // dd($status);
        if ($status) {
            $qty = $request->quantity;
            $cart['quantity'] = $request->quantity;
            $cart['shipping_cost'] =  CartManager::get_shipping_cost_for_product_category_wise($product, $request->quantity);
        }

        $cart->save();

        return [
            'status' => $status,
            'qty' => $qty,
            'message' => $status == 1 ? Helpers::translate('successfully_updated!') : Helpers::translate('sorry_stock_is_limited')
        ];
    }

    public static function put_in_cart($request)
    {
        $product = Product::find($request['product_id']);
        $data = [
            'id' => $product['id']
        ];
        $str = '';
        $tax = 0;

        if ($request->has('color')) {
            $data['color'] = $request['color'];
            $str = Color::where('code', $request['color'])->pluck('name')->first();
        }

        $data['variant'] = $str;

        if ($str != null && $product->variant_product) {
            $product_stock = $product->stocks->where('variant', $str)->first();
            $price = $product_stock->price;
            $quantity = $product_stock->qty;

            if ($quantity >= $request['quantity']) {
                // $variations->$str->qty -= $request['quantity'];
                // $product->variations = json_encode($variations);
                // $product->save();
            } else {
                return response()->json([
                    'success' => 0,
                    'messages' => ['0' => 'Out of stock!']
                ]);
            }
        } else {
            $price = $product->unit_price;
        }


        /* if ($product->tax_type == 'percent') {
             $tax = ($price * $product->tax) / 100;
         } elseif ($product->tax_type == 'amount') {
             $tax = $product->tax;
         }*/

        $data['quantity'] = $request['quantity'];
        $data['price'] = $price;
        $data['tax'] = $product->tax;
        $data['tax_type'] = $product->tax_type;
        $data['slug'] = $product->slug;
        $data['name'] = $product->name;
        $data['shipping'] = 0;
        $data['thumbnail'] = $product->thumbnail;

        if ($request['quantity'] == null) {
            $data['quantity'] = 1;
        }

        if ($request->session()->has('cart')) {
            $foundInCart = false;
            $cart = collect();

            foreach ($request->session()->get('cart') as $key => $cartItem) {
                if ($cartItem['id'] == $request->id) {
                    if ($cartItem['variant'] == $str) {
                        $foundInCart = true;
                        $cartItem['quantity'] += $request['quantity'];
                    }
                }
                $cart->push($cartItem);
            }

            if (!$foundInCart) {
                $cart->push($data);
            }
            $request->session()->put('cart', $cart);
        } else {
            $cart = collect([$data]);
            $request->session()->put('cart', $cart);
        }

        return CartManager::get_cart();
    }

    public static function cart_total($cart)
    {
        $total = 0;
        if (!empty($cart)) {
            foreach ($cart as $item) {
                $product_subtotal = $item['price'] * $item['quantity'];
                $total += $product_subtotal;
            }
        }
        return $total;
    }

    public static function cart_total_applied_discount($cart)
    {
        $total = 0;
        if (!empty($cart)) {
            foreach ($cart as $item) {
                $product_subtotal = ($item['price'] - $item['discount']) * $item['quantity'];
                $total += $product_subtotal;
            }
        }
        return $total;
    }

    public static function cart_total_with_tax($cart)
    {
        $total = 0;
        if (!empty($cart)) {
            foreach ($cart as $item) {
                $product_subtotal = ($item['price'] * $item['quantity']) + ($item['tax'] * $item['quantity']);
                $total += $product_subtotal;
            }
        }
        return $total;
    }

    public static function cart_grand_total($cart)
    {
        $total = 0;
        if (!empty($cart)) {
            foreach ($cart as $item) {
                $product_subtotal = ($item['price'] * $item['quantity']);
                //    + ($item['tax'] * $item['quantity'])
                //         + $item['shipping_cost']
                //        - $item['discount']* $item['quantity'];
                $total += $product_subtotal;
            }
        }
        return $total;
    }

    public static function add_to_cart($cart, $request, $from_api = false)
    {
        $str = '';
        $variations = [];
        $price = 0;
        $user = Helpers::get_customer($request);
        if (!empty($cart)) {
            foreach ($cart as $key => $value) {

                $product = Product::find($value['id']);

                //check the color enabled or disabled for the product
                $value['color'] = null;
                if (isset($value['color'])) {
                    // dd($value['color']);
                    $str = Color::where('name', $value['color'])->first()->name;
                    $variations['color'] = $str;
                    $cart['color'] = $value['color'];
                }

                //Gets all the choice values of customer choice option and generate a string like Black-S-Cotton
                $choices = [];
                if (!empty($product->choice_options)) {
                    foreach (json_decode($product->choice_options) as $key => $choice) {
                        $choices[$choice->name] = $request[$choice->name];
                        $variations[$choice->title] = $request[$choice->name];
                        if ($str != null) {
                            $str .= '-' . str_replace(' ', '', $request[$choice->name]);
                        } else {
                            $str .= str_replace(' ', '', $request[$choice->name]);
                        }
                    }
                }

                if ($user == 'offline') {
                    if (session()->has('offline_cart')) {
                        $cart = session('offline_cart');
                        $check = $cart->where('product_id', $request->id)->where('variant', $str)->first();
                        if (isset($check) == false) {
                            $cart = collect();
                            $cart['id'] = time();
                        } else {
                            return [
                                'status' => 0,
                                'message' => 'already_added!'
                            ];
                        }
                    } else {
                        $cart = collect();
                        session()->put('offline_cart', $cart);
                    }
                } else {
                    if (isset($value['variant'])) {
                        $cart = Cart::where(['product_id' => $value['id'], 'customer_id' => $user->id, 'variant' => $value['variant']])->first();
                    }
                    if (!isset($value['variant'])) {
                        $cart = Cart::where(['product_id' => $value['id'], 'customer_id' => $user->id])->first();
                    }
                    if (isset($cart) == false) {
                        $cart = new Cart();
                    } else {
                        return [
                            'status' => 0,
                            'message' => 'already_added!'
                        ];
                    }
                }

                //dd($cart);
                $cart['product_id'] = $value['id'];
                // $cart['choices'] = json_encode($choices);

                //chek if out of stock
                //  dd($product['current_stock']);
                // dd($product );
                if ($product['current_stock'] < $value['qty']) {
                    return [
                        'status' => 0,
                        'message' => 'out_of_stock!'
                    ];
                }
                if (isset($value['variation'])) {
                    $cart['variations'] = json_encode($value['variation']);
                    $cart['variant'] = $str;


                    //Check the string and decreases quantity for the stock
                    if ($str != null) {
                        $count = count(json_decode($product->variation));
                        for ($i = 0; $i < $count; $i++) {
                            if (json_decode($product->variation)[$i]->type == $str) {
                                $price = json_decode($product->variation)[$i]->price;
                                if (json_decode($product->variation)[$i]->qty < $request['quantity']) {
                                    return [
                                        'status' => 0,
                                        'message' => 'out_of_stock!'
                                    ];
                                }
                            }
                        }
                    }
                } else {
                    $price = $product->unit_price;
                }

                $tax = Helpers::tax_calculation($price, $product['tax'], 'percent');

                //generate group id
                if ($user == 'offline') {
                    $check = session('offline_cart');
                    $cart_check = $check->where('seller_id', ($product->added_by == 'admin') ? 1 : $product->user_id)
                        ->where('seller_is', $product->added_by)->first();
                } else {
                    $cart_check = Cart::where([
                        'customer_id' => $user->id,
                        'seller_id' => ($product->added_by == 'admin') ? 1 : $product->user_id,
                        'seller_is' => $product->added_by
                    ])->first();
                }

                if (isset($cart_check)) {
                    $cart['cart_group_id'] = $cart_check['cart_group_id'];
                } else {
                    $cart['cart_group_id'] = ($user == 'offline' ? 'offline' : $user->id) . '-' . Str::random(5) . '-' . time();
                }
                //generate group id end

                $cart['customer_id'] = $user->id ?? 0;
                $cart['quantity'] = $value['qty'];
                /*$data['shipping_method_id'] = $shipping_id;*/
                $cart['price'] = $price;
                $cart['tax'] = $tax;
                $cart['slug'] = $product->slug;
                $cart['name'] = $product->name;
                $cart['discount'] = Helpers::get_product_discount($product, $price);
                /*$data['shipping_cost'] = $shipping_cost;*/
                $cart['thumbnail'] = $product->thumbnail;
                $cart['seller_id'] = ($product->added_by == 'admin') ? 1 : $product->user_id;
                $cart['seller_is'] = $product->added_by;
                $cart['shipping_cost'] = CartManager::get_shipping_cost_for_product_category_wise($product, $value['qty']);
                if ($product->added_by == 'seller') {
                    $cart['shop_info'] = Shop::where(['seller_id' => $product->user_id])->first()->name;
                } else {
                    $cart['shop_info'] = Helpers::get_business_settings('company_name');
                }

                $shippingMethod = Helpers::get_business_settings('shipping_method');

                if ($shippingMethod == 'inhouse_shipping') {
                    $admin_shipping = ShippingType::where('seller_id', 0)->first();
                    $shipping_type = isset($admin_shipping) == true ? $admin_shipping->shipping_type : 'order_wise';
                } else {
                    if ($product->added_by == 'admin') {
                        $admin_shipping = ShippingType::where('seller_id', 0)->first();
                        $shipping_type = isset($admin_shipping) == true ? $admin_shipping->shipping_type : 'order_wise';
                    } else {
                        $seller_shipping = ShippingType::where('seller_id', $product->user_id)->first();
                        $shipping_type = isset($seller_shipping) == true ? $seller_shipping->shipping_type : 'order_wise';
                    }
                }
                $cart['shipping_type'] = $shipping_type;

                if ($user == 'offline') {
                    $offline_cart = session('offline_cart');
                    $offline_cart->push($cart);
                    session()->put('offline_cart', $offline_cart);
                } else {
                    $cart->save();
                }
                //  dd($value['id']);
            }
        }

        return [
            'status' => 1,
            'message' => 'successfully_added!'
        ];
    }

    //old cart functionality
    public static function add_to_cart_old($request, $from_api = false)
    {
        $str = '';
        $variations = [];
        $price = 0;

        $user = Helpers::get_customer($request);
        $product = Product::find($request->id);

        //check the color enabled or disabled for the product
        if ($request->has('color')) {
            $str = Color::where('code', $request['color'])->first()->name;
            $variations['color'] = $str;
        }

        //Gets all the choice values of customer choice option and generate a string like Black-S-Cotton
        $choices = [];
        if (!empty($product->choice_options)) {
            foreach (json_decode($product->choice_options) as $key => $choice) {
                $choices[$choice->name] = $request[$choice->name];
                $variations[$choice->title] = $request[$choice->name];
                if ($str != null) {
                    $str .= '-' . str_replace(' ', '', $request[$choice->name]);
                } else {
                    $str .= str_replace(' ', '', $request[$choice->name]);
                }
            }
        }

        if ($user == 'offline') {
            if (session()->has('offline_cart')) {
                $cart = session('offline_cart');
                $check = $cart->where('product_id', $request->id)->where('variant', $str)->first();
                if (isset($check) == false) {
                    $cart = collect();
                    $cart['id'] = time();
                } else {
                    return [
                        'status' => 0,
                        'message' => 'already_added'
                    ];
                }
            } else {
                $cart = collect();
                session()->put('offline_cart', $cart);
            }
        } else {
            $cart = Cart::where(['product_id' => $request->id, 'customer_id' => $user->id, 'variant' => $str])->first();
            if (isset($cart) == false) {
                $cart = new Cart();
            } else {
                /* return [
                    'status' => 0,
                    'message' => translate('already_added!')
                ];*/
                $cart = new Cart();
            }
        }

        $cart['color'] = $request->has('color') ? $request['color'] : null;
        $cart['product_id'] = $product->id;
        $cart['choices'] = json_encode($choices);
        $cartexist = Cart::where(['product_id' => $product->id])->first();
        $stock = $product['current_stock'];
        if ($cartexist != null) {
            $stock = $product['current_stock'] - $cartexist->quantity;
        }

        //chek if out of stock
        if ($stock < $request['quantity']) {
            return [
                'status' => 0,
                'message' => 'out_of_stock!'
            ];
        }

        $cart['variations'] = json_encode($variations);
        $cart['variant'] = $str;

        //Check the string and decreases quantity for the stock
        if ($str != null) {
            $count = count(json_decode($product->variation));
            for ($i = 0; $i < $count; $i++) {
                if (json_decode($product->variation)[$i]->type == $str) {
                    $price = json_decode($product->variation)[$i]->price;
                    if (json_decode($product->variation)[$i]->qty < $request['quantity']) {
                        return [
                            'status' => 0,
                            'message' => translate('out_of_stock!')
                        ];
                    }
                }
            }
        } else {
            $price = $product->unit_price;
        }

        $tax = Helpers::tax_calculation($price, $product['tax'], 'percent');

        //generate group id
        if ($user == 'offline') {
            $check = session('offline_cart');
            $cart_check = $check->where('seller_id', ($product->added_by == 'admin') ? 1 : $product->user_id)
                ->where('seller_is', $product->added_by)->first();
        } else {
            $cart_check = Cart::where([
                'customer_id' => $user->id,
                'seller_id' => ($product->added_by == 'admin') ? 1 : $product->user_id,
                'seller_is' => $product->added_by
            ])->first();
        }

        if (isset($cart_check)) {
            $cart['cart_group_id'] = $cart_check['cart_group_id'];
        } else {
            $cart['cart_group_id'] = ($user == 'offline' ? 'offline' : $user->id) . '-' . Str::random(5) . '-' . time();
        }
        //generate group id end

        $cart['customer_id'] = $user->id ?? 0;
        $cart['quantity'] = $request['quantity'];
        /*$data['shipping_method_id'] = $shipping_id;*/
        $cart['price'] = $price;
        $cart['tax'] = $tax;
        $cart['slug'] = $product->slug;
        $cart['name'] = $product->name;
        $cart['discount'] = Helpers::get_product_discount($product, $price);
        /*$data['shipping_cost'] = $shipping_cost;*/
        $cart['thumbnail'] = $product->thumbnail;
        $cart['seller_id'] = ($product->added_by == 'admin') ? 1 : $product->user_id;
        $cart['seller_is'] = $product->added_by;
        $cart['shipping_cost'] = CartManager::get_shipping_cost_for_product_category_wise($product, $request['quantity']);
        if ($product->added_by == 'seller') {
            $cart['shop_info'] = Shop::where(['seller_id' => $product->user_id])->first()->name;
        } else {
            $cart['shop_info'] = Helpers::get_business_settings('company_name');
        }

        $shippingMethod = Helpers::get_business_settings('shipping_method');

        if ($shippingMethod == 'inhouse_shipping') {
            $admin_shipping = ShippingType::where('seller_id', 0)->first();
            $shipping_type = isset($admin_shipping) == true ? $admin_shipping->shipping_type : 'order_wise';
        } else {
            if ($product->added_by == 'admin') {
                $admin_shipping = ShippingType::where('seller_id', 0)->first();
                $shipping_type = isset($admin_shipping) == true ? $admin_shipping->shipping_type : 'order_wise';
            } else {
                $seller_shipping = ShippingType::where('seller_id', $product->user_id)->first();
                $shipping_type = isset($seller_shipping) == true ? $seller_shipping->shipping_type : 'order_wise';
            }
        }
        $cart['shipping_type'] = $shipping_type;

        if ($user == 'offline') {
            $offline_cart = session('offline_cart');
            $offline_cart->push($cart);
            session()->put('offline_cart', $offline_cart);
        } else {
            $cart->save();
        }

        return [
            'status' => 1,
            'message' => translate('successfully_added!')
        ];
    }
}
