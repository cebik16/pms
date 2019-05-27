<?php

namespace app\models;

use Yii;
/**
 * This is the model class for table "Task".
 *
 * @property int $id
 * @property strinng $status
 * @property int $projectID
 * @property int $assignedTo
 * @property int $name
 * @property strinng $description
 * @property file $attachment
 */
class Task extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Task';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['statusId', 'projectID', 'assignedTo', 'name', 'description', 'attachment'], 'required'],
	        [['name', 'description', 'status'], 'string'],
	        [['status', 'projectID', 'assignedTo', 'projects'], 'integer'],
	        [['attachment'], 'file'],
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
	        'projectID' => 'Project ID',
	        'assignedTo' => 'Assigned To',
	        'status' => 'Status',
            'description' => 'Description',
            'attachment' => 'Attachment',
        ];
    }
	
	public function getProject()
	{
		return $this->hasOne(Project::class, ['id' => 'projectID']);
	}
	
	public function getComment()
	{
		return $this->hasOne(Comment::class, ['id' => 'projectID']);
	}
}
