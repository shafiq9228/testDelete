<?php ob_start();

ini_set('max_execution_time', -1); 
require "config.php";

extract($_GET);
extract($_POST);
/*date_default_timezone_set('Asia/Kolkata');

require "config.php";
$date = date('Y-m-d');
$datetime = date('Y-m-d h:i:s');

function dateDifference($start_date, $end_date){
    // calulating the difference in timestamps 
    $diff = strtotime($start_date) - strtotime($end_date);
     
    // 1 day = 24 hours 
    // 24 * 60 * 60 = 86400 seconds
    return ceil(abs($diff / 86400));
}

echo "SELECT *  FROM recharges where status = 'Debit' and expiry_date = ( CURDATE() - INTERVAL 2 DAY ) and guid = '".$i."' and expiry_date !='1970-01-01' and expiry_date !='' ";exit;

$row = $db->query("SELECT *  FROM recharges where status = 'Debit' and date_add(expiry_date,interval 2 day) > '$date' and guid = '".$i."' and expiry_date !='1970-01-01' and expiry_date !='' ")->fetch();


$dateDiff = dateDifference('2021-06-17', '2021-06-30');

echo $dateDiff;exit;


$response = '{
"status": "success",
"current_time": "02,Aug,2021 05:16:06 PM", "amount": "10",
"message": "Transaction Processing", "payment_mode": "UPI",
"bank_ref": "6107dafe9793d",
"account": "open.3000032503@icici", "ifsc": null,
"bank": null,
"account_name": "J SARKAR", "payment_type": "UPI",
"txstatus_desc": "Pending",
"order_id": "ZLPO020070088150019005", "biller": "Direct Payout", "callback_status": "Pending",
"timestamp": "2021-08-02 05:16:06pm", "api_mode": "LIVE",
"balance": "9421.07",
"charge": 4.71,
"charged_amount": 14.7,
"your_request": {
"vpa": "open.3000032503@icici", "account_name": "J SARKAR", "agent_id": "ZLPO020070088150019005", "amount": "10",
"email": "zuelpay@gmail.com", "mobile": "9432839941", "remark": "Pizaa To Misti"
},
"tlid": "Z2021080216279047669A82"
}';



$arr = json_decode($response, true);

echo $arr[status]; */



/*$json = "{
    text: 'upi://pay?pa=9866882829@okbizaxis&pn=Catchway%20We…d&mc=7372&aid=uGICAgIC9oOfiNA&tr=BCR2DN6TQWFMLTAP',
    format: 'QR_CODE', 
    cancelled: false
    
}"; 



$arr = json_decode($json, true);


print_r($arr);exit;

$response = str_replace("'",'"',"$json"); 

//echo $response;

echo $response[text]; 

$json = 'upi://pay?pa=paytmqr281005050101119yaeq4t8ux@paytm&pn=Paytm%20Merchant&mc=5499&mode=02&orgid=000000&paytmqr=281005050101119YAEQ4T8UX&sign=MEQCIAIQvRDZNTlvu6VW0sq2ekTbpjM4nLnRtnD1HFqlNfC1AiAge6Lz425B1kcqMMyneJSh6cTpayGPFHsr0DIJgY6h1A=='; 

//$arr = json_decode($json, true);

$a1 = explode("upi://pay?pa=",$json);
echo $a1[1].'<br>';
//echo '<pre>'; print_r($arr);

$upi = explode("&pn=",$a1[1]);

echo $upi[0].'<br>';

$upiname = explode("&",$upi[1]);

$name = str_replace("%20"," ","$upiname[0]"); 

echo $name.'<br>'; */


/*$userid = '783';

$reg = $db->query("SELECT * FROM `register`  where guid = '".$userid."' ")->fetch();

$tb = $db->query("SELECT sum(amount) FROM `transactions`  where userid = '".$userid."' and status = 'Debit' and bill_status = '0'  ")->fetch();

$tc = $db->query("SELECT sum(amount) FROM `transactions`  where userid = '".$userid."' and status = 'Cashback' and bill_status = '0'  ")->fetch();

$tcr = $db->query("SELECT sum(amount) FROM `transactions`  where userid = '".$userid."' and status = 'Credit'  ")->fetch();

$bill = $db->query("SELECT sum(total) FROM `bills`  where userid = '".$userid."' and status = 'Pending'  ")->fetch();

//echo $reg['credit'];exit;
$credit = ($reg['credit']+$tc[0])-$tb[0]-$bill[0];


echo $credit;exit; 


$response ='{
  "data": {
    "if_number": false,
    "otp_sent": false,
    "client_id": "takdTqhCxo"
  },
  "status_code": 422,
  "message": "",
  "success": false,
  "type": "aadhaar_v2_generate"
}';


$arr = json_decode($response, true);


//print_r($arr);
echo $arr[data][client_id];

if($arr['success'] == true){
    
    echo "ok";exit;
}else{
    
    echo "notok";exit;
    
}


$json = 'upi://pay?mode=02&pa=Q705919440@ybl&purpose=00&mc=0000&pn=PhonePeMerchant&orgid=180001&sign=MEUCIGNV7uWcPi0oNxPUi53ziotJ6wMpZPV4BiZGUYQv711wAiEAgIqrbRdlwdFinSdlT56HRGQ68rNWEeoCE+e+2/tJTcw=';


$parts = parse_url($json);
parse_str($parts['query'], $query);

echo $query['pn'];

//$json = "upi://pay?pa=paytmqr281005050101119yaeq4t8ux@paytm&pn=Paytm%20Merchant&mc=5499&mode=02&orgid=000000&paytmqr=281005050101119YAEQ4T8UX&sign=MEQCIAIQvRDZNTlvu6VW0sq2ekTbpjM4nLnRtnD1HFqlNfC1AiAge6Lz425B1kcqMMyneJSh6cTpayGPFHsr0DIJgY6h1A==";
//print_r($json);

$a1 = explode("upi://pay?pa=",$json);

//print_r($a1);

$upi = explode("&pn=",$a1[1]);
//print_r($upi);
$upi_id = $upi[0];
*/

