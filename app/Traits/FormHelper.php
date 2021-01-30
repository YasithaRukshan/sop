<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait FormHelper
{
    /**
     * check image and return
     *
     * @param  mixed $images
     * @return void
     */
    public function image($images)
    {
        if ($images) {
            return config('images.access_path') . 'crop/' . $images->name;
        } else {
            return asset('assets/images/no.jpg');
        }
    }

    /**
     * get status badge
     *
     * @param  mixed $status
     * @return void
     */
    public function getStatus($status)
    {
        if ($status == 1) {
            return  '<span class="badge badge-success">Published</span>';
        } else {
            return  '<span class="badge badge-danger">Drafted</span>';
        }
    }

    /**
     * limit String
     *
     * @param  mixed $String
     * @return void
     */
    public function limitStr($str)
    {
        return Str::limit($str ? $str : '', 50);
    }

    /**
     * limit 100 String
     *
     * @param  mixed $String
     * @return void
     */

    public function limitStr100($str)
    {
        return Str::limit($str ? $str : '', 100);
    }

    /**
     * set description
     *
     * @param  mixed $description,$images
     * @return void
     */

    public function setdescription($description, $images)
    {
        if ($description) {
            return '<p class="card-text" >' . $this->limitStr100($description) . '</p>';
        } else {
            if ($images) {
                return '<div class="pb-2 mt-2"> <div class="alert alert-danger align-middle  text-center fade show " role="alert">
                        <i class="mdi mdi-block-helper mr-2"></i>
                        <span class="align-middle">Not yet add a description.</span> </div></div>';
            } else {
                return '<div class="pb-2  mt-2"> <div class="alert alert-danger align-middle text-center fade show " role="alert">
                        <i class="mdi mdi-block-helper mr-2"></i>
                        <span class="align-middle">Not yet add a description and image.</span></div></div>';
            }
        }
    }
    /**
     * numK
     *
     * @param  mixed $input
     * @return void
     */
    function numdK($input)
    {
        $input = number_format($input);
        $input_count = substr_count($input, ',');
        if ($input_count != '0') {
            if ($input_count == '1') {
                return substr($input, 0, -4) . 'k';
            } else if ($input_count == '2') {
                return substr($input, 0, -8) . 'mil';
            } else if ($input_count == '3') {
                return substr($input, 0,  -12) . 'bil';
            } else {
                return;
            }
        } else {
            return $input;
        }
    }
    function numberAbbreviation($number)
    {
        $abbrevs = array(12 => "T", 9 => "B", 6 => "M", 3 => "K", 0 => "");
        foreach ($abbrevs as $exponent => $abbrev) {
            if ($number >= pow(10, $exponent)) {
                $display_num = $number / pow(10, $exponent);
                $decimals = ($exponent >= 3 && round($display_num) < 100) ? 1 : 0;
                if ($display_num > 0) {
                    return number_format($display_num, $decimals) . $abbrev;
                }
            }
        }
        return 0;
    }
}
