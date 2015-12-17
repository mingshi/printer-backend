@extends('layouts.nav')

@section('content')
<form id='edit' role='form' method='post' class="form-horizontal ajax" action="{{ URL::route('adminPasswordSave') }}">
    <div class="panel panel-default">
        <div class="panel-body">
           	<div class="form-group">
                <label class="col-sm-2 control-label">用户名</label>
                <div class="col-sm-3">
                    <input value="{{ @$row->username }}" type="text" class="form-control" placeholder="用户名" name="username" readonly="readonly" />
                </div>
            </div>

			<div class="form-group">
                <label class="col-sm-2 control-label">当前密码</label>
                <div class="col-sm-3">
					<input type="password" style="display:none">
                    <input autocomplete="off" type="password" class="form-control" placeholder="当前密码" name="currentpwd" />
                </div>
            </div>

			<div class="form-group">
                <label class="col-sm-2 control-label">新密码</label>
                <div class="col-sm-3">
                    <input autocomplete="off" type="password" class="form-control" placeholder="密码，不填即不修改" name="pwd" />
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">确认密码</label>
                <div class="col-sm-3">
                    <input autocomplete="off" type="password" class="form-control" placeholder="密码，不填即不修改" name="confirmpwd" />
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label"></label>
                <div class="osc-submit col-sm-4">
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
    $('.adminPassword').addClass('active');
});
</script>
@stop