/*$reg = $db->query("SELECT * FROM `register`  where guid = '".$_GET['userid']."' ")->fetch();

$tb = $db->query("SELECT sum(amount) FROM `transactions`  where userid = '".$userid."' and status = 'Debit'  ")->fetch();

$tc = $db->query("SELECT sum(amount) FROM `transactions`  where userid = '".$userid."' and status = 'Cashback'  ")->fetch();


$tcr = $db->query("SELECT sum(amount) FROM `transactions`  where userid = '".$userid."' and status = 'Credit'  ")->fetch();

$int = $db->query ("SELECT sum(interest) FROM `interest` where status = 'Paid' and userid = '".$userid."' ")->fetch();


$credit = ($reg['credit']+$tc[0]+$tcr[0])-$tb[0]-$int[0];


echo $credit;exit; */

/*$response = '{"data": {"client_id": "income_epfo_passbook_saAxOCwgUQnClARWeZXk", "pf_uan": "101249427697", "full_name": "P GOVIND KUMAR", "father_name": "P THYAGARAJU", "dob": "1992-01-04", "companies": {"GRVSP00550680000024520": {"passbook": [{"member_id": "GRVSP00550680000024520", "credit_debit_flag": "C", "doe_epf": "2021-10-24", "doe_eps": "2021-10-24", "doj_epf": "2018-10-08", "office": null, "transaction_approved": "2021-10-24", "transaction_category": "ob_interest", "employee_share": "0", "employer_share": "0", "pension_share": "0", "approved_on": "2018-04-01", "year": "2018", "month": "04", "description": "OB Int. Updated upto 31/03/2018"}, {"member_id": "GRVSP00550680000024520", "credit_debit_flag": "C", "doe_epf": "2021-10-24", "doe_eps": "2021-10-24", "doj_epf": "2018-10-08", "office": null, "transaction_approved": "2021-10-24", "transaction_category": "contribution", "employee_share": "604", "employer_share": "185", "pension_share": "419", "approved_on": "2018-11-14", "year": "2018", "month": "11", "description": "Cont. For Due-Month 112018"}, {"member_id": "GRVSP00550680000024520", "credit_debit_flag": "C", "doe_epf": "2021-10-24", "doe_eps": "2021-10-24", "doj_epf": "2018-10-08", "office": null, "transaction_approved": "2021-10-24", "transaction_category": "contribution", "employee_share": "754", "employer_share": "231", "pension_share": "523", "approved_on": "2018-12-12", "year": "2018", "month": "12", "description": "Cont. For Due-Month 122018"}, {"member_id": "GRVSP00550680000024520", "credit_debit_flag": "C", "doe_epf": "2021-10-24", "doe_eps": "2021-10-24", "doj_epf": "2018-10-08", "office": null, "transaction_approved": "2021-10-24", "transaction_category": "contribution", "employee_share": "705", "employer_share": "216", "pension_share": "489", "approved_on": "2019-01-10", "year": "2019", "month": "01", "description": "Cont. For Due-Month 012019"}, {"member_id": "GRVSP00550680000024520", "credit_debit_flag": "C", "doe_epf": "2021-10-24", "doe_eps": "2021-10-24", "doj_epf": "2018-10-08", "office": null, "transaction_approved": "2021-10-24", "transaction_category": "contribution", "employee_share": "767", "employer_share": "234", "pension_share": "533", "approved_on": "2019-02-12", "year": "2019", "month": "02", "description": "Cont. For Due-Month 022019"}, {"member_id": "GRVSP00550680000024520", "credit_debit_flag": "C", "doe_epf": "2021-10-24", "doe_eps": "2021-10-24", "doj_epf": "2018-10-08", "office": null, "transaction_approved": "2021-10-24", "transaction_category": "contribution", "employee_share": "752", "employer_share": "230", "pension_share": "522", "approved_on": "2019-03-14", "year": "2019", "month": "03", "description": "Cont. For Due-Month 032019"}, {"member_id": "GRVSP00550680000024520", "credit_debit_flag": "C", "doe_epf": "2021-10-24", "doe_eps": "2021-10-24", "doj_epf": "2018-10-08", "office": null, "transaction_approved": "2021-10-24", "transaction_category": "contribution", "employee_share": "755", "employer_share": "231", "pension_share": "524", "approved_on": "2019-04-11", "year": "2019", "month": "04", "description": "Cont. For Due-Month 042019"}, {"member_id": "GRVSP00550680000024520", "credit_debit_flag": "C", "doe_epf": "2021-10-24", "doe_eps": "2021-10-24", "doj_epf": "2018-10-08", "office": null, "transaction_approved": "2021-10-24", "transaction_category": "contribution", "employee_share": "805", "employer_share": "246", "pension_share": "559", "approved_on": "2019-05-13", "year": "2019", "month": "05", "description": "Cont. For Due-Month 052019"}, {"member_id": "GRVSP00550680000024520", "credit_debit_flag": "C", "doe_epf": "2021-10-24", "doe_eps": "2021-10-24", "doj_epf": "2018-10-08", "office": null, "transaction_approved": "2021-10-24", "transaction_category": "contribution", "employee_share": "705", "employer_share": "216", "pension_share": "489", "approved_on": "2019-06-13", "year": "2019", "month": "06", "description": "Cont. For Due-Month 062019"}, {"member_id": "GRVSP00550680000024520", "credit_debit_flag": "C", "doe_epf": "2018-01-22", "doe_eps": "2018-01-31", "doj_epf": "1800-01-01", "office": null, "transaction_approved": "2019-09-06", "transaction_category": "uncategorized", "employee_share": "276", "employer_share": "85", "pension_share": "0", "approved_on": "2019-09-06", "year": "2019", "month": "07", "description": "TRANSFER IN - SAME OFFICE(Old Member Id-:APHYD00725920000010338 )"}, {"member_id": "GRVSP00550680000024520", "credit_debit_flag": "C", "doe_epf": "2021-10-24", "doe_eps": "2021-10-24", "doj_epf": "2018-10-08", "office": null, "transaction_approved": "2021-10-24", "transaction_category": "contribution", "employee_share": "574", "employer_share": "176", "pension_share": "398", "approved_on": "2019-07-15", "year": "2019", "month": "07", "description": "Cont. For Due-Month 072019"}, {"member_id": "GRVSP00550680000024520", "credit_debit_flag": "C", "doe_epf": "2018-01-22", "doe_eps": "2018-01-31", "doj_epf": "1800-01-01", "office": null, "transaction_approved": "2019-09-06", "transaction_category": "uncategorized", "employee_share": "8", "employer_share": "2", "pension_share": "0", "approved_on": "2019-09-06", "year": "2019", "month": "09", "description": "TRANSFER IN - INTEREST AMOUNT ONLY(Old Member Id-:APHYD00725920000010338 )"}, {"member_id": "GRVSP00550680000024520", "credit_debit_flag": "D", "doe_epf": "2021-10-24", "doe_eps": "2021-10-24", "doj_epf": "2018-10-08", "office": null, "transaction_approved": "2021-10-24", "transaction_category": "uncategorized", "employee_share": "6938", "employer_share": "2123", "pension_share": "0", "approved_on": "2019-09-11", "year": "2019", "month": "09", "description": "Claim Against PARA 69(2)"}, {"member_id": "GRVSP00550680000024520", "credit_debit_flag": "C", "doe_epf": "2021-10-24", "doe_eps": "2021-10-24", "doj_epf": "2018-10-08", "office": null, "transaction_approved": "2021-10-24", "transaction_category": "interest", "employee_share": "184", "employer_share": "56", "pension_share": "0", "approved_on": "2019-09-11", "year": "2019", "month": "09", "description": "Int. given against Claim : GRVSP190850013142"}, {"member_id": "GRVSP00550680000024520", "credit_debit_flag": "D", "doe_epf": "2021-10-24", "doe_eps": "2021-10-24", "doj_epf": "2018-10-08", "office": null, "transaction_approved": "2021-10-24", "transaction_category": "uncategorized", "employee_share": "0", "employer_share": "0", "pension_share": "0", "approved_on": "2019-09-12", "year": "2019", "month": "09", "description": "Claim "}, {"member_id": "GRVSP00550680000024520", "credit_debit_flag": "C", "doe_epf": "2021-10-24", "doe_eps": "2021-10-24", "doj_epf": "2018-10-08", "office": null, "transaction_approved": "2021-10-24", "transaction_category": "interest", "employee_share": "49", "employer_share": "15", "pension_share": "0", "approved_on": "2019-10-04", "year": "2019", "month": "03", "description": "Int. given against Claim "}, {"member_id": "GRVSP00550680000024520", "credit_debit_flag": "C", "doe_epf": "2018-01-22", "doe_eps": "2018-01-31", "doj_epf": "1800-01-01", "office": null, "transaction_approved": "2019-09-06", "transaction_category": "uncategorized", "employee_share": "8", "employer_share": "2", "pension_share": "0", "approved_on": "2019-09-06", "year": "2020", "month": "03", "description": "TRANSFER IN - INTEREST AMOUNT ONLY(Old Member Id-:APHYD00725920000010338 )"}, {"member_id": "GRVSP00550680000024520", "credit_debit_flag": "C", "doe_epf": "2018-01-22", "doe_eps": "2018-01-31", "doj_epf": "1800-01-01", "office": null, "transaction_approved": "2019-09-06", "transaction_category": "uncategorized", "employee_share": "-8", "employer_share": "-2", "pension_share": "0", "approved_on": "2019-09-06", "year": "2020", "month": "03", "description": "TRANSFER IN - INTEREST AMOUNT ONLY(Old Member Id-:APHYD00725920000010338 )"}], "company_name": "CONCENTRIX DAKSH SERVICES INDIA PRIVATE LIMITED", "establishment_id": "GRVSP0055068000", "employee_total": 0, "employer_total": 0, "pension_total": 4456}, "APHYD00725920000010338": {"passbook": [{"member_id": "APHYD00725920000010338", "credit_debit_flag": "C", "doe_epf": "2021-10-26", "doe_eps": "2021-10-26", "doj_epf": "2018-01-22", "office": null, "transaction_approved": "2021-10-26", "transaction_category": "ob_interest", "employee_share": "0", "employer_share": "0", "pension_share": "0", "approved_on": "2017-04-01", "year": "2017", "month": "04", "description": "OB Int. Updated upto 31/03/2017"}, {"member_id": "APHYD00725920000010338", "credit_debit_flag": "C", "doe_epf": "2021-10-26", "doe_eps": "2021-10-26", "doj_epf": "2018-01-22", "office": null, "transaction_approved": "2021-10-26", "transaction_category": "contribution", "employee_share": "252", "employer_share": "77", "pension_share": "175", "approved_on": "2018-02-15", "year": "2018", "month": "02", "description": "Cont. For Due-Month 022018"}, {"member_id": "APHYD00725920000010338", "credit_debit_flag": "C", "doe_epf": "2021-10-26", "doe_eps": "2021-10-26", "doj_epf": "2018-01-22", "office": null, "transaction_approved": "2021-10-26", "transaction_category": "interest", "employee_share": "2", "employer_share": "1", "pension_share": "0", "approved_on": "2018-09-08", "year": "2017", "month": "04", "description": "Int. Updated upto 31/03/2018"}, {"member_id": "APHYD00725920000010338", "credit_debit_flag": "C", "doe_epf": "2021-10-26", "doe_eps": "2021-10-26", "doj_epf": "2018-01-22", "office": null, "transaction_approved": "2021-10-26", "transaction_category": "interest", "employee_share": "8", "employer_share": "2", "pension_share": "0", "approved_on": "2019-08-21", "year": "2019", "month": "08", "description": "Int. given against Claim : APHYD190850018776"}, {"member_id": "APHYD00725920000010338", "credit_debit_flag": "D", "doe_epf": "2021-10-26", "doe_eps": "2021-10-26", "doj_epf": "2018-01-22", "office": null, "transaction_approved": "2021-10-26", "transaction_category": "uncategorized", "employee_share": "284", "employer_share": "87", "pension_share": "0", "approved_on": "2019-08-21", "year": "2019", "month": "08", "description": "Claim: Against PARA 57(1)"}, {"member_id": "APHYD00725920000010338", "credit_debit_flag": "C", "doe_epf": "2021-10-26", "doe_eps": "2021-10-26", "doj_epf": "2018-01-22", "office": null, "transaction_approved": "2021-10-26", "transaction_category": "interest", "employee_share": "22", "employer_share": "7", "pension_share": "0", "approved_on": "2019-11-04", "year": "2019", "month": "03", "description": "Int. given against Claim "}], "company_name": "COMPUTER GENERATED SOLUTIONS INDIA PRIVATE LIMITED,", "establishment_id": "APHYD0072592000", "employee_total": 0, "employer_total": 0, "pension_total": 175}, "APHYD00428070000011961": {"passbook": [{"member_id": "APHYD00428070000011961", "credit_debit_flag": "C", "doe_epf": "2021-10-26", "doe_eps": "2021-10-26", "doj_epf": "2021-05-10", "office": null, "transaction_approved": "2021-10-26", "transaction_category": "ob_interest", "employee_share": "0", "employer_share": "0", "pension_share": "0", "approved_on": "2021-04-01", "year": "2021", "month": "04", "description": "OB Int. Updated upto 31/03/2021"}, {"member_id": "APHYD00428070000011961", "credit_debit_flag": "C", "doe_epf": "2019-09-03", "doe_eps": "2021-05-05", "doj_epf": "1800-01-01", "office": null, "transaction_approved": "2021-08-09", "transaction_category": "uncategorized", "employee_share": "17831", "employer_share": "9027", "pension_share": "0", "approved_on": "2021-08-09", "year": "2021", "month": "06", "description": "TRANSFER IN - SAME OFFICE(Old Member Id-:DSNHP00237190000263818 )"}, {"member_id": "APHYD00428070000011961", "credit_debit_flag": "C", "doe_epf": "2021-10-26", "doe_eps": "2021-10-26", "doj_epf": "2021-05-10", "office": null, "transaction_approved": "2021-10-26", "transaction_category": "contribution", "employee_share": "1800", "employer_share": "550", "pension_share": "1250", "approved_on": "2021-06-16", "year": "2021", "month": "06", "description": "Cont. For Due-Month 062021"}, {"member_id": "APHYD00428070000011961", "credit_debit_flag": "C", "doe_epf": "2021-10-26", "doe_eps": "2021-10-26", "doj_epf": "2021-05-10", "office": null, "transaction_approved": "2021-10-26", "transaction_category": "contribution", "employee_share": "1800", "employer_share": "550", "pension_share": "1250", "approved_on": "2021-07-15", "year": "2021", "month": "07", "description": "Cont. For Due-Month 072021"}, {"member_id": "APHYD00428070000011961", "credit_debit_flag": "C", "doe_epf": "2021-10-26", "doe_eps": "2021-10-26", "doj_epf": "2021-05-10", "office": null, "transaction_approved": "2021-10-26", "transaction_category": "contribution", "employee_share": "1800", "employer_share": "550", "pension_share": "1250", "approved_on": "2021-08-15", "year": "2021", "month": "08", "description": "Cont. For Due-Month 082021"}, {"member_id": "APHYD00428070000011961", "credit_debit_flag": "C", "doe_epf": "2021-10-26", "doe_eps": "2021-10-26", "doj_epf": "2021-05-10", "office": null, "transaction_approved": "2021-10-26", "transaction_category": "contribution", "employee_share": "1529", "employer_share": "467", "pension_share": "1062", "approved_on": "2021-09-14", "year": "2021", "month": "09", "description": "Cont. For Due-Month 092021"}, {"member_id": "APHYD00428070000011961", "credit_debit_flag": "C", "doe_epf": "2019-09-03", "doe_eps": "2021-05-05", "doj_epf": "1800-01-01", "office": null, "transaction_approved": "2021-08-09", "transaction_category": "uncategorized", "employee_share": "347", "employer_share": "182", "pension_share": "0", "approved_on": "2021-08-09", "year": "2022", "month": "03", "description": "TRANSFER IN - INTEREST AMOUNT ONLY(Old Member Id-:DSNHP00237190000263818 )"}], "company_name": "LOCUZ ENTERPRISE SOLUTIONS LTD", "establishment_id": "APHYD0042807000", "employee_total": 25107, "employer_total": 11326, "pension_total": 4812}, "DSNHP00237190000263818": {"passbook": [{"member_id": "DSNHP00237190000263818", "credit_debit_flag": "C", "doe_epf": "2021-10-26", "doe_eps": "2021-10-26", "doj_epf": "2019-09-03", "office": null, "transaction_approved": "2021-10-26", "transaction_category": "ob_interest", "employee_share": "0", "employer_share": "0", "pension_share": "0", "approved_on": "2019-04-01", "year": "2019", "month": "04", "description": "OB Int. Updated upto 31/03/2019"}, {"member_id": "DSNHP00237190000263818", "credit_debit_flag": "C", "doe_epf": "2021-10-26", "doe_eps": "2021-10-26", "doj_epf": "2019-09-03", "office": null, "transaction_approved": "2021-10-26", "transaction_category": "contribution", "employee_share": "1287", "employer_share": "394", "pension_share": "893", "approved_on": "2019-10-14", "year": "2019", "month": "10", "description": "Cont. For Due-Month 102019"}, {"member_id": "DSNHP00237190000263818", "credit_debit_flag": "C", "doe_epf": "2021-10-26", "doe_eps": "2021-10-26", "doj_epf": "2019-09-03", "office": null, "transaction_approved": "2021-10-26", "transaction_category": "contribution", "employee_share": "1379", "employer_share": "422", "pension_share": "957", "approved_on": "2019-11-13", "year": "2019", "month": "11", "description": "Cont. For Due-Month 112019"}, {"member_id": "DSNHP00237190000263818", "credit_debit_flag": "C", "doe_epf": "2021-10-26", "doe_eps": "2021-10-26", "doj_epf": "2019-09-03", "office": null, "transaction_approved": "2021-10-26", "transaction_category": "contribution", "employee_share": "1379", "employer_share": "422", "pension_share": "957", "approved_on": "2019-12-12", "year": "2019", "month": "12", "description": "Cont. For Due-Month 122019"}, {"member_id": "DSNHP00237190000263818", "credit_debit_flag": "C", "doe_epf": "2021-10-26", "doe_eps": "2021-10-26", "doj_epf": "2019-09-03", "office": null, "transaction_approved": "2021-10-26", "transaction_category": "contribution", "employee_share": "1379", "employer_share": "422", "pension_share": "957", "approved_on": "2020-01-14", "year": "2020", "month": "01", "description": "Cont. For Due-Month 012020"}, {"member_id": "DSNHP00237190000263818", "credit_debit_flag": "C", "doe_epf": "2021-10-26", "doe_eps": "2021-10-26", "doj_epf": "2019-09-03", "office": null, "transaction_approved": "2021-10-26", "transaction_category": "contribution", "employee_share": "1379", "employer_share": "422", "pension_share": "957", "approved_on": "2020-02-14", "year": "2020", "month": "02", "description": "Cont. For Due-Month 022020"}, {"member_id": "DSNHP00237190000263818", "credit_debit_flag": "C", "doe_epf": "2021-10-26", "doe_eps": "2021-10-26", "doj_epf": "2019-09-03", "office": null, "transaction_approved": "2021-10-26", "transaction_category": "contribution", "employee_share": "1379", "employer_share": "422", "pension_share": "957", "approved_on": "2020-03-12", "year": "2020", "month": "03", "description": "Cont. For Due-Month 032020"}, {"member_id": "DSNHP00237190000263818", "credit_debit_flag": "C", "doe_epf": "2021-10-26", "doe_eps": "2021-10-26", "doj_epf": "2019-09-03", "office": null, "transaction_approved": "2021-10-26", "transaction_category": "interest", "employee_share": "143", "employer_share": "44", "pension_share": "0", "approved_on": "2021-01-29", "year": "2019", "month": "04", "description": "Int. Updated upto 31/03/2020"}, {"member_id": "DSNHP00237190000263818", "credit_debit_flag": "C", "doe_epf": "2021-10-26", "doe_eps": "2021-10-26", "doj_epf": "2019-09-03", "office": null, "transaction_approved": "2021-10-26", "transaction_category": "contribution", "employee_share": "1335", "employer_share": "408", "pension_share": "927", "approved_on": "2020-04-15", "year": "2020", "month": "04", "description": "Cont. For Due-Month 042020"}, {"member_id": "DSNHP00237190000263818", "credit_debit_flag": "C", "doe_epf": "2021-10-26", "doe_eps": "2021-10-26", "doj_epf": "2019-09-03", "office": null, "transaction_approved": "2021-10-26", "transaction_category": "contribution", "employee_share": "1423", "employer_share": "435", "pension_share": "988", "approved_on": "2020-05-13", "year": "2020", "month": "05", "description": "Cont. For Due-Month 052020"}, {"member_id": "DSNHP00237190000263818", "credit_debit_flag": "C", "doe_epf": "2021-10-26", "doe_eps": "2021-10-26", "doj_epf": "2019-09-03", "office": null, "transaction_approved": "2021-10-26", "transaction_category": "contribution", "employee_share": "1379", "employer_share": "422", "pension_share": "957", "approved_on": "2020-06-12", "year": "2020", "month": "06", "description": "Cont. For Due-Month 062020"}, {"member_id": "DSNHP00237190000263818", "credit_debit_flag": "D", "doe_epf": "2021-10-26", "doe_eps": "2021-10-26", "doj_epf": "2019-09-03", "office": null, "transaction_approved": "2021-10-26", "transaction_category": "uncategorized", "employee_share": "10900", "employer_share": "0", "pension_share": "0", "approved_on": "2020-06-29", "year": "2020", "month": "06", "description": "Claim Against PARA 68H(1)"}, {"member_id": "DSNHP00237190000263818", "credit_debit_flag": "C", "doe_epf": "2021-10-26", "doe_eps": "2021-10-26", "doj_epf": "2019-09-03", "office": null, "transaction_approved": "2021-10-26", "transaction_category": "contribution", "employee_share": "1379", "employer_share": "422", "pension_share": "957", "approved_on": "2020-07-14", "year": "2020", "month": "07", "description": "Cont. For Due-Month 072020"}, {"member_id": "DSNHP00237190000263818", "credit_debit_flag": "C", "doe_epf": "2021-10-26", "doe_eps": "2021-10-26", "doj_epf": "2019-09-03", "office": null, "transaction_approved": "2021-10-26", "transaction_category": "contribution", "employee_share": "1379", "employer_share": "422", "pension_share": "957", "approved_on": "2020-08-13", "year": "2020", "month": "08", "description": "Cont. For Due-Month 082020"}, {"member_id": "DSNHP00237190000263818", "credit_debit_flag": "C", "doe_epf": "2021-10-26", "doe_eps": "2021-10-26", "doj_epf": "2019-09-03", "office": null, "transaction_approved": "2021-10-26", "transaction_category": "contribution", "employee_share": "1379", "employer_share": "422", "pension_share": "957", "approved_on": "2020-09-11", "year": "2020", "month": "09", "description": "Cont. For Due-Month 092020"}, {"member_id": "DSNHP00237190000263818", "credit_debit_flag": "C", "doe_epf": "2021-10-26", "doe_eps": "2021-10-26", "doj_epf": "2019-09-03", "office": null, "transaction_approved": "2021-10-26", "transaction_category": "contribution", "employee_share": "1379", "employer_share": "422", "pension_share": "957", "approved_on": "2020-10-09", "year": "2020", "month": "10", "description": "Cont. For Due-Month 102020"}, {"member_id": "DSNHP00237190000263818", "credit_debit_flag": "C", "doe_epf": "2021-10-26", "doe_eps": "2021-10-26", "doj_epf": "2019-09-03", "office": null, "transaction_approved": "2021-10-26", "transaction_category": "contribution", "employee_share": "1335", "employer_share": "408", "pension_share": "927", "approved_on": "2020-11-11", "year": "2020", "month": "11", "description": "Cont. For Due-Month 112020"}, {"member_id": "DSNHP00237190000263818", "credit_debit_flag": "C", "doe_epf": "2021-10-26", "doe_eps": "2021-10-26", "doj_epf": "2019-09-03", "office": null, "transaction_approved": "2021-10-26", "transaction_category": "contribution", "employee_share": "1423", "employer_share": "435", "pension_share": "988", "approved_on": "2020-12-09", "year": "2020", "month": "12", "description": "Cont. For Due-Month 122020"}, {"member_id": "DSNHP00237190000263818", "credit_debit_flag": "C", "doe_epf": "2021-10-26", "doe_eps": "2021-10-26", "doj_epf": "2019-09-03", "office": null, "transaction_approved": "2021-10-26", "transaction_category": "contribution", "employee_share": "1379", "employer_share": "422", "pension_share": "957", "approved_on": "2021-01-07", "year": "2021", "month": "01", "description": "Cont. For Due-Month 012021"}, {"member_id": "DSNHP00237190000263818", "credit_debit_flag": "C", "doe_epf": "2021-10-26", "doe_eps": "2021-10-26", "doj_epf": "2019-09-03", "office": null, "transaction_approved": "2021-10-26", "transaction_category": "contribution", "employee_share": "1379", "employer_share": "422", "pension_share": "957", "approved_on": "2021-02-09", "year": "2021", "month": "02", "description": "Cont. For Due-Month 022021"}, {"member_id": "DSNHP00237190000263818", "credit_debit_flag": "C", "doe_epf": "2021-10-26", "doe_eps": "2021-10-26", "doj_epf": "2019-09-03", "office": null, "transaction_approved": "2021-10-26", "transaction_category": "contribution", "employee_share": "1639", "employer_share": "501", "pension_share": "1138", "approved_on": "2021-03-10", "year": "2021", "month": "03", "description": "Cont. For Due-Month 032021"}, {"member_id": "DSNHP00237190000263818", "credit_debit_flag": "C", "doe_epf": "2021-10-26", "doe_eps": "2021-10-26", "doj_epf": "2019-09-03", "office": null, "transaction_approved": "2021-10-26", "transaction_category": "contribution", "employee_share": "1509", "employer_share": "462", "pension_share": "1047", "approved_on": "2021-04-09", "year": "2021", "month": "04", "description": "Cont. For Due-Month 042021"}, {"member_id": "DSNHP00237190000263818", "credit_debit_flag": "C", "doe_epf": "2021-10-26", "doe_eps": "2021-10-26", "doj_epf": "2019-09-03", "office": null, "transaction_approved": "2021-10-26", "transaction_category": "contribution", "employee_share": "1509", "employer_share": "462", "pension_share": "1047", "approved_on": "2021-05-11", "year": "2021", "month": "05", "description": "Cont. For Due-Month 052021"}, {"member_id": "DSNHP00237190000263818", "credit_debit_flag": "C", "doe_epf": "2021-10-26", "doe_eps": "2021-10-26", "doj_epf": "2019-09-03", "office": null, "transaction_approved": "2021-10-26", "transaction_category": "contribution", "employee_share": "162", "employer_share": "50", "pension_share": "112", "approved_on": "2021-07-19", "year": "2021", "month": "06", "description": "Cont. For Due-Month 062021"}, {"member_id": "DSNHP00237190000263818", "credit_debit_flag": "C", "doe_epf": "2021-10-26", "doe_eps": "2021-10-26", "doj_epf": "2019-09-03", "office": null, "transaction_approved": "2021-10-26", "transaction_category": "interest", "employee_share": "580", "employer_share": "414", "pension_share": "0", "approved_on": "2021-07-24", "year": "2021", "month": "03", "description": "Int. given against Claim : DSNHP210750106824"}, {"member_id": "DSNHP00237190000263818", "credit_debit_flag": "D", "doe_epf": "2021-10-26", "doe_eps": "2021-10-26", "doj_epf": "2019-09-03", "office": null, "transaction_approved": "2021-10-26", "transaction_category": "uncategorized", "employee_share": "18178", "employer_share": "9209", "pension_share": "0", "approved_on": "2021-07-24", "year": "2021", "month": "07", "description": "Claim: Against PARA 57(1)"}, {"member_id": "DSNHP00237190000263818", "credit_debit_flag": "C", "doe_epf": "2021-10-26", "doe_eps": "2021-10-26", "doj_epf": "2019-09-03", "office": null, "transaction_approved": "2021-10-26", "transaction_category": "interest", "employee_share": "347", "employer_share": "182", "pension_share": "0", "approved_on": "2021-07-24", "year": "2021", "month": "07", "description": "Int. given against Claim : DSNHP210750106824"}], "company_name": "WIPRO LIMITED", "establishment_id": "DSNHP0023719000", "employee_total": 162, "employer_total": 50, "pension_total": 19551}}}, "status_code": 200, "success": true, "message": "Success", "message_code": "success"}

';


   $pf = json_decode($response, true);

foreach($pf[data][companies][GRVSP00550680000024520][passbook] as $key => $item) {
    $i=0;
    
  //echo $item;
    print_r($item[description]);
    $i++;
}  */

