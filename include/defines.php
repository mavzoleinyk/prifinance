<?php

use SypexGeo\SxGeo;

$sxGeoDB = realpath(__DIR__ . '/../databases/SxGeoCountry.dat');
$sxGeo = new SxGeo($sxGeoDB);
$countryCode = $sxGeo->getCountry($_SERVER['REMOTE_ADDR']);
define('COUNTRY_CODE', empty($countryCode) ? 'GB' : $countryCode);
define('BROWSER_LANGUAGE_CODE', substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2));

