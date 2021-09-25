<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
class Index extends Controller
{
   function home(){

     return view('admin.index');
   }
}
