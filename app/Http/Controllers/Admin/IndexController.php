<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{

    // 后台主页
    public function index()
    {
        // 得到闪存并设置闪存给下一个http请求的页面使用
        session()->flash('msg', session('msg'));

        return view('admin.index.index');
    }

    // 欢迎页
    public function welcome()
    {

        return view('admin.index.welcome');
    }

    // 欢迎页
    public function test()
    {

        return view('admin.index.test');
    }

    // 用户退出
    public function logout()
    {
        auth()->logout();
        return redirect(route('admin.login'))->with('msg', '请重新登录');
    }
}
