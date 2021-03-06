<?php

namespace common\models\tables;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "tasks".
 *
 * @property int $id
 * @property string $name
 * @property string $date
 * @property string $description
 * @property int $responsible_id
 *
 * @property Users $user
 */
class Tasks extends \yii\db\ActiveRecord
{
    const EVENT_RUN_COMPLETE = 'run complete';

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'create_time',
                'updatedAtAttribute' => 'update_time',
//                'value' => new Expression('NOW()'),
                'value' => function () {
                    return date('Y-m-d H:i:s');
                }
            ]

        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tasks';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'date'], 'required'],
            [['date'], 'safe'],
            [['date_complite'], 'safe'],
            [['dedline_date'], 'safe'],
            [['description'], 'string'],
            [['administrator_id'], 'integer'],
            [['responsible_id'], 'integer'],
            [['id_project'], 'integer'],
            [['status'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'name', //Yii::t('main','task_name'),
            'date' => 'Date',
            'status'=>'Status',
            'description' => 'Description',
            'responsible_id' => 'Responsible ID',
            'id_project' => 'ID Project',
            'dedline_date'=>'Dedline Date',
            'administrator_id'=>'Administrator ID',
            'date_complite'=>'Date Complite'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResponsible()
    {
        return $this->hasOne(Users::class, ['id' => 'responsible_id']);
    }

    public function getAdministrator()
    {
        return $this->hasOne(Users::class, ['id' => 'administrator_id']);
    }

    public function getTaskComments()
    {
        return $this->hasMany(TaskComments::class, ['task_id' => 'id']);
    }
    public function getTaskAttachments()
    {
        return $this->hasMany(TaskAttachments::class, ['task_id' => 'id']);
    }

    public function getStatus()
    {
        return $this->hasOne(TaskStatus::class, ['id' => 'status']);
    }

//    public function fields()
//    {
//        return [
//            'name'
//        ];
//    }

    public function extraFields()
    {
        return ['responsible'];
    }
}
