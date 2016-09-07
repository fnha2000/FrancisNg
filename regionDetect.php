<?php

if (isset($_SERVER['HTTP_CLIENT_IP']))
{
    $real_ip_adress = $_SERVER['HTTP_CLIENT_IP'];
}

if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
{
    $real_ip_adress = $_SERVER['HTTP_X_FORWARDED_FOR'];
}
else
{
    $real_ip_adress = $_SERVER['REMOTE_ADDR'];
}

$cip = $real_ip_adress;
$iptolocation = 'http://api.hostip.info/country.php?ip=' . $cip;
$creatorlocation = file_get_contents($iptolocation);
echo $creatorlocation;

?>