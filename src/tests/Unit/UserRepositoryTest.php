<?php

namespace Tests\Unit;

use Illuminate\Http\Request;
use Tests\TestCase;

use App\Repositories\UserRepository;

class UserRepositoryTest extends TestCase
{
    /**
     * Test if get users will  return array with filter balanceMin
     */
    public function test_getUsers_return_array_with_filter_balanceMin(): void
    {
        $mockRequest = Request::create('/api/v1/users', 'GET', ["balanceMin"=>50]);
        $repo = new UserRepository();
        $users = $repo->getUsers($mockRequest);
        $this->assertTrue(is_array($users));
        foreach ($users as $user) {
            $this->assertTrue($user->amount > 50);
        }    
    }

     /**
     * Test if get users will  return array with filter balanceMin
     */
    public function test_getUsers_return_array_with_filter_provider(): void
    {
        $mockRequest = Request::create('/api/v1/users', 'GET', ["provider"=>"DataProviderY"]);
        $repo = new UserRepository();
        $users = $repo->getUsers($mockRequest);
        $this->assertTrue(is_array($users));
        foreach ($users as $user) {
            $this->assertTrue($user->provider == "DataProviderY");
        }    
    }

    /**
     * Test if get users will  return array
     */
    public function test_getUsers_return_array(): void
    {
        $mockRequest = Request::create('/api/v1/users', 'GET');
        $repo = new UserRepository();
        $users = $repo->getUsers($mockRequest);
        $this->assertTrue(is_array($users));  
    }

    
}
