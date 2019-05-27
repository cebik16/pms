<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "project".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $startDate
 * @property string $duration
 * @property int $created_at
 * @property int $updated_at
 */
class Project extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'project';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'description', 'startDate', 'duration'], 'required'],
            [['startDate', 'duration'], 'safe'],
            [['startDate'], 'date', 'format' => 'YYYY-mm-dd'],
            [['created_at', 'updated_at'], 'integer'],
            [['name', 'description'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'startDate' => 'Start Date',
            'duration' => 'Duration',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
	
	public function getComment()
	{
		return $this->hasOne(Comment::class, ['id' => 'projectID']);
	}
 
}
