<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StatementController extends Controller
{
    public function statement(Request $request){
        $deposits = DB::table('deposits')
            ->select('id', DB::raw('"Deposit" as type'), 'amount', 'created_at')
            ->where('user_id', Auth::user()->id);

        $withdrawals = DB::table('withdrawals')
            ->select('id', DB::raw('"Withdrawal" as type'), DB::raw('-amount as amount'), 'created_at')
            ->where('user_id', Auth::user()->id);

        $sentTransfers = DB::table('transfers')
            ->select('id', DB::raw('"Transfer Sent" as type'), DB::raw('-amount as amount'), 'created_at')
            ->where('sender_user_id', Auth::user()->id);

        $receivedTransfers = DB::table('transfers')
            ->select('id', DB::raw('"Transfer Received" as type'), 'amount', 'created_at')
            ->where('recipient_user_id', Auth::user()->id);

        $transactions = $deposits
            ->union($withdrawals)
            ->union($sentTransfers)
            ->union($receivedTransfers)
            ->orderBy('created_at', 'desc')
            ->get();
        return view('statement', compact('transactions'));
    }
}
