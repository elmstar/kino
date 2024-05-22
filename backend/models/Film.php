<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;

/**
 * This is the model class for table "film".
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $photo
 * @property string|null $description
 * @property int|null $age
 *
 * @property Session[] $session
 */
class Film extends \yii\db\ActiveRecord
{
    public const UPLOAD_CATALOG = '/web/upload/film';
    public $imageFile;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'film';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['age', 'title', 'duration'], 'required'],
            [['description'], 'string'],
            [['title'], 'unique'],
            [['title'],'string', 'max' => 128],
            [['age'], 'integer'],
            [['duration'], 'integer', 'min' => 0, 'max' => 300],
            [['age'], 'integer', 'max' => 21],
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
            if (!file_exists(Yii::getAlias('@frontend').self::UPLOAD_CATALOG))
                mkdir(Yii::getAlias('@frontend').self::UPLOAD_CATALOG, 0744,true);
            if (!is_link(Yii::getAlias('@backend').self::UPLOAD_CATALOG)) {
                if (!file_exists(Yii::getAlias('@backend').'/web/upload'))
                    mkdir(Yii::getAlias('@backend').'/web/upload', 0744,true);
                symlink(
                    Yii::getAlias('@frontend').self::UPLOAD_CATALOG,
                    Yii::getAlias('@backend').self::UPLOAD_CATALOG
                );
            }
            $this->imageFile->saveAs('../../frontend/web/upload/film/' . $this->id . '.' . $this->imageFile->extension);
            $this->photo = $this->imageFile->extension;
            $this->imageFile = '';
            $this->save();
            return true;
        } else {
            return false;
        }
    }

     /**
     * Gets query for [[Session]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSessions()
    {
        return $this->hasMany(Session::class, ['film_id' => 'id']);
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
        return self::find()->select('title')->indexBy('id')->column();
    }
}
