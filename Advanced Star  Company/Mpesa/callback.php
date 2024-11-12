<?php

echo '<a href="homepage.html">Home<br/></a>';
$content = file_get_contents('php://input');
$res = json_decode($content, true);
$dataToLog = array(
    date("Y-m-d H:i:s"),
    "MerchantRequestID: ".$res['Body']['stkCallback']['MerchantRequestID'],
    "CheckoutRequestID: ".$res['Body']['stkCallback']['CheckoutRequestID'],
    "ResultCode: ".$res['Body']['stkCallback']['ResultCode'],
    "ResultDesc: ".$res['Body']['stkCallback']['ResultDesc'],
);

$data = implode(" - ", $dataToLog);
$data = PHP_EOL;
file_put_contents('transaction_log', $data, FILE_APPEND);//Logs the data ino transaction_log
//Saving of data into our database
$conn = new PDO("mysql:host=localhost;dbname=mpesa","root");
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$stmt = $conn->query("SELECT * FROM orders ORDER BY ID DESC LIMIT 1");
$stmt->execute();
$stmt = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach($rows as $row){
    $ID = $row['ID'];

    if($res['Body']['stkCallback']['ResultCode'] == '1032'){
        $sql = $conn->query("UPDATE `orders` SET `Status` = 'CANCELLED' WHERE `orders`.`ID` = $ID");
        $rs = $sql->execute();
    }else{
        $sql = $conn->query("UPDATE `orders` SET `Status` = 'SUCCESS' WHERE `orders`.ID = $ID");
        $rs = $sql->execute();
    }
    if($rs){
        file_put_contents('error_log', "Records Inserted", FILE_APPEND);;
    }else{
        file_put_contents('error_log',"Failed to Insert Records", FILE_APPEND);
    }
}
