<?php


namespace app\models;


use League\ISO3166\ISO3166;

class Countries
{
    /**
     * @return array
     */
    public function allCodes()
    {
        $countries = (new ISO3166())->all();
        return array_map(function($v) {
            return  $v['alpha2'];
        }, $countries);
    }

    /**
     * @param $code
     * @return mixed
     */
    public function codeToCountry($code)
    {
        return (new ISO3166())->alpha2($code)['name'];
    }
}