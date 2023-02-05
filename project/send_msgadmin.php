<?php

    include "dbconfig.php";
  
    if (isset($_POST['message']) && isset($_POST['receiverid'])) {
        $subject = $_POST['subject'];
        $message = $_POST['message'];
        $sender = "Admin";
        $receiver = $_POST["receiverid"];

        $post_data = [
            'subject' => $subject,
            'message'=> $message,
            'sender' => $sender,
            'receiver' => $receiver,
            'time' => date('jS F Y h:i:s A'),
        ];
        $ref_table = "messages";
        $postRef_result = $database->getReference($ref_table)->push($post_data);
    }

    header("Location: message_admin.php");
    exit();
    
?>