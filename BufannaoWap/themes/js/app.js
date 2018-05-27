(function (w) {
    w.jApp = {
        options:{
            url:null,	    //网址
            action:null,	//action地址
            prefix:null,	//cookie前缀
            current:null,	//当前页面类型
            usePjax:!1,
            lazyLoad:!1
        },
        prevTop:0,
        headerShow:true,
        loadingShow:true,
        init:function(options){
            $.extend(jApp.options,options);
            jApp.notice();
            jApp.initClick();
            if(true === jApp.options.lazyLoad){
                jApp.initLazyLoad();
            }
			if('post' == jApp.options.current || 'page' == jApp.options.current){
                jApp.initHighLight();
                jApp.initPostMenu();
            }
            //移动页面hover失焦后
            document.body.addEventListener('touchstart', function(){});
        },
        initClick:function(){
			$(document).on('click','.site-name',function(){
                return jApp.menuToggle();
            });
            $(document).on('click','.btn-search',function(){
                var srh = $('.site-search');
                var hide = function(){
                    $(document).one("click", function(e){
                        if(!$(e.target).parents("#search").length){
                            srh.removeClass('active');
                        }else{
                            hide();
                        }
                    });
                }
                if(!srh.hasClass('active')){
                    srh.addClass('active').find('input').focus();
                }
                hide();
                return false;
            });
			$(document).on('click','.btn-nav-size',function(){
                jApp.menuSizeToggle($(this));
				return false;
            });
			$(document).on('click','.btn-screen-size',function(){
                jApp.screenSizeToggle($(this));
				return false;
            });
			$(document).on('click','.btn-mode',function(){
                jApp.modeToggle($(this));
				return false;
            });
            $(document).on('click','.btn-like',function(){
                jApp.ajaxLikePost($(this));
                return false;
            });
            $(document).on('click','.btn-gotop',function(e){
                e.preventDefault();
                jApp.goTop();
            });
            $(document).on('click','.btn-index-menu',function(e){
                e.preventDefault();
                var indexWrap = $('#post-index-wrap');
                if(indexWrap.hasClass('hidden')){
                    return false;
                }
                if(indexWrap.hasClass('open')){
                    indexWrap.removeClass('open');
                }else{
                    indexWrap.addClass('open');
                }
                return false;
            });
        },
        initPage:function(options){
            $.extend(jApp.options,options);
            if(jApp.options.title){
                $('title').text(jApp.options.title);
            }
            if('post' == jApp.options.current || 'page' == jApp.options.current){
                jApp.initHighLight();
                jApp.initPostMenu();
                $('#wrapper').addClass('single');
            }else{
                $('#wrapper').removeClass('single');
            }
            if(jApp.options.lazyLoad){
                jApp.initLazyLoad($('#main'));
            }
        },
        notice:function(){
            cookies = {notice:jApp.getCookie('__typecho_notice'),noticeType:jApp.getCookie('__typecho_notice_type')};
            if (!!cookies.notice && 'success|notice|error'.indexOf(cookies.noticeType) >= 0){
                jApp.dialog($.parseJSON(cookies.notice).join(','),cookies.noticeType);
                jApp.setCookie('__typecho_notice',null,-1);
                jApp.setCookie('__typecho_notice_type',null,-1);
            }
        },

        initHighLight:function(){
			$('#content pre > code').each(function(i, block) {
				hljs.highlightBlock(block);
			});
        },
        initLazyLoad:function(el){
            if(undefined === el){
                $('.lazy').lazyload();
            }else{
                $('.lazy',el).lazyload();
            }
        },
        initPostMenu:function(){
            var titles = $('.post-content').children('h1,h2,h3,h4'),
                wrap = $('#post-index-wrap'), wrapIndex = $('#post-index'),tagLevel = 1;
			if(!titles.length){
				wrap.parents('.panel').addClass('hidden');
				return;
			}
			$.each(titles,function(index,v){
				if($(v).text().trim() === '') {
					return;
				}
				$(v).attr('id', 'post-index-' + index);      // 加id
				var tl = parseInt($(v)[0].tagName.slice(1));  // 当前的tagLevel
				var li = null;
				if(index === 0 || tl === tagLevel) {  // 第一个或者是与上一个相同
					li = $('<li><a href="#post-index-'+ index +'">' + $(v).text() + '</a></li>');
					wrapIndex.append(li);
				} else if(tl > tagLevel) {  // 当前的大于上次的
					li = $('<ul><li><a href="#post-index-' + index + '">' + $(v).text() + '</a></li></ul>');
					wrapIndex.append(li);
					wrapIndex = li;
				} else if(tl < tagLevel) {    // 当前的小于上次的
					li = $('<li><a href="#post-index-' + index + '">' + $(v).text() + '</a></li>');
					if(tl === 1) {
						$('#post-index').append(li);
						wrapIndex = $('#post-index');
					} else {
						wrapIndex.parent('ul').append(li);
						wrapIndex = wrapIndex.parent('ul');
					}
				}
				tagLevel = tl;
            });
            if($('.btn-index-menu').hasClass('hidden')){
                $('.btn-index-menu').removeClass('hidden')
            }
			$('body').scrollspy({ target: '#post-index li > a' });
			$('body').on('activate.bs.scrollspy', function () {
			  var active = $('#post-index').find('li.active');
			  $('.post-index-highlight').css({'top':active.position().top,'height':active.height()});
			})
            wrap.affix({offset:wrap.offset().top});
            $(document).on('click','#post-index li > a',function(){
                wrap.removeClass('open');
            });
        },
        goTop:function(){
            $("html, body").animate({ scrollTop: 0 }, 200);
        },
        ajaxLikePost:function(el){
            var cid = el.data('cid');
            if(cid === undefined){
                jApp.dialog('内容不存在','error');
                return;
            }
            var num = parseInt(el.find('.likes-num').text());
            $.get(jApp.options.action+'/textends?do=like&cid='+cid+'&_='+window.token,function(rs){
                var type = 'error';
                if(rs.status==1){
                    type= 'success';
                    num = (rs.likesNum !== undefined) ? rs.likesNum : (num+1);
                    el.find('.likes-num').text(' '+num);
                }
                jApp.dialog(rs.msg,type);
            });
        },
        dialog:function(msg,type,time){		//提示信息
            var id = 'notice-'+(new Date().getTime());
            type = type==='error' ? 'error' :'success';
            time = time === undefined ? (type=='success' ? 3000 : 5000) : time;
            var html = '<div id="'+id+'" class="notice-item '+type+'"><span class="notice-item-close"><i class="icon icon-close"></i></span>'
            +'<span class="notice-item-type"><i class="icon icon-'+type+'"></i></span><p>'+msg+'</p></div>';
            var notice = $('#notice');
            if(notice.length==0){
                $('<div id="notice"></div>').appendTo($('body'));
            }
            $(html).appendTo($('#notice')).on('click','.notice-item-close',function(){
                $(this).parent().remove();
                return false;
            });
            //居中显示
            $('#notice').css('margin-right',-$('#notice').width()/2);
            if(time != 0){
                setTimeout(function(){
                    $('#'+id).remove();
                },time);
            }
        },
        setCookie:function(name,value,expires){
            expires = expires === undefined ? 1 : expires;
            expires = new Date(+new Date + 1000 * 60 * 60 * 24 * expires);
            expires = ';expires=' + expires.toGMTString();
            path = ';path=/';
            document.cookie = jApp.options.prefix+name+"="+escape(value)+expires+path;   //转码并赋值
        },
        getCookie:function(name){
            name = jApp.options.prefix+name;
            var arr,reg=new RegExp("(^| )"+name+"=([^;]*)(;|$)");
            if(arr=document.cookie.match(reg))
                return unescape(arr[2]);
            else
                return null;
        }
    };
})(window);
