@extends('layouts.nav')

@section('content')
<ol class="breadcrumb">
    <li><a href="{{ URL::route('home') }}">首页</a></li>
    <li><a href="{{ URL::route('activityLists') }}">活动列表</a></li>
    @if (!empty($row) && $id > 0)
    <li class="active">活动编辑</li>
    @else
    <li class="active">活动添加</li>
    @endif
</ol>
<form id='edit' role='form' method='post' class="form-horizontal ajax" action="{{ URL::route('activitySave') }}">
    <div class="panel panel-default">
        <div class="panel-body">
           	<div class="form-group">
                <label class="col-sm-2 control-label">标题</label>
                <div class="col-sm-3">
                    <input class="form-control" value="{{ @$row->subject }}" name="subject" placeholder="必填" autocomplete="off" type="text" />
                </div>
            </div>

           	<div class="form-group">
                <label class="col-sm-2 control-label">内容</label>
                <div class="col-sm-3">
					<textarea class="form-control" placeholder="必填" id="content" name="content" style="height: 200px;">{{ htmlspecialchars(@$row->content) }}</textarea>
				</div>
            </div>
        
            <div class="form-group">
                  <label class="col-sm-2 control-label">列表图片</label>
                  <div class="col-sm-4">
                      <input type="hidden" id="list_image" name="list_image" value="<?= @$row->list_image ?>" />
                      <span id="image-img-span">
                          @if (@$row->list_image)
                          <img src="{{$row->list_image}}" style="width:150px;" />
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
                <label class="col-sm-2 control-label">上线时间</label>
                <div class="col-sm-3">
					<input placeholder="必填" type="text" name="start_time" id="start_time" class="form-control" value="{{ @$row->start_time }}" />
				</div>
            </div>
			
           	<div class="form-group">
                <label class="col-sm-2 control-label">过期时间</label>
                <div class="col-sm-3">
					<input type="text" placeholder="必填" name="expire" id="expire" class="form-control" value="{{ @$row->expire }}" />
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
<?= HTML::script('packages/kindEditor/kindeditor-min.js'); ?>
<?= HTML::script('packages/kindEditor/lang/zh_CN.js'); ?>
<script type="text/javascript">
$(function(){
    $('.nav-activity').addClass('active');
	$('#expire, #start_time').datepicker({ dateFormat: 'yy-mm-dd', inline: true });

    $('#image-img-btn').fileupload({
        url: "{{ URL::route('uploadImage') }}",
        done: function (e, data) {
            var result = $.parseJSON(data.result);
            if (result.status == 1) {
                $('#image-img-span').html('<img src="' + result.path + '" style="width:150px;" />');
                $('#list_image').val(result.path);
            } else {
                alert(result.error);
            }
        }
    }); 
});
KindEditor.ready(function(K) {
	var options = {
		items: [
			'undo', 'redo', '|',
			'plainpaste', 'wordpaste', '|', 'justifyleft', 'justifycenter', 'justifyright',
			'justifyfull', 'insertorderedlist', 'insertunorderedlist', 'indent', 'outdent', 'subscript',
			'superscript', 'clearhtml', 'quickformat', 'selectall', '|', 'fullscreen', '/',
			'formatblock', 'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold',
			'italic', 'underline', 'strikethrough', 'lineheight', 'removeformat', '|', 'image', 'table', 'hr', 'pagebreak'
		],
		uploadJson: "{{ URL::route('uploadImage') }}",
		extraFileUploadParams : {
			'_token': "{{ csrf_token() }}"
		}
	};

	var editor = K.create('textarea[name="content"]', options);
});
</script>
@stop
