<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "brand".
 *
 * @property integer $brand_id
 * @property string $brand_name
 * @property string $brand_logo
 * @property string $brand_desc
 * @property string $site_url
 * @property integer $sort
 * @property integer $is_show
 *
 * @property Goods[] $goods
 */
class Brand extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'brand';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['brand_name', 'brand_logo', 'brand_desc', 'site_url', 'sort'], 'required'],
            [['brand_desc'], 'string'],
            [['sort', 'is_show'], 'integer'],
            [['brand_name'], 'string', 'max' => 60],
            [['brand_logo'], 'string', 'max' => 80],
            [['site_url'], 'string', 'max' => 180],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'brand_id' => 'Brand ID',
            'brand_name' => 'Brand Name',
            'brand_logo' => 'Brand Logo',
            'brand_desc' => 'Brand Desc',
            'site_url' => 'Site Url',
            'sort' => 'Sort',
            'is_show' => 'Is Show',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGoods()
    {
        return $this->hasMany(Goods::className(), ['brand_brand_id' => 'brand_id']);
    }
}
