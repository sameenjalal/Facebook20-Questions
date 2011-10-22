<?php

include 'facebook/facebook.php';

$p = get_profile_pictures(796985133);
//print_r($p);

function get_profile_pictures($friendUid){
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


		  // get user ids of friends

		  $qry = "SELECT id, pic_big FROM profile WHERE id = me() OR id = $friendUid";
		  $param  =   array(
								'method'    => 'fql.query',
								'access_token' => $cookie['access_token'],
								'query'     => $qry,
								'callback'  => ''
								);

		  $result   =  $facebook->api($param);
		  return $result;
}
