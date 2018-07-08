<?php

class CountryCest
{
    public function countriesCodes(FunctionalTester $I)
    {
        $allCodes = (new \app\models\Countries())->allCodes();
        $I->assertContains('UA', $allCodes);
    }
}