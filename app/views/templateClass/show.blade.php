@extends('layouts.nav')

@section('content')
<ol class="breadcrumb">
    <li><a href="{{ URL::route('home') }}">首页</a></li>
    <li><a href="{{ URL::route('templateClasses') }}">模版分类列表</a></li>
    @if (!empty($row) && $id > 0)
    <li class="active">分类编辑</li>
    @else
    <li class="active">分类添加</li>
    @endif
</ol>

<form id='edit' role='form' method='post' class="form-horizontal ajax" action="{{ URL::route('templateClassSave') }}">
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
                    <input class="form-control" value="{{ @$row->sort }}" name="sort" placeholder="默认为0，数字越大，排序越靠前" autocomplete="off" type="text" />
                </div>
            </div>
 
           	<div class="form-group">
                <label class="col-sm-2 control-label">状态</label>
                <div class="col-sm-3">
					<select name="status" class="form-control">
						@foreach (BaseORM::$status_map as $k => $n)
						<option value="{{ $k }}" {{{@$row->status == $k ? 'selected' : ''}}}>{{ $n }}</option>
						@endforeach
					</select>
                </div>
            </div>

            <div class="form-group">
                  <label class="col-sm-2 control-label">类型封面</label>
                  <div class="col-sm-4">
                      <input type="hidden" id="front" name="front" value="<?= @$row->front ?>" />
                      <span id="image-img-span">
                          @if (@$row->front)
                          <img src="{{$row->front}}" style="width:150px;" />
                          @endif
                      </span>
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
    $('.nav-temp-class').addClass('active');

    $('#image-img-btn').fileupload({
        url: "{{ URL::route('uploadImage') }}",
        done: function (e, data) {
            var result = $.parseJSON(data.result);
            if (result.status == 1) {
                $('#image-img-span').html('<img src="' + result.path + '" style="width:150px;" />');
                $('#front').val(result.path);
            } else {
                alert(result.error);
            }
        }
    });
});
</script>
@stop
