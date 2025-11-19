<?php

namespace App\CPU;

use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ImageManager
{
    public static function upload(string $dir, string $format, $image = null)
    {
        if ($image != null) {
            $imageName = Carbon::now()->toDateString() . "-" . uniqid() . "." . $format;
            if (!Storage::disk('public')->exists($dir)) {
                Storage::disk('public')->makeDirectory($dir);
            }
            Storage::disk('public')->put($dir . $imageName, file_get_contents($image));
        } else {
            $imageName = 'def.png';
        }

        return $imageName;
    }

    public static function update(string $dir, $old_image, string $format, $image = null)
    {
        if (Storage::disk('public')->exists($dir . $old_image)) {
            Storage::disk('public')->delete($dir . $old_image);
        }
        $imageName = ImageManager::upload($dir, $format, $image);
        return $imageName;
    }

    public static function keepInSession($image, $remove_route = null, $folder = null, $session_destroy = true)
    {
        if ($session_destroy == true) {
            session()->forget($folder);
        }

        $modal_id = str_replace('_', '-', $folder);

        if ($image != null) {
            session()->push($folder, ['image' => $image, 'remove_route' => $remove_route]);
            session()->push('image_folders', $folder);
            return [
                'success' => 1,
                'images' => view('shared-partials.image-process._show-images', compact('folder', 'modal_id'))->render(),
                'count' => count(session($folder))
            ];
        }

        return [
            'success' => 0,
        ];
    }

    public static function removeFromSession($id, $folder)
    {
        $ar = session($folder);
        unset($ar[$id]);
        session()->put($folder, $ar);
        $modal_id = str_replace('_', '-', $folder);
        return [
            'success' => 1,
            'images' => view('shared-partials.image-process._show-images', compact('folder', 'modal_id'))->render(),
            'count' => count(session($folder))
        ];
    }


    public static function delete($full_path)
    {
        if (Storage::disk('public')->exists($full_path)) {
            Storage::disk('public')->delete($full_path);
        }

        return [
            'success' => 1,
            'message' => 'Removed successfully !'
        ];

    }
}
