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

        $documents = $this->firestoreDB->collection('applicants')->documents();

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

    public function getRejectedCount(Request $request)
    {
        $data = 0;

        $documents = $this->firestoreDB->collection('job_applications')->documents();

        foreach ($documents as $document) {
            if ($document->data()["status"] == "Rejected")
                $data++;
        }

        $response = [
            'data' => $data,
            'success' => true,
            'message' => 'Rejected applicant count is successfully fetched!',
        ];

        return response($response, 200);
    }

    public function getCompaniesCount(Request $request)
    {
        $data = 0;

        $documents = $this->firestoreDB->collection('employers')->documents();

        foreach ($documents as $document) {
            $data++;
        }

        $response = [
            'data' => $data,
            'success' => true,
            'message' => 'Companies count is successfully fetched!',
        ];

        return response($response, 200);
    }

    public function getInterviewedCount(Request $request)
    {
        $data = 0;

        $documents = $this->firestoreDB->collection('job_applications')->documents();

        foreach ($documents as $document) {
            $data++;
        }

        $response = [
            'data' => $data,
            'success' => true,
            'message' => 'Interviewed count is successfully fetched!',
        ];

        return response($response, 200);
    }

    public function getProfileStrength(Request $request)
    {
        $data = [
            "hired" => [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
            "rejected" => [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
            "ongoing" => [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
        ];

        $hiredCount = 0;
        $rejectedCount = 0;
        $ongoingCount = 0;

        $documents = $this->firestoreDB->collection('job_applications')->documents();

        foreach ($documents as $document) {
            if ($document->data()["status"] == "Hired") {
                $intMonth = (int) date("m", strtotime($document->data()["application_date"]));
                $hiredCount++;
                $data["hired"][$intMonth - 1] = $hiredCount;
            } else if ($document->data()["status"] == "Rejected") {
                $intMonth = (int) date("m", strtotime($document->data()["application_date"]));
                $rejectedCount++;
                $data["rejected"][$intMonth - 1] = $rejectedCount;
            } else {
                $intMonth = (int) date("m", strtotime($document->data()["application_date"]));
                $ongoingCount++;
                $data["ongoing"][$intMonth - 1] = $ongoingCount;
            }
        }

        $response = [
            'data' => $data,
            'success' => true,
            'message' => 'Profile Strength is successfully fetched!',
        ];

        return response($response, 200);
    }
}
