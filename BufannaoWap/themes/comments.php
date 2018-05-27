<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

<?php
function threadedComments($comments, $options) {
    $commentClass = '';
    if ($comments->authorId) {
        if ($comments->authorId == $comments->ownerId) {
            $commentClass .= ' comment-by-author';
        } else {
            $commentClass .= ' comment-by-user';
        }
    }
    $commentLevelClass = $comments->levels > 0 ? ' comment-child' : ' comment-parent';
    $depth = $comments->levels +1;
    if ($comments->url) {
        $author = '<a href="' . $comments->url . '"target="_blank"' . ' rel="external nofollow">' . $comments->author . '</a>';
    } else {
        $author = $comments->author;
    }

	$avatar= 'https://gravatar.loli.net/avatar/' . md5($comments->mail) . '?s=32';

    ?>

    <li id="li-<?php $comments->theId(); ?>" class="comment-list-item comment even thread-even depth-<?php echo $depth ?> comment-body<?php
    if ($comments->levels > 0) {
        echo ' comment-child';
        $comments->levelsAlt(' comment-level-odd', ' comment-level-even');
    } else {
        echo ' comment-parent';
    }
    $comments->alt(' comment-odd', ' comment-even');
    ?>">
        <article id="<?php $comments->theId(); ?>" class="comment-body">
            <footer class="comment-meta">
                <div class="comment-author vcard">
                    <img class="avatar" src="<?php echo $avatar; ?>" alt="<?php echo $comments->author; ?>" width="40" height="40">
                    <?php /*$comments->gravatar(40);*/ ?>
                    <b class="fn <?php echo $commentClass; ?> " itemprop="author">
                        <?php echo $author; ?>
                    </b>
                </div>
                <!-- .comment-author -->

                <div class="comment-metadata">
                    <a href="" itemprop="url">
                        <time class="liveTime" id="liveTime" data-lta-value="<?php $comments->date('c'); ?>"></time>
                    </a>
                </div>
                <!-- .comment-metadata -->

            </footer>
            <!-- .comment-meta -->

            <div class="comment-content  major-text">
                <?php $comments->content(); ?>
            </div>
            <!-- .comment-content -->

            <div class="comment-actions">
                <?php $comments->reply('<i class="icon-action-undo icons" style="margin-right:3px;"></i>回复'); ?>
                <!-- .comment-actions -->
            </div>
        </article>

        <?php if ($comments->children) { ?>
            <div class="children">
                <?php $comments->threadedComments($options); ?>
            </div>
        <?php } ?>
    </li>
<?php } ?>

<div id="comments" data-no-instant>
    <div class="comment-respond">
    <?php $this->comments()->to($comments); /*$this->commentsNum(_t('暂无评论'), _t('仅有 1 条评论'), _t('已有 %d 条评论'));*/ ?>

        <?php if($this->allow('comment')): ?>
            <div id="<?php $this->respondId(); ?>" class="respond">
                <div class="cancel-comment-reply">
                    <?php $comments->cancelReply(); ?>
                </div>
                <h4 id="response" class="comment-reply-title">
                    <?php if($this->user->hasLogin()): ?>
						<span>发表评论</span>
					<?php endif; ?>
                    <small>
                        <span class="response">
                            <?php if($this->user->hasLogin()): ?>
                                <a href="<?php $this->options->profileUrl(); ?>"><?php $this->user->screenName(); ?></a>(已登录) <a href="<?php $this->options->logoutUrl(); ?>" class="czs-out-l"></a>
                            <?php else: ?>
								<div class="flex-center units-gap">登录后方可发表评论</div>
                            <?php endif; ?>
                        </span>
                    </small>
                </h4>
				<?php if(!$this->user->hasLogin()): ?>	
				<div class="text-center">
				<div class="account-more">
					<div class="flex-center units-gap">	
						<a class="unit-0 theme-icon-link" style="font-size: 32px;" href="/oauth?type=weibo" title="Weibo"><i class="czs-weibo"></i></a>
						<a class="unit-0 theme-icon-link" style="font-size: 32px;" href="/oauth?type=qq" title="Qq"><i class="czs-qq"></i></a>
						<a class="unit-0 theme-icon-link" style="font-size: 32px;" href="<?php echo Typecho_Common::url('/action/wap-login', $this->options->index); ?>" title="Login"><i class="czs-come-l"></i></a>
					</div>
				</div>
				</div>
				<?php else: ?>			
                <form method="post" action="<?php $this->commentUrl() ?>" id="comment-form" class="comment-form" role="form">
                    <div class="author-infos guest" id="comment-form-avatar"><img src="https://i.loli.net/2018/05/07/5af0109433ee3.png" width="100" class="avatar"></div>
                    <div class="comment-form-main">
                        <div class="comment-textarea-wrapper mdui-ripple">
                            <p class="comment-form-comment"><label for="comment">评论</label>
                                <textarea style="" id="textarea" name="text"  <?php if(!$this->user->hasLogin()): ?> onclick='document.getElementById("comment-form-do").style.display="block";'<?php endif; ?>  cols="45" rows="8" aria-required="true" required="required" placeholder="发泄你的牢骚,留下你的笔言!"><?php $this->remember('text',false); ?></textarea>
                            </p>
                            <div class="comment-form-toolbar">
                              <?php if(isset($this->options->plugins['activated']['Smilies'])) Smilies_Plugin::output(); ?>
                              
                            </div>
                        </div>
                        <p class="form-submit">
                            <button name="submit" type="submit" id="submit" class="submit"><i class="czs-telegram" style="font-size:32px"></i></button>
                            <?php $security = $this->widget('Widget_Security'); ?>
                            <input type="hidden" name="_" value="<?php echo $security->getToken($this->request->getReferer())?>">
                        </p>
                    </div>
                </form>
				<?php endif; ?>
				
            </div>
        <?php endif; ?>

        <?php if ($comments->have()): ?>
            <?php $comments->listComments(); ?>
            <?php $comments->pageNav('&laquo;', '&raquo;'); ?>

        <?php endif; ?>

    </div>
