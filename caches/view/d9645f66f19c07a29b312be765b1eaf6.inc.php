<?php if(!defined('IN_APP')) exit('Access Denied');?>
<?php
//生成lock文件
$is_success = file_put_contents(APP_ROOT.'caches/install.lock','hdshop:'.date('Y-m-d H:i:s').' by '.HD_VERSION);
if(!$is_success)
{
die('create install.lock file fail');
}
?>
<meta http-equiv="x-ua-compatible" content="text/html;" />
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>奕瑞(网店)系统-最灵活的企业级电子商务系统软件</title>
<meta name="Keywords" content="奕瑞,奕瑞,奕瑞系统,网店系统,商城系统,电子商务软件" />
<meta name="Description" content="奕瑞网店系统，国内专业电子商务系统方案解决服务商，最灵活的企业级网店系统，为中小企业级站长提供电商一站式解决方案。" />
<link rel="shortcut icon"  href="<?php echo MODULE_PATH?>images/favicon.ico"/>
<link rel="stylesheet" type="text/css" href="<?php echo MODULE_PATH?>css/install_style.css"/>
</head>
<body>
<div class="content">
<div class="con-head">
<span class="update fr"><?php echo HD_VERSION?></span>
</div>
<div class="con-body">
<!--成功安装信息-->
<div class="State">
<h2>安装成功，欢迎您使用奕瑞（网店）系统</h2>
<h4>请牢记您的管理员账号和密码用于网站后台登陆</h4>
<li>管理员账号：<span class="name"><?php echo $_GET['admin_user']?></span></li>
</div>
<div class="btn mt85">
<a class="agree-btn m195 fl" href="../index.php">进入商城前台</a>
<a class="agree-btn3 fl" href="<?php echo url('admin/public/login')?>">进入商城后台</a>
</div>
<a class="state-bg bg-img fr"></a>
</div>
</div>
<p align="center">©2013-2015 yaozihao.cn (奕瑞科技旗下品牌)</p>
</body>
</html>
