<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge, chrome=1">
    <title>大印相管理后台</title>
    <?= HTML::style('css/smoothness/jquery-ui-1.9.1.custom.min.css'); ?>
    <?= HTML::style('css/bootstrap.min.css'); ?>
    <?= HTML::style('css/bootstrap-responsive.min.css'); ?>
    <?= HTML::style('css/common.css'); ?>
    @yield('css')
</head>

<body>
    <div class="container">@yield('content')</div>
    <div id="popup-msg" class="alert" style="display:none"></div>
    </div>
    <?= HTML::script('js/jquery-1.10.2.min.js'); ?>
    <?= HTML::script('js/bootstrap.min.js'); ?>
    <?= HTML::script('js/ms.js'); ?>
    @yield('js')
</body>
<?php if (@$msg) : ?>
<script>
    $(function(){
        popup_msg(<?=escape_js_quotes($msg['msg'], TRUE)?>, <?=escape_js_quotes($msg['type'], TRUE)?>);
    });
</script>
<?php endif; ?>
</html>
