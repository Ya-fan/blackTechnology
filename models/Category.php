<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property integer $cat_id
 * @property string $cat_name
 * @property string $cat_desc
 * @property integer $p_id
 * @property integer $sort
 * @property integer $is_nav
 * @property integer $is_show
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cat_name', 'cat_desc'], 'required'],
            [['p_id', 'sort', 'is_nav', 'is_show'], 'integer'],
            [['cat_name'], 'string', 'max' => 50],
            [['cat_desc'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cat_id' => 'Cat ID',
            'cat_name' => 'Cat Name',
            'cat_desc' => 'Cat Desc',
            'p_id' => 'P ID',
            'sort' => 'Sort',
            'is_nav' => 'Is Nav',
            'is_show' => 'Is Show',
        ];
    }
}
