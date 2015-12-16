@extends('layouts.master')

@section('css')
<style>
.form-signin {
max-width: 400px;
padding: 19px 29px 29px;
margin: 100px auto 20px;
background-color: #fff;
border: 1px solid #e5e5e5;
-webkit-border-radius: 5px;
-moz-border-radius: 5px;
border-radius: 5px;
-webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
-moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
box-shadow: 0 1px 2px rgba(0,0,0,.05);
}
.form-signin .form-signin-heading,
.form-signin .checkbox {
margin-bottom: 10px;
}
.form-signin input[type="text"],
.form-signin input[type="password"] {
font-size: 16px;
height: auto;
margin-bottom: 15px;
padding: 7px 9px;
}
</style>
@stop
@section('content')
<div class="container" style="width: 100%">
    @if(Session::has('success'))
    <div class="alert alert-success alert-dismissable" style="text-align: center;">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{ Session::get('success') }}
        {{ Session::forget('success') }}
    </div>
    @endif

    @if(Session::has('error'))
    <div class="alert alert-danger alert-dismissable" style="text-align: center;">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{ Session::get('error') }}
        {{ Session::forget('error') }}
    </div>
    @endif

    <form class="form-signin" method="post" action="{{ URL::route('dologin') }}">
        <h2 class="form-signin-heading">登录系统</h2>
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <input type="text" placeholder="用户名" name="username" class="input-block-level">
        <input type="password" placeholder="密码" name="password" class="input-block-level">
        <label>验证码
            <input type="text" name="captcha" style="width:70px;margin-bottom:0" autocomplete="off"/>
            <img src="{{ URL::route('captcha', ['r' => rand()]) }}" style="cursor:pointer" onclick="this.src=this.src.replace(/r=.+$/, 'r=' + Math.random())" title="看不清？点击换一张"/>
        </label>
        <!--
        <label class="checkbox">
          <input type="checkbox" value="remember-me"> Remember me
        </label>
        -->
        <br/>
        <button type="submit" class="btn btn-lg btn-block btn-success" style="margin-top: 20px;">登录</button>
    </form>
</div>
@stop

@section('js')
<script>$(function(){$('.form-signin :input:first')[0].focus()});</script>
@stop
