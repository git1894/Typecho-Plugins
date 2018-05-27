<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

function themeInit($archive) {
    // 判断是否是文章，如果是就插入广告
    $ad_code = '<div style="margin-top:10px;margin-bottom: 16px;">
	<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
	<!-- wapAutoSize -->
	<ins class="adsbygoogle"
		 style="display:block"
		 data-ad-client="ca-pub-5666802432587663"
		 data-ad-slot="5442262211"
		 data-ad-format="auto"></ins>
	<script>
	(adsbygoogle = window.adsbygoogle || []).push({});
	</script></div>';
    if ($archive->is('single')) {
        $archive->content = prefix_insert_after_paragraph( $ad_code, 1, $archive->content );;
    }
}
 
// 插入广告所需的功能代码
function prefix_insert_after_paragraph( $insertion, $paragraph_id, $content ) {
    $closing_p = '</p>';
    $paragraphs = explode( $closing_p, $content );
    foreach ($paragraphs as $index => $paragraph) {
        if ( trim( $paragraph ) ) {
            $paragraphs[$index] .= $closing_p;
        }
        if ( $paragraph_id == $index + 1 ) {
            $paragraphs[$index] .= $insertion;
        }
    }
    return implode( '', $paragraphs );
}

function get_post_view($archive)
{
    $cid    = $archive->cid;
    $db     = Typecho_Db::get();
    $prefix = $db->getPrefix();
    if (!array_key_exists('viewsNum', $db->fetchRow($db->select()->from('table.contents')))) {
        $db->query('ALTER TABLE `' . $prefix . 'contents` ADD `viewsNum` INT(10) DEFAULT 0;');
        echo 0;
        return;
    }
    $row = $db->fetchRow($db->select('viewsNum')->from('table.contents')->where('cid = ?', $cid));
    if ($archive->is('single')) {
		$viewsNum = Typecho_Cookie::get('extend_contents_viewsNum');
        if(empty($viewsNum)){
            $viewsNum = array();
        }else{
            $viewsNum = explode(',', $viewsNum);
        }
	if(!in_array($cid,$viewsNum)){
       $db->query($db->update('table.contents')->rows(array('viewsNum' => (int) $row['viewsNum'] + 1))->where('cid = ?', $cid));
		array_push($viewsNum, $cid);
            $viewsNum = implode(',', $viewsNum);
            Typecho_Cookie::set('extend_contents_viewsNum', $viewsNum); //记录查看cookie
        }
    }
    echo $row['viewsNum'];
}

function theMostViewed($limit = 10, $before = '<br/> - ( 访问: ', $after = ' 次 ) ')
{
	$db = Typecho_Db::get();
	$options = Typecho_Widget::widget('Widget_Options');
	$limit = is_numeric($limit) ? $limit : 10;
	$posts = $db->fetchAll($db->select()->from('table.contents')
			 ->where('type = ? AND status = ? AND password IS NULL', 'post', 'publish')
			 ->order('viewsNum', Typecho_Db::SORT_DESC)
			 ->limit($limit)
			 );

	if ($posts) {
		foreach ($posts as $post) {
			$result = Typecho_Widget::widget('Widget_Abstract_Contents')->push($post);
			$post_views = number_format($result['viewsNum']);
			$post_title = htmlspecialchars($result['title']);
			$permalink = $result['permalink'];
			echo "<li class='text-overflow' style='margin:5px 0'><a href='$permalink'>$post_title</a></li>";
		}

	} else {
		echo "<li>N/A</li>\n";
	}
}