<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "sessions".
 *
 * @property int $id
 * @property int $film_id
 * @property string|null $datetime
 * @property float|null $price
 *
 * @property Films $film
 */
class Sessions extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sessions';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['film_id'], 'required'],
            [['film_id'], 'integer'],
            [['datetime'], 'safe'],
            [['price'], 'number'],
            [['film_id'], 'exist', 'skipOnError' => true, 'targetClass' => Films::class, 'targetAttribute' => ['film_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'film_id' => 'Film ID',
            'datetime' => 'Datetime',
            'price' => 'Price',
        ];
    }

    /**
     * Gets query for [[Film]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFilm()
    {
        return $this->hasOne(Films::class, ['id' => 'film_id']);
    }
}
