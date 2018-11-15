@extends('layouts.default')
@section('title', '注册')
@section('content')
    <div class="col-md-offset-2 col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h1>注册</h1>
            </div>
            <div class="panel-body">
                @include('shared._errors')

                <form method="POST" action="{{route('users.store')}}">

                    {{csrf_field()}}
                    {{--Laravel 为了安全考虑，会让我们提供一个 token（令牌）来防止我们的应用受到 CSRF（跨站请求伪造）的攻击--}}

                    <div class="form-group">
                        <label for="name">姓名：</label>
                        <input type="text" name="name" class="form-control" value="{{old('name')}}">
                    </div>

                    <div class="form-group">
                        <label for="email">邮箱：</label>
                        <input type="text" name="email" class="form-control" value="{{old('email')}}">
                    </div>

                    <div class="form-group">
                        <label for="password">密码：</label>
                        <input type="password" name="password" class="form-control" value="{{old('password')}}">
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">确认密码：</label>
                        <input type="password" name="password_confirmation" class="form-control" value="{{old('password_confirmation')}}">
                    </div>
                    {{--名字必须是password_confirmation，不允许缩写？--}}

                    <button type="submit" class="btn btn-primary">提交</button>
                </form>
            </div>
        </div>
    </div>

@stop