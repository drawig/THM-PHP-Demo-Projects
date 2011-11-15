<?php

	include('Warenkorb.php');

	/**
	 * Ein Objekt dieser Klasse repräsentiert einen eingeloggten Benutzer im Webshop.
	 * Dieser hat einen eindeutigen Benutzernamen, mit dem er erkannt werden kann.
	 * Außerdem hat ein Benutzer einen Warenkorb, in den er Artikel, die er kaufen möchte,
	 * einstellen kann.
	 */
	class User {

		/** Der eindeutige Name des Benutzers. */
		private $mName;
		private $mWarenkorb;

		/**
		 * Erzeugt ein neues User Objekt mit dem angegebenen Benutzernamen und einem leeren Warenkorb.
		 *
		 * @param string Der Benutzername dieses Benutzers.
		 */
		function __construct($name) {
			$this->mName = $name;
			$this->mWarenkorb = new Warenkorb();
		}

		/**
		 * Gibt den Benutzernamen dieses User Objektes wieder
		 *
		 * @return string Den Benutzernamen dieses User Objektes.
		 */
		public function getName() {
			return $this->mName;
		}

		/**
		 * Gibt den Warenkorb, der zu diesem User gehört zurück.
		 *
		 * @return Warenkorb Der Warenkorb, der zu diesem User gehört.
		 */
		public function getWarenkorb() {
			return $this->mWarenkorb;
		}

		/**
		 * Leert den Warenkorb dieses Users.
		 */
		public function leerWarenkorb() {
			$this->mWarenkorb = new Warenkorb();		
		}
	}
?>
