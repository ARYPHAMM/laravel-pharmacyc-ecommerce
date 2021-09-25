<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;



class MyController extends Controller
{
    // public function __construct()
    // {
    //     // view()->share('menu', 'abc'); #1 
    //     view()->compoer('*',function($view){
    //           $view->with('menu','abc');
    //     });
    // }
    //
    public function getData($ten)
    {
         return view('admin.user.edit');
    }
    public function getRequest(Request $request)
    {
        // dd($request); dump
        //return $request->path(); currer request
        //return $request->url(); get host url va current url
        // if ($request->is('my*')) { condition about url name
        //     return 'myrequest';
        // } else {
        //     return 'Not my';
        // }
        if($request->isMethod('get')){
            return 'Method is get';
        }else{
            return 'Method is not get';
        }
    }
    public function getForm(){
        // return view('study.demo'); study/demo
        return view('form');
    }
    public function postForm(Request $request){
        // return $request->name;
        // return redirect('getform');

        return redirect()->route('get-form')->with('success','Successfuly!'); // add flow a session
    }
}
