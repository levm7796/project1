<?php

namespace Database\Factories;

use App\Models\Products;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Shoes>
 */
class ProductsFactory extends Factory
{

    protected $model = Products::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
//        return [
//            'img' => 'https://i5.walmartimages.com/asr/34c3bb89-ce6c-4997-aac6-d0daf9ade8c4_1.9ac121eb659026483e51f4bdad0cba06.jpeg',
//            'name' => 'Shoes',
//            'price' => 10
//        ];

        return
//            [
//                'img' => 'img4',
//                'description' => 'Cotton T Shirt',
//                'name' => 'Basic Slim Fit T-Shirt',
//                'color' => '#ffffff',
//                'colors' => 5,
//                'price' => 99
//            ];
//            [
//                'img' => 'img5',
//                'name' => 'Blurred Print T-Shirt',
//                'description' => 'Henley T-Shirt',
//                'color' => '#DBDCCE',
//                'colors' => 3,
//                'price' => 99
//            ];
//            [
//                'img' => 'img6',
//                'name' => 'Full Sleeve Zipper',
//                'description' => 'Crewneck T-Shirt',
//                'color' => '#EAE8D9',
//                'colors' => 2,
//                'price' => 99
//            ];
//            [
//                'img' => 'img3',
//                'name' => 'Embroidered Seersucker Shirt',
//                'description' => 'V-Neck T-Shirt',
//                'color' => 'null',
//                'colors' => 0,
//                'price' => 99
//            ];
//            [
//                'img' => 'img7',
//                'name' => 'Basic Heavy Weight T-shirt',
//                'description' => 'Cotton T Shirt',
//                'color' => '#ffffff',
//                'colors' => 5,
//                'price' => 199
//            ];
//
//            [
//                'img' => 'img8',
//                'name' => 'Soft Wash straight Fit Jeans',
//                'description' => 'Cotton jeans',
//                'color' => '#ffffff',
//                'colors' => 5,
//                'price' => 199
//            ];
//
        [
            'img' => 'img9',
            'name' => 'Basic Heavy Weight T-shirt',
            'description' => 'Cotton T Shirt',
            'color' => '#ffffff',
            'colors' => 5,
            'price' => 199
        ];
    }
}
