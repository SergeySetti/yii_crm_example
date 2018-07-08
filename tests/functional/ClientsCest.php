<?php

namespace tests;


use app\models\ClientModel;
use app\models\UserModel;
use FunctionalTester;

class ClientsCest
{
    public function checkRelations(FunctionalTester $I)
    {
        $user = new  UserModel();
        $user->username = 'Foo';
        $user->setPassword('abc');
        $user->save();

        $userToAttach = UserModel::findByUsername('Foo');

        $client = new ClientModel();
        $client->name = "Bar";
        $client->status = "Active";
        $client->country = "UA";
        $client->save();

        $client->link('user', $userToAttach);

        $checkClient = ClientModel::findOne([
            'name' => 'Bar',
        ]);

        /** @var UserModel $attachedUser */
        $attachedUser = $checkClient->getUser()->one();
        $attachedUserSame = $checkClient->user();

        $I->assertEquals('Foo', $attachedUser->username);
        $I->assertEquals($attachedUserSame->username, $attachedUser->username);
    }
}