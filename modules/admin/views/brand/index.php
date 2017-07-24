<?php
use \app\common\services\UrlService;
use \app\common\services\StaticService;
use yii\widgets\LinkPager;

StaticService::includeAppJsStatic('/shop_admin/js/admin/user/list.js', app\assets\AdminAsset::className());

?>
<link rel="stylesheet" type="text/css" href="<?= UrlService::buildWwwUrl('/shop_admin/static/h-ui/css/H-ui.min.css')?>" />
<link rel="stylesheet" type="text/css" href="<?= UrlService::buildWwwUrl('/shop_admin/static/h-ui.admin/css/H-ui.admin.css')?>" />
<link rel="stylesheet" type="text/css" href="<?= UrlService::buildWwwUrl('/shop_admin/lib/Hui-iconfont/1.0.8/iconfont.css')?>" />
<link rel="stylesheet" href="<?= UrlService::buildWwwUrl('/assets/25719680/css/bootstrap.css')?>"> 
<link rel="stylesheet" type="text/css" href="<?= UrlService::buildWwwUrl('/shop_admin/static/h-ui.admin/skin/default/skin.css')?>" id="skin" />
<link rel="stylesheet" type="text/css" href="<?= UrlService::buildWwwUrl('/shop_admin/static/h-ui.admin/css/style.css')?>" 
 
<div class="dislpayArrow hidden-xs"><a class="pngfix" href="javascript:void(0);" onClick="displaynavbar(this)"></a></div>
<!--/_menu 作为公共模版分离出去-->

<section class="Hui-article-box">
    <nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 产品管理 <span class="c-gray en">&gt;</span> 品牌管理 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>

    <div class="Hui-article">
        <article class="cl pd-20">
            <div class="text-c">
                <form class="Huiform" method="post" action="" target="_self" id="form" enctype="multipart/form-data">
                    <input type="text" placeholder="图片名称" value="" class="input-text" style="width:120px" name="logo_name">
					<span class="btn-upload form-group">
					<input class="input-text upload-url" type="text" name="uploadfile-2" id="uploadfile-2" readonly  datatype="*" nullmsg="请添加附件！" style="width:200px">
					<a href="javascript:void();" class="btn btn-primary upload-btn"><i class="Hui-iconfont">&#xe642;</i> 浏览文件</a>
					<input type="file" multiple name="brand_logo" class="input-file">
					</span>
                    <span class="select-box" style="width:150px">
					<select class="select" size="1" id="select" name="brand_id">
                        <?php foreach($total as $key=>$val){?>
                        <option value="<?= $val['brand_id']?>" selected><?= $val['brand_name']?></option>
                        <?php }?>
                    </select>
					</span>
                    <button type="button" class="btn btn-success" id="" name="" onClick="picture_colume_add(this);"><i class="Hui-iconfont">&#xe600;</i> 添加</button>
                </form>
            </div>
            <div class="cl pd-5 bg-1 bk-gray mt-20"> <span class="l"><a href="javascript:;" onclick="datadel()" class="btn btn-danger radius"><i class="Hui-iconfont">&#xe6e2;</i> 批量删除</a><a class="btn btn-primary radius" onclick="brand_add('添加品牌','<?= UrlService::buildWwwUrl('brand/add')?>')" href="javascript:;"><i class="Hui-iconfont">&#xe600;</i> 添加品牌</a></span> <span class="r">共有数据：<strong><?= $count?></strong> 条</span> </div>
            <div class="mt-10">
                <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">
                  
                <div id="DataTables_Table_0_filter" class="dataTables_filter">
                    <label>
                    从当前数据中检索:
                    <input class="input-text " aria-controls="DataTables_Table_0" type="search" name='search'>
                    </label>
                </div>
                  
                <table class="table table-border table-bordered table-bg table-sort">
                    <thead>
                    <tr class="text-c">
                        <th width="25"><input type="checkbox" name="" value=""></th>
                        <th width="70">ID</th>
                        <th width="70">是否显示</th>
                        <th width="80">排序</th>
                        <th width="200">LOGO</th>
                        <th width="120">品牌名称</th>
                        <th>具体描述</th>
                        <th width="100">操作</th>
                    </tr>
                    </thead>
                    <tbody id='box'>
                    <?php foreach($data as $key=>$val){?>
                    <tr class="text-c">
                        <td><input name="ids" type="checkbox" value="<?= $val['brand_id']?>"></td>
                        <td><?= $val['brand_id']?></td>
                        <td><button type="button" class="btn btn-success" id="show" name="<?= $val['is_show']?>"><?= $val['is_show'] == 1 ? "显示" : "不显示"; ?></button></td>
                        <td><span id="quick"><?= $val['sort']?></span><input type="text" id='hidden' class="input-text text-c" value="<?= $val['sort']?>" style="display:none"></td>
                        <td><img src="<?= UrlService::buildWwwUrl('/shop_admin/images/brand').'/'.$val['brand_logo']?>" id='logo' width="150"></td>
                        <td class="text-l"><?= $val['brand_name']?></td>
                        <td class="text-l"><?= $val['brand_desc']?></td>
                        <td class="f-14 product-brand-manage"><a style="text-decoration:none" href="<?= UrlService::buildWwwUrl('/admin/brand/update?id=').$val['brand_id']?>" title="编辑" id='edit'><i class="Hui-iconfont">&#xe6df;</i></a> <a style="text-decoration:none" class="ml-5" onClick="active_del(this,'<?= $val['brand_id']?>')" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a></td>
                    </tr>
                    <?php }?>
                    </tbody>
                </table>
                <!--分页  -->
                        <?= LinkPager::widget([
                            'pagination' => $page,
                            'hideOnSinglePage' => false,
                            'nextPageLabel' => '下一页',
                            'prevPageLabel' => '上一页', 
                            ]); ?>
                <!--分页结束  -->
                </div>
            </div>
        </article>
    </div>
