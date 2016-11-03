<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bitacora".
 *
 * @property integer $id
 * @property integer $gaceta_id
 * @property integer $user_id
 * @property string $fecha_registro
 *
 * @property BackendUser $user
 * @property Gaceta $gaceta
 */
class Bitacora extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bitacora';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['gaceta_id', 'user_id', 'fecha_registro'], 'required'],
            [['gaceta_id', 'user_id'], 'integer'],
            [['fecha_registro'], 'safe'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => BackendUser::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['gaceta_id'], 'exist', 'skipOnError' => true, 'targetClass' => Gaceta::className(), 'targetAttribute' => ['gaceta_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'gaceta_id' => 'Gaceta ID',
            'user_id' => 'User ID',
            'fecha_registro' => 'Fecha Registro',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(BackendUser::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGaceta()
    {
        return $this->hasOne(Gaceta::className(), ['id' => 'gaceta_id']);
    }
}