//echo $response;exit;

$reg = $db->query("SELECT * FROM `register`  where guid = '".$userid."' ")->fetch();

$b = $db->query ("SELECT sum(total) FROM `bills` where status = 'Pending' and userid = '".$userid."' ")->fetch();


$tb = $db->query("SELECT sum(amount) FROM `transactions`  where userid = '".$userid."' and status = 'Debit' and bill_status = '0'   ")->fetch();

$tc = $db->query("SELECT sum(amount) FROM `transactions`  where userid = '".$userid."' and status = 'Cashback' and bill_status = '0' ")->fetch();

$tcr = $db->query("SELECT sum(amount) FROM `transactions`  where userid = '".$userid."' and status = 'Credit'  ")->fetch();

$int = $db->query ("SELECT sum(interest) FROM `interest` where status = 'Paid' and userid = '".$userid."' ")->fetch();

//$wav = $db->query ("SELECT sum(amount) FROM `transactions` where status = 'Waiveoff' and userid = '".$userid."' ")->fetch();

$credit = ($reg['credit']+$tc[0]+$tcr[0])-$tb[0]-$int[0];



$spent = $tb[0]-$int[0]-($tc[0]+$tcr[0]);

$totalspent = $b[0]+$tb[0];

$balance = $reg['credit']+$tc[0]-$totalspent;

