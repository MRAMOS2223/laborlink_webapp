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
                'profilePic' => 'https://demos.themeselection.com/sneat-vuetify-vuejs-admin-template/demo-1/assets/avatar-2-e08c0d9d.png',
                'messages' => [],
                'receiver_id' => ''
            ];

            $userDetailDocument = $this->firestoreDB->collection('users')
            ->document($user->id())
            ->snapshot();

            $output['name'] = $userDetailDocument->data()["name"];

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
