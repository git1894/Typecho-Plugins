<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
		<?php if($this->request->isAjax()) :?>
		<script>
			window.token = <?php echo Typecho_Common::shuffleScriptVar(
										$this->security->getToken($this->request->getRequestUrl()));?>
			jApp.initPage({
				title:'<?php $this->archiveTitle(array(
					'category'  =>  _t('分类 %s 下的文章'),
					'search'    =>  _t('包含关键字 %s 的文章'),
					'tag'       =>  _t('标签 %s 下的文章'),
					'author'    =>  _t('%s 发布的文章')
				), '', ' - '); ?><?php $this->options->title(); ?>',
				current:'<?php echo $this->is('account') ? 'action' : $this->getArchiveType();?>',
				lazyLoad:<?php echo  $this->options->lazyLoad ? 'true' : 'false';?>
			});
			TeCmt.init({action:'<?php $this->options->index('action');?>',current:'<?php echo $this->getArchiveType();?>'});
		</script>
		<div class="hidden"><?php if($this->options->siteStat):?><?php $this->options->siteStat();?><?php endif;?></div>
		<?php return;endif;?>
	</div><!-- end #main-->
		<?php if(!$this->is('post')): ?>					
			<footer class="footer">
				<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
				<!-- wapAutoSize -->
				<ins class="adsbygoogle"
					 style="display:block"
					 data-ad-client="ca-pub-5666802432587663"
					 data-ad-slot="5442262211"
					 data-ad-format="auto"></ins>
				<script>
				(adsbygoogle = window.adsbygoogle || []).push({});
				</script>
			</footer><!-- end #footer -->
		<?php endif;?>	
    </div>
	<?php if($this->is('post')): ?>		
		<div class="site-tool">
			<a href="#" class="icon icon-list btn-index-menu<?php if(!$this->is('single')){ _e(' hidden');}?>" title="<?php _e('文章目录'); ?>"></a>
			<a href="#" class="icon icon-top btn-gotop"></a>
		</div>
	<?php endif;?>		
</div><!-- end #wrapper -->
<script src="https://oanwyx954.qnssl.com/jquery.min.js"></script>
<script src="https://oanwyx954.qnssl.com/jquery.plugins.js"></script>
<script src="https://oanwyx954.qnssl.com/app-wap.js"></script>
<script>
	$(function(){
		window.token = <?php echo Typecho_Common::shuffleScriptVar(
								$this->security->getToken($this->request->getRequestUrl()));?>
		jApp.init({
			url:'<?php $this->options->siteUrl();?>',
			action:'<?php $this->options->index('action');?>',
			usePjax:<?php echo $this->options->usePjax ? 'true' : 'false';?>,
			current:'<?php echo $this->getArchiveType();?>',
			prefix:'<?php echo md5($this->options->rootUrl);?>',
			lazyLoad:<?php echo  $this->options->lazyLoad ? 'true' : 'false';?>
		});
	});
</script>
<div class="hidden"><?php if($this->options->siteStat):?><?php $this->options->siteStat();?><?php endif;?></div>
<?php $this->footer(); ?>
</body>
</html>
