<?php

require 'dashboard/functions/act.php';
require 'dashboard/functions/db.php';

session_start();
session_destroy();

header("Location: index.php");
?>