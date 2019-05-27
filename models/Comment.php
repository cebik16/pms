<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Comment".
 *
 * @property int $id
 * @property int $userId
 * @property int $taskId
 * @property string $text
 * @property string $created_at
 * @property string $updated_at
 */
class Comment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Comment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['userId', 'taskId', 'text', 'created_at', 'updated_at'], 'required'],
            [['userId', 'taskId'], 'integer'],
            [['text'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'userId' => 'User ID',
            'taskId' => 'Task ID',
            'text' => 'Text',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
