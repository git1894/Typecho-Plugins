<?php
/**
 * 友情链接
 *
 * @package custom
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>
<article>
  <h1 class="text-center"><?php $this->title(); ?></h1>
  <div class="top-gap-big">
		<?php $this->content(); ?>
		<?php if(isset($this->options->plugins['activated']['Links'])): ?>
		<ul>
			<?php Links_Plugin::output(null,0,'');?>
		</ul>
		<?php endif;?>
  </div>
</article>


<?php $this->need('footer_ad.php'); ?>	
<?php $this->need('footer.php'); ?>
