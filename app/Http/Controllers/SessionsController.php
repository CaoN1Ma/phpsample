<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;

class SessionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest', [
            'only' => ['create']
        ]);
    }

    public function create()
    {
        return view('sessions.create');
    }

    public function store(Request $request)
    {
        $credentials=$this->validate($request,[
            'email'=>'required|email|max:255',
            'password'=>'required'
        ]);

        if (Auth::attempt($credentials,$request->has('remember'))){
            if (Auth::user()->activated)
            {
            session()->flash('success','欢迎回来');
            return redirect()->intended(route('users.show',[Auth::user()]));
            }else{
                Auth::logout();
                session()->flash('warning','账号未激活，请检查您的邮箱激活账号');
                return redirect('/');
            }
        }else{
            session()->flash('danger','邮箱或密码不匹配');
            return redirect()->back();
        }

    }
    public function destroy()
    {
        Auth::logout();
        session()->flash('success','退出成功！');
        return redirect('login');
    }

}
