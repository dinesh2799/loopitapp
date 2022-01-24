<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Car;
class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
//    public function test_example()
//    {
//
//        $response = $this->get('/');
//
//        $response->assertStatus(200);
//    }

        public function add_car()
    {
        $data = Car::make([
            'model' => 'abcd',
            'brand' => 'hh',
            'stock' => 10,
            'booked' => 5,
            'available' => 5,
        ]);

        $data2 = Car::make([
            'model' => 'aebcd',
            'brand' => 'hfh',
            'stock' => 100,
            'booked' => 50,
            'available' => 50,
        ]);

        $this->assertTrue($data->model != $data2->model);
    }

    public function test_find_car()
    {

        $response = $this->withHeaders([
            'Authorization' => 'Bearer '
        ])->json('GET','api/cars');

        //Write the response in laravel.log
//        \Log::info(1, [$response->getContent()]);

        $response->assertStatus(200);
    }


}
