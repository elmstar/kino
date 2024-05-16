<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "films".
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $photo
 * @property string|null $description
 * @property int|null $age
 *
 * @property Sessions[] $sessions
 */
class Films extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'films';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['age'], 'integer'],
            [['title'], 'string', 'max' => 128],
            [['photo'], 'string', 'max' => 4],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'photo' => 'Photo',
            'description' => 'Description',
            'age' => 'Age',
        ];
    }

    /**
     * Gets query for [[Sessions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSessions()
    {
        return $this->hasMany(Sessions::class, ['film_id' => 'id']);
    }
}
