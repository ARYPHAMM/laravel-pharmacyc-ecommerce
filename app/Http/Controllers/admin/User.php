<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Account;
// use Illuminate\Support\ServiceProvide;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class User extends Controller
{

    public function __construct(Controller $controller)
    { 

        parent::__construct();

    }
    public function list()
    {
      
        $items = Account::paginate(10);
        return view('admin.user.list', ['items' => $items]);
    }
    public function edit(Request $request)
    {
        if (isset($request->id)) {
            $account = Account::find($request->id);
            // return view('admin.user.edit',['account' =>$account]);
        } else {
            $account = 1;
        }
        // return view('admin.user.edit',compact('account'))->with('name','tien'); // add with a variable
        return view('admin.user.edit', compact('account')); // add with a variable
    }
    public function remove($id)
    {
        $account = Account::find($id);
        $account->delete();
        $alert = array('title' => 'Xóa tài khoản '.$account->username.' thành công!', 'status' => 'danger');
        return back()->with('session-notification', $alert);

    }
    public function update(Request $request)
    {

        $alert = array();
        if (isset($request->id)) {
            $account = Account::find($request->id);
            if ($request->email !=  $account->email) {
                $alert = array('title' => 'Có lỗi xảy ra!', 'status' => 'danger');
            } else {

                if ($this->account_current['role'] == 1) {
                    $account->username = $request->username;
                }
                if(@$request->password !== null && @$request->password != "") // have to change password
                {
                    if($request->password == $request->password_confirm)
                      $account->password = bcrypt($request->password);
                    else{
                      $alert = array('title' => 'Mật khẩu không khớp!', 'status' => 'danger');
                      return back()->with('session-notification', $alert);
                    }
                }
                $account->birthday = $request->birthday;
                if ($this->account_current['role'] == 1) {
                    $account->role = $request->role;
                }

                if ($request->hasFile('thumbnail')) {
                    $file = $request->file('thumbnail');
                    $file_name = $file->getClientOriginalName('image');
                    $extention = $file->getClientOriginalExtension('image');
                    if (strcasecmp($extention, 'jpg') === 0 || strcasecmp($extention, 'png') === 0 || strcasecmp($extention, 'jpeg') == 0) {
                        $name = Str::random(4) . "_" . $file_name;
                        while (file_exists("upload/" . $name)) {
                            $name = Str::random(4) . "_" . $file_name;
                        }
                        $file->move('upload', $name);
                       
                        $account->thumbnail = "upload/" . $name;
                    }
                }
                $alert = array('title' => 'Cập nhật tài khoản thành công!', 'status' => 'success');
            }
        } else {
            $account = new Account();
            $account->username = $request->username;
            $account->password = bcrypt($request->password);
            $account->email = $request->email;
            $account->birthday = $request->birthday;
            $account->role = '2';
            if ($request->hasFile('thumbnail')) {
                $file = $request->file('thumbnail');
                $file_name = $file->getClientOriginalName('image');
                $extention = $file->getClientOriginalExtension('image');
                if (strcasecmp($extention, 'jpg') === 0 || strcasecmp($extention, 'png') === 0 || strcasecmp($extention, 'jpeg') == 0) {
                    $name = Str::random(4) . "_" . $file_name;
                    while (file_exists("upload/" . $name)) {
                        $name = Str::random(4) . "_" . $file_name;
                    }
                    $file->move('upload', $name);
                    $account->thumbnail = "upload/" . $name;
                }
            }
            $alert = array('title' => 'Tạo tài khoản thành công!', 'status' => 'success');
        }
        $account->save();
        return redirect()->route('user-list')->with('session-notification', $alert);
    }
    public function register()
    {
        return view('admin.user.register');
    }
    public function login()
    {
        if (Cookie::get('admin') !== null) {
            return redirect()->route('admin-home');
        }
        return view('admin.user.login');
    }
    public function checkLogin(Request $request)
    {
        if (Auth::guard('account')->attempt(['email' => $request->email, 'password' => $request->password])) {
            if (Cookie::get('admin') !== null) {
                return redirect()->route('admin-home');
            } else {
                return redirect()->route('admin-home')->withCookie(cookie("admin", $request->email, 3600));
            }
        }
        return redirect()->route('user-login');
    }
    public function logout(){
        $alert = array('title' => 'Đăng xuất thành công!', 'status' => 'success');
        return redirect()->route('user-login')->withCookie(cookie("admin",null,0)) ->with('session-notification', $alert);
    }
    // public function setCookie($key,$value,$time){
    //     $reponse = new Response;
    //     $reponse->withCookie($key,$value,$time);
    //     return $reponse;
    // }
    // public function getCookie(Request $request,$key){
    //     return $request->cookie($key);
    // }
}
