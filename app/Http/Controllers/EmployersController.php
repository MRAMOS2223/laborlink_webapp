<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Contract\Firestore;

class EmployersController extends Controller
{
    protected $firestoreDB;
    public function __construct()
    {
        $this->firestoreDB = app('firebase.firestore')->database();
    }
    public function index(Request $request)
    {
        $employers = [];
        $documents = $this->firestoreDB->collection('employers')->documents();

        foreach ($documents as $document) {
            array_push($employers, $document->data());
        }

        $response = [
            'data' => $employers,
            'success' => true,
            'message' => 'Employers data is successfully fetched!',
        ];

        return response($response, 200);
    }
}
