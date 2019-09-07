<?php
error_reporting(0);
echo "\n";
echo "\n";
echo "\033[32;1m••••[ Modifykasi by : Mr.Tr3v!0n ]••••\n";
echo "\033[34;1m•       Kontak wa : 083879017166     •\n";
echo "\033[34;1m•     Team Termux : TERMUX TOOLS-ID  •\n";
echo "\033[34;1m•     Team Cyber  : Baby Cyber Mafia •\n";
echo "\033[32;1m••••••••••••••••••••••••••••••••••••••\n";
echo "\033[32;1m••••[  TOOLS AUTOLIKE FACEBOOK   ]••••\n";
echo "\n";
echo "\033[32;1m[\033[34;1m•\033[32;1m]\033[34;1mMASUKAN TOKEN NYA\033[32;1m[\033[34;1m•\033[32;1m]=> : ";
$token = trim(fgets(STDIN, 1024));
echo "\n";
echo "\033[32;1m[\033[34;1m•\033[32;1m]\033[34;1mMASUKAN JUMLAH LIKE\033[32;1m[\033[34;1m•\033[32;1m]=> : ";
$limit        = trim(fgets(STDIN, 1024));
$ambil_konten = file_get_contents("https://graph.facebook.com/v2.1/me/home?fields=id,from,type,message&limit={$limit}&access_token={$token}");
$jdecode      = json_decode($ambil_konten,true);

foreach ($jdecode['data'] as $key => $data) {
	$data_id    = $data['id']; // data id
	$data_name  = $data['from']['name']; // pemilik status
	$data_time  = $data['created_time']; // waktu status
	$data_pesan = $data['message'];
	$url        = "https://graph.facebook.com/v2.1/{$data_id}/likes";
	$curl       = curl_init();

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_CONNECTTIMEOUT,20);
    curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.64 Safari/537.31');
    curl_setopt($curl, CURLOPT_COOKIE,'cookie.txt');
    curl_setopt($curl, CURLOPT_COOKIEFILE,'cookie.txt');
    curl_setopt($curl, CURLOPT_COOKIEJAR,'cookie.txt');
    curl_setopt($curl, CURLOPT_POSTFIELDS,"access_token={$token}&method=post");
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 3);
    curl_setopt($curl, CURLOPT_HEADER, 0);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl,CURLOPT_FOLLOWLOCATION,true);

    $result  = curl_exec($curl);
    $results = json_decode($result,true);
    curl_close($curl);

    if ($results['success']) {
    	echo "[Success]-> ".substr_replace($data_pesan,"...",16)." - ".$data_name."\r\n";
    }
}
?>
