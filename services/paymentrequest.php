<?php //header("Access-Control-Allow-Origin: *");
date_default_timezone_set('Asia/Kolkata'); 
require "config.php";
extract($_POST);
extract($_GET);
$date = date('Y-m-d');
$datetime = date('Y-m-d H:i:s');


 //$razor_pay_key_id = 'rzp_live_QctJgrJ5yUuAaZ';
    $razor_pay_key_id = 'rzp_live_fqgbm1A9atGl50';
    $secret_key = 'UkguuH00vvszM7V3z6WFQ7lj';
    //define("KEY",$razor_pay_key_id);
    //define("API_SECRET",$secret_key);


$row = $db->query("SELECT * FROM `bills`  where guid = '".$_GET['paymentid']."'  ")->fetch();


$int = $db->query ("SELECT sum(interest) FROM `interest` where status = 'Pending' and bill = '".$_GET['paymentid']."' ")->fetch();
$total = $row['total']+$int[0];
$nettotal = $row['total']+$int[0]-$row['waiveoff'];

?>
<!DOCTYPE html>
<html lang="en">


<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- SITE META -->
    <title>Dakshinpay</title>
    
    <style>
        body{
            background: #f8f8f8;
            padding: 30px;
            font-family: arial;
            text-align: left;
        }
        .payment-status-box{
            background-color:#ffffff;
            border-radius: 10px;
            box-shadow: 2px 2px 6px #ccc;
            padding: 30px;
            width: 50%;
            margin: 0 auto;
        }
        .pay-btn {
            background: #00bcd4;
            border: 0;
            color: white;
            padding: 10px;
            width: 100%;
            border-radius: 100px;
            box-shadow: 1px 1px 4px #ccc;
            margin-top: 15px;
        }
        table{
            width: 100%;
        }
        th, td {
            padding: 6px 10px;
            font-size: 13px;
            border: 1px solid #eee;
        }
        .title-head {
            text-transform: uppercase;
            font-size: 16px;
            color: #00bcd4;
        }
        @media only screen and (max-width: 600px) {
            body{
                background: #f8f8f8;
                padding: 15px;
                font-family: arial;
                text-align: left;
            }
            .payment-status-box{
                background-color:#ffffff;
                border-top: 5px solid #00bcd4;
                border-radius: 10px;
                box-shadow: 2px 2px 6px #ccc;
                padding: 30px;
                width: auto;
            }
        }

    </style>
    
  </head>
<body>  


						<div class="col-lg-12 col-md-12">
							<div class="payment-status-box">
							    <h3 align="center" class="title-head">Payment Details</h3>
							    <?php if($row['status']=='Pending'){ ?> 
								<form action ="" method="POST">
										
										<p><input type="hidden" id="total" value="<?php echo $nettotal;?>">
											<input type="hidden" id="name" value="<?php echo $row['name'];?>">
											<input type="hidden" id="email" value="<?php echo $row['email'];?>">
											<input type="hidden" id="phone" value="<?php echo $row['mobile'];?>">
											<input type="hidden" id="userid" value="<?php echo $row['userid'];?>">
											<input type="hidden" id="guid" value="<?php echo $row['guid'];?>">
										</p>
										<table>
										    <tr>
										        <th>Name</th>
										        <td><?php echo $row['name'];?></td>
										    </tr>
										    <tr>
										        <th>Mobile</th>
										        <td><?php echo $row['mobile'];?></td>
										    </tr>
										    <tr>
										        <th>Email</th>
										        <td><?php echo $row['email'];?></td>
										    </tr>
										    <tr>
										        <th>Total Amount</th>
										        <td><?php echo $nettotal;?>/-</td>
										    </tr>
										    <!--tr>
										        <td colspan="2"><button class="pay-btn" type="button" onClick="return test();">PAY NOW</button></td>
										    </tr-->
										</table>
										<button class="pay-btn" type="button" onClick="return test();">PAY NOW</button>
										<!--p>Name : <?php echo $row['name'];?> </p>
										<br>
										<p>Mobile : <?php echo $row['mobile'];?></p>
										<br>
										<p>Email : <?php echo $row['email'];?></p>
										<br>
										<p>Total Amount : <?php echo $nettotal;?>/-</p>
										<br>
										<div align="center">
											<button class="btn btn-primary" type="button" onClick="return test();">PAY NOW</button>
											<!--button name= "cancel" value="cancel"  class="btn btn-danger"  >Cancel</button-->
										</div-->
								</form>
								<?php }else if($row['status']=='Paid'){ ?>
								<p>Name : <?php echo $row['name'];?> </p>
										<br>
										<p>Mobile : <?php echo $row['mobile'];?></p>
										<br>
										<p>Email : <?php echo $row['email'];?></p>
										<br>
										<p>Total Amount : <?php echo $nettotal;?>/-</p>
										<br>
							
								<h4>Payment successfull</h4>
								<?php } ?>
								<br>
							</div>
						</div>
    
    
     <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
   
<script>



         function payment(s)
         {
         	var amt=document.getElementById('total').value;
         	var userid=document.getElementById('userid').value;
         	var billid=document.getElementById('guid').value;
         	
         //alert(s);
         	//alert(amt);
         	//alert(uid);exit;
          $.ajax({
                                  type: "post",
                                  url: "payment.php",
                                  data: "paymentid=" +s+"&userid="+userid+"&amount="+amt+"&billid="+billid,
                                  success: function(response) {
                                      
                                    //alert(response);
                                      
         							if(response==0110)
         							{
										alert('Thank you,we have received your payment');   
										window.location='paymentrequest.php?paymentid='+paymentid;
         							}
         							else
         							{
         							    alert('Opps! something went wrong'); 
										window.location='paymentrequest.php?paymentid='+paymentid;	 
         							}
                                  }
                              });	
         }
         function test(){
         	var amt=document.getElementById('total').value;
         		var name=document.getElementById('name').value;
         			var email=document.getElementById('email').value;
         				var phone=document.getElementById('phone').value;
         	//alert(amt*100);
         	
         	if(amt<=0){window.location='paymentrequest.php?paymentid='+paymentid;}
			
         var options = {
             "key": "<?php echo $razor_pay_key_id;?>",
             "currency": "INR",
             "amount": Math.round(amt*100),// 2000 paise = INR 20
             "name": name,
             "description": "Payment",
             "image": "https://www.dakshinpay.com/cw_admin/images/icon.png",
             "handler": function (response){
                 
                 //alert(response.razorpay_payment_id);
         		return payment(response.razorpay_payment_id);
                 
         		
             },
             "prefill": {
                 "name": name,
                 "email": email,
                  "contact": phone,
             },
             "notes": {
                 "address": ""
             },
             "theme": {
                 "color": "#F37254"
             }
         };
         var rzp1 = new Razorpay(options);
         
             rzp1.open();
             e.preventDefault();
         }
      </script> 
</body>
</html>