<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge, chrome=1">
    <title>小区阿福后台</title>
    <?= HTML::style('css/bootstrap.min.css'); ?>
    <?= HTML::style('css/common.css'); ?>
    <?= HTML::style('css/ui-lightness/jquery-ui-1.10.4.custom.min.css'); ?>
    @yield('css')
</head>

<body>
<div role="navigation" class="navbar navbar-inverse navbar-static-top">
    <div class="container" style="width: 100%;">
        <div class="navbar-header">
            <a href="/" class="navbar-brand">小区阿福后台</a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="nav-user"><a href="{{ URL::route('userLists') }}">用户</a></li>
                <li class="nav-temp-class"><a href="{{ URL::route('templateClasses') }}">相册分类</a></li>
                <li class="nav-temp"><a href="{{ URL::route('templateLists') }}">模版管理</a></li>
                <li class="nav-order"><a href="">订单管理</a></li>
                <li class="nav-album"><a href="{{ URL::route('albumLists') }}">相册管理</a></li>
                <li class="nav-activity"><a href="">活动管理</a></li>
                <li class="nav-banner"><a href="{{ URL::route('bannerLists') }}">广告管理</a></li>
            </ul>
            
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle navigation-title account" data-toggle="dropdown">欢迎 {{ Cookie::get('admin_username') }}<b class="caret"></b></a>
                   	<ul class="dropdown-menu">
                        <li class="adminPassword"><a href="{{ URL::route('adminPassword') }}">修改密码</a></li>
						@if($g['is_super_admin'])
                        <li class="adminLists"><a href="{{ URL::route('adminLists') }}">管理员</a></li>
						@endif
                        <li><a href="{{ URL::route('logout') }}">退出</a></li>
                    </ul> 
                </li>
            </ul>            

        </div><!--/.nav-collapse -->
    </div>
</div>

<div class="container" style="width: 100%">
    @if(Session::has('success'))
    <div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{ Session::get('success') }}
        {{ Session::forget('success') }}
    </div>
    @endif

    @if(Session::has('error'))
    <div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{ Session::get('error') }}
        {{ Session::forget('error') }}
    </div>
    @endif

    @yield('content')
</div>

<div id="popup-msg" class="alert" style="display:none"></div>
</div>

<?= HTML::script('js/jquery-1.10.2.min.js'); ?>
<?= HTML::script('js/bootstrap.min.js'); ?>
<?= HTML::script('js/jquery.ui.widget.js'); ?>
<?= HTML::script('js/common.js'); ?>
<?= HTML::script('js/jquery-ui-1.10.4.custom.min.js'); ?>
<?= HTML::script('js/jquery.datetimepicker.js'); ?>
<?= HTML::script('js/jquery.timepicker.js'); ?>
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
