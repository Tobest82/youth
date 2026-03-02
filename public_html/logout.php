<?php
require_once("controller/controller.php");
session_destroy();

header("location:login.php");