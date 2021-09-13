<?php

namespace Database\Seeders;

use App\Models\BalanceHistory;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class BalanceHistorySeeder extends Seeder
{

    /**
     * @return void
     */
    public function run()
    {
        $user = User::getByEmail('test@test.com');
        $history = $user->currentBalanceHistory();
        $created_at = $history->created_at['date'];

        for ($i = 0; $i < 40; $i++) {
            $randomBool = rand(true, false) == true;
            $value = rand(0, 10000) / 10;

            if ($randomBool) {
                $balance = $history->balance + $value;
                $history = $user->balanceHistory()
                    ->create(compact('balance', 'value', 'created_at'));
                $created_at = $this->getRandomPaymentDate($history->created_at['date']);
            } else {
                if ($history->balance >= $value) {
                    $balance = $history->balance - $value;
                    $history = $user->balanceHistory()
                        ->create(compact('balance', 'value', 'created_at'));
                    $created_at = $this->getRandomPaymentDate($history->created_at['date']);
                }
            }

        }
    }

    private function getRandomPaymentDate($from): Carbon
    {
        return Carbon::parse($from)
            ->addWeeks(rand(1, 3))
            ->addDays(rand(1, 6))
            ->addMinutes(rand(720, 1440))
            ->addSeconds(rand(0, 60));
    }
}
