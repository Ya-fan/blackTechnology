<?php 
use \app\common\services\UrlService;

 ?>
 <?php $this->beginPage(); ?>
<!--_meta 作为公共模版分离出去-->
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<link rel="Bookmark" href="<?= UrlService::buildWwwUrl('/favicon.ico') ?>" >
<link rel="Shortcut Icon" href="<?= UrlService::buildWwwUrl('favicon.ico') ?>" />
<!--[if lt IE 9]>
<script type="text/javascript" src="lib/html5.js"></script>
<script type="text/javascript" src="lib/respond.min.js"></script>
<![endif]-->

<link rel="stylesheet" type="text/css" href="<?= UrlService::buildWwwUrl('/shop_admin/static/h-ui/css/H-ui.min.css') ?>" />
<link rel="stylesheet" type="text/css" href="<?= UrlService::buildWwwUrl('/shop_admin/static/h-ui.admin/css/H-ui.admin.css ') ?> " />
<link rel="stylesheet" type="text/css" href="<?= UrlService::buildWwwUrl('/shop_admin/lib/Hui-iconfont/1.0.8/iconfont.css ') ?> " />
<link rel="stylesheet" type="text/css" href="<?= UrlService::buildWwwUrl('/shop_admin/static/h-ui.admin/skin/default/skin.css ') ?> " id="skin" />
<link rel="stylesheet" type="text/css" href="<?= UrlService::buildWwwUrl('/shop_admin/static/h-ui.admin/css/style.css ') ?> " />

<!--[if IE 6]>
<script type="text/javascript" src="http://lib.h-ui.net/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script><![endif]-->
<!--/meta 作为公共模版分离出去-->

<title><?=  \Yii::$app->params['seller']['name']; ?></title>

<!-- <meta name="keywords" content="H-ui.admin v3.0,H-ui网站后台模版,后台模版下载,后台管理系统模版,HTML后台模版下载"> -->
<!-- <meta name="description" content="H-ui.admin v3.0，是一款由国人开发的轻量级扁平化网站后台模板，完全免费开源的网站后台管理系统模版，适合中小型CMS后台系统。"> -->
</head>
<body>
<?php $this->beginBody(); ?>
<!--_header 作为公共模版分离出去-->
<header class="navbar-wrapper">
	<div class="navbar navbar-fixed-top">
		<div class="container-fluid cl"> <a class="logo navbar-logo f-l mr-10 hidden-xs" href="javascript:void(0)"><?= \Yii::$app->params['seller']['name']; ?></a> <a class="logo navbar-logo-m f-l mr-10 visible-xs" href="javascript:void(0)"></a> <span class="logo navbar-slogan f-l mr-10 hidden-xs">Nothing is possible... </span> <a aria-hidden="false" class="nav-toggle Hui-iconfont visible-xs" href="javascript:;">&#xe667;</a>
			<nav class="nav navbar-nav">
				<ul class="cl">
					<li class="dropDown dropDown_hover"><a href="javascript:;" class="dropDown_A"><i class="Hui-iconfont">&#xe600;</i> 新增 <i class="Hui-iconfont">&#xe6d5;</i></a>
						<ul class="dropDown-menu menu radius box-shadow">
							<li><a href="javascript:;" onclick="article_add('添加资讯','article-add.html')"><i class="Hui-iconfont">&#xe616;</i> 商品</a></li>
							<li><a href="javascript:;" onclick="picture_add('添加资讯','picture-add.html')"><i class="Hui-iconfont">&#xe613;</i> 手机号</a></li>
						</ul>
					</li>
				</ul>
			</nav>
			<nav id="Hui-userbar" class="nav navbar-nav navbar-userbar hidden-xs">
				<ul class="cl">
					<!-- <li>超级管理员</li> -->
					<li class="dropDown dropDown_hover"> <a href="#" class="dropDown_A"><?//= //$this->params['current_user']['nickname'] ?> <i class="Hui-iconfont">&#xe6d5;</i></a>
						<ul class="dropDown-menu menu radius box-shadow">
							<li><a href="javascript:;" onclick="myselfinfo()">个人信息</a></li>
							<!-- <li><a href="#">切换账户</a></li> -->
							<li><a href="<?= UrlService::buildAdminUrl('/user/out') ?>">退出</a></li>
						</ul>
					</li>
					<!-- <li id="Hui-msg"> <a href="#" title="消息"><span class="badge badge-danger">1</span><i class="Hui-iconfont" style="font-size:18px">&#xe68a;</i></a> </li> -->
					<li id="Hui-skin" class="dropDown right dropDown_hover"> <a href="javascript:;" class="dropDown_A" title="换肤"><i class="Hui-iconfont" style="font-size:18px">&#xe62a;</i></a>
						<ul class="dropDown-menu menu radius box-shadow">
							<li><a href="javascript:;" data-val="default" title="默认（黑色）">默认（黑色）</a></li>
							<li><a href="javascript:;" data-val="blue" title="蓝色">蓝色</a></li>
							<li><a href="javascript:;" data-val="green" title="绿色">绿色</a></li>
							<li><a href="javascript:;" data-val="red" title="红色">红色</a></li>
							<li><a href="javascript:;" data-val="yellow" title="黄色">黄色</a></li>
							<li><a href="javascript:;" data-val="orange" title="橙色">橙色</a></li>
						</ul>
					</li>
				</ul>
			</nav>
		</div>
	</div>
