<?php

	/**
	 * Ein Objekt dieser Klasse repräsentiert einen eingeloggten Benutzer im Webshop.
	 * Dieser hat einen eindeutigen Benutzernamen, mit dem er erkannt werden kann.
	 */
	class User {

		/** Der eindeutige Name des Benutzers. */
		private $mName;

		/**
		 * Erzeugt ein neues User Objekt mit dem angegebenen Benutzernamen.
		 *
		 * @param string Der Benutzername dieses Benutzers.
		 */
		function __construct($name) {
			$mName = $name;
		}

		/**
		 * Gibt den Benutzernamen dieses User Objektes wieder
		 *
		 * @return string Den Benutzernamen dieses User Objektes.
		 */
		public function getName() {
			return $mName;
		}
	}
?>
