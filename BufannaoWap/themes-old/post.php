<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php');?>
<article class="post page">
	<a class="post-title" href="<?php $this->permalink() ?>"><?php $this->title(); ?></a>
	<div class="post-content markdown">
		<?php $this->content(); ?>
	</div>
	<div class="post-foot">
		<span class="post-tags"><i class="icon icon-tag"></i> <?php $this->category(' '); ?> <?php $this->tags(' ', true, ''); ?></span>
		<span class="pull-right" title="<?php _e('转载请注明出处');?>">&copy; <?php _e('著作权归作者所有');?></span>
	</div>
	<div class="post-tool">
		<div class="social">
			<a class="btn-like" href="#" data-cid="<?php $this->cid();?>"><div class="social-inner"><i class="icon icon-like"></i> <?php _e('点赞');?> <span class="likes-num"><?php $this->likesNum();?></span></div></a>
			
		</div>
	</div>
</article>
<div id="post-index-wrap">
	<div class="post-index-menu"><i class="icon icon-list btn-index-menu" title="<?php _e('文章目录'); ?>"></i> <?php _e('文章目录'); ?></div>
	<div class="post-index-box">
		<div class="post-index-highlight"></div>
		<ul id="post-index" class="post-index"></ul>
	</div>
</div>
<?php $this->need('comments.php'); ?>
<?php $this->need('footer.php');?>