<?php

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    // Script accessed directly without form submission
    $response = array('message' => 'Invalid request.');
    echo json_encode($response);
    exit;
}


// Get form data
$name = $_POST['name'];
$dob = $_POST['dob'];
$father_name = $_POST['father_name'];
$mother_name = $_POST['mother_name'];
$religion = $_POST['religion'];
$community = $_POST['community'];
$caste = $_POST['caste'];
$scourse = $_POST['scourse'];
$sslc_obtained = $_POST['sslc_obtained'];
$sslc_total = $_POST['sslc_total'];
$sslc_passing = $_POST['sslc_passing'];
$hsc_obtained = $_POST['hsc_obtained'];
$hsc_total = $_POST['hsc_total'];
$hsc_passing = $_POST['hsc_passing'];
$ug_subject = $_POST['ug_subject'];
$ug_total = $_POST['ug_total'];
$ug_obtained = $_POST['ug_obtained'];
$ug_passing = $_POST['ug_passing'];
$ug_percentage = $_POST['ug_percentage'];
$pg_total = $_POST['pg_total'];
$pg_subject = $_POST['pg_subject'];
$pg_obtained = $_POST['pg_obtained'];
$pg_percentage = $_POST['pg_percentage'];
$pg_passing = $_POST['pg_passing'];

$mobile = $_POST['mobile'];
$email = $_POST['email'];
$address = $_POST['address'];

// Set up email headers
$headers = "From: www.jenneysedu.in" . "\r\n" .
           "Reply-To: $u_email" . "\r\n" ;

// Set up email content
$subject = 'New Application Form the Website from '.$name;
$message = 
"Name: $name\n
DOB: $dob\n
Father Name: $father_name\n
Mother Name: $mother_name\n
Religion: $religion\n
Community: $community\n
Caste: $caste\n
Course Selected: $scourse\n
SSLC Obtained Marks: $sslc_obtained\n
SSLC Total: $sslc_total\n
SSLC Passing Year: $sslc_passing\n
HSC Obtained Marks: $hsc_obtained\n
HSC Total: $hsc_total\n
HSC Year of Passing: $hsc_passing\n
UG Subject: $ug_subject\n
UG Obtained: $ug_obtained\n
UG Total: $ug_total\n
UG Percentage: $ug_percentage\n
UG Passing Year: $ug_passing\n
PG Subject: $pg_subject\n
PG Obtained: $pg_obtained\n
PG Total: $pg_total\n
PG Percentage: $pg_percentage\n
PG Passing Year: $pg_passing\n

Mobile: $mobile\n
Email: $email\n
Address: $address\n
";




error_reporting(E_ALL);
ini_set('display_errors', 1);

if (mail('jcetrichy@gmail.com', $subject, $message, $headers)) {
    // Email sent successfully
    $response = array('message' => 'Application sent successfully!');
    echo json_encode($response);
} else {
    // Failed to send email
    $response = array('message' => 'Failed to send Application, Please try again.');
    echo json_encode($response);
    echo "Error: " . error_get_last()['message'];
}
?>
