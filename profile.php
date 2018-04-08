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
        $bio = $_POST['bio'];
        
        // goal id of new goal added
        $new_goal_id = -1;
        
        foreach ($_POST as $key => $value)
        {
            if (substr($key, 0, 11) == "goal_remove")
            {
                $goal_id = filter_var(substr($key, 11), FILTER_SANITIZE_NUMBER_INT);
                // deletes role from role_assoc
                $stmt = $conn->prepare("DELETE FROM `goal_assoc` WHERE `goal_id`=?");
                $stmt->bind_param("i", $goal_id);
                $stmt->execute();
                // deletes role from row
                $stmt = $conn->prepare("DELETE FROM `goals` WHERE `id`=?");
                $stmt->bind_param("i", $goal_id);
                $stmt->execute();
            }
            // if new goal added
            else if (substr($key, 0, 13) == "goal_name_new")
            {
                if ($value != "")
                {
                    // inserts new goal into goals table with name and empty text
                    $stmt = $conn->prepare("INSERT INTO `goals` (goalName, goalText) VALUES (?, '')");
                    $stmt->bind_param("s", $value);
                    $stmt->execute();
                    $new_goal_id = $conn->insert_id;
                    // inserts new goal into role_assoc for user who posted request
                    $stmt = $conn->prepare("INSERT INTO `goal_assoc` (user_id, goal_id) VALUES (?, ?)");
                    $stmt->bind_param("ii", $user_id, $new_goal_id);
                    $stmt->execute();
                }
            }
            else if (substr($key, 0, 13) == "goal_text_new")
            {
                // updates goal text at new goal id
                $stmt = $conn->prepare("UPDATE `goals` SET `goalText`=? WHERE `id`=?");
                $stmt->bind_param("si", $value, $new_goal_id);
                $stmt->execute();
            }
            // updates user assigned to role
            else if (substr($key, 0, 9) == "goal_name")
            {
                $goal_id = filter_var(substr($key, 9), FILTER_SANITIZE_NUMBER_INT);
                $stmt = $conn->prepare("UPDATE `goals` SET `goalName`=? WHERE `id`=?");
                $stmt->bind_param("si", $value , $goal_id);
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
        if (count($error) == 0)
        {
            $stmt = $conn->prepare("UPDATE `users` SET `bio`=? WHERE `id`=?");
            $stmt->bind_param("si", $bio, $user_id);
            if (!$stmt->execute())
            {
                echo "Profile Error: ".$stmt->error;
            }
        }
    } //ends post request
    
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
    
    $stmt2 = $conn->prepare("SELECT `bio` FROM `users` WHERE `id`=?");
    $stmt2->bind_param("i", $user_id);
    $stmt2->execute();
    $res2 = $stmt2->get_result();
    $row2 = $res2->fetch_assoc();
    
    $bio = $row2['bio'];
    
    $loader = new Twig_Loader_Filesystem('resources/views');
    $twig = new Twig_Environment($loader);
    
    $admin = check_if_user_is_admin($_SESSION['user_id']);
    
    echo $twig->render('profile.html', array(
                                             'nav' => array('page' => $_SERVER['PHP_SELF'], 'admin' => $admin),
                                             'rows' => $rows,
                                             'bio' => $bio
                                             ));
    ?>