echo $balance; // credit = 305 paid - 69 debit - 50 */

/*$message = "$otp is your DakshinPAY AUTHORIZATION OTP. By confirming OTP, you agree to DakshinPAY's T%26C https://Dakshinpay.in/tnc.html . NEVER SHARE YOUR OTP WITH ANYONE. DakshinPAY NEVER CALLS TO VERIFY OTP.";
$sms=str_replace(" ","%20","$message"); 


echo $sms;exit; 

$maxid = $db->query("SELECT  max(guid) FROM register where approval_status = 'Rejected'  ")->fetch();

for($i=$i;$i<=$maxid;$i++){
    
$files = $db->query("SELECT * FROM `register` where guid = '".$i."' and approval_status = 'Rejected'   ")->fetch();

unlink('../cw_admin/uploads/'.$files['image']);

unlink('../cw_admin/uploads/'.$files['aadharfront']);

unlink('../cw_admin/uploads/'.$files['aadharback']);

unlink('../cw_admin/uploads/'.$files['selfie']);

unlink('../cw_admin/uploads/'.$files['bank_stmt']);

unlink('../cw_admin/uploads/'.$files['pay_slip']);

unlink('../cw_admin/uploads/'.$files['pancard']);


unlink('../cw_admin/uploads/'.$files['bank']);

}
*/

