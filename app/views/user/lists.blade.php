@extends('layouts.nav')

@section('content')
<ol class="breadcrumb">
    <li><a href="/">首页</a></li>
    <li class="active">用户列表</li>
</ol>
<div class="panel panel-default">
    <div class="panel-heading">
        <span>快速查询</span>
    </div>
    <div class="panel-body">
        <form method="get" class="form-horizontal" role="form" >
            <div class="form-group">
                <label class="col-sm-1 control-label" for="owner_name">姓名</label>
                <div class="col-sm-3">
                    <input class="form-control input-sm" type="text" name="real_name" id="real_name" value="{{@$params['real_name']}}" />
                </div>
                <label class="col-sm-1 control-label" for="mobile">手机</label>
                <div class="col-sm-3">
                    <input class="form-control input-sm" type="text" name="mobile" id="mobile" value="{{@$params['mobile']}}" />
                </div>
            </div>
            <div class="form-group">
                <div class="osc-submit">
                    <button type="submit" class="btn btn-primary btn-large">查询</button>
                </div>
            </div>

        </form>
    </div>
</div>
@stop

@section('js')
<script type="text/javascript">
$(function() {
    $('.nav-user').addClass('active');
});
</script>
@stop
