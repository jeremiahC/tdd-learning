<?php

namespace Tests\Feature;

use App\User;
use App\Category;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class TakeLessonTest extends TestCase
{
    use DatabaseMigrations;

    private $name = 'Jeremiah Caballero';
    private $email = 'jeremiah.caballero@gmail.com';
    private $password = 'secret';

    public function userCreate()
    {
        $user = factory(User::class)->create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'remember_token' => str_random(10),
        ]);

        return $user;
    }

    /**
     * @test
     */
    public function user_can_take_lesson()
    {
        //act
        $user = $this->userCreate();

        $category = factory(Category::class)->create([
            'title' => 'Learn English',
            'description' => 'You Can Learn English',
        ]);


        $response = $this->post('lesson/take/' . $user->id, [
            'category_id' => $category->id
        ]);

        $response->assertStatus(201);
    }

    /** @test */
    public function user_can_get_number_of_lessons_learned()
    {
        $user = $this->userCreate();

        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
