@extends('layouts.nav')

@section('content')
<ol class="breadcrumb">
    <li><a href="{{ URL::route('home') }}">首页</a></li>
    <li><a href="{{ URL::route('orderLists') }}">订单列表</a></li>
    <li class="active">订单查看</li>
</ol>

<form id='edit' role='form' method='post' class="ajax" action="{{ URL::route('orderSave') }}">
    <div class="panel panel-default">
        <div class="panel-body">
           	<div class="form-group">
                <label class="col-sm-1 control-label">姓名</label>
                <div class="col-sm-1">
					{{ $user->real_name }}
                </div>
                <label class="col-sm-1 control-label">微信号</label>
                <div class="col-sm-2">
					{{ $user->wx_id }}
                </div>
                <label class="col-sm-1 control-label">地址</label>
                <div class="col-sm-2">
					{{ $user->address }}
                </div>
                <label class="col-sm-1 control-label">手机</label>
                <div class="col-sm-2">
					{{ $user->mobile }}
                </div>
            </div>
			<br />

			<div class="form-group">
                <label class="col-sm-1 control-label">模版名称</label>
                <div class="col-sm-1">
					{{ $template->name }}
                </div>
                <label class="col-sm-1 control-label">模版价格</label>
                <div class="col-sm-2">
					{{ $template->price }}
                </div>
                <label class="col-sm-1 control-label">模版分类</label>
                <div class="col-sm-2">
					{{ $class->name }}
                </div>
			</div>

			<br />
			<div class="form-group">
                <label class="col-sm-1 control-label">订单状态</label>
                <div class="col-sm-1">
					<select name="status" class="form-control">
						@foreach (OrderORM::$status as $k => $n)
						<option value="{{ $k }}" {{{ $row->status == $k ? 'selected' : '' }}}>{{{ $n }}}</option>
						@endforeach
					</select>
                </div>
                <label class="col-sm-1 control-label">支付状态</label>
                <div class="col-sm-2">
					{{ OrderORM::$pay_status[$row->pay_status] }}
                </div>
			</div>

			<br />
			<ul class="album-image">
				@foreach(@$source as $s)
				<li><a href="{{ Config::get('app.image_host') }}{{ $s->source }}" target="_blank"><img src="{{ Config::get('app.image_host') }}{{ $s->source }}" /></a></li>
				@endforeach
			</ul>

			<div class="form-group" style="margin-top:30px">
                <div class="osc-submit">
                    <button type="submit" class="btn btn-success">保存</button>
                    <input type="hidden" name="id" value="{{ $id }}" />
                </div>
            </div>

 
        </div>
    </div>
</form>
@stop

@section('js')
<script type="text/javascript">
$(function() {
    $('.nav-order').addClass('active');
});
</script>
@stop
