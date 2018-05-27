<?php

class BufannaoWap_Login extends Widget_Login
{
    public function action()
    {
		Typecho_Widget::widget('Widget_Notice')->to($notice);
		$rememberName = Typecho_Cookie::get('__typecho_remember_name');
		Typecho_Cookie::delete('__typecho_remember_name');
		BufannaoWap_Plugin::wapHeader();
?>
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Cache-control" content="no-cache" />
<link rel="stylesheet" type="text/css" media="all" href="https://pangsuan.com/usr/plugins/BufannaoWap/themes/css/caomei.css">
<link rel="stylesheet" type="text/css" media="all" href="https://pangsuan.com/usr/plugins/BufannaoWap/themes/css/global.css">
<link rel="stylesheet" type="text/css" media="all" href="https://pangsuan.com/usr/plugins/BufannaoWap/themes/css/login.css">
<title>登录 - <?php $this->options->title(); ?></title>
</head>
<body>
<div id="account" class="">
    <a class="logo" href="/" title="胖蒜">胖蒜</a>
    <div class="account-inner">
    
<div class="text-center">
    <div class="account-sign">       
        <h3 class="intro">欢迎回来</h3>
        <form action="<?php $this->options->loginAction(); ?>" method="post" name="login">
			<div class="form-group">
				<div class="input-group">
					<span class="input-group-addon"><i class="czs-user"></i></span>
					<input type="text" class="form-control" id="input-name" name="name" value="" placeholder="请输入用户名/邮箱" autocomplete="off">
				</div>
            </div>
            <div class="form-group">
				<div class="input-group">
					<span class="input-group-addon"><i class="czs-keyboard"></i></span>
					<input type="password" class="form-control" id="input-password" name="password" value="" placeholder="请输入密码">
				</div>
				
            </div>
            <div class="form-group clearfix">
                <div class="checkbox btn-remember pull-left">
					<label for="remember">
					  <input type="checkbox" name="remember" class="checkbox" value="1" id="remember">下次自动登录					</label>
				</div>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-info btn-block" value="登录">
				<p class="form-control-static pull-right hidden"><a href="/forgot">忘记密码了?</a></p>
            </div>
            <input type="hidden" name="referer" value="<?php echo htmlspecialchars($this->request->get('referer', $this->options->siteUrl)); ?>" />
        </form>
		<div class="account-more">
			<legend>社交帐号登录</legend>
			<ul>
                <li><a class="btn-weibo" href="/oauth?type=weibo" title="Weibo"><i class="czs-weibo"></i></a></li>
                <li><a class="btn-qq" href="/oauth?type=qq" title="Qq"><i class="czs-qq"></i></a></li>
			</ul>
		</div>
    </div>
</div>
	</div>
</div>

</body>
</html>
<?php
    }
}
