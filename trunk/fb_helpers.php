<?php

include 'facebook/facebook.php';

function debug_r($arr, $name='') {
	echo "<pre>";
	if($name)
		echo $name.":";
	print_r($arr);
	echo "</pre>";
}

$config = array();

$config['url'] = 'http://vverma.net/hackny/trunk';

$config['fb']['key'] = '041011fc5adf6bcb68e7cd8533e7d646';
$config['fb']['secret'] = 'b389eb05a2528a0c715914ed2fa909e6';

$facebook = new Facebook(array(
	'appId' => $config['fb']['key'],
	'secret' => $config['fb']['secret'],
	'cookie' => true,
));

$session = $facebook->getSession();

if ($session)
{
	$user = $facebook->getUser();

	$uid = '854595155';
	$uid = '669201311';
	$uid = '551906507';
	//$uid = '1340490250';
	//	$uid = '1051411742';

	get_user_details($uid);

}
else
{
	$loginUrl = $facebook->getLoginUrl(array(
		'canvas' => 1,
		'fbconnect' => 0,
		'req_perms' => 'friends_status, friends_birthday, friends_education_history, user_relationship_details, friends_relationship_details, friends_interests, friends_likes, friends_relationships',
	));

	echo '<fb:redirect url="' . $loginUrl . '" />';

	echo $loginUrl;
}

function get_user_details($uid)
{
	global $facebook;
	$user = $facebook->getUser();



	$fql = "SELECT first_name, middle_name, last_name, sex, activities, interests, music, tv, movies, books, hs_info, education_history, work_history, relationship_status, hometown_location, birthday_date, birthday FROM user WHERE uid = $uid";
	$param  =   array(
		'method'    => 'fql.query',
		'access_token' => $cookie['access_token'],
		'query'     => $fql,
		'callback'  => ''
	);

	$user_info   =   $facebook->api($param);
	//debug_r($user_info, 'user_deatils');

	$fql = "SELECT uid2 from friend WHERE uid1 = '$uid'";
	$param  =   array(
		'method'    => 'fql.query',
		'access_token' => $cookie['access_token'],
		'query'     => $fql,
		'callback'  => ''
	);

	try {
		$user_friends   =   $facebook->api($param);
	}
	catch(Exception $e) {
		$user_friends = array();
	}

	$user_friends = array_map(create_function('$s','return $s[\'uid2\'];'), $user_friends);
	$fql = "SELECT status_id,message FROM status WHERE uid = '$uid'";
	$param  =   array(
		'method'    => 'fql.query',
		'access_token' => $cookie['access_token'],
		'query'     => $fql,
		'callback'  => ''
	);

	try {
		$user_statuses   =   $facebook->api($param);
	} catch (Exception $e) {
		$user_statuses = array();
	}

	//debug_r($user_statuses, 'statuses');

	$user_details = array_merge($user_info[0], array(
		'friends' => $user_friends,
		'statuses' => $user_statuses,
	));

	return $user_details;
}

function get_random_friend()
{
	global $facebook;

	$user = $facebook->getUser();
	printf("user id: $user\n");

	// get user ids of friends

	$qry = "SELECT uid2 FROM friend WHERE uid1 = me()";
	$param  =   array(
		'method'    => 'fql.query',
		'access_token' => $cookie['access_token'],
		'query'     => $qry,
		'callback'  => ''
	);

	$fuids   =  $facebook->api($param);

	// Now return a random friend's id.

	$friendlistSize = count($fuids);
	$randomIndex = rand ();
	$randomIndex = $randomIndex % $friendlistSize; 

	$subarray = $fuids[$randomIndex];
	$result = $subarray["uid2"];

	return $result;
}
