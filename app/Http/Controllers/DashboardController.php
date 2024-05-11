<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Contract\Firestore;

class DashboardController extends Controller
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

    public function getHireCount(Request $request)
    {
        $data = 0;

        $documents = $this->firestoreDB->collection('job_applications')->documents();

        foreach ($documents as $document) {
            if ($document->data()["status"] == "Hired")
                $data++;
        }

        $response = [
            'data' => $data,
            'success' => true,
            'message' => 'Hire count is successfully fetched!',
        ];

        return response($response, 200);
    }

    public function getJobPostingsCount(Request $request)
    {
        $data = 0;

        $documents = $this->firestoreDB->collection('jobs')->documents();

        foreach ($documents as $document) {
            $data++;
        }

        $response = [
            'data' => $data,
            'success' => true,
            'message' => 'Job posting count is successfully fetched!',
        ];

        return response($response, 200);
    }

    public function getApplicantsCount(Request $request)
    {
        $data = 0;

        $documents = $this->firestoreDB->collection('job_applications')->documents();

        foreach ($documents as $document) {
            $data++;
        }

        $response = [
            'data' => $data,
            'success' => true,
            'message' => 'Applicant count is successfully fetched!',
        ];

        return response($response, 200);
    }

    public function getMonthlyEarnings(Request $request)
    {
        $data = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

        $documents = $this->firestoreDB->collection('transactions')->documents();

        foreach ($documents as $document) {
            $intMonth = (int) date("m", strtotime($document->data()["transaction_datetime"]));

            $data[$intMonth - 1] = floatval($document->data()["amount_paid"]);
        }

        $response = [
            'data' => $data,
            'success' => true,
            'message' => 'Monthly Earnings is successfully fetched!',
        ];

        return response($response, 200);
    }
}
