<?PHP

class Player {
	public $cardpool, $curve, $colors, $signal;
	function __construct() {
		$this->cardpool = array(); //stores all the picked cards
		$this->curve = array(
			0 => 0, //lands and 0-cost artifacts
			1 => 0,
			2 => 0,
			3 => 0,
			4 => 0,
			5 => 0,
			6 => 0,
			7 => 0,
			"FX" => 0, //flexible cost as with Gearseeker Serpent or Metalwork Colossus
		);
		$this->colors = array( //keeps track of the player's colors
			"W" => new Color,
			"U" => new Color,
			"G" => new Color,
			"R" => new Color,
			"B" => new Color,
		);
		$this->signal = array( //keeps track of high priority cards in passing packs by color to inform decisions based on availability of colors
			"W" => new Signal,
			"U" => new Signal,
			"G" => new Signal,
			"R" => new Signal,
			"B" => new Signal,	
		);
	}
}

class Color {
	public $quality, $quantity, $color;
	function __construct() {
		$this->quality = 0; //stores LSV values of card of a given color provided their value is > 20
		$this->quantity = 0; //stores the number of all the cards whose values have been added to the quantity parameter for a given color
		$this->color = ""; //stores the color of the signal for card picking purposes
	}
}

class Signal extends Color {
	public $signal;
	function __construct() {
		$this->quality = 0; //stores LSV values of card of a given color provided their value is > 20
		$this->quantity = 0; //stores the number of all the cards whose values have been added to the quantity parameter for a given color
		$this->color = ""; //stores the color of the signal for card picking purposes
		$this->signal = FALSE; //this is to note if the signal is stronger than the player's primary colors
	}
}

class Card {
	public $number, $color, $concost, $archetype, $subtype, $themes, $LSV;
	function __construct($num, $conn) {
		$this->number = $num;
		$sql = "SELECT color, concost, archetype, sub_type, themes, LSV FROM kld WHERE number=\"" . $this->number . "\"";
		if ($result = $conn->query($sql)) {
			while ($row = $result->fetch_row()) {
				$this->color = $row[0];
				$this->concost = $row[1];
				$this->archetype = $row[2];
				$this->subtype = explode (", ", $row[3]);
				$this->themes = explode (", ", $row[4]);
				$this->LSV = $row[5];
			}
		}
	}
}

class Benchmark{
	public $selector, $value;
	function __construct() {
		$this->selector = 0;
		$this->value = 0;
	}
}
?>