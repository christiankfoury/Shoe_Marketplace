<?php
namespace app\controllers;

class Message extends \app\core\Controller {

    #[\app\filters\Login]
    public function index(){
        $messagesReceived = new \app\models\Message();
        $messagesReceived->receiver = $_SESSION["username"];
        $messagesReceived = $messagesReceived->getMessagesByReceiver($_SESSION["username"]);
        $messagesSent = new \app\models\Message();
        $messagesSent->sender = $_SESSION["username"];
        $messagesSent = $messagesSent->getMessagesBySender($_SESSION["username"]);
        $this->view('Message/inbox',["inbox"=>$messagesReceived,"outbox"=>$messagesSent]);
    }

    #[\app\filters\Login]
    public function createMessage($sender,$receiver){
        if(isset($_POST['action'])){
            $message = new \app\models\Message();
            $message->sender = $sender;
            $message->receiver = $receiver;
            $message->message = $_POST['message'];
            $message->insert();
            header("location:/Message/index");
        }
        else{
            $message = new \app\models\Message();
            $message->sender = $sender;
            $message->receiver = $receiver;
            $this->view('Message/sendMessage',$message);
        }
    }

    #[\app\filters\Login]
    public function readMessage($message_id){
        $message = new \app\models\Message();
        $message = $message->get($message_id);
        if($message->read_status == "unread" || $message->read_status == "to_reread"){
            $message->read_status = "read";
            $message->update();
        }
        $this->view('Message/readMessage',$message);
    }

    #[\app\filters\Login]
    public function toRereadMessage($message_id){
        $message = new \app\models\Message();
        $message = $message->get($message_id);
        $message->read_status = "to_reread";
        $message->update();

        $profile = new \app\models\Profile();
        $profile = $profile->get($message->receiver);
        header("location:/Profile/inbox");
    }

    #[\app\filters\Login]
    public function deleteMessage($message_id){
        $message = new \app\models\Message();
        $message = $message->get($message_id);
        $profile = new \app\models\Profile();
        $profile = $profile->get($message->sender);

        $message->delete();
        header("location:/Profile/outbox");
    }
}