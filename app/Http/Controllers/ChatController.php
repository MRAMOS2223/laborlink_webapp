<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;
use Kreait\Firebase\Contract\Firestore;
use Carbon\Carbon;
use DateTimeZone;

class ChatController extends Controller
{
    protected $firestoreDB;
    public function __construct()
    {
        $this->firestoreDB = app('firebase.firestore')->database();
    }
    public function getChatList(Request $request)
    {   
        $adminId = 'BYqNI3olHYS4VeX1ifYUcDbBJzr1';
        $chats = [];
        $usersDocument = $this->firestoreDB->collection('users')
            ->document($adminId)
            ->collection('my_users')
            ->documents();

        foreach ($usersDocument as $user) {
            $output = [
                'id' => $user->id(),
                'name'=> '',
                'profilePic' => '',
                'messages' => [],
                'receiver_id' => ''
            ];

            $userDetailDocument = $this->firestoreDB->collection('users')
            ->document($user->id())
            ->snapshot();

            $output['name'] = $userDetailDocument->data()["name"];

            $output['profilePic'] = $userDetailDocument->data()["user_type"] == 'Applicant' ? 'https://firebasestorage.googleapis.com/v0/b/labor-link-f9424.appspot.com/o/app_image_assets%2Fpngwing.com.png?alt=media&token=ab84abf3-f915-4422-a711-00314197b9ae' : 'https://firebasestorage.googleapis.com/v0/b/labor-link-f9424.appspot.com/o/company_images%2Fdefault-company-avatar-removebg-preview.png?alt=media&token=a3649b8b-5034-406c-95b0-2d289e558be2';

            $messagesDocuments = $this->firestoreDB->collection('chats')
            ->document($adminId.'_'.$user->id())
            ->collection('messages')
            ->documents();

            if(count(iterator_to_array($messagesDocuments)) > 0){
                foreach ($messagesDocuments as $messageDocument) {
                    $messageData = [
                        "id" => $messageDocument->id(),
                        "text" => $messageDocument->data()["msg"],
                        "sentByMe" => $messageDocument->data()["fromId"] == $adminId ? true : false
                    ];
                    
                    $output['receiver_id'] = $adminId.'_'.$user->id();
                    array_push($output['messages'], $messageData);
                }
            }
            else{
                $otherMessagesDocuments = $this->firestoreDB->collection('chats')
                ->document($user->id().'_'.$adminId)
                ->collection('messages')
                ->documents();
                foreach ($otherMessagesDocuments as $otherMessageDocument) {
                    $messageData = [
                        "id" => $otherMessageDocument->id(),
                        "text" => $otherMessageDocument->data()["msg"],
                        "sentByMe" => $otherMessageDocument->data()["fromId"] == $adminId ? true : false
                    ];

                    $output['receiver_id'] = $user->id().'_'.$adminId;
                    array_push($output['messages'], $messageData);
                }   
            }

            array_push($chats, $output);
        }

        $response = [
            'data' => $chats,
            'success' => true,
            'message' => 'Chat data is successfully fetched!',
        ];

        return response($response, 200);
    }

    public function insertChatMessage(Request $request){
        $currentDateTime = Carbon::now('Asia/Shanghai')->addHours(15);
        $timestampShanghai = $currentDateTime->timestamp * 1000 + (int) ($currentDateTime->micro / 1000);
        $currentTimestamp = strval($timestampShanghai);

        $chatMessage = $request->input('message');
        $id = $request->input('id');
        $receiver = $request->input('receiver');
        
        $messagePayload = [
            'fromId' => 'BYqNI3olHYS4VeX1ifYUcDbBJzr1',
            'msg' => $chatMessage,
            'read' => null,
            'sent'=> $currentTimestamp,
            'toId' => $receiver,
            'type' => 'text'
        ];

        $this->firestoreDB->collection('chats')
            ->document($id)
            ->collection('messages')
            ->document($currentTimestamp)
            ->set($messagePayload);

        $response = [
            'data' => [
                'message' => $chatMessage,
                'time' => $currentTimestamp,
            ],
            'success' => true,
            'message' => 'Chat has been successfully sent!',
        ];

        return response($response, 200);
    }
}
