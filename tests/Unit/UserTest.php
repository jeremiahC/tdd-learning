<?php

namespace Tests\Unit;

use App\User;
use App\Category;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * test if take lesson function works
     *
     * @test
     */
    public function can_take_lessons()
    {
        $user = factory(User::class)->create([
            'name' => 'Jeremiah Caballero',
            'email' => 'jeremiah.caballero@gmail.com',
            'password' => Hash::make('secret'),
            'remember_token' => str_random(10),
        ]);

        $category = factory(Category::class)->create([
            'title' => 'Learn English',
            'description' => 'You Can Learn English',
        ]);

        $lesson = $user->takeLesson($category->id);

        $this->assertNotEmpty($lesson);
    }
}
