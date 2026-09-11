<?php

namespace App\CPU;

use App\Model\Product;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ImageManager
{
    public static function isImageUsedElsewhere($filename, $excludeProductId = null)
    {
        if (!$filename || $filename === 'def.png') {
            return false;
        }

        $query = Product::where(function ($q) use ($filename) {
            $q->where('thumbnail', $filename)
              ->orWhere('meta_image', $filename)
              ->orWhere('digital_file_ready', $filename)
              ->orWhereRaw('images LIKE ?', ['%"' . $filename . '"%'])
              ->orWhereRaw('color_image LIKE ?', ['%"image_name":"' . $filename . '"%']);
        });

        if ($excludeProductId) {
            $query->where('id', '!=', $excludeProductId);
        }

        return $query->exists();
    }

    public static function upload(string $dir, string $format, $image = null)
    {
        if ($image != null) {
            $imageName = Carbon::now()->toDateString() . "-" . uniqid() . "." . $format;
            if (!Storage::disk('public')->exists($dir)) {
                Storage::disk('public')->makeDirectory($dir);
            }
            if ($image instanceof UploadedFile) {
                Storage::disk('public')->put($dir . $imageName, file_get_contents($image->getPathname()));
            } else {
                Storage::disk('public')->put($dir . $imageName, file_get_contents($image));
            }
        } else {
            $imageName = 'def.png';
        }

        return $imageName;
    }

    public static function update(string $dir, $old_image, string $format, $image = null, $excludeProductId = null)
    {
        if ($old_image && $old_image !== 'def.png') {
            if (!static::isImageUsedElsewhere($old_image, $excludeProductId)) {
                if (Storage::disk('public')->exists($dir . $old_image)) {
                    Storage::disk('public')->delete($dir . $old_image);
                }
            }
        }
        $imageName = ImageManager::upload($dir, $format, $image);
        return $imageName;
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
