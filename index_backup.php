
<?php
require_once("inc/functions.php");


// $requests = $_GET;
// $hmac = $_GET['hmac'];
// $serializeArray = serialize($requests);
// $requests = array_diff_key($requests, array('hmac' => ''));
// ksort($requests);


// $parsedUrl = parse_url('https://'.$requests['shop']);
// $host = explode('.', $parsedUrl['host']);
// $subdomain = $host[0];


$shop = 'jayka-new';
$token = "a9e07d1effc31e923977851750e790f0";
$shopUrl='jayka-new.myshopify.com';


// echo "hiiii";
$t=time();
// for()
$price_rule_arr = array(
  "price_rule"=> array(
    "title"=>  "test",
    "target_type"=> "line_item",
    "target_selection"=>  "all",
    "allocation_method"=>  "across",
    "value_type"=> "percentage",
    "value"=> "-10.0",
    "customer_selection"=>  "all",
    "prerequisite_quantity_range" => array(
               "greater_than_or_equal_to"=> 3,
     ),   
    "allocation_limit"=> 3,
    "starts_at"=> date("Y-m-d",$t)
  ) );


$price_rule= shopify_call($token, $shop, "/admin/api/2020-01/price_rules.json", $price_rule_arr, 'POST');
$price_rule = json_decode($price_rule['response'], JSON_PRETTY_PRINT);
 echo "<pre>";
print_r($price_rule);


 foreach ($price_rule as $rule_value) {
$permitted_chars = 'QWERTYUIOPLKJHGFDSAZXCVBNM';
$code=substr(str_shuffle($permitted_chars), 0, 10);
$rul_id=$rule_value['id'];
$dis_code_arr = array(
  "discount_code"=> array(
    "code"=> $code
  ));

$dis_code = shopify_call($token, $shop, "/admin/api/2020-01/price_rules/".$rul_id."/discount_codes.json", $dis_code_arr, 'POST');

$dis_code = json_decode($dis_code['response'], JSON_PRETTY_PRINT);

echo "<pre>";
print_r($dis_code);


}


