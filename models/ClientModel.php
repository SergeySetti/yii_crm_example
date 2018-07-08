<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "clients".
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $status
 * @property string $country
 * @property string $note
 * @property integer $payment_method_id
 * @property PaymentMethodModel $paymentMethod
 * @property UserModel $user
 */
class ClientModel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'clients';
    }

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
            [['name', 'country'], 'required'],
            [['status', 'note'], 'string'],
            ['status', 'required'],
            [['name', 'country'], 'string', 'max' => 255],
            ['name', 'unique', 'targetClass' => ClientModel::class, 'filter' => ['=', 'user_id', $loggedInUserId], 'message' => 'This client\'s name has already been taken.'],
            ['payment_method_id', 'exist', 'skipOnEmpty' => true, 'targetClass' => PaymentMethodModel::class, 'targetAttribute' => ['payment_method_id' => 'id']],
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
            'status' => 'Status',
            'country' => 'Country',
            'note' => 'Note',
            'payment_method_id' => 'Payment method',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(UserModel::class, ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPaymentMethod()
    {
        return $this->hasOne(PaymentMethodModel::class, ['id' => 'payment_method_id']);
    }

    /**
     * @return UserModel
     */
    public function user()
    {
        /** @var UserModel $user */
        $user = $this->hasOne(UserModel::class, ['id' => 'user_id'])->one();
        return $user;
    }
}
