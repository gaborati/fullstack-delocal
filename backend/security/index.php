<?php
require_once '/Users/gaborattila/Desktop/fullstack-delocal/backend/security/tokenHandler.php';


$secret_key = bin2hex(random_bytes(32));
tokenHandler::setSecretKey($secret_key);
