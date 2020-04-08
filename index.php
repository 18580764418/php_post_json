<?php
function SendDataByCurl($url,$data=array()){
  $url = str_replace(' ','+',$url);
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, "$url");
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_HEADER, 0);
  curl_setopt($ch,CURLOPT_TIMEOUT,3);
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

  $output = curl_exec($ch);
  $errorCode = curl_errno($ch);
  curl_close($ch);
  if(0 !== $errorCode) {
    return false;
  }
  return $output;
}
$url="http://113.204.194.88:3000/api/insert";
$data['token']='EFMc*eowRc0vKw07K4!bc1b*T%0OqMl1Cn1Y69wwUEu6j!be4Q%!lQPwLur31bmV';
$data['table']='fund_bonus_records';
$data['data']['member_id']=1;
$data['data']['bonus_type']=2;
$data['data']['bonus_amount']=900;
$data['data']['product_type']=5;
$data['data']['from_member_id']=2;
$data['data']['is_received']=1;
$data['data']['created_at']=1586230985;
$data['data']['bonus_id']=3298;
SendDataByCurl($url,json_encode($data));
?>