</section>


<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="<?= UrlService::buildWwwUrl('/shop_admin/lib/jquery/1.9.1/jquery.min.js')?>"></script>
<script type="text/javascript" src="<?= UrlService::buildWwwUrl('/shop_admin/lib/My97DatePicker/4.8/WdatePicker.js')?>"></script>
<script type="text/javascript" src="<?= UrlService::buildWwwUrl('/shop_admin/lib/datatables/1.10.0/jquery.dataTables.min.js')?>"></script>
<script type="text/javascript" src="<?= UrlService::buildWwwUrl('/shop_admin/lib/laypage/1.2/laypage.js')?>"></script>
<script type="text/javascript">
    
    $(function(){

        //即点即改
        $(document).on('click','#quick',function(){
            $(this).hide();
            $(this).next().show();
        })
        $(document).on('blur','#hidden',function(){
            var sort = $(this).val();
            var id = $(this).parent().prev().html();
            var obj = $(this);

            $.ajax({
                type:"post",
                url:"<?= UrlService::buildWwwUrl('/admin/brand/quick')?>",
                data:{"sort":sort,"brand_id":id},
                dataType:"json",
                success:function(data){
                    if(data.code == 1){
                        obj.hide();
                        obj.prev().show().html(obj.val());
                    }else{
                        obj.hide();
                        obj.prev().show();
                    }
                }
            })
        })

        //是否显示
            $(document).on('click','#show',function(){
                var is_show = $(this).attr('name');
                var brand_id = $(this).parent().prev().html();
                
                $.ajax({
                    type:"post",
                    url:"<?= UrlService::buildWwwUrl('/admin/brand/status')?>",
                    data:{"is_show":is_show,"brand_id":brand_id},
                    success:function(data){
                        if( data == 1 ){
                            window.location.href = "<?= UrlService::buildWwwUrl('/admin/brand/index')?>";
                        }else{
                            alert('操作有误');
                        }
                    }
                })
            })

        //搜索
        $("input[name='search']").blur(function(){
            var keyword = $(this).val();
            $.ajax({
                type:"get",
                url:"<?= UrlService::buildWwwUrl('/admin/brand/search')?>",
                data:{"keyword":keyword},
                dataType:'json',
                success:function(data){
                    if(data.code == 200){
                        var str = '';
                        $.each(data.content, function(k, v){
                            str+='<tr class="text-c">';
                                str+='<td><input name="ids" type="checkbox" value="'+v.brand_id+'"></td>';
                                str+='<td>'+v.brand_id+'</td>';
                                str+='<td><span id="quick">'+v.sort+'</span><input type="text" id="hidden" class="input-text text-c" value="'+v.sort+'" style="display:none"></td>';
                                str+='<td><img src="http://www.black.com/shop_admin/images/brand/'+v.brand_logo+'" width="150"></td>';
                                str+='<td class="text-l">'+v.brand_name+'</td>';
                                str+='<td class="text-l">'+v.brand_desc+'</td>';
                                str+='<td class="f-14 product-brand-manage"><a style="text-decoration:none" onClick="product_brand_edit("品牌编辑","http://www.black.com/admin/brand/index","'+v.brand_id+'")" href="javascript:;" title="编辑"><i class="Hui-iconfont">&#xe6df;</i></a> <a style="text-decoration:none" class="ml-5" onClick="active_del(this,"'+v.brand_id+'")" href="javascript:;" title="删除"><i class="Hui-iconfont">&#xe6e2;</i></a></td>';
                            str+='</tr>';
                        })
                        $("#box").html(str);
                    }else{
                        alert(data.msg)
                    }
                }
            })
        })

    })

    //图片上传
    function picture_colume_add(obj){
        var form = new FormData(document.getElementById('form'));
        var id = $("#select").val();
        
        $.ajax({
                type:"post",
                url:"<?= UrlService::buildWwwUrl('/admin/brand/upload')?>",
                processData:false,
                contentType:false,
                data:form,
                dataType:"json",
                success:function(data){
                    if(data.code == 200){
                        window.location.href = "<?= UrlService::buildWwwUrl('/admin/brand/index')?>";
                        //document.getElementById("logo").setAttribute("src", data.content);
                    }else{
                        alert(data.msg)
                    }
                }
            })
    }

    //js删除
    function active_del(obj,brand_id){
        if( window.confirm( "您确定要删除吗?" ) ) {
            $.ajax({
                type: "get",
                url: "<?= UrlService::buildWwwUrl('/admin/brand/del')?>",
                data: {"brand_id": brand_id},
                success: function (data) {
                    if (data == 1) {
                        obj.parentNode.parentNode.remove();
                    } else {
                        alert( "删除失败" );
                    }
                }
            })
        }
    }
    //批量删除
    function datadel(){
        var ids = document.getElementsByName("ids");
        var num = ids.length;
        var str = '';
        
        for(var i = 0; i < num; i++){
            if(ids[i].checked){
                str += ','+ids[i].value;
            }
        }
        str = str.substr(1);
        
        if(str != ''){
            if( window.confirm( "数据删除将不可恢复，请谨慎操作！" ) ){
                $.ajax({
                    type:"get",
                    url:"<?= UrlService::buildWwwUrl('/admin/brand/delall')?>",
                    data:{'brand_id':str},
                    success:function(data){
                        if(data == 1){
                            $("input:checkbox[name='ids']:checked").each(function() {
                                n = $("input:checkbox[name='ids']:checked").parents('tr').index();
                                $('#box').find('tr:eq('+n+')').remove();
                            });
                        }else{
                            alert("删除失败")
                        }
                    }
                })
            }
        }else{
            alert("请选择要删除的选项！")
        }  
    }

    /*品牌-编辑*/
    function product_brand_edit(title,url,id){
        var index = layer.open({
            type: 2,
            title: title,
            content: url
        });
        layer.full(index);
        $.ajax({
            type:'get',
            url:"<?= UrlService::buildWwwUrl('/admin/brand/update')?>",
            data:{"brand_id":id},
            success:function(data){
                alert(12)
        }
        })
    }
    // $('.table-sort').dataTable({
    //     "aaSorting": [[ 1, "desc" ]],//默认第几个排序
    //     "bStateSave": true,//状态保存
    //     "aoColumnDefs": [
    //         //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
    //         {"orderable":false,"aTargets":[0,6]}// 制定列不参与排序
    //     ]
    // });

    /*添加品牌*/
    function brand_add(title,url){
        var index = layer.open({
            type: 2,
            title: title,
            content: url
        });
        layer.full(index);
    }
</script>

