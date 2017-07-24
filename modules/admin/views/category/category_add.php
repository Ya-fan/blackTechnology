<?php 
use \app\common\services\UrlService;
?>

<!DOCTYPE HTML>
<html>
<head>
<base href="/shop_admin/">
<center>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<!--[if lt IE 9]>
<script type="text/javascript" src="lib/html5.js"></script>
<script type="text/javascript" src="lib/respond.min.js"></script>
<![endif]-->
<link href="static/h-ui/css/H-ui.min.css" rel="stylesheet" type="text/css" />
<link href="static/h-ui.admin/css/H-ui.admin.css" rel="stylesheet" type="text/css" />
<link href="lib/icheck/icheck.css" rel="stylesheet" type="text/css" />
<link href="lib/Hui-iconfont/1.0.8/iconfont.css" rel="stylesheet" type="text/css" />
<!--[if IE 6]>
<script type="text/javascript" src="http://lib.h-ui.net/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script><![endif]-->
<title>添加产品分类</title>
</head>
<body>
<div class="pd-20">
  <form action="<?= UrlService::buildAdminUrl('/category/addcate'); ?>" method="post" class="form form-horizontal" id="form-user-add">
    <div class="row cl">
      <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>所属分类：</label>
      <div class="formControls col-5">
        
        <select name="cateone" class="select">
          <option value="0">顶级分类</option>
          <?php 
            foreach ($cateData as $k => $v) {  ?>
            <option value="<?=$v['cate_id'] ?>"><?= $v['cate_name'] ?></option>
            <?php } ?>
        </select>
      </div>
      <div class="col-5"> </div>
    </div>
     <div class="row cl">
      <div class="formControls col-5">
        <select name="catetwo" style="display:none" class="select">
            <option value="0">请选择</option>
        </select>
      </div>
      <div class="col-5"> </div>
    </div>
    <div class="row cl">
      <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>分类名称：</label>
      <div class="formControls col-5">
        <input type="text" class="input-text" value=""  name="cate_name">
      </div>
      <div class="col-5"> </div>
    </div>
    <div class="row cl">
      <label class="form-label col-xs-4 col-sm-2">备注：</label>
      <div class="formControls col-5">
        <textarea name="cate_desc" cols="" rows="" class="textarea"  placeholder="说点什么...最少输入10个字符" datatype="*10-100" dragonfly="true" nullmsg="备注不能为空！" onKeyUp="textarealength(this,100)"></textarea>
        <p class="textarea-numberbar"><em class="textarea-length">0</em>/100</p>
      </div>
      <div class="col-5"> </div>
    </div>
     <div class="row cl">
      <label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>排序：</label>
      <div class="formControls col-5">
        <input type="text" class="input-text" value="" placeholder="" id="user-name" name="sort">
      </div>
      <div class="col-5"> </div>
    </div>
    <div class="row cl">
      <div class="col-9 col-offset-2">
        <input class="btn btn-primary radius" type="submit" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
      </div>
    </div>
  </form>
</div>
</center> 
<!--_footer 作为公共模版分离出去--> 
<script type="text/javascript" src="lib/jquery/1.9.1/jquery.min.js"></script> 
<script type="text/javascript" src="lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="static/h-ui/js/H-ui.js"></script> 
<script type="text/javascript" src="static/h-ui.admin/js/H-ui.admin.page.js"></script> 
<!--/_footer /作为公共模版分离出去--> 

<!--请在下方写此页面业务相关的脚本--> 
<script type="text/javascript" src="lib/jquery.validation/1.14.0/jquery.validate.js"></script> 
<script type="text/javascript" src="lib/jquery.validation/1.14.0/validate-methods.js"></script> 
<script type="text/javascript" src="lib/jquery.validation/1.14.0/messages_zh.js"></script> 
<script type="text/javascript">
$(function(){
	$('.skin-minimal input').iCheck({
		checkboxClass: 'icheckbox-blue',
		radioClass: 'iradio-blue',
		increaseArea: '20%'
	});	

  $(".pd-20").delegate('select[name=cateone]','change',function(){
     _this = $(this);
     cate_id = _this.val();
      if(cate_id!=0)
      {
        $.ajax
        ({
          type:'get',
          url:"<?= UrlService::buildAdminUrl('/category/addcate'); ?>",
          data:{cate_id:cate_id},
          success:function(res)
         {
            if(res.msg=='OK'){
              var catedata = res.data;
              var str = '';
              str += '<option value="0">请选择</option>';
              $.each(catedata,function(k,v){
               str+='<option value="'+v.cate_id+'">'+v.cate_name+'</option>';
              })
              $("select[name=catetwo]").html(str);
              $("select[name=catetwo]").show();
            }else{
             alert(res.data.msg);
            }     
          }
        })
      }else{
        $("select[name=catetwo]").hide();
      }
   })
});


</script>
</body>
</html>