<?
	$category_data = array 
	(
		'relationship_status' => array(
			'name' => 'relationship_status',
			'type' => 'dropdown',
			'choices' => array(
				'single',
				'engaged',
				'married',
				'complicated',
				'open_relationship',
				'widowed',
				'separated',
				'divorced',
				'civil_union',
				'domestic_partnership',
			),
		),
		'religious_views' => array(
			'name' => 'religious_views',
			'type' => 'text',
		),
		'political_views' => array(
			'name' => 'political_views',
			'type' => 'text',
		),
		'status_updates' => array(
			'name' => 'status_updates',
			'type' => 'text',
		),
		'education_info' => array(
			'name' => 'education_info',
			'type' => 'text',
		),
		'interests' => array(
			'name' => 'interests',
			'type' => 'text',
		),
		'friends' => array(
			'name' => 'friends',
			'type' => 'text',
		),
	);

	function human_name($str)
	{

		$str = str_replace('_', ' ', $str);

		$rv = '';

		foreach(explode(' ', $str) as $part)
			$rv .= ucfirst($part). ' ';

		return trim($rv);
	}
?>
