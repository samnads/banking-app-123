<?php

namespace App\Http\Controllers;

use App\Models\Withdrawal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WithdrawController extends Controller
{
    public function withdraw(Request $request)
    {
        return view('withdraw', [
            'user' => $request->user(),
        ]);
    }

    public function withdraw_now(Request $request)
    {
        $withdrawal = new Withdrawal;
        $withdrawal->user_id = Auth::id();
        $withdrawal->amount = $request->amount;
        $withdrawal->save();
        return view('withdraw', [
            'user' => $request->user(),
        ]);
    }
}
