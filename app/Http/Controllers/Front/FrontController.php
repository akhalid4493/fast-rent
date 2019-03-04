<?php

namespace App\Http\Controllers\Front;

use App\TheApp\Libraries\SendNotification;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FrontController extends Controller
{
  use SendNotification;

    public function index()
    {
    	return view('front.home');
    }
}
