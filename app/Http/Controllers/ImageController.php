<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;
use Intervention\Image\ImageManager;

class ImageController extends Controller
{

    public function removeWatermark(Request $request, ImageManager $imageManager)
    {

        try {
            // Check if the watermark image exists
            if (!file_exists('Watermark.png')) {
                return response()->json(['error' => 'Watermark image not found']);
            }

            $image = Image::make($request->file('image'));
            $watermark = Image::make('Watermark.png')->resize($image->width(), $image->height());

            // Create a new filter that will overlay the watermark
            $filter = new class implements FilterInterface
            {
                public function applyFilter(Image $image)
                {
                    $watermark = $image->get('watermark');
                    $image->insert($watermark, 'center');

                    return $image;
                }
            };

            // Apply the filter to the image
            $image = $image->filter($filter);

            // Save the modified image
            $image->save('path/to/output/image.png');

            return response()->json(['message' => 'Watermark removed successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error processing image: ' . $e->getMessage()]);
        }
    }
    // public function removeWatermark(Request $request)
    // {
    //     $image = Image::make($request->file('image'));

    //     // Load the watermark image
    //     $watermark = Image::make('path/to/watermark.png');

    //     // Create a new filter that will remove the watermark
    //     $filter = new class implements FilterInterface
    //     {
    //         public function applyFilter(Image $image)
    //         {
    //             $watermark = $image->get('watermark');

    //             // Remove the watermark from the image
    //             $image->remove($watermark);

    //             return $image;
    //         }
    //     };

    //     // Apply the filter to the image
    //     $image = $image->filter($filter);

    //     // Save the modified image
    //     $image->save('path/to/output/image.png');

    //     return response()->json(['message' => 'Watermark removed successfully']);
    // }
}
