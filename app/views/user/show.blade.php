@extends('layouts.nav')

@section('content')
<ol class="breadcrumb">
    <li><a href="{{ URL::route('home') }}">首页</a></li>
    <li><a href="{{ URL::route('userLists') }}">用户列表</a></li>
    @if (!empty($row) && $id > 0)
    <li class="active">用户编辑</li>
    @else
    <li class="active">用户添加</li>
    @endif
</ol>

<form id='edit' role='form' method='post' class="form-horizontal ajax" action="{{ URL::route('userSave') }}">
    <div class="panel panel-default">
        <div class="panel-body">
           	<div class="form-group">
                <label class="col-sm-2 control-label">姓名</label>
                <div class="col-sm-3">
                    <input class="form-control" value="{{ @$row->real_name }}" name="real_name" placeholder="必填" />
                </div>
            </div>

           	<div class="form-group">
                <label class="col-sm-2 control-label">电话</label>
                <div class="col-sm-3">
                    <input class="form-control" value="{{ @$row->mobile }}" name="mobile" placeholder="必填" />
                </div>
            </div>

           	<div class="form-group">
                <label class="col-sm-2 control-label">地址</label>
                <div class="col-sm-3">
                    <input class="form-control" value="{{ @$row->address }}" name="address" placeholder="必填" />
                </div>
            </div>

           	<div class="form-group">
                <label class="col-sm-2 control-label">微信号</label>
                <div class="col-sm-3">
                    <input class="form-control" value="{{ @$row->wx_id }}" name="wx_id" placeholder="" />
                </div>
            </div>

           	<div class="form-group">
                <label class="col-sm-2 control-label">状态</label>
                <div class="col-sm-3">
                    <select name="status" class="form-control">
                        @foreach (BaseORM::$status_map as $k => $n)
                        <option value="{{ $k }}" @if (@$row->status == $k) selected @endif>{{ $n }}</option>
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
    $('.nav-user').addClass('active');
});
</script>
@stop
