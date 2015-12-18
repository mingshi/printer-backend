@extends('layouts.nav')

@section('content')
<ol class="breadcrumb">
    <li><a href="/">首页</a></li>
    <li class="active">banner列表</li>
    <a href="{{ URL::route('bannerShow', ['id' => 0]) }}" class="btn btn-primary btn-xs pull-right">添加Banner</a>
</ol>

<table class="table table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>排序</th>
            <th>图片</th>
            <th>状态</th>
            <th>过期时间</th>
            <th>链接</th>
            <th>操作</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($rows as $r)
        <tr>
            <td>{{ $r->id }}</td>
            <td>{{ $r->sort }}</td>
            <td>@if(!empty($r->img_md5))<img src="{{ $r->img_md5 }}" style="width: 100px;" />@endif</td>
            <td>
           		@if ($r->status == BaseORM::ENABLE)
                <span class="glyphicon glyphicon-ok"></span>
                @else
                <span class="glyphicon glyphicon-remove"></span>
                @endif 
            </td>
			<td>{{ $r->expire }}</td>
			<td>{{ $r->elink }}</td>
			<td><a href="{{ URL::route('bannerShow', ['id' => $r->id]) }}">编辑</a></td>
        </tr>
        @endforeach
    </tbody>
</table>
<?= Pagination::render($page_size); ?>
@stop

@section('js')
<script type="text/javascript">
$(function(){
    $('.nav-banner').addClass('active');
});
</script>
@stop
