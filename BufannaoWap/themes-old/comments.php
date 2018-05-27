<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<div id="comments">
    <?php if($this->allow('comment')): ?>
	<div class="comments-inner">
		<h3 style="text-align: center;margin-bottom: 20px;"><?php $this->commentsNum(_t('暂无评论'), _t('仅有一条评论'), _t('已有 %d 条评论')); ?></h3>        
		<?php $this->comments()->to($comments); ?>
		<?php if ($comments->have()): ?>
		<?php $comments->listComments(); ?>
		<?php $comments->pageNav('&laquo; 前一页', '后一页 &raquo;'); ?>
		<?php endif; ?>        
	</div>
    <?php endif; ?>
    <?php if($this->allow('comment')): ?>
    <div id="<?php $this->respondId(); ?>" class="respond">
        <div class="cancel-comment-reply">
			<a href="#" id="cancel-comment-reply-link" onclick="return TypechoComment.cancelReply();" style="display:none"><?php _e('取消回复')?></a>
        </div>
    	
        <?php if($this->user->hasLogin()): ?>
        <form class="form" method="post" action="<?php $this->commentUrl() ?>" id="comment-form">
            <div class="form-group">
                <label for="textarea" class="required sr-only"><?php _e('内容'); ?></label>
                <textarea rows="4" name="text" id="textarea" class="form-control" required ><?php $this->remember('text'); ?></textarea>
            </div>
    		<div style="float: left;"><?php _e('登录身份: '); ?><a href="<?php $this->options->profileUrl(); ?>"><?php $this->user->screenName(); ?></a>. <a href="<?php $this->options->logoutUrl(); ?>" title="Logout"><?php _e('退出'); ?> &raquo;</a></div>
            <div class="form-group">
                <button type="submit" class="btn btn-block" style="float: right;"><?php _e('回复'); ?></button>
            </div>
    	</form>		
		<?php else: ?>
		<div class="text-center">
		<div class="account-more">
			<legend>登录后方可评论</legend>
			<ul>
                <li><a class="btn-weibo" href="/oauth?type=weibo" title="Weibo"><i class="icon icon-weibo"></i></a></li>
                <li><a class="btn-qq" href="/oauth?type=qq" title="Qq"><i class="icon icon-qq"></i></a></li>
                <li><a class="btn-local" href="<?php echo Typecho_Common::url('/action/wap-login', $this->options->index); ?>" title="Login"><i class="icon icon-login"></i></a></li>
			</ul>
		</div>
		</div>
		<?php endif; ?>
    		
    </div>
    <?php else: ?>
    <h3><?php _e('评论已关闭'); ?></h3>
    <?php endif; ?>
</div>
