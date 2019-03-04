<?php
namespace App\TheApp\Libraries;

use App\TheApp\Libraries\ImgRepository;
use Illuminate\Support\Facades\Cache;
use App\Models\Setting;
use Image;

class SettingRepository
{

    static public function updateSettings($requests)
    {
	    $settings = [];

	    foreach ($requests as $key => $value) {

	        $settings[$key] = Setting::where('name' , $key)->update(['value'=>$value]);
			
	    }

	    Cache::flush();

        return back()->with(['msg'=>'The Setting Updated' , 'alert'=>'success']);
    }



    static public function updateLogo($img)
    {

        $image = ImgRepository::uploadImage($img);

		Setting::where('name','logo')->update([
			'value' => $image
		]);

		Cache::flush();

		return back()->with(['msg'=>'The logo Updated' , 'alert'=>'success']);
    }

}