<?
	if(!isset($_POST['category']) || !$_POST['category'])
	{
		echo "Error. Please check your request.";
		exit;
	}

	require('question_type_array.php');

	$category = $_POST['category'];
	
	$category_arr = $category_data[$category];
	switch($category_arr['type'])
	{
	case 'dropdown':
?>
		<p> Choose an option </p>
		<select id="choice_dropdown" name="choice">
			<option value=""> Please select </option>
			<? foreach($category_arr['choices'] as $choice): ?>
				<option value="<?=$choice; ?>"> <?= human_name($choice); ?> </option>
			<? endforeach; ?>
		</select>
<?
	break;
	case 'text':
?>
		<p> Please enter some text: </p>
		<input type="text" name="choice"/>
<?
		break;
	default:
		exit("Invalid data.");
	}
?>
