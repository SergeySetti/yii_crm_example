<?php

namespace tests;

use app\models\UserModel;

class SignUpFormCest
{

    public function _before(\FunctionalTester $I)
    {
        $I->amOnRoute('site/signup');
    }


    public function openSignUpPage(\FunctionalTester $I)
    {
        $I->submitForm('#signup-form', [
            'SignupForm[country]' => '11'
        ]);

        $I->expectTo('See validations errors');
        $I->see('Password cannot be blank.');
        $I->see('Incorrect country.');
        $I->see('Email cannot be blank.');
    }


    public function tryToSignupForIndividualAccount(\FunctionalTester $I)
    {
        $I->submitForm('#signup-form', [
            'SignupForm[subscription_type]' => UserModel::SUBSCRIPTION_TYPE_COMPANY
        ]);

        $I->expectTo('See validations errors');
        $I->see('Company name can not be blank.');


        $I->submitForm('#signup-form', [
            'SignupForm[subscription_type]' => UserModel::SUBSCRIPTION_TYPE_INDIVIDUAL
        ]);

        $I->expectTo('Don\'t see validations errors');
        $I->dontSee('Company name can not be blank.');
    }

}
