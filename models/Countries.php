<?php


namespace app\models;


use League\ISO3166\ISO3166;

class Countries
{
    public function allCodes()
    {
        $countries = (new ISO3166())->all();
        return array_map(function($v) {
            return  $v['alpha2'];
        }, $countries);
    }
}