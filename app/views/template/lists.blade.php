@extends('layouts.nav')

@section('content')
<ol class="breadcrumb">
    <li><a href="/">首页</a></li>
    <li class="active">模板列表</li>
    <a href="{{ URL::route('templateLists', ['id' => 0]) }}" class="btn btn-primary btn-xs pull-right">添加模板</a>
</ol>
<div class="panel panel-default">
    <div class="panel-heading">
        <span>快速查询</span>
    </div>
    <div class="panel-body">
        <form method="get" class="form-horizontal" role="form" >
            <div class="form-group">
                <label class="col-sm-1 control-label" for="class">分类</label>
                <div class="col-sm-2">
                    <select name="class" class="form-control">
                        <option value="0">选择分类</option>
                        @foreach ($classes as $k => $v)
                        <option value="{{ $k }}" {{{ $params['class'] == $k ? 'selected' : '' }}}>{{ $v->name}}</option>
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
        <th>ID</th> 
        <th>名称</th> 
        <th>排序</th> 
        <th>状态</th> 
        <th></th> 
    </table>
</table>
@stop

@section('js')
<script type="text/javascript">
$(function(){
    $('.nav-temp').addClass('active');
});
</script>
@stop


