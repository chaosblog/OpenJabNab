<?php
	$locale = 'de_DE'; // setzt die Sprache auf Deutsch
	$domain = 'openJabNab'; // setzt die Domäne
	$encoding = 'UTF-8'; // setzt die Zeichenkodierung

	// lädt php-gettext
	require_once(ROOT_SITE.'include/gettext/gettext.inc');

	// teilt php-gettext die Sprache mit
	T_setlocale(LC_MESSAGES, $locale);

	// teilt php-gettext mit, wo es die Übersetzungen suchen soll
	T_bindtextdomain($domain, ROOT_SITE.'include/locale');

	// teilt php-gettext die zu verwendene Zeichenkodierung mit
	T_bind_textdomain_codeset($domain, $encoding);

	// weist php-gettext an, die definierte Domäne zu verwenden
	T_textdomain($domain);

	// php-gettext erwartet die Übersetzung nun in
	// ./locale/de_DE/LC_MESSAGES/myApplication.mo

	if (locale_emulation()) {
		// echo 'php-gettext wird verwendet.<br /><br />';
	} else {
		// echo 'gettext wird nativ verwendet.<br /><br />';
	}
?>
