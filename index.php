<?php

require_once('loader.php');
$page = $_GET['page'] ?? false;
include_once('components/header.php');
switch ($page) {
    case 'login':
        include('pages/login.php');
        break;
    case 'dashboard':
        include('pages/dashboard.php');
        break;
    case 'password_reset':
        include('pages/password_reset.php');
        break;
    case 'new_password':
        include('pages/new_password.php');
        break;
    case 'newPassSuccess':
        include('pages/newPassSuccess.php');
        break;
    default:
        include('pages/register.php');
        break;
}

include_once('components/footer.php');
