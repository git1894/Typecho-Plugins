<div class="theme-sidebar-mask theme-hide"></div>
	  
	<aside class="theme-sidebar-wrapper">
	  <div class="container flex-left units-gap theme-header-container">			  
		<a class="unit-0 theme-icon-link" href="/tags.html" title="标签">
		  <i class="czs-tag-l"></i>
		</a>		  
		<a class="unit-0 theme-icon-link" href="/search.html" title="搜索">
		  <i class="czs-search-l"></i>
		</a>
	  
		<div class="unit"></div>
		<?php if($this->user->hasLogin()):?>
			<a class="unit-0 theme-icon-link" href="<?php $this->options->logoutUrl(); ?>" title="退出">
			  <i class="czs-out-l"></i>
			</a>
			<a class="unit-0 theme-icon-link" href="<?php $this->options->adminUrl(); ?>" title="后台">
			  <i class="czs-setting-l"></i>
			</a>	
		<?php else:?>
			<a href="/oauth?type=weibo" rel="nofollow"><img src="<?php $this->options->pluginUrl('BufannaoWap/themes/images/weibo_login_55_24.png'); ?>" alt="微博登录"/></a>&nbsp;&nbsp;
			<a href="/oauth?type=qq" rel="nofollow"><img src="<?php $this->options->pluginUrl('BufannaoWap/themes/images/qq_logo_55_24.png'); ?>" alt="QQ登录"/></a>
		<?php endif;?>
	  </div>
	
	  <div class="container">
		
		  <h1>胖蒜</h1>
		  
		  <p class="top-gap-0 text-muted">发现、分享新鲜有趣的知识</p>
		  
		  <div class="flex-left flex-middle top-gap">
			<img src="<?php $this->options->pluginUrl('BufannaoWap/themes/images/1weima.png'); ?>"/>
		  </div>
		  
		  <p>欢迎访问胖蒜网，这里搜集了新鲜有趣的知识，希望能够与您一起交流，共同成长。</p>
		  
		  <p class="theme-sidebar-social">
		  
			<a class="unit-0 theme-icon-link" href="https://weibo.com/pangsuan" title="V2EX">
			  <i class="czs-weibo"></i>
			</a>
		  
			<a class="unit-0 theme-icon-link" href="https://twitter.com/mhcyong" title="Twitter">
			  <i class="czs-twitter"></i>
			</a>
		  
			<a class="unit-0 theme-icon-link" href="mailto:m@pangsuan.com" title="Gmail">
			  <i class="czs-message-l"></i>
			</a>
		  
			<a class="unit-0 theme-icon-link" href="/feed" title="RSS 订阅">
			  <i class="czs-rss"></i>
			</a>
		  
		  </p>
		  
		  <h1>友情链接</h1>
		  <p class="text-muted">
			<small>
			  </small></p><ul class="theme-list-style-none"><small>
				<li><a class="text-muted" href="https://blog.pangsuan.com/">博客</a></li>
				<li><a class="text-muted" href="https://i.pangsuan.com">图床</a></li>
				<li><a class="text-muted" href="/links.html">More</a></li>
			  </small></ul><small>
			</small>
		  <p></p>			  
	  </div>
	</aside>