<?php
/**
 * 文章存档
 *
 * @package custom
 */
if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>
<article>
	<h1 class="text-center"><?php $this->title(); ?></h1>
	<div class="top-gap-big">
		<?php $this->widget('Widget_Contents_Post_Recent', 'pageSize=10000')->to($archives);
			$year=0; $mon=0; $i=0; $j=0;
			$output = '<div id="archives">';
			while($archives->next()):
				$year_tmp = date('Y',$archives->created);
				$mon_tmp = date('m',$archives->created);
				$y=$year; $m=$mon;
				if ($mon != $mon_tmp && $mon > 0) $output .= '</ul></li>';
				if ($year != $year_tmp && $year > 0) $output .= '</ul>';
				if ($year != $year_tmp) {
					$year = $year_tmp;
					$output .= '<h3 class="al_year">'. $year .' 年</h3><ul class="al_mon_list">'; //输出年份
				}
				if ($mon != $mon_tmp) {
					$mon = $mon_tmp;
					$output .= '<li><span class="al_mon">'. $mon .' 月</span><ul class="al_post_list">'; //输出月份
				}
				$output .= '<li class="text-overflow">'.date('d日: ',$archives->created).'<a href="'.$archives->permalink .'">'. $archives->title .'</a></li>'; //输出文章日期和标题
			endwhile;
			$output .= '</ul></li></ul></div>';
			echo $output;
		?>	
	</div>
</article>

<?php $this->need('footer_ad.php'); ?>	
<?php $this->need('footer.php'); ?>