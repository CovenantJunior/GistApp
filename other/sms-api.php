<?php
//Send
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://d7networks.com/api/verifier/send",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => array('mobile' => '+2348154140492','sender_id' => 'SMSINFO','message' => 'Your otp code is {654676}','expiry' => '900'),
  CURLOPT_HTTPHEADER => array(
    "Authorization: Token {06182c60cc1929478d084a63ef56e2cb6513f4de}"
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;
?>

<?php
 
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => "https://http-api.d7networks.com/send?username=mjrz7550&password=UU8RThRs
                  &dlr-method=POST&dlr-url=https://4ba60af1.ngrok.io/receive&dlr=yes&dlr-level=3&to=2348154140492
                  &from=smsinfo&content=This%20is%20the%20sample%20content%20sent%20to%20test%20",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
));
$response = curl_exec($curl);
curl_close($curl);
echo $response;

?>

<?php
/*
//Verify
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://d7networks.com/api/verifier/verify",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => array('otp_id' => 'b6ed371c-b25b-4669-b636-23f2be3fa0a8','otp_code' => '702720'),
  CURLOPT_HTTPHEADER => array(
    "Authorization: Token 06182c60cc1929478d084a63ef56e2cb6513f4de"
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;
*/
?>



<?php
/*
//Resend
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://d7networks.com/api/verifier/resend",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => array('otp_id' => 'e8304abf-cbe1-4986-a560-91714d70c72d'),
  CURLOPT_HTTPHEADER => array(
    "Authorization: Token 06182c60cc1929478d084a63ef56e2cb6513f4de"
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;
*/
?>