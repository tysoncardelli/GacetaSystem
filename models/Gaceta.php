<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "gaceta".
 *
 * @property integer $id
 * @property string $asunto
 * @property string $numero
 * @property string $fecha_publicacion
 * @property string $ruta
 *
 * @property Bitacora[] $bitacoras
 * @property Motivo[] $motivos
 */
class Gaceta extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gaceta';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['asunto', 'numero', 'fecha_publicacion', 'ruta'], 'required'],
            [['fecha_publicacion'], 'safe'],
            [['asunto'], 'string', 'max' => 100],
            [['numero'], 'string', 'max' => 45],
            [['ruta'], 'string', 'max' => 150],
            [['numero'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'asunto' => 'Asunto',
            'numero' => 'Número',
            'fecha_publicacion' => 'Fecha Publicación',
            'ruta' => 'Ruta',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBitacoras()
    {
        return $this->hasMany(Bitacora::className(), ['gaceta_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMotivos()
    {
        return $this->hasMany(Motivo::className(), ['gaceta_id' => 'id']);
    }
}
