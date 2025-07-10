<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class OrderSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        for ($i = 1; $i <= 20; $i++) {
            $services = [];
            $items = [];

            // Generate 1–3 services
            for ($j = 0; $j < rand(1, 3); $j++) {
                $services[] = [
                    'service' => $faker->word,
                    'qty'     => rand(1, 10),
                    'price'   => $faker->randomFloat(2, 1000, 5000),
                ];
            }

            // Generate 1–3 items
            for ($k = 0; $k < rand(1, 3); $k++) {
                $items[] = [
                    'item'       => $faker->word,
                    'model'      => $faker->bothify('Model-##??'),
                    'qty'        => rand(1, 50),
                    'unit_price' => $faker->randomFloat(2, 50, 500),
                ];
            }

            $total_price = collect($services)->sum(fn($s) => $s['qty'] * $s['price']) +
                collect($items)->sum(fn($i) => $i['qty'] * $i['unit_price']);

            $amount_paid = $faker->randomFloat(2, 0, $total_price);
            $discount    = $faker->randomFloat(2, 0, 500);
            $amount_due  = $total_price - $amount_paid - $discount;

            Order::create([
                'company_name'        => $faker->company,
                'company_address'     => $faker->address,
                'company_mobile'      => $faker->phoneNumber,
                'representer_name'    => $faker->name,
                'representer_mobile'  => $faker->phoneNumber,
                'designer_id'         => rand(1, 3), // ensure these exist
                'printer_id'          => rand(1, 3),

                'services'            => json_encode($services),
                'items'               => json_encode($items),

                'payment_method'      => $faker->randomElement(['cash', 'card', 'online', 'check']),
                'total_price'         => $total_price,
                'amount_paid'         => $amount_paid,
                'discount'            => $discount,
                'amount_due'          => $amount_due,
                'state'               => $faker->randomElement(['placed', 'designed', 'Ready', 'failed', 'canceled']),
                'remarks'             => $faker->sentence,
            ]);
        }
    }
}
