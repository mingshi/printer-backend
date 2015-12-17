@extends('layouts.nav')

@section('content')
<ol class="breadcrumb">
    <li><a href="{{ URL::route('home') }}">首页</a></li>
    <li><a href="{{ URL::route('adminLists') }}">管理员列表</a></li>
    @if (!empty($row) && $id > 0)
    <li class="active">管理员编辑</li>
    @else
    <li class="active">管理员添加</li>
    @endif
</ol>

<form id='edit' role='form' method='post' class="form-horizontal ajax" action="{{ URL::route('adminSave') }}">
    <div class="panel panel-default">
        <div class="panel-body">
           	<div class="form-group">
                <label class="col-sm-2 control-label">用户名</label>
                <div class="col-sm-3">
                    <input class="form-control" value="{{ @$row->username }}" name="username" placeholder="必填" autocomplete="off" type="text" />
                </div>
            </div>

           	<div class="form-group">
                <label class="col-sm-2 control-label">密码</label>
                <div class="col-sm-3">
                	<input type="password" style="display:none;">
					<input placeholder="新增必填,编辑不填为不修改" type="password" class="form-control" name="pwd" />
				</div>
            </div>

           	<div class="form-group">
                <label class="col-sm-2 control-label">是否超管</label>
                <div class="col-sm-3">
					<select name="is_super_admin" class="form-control">
						@foreach (BaseORM::$status_map as $k => $n)
						<option value="{{ $k }}" {{{@$row->is_super_admin == $k ? 'selected' : ''}}}>{{ $n }}</option>
						@endforeach
					</select>
				</div>
            </div>
 
           	<div class="form-group">
                <label class="col-sm-2 control-label">状态</label>
                <div class="col-sm-3">
					<select name="status" class="form-control">
						@foreach (BaseORM::$status_map as $k => $n)
						<option value="{{ $k }}" {{{@$row->status == $k ? 'selected' : ''}}}>{{ $n }}</option>
						@endforeach
					</select>
				</div>
            </div>

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
    $('.adminLists').addClass('active');
});
</script>
@stop
