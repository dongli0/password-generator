<?php

function read_dictionary($filename=""){
//can use full path or relative path
$dictionary_file = "dictionries/{$filename}";
return file($dictionary_file,FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

}

function pick_random($array){
	//array_rand()uses rand() & libc random number gnerator
	//which is slower, less randow than mt_rand();
	//$i = array_rand($array);
	$i = mt_rand(0,count($array)-1);
	return $array[$i];
}
function pick_random_symbol(){
	$symbols = '$*?!-';
	$i = mt_rand(0,strlen($symbols)-1);
	return $symbols[$i];
}
function pick_random_number($digits=1){
	$min = pow(10,($digits -1));
	$max = pow(10, $digits) - 1;
	return strval(mt_rand($min,$max));
}
function filter_words_by_length($array,$length){
	$select_words = array();
	foreach ($array as $word) {
		if (strlen($word) ==$length ) {
			$select_words[] = $word;
		}
	}
	return $select_words;
}
function pick_random_word($words,$length){
	$select_words =  filter_words_by_length($words,$length);
	return pick_random($select_words);
}

$basic_words = read_dictionary('friendly_words.txt');
$brand_words = read_dictionary('brand_words.txt');

$words = array_merge($brand_words,$basic_words);
//could use array_unique

$length =12;
$words_count= 2;
$digits_count =2;
$symbols_count =1;
$avg_wlength = ($length - $digits_count - $symbols_count)/$words_count;


$password = '';

$next_wlength = mt_rand($avg_wlength -1 ,$avg_wlength+1);
$password .= pick_random_word($words,$next_wlength);

$password .= pick_random_symbol();
$password .= pick_random_number(3);

$next_wlength = $length - strlen($password);
$password .= pick_random_word($words,$next_wlength);


echo "friendly password ".$password ."<br/>";
echo "length " .strlen($password) ."<br/>";

?>