@extends('layouts.nav')

@section('content')
<ol class="breadcrumb">
    <li><a href="/">首页</a></li>
    <li class="active">订单列表</li>
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
                <label class="col-sm-1 control-label" for="status">状态</label>
                <div class="col-sm-2">
                    <select name="status" class="form-control">
                        <option value="-1">选择状态</option>
                        @foreach (OrderORM::$status as $k => $n)
                        <option value="{{ $k }}" {{{ $params['status'] == $k ? 'selected' : '' }}}>{{ $n }}</option>
                        @endforeach
                    </select>
                </div>
                <label class="col-sm-1 control-label" for="pay_status">支付状态</label>
                <div class="col-sm-2">
                    <select name="pay_status" class="form-control">
                        <option value="-1">选择支付状态</option>
                        @foreach (OrderORM::$pay_status as $k => $n)
                        <option value="{{ $k }}" {{{ $params['pay_status'] == $k ? 'selected' : '' }}}>{{ $n }}</option>
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
            <th>姓名</th>    
            <th>地址</th>    
            <th>电话</th>    
            <th>数量</th>    
            <th>总价</th>    
            <th>状态</th>    
            <th>支付状态</th> 
            <th>操作</th> 
        </tr>
    </thead>
    <tbody>
        @foreach ($rows as $r)
        <tr>
            <td>{{ $r->id }}</td>
            <td>{{ $r->real_name }}</td>
            <td>{{ $r->address }}</td>
            <td>{{ $r->mobile }}</td>
            <td>{{ $r->quantity }}</td>
            <td>{{ $r->total_amount }}</td>
            <td>{{ OrderORM::$status[$r->status] }}</td>
            <td>{{ OrderORM::$pay_status[$r->pay_status] }}</td>
            <td><a href="{{ URL::route('orderShow', ['id' => $r->id]) }}">查看</a></td>
        </tr>
        @endforeach
    </tbody>
</table>
<?= Pagination::render($page_size); ?>
@stop

@section('js')
<script type="text/javascript">
$(function (){
    $('.nav-order').addClass('active');
});
</script>
@stop
