<?php
/**
 * Mobi主题
 * 
 * @package Mobi
 * @author 胖蒜
 * @version 2.0.0
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
function cat_count($slug){
	$db = Typecho_Db::get();
	$po=$db->select('table.metas.count')->from ('table.metas')->where ('slug = ?', $slug);
	$pom = $db->fetchRow($po);
	$ccount = $pom['count'];
	return $ccount;
}

function cat_type($slug){
	$db = Typecho_Db::get();
	$po=$db->select('table.metas.type')->from ('table.metas')->where ('slug = ?', $slug);
	$pom = $db->fetchRow($po);
	$ctype = $pom['type'];
	return $ctype;
}


$totalPost = cat_count($this->getArchiveSlug());
$totalPage = ceil($totalPost / $this->parameter->pageSize);
$prePage = $totalPage - 1;
$plink = "/".cat_type($this->getArchiveSlug())."/".$this->getArchiveSlug();

if($totalPage > 1){
	if($this->_currentPage == 1){
		echo '<div class="get-more-line"><a href="'.$plink.'/2">加载更多</a></div>';
	}elseif($this->_currentPage == $totalPage){
		echo '<div class="get-more-line"><a href="'.$plink.'/'.$prePage.'">上一页</a></div>';
	}else{ 
		echo '<div class="pageli">';
		echo $this->pageLink('上一页','prev');
		echo $this->pageLink('下一页','next');
		echo '</div>';
	}
}
?>

<?php $this->need('footer_ad.php'); ?>	
<?php $this->need('footer.php');?>
