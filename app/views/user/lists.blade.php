@extends('layouts.nav')

@section('content')
<ol class="breadcrumb">
    <li><a href="/">首页</a></li>
    <li class="active">用户列表</li>
    <a href="{{ URL::route('userShow', ['id' => 0]) }}" class="btn btn-primary btn-xs pull-right">添加用户</a>
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

<table class="table table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>姓名</th>
            <th>微信号</th>
            <th>地址</th>
            <th>状态</th>
            <th>操作</th>
        </tr>
    </thead>
    <tbody>
        @foreach($rows as $r)
        <tr>
            <td>{{ $r->id }}</td>
            <td>{{ $r->real_name }}</td>
            <td>{{ $r->wx_id }}</td>
            <td>{{ $r->address }}</td>
            <td>
                @if ($r->status == BaseORM::ENABLE)
                <span class="glyphicon glyphicon-ok"></span>
                @else
                <span class="glyphicon glyphicon-remove"></span>
                @endif
            </td>
            <td><a href="{{ URL::route('userShow', ['id' => $r->id]) }}">编辑</a></td>
        </tr>
        @endforeach
    </tbody>
</table>
<?= Pagination::render($page_size); ?>
@stop

@section('js')
<script type="text/javascript">
$(function() {
    $('.nav-user').addClass('active');
});
</script>
@stop
