<?php 

function random_char($string){
	$i =  mt_rand(0,strlen($string)-1);
	return $string[$i];
}

function random_string($length,$char_set){

	$output = '';

	for ($i=0; $i < $length; $i++) { 
		$output .= random_char($char_set);
	}
	return $output;
}
function generate_password($options){
	$lower = implode(range('a', 'z'));
	$upper = implode(range('A','Z'));
	$number = implode(range(0, 9));
	$symbols = '$*?!-';

	//extract configuration flags into variables
	$use_lower = isset($options['lower']) ? $options['lower'] : '0';
	$use_upper= isset($options['upper']) ? $options['upper'] : '0';
	$use_number = isset($options['number']) ? $options['number'] : '0';
	$use_symbols= isset($options['symbols']) ? $options['symbols'] : '0';

	$chars= '';
	if ($use_lower === '1') { $chars .= $lower;}
	if ($use_upper === '1') { $chars .= $upper;}
	if ($use_number === '1') { $chars .= $number;}
	if ($use_symbols === '1') { $chars .= $symbols;}

	//$chars = $upper . $lower . $number . $symbols;
	$length = isset($options['length']) ? $options['length'] : 8;
	return  random_string($length, $chars);
}

$options = array(
	'length' => $_GET['length'],
	'lower' => $_GET['lower'],
	'upper' => $_GET['upper'],
	'number' => $_GET['number'],
	'symbols' => $_GET['symbols']
);
$password = generate_password($options);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8"> 
	<title>Password Generator</title>
</head>
<body>
	<p>Generated Password: <?php echo $password;  ?></p>

	<p>Generated a new password using the form options.</p>

	<form action="" method="get">
		Length: <input type="text" name="length" value="<?php if (isset($_GET['length'])) { echo $_GET['length'];}?>"/><br/>
		<input type="checkbox" name="lower" value="1"
		 <?php if(@$_GET['lower'] ==1 ) { echo 'checked';} ?> >Lowercase<br/></input>
		<input type="checkbox" name="upper" value="1" 
		<?php if(@$_GET['upper'] ==1 ) { echo 'checked';} ?>>Upper<br/></input>
		<input type="checkbox" name="number" value="1" 
		<?php if(@$_GET['number'] ==1 ) { echo 'checked';} ?>>Number<br/></input>
		<input type="checkbox" name="symbols" value="1"
		<?php if(@$_GET['symbols'] ==1 ) { echo 'checked';} ?> >Symbols<br/></input>
		<input type="submit" value="Submit"></input>

	</form>
</body>
</html>