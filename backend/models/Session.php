<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "session".
 *
 * @property int $id
 * @property int $film_id
 * @property string|null $datetime
 * @property float|null $price
 *
 * @property Film $film
 */
class Session extends \yii\db\ActiveRecord
{
    /**
     * Промежуток между сеансами в секундах
     */
    const SESSION_INTERVAL = 1800;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'session';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['film_id', 'datetime', 'price'], 'required'],
            [['film_id'], 'integer'],
            [['datetime'], 'safe'],
            [['price'], 'number', 'max' => 1000000, 'numberPattern' => '/^\s*[-+]?[0-9]*[.]?[0-9]+([eE][-+]?[0-9]+)?\s*$/'],
            [['film_id'], 'exist', 'skipOnError' => true, 'targetClass' => Film::class, 'targetAttribute' => ['film_id' => 'id']],
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
    public function attributeHints()
    {
        return [
            'price' => 'В качестве разделителя дробной части используется точка'
        ];
    }

    /**
     * Gets query for [[Film]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFilm()
    {
        return $this->hasOne(Film::class, ['id' => 'film_id']);
    }
    public function setDatetime($value)
    {
        $this->datetime = ($value) ? date('Y-m-d H:i:s', strtotime($value)) : '';
        dd($this->datetime);
    }
    public function validateTime()
    {
        $datetime = strtotime($this->datetime) - self::SESSION_INTERVAL;
        $datetimeEnd = strtotime($this->datetime) + $this->film->duration * 60 + self::SESSION_INTERVAL;
        $startTime = date('Y-m-d H:i:s',$datetime - 6*3600);
        $endTime = date('Y-m-d H:i:s',$datetime + 6*3600);
        $preSessions = self::find()
            ->where(['between', 'datetime', $startTime, $endTime])
            ->andWhere(['!=', 'id', (int)$this->id])
            ->all();
        if (!empty($preSessions)) {
            foreach ($preSessions as $session) {
                $sessionStart = strtotime($session->datetime);
                $filmDuration = ($session->film->duration)*60;
                $sessionEnd = $sessionStart + $filmDuration;

                if ($sessionStart < $datetime && $datetime < $sessionEnd) {
                    return false;
                }
                if ($sessionStart < $datetimeEnd && $datetimeEnd < $sessionEnd) {
                    return false;
                }
                if ($datetime < $sessionStart && $sessionStart < $datetimeEnd) {
                    return false;
                }
                if ($datetime < $sessionEnd && $sessionEnd < $datetimeEnd) {
                    return false;
                }
            }
        }
        return true;
    }
}
