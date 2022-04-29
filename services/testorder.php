<?php 

/*$api = new Api('rzp_live_aVjyVBEPSCkf4I', 'a4Nz5PlBmYilpsYya7kaSDD9');

$api->order->create(array('receipt' => '123', 'amount' => 100, 'currency' => 'INR', 'notes'=> array('key1'=> 'value3','key2'=> 'value2'))); */

require('config.php');
require('razorpay-php/Razorpay.php');
session_start();
use Razorpay\Api\Api;
$api = new Api('rzp_live_aVjyVBEPSCkf4I', 'a4Nz5PlBmYilpsYya7kaSDD9');
$orderData = [
    'receipt'         => 3456,
    'amount'          => 10 * 100,
    'currency'        => 'INR',
    'payment_capture' => 1
];
$razorpayOrder = $api->order->create($orderData);
$razorpayOrderId = $razorpayOrder['id'];

echo $razorpayOrderId; 
