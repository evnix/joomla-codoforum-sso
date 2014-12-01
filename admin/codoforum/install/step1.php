<?php


/*
 * @CODOLICENSE
 */

define('CODO_LICENSE', 'ACCEPTED');

$xhash = md5(time() . uniqid());
$_SESSION['xhash'] = $xhash;
