<?PHP
require_once "classes.php";
function boostgen() {
	
	//establish connection to MySQL and access the magic DB
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "magic";

	$conn = new mysqli($servername, $username, $password, $dbname);
	
	//provisional clause for output in case of connection failure
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	
	//set up a multi-array with index[0] corresponding to Rares/Mythics, [1-3] to Uncommons, [4-13] to Commons with [4] reserved for foils if any, and [14] to a basic land
	$booster = array();

	//assign a rare or mythic
	if (rand(1, 144) == 144) {
		$sql = "SELECT number FROM kld WHERE rarity='I'";
		$result = $conn->query($sql);
	} elseif (rand(1, 8) == 8) {
		$sql = "SELECT number FROM kld WHERE rarity='M'";
		$result = $conn->query($sql);
	} else {
		$sql = "SELECT number FROM kld WHERE rarity='R'";
		$result = $conn->query($sql);
	}
		$offset = 0;
		while($row = $result->fetch_assoc()) {
			$temp[$offset] = $row["number"];
			++$offset;
		}
		shuffle($temp);
		$booster[0] = $temp[0];
	
	unset($temp); //purge the array previously created as fetching a new set of cards by a different rarity somehow fails to override the previously assigned values
	//assign uncommons
	$sql = "SELECT number FROM kld WHERE rarity='U'";
	$result = $conn->query($sql);
	$offset = 0;
	while($row = $result->fetch_assoc()) {
		$temp[$offset] = $row["number"];
		++$offset;
	}
	shuffle($temp);
	for ($unc = 1; $unc <=3; $unc++) {
		$booster[$unc] = $temp[$unc];
	}
	
	unset($temp); //purge the array previously created as fetching a new set of cards by a different rarity somehow fails to override the previously assigned values
	//assign commons and, if necessary, a foil
	if (rand(1,6) == 6) {
		if (rand(1,8) == 8) {
			$sql = "SELECT number FROM kld WHERE rarity='M'";
			$result = $conn->query($sql);
		} else {
			$sql = "SELECT number FROM kld WHERE rarity!='M' AND rarity!='I'";
			$result = $conn->query($sql);
		}
		$offset = 0;
		while($row = $result->fetch_assoc()) {
			$temp[$offset] = $row["number"];
			++$offset;
		}
		shuffle($temp);
		$booster[4] = $temp[0];
		unset($temp);
		$sql = "SELECT number FROM kld WHERE rarity='C'";
		$result = $conn->query($sql);
		while($row = $result->fetch_assoc()) {
			$temp[$offset] = $row["number"];
			++$offset;
		}
		shuffle($temp);
		for ($com = 5; $com <=13; $com++) {
			$booster[$com] = $temp[$com];
		}
	} else {
		$sql = "SELECT number FROM kld WHERE rarity='C'";
		$result = $conn->query($sql);
		while($row = $result->fetch_assoc()) {
			$temp[$offset] = $row["number"];
			++$offset;
		}
		shuffle($temp);
		for ($com = 4; $com <=13; $com++) {
			$booster[$com] = $temp[$com];
		}
	}
	unset($temp); //purge the array previously created as fetching a new set of cards by a different rarity somehow fails to override the previously assigned values
	//assign a basic land
	$sql = "SELECT number FROM kld WHERE rarity='B'";
	$result = $conn->query($sql);
		$offset = 0;
		while($row = $result->fetch_assoc()) {
			$temp[$offset] = $row["number"];
			++$offset;
		}
		shuffle($temp);
		$booster[14] = $temp[0];
	for ($card = 0; $card < 15; $card++) {
		$booster[$card] = new Card ($booster[$card], $conn); //makes each card into a class
	}
	return $booster;
}
?>