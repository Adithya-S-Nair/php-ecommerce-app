<?php
session_start();
if ($_SESSION['orders'])
    unset($_SESSION['orders']);
