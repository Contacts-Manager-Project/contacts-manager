<?php
require 'lib.php';
require 'colors.php';
define("FILENAME", 'contacts.txt');
// Using "readDoc() and writeDoc()" from lib.php


//===============================================================================================
//                                          WH checker
//===============================================================================================

function getWH() {
  $WIDTH = trim(`tput cols`);
  $HEIGHT = trim(`tput lines`);

  if ($WIDTH >= 78){
      titleBar();
    } else if ($WIDTH <= 78){
    halfTitle();
  }
}


// //===============================================================================================
// //                                        makeContactArray
// //===============================================================================================
function makeContactArray($doc){
  clearstatcache();
  $contactsArray = trim(readDoc($doc));
	$contactsArray = explode("\n",$contactsArray);
  $contacts =[];
	foreach ($contactsArray as $key => $person) {
      if ($person[0] == "\0") {
        continue;
      }else {
        $person = explode('|',$person);

        if (strlen($person[1]) == 10){
          $person[1] = substr($person[1],0,3) . "-" . substr($person[1],3,3) . "-" . substr($person[1],6,4);
          $personInfo['name'] = $person[0];
          $personInfo['number'] = $person[1];
          array_push($contacts,$personInfo);
        } else {
          $person[1] = substr($person[1],0,3) . "-" . substr($person[1],3,4);
          $personInfo['name'] = $person[0];
          $personInfo['number'] = $person[1];
          array_push($contacts,$personInfo);
        }
      }
    }

    return $contacts;
  }

//===============================================================================================
//                                        viewContacts
//===============================================================================================
function viewContacts($contactsArray){
  clearstatcache();

  $names = [];
  foreach ($contactsArray as $key => $value) {
  		array_push($names, $value['name']);
  }
  $names = array_map('strlen',$names);
  rsort($names);
  $longest = $names[0];
  echo cyan(str_pad("=============================", $longest));
  echo PHP_EOL . str_pad("", 4) . cyan(str_pad("NAME", $longest -4));
  echo cyan(' | ');
  echo str_pad("", 4). cyan("NUMBER\n");
  echo cyan(str_pad("=============================\n", $longest));


  foreach ($contactsArray as $key => $person) {
    echo str_pad($person['name'], $longest) . cyan(" | ") . str_pad($person['number'], $longest) . PHP_EOL;
  }
  return options(FILENAME);
}

//===============================================================================================
//                                        promptUser
//===============================================================================================
function promptUser(){
  do{
    fwrite(STDOUT, cyan("Please Select an Action by Number: "));
    $response = trim(fgets(STDOUT));
  }while (!$response);
  return $response;
  echo "\r";
}

//===============================================================================================
//                                        options
//===============================================================================================
function options($doc){
  fwrite(STDOUT, PHP_EOL . red('Actions:') . "\n 1. View Contacts\n 2. Add Contact\n 3. Delete Contact\n 4. Search Contacts\n 5. Reset Screen\n 6. Exit\n");
  switch (promptUser()) {
    case 1:
    	//View Contacts
	    clearScreen();
	    getWH();
	    viewContacts(makeContactArray($doc));
	    break;
    case 2 :
    	//Add
      clearScreen();
	    getWH();
	    addContact(FILENAME);
	    break;
    case 3:
    	//Delete
      deleteContact(FILENAME);
	    break;
    case 4:
    	//Search
      clearScreen();
	    getWH();
      searchContacts(makeContactArray($doc));
	    break;
    case 5:
        clearScreen();
        getWH();
        options(FILENAME);
        break;
    case 6:
      //Exit
      if (`cowsay moo`){
        clearScreen();
        echo cyan(`cowsay Goodbye`, true);
      } else {
        clearScreen();
        echo cyan("Goodbye");
      }
      break;
    default:
      echo "Please enter a valid response!\n";
      sleep(1);
	    clearScreen();
      getWH();
      options(FILENAME);
      promptUser();
	    break;
  }
}

//===============================================================================================
//                                        Search Function
//===============================================================================================

function searchContacts($contactArray){
  clearstatcache();
  fwrite(STDOUT,'ENTER A NAME: ');
  $name = trim(fgets(STDIN));
  $name = strtoupper($name);
  $names = [];
  foreach ($contactArray as $key => $value) {
  		$names{strtoupper($value['name'])} = $value['number'];
  }
  if (array_key_exists($name,$names)) {
    echo "Their number is: " . $names[$name];
  }else {
    echo red("NAME DOES NOT EXIST");
  }
  return options(FILENAME);
}

//===============================================================================================
//                                       Add Contact Function
//===============================================================================================

function addContact($doc){
  clearstatcache();
  fwrite(STDOUT,"ENTER CONTACT NAME: ");
  $newContact = trim(fgets(STDIN));
  $newContact = $newContact . "|";

  $number;
  do {
    fwrite(STDOUT,"ENTER CONTACT NUMBER BETWEEN 7 AND 10 DIGITS: ");
    $number = fgets(STDIN);
    // var_dump($number);
    // var_dump(strlen($number));
  } while (strlen($number) !== 11 && strlen($number) !== 8);
  $newContact = $newContact . $number;
  writeDoc($doc,$newContact);
  return options(FILENAME);
}
//===============================================================================================
//                                       Add Delete Function
//===============================================================================================

function deleteContact($doc){
    fwrite(STDOUT,'ENTER NAME FOR DELETION: ');
    $name = trim(fgets(STDIN));
    $name = strtoupper($name);
    $contactList = readDoc($doc);
    $offset = stripos($contactList, $name);
    $end = stripos($contactList,"\n",$offset) - $offset;
    // var_dump($end);
    $spaces = "";
  for ($i=0; $i < $end  ; $i++) {
    $spaces .= "\0";
  }
  // var_dump($spaces);
  echo "$spaces";
    $contacts = fopen($doc,'r+');
    fseek($contacts,$offset);
    fwrite($contacts,$spaces);
    fclose($contacts);
  return options(FILENAME);
}
//===============================================================================================
//                                        Actual Program
//===============================================================================================


clearScreen();
getWH();
options(FILENAME);
