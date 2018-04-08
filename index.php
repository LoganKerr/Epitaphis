<?php
    
    session_start();
    ob_start();
    
	require_once("config/config.php");
    require_once("vendor/autoload.php");
    
    if (isset($_SESSION['user_id']))
    {
        header("Location: profile.php");
        exit();
    }
    
    // form submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $error = array();
        
        // if login form submitted
        if ($_POST['form'] == "login")
        {
            
            $login_email = $_POST['email'];
            $pass = $_POST['pass'];
            
            if (!empty($login_email) && !empty($pass))
            {
                $stmt = $conn->prepare("SELECT `id`, `passHash` FROM `users` WHERE `email`=?");
                $stmt->bind_param("s", $login_email);
                $stmt->execute();
                $res = $stmt->get_result();
                
                if ($res->num_rows == 0) {
                    $error['email'] = "Invalid email or password";
                }
                else
                {
                    $row = $res->fetch_assoc();
                    $passHash = $row['passHash'];
                    if (!password_verify($pass, $passHash))
                    {
                        $error['login-email'] = "Invalid email or password";
                    }
                }
            }
        }
        else if ($_POST['form'] == "signup")
        {
            $required = array("email", "firstName", "lastName", "pass1", "pass2");
            foreach ($required as $key => $value)
            {
                if ($value == "email" && (!isset($_POST[$value]) || empty($_POST[$value])))
                {
                    $error["signup_email"] = "This field is required.";
                }
                if(!isset($_POST[$value]) || empty($_POST[$value]) && $_POST[$value] != '0')
                {
                    $error[$value] = "This field is required.";
                }
            }
            // escape data
            $signup_email = $_POST['email'];
            $firstName = $_POST['firstName'];
            $lastName = $_POST['lastName'];
            $pass1 = $_POST['pass1'];
            $pass2 = $_POST['pass2'];
            
            if (!empty($signup_email))
            {
                // TODO: validate email with regex
                // validates email is not already in use
                $stmt = $conn->prepare("SELECT `email` FROM `users` WHERE `email`=?");
                $stmt->bind_param("s", $signup_email);
                $stmt->execute();
                $res = $stmt->get_result();
                
                if ($res->num_rows != 0) {
                    $error['signup_email'] = "Email is already in use.";
                }
            }
            
            if (!empty($firstName))
            {
                // TODO: validate first name with regex
            }
            
            if (!empty($lastName))
            {
                // TODO: validate last name with regex
            }
            
            if (!empty($pass1))
            {
                // TODO: validate password
            }
            
            if (!empty($pass2))
            {
                if ($pass1 != $pass2)
                {
                    $error['pass2'] = "Passwords must match.";
                }
            }
            
            if (count($error) == 0)
            {
                $hash = password_hash($pass1, PASSWORD_DEFAULT);
                // insert row into database
                
                $stmt = $conn->prepare("INSERT INTO `users` (`email`, `firstName`, `lastName`, `passHash`) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("ssss", $signup_email, $firstName, $lastName, $hash);
                if ($stmt->execute())
                {
                    header("Location: index.php");
                    exit();
                }
                else
                {
                    $error['top'] = "Registration error. Please try again later.";
                }
            }
        }
        
        if (count($error) == 0)
        {
            $_SESSION['user_id'] = $row['id'];
            header('Location: index.php');
            exit();
        }
    }
    
    $loader = new Twig_Loader_Filesystem('resources/views');
    $twig = new Twig_Environment($loader);
    
    echo $twig->render('index.html',
                       array(
                                'login_email' => $login_email,
                                'signup_email' => $signup_email,
                                'firstName' => $firstName,
                                'lastName' => $lastName,
                                'error' => $error
                       )
                       );
?>
