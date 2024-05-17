<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;

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
    public $imageFile;
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
            [['age', 'duration'], 'integer'],
            [['title'], 'string', 'max' => 128],
            [['imageFile'],'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название',
            'photo' => 'Фото',
            'description' => 'Описание',
            'duration'  => 'Продолжительность(мин.)',
            'age' => 'Возрастные ограничения',
        ];
    }
    public function attributeHints()
    {
        return [
            'duration'  => 'Продолжительность в минутах'
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $this->imageFile->saveAs('../../common/images/' . $this->id . '.' . $this->imageFile->extension);
            $this->photo = $this->imageFile->extension;
            $this->imageFile = '';
            $this->save();
            return true;
        } else {
            return false;
        }
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
    // ------------------------ Данные для выпадающих списков (DropDownList) ----------------------
    public static function getDropDownListAge()
    {
        return [
            0 => '0+',
            3 => '3+',
            6 => '6+',
            12 => '12+',
            16  => '16+',
            18 => '18+'
        ];
    }
    public static function getDropDownListFilms()
    {
        $rows = self::find()
            ->select(['id','title'])
            ->asArray()->all();
        return ArrayHelper::map($rows, 'id', 'title');
    }
}
