<?php 
use \app\common\services\UrlService;
?>
<!--_meta 作为公共模版分离出去-->
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<base href="/shop_admin/">
<link rel="Bookmark" href="favicon.ico" >
<link rel="Shortcut Icon" href="favicon.ico" />
<!--[if lt IE 9]>
<script type="text/javascript" src="lib/html5.js"></script>
<script type="text/javascript" src="lib/respond.min.js"></script>
<![endif]-->

<!--[if IE 6]>
<script type="text/javascript" src="http://lib.h-ui.net/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script><![endif]-->
<!--/meta 作为公共模版分离出去-->
<div class="dislpayArrow hidden-xs"><a class="pngfix" href="javascript:void(0);" onClick="displaynavbar(this)"></a></div>
<!--/_menu 作为公共模版分离出去-->
<section class="Hui-article-box">
	<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span>系统管理 <span class="c-gray en">&gt;</span> 栏目管理 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
		<div class="pd-20 text-c">
			
			<div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a class="btn btn-primary radius" onclick="system_category_add('添加分类','<?= UrlService::buildAdminUrl('/category/addcate') ?>')" href="javascript:;"><i class="Hui-iconfont">&#xe600;</i> 添加分类</a></div>
			<div class="mt-20">
				<table class="table table-border table-bordered table-hover table-bg table-sort">
					<thead>
						<tr class="text-c">
							<th width="80">ID</th>
							<th width="80">分类名称</th>
							<th width="80">排序</th>
							<th width="200">分类介绍</th>
							<th width="100">操作</th>
						</tr>
					</thead>
					<tbody>
					<?php foreach ($cateData as $k => $val) { ?>
						<tr class="text-c" pids="<?=$val['p_id'] ?>">
							<td><?= $val['cate_id'] ?></td>
							<td><a href="javascript:void(0)"><span class="is_show" cateid="<?= $val['cate_id'] ?>" pid ="<?= $val['p_id'] ?>">[+]</span></a><?= $val['cate_name'] ?></td>
							<td><?= $val['sort'] ?></td>
							<td><?= $val['cate_desc']  ?></td>							
							<td class="f-14"> <a title="删除" href="javascript:;" onclick="system_category_del(this,<?=$val['cate_id'] ?>)" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
						</tr>						
						<?php }  ?>
					</tbody>
				</table>
			</div>
		</div>

</section>

<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="static/h-ui/js/H-ui.js"></script>
<script type="text/javascript" src="static/h-ui.admin/js/H-ui.admin.page.js"></script>
<!--/_footer /作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="lib/My97DatePicker/4.8/WdatePicker.js"></script>
<script type="text/javascript" src="lib/datatables/1.10.0/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="lib/laypage/1.2/laypage.js"></script>
<script type="text/javascript">

/*$('.table-sort').dataTable({
	"aaSorting": [[ 1, "desc" ]],//默认第几个排序
	"bStateSave": true,//状态保存
	"aoColumnDefs": [
	  //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
	  {"orderable":false,"aTargets":[0,4]}// 制定列不参与排序
	]
});*/
$(".table-border").delegate('.is_show','click',function(){
	  var _this = $(this);
	  _this.html("[-]");
	  _this.addClass("is_remove").removeClass("is_show");
	  var cate_id = _this.attr('cateid');
	  $.ajax({
	  	 type:'get',
         url:"<?= UrlService::buildAdminUrl('/category/list'); ?>",
         data:{cate_id:cate_id},
         success:function(res){
          if(res.msg=="OK"){
             var data = res.data;
             var str = '';
             var nbsp = "";
             $.each(data,function(k,v){
             str+='<tr class="text-c" pids ="'+v.p_id+'">';
		     str+='<td>'+v.cate_id+'</td>';
		     str+='<td><a href="javascript:void(0)"><span class="is_show" cateid="'+v.cate_id+'" pid ="'+v.p_id+'">[+]</span></a>'+nbsp+v.cate_name+'</td>';
		     str+='<td>'+v.sort+'</td>';
		     str+='<td>'+v.cate_desc+'</td>';							
			 str+='<td class="f-14"><a title="删除" href="javascript:;" onclick="system_category_del(this,'+v.cate_id+')" class="ml-5" style="text-decoration:none"><i class="Hui-iconfont">&#xe6e2;</i></a></td>';
			 str+='</tr>';	
             })
             _this.parents("tr").after(str);
          }else{
            _this.html("[+]");
            _this.addClass("is_show").removeClass("is_remove");
          	alert(res.data.msg);         
          }
       }
   })
})

$(".table-border").delegate('.is_remove','click',function(){
	var all = {}
      var  __this = $(this);
      var cate_id = __this.attr('cateid');
      all = __this.parents("tr").nextAll("tr");
       $.each(all,function(){ 
       if($(this).attr('pids')!=cate_id){
       	   return true;
       	 } 
       else{      	 
         var id = $(this).find(".is_remove").attr('cateid')?$(this).find(".is_remove").attr('cateid'):-1;
       	 $.each(all,function(){    
       	   if($(this).attr('pids')==id){
       	   	  $(this).remove();
       	   } 	   
         }) 
         if($(this).attr('pids')==cate_id){
       	   $(this).remove();
       	   } 
       	  }
       })
       __this.html("[+]");
       __this.addClass("is_show").removeClass("is_remove");
      
})
/*系统-栏目-添加*/
function system_category_add(title,url,w,h){
	layer_show(title,url,w,h);
}
/*系统-栏目-编辑*/
function system_category_edit(title,url,id,w,h){
	layer_show(title,url,w,h);
}
/*系统-栏目-删除*/
function system_category_del(obj,id){
	layer.confirm('确认要删除吗？',function(){
	 $.ajax({
	  	    type:'get',
            url:"<?= UrlService::buildAdminUrl('/category/del'); ?>",
            data:{cate_id:id},
            success:function(res)
            {
                if(res.msg=='OK')
                {
                  $(obj).parents("tr").remove();
		          layer.msg(res.data.msg,{icon:1,time:1000});
                }if(res.msg=='errorme'){
                  layer.msg(res.data.msg,{icon:1,time:1000});
                }else{
                  layer.msg(res.data.msg,{icon:1,time:1000});
                }
            }
         })
		
	});
}
</script>
<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>