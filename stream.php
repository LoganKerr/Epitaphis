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

    $loader = new Twig_Loader_Filesystem('resources/views');
    $twig = new Twig_Environment($loader);
    
    $admin = check_if_user_is_admin($_SESSION['user_id']);
    
    $stmt = $conn->prepare("SELECT `users`.`firstName`, `users`.`lastName`, `goal_assoc`.`timestamp`, `goals`.`goalName`, `goals`.`goalText`, `profile_pictures`.`path` FROM `goal_assoc` INNER JOIN `goals` ON `goal_assoc`.`goal_id`=`goals`.`id` INNER JOIN `users` ON `goal_assoc`.`user_id`=`users`.`id` INNER JOIN `profile_pictures` ON `users`.`profile_picture_id`=`profile_pictures`.`id` ORDER BY `goal_assoc`.`timestamp` ASC");
    $stmt->execute();
    $res = $stmt->get_result();
    $i = 0;
    
    while ($row = $res->fetch_assoc())
    {
        $rows[$i] = $row;
        $i++;
    }
    
    echo $twig->render('stream.html', array(
                                             'nav' => array('page' => $_SERVER['PHP_SELF'], 'admin' => $admin),
                                             'rows' => $rows
                                             ));
    ?>

