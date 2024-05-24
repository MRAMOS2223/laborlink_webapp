<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Contract\Firestore;

class IDVerificationController extends Controller
{
    protected $firestoreDB;
    public function __construct()
    {
        $this->firestoreDB = app('firebase.firestore')->database();
    }
    public function index(Request $request)
    {
        $ids = [];
        $users = [];
        $documents = $this->firestoreDB->collection('id_verifications')->documents();

        foreach ($documents as $document) {
            $allIDForVerification = [];

            if($document->data()['user_type'] == "employer"){
                $employerDocuments = $this->firestoreDB->collection('employers')->where("email_address", "==", $document->data()["email_address"])->documents();

                foreach ($employerDocuments as $employerDocument) {
                    $allIDForVerification["id"] = $employerDocument->id();
                    $allIDForVerification['user_name'] = $employerDocument->data()["employer_name"];
                    $allIDForVerification['field'] = $employerDocument->data()["industry"];
                    $allIDForVerification["logo"] = $employerDocument->data()["logo_url"];
                    $allIDForVerification["location"] = $employerDocument->data()["employer_address"];
                }

            }else{
                $applicantDocuments = $this->firestoreDB->collection('applicants')->where("email_address", "==", $document->data()["email_address"])->documents();

                foreach ($applicantDocuments as $applicantDocument) {
                    $allIDForVerification["id"] = $applicantDocument->id();
                    $allIDForVerification['user_name'] = $applicantDocument->data()["full_name"];
                    $allIDForVerification['field'] = $applicantDocument->data()["job_role"];
                    $allIDForVerification["logo"] = $applicantDocument->data()["profile_url"];
                    $allIDForVerification["location"] = $applicantDocument->data()["address"];
                }
            }

            $allIDForVerification['file_name'] = $document->data()["file_name"];
            $allIDForVerification['link'] = $document->data()["link"];
            $allIDForVerification['id_type'] = $document->data()["id_type"];
            array_push($ids, $allIDForVerification);
        }

        for($i = 0; $i < count($ids); $i++){
            $user = [
                "user_name" => $ids[$i]["user_name"],
                "field" => $ids[$i]["field"],
                "logo" => $ids[$i]["logo"],
                "location" => $ids[$i]["location"],
                "ids" => []
            ];

            $pos = array_search($ids[$i]["user_name"], array_column($users, 'user_name'));

            if($pos !== false){
                $idSet = [
                    "file_name" =>  $ids[$i]["file_name"],
                    "link" =>  $ids[$i]["link"],
                    "id_type" =>  strtoupper(substr($ids[$i]["id_type"],0, 1)).substr($ids[$i]["id_type"],1)
                ];

                array_push($users[$pos]["ids"], $idSet);
            }else{
                $idSet = [
                    "file_name" =>  $ids[$i]["file_name"],
                    "link" =>  $ids[$i]["link"],
                    "id_type" =>  strtoupper(substr($ids[$i]["id_type"],0, 1)).substr($ids[$i]["id_type"],1)
                ];

                array_push($user["ids"], $idSet);
                array_push($users, $user);
            }
            
        }

        $response = [
            'data' => $users,
            'success' => true,
            'message' => 'Users ID are successfully fetched!',
        ];

        return response($response, 200);
    }
}
