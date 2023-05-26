<?php

namespace App\Http\Controllers;

use App\Models\TransactionHeader;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function showTransactions()
    {
        $transactions = TransactionHeader::with(["transactionDetails", "location", "user"])->get();
        return view("transactions")
            ->with("transactions", $transactions);
    }

    public function doPickup($transaction_id)
    {
        $transaction_id = intval($transaction_id);
        $transaction = TransactionHeader::find($transaction_id);
        $transaction->isPicked = true;
        $transaction->save();
        return redirect()->back();
    }
}
