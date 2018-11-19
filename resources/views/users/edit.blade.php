@extends('layouts.default')
@section('title', '更新资料')
@section('content')
    <div class="col-md-offset-2 col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h1>更新个人资料</h1>
            </div>
            <div class="panel-body">
                @include('shared._errors')

                <div class="gravatar_edit">
                    <a href="http://gravatar.com/emails" target="_blank">
                        <img src="{{$user->gravatar('200')}}" alt="{{$user->name}}" class="gravatar"/>
                    </a>
                </div>

                <form method="POST" action="{{route('users.update',$user->id)}}">

                    {{method_field('PATCH')}}
                    {{csrf_field()}}
                    {{--Laravel 为了安全考虑，会让我们提供一个 token（令牌）来防止我们的应用受到 CSRF（跨站请求伪造）的攻击--}}

                    <div class="form-group">
                        <label for="name">姓名：</label>
                        <input type="text" name="name" class="form-control" value="{{$user->name}}">
                    </div>

                    <div class="form-group">
                        <label for="email">邮箱：</label>
                        <input type="text" name="email" class="form-control" value="{{$user->email}}" disabled>
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

                    <button type="submit" class="btn btn-primary">更新</button>
                </form>
            </div>
        </div>
    </div>

@stop