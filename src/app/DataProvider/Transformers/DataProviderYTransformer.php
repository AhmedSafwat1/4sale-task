<?php

namespace App\DataProvider\Transformers;

use Carbon\Carbon;
use App\DataProvider\Models\UserModel;
use App\DataProvider\Concern\TransformerModel;
use App\DataProvider\Concern\TransformerInterface;

class DataProviderYTransformer implements TransformerInterface
{
    protected $statusCode = [
        '100'  => UserModel::STATUS_AUTHORIZED,
        '200'  => UserModel::STATUS_DECLINE,
        '300'  => UserModel::STATUS_REFUNDED
    ];

    public function transform(object $item): TransformerModel
    {
        return new UserModel(
            $item->id,
            $item->email,
            $item->balance,
            $item->currency,
            $this->statusCode[$item->status],
            Carbon::createFromFormat('d/m/Y', $item->created_at)->format("Y-m-d"),
            'DataProviderY',
        );
    }
}
