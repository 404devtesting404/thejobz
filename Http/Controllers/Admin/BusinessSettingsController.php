<?php

namespace App\Http\Controllers\Admin;

use App\CPU\ImageManager;
use App\Http\Controllers\Controller;
use App\Model\BusinessSetting;
use App\Model\SocialMedia;
use App\Model\Sliders;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Validator;

class BusinessSettingsController extends Controller
{
    public function website_info()
    {
        // $company_name = BusinessSetting::where('type', 'company_name')->first();
        // $company_email = BusinessSetting::where('type', 'company_email')->first();
        // $company_phone = BusinessSetting::where('type', 'company_phone')->first();
        // $footer_content = BusinessSetting::where('type', 'footer_content')->first();
        // $header_content = BusinessSetting::where('type', 'header_content')->first();
        // $company_address = BusinessSetting::where('type', 'company_address')->first();
          $data['config'] = BusinessSetting::where('type', 'adsterra_adds')->first();
          $data['alert'] = BusinessSetting::where('type', 'adsterra_alert_adds')->first();
          $data['adsterra_social_adds'] = BusinessSetting::where('type', 'adsterra_social_adds')->first();



        return view('admin.web-config.web-config', [
            'data' => $data,
        ]);
        // return view('admin.web-config.web-config');
        // return view('admin.contacts.list', compact('contacts'));

    }

    public function alert_add_update()
    {
        $adsterra_alert_adds = BusinessSetting::where('type', 'adsterra_alert_adds')->first();

            DB::table('business_settings')->where(['type' => 'adsterra_alert_adds'])->update([
                'type' => 'adsterra_alert_adds',
                'value' => $adsterra_alert_adds->value == 1 ? 0 : 1,
                'updated_at' => now(),
            ]);


        if (isset($adsterra_alert_adds) && $adsterra_alert_adds->value) {
            return response()->json(['message' => 'Adds is off.']);
        }
        return response()->json(['message' => 'Adds is on.']);
    }
    
    public function adsterra_social_adds()
    {
        $adsterra_social_adds = BusinessSetting::where('type', 'adsterra_social_adds')->first();

            DB::table('business_settings')->where(['type' => 'adsterra_social_adds'])->update([
                'type' => 'adsterra_social_adds',
                'value' => $adsterra_social_adds->value == 1 ? 0 : 1,
                'updated_at' => now(),
            ]);


        if (isset($adsterra_social_adds) && $adsterra_social_adds->value) {
            return response()->json(['message' => 'Social Adds is off.']);
        }
        return response()->json(['message' => 'Social Adds is on.']);
    }
    
    public function whatsappJoinModal()
    {
        $whatsappJoinModal = BusinessSetting::where('type', 'whatsappJoinModal')->first();
            DB::table('business_settings')->where(['type' => 'whatsappJoinModal'])->update([
                'type' => 'whatsappJoinModal',
                'value' => $whatsappJoinModal->value == 1 ? 0 : 1,
                'updated_at' => now(),
            ]);


        if (isset($whatsappJoinModal) && $whatsappJoinModal->value) {
            return response()->json(['message' => 'whatsappJoin Modal PopUp is off.']);
        }
        return response()->json(['message' => 'whatsappJoin Modal PopUp is on.']);
    }

