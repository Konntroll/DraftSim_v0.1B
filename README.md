# DraftSim_v0.1B

This is the second iteration of my Magic draft simulator (version 0.1B). It is similar to version 0.1A in some respects but differs a good deal in many others. 

Designed to work with the Kaladesh set of Magic cards this program is ”hardwired" for the set and would be impossible to use properly with a different set without major rewrites. This is due to substantial changes in the pick mechanism that were implemented to refine the card picking process and make it a bit more realistic and consistent. The program makes wide use of objects to facilitate evaluations and tracking of player and card pick data.

Similarly to the previous version, this one uses a separate booster generating function that has been adjusted to accommodate the peculiarities of Kaladesh (namely, the Inventions subset) and to generate boosters not as arrays of numbers but as arrays of card objects with parameters pulled from a MySQL database (kld.sql). This has reduced the number of MySQL queries required for the program.

The interface part of the code (start_v0.1B.php) is largely unchanged, except for creation of player objects assigned to session variables for use in the course of the draft.

Classes used in the program are defined in a separate file (classes.php). There is also a separate function file (function.php) as during the development I anticipated that there would be a number of functions with the current picking mechanism (pick.php) constituting three separate functions. However, I eventually decided to lump everything together into one giant function, which is probably a questionale choice. So functions.php is now merely a vestigial part of the code.

The drafting mechanism has undergone the most extensive changes and is now split into two parts. One of them keeps track of draft progress parameters such as current round, player, booster pass direction, etc. The booster carrousel has become a lot more transparent and concise here.

The other part of the drafting mechanism is the pick function which is now the most extensive part of the code that includes three large switch statements each iterating over most of the cards in the set individually and making adjustments to their value rating (LSV value) in order to inform the final pick. 

Other than that, this function also takes care of color considerations pushing simulated players to commit to a certain pair of colors in their card pool that have the most valuable cards, checking for splashable cards and ways to splash them as the virtual player considers its picks, and reading signals by evaluating the total value of cards passed to the player in each color adjusted by their number. It also keeps track of the mana curve.

This approach has made it possible to handle drafting more or less as a real player would, giving preference to specific cards and adjusting values not only of the cards to be picked but also of those that have already made it into the player’s card pool. With further work the OO aspect of the code could make it possible to introduce strategies and/or deck archetypes to further refine simulated drafting.

The trade off here is, of course, poor scalability. Each new set, whether in the same block or not, will require rewriting of large sections of the pick function with careful analysis of the new set’s peculiarities. Nevertheless, given that sets are published relatively infrequently I believe it would be quite possible to implement this approach in a dedicated production environment.
