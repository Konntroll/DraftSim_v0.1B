<?PHP
require_once "classes.php";
session_start();
require_once "login.php"; //connects to the DB
require_once "pick.php"; //contains functions used hereunder

if (isset($_POST['card'])) {
	for ($card = 0; $card < count($_SESSION['draft'][$_SESSION['round']][0]); $card++) {
		if ($_SESSION['draft'][$_SESSION['round']][0][$card]->number = $_POST['card']) {
			$temp = clone $_SESSION['draft'][$_SESSION['round']][0][$card];
			array_splice($_SESSION['draft'][$_SESSION['round']][0], $card, 1);
			break;
		}
	}	
	array_push($_SESSION['players'][0]->cardpool, $temp);
	for ($player = 1; $player < 8; $player++) { //goes through picks for players 1 through 7 with position 0 reserved for the humam player
		$temp = array(); //used for cloning of cards in the current booster for draft functions to perform operations on them without changing the properties of the actual booster
		for ($card = 0; $card < count($_SESSION['draft'][$_SESSION['round']][$player]); $card++) {
			$temp[$card] = clone $_SESSION['draft'][$_SESSION['round']][$player][$card]; //copies the player's booster to perform operations with the cards therein without changing the properties of the original booster
		}
		$pick = pick(&$temp, $player); //iterates over the player's cardpool to check each card in it against what is in the booster and to adjust LSV values of cards in the booster accordingly
		array_splice($_SESSION['draft'][$_SESSION['round']][$player], $pick, 1);
		unset($temp); //purges the array for future use, just in case
	}
	if ($_SESSION['round'] == 1) { //passes the boosters around the table according to the round
		array_unshift($_SESSION['draft'][$_SESSION['round']], array_pop($_SESSION['draft'][$_SESSION['round']]));
	} else {
		array_push($_SESSION['draft'][$_SESSION['round']], array_shift($_SESSION['draft'][$_SESSION['round']]));
	}
	if ($_SESSION['round'] != 2 && count($_SESSION['draft'][$_SESSION['round']][7]) == 0) $_SESSION['round']++; //checks if it's time for the next round
	if ($_SESSION['round'] == 2 && count($_SESSION['draft'][$_SESSION['round']][7]) == 0) { //checks if the draft is over and displays the picks made by the human player if it is
		$JSpass = array(); //used to extract numbers from card objects in order to pass to JS player/computer interface
		for ($card = 0; $card < count($_SESSION['players'][0]->cardpool); $card++) {
			$JSpass[$card] = $_SESSION['players'][0]->cardpool[$card]->number;
		}
		unset($_SESSION['players']);
		unset($_SESSION['round']);
		unset($_SESSION['draft']);
		echo json_encode($JSpass);
	} else { //displays the next booster for the human player to pick from
		$JSpass = array(); //used to extract numbers from card objects in order to pass to JS player/computer interface
		for ($card = 0; $card < count($_SESSION['draft'][$_SESSION['round']][0]); $card++) {
			$JSpass[$card] = $_SESSION['draft'][$_SESSION['round']][0][$card]->number;
		}
		echo json_encode($JSpass);
		unset($JSpass); //purges the array for future use, just in case
	}
}
?>