<?php
	require 'lib.php';
//======================================================================
// Using "readDoc() and writeDoc()" from lib.php 
//======================================================================

	$doc = 'contacts.txt';
	$handle = fopen('contacts.txt', 'a');

	echo `clear`;


	printf("|=====================================================================================|\n");
	printf("|   ,---.          |              |             ,-.-.                                 |\n");
	printf("|   |    ,---.,---.|--- ,---.,---.|--- ,---.    | | |,---.,---.,---.,---.,---.,---.   |\n");
	printf("|   |    |   ||   ||    ,---||    |    `---.    | | |,---||   |,---||   ||---'|       |\n");
	printf("|   `---'`---'`   '`---'`---^`---'`---'`---'    ` ' '`---^`   '`---^`---|`---'`       |\n");
	printf("|                                                                   `---'             |\n");
	printf("|=====================================================================================|\n");



	fwrite(STDOUT, "\n\nActions:\n 1. View Contacts\n 2. Add Contact\n 3. Delete Contact\n 4. Search Contacts\n 5. Exit\n");
	function promptUser(){
		do{
		fwrite(STDOUT, "Please Select an Action by Number: ");
		$response = trim(fgets(STDOUT));
		}while (!$response);
		return $response;
		echo "\r";
	}
		switch (promptUser()) {
			case 1:
				echo "You have selected Contacts\n";
				
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


	fclose($handle);