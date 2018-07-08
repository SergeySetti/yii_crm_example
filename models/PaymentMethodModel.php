<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "payment_methods".
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $type
 * @property string $description
 *
 * @property ClientModel[] $clients
 * @property UserModel $user
 */
class PaymentMethodModel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'payment_methods';
    }

    /**
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->user_id = \Yii::$app->getUser()->getId();
            }
            return true;
        }
        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        $loggedInUserId = Yii::$app->getUser()->getId();

        return [
            [['type', 'description'], 'string'],
            [['type', 'description',  'name'], 'required'],
            [['name'], 'string', 'max' => 255],
            ['name', 'unique', 'targetClass' => PaymentMethodModel::class, 'filter' => ['=', 'user_id', $loggedInUserId], 'message' => 'This payment method name has already been taken.'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'name' => 'Name',
            'type' => 'Type',
            'description' => 'Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClients()
    {
        return $this->hasMany(ClientModel::class, ['payment_method_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(UserModel::class, ['id' => 'user_id']);
    }
}
