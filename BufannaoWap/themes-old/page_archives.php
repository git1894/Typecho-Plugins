<?php
/**
 * 文章存档
 *
 * @package custom
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>
<article class="post page">
	<div class="post-content markdown">
		<?php Textends_Plugin::archives();?>
	</div>
</article>
<?php $this->need('footer.php'); ?>