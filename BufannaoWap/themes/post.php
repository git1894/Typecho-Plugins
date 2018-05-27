<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php');?>
<article>
  <h1 class="text-center"><?php $this->title(); ?></h1>
  <div class="text-center top-gap">
    <div class="text-small text-muted">
	  <time datetime="<?php $this->date('c'); ?>">
		<?php $this->date(); ?>
	  </time>
	  <span class="theme-separator">·</span>
	  <i class="czs-bookmark-l"></i>
	  <?php $this->category(' '); ?>
	  <span class="theme-separator">·</span>
	  <i class="czs-eye-l"></i>
	  <?php get_post_view($this) ?> 次
	</div>
  </div>
  <div class="top-gap-big">
  <?php $this->content(); ?>
  </div>
</article>
<br/>
<?php Like_Plugin::theLike(); ?>
	
<blockquote class="top-gap-big"> <p> 本文遵循 <a href="http://creativecommons.org/licenses/by-nc-nd/3.0/deed.zh" class"text-muted"="">CC BY-ND-ND 3.0</a> 协议，转载请注明原作者，禁止商用，禁止演绎。 </p> </blockquote>
<div class="top-gap-big text-center text-muted">
  <small>
    <i class="czs-tag-l"></i>
     <?php $this->tags(' ', true, ''); ?>
  </small>
</div>

  
<?php $this->need('comments.php'); ?>
<?php $this->need('footer.php');?>