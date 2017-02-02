<?PHP
require_once "classes.php";
session_start;

function pick(&$booster, $player) {
	//the following statements serve to prep the player's cardpool parameters for possible evaluations
	$colors = array_keys($_SESSION['players'][$player]->colors); //now the keys of the $colors array correspond to colors in the player's cardpool in descending order
	$primary = new Color; //will store parameters for the player's main color
	$secondary = new Color; //will store parameters for the player's second most prominent color
	foreach ($colors as $color) {
		if ($_SESSION['players'][$player]->colors[$color]->quality > $primary->quality) {
			$secondary->quality = $primary->quality;
			$secondary->quantity = $primary->quantity;
			$secondary->color = $primary->color;
			$primary->quality = $_SESSION['players'][$player]->colors[$color]->quality;
			$primary->quantity = $_SESSION['players'][$player]->colors[$color]->quantity;
			$primary->color = $color;
		} elseif ($_SESSION['players'][$player]->colors[$color]->quality > $secondary->quality) {
			$secondary->quality = $_SESSION['players'][$player]->colors[$color]->quality;
			$secondary->quantity = $_SESSION['players'][$player]->colors[$color]->quantity;
			$secondary->color = $color;
		}
	}
	//end of prep and start of the pick process
	for ($i = 0; $i < count($booster); $i++) { //this will be used to apply all LSV adjustments at once and to prevent them from influencing each other in the course of the evaluation process
		$preeval[$i] = $booster[$i]->LSV;
	}
	foreach ($_SESSION['players'][$player]->cardpool as $card) { //checks the player's cardpool to see which cards in the booster would be the most relevant
		switch ($card->number) {
			case 3: //Aetherstorm Roc
				foreach ($booster as $option) {
					foreach ($option->themes as $theme) {
						 if ($theme == "tokens") $preeval[array_search($option, $booster)] += 2;
					}
				}
				break;
			case 4: //Angel of Invention
				foreach ($booster as $option) {
					foreach ($option->themes as $theme) { //rewards go-wide strategies
						 if ($theme == "tokens") $preeval[array_search($option, $booster)] += 2;
					}
				}
				break;
			case 12: //Eddytrail Hawk
				foreach ($booster as $option) {
					$evasion = null;
					foreach ($option->themes as $theme) {
						if ($theme == "evasion") $evasion = TRUE;
					}
					if (!$evasion) {
						if (($option->archetype == "C" || $option->archetype == "AC") && $option->LSV > 25) $preeval[array_search($option, $booster)]++;
					}
					unset($evasion);
				}
				break;
			case 16: //Gearshift Ace
				foreach ($booster as $option) {
					foreach($option->subtype as $subtype) {
						if ($subtype == "V") $preeval[array_search($option, $booster)] += 2;
					}
				}
				break;
			case 20: //Inspired Charge
				foreach ($booster as $option) {
					foreach ($option->themes as $theme) { //rewards aggressive go-wide strategies
						 if ($theme == "tokens") $preeval[array_search($option, $booster)]++;
						 if ($theme == "evasion") $preeval[array_search($option, $booster)]++;
					}
				}
				break;
			case 21: //Master Trinketeer
				foreach ($booster as $option) {
					foreach ($option->themes as $theme) { //rewards aggressive go-wide strategies
						 if ($theme == "tokens") $preeval[array_search($option, $booster)]++;
					}
					foreach($option->subtype as $subtype) {
						if ($subtype == "T") $preeval[array_search($option, $booster)] += 2;
					}
				}
				break;
			case 22: //Ninth Bridge Patrol
				foreach ($booster as $option) {
					foreach ($option->themes as $theme) {
						 if ($theme == "tokens") $preeval[array_search($option, $booster)]++;
						 if ($theme == "blink") $preeval[array_search($option, $booster)]++;
						 if ($theme == "bounce") $preeval[array_search($option, $booster)]++;
					}
				}
				break;
			case 32: //Toolcraft Exemplar
				foreach ($booster as $option) {
					if (($option->archetype == "A" || $option->archetype == "AC") && $option->LSV > 15 && $option->concost <= 3) $preeval[array_search($option, $booster)]++;
					foreach ($option->themes as $theme) {
						 if ($theme == "tokens") $preeval[array_search($option, $booster)]++;
					}
				}
				break;
			case 33: //Trusty Companion
				foreach ($booster as $option) {
					foreach($option->subtype as $subtype) {
						if ($subtype == "V") $preeval[array_search($option, $booster)]++;
					}
				}
				break;
			case 45: //Era of Innovation
				foreach ($booster as $option) {
					if (($option->archetype == "A" || $option->archetype == "AC") && $option->LSV > 15) $preeval[array_search($option, $booster)] += 2;
					foreach($option->subtype as $subtype) {
						if ($subtype == "A" && $option->LSV > 20) $preeval[array_search($option, $booster)] += 2;
					}
					foreach ($option->themes as $theme) {
						if ($theme == "tokens") $preeval[array_search($option, $booster)] += 2; //all Kaladesh tokens are artifacts
					}
				}
				break;
			case 48: //Gearseeker Serpent
				foreach ($booster as $option) {
					if (($option->archetype == "A" || $option->archetype == "AC") && $option->LSV > 15) $preeval[array_search($option, $booster)] += 2;
					foreach ($option->themes as $theme) {
						 if ($theme == "tokens") $preeval[array_search($option, $booster)] += 2;
					}
				}
				break;
			case 50: //Glint-Nest Crane
				foreach ($booster as $option) {
					if (($option->archetype == "A" || $option->archetype == "AC") && $option->LSV > 15) $preeval[array_search($option, $booster)] += 2;
				}
				break;
			case 56: //Metallurgic Summonings
				foreach ($booster as $option) {
					if (($option->archetype == "S" || $option->archetype == "I") && $option->LSV > 20) $preeval[array_search($option, $booster)] += 5;
				}
				break;
			case 59: //Padeem, Consul of Innovation
				foreach ($booster as $option) {
					if (($option->archetype == "A" || $option->archetype == "AC") && $option->LSV > 20) $preeval[array_search($option, $booster)] += 3;
				}
				break;
			case 62: //Saheeli's Artistry
				foreach ($booster as $option) {
					if (($option->archetype == "S" || $option->archetype == "I") && $option->LSV > 20) $preeval[array_search($option, $booster)] += 5;
				}
				break;
			case 64: //Shrewd Negotiation
				foreach ($booster as $option) {
					foreach ($option->themes as $theme) {
						 if ($theme == "tokens") $preeval[array_search($option, $booster)] += 3;
					}
				}
				break;
			case 67: //Torrential Gearhulk
				foreach ($booster as $option) {
					if ($option->archetype == "I" && $option->LSV > 20) $preeval[array_search($option, $booster)] += 5;
				}
				break;
			case 71: //Aetherborn Marauder
				foreach ($booster as $option) {
					foreach ($option->themes as $theme) {
						 if ($theme == "counters") $preeval[array_search($option, $booster)] += 2;
					}
				}
				break;
			case 74: //Dhund Operative
				foreach ($booster as $option) {
					if (($option->archetype == "A" || $option->archetype == "AC") && $option->LSV > 15) $preeval[array_search($option, $booster)] += 2;
					foreach ($option->themes as $theme) {
						 if ($theme == "tokens") $preeval[array_search($option, $booster)]++;
					}
				}
				break;
			case 78: //Eliminate the Competition
				foreach ($booster as $option) {
					foreach ($option->themes as $theme) {
						 if ($theme == "tokens") $preeval[array_search($option, $booster)] += 2;
					}
				}
				break;
			case 79: //Embraal Bruiser
				foreach ($booster as $option) {
					if (($option->archetype == "A" || $option->archetype == "AC") && $option->LSV > 15) $preeval[array_search($option, $booster)] += 2;
					foreach ($option->themes as $theme) {
						 if ($theme == "tokens") $preeval[array_search($option, $booster)]++;
					}
				}
				break;
			case 81: //Fortuitous Find
				foreach ($booster as $option) {
					if (($option->archetype == "A" || $option->archetype == "AC") && $option->LSV > 20) $preeval[array_search($option, $booster)]++;
				}
				break;
			case 82: //Foundry Screecher
				foreach ($booster as $option) {
					if (($option->archetype == "A" || $option->archetype == "AC") && $option->LSV > 15) $preeval[array_search($option, $booster)] += 2;
					foreach ($option->themes as $theme) {
						 if ($theme == "tokens") $preeval[array_search($option, $booster)]++;
					}
				}
				break;
			case 90: //Marionette Master
				foreach ($booster as $option) {
					foreach ($option->themes as $theme) {
						 if ($theme == "tokens") $preeval[array_search($option, $booster)] += 3;
						 if ($theme == "sacrifice artifact") $preeval[array_search($option, $booster)] += 3;
					}
				}
				break;
			case 92: //Midnight Oil
				foreach ($booster as $option) {
					if ($option->concost <= 3 && $option->LSV > 20) $preeval[array_search($option, $booster)] += 2;
				}
				break;
			case 94: //Morbid Curiosity
				foreach ($booster as $option) {
					if ($option->concost == "FX" && ($option->archetype == "C" || $option->archetype == "AC")) $preeval[array_search($option, $booster)] += 3;
				}
				break;
			case 97: //Ovalchase Daredevil
				foreach ($booster as $option) {
					if (($option->archetype == "A" || $option->archetype == "AC") && $option->LSV > 15) $preeval[array_search($option, $booster)] += 2;
					foreach ($option->themes as $theme) {
						if ($theme == "tokens") $preeval[array_search($option, $booster)]++; //all Kaladesh tokens are artifacts
					}
				}
				break;
			case 101: //Syndicate Trafficker
				foreach ($booster as $option) {
					if (($option->archetype == "A" || $option->archetype == "AC") && $option->LSV > 15) $preeval[array_search($option, $booster)] += 2;
					foreach ($option->themes as $theme) {
						if ($theme == "tokens") $preeval[array_search($option, $booster)] += 2; //all Kaladesh tokens are artifacts
					}
				}
				break;
			case 103: //Underhanded Designs
				foreach ($booster as $option) {
					if (($option->archetype == "A" || $option->archetype == "AC") && $option->LSV > 15) $preeval[array_search($option, $booster)] += 2;
					foreach ($option->themes as $theme) {
						if ($theme == "tokens") $preeval[array_search($option, $booster)]++; //all Kaladesh tokens are artifacts
					}
				}
				break;
			case 119: //Incendiary Sabotage
				foreach ($booster as $option) { 
					if (($option->archetype == "A" || $option->archetype == "AC") && $option->LSV >= 15) $preeval[array_search($option, $booster)]++;
				}
				break;
			case 120: //Inventor's Apprentice
				foreach ($booster as $option) {
					if (($option->archetype == "A" || $option->archetype == "AC") && $option->LSV > 20 && $option->concost <= 3) $preeval[array_search($option, $booster)]++;
				}
				break;
			case 125: //Quicksmith Genius
				foreach ($booster as $option) { 
					if (($option->archetype == "A" || $option->archetype == "AC") && $option->LSV >= 15) $preeval[array_search($option, $booster)]++;
					foreach ($option->themes as $theme) {
						if ($theme == "tokens") $preeval[array_search($option, $booster)] += 2; //all Kaladesh tokens are artifacts
					}
				}
				break;
			case 126: //Reckless Fireweaver
				foreach ($booster as $option) { 
					if (($option->archetype == "A" || $option->archetype == "AC") && $option->LSV >= 15) $preeval[array_search($option, $booster)]++;
					foreach ($option->themes as $theme) {
						if ($theme == "tokens") $preeval[array_search($option, $booster)] += 2; //all Kaladesh tokens are artifacts
					}
				}
				break;
			case 129: //Salivating Gremlins
				foreach ($booster as $option) { 
					if (($option->archetype == "A" || $option->archetype == "AC") && $option->LSV >= 15) $preeval[array_search($option, $booster)]++;
					foreach ($option->themes as $theme) {
						if ($theme == "tokens") $preeval[array_search($option, $booster)] += 2; //all Kaladesh tokens are artifacts
					}
				}
				break;
			case 132: //Speedway Fanatic
				foreach ($booster as $option) {
					 foreach($option->subtype as $subtype) {
						if ($subtype == "V") $preeval[array_search($option, $booster)] += 2;
					}
				}
				break;
			case 140: //Welding Sparks
				foreach ($booster as $option) { 
					if (($option->archetype == "A" || $option->archetype == "AC") && $option->LSV >= 15) $preeval[array_search($option, $booster)]++;
					foreach ($option->themes as $theme) {
						if ($theme == "tokens") $preeval[array_search($option, $booster)] += 2; //all Kaladesh tokens are artifacts
					}
				}
				break;
			case 144: //Armorcraft Judge
				foreach ($booster as $option) {
					foreach ($option->themes as $theme) {
						 if ($theme == "counters") $preeval[array_search($option, $booster)] += 2;
					}
				}
				break;
			case 145: //Attune with Aether
				foreach ($booster as $option) {
					if (strlen($option->color) == 1 && $option->color != $primary->color && $option->color != $secondary->color && $option->LSV > 30) $preeval[array_search($option, $booster)] += 2;
					elseif (strlen($option->color) > 1 && $option->color != $primary->color . $secondary->color && $option->color != $secondary->color . $primary->color) { //this is to check if either color of a multicolored card matches one of the player's primary colors and if the card is worth splashing
						$temp = preg_split('//', $option->color, -1, PREG_SPLIT_NO_EMPTY);
						foreach ($temp as $color) {
							if ($color != $primary->color && $color == $secondary->color && $option->LSV >= 30) $preeval[array_search($option, $booster)] += 2;
							elseif ($color == $primary->color && $color != $secondary->color && $option->LSV >= 30) $preeval[array_search($option, $booster)] += 2;
						}
					}
					unset($temp);
				}
				break;
			case 151: //Cultivator of Blades
				foreach ($booster as $option) {
					foreach ($option->themes as $theme) {
						if ($theme == "evasion") $preeval[array_search($option, $booster)]++;
						if ($theme == "tokens") $preeval[array_search($option, $booster)] += 2;
					}
				}
				break;
			case 153: //Durable Handicraft
				foreach ($booster as $option) {
					foreach ($option->themes as $theme) {
						if ($theme == "tokens" && $option->concost <= 3) $preeval[array_search($option, $booster)] += 2;
						elseif ($theme == "tokens") $preeval[array_search($option, $booster)]++;
					}
				}
				break;
			case 155: //Fairgrounds Trumpeter
				foreach ($booster as $option) {
					foreach ($option->themes as $theme) {
						if ($theme == "counters") $preeval[array_search($option, $booster)]++;
					}
				}
				break;
			case 169: //Servant of the Conduit
				foreach ($booster as $option) {
					if (strlen($option->color) == 1 && $option->color != $primary->color && $option->color != $secondary->color && $option->LSV > 30) $preeval[array_search($option, $booster)] += 2;
					elseif (strlen($option->color) > 1 && $option->color != $primary->color . $secondary->color && $option->color != $secondary->color . $primary->color) { //this is to check if either color of a multicolored card matches one of the player's primary colors and if the card is worth splashing
						$temp = preg_split('//', $option->color, -1, PREG_SPLIT_NO_EMPTY);
						foreach ($temp as $color) {
							if ($color != $primary->color && $color == $secondary->color && $option->LSV >= 30) $preeval[array_search($option, $booster)] += 2;
							elseif ($color == $primary->color && $color != $secondary->color && $option->LSV >= 30) $preeval[array_search($option, $booster)] += 2;
						}
					}
					unset($temp);
				}
				break;
			case 173: //Wild Wanderer
				foreach ($booster as $option) {
					if (strlen($option->color) == 1 && $option->color != $primary->color && $option->color != $secondary->color && $option->LSV > 30) $preeval[array_search($option, $booster)] += 2;
					elseif (strlen($option->color) > 1 && $option->color != $primary->color . $secondary->color && $option->color != $secondary->color . $primary->color) { //this is to check if either color of a multicolored card matches one of the player's primary colors and if the card is worth splashing
						$temp = preg_split('//', $option->color, -1, PREG_SPLIT_NO_EMPTY);
						foreach ($temp as $color) {
							if ($color != $primary->color && $color == $secondary->color && $option->LSV >= 30) $preeval[array_search($option, $booster)] += 2;
							elseif ($color == $primary->color && $color != $secondary->color && $option->LSV >= 30) $preeval[array_search($option, $booster)] += 2;
						}
					}
					unset($temp);
				}
				break;
			case 177: //Contraband Kingpin
				foreach ($booster as $option) { 
					if (($option->archetype == "A" || $option->archetype == "AC") && $option->LSV >= 20) $preeval[array_search($option, $booster)] += 2;
					foreach ($option->themes as $theme) {
						if ($theme == "tokens") $preeval[array_search($option, $booster)] += 2;
					}
				}
				break;
			case 178: //Depala, Pilot Exemplar
				foreach ($booster as $option) {
					foreach($option->subtype as $subtype) {
						if ($subtype == "V" || $subtype == "D") $preeval[array_search($option, $booster)] += 2;
					}
				}
				break;
			case 181: //Engineered Might
				foreach ($booster as $option) {
					foreach ($option->themes as $theme) {
						if ($theme == "evasion") $preeval[array_search($option, $booster)]++;
					}
				}
				break;
			case 188: //Veteran Motorist
				foreach ($booster as $option) {
					foreach($option->subtype as $subtype) {
						if ($subtype == "V") $preeval[array_search($option, $booster)] += 2;
					}
				}
				break;
			case 193: //Animation Module
				foreach ($booster as $option) {
					foreach ($option->themes as $theme) {
						if ($theme == "counters") $preeval[array_search($option, $booster)] += 2;
					}
				}
				break;
			case 200: //Chief of the Foundry
				foreach ($booster as $option) { 
					if ($option->archetype == "AC" && $option->LSV >= 20) $preeval[array_search($option, $booster)] += 2;
					foreach ($option->themes as $theme) {
						if ($theme == "tokens") $preeval[array_search($option, $booster)] += 2; //all Kaladesh tokens are artifact creatures
					}
				}
				break;
			case 203: //Cultivator's Caravan
				foreach ($booster as $option) {
					if (strlen($option->color) == 1 && $option->color != $primary->color && $option->color != $secondary->color && $option->LSV > 30) $preeval[array_search($option, $booster)] += 2;
					elseif (strlen($option->color) > 1 && $option->color != $primary->color . $secondary->color && $option->color != $secondary->color . $primary->color) { //this is to check if either color of a multicolored card matches one of the player's primary colors and if the card is worth splashing
						$temp = preg_split('//', $option->color, -1, PREG_SPLIT_NO_EMPTY);
						foreach ($temp as $color) {
							if ($color != $primary->color && $color == $secondary->color && $option->LSV >= 30) $preeval[array_search($option, $booster)] += 2;
							elseif ($color == $primary->color && $color != $secondary->color && $option->LSV >= 30) $preeval[array_search($option, $booster)] += 2;
						}
					}
					unset($temp);
				}
				break;
			case 205: //Decoction Module
				foreach ($booster as $option) {
					foreach ($option->themes as $theme) {
						if ($theme == "tokens") $preeval[array_search($option, $booster)] += 2;
					}
				}
				break;
			case 215: //Foundry Inspector
				foreach ($booster as $option) {
					if (($option->archetype == "A" || $option->archetype == "AC") && $option-LSV >= 20) $preeval[array_search($option, $booster)] += 2;
				}
				break;
			case 218: //Inventor's Goggles
				foreach ($booster as $option) {
					foreach($option->subtype as $subtype) {
						if ($subtype == "V" && $option->LSV > 20) $preeval[array_search($option, $booster)]++;
					}
				}
				break;
			case 222: //Metalwork Colossus
				foreach ($booster as $option) {
					if ($option->archetype == "A" && $option-LSV >= 20 && $option->concost > 2) $preeval[array_search($option, $booster)] += 3;
				}
				break;
			case 226: //Panharmonicon
				foreach ($booster as $option) {
					foreach ($option->themes as $theme) {
						if ($theme == "ETB") $preeval[array_search($option, $booster)] += 3;
						if ($theme == "blink") $preeval[array_search($option, $booster)] += 2;
						if ($theme == "bounce") $preeval[array_search($option, $booster)]++;
					}
				}
				break;
			case 229: //Prophetic Prism
				foreach ($booster as $option) {
					if (strlen($option->color) == 1 && $option->color != $primary->color && $option->color != $secondary->color && $option->LSV > 30) $preeval[array_search($option, $booster)] += 2;
					elseif (strlen($option->color) > 1 && $option->color != $primary->color . $secondary->color && $option->color != $secondary->color . $primary->color) { //this is to check if either color of a multicolored card matches one of the player's primary colors and if the card is worth splashing
						$temp = preg_split('//', $option->color, -1, PREG_SPLIT_NO_EMPTY);
						foreach ($temp as $color) {
							if ($color != $primary->color && $color == $secondary->color && $option->LSV >= 30) $preeval[array_search($option, $booster)] += 2;
							elseif ($color == $primary->color && $color != $secondary->color && $option->LSV >= 30) $preeval[array_search($option, $booster)] += 2;
						}
					}
					unset($temp);
				}
				break;
			case 241: //Workshop Assistant
				foreach ($booster as $option) {
					if (($option->archetype == "A" || $option->archetype == "AC") && $option-LSV >= 20) $preeval[array_search($option, $booster)]++;
				}
				break;
			case 242: //Aether Hub
				foreach ($booster as $option) {
					if (strlen($option->color) == 1 && $option->color != $primary->color && $option->color != $secondary->color && $option->LSV > 30) $preeval[array_search($option, $booster)] += 2;
					elseif (strlen($option->color) > 1 && $option->color != $primary->color . $secondary->color && $option->color != $secondary->color . $primary->color) { //this is to check if either color of a multicolored card matches one of the player's primary colors and if the card is worth splashing
						$temp = preg_split('//', $option->color, -1, PREG_SPLIT_NO_EMPTY);
						foreach ($temp as $color) {
							if ($color != $primary->color && $color == $secondary->color && $option->LSV >= 30) $preeval[array_search($option, $booster)] += 2;
							elseif ($color == $primary->color && $color != $secondary->color && $option->LSV >= 30) $preeval[array_search($option, $booster)] += 2;
						}
					}
					unset($temp);
					foreach ($option->themes as $theme) {
						if ($theme == "generator") $preeval[array_search($option, $booster)]++;
					}
				}
				break;
			case 243: //Blooming Marsh
				if ($card->color != $primary->color . $secondary->color && $card->color != $secondary->color . $primary->color) {
					$temp = preg_split('//', $card->color, -1, PREG_SPLIT_NO_EMPTY);
					if ($temp[0] == $primary->color || $temp[0] == $secondary->color) {
						if (strlen($option->color) == 1 && $option->color == $temp[1] && $option->LSV > 30) $preeval[array_search($option, $booster)] += 2;
						elseif (strlen($option->color) > 1 && $option->color != $primary->color . $secondary->color && $option->color != $secondary->color . $primary->color && $option->LSV > 30) {
							$gold = preg_split('//', $option->color, -1, PREG_SPLIT_NO_EMPTY);
							if (($gold[0] == $temp[1] && $gold[1] == $temp[0]) || ($gold[1] == $temp[1] && $gold[0] == $temp[0])) $preeval[array_search($option, $booster)] += 2;
						}
					} elseif ($temp[1] == $primary->color || $temp[1] == $secondary->color) {
						if (strlen($option->color) == 1 && $option->color == $temp[0] && $option->LSV > 30) $preeval[array_search($option, $booster)] += 2;
						elseif (strlen($option->color) > 1 && $option->color != $primary->color . $secondary->color && $option->color != $secondary->color . $primary->color && $option->LSV > 30) {
							$gold = preg_split('//', $option->color, -1, PREG_SPLIT_NO_EMPTY);
							if (($gold[0] == $temp[0] && $gold[1] == $temp[1]) || ($gold[1] == $temp[0] && $gold[0] == $temp[1])) $preeval[array_search($option, $booster)] += 2;
						}
					}
				}
				unset($temp);
				unset($gold);
				break;
			case 244: //Botanical Sanctum
				if ($card->color != $primary->color . $secondary->color && $card->color != $secondary->color . $primary->color) { //checks if the color combination of the land correspond the player's two primary colors (in which case nothing happens) and if not...
					$temp = preg_split('//', $card->color, -1, PREG_SPLIT_NO_EMPTY); //... splits the land's colors into an array and...
					if ($temp[0] == $primary->color || $temp[0] == $secondary->color) { //... checks if the first color is the same as either one of the player's primaries and if it is...
						if (strlen($option->color) == 1 && $option->color == $temp[1] && $option->LSV > 30) $preeval[array_search($option, $booster)] += 2; //... checks if splashable card in the booster (LSV > 30) are of the other color of the land in question
						elseif (strlen($option->color) > 1 && $option->color != $primary->color . $secondary->color && $option->color != $secondary->color . $primary->color && $option->LSV > 30) { //if a card is multicolored and its color combo doesn't match the composition of the player's primaries
							$gold = preg_split('//', $option->color, -1, PREG_SPLIT_NO_EMPTY); //splits the card's colors into an array
							if (($gold[0] == $temp[1] && $gold[1] == $temp[0]) || ($gold[1] == $temp[1] && $gold[0] == $temp[0])) $preeval[array_search($option, $booster)] += 2; //and checks if one of the colors mathces either of the player's primaries and whether the other matches the land's off-color
						}
					} elseif ($temp[1] == $primary->color || $temp[1] == $secondary->color) { //does the same assuming than the second color of the land matches either of the player's colors
						if (strlen($option->color) == 1 && $option->color == $temp[0] && $option->LSV > 30) $preeval[array_search($option, $booster)] += 2;
						elseif (strlen($option->color) > 1 && $option->color != $primary->color . $secondary->color && $option->color != $secondary->color . $primary->color && $option->LSV > 30) {
							$gold = preg_split('//', $option->color, -1, PREG_SPLIT_NO_EMPTY);
							if (($gold[0] == $temp[0] && $gold[1] == $temp[1]) || ($gold[1] == $temp[0] && $gold[0] == $temp[1])) $preeval[array_search($option, $booster)] += 2;
						}
					}
				}
				unset($temp);
				unset($gold);
				break;
			case 245: //Concealed Courtyard
				if ($card->color != $primary->color . $secondary->color && $card->color != $secondary->color . $primary->color) { //checks if the color combination of the land correspond the player's two primary colors (in which case nothing happens) and if not...
					$temp = preg_split('//', $card->color, -1, PREG_SPLIT_NO_EMPTY); //... splits the land's colors into an array and...
					if ($temp[0] == $primary->color || $temp[0] == $secondary->color) { //... checks if the first color is the same as either one of the player's primaries and if it is...
						if (strlen($option->color) == 1 && $option->color == $temp[1] && $option->LSV > 30) $preeval[array_search($option, $booster)] += 2; //... checks if splashable card in the booster (LSV > 30) are of the other color of the land in question
						elseif (strlen($option->color) > 1 && $option->color != $primary->color . $secondary->color && $option->color != $secondary->color . $primary->color && $option->LSV > 30) { //if a card is multicolored and its color combo doesn't match the composition of the player's primaries
							$gold = preg_split('//', $option->color, -1, PREG_SPLIT_NO_EMPTY); //splits the card's colors into an array
							if (($gold[0] == $temp[1] && $gold[1] == $temp[0]) || ($gold[1] == $temp[1] && $gold[0] == $temp[0])) $preeval[array_search($option, $booster)] += 2; //and checks if one of the colors mathces either of the player's primaries and whether the other matches the land's off-color
						}
					} elseif ($temp[1] == $primary->color || $temp[1] == $secondary->color) { //does the same assuming than the second color of the land matches either of the player's colors
						if (strlen($option->color) == 1 && $option->color == $temp[0] && $option->LSV > 30) $preeval[array_search($option, $booster)] += 2;
						elseif (strlen($option->color) > 1 && $option->color != $primary->color . $secondary->color && $option->color != $secondary->color . $primary->color && $option->LSV > 30) {
							$gold = preg_split('//', $option->color, -1, PREG_SPLIT_NO_EMPTY);
							if (($gold[0] == $temp[0] && $gold[1] == $temp[1]) || ($gold[1] == $temp[0] && $gold[0] == $temp[1])) $preeval[array_search($option, $booster)] += 2;
						}
					}
				}
				unset($temp);
				unset($gold);
				break;
			case 246: //Inspiring Vantage
				if ($card->color != $primary->color . $secondary->color && $card->color != $secondary->color . $primary->color) { //checks if the color combination of the land correspond the player's two primary colors (in which case nothing happens) and if not...
					$temp = preg_split('//', $card->color, -1, PREG_SPLIT_NO_EMPTY); //... splits the land's colors into an array and...
					if ($temp[0] == $primary->color || $temp[0] == $secondary->color) { //... checks if the first color is the same as either one of the player's primaries and if it is...
						if (strlen($option->color) == 1 && $option->color == $temp[1] && $option->LSV > 30) $preeval[array_search($option, $booster)] += 2; //... checks if splashable card in the booster (LSV > 30) are of the other color of the land in question
						elseif (strlen($option->color) > 1 && $option->color != $primary->color . $secondary->color && $option->color != $secondary->color . $primary->color && $option->LSV > 30) { //if a card is multicolored and its color combo doesn't match the composition of the player's primaries
							$gold = preg_split('//', $option->color, -1, PREG_SPLIT_NO_EMPTY); //splits the card's colors into an array
							if (($gold[0] == $temp[1] && $gold[1] == $temp[0]) || ($gold[1] == $temp[1] && $gold[0] == $temp[0])) $preeval[array_search($option, $booster)] += 2; //and checks if one of the colors mathces either of the player's primaries and whether the other matches the land's off-color
						}
					} elseif ($temp[1] == $primary->color || $temp[1] == $secondary->color) { //does the same assuming than the second color of the land matches either of the player's colors
						if (strlen($option->color) == 1 && $option->color == $temp[0] && $option->LSV > 30) $preeval[array_search($option, $booster)] += 2;
						elseif (strlen($option->color) > 1 && $option->color != $primary->color . $secondary->color && $option->color != $secondary->color . $primary->color && $option->LSV > 30) {
							$gold = preg_split('//', $option->color, -1, PREG_SPLIT_NO_EMPTY);
							if (($gold[0] == $temp[0] && $gold[1] == $temp[1]) || ($gold[1] == $temp[0] && $gold[0] == $temp[1])) $preeval[array_search($option, $booster)] += 2;
						}
					}
				}
				unset($temp);
				unset($gold);
				break;
			case 249: //Spirebluff Canal				
				if ($card->color != $primary->color . $secondary->color && $card->color != $secondary->color . $primary->color) { //checks if the color combination of the land correspond the player's two primary colors (in which case nothing happens) and if not...
					$temp = preg_split('//', $card->color, -1, PREG_SPLIT_NO_EMPTY); //... splits the land's colors into an array and...
					if ($temp[0] == $primary->color || $temp[0] == $secondary->color) { //... checks if the first color is the same as either one of the player's primaries and if it is...
						if (strlen($option->color) == 1 && $option->color == $temp[1] && $option->LSV > 30) $preeval[array_search($option, $booster)] += 2; //... checks if splashable card in the booster (LSV > 30) are of the other color of the land in question
						elseif (strlen($option->color) > 1 && $option->color != $primary->color . $secondary->color && $option->color != $secondary->color . $primary->color && $option->LSV > 30) { //if a card is multicolored and its color combo doesn't match the composition of the player's primaries
							$gold = preg_split('//', $option->color, -1, PREG_SPLIT_NO_EMPTY); //splits the card's colors into an array
							if (($gold[0] == $temp[1] && $gold[1] == $temp[0]) || ($gold[1] == $temp[1] && $gold[0] == $temp[0])) $preeval[array_search($option, $booster)] += 2; //and checks if one of the colors mathces either of the player's primaries and whether the other matches the land's off-color
						}
					} elseif ($temp[1] == $primary->color || $temp[1] == $secondary->color) { //does the same assuming than the second color of the land matches either of the player's colors
						if (strlen($option->color) == 1 && $option->color == $temp[0] && $option->LSV > 30) $preeval[array_search($option, $booster)] += 2;
						elseif (strlen($option->color) > 1 && $option->color != $primary->color . $secondary->color && $option->color != $secondary->color . $primary->color && $option->LSV > 30) {
							$gold = preg_split('//', $option->color, -1, PREG_SPLIT_NO_EMPTY);
							if (($gold[0] == $temp[0] && $gold[1] == $temp[1]) || ($gold[1] == $temp[0] && $gold[0] == $temp[1])) $preeval[array_search($option, $booster)] += 2;
						}
					}
				}
				unset($temp);
				unset($gold);
				break;
		}
	}
	
	foreach ($booster as $card) { //checks the cards in the booster against the cards in the player's cardpool to see if thier themes align
		switch ($card->number) {
			case 1:  //Acrobatic Maneuver
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) {
					foreach ($inpool->themes as $theme) {
						if ($theme == "ETB") $preeval[array_search($card, $booster)] += 2;
					}
				}
				break;
			case 3: //Aetherstorm Roc
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) {
					foreach ($inpool->themes as $theme) {
						if ($theme == "generator") $preeval[array_search($card, $booster)] += 2;
						if ($theme == "sink") $preeval[array_search($card, $booster)]++;
					}
				}
				break;
			case 4: //Angel of Invention
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) {
					foreach ($inpool->themes as $theme) {
						if ($theme == "blink") $preeval[array_search($card, $booster)] += 2;
						if ($theme == "bounce") $preeval[array_search($card, $booster)]++;
					}
				}
				break;
			case 5: //Authority of Consuls
				$temp = 0;
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) { 
					if ($inpool->archetype == "C" && $inpool->concost <= 3 && $inpool->LSV >= 20) $temp++;
				}
				if ($temp > 6) $preeval[array_search($card, $booster)] += 2 * $temp;
				unset($temp);
				break;
			case 6: //Aviary Mechanic
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) {
					foreach ($inpool->themes as $theme) {
						if ($theme == "ETB") $preeval[array_search($card, $booster)]++;
					}
				}
				break;
			case 7: //Built to Last
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) {
					if ($inpool->number == 7) $preeval[array_search($card, $booster)] -= 5; //checks if the player already has Built to Last to reduce its value accordingly because multiples are undesirable
				}
				break;
			case 11: //Consul's Shieldguard
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) {
					foreach ($inpool->themes as $theme) {
						if ($theme == "generator") $preeval[array_search($card, $booster)]++;
					}
				}
				break;
			case 12: //Eddytrail Hawk
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) {
					$evasion = null;
					foreach ($inpool->themes as $theme) {
						if ($theme == "generator") $preeval[array_search($card, $booster)]++;
						if ($theme == "evasion") $evasion = TRUE;
					}
					if (!$evasion) {
						if (($inpool->archetype == "C" || $inpool->archetype == "AC") && $inpool->LSV > 25) $preeval[array_search($card, $booster)] += 2;
					} 
					unset($evasion);
				}
				break;
			case 14: //Fragmentize
				$temp = 0;
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) { 
					if ($inpool->number == 14) $temp++;
				}
				if ($temp > 1) $preeval[array_search($card, $booster)] -= 4 * $temp; //checks if the player already has two or more Fragmentize to reduce its value accordingly because multiples are undesirable
				unset($temp);
				break;
			case 16: //Gearshift Ace
				$temp = 0;
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) {
					foreach ($inpool->subtype as $subtype) {
						if ($subtype == "V") $temp++;
					}
				}
				if ($temp <= 3) $preeval[array_search($card, $booster)] += (2 * $temp);
				else $preeval[array_search($card, $booster)] += 6;
				unset($temp);
				break;
			case 17: //Glint-Sleeve Artisan
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) {
					foreach ($inpool->themes as $theme) {
						if ($theme == "blink") $preeval[array_search($card, $booster)]++;
						if ($theme == "bounce") $preeval[array_search($card, $booster)]++;
					}
				}
				break;
			case 19: //Impeccable Timing
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) {
					if ($inpool->number == 14) $preeval[array_search($card, $booster)] -= 10; //checks if the player already has Impeccable Timing to reduce its value accordingly because multiples are undesirable
				}
				break;
			case 20: //Inspired Charge
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) {
					if (($inpool->archetype == "C" || $inpool->archetype == "AC") && $inpool->concost <= 3 && $inpool->LSV > 20) $preeval[array_search($card, $booster)] += 2;
					if ($inpool->number == 20) $preeval[array_search($card, $booster)] -= 8;
					foreach ($inpool->themes as $theme) {
						if ($theme == "tokens") $preeval[array_search($card, $booster)] += 2;
						if ($theme == "evasion") $preeval[array_search($card, $booster)] += 2;
					}
				}
				break;
			case 21: //Master Trinketeer
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) {
					foreach ($inpool->themes as $theme) {
						if ($theme == "tokens") $preeval[array_search($card, $booster)] += 2;
					}
					foreach ($inpool->subtype as $subtype) {
						if ($subtype == "T") $preeval[array_search($card, $booster)] += 2;
					}
				}
				break;
			case 22: //Ninth Bridge Patrol
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) {
					foreach ($inpool->themes as $theme) {
						if ($theme == "tokens") $preeval[array_search($card, $booster)]++;
						if ($theme == "blink") $preeval[array_search($card, $booster)]++;
						if ($theme == "bounce") $preeval[array_search($card, $booster)]++;
					}
				}
				break;
			case 23: //Pressure Point
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) {
					if ($inpool->number == 23) $preeval[array_search($card, $booster)] -= 7; //checks if the player already has Impeccable Timing to reduce its value accordingly because multiples are undesirable
				}
				break;
			case 24: //Propeller Pioneer
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) {
					foreach ($inpool->themes as $theme) {
						if ($theme == "blink") $preeval[array_search($card, $booster)]++;
						if ($theme == "bounce") $preeval[array_search($card, $booster)]++;
					}
				}
				break;
			case 25: //Refurbish
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) {
					if (($inpool->archetype == "A" || $inpool->archetype == "AC") && $inpool->LSV > 25) $preeval[array_search($card, $booster)] += 2;
					if ($inpool->number == 25) $preeval[array_search($card, $booster)] -= 8;
				}
				break;
			case 27: //Servo Exhibition
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) {
					if ($inpool->number == 27) $preeval[array_search($card, $booster)] -= 8; //checks if the player already has Impeccable Timing to reduce its value accordingly because multiples are undesirable
				}
				break;
			case 31: //Thriving Ibex
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) {
					foreach ($inpool->themes as $theme) {
						if ($theme == "generator") $preeval[array_search($card, $booster)]++;
					}
				}
				break;
			case 32: //Toolcraft Exemplar
				$temp = 0;
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) { 
					if (($inpool->archetype == "A" || $inpool->archetype == "AC") && $inpool->LSV > 20 && $inpool->concost <= 3) $temp++; //checks if the player has enough low-cost artifacts to make this desirable
					foreach ($inpool->themes as $theme) {
						if ($theme == "tokens") $preeval[array_search($card, $booster)] += 2;
					}
				}
				if ($temp > 4) $preeval[array_search($card, $booster)] += 2 * $temp;
				unset($temp);
				break;
			case 33: //Trusty Companion
				$temp = 0;
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) {
					foreach ($inpool->subtype as $subtype) {
						if ($subtype == "V") $preeval[array_search($card, $booster)]++;
					}
				}
				break;
			case 34: //Visionary Augmenter
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) {
					foreach ($inpool->themes as $theme) {
						if ($theme == "blink") $preeval[array_search($card, $booster)]++;
						if ($theme == "bounce") $preeval[array_search($card, $booster)]++;
					}
				}
				break;
			case 35: //Wispweaver Angel
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) {
					foreach ($inpool->themes as $theme) {
						if ($theme == "ETB") $preeval[array_search($card, $booster)] += 2;
					}
				}
				break;
			case 37: //Aether Theorist
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) {
					foreach ($inpool->themes as $theme) {
						if ($theme == "generator") $preeval[array_search($card, $booster)]++;
					}
				}
				break;
			case 38: //Aether Tradewinds 
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) {
					foreach ($inpool->themes as $theme) {
						if ($theme == "ETB") $preeval[array_search($card, $booster)]++;
					}
				}
				break;
			case 39: //Aethersquall Ancient
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) {
					foreach ($inpool->themes as $theme) {
						if ($theme == "generator") $preeval[array_search($card, $booster)] += 3;
						if ($theme == "sink") $preeval[array_search($card, $booster)] += 2;
					}
				}
				break;
			case 41: //Confiscation Coup
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) {
					foreach ($inpool->themes as $theme) {
						if ($theme == "generator") $preeval[array_search($card, $booster)] += 2;
					}
				}
				break;
			case 43: //Disappearing Act
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) {
					foreach ($inpool->themes as $theme) {
						if ($theme == "ETB") $preeval[array_search($card, $booster)]++;
					}
				}
				break;
			case 45: //Era of Innovation
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) { 
					if (($inpool->archetype == "A" || $inpool->archetype == "AC") && $inpool->concost <= 3) $preeval[array_search($card, $booster)] += 2;
					foreach ($inpool->subtype as $subtype) {
						if ($subtype == "A" && $inpool->concost <= 3) $preeval[array_search($card, $booster)] += 2;
					}
					foreach ($inpool->themes as $theme) {
						if ($theme == "tokens") $preeval[array_search($card, $booster)] += 2;
						if ($theme == "sink") $preeval[array_search($card, $booster)] += 2;
						if ($theme == "generator") $preeval[array_search($card, $booster)]++;
					}
				}
				break;
			case 46: //Experimental Aviator
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) {
					foreach ($inpool->themes as $theme) {
						if ($theme == "blink") $preeval[array_search($card, $booster)] += 2;
						if ($theme == "bounce") $preeval[array_search($card, $booster)]++;
					}
				}				
				break;
			case 48: //Gearseeker Serpent
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) { 
					if (($inpool->archetype == "A" || $inpool->archetype == "AC") && $inpool->LSV > 15) $preeval[array_search($card, $booster)] += 2;
					foreach ($inpool->themes as $theme) {
						if ($theme == "tokens") $preeval[array_search($card, $booster)] += 3;
					}
				}
				break;
			case 50: //Glint-Nest Crane
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) { 
					if (($inpool->archetype == "A" && $inpool->LSV >= 20) || ($inpool->archetype == "AC" && $inpool->LSV >= 20)) $preeval[array_search($card, $booster)] += 3;
				}
				break;
			case 51: //Hightide Hermit
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) {
					foreach ($inpool->themes as $theme) {
						if ($theme == "generator") $preeval[array_search($card, $booster)]++;
						if ($theme == "sink") $preeval[array_search($card, $booster)]++;
					}
				}
				break;
			case 53: //Janjeet Sentry
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) {
					foreach ($inpool->themes as $theme) {
						if ($theme == "generator") $preeval[array_search($card, $booster)]++;
					}
				}
				break;
			case 56: //Metallurgic Summonings
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) { 
					if (($inpool->archetype == "S" || $inpool->archetype == "I") && $inpool->LSV >= 20) $preeval[array_search($card, $booster)] += 5;
				}
				break;
			case 57: //Minister of Inquiries
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) {
					foreach ($inpool->themes as $theme) {
						if ($theme == "generator") $preeval[array_search($card, $booster)]++;
					}
				}
				break;
			case 58: //Padeem, Consul of Innovation
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) { 
					if (($inpool->archetype == "A" && $inpool->LSV >= 20) || ($inpool->archetype == "AC" && $inpool->LSV >= 20)) $preeval[array_search($card, $booster)] += 3;
				}
				break;
			case 60: //Paradoxical Outcome
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) {
					foreach ($inpool->themes as $theme) {
						if ($theme == "ETB") $preeval[array_search($card, $booster)]++;
					}
				}
				break;
			case 62: //Saheeli's Artistry
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) { 
					if (($inpool->archetype == "A" || $inpool->archetype == "AC") && $inpool->LSV >= 20) $preeval[array_search($card, $booster)] += 3;
				}
				break;
			case 63: //Select for Inspection
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) {
					foreach ($inpool->themes as $theme) {
						if ($theme == "ETB") $preeval[array_search($card, $booster)]++;
					}
				}
				break;
			case 64: //Shrewd Negotiation
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) {
					foreach ($inpool->themes as $theme) {
						if ($theme == "tokens") $preeval[array_search($card, $booster)] += 3;
					}
				}
				break;
			case 65: //Tezzeret's Ambition
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) { 
					if (($inpool->archetype == "A" && $inpool->LSV >= 20) || ($inpool->archetype == "AC" && $inpool->LSV >= 20)) $preeval[array_search($card, $booster)]++;
					foreach ($inpool->themes as $theme) {
						if ($theme == "tokens") $preeval[array_search($card, $booster)]++;
					}
				}
				break;
			case 66: //Thriving Turtle
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) {
					foreach ($inpool->themes as $theme) {
						if ($theme == "generator") $preeval[array_search($card, $booster)]++;
					}
				}
				break;
			case 67: //Torrential Gearhulk
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) { 
					if ($inpool->archetype == "I" && $inpool->LSV >= 20) $preeval[array_search($card, $booster)] += 2;
				}
				break;
			case 68: //Vedalken Blademaster
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) { 
					if ($inpool->archetype != "C" && $inpool->archetype != "AC" && $inpool->archetype != "L" && $inpool->LSV > 20) $preeval[array_search($card, $booster)] += 2;
				}
			case 69: //Weldfast Wingsmith
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) { 
					if (($inpool->archetype == "A" || $inpool->archetype == "AC") && $inpool->LSV >= 20) $preeval[array_search($card, $booster)]++;
				}
			case 71: //Aetherborn Marauder
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) {
					foreach ($inpool->themes as $theme) {
						if ($theme == "counters") $preeval[array_search($card, $booster)]++;
					}
				}
				break;
			case 73: //Demon of Dark Schemes
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) {
					foreach ($inpool->themes as $theme) {
						if ($theme == "generator") $preeval[array_search($card, $booster)] += 2;
						if ($theme == "sink") $preeval[array_search($card, $booster)]++;
					}
				}		
				break;
			case 74: //Dhund Operative
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) { 
					if (($inpool->archetype == "A" && $inpool->LSV >= 15) || ($inpool->archetype == "AC" && $inpool->LSV >= 15)) $preeval[array_search($card, $booster)]++;
					foreach ($inpool->themes as $theme) {
						if ($theme == "tokens") $preeval[array_search($card, $booster)]++;
					}
				}
				break;
			case 75: //Die Young
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) {
					foreach ($inpool->themes as $theme) {
						if ($theme == "generator") $preeval[array_search($card, $booster)] += 2;
					}
				}
				break;
			case 78: //Eliminate the Competition
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) {
					foreach ($inpool->themes as $theme) {
						if ($theme == "tokens") $preeval[array_search($card, $booster)] += 3;
					}
				}
				break;
			case 79: //Embraal Bruiser
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) { 
					if (($inpool->archetype == "A" && $inpool->LSV >= 15) || ($inpool->archetype == "AC" && $inpool->LSV >= 15)) $preeval[array_search($card, $booster)]++;
					foreach ($inpool->themes as $theme) {
						if ($theme == "tokens") $preeval[array_search($card, $booster)]++;
					}
				}
				break;
			case 81: //Fortuitous Find
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) { 
					if (($inpool->archetype == "A" && $inpool->LSV >= 30) || ($inpool->archetype == "AC" && $inpool->LSV >= 20)) $preeval[array_search($card, $booster)] += 2;
				}
				break;
			case 82: //Foundry Screecher
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) { 
					if (($inpool->archetype == "A" && $inpool->LSV >= 15) || ($inpool->archetype == "AC" && $inpool->LSV >= 15)) $preeval[array_search($card, $booster)]++;
					foreach ($inpool->themes as $theme) {
						if ($theme == "tokens") $preeval[array_search($card, $booster)]++;
					}
				}
				break;
			case 84: //Gonti, Lord of Luxury
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) {
					foreach ($inpool->themes as $theme) {
						if ($theme == "blink") $preeval[array_search($card, $booster)] += 2;
						if ($theme == "bounce") $preeval[array_search($card, $booster)]++;
					}
				}
				break;
			case 90: //Marionette Master
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) {
					foreach ($inpool->themes as $theme) {
						if ($theme == "blink") $preeval[array_search($card, $booster)] += 2;
						if ($theme == "bounce") $preeval[array_search($card, $booster)]++;
						if ($theme == "tokens") $preeval[array_search($card, $booster)] += 2;
						if ($theme == "sacrifice artifact") $preeval[array_search($card, $booster)] += 2;
					}
				}
				break;
			case 91: //Maulfist Squad
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) {
					foreach ($inpool->themes as $theme) {
						if ($theme == "blink") $preeval[array_search($card, $booster)]++;
						if ($theme == "bounce") $preeval[array_search($card, $booster)]++;
					}
				}
				break;
			case 92: //Midnight Oil
				$temp = 0;
				for ($i = 1; $i < (count($_SESSION['players'][$player]->curve) - 1); $i++) {
					$temp += $_SESSION['players'][$player]->curve[$i];
				}
				if ($temp / (count($_SESSION['players'][$player]->curve) - 1) < 4 && count($_SESSION['players'][$player]->cardpool) >= 20) $preeval[array_search($card, $booster)] += 15;
				elseif ($temp / (count($_SESSION['players'][$player]->curve) - 1) < 4 && count($_SESSION['players'][$player]->cardpool) >= 30) $preeval[array_search($card, $booster)] += 25;
				unset($temp);
				break;
			case 94: //Morbid Curiosity
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) { 
					if ($inpool->concost == "FX" && ($inpool->archetype == "C" || $inpool->archetype == "A" || $inpool->archetype == "AC")) $preeval[array_search($card, $booster)] += 2; //no non-creature artifacts with flexible cost
				}
				break;
			case 97: //Ovalchase Daredevil
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) { 
					if (($inpool->archetype == "A" && $inpool->LSV >= 15) || ($inpool->archetype == "AC" && $inpool->LSV >= 15)) $preeval[array_search($card, $booster)] += 2;
					foreach ($inpool->themes as $theme) {
						if ($theme == "tokens") $preeval[array_search($card, $booster)]++;
					}
				}
				break;
			case 99: //Rush of Vitality
				$temp = 0;
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) { 
					if ($inpool->number == 99) $temp++;
				}
				if ($temp > 1) $preeval[array_search($card, $booster)] -= 5 * $temp; //checks if the player already has two or more Fragmentize to reduce its value accordingly because multiples are undesirable
				unset($temp);
				break;
			case 101: //Syndicate Trafficker
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) { 
					if (($inpool->archetype == "A" && $inpool->LSV >= 15) || ($inpool->archetype == "AC" && $inpool->LSV >= 15)) $preeval[array_search($card, $booster)]++;
					foreach ($inpool->themes as $theme) {
						if ($theme == "tokens") $preeval[array_search($card, $booster)] += 2;
					}
				}
				break;
			case 102: //Thriving Rats
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) { 
					foreach ($inpool->themes as $theme) {
						if ($theme == "generator") $preeval[array_search($card, $booster)]++;
					}
				}
				break;
			case 103: //Underhanded Designs
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) { 
					if (($inpool->archetype == "A" && $inpool->LSV >= 15) || ($inpool->archetype == "AC" && $inpool->LSV >= 15)) $preeval[array_search($card, $booster)] += 2;
					foreach ($inpool->themes as $theme) {
						if ($theme == "tokens") $preeval[array_search($card, $booster)] += 2;
					}
				}
				break;
			case 105: //Weaponcraft Enthusiast
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) { 
					foreach ($inpool->themes as $theme) {
						if ($theme == "blink") $preeval[array_search($card, $booster)]++;
						if ($theme == "bounce") $preeval[array_search($card, $booster)]++;
					}
				}
				break;
			case 106: //Aethertorch Renegade
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) { 
					foreach ($inpool->themes as $theme) {
						if ($theme == "generator") $preeval[array_search($card, $booster)] += 2;
						if ($theme == "sink") $preeval[array_search($card, $booster)]++;
					}
				}
				break;
			case 108: //Built to Smash
				$temp = 0;
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) { 
					if ($inpool->number == 108) $temp++;
				}
				if ($temp > 1) $preeval[array_search($card, $booster)] -= 5 * $temp; //checks if the player already has two or more Fragmentize to reduce its value accordingly because multiples are undesirable
				unset($temp);
				break;
			case 117: //Harnessed Lightning
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) { 
					foreach ($inpool->themes as $theme) {
						if ($theme == "generator") $preeval[array_search($card, $booster)] += 2;
					}
				}
				break;
			case 119: //Incendiary Sabotage
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) { 
					if (($inpool->archetype == "A" || $inpool->archetype == "AC") && $inpool->LSV >= 15) $preeval[array_search($card, $booster)] += 2;
				}
				break;
			case 120: //Inventor's Apprentice
				$temp = 0;
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) { 
					if (($inpool->archetype == "A" || $inpool->archetype == "AC") && $inpool->concost < 3) $temp++; //checks if the player has enough low-cost artifacts to make this desirable
					foreach ($inpool->themes as $theme) {
						if ($theme == "tokens" && $inpool->concost < 3) $temp++;
					}
				}
				if ($temp > 5) $preeval[array_search($card, $booster)] += 2 * $temp;
				unset($temp);
				break;
			case 121: //Lathnu Hellion
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) { 
					foreach ($inpool->themes as $theme) {
						if ($theme == "generator") $preeval[array_search($card, $booster)] += 2;
					}
				}
				break;
			case 123: //Maulfist Doorbuster
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) { 
					foreach ($inpool->themes as $theme) {
						if ($theme == "generator") $preeval[array_search($card, $booster)]++;
					}
				}
				break;
			case 125: //Quicksmith Genius
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) { 
					if (($inpool->archetype == "A" || $inpool->archetype == "AC") && $inpool->LSV > 15) $preeval[array_search($card, $booster)]++;
					foreach ($inpool->themes as $theme) {
						if ($theme == "tokens") $preeval[array_search($card, $booster)] += 2;
					}
				}
				break;
			case 126: //Reckless Fireweaver
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) { 
					if (($inpool->archetype == "A" && $inpool->LSV >= 15) || ($inpool->archetype == "AC" && $inpool->LSV >= 15)) $preeval[array_search($card, $booster)]++;
					foreach ($inpool->themes as $theme) {
						if ($theme == "tokens") $preeval[array_search($card, $booster)] += 2;
					}
				}
				break;
			case 127: //Renegade Tactics
				$temp = 0;
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) { 
					if ($inpool->number == 127) $temp++;
				}
				if ($temp > 0) $preeval[array_search($card, $booster)] -= 5 * $temp; //checks if the player already has two or more Fragmentize to reduce its value accordingly because multiples are undesirable
				unset($temp);
				break;
			case 129: //Salivating Gremlins
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) { 
					if (($inpool->archetype == "A" && $inpool->LSV >= 15) || ($inpool->archetype == "AC" && $inpool->LSV >= 15)) $preeval[array_search($card, $booster)] += 2;
					foreach ($inpool->themes as $theme) {
						if ($theme == "tokens") $preeval[array_search($card, $booster)] += 3;
					}
				}
				break;
			case 132: //Speedway Fanatic
				$temp = 0;
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) {
					foreach ($inpool->subtype as $subtype) {
						if ($subtype == "V") $temp++;
					}
				}
				if ($temp <= 3) $preeval[array_search($card, $booster)] += (2 * $temp);
				else $preeval[array_search($card, $booster)] += 6;
				unset($temp);
				break;
			case 134: //Spontaneous Artist
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) { 
					foreach ($inpool->themes as $theme) {
						if ($theme == "generator") $preeval[array_search($card, $booster)]++;
					}
				}
				break;
			case 136: //Territorial Gorger
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) { 
					foreach ($inpool->themes as $theme) {
						if ($theme == "generator") $preeval[array_search($card, $booster)]++;
					}
				}
				break;
			case 138: //Thriving Grubs
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) { 
					foreach ($inpool->themes as $theme) {
						if ($theme == "generator") $preeval[array_search($card, $booster)]++;
					}
				}
				break;
			case 140: //Welding Sparks
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) { 
					if (($inpool->archetype == "A" && $inpool->LSV >= 15) || ($inpool->archetype == "AC" && $inpool->LSV >= 15)) $preeval[array_search($card, $booster)] += 2;
					foreach ($inpool->themes as $theme) {
						if ($theme == "tokens") $preeval[array_search($card, $booster)] += 3;
					}
				}
				break;
			case 141: //Appetite for the Unnatural
				$temp = 0;
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) { 
					if ($inpool->number == 141) $temp++;
				}
				if ($temp > 1) $preeval[array_search($card, $booster)] -= 5 * $temp; //checks if the player already has two or more Appetite for the Unnatural to reduce its value accordingly because multiples are undesirable
				unset($temp);
				break;
			case 142: //Arborback Stomper
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) { 
					foreach ($inpool->themes as $theme) {
						if ($theme == "blink") $preeval[array_search($card, $booster)] += 2;
						if ($theme == "bounce") $preeval[array_search($card, $booster)]++;
					}
				}
				break;
			case 143: //Architect of the Untamed
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) { 
					foreach ($inpool->themes as $theme) {
						if ($theme == "generator") $preeval[array_search($card, $booster)] += 2;
					}
				}
				break;
			case 144: //Armorcraft Judge
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) { 
					foreach ($inpool->themes as $theme) {
						if ($theme == "counters") $preeval[array_search($card, $booster)] += 2;
						if ($theme == "blink") $preeval[array_search($card, $booster)] += 2;
						if ($theme == "bounce") $preeval[array_search($card, $booster)]++;
					}
				}
				break;
			case 145: //Attune with Aether
				if ($_SESSION['round'] >= 1) {
					foreach ($_SESSION['players'][$player]->cardpool as $inpool) { 
						if (strlen($inpool->color) == 1 && $inpool->color != $primary->color && $inpool->color != $secondary->color && $inpool->LSV > 30) $preeval[array_search($card, $booster)] += 5;
						elseif (strlen($inpool->color) > 1 && $inpool->color != $primary->color . $secondary->color && $inpool->color != $secondary->color . $primary->color) { //this is to check if either color of a multicolored card matches one of the player's primary colors
							$temp = preg_split('//', $inpool->color, -1, PREG_SPLIT_NO_EMPTY);
							foreach ($temp as $color) {
								if ($color != $primary->color && $color == $secondary->color && $inpool->LSV >= 30) $preeval[array_search($card, $booster)] += 5;
								elseif ($color == $primary->color && $color != $secondary->color && $inpool->LSV >= 30) $preeval[array_search($card, $booster)] += 5;
							}
						}
						unset($temp);
					}
				}
				$temp = 0;
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) { 
					if ($inpool->number == 145) $temp++;
				}
				if ($temp > 1) $preeval[array_search($card, $booster)] -= 5 * $temp; //checks if the player already has two or more Attune with Aether to reduce its value accordingly because multiples are undesirable
				unset($temp);
				break;
			case 146: //Blossoming Defense
				$temp = 0;
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) { 
					if ($inpool->number == 146) $temp++;
				}
				if ($temp > 1) $preeval[array_search($card, $booster)] -= 5 * $temp; //checks if the player already has two or more Blossoming Defense to reduce its value accordingly because multiples are undesirable
				unset($temp);
				break;
			case 147: //Bristling Hydra
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) { 
					foreach ($inpool->themes as $theme) {
						if ($theme == "generator") $preeval[array_search($card, $booster)] += 2;
					}
				}
				break;
			case 150: //Creeping Mold
				$temp = 0;
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) { 
					if ($inpool->number == 150) $temp++;
				}
				if ($temp > 0) $preeval[array_search($card, $booster)] -= 5 * $temp; //checks if the player already has one or more Creeping Mold to reduce its value accordingly because multiples are undesirable
				unset($temp);
				break;
			case 151: //Cultivator of Blades
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) { 
					foreach ($inpool->themes as $theme) {
						if ($theme == "blink") $preeval[array_search($card, $booster)] += 2;
						if ($theme == "bounce") $preeval[array_search($card, $booster)]++;
						if ($theme == "tokens") $preeval[array_search($card, $booster)] += 2;
						if ($theme == "evasion") $preeval[array_search($card, $booster)]++;
					}
				}
				break;
			case 153: //Durable Handicraft
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) { 
					foreach ($inpool->themes as $theme) {
						if ($theme == "tokens") $preeval[array_search($card, $booster)] += 2;
					}
				}
				break;
			case 154: //Elegant Edgecrafters
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) { 
					foreach ($inpool->themes as $theme) {
						if ($theme == "blink") $preeval[array_search($card, $booster)]++;
						if ($theme == "bounce") $preeval[array_search($card, $booster)]++;
					}
				}
				break;
			case 155: //Fairgrounds Trumpeter
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) { 
					foreach ($inpool->themes as $theme) {
						if ($theme == "counters") $preeval[array_search($card, $booster)] += 2;
					}
				}
				break;
			case 157: //Highspire Artisan
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) { 
					foreach ($inpool->themes as $theme) {
						if ($theme == "blink") $preeval[array_search($card, $booster)]++;
						if ($theme == "bounce") $preeval[array_search($card, $booster)]++;
					}
				}
				break;
			case 161: //Longtusk Cub
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) { 
					foreach ($inpool->themes as $theme) {
						if ($theme == "generator") $preeval[array_search($card, $booster)] += 2;
					}
				}
				break;
			case 164: //Ornamental Courage
				$temp = 0;
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) { 
					if ($inpool->number == 164) $temp++;
				}
				if ($temp > 0) $preeval[array_search($card, $booster)] -= 5 * $temp; //checks if the player already has two or more Ornamental Courage to reduce its value accordingly because multiples are undesirable
				unset($temp);
				break;
			case 166: //Peema Outrider
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) { 
					foreach ($inpool->themes as $theme) {
						if ($theme == "blink") $preeval[array_search($card, $booster)]++;
						if ($theme == "bounce") $preeval[array_search($card, $booster)]++;
					}
				}
				break;
			case 167: //Riparian Tiger
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) { 
					foreach ($inpool->themes as $theme) {
						if ($theme == "generator") $preeval[array_search($card, $booster)] += 2;
					}
				}
				break;
			case 168: //Sage of Shaila's Claim
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) { 
					foreach ($inpool->themes as $theme) {
						if ($theme == "sink") $preeval[array_search($card, $booster)]++;
					}
				}
				break;
			case 169: //Servant of the Conduit
				if ($_SESSION['round'] >= 1) {
					foreach ($_SESSION['players'][$player]->cardpool as $inpool) { 
						if (strlen($inpool->color) == 1 && $inpool->color != $primary->color && $inpool->color != $secondary->color && $inpool->LSV > 30) $preeval[array_search($card, $booster)] += 5;
						elseif (strlen($inpool->color) > 1 && $inpool->color != $primary->color . $secondary->color && $inpool->color != $secondary->color . $primary->color) { //this is to check if either color of a multicolored card matches one of the player's primary colors
							$temp = preg_split('//', $inpool->color, -1, PREG_SPLIT_NO_EMPTY);
							foreach ($temp as $color) {
								if ($color != $primary->color && $color == $secondary->color && $inpool->LSV >= 30) $preeval[array_search($card, $booster)] += 5;
								elseif ($color == $primary->color && $color != $secondary->color && $inpool->LSV >= 30) $preeval[array_search($card, $booster)] += 5;
							}
						}
						unset($temp);
					}
				}
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) { 
					foreach ($inpool->themes as $theme) {
						if ($theme == "generator") $preeval[array_search($card, $booster)]++;
					}
				}
				break;
			case 170: //Take Down 
				$temp = 0;
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) { 
					if ($inpool->number == 164) $temp++;
				}
				if ($temp > 0) $preeval[array_search($card, $booster)] -= 5 * $temp; //checks if the player already has two or more Fragmentize to reduce its value accordingly because multiples are undesirable
				unset($temp);
				break;
			case 171: //Thriving Rhino
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) { 
					foreach ($inpool->themes as $theme) {
						if ($theme == "generator") $preeval[array_search($card, $booster)] += 2;
					}
				}
				break;
			case 173: //Wild Wanderer
				if ($_SESSION['round'] >= 1) {
					foreach ($_SESSION['players'][$player]->cardpool as $inpool) { 
						if (strlen($inpool->color) == 1 && $inpool->color != $primary->color && $inpool->color != $secondary->color && $inpool->LSV > 30) $preeval[array_search($card, $booster)] += 5;
						elseif (strlen($inpool->color) > 1 && $inpool->color != $primary->color . $secondary->color && $inpool->color != $secondary->color . $primary->color) { //this is to check if either color of a multicolored card matches one of the player's primary colors
							$temp = preg_split('//', $inpool->color, -1, PREG_SPLIT_NO_EMPTY);
							foreach ($temp as $color) {
								if ($color != $primary->color && $color == $secondary->color && $inpool->LSV >= 30) $preeval[array_search($card, $booster)] += 5;
								elseif ($color == $primary->color && $color != $secondary->color && $inpool->LSV >= 30) $preeval[array_search($card, $booster)] += 5;
							}
						}
						unset($temp);
					}
				}
				break;
			case 176: //Cloudblazer
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) { 
					foreach ($inpool->themes as $theme) {
						if ($theme == "blink") $preeval[array_search($card, $booster)] += 2;
						if ($theme == "bounce") $preeval[array_search($card, $booster)] += 2;
					}
				}
				break;
			case 177: //Contraband Kingpin
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) { 
					if (($inpool->archetype == "A" || $inpool->archetype == "AC") && $inpool->LSV >= 15) $preeval[array_search($card, $booster)] += 2;
					foreach ($inpool->themes as $theme) {
						if ($theme == "tokens") $preeval[array_search($card, $booster)] += 2;
					}
				}
				break;
			case 178: //Depala, Pilot Exemplar
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) {
					foreach ($inpool->subtype as $subtype) {
						if ($subtype == "D" || $subtype == "V") $preeval[array_search($card, $booster)] += 2;
					}
				}
				break;
			case 180: //Empyreal Voyager
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) { 
					foreach ($inpool->themes as $theme) {
						if ($theme == "sink") $preeval[array_search($card, $booster)] += 2;
					}
				}
				break;
			case 181: //Engineered Might
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) { 
					foreach ($inpool->themes as $theme) {
						if ($theme == "evasion") $preeval[array_search($card, $booster)]++;
						if ($theme == "tokens") $preeval[array_search($card, $booster)]++;
					}
				}
				break;
			case 188: //Veteran Motorist
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) {
					foreach ($inpool->subtype as $subtype) {
						if ($subtype == "V") $preeval[array_search($card, $booster)] += 2;
					}
				}
				break;
			case 189: //Voltaic Brawler
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) { 
					foreach ($inpool->themes as $theme) {
						if ($theme == "generator") $preeval[array_search($card, $booster)] += 2;
					}
				}
				break;
			case 190: //Whirler Virtuoso
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) { 
					foreach ($inpool->themes as $theme) {
						if ($theme == "generator") $preeval[array_search($card, $booster)] += 3;
					}
				}
				break;
			case 191: //Accomplished Automaton
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) { 
					foreach ($inpool->themes as $theme) {
						if ($theme == "blink") $preeval[array_search($card, $booster)]++;
						if ($theme == "bounce") $preeval[array_search($card, $booster)]++;
					}
				}
				break;
			case 192: //Aetherworks Marvel
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) { 
					foreach ($inpool->themes as $theme) {
						if ($theme == "generator") $preeval[array_search($card, $booster)] += 2;
					}
				}
				break;
			case 193: //Animation Module
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) { 
					foreach ($inpool->themes as $theme) {
						if ($theme == "counters") $preeval[array_search($card, $booster)] += 2;
					}
				}
				break;
			case 194: //Aradara Express
				$temp = 0;
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) {
					foreach ($inpool->subtype as $subtype) {
						if ($subtype == "V" && $inpool->LSV > $card->LSV) $temp++;
					}
				}
				if ($temp > 2) $preeval[array_search($card, $booster)] = 10; //so as not to overdo vehicles
				unset($temp);
				break;
			case 195: //Ballista Charger
				$temp = 0;
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) {
					foreach ($inpool->subtype as $subtype) {
						if ($subtype == "V" && $inpool->LSV > $card->LSV) $temp++;
					}
				}
				if ($temp > 2) $preeval[array_search($card, $booster)] = 10; //so as not to overdo vehicles
				unset($temp);
				break;
			case 196: //Bomat Bazaar Barge
				$temp = 0;
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) {
					foreach ($inpool->subtype as $subtype) {
						if ($subtype == "V" && $inpool->LSV > $card->LSV) $temp++;
					}
				}
				if ($temp > 2) $preeval[array_search($card, $booster)] = 10; //so as not to overdo vehicles
				unset($temp);
				break;
			case 200: //Chief of the Foundry
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) { 
					if ($inpool->archetype == "AC" && $inpool->LSV >= 15) $preeval[array_search($card, $booster)] += 2;
					foreach ($inpool->themes as $theme) {
						if ($theme == "tokens") $preeval[array_search($card, $booster)] += 2;
					}
				}
				break;
			case 203: //Cultivator's Caravan
				if ($_SESSION['round'] >= 1) {
					foreach ($_SESSION['players'][$player]->cardpool as $inpool) { 
						if (strlen($inpool->color) == 1 && $inpool->color != $primary->color && $inpool->color != $secondary->color && $inpool->LSV > 30) $preeval[array_search($card, $booster)] += 5;
						elseif (strlen($inpool->color) > 1 && $inpool->color != $primary->color . $secondary->color && $inpool->color != $secondary->color . $primary->color) { //this is to check if either color of a multicolored card matches one of the player's primary colors
							$temp = preg_split('//', $inpool->color, -1, PREG_SPLIT_NO_EMPTY);
							foreach ($temp as $color) {
								if ($color != $primary->color && $color == $secondary->color && $inpool->LSV >= 30) $preeval[array_search($card, $booster)] += 5;
								elseif ($color == $primary->color && $color != $secondary->color && $inpool->LSV >= 30) $preeval[array_search($card, $booster)] += 5;
							}
						}
						unset($temp);
					}
				}
				$temp = 0;
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) {
					foreach ($inpool->subtype as $subtype) {
						if ($subtype == "V" && $inpool->LSV > $card->LSV) $temp++;
					}
				}
				if ($temp > 2) $preeval[array_search($card, $booster)] = 10; //not utterly horendous but just about
				unset($temp);
				break;
			case 204: //Deadlock Trap
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) { 
					foreach ($inpool->themes as $theme) {
						if ($theme == "generator") $preeval[array_search($card, $booster)] += 2;
					}
				}
				break;
			case 205: //Decoction Module
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) { 
					foreach ($inpool->themes as $theme) {
						if ($theme == "sink") $preeval[array_search($card, $booster)]++;
						if ($theme == "tokens") $preeval[array_search($card, $booster)] += 2;
						if ($theme == "blink") $preeval[array_search($card, $booster)]++;
					}
				}
				break;
			case 206: //Demolition Stomper
				$temp = 0;
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) {
					foreach ($inpool->subtype as $subtype) {
						if ($subtype == "V" && $inpool->LSV > $card->LSV) $temp++;
					}
				}
				if ($temp > 2) $preeval[array_search($card, $booster)] = 10; //so as not to overdo vehicles
				unset($temp);
				break;
			case 208: //Dynvolt Tower
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) {
					if (($inpool->archetype == "S" || $inpool->archetype == "I") && $inpool->LSV == 20) $preeval[array_search($card, $booster)] += 2;
					foreach ($inpool->themes as $theme) {
						if ($theme == "generator") $preeval[array_search($card, $booster)] += 2;
					}
				}
				break;
			case 210: //Electrostatic Pummeler
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) { 
					foreach ($inpool->themes as $theme) {
						if ($theme == "generator") $preeval[array_search($card, $booster)] += 2;
					}
				}
				break;
			case 211: //Fabrication Module
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) { 
					foreach ($inpool->themes as $theme) {
						if ($theme == "generator") $preeval[array_search($card, $booster)]++;
					}
				}
				break;
			case 215: //Foundry Inspector
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) { 
					if (($inpool->archetype == "A" || $inpool->archetype == "AC") && $inpool->LSV >= 15) $preeval[array_search($card, $booster)] += 2;
				}
				break;
			case 217: //Glassblower's Puzzleknot
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) { 
					foreach ($inpool->themes as $theme) {
						if ($theme == "generator") $preeval[array_search($card, $booster)]++;
					}
				}
				break;
			case 218: //Inventor's Goggles
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) {
					foreach ($inpool->subtype as $subtype) {
						if ($subtype == "A") $preeval[array_search($card, $booster)] += 2;
					}
				}
				break;
			case 219: //Ironleague Steed
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) { 
					foreach ($inpool->themes as $theme) {
						if ($theme == "blink") $preeval[array_search($card, $booster)]++;
						if ($theme == "bounce") $preeval[array_search($card, $booster)]++;
					}
				}
				break;
			case 222: //Metalwork Colossus
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) { 
					if ($inpool->archetype == "A" && $inpool->LSV >= 15) $preeval[array_search($card, $booster)] += 3;
				}
				break;
			case 223: //Multiform Wonder
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) { 
					foreach ($inpool->themes as $theme) {
						if ($theme == "generator") $preeval[array_search($card, $booster)] += 2;
					}
				}
				break;
			case 225: //Ovalchase Dragster
				$temp = 0;
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) {
					foreach ($inpool->subtype as $subtype) {
						if ($subtype == "V" && $inpool->LSV > $card->LSV) $temp++;
					}
				}
				if ($temp > 2) $preeval[array_search($card, $booster)] = 10; //so as not to overdo vehicles
				unset($temp);
				break;
			case 226: //Panharmonicon
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) { 
					foreach ($inpool->themes as $theme) {
						if ($theme == "ETB") $preeval[array_search($card, $booster)] += 3;
						if ($theme == "blink") $preeval[array_search($card, $booster)] += 2;
						if ($theme == "bounce") $preeval[array_search($card, $booster)]++;
					}
				}
				break;
			case 229: //Prophetic Prism
				if ($_SESSION['round'] >= 1) {
					foreach ($_SESSION['players'][$player]->cardpool as $inpool) { 
						if (strlen($inpool->color) == 1 && $inpool->color != $primary->color && $inpool->color != $secondary->color && $inpool->LSV > 30) $preeval[array_search($card, $booster)] += 5;
						elseif (strlen($inpool->color) > 1 && $inpool->color != $primary->color . $secondary->color && $inpool->color != $secondary->color . $primary->color) { //this is to check if either color of a multicolored card matches one of the player's primary colors
							$temp = preg_split('//', $inpool->color, -1, PREG_SPLIT_NO_EMPTY);
							foreach ($temp as $color) {
								if ($color != $primary->color && $color == $secondary->color && $inpool->LSV >= 30) $preeval[array_search($card, $booster)] += 5;
								elseif ($color == $primary->color && $color != $secondary->color && $inpool->LSV >= 30) $preeval[array_search($card, $booster)] += 5;
							}
						}
						unset($temp);
					}
				}
				break;
			case 232: //Self-Assembler
				$temp = 0;
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) { 
					if ($inpool->number == 232) $temp++;
				}
					if ($temp == 1) $preeval[array_search($card, $booster)] += 10;
					elseif ($temp == 2) $preeval[array_search($card, $booster)] += 15;
					elseif ($temp >= 3) $preeval[array_search($card, $booster)] -= (10 * ($temp - 1));
				unset($temp);
				break;
			case 233: //Sky Skiff
				$temp = 0;
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) {
					foreach ($inpool->subtype as $subtype) {
						if ($subtype == "V" && $inpool->LSV > $card->LSV) $temp++;
					}
				}
				if ($temp > 2) $preeval[array_search($card, $booster)] = 10; //so as not to overdo vehicles
				unset($temp);
				break;
			case 240: //Woodweaver's Puzzleknot
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) { 
					foreach ($inpool->themes as $theme) {
						if ($theme == "sink") $preeval[array_search($card, $booster)] += 2;
					}
				}
				break;
			case 241: //Workshop Assistant
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) { 
					if (($inpool->archetype == "A" || $inpool->archetype == "AC") && $inpool->LSV >= 15) $preeval[array_search($card, $booster)]++;
				}
				break;
			case 242: //Aether Hub
				if ($_SESSION['round'] >= 1) {
					foreach ($_SESSION['players'][$player]->cardpool as $inpool) { 
						if (strlen($inpool->color) == 1 && $inpool->color != $primary->color && $inpool->color != $secondary->color && $inpool->LSV > 30) $preeval[array_search($card, $booster)] += 5;
						elseif (strlen($inpool->color) > 1 && $inpool->color != $primary->color . $secondary->color && $inpool->color != $secondary->color . $primary->color) { //this is to check if either color of a multicolored card matches one of the player's primary colors
							$temp = preg_split('//', $inpool->color, -1, PREG_SPLIT_NO_EMPTY);
							foreach ($temp as $color) {
								if ($color != $primary->color && $color == $secondary->color && $inpool->LSV >= 30) $preeval[array_search($card, $booster)] += 5;
								elseif ($color == $primary->color && $color != $secondary->color && $inpool->LSV >= 30) $preeval[array_search($card, $booster)] += 5;
							}
						}
						unset($temp);
					}
				}
				$temp = 0;
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) { 
					if ($inpool->number == 242) $temp++;
				}
				if ($temp > 1) $preeval[array_search($card, $booster)] -= 5 * $temp; //checks if the player already has two or more Attune with Aether to reduce its value accordingly because multiples are undesirable
				unset($temp);
				break;
			case 243: //Blooming Marsh
				if ((($booster[array_search($card, $booster)]->color == $primary->color . $secondary->color) || ($booster[array_search($card, $booster)]->color == $secondary->color . $primary->color)) && $_SESSION['round'] >= 1) $preeval[array_search($card, $booster)] += 2; //checks if the land's colors match the player's archetype which is more relevant later in the draft once the archetype is set
				elseif ($_SESSION['round'] >= 1) {
					$temp = preg_split('//', $booster[array_search($card, $booster)]->color, -1, PREG_SPLIT_NO_EMPTY); //separates the land's colors into an array
					if ($temp[0] == $primary->color || $temp[0] == $secondary->color) { //checks if the first color matches any of the player's primary colors
						foreach ($_SESSION['players'][$player]->cardpool as $inpool) { //looks through the player's cardpool for cards that match the off-color
							if (strlen($inpool->color) == 1 && $inpool->color == $temp[1] && $inpool->LSV >= 30) $preeval[array_search($card, $booster)] += 5; //single-color cards whose color the same as the off-color of the land
							elseif (strlen(preg_replace("/[^A-Z.]/", "", $inpool->color)) == 2 && (($inpool->color != $primary->color . $secondary->color) || ($inpool->color != $secondary->color . $primary->color)) && $inpool->LSV > 30) { //check if the card is multicolored and if it matches the player's color archetype
								$gold = array();
								$gold = preg_split('//', $inpool->color, -1, PREG_SPLIT_NO_EMPTY); //separates the card's colors into an array
								if (($gold[0] == $primary->color || $gold[0] == $secondary->color) && $gold[1] == $temp[1]) $preeval[array_search($card, $booster)] += 5; //checks if the first color matches any of the primaries and if the second color mathes the off-color of the land (at this point all color archetype matches have been excluded)
								elseif (($gold[1] == $primary->color || $gold[1] == $secondary->color) && $gold[0] == $temp[1]) $preeval[array_search($card, $booster)] += 5; //checks if the second color matches any of the primaries and if the first color mathes the off-color of the land (at this point all color archetype matches have been excluded)
							}
						}
					} elseif ($temp[1] == $primary->color || $temp[1] == $secondary->color) { //same as above only in reverse, i.e. the second color of the land matches one of the player's primary colors while the first one doesn't
						foreach ($_SESSION['players'][$player]->cardpool as $inpool) {
							if (strlen($inpool->color) == 1 && $inpool->color == $temp[0] && $inpool->LSV >= 30) $preeval[array_search($card, $booster)] += 5;
							elseif (strlen(preg_replace("/[^A-Z.]/", "", $inpool->color)) == 2 && (($inpool->color != $primary->color . $secondary->color) || ($inpool->color != $secondary->color . $primary->color)) && $inpool->LSV > 30) {
								$gold = array();
								$gold = preg_split('//', $inpool->color, -1, PREG_SPLIT_NO_EMPTY);
								if (($gold[0] == $primary->color || $gold[0] == $secondary->color) && $gold[1] == $temp[0]) $preeval[array_search($card, $booster)] += 5;
								elseif (($gold[1] == $primary->color || $gold[1] == $secondary->color) && $gold[0] == $temp[0]) $preeval[array_search($card, $booster)] += 5;
							}
						}
					}
				}
				unset($temp);
				unset($gold);
				break;
			case 244: //Botanical Sanctum
				if ((($booster[array_search($card, $booster)]->color == $primary->color . $secondary->color) || ($booster[array_search($card, $booster)]->color == $secondary->color . $primary->color)) && $_SESSION['round'] >= 1) $preeval[array_search($card, $booster)] += 2; //checks if the land's colors match the player's archetype which is more relevant later in the draft once the archetype is set
				elseif ($_SESSION['round'] >= 1) {
					$temp = preg_split('//', $booster[array_search($card, $booster)]->color, -1, PREG_SPLIT_NO_EMPTY); //separates the land's colors into an array
					if ($temp[0] == $primary->color || $temp[0] == $secondary->color) { //checks if the first color matches any of the player's primary colors
						foreach ($_SESSION['players'][$player]->cardpool as $inpool) { //looks through the player's cardpool for cards that match the off-color
							if (strlen($inpool->color) == 1 && $inpool->color == $temp[1] && $inpool->LSV >= 30) $preeval[array_search($card, $booster)] += 5; //single-color cards whose color the same as the off-color of the land
							elseif (strlen(preg_replace("/[^A-Z.]/", "", $inpool->color)) == 2 && (($inpool->color != $primary->color . $secondary->color) || ($inpool->color != $secondary->color . $primary->color)) && $inpool->LSV > 30) { //check if the card is multicolored and if it matches the player's color archetype
								$gold = array();
								$gold = preg_split('//', $inpool->color, -1, PREG_SPLIT_NO_EMPTY); //separates the card's colors into an array
								if (($gold[0] == $primary->color || $gold[0] == $secondary->color) && $gold[1] == $temp[1]) $preeval[array_search($card, $booster)] += 5; //checks if the first color matches any of the primaries and if the second color mathes the off-color of the land (at this point all color archetype matches have been excluded)
								elseif (($gold[1] == $primary->color || $gold[1] == $secondary->color) && $gold[0] == $temp[1]) $preeval[array_search($card, $booster)] += 5; //checks if the second color matches any of the primaries and if the first color mathes the off-color of the land (at this point all color archetype matches have been excluded)
							}
						}
					} elseif ($temp[1] == $primary->color || $temp[1] == $secondary->color) { //same as above only in reverse, i.e. the second color of the land matches one of the player's primary colors while the first one doesn't
						foreach ($_SESSION['players'][$player]->cardpool as $inpool) {
							if (strlen($inpool->color) == 1 && $inpool->color == $temp[0] && $inpool->LSV >= 30) $preeval[array_search($card, $booster)] += 5;
							elseif (strlen(preg_replace("/[^A-Z.]/", "", $inpool->color)) == 2 && (($inpool->color != $primary->color . $secondary->color) || ($inpool->color != $secondary->color . $primary->color)) && $inpool->LSV > 30) {
								$gold = array();
								$gold = preg_split('//', $inpool->color, -1, PREG_SPLIT_NO_EMPTY);
								if (($gold[0] == $primary->color || $gold[0] == $secondary->color) && $gold[1] == $temp[0]) $preeval[array_search($card, $booster)] += 5;
								elseif (($gold[1] == $primary->color || $gold[1] == $secondary->color) && $gold[0] == $temp[0]) $preeval[array_search($card, $booster)] += 5;
							}
						}
					}
				}
				unset($temp);
				unset($gold);
				break;
			case 245: //Concealed Courtyard
				if ((($booster[array_search($card, $booster)]->color == $primary->color . $secondary->color) || ($booster[array_search($card, $booster)]->color == $secondary->color . $primary->color)) && $_SESSION['round'] >= 1) $preeval[array_search($card, $booster)] += 2; //checks if the land's colors match the player's archetype which is more relevant later in the draft once the archetype is set
				elseif ($_SESSION['round'] >= 1) {
					$temp = preg_split('//', $booster[array_search($card, $booster)]->color, -1, PREG_SPLIT_NO_EMPTY); //separates the land's colors into an array
					if ($temp[0] == $primary->color || $temp[0] == $secondary->color) { //checks if the first color matches any of the player's primary colors
						foreach ($_SESSION['players'][$player]->cardpool as $inpool) { //looks through the player's cardpool for cards that match the off-color
							if (strlen($inpool->color) == 1 && $inpool->color == $temp[1] && $inpool->LSV >= 30) $preeval[array_search($card, $booster)] += 5; //single-color cards whose color the same as the off-color of the land
							elseif (strlen(preg_replace("/[^A-Z.]/", "", $inpool->color)) == 2 && (($inpool->color != $primary->color . $secondary->color) || ($inpool->color != $secondary->color . $primary->color)) && $inpool->LSV > 30) { //check if the card is multicolored and if it matches the player's color archetype
								$gold = array();
								$gold = preg_split('//', $inpool->color, -1, PREG_SPLIT_NO_EMPTY); //separates the card's colors into an array
								if (($gold[0] == $primary->color || $gold[0] == $secondary->color) && $gold[1] == $temp[1]) $preeval[array_search($card, $booster)] += 5; //checks if the first color matches any of the primaries and if the second color mathes the off-color of the land (at this point all color archetype matches have been excluded)
								elseif (($gold[1] == $primary->color || $gold[1] == $secondary->color) && $gold[0] == $temp[1]) $preeval[array_search($card, $booster)] += 5; //checks if the second color matches any of the primaries and if the first color mathes the off-color of the land (at this point all color archetype matches have been excluded)
							}
						}
					} elseif ($temp[1] == $primary->color || $temp[1] == $secondary->color) { //same as above only in reverse, i.e. the second color of the land matches one of the player's primary colors while the first one doesn't
						foreach ($_SESSION['players'][$player]->cardpool as $inpool) {
							if (strlen($inpool->color) == 1 && $inpool->color == $temp[0] && $inpool->LSV >= 30) $preeval[array_search($card, $booster)] += 5;
							elseif (strlen(preg_replace("/[^A-Z.]/", "", $inpool->color)) == 2 && (($inpool->color != $primary->color . $secondary->color) || ($inpool->color != $secondary->color . $primary->color)) && $inpool->LSV > 30) {
								$gold = array();
								$gold = preg_split('//', $inpool->color, -1, PREG_SPLIT_NO_EMPTY);
								if (($gold[0] == $primary->color || $gold[0] == $secondary->color) && $gold[1] == $temp[0]) $preeval[array_search($card, $booster)] += 5;
								elseif (($gold[1] == $primary->color || $gold[1] == $secondary->color) && $gold[0] == $temp[0]) $preeval[array_search($card, $booster)] += 5;
							}
						}
					}
				}
				unset($temp);
				unset($gold);
				break;
			case 246: //Inspiring Vantage
				if ((($booster[array_search($card, $booster)]->color == $primary->color . $secondary->color) || ($booster[array_search($card, $booster)]->color == $secondary->color . $primary->color)) && $_SESSION['round'] >= 1) $preeval[array_search($card, $booster)] += 2; //checks if the land's colors match the player's archetype which is more relevant later in the draft once the archetype is set
				elseif ($_SESSION['round'] >= 1) {
					$temp = preg_split('//', $booster[array_search($card, $booster)]->color, -1, PREG_SPLIT_NO_EMPTY); //separates the land's colors into an array
					if ($temp[0] == $primary->color || $temp[0] == $secondary->color) { //checks if the first color matches any of the player's primary colors
						foreach ($_SESSION['players'][$player]->cardpool as $inpool) { //looks through the player's cardpool for cards that match the off-color
							if (strlen($inpool->color) == 1 && $inpool->color == $temp[1] && $inpool->LSV >= 30) $preeval[array_search($card, $booster)] += 5; //single-color cards whose color the same as the off-color of the land
							elseif (strlen(preg_replace("/[^A-Z.]/", "", $inpool->color)) == 2 && (($inpool->color != $primary->color . $secondary->color) || ($inpool->color != $secondary->color . $primary->color)) && $inpool->LSV > 30) { //check if the card is multicolored and if it matches the player's color archetype
								$gold = array();
								$gold = preg_split('//', $inpool->color, -1, PREG_SPLIT_NO_EMPTY); //separates the card's colors into an array
								if (($gold[0] == $primary->color || $gold[0] == $secondary->color) && $gold[1] == $temp[1]) $preeval[array_search($card, $booster)] += 5; //checks if the first color matches any of the primaries and if the second color mathes the off-color of the land (at this point all color archetype matches have been excluded)
								elseif (($gold[1] == $primary->color || $gold[1] == $secondary->color) && $gold[0] == $temp[1]) $preeval[array_search($card, $booster)] += 5; //checks if the second color matches any of the primaries and if the first color mathes the off-color of the land (at this point all color archetype matches have been excluded)
							}
						}
					} elseif ($temp[1] == $primary->color || $temp[1] == $secondary->color) { //same as above only in reverse, i.e. the second color of the land matches one of the player's primary colors while the first one doesn't
						foreach ($_SESSION['players'][$player]->cardpool as $inpool) {
							if (strlen($inpool->color) == 1 && $inpool->color == $temp[0] && $inpool->LSV >= 30) $preeval[array_search($card, $booster)] += 5;
							elseif (strlen(preg_replace("/[^A-Z.]/", "", $inpool->color)) == 2 && (($inpool->color != $primary->color . $secondary->color) || ($inpool->color != $secondary->color . $primary->color)) && $inpool->LSV > 30) {
								$gold = array();
								$gold = preg_split('//', $inpool->color, -1, PREG_SPLIT_NO_EMPTY);
								if (($gold[0] == $primary->color || $gold[0] == $secondary->color) && $gold[1] == $temp[0]) $preeval[array_search($card, $booster)] += 5;
								elseif (($gold[1] == $primary->color || $gold[1] == $secondary->color) && $gold[0] == $temp[0]) $preeval[array_search($card, $booster)] += 5;
							}
						}
					}
				}
				unset($temp);
				unset($gold);
				break;
			case 249: //Spirebluff Canal				
				if ((($booster[array_search($card, $booster)]->color == $primary->color . $secondary->color) || ($booster[array_search($card, $booster)]->color == $secondary->color . $primary->color)) && $_SESSION['round'] >= 1) $preeval[array_search($card, $booster)] += 2; //checks if the land's colors match the player's archetype which is more relevant later in the draft once the archetype is set
				elseif ($_SESSION['round'] >= 1) {
					$temp = preg_split('//', $booster[array_search($card, $booster)]->color, -1, PREG_SPLIT_NO_EMPTY); //separates the land's colors into an array
					if ($temp[0] == $primary->color || $temp[0] == $secondary->color) { //checks if the first color matches any of the player's primary colors
						foreach ($_SESSION['players'][$player]->cardpool as $inpool) { //looks through the player's cardpool for cards that match the off-color
							if (strlen($inpool->color) == 1 && $inpool->color == $temp[1] && $inpool->LSV >= 30) $preeval[array_search($card, $booster)] += 5; //single-color cards whose color the same as the off-color of the land
							elseif (strlen(preg_replace("/[^A-Z.]/", "", $inpool->color)) == 2 && (($inpool->color != $primary->color . $secondary->color) || ($inpool->color != $secondary->color . $primary->color)) && $inpool->LSV > 30) { //check if the card is multicolored and if it matches the player's color archetype
								$gold = array();
								$gold = preg_split('//', $inpool->color, -1, PREG_SPLIT_NO_EMPTY); //separates the card's colors into an array
								if (($gold[0] == $primary->color || $gold[0] == $secondary->color) && $gold[1] == $temp[1]) $preeval[array_search($card, $booster)] += 5; //checks if the first color matches any of the primaries and if the second color mathes the off-color of the land (at this point all color archetype matches have been excluded)
								elseif (($gold[1] == $primary->color || $gold[1] == $secondary->color) && $gold[0] == $temp[1]) $preeval[array_search($card, $booster)] += 5; //checks if the second color matches any of the primaries and if the first color mathes the off-color of the land (at this point all color archetype matches have been excluded)
							}
						}
					} elseif ($temp[1] == $primary->color || $temp[1] == $secondary->color) { //same as above only in reverse, i.e. the second color of the land matches one of the player's primary colors while the first one doesn't
						foreach ($_SESSION['players'][$player]->cardpool as $inpool) {
							if (strlen($inpool->color) == 1 && $inpool->color == $temp[0] && $inpool->LSV >= 30) $preeval[array_search($card, $booster)] += 5;
							elseif (strlen(preg_replace("/[^A-Z.]/", "", $inpool->color)) == 2 && (($inpool->color != $primary->color . $secondary->color) || ($inpool->color != $secondary->color . $primary->color)) && $inpool->LSV > 30) {
								$gold = array();
								$gold = preg_split('//', $inpool->color, -1, PREG_SPLIT_NO_EMPTY);
								if (($gold[0] == $primary->color || $gold[0] == $secondary->color) && $gold[1] == $temp[0]) $preeval[array_search($card, $booster)] += 5;
								elseif (($gold[1] == $primary->color || $gold[1] == $secondary->color) && $gold[0] == $temp[0]) $preeval[array_search($card, $booster)] += 5;
							}
						}
					}
				}
				unset($temp);
				unset($gold);
				break;
		}
	}
	
	if ($_SESSION['round'] == 2) { //this is to smooth out the curve of the player's would be deck by checking a given card against other cards in the player's pool that may be more playable by comparing their converted costs
		//this should take different archetypes into account as some archetypes may favor lower curves while others could get away with a higher one => adjust ones archetype mechanics are fleshed out
		$temp = 0;
		foreach ($booster as $card) {
			switch ($card->concost) {
				case 1:
					foreach ($_SESSION['players'][$player]->cardpool as $cc1) {
						if ($cc1->concost == 1 && (($cc1->LSV - $card->LSV) > 10)) $temp++;
					}
					if ($temp >= 2) $preeval[array_search($option, $booster)] -= 4 * $temp;
					unset($temp);
					break;
				case 2:
					foreach ($_SESSION['players'][$player]->cardpool as $cc2) {
						if ($cc2->concost == 2 && (($cc2->LSV - $card->LSV) > 10)) $temp++;
					}
					if ($temp >= 4) $preeval[array_search($option, $booster)] -= 3 * $temp;
					unset($temp);
					break;
				case 3:
					foreach ($_SESSION['players'][$player]->cardpool as $cc3) {
						if ($cc3->concost == 3 && (($cc3->LSV - $card->LSV) > 10)) $temp++;
					}
					if ($temp >= 5) $preeval[array_search($option, $booster)] -= 3 * $temp;
					unset($temp);
					break;
				case 4:
					foreach ($_SESSION['players'][$player]->cardpool as $cc4) {
						if ($cc4->concost == 4 && (($cc4->LSV - $card->LSV) > 10)) $temp++;
					}
					if ($temp >= 5) $preeval[array_search($option, $booster)] -= 3 * $temp;
					unset($temp);
					break;
				case 5:
					foreach ($_SESSION['players'][$player]->cardpool as $cc5) {
						if ($cc5->concost == 5 && (($cc5->LSV - $card->LSV) > 10)) $temp++;
					}
					if ($temp >= 4) $preeval[array_search($option, $booster)] -= 4 * $temp;
					unset($temp);
					break;
				case 6:
					foreach ($_SESSION['players'][$player]->cardpool as $cc6) {
						if ($cc6->concost == 6 && (($cc6->LSV - $card->LSV) > 10)) $temp++;
					}
					if ($temp >= 2) $preeval[array_search($option, $booster)] -= 5 * $temp;
					unset($temp);
					break;
				case 7:
					foreach ($_SESSION['players'][$player]->cardpool as $cc7) {
						if ($cc7->concost == 7 && (($cc7->LSV - $card->LSV) > 10)) $temp++;
					}
					if ($temp >= 1) $preeval[array_search($option, $booster)] -= 7 * $temp;
					unset($temp);
					break;
				default:
				break;
			} 
		}
	}
	
	//the following applies LSV increments made during evaluation to all the cards in the booster at once
	for ($i = 0; $i < count ($booster); $i++) { 
		$booster[$i]->LSV = $preeval[$i];
	}
	
	//the following is to collect information about cards being passed to the player as a signal of color availability
	if ($_SESSION['round'] == 0 && count($booster) < 15) {
		$signal = array_keys($_SESSION['players'][$player]->signal);
		foreach ($booster as $card) {
			if (strlen($card->color) == 1) { //if the card has only one color this clause adds its LSV value to the corresponding color signal provided it is valuable enough to register as a signal
				foreach ($signal as $color) {
					if ($card->color == $color && $card->LSV > 20) {
						$_SESSION['players'][$player]->signal[$color]->quality += $card->LSV;
						$_SESSION['players'][$player]->signal[$color]->quantity++;
					}
				}
			} elseif (strlen($card->color) > 1) { //if the card has more than one color this clause splits its colors into an array and adds half its LSV value (to account for possible difficulties in playing it) to each corresponding color signal provided it is valuable enough to register as a signal
				$temp = preg_split('//', $card->color, -1, PREG_SPLIT_NO_EMPTY);
				for ($mc = 0; $mc < count($temp); $mc++) {
					foreach ($signal as $color) {
						if ($temp[$mc] == $color && $card->LSV > 20) {
							$_SESSION['players'][$player]->signal[$color]->quality += ($card->LSV / count($temp));
							$_SESSION['players'][$player]->signal[$color]->quantity += 0.5;
						}
					}
				}
				unset($temp);
			}
		}
	}
	$maxsignal = new Signal;
	if (($_SESSION['round'] == 0 && count($booster) <= 10) || ($_SESSION['round'] == 1 && count($booster) < 15)) { //CHECK IF THIS ACTUALLY WORKS!
		$signal = array_keys($_SESSION['players'][$player]->signal);
		foreach ($signal as $color) {
			if ($_SESSION['players'][$player]->signal[$color]->quality > $maxsignal->quality) {
				$maxsignal->quality = $_SESSION['players'][$player]->signal[$color]->quality;
				$maxsignal->quantity = $_SESSION['players'][$player]->signal[$color]->quantity;
				$maxsignal->color = $color;
			}
		}
		if ($maxsignal->color != $primary->color && $maxsignal->color != $secondary->color) {
			if (((($maxsignal->quality / $maxsignal->quantity) - ($primary->quality / $primary->quantity)) > 10) || ((($maxsignal->quality / $maxsignal->quantity) - ($secondary->quality / $secondary->quantity)) > 20)) {
				$maxsignal->signal = TRUE;
			}
		}
	}
	
	//the following will make a pick according to the player's colors and draft phase
	//the first loop will go over on-color options while the second one will look for possible splashes
	if ($benchmark != null) unset($benchmark); //purge the benchmark object if it's not null for some reason
	$benchmark = new Benchmark; //selector object storing the highest LSV and the key of the card
	for ($card = 0; $card < count($booster); $card++) {
		if ($_SESSION['round'] == 0 && count($booster) > 10) { //the first five picks are informed by LSV value of cards alone
			if ($booster[$card]->LSV > $benchmark->value) {
				$benchmark->value = $booster[$card]->LSV; //stores the highest LSV so far
				$benchmark->selector = $card; //this is the key of the card in the booster array necessary for selection and removal after the pick is finalized
			}
		} elseif ($maxsignal->signal == TRUE && $booster[$card]->color == $maxsignal->color && $booster[$card]->LSV >= 25) { //this is to determine if the signal differs from the player's colors and to act upon it by considering LSV values of cards of signaled color in the final estimation
			if ($booster[$card]->LSV > $benchmark->value) {
				$benchmark->value = $booster[$card]->LSV; //stores the highest on color LSV so far
				$benchmark->selector = $card; //this is the key of the card in the booster array necessary for selection and removal after the pick is finalized
			}
		} elseif ($booster[$card]->color == $primary->color || $booster[$card]->color == $secondary->color) {
			if ($booster[$card]->LSV > $benchmark->value) {
				$benchmark->value = $booster[$card]->LSV; //stores the highest on color LSV so far
				$benchmark->selector = $card; //this is the key of the card in the booster array necessary for selection and removal after the pick is finalized
			}
		} elseif (strlen($booster[$card]->color) > 1) {
			if (($booster[$card]->color == $primary->color . $secondary->color) || ($booster[$card]->color == $secondary->color . $primary->color)) {
				if ($booster[$card]->LSV > $benchmark->value) {
					$benchmark->value = $booster[$card]->LSV; //takes in the value of a multicolor card if both its colors correspond to the player's primary colors
					$benchmark->selector = $card; //this is the key of the card in the booster array necessary for selection and removal after the pick is finalized
				}
			} 
		}
	}
	for ($card = 0; $card < count($booster); $card++) { //this loop checks for possible splash material after on-color options have been evaluated
		if (strlen($booster[$card]->color) == 1 && $booster[$card]->color != $primary->color && $booster[$card]->color != $secondary->color && $booster[$card]->LSV > 30) {
			if (($booster[$card]->LSV - 10) > $benchmark->value) { //compares reduced LSV to see if it justifies the extra work of splashing the card into the player's deck
				$benchmark->value = $booster[$card]->LSV; //stores the highest on color LSV so far
				$benchmark->selector = $card; //this is the key of the card in the booster array necessary for selection and removal after the pick is finalized
			}
		}
		elseif (strlen($booster[$card]->color) > 1 && $booster[$card]->LSV > 30) {
			if (($booster[$card]->color != $primary->color . $secondary->color) && ($booster[$card]->color != $secondary->color . $primary->color)) { //this excludes matching multicolor cards from evaluation as they have already been considered in the previous loop
				$temp = preg_split('//', $booster[$card]->color, -1, PREG_SPLIT_NO_EMPTY);
				foreach ($temp as $color) {
					if ($color == $primary->color || $color == $secondary->color) { //we know by now that the card's color combination and that of primary colors of the player don't match so if any one of the card's colors correspond to the player's colors the card may be splashable
						if (($booster[$card]->LSV - 10) > $benchmark->value) { //compares reduced LSV to see if it justifies the extra work of splashing the card into the player's deck
							$benchmark->value = $booster[$card]->LSV; //stores the highest on color LSV so far
							$benchmark->selector = $card; //this is the key of the card in the booster array necessary for selection and removal after the pick is finalized
						}
					}
				}
				unset($temp);
			}
		}
	}
	$pick = clone $booster[$benchmark->selector]; //make a pick from the temporary booster to retain the adjusted LSV for subsequent evaluations
	array_push($_SESSION['players'][$player]->cardpool, $pick);
	if ($pick->color != "A" && $pick->color != "N") {
		if (strlen($pick->color) == 1) {
			$_SESSION['players'][$player]->colors[$pick->color]->quality += $pick->LSV;
			$_SESSION['players'][$player]->colors[$pick->color]->quantity++;
		} else {
			$temp = preg_split('//', $pick->color, -1, PREG_SPLIT_NO_EMPTY);
			foreach ($temp as $color) {
				$_SESSION['players'][$player]->colors[$color]->quality += ($pick->LSV / 2);
				$_SESSION['players'][$player]->colors[$color]->quantity += 0.5;
			}
		}
	}
	$_SESSION['players'][$player]->curve[$pick->concost]++;
	
	foreach ($_SESSION['players'][$player]->cardpool as $inpool) { //this is to update the LSV values of cards in the player's cardpool to reflect their increased value due to picks made so far; this may be important for future evaluations
		switch ($pick->number) {
			case 1: //Acrobatic Meneuver
				foreach ($inpool->themes as $theme) {
					if ($theme == "ETB") $inpool->LSV++;
				}
				break;
			case 3: //Aetherstorm Roc
				foreach ($inpool->themes as $theme) {
					if ($theme == "generator") $inpool->LSV++;
					if ($theme == "sink") $inpool->LSV++;
				}
				break;
			case 4: //Angel of Invention
				foreach ($inpool->themes as $theme) {
					if ($theme == "blink") $inpool->LSV += 2;
					if ($theme == "bounce") $inpool->LSV++;
				}
				break;
			case 6: //Aviary Mechanic
				foreach ($inpool->themes as $theme) {
					if ($theme == "ETB") $inpool->LSV++;
				}
				break;
			case 11: //Consul's Shieldguard
				foreach ($inpool->themes as $theme) {
					if ($theme == "generator") $inpool->LSV++;
				}
				break;
			case 12: //Eddytrail Hawk
				$evasion = null;
				foreach ($inpool->themes as $theme) {
					if ($theme == "generator") $preeval[array_search($inpool, $booster)]++;
					if ($theme == "evasion") $evasion = TRUE;
				}
				if (!$evasion) {
					if (($inpool->archetype == "C" || $inpool->archetype == "AC") && $inpool->LSV > 25) $inpool->LSV++;
				} 
				unset($evasion);
				break;
			case 16: //Gearshift Ace
				foreach ($inpool->subtype as $subtype) {
					if ($subtype == "V") $inpool->LSV++;
				}
				break;
			case 17: //Glint-Sleeve Artisan
				foreach ($inpool->themes as $theme) {
					if ($theme == "blink") $inpool->LSV++;
					if ($theme == "bounce") $inpool->LSV++;
				}
				break;
			case 20: //Inspired Charge
				if ($inpool->archetype == "C" && $inpool->concost <= 3 && $inpool->LSV > 20) $inpool->LSV++;
				foreach ($inpool->themes as $theme) {
					if ($theme == "tokens") $inpool->LSV++;
					if ($theme == "evasion") $inpool->LSV++;
				}
				break;
			case 21: //Master Trinketeer
				foreach ($inpool->themes as $theme) {
					if ($theme == "tokens") $inpool->LSV++;
				}
				foreach ($inpool->subtype as $subtype) {
					if ($subtype == "t") $inpool->LSV++;
				}
				break;
			case 24: //Propeller Pioneer
				foreach ($inpool->themes as $theme) {
					if ($theme == "blink") $inpool->LSV++;
					if ($theme == "bounce") $inpool->LSV++;
				}
				break;
			case 31: //Thriving Ibex
				foreach ($inpool->themes as $theme) {
					if ($theme == "generator") $inpool->LSV++;
				}
				break;
			case 32: //Toolcraft Exemplar
				foreach ($inpool->themes as $theme) {
					if ($theme == "tokens") $inpool->LSV++;
				}
				$temp = 0;
				if (($inpool->archetype == "A" || $inpool->archetype == "AC") && $inpool->LSV > 20 && $inpool->concost <= 3) $temp++; //checks if the player has enough low-cost artifacts to make this desirable
				if ($temp > 4) $inpool->LSV++;
				unset($temp);
				break;
			case 34: //Visionary Augmenter
				foreach ($inpool->themes as $theme) {
					if ($theme == "tokens") $inpool->LSV++;
					if ($theme == "evasion") $inpool->LSV++;
				}
				break;
			case 35: //Wispweaver Angel
				foreach ($inpool->themes as $theme) {
					if ($theme == "ETB") $inpool->LSV += 2;
				}
				break;
			case 37: //Aether Theorist
				foreach ($inpool->themes as $theme) {
					if ($theme == "generator") $inpool->LSV++;
				}
				break;
			case 38: //Aether Tradewinds 
				foreach ($inpool->themes as $theme) {
					if ($theme == "ETB") $inpool->LSV++;
				}
				break;
			case 39: //Aethersquall Ancient
				foreach ($inpool->themes as $theme) {
					if ($theme == "generator") $inpool->LSV += 2;
					if ($theme == "sink") $inpool->LSV++;
				}
				break;
			case 41: //Confiscation Coup
				foreach ($inpool->themes as $theme) {
					if ($theme == "generator") $inpool->LSV += 2;
				}
				break;
			case 45: //Era of Innovation
				if (($inpool->archetype == "A" || $inpool->archetype == "AC") && $inpool->concost <= 3) $inpool->LSV++;
				foreach ($inpool->subtype as $subtype) {
					if ($subtype == "A" && $inpool->concost <= 3) $inpool->LSV++;
				}
				foreach ($inpool->themes as $theme) {
					if ($theme == "tokens") $preeval[array_search($inpool, $booster)] += 2;
					if ($theme == "sink") $preeval[array_search($inpool, $booster)] += 2;
					if ($theme == "generator") $preeval[array_search($inpool, $booster)]++;
				}
				break;
			case 46: //Experimental Aviator
				foreach ($inpool->themes as $theme) {
					if ($theme == "blink") $inpool->LSV += 2;
					if ($theme == "bounce") $inpool->LSV++;
				}				
				break;
			case 48: //Gearseeker Serpent
				foreach ($inpool->themes as $theme) {
					if ($theme == "tokens") $inpool->LSV += 2;
				}
				if (($inpool->archetype == "A" || $inpool->archetype == "AC") && $inpool->LSV > 15) $inpool->LSV++;
				break;
			case 50: //Glint-Nest Crane 
				if (($inpool->archetype == "A" && $inpool->LSV >= 20) || ($inpool->archetype == "AC" && $inpool->LSV >= 20)) $inpool->LSV++;
				break;
			case 51: //Hightide Hermit
				foreach ($inpool->themes as $theme) {
					if ($theme == "generator") $inpool->LSV++;
					if ($theme == "sink") $inpool->LSV++;
				}
				break;
			case 53: //Janjeet Sentry
				foreach ($inpool->themes as $theme) {
					if ($theme == "generator") $inpool->LSV++;
				}
				break;
			case 56: //Metallurgic Summonings
				if (($inpool->archetype == "S" || $inpool->archetype == "I") && $inpool->LSV >= 20) $inpool->LSV += 3;
				break;
			case 57: //Minister of Inquiries
				foreach ($inpool->themes as $theme) {
					if ($theme == "generator") $inpool->LSV++;
				}
				break;
			case 58: //Padeem, Consul of Innovation
				if (($inpool->archetype == "A" && $inpool->LSV >= 20) || ($inpool->archetype == "AC" && $inpool->LSV >= 20)) $inpool->LSV++;
				break;
			case 62: //Saheeli's Artistry
				if (($inpool->archetype == "A" || $inpool->archetype == "AC") && $inpool->LSV >= 20) $inpool->LSV += 2;
				break;
			case 63: //Select for Inspection
				foreach ($inpool->themes as $theme) {
					if ($theme == "ETB") $inpool->LSV++;
				}
				break;
			case 64: //Shrewd Negotiation
				foreach ($inpool->themes as $theme) {
					if ($theme == "tokens") $inpool->LSV += 2;
				}
				break;
			case 66: //Thriving Turtle
				foreach ($inpool->themes as $theme) {
					if ($theme == "generator") $inpool->LSV++;
				}
				break;
			case 67: //Torrential Gearhulk
				if ($inpool->archetype == "I" && $inpool->LSV >= 20) $inpool->LSV++;
				break;
			case 71: //Aetherborn Marauder
				foreach ($inpool->themes as $theme) {
					if ($theme == "counters") $inpool->LSV++;
				}
				break;
			case 73: //Demon of Dark Schemes
				foreach ($inpool->themes as $theme) {
					if ($theme == "generator") $inpool->LSV += 2;
					if ($theme == "sink") $inpool->LSV++;
				}
				break;
			case 74: //Dhund Operative
				if (($inpool->archetype == "A" && $inpool->LSV >= 15) || ($inpool->archetype == "AC" && $inpool->LSV >= 15)) $inpool->LSV++;
				foreach ($inpool->themes as $theme) {
					if ($theme == "tokens") $inpool->LSV++;
				}
				break;
			case 75: //Die Young
				foreach ($inpool->themes as $theme) {
					if ($theme == "generator") $inpool->LSV++;
				}
				break;
			case 78: //Eliminate the Competition
				foreach ($inpool->themes as $theme) {
					if ($theme == "tokens") $inpool->LSV++;
				}
				break;
			case 79: //Embraal Bruiser
				if (($inpool->archetype == "A" && $inpool->LSV >= 15) || ($inpool->archetype == "AC" && $inpool->LSV >= 15)) $inpool->LSV++;
				foreach ($inpool->themes as $theme) {
					if ($theme == "tokens") $inpool->LSV++;
				}
				break;
			case 81: //Fortuitous Find
				if (($inpool->archetype == "A" && $inpool->LSV >= 30) || ($inpool->archetype == "AC" && $inpool->LSV >= 25)) $inpool->LSV += 2;
				break;
			case 82: //Foundry Screecher
				if (($inpool->archetype == "A" && $inpool->LSV >= 15) || ($inpool->archetype == "AC" && $inpool->LSV >= 15)) $inpool->LSV++;
				foreach ($inpool->themes as $theme) {
					if ($theme == "tokens") $inpool->LSV++;
				}
				break;
			case 84: //Gonti, Lord of Luxury
				foreach ($inpool->themes as $theme) {
					if ($theme == "blink") $inpool->LSV += 2;
					if ($theme == "bounce") $inpool->LSV++;
				}
				break;
			case 90: //Marionette Master
				foreach ($inpool->themes as $theme) {
					if ($theme == "blink") $inpool->LSV += 2;
					if ($theme == "bounce") $inpool->LSV++;
					if ($theme == "tokens") $inpool->LSV += 2;
					if ($theme == "sacrifice artifact") $inpool->LSV += 2;
				}
				break;
			case 91: //Maulfist Squad
				foreach ($inpool->themes as $theme) {
					if ($theme == "blink") $inpool->LSV++;
					if ($theme == "bounce") $inpool->LSV++;
				}
				break;
			case 92: //Midnight Oil
				if ($inpool->concost < 4 && $inpool->LSV > 25) $inpool->LSV++;
				break;
			case 94: //Morbid Curiosity
					if ($inpool->concost == "FX" && ($inpool->archetype == "C" || $inpool->archetype == "A" || $inpool->archetype == "AC")) $inpool->LSV += 2; //no non-creature artifacts with flexible cost but these are included for the sake of scalability
				break;
			case 97: //Ovalchase Daredevil
					if (($inpool->archetype == "A" || $inpool->archetype == "AC") && $inpool->LSV >= 15) $inpool->LSV++;
					foreach ($inpool->themes as $theme) {
						if ($theme == "tokens") $inpool->LSV++;
					}
				break;
			case 101: //Syndicate Trafficker
				if (($inpool->archetype == "A" || $inpool->archetype == "AC") && $inpool->LSV >= 15) $inpool->LSV++;
				foreach ($inpool->themes as $theme) {
					if ($theme == "tokens") $inpool->LSV++;
				}
				break;
			case 102: //Thriving Rats
				foreach ($inpool->themes as $theme) {
					if ($theme == "generator") $inpool->LSV++;
				}
				break;
			case 103: //Underhanded Designs
				if (($inpool->archetype == "A" || $inpool->archetype == "AC") && $inpool->LSV >= 15) $inpool->LSV++;
				foreach ($inpool->themes as $theme) {
					if ($theme == "tokens") $inpool->LSV++;
				}
				break;
			case 105: //Weaponcraft Enthusiast
				foreach ($inpool->themes as $theme) {
					if ($theme == "blink") $inpool->LSV++;
					if ($theme == "bounce") $inpool->LSV++;
				}
				break;
			case 106: //Aethertorch Renegade
				foreach ($inpool->themes as $theme) {
					if ($theme == "generator") $inpool->LSV++;
					if ($theme == "sink") $inpool->LSV++;
				}
				break;
			case 117: //Harnessed Lightning
				foreach ($inpool->themes as $theme) {
					if ($theme == "generator") $inpool->LSV++;
				}
				break;
			case 119: //Incendiary Sabotage
				if (($inpool->archetype == "A" || $inpool->archetype == "AC") && $inpool->LSV >= 15) $inpool->LSV++;
				foreach ($inpool->themes as $theme) {
					if ($theme == "tokens") $inpool->LSV++;
				}
				break;
			case 120: //Inventor's Apprentice
				if (($inpool->archetype == "A" || $inpool->archetype == "AC") && $inpool->concost < 3) $inpool->LSV++; //checks if the player has enough low-cost artifacts to make this desirable
				foreach ($inpool->themes as $theme) {
					if ($theme == "tokens" && $inpool->concost < 3) $inpool->LSV++;
				}
				break;
			case 121: //Lathnu Hellion
				foreach ($inpool->themes as $theme) {
					if ($theme == "generator") $inpool->LSV++;
				}
				break;
			case 123: //Maulfist Doorbuster
				foreach ($inpool->themes as $theme) {
					if ($theme == "generator") $inpool->LSV++;
				}
				break;
			case 125: //Quicksmith Genius
				if (($inpool->archetype == "A" || $inpool->archetype == "AC") && $inpool->LSV > 15) $inpool->LSV++;
				foreach ($inpool->themes as $theme) {
					if ($theme == "tokens") $inpool->LSV += 2;
				}
				break;
			case 126: //Reckless Fireweaver
				if (($inpool->archetype == "A" || $inpool->archetype == "AC") && $inpool->LSV >= 15) $inpool->LSV++;
				foreach ($inpool->themes as $theme) {
					if ($theme == "tokens") $inpool->LSV++;
				}
				break;
			case 129: //Salivating Gremlins
				if (($inpool->archetype == "A" || $inpool->archetype == "AC") && $inpool->LSV >= 15) $inpool->LSV++;
				foreach ($inpool->themes as $theme) {
					if ($theme == "tokens") $inpool->LSV += 2;
				}
				break;
			case 132: //Speedway Fanatic
				foreach ($inpool->subtype as $subtype) {
					if ($subtype == "V") $inpool->LSV++;
				}
				break;
			case 138: //Thriving Grubs
				foreach ($inpool->themes as $theme) {
					if ($theme == "generator") $inpool->LSV++;
				}
				break;
			case 140: //Welding Sparks
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) { 
					if (($inpool->archetype == "A" && $inpool->LSV >= 15) || ($inpool->archetype == "AC" && $inpool->LSV >= 15)) $inpool->LSV++;
					foreach ($inpool->themes as $theme) {
						if ($theme == "tokens") $inpool->LSV += 2;
					}
				}
				break;
			case 142: //Arborback Stomper
				foreach ($inpool->themes as $theme) {
					if ($theme == "blink") $inpool->LSV++;
					if ($theme == "bounce") $inpool->LSV++;
				}
				break;
			case 143: //Architect of the Untamed
				foreach ($inpool->themes as $theme) {
					if ($theme == "generator") $inpool->LSV++;
				}
				break;
			case 144: //Armorcraft Judge
				foreach ($inpool->themes as $theme) {
					if ($theme == "counters") $inpool->LSV += 2;
					if ($theme == "blink") $inpool->LSV += 2;
					if ($theme == "bounce") $inpool->LSV++;
				}
				break;
			case 145: //Attune with Aether
				if ($_SESSION['round'] >= 1) {
					if (strlen($inpool->color) == 1 && $inpool->color != $primary->color && $inpool->color != $secondary->color && $inpool->LSV > 30) $inpool->LSV += 2;
					elseif (strlen($inpool->color) > 1 && $inpool->color != $primary->color . $secondary->color && $inpool->color != $secondary->color . $primary->color) { //this is to check if either color of a multicolored card matches one of the player's primary colors
						$temp = preg_split('//', $inpool->color, -1, PREG_SPLIT_NO_EMPTY);
						foreach ($temp as $color) {
							if ($color != $primary->color && $color == $secondary->color && $inpool->LSV >= 30) $inpool->LSV += 2;
							elseif ($color == $primary->color && $color != $secondary->color && $inpool->LSV >= 30) $inpool->LSV += 2;
						}
					}
					unset($temp);
				}
				break;
			case 147: //Bristling Hydra
				foreach ($inpool->themes as $theme) {
					if ($theme == "generator") $inpool->LSV++;
				}
				break;
			case 151: //Cultivator of Blades
				foreach ($inpool->themes as $theme) {
					if ($theme == "blink") $inpool->LSV += 2;
					if ($theme == "bounce") $inpool->LSV++;
					if ($theme == "tokens") $inpool->LSV += 2;
					if ($theme == "evasion") $inpool->LSV++;
				}
				break;
			case 153: //Durable Handicraft
				foreach ($inpool->themes as $theme) {
					if ($theme == "tokens") $inpool->LSV++;
				}
				break;
			case 155: //Fairgrounds Trumpeter
				foreach ($inpool->themes as $theme) {
					if ($theme == "counters") $inpool->LSV++;
				}
				break;
			case 161: //Longtusk Cub
				foreach ($inpool->themes as $theme) {
					if ($theme == "generator") $inpool->LSV++;
				}
				break;
			case 166: //Peema Outrider
				foreach ($inpool->themes as $theme) {
					if ($theme == "blink") $inpool->LSV++;
					if ($theme == "bounce") $inpool->LSV++;
				}
				break;
			case 167: //Riparian Tiger
				foreach ($inpool->themes as $theme) {
					if ($theme == "generator") $inpool->LSV += 2;
				}
				break;
			case 168: //Sage of Shaila's Claim
				foreach ($inpool->themes as $theme) {
					if ($theme == "sink") $inpool->LSV++;
				}
				break;
			case 169: //Servant of the Conduit
				if ($_SESSION['round'] >= 1) {
					if (strlen($inpool->color) == 1 && $inpool->color != $primary->color && $inpool->color != $secondary->color && $inpool->LSV > 30) $inpool->LSV += 2;
					elseif (strlen($inpool->color) > 1 && $inpool->color != $primary->color . $secondary->color && $inpool->color != $secondary->color . $primary->color) { //this is to check if either color of a multicolored card matches one of the player's primary colors
						$temp = preg_split('//', $inpool->color, -1, PREG_SPLIT_NO_EMPTY);
						foreach ($temp as $color) {
							if ($color != $primary->color && $color == $secondary->color && $inpool->LSV >= 30) $inpool->LSV += 2;
							elseif ($color == $primary->color && $color != $secondary->color && $inpool->LSV >= 30) $inpool->LSV += 2;
						}
					}
					unset($temp);
				}
				break;
			case 171: //Thriving Rhino
				foreach ($inpool->themes as $theme) {
					if ($theme == "generator") $inpool->LSV += 2;
				}
				break;
			case 173: //Wild Wanderer
				if ($_SESSION['round'] >= 1) {
					if (strlen($inpool->color) == 1 && $inpool->color != $primary->color && $inpool->color != $secondary->color && $inpool->LSV > 30) $inpool->LSV += 2;
					elseif (strlen($inpool->color) > 1 && $inpool->color != $primary->color . $secondary->color && $inpool->color != $secondary->color . $primary->color) { //this is to check if either color of a multicolored card matches one of the player's primary colors
						$temp = preg_split('//', $inpool->color, -1, PREG_SPLIT_NO_EMPTY);
						foreach ($temp as $color) {
							if ($color != $primary->color && $color == $secondary->color && $inpool->LSV >= 30) $inpool->LSV += 2;
							elseif ($color == $primary->color && $color != $secondary->color && $inpool->LSV >= 30) $inpool->LSV += 2;
						}
					}
					unset($temp);
				}
				break;
			case 176: //Cloudblazer
				foreach ($inpool->themes as $theme) {
					if ($theme == "blink") $inpool->LSV += 2;
					if ($theme == "bounce") $inpool->LSV++;
				}
				break;
			case 177: //Contraband Kingpin
				if (($inpool->archetype == "A" || $inpool->archetype == "AC") && $inpool->LSV >= 15) $inpool->LSV++;
				foreach ($inpool->themes as $theme) {
					if ($theme == "tokens") $inpool->LSV += 2;
				}
				break;
			case 178: //Depala, Pilot Exemplar
				foreach ($inpool->subtype as $subtype) {
					if ($subtype == "V" || $subtype == "D") $inpool->LSV++;
				}
				break;
			case 180: //Empyreal Voyager
				foreach ($inpool->themes as $theme) {
					if ($theme == "sink") $inpool->LSV++;
				}
				break;
			case 181: //Engineered Might
				foreach ($inpool->themes as $theme) {
					if ($theme == "evasion") $inpool->LSV++;
					if ($theme == "tokens") $inpool->LSV++;
				}
				break;
			case 188: //Veteran Motorist
				foreach ($inpool->subtype as $subtype) {
					if ($subtype == "V") $inpool->LSV++;
				}
				break;
			case 189: //Voltaic Brawler 
				foreach ($inpool->themes as $theme) {
					if ($theme == "generator") $inpool->LSV += 2;
				}
				break;
			case 190: //Whirler Virtuoso 
				foreach ($inpool->themes as $theme) {
					if ($theme == "generator") $inpool->LSV += 2;
				}
				break;
			case 192: //Aetherworks Marvel
				foreach ($inpool->themes as $theme) {
					if ($theme == "generator") $inpool->LSV++;
				}
				break;
			case 193: //Animation Module
				foreach ($inpool->themes as $theme) {
					if ($theme == "counters") $inpool->LSV++;
				}
				break;
			case 200: //Chief of the Foundry
				if ($inpool->archetype == "AC" && $inpool->LSV >= 15) $inpool->LSV++;
				foreach ($inpool->subtype as $subtype) {
					if ($subtype == "V" && $inpool->LSV >= 15) $inpool->LSV++;
				}
				foreach ($inpool->themes as $theme) {
					if ($theme == "tokens") $inpool->LSV += 2;
				}
				break;
			case 203: //Cultivator's Caravan
				if ($_SESSION['round'] >= 1) {
					if (strlen($inpool->color) == 1 && $inpool->color != $primary->color && $inpool->color != $secondary->color && $inpool->LSV > 30) $inpool->LSV += 2;
					elseif (strlen($inpool->color) > 1 && $inpool->color != $primary->color . $secondary->color && $inpool->color != $secondary->color . $primary->color) { //this is to check if either color of a multicolored card matches one of the player's primary colors
						$temp = preg_split('//', $inpool->color, -1, PREG_SPLIT_NO_EMPTY);
						foreach ($temp as $color) {
							if ($color != $primary->color && $color == $secondary->color && $inpool->LSV >= 30) $inpool->LSV += 2;
							elseif ($color == $primary->color && $color != $secondary->color && $inpool->LSV >= 30) $inpool->LSV += 2;
						}
					}
					unset($temp);
				}
				break;
			case 204: //Deadlock Trap
				foreach ($inpool->themes as $theme) {
					if ($theme == "generator") $inpool->LSV++;
				}
				break;
			case 205: //Decoction Module
				foreach ($inpool->themes as $theme) {
					if ($theme == "sink") $inpool->LSV++;
					if ($theme == "tokens") $inpool->LSV += 2;
					if ($theme == "blink") $inpool->LSV++;
				}
				break;
			case 208: //Dynvolt Tower
				if (($inpool->archetype == "S" || $inpool->archetype == "I") && $inpool->LSV == 20) $inpool->LSV++;
				foreach ($inpool->themes as $theme) {
					if ($theme == "generator") $inpool->LSV++;
				}
				break;
			case 210: //Electrostatic Pummeler
				foreach ($inpool->themes as $theme) {
					if ($theme == "generator") $inpool->LSV++;
				}
				break;
			case 211: //Fabrication Module
				foreach ($inpool->themes as $theme) {
					if ($theme == "generator") $inpool->LSV++;
				}
				break;
			case 215: //Foundry Inspector
				if (($inpool->archetype == "A" || $inpool->archetype == "AC") && $inpool->LSV >= 15) $inpool->LSV++;
				break;
			case 218: //Inventor's Goggles
				foreach ($inpool->subtype as $subtype) {
					if ($subtype == "A") $inpool->LSV++;
				}
				break;
			case 219: //Ironleague Steed
				foreach ($inpool->themes as $theme) {
					if ($theme == "blink") $inpool->LSV++;
					if ($theme == "bounce") $inpool->LSV++;
				}
				break;
			case 222: //Metalwork Colossus
				if ($inpool->archetype == "A" && $inpool->LSV >= 15) $inpool->LSV++;
				break;
			case 223: //Multiform Wonder
				foreach ($inpool->themes as $theme) {
					if ($theme == "generator") $inpool->LSV += 2;
				}
				break;
			case 226: //Panharmonicon
				foreach ($inpool->themes as $theme) {
					if ($theme == "ETB") $inpool->LSV += 2;
					if ($theme == "blink") $inpool->LSV++;
					if ($theme == "bounce") $inpool->LSV++;
				}
				break;
			case 229: //Prophetic Prism
				if ($_SESSION['round'] >= 1) {
					if (strlen($inpool->color) == 1 && $inpool->color != $primary->color && $inpool->color != $secondary->color && $inpool->LSV > 30) $inpool->LSV += 2;
					elseif (strlen($inpool->color) > 1 && $inpool->color != $primary->color . $secondary->color && $inpool->color != $secondary->color . $primary->color) { //this is to check if either color of a multicolored card matches one of the player's primary colors
						$temp = preg_split('//', $inpool->color, -1, PREG_SPLIT_NO_EMPTY);
						foreach ($temp as $color) {
							if ($color != $primary->color && $color == $secondary->color && $inpool->LSV >= 30) $inpool->LSV += 2;
							elseif ($color == $primary->color && $color != $secondary->color && $inpool->LSV >= 30) $inpool->LSV += 2;
						}
					}
					unset($temp);
				}
				break;
			case 242: //Aether Hub
				if ($_SESSION['round'] >= 1) {
					if (strlen($inpool->color) == 1 && $inpool->color != $primary->color && $inpool->color != $secondary->color && $inpool->LSV > 30) $inpool->LSV += 2;
					elseif (strlen($inpool->color) > 1 && $inpool->color != $primary->color . $secondary->color && $inpool->color != $secondary->color . $primary->color) { //this is to check if either color of a multicolored card matches one of the player's primary colors
						$temp = preg_split('//', $inpool->color, -1, PREG_SPLIT_NO_EMPTY);
						foreach ($temp as $color) {
							if ($color != $primary->color && $color == $secondary->color && $inpool->LSV >= 30) $inpool->LSV += 2;
							elseif ($color == $primary->color && $color != $secondary->color && $inpool->LSV >= 30) $inpool->LSV += 2;
						}
					}
					unset($temp);
				}
				$temp = 0;
				foreach ($_SESSION['players'][$player]->cardpool as $inpool) { 
					if ($inpool->number == 242) $temp++;
				}
				if ($temp > 1) $inpool->LSV -= 5 * $temp; //checks if the player already has two or more Attune with Aether to reduce its value accordingly because multiples are undesirable
				unset($temp);
				break;
			case 243: //Blooming Marsh
				if (($pick->color != $primary->color . $secondary->color) && ($pick->color != $secondary->color . $primary->color)) {
					$temp = preg_split('//', $pick->color, -1, PREG_SPLIT_NO_EMPTY); //separates the land's colors into an array
					if ($temp[0] == $primary->color || $temp[0] == $secondary->color) { //checks if the first color matches any of the player's primary colors
						foreach ($_SESSION['players'][$player]->cardpool as $inpool) { //looks through the player's cardpool for cards that match the off-color
							if (strlen($inpool->color) == 1 && $inpool->color == $temp[1] && $inpool->LSV >= 30) $inpool->LSV += 2; //single-color cards whose color the same as the off-color of the land
							elseif (strlen(preg_replace("/[^A-Z.]/", "", $inpool->color)) == 2 && (($inpool->color != $primary->color . $secondary->color) && ($inpool->color != $secondary->color . $primary->color)) && $inpool->LSV >= 30) { //check if the card is multicolored and if it matches the player's color archetype
								$gold = array();
								$gold = preg_split('//', $inpool->color, -1, PREG_SPLIT_NO_EMPTY); //separates the card's colors into an array
								if (($gold[0] == $primary->color || $gold[0] == $secondary->color) && $gold[1] == $temp[1]) $inpool->LSV += 2; //checks if the first color matches any of the primaries and if the second color mathes the off-color of the land (at this point all color archetype matches have been excluded)
								elseif (($gold[1] == $primary->color || $gold[1] == $secondary->color) && $gold[0] == $temp[1]) $inpool->LSV += 2; //checks if the second color matches any of the primaries and if the first color mathes the off-color of the land (at this point all color archetype matches have been excluded)
							}
						}
					} elseif ($temp[1] == $primary->color || $temp[1] == $secondary->color) { //same as above only in reverse, i.e. the second color of the land matches one of the player's primary colors while the first one doesn't
						foreach ($_SESSION['players'][$player]->cardpool as $inpool) {
							if (strlen($inpool->color) == 1 && $inpool->color == $temp[0] && $inpool->LSV >= 30) $inpool->LSV += 2;
							elseif (strlen(preg_replace("/[^A-Z.]/", "", $inpool->color)) == 2 && (($inpool->color != $primary->color . $secondary->color) && ($inpool->color != $secondary->color . $primary->color)) && $inpool->LSV >= 30) {
								$gold = array();
								$gold = preg_split('//', $inpool->color, -1, PREG_SPLIT_NO_EMPTY);
								if (($gold[0] == $primary->color || $gold[0] == $secondary->color) && $gold[1] == $temp[0]) $inpool->LSV += 2;
								elseif (($gold[1] == $primary->color || $gold[1] == $secondary->color) && $gold[0] == $temp[0]) $inpool->LSV += 2;
							}
						}
					}
				}
				unset($temp);
				unset($gold);
				break;
			case 244: //Botanical Sanctum
				if (($pick->color != $primary->color . $secondary->color) && ($pick->color != $secondary->color . $primary->color)) {
					$temp = preg_split('//', $pick->color, -1, PREG_SPLIT_NO_EMPTY); //separates the land's colors into an array
					if ($temp[0] == $primary->color || $temp[0] == $secondary->color) { //checks if the first color matches any of the player's primary colors
						foreach ($_SESSION['players'][$player]->cardpool as $inpool) { //looks through the player's cardpool for cards that match the off-color
							if (strlen($inpool->color) == 1 && $inpool->color == $temp[1] && $inpool->LSV >= 30) $inpool->LSV += 2; //single-color cards whose color the same as the off-color of the land
							elseif (strlen(preg_replace("/[^A-Z.]/", "", $inpool->color)) == 2 && (($inpool->color != $primary->color . $secondary->color) && ($inpool->color != $secondary->color . $primary->color)) && $inpool->LSV >= 30) { //check if the card is multicolored and if it matches the player's color archetype
								$gold = array();
								$gold = preg_split('//', $inpool->color, -1, PREG_SPLIT_NO_EMPTY); //separates the card's colors into an array
								if (($gold[0] == $primary->color || $gold[0] == $secondary->color) && $gold[1] == $temp[1]) $inpool->LSV += 2; //checks if the first color matches any of the primaries and if the second color mathes the off-color of the land (at this point all color archetype matches have been excluded)
								elseif (($gold[1] == $primary->color || $gold[1] == $secondary->color) && $gold[0] == $temp[1]) $inpool->LSV += 2; //checks if the second color matches any of the primaries and if the first color mathes the off-color of the land (at this point all color archetype matches have been excluded)
							}
						}
					} elseif ($temp[1] == $primary->color || $temp[1] == $secondary->color) { //same as above only in reverse, i.e. the second color of the land matches one of the player's primary colors while the first one doesn't
						foreach ($_SESSION['players'][$player]->cardpool as $inpool) {
							if (strlen($inpool->color) == 1 && $inpool->color == $temp[0] && $inpool->LSV >= 30) $inpool->LSV += 2;
							elseif (strlen(preg_replace("/[^A-Z.]/", "", $inpool->color)) == 2 && (($inpool->color != $primary->color . $secondary->color) && ($inpool->color != $secondary->color . $primary->color)) && $inpool->LSV >= 30) {
								$gold = array();
								$gold = preg_split('//', $inpool->color, -1, PREG_SPLIT_NO_EMPTY);
								if (($gold[0] == $primary->color || $gold[0] == $secondary->color) && $gold[1] == $temp[0]) $inpool->LSV += 2;
								elseif (($gold[1] == $primary->color || $gold[1] == $secondary->color) && $gold[0] == $temp[0]) $inpool->LSV += 2;
							}
						}
					}
				}
				unset($temp);
				unset($gold);
				break;
			case 245: //Concealed Courtyard
				if (($pick->color != $primary->color . $secondary->color) && ($pick->color != $secondary->color . $primary->color)) {
					$temp = preg_split('//', $pick->color, -1, PREG_SPLIT_NO_EMPTY); //separates the land's colors into an array
					if ($temp[0] == $primary->color || $temp[0] == $secondary->color) { //checks if the first color matches any of the player's primary colors
						foreach ($_SESSION['players'][$player]->cardpool as $inpool) { //looks through the player's cardpool for cards that match the off-color
							if (strlen($inpool->color) == 1 && $inpool->color == $temp[1] && $inpool->LSV >= 30) $inpool->LSV += 2; //single-color cards whose color the same as the off-color of the land
							elseif (strlen(preg_replace("/[^A-Z.]/", "", $inpool->color)) == 2 && (($inpool->color != $primary->color . $secondary->color) && ($inpool->color != $secondary->color . $primary->color)) && $inpool->LSV >= 30) { //check if the card is multicolored and if it matches the player's color archetype
								$gold = array();
								$gold = preg_split('//', $inpool->color, -1, PREG_SPLIT_NO_EMPTY); //separates the card's colors into an array
								if (($gold[0] == $primary->color || $gold[0] == $secondary->color) && $gold[1] == $temp[1]) $inpool->LSV += 2; //checks if the first color matches any of the primaries and if the second color mathes the off-color of the land (at this point all color archetype matches have been excluded)
								elseif (($gold[1] == $primary->color || $gold[1] == $secondary->color) && $gold[0] == $temp[1]) $inpool->LSV += 2; //checks if the second color matches any of the primaries and if the first color mathes the off-color of the land (at this point all color archetype matches have been excluded)
							}
						}
					} elseif ($temp[1] == $primary->color || $temp[1] == $secondary->color) { //same as above only in reverse, i.e. the second color of the land matches one of the player's primary colors while the first one doesn't
						foreach ($_SESSION['players'][$player]->cardpool as $inpool) {
							if (strlen($inpool->color) == 1 && $inpool->color == $temp[0] && $inpool->LSV >= 30) $inpool->LSV += 2;
							elseif (strlen(preg_replace("/[^A-Z.]/", "", $inpool->color)) == 2 && (($inpool->color != $primary->color . $secondary->color) && ($inpool->color != $secondary->color . $primary->color)) && $inpool->LSV >= 30) {
								$gold = array();
								$gold = preg_split('//', $inpool->color, -1, PREG_SPLIT_NO_EMPTY);
								if (($gold[0] == $primary->color || $gold[0] == $secondary->color) && $gold[1] == $temp[0]) $inpool->LSV += 2;
								elseif (($gold[1] == $primary->color || $gold[1] == $secondary->color) && $gold[0] == $temp[0]) $inpool->LSV += 2;
							}
						}
					}
				}
				unset($temp);
				unset($gold);
				break;
			case 246: //Inspiring Vantage
				if (($pick->color != $primary->color . $secondary->color) && ($pick->color != $secondary->color . $primary->color)) {
					$temp = preg_split('//', $pick->color, -1, PREG_SPLIT_NO_EMPTY); //separates the land's colors into an array
					if ($temp[0] == $primary->color || $temp[0] == $secondary->color) { //checks if the first color matches any of the player's primary colors
						foreach ($_SESSION['players'][$player]->cardpool as $inpool) { //looks through the player's cardpool for cards that match the off-color
							if (strlen($inpool->color) == 1 && $inpool->color == $temp[1] && $inpool->LSV >= 30) $inpool->LSV += 2; //single-color cards whose color the same as the off-color of the land
							elseif (strlen(preg_replace("/[^A-Z.]/", "", $inpool->color)) == 2 && (($inpool->color != $primary->color . $secondary->color) && ($inpool->color != $secondary->color . $primary->color)) && $inpool->LSV >= 30) { //check if the card is multicolored and if it matches the player's color archetype
								$gold = array();
								$gold = preg_split('//', $inpool->color, -1, PREG_SPLIT_NO_EMPTY); //separates the card's colors into an array
								if (($gold[0] == $primary->color || $gold[0] == $secondary->color) && $gold[1] == $temp[1]) $inpool->LSV += 2; //checks if the first color matches any of the primaries and if the second color mathes the off-color of the land (at this point all color archetype matches have been excluded)
								elseif (($gold[1] == $primary->color || $gold[1] == $secondary->color) && $gold[0] == $temp[1]) $inpool->LSV += 2; //checks if the second color matches any of the primaries and if the first color mathes the off-color of the land (at this point all color archetype matches have been excluded)
							}
						}
					} elseif ($temp[1] == $primary->color || $temp[1] == $secondary->color) { //same as above only in reverse, i.e. the second color of the land matches one of the player's primary colors while the first one doesn't
						foreach ($_SESSION['players'][$player]->cardpool as $inpool) {
							if (strlen($inpool->color) == 1 && $inpool->color == $temp[0] && $inpool->LSV >= 30) $inpool->LSV += 2;
							elseif (strlen(preg_replace("/[^A-Z.]/", "", $inpool->color)) == 2 && (($inpool->color != $primary->color . $secondary->color) && ($inpool->color != $secondary->color . $primary->color)) && $inpool->LSV >= 30) {
								$gold = array();
								$gold = preg_split('//', $inpool->color, -1, PREG_SPLIT_NO_EMPTY);
								if (($gold[0] == $primary->color || $gold[0] == $secondary->color) && $gold[1] == $temp[0]) $inpool->LSV += 2;
								elseif (($gold[1] == $primary->color || $gold[1] == $secondary->color) && $gold[0] == $temp[0]) $inpool->LSV += 2;
							}
						}
					}
				}
				unset($temp);
				unset($gold);
				break;
			case 249: //Spirebluff Canal				
				if (($pick->color != $primary->color . $secondary->color) && ($pick->color != $secondary->color . $primary->color)) {
					$temp = preg_split('//', $pick->color, -1, PREG_SPLIT_NO_EMPTY); //separates the land's colors into an array
					if ($temp[0] == $primary->color || $temp[0] == $secondary->color) { //checks if the first color matches any of the player's primary colors
						foreach ($_SESSION['players'][$player]->cardpool as $inpool) { //looks through the player's cardpool for cards that match the off-color
							if (strlen($inpool->color) == 1 && $inpool->color == $temp[1] && $inpool->LSV >= 30) $inpool->LSV += 2; //single-color cards whose color the same as the off-color of the land
							elseif (strlen(preg_replace("/[^A-Z.]/", "", $inpool->color)) == 2 && (($inpool->color != $primary->color . $secondary->color) && ($inpool->color != $secondary->color . $primary->color)) && $inpool->LSV >= 30) { //check if the card is multicolored and if it matches the player's color archetype
								$gold = array();
								$gold = preg_split('//', $inpool->color, -1, PREG_SPLIT_NO_EMPTY); //separates the card's colors into an array
								if (($gold[0] == $primary->color || $gold[0] == $secondary->color) && $gold[1] == $temp[1]) $inpool->LSV += 2; //checks if the first color matches any of the primaries and if the second color mathes the off-color of the land (at this point all color archetype matches have been excluded)
								elseif (($gold[1] == $primary->color || $gold[1] == $secondary->color) && $gold[0] == $temp[1]) $inpool->LSV += 2; //checks if the second color matches any of the primaries and if the first color mathes the off-color of the land (at this point all color archetype matches have been excluded)
							}
						}
					} elseif ($temp[1] == $primary->color || $temp[1] == $secondary->color) { //same as above only in reverse, i.e. the second color of the land matches one of the player's primary colors while the first one doesn't
						foreach ($_SESSION['players'][$player]->cardpool as $inpool) {
							if (strlen($inpool->color) == 1 && $inpool->color == $temp[0] && $inpool->LSV >= 30) $inpool->LSV += 2;
							elseif (strlen(preg_replace("/[^A-Z.]/", "", $inpool->color)) == 2 && (($inpool->color != $primary->color . $secondary->color) && ($inpool->color != $secondary->color . $primary->color)) && $inpool->LSV >= 30) {
								$gold = array();
								$gold = preg_split('//', $inpool->color, -1, PREG_SPLIT_NO_EMPTY);
								if (($gold[0] == $primary->color || $gold[0] == $secondary->color) && $gold[1] == $temp[0]) $inpool->LSV += 2;
								elseif (($gold[1] == $primary->color || $gold[1] == $secondary->color) && $gold[0] == $temp[0]) $inpool->LSV += 2;
							}
						}
					}
				}
				unset($temp);
				unset($gold);
				break;
		}
	}
	//purge variables set in the prep
	unset($maxsignal);
	unset($signal);
	unset($temp);
	unset($pick);
	return($benchmark->selector);
}

?>