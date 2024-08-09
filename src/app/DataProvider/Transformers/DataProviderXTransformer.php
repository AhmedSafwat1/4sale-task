<?php

namespace App\DataProvider\Transformers;

use App\DataProvider\Models\UserModel;
use App\DataProvider\Concern\TransformerModel;
use App\DataProvider\Concern\TransformerInterface;

class DataProviderXTransformer implements TransformerInterface
{
    protected $statusCode = [
        '1'  => UserModel::STATUS_AUTHORIZED,
        '2'  => UserModel::STATUS_DECLINE,
        '3'  => UserModel::STATUS_REFUNDED
    ];
    
    public function transform(object $item): TransformerModel
    {
        return new UserModel(
            $item->parentIdentification,
            $item->parentEmail,
            $item->parentAmount,
            $item->Currency,
            $this->statusCode[$item->statusCode] ?? null,
            $item->registerationDate,
            'DataProviderX'
        );
    }
}
