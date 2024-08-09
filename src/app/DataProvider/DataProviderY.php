<?php

namespace App\DataProvider;

use Carbon\Carbon;
use App\DataProvider\Concern\JsonProviderBase;
use App\DataProvider\Concern\ProviderInterface;
use App\DataProvider\Transformers\DataProviderYTransformer;

class DataProviderY extends JsonProviderBase implements ProviderInterface  
{
    protected $statusCode = [
        '100'  => 'authorised',
        '200'  => 'decline',
        '300'  => 'refunded'
    ];

    public function getTransformerClass():string {
        return DataProviderYTransformer::class;
     }

    public function getFilePath()
    {
        return storage_path("data/DataProviderY.json");
    }
}
