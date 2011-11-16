<?php


	/**
	 * Diese Klasse bietet Funktionen, mit denen von Firescrum häufig durchgeführte Datenbank-Zugriffe
	 * abstrahiert werden.
	 */
	class DatabaseAdapter {

		//Hier richtige Daten eingeben.
		private static $mDBHost = "";
		private static $mDBUser = "";
		private static $mDBPassword = "";

		/**
		*
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
		*
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
					$projekt = new Projekt($tempArray['titel'],$tempArray['beschreibung']);
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
		
		
	}
?>
