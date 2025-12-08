<?php
    session_start();
    //$_SESSION['nev'] és $_SESSION['dolg_id'] van használva, de együtt, így bármelyik vizsgálata is elég, ezért nem lett módosítva a példa
    if (!isset($_SESSION['cahol_nev'])) {
        header("Location: bejelentkezes.php");
        exit();
    }

    $isAdmin = false;
    $current_page = basename($_SERVER['SCRIPT_NAME']);

    $admin_pages = 
    [
        'uj_auto_tipus.php',
        'uj_auto.php',
        'uj_osztaly.php',
        'uj_telephely.php',
        'felhasznalok_lista.php',
    ];

    if($_SESSION['cahol_jogosultsag'] == "admin" || $_SESSION['cahol_jogosultsag'] == "suser")
    {
        $isAdmin = true;
    }

    if (in_array($current_page, $admin_pages, true) && !$isAdmin) 
    {
        header("Location: autok_lista.php");
        exit();
    }
?>