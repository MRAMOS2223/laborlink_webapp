<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Contract\Firestore;

class SubscribersController extends Controller
{
    protected $firestoreDB;
    public function __construct()
    {
        $this->firestoreDB = app('firebase.firestore')->database();
    }
    public function index(Request $request)
    {
        $subscribers = [];
        $documents = $this->firestoreDB->collection('subscribers')->orderBy("created_on", "DESC")->documents();

        foreach ($documents as $document) {
            $subscriberDocuments = $this->firestoreDB->collection('employers')->where("email_address", "==", $document->data()["employer_email_address"])->documents();

            foreach ($subscriberDocuments as $subscriberDocument) {
                $tempSubscriberDocument = $subscriberDocument->data();

                $tempSubscriberDocument["duration"] = $document["duration"];
                $tempSubscriberDocument["plan"] = $document["plan"];
                $tempSubscriberDocument["premium_plan_starting_date"] = $document["premium_plan_starting_date"];
                $tempSubscriberDocument["premium_plan_ending_date"] = $document["premium_plan_ending_date"];
                $tempSubscriberDocument["monthly_payment"] = $document["monthly_payment"];
                $tempSubscriberDocument["id"] = $document["id"];
                $tempSubscriberDocument["status"] = $document["is_cancelled"] == "true" ? 'Cancelled' : 'Subscribed';
                array_push($subscribers, $tempSubscriberDocument);
            }

        }
        $response = [
            'data' => $subscribers,
            'success' => true,
            'message' => 'Subscribers data is successfully fetched!',
        ];

        return response($response, 200);
    }
}
