<?php

namespace Tests\Unit\Services;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\AbstractTest;

class UserServiceTest extends AbstractTest
{
    use RefreshDatabase;

    /** @test */
    public function it_can_store_new_user()
    {
        $userData = [
            'email' => 'john.doe@example.com',
            'password' => bcrypt('password'),
        ];

        $userService = new UserService();
        $newUser = $userService->store($userData);

        $this->assertDatabaseHas('users', $userData);
        $this->assertNotNull($newUser->id);
    }

    /** @test */
    public function it_can_check_if_user_exists()
    {
        $user = User::factory()->create();

        $userService = new UserService();
        $this->assertTrue($userService->isExist($user->id));
    }

    /** @test */
    public function it_returns_false_if_user_does_not_exist()
    {
        $userService = new UserService();
        $this->assertFalse($userService->isExist(999)); // Несуществующий ID
    }
}
