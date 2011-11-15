<?php

	include('User.php');
	include('Artikel.php');

	/**
	 * Diese Klasse bietet Funktionen, mit denen vom Webshop häufig durchgeführte Datenbank-Zugriffe
	 * abstrahiert werden.
	 */
	class DatabaseAdapter {

		//Hier richtige Daten eingeben.
		private static $mDBHost = "";
		private static $mDBUser = "";
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

				if(!$return) {
					$dbh = NULL;
					return NULL;
				}

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
			//$returnArray[] = array();
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
					$tempArray = array();
					
					//Durchlaeuft das innere Array (welches key-value-paare enthaelt)
					foreach($entry as $key => $value) {
						$tempArray[$key] = $value;
					}
					
					//Neue Artikel erstellen und dem returnArray hinzufuegen
					$artikel = new Artikel($tempArray[id],$tempArray[name],$tempArray[beschreibung],$tempArray[preis],$tempArray[bildpfad]);
					$returnArray[] = $artikel;
					
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
		* Fuegt einen uebergebenen Artikel der Datenbank hinzu
		*/
		public static function addArtikel($artikel) {
			try {
				$dbHost = DatabaseAdapter::$mDBHost;
				$dbh = new PDO("mysql:host=$dbHost;dbname=webshop", DatabaseAdapter::$mDBUser, DatabaseAdapter::$mDBPassword); 
		
				$sth = $dbh->prepare("INSERT INTO artikel(name, beschreibung, preis, bildpfad) VALUES(?, ?, ?, ?);");

				$sth->bindParam(1, $artikel->getTitel());
				$sth->bindParam(2, $artikel->getBeschreibung());
				$sth->bindParam(3, $artikel->getPreis());
				$sth->bindParam(4, $artikel->getBildpfad());
							
				$sth->execute();

				$return = $sth->fetch();

				if(!$return)
					return NULL;

				$dbh = NULL;

			} catch (Exception $e) {}

			return NULL;
		}
		
		/**
		 * Liest einen einzelnen Artikel mit der gegebenen ArtikelNr. aus der Datenbank.
		 * Gibt ihn zurück, falls der Datenbankzugriff geglückt ist und er gefunden wurde.
		 * Gibt sonst NULL zurück.
		 *
		 * @param int Die ArtikelNr. des Artikels, der aus der Datenbank gelesen werden soll.
		 * @return Artikel Den Artikel mit der gegebenen ArtikelNr., falls er gefunden wurde, NULL sonst.
		 */
		public static function getSingleArtikel($artikelNr) {
			$result = NULL;

			try {
				$dbHost = DatabaseAdapter::$mDBHost;
				$dbh = new PDO("mysql:host=$dbHost;dbname=webshop", DatabaseAdapter::$mDBUser, DatabaseAdapter::$mDBPassword); 
		
				$sth = $dbh->prepare("SELECT * FROM artikel WHERE id=?;");

				$sth->bindParam(1, $artikelNr);

				$sth->execute();

				$return = $sth->fetch();

				if(!$return) {
					$dbh = NULL;
					return NULL;
				}

				$artNr = $return['id'];
				$titel = $return['name'];
				$beschreibung = $return['beschreibung'];
				$preis = $return['preis'];
				$bildpfad = $return['bildpfad'];

				$result = new Artikel($artNr, $titel, $beschreibung, $preis, $bildpfad);
			} catch (Exception $e) {}

			return $result;
		}
	}
?>
