<?PHP
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
?>