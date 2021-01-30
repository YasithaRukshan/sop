<?php

namespace infrastructure;

use App\Models\Image;
use Illuminate\Support\Facades\Config;
use infrastructure\Facades\FileFacade;
use Intervention\Image\ImageManager;

/**
 * Created by VS  CODE.
 * User: Supun
 * Date: 11/18/19
 * Time: 10:47 AM
 */

class ImageCropper
{
    const CROP = "/crop";
    protected $upload_path;
    public function __construct()
    {
        $this->upload_path =Config::get('images.upload_path');
    }

    public function up($image, $dimensions)
    {
        if ($image) {
            //get filename with extension
            $filename_with_extension = $image->getClientOriginalName();

            //get filename without extension
            $filename = pathinfo($filename_with_extension, PATHINFO_FILENAME);

            //get file extension
            $extension = $image->getClientOriginalExtension();

            //filename to store
            $filename_to_store = FileFacade::makeName($image);

            //Upload File
            $image->move($this->upload_path . '/', $filename_to_store);

            if (!is_dir($this->upload_path . self::CROP)) {
                mkdir($this->upload_path . self::CROP, 0755);
            }
            // crop image
            $manager = new ImageManager(array('driver' => Config::get('images.driver')));

            $img = $manager->make($this->upload_path . '/' . $filename_to_store);
            $crop_path = $this->upload_path . self::CROP . '/' . $filename_to_store;

            $img->crop((int) $dimensions['w'], (int) $dimensions['h'], (int) $dimensions['x1'], (int) $dimensions['y1']);
            $img->save($crop_path);
            $output = $this->storeToDb($filename_to_store);
            return ['status' => 1, 'data' => $output];
        }
        return ['status' => 0, 'data' => ''];
    }

    public function storeToDb($image)
    {

        return Image::create([
            'name' => $image,
            // 'status' => 1,
        ]);
    }
}
