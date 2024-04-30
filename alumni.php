<?php
require '../vendor/vendor/autoload.php';

use Aws\Ses\SesClient;
use Aws\Exception\AwsException;

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    // Script accessed directly without form submission
    $response = array('message' => 'Invalid request.');
    echo json_encode($response);
    exit;
}

$config = require '../vendor/config.php';

$awsKey = $config['aws']['key'];
$awsSecret = $config['aws']['secret'];
$awsRegion = $config['aws']['region'];

$sesClient = new SesClient([
    'version' => 'latest',
    'region' => $awsRegion,
    'credentials' => [
        'key' => $awsKey,
        'secret' => $awsSecret,
    ],
]);
// Get form data
$name = $_POST['name'];
$f_name = $_POST['father_name'];
$u_email = $_POST['email'];
$mobile = $_POST['mobile'];
$course = $_POST['course'];

$year = $_POST['year'];
$position = $_POST['position'];

$address = $_POST['address'];

// Set up email headers
$headers = "From: www.jenneysedu.in" . "\r\n" .
           "Reply-To: $u_email" . "\r\n" ;

// Set up email content
$subject = 'Alumni Enquiry Form the Website';
$message = "Name: $name\nFather Name: $f_name\nEmail: $u_email\nPhone Number: $mobile\nCourse: $course\nYear Passed Out: $year\nPosition: $position\nAddress: $address";

$senderEmail = 'asquaremailer@gmail.com';
//jcetrichy@gmail.com
$recipientEmail = 'elavarasan5193@gmail.com';

error_reporting(E_ALL);
ini_set('display_errors', 1);

try {
    $result = $sesClient->sendEmail(['Destination' => [
        'ToAddresses' => [$recipientEmail],
    ],
    'Message' => [
        'Body' => [
            'Text' => [
                'Charset' => 'UTF-8',
                'Data' => $message,
            ],
        ],
        'Subject' => [
            'Charset' => 'UTF-8',
            'Data' => $subject,
        ],
    ],
    'Source' => $senderEmail,
    'ReplyToAddresses' => [$u_email], // Specify Reply-To header

]);

// Prepare JSON response
$response = "Email sent successfully";
echo $response;
} catch (AwsException $e) {
// Prepare JSON error response
$response = "Email not sent, Please contact support";
echo $response;
}
?>
