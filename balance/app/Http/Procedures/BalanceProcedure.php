<?php

declare(strict_types = 1);

namespace App\Http\Procedures;

use App\Models\User;
use Illuminate\Http\Request;
use Sajya\Server\Procedure;

class BalanceProcedure extends Procedure
{

    /**
     * The name of the procedure that will be
     * displayed and taken into account in the search
     *
     * @var string
     */
    public static string $name = 'balance';

    /**
     * @param Request $request
     * @return mixed
     */
    public function userBalance(Request $request)
    {
        $user = User::getByEmail($request->email)->first();
        return $user->currentBalanceHistory()->balance;
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function history(Request $request)
    {
        $user = User::getByEmail($request->email)->first();
        return $user->sortedBalanceHistory();
    }
}
