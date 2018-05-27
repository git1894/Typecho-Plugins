<?php
/**
 * 搜索页面
 *
 * @package custom
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>
<article>
	<div class="top-gap-big">		
	<div class="flex-center flex-middle" style="height:100px;">
		<form method="post" action="<?php $this->options->siteUrl(); ?>" class="form">
			<div class="flex-left units-gap">
				<input type="text" id="s" name="s" class="unit" placeholder="<?php _e('输入关键字搜索'); ?>" />
				<div class="unit-0"  style="width:85px;"><button type="submit" class="btn btn-primary"><?php _e('搜索'); ?></button></div>
			</div>
		</form>	
	</div>
	</div>
</article>

<?php $this->need('footer_ad.php'); ?>	
<?php $this->need('footer.php'); ?>
