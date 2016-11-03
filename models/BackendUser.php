<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "backend_user".
 *
 * @property integer $id
 * @property string $nombre
 * @property string $apellido
 * @property string $username
 * @property string $password
 * @property string $fecha_caducidad
 * @property integer $Rol
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
            [['nombre', 'apellido', 'username', 'password', 'fecha_caducidad', 'Rol'], 'required'],
            [['fecha_caducidad'], 'safe'],
            [['Rol'], 'integer'],
            [['nombre'], 'string', 'max' => 150],
            [['apellido', 'username', 'password'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'apellido' => 'Apellido',
            'username' => 'Usuario',
            'password' => 'Contraseña',
            'fecha_caducidad' => 'Fecha Caducidad',
            'Rol' => 'Rol',
        ];
    }

     public function getAuthKey()
    {
         //  throw new \yii\base\NotSupportedException();       
           return $this->id;
    }
   
        public function validateAuthKey($authKey)
    {
           // throw new \yii\base\NotSupportedException();       
             return $this->id === $authKey;
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
        public function getRol()
    {
        return $this->Rol;
    }
    public static function findByUsername($username){
            return self::findOne(['username'=>$username]);
    }
    public function validatePassword($password){
            return $this->password===$password; 
    }

}
