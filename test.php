<?php




function CheckUser($login, $password){
    $users = array(
        "root" => "root",
        "andrey" => "1234"
    );

    if ($users[$login] === $password){
        
        return true;
        
    } else {
        return false;
    }
    
  
}

function SeeMessages(){
    if (file_exists('messages.json')){
        $string = file_get_contents('messages.json');
        $messages =  json_decode($string, true);
        
        foreach ($messages as $message){
            echo $message[login] . ": " . $message[message] . "<br/>";
        }
    } 
}

function SaveMessage($login, $text){


    $message = array(
        "login" => $login,
        "message" => $text,
        "date" => date('d.m.Y h:i:s')
    );

    if (!file_exists('messages.json')){
        $file = fopen('messages.json', "a");
        $newMessages[] = $message;
        fputs($file, json_encode($newMessages));
    } else {
        $string = file_get_contents('messages.json');
        $file = fopen('messages.json', "w");
        $oldMessages =  json_decode($string, true);
        array_push($oldMessages, $message);
        $newMessages = json_encode($oldMessages, JSON_UNESCAPED_UNICODE);
        fputs($file, $newMessages);
    }
}

function Main(){
    $login = $_GET['login'];
    $password = $_GET['password'];
    
    
    
    
    if (CheckUser($login, $password)){
        $text = $_GET['message'];
        if (isset($text)){
            SaveMessage($login, $text);
        }
    } else {
        echo "Пара логин-пароль не существует <br/>";
    }
    
    SeeMessages();
}


Main();

?>


