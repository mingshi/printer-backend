@extends('layouts.nav')

@section('content')
<ol class="breadcrumb">
    <li><a href="{{ URL::route('home') }}">首页</a></li>
    <li><a href="{{ URL::route('templateLists') }}">模版列表</a></li>
    @if (!empty($row) && $id > 0)
    <li class="active">模版编辑</li>
    @else
    <li class="active">模版添加</li>
    @endif
</ol>
<form id='edit' role='form' method='post' class="form-horizontal ajax" action="{{ URL::route('templateSave') }}">
    <div class="panel panel-default">
        <div class="panel-body">
           	<div class="form-group">
                <label class="col-sm-2 control-label">名称</label>
                <div class="col-sm-3">
                    <input class="form-control" value="{{ @$row->name }}" name="name" placeholder="必填" autocomplete="off" type="text" />
                </div>
            </div>

           	<div class="form-group">
                <label class="col-sm-2 control-label">排序</label>
                <div class="col-sm-3">
                    <input class="form-control" value="{{ @$row->sort }}" name="sort" placeholder="默认为0，数字越大越靠前" autocomplete="off" type="text" />
                </div>
            </div>

           	<div class="form-group">
                <label class="col-sm-2 control-label">状态</label>
                <div class="col-sm-3">
                    <select name="status" class="form-control">
                        @foreach (BaseORM::$status_map as $k => $n)
                        <option value="{{ $k }}" {{{ @$row->status == $k ? 'selected' : ''}}}>{{ $n }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

           	<div class="form-group">
                <label class="col-sm-2 control-label">价格</label>
                <div class="col-sm-3">
                    <input class="form-control" value="{{ @$row->price }}" name="price" placeholder="不填为0元" autocomplete="off" type="text" />
                </div>
            </div>

           	<div class="form-group">
                <label class="col-sm-2 control-label">分类</label>
                <div class="col-sm-3">
                    <select name="class" class="form-control">
                        @foreach ($classes as $cid => $val)
                        <option value="{{ $cid }}" {{{ @$row->class == $cid ? 'selected' : ''}}}>{{ $val->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

           	<div class="form-group">
                <label class="col-sm-2 control-label">图片</label>
                <div class="col-sm-10">
                    <ul class="images">
                        @foreach ($sources as $s)
                        <li>
                            <input type="hidden" name="source[]" value="<?= $s->source ?>" />
                           	<span id="image-img-span">
								<img src="{{ $s->source }}" style="width:150px;" />
                            </span>
                            <br />
                            <button style="display: none;" class="btn btn-danger" type="button">删除</button>
                            <input type="radio" name="is_front" {{{ $s->is_front == BaseORM::ENABLE ? 'checked' : '' }}}>封面
                        </li>
                        @endforeach
                    </ul>
					<span class="btn btn-primary fileinput-button">
                        <i class="glyphicon glyphicon-plus"></i>
                        <span>选择图片</span>
                        <input style="width:200px;" id="image-img-btn" type="file" multiple="" name="file"/>
                    </span>
                </div>
            </div>

            <div class="form-group" style="margin-top:30px">
                <div class="osc-submit">
                    <button type="submit" class="btn btn-success">保存</button>
                    <input type="hidden" name="front_index" value="0" />
                    <input type="hidden" name="id" value="{{ $id }}" />
                </div>
            </div>

        </div>
    </div>
</form>
@stop

@section('js')
<?= HTML::script('js/jquery.iframe-transport.js'); ?>
<?= HTML::script('js/jquery.fileupload.js'); ?>
<script type="text/javascript">
$(function() {
    $('.nav-temp').addClass('active');
	$('#image-img-btn').fileupload({
        url: "{{ URL::route('uploadImage') }}",
        done: function (e, data) {
            var result = $.parseJSON(data.result);
            if (result.status == 1) {
                //$('#image-img-span').html('<img src="' + result.path + '" style="width:150px;" />');
                //$('#img_md5').val(result.path);
                var html = '<li><input type="hidden" name="source[]" value="' + result.path + '" />';
                html += '<span id="image-img-span"><img src="' + result.path + '" style="width:150px;" /></span><br /><button style="display: none;" class="btn btn-danger" type="button">删除</button><input type="radio" name="is_front">封面</li>';
                $('.images').append(html);
                each_del();
                each_check(); 
            } else {
                alert(result.error);
            }
        }
    });

    function each_del()
    {
        $('ul.images li').each(function() {
            $(this).mouseenter(function() {
                $(this).children('button').show();
            });
            $(this).mouseleave(function() {
                $(this).children('button').hide();
            });
        });

        $('button.btn-danger').each(function() {
            $(this).unbind('click');
            $(this).click(function() {
                if (confirm('你真的要删除吗？')) {
                    $(this).parent().remove(); 
                } else {
                    return false;
                }
            });
        });
    }

    function each_check()
    {
        $("input[name='is_front']").each(function() {
            $(this).unbind('change');
            $(this).change(function() {
                var index = $(this).parent().index();
                $("input[name='front_index']").val(index);
            });
        });
    }

    each_del();
    each_check();
});
</script>
@stop
