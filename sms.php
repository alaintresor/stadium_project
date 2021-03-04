<?php 

// $phone = "+250789733274";
// $message= "Gate system Welcome message goes here..";
//  $curl = curl_init();
// curl_setopt_array($curl, array(
//   CURLOPT_URL => 'https://api.mista.io/sms',
//   CURLOPT_RETURNTRANSFER => true,
//   CURLOPT_ENCODING => '',
//   CURLOPT_MAXREDIRS => 10,
//   CURLOPT_TIMEOUT => 0,
//   CURLOPT_FOLLOWLOCATION => true,
//   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//   CURLOPT_CUSTOMREQUEST => 'POST',
//   CURLOPT_POSTFIELDS => array('to' => $phone,'from' => 'SmarTicket','unicode' => '0','sms' => $message,'action' => 'send-sms'),
//   CURLOPT_HTTPHEADER => array(
//     'x-api-key:andrass7'
//   ),
// ));

// $response = curl_exec($curl);

// curl_close($curl);
// echo $response;
$res1['telephone']='0780640237';
$phone = "+25".$res1['telephone'];
$message= "Gate ".$res1['telephone']." system Welcome message goes here..";
$num = rand(9999999,100000);
$tckCode="RNTC".$num;
echo $tckCode;
?>