    public function maintenance_add()
    {
        $adsterra_adds = BusinessSetting::where('type', 'adsterra_adds')->first();
        if (isset($adsterra_adds) == false) {
            DB::table('business_settings')->insert([
                'type' => 'adsterra_adds',
                'value' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } else {
            DB::table('business_settings')->where(['type' => 'adsterra_adds'])->update([
                'type' => 'adsterra_adds',
                'value' => $adsterra_adds->value == 1 ? 0 : 1,
                'updated_at' => now(),
            ]);
        }

        if (isset($adsterra_adds) && $adsterra_adds->value) {
            return response()->json(['message' => 'Adds is off.']);
        }
        return response()->json(['message' => 'Adds is on.']);
    }

    public function companyInfo()
    {
        $company_name = BusinessSetting::where('type', 'company_name')->first();
        $company_email = BusinessSetting::where('type', 'company_email')->first();
        $company_phone = BusinessSetting::where('type', 'company_phone')->first();
        $footer_content = BusinessSetting::where('type', 'footer_content')->first();
        $header_content = BusinessSetting::where('type', 'header_content')->first();
        $company_address = BusinessSetting::where('type', 'company_address')->first();
        $company_fax = BusinessSetting::where('type', 'company_fax')->first();


        return view('admin-views.business-settings.website-info', [
            'company_name' => $company_name,
            'company_email' => $company_email,
            'company_phone' => $company_phone,
            'footer_content' => $footer_content,
            'header_content' => $header_content,
            'company_address' => $company_address,
            'company_fax' => $company_fax,
        ]);
    }

    public function updateCompany(Request $data)
    {
        $validatedData = $data->validate([
            'company_name' => 'required',
        ]);
        BusinessSetting::where('type', 'company_name')->update(['value' => $data->company_name]);
        Toastr::success('Company Updated successfully!');
        return redirect()->back();
    }

    public function updateCompanyEmail(Request $data)
    {
        $validatedData = $data->validate([
            'company_email' => 'required',
        ]);
        BusinessSetting::where('type', 'company_email')->update(['value' => $data->company_email]);
        Toastr::success('Company Email Updated successfully!');
        return redirect()->back();
    }

    public function updateCompanyCopyRight(Request $data)
    {
        $validatedData = $data->validate([
            'company_copyright_text' => 'required',
        ]);
        BusinessSetting::where('type', 'company_copyright_text')->update(['value' => $data->company_copyright_text]);
        Toastr::success('Company Copy Right Updated successfully!');
        return redirect()->back();
    }

    public function shop_banner(Request $request)
    {
        $img = BusinessSetting::where(['type' => 'shop_banner'])->first();
        if (isset($img)) {
            $img = ImageManager::update('shop/', $img, 'png', $request->file('image'));
            BusinessSetting::where(['type' => 'shop_banner'])->update([
                'value' => $img,
            ]);
        } else {
            $img = ImageManager::upload('shop/', 'png', $request->file('image'));
            DB::table('business_settings')->insert([
                'type' => 'shop_banner',
                'value' => $img,
            ]);
        }
        return back();
    }

    public function update(Request $request, $name)
    {

        if ($name == 'download_app_apple_stroe') {
            $download_app_store = BusinessSetting::where('type', 'download_app_apple_stroe')->first();
            if (isset($download_app_store) == false) {
                DB::table('business_settings')->insert([
                    'type' => 'download_app_apple_stroe',
                    'value' => json_encode([
                        'status' => 1,
                        'link' => '',

                    ]),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            } else {
                DB::table('business_settings')->where(['type' => 'download_app_apple_stroe'])->update([
                    'type' => 'download_app_apple_stroe',
                    'value' => json_encode([
                        'status' => $request['status'],
                        'link' => $request['link'],

                    ]),
                    'updated_at' => now(),
                ]);
            }
        } elseif ($name == 'download_app_google_stroe') {
            $download_app_store = BusinessSetting::where('type', 'download_app_google_stroe')->first();
            if (isset($download_app_store) == false) {
                DB::table('business_settings')->insert([
                    'type' => 'download_app_google_stroe',
                    'value' => json_encode([
                        'status' => 1,
                        'link' => '',

                    ]),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            } else {
                DB::table('business_settings')->where(['type' => 'download_app_google_stroe'])->update([
                    'type' => 'download_app_google_stroe',
                    'value' => json_encode([
                        'status' => $request['status'],
                        'link' => $request['link'],

                    ]),
                    'updated_at' => now(),
                ]);
            }
        }
        Toastr::success('App Store Updated successfully');

        return back();
    }

    public function updateCompanyPhone(Request $data)
    {
        $validatedData = $data->validate([
            'company_phone' => 'required',
        ]);
        BusinessSetting::where('type', 'company_phone')->update(['value' => $data->company_phone]);
        Toastr::success('Company Phone Updated successfully!');
        return redirect()->back();
    }
    public function companyfooter_contentupdate(Request $data)
    {
        $validatedData = $data->validate([
            'footer_content' => 'required',
        ]);
        BusinessSetting::where('type', 'footer_content')->update(['value' => $data->footer_content]);
        Toastr::success('Footer Content Updated successfully!');
        return redirect()->back();
    }

    public function companyheader_contentupdate(Request $data)
    {
        $validatedData = $data->validate([
            'header_content' => 'required',
        ]);
        BusinessSetting::where('type', 'header_content')->update(['value' => $data->header_content]);
        Toastr::success('Header Content Updated successfully!');
        return redirect()->back();
    }
    public function company_fax_update(Request $data)
    {
        $validatedData = $data->validate([
            'company_fax' => 'required',
        ]);
        BusinessSetting::where('type', 'company_fax')->update(['value' => $data->company_fax]);
        Toastr::success('Fax Updated successfully!');
        return redirect()->back();
    }

    public function company_support_email(Request $data)
    {
        $validatedData = $data->validate([
            'company_support_email' => 'required',
        ]);
        BusinessSetting::where('type', 'company_support_email')->update(['value' => $data->company_support_email]);
        Toastr::success('Support email Updated successfully!');
        return redirect()->back();
    }


    public function company_address_update(Request $data)
    {
        $validatedData = $data->validate([
            'company_address' => 'required',
        ]);
        BusinessSetting::where('type', 'company_address')->update(['value' => $data->company_address]);
        Toastr::success('Footer Content Updated successfully!');
        return redirect()->back();
    }
    public function business_hours(Request $data)
    {
        $validatedData = $data->validate([
            'business_hours' => 'required',
        ]);
        BusinessSetting::where('type', 'business_hours')->update(['value' => $data->business_hours]);
        BusinessSetting::where('type', 'business_hours_two')->update(['value' => $data->business_hours_two]);
        Toastr::success('Business hours Content Updated successfully!');
        return redirect()->back();
    }
    public function uploadWebLogo(Request $data)
    {
        $img = BusinessSetting::where(['type' => 'company_web_logo'])->pluck('value')[0];
        if ($data->image) {
            $img = ImageManager::update('company/', $img, 'png', $data->file('image'));
        }

        BusinessSetting::where(['type' => 'company_web_logo'])->update([
            'value' => $img,
        ]);
        return back();
    }

    public function uploadFooterLog(Request $data)
    {
        $img = BusinessSetting::where(['type' => 'company_footer_logo'])->pluck('value')[0];
        if ($data->image) {
            $img = ImageManager::update('company/', $img, 'png', $data->file('image'));
        }

        BusinessSetting::where(['type' => 'company_footer_logo'])->update([
            'value' => $img,
        ]);
        Toastr::success('Footer Logo updated successfully!');
        return back();
    }

    public function uploadFavIcon(Request $data)
    {
        $img = BusinessSetting::where(['type' => 'company_fav_icon'])->pluck('value')[0];

        if ($data->image) {
            $img = ImageManager::update('company/', $img, 'png', $data->file('image'));
        }

        BusinessSetting::where(['type' => 'company_fav_icon'])->update([
            'value' => $img,
        ]);
        Toastr::success('Fav Icon updated successfully!');
        return back();
    }

    public function uploadMobileLogo(Request $data)
    {
        $img = BusinessSetting::where(['type' => 'company_mobile_logo'])->pluck('value')[0];
        if ($data->image) {
            $img = ImageManager::update('company/', $img, 'png', $data->file('image'));
        }
        BusinessSetting::where(['type' => 'company_mobile_logo'])->update([
            'value' => $img,
        ]);
        return back();
    }

    public function update_colors(Request $request)
    {
        $colors = BusinessSetting::where('type', 'colors')->first();
        if (isset($colors)) {
            BusinessSetting::where('type', 'colors')->update([
                'value' => json_encode(
                    [
                        'primary' => $request['primary'],
                        'secondary' => $request['secondary'],
                    ]
                ),
            ]);
        } else {
            DB::table('business_settings')->insert([
                'type' => 'colors',
                'value' => json_encode(
                    [
                        'primary' => $request['primary'],
                        'secondary' => $request['secondary'],
                    ]
                ),
            ]);
        }
        Toastr::success('Color  updated!');
        return back();
    }

    public function fcm_index()
    {
        return view('admin-views.business-settings.fcm-index');
    }

    public function update_fcm(Request $request)
    {
        DB::table('business_settings')->updateOrInsert(['type' => 'fcm_project_id'], [
            'value' => $request['fcm_project_id'],
        ]);

        DB::table('business_settings')->updateOrInsert(['type' => 'push_notification_key'], [
            'value' => $request['push_notification_key'],
        ]);

        Toastr::success('Settings updated!');
        return back();
    }

    public function update_fcm_messages(Request $request)
    {
        DB::table('business_settings')->updateOrInsert(['type' => 'order_pending_message'], [
            'value' => json_encode([
                'status' => $request['pending_status'],
                'message' => $request['pending_message'],
            ]),
        ]);

        DB::table('business_settings')->updateOrInsert(['type' => 'order_confirmation_msg'], [
            'value' => json_encode([
                'status' => $request['confirm_status'],
                'message' => $request['confirm_message'],
            ]),
        ]);

        DB::table('business_settings')->updateOrInsert(['type' => 'order_processing_message'], [
            'value' => json_encode([
                'status' => $request['processing_status'],
                'message' => $request['processing_message'],
            ]),
        ]);

        DB::table('business_settings')->updateOrInsert(['type' => 'out_for_delivery_message'], [
            'value' => json_encode([
                'status' => $request['out_for_delivery_status'],
                'message' => $request['out_for_delivery_message'],
            ]),
        ]);

        DB::table('business_settings')->updateOrInsert(['type' => 'order_delivered_message'], [
            'value' => json_encode([
                'status' => $request['delivered_status'],
                'message' => $request['delivered_message'],
            ]),
        ]);

        DB::table('business_settings')->updateOrInsert(['type' => 'order_returned_message'], [
            'value' => json_encode([
                'status' => $request['returned_status'],
                'message' => $request['returned_message'],
            ]),
        ]);


        DB::table('business_settings')->updateOrInsert(['type' => 'order_failed_message'], [
            'value' => json_encode([
                'status' => $request['failed_status'],
                'message' => $request['failed_message'],
            ]),
        ]);

        Toastr::success('Message updated!');
        return back();
    }

    public function seller_settings()
    {
        $sales_commission = BusinessSetting::where('type', 'sales_commission')->first();
        if (!isset($sales_commission)) {
            DB::table('business_settings')->insert(['type' => 'sales_commission', 'value' => 0]);
        }

        $seller_registration = BusinessSetting::where('type', 'seller_registration')->first();
        if (!isset($seller_registration)) {
            DB::table('business_settings')->insert(['type' => 'seller_registration', 'value' => 1]);
        }

        return view('admin-views.business-settings.seller-settings');
    }

    public function sales_commission(Request $data)
    {
        $validatedData = $data->validate([
            'commission' => 'required|min:0',
        ]);
        $sales_commission = BusinessSetting::where('type', 'sales_commission')->first();

        if (isset($sales_commission)) {
            BusinessSetting::where('type', 'sales_commission')->update(['value' => $data->commission]);
        } else {
            DB::table('business_settings')->insert(['type' => 'sales_commission', 'value' => $data->commission]);
        }

        Toastr::success('Sales commission Updated successfully!');
        return redirect()->back();
    }

    public function seller_registration(Request $data)
    {
        $seller_registration = BusinessSetting::where('type', 'seller_registration')->first();
        if (isset($seller_registration)) {
            BusinessSetting::where(['type' => 'seller_registration'])->update(['value' => $data->seller_registration]);
        } else {
            DB::table('business_settings')->insert([
                'type' => 'seller_registration',
                'value' => $data->seller_registration,
                'updated_at' => now()
            ]);
        }

        Toastr::success('Seller registration Updated successfully!');
        return redirect()->back();
    }

    public function update_language(Request $request)
    {
        $languages = $request['language'];
        if (in_array('en', $languages)) {
            unset($languages[array_search('en', $languages)]);
        }
        array_unshift($languages, 'en');

        DB::table('business_settings')->where(['type' => 'pnc_language'])->update([
            'value' => json_encode($languages),
        ]);
        Toastr::success('Language  updated!');
        return back();
    }
}
