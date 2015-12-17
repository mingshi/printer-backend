@extends('layouts.nav')

@section('content')
<ol class="breadcrumb">
    <li><a href="/">首页</a></li>
    <li class="active">相册分类列表</li>
    <a href="{{ URL::route('templateClassShow', ['id' => 0]) }}" class="btn btn-primary btn-xs pull-right">添加分类</a>
</ol>
<div class="panel panel-default">
    <div class="panel-heading">
        <span>快速查询</span>
    </div>
    <div class="panel-body">
        <form method="get" class="form-horizontal" role="form" >
            <div class="form-group">
                <label class="col-sm-1 control-label" for="name">名称</label>
                <div class="col-sm-2">
                    <input class="form-control input-sm" type="text" name="name" id="name" value="{{@$params['name']}}" />
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
			<th>名称</th>
			<th>排序</th>
			<th>状态</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($rows as $r)
		<tr>
			<td>{{ $r->id }}</td>
			<td>{{ $r->name }}</td>
			<td>{{ $r->sort }}</td>
			<td>
                @if ($r->status == BaseORM::ENABLE)
                <span class="glyphicon glyphicon-ok"></span>
                @else
                <span class="glyphicon glyphicon-remove"></span>
                @endif
            </td>
            <td><a href="{{ URL::route('templateClassShow', ['id' => $r->id]) }}">编辑</a></td>
		</tr>
		@endforeach
	</tbody>
</table>
<?= Pagination::render($page_size); ?>
@stop

@section('js')
<script type="text/javascript">
$(function() {
    $('.nav-temp-class').addClass('active');
});
</script>
@stop
