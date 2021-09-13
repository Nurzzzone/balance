<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class BalanceSeeder extends Seeder
{
    protected const INIT_BALANCE = 1000.0;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'email' => 'test@test.com',
            'password' => Hash::make('123456'),
            'username' => 'username'
        ]);

        $user->balanceHistory()->create([
            'value' => self::INIT_BALANCE,
            'balance' => self::INIT_BALANCE,
            'created_at' => Carbon::today()->subYears(3)
        ]);
    }
}
