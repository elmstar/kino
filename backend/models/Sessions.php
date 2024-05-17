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
            'film_id' => 'Фильм',
            'datetime' => 'Дата и время начала',
            'price' => 'Стоимость',
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
    public function setDatetime($value)
    {
        $this->datetime = ($value) ? date('Y-m-d H:i:s', strtotime($value)) : '';
    }
    public function validateTime()
    {
        $datetime = strtotime($this->datetime) - 1800;
        $datetimeEnd = $datetime + $this->film->duration * 60 + 1800;

        $startTime = date('Y-m-d H:i:s',$datetime - 6*3600);
        $endTime = date('Y-m-d H:i:s',$datetime + 6*3600);
        $preSessions = self::find()
            ->where(['between', 'datetime', $startTime, $endTime])
            ->andWhere(['!=', 'id', $this->id])
            ->all();
        if (is_countable($preSessions)) {
            foreach ($preSessions as $session) {
                $sessionStart = strtotime($session->datetime);
                $filmDuration = ($session->film->duration)*60;
                $sessionEnd = $sessionStart + $filmDuration;
                if ($datetime > $sessionStart AND $datetime < $sessionEnd) {
                    return false;
                }

                if ( $datetimeEnd > $sessionStart AND $datetimeEnd < $sessionEnd) {

                    return false;
                }

            }
        }

        return true;
    }
}
