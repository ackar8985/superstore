<?php
    require("connect.php");
    connect();

    function checkUsername($username) {
        global $conn;
        $sql = "SELECT `Username` from Accounts where `Username` = '$username'";
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) > 0) {
            return true;
        } else {
            return false; 
        }
    }

    function isValid($username, $password) {
        global $conn;
        if (checkUsername($username) == false) {
            return false;
        }

        $sql = "SELECT `Username`, `Password` from Accounts where `username` = '$username'";
        
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) > 0) {
            if(mysqli_fetch_assoc($result)["Password"] == $password) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function isEmployee($username) {
        global $conn;

        if(checkUsername($username) == false) {
            return false;
        }
        $sql = "SELECT `Type` from Accounts where `username` = '$username'";

        $result = mysqli_query($conn, $sql);

        if(mysqli_fetch_assoc($result)["Type"] == "Employee") {
            return true;
        } else {
            return false;
        }
    }

    function isAdministrator($username) {
        global $conn;

        if(checkUsername($username) == false) {
            return false;
        }
        $sql = "SELECT `Type` from Accounts where `username` = '$username'";

        $result = mysqli_query($conn, $sql);

        if(mysqli_fetch_assoc($result)["Type"] == "Administrator") {
            return true;
        } else {
            return false;
        }
    }

    function register($username, $password, $email) {
        global $conn;

        if (checkUsername($username)) {
            return false;
        }

        $current_date = date("Ymd");
        $sql = "INSERT INTO Accounts (ID, Username, Password, Email, Date, Type) VALUES (NULL, '$username', '$password', '$email', '$current_date', 'Customer')";
        $result = mysqli_query($conn, $sql);

        if($result) {
            $validLogin = true;
            return true;
        } else {
            return false;
        }
    }

    function modifyAccount($id, $newUsername, $newEmail, $newType) {
        global $conn;
        $sql = "UPDATE Accounts SET Username = '$newUsername', Email = '$newEmail', `Type` = '$newType' WHERE id = '$id'";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            echo("Sucessfully updated account id " . $id);
        } else {
            echo("Update failed for account id ". $id);
        }
        
    }

    function deleteAccount($id) {
        global $conn;
        $sql = "DELETE FROM Accounts WHERE id = '$id'";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            echo("Sucessfully DELETED account id " . $id);
        } else {
            echo("DELETE failed for account id ". $id);
        }
        
    }

    function searchAccount($username) {
        global $conn;
        $sql = "SELECT * FROM Accounts where Username like '%$username%'";
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) > 0) {
            $data = array();
            $i = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                $data[$i++] = $row;
            }
            echo (json_encode($data));
            return null;
        } else {
            echo("no data");
        }
        
    }

    //inventory functions
    function searchItems($itemName){
        global $conn;
        $sql = "SELECT * from Inventory where `Name` like '%$itemName%'";
        $result = mysqli_query($conn, $sql);
        $data = array();
        if(mysqli_num_rows($result) > 0) {
            $i = 0;
            while($row = mysqli_fetch_assoc($result)) {
                $data[$i++] = $row;
            }
            echo (json_encode($data));
        } else {
            $data = "No data";
            echo $data;
        }        
    }

    function deleteItem($itemID) {
        global $conn;
        $sql = "DELETE from Inventory where `id`= $itemID";
        $result = mysqli_query($conn, $sql);
        
        if ($result) {
            $success = "Deleted item ID: " . $itemID;
            echo($success);            
        }
        else {
            $success = "Failed to delete item ID: " . $itemID;
            echo($success);
        }
    }

    function modifyItem($itemID, $newCode, $newName, $newIsle, $newPosition) {
        global $conn;
        $sql = "UPDATE Inventory SET `Code` = '$newCode', `Name` = '$newName', `Isle` = '$newIsle', `Position` = '$newPosition' WHERE (`id` = '$itemID');";
        $result = mysqli_query($conn, $sql);

        if($result) return true;
        else return false;
    }

    function addItem($code, $name, $isle, $position) {
        global $conn;
        $sql = "INSERT INTO Inventory (id, Code, Name, Isle, Position)
        VALUES (NULL, '$code', '$name', '$isle', '$position');";
        $result = mysqli_query($conn, $sql);

        if($result) {
            echo (searchItems($name));
        } else {
            echo ("Request was not successful");
        } 
    }

    function showItem($isle, $position) {
        global $conn;
        $sql = "SELECT * FROM Inventory WHERE `Isle` = '$isle' and `Position` = '$position'";
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) > 0) {
            $i = 0;
            while($row = mysqli_fetch_assoc($result)) {
                $data[$i++] = $row;
            }
            echo (json_encode($data));
        } else {
            $data = "no data";
            echo $data;
        } 
    }

?>