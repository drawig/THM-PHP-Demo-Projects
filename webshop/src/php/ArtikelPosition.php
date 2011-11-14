<?php

	include('Artikel.php');

	/**
	 * Ein Objekt dieser Klasse repräsentiert eine Position eines Artikels im Warenkorb.
	 * Zusätzlich zu der Position kann über ein Objekt dieser Klasse eingestellt werden,
	 * wie viele gleiche Artikel es halten soll. Diese Klasse ist zustandsorientiert.
	 */
	class ArtikelPosition {

		private $mArtikel;
		private $mAnzahl;

		/**
		 * Erstellt eine neue Artikelposition, die den übergebenen Artikel mit der übergebenen Anzahl
		 * hält.
		 *
		 * @param Artikel Der Artikel, dessen Anzahl über diese Artikelposition gehalten werden soll.
		 * @param int Die Anzahl der (gleichen) Artikel, die in dieser Artikelposition gehalten werden sollen.
		 */
		function __construct($artikel, $anzahl) {
			$this->mArtikel = $artikel;
			$this->mAnzahl = $anzahl;
		}

		/**
		 * Setzt die Anzahl des Artikels, der über diese ArtikelPosition gehalten wird auf eine
		 * neue Anzahl.
		 *
		 * @param int Der Wert auf den die Anzahl der Artikel in dieser ArtikelPosition gestellt werden soll.
		 */
		public function setAnzahl($neueAnzahl) {
			$this->mAnzahl = $neueAnzahl;
		}
		
		/**
		 * Holt den Artikel, der in dieser ArtikelPosition gehalten wird.
		 *
		 * @return Artikel Der Artikel, der in dieser ArtikelPosition gehalten wird.
		 */
		public function getArtikel() {
			return $this->mArtikel;
		}

		/**
		 * Holt den Gesamtpreis der Artikel in dieser Artikelposition. Dieser errechnet sich aus dem Preis
		 * des gehaltenen Artikels multipliziert mit seiner gehaltenen Anzahl.
		 *
		 * @return int Der Gesamtpreis der Artikel in dieser Artikelposition.
		 */
		public function getPreis() {
			return $this->mArtikel->getPreis() * $this->mAnzahl;
		}
	}
?>
