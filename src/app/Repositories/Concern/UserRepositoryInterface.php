<?php
namespace App\Repositories\Concern;

use Illuminate\Http\Request;

interface UserRepositoryInterface {
    /**
     * Get Users
     *
     * @param Request $request
     * @return array
     */
    public function getUsers(Request $request):array;
}