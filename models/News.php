<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "news".
 *
 * @property integer $id
 * @property integer $date
 * @property string $title
 * @property string $intro
 * @property string $slug
 * @property string $content
 * @property string $image
 * @property integer $published
 */
class News extends ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%news}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date', 'title', 'intro', 'content', 'slug'], 'required'],
            [['published'], 'integer'],
            [['date'], 'date', 'format' => 'php:d.m.Y', 'timestampAttribute' => 'date'],
            [['content'], 'string'],
            [['title'], 'string', 'max' => 40],
            [['slug', 'image'], 'string', 'max' => 255],
            [['intro'], 'string', 'max' => 512],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'Дата',
            'title' => 'Заголовок',
            'intro' => 'Вступление',
            'slug' => 'ЧПУ ссылка',
            'content' => 'Содержание',
            'published' => 'Опубликовать',
            'image' => 'URL картинки',
        ];
    }
}