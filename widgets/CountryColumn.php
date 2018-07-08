<?php

namespace app\widgets;

use app\models\Countries;
use League\ISO3166\ISO3166;
use yii\grid\Column;

class CountryColumn extends Column
{
    /**
     * {@inheritdoc}
     */
    public $header = 'Country';

    /**
     * {@inheritdoc}
     */
    protected function renderDataCellContent($model, $key, $index)
    {
        return (new Countries())->codeToCountry($model->country);
    }
}
