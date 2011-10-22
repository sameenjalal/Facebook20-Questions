<? 
include 'getProfilePictures.php';
	//$one = $_POST['first_picture'];
	//$two = $_POST['second_picture'];
	//$success = $_POST['success'];
	$pictures = get_profile_pictures(1051411742);
	
	$one = $pictures[0]["pic_big"];
	$two = $pictures[1]["pic_big"];
	$success = 1;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<link rel="stylesheet" type="text/css" href="main.css" media="screen" />
<img src="embeds/facebook_banner.png" />
	<div id="end">
		<img src="<?=$one;?>" id="left" width="200px" style="padding-left:50px; padding-top: 50px"/>
		<img src="<?=$two;?>" id="right" width="200px" style="padding-left: 200px; padding-top: 50px"/>
	<? if ($success) { ?>
		<h1 style="font-color: green;">Awesome job! You actually know your friends!</h1>
	<? } else { ?>
		<h1 style="font-color: red; float: right;">Aw boo... You need to get call this person and get to know your friend</h1>
	<? } ?>
	</div>
</html>
