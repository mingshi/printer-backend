@extends('layouts.nav')

@section('content')
<ol class="breadcrumb">
    <li><a href="/">首页</a></li>
    <li class="active">管理员列表</li>
    <a href="{{ URL::route('adminShow', ['id' => 0]) }}" class="btn btn-primary btn-xs pull-right">添加管理员</a>
</ol>
<div class="panel panel-default">
    <div class="panel-heading">
        <span>快速查询</span>
    </div>
    <div class="panel-body">
        <form method="get" class="form-horizontal" role="form" >
            <div class="form-group">
                <label class="col-sm-1 control-label" for="username">用户名</label>
                <div class="col-sm-2">
                    <input class="form-control input-sm" type="text" name="username" id="username" value="{{@$params['username']}}" />
                </div>
                <div class="osc-submit col-sm-1">
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
            <th>用户名</th>
            <th>是否超管</th>
            <th>状态</th>
            <th>最后登录时间</th>
            <th>操作</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($rows as $r)
        <tr>
            <td>{{ $r->id }}</td>
            <td>{{ $r->username }}</td>
            <td>
				@if ($r->is_super_admin == BaseORM::ENABLE)
                <span class="glyphicon glyphicon-ok"></span>
                @else
                <span class="glyphicon glyphicon-remove"></span>
                @endif
            </td>
            <td>
				@if ($r->status == BaseORM::ENABLE)
                <span class="glyphicon glyphicon-ok"></span>
                @else
                <span class="glyphicon glyphicon-remove"></span>
                @endif
            </td>
            <td>{{ $r->last_login_time }}</td>
            <td><a href="{{ URL::route('adminShow', ['id' => $r->id]) }}">编辑</a></td>
        </tr>
        @endforeach
    </tbody> 
</table>
<?= Pagination::render($page_size); ?>
@stop

@section('js')
<script type="text/javascript">
$(function() {
    $('.adminLists').addClass('active');
});
</script>
@stop
