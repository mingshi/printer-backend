@extends('layouts.nav')

@section('content')
<ol class="breadcrumb">
    <li><a href="{{ URL::route('home') }}">首页</a></li>
    <li><a href="{{ URL::route('albumLists') }}">相册列表</a></li>
    <li class="active">相册查看</li>
</ol>

<div class="panel panel-default">
    <div class="panel-body">
		<div class="form-group">
			<label class="col-sm-1 control-label">姓名</label>
            <div class="col-sm-2">
                {{ @$user->real_name }}
			</div>
			<label class="col-sm-1 control-label">微信号</label>
            <div class="col-sm-2">
                {{ @$user->wx_id }}
			</div>
			<label class="col-sm-1 control-label">地址</label>
            <div class="col-sm-2">
                {{ @$user->address }}
			</div>
			<label class="col-sm-1 control-label">手机</label>
            <div class="col-sm-2">
                {{ @$user->mobile }}
			</div>
		</div>

        <br />
        <div class="form-group">
            <label class="col-sm-1 control-label">分类</label>
            <div class="col-sm-2">
                {{ @$classes[$row->class]->name }}
			</div>
        </div>

        <br />
        
        <ul class="album-image">
            @foreach(@$source as $s)
            <li><img src="{{ Config::get('app.image_host') }}{{ $s->source }}" /></li> 
            @endforeach
        </ul>



    </div>
</div>
@stop

@section('js')
<script type="text/javascript">
$(function() {
    $('.nav-album').addClass('active');
});
</script>
@stop
