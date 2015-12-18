@extends('layouts.nav')

@section('content')
<ol class="breadcrumb">
    <li><a href="{{ URL::route('home') }}">首页</a></li>
    <li><a href="{{ URL::route('bannerLists') }}">Banner列表</a></li>
    @if (!empty($row) && $id > 0)
    <li class="active">Banner编辑</li>
    @else
    <li class="active">Banner添加</li>
    @endif
</ol>

<form id='edit' role='form' method='post' class="form-horizontal ajax" action="{{ URL::route('bannerSave') }}">
    <div class="panel panel-default">
        <div class="panel-body">
           	<div class="form-group">
                <label class="col-sm-2 control-label">排序</label>
                <div class="col-sm-3">
                    <input class="form-control" value="{{ @$row->sort }}" name="sort" placeholder="" autocomplete="off" type="text" />
                </div>
            </div>

           	<div class="form-group">
                <label class="col-sm-2 control-label">链接</label>
                <div class="col-sm-3">
                    <input class="form-control" value="{{ @$row->elink }}" name="elink" placeholder="" autocomplete="off" type="text" />
                </div>
            </div>

           	<div class="form-group">
                <label class="col-sm-2 control-label">过期时间</label>
                <div class="col-sm-3">
					<input placeholder="必填" type="text" class="form-control" id="expire" name="expire" value="<?= @$row->expire == '' ? '' : date('Y-m-d',strtotime($row->expire)) ?>" />
                </div>
            </div>

			<div class="form-group">
			    <label class="col-sm-2 control-label">图片</label>
			    <div class="col-sm-4">
				    <input type="hidden" id="img_md5" name="img_md5" value="<?= @$row->img_md5 ?>" />
                    <span id="image-img-span">
                        @if (@$row->img_md5 && !empty($row->img_md5))
                        <img src="{{ @$row->img_md5 }}" style="width:150px;" />
                        @endif
				    </span>
				    <span class="btn btn-primary fileinput-button">
					    <i class="glyphicon glyphicon-plus"></i>
					    <span>选择图片</span>
					    <input style="width:200px;" id="image-img-btn" type="file" multiple="" name="file"/>
				    </span>
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
    $('.nav-banner').addClass('active');
    $('#expire').datepicker({ dateFormat: 'yy-mm-dd', inline: true });

	$('#image-img-btn').fileupload({
        url: "{{ URL::route('uploadImage') }}",
        done: function (e, data) {
            var result = $.parseJSON(data.result);
            if (result.status == 1) {
                $('#image-img-span').html('<img src="' + result.path + '" style="width:150px;" />');
                $('#img_md5').val(result.path);
            } else {
                alert(result.error);
            }
        }
    });
});
</script>
@stop
