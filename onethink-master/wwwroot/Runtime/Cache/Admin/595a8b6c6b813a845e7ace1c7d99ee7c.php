<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo ($meta_title); ?>|OneThink管理平台</title>
    <link href="/Public/favicon.ico" type="image/x-icon" rel="shortcut icon">
    <link rel="stylesheet" type="text/css" href="/Public/Admin/css/base.css" media="all">
    <link rel="stylesheet" type="text/css" href="/Public/Admin/css/common.css" media="all">
    <link rel="stylesheet" type="text/css" href="/Public/Admin/css/module.css">
    <link rel="stylesheet" type="text/css" href="/Public/Admin/css/style.css" media="all">
	<link rel="stylesheet" type="text/css" href="/Public/Admin/css/<?php echo (C("COLOR_STYLE")); ?>.css" media="all">
     <!--[if lt IE 9]>
    <script type="text/javascript" src="/Public/static/jquery-1.10.2.min.js"></script>
    <![endif]--><!--[if gte IE 9]><!-->
    <script type="text/javascript" src="/Public/static/jquery-2.0.3.min.js"></script>
    <script type="text/javascript" src="/Public/Admin/js/jquery.mousewheel.js"></script>
    <!--<![endif]-->
    
</head>
<body>
    <!-- 头部 -->
    <div class="header">
        <!-- Logo -->
        <span class="logo"></span>
        <!-- /Logo -->

        <!-- 主导航 -->
        <ul class="main-nav">
            <?php if(is_array($__MENU__["main"])): $i = 0; $__LIST__ = $__MENU__["main"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($i % 2 );++$i;?><li class="<?php echo ((isset($menu["class"]) && ($menu["class"] !== ""))?($menu["class"]):''); ?>"><a href="<?php echo (U($menu["url"])); ?>"><?php echo ($menu["title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
        <!-- /主导航 -->

        <!-- 用户栏 -->
        <div class="user-bar">
            <a href="javascript:;" class="user-entrance"><i class="icon-user"></i></a>
            <ul class="nav-list user-menu hidden">
                <li class="manager">你好，<em title="<?php echo session('user_auth.username');?>"><?php echo session('user_auth.username');?></em></li>
                <li><a href="<?php echo U('User/updatePassword');?>">修改密码</a></li>
                <li><a href="<?php echo U('User/updateNickname');?>">修改昵称</a></li>
                <li><a href="<?php echo U('Public/logout');?>">退出</a></li>
            </ul>
        </div>
    </div>
    <!-- /头部 -->

    <!-- 边栏 -->
    <div class="sidebar">
        <!-- 子导航 -->
        
            <div id="subnav" class="subnav">
                <?php if(!empty($_extra_menu)): ?>
                    <?php echo extra_menu($_extra_menu,$__MENU__); endif; ?>
                <?php if(is_array($__MENU__["child"])): $i = 0; $__LIST__ = $__MENU__["child"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sub_menu): $mod = ($i % 2 );++$i;?><!-- 子导航 -->
                    <?php if(!empty($sub_menu)): if(!empty($key)): ?><h3><i class="icon icon-unfold"></i><?php echo ($key); ?></h3><?php endif; ?>
                        <ul class="side-sub-menu">
                            <?php if(is_array($sub_menu)): $i = 0; $__LIST__ = $sub_menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($i % 2 );++$i;?><li>
                                    <a class="item" href="<?php echo (U($menu["url"])); ?>"><?php echo ($menu["title"]); ?></a>
                                </li><?php endforeach; endif; else: echo "" ;endif; ?>
                        </ul><?php endif; ?>
                    <!-- /子导航 --><?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
        
        <!-- /子导航 -->
    </div>
    <!-- /边栏 -->

    <!-- 内容区 -->
    <div id="main-content">
        <div id="top-alert" class="fixed alert alert-error" style="display: none;">
            <button class="close fixed" style="margin-top: 4px;">&times;</button>
            <div class="alert-content">这是内容</div>
        </div>
        <div id="main" class="main">
            
            <!-- nav -->
            <?php if(!empty($_show_nav)): ?><div class="breadcrumb">
                <span>您的位置:</span>
                <?php $i = '1'; ?>
                <?php if(is_array($_nav)): foreach($_nav as $k=>$v): if($i == count($_nav)): ?><span><?php echo ($v); ?></span>
                    <?php else: ?>
                    <span><a href="<?php echo ($k); ?>"><?php echo ($v); ?></a>&gt;</span><?php endif; ?>
                    <?php $i = $i+1; endforeach; endif; ?>
            </div><?php endif; ?>
            <!-- nav -->
            

            
    <script type="text/javascript" src="/Public/static/uploadify/jquery.uploadify.min.js"></script>
    <div class="main-title">
        <h2>
            <?php echo ($info['id']?'编辑':'新增'); ?>租售
            <!--<?php if(!empty($pid)): ?>-->
                <!--[&nbsp;父导航：<a href="<?php echo U('index','pid='.$pid);?>"><?php echo ($parent["title"]); ?></a>&nbsp;]-->
            <!--<?php endif; ?>-->
        </h2>
    </div>
    <form action="<?php echo U();?>" method="post" class="form-horizontal">
        <!--<input type="hidden" name="pid" value="<?php echo ($pid); ?>">-->
        <div class="form-item">
            <label class="item-label">租售标题<span class="check-tips">（用于显示的文字）</span></label>
            <div class="controls">
                <input type="text" class="text input-large" name="title" value="<?php echo ((isset($info["title"]) && ($info["title"] !== ""))?($info["title"]):''); ?>">
            </div>
        </div>
        <div class="form-item">
            <label class="item-label">简单描述<span class="check-tips"></span></label>
            <label class="textarea">
                <textarea name="detail"><?php echo ((isset($info["detail"]) && ($info["detail"] !== ""))?($info["detail"]):''); ?></textarea>
                <?php echo hook('adminArticleEdit', array('name'=>$field['name'],'value'=>$data[$field['name']]));?>
            </label>
        </div>


        <div class="form-item" value="file">
            <label class="item-label">房屋图片<span class="check-tips"></span></label>
            <div class="controls">
                <input type="file" id="upload_picture_<?php echo ($field["name"]); ?>">
                <input type="hidden" name="img" id="cover_id_<?php echo ($field["name"]); ?>" value="<?php echo ($data[$field['name']]); ?>"/>
                <div class="upload-img-box">
                    <?php if(!empty($data[$field['name']])): ?><div class="upload-pre-item"><img src="<?php echo (get_cover($data[$field['name']],'path')); ?>"/></div><?php endif; ?>
                </div>
            </div>
        </div>

        <script type="text/javascript">
            //上传图片
            /* 初始化上传插件 */
            $("#upload_picture_<?php echo ($field["name"]); ?>").uploadify({
                "height"          : 30,
                "swf"             : "/Public/static/uploadify/uploadify.swf",
                "fileObjName"     : "download",
                "buttonText"      : "上传图片",
                "uploader"        : "<?php echo U('File/uploadPicture',array('session_id'=>session_id()));?>",
                "width"           : 120,
                'removeTimeout'	  : 1,
                'fileTypeExts'	  : '*.jpg; *.png; *.gif;',
                "onUploadSuccess" : uploadPicture<?php echo ($field["name"]); ?>,
            'onFallback' : function() {
                alert('未检测到兼容版本的Flash.');
            }
            });
            function uploadPicture<?php echo ($field["name"]); ?>(file, data){
                var data = $.parseJSON(data);
                var src = '';
                if(data.status){
                    $("#cover_id_<?php echo ($field["name"]); ?>").val(data.id);
                    src = data.url || '' + data.path
                    $("#cover_id_<?php echo ($field["name"]); ?>").parent().find('.upload-img-box').html(
                            '<div class="upload-pre-item"><img src="' + src + '"/></div>'
                    );
                } else {
                    updateAlert(data.info);
                    setTimeout(function(){
                        $('#top-alert').find('button').click();
                        $(that).removeClass('disabled').prop('disabled',false);
                    },1500);
                }
            }
        </script>




        <div class="form-item">
            <label class="item-label">房屋地址<span class="check-tips"></span></label>
            <div class="controls">
                <input type="text" class="text input-large" name="address" value="<?php echo ((isset($info["address"]) && ($info["address"] !== ""))?($info["address"]):''); ?>">
            </div>
        </div>
        <div class="form-item">
            <label class="item-label">面积<span class="check-tips"></span></label>
            <div class="controls">
                <input type="text" class="text input-large" name="size" value="<?php echo ((isset($info["size"]) && ($info["size"] !== ""))?($info["size"]):''); ?>">
            </div>
        </div>
        <div class="form-item">
            <label class="item-label">价格/月<span class="check-tips"></span></label>

            <div class="controls">
                <input type="text" class="text input-large" name="price" value="<?php echo ((isset($info["price"]) && ($info["price"] !== ""))?($info["price"]):''); ?>">
                <select name="company">
                    <option value="0" <?php if(($info["type"]) == "0"): ?>selected<?php endif; ?>>元</option>
                    <option value="1" <?php if(($info["type"]) == "1"): ?>selected<?php endif; ?>>万元</option>
                </select>
            </div>
        </div>
        <div class="form-item">
            <label class="item-label">电话<span class="check-tips"></span></label>
            <div class="controls">
                <input type="text" class="text input-large" name="tel" value="<?php echo ((isset($info["tel"]) && ($info["tel"] !== ""))?($info["tel"]):''); ?>">
            </div>
        </div>
        <div class="form-item">
            <label class="item-label">类型<span class="check-tips"></span></label>
            <div class="controls">
                <select name="type">
                    <option value="0" <?php if(($info["type"]) == "0"): ?>selected<?php endif; ?>>出租</option>
                    <option value="1" <?php if(($info["type"]) == "1"): ?>selected<?php endif; ?>>出售</option>
                </select>
            </div>
        </div>
        <div class="form-item">
            <label class="item-label">截止时间<span class="check-tips"></span></label>
            <div class="controls">
                <!--<input type="text" name="over_time" class="text date" value="<?php echo ((isset($info["over_time"]) && ($info["over_time"] !== ""))?($info["over_time"]):''); ?>" placeholder="请选择日期" />-->
                <input type="date" class="text input-large" name="over_time" value="<?php echo ((isset($info["over_time"]) && ($info["over_time"] !== ""))?($info["over_time"]):''); ?>" placeholder="请选择日期" />
            </div>
        </div>

        <div class="form-item">
            <input type="hidden" name="id" value="<?php echo ((isset($info["id"]) && ($info["id"] !== ""))?($info["id"]):''); ?>">
            <!--<input type="submit" value="提交"/>-->
            <button class="btn submit-btn ajax-post" id="submit" type="submit" target-form="form-horizontal">确 定</button>
            <button class="btn btn-return" onclick="javascript:history.back(-1);return false;">返 回</button>
        </div>
    </form>

        </div>
        <div class="cont-ft">
            <div class="copyright">
                <div class="fl">感谢使用<a href="http://www.onethink.cn" target="_blank">OneThink</a>管理平台</div>
                <div class="fr">V<?php echo (ONETHINK_VERSION); ?></div>
            </div>
        </div>
    </div>
    <!-- /内容区 -->
    <script type="text/javascript">
    (function(){
        var ThinkPHP = window.Think = {
            "ROOT"   : "", //当前网站地址
            "APP"    : "/admin.php?s=", //当前项目地址
            "PUBLIC" : "/Public", //项目公共目录地址
            "DEEP"   : "<?php echo C('URL_PATHINFO_DEPR');?>", //PATHINFO分割符
            "MODEL"  : ["<?php echo C('URL_MODEL');?>", "<?php echo C('URL_CASE_INSENSITIVE');?>", "<?php echo C('URL_HTML_SUFFIX');?>"],
            "VAR"    : ["<?php echo C('VAR_MODULE');?>", "<?php echo C('VAR_CONTROLLER');?>", "<?php echo C('VAR_ACTION');?>"]
        }
    })();
    </script>
    <script type="text/javascript" src="/Public/static/think.js"></script>
    <script type="text/javascript" src="/Public/Admin/js/common.js"></script>
    <script type="text/javascript">
        +function(){
            var $window = $(window), $subnav = $("#subnav"), url;
            $window.resize(function(){
                $("#main").css("min-height", $window.height() - 130);
            }).resize();

            /* 左边菜单高亮 */
            url = window.location.pathname + window.location.search;
            url = url.replace(/(\/(p)\/\d+)|(&p=\d+)|(\/(id)\/\d+)|(&id=\d+)|(\/(group)\/\d+)|(&group=\d+)/, "");
            $subnav.find("a[href='" + url + "']").parent().addClass("current");

            /* 左边菜单显示收起 */
            $("#subnav").on("click", "h3", function(){
                var $this = $(this);
                $this.find(".icon").toggleClass("icon-fold");
                $this.next().slideToggle("fast").siblings(".side-sub-menu:visible").
                      prev("h3").find("i").addClass("icon-fold").end().end().hide();
            });

            $("#subnav h3 a").click(function(e){e.stopPropagation()});

            /* 头部管理员菜单 */
            $(".user-bar").mouseenter(function(){
                var userMenu = $(this).children(".user-menu ");
                userMenu.removeClass("hidden");
                clearTimeout(userMenu.data("timeout"));
            }).mouseleave(function(){
                var userMenu = $(this).children(".user-menu");
                userMenu.data("timeout") && clearTimeout(userMenu.data("timeout"));
                userMenu.data("timeout", setTimeout(function(){userMenu.addClass("hidden")}, 100));
            });

	        /* 表单获取焦点变色 */
	        $("form").on("focus", "input", function(){
		        $(this).addClass('focus');
	        }).on("blur","input",function(){
				        $(this).removeClass('focus');
			        });
		    $("form").on("focus", "textarea", function(){
			    $(this).closest('label').addClass('focus');
		    }).on("blur","textarea",function(){
			    $(this).closest('label').removeClass('focus');
		    });

            // 导航栏超出窗口高度后的模拟滚动条
            var sHeight = $(".sidebar").height();
            var subHeight  = $(".subnav").height();
            var diff = subHeight - sHeight; //250
            var sub = $(".subnav");
            if(diff > 0){
                $(window).mousewheel(function(event, delta){
                    if(delta>0){
                        if(parseInt(sub.css('marginTop'))>-10){
                            sub.css('marginTop','0px');
                        }else{
                            sub.css('marginTop','+='+10);
                        }
                    }else{
                        if(parseInt(sub.css('marginTop'))<'-'+(diff-10)){
                            sub.css('marginTop','-'+(diff-10));
                        }else{
                            sub.css('marginTop','-='+10);
                        }
                    }
                });
            }
        }();
    </script>
    
    <script type="text/javascript" charset="utf-8">
        //导航高亮
        highlight_subnav('<?php echo U('index');?>');
    </script>

</body>
</html>