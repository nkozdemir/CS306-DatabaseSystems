<?php

    include "dbconfig.php";

    $url = $_SERVER['REQUEST_URI'];
        
    $url_components = parse_url($url);

    parse_str($url_components['query'], $params);

    if(isset($_POST['subject']) && isset($_POST['message']) && isset($params['sender'])) {
        $subject = $_POST['subject'];
        $message = $_POST['message'];
        $sender = $params['sender'];
        $receiver = "Admin";

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
    
    header("Location: http://localhost/project/message_client.php");
    exit();

?>