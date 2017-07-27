<?php
require 'lib.php';
//======================================================================
// Using "readDoc() and writeDoc()" from lib.php
function titleBar(){
	printf("|=====================================================================================|\n");
	printf("|   ,---.          |              |             ,-.-.                                 |\n");
	printf("|   |    ,---.,---.|--- ,---.,---.|--- ,---.    | | |,---.,---.,---.,---.,---.,---.   |\n");
	printf("|   |    |   ||   ||    ,---||    |    `---.    | | |,---||   |,---||   ||---'|       |\n");
	printf("|   `---'`---'`   '`---'`---^`---'`---'`---'    ` ' '`---^`   '`---^`---|`---'`       |\n");
	printf("|                                                                   `---'             |\n");
	printf("|=====================================================================================|\n");
}

function viewContacts($doc){
  $contents = readDoc($doc);
  $contents = explode("\n",$contents);
  foreach ($contents as $key => $person) {
    $person = explode('|',$person);
    $person[1] = substr($person[1],0,3) . "-" . substr($person[1],3,3) . "-" . substr($person[1],6,4);
    $personInfo['name'] = $person[0];
    $personInfo['number'] = $person[1];
    $contents[$key] = $personInfo;
    }
  
  $names = [];
  foreach ($contents as $key => $value) {
  		array_push($names, $value['name']);
  }
  $names = array_map('strlen',$names);
  rsort($names);
  $longest = $names[0];

  echo str_pad('NAME ',$longest);
  echo ' | ';
  echo "NUMBER\n";

  foreach ($contents as $key => $person) {
    echo str_pad($person['name'], $longest) . " | " . str_pad($person['number'], $longest) . PHP_EOL;
  }
  return options($doc);
}


function promptUser(){
  do{
    fwrite(STDOUT, "Please Select an Action by Number: ");
    $response = trim(fgets(STDOUT));
  }while (!$response);
  return $response;
  echo "\r";
}
function options($doc){
  fwrite(STDOUT, "\n\nActions:\n 1. View Contacts\n 2. Add Contact\n 3. Delete Contact\n 4. Search Contacts\n 5. Exit\n");
  switch (promptUser()) {
    case 1:
    echo "You have selected Contacts\n";
    clearScreen();
    titleBar();
    viewContacts($doc);
    break;
    case 2:
    echo "You have selected Add Contact\n";
    break;
    case 3:
    echo "You have selected Delete Contact\n";
    break;
    case 4:
    echo "You have selected Search Contacts\n";
    break;
    case 5:
    echo "You have selected Exit\n";
    break;
    case null:
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
//                                        Actual Program
//===============================================================================================
$doc = 'contacts.txt';

clearScreen();
titleBar();
options($doc);


























