<?php
/**
 * 标签云
 *
 * @package custom
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>
<div style="margin-bottom:20px;">
  <h1 class="text-center"><?php $this->title(); ?></h1>
	<div class="top-gap-big">
		<?php $this->widget('Widget_Metas_Tag_Cloud', 'ignoreZeroCount=1&limit=28')->to($tags); ?>
		<?php while($tags->next()): ?>
		<a href="<?php $tags->permalink(); ?>" class="size-<?php $tags->split(5, 10, 20, 30); ?>"><?php $tags->name(); ?></a>
		<?php endwhile; ?>
	</div>
</div>

<?php $this->need('footer_ad.php'); ?>	
<?php $this->need('footer.php'); ?>
