<?php

namespace App\DataProvider\Filters;

use Illuminate\Http\Request;

interface IFilter
{
    public function itemIsValid(object $item, Request $request):bool;
}
