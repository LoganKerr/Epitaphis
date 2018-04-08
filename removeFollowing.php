<?php
    session_start();
    ob_start();
    header('Content-Type: text/html; charset=utf-8');
    
    require_once("config/config.php");
    require_once("functions.php");
    require_once("vendor/autoload.php");
    
    // if user is not signed in
    if (!isset($_SESSION['user_id']))
    {
        header("Location: index.php");
    }
    
    $user_id = $_SESSION['user_id'];
    
    // profile form submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $error = array();
        // get data
        
    } //ends post request
    
    $loader = new Twig_Loader_Filesystem('resources/views');
    $twig = new Twig_Environment($loader);
    
    $admin = check_if_user_is_admin($_SESSION['user_id']);
    
    echo $twig->render('profile.html', array(
                                             'nav' => array('page' => $_SERVER['PHP_SELF'], 'admin' => $admin),
                                             'rows' => $rows,
                                             'bio' => $bio
                                             ));
    ?>
