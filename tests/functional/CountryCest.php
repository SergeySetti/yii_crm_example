<?php

namespace tests;

use FunctionalTester;

class CountryCest
{
    public function countriesCodes(FunctionalTester $I)
    {
        $allCodes = (new \app\models\Countries())->allCodes();
        $I->assertContains('UA', $allCodes);
    }
}