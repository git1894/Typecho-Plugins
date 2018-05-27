<?php
/**
 * bufannao.com WAP插件
 *
 * @package bufannaoWap
 * @author Kayon
 * @version 1.0.2
 * @link https://pangsuan.com
 */
class BufannaoWap_Plugin implements Typecho_Plugin_Interface
{
    /**
     * 激活插件方法,如果激活失败,直接抛出异常
     * 
     * @access public
     * @return void
     * @throws Typecho_Plugin_Exception
     */
    public static function activate()
    {
        Typecho_Plugin::factory('Widget_Archive')->handleInit = array('BufannaoWap_Plugin', 'location');
		$actionTable = unserialize(Helper::options()->actionTable);
		$actionTable += array(
			'wap-login' => 'BufannaoWap_Login',
			'wap-editPost' => 'BufannaoWap_EditPost',
			'wap-editPage' => 'BufannaoWap_EditPage',
			'wap-editComment' => 'BufannaoWap_EditComment',
		);
		Typecho_Widget::widget('Widget_Abstract_Options')->update(array('value' => serialize($actionTable))
        , Typecho_Db::get()->sql()->where('name = ?', 'actionTable'));
        return _t('插件已激活，现在可以对插件进行设置！');
    }
    
    /**
     * 禁用插件方法,如果禁用失败,直接抛出异常
     * 
     * @static
     * @access public
     * @return void
     * @throws Typecho_Plugin_Exception
     */
    public static function deactivate(){
		$actionTable = unserialize(Helper::options()->actionTable);
		unset($actionTable['wap-login']);
		unset($actionTable['wap-editPost']);
		unset($actionTable['wap-editPage']);
		unset($actionTable['wap-editComment']);
		reset($actionTable);
		Typecho_Widget::widget('Widget_Abstract_Options')->update(array('value' => serialize($actionTable))
        , Typecho_Db::get()->sql()->where('name = ?', 'actionTable'));
        return _t('插件已禁用！');
	}
    
    /**
     * 获取插件配置面板
     * 
     * @access public
     * @param Typecho_Widget_Helper_Form $form 配置面板
     * @return void
     */
    public static function config(Typecho_Widget_Helper_Form $form)
    {
		$showPic = new Typecho_Widget_Helper_Form_Element_Radio('showPic', array('1'=>_t('是'), '0'=>_t('否')), 0, _t('是否显示图片'), _t('是否显示文章中的图片，不显示图片可以加快浏览速度并节省流量'));
		$form->addInput($showPic);
		$header = new Typecho_Widget_Helper_Form_Element_Textarea('header', NULL, '', '头部代码', '附加WAP页面头部代码');
        $form->addInput($header);
		$footer = new Typecho_Widget_Helper_Form_Element_Textarea('footer', NULL, '', '底部代码', '附加WAP页面底部代码');
        $form->addInput($footer);
	}
    
    /**
     * 个人用户的配置面板
     * 
     * @access public
     * @param Typecho_Widget_Helper_Form $form
     * @return void
     */
    public static function personalConfig(Typecho_Widget_Helper_Form $form){}

    
    /**
     * 设置Wap主题
     * 
     * @access public
     * @param Widget_Archive $widget
     * @return void
     */
    public static function location($widget)
    {
		$acceptHeader = $_SERVER['HTTP_USER_AGENT'];
		if(strpos(strtoupper($_SERVER['HTTP_ACCEPT']), "VND.WAP.WML") || strpos($acceptHeader,"NetFront") || strpos($acceptHeader,"iPhone") || strpos($acceptHeader,"MIDP-2.0") || strpos($acceptHeader,"Opera Mini") || strpos($acceptHeader,"UCWEB") || strpos($acceptHeader,"Android") || strpos($acceptHeader,"Windows CE") || strpos($acceptHeader,"SymbianOS"))
		{
			$widget->setThemeDir(__TYPECHO_ROOT_DIR__ . '/' . __TYPECHO_PLUGIN_DIR__ . '/BufannaoWap/themes/');
		}
    }

    /**
     * 输出WapHeader
     * 
     * @access public
     */
    public static function wapHeader()
    {
		$acceptHeader = $_SERVER['HTTP_USER_AGENT'];
		if (false !== strpos($acceptHeader, 'application/vnd.wap.xhtml+xml')) header('Content-type: application/vnd.wap.xhtml+xml;charset=utf-8');
		else if (false !== strpos($acceptHeader, 'application/xhtml+xml')) header('Content-type: application/xhtml+xml;charset=utf-8');
		else header('Content-type: text/html;charset=utf-8');
		echo '<?xml version="1.0" encoding="utf-8"?>';
    }
}
