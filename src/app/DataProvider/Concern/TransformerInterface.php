<?php

namespace App\DataProvider\Concern;

interface TransformerInterface
{
    public function transform(object $item): TransformerModel;
}
