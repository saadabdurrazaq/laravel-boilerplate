<?php

namespace Tests\Unit;

use App\Services\Master\UserService;
use App\Repositories\Master\UserRepository;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Mockery;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    // composer require --dev laravel/telescope
    // php artisan make:test UserServiceTest --unit
    // run the test using php artisan test --filter UserServiceTest
    public function setUp(): void
    {
        parent::setUp();
    }

    public function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    /** @test */
    public function it_returns_paginated_users_with_trashed_count()
    {
        // Explicitly declare the mock type using PHPDoc
        /** @var \App\Repositories\Master\UserRepository|\Mockery\MockInterface $userRepositoryMock */
        $userRepositoryMock = Mockery::mock(UserRepository::class);

        Request::shouldReceive('input')
            ->with('per_page', 10)
            ->andReturn(10);
        Request::shouldReceive('input')
            ->with('page', 1)
            ->andReturn(1);

        DB::shouldReceive('statement')
            ->once()
            ->with("SET SQL_MODE=''")
            ->andReturn(true);
        DB::shouldReceive('statement')
            ->once()
            ->with("SET SQL_MODE=only_full_group_by")
            ->andReturn(true);

        $mockedUsers = collect([
            (object)[
                'id' => 1,
                'role_id' => 1,
                'username' => 'testuser',
                'name' => 'Test User',
                'is_active' => 1,
                'role_name' => 'Admin'
            ]
        ]);

        DB::shouldReceive('table')
            ->with('users')
            ->andReturnSelf();
        DB::shouldReceive('leftJoin')
            ->andReturnSelf();
        DB::shouldReceive('selectRaw')
            ->andReturnSelf();
        DB::shouldReceive('when')
            ->andReturnSelf();
        DB::shouldReceive('groupBy')
            ->andReturnSelf();
        DB::shouldReceive('forPage')
            ->with(1, 10)
            ->andReturn($mockedUsers);

        User::shouldReceive('count')
            ->once()
            ->andReturn(50);
        User::shouldReceive('onlyTrashed')
            ->once()
            ->andReturnSelf();
        User::shouldReceive('count')
            ->once()
            ->andReturn(5);

        $service = new UserService($userRepositoryMock);

        $result = $service->getAll();

        $this->assertTrue($result['success']);
        $this->assertEquals(200, $result['status']);
        $this->assertCount(1, $result['users']->items()); // Since we mocked 1 user
        $this->assertEquals(5, $result['trashed_users']);
        $this->assertEquals(10, $result['items_per_show']);
    }
}
