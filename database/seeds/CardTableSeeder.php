<?php

use Illuminate\Database\Seeder;

use App\Card;

class CardTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $suits = ['spades', 'hearts', 'clubs', 'diamonds'];
        $values = range(2, 10);
        $values[] = 'jack';
        $values[] = 'queen';
        $values[] = 'king';
        $values[] = 'ace';

        foreach($suits as $suit) {
            foreach($values as $value) {
                Card::create([
                    'suit' => $suit,
                    'value' => $value,
                    'readable' => ucfirst($value) . ' of ' . ucfirst($suit),
                ]);

            }
        }

    }
}
