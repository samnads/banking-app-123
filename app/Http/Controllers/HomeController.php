<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home(Request $request){
        $account = User::with([
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
        ])
        ->where('id',Auth::user()->id)
        ->first();
        $data = [
            'total_deposits' => $account->deposits->first()->total_deposits ?? 0,
            'total_withdrawals' => $account->withdrawals->first()->total_withdrawals ?? 0,
            'total_transfers_sent' => $account->sentTransfers->first()->total_sent ?? 0,
            'total_transfers_received' => $account->receivedTransfers->first()->total_received ?? 0
        ];
        $data['balance'] = $data['total_deposits'] + $data['total_transfers_received'] - $data['total_withdrawals'] - $data['total_transfers_sent'];
        return view('dashboard', $data);
    }
}
