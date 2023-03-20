<?php
namespace App\Services;

use Illuminate\Http\UploadedFile;

class ImageService
{
    /**
     * @param UploadedFile $image
     * @param string $dest_folder
     * @return string
     */
    public function create(UploadedFile $image, ?string $dest_folder)
    {
        // TODO: Implement moveImage() method.
        $image_name = time() . '_' . $image->getClientOriginalName();
        $image->move('upload/images/' . $dest_folder, $image_name);

        return $image_name;
    }

    /**
     * @param string|null $old_image
     * @param string|null $dest_folder
     * @return void
     */
    public function delete(?string $old_image, ?string $dest_folder)
    {
        try {
            $old_image_path = public_path() . '/' . 'upload' . '/' .  'images' . '/' . $dest_folder . '/' . $old_image;
            unlink($old_image_path);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}