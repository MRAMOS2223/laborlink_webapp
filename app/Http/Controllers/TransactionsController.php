<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Contract\Firestore;

class TransactionsController extends Controller
{
    protected $firestoreDB;
    public function __construct()
    {
        $this->firestoreDB = app('firebase.firestore')->database();
    }
    public function index(Request $request)
    {
        $transactions = [];
        $documents = $this->firestoreDB->collection('transactions')->documents();

        foreach ($documents as $document) {
            array_push($transactions, $document->data());
        }

        $response = [
            'data' => $transactions,
            'success' => true,
            'message' => 'Transactions data is successfully fetched!',
        ];

        return response($response, 200);
    }
}
