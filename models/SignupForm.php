<?php

namespace app\models;

use yii\base\Model;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $password_repeat;
    public $company_name;
    public $country;
    public $company;
    public $subscription_type;
    public $real_name;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\app\models\UserModel', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['real_name', 'required'],
            ['subscription_type', 'in', 'range' => array_keys(UserModel::SUBSCRIPTION_TYPES)],
            ['country', 'string', 'min' => 2, 'max' => 2],
            ['country', 'validateCountry'],
            ['company_name', 'validateCompany', 'skipOnEmpty' => false, 'skipOnError' => false],
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\app\models\UserModel', 'message' => 'This email address has already been taken.'],
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
            ['password', 'compare', 'compareAttribute' => 'password_repeat'],
            ['password_repeat', 'compare', 'compareAttribute' => 'password'],

        ];
    }

    /**
     * Validate input for country code
     *
     * @param $attribute
     */
    public function validateCountry($attribute)
    {
        $countries = (new Countries())->allCodes();

        if (!in_array($this->country, $countries)) {
            $this->addError($attribute, 'Incorrect country.');
        }

    }

    /**
     * Validate input for country code
     *
     * @param $attribute
     */
    public function validateCompany($attribute)
    {
        if ($this->subscription_type == UserModel::SUBSCRIPTION_TYPE_COMPANY) {
            if(!$this->company_name) {
                $this->addError($attribute, 'Company name can not be blank.');
            }
        }
    }

    /**
     * Signs user up.
     *
     * @return \app\models\UserModel|null
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = new UserModel();
        $user->username = $this->username;
        $user->real_name = $this->real_name;
        $user->email = $this->email;
        $user->subscription_type = $this->subscription_type;
        $user->company_name = $this->company_name;
        $user->country = $this->country;
        $user->setPassword($this->password);

        return $user->save() ? $user : null;
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'real_name' => 'Your name',
            'password' => 'Password',
            'password_repeat' => 'Confirm password',
            'subscription_type' => 'Subscription type',
            'company_name' => 'Company name',
            'email' => 'Email',
            'country' => 'Country',
        ];
    }
}