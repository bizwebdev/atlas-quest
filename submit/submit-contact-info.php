<?php

function generateRandomString($length = 7)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= str_shuffle($characters[rand(0, $charactersLength - 1)]);
    }
    return $randomString;
}

function slack($message, $channel, $emailTo)
{
	sendEmail($emailTo);
    $ch = curl_init("https://slack.com/api/chat.postMessage");
    $data = http_build_query([
        "token" => "xoxp-408644872640-409226477107-409230304899-98dda0be71a34e5f9f0e2230c61b38cb",
    	"channel" => $channel, //"#mychannel",
    	"text" => $message, //"Hello, Foo-Bar channel message.",
    	"username" => "ContactUs",
    ]);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $result = curl_exec($ch);
    curl_close($ch);
    
    return $result;
}

function sendEmail($to){
	
	$subject = 'From contact page' ;
	$message = "Thanks for contacting us, will get back to you asap.";

	$headers = 'From: no-reply@atlasquest.com' . PHP_EOL ;
	mail ( $to, $subject, $message, $headers ) ;

}

slack('Got new Contact Request' , '#queries', 'eshu.1505@gmail.com');

?>