<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "pnie".
 *
 * @property int $id
 * @property int $id_pasieki
 * @property string $type
 * @property string $kind_of_frame
 * @property int $capacity
 * @property int $number_of_frames
 * @property string $start_data
 * @property string $end_date
 * @property string $ts_insert
 * @property string $ts_update
 * @property string $name
 * @property int $family_condition
 *
 * @property Pasieki $pasieki
 */
class Pnie extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pnie';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_pasieki', 'capacity', 'number_of_frames', 'family_condition'], 'integer'],
            [['type', 'kind_of_frame', 'capacity', 'number_of_frames', 'name', 'family_condition'], 'required'],
            [['start_data', 'end_date', 'ts_insert', 'ts_update'], 'safe'],
            [['type', 'kind_of_frame', 'name'], 'string', 'max' => 30],
            [['id_pasieki'], 'exist', 'skipOnError' => true, 'targetClass' => Pasieki::className(), 'targetAttribute' => ['id_pasieki' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id',
            'id_pasieki',
            'type' => Yii::t('app_frontend', 'type'),
            'kind_of_frame' => Yii::t('app_frontend', 'kind of frame'),
            'capacity' => Yii::t('app_frontend', 'capacity'),
            'number_of_frames' => Yii::t('app_frontend', 'number of frames'),
            'start_data' => Yii::t('app_frontend', 'start data'),
            'end_date' => Yii::t('app_frontend', 'end date'),
            'ts_insert',
            'ts_update' => Yii::t('app_frontend', 'updated'),
            'name' => Yii::t('app_frontend', 'name'),
            'family_condition' => Yii::t('app_frontend', 'family condition'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPasieki()
    {
        return $this->hasOne(Pasieki::className(), ['id' => 'id_pasieki']);
    }
}
