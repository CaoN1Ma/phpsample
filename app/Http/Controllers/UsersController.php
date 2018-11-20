<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\User;
use Auth;
use Mail;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth',[
            'except'=>['create','store','index','confirmEmail']
        ]);
        $this->middleware('guest', [
            'only' => ['create']
        ]);
//        只允许未登录用户注册
    }

    public function create()
    {
        return view('users.create');
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required|unique:users|max:50',
            'email'=>'required|email|unique:users|max:255',
            'password'=>'required|confirmed|min:6'
        ]);

        $user=User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
        ]);
//        Auth::login($user);
//        session()->flash('success','注册成功，欢迎');
//        return redirect()->route('users.show',[$user]);
//        注册后直接登录

        $this->sendEmailConfirmationTo($user);
        session()->flash('success','验证邮件已发送至您的邮箱，请注意查收');
        return redirect('/');
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user);
        return view('users.edit',compact('user'));
    }

    public function update(User $user, Request $request)
    {

        $this->validate($request,[
            'name'=>'required|unique:users|max:50',
            'password'=>'nullable|confirmed|min:6'

        ]);

        $this->authorize('update', $user);

        $data=[];
        $data['name']=$request->name;
        if ($request->password){
            $data['password']=bcrypt($request->password);
        }

        $user->update($data);
        session()->flash('success','更新成功');
        return redirect()->route('users.show', $user->id);
    }

    public function index()
    {
        $users =User::paginate(10);
        return view('users.index',compact('users'));
    }

    public function destroy(User $user)
    {
        $this->authorize('destroy', $user);
        $user->delete();
        session()->flash('success','删除成功');
        return back();
    }

    protected function sendEmailConfirmationTo($user)
    {
        $view='emails.confirm';
        $data=compact('user');
        $from='john@aaa.com';
        $name='John';
        $to=$user->email;
        $subject="哟吼吼，确认邮箱";

        Mail::send($view,$data,function ($message)use($from,$name,$to,$subject){
        $message->from($from,$name)->to($to)->subject($subject);
        });
    }

    public function confirmEmail($token)
    {
        $user=User::where('activation_token',$token)->firstOrFail();
        $user->activated=true;
        $user->activation_token=null;
        $user->save();

        Auth::login($user);
        session()->flash('success','Yo, 激活成功');
        return redirect()->route('users.show',[$user]);
    }
}
