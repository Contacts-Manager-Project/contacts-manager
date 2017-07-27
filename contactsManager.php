<?php
require 'lib.php';
define("FILENAME", 'contacts.txt');
// Using "readDoc() and writeDoc()" from lib.php
//======================================================================
//						Title Bar
//======================================================================
function titleBar(){
	printf("|=====================================================================================|\n");
	printf("|   ,---.          |              |             ,-.-.                                 |\n");
	printf("|   |    ,---.,---.|--- ,---.,---.|--- ,---.    | | |,---.,---.,---.,---.,---.,---.   |\n");
	printf("|   |    |   ||   ||    ,---||    |    `---.    | | |,---||   |,---||   ||---'|       |\n");
	printf("|   `---'`---'`   '`---'`---^`---'`---'`---'    ` ' '`---^`   '`---^`---|`---'`       |\n");
	printf("|                                                                   `---'             |\n");
	printf("|=====================================================================================|\n");
}


//===============================================================================================
//                                        makeContactArray
//===============================================================================================
function makeContactArray($doc){
  	$contactsArray = readDoc($doc);
	$contactsArray = explode("\n",$contactsArray);
	foreach ($contactsArray as $key => $person) {
	    $person = explode('|',$person);
	    $person[1] = substr($person[1],0,3) . "-" . substr($person[1],3,3) . "-" . substr($person[1],6,4);
	    $personInfo['name'] = $person[0];
	    $personInfo['number'] = $person[1];
	    $contactsArray[$key] = $personInfo;
    }
    return $contactsArray;
  }

//===============================================================================================
//                                        viewContacts
//===============================================================================================
function viewContacts($contactsArray){
  
  
  $names = [];
  foreach ($contactsArray as $key => $value) {
  		array_push($names, $value['name']);
  }
  $names = array_map('strlen',$names);
  rsort($names);
  $longest = $names[0];

  echo str_pad('NAME ',$longest);
  echo ' | ';
  echo "NUMBER\n";

  foreach ($contactsArray as $key => $person) {
    echo str_pad($person['name'], $longest) . " | " . str_pad($person['number'], $longest) . PHP_EOL;
  }
  return options(FILENAME);
}

//===============================================================================================
//                                        promptUser
//===============================================================================================
function promptUser(){
  do{
    fwrite(STDOUT, "Please Select an Action by Number: ");
    $response = trim(fgets(STDOUT));
  }while (!$response);
  return $response;
  echo "\r";
}

//===============================================================================================
//                                        options
//===============================================================================================
function options($doc){
  fwrite(STDOUT, "\n\nActions:\n 1. View Contacts\n 2. Add Contact\n 3. Delete Contact\n 4. Search Contacts\n 5. Exit\n");
  switch (promptUser()) {
    case 1:
    	//View Contacts
	    clearScreen();
	    titleBar();
	    viewContacts(makeContactArray($doc));
	    break;
    case 2:
    	//Add
	    echo "You have selected Add Contact\n";
	    break;
    case 3:
    	//Delete
	    echo "You have selected Delete Contact\n";
	    break;
    case 4:
    	//Search
	    echo "You have selected Search Contacts\n";
	    break;
    case 5:
    	//Exit
	    echo "You have selected Exit\n";
	    break;
    case "\n":
	    useSameLine();
	    echo "Please enter a valid response!\n";
	    break;
    default:
	    useSameLine();
	    echo "Please enter a valid response: ";
	    break;
  }
}

//===============================================================================================
//                                        Search Function
//===============================================================================================

// function searchContacts() {

// }










//===============================================================================================
//                                        Actual Program
//===============================================================================================


clearScreen();
titleBar();
options(FILENAME);


























