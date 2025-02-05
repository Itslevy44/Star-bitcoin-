<?php
header("Content-Type:application/json");

    $env="sandbox";
    $type = 4;
    $shortcode = '600988'; 
    $key = ""; //Put your key here
    $secret = "";  //Put your secret here
    $initiatorName = "testapi";
    $initiatorPassword = "Safaricom978!";
    $results_url = "https://mydomain.com/TransactionStatus/result/";
    $timeout_url = "https://mydomain.com/TransactionStatus/queue/"; 

    if (!isset($_GET["transactionID"])) {
        echo "Technical error";
        exit();
    }

    $transactionID = $_GET["transactionID"]; 
    $command = "TransactionStatusQuery";
    $remarks = "Transaction Status Query"; 
    $occasion = "Transaction Status Query";
    $callback = null ;

    
    $access_token = ($env == "live") ? "https://api.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials" : "https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials"; 
    $credentials = base64_encode($key . ':' . $secret); 
    
    $ch = curl_init($access_token);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ["Authorization: Basic " . $credentials]);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
    $response = curl_exec($ch);
    curl_close($ch);
    
    $result = json_decode($response); 

    
    $token = isset($result->{'access_token'}) ? $result->{'access_token'} : "N/A";

    $publicKey = file_get_contents(__DIR__ . "/mpesa_public_cert.cer"); 
    $isvalid = openssl_public_encrypt($initiatorPassword, $encrypted, $publicKey, OPENSSL_PKCS1_PADDING); 
    $password = base64_encode($encrypted);


    $curl_post_data = array( 
        "Initiator" => $initiatorName, 
        "SecurityCredential" => $password, 
        "CommandID" => $command, 
        "TransactionID" => $transactionID, 
        "PartyA" => $shortcode, 
        "IdentifierType" => $type, 
        "ResultURL" => $results_url, 
        "QueueTimeOutURL" => $timeout_url, 
        "Remarks" => $remarks, 
        "Occasion" => $occasion,
    ); 

    $data_string = json_encode($curl_post_data);


    $endpoint = ($env == "live") ? "https://api.safaricom.co.ke/mpesa/transactionstatus/v1/query" : "https://sandbox.safaricom.co.ke/mpesa/transactionstatus/v1/query"; 

    $ch2 = curl_init($endpoint);
    curl_setopt($ch2, CURLOPT_HTTPHEADER, [
        'Authorization: Bearer '.$token,
        'Content-Type: application/json'
    ]);
    curl_setopt($ch2, CURLOPT_POST, 1);
    curl_setopt($ch2, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt($ch2, CURLOPT_RETURNTRANSFER, 1);
    $response     = curl_exec($ch2);
    curl_close($ch2);


    $result = json_decode($response); 
    
    $verified = $result->{'ResponseCode'};
    if($verified === "0"){
        echo "Transaction verified as TRUE";
    }else{
        echo "Transaction doesnt exist";
    }
