<?php

namespace App\DataProvider\Filters;

use Illuminate\Http\Request;
use App\DataProvider\Filters\IFilter;

class CurrencyFilter implements IFilter
{
    public $params ="currency";
    public $attribute = "currency";

    public function itemIsValid(object $item, Request $request):bool
    {
        if(!$request->has($this->params) || empty($request->input($this->params))) {
            return true;
        }
        return $item->{$this->attribute} == $request->input($this->params);
    }
}
