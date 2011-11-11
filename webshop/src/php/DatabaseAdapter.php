<?php

	include('User.php');

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

				if(!$return)
					return NULL;

				$returnedUser = new User($userName);

				$dbh = NULL;
				return $returnedUser;
			} catch (Exception $e) {}

			return NULL;
		}
	}
?>
