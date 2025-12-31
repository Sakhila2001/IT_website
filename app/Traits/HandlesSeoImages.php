<?php
// app/Traits/HandlesSeoImages.php
namespace App\Traits;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait HandlesSeoImages
{
    protected function processSeoImage($file, $pageType, $identifier = null)
    {
        $manager = new ImageManager(new Driver());
        
        $slug = $identifier ? Str::slug($identifier) : 'image';
        $filename = "seo_{$slug}_".time().'.webp';
        $path = "seo/images/{$pageType}/{$filename}";
        
        // Ensure directory exists with proper permissions
        $directory = "public/seo/images/{$pageType}";
        Storage::makeDirectory($directory, 0755, true, true);
        
        // Verify directory was created
        if (!Storage::exists($directory)) {
            throw new \Exception("Failed to create directory: {$directory}");
        }

        // Full storage path
        $storagePath = storage_path("app/{$directory}/{$filename}");
        
        try {
            $manager->read($file)
                   ->resize(1200, 630)
                   ->toWebp(80)
                   ->save($storagePath);
            
            return "seo/images/{$pageType}/{$filename}";
            
        } catch (\Exception $e) {
            // Clean up if failed
            if (file_exists($storagePath)) {
                unlink($storagePath);
            }
            throw new \Exception("Image processing failed: " . $e->getMessage());
        }
    }
    /**
     * Delete existing SEO image
     */
    protected function deleteSeoImage($path)
    {
        if ($path && Storage::exists("public/{$path}")) {
            Storage::delete("public/{$path}");
        }
    }

    /**
     * Get public URL for SEO image
     */
    protected function getSeoImageUrl($path)
    {
        return $path ? asset("storage/{$path}") : null;
    }
}