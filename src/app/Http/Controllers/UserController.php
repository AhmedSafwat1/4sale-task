<?php

namespace App\Http\Controllers;

use App\Repositories\Concern\UserRepositoryInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(public UserRepositoryInterface $repo)
    {
    }
    public function getUsers(Request $request)
    {

        return response()->json(["status"=>"success", "data"=>$this->repo->getUsers($request)]);
    }
}
