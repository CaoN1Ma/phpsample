@extends('layouts.default')
@section('title','更换密码')
@section('content')
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">更换密码</div>
            <div class="panel-body">
                @if(session('status'))
                    <div class="alert alert-success">
                        {{session('status')}}
                    </div>
                    @endif
                <form class="form-horizontal" method="POST" action="{{route('password.update')}}">
                    {{csrf_field()}}
                    <input type="hidden" name="token" value="{{$token}}">
                    {{--<div class="form-group{{$errors->has('email')?'has-error':''}}">--}}
                    {{--邮箱自动填写，无需检查--}}
                    <div class="form-group">
                        <label for="email" class="col-lg-4 control-label">邮箱地址：</label>
                        <div class="col-md-6">
                            {{--<input id="email" type="email" class="form-control" name="email" value="{{$email or old('email')}}" required autofocus>--}}
                            {{--手动填写邮箱--}}
                            <input id="email" type="email" class="form-control" name="email" value="{{decrypt($email)}}" readonly>
                            {{--自动填写邮箱--}}
                            @if($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{$errors->first('email')}}</strong>
                                </span>
                                @endif
                        </div>
                    </div>

                    <div class="form-group{{$errors->has('password')?'has-error':''}}">
                        <label for="password" class="col-lg-4 control-label">密码：</label>
                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control" name="password" required>
                            @if($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{$errors->first('password')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{$errors->has('password_confirmation')?'has-error':''}}">
                        <label for="password_confirm" class="col-lg-4 control-label">确认密码：</label>
                        <div class="col-md-6">
                            <input id="password_confirm" type="password" class="form-control" name="password_confirmation" required>
                            @if($errors->has('password_confirmation'))
                                <span class="help-block">
                                    <strong>{{$errors->first('password_confirmation')}}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                修改密码
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endsection