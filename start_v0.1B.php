<?PHP
	require_once "classes.php";	
	session_start();
	require_once "login.php";
	require_once "kldboostgen.php";
	$_SESSION['round'] = 0;
	$_SESSION['players'] = array();
	for ($player = 0; $player < 8; $player++) {
		$_SESSION['players'][$player] = new Player;
	}
	$_SESSION['draft'] = array();
	for ($round = 0; $round < 3; $round++) {
		for ($booster = 0; $booster < 8; $booster++) {
			$_SESSION['draft'][$round][$booster] = boostgen();
		}
	}
	$JSpass = array();
	for ($card = 0; $card < count($_SESSION['draft'][0][0]); $card++) {
		$JSpass[$card] = $_SESSION['draft'][0][0][$card]->number;
	}
?>

<script>

var draft = <?PHP echo json_encode($JSpass); ?>

for (pick = 0; pick < draft.length; pick++) {
	document.write("<img id=" + "\"" + draft[pick] + "\"" + "onclick=cardPick(" + draft[pick] + ")" + " src=\"kld/" + draft[pick] + ".png\" width=\"240\" height=\"340\"> ");
}

function cardPick(cardNum) {
	params = ("card=" + cardNum)
	request = new XMLHttpRequest()
	request.open("POST", "klddraft.php", true)
	request.setRequestHeader("Content-type", "application/x-www-form-urlencoded")
	//request.setRequestHeader("Content-length", cardNum.length)
	//request.setRequestHeader("Connection", "close")
	request.onreadystatechange = function() {
		if (this.readyState == 4) {
			if (this.status == 200) {
				if (this.responseText != null) {
					document.body.innerHTML = ""
					draft = JSON.parse(this.responseText)
					for (pick = 0; pick < draft.length; pick++) {
						document.write("<img id=" + "\"" + draft[pick] + "\"" + "onclick=cardPick(" + draft[pick] + ")" + " src=\"kld/" + draft[pick] + ".png\" width=\"240\" height=\"340\"> ")
					}
				}
				else alert("Ajax error: No data received")
			}
			else alert( "Ajax error: " + this.statusText)
		}
	}
	request.send(params)
}
	
</script>