<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InicioController extends Controller
{
    public function usa_control_1()
	{
		return view('demo_control');
	}

	public function usa_control_y_param_1($var)
	{
		return view('demo2_control')->with('variable',$var);
	}
}