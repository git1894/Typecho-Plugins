<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>
<article>
  <h1 class="text-center"><?php $this->title(); ?></h1>
  <div class="text-center top-gap">
    <div class="text-small text-muted">
		<time datetime="<?php $this->date('c'); ?>">
		<?php $this->date(); ?>
		</time>
	  <span class="theme-separator">·</span>
	  <i class="czs-bookmark-l"></i>
	  <?php $this->category(' '); ?>
	  <span class="theme-separator">·</span>
	  <i class="czs-eye-l"></i>
	  <?php get_post_view($this) ?> 次
	</div>
  </div>
  <div class="top-gap-big">
  <?php $this->content(); ?>
  </div>
</article>

<?php $this->need('comments.php'); ?>

<?php $this->need('footer_ad.php'); ?>	
<?php $this->need('footer.php'); ?>
