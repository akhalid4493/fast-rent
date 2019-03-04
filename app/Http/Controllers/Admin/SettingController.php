<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\TheApp\Libraries\SettingRepository;
use App\TheApp\Requests\Admin\Settings\SettingRequest;

class SettingController extends AdminController
{

    function __construct()
    {
        // PERMISSION OF ADMIN FUNCTIONS
        $this->middleware('permission:show_settings'  ,['only' => ['show'   , 'index']]);
        $this->middleware('permission:add_settings'   ,['only' => ['create' , 'store']]);
    }


    public function index()
    {        
        return view('admin.settings.all');
    }


    public function dataTable(Request $request)
    {

    }


    public function create()
    {

    }


    public function store(Request $request)
    {
        if ($request->logo !='') {
            $settings = SettingRepository::updateLogo($request->logo);
        }else{
            $settings = SettingRepository::updateSettings($request->except('_token'));
        }
        
        return $settings;
    }


    public function show($id)
    {
        
    }


    public function edit($id)
    {
        
    }


    public function update(Request $request, $id)
    {
        
    }


    public function destroy($id)
    {
        
    }

}
