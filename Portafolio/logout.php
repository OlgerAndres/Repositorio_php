<?php

require 'Boostrap.php';

$user = new Users();
$user->logout();

header('Location: /');