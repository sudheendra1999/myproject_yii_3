<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "person".
 *
 * @property int $person_id
 * @property int $income
 * @property int $expense
 * @property int $total_balance
 * @property string $details
 * @property string $date_capture
 * @property int $user_id
 *
 * @property BackendUser $user
 */
class Person extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'person';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['income', 'expense', 'total_balance', 'details', 'user_id'], 'required'],
            [['income', 'expense', 'total_balance', 'user_id'], 'integer'],
            [['details'], 'string'],
            [['date_capture'], 'safe'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => BackendUser::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'person_id' => 'Person ID',
            'income' => 'Income',
            'expense' => 'Expense',
            'total_balance' => 'Total Balance',
            'details' => 'Details',
            'date_capture' => 'Date Capture',
            'user_id' => 'User ID',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(BackendUser::className(), ['id' => 'user_id']);
    }
}
