<?php 
    require '../config/init.php';
    if(isset($_POST)){
        $email = $_POST['email'];
        $subscriber = new Subscriber();
        $success = $subscriber->addEmail($email);
        if($success){
            redirect('../');
        } else {
            redirect('../');
        }
    } else {
            redirect('../');
    }
