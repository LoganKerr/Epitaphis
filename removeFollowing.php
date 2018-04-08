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
        
        foreach ($_POST as $key => $value)
        {
            // for each user this user is following
            if (substr($key, 0, 20) == "usersYouAreFollowing")
            {
                // if user wants to cancel following
                if ($value == "cancel")
                {
                    $following_id = filter_var(substr($key, 20), FILTER_SANITIZE_NUMBER_INT);
                    $stmt = $conn->prepare("DELETE FROM `follower_assoc` WHERE `user_id`=? AND `following_id`=?");
                    $stmt->bind_param("ii", $user_id, $following_id);
                    $stmt->execute();
                }
            }
        }
        
    } //ends post request
    
    header("Location: followers.php");
    
    /*
    $loader = new Twig_Loader_Filesystem('resources/views');
    $twig = new Twig_Environment($loader);
    
    $admin = check_if_user_is_admin($_SESSION['user_id']);
    
    echo $twig->render('followers.html', array(
                                             'nav' => array('page' => $_SERVER['PHP_SELF'], 'admin' => $admin)
                                             ));
     */
    ?>
