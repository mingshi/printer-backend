<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge, chrome=1">
    <title>阿福商业管理后台</title>
    <?= HTML::style('css/ui-lightness/jquery-ui-1.10.4.custom.min.css'); ?>
    <?= HTML::style('css/jquery.datetimepicker.css'); ?>
    <?= HTML::style('css/jquery.timepicker.css'); ?>
    <?= HTML::style('css/bootstrap.min.css'); ?>
    <?= HTML::style('css/bootstrap-responsive.min.css'); ?>
    <?= HTML::style('css/common.css'); ?>
    <?= HTML::style('css/app.css'); ?>
    @yield('css')
</head>

<body>
<div role="navigation" class="navbar navbar-inverse navbar-static-top navigation" style="height: 70px;">
    <div class="header-top"></div>
    <div class="container">
        <div class="navbar-header">
            <a href="{{ URL::route('thome') }}" class="navbar-brand navigation-title" style="display:block; line-height: 30px">阿福商业管理后台</a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right" style="margin-top: 13px;">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle navigation-title account" data-toggle="dropdown">欢迎 {{ Cookie::get('admin_username') }}<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ URL::route('adminPassword') }}">修改密码</a></li>
                        <li><a href="{{ URL::route('logout') }}">退出</a></li>
                    </ul>
                </li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</div>


    @if(Session::has('success'))
    <div class="alert alert-success alert-dismissable ms-alert">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{ Session::get('success') }}
        {{ Session::forget('success') }}
    </div>
    @endif

    @if(Session::has('error'))
    <div class="alert alert-danger alert-dismissable ms-alert">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{ Session::get('error') }}
        {{ Session::forget('error') }}
    </div>
    @endif
<div class="container" style="position: relative; overflow:auto; width: 100%; background-color: #e1e2e6;">
    <div class="wash-content-wrap">
    @yield('content')
    <div class="clearfix"></div>
    </div>
</div>

<div id="popup-msg" class="alert" style="display:none"></div>
</div>

<?= HTML::script('js/jquery-1.10.2.min.js'); ?>
<?= HTML::script('js/jquery-ui-1.10.4.custom.min.js'); ?>
<?= HTML::script('js/jquery.datetimepicker.js'); ?>
<?= HTML::script('js/jquery.timepicker.js'); ?>
<?= HTML::script('js/bootstrap.min.js'); ?>
<?= HTML::script('js/jquery.ui.widget.js'); ?>
<?= HTML::script('js/common.js'); ?>
<?= HTML::script('js/jquery.browser.js'); ?>
<?= HTML::script('js/ms.js'); ?>
<?= HTML::script('js/jquery.searchabledropdown-1.0.8.min.js'); ?>
@yield('js')
<?php if (isset($msg) && $msg['info']) : ?>
<script type="text/javascript">
$(function(){
    popup_msg("<?=$msg['info']?>", "<?=$msg['type']?>");
});
</script>
<?php endif; ?>
</body>

</html>
