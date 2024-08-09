<?php

namespace App\DataProvider;

use App\DataProvider\Models\UserModel;
use App\DataProvider\Concern\JsonProviderBase;
use App\DataProvider\Concern\ProviderInterface;
use App\DataProvider\Transformers\DataProviderXTransformer;

class DataProviderX extends JsonProviderBase implements ProviderInterface
{
    protected $statusCode = [
        '1'  => UserModel::STATUS_AUTHORIZED,
        '2'  => UserModel::STATUS_DECLINE,
        '3'  => UserModel::STATUS_REFUNDED
    ];

    public function getTransformerClass():string {
       return DataProviderXTransformer::class;
    }

    public function getFilePath()
    {
        return storage_path("data/DataProviderX.json");
    }

}
