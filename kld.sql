CREATE DATABASE magic;
USE magic;
CREATE TABLE kld (
	number INT(3) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	rarity CHAR(1),
	color VARCHAR(2),
	concost VARCHAR(2),
	archetype CHAR(2),
	sub_type VARCHAR(4),
	themes VARCHAR (64),
	LSV TINYINT(3) UNSIGNED) ENGINE MyISAM;
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('C', 'W', '3', 'I', 'N', 'blink', '20'); -- Acrobatic Maneuver
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('U', 'W', '3', 'C', 'D', 'evasion', '35'); -- Aerial Responder
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('R', 'W', '4', 'C', 'N', 'evasion, generator, sink', '50'); -- Aetherstorm Roc
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('M', 'W', '5', 'C', 'N', 'tokens, counters, ETB, evasion', '45'); -- Angel of Invention
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('R', 'W', '1', 'E', 'N', 'none', '5'); -- Authority of the Consuls
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('C', 'W', '2', 'C', 'D, A', 'bounce, ETB', '30'); -- Aviary Mechanic
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('C', 'W', '1', 'I', 'N', 'trick', '25'); -- Built to Last
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('R', 'W', '4', 'E', 'N', 'removal', '35'); -- Captured by the Consulate
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('M', 'W', '5', 'AC', 'N', 'ETB', '40'); -- Cataclysmic Gearhulk
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('U', 'W', '4', 'E', 'N', 'generator, sink', '15'); -- Consulate Surveillance
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('U', 'W', '4', 'C', 'D', 'sink', '30'); -- Consul’s Shieldguard
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('C', 'W', '2', 'C', 'N', 'sink', '20'); -- Eddytrail Hawk
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('U', 'W', '3', 'C', 'D', 'ETB', '35'); -- Fairgrounds Warden
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('C', 'W', '1', 'S', 'N', 'removal', '25'); -- Fragmentize
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('R', 'W', '5', 'S', 'N', 'none', '40'); -- Fumigate
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('U', 'W', '2', 'C', 'D', 'none', '30'); -- Gearshift Ace 
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('C', 'W', '3', 'C', 'D, A', 'tokens, counters, ETB', '30'); -- Glint-Sleeve Artisan
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('C', 'W', '3', 'C', 'N', 'none', '15'); -- Herald of the Fair
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('C', 'W', '2', 'I', 'N', 'none', '20'); -- Impeccable Timing, down from 30
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('C', 'W', '4', 'I', 'N', 'none', '10'); -- Inspired Charge
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('R', 'W', '3', 'C', 'D, A', 'tokens', '35'); -- Master Trinketeer
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('C', 'W', '2', 'C', 'D', 'counters', '20'); -- Ninth Bridge Patrol
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('C', 'W', '2', 'I', 'N', 'trick', '25'); -- Pressure Point
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('C', 'W', '4', 'C', 'A', 'tokens, counters, ETB, evasion', '30'); -- Propeller Pioneer
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('U', 'W', '4', 'S', 'N', 'none', '10'); -- Refurbish
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('C', 'W', '3', 'E', 'N', 'removal', '35'); -- Revoke Privileges
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('U', 'W', '2', 'S', 'N', 'tokens', '20'); -- Servo Exhibition
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('C', 'W', '5', 'C', 'N', 'evasion', '30'); -- Skyswirl Harrier
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('U', 'W', '3', 'I', 'N', 'removal', '35'); -- Skywhaler’s Shot
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('C', 'W', '1', 'C', 'N', 'none', '10'); -- Tasseled Dromedary
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('C', 'W', '4', 'C', 'N', 'sink, counters', '30'); -- Thriving Ibex
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('R', 'W', '1', 'C', 'D, A', 'none', '15'); -- Toolcraft Exemplar
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('U', 'W', '2', 'C', 'N', 'none', '20'); -- Trusty Companion
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('U', 'W', '4', 'C', 'D, A', 'tokens, counters, ETB', '35'); -- Visionary Augmenter
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('U', 'W', '6', 'C', 'N', 'blink, evasion, ETB', '35'); -- Wispweaver Angel
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('U', 'U', '2', 'E', 'N', 'generator, removal', '30'); -- Aether Meltdown
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('C', 'U', '2', 'C', 'N', 'generator, sink', '30'); -- Aether Theorist
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('C', 'U', '3', 'I', 'N', 'bounce', '20'); -- Aether Tradewinds
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('R', 'U', '7', 'C', 'N', 'generator, sink', '35'); -- Aethersquall Ancient
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('U', 'U', '1', 'I', 'N', 'permission', '15'); -- Ceremonious Rejection
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('R', 'U', '5', 'S', 'N', 'sink, removal', '50'); -- Confiscation Coup
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('C', 'U', '2', 'C', 'N', 'none', '10'); -- Curio Vendor, down from 15
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('U', 'U', '3', 'I', 'N', 'permission, bounce', '15'); -- Disappearing Act
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('C', 'U', '2', 'I', 'N', 'trick', '0'); -- Dramatic Reversal
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('U', 'U', '2', 'E', 'N', 'generator, sink', '10'); -- Era of Innovation
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('U', 'U', '5', 'C', 'A', 'tokens, evasion, ETB', '35'); -- Experimental Aviator
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('C', 'U', '4', 'I', 'N', 'permission', '10'); -- Failed Inspection
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('C', 'U', 'FX', 'C', 'N', 'none', '30'); -- Gearseeker Serpent
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('U', 'U', '4', 'I', 'N', 'none', '30'); -- Glimmer of Genius
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('U', 'U', '2', 'C', 'N', 'evasion, ETB', '30'); -- Glint-Nest Crane
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('C', 'U', '5', 'C', 'N', 'generator', '15'); -- Hightide Hermit
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('R', 'U', '4', 'I', 'N', 'permission', '35'); -- Insidious Will
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('U', 'U', '3', 'C', 'N', 'sink', '20'); -- Janjeet Sentry, down from 30
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('U', 'U', '4', 'C', 'N', 'evasion', '30'); -- Long-Finned Skywhale
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('C', 'U', '4', 'E', 'N', 'removal', '30'); -- Malfunction
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('M', 'U', '5', 'E', 'N', 'none', '10'); -- Metallurgic Summonings
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('U', 'U', '1', 'C', 'N', 'sink', '5'); -- Minister of Inquiries
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('C', 'U', '4', 'C', 'A', 'none', '20'); -- Nimble Innovator, down from 30
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('R', 'U', '4', 'C', 'A', 'none', '35'); -- Padeem, Consul of Innovation
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('R', 'U', '4', 'I', 'N', 'none', '10'); -- Paradoxical Outcome
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('C', 'U', '2', 'I', 'N', 'permission', '15'); -- Revolutionary Rebuff
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('R', 'U', '6', 'S', 'N', 'none', '40'); -- Saheeli's Artistry
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('C', 'U', '1', 'I', 'N', 'bounce', '15'); -- Select for Inspection
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('U', 'U', '5', 'S', 'N', 'removal', '30'); -- Shrewd Negotiation
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('C', 'U', '5', 'S', 'N', 'none', '20'); -- Tezzeret's Ambition, down from 25
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('C', 'U', '1', 'C', 'N', 'sink, counters', '20'); -- Thriving Turtle
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('M', 'U', '6', 'AC', 'N', 'ETB', '40'); -- Torrential Gearhulk
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('C', 'U', '3', 'C', 'N', 'none', '20'); -- Vedalken Blademaster
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('C', 'U', '4', 'C', 'A', 'none', '20'); -- Weldfast Wingsmith, up from 15
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('C', 'U', '3', 'C', 'N', 'evasion', '25'); -- Wind Drake
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('U', 'B', '4', 'C', 'N', 'evasion, ETB', '30'); -- Aetherborn Marauder, down from 35
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('C', 'B', '5', 'C', 'A', 'tokens, conunters, ETB', '30'); -- Ambitious Aetherborn
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('M', 'B', '6', 'C', 'N', 'sink, generator, ETB', '50'); -- Demon of Dark Schemes
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('C', 'B', '2', 'C', 'N', 'none', '25'); -- Dhund Operative
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('U', 'B', '4', 'S', 'N', 'none', '5'); -- Diabolic Tutor
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('C', 'B', '2', 'S', 'N', 'sink, removal', '35'); -- Die Young
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('C', 'B', '6', 'C', 'N', 'ETB', '20'); -- Dukhara Scavenger
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('R', 'B', '5', 'S', 'N', 'removal', '30'); -- Eliminate the Competition
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('U', 'B', '2', 'C', 'N', 'evasion', '20'); -- Embraal Bruiser
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('U', 'B', '3', 'I', 'N', 'removal', '35'); -- Essence Extraction
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('C', 'B', '3', 'S', 'N', 'none', '20'); -- Fortuitous Find, up from 15
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('C', 'B', '3', 'C', 'N', 'evasion', '25'); -- Foundry Screecher
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('U', 'B', '2', 'C', 'N', 'counters', '10'); -- Fretwork Colony
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('R', 'B', '4', 'C', 'N', 'none', '35'); -- Gonti, Lord of Luxury
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('U', 'B', '1', 'S', 'N', 'none', '15'); -- Harsh Scrutiny
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('C', 'B', '3', 'C', 'N', 'counters', '25'); -- Lawless Broker
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('C', 'B', '3', 'S', 'N', 'generator', '25'); -- Live Fast, down from 30
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('R', 'B', '3', 'S', 'N', 'none', '0'); -- Lost Legacy
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('U', 'B', '3', 'I', 'N', 'removal', '20'); -- Make Obsolete, down from 35
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('R', 'B', '6', 'C', 'A', 'tokens, counters, ETB', '40'); -- Marionette Master
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('C', 'B', '4', 'C', 'A', 'tokens, counters, ETB', '30'); -- Maulfist Squad
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('R', 'B', '4', 'E', 'N', 'none', '20'); -- Midnight Oil
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('C', 'B', '3', 'S', 'N', 'none', '10'); -- Mind Rot
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('U', 'B', '3', 'S', 'N', 'sacrifice artifact', '10'); -- Morbid Curiosity
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('C', 'B', '1', 'C', 'N', 'none', '5'); -- Night Market Lookout
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('M', 'B', '6', 'AC', 'N', 'ETB', '50'); -- Noxious Gearhulk
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('U', 'B', '4', 'C', 'N', 'none', '35'); -- Ovalchase Daredevil
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('C', 'B', '4', 'C', 'N', 'none', '20'); -- Prakhata Club Security
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('C', 'B', '2', 'I', 'N', 'trick', '25'); -- Rush of Vitality
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('C', 'B', '2', 'I', 'N', 'trick, counters', '30'); -- Subtle Strike
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('R', 'B', '2', 'C', 'N', 'sacrifice artifact', '35'); -- Syndicate Trafficker
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('C', 'B', '2', 'C', 'N', 'sink, counters', '20'); -- Thriving Rats, down from 30
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('C', 'B', '5', 'I', 'N', 'removal', '35'); -- Tidy Conclusion
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('U', 'B', '2', 'E', 'N', 'removal', '30'); -- Underhanded Designs
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('U', 'B', '3', 'C', 'A', 'tokens, counters, ETB', '30'); -- Weaponcraft Enthusiast
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('U', 'R', '3', 'C', 'N', 'generator, sink, removal', '35'); -- Aethertorch Renegade
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('U', 'R', '3', 'C', 'N', 'none', '35'); -- Brazen Scourge
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('C', 'R', '1', 'I', 'N', 'trick', '15'); -- Built to Smash
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('C', 'R', '2', 'S', 'N', 'none', '15'); -- Cathartic Reunion
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('M', 'R', '2', 'I', 'N', 'removal', '30'); -- Chandra’s Pyrohelix, down from 35
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('C', 'R', '4', 'P', 'N', 'removal', '50'); -- Chandra, Torch of Defiance
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('M', 'R', '6', 'AC', 'N', 'ETB', '40'); -- Combustible Gearhulk
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('C', 'R', '4', 'S', 'N', 'removal', '5'); -- Demolish
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('R', 'R', '4', 'I', 'N', 'removal', '35'); -- Fateful Showdown
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('U', 'R', '4', 'S', 'N', 'removal', '35'); -- Furious Reprisal
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('C', 'R', '2', 'E', 'N', 'none', '0'); -- Giant Spectacle
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('U', 'R', '2', 'I', 'N', 'sink, removal', '40'); -- Harnessed Lightning
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('C', 'R', '3', 'S', 'N', 'none', '15'); -- Hijack
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('U', 'R', '4', 'I', 'N', 'removal', '25'); -- Incendiary Sabotage
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('U', 'R', '1', 'C', 'A', 'none', '15'); -- Inventor’s Apprentice
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('R', 'R', '3', 'C', 'N', 'sink', '30'); -- Lathnu Hellion, down from 35
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('R', 'R', '4', 'S', 'N', 'none', '0'); -- Madcap Experiment
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('U', 'R', '4', 'C', 'N', 'sink', '30'); -- Maulfist Doorbuster
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('R', 'R', '3', 'C', 'A', 'tokens, sacrifice artifact, ETB', '40'); -- Pia Nalaar, up from 35
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('U', 'R', '3', 'C', 'A', 'none', '25'); -- Quicksmith Genius
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('C', 'R', '2', 'C', 'A', 'none', '10'); -- Reckless Fireweaver
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('C', 'R', '1', 'S', 'N', 'trick', '15'); -- Renegade Tactics
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('C', 'R', '1', 'C', 'N', 'removal', '10'); -- Ruinous Gremlin
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('C', 'R', '3', 'C', 'N', 'evasion', '20'); -- Salivating Gremlins
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('R', 'R', '4', 'C', 'N', 'evasion', '40'); -- Skyship Stalker
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('U', 'R', '1', 'S', 'N', 'none', '20'); -- Spark of Creativity, down from 25
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('U', 'R', '2', 'C', 'N', 'none', '25'); -- Speedway Fanatic
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('C', 'R', '3', 'C', 'N', 'none', '15'); -- Spireside Infiltrator
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('C', 'R', '4', 'C', 'N', 'none', '30'); -- Spontaneous Artist
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('U', 'R', '4', 'S', 'N', 'none', '5'); -- Start Your Engines
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('R', 'R', '4', 'C', 'N', 'sink', '25'); -- Territorial Gorger
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('C', 'R', '4', 'C', 'N', 'none', '5'); -- Terror of the Fairgrounds
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('C', 'R', '2', 'C', 'N', 'sink, counters', '30'); -- Thriving Grubs
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('C', 'R', '5', 'C', 'N', 'evasion', '15'); -- Wayward Giant
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('C', 'R', '3', 'I', 'N', 'removal', '35'); -- Welding Sparks
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('C', 'G', '3', 'I', 'N', 'removal', '10'); -- Appetite for the Unnatural
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('U', 'G', '5', 'C', 'N', 'evasion, ETB', '35'); -- Arborback Stomper
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('R', 'G', '3', 'C', 'A', 'sink', '25'); -- Architect of the Untamed
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('U', 'G', '4', 'C', 'A', 'ETB', '30'); -- Armorcraft Judge
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('C', 'G', '1', 'S', 'N', 'manafix', '25'); -- Attune with Aether
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('U', 'G', '1', 'I', 'N', 'trick', '25'); -- Blossoming Defense
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('R', 'G', '4', 'C', 'N', 'sink, counters', '40'); -- Bristling Hydra
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('C', 'G', '2', 'I', 'N', 'none', '5'); -- Commencement of Festivities
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('C', 'G', '6', 'C', 'N', 'none', '15'); -- Cowl Prowler
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('U', 'G', '4', 'S', 'N', 'removal', '5'); -- Creeping Mold
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('R', 'G', '5', 'C', 'A', 'tokens, counters, ETB', '40'); -- Cultivator of Blades
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('R', 'G', '4', 'S', 'N', 'none', '0'); -- Dubious Challenge
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('U', 'G', '2', 'E', 'N', 'counters', '30'); -- Durable Handicraft, up from 10
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('U', 'G', '6', 'C', 'A', 'tokens, counters, ETB', '30'); -- Elegant Edgecrafters
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('U', 'G', '3', 'C', 'N', 'counters', '20'); -- Fairgrounds Trumpeter
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('U', 'G', '3', 'C', 'N', 'none', '20'); -- Ghirapur Guide
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('C', 'G', '3', 'C', 'A', 'tokens, counters, ETB', '20'); -- Highspire Artisan
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('C', 'G', '4', 'S', 'N', 'removal, counters', '30'); -- Hunt the Weak
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('C', 'G', '2', 'C', 'N', 'counters, ETB', '30'); -- Kujar Seedsculptor
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('C', 'G', '2', 'S', 'N', 'none', '10'); -- Larger Than Life, up from 0
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('U', 'G', '2', 'C', 'N', 'generator, sink, counters', '30'); -- Longtusk Cub
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('U', 'G', '2', 'S', 'N', 'removal', '35'); -- Nature’s Way
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('M', 'G', '5', 'P', 'N', 'none', '45'); -- Nissa, Vital Force
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('C', 'G', '1', 'I', 'N', 'trick', '15'); -- Ornamental Courage
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('R', 'G', '1', 'C', 'A', 'tokens', '35'); -- Oviya Pashiri, Sage Lifecrafter, up from 25
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('C', 'G', '4', 'C', 'A', 'tokens, counters, evasion, ETB', '35'); -- Peema Outrider
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('C', 'G', '5', 'C', 'N', 'sink, evasion, ETB', '30'); -- Riparian Tiger
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('C', 'G', '2', 'C', 'N', 'generator, ETB', '15'); -- Sage of Shaila's Claim
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('U', 'G', '2', 'C', 'N', 'manafix, manaboost, sink', '35'); -- Servant of the Conduit
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('C', 'G', '1', 'I', 'N', 'removal', '5'); -- Take Down
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('C', 'G', '3', 'C', 'N', 'sink, counters', '30'); -- Thriving Rhino
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('M', 'G', '5', 'AC', 'N', 'counters, ETB', '50'); -- Verdurous Gearhulk
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('C', 'G', '4', 'C', 'N', 'manafix, ETB', '20'); -- Wild Wanderer
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('R', 'G', 'FX', 'S', 'N', 'none', '25'); -- Wildest Dreams
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('C', 'G', '1', 'C', 'N', 'none', '10'); -- Wily Bandar
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('U', 'WU', '5', 'C', 'N', 'ETB, evasion', '40'); -- Cloudblazer
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('U', 'BU', '2', 'C', 'N', 'none', '30'); -- Contraband Kingpin
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('R', 'WR', '3', 'C', 'D', 'none', '30'); -- Depala, Pilot Exemplar, down from 40
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('M', 'WU', '4', 'P', 'N', 'none', '40'); -- Dovin Baan
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('U', 'GU', '3', 'C', 'N', 'generator, evasion', '35'); -- Empyreal Voyager
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('U', 'WG', '5', 'S', 'N', 'none', '20'); -- Engineered Might, up from 15
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('U', 'BG', '4', 'S', 'N', 'none', '15'); -- Hazardous Conditions
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('R', 'WB', '3', 'C', 'N', 'none', '35'); -- Kambal, Consul of Allocation
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('M', 'GU', '4', 'C', 'N', 'none', '40'); -- Rashmi, Eternities Crafter
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('U', 'WB', '4', 'C', 'N', 'none', '35'); -- Restoration Gearsmith
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('M', 'UR', '3', 'P', 'N', 'none', '15'); -- Saheeli Rai
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('U', 'BR', '3', 'I', 'N', 'removal', '40'); -- Unlicensed Disintegration
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('U', 'WR', '2', 'C', 'D', 'none', '35'); -- Veteran Motorist, down from 35
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('U', 'GR', '2', 'C', 'N', 'sink', '40'); -- Voltaic Brawler
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('U', 'UR', '3', 'C', 'A', 'sink', '35'); -- Whirler Virtuoso
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('C', 'A', '7', 'AC', 'N', 'sink', '20'); -- Accomplished Automaton, up from 10
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('R', 'A', '4', 'A', 'N', 'none', '10'); -- Aetherflux Reservoir
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('M', 'A', '4', 'A', 'N', 'sink', '35'); -- Aetherworks Marvel
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('R', 'A', '1', 'A', 'N', 'tokens', '10'); -- Animation Module
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('C', 'A', '5', 'A', 'V', 'none', '10'); -- Aradara Express, down from 15
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('U', 'A', '5', 'A', 'V', 'none', '30'); -- Ballista Charger
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('C', 'W', '5', 'AC', 'N', 'none', '15'); -- Bastion Mastodon, up from 10
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('U', 'A', '4', 'A', 'V', 'none', '35'); -- Bomat Bazaar Barge
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('R', 'R', '1', 'AC', 'N', 'none', '5'); -- Bomat Courier
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('U', 'A', '3', 'AC', 'N', 'none', '30'); -- Chief of the Foundry
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('C', 'W', '2', 'A', 'N', 'tokens', '15'); -- Cogworker’s Puzzleknot
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('C', 'A', '2', 'AC', 'N', 'none', '15'); -- Consulate Skygate, up from 10
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('R', 'A', '3', 'A', 'V', 'manafix, manaboost', '40'); -- Cultivator’s Caravan, up from 35
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('R', 'A', '3', 'A', 'N', 'sink', '20'); -- Deadlock Trap, up from 15
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('U', 'A', '2', 'A', 'N', 'generator', '10'); -- Decoction Module
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('U', 'A', '6', 'A', 'V', 'none', '10'); -- Demolition Stomper
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('C', 'U', '4', 'AC', 'N', 'none', '15'); -- Dukhara Peafowl, up from 10
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('R', 'A', '3', 'A', 'N', 'sink', '10'); -- Dynavolt Tower
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('C', 'A', '2', 'AC', 'N', 'none', '15'); -- Eager Construct
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('R', 'A', '3', 'AC', 'N', 'sink', '15'); -- Electrostatic Pummeler, check rating
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('U', 'A', '3', 'A', 'N', 'counters', '10'); -- Fabrication Module
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('U', 'A', '3', 'AC', 'N', 'none', '20'); -- Filigree Familiar, down from 30
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('C', 'R', '2', 'A', 'N', 'none', '15'); -- Fireforger’s Puzzleknot, up from 5
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('R', 'A', '4', 'A', 'V', 'none', '35'); -- Fleetwheel Cruiser
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('U', 'A', '3', 'AC', 'N', 'none', '30'); -- Foundry Inspector
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('R', 'A', '4', 'A', 'N', 'none', '0'); -- Ghirapur Orrery
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('C', 'U', '2', 'A', 'N', 'none', '15'); -- Glassblower’s Puzzleknot, up from 10
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('C', 'A', '1', 'A', 'N', 'none', '20'); -- Inventor’s Goggles
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('U', 'A', '4', 'AC', 'N', 'tokens, counters, ETB', '30'); -- Iron League Steed
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('R', 'A', '2', 'A', 'N', 'evasion', '35'); -- Key to the City
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('C', 'B', '2', 'A', 'N', 'none', '20'); -- Metalspinner’s Puzzleknot, up from 10
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('R', 'A', 'FX', 'AC', 'N', 'none', '10'); -- Metalwork Colossus
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('R', 'A', '5', 'AC', 'N', 'sink', '40'); -- Multiform Wonder
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('C', 'G', '2', 'AC', 'N', 'none', '15'); -- Narnam Cobra
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('U', 'A', '4', 'A', 'V', 'none', '25'); -- Ovalchase Dragster
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('R', 'A', '4', 'A', 'N', 'none', '10'); -- Panharmonicon
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('U', 'A', '2', 'A', 'N', 'none', '5'); -- Perpetual Timepiece
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('C', 'B', '3', 'AC', 'N', 'none', '15'); -- Prakhata Pillar-Bug, up from 15
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('C', 'A', '2', 'A', 'N', 'manafix', '25'); -- Prophetic Prism
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('C', 'A', '3', 'A', 'V', 'none', '35'); -- Renegade Freighter, up from 30
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('R', 'B', '2', 'AC', 'N', 'none', '25'); -- Scrapheap Scrounger
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('C', 'A', '5', 'AC', 'N', 'none', '20'); -- Self-Assembler
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('C', 'A', '2', 'A', 'V', 'none', '20'); -- Sky Skiff, down from 30
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('M', 'A', '5', 'A', 'V', 'none', '50'); -- Skysovereign, Consul Flagship
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('R', 'A', '2', 'A', 'V', 'none', '40'); -- Smuggler’s Copter
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('U', 'A', '4', 'AC', 'T', 'none', '30'); -- Snare Thopter
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('C', 'A', '2', 'A', 'N', 'none', '10'); -- Torch Gauntlet
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('C', 'R', '3', 'C', 'N', 'none', '15'); -- Weldfast Monitor
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('U', 'A', '3', 'A', 'N', 'tokens', '10'); -- Whirlermaker
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('C', 'G', '2', 'A', 'N', 'generator', '10'); -- Woodweaver’s Puzzleknot
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('C', 'A', '3', 'AC', 'N', 'none', '15'); -- Workshop Assistant
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('U', 'N', '0', 'L', 'N', 'manafix, sink', '20'); -- Aether Hub
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('R', 'BG', '0', 'L', 'N', 'none', '20'); -- Blooming Marsh
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('R', 'GU', '0', 'L', 'N', 'none', '20'); -- Botanical Sanctum
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('R', 'WB', '0', 'L', 'N', 'none', '20'); -- Concealed Courtyard
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('R', 'RW', '0', 'L', 'N', 'none', '20'); -- Inspiring Vantage
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('R', 'N', '0', 'L', 'N', 'none', '15'); -- Inventor’s Fair
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('U', 'N', '0', 'L', 'N', 'none', '15'); -- Sequestered Stash
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('R', 'UR', '0', 'L', 'N', 'none', '20'); -- Spirebluff Canal
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('B', 'N', '0', 'L', 'N', 'none', '0'); -- Plains
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('B', 'N', '0', 'L', 'N', 'none', '0'); -- Plains
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('B', 'N', '0', 'L', 'N', 'none', '0'); -- Plains
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('B', 'N', '0', 'L', 'N', 'none', '0'); -- Island
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('B', 'N', '0', 'L', 'N', 'none', '0'); -- Island
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('B', 'N', '0', 'L', 'N', 'none', '0'); -- Island
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('B', 'N', '0', 'L', 'N', 'none', '0'); -- Swamp
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('B', 'N', '0', 'L', 'N', 'none', '0'); -- Swamp
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('B', 'N', '0', 'L', 'N', 'none', '0'); -- Swamp
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('B', 'N', '0', 'L', 'N', 'none', '0'); -- Mountain
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('B', 'N', '0', 'L', 'N', 'none', '0'); -- Mountain
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('B', 'N', '0', 'L', 'N', 'none', '0'); -- Mountain
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('B', 'N', '0', 'L', 'N', 'none', '0'); -- Forest
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('B', 'N', '0', 'L', 'N', 'none', '0'); -- Forest
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('B', 'N', '0', 'L', 'N', 'none', '0'); -- Forest
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('I', 'W', '5', 'AC', 'N', 'ETB', '100'); -- Cataclysmic Gearhulk
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('I', 'U', '6', 'AC', 'N', 'ETB', '100'); -- Torrential Gearhulk
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('I', 'B', '6', 'AC', 'N', 'ETB', '100'); -- Noxious Gearhulk
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('I', 'R', '6', 'AC', 'N', 'ETB', '100'); -- Combustible Gearhulk
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('I', 'G', '5', 'AC', 'N', 'ETB', '100'); -- Verdurous Gearhulk
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('I', 'A', '1', 'A', 'N', 'none', '100'); -- Aether Vial
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('I', 'A', '3', 'A', 'N', 'none', '100'); -- Champion's Helm
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('I', 'A', '3', 'A', 'N', 'manafix', '100'); -- Chromatic Lantern
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('I', 'A', '0', 'A', 'N', 'manaboost', '100'); -- Chrome Mox
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('I', 'A', '3', 'A', 'N', 'bounce', '100'); -- Cloudstone Curio
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('I', 'A', '3', 'A', 'N', 'none', '100'); -- Crucible of Worlds
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('I', 'A', '5', 'A', 'N', 'none', '100'); -- Gauntlet of Power
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('I', 'A', 'FX', 'AC', 'N', 'tokens, counters', '100'); -- Hangarback Walker
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('I', 'A', '2', 'A', 'N', 'none', '100'); -- Lightning Greaves
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('I', 'A', '0', 'A', 'N', 'manaboost', '100'); -- Lotus Petal
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('I', 'A', '0', 'A', 'N', 'manaboost', '100'); -- Mana Crypt
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('I', 'A', '1', 'A', 'N', 'manaboost', '100'); -- Mana Vault
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('I', 'A', '5', 'A', 'N', 'none', '100'); -- Mind's Eye
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('I', 'A', '0', 'A', 'N', 'manaboost', '100'); -- Mox Opal
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('I', 'A', '2', 'AC', 'N', 'none', '100'); -- Painter's Servant
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('I', 'A', '3', 'A', 'N', 'none', '100'); -- Rings of Brighthearth
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('I', 'A', '2', 'A', 'N', 'none', '100'); -- Scroll Rack
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('I', 'A', '3', 'A', 'N', 'none', '100'); -- Sculpting Steel
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('I', 'A', '1', 'A', 'N', 'manaboost', '100'); -- Sol Ring
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('I', 'A', '4', 'AC', 'N', 'none', '100'); -- Solemn Simulacrum
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('I', 'A', '3', 'A', 'N', 'none', '100'); -- Static Orb
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('I', 'A', '2', 'AC', 'N', 'none', '100'); -- Steel Overseer
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('I', 'A', '3', 'A', 'N', 'none', '100'); -- Sword of Feast and Famine
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('I', 'A', '3', 'A', 'N', 'none', '100'); -- Sword of Fire and Ice
INSERT INTO kld (rarity, color, concost, archetype, sub_type, themes, LSV) VALUES ('I', 'A', '3', 'A', 'N', 'none', '100'); -- Sword of Light and Shadow