/*define( 'API_ACCESS_KEY', 'AAAAVVzX-7Q:APA91bE-TFFSKkJOOhbg9ce3dg6x9TgW8TvxThSwpKvKoB5rH1ZefZhVECaN23gw-eonUIO1hBrmnFr3vINwYOtJh5tVZNPBn4n-Mnu6RkJFd4AU-mdt5A9t2SLlFHgJ20XPPuXqmBSF');

$singleID = 'fI2zztNo7dY:APA91bHt_gcFIZGXXa7R0FDQ6rxXTzWDjTMj0qTfSIJQHHmFKNfZ9xbgR8QpcKm6W0mWHgYuS905nZ8CueOkSvNLRQgf9z4GsN043D0ja6CQu5YRX3sXmv-J8GvbJzHJCLC_EltjkIy8'; 
    $fcmMsg = array(
    	'body' => 'ok dakshinpay',
    	'title' => 'test',
    	'sound' => "default",
        'color' => "#203E78" 
    );
    $fcmFields = array(
    	'to' => $singleID,
        'priority' => 'high',
    	'notification' => $fcmMsg
    );
    $headers = array(
    	'Authorization: key=' . API_ACCESS_KEY,
    	'Content-Type: application/json'
    );
    $ch = curl_init();
    curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
    curl_setopt( $ch,CURLOPT_POST, true );
    curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
    curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
    curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
    curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fcmFields ) );
    $result = curl_exec($ch ); */

//echo $result;exit;
