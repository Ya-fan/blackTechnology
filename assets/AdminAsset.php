<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

class AdminAsset extends AssetBundle
{
    
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public function registerAssetFiles( $View )
    {
       
        $this->css = [
            '/shop_admin/static/h-ui/css/H-ui.min.css',

            '/shop_admin/static/h-ui/css/H-ui.min.css',
            '/shop_admin/lib/Hui-iconfont/1.0.8/iconfont.css',
            '/shop_admin/static/h-ui.admin/css/style.css',

        ];

        $this->js = [
                
        '/shop_admin/lib/jquery/1.9.1/jquery.min.js',
        '/shop_admin/lib/layer/2.4/layer.js',
        '/shop_admin/lib/jquery.validation/1.14.0/jquery.validate.js',
        '/shop_admin/lib/jquery.validation/1.14.0/validate-methods.js',
        '/shop_admin/lib/jquery.validation/1.14.0/messages_zh.js',
        '/shop_admin/static/h-ui/js/H-ui.js',
        '/shop_admin/static/h-ui.admin/js/H-ui.admin.page.js',


        ];

        parent::registerAssetFiles( $View );
    }

    // public $depends = [
    //     'yii\web\YiiAsset',
    //     'yii\bootstrap\BootstrapAsset',
    // ];
    // public $jsOptions = [
    // 'position' => \yii\web\View::POS_HEAD
    // ];
}
