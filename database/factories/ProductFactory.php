<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $category_id = Category::all()->random()->id;
        $subcategory_id = Category::where('parent_id', $category_id)->random()->id;
        return [
            'product_name'  =>  $this->faker->simpleProduct,
            'category_id' => $category_id,
            'subcategory_id'    =>  $subcategory_id,
            'price' =>  $this->faker->randomeNumber(2),
            'description' => $this->faker->text,
            'image' => $this->faker->imageUrl($width = 640, $height = 480),
            'status' => $this->faker->boolean
        ];
    }
}
