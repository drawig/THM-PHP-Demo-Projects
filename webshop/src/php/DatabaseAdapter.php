<?php

	include('User.php');
	include('Artikel.php');

	/**
	 * Diese Klasse bietet Funktionen, mit denen vom Webshop häufig durchgeführte Datenbank-Zugriffe
	 * abstrahiert werden.
	 */
	class DatabaseAdapter {

		//Hier richtige Daten eingeben.
		private static $mDBHost = "localhost";
		private static $mDBUser = "root";
		private static $mDBPassword = "";

		/**
		 * Versucht aus der User-Tabelle einen Benutzer herauszulesen, der den angegebenen
		 * Nutzernamen und das angegebene Passwort aufweist. Falls der Datenbank-Zugriff geglückt ist
		 * und der Benutzer mit den angegebenen Attributen gefunden wurde, wird ein dazu passendes User-Objekt
		 * zurück gegeben.
		 *
		 * @param string Der Benutzername des Benutzers, der herausgelesen werden soll.
		 * @param string Das Passwort, das zum Benutzer gehört.
		 * @return User Der gelesene Benutzer, falls er gefunden wurde und der Datenbank-Zugriff geklappt hat,
		 * null sonst.
		 */
		public static function getUser($userName, $password) {
			try {
				$dbHost = DatabaseAdapter::$mDBHost;
				$dbh = new PDO("mysql:host=$dbHost;dbname=webshop", DatabaseAdapter::$mDBUser, DatabaseAdapter::$mDBPassword); 

				$sth = $dbh->prepare("SELECT username, password FROM users WHERE username=? AND password=?;");
				$sth->bindParam(1, $userName);
				$sth->bindParam(2, $password);

				$sth->execute();

				$return = $sth->fetch();

				if(!$return)
					return NULL;

				$returnedUser = new User($userName);

				$dbh = NULL;
				return $returnedUser;
			} catch (Exception $e) {}

			return NULL;
		}
		
		/**
		* Liest saemtliche eingetragenen Artikel aus der Datenbank aus, 
		* speichert sie in einem (assoziativem) Array und liefert dieses zuerueck.
		*
		*/
		public static function getArtikel() {
			$returnArray[] = array();
			try {
				$dbHost = DatabaseAdapter::$mDBHost;
				$dbh = new PDO("mysql:host=$dbHost;dbname=webshop", DatabaseAdapter::$mDBUser, DatabaseAdapter::$mDBPassword); 

				$sth = $dbh->prepare("SELECT * FROM artikel;");

				$sth->execute();

				//Liefert ein Array welches wiederrum weitere Arrays beeinhaltet, welche die key + value paare beeinhalten
				$return = $sth->fetchAll();

				if(!$return)
					return NULL;

				
				//Durchlaeuft das aeußere Array (welches Arrays enthaelt)
				foreach ($return as $entry) {
					$count = 0;
					$tempArray = array();
					
					//Durchlaeuft das innere Array (welches key-value-paare enthaelt)
					foreach($entry as $key => $value) {
						$tempArray[] = $value;
					}
					
					//Neue Artikel erstellen und dem returnArray hinzufuegen
					$artikel = new Artikel($tempArray[0],$tempArray[1],$tempArray[2],$tempArray[3],$tempArray[4]);
					$returnArray[$count++] = $artikel;
				}
					

				$dbh = NULL;
				
				return $returnArray;
				
			} catch (Exception $e) {}

			return NULL;
		}
		
	}
?>
