<?php
$result = array(17, 2, 41, 8, 5, 4, 3, 25, 19, 42 , 14 , 6 , 31 , 34 , 36 , 12 , 1 , 15 );
?>
<!DOCTYPE html>
<html>
<head>
	<base href="http://<?=$_SERVER['SERVER_NAME']?>/"/>
	<meta charset="UTF-8" />
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name='description' content='' />
	<meta name='keywords' content='' />
	<title></title>
	<style>
	.cart {
		float: left;
		margin: 10px;
	}
	td {
		padding: 5px;
		text-align: center;
	}
	.active {
		background-color: #00ff00;
	}
	.score {
		background-color: #000;
		color:#fff;
	}
	</style>
	</head>
	<body>
	<header>
<?php foreach($users as $_user) {?>
<table border="1" class="cart">
	<tr>
		<td colspan="5"><?=$_user->name;?></td>
		<td class='score'>
			<?=$_user->diagonal2[0]->score == 5 ? 'B' : $_user->diagonal2[0]->score;?>
		</td>
	</tr>
<?php 
foreach($_user->horizontal as $_row) {
	$_row_values = explode(",",$_row->value);
?>
	<tr>	
<?php 
	foreach($_row_values as $_row_value) { 
		$class="";
		if(in_array($_row_value,$result)){
			$class=" class='active'";			
		}
?>
		<td <?=$class;?>><?=$_row_value;?></td>

<?php } ?>
		<td class='score'><?=$_row->score == 5 ? 'B' : $_row->score;?></td>
	</tr>
<?php } ?>
	<tr>
<?php foreach($_user->vertical as $_row) { ?>
		<td class='score'><?=$_row->score == 5 ? 'B' : $_row->score;?></td>
<?php } ?>
		<td class='score'>
			<?=$_user->diagonal1[0]->score == 5 ? 'B' : $_user->diagonal1[0]->score;?>
		</td>
	</tr>
</table>
</div>
<?php } ?>