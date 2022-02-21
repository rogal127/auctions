<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Auction;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bid>
 */
class BidFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'auction_id' => Auction::inRandomOrder()->first()->id,
            'user_id' => User::inRandomOrder()->first()->id,
            'value' => rand(10000000, 200000000)
        ];
    }
}
