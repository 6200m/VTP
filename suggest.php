<?php
if(strlen(strstr($_SERVER['HTTP_USER_AGENT'],"WiiConnect24")) <= 0 ){ // if not the Wii
	die("Hi! You're not a Wii.");
}
if (empty($_POST)) {
    die("Stop hitting our server without actual suggestion data. Thanks!");
}
require "config/config.php";
require "lib/snowflake.php";
require_once 'vendor/autoload.php';
$client = (new Raven_Client($sentryurl))->install();

$wiiNo = $_POST['wiiNo'];
$countryID = $_POST['countryID'];
$regionID = $_POST['regionID'];
$langCD = $_POST['langCD'];
$content = $_POST['content'];
$choice1 = $_POST['choice1'];
$choice2 = $_POST['choice2'];

$sf = new SnowFlake(1,1);
$uuid = abs($sf->generateID());

$db = connectMySQL();

$stmt = $db->prepare('INSERT INTO `suggestions` (`uuid`,
  `wiiNo`,
  `countryID`,
  `regionID`,
  `langCD`,
  `content`,
  `choice1`,
  `choice2`
) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');

$stmt->bind_param('iiiiisss', $uuid, $wiiNo, $countryID, $regionID, $langCD, $content, $choice1, $choice2);

if (!$stmt->execute()) {
	error_log('DATABASE ERROR ON suggest - ' . $stmt->error);
	die(500);
}

echo(100);
?>
