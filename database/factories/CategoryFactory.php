<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'parent_id' => null,
        ];
    }

    public function children(){
        return  $this->state(function( array $attributes){
            return [
                'parent_id' => Category::factory()->create()->id,
            ];
        });
    }
}
