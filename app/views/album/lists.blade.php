@extends('layouts.nav')

@section('content')
<ol class="breadcrumb">
    <li><a href="/">首页</a></li>
    <li class="active">相册列表</li>
</ol>

<div class="panel panel-default">
    <div class="panel-heading">
        <span>快速查询</span>
    </div>
    <div class="panel-body">
        <form method="get" class="form-horizontal" role="form" >
            <div class="form-group">
                <label class="col-sm-1 control-label" for="mobile">手机</label>
                <div class="col-sm-2">
                    <input class="form-control input-sm" type="text" name="mobile" id="mobile" value="{{@$params['mobile']}}" />
                </div>
                <label class="col-sm-1 control-label" for="class">分类</label>
                <div class="col-sm-2">
                    <select name="class" class="form-control">
                        <option value="0">选择分类</option>
                        @foreach ($classes as $k => $n)
                        <option value="{{ $k }}" {{{ $params['class'] == $k ? 'selected' : ''}}}>{{ $n->name }}</option>   
                        @endforeach
                    </select>
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
            <th>分类</th>
            <th>手机</th>
            <th>姓名</th>
            <th>地址</th>
            <th>操作</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($rows as $r)
        <tr>
            <td>{{ $r->id }}</td>
            <td>{{ $classes[$r->class]->name }}</td>
            <td>{{ $r->mobile }}</td>
            <td>{{ $r->real_name }}</td>
            <td>{{ $r->address }}</td>
            <td><a href="{{ URL::route('albumShow', ['id' => $r->id]) }}">查看</a></td>
        </tr>     
        @endforeach
    </tbody>
</table>
<?= Pagination::render($page_size); ?>
@stop

@section('js')
<script type="text/javascript">
$(function() {
    $('.nav-album').addClass('active');
});
</script>
@stop
