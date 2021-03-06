<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\Governorates\GovernorateResource;
use App\Http\Resources\Provinces\ProvinceResource;
use App\Http\Resources\Settings\SettingResource;
use App\Http\Resources\Sliders\SliderResource;
use App\Http\Resources\Pages\PageResource;
use Illuminate\Http\Request;
use App\Models\Governorate;
use App\Models\Province;
use App\Models\Setting;
use App\Models\Slider;
use App\Models\Page;

class GlobalController extends ApiController
{
    // ALL SETTINGS PARAMETERS
    public function settings(Request $request)
    {
        $data = SettingResource::collection(Setting::all());

        return $this->responseMessages($data,true,200);
    }

    // GET SETTING ROW BY KEY
    public function setting(Request $request)
    {
        $value = Setting::where('name',$request['key'])->first();

        if ($value != null)
            return $this->responseMessages(new SettingResource($value),true,200);

        return $this->responseMessages([],false,404,[ 'the key not found']);
    }

    // GET ALL SLIDERS
    public function sliders()
    {
        return $this->responseMessages(SliderResource::collection(Slider::all()),true,200);
    }

    // GET ALL PAGES
    public function allPages()
    {
        return $this->responseMessages(PageResource::collection(Page::all()),true,200);
    }

    // GET PAGE BY ID
    public function page($id)
    {
        $page = Page::where('id',$id)->first();

        if ($page != null)
            return $this->responseMessages(new PageResource($page),true,200);

        return $this->responseMessages([],false,404,[ 'page not found']);
    }

    // GetAll Governorates
    public function governorates()
    {
        $governorates = Governorate::all();

        return $this->responseMessages(GovernorateResource::collection($governorates),true,200);
    }

    // GetAll Provinces
    public function provinces(Request $request)
    {
        $provinces = Province::orderBy('id','DESC');
        
        if ($request['governorate_id'] != null) {
            $provinces->where('governorate_id',$request['governorate_id']);
        }

        $provinces = $provinces->get();

        return $this->responseMessages(ProvinceResource::collection($provinces),true,200);
    }
}