</header>
<!--/_header 作为公共模版分离出去-->

<!--_menu 作为公共模版分离出去-->
<aside class="Hui-aside">
	
	<div class="menu_dropdown bk_2">
		<dl id="menu-article">
			<dt><i class="Hui-iconfont">&#xe616;</i> 统计结算模块 <i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a href="article-list.html" title="管理首页">管理首页</a></li>
					<li><a href="article-list.html" title="销售额统计">销售额统计</a></li>
				</ul>
			</dd>
		</dl>
		<dl id="menu-picture">
			<dt><i class="Hui-iconfont">&#xe613;</i> 商品模块<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a href="picture-list.html" title="商品列表">商品列表</a></li>
					<li><a href="picture-list.html" title="添加商品">添加商品</a></li>
					<li><a href="picture-list.html" title="手机号列表">手机号列表</a></li>
					<li><a href="picture-list.html" title="添加手机号">添加手机号</a></li>
				</ul>
			</dd>
		</dl>
		<dl id="menu-product">
			<dt><i class="Hui-iconfont">&#xe620;</i> 订单模块<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a href="product-brand.html" title="订单列表">订单列表</a></li>
					<li><a href="product-category.html" title="手机号订单">手机号订单</a></li>
				</ul>
			</dd>
		</dl>
		<dl id="menu-comments">
			<dt><i class="Hui-iconfont">&#xe622;</i> 配置模块<i class="Hui-iconfont menu_dropdown-arrow">&#xe6d5;</i></dt>
			<dd>
				<ul>
					<li><a href="http://h-ui.duoshuo.com/admin/" title="物流模块">物流模块</a></li>
					<li><a href="feedback-list.html" title="发货地址">发货地址</a></li>
					<li><a href="feedback-list.html" title="资料修改">资料修改</a></li>
					<li><a href="feedback-list.html" title="LOGO修改">LOGO修改</a></li>
					<li><a href="feedback-list.html" title="收款信息">收款信息</a></li>
					<li><a href="feedback-list.html" title="主页信息">主页信息</a></li>
				</ul>
			</dd>
		</dl>
	</div>
</aside>
<div class="dislpayArrow hidden-xs"><a class="pngfix" href="javascript:void(0);" onClick="displaynavbar(this)"></a></div>
<!--/_menu 作为公共模版分离出去-->

<?= $content ;?>
<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="<?= UrlService::buildWwwUrl('/shop_admin/lib/jquery/1.9.1/jquery.min.js') ?>"></script> 
<script type="text/javascript" src="<?= UrlService::buildWwwUrl('/shop_admin/lib/layer/2.4/layer.js') ?>"></script> 
 
<script type="text/javascript" src="<?= UrlService::buildWwwUrl('/shop_admin/lib/jquery.validation/1.14.0/jquery.validate.js') ?>"></script> 
<script type="text/javascript" src="<?= UrlService::buildWwwUrl('/shop_admin/lib/jquery.validation/1.14.0/validate-methods.js') ?>"></script> 
<script type="text/javascript" src="<?= UrlService::buildWwwUrl('/shop_admin/lib/jquery.validation/1.14.0/messages_zh.js') ?>"></script> 
<script type="text/javascript" src="<?= UrlService::buildWwwUrl('/shop_admin/static/h-ui/js/H-ui.js') ?>"></script> 
<script type="text/javascript" src="<?= UrlService::buildWwwUrl('/shop_admin/static/h-ui.admin/js/H-ui.admin.page.js') ?>"></script> 

<!--/_footer /作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript">
	/*个人信息*/
function myselfinfo(){

	layer.open({
		type: 1,
		area: ['300px','200px'],
		fix: false, //不固定
		maxmin: true,
		shade:0.4,
		title: '商户信息',
		content:"商户信息"
		//content: "<table><tr><td>用户名</td><td>"+ <?//= $this->params['current_user']['nickname'];  ?>+"</td></tr><tr><td>手机号</td><td>"+ <?//= $this->params['current_user']['mobile'] ?>+"</td></tr><tr><td>邮  箱</td><td> "+<?//= $this->params['current_user']['email'] ?>+"</td></tr><tr><td>性  别</td><td>"+ <?php //if( $this->params['current_user']['sex'] == 0  ){echo '未填写' ;}else if( $this->params['current_user']['sex'] == 1 ){echo '男';}else{ echo '女';}?>+"</td></tr></table>"
	});
}
</script>
<!--/请在上方写此页面业务相关的脚本-->
<?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage(); ?>