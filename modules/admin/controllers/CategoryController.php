<?php 
namespace app\modules\admin\controllers;

use yii\web\Controller;

use  app\modules\admin\controllers\common\BaseAdminController;
use app\models\Category;
use \app\common\services\UrlService;

/**
 * Auth： 胡
 * 分类管理
 * time : 2017-7-19
 */
class CategoryController extends BaseAdminController{

    public $returnData = [
        'msg' => "已经是最底级分类了",
    ];
    //分类的展示
    public function actionList()
    {
        $map = 0;
        if($this->isRequestMethod('ajax'))
        {          
           $map = $this->get('cate_id');
           $cateData = $this->actionGatcate($map);
           if(!$cateData)
           {
             echo $this->renderJson($this->returnData,'error',404);die;
           }else{
             echo $this->renderJson($cateData);die;
           }
        }else{
           $cateData = $this->actionGatcate($map);
        }  
        return $this->render('list',['cateData'=>$cateData]);
    }

     //分类的添加以及添加时的查询二级分类
     public function actionAddcate()
     {          
        if($this->isRequestMethod('post'))
        {
         $cate_name = trim($this->post('cate_name'));
         $cateone = trim($this->post('cateone'));
         $catetwo = trim($this->post('catetwo'));
         $sort = trim($this->post('sort'));
         $cate_desc =  trim($this->post('cate_desc'));
            if($cateone==0){
             $p_id = 0;
            }elseif($cateone!=0 && $catetwo==0){
             $p_id = $cateone;
            }else{
             $p_id = $catetwo;
            }
          //执行添加
          $category = new Category();
          $category->cate_name = $cate_name;
          $category->cate_desc = $cate_desc;
          $category->p_id = $p_id;
          $category->sort = $sort;
          $category->save( 0 );
          //跳转控制器方法
          $this->redirect(array('category/list')); 
        }     
        elseif($this->isRequestMethod('ajax')){
          $map = $this->get('cate_id');
          $cateData = $this->actionGatcate($map);
            if(!$cateData)
            {
                $this->returnData['msg'] = "您选择的分类下还没有二级分类";
                echo $this->renderJson($this->returnData,'error',404);die;
            }else{
                echo $this->renderJson($cateData);die;
            }
        }else{
           $cateData = $this->actionGatcate();
          // print_r($cateData);die;
          return $this->renderPartial('category_add',['cateData'=>$cateData]);
        }
    
     }

     public function actionDel()
     {
        
         $id = $this->get('cate_id');
         $data = $this->actionGatcate($id);
         if(!$data)
         {
           $res = Category::deleteAll( ['cate_id'=>$id] );
             if($res)
             {
             $this->returnData['msg'] = "删除成功!";
              echo $this->renderJson($this->returnData);die; 
             }
             else
             {
              $this->returnData['msg'] = "删除失败，未知错误";
              echo $this->renderJson($this->returnData,'errorme',401);die; 
             }
         }
         else
         {
            $this->returnData['msg'] = "该分类下还有分类无法删除";
            echo $this->renderJson($this->returnData,'erroryou',403);die;
         }     
     }

     //获取分类
     public function actionGatcate($pid=0)
     {
        $cateData = Category::find()->where( ['p_id'=>$pid] )->asArray()->all();
        return $cateData;
     }

}

?>
