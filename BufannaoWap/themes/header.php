<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit;
if($this->request->isAjax()) return;
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta http-equiv="Content-Type" content="text/html;"> 
<meta http-equiv="x-ua-compatible" content="ie=edge">
<meta charset="<?php $this->options->charset(); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"> 
<meta http-equiv="Cache-Control" content="no-transform">
<meta http-equiv="Cache-Control" content="no-siteapp">
<link rel="stylesheet" href="<?php $this->options->pluginUrl('BufannaoWap/themes/css/mobi.min.css'); ?>">
<link rel="stylesheet" href="<?php $this->options->pluginUrl('BufannaoWap/themes/css/caomei.css'); ?>">
<link rel="stylesheet" href="<?php $this->options->pluginUrl('BufannaoWap/themes/css/theme.css'); ?>">
<link href="<?php $this->options->pluginUrl('BufannaoWap/themes/favicon.ico'); ?>" rel="icon" />
<link rel="shortcut icon" href="<?php $this->options->pluginUrl('BufannaoWap/themes/favicon.ico'); ?>" type="image/png" />
<link rel="apple-touch-icon" sizes="152x152" href="<?php $this->options->pluginUrl('BufannaoWap/themes/images/apple-touch-icon.png'); ?>"/>
<title><?php $this->archiveTitle(array(
            'category'  =>  _t('分类：%s'),
            'search'    =>  _t('搜索：%s'),
            'tag'       =>  _t('标签：%s'),
            'author'    =>  _t('作者：%s')
        ), '', ' - '); ?><?php $this->options->title(); ?></title>
<?php if($this->options->siteExtendStyle):?>
    <style type="text/css"><?php $this->options->siteExtendStyle();?></style>
<?php endif; ?>
<!--[if lt IE 9]>
<script src="//cdnjscn.b0.upaiyun.com/libs/html5shiv/r29/html5.min.js"></script>
<script src="//cdnjscn.b0.upaiyun.com/libs/respond.js/1.3.0/respond.min.js"></script>
<![endif]-->
</head>
<body class="theme-body">
    <div class="flex-center theme-header-wrapper">
	  <div class="container flex-left units-gap theme-header-container">
		<a href="/" class="unit-0 theme-header-icon theme-icon-link" title="首页">
		  <i class="czs-home-l"></i>
		</a>
		<div class="flex-center text-center flex-middle unit theme-header-title theme-header-title-no-transition" style="font-size: 20px;">
		  <?php $this->options->title(); ?>
		</div>
		<a class="unit-0 theme-header-icon theme-icon-link theme-header-sidebar-icon" href="javascript:void(0);" title="更多">
		  <i class="czs-menu-l"></i>
		</a>
	  </div>
	</div>
	<div class="theme-header-placeholder"></div>
    <div class="flex-center">
      <div class="container">