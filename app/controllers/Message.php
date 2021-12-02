<?php

namespace app\controllers;

class Message extends \app\core\Controller
{

    #[\app\filters\Login]
    public function index()
    {
        if (isset($_POST['search'])) {
            if ($_POST['searchBox'] == "") {
                header("Location:/User/index");
            } else {
                $search = $_POST['searchBox'];
                header("Location:/User/search/$search");
            }
        } else {
            $messagesReceived = new \app\models\Message();
            $messagesReceived->receiver = $_SESSION["username"];
            $messagesReceived = $messagesReceived->getMessagesByReceiver($_SESSION["username"]);
            $messagesSent = new \app\models\Message();
            $messagesSent->sender = $_SESSION["username"];
            $messagesSent = $messagesSent->getMessagesBySender($_SESSION["username"]);
            $this->view('Message/inbox', ["inbox" => $messagesReceived, "outbox" => $messagesSent]);
        }
    }

    #[\app\filters\Login]
    public function createMessage($sender, $receiver)
    {
        if (isset($_POST['search'])) {
            if ($_POST['searchBox'] == "") {
                header("Location:/User/index");
            } else {
                $search = $_POST['searchBox'];
                header("Location:/User/search/$search");
            }
        } else if (isset($_POST['action'])) {
            $message = new \app\models\Message();
            $message->sender = $sender;
            $message->receiver = $receiver;
            $message->message = $_POST['message'];
            $message->insert();
            header("location:/Message/index");
        } else {
            $message = new \app\models\Message();
            $message->sender = $sender;
            $message->receiver = $receiver;
            $this->view('Message/sendMessage', $message);
        }
    }
}
