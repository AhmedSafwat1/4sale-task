<?php

namespace App\DataProvider\Models;

use App\DataProvider\Concern\TransformerModel;

class UserModel implements TransformerModel
{
    public const STATUS_AUTHORIZED = "authorised";
    public const STATUS_DECLINE = "decline";
    public const STATUS_REFUNDED = "refunded";


    public ?string $id;
    public ?string $parentEmail;
    public ?float $amount;
    public ?string $currency;
    public ?string $status;
    public ?string $created_at;
    public ?string $provider;

    public function __construct(
        ?string $id = "",
        ?string $parentEmail = "",
        ?float $amount = 0,
        ?string $currency = '',
        ?string $status = '',
        ?string $created_at = "",
        ?string $provider = ""
    ) {
        $this->id = $id;
        $this->parentEmail = $parentEmail;
        $this->amount = $amount;
        $this->currency = $currency;
        $this->status = $status;
        $this->created_at = $created_at ?? now()->toDateString();
        $this->provider = $provider;
    }
}
