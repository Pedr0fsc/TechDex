<?php
session_start();
session_destroy();
header("Location: /TechDex/app/views/login.php");
exit;