</div>

<script type="text/javascript">
(function () {
    window.TypechoComment = {
        dom : function (id) {
            return document.getElementById(id);
        },
    
        create : function (tag, attr) {
            var el = document.createElement(tag);
        
            for (var key in attr) {
                el.setAttribute(key, attr[key]);
            }
        
            return el;
        },

        reply : function (cid, coid) {
            var comment = this.dom(cid), parent = comment.parentNode,
                response = this.dom('<?php echo $this->respondId(); ?>'), input = this.dom('comment-parent'),
                form = 'form' == response.tagName ? response : response.getElementsByTagName('form')[0],
                textarea = response.getElementsByTagName('textarea')[0];

            if (null == input) {
                input = this.create('input', {
                    'type' : 'hidden',
                    'name' : 'parent',
                    'id'   : 'comment-parent'
                });

                form.appendChild(input);
            }

            input.setAttribute('value', coid);

            if (null == this.dom('comment-form-place-holder')) {
                var holder = this.create('div', {
                    'id' : 'comment-form-place-holder'
                });

                response.parentNode.insertBefore(holder, response);
            }

            comment.appendChild(response);
            this.dom('cancel-comment-reply-link').style.display = '';

            if (null != textarea && 'text' == textarea.name) {
                textarea.focus();
            }

            return false;
        },

        cancelReply : function () {
            var response = this.dom('<?php echo $this->respondId(); ?>'),
            holder = this.dom('comment-form-place-holder'), input = this.dom('comment-parent');

            if (null != input) {
                input.parentNode.removeChild(input);
            }

            if (null == holder) {
                return true;
            }

            this.dom('cancel-comment-reply-link').style.display = 'none';
            holder.parentNode.insertBefore(response, holder);
            return false;
        }
    };
})();
</script>
<script type="text/javascript">
(function () {
    var event = document.addEventListener ? {
        add: 'addEventListener',
        triggers: ['scroll', 'mousemove', 'keyup', 'touchstart'],
        load: 'DOMContentLoaded'
    } : {
        add: 'attachEvent',
        triggers: ['onfocus', 'onmousemove', 'onkeyup', 'ontouchstart'],
        load: 'onload'
    }, added = false;

    document[event.add](event.load, function () {
        var r = document.getElementById('<?php echo $this->respondId(); ?>'),
            input = document.createElement('input');
        input.type = 'hidden';
        input.name = '_';
        input.value = (function () {
    var _6Ef = '9'//'9Kj'
+''///*'NK'*/'NK'
+'4c8'//'Y'
+'997'//'3a'
+//'3S'
'f4'+'1'//'Q'
+//'8sp'
'6'+//'rC'
'f1'+//'0h'
'6c2'+//'t1R'
'2f'+'8'//'j'
+'843'//'LHg'
+//'1c'
'c9'+'a20'//'k'
+'1d'//'tX'
+//'RFD'
'ff'+//'3x'
'e', _SQIs2M = [];
    
    for (var i = 0; i < _SQIs2M.length; i ++) {
        _6Ef = _6Ef.substring(0, _SQIs2M[i][0]) + _6Ef.substring(_SQIs2M[i][1]);
    }

    return _6Ef;
})();

        if (null != r) {
            var forms = r.getElementsByTagName('form');
            if (forms.length > 0) {
                function append() {
                    if (!added) {
                        forms[0].appendChild(input);
                        added = true;
                    }
                }
            
                for (var i = 0; i < event.triggers.length; i ++) {
                    var trigger = event.triggers[i];
                    document[event.add](trigger, append);
                    window[event.add](trigger, append);
                }
            }
        }
    });
})();
</script>