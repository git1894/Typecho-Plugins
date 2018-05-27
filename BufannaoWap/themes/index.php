<?php
/**
 * Mobi
 * 
 * @package Mobi
 * @author 小否先生
 * @version 1.0.0
 * @link https://pangsuan.com
 *
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php'); ?>
<ul class="theme-ul-no-style">
<?php while($this->next()): ?>
	<div class="flex-left">
	  <div class="unit-0" style="width:80px;"><img src="<?php $this->thumbnail(); ?>-wap" style="width:80px;height:65px;padding-top:5px;"></div>
	  <div class="unit">
		  <a href="<?php $this->permalink() ?>">
			<B class="txt-center"><?php $this->title() ?></B>
		  </a>
		  <div class="text-small txt-review">
			  <?php $this->description(); ?>
			</div>
	  </div>
	</div>
	<hr style="margin-top: 2px; padding-bottom: 8px;">
<?php endwhile; ?>	
</ul>

<?php 
$totalPage = ceil($this->getTotal() / $this->parameter->pageSize);
$prePage = $totalPage - 1;
?>

<?php
if($this->_currentPage == 1){
	echo '<div class="get-more-line"><a href="/page/2">加载更多</a></div>';
}elseif($this->_currentPage == $totalPage){
	echo '<div class="get-more-line"><a href="/page/'.$prePage.'">上一页</a></div>';
}else{ 
	echo '<div class="pageli">';
	echo $this->pageLink('上一页','prev');
	echo $this->pageLink('下一页','next');
	echo '</div>';
}
?>

<?php $this->need('footer_ad.php'); ?>	
<?php $this->need('footer.php');?>
