<?php

	include('DatabaseAdapter.php');

	/**
	 * Diese Klasse bietet Funktionen, mit denen Login Anfragen von Benutzern
	 * bearbeitet werden können.
	 */
	class LoginService {

		/**
		 * Versucht einen Benutzer mit den eingegebenen Benutzernamen und Passwort einzuloggen.
		 *
		 * @param string Der Benutzername mit dem der Benutzer eingeloggt werden soll.
		 * @param string Das Passwort, das zum Benutzernamen gehört.
		 * @return boolean True, falls der Benutzer eingeloggt wurde.
		 */
		public static function login($username, $password) {
			$user = DatabaseAdapter::getUser($username, $password);

			if($user != NULL) {
				session_start();
				$_SESSION['user'] = serialize($user);
				return true;
			}

			return false;
		}
	}
?>
