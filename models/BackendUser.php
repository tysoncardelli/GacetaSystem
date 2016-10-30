<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "backend_user".
 *
 * @property integer $id
 * @property string $firstName
 * @property string $lastName
 * @property string $username
 * @property string $password
 * @property string $authKey
 */
class BackendUser extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'backend_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['firstName', 'lastName', 'username', 'password', 'authKey'], 'required'],
            [['firstName'], 'string', 'max' => 150],
            [['lastName', 'username', 'password'], 'string', 'max' => 45],
            [['authKey'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'firstName' => 'First Name',
            'lastName' => 'Last Name',
            'username' => 'Username',
            'password' => 'Password',
            'authKey' => 'Auth Key',
        ];
    }

    public function getAuthKey()
    {
            return $this->authKey;
    }
   
        public function validateAuthKey($authKey)
    {
             return $this->authKey === $authKey;
    }
        public static function findIdentity($id)
    {
            return new static(self::findOne($id));
    }
      public static function findIdentityByAccessToken($token, $type = null)
    {
            throw new \yii\base\NotSupportedException();            

    }

       public function getId()
    {
        return $this->id;
    }

    public static function findByUsername($username){
            return self::findOne(['username'=>$username]);
    }
    public function validatePassword($password){
            return $this->password===$password; 
    }

}
