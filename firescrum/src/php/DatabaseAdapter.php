<?php

	include('Projekt.php');

	/**
	 * Diese Klasse bietet Funktionen, mit denen von Firescrum häufig durchgeführte Datenbank-Zugriffe
	 * abstrahiert werden.
	 */
	class DatabaseAdapter {

		//Hier richtige Daten eingeben.
		private static $mDBHost = "localhost";
		private static $mDBUser = "root";
		private static $mDBPassword = "";

		/**
		* Erstellt aus dem uebergebenen Titel und der Beschreibung ein neues Projekt bzw. erstellt einen Eintrag
		* in der Datenbank mit diesen Daten.
		*
		* @param String  Titel des Projekts
		* @param String Beschreibung des Projekts
		*/
		public static function addProjekt($titel, $beschreibung) {
			try {
				$dbHost = DatabaseAdapter::$mDBHost;
				$dbh = new PDO("mysql:host=$dbHost;dbname=firescrum", DatabaseAdapter::$mDBUser, DatabaseAdapter::$mDBPassword); 
		
				$sth = $dbh->prepare("INSERT INTO projekte(titel, beschreibung) VALUES(?, ?);");

				$sth->bindParam(1, $titel);
				$sth->bindParam(2, $beschreibung);
				
							
				$sth->execute();

				$return = $sth->fetch();

				if(!$return)
					return NULL;

				$dbh = NULL;

			} catch (Exception $e) {}

			return NULL;
		}
		
		
		/**
		* Liest saemtliche in der Datenbank vorhanden Projekteintraege aus, speichert diese in einem
		* array und liefert dieses zurueck
		*
		* @return array mit allen Projekten
		*/
		public static function getProjekte() {
			
			try {
				$dbHost = DatabaseAdapter::$mDBHost;
				$dbh = new PDO("mysql:host=$dbHost;dbname=firescrum", DatabaseAdapter::$mDBUser, DatabaseAdapter::$mDBPassword); 

				$sth = $dbh->prepare("SELECT * FROM projekte;");

				$sth->execute();

				//Liefert ein Array welches wiederrum weitere Arrays beeinhaltet, welche die key + value paare beeinhalten
				$return = $sth->fetchAll();

				if(!$return)
					return NULL;

				
				//Durchlaeuft das aeußere Array (welches Arrays enthaelt)
				foreach ($return as $entry) {
					$tempArray = array();
					
					//Durchlaeuft das innere Array (welches key-value-paare enthaelt)
					foreach($entry as $key => $value) {
						$tempArray[$key] = $value;
					}
					
					//Neue Projekte erstellen und dem returnArray hinzufuegen
					$projekt = new Projekt($tempArray['id'], $tempArray['titel'], $tempArray['beschreibung']);
					$returnArray[] = $projekt;
					
				}
				
				/* Debug
				echo '<br><br>';
				print_r($returnArray); */
				
				$dbh = NULL;
				
				return $returnArray;
				
			} catch (Exception $e) {}

			return NULL;
		}
		
		/**
		* Liest ein einzelnes Projekt anhand der ubergebenen id aus der Datenbank aus und gibt dieses zurueck
		* 
		* @param int eindeutige id des Projekts
		* @return Projekt das zur ID zugehoerige Projekt
		*/
		public static function getSingleProjekt($id) {
			$result = NULL;

			try {
				$dbHost = DatabaseAdapter::$mDBHost;
				$dbh = new PDO("mysql:host=$dbHost;dbname=firescrum", DatabaseAdapter::$mDBUser, DatabaseAdapter::$mDBPassword); 
		
				$sth = $dbh->prepare("SELECT * FROM projekt WHERE id=?;");

				$sth->bindParam(1, $id);

				$sth->execute();

				$return = $sth->fetch();

				if(!$return) {
					$dbh = NULL;
					return NULL;
				}

				$id = $return['id'];
				$titel = $return['titel'];
				$beschreibung = $return['beschreibung'];
				

				$result = new Projekt($id, $titel, $beschreibung);
				
			} catch (Exception $e) {}

			return $result;
		}
		
		
		/**
		* Liefert alle zum uebergebenen Projekt alle in der Datenbank vorhanden Tickets als array
		*
		* @param projekt projekt zu dem die Tickets geliefert werden sollen
		* @return array enthaelt alle Tickets zum Projekt
		*/
		public static function getTickets($projekt) {
			
			try {
				$dbHost = DatabaseAdapter::$mDBHost;
				$dbh = new PDO("mysql:host=$dbHost;dbname=firescrum", DatabaseAdapter::$mDBUser, DatabaseAdapter::$mDBPassword); 

		//TODO	$sth = $dbh->prepare("SELECT * FROM projekte;");

				$sth->execute();

				//Liefert ein Array welches wiederrum weitere Arrays beeinhaltet, welche die key + value paare beeinhalten
				$return = $sth->fetchAll();

				if(!$return)
					return NULL;

				
				//Durchlaeuft das aeußere Array (welches Arrays enthaelt)
				foreach ($return as $entry) {
					$tempArray = array();
					
					//Durchlaeuft das innere Array (welches key-value-paare enthaelt)
					foreach($entry as $key => $value) {
						$tempArray[$key] = $value;
					}
					
					//Neue Tickets erstellen und dem returnArray hinzufuegen
			//TODO	$ticket = new Ticket($tempArray['id'], $tempArray['titel'], $tempArray['beschreibung']);
					$returnArray[] = $ticket;
					
				}
				
				/* Debug
				echo '<br><br>';
				print_r($returnArray); */
				
				$dbh = NULL;
				
				return $returnArray;
				
			} catch (Exception $e) {}

			return NULL;
		}
		
	}
?>
