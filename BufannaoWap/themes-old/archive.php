<?php
/**
 * 仿简书主题
 * 
 * @package JianShu
 * @author 绛木子
 * @version 2.0.0
 * @link http://lixianhua.com
 *
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php'); ?>
<?php if($this->options->siteBanner && $this->is('index') && 1 == $this->getCurrentPage()):?>
	<?php Textends_Plugin::contents('cid='.$this->options->siteBanner)->to($banner);?>
	<?php if($banner->have()):?>
	<div id="banner" class="carousel slide" data-ride="carousel" data-interval="5000" data-multi="true">
		<div class="carousel-inner" role="listbox">
		<?php while($banner->next()): ?>
			<div class="item <?php if(1 == $banner->sequence){_e('active');}?>">
				<?php Textends_Plugin::thumbnail($banner,array('width'=>'620','height'=>'310','format'=>'<a class="banner-item" href="{permalink}" style="background-image:url(\'{thumbnail}\');" title="{title}"></a>')); ?>
			</div>
		<?php endwhile; ?>
		</div>
		<a class="left carousel-control" href="#banner" role="button" data-slide="prev">
			<span class="icon icon-prev" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="right carousel-control" href="#banner" role="button" data-slide="next">
			<span class="icon icon-next" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a>
	</div>
	<?php endif; ?>
<?php endif; ?>
<div class="post-list">
<?php while($this->next()): ?>
	<a href="<?php $this->permalink() ?>">
	<article>
		<div class="item-avatar"><img src="<?php $this->thumbnail(); ?>-wap" /></div>
		<div class="item-content">
			<h1 class="title"><?php $this->title() ?></h1>
			<p class="review"><?php $this->description(); ?></p>
		</div>
	</article>
	</a>
	<div class="clear"></div>
<?php endwhile; ?>
</div>

</section>
<div class="clear"></div>

<?php
 if($this->_currentPage>1){ 
	echo '<div class="pageli">';
	echo $this->pageLink('上一页','prev');
	echo $this->pageLink('下一页','next');
	echo '</div>';
 }
elseif(ceil($this->getTotal() / $this->parameter->pageSize) > 1)
	echo '<div class="get-more-line"><a href="2">加载更多</a></div>';
?>

<div class="clear"></div>

<?php $this->need('footer.php');?>
