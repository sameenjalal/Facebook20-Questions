<?php

require 'facebook/facebook.php';
require "question_type_array.php";
require "helpers.php";

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

if (!$session) //if user is not logged in, redirect to login page.
{
	$loginUrl = $facebook->getLoginUrl(array(
		'canvas' => 1,
		'fbconnect' => 0,
		'req_perms' => 'friends_status, friends_birthday, friends_education_history, user_relationship_details, friends_relationship_details, friends_interests, friends_likes, friends_relationships',
	));

	echo '<fb:redirect url="' . $loginUrl . '" />';

	echo $loginUrl;

	exit;
}

$user = $facebook->getUser();

?>

<link rel="stylesheet" type="text/css" href="<?= BASE_URL?>embeds/main.css" media="screen" />
<script type="text/javascript" src="<?= BASE_URL?>embeds/jquery-1.5.2.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		var Guess = {
			start: function() {
				$.ajax({
					url: '/hackny/trunk/ajax_guess.php',
					data: {
						action: 'start'
					},
					success: function(response) {
						response_json = $.parseJSON(response);
						$('#start_game').remove();
						console.log(response_json);
					}
				});
			},
			render_info: function(info) {
				
			};
			

		};

		$('#start_game').click(Guess.start);
	});
</script>

<img src="<?= BASE_URL?>embeds/facebook_banner.png" />
<div id="wrapper">
	<p> Think you know your Facebook friends well? See if you can guess which friend we're thinking about by asking us twenty questions! </p>

	<button id="start_game"><img src="<?= BASE_URL?>embeds/start_game.png" /> </button>
	<div id="known_info"> </div>
	<div id="guess_form">
	</div>
</div>

