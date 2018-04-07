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
        // validate data -----------------------
        // escape data
        
        foreach ($_POST as $key => $value)
        {
            // updates user assigned to role
            if (substr($key, 0, 9) == "goal_name")
            {
                $goal_id = filter_var(substr($key, 9), FILTER_SANITIZE_NUMBER_INT);
                $stmt = $conn->prepare("UPDATE `goals` SET `goalName`=? WHERE `id`=?");
                $stmt->bind_param("si", $value ,$goal_id);
                $stmt->execute();
            }
            // updates role name if changed
            else if (substr($key, 0, 9) == "goal_text")
            {
                $goal_id = filter_var(substr($key, 9), FILTER_SANITIZE_NUMBER_INT);
                $stmt = $conn->prepare("UPDATE `goals` SET `goalText`=? WHERE `id`=?");
                $stmt->bind_param("si", $value, $goal_id);
                $stmt->execute();
                
            }
        }
    }
    
    $stmt = $conn->prepare("SELECT `goal_assoc`.`goal_id`, `goals`.`goalName`, `goals`.`goalText` FROM `goal_assoc` LEFT JOIN `goals` ON `goal_assoc`.`goal_id`=`goals`.`id` WHERE `goal_assoc`.`user_id`=?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $res = $stmt->get_result();
    $i = 0;
    
    while ($row = $res->fetch_assoc())
    {
        $rows[$i] = $row;
        $i++;
    }
    
    $loader = new Twig_Loader_Filesystem('resources/views');
    $twig = new Twig_Environment($loader);
    
    $admin = check_if_user_is_admin($_SESSION['user_id']);
    
    echo $twig->render('profile.html', array(
                                             'nav' => array('page' => $_SERVER['PHP_SELF'], 'admin' => $admin),
                                             'rows' => $rows
                                             ));
    ?>

