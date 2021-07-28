<?php

function slack($message)
{
    $ch = curl_init("https://slack.com/api/chat.postMessage");
    $data = http_build_query([
        "token" => "xoxp-444859433459-444859433731-467513186016-c050aa539396b6d57975c68fa3175ad4",
        "channel" => '#atlas-quest-consultatants',
        // "channel" => '#atlas-quest-test-channel',
    	"text" => $message, //"Hello, Foo-Bar channel message.",
        "username" => "Consultant Registration",
        "icon_emoji" => ":man-raising-hand:",
    ]);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}

$firstName=($_POST['firstname']);
$lastName=($_POST['lastname']);
$email=($_POST['email']);
$dob=($_POST['dob']);
$address=($_POST['address']);
$phone=($_POST['phone']);

$work=($_POST['work']);
$relocate=($_POST['relocate']);
$ssn=($_POST['ssn']);
$ed=($_POST['ed']);
$pss=($_POST['pss']);

// respondToUser($firstName, $email);
// sendRequestToSupport($firstName, $lastName, $email, $phone, $message);

$slackMessage =  "```New Consultant Registration \n" . 
                 "Name : " . $firstName . ' ' . $lastName . "\n" . 
                 "DOB : " . $dob . "\n" .
                 "Email: " . $email . "\n" . 
                 "Phone: " . $phone . "\n" .
                 "Address : " . $address . "\n" .
                 "Work Auth: " . $work . "\n" .
                 "Ready to relocate: " . $relocate . "\n" .
                 "SSN : " . $ssn . "\n" .
                 "Education Details : " . $ed . "\n" .
                 "Preferred Skills : " . $pss . "\n```";

slack($slackMessage);
header("Location: index.html?success=true");
exit();
?>