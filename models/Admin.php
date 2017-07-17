<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "admin".
 *
 * @property string $uid
 * @property string $nickname
 * @property string $mobile
 * @property string $email
 * @property integer $sex
 * @property string $avatar
 * @property string $login_name
 * @property string $login_pwd
 * @property string $login_salt
 * @property integer $status
 * @property string $updated_time
 * @property string $created_time
 */
class Admin extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admin';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sex', 'status'], 'integer'],
            [['updated_time', 'created_time'], 'safe'],
            [['nickname', 'email'], 'string', 'max' => 100],
            [['mobile', 'login_name'], 'string', 'max' => 20],
            [['avatar'], 'string', 'max' => 64],
            [['login_pwd', 'login_salt'], 'string', 'max' => 32],
            [['login_name'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'uid' => 'Uid',
            'nickname' => 'Nickname',
            'mobile' => 'Mobile',
            'email' => 'Email',
            'sex' => 'Sex',
            'avatar' => 'Avatar',
            'login_name' => 'Login Name',
            'login_pwd' => 'Login Pwd',
            'login_salt' => 'Login Salt',
            'status' => 'Status',
            'updated_time' => 'Updated Time',
            'created_time' => 'Created Time',
        ];
    }

     // 生成加密 密码
    public function getSaltPassword( $password )
    {
        return md5( $password. md5( $this->login_salt ) );
    }

    // 校验加密 密码
    public function verifyPassword( $password )
    {  
       $verify_pwd =  $this->getSaltPassword( $password ) ;
   
        if( $verify_pwd != $this->login_pwd )
        {
            return false;
        }
        else
        {
            return true;
        }
    }

    // 设置密码
    public function setPassword( $password )
    {
        $this->login_pwd = $this->getSaltPassword( $password );
    }

    // 生成密码随机key
    public function setSalt()
    {
        $chars = 'qazwxedcrfvtgbyhnujmikolpQAZWSXEDCRFVTGBYHNUJMIKOLP!@#$%^&*';
        
        $salt = '';

        for ($i=0; $i <= 6 ; $i++) { 
            
            $salt .= $chars[ mt_rand( 0, strlen( $chars )-1 ) ]; 
        }

        $this->login_salt = $salt;

        return $salt;
    }




}
