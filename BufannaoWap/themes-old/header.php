<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit;
if($this->request->isAjax()) return;
?>
<!DOCTYPE HTML>
<html class="no-js">
<head>
    <meta charset="<?php $this->options->charset(); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title><?php $this->archiveTitle(array(
            'category'  =>  _t('分类：%s'),
            'search'    =>  _t('搜索：%s'),
            'tag'       =>  _t('标签：%s'),
            'author'    =>  _t('作者：%s')
        ), '', ' - '); ?><?php $this->options->title(); ?></title>

    <link href="<?php $this->options->pluginUrl('BufannaoWap/themes/favicon.ico'); ?>" rel="icon" />
    <link rel="shortcut icon" href="<?php $this->options->pluginUrl('BufannaoWap/themes/favicon.ico'); ?>" type="image/png" />
    <link rel="apple-touch-icon" sizes="152x152" href="<?php $this->options->pluginUrl('BufannaoWap/themes/images/apple-touch-icon.png'); ?>"/>
    <link rel="stylesheet" href="<?php $this->options->pluginUrl('BufannaoWap/themes/css/icon.css'); ?>">
    <link rel="stylesheet" href="<?php $this->options->pluginUrl('BufannaoWap/themes/css/global.css'); ?>">
    <link rel="stylesheet" href="<?php $this->options->pluginUrl('BufannaoWap/themes/css/markdown.css'); ?>">
    <link rel="stylesheet" href="<?php $this->options->pluginUrl('BufannaoWap/themes/default.css'); ?>">
    <?php if($this->options->siteExtendStyle):?>
    <style type="text/css"><?php $this->options->siteExtendStyle();?></style>
    <?php endif; ?>
    <!--[if lt IE 9]>
    <script src="//cdnjscn.b0.upaiyun.com/libs/html5shiv/r29/html5.min.js"></script>
    <script src="//cdnjscn.b0.upaiyun.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <?php $this->header(); ?>
</head>
<body>
<div id="wrap">
<header role="masthead">
	<a href="https://pangsuan.com"><h1 id="branding"></h1></a>
	<nav>
	<?php if($this->user->hasLogin()):?>
		<a href="<?php $this->options->logoutUrl(); ?>" class="btn btn-default pull-right" title="<?php _e('退出'); ?>"><i class="icon icon-logout"></i></a>
		<a class="btn btn-default pull-right" href="<?php $this->options->adminUrl(); ?>" title="<?php _e('后台'); ?>"><i class="icon icon-setting"></i> <?php $this->user->screenName(); ?> </a>
	<?php else:?>
		<a href="/oauth?type=weibo" rel="nofollow"><img src="<?php $this->options->pluginUrl('BufannaoWap/themes/images/weibo_login_55_24.png'); ?>" alt="微博登录"/></a>&nbsp;&nbsp;
		<a href="/oauth?type=qq" rel="nofollow"><img src="<?php $this->options->pluginUrl('BufannaoWap/themes/images/qq_logo_55_24.png'); ?>" alt="QQ登录"/></a>
	<?php endif;?>
    </nav>
</header>
<div id="content">  	
<section id="recent">
	<div class="tabs">
		<a class="btn btn-small fr" type="button" href="/action/wap-login">创建新主题</a>
		<span class="bread-nav"><a href="/tag/创意">创意</a>&nbsp;&nbsp;&nbsp;<a href="/tag/设计">设计</a>&nbsp;&nbsp;&nbsp;<a href="/tag/美食">美食</a>&nbsp;&nbsp;&nbsp;<a href="/archives.html">归档</a>&nbsp;&nbsp;&nbsp;<a href="/tags.html">标签</a></span>
	</div>
