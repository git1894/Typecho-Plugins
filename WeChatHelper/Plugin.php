<?php
/**
 * 让你的微信公众帐号和Typecho博客联系起来
 * 
 * @package WeChatHelper
 * @author 冰剑
 * @version 1.0.0
 * @link http://www.binjoo.net
 */
class WeChatHelper_Plugin implements Typecho_Plugin_Interface
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
        Helper::addAction('wechatHelper', 'WeChatHelper_Action');
        Helper::addRoute('wechat', '/wechat', 'WeChatHelper_Action', 'link');
        return('微信助手已经成功激活，请进入设置Token!');
    }
    
    /**
     * 禁用插件方法,如果禁用失败,直接抛出异常
     *
     * @static
     * @access public
     * @return void
     * @throws Typecho_Plugin_Exception
     */
    public static function deactivate()
    {
        Helper::removeRoute('wechat');
        Helper::removeAction('wechatHelper');
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
        /** Token **/
        $token = new Typecho_Widget_Helper_Form_Element_Text('token', NULL, '', _t('微信Token'), '可以任意填写，用作生成签名。');
        $form->addInput($token);
        /** 用户添加订阅欢迎语 **/
        $welcome = new Typecho_Widget_Helper_Form_Element_Textarea('welcome', NULL, '哟，客官，您来啦！'.chr(10).'发送\'h\'让小的给您介绍一下！', '订阅欢迎语', '用户订阅之后主动发送的一条欢迎语消息。');
        $form->addInput($welcome);
        /** 返回最大结果条数 **/
        $imageDefault = new Typecho_Widget_Helper_Form_Element_Text('imageDefault', NULL, 'https://i.loli.net/2018/04/22/5adc4a335738f.png', _t('默认显示图片'), '图片链接，支持JPG、PNG格式，推荐图为80*80。');
        $form->addInput($imageDefault);
        /** 返回最大结果条数 **/
        $imageNum = new Typecho_Widget_Helper_Form_Element_Text('imageNum', NULL, '5', _t('返回图文数量'), '图文消息数量，限制为10条以内。');
        $imageNum->input->setAttribute('class', 'mini');
        $form->addInput($imageNum);
        /** 水墙 TOP 排行榜显示数量 **/
        $rankNum = new Typecho_Widget_Helper_Form_Element_Text('rankNum', NULL, '10', _t('访客评论排行榜'), '显示的排行榜数量。');
        $rankNum->input->setAttribute('class', 'mini');
        $form->addInput($rankNum);
        /** 日志截取字数 **/
        $subMaxNum = new Typecho_Widget_Helper_Form_Element_Text('subMaxNum', NULL, '200', _t('日志截取字数'), '显示单条日志时，截取日志内容字数。');
        $subMaxNum->input->setAttribute('class', 'mini');
        $form->addInput($subMaxNum);
    }
    
    /**
     * 个人用户的配置面板
     * 
     * @access public
     * @param Typecho_Widget_Helper_Form $form
     * @return void
     */
    public static function personalConfig(Typecho_Widget_Helper_Form $form){}
}
