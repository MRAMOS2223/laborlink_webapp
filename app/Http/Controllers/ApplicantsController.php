<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Contract\Firestore;

class ApplicantsController extends Controller
{
    protected $firestoreDB;
    public function __construct()
    {
        $this->firestoreDB = app('firebase.firestore')->database();
    }
    public function index(Request $request)
    {
        $applicants = [];
        $documents = $this->firestoreDB->collection('applicants')->documents();

        foreach ($documents as $document) {
            if ($document->data()["email_address"] != "admin@laborlink.site")
                array_push($applicants, $document->data());
        }

        $response = [
            'data' => $applicants,
            'success' => true,
            'message' => 'Applicants data is successfully fetched!',
        ];

        return response($response, 200);
    }
}
