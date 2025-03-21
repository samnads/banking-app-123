<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DepositController extends Controller
{
    public function deposit(Request $request)
    {
        /*$account = Auth::user()->with([
            'deposits' => function ($query) {
                $query->selectRaw('user_id, SUM(amount) as total_deposits')->groupBy('user_id');
            },
            'withdrawals' => function ($query) {
                $query->selectRaw('user_id, SUM(amount) as total_withdrawals')->groupBy('user_id');
            },
            'sentTransfers' => function ($query) {
                $query->selectRaw('sender_user_id, SUM(amount) as total_sent')->groupBy('sender_user_id');
            },
            'receivedTransfers' => function ($query) {
                $query->selectRaw('recipient_user_id, SUM(amount) as total_received')->groupBy('recipient_user_id');
            }
        ])->first();
        return response()->json([
            'balance' => $account->balance,
            'total_deposits' => $account->deposits->first()->total_deposits ?? 0,
            'total_withdrawals' => $account->withdrawals->first()->total_withdrawals ?? 0,
            'total_transfers_sent' => $account->sentTransfers->first()->total_sent ?? 0,
            'total_transfers_received' => $account->receivedTransfers->first()->total_received ?? 0
        ]);*/
        return view('deposit', [
            'user' => $request->user(),
        ]);
    }

    public function save_deposit(Request $request)
    {
        $depost = new Deposit;
        $depost->user_id = Auth::id();
        $depost->amount = $request->amount;
        $depost->save();
        return view('deposit', [
            'user' => $request->user(),
        ]);
    }
}
