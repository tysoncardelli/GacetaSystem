<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $nombre
 * @property string $login
 * @property string $password
 * @property string $fecha_caducidad
 *
 * @property Bitacora[] $bitacoras
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'login', 'password', 'fecha_caducidad'], 'required'],
            [['fecha_caducidad'], 'safe'],
            [['nombre'], 'string', 'max' => 150],
            [['login', 'password'], 'string', 'max' => 45],
            [['login'], 'unique'],
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
            'login' => 'Login',
            'password' => 'Password',
            'fecha_caducidad' => 'Fecha Caducidad',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBitacoras()
    {
        return $this->hasMany(Bitacora::className(), ['user_id' => 'id']);
    }
}
