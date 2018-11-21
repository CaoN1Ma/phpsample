@extends('layouts.default')
@section('title', '登陆')
@section('content')
    <div class="col-md-offset-2 col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h1>登陆</h1>
            </div>
            <div class="panel-body">
                @include('shared._errors')

                <form method="POST" action="{{route('login')}}">

                    {{csrf_field()}}
                    {{--Laravel 为了安全考虑，会让我们提供一个 token（令牌）来防止我们的应用受到 CSRF（跨站请求伪造）的攻击--}}

                    <div class="form-group">
                        <label for="email">邮箱：</label>
                        <input type="text" name="email" class="form-control" value="{{old('email')}}">
                    </div>

                    <div class="form-group">
                        <label for="password">密码(<a href="{{route('password.request')}}" >忘记密码</a>)：</label>
                        <input type="password" name="password" class="form-control" value="{{old('password')}}">
                    </div>
                    <div class="checkbox">
                        <label><input type="checkbox" name="remember">记住我</label>
                    </div>

                    <button type="submit" class="btn btn-primary">登陆</button>
                </form>

                <hr>

                <p>还没账号？<a href="{{ route('signup') }}">现在注册！</a></p>
            </div>
        </div>
    </div>

@stop