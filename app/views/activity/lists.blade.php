@extends('layouts.nav')

@section('content')
<ol class="breadcrumb">
    <li><a href="/">首页</a></li>
    <li class="active">活动列表</li>
    <a href="{{ URL::route('activityShow', ['id' => 0]) }}" class="btn btn-primary btn-xs pull-right">添加活动</a>
</ol>
<div class="panel panel-default">
    <div class="panel-heading">
        <span>快速查询</span>
    </div>
    <div class="panel-body">
        <form method="get" class="form-horizontal" role="form" >
            <div class="form-group">
                <label class="col-sm-1 control-label" for="start_time">上线时间</label>
                <div class="col-sm-2">
                    <input class="form-control input-sm" type="text" name="start_time" id="start_time" value="{{@$params['start_time']}}" />
                </div>
                <label class="col-sm-1 control-label" for="start_time">过期时间</label>
                <div class="col-sm-2">
                    <input class="form-control input-sm" type="text" name="expire" id="expire" value="{{@$params['expire']}}" />
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
			<th>标题</th>
			<th>上线时间</th>
			<th>过期时间</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($rows as $r)
            <tr>
                <td>{{ $r->id }}</td>
                <td>{{ $r->subject }}</td>
                <td>{{ $r->start_time }}</td>
                <td>{{ $r->expire }}</td>
                <td><a href="{{ URL::route('activityShow', ['id' => $r->id]) }}">编辑</a></td>
            </tr>        
		@endforeach
	</tbody>
</table>
<?= Pagination::render($page_size); ?>
@stop

@section('js')
<script type="text/javascript">
$(function(){
    $('.nav-activity').addClass('active');
	$('#expire, #start_time').datepicker({ dateFormat: 'yy-mm-dd', inline: true });
});
</script>
@stop
