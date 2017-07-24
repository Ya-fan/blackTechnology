<?php
/**
 *商品品牌管理
 */
namespace app\modules\admin\controllers;

 use Yii;
 use yii\filters\AccessControl;
 use yii\web\Controller;
 use app\modules\admin\controllers\common\BaseAdminController;
 use app\models\Brand;
 use \app\common\services\UrlService;
 use yii\data\Pagination;

class BrandController extends BaseAdminController
{
    public $layout = "admin";
    public function actionIndex()
    {

        $page = new Pagination(['totalCount' =>Brand::find()->count(),'pageSize' => '5']);
        $data = Brand::find()->orderBy("sort ASC")->offset($page->offset)->limit($page->limit)->asarray()->all();
        $total = Brand::find()->orderBy("sort ASC")->asArray()->all();
        $count = count( $total );

        return $this->render( 'index',['data'=>$data,'count'=>$count, 'page'=>$page, 'total'=>$total] );
    }

    //添加页面上传
    public function actionFile()
    {
        if( $this->isRequestMethod('post') )
        {

            if(isset($_FILES['brand_logo']) && $_FILES['brand_logo']['error'] == 0){
                
                $file = $_FILES['brand_logo'];

                if( move_uploaded_file( $file['tmp_name'], "shop_admin/images/brand/".$file['name'] ) ){
                    $brand_logo = UrlService::buildWwwUrl('/shop_admin/images/brand').'/'.$file['name'];
                }else{
                    $brand_logo = '';
                }

               return json_encode( $brand_logo );
            }
        }
    }

    public function actionAdd()
    {
        if( $this->isRequestMethod('post') )
        {

            $is_show = $this->post('is_show');
            $is_show = empty($is_show) ? 0 : $is_show;
            $brand_logo = $this->post('brand_logo');
            $brand_logo = substr($brand_logo,45);

            $arr = array(
                'brand_name' => $this->post('brand_name'),
                'brand_desc' => $this->post('brand_desc'),
                'brand_logo' => $brand_logo,
                'sort' => $this->post('sort'),
                'is_show' => $is_show,
                'site_url' => $this->post('site_url'),
            );

            $model = new Brand();
            if( $model->load( $arr, '' ) && $model->save( false ) )
            {
                $data['code'] = 200;
                $data['content'] = $arr;
                $data['msg'] = 'ok';
            }else{
                $data['code'] = 404;
                $data['content'] = "";
                $data['msg'] = 'error';
            }
                return json_encode($data);
        }else{
            return $this->renderPartial( 'add' );
        }
    }
    //单删
    public function actionDel()
    {
        if( $this->isRequestMethod('get') ){

            $brand_id = $this->get('brand_id');
            $model = Brand::find()->where(['brand_id'=>$brand_id])->one();
            $res = $model -> delete();

            if($res){
                echo 1;
            }else{
                echo 0;
            }
        }
    }

    //是否显示
    public function actionStatus()
    {
        if( $this->isRequestMethod('post') ){

            $brand_id = $this->post('brand_id');
            $is_show = $this->post('is_show');
            if( $is_show == 1 ){
                $new = 0;
            }else{
                $new = 1;
            }
            $model = Brand::find()->where(['brand_id'=>$brand_id])->one();
            $model->is_show = $new;
            $res = $model->save(false);

            if($res){
                echo 1;
            }else{
                echo 0;
            }
        }
    }

    //批量删除
    public function actionDelall()
    {
        if( $this->isRequestMethod('get') ){
            $brand_id = $this->get('brand_id');
            $brand_id = explode( ',', $brand_id );

            $res = Brand::deleteAll( ['in', 'brand_id', $brand_id] );

            if($res){
                echo 1;
            }else{
                echo 0;
            }
        }
    }
    //修改
    public function actionUpdate()
    {     
           if( $this->isRequestMethod('get') )
        {
            $brand_id = $this->get('id');
            $arr = Brand::find()->where(['brand_id'=>$brand_id])->asarray()->one();
             return $this->renderPartial( 'update', ['arr'=>$arr] );
        }
           else if( $this->isRequestMethod('post') )
        {
            $brand_id = $this->post('brand_id');         
            $is_show = $this->post('is_show');
            $is_show = empty($is_show) ? 0 : $is_show;
            $brand_logo = $this->post('brand_logo');
            $brand_logo = substr($brand_logo,45);

            $arr = array(
                'brand_name' => $this->post('brand_name'),
                'brand_desc' => $this->post('brand_desc'),
                'brand_logo' => $brand_logo,
                'sort' => $this->post('sort'),
                'is_show' => $is_show,
                'site_url' => $this->post('site_url'),
            );
            $model = Brand::find()->where(['brand_id'=>$brand_id])->one();
            if( $model->load( $arr, '' ) && $model->save( false ) ){
                $data['code'] = 200;
                $data['content'] = $arr;
                $data['msg'] = 'ok';
            }else{
                $data['code'] = 404;
                $data['content'] = '';
                $data['msg'] = '修改失败';
            }
            return json_encode( $data );
        }
        else
        {
            return $this->render( 'index' );
        }
    }
    //即点即改
    public function actionQuick(){
        if( $this->isRequestMethod('post') ){
            $sort = $this->post('sort');
            $brand_id = $this->post('brand_id');
            $model = Brand::find()->where(['brand_id'=>$brand_id])->one();
            $model->sort = $sort;
            $res = $model->save( false );
            if($res){
                $data['code'] = 1;
                $data['msg'] = '';
            }else{
                $data['code'] = 0;
                $data['msg'] = 'error';
            }
            return json_encode( $data );
        }
    }
    //搜索
    public function actionSearch()
    {
        if( $this->isRequestMethod('get') ){
            $keyword = $this->get( 'keyword' );
            $data = Brand::find()->where( [ 'and', ['is_show'=>1], ['like', 'brand_name', '%'.$keyword.'%', false] ] )->orderBy("sort ASC")->asArray()->all();
            if(empty( $data )){
                $arr['code'] = 404;
                $arr['msg'] = '无搜索结果';
                $arr['content'] = '';
            }else{
                $arr['code'] = 200;
                $arr['msg'] = '';
                $arr['content'] = $data;
            }
            return json_encode( $arr );
        }else{
            return $this->render( 'index' );
        }
    }
    //图片上传
    public function actionUpload(){

        if( $this->isRequestMethod('post') ){
            
            $brand_id = $this->post('brand_id');

            if(isset($_FILES['brand_logo']) && $_FILES['brand_logo']['error'] == 0){
                
                $file = $_FILES['brand_logo'];
                $brand_logo = $file['name'];

                if( move_uploaded_file($file['tmp_name'],"shop_admin/images/brand/".$file['name']) ){
                    $model = Brand::find()->where( ['brand_id'=>$brand_id] )->one();
                    $model->brand_logo = $brand_logo;
                    $res = $model->save( false );
                    if( $res ){
                        $data['code'] = 200;
                        $data['msg'] = '';
                        $data['content'] = UrlService::buildWwwUrl('/shop_admin/images/brand').'/'.$brand_logo;
                    }else{
                        $data['code'] = 404;
                        $data['msg'] = '上传失败！';
                        $data['content'] = '';
                    }
                    return json_encode( $data );
                }else{
                    return $this->render( 'index' );
                }
        }
        }
    }
}

