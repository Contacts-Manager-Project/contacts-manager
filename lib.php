<?php

function is_even($arg)
{
	if (is_numeric($arg)){
		if ($a % 2 === 0){
			return true;
		} else {
			return false;
		}
	} else {
		return "NaN\n";
	}
}

function is_vowel($arg)
{
		switch ($arg) {
			case 'a':
				return true;
				break;
			case 'e':
				return true;
				break;
			case 'i':
				return true;
				break;
			case 'o':
				return true;
				break;
			case 'u':
				return true;
				break;

			default:
				return false;
				break;
		}
}

function first($arg)
{
	if (is_array($arg)){
		return current($arg);
	} else {
		$arr = str_split($arg);
		return $arr[0];
	}
}
function second($arg)
{
	if (count($arg) > 1){
		if (is_array($arg)){
			return next($arg);
		} else {
			$arr = str_split($arg);
			return next($arr);
		}
	} else {
		return "ERROR: Can't get second of single item";
	}
}
function last($arg)
{
	if (is_array($arg)){
		return end($arg);
	} else {
		return end(str_split($arg));
	}
}

function reverse($arg, $preserve = false)
{
	if (is_array($arg)){
		return array_reverse($arg, $preserve);
	} else {
		return implode(array_reverse(str_split($arg), $preserve));
	}
}

function random($arg)
{
	if (is_array($arg)){
		$num = mt_rand(0, (count($arg) -1));
		return $arg[$num];
	} else {
		$arr = str_split($arg);
		$num = mt_rand(0, (count($arr) - 1));
		return $arr[$num];
	}
}
function randColor(){
	$num = '';
	for ($i = 0; $i <= 5; $i++ ){
		$num .= random('ABCDEF0123456789');
	}

	echo "\$randColor: # $num;" . PHP_EOL;
}

function append($fileName, $string)
{
	$handle = fopen($filename, 'a');
	fwrite($handle, $string);
	fclose($handle);
}

//Reads the doc
function readDoc($doc){
	$handle = fopen($doc,'r');
	$contents = trim(fread($handle, filesize($doc)));
	fclose($handle);
	return $contents;
}

//Writes to the doc
function writeDoc($doc,$newString){
	$handle = fopen($doc,'a');
	$newContents = fwrite($handle, $newString);
	fclose($handle);
	return $newcontents;
}

function useSameLine(){
	echo `tput cuu1`;
	echo `tput el`;
}
function clearScreen(){
	echo `clear && printf '\e[3J'`;
}