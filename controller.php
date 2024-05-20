<?php
    if(empty($_POST["Page"])) {
        include ("view_startpage.php");
        exit();
    }

    else {
        require ("model.php");
        $validLogin = false;

        switch ($_POST["Page"]) {
            case "StartPage":
                {
                    if($_POST["Command"] == "SignIn") {
                        $username = $_POST["username"];
                        $password = $_POST["password"];

                        if (isValid($username, $password)) {
                            $validLogin = true;
                            session_start();
                            $_SESSION["Username"] = $username;
                            $_SESSION["SignedIn"] = true;

                            if (isEmployee($username)) {
                                $_SESSION["accountType"] = "Employee";
                                include("view_employee_homepage.php");
                                exit();
                            } elseif (isAdministrator($username)) {
                                $_SESSION["accountType"] = "Administrator";
                                include("view_administrator_homepage.php");
                                exit();
                            } else {
                                include("view_customer_homepage.php");
                                exit();
                            }

                        } else {
                            $validLogin = false;
                            include("view_startpage.php");
                        }

                        //TODO automatic signout
                    }
                    else if($_POST["Command"] == "SignUp") {
                        $username = $_POST["username"];
                        $password = $_POST["password"];
                        $email = $_POST["email"];
                        if (register($username, $password, $email)) {
                            $validLogin = true;
                            $signUpFailed = false;
                            include("view_startpage.php");
                        } else {
                            $signUpFailed = true;
                            include("view_startpage.php");
                        }
                    }
                }
                break;

            case "CustomerHomePage":
                session_start();
                {
                    if (!$_SESSION["SignedIn"] || empty($_SESSION["SignedIn"])) {
                        include("view_startpage.php");
                        exit();
                    }

                    if ($_POST["Command"] == "SignOut") {
                        $validLogin = true;
                        session_unset();
                        session_destroy();
                        include("view_startpage.php");
                        exit();
                    }

                    if ($_POST["Command"] == "SearchItem") {
                        echo(searchItems($_POST["itemName"]));
                    }
                }
                break;
            
            case "EmployeeHomePage":
                session_start();

                if (!$_SESSION["SignedIn"] || empty($_SESSION["SignedIn"])) {
                    include("view_startpage.php");
                    exit();
                }

                switch ($_POST["Command"]) {
                    case "SignOut": {
                        $validLogin = true;
                        session_unset();
                        session_destroy();
                        include("view_startpage.php");
                        break;
                    }
                    case "SearchItem": {
                        echo (searchItems($_POST["itemName"]));
                        break;
                    }
                    case "ModifyItems": {
                        $modifySucess = false;
                        echo (modifyItem($_POST["itemID"], $_POST["newitemCode"], $_POST["newitemName"], $_POST["newitemIsle"], $_POST["newitemPosition"]));
                        break;
                    }
                    case "AddItem" : {
                        echo(addItem($_POST["itemCode"], $_POST["itemName"], $_POST["isle"], $_POST["position"]));
                        break;
                    }
                    case "DeleteItem" : {
                        echo(deleteItem($_POST["itemID"]));
                        break;
                    }
                    case "ShowItemOnPosition" : {
                        echo(showItem($_POST["isle"], $_POST["position"]));
                        break;
                    }
                }
                break;
            
            case "AdminHomePage": 
                session_start();

                if (!$_SESSION["SignedIn"] || empty($_SESSION["SignedIn"])) {
                    include("view_startpage.php");
                    exit();
                }

                switch($_POST["Command"]) {
                    case "SignOut": {
                        $validLogin = true;
                        session_unset();
                        session_destroy();
                        include("view_startpage.php");
                        break;
                    }

                    case "SearchAccount": {
                        echo(searchAccount($_POST["accountName"]));
                        break;
                    }
                    
                    case "DeleteAccount": {
                        echo(deleteAccount($_POST["accountID"]));
                        break;
                    }

                    case "ModifyAccount": {
                        echo(modifyAccount($_POST["accountID"], $_POST["newUsername"], $_POST["newEmail"], $_POST["newType"]));
                        break;
                    }
                }
                break;
        }
    }
?>