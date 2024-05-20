<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="administrator_homepage.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<?php 
    if (!isset($_SESSION["SignedIn"]) || !$_SESSION["SignedIn"]) {
        include("view_startpage.php");
    }
?>

<body>
    <div id="left-pane">
        <div id="info-box">
            <div id="photo-box"><img src="blank-avatar.webp" height="43" width="43" style="border-radius: 50%"></div>
            <div id="username-display">
                <?php
                    echo($_SESSION["accountType"]."<br>");
                    echo($_SESSION["Username"]);
                ?>
            </div>
        </div>
        <button class='btn' id="modify_account_btn">Modify Accounts</button>
        <!-- <button class='btn' id="search_item_btn">Search Items</button> -->
        
        <form action="controller.php" method="post">
            <input type="hidden" name="Page" value="AdminHomePage">
            <input type="hidden" name="Command" value="SignOut">
            <button type="submit" class='btn btn-danger' id="signout_btn">Sign Out</button>
        </form>
    </div>
    <div id="right-pane">
        <div id="account-modifier">
            <h1>Modify accounts</h1>
            <form action="controller.php" method="POST" id="search-form">
                <input type="hidden" name="Page" value="AdminHomePage">
                <input type="hidden" name="Command" value="SearchAccount">

                <div class="form-group">
                    <label for="mod_accountID">Account ID:</label>
                    <input type="" class="form-control" name="mod_accountID" id="mod_accountID" disabled>
                </div>

                <div class="form-group">
                    <label for="mod_accountEmail">Account username:</label>
                    <input type="" class="form-control" name="mod_accountUsername" id="mod_accountUsername">
                </div>

                <div class="form-group">
                    <label for="mod_accountName">Email:</label>
                    <input type="" class="form-control" name="mod_accountEmail" id="mod_accountEmail" disabled>
                </div>

                <div class="form-group">
                    <div style="width: 45%; margin-right:10px; display: inline-block">
                        <label for="accountDate">Join date:</label>
                        <input type="" class="form-control" name="mod_accountDate" id="mod_accountDate" disabled>
                    </div>
                    <div style="width: 45%; margin-right:10px; display: inline-block">
                        <label for="mod_accountType">Account Type:</label>
                        <select class="form-control" id="mod_accountType" disabled>
                            <option>Employee</option>
                            <option>Customer</option>
                        </select>
                    </div>
                </div>
                    
                </div>

                <div id="noAccountMessage">
                    <p style='color: #8b0300;'>Account does not exist in records.</p>
                </div>
                
                <button type="" class="btn" id="mod_submitSearch">Search</button>
                <button type="" class="btn" id="mod_submitSave">Save</button>
                <button type="" class="btn" id="mod_submitCancel">Cancel</button>
                <button type="" class="btn" id="mod_submitDelete">Delete</button>

            </form>
            
            <div id="mod_result_pane">
                

            </div>
        </div>
    </div>
</body>

<script>
    $('#mod_submitSearch').click(function() {
        $("#search-form").on("submit", function (e) {
            e.preventDefault();
        });

        $('#noItemMessage').css("display", "none");

        $.ajax({
        type : "POST",
        url : "controller.php",
        data : {Page : "AdminHomePage", 
            Command : "SearchAccount", 
            accountName : $('#mod_accountUsername').val()},
        success: function (data) {
            if (data == "no data") {
                $('#noAccountMessage').css("display", "block");
                //$('#mod_result_pane').css("display", "none");
                return null;
            }
            var myData = JSON.parse(data);
            var t = "<table id='search_result_table' class='table table-striped'>";

            console.log(myData);

            //for table headers
            t += "<tr>";
            for (let key in myData[0]) {
                if (key != "Password") {
                    t += "<th id = col_" + key + ">" + key + "</th>";
                }
            }
            t += "<th></th>";
            t += "</tr>";

            //for table data
            for (let i = 0; i < myData.length; i++) {
                t += "<tr>";
                for (let key in myData[i]) {
                    if (key != "Password") {
                        t += "<td id=account" + key + myData[i]["id"] + ">" + myData[i][key] + "</td>";
                    }
                }
                //disable modify Admin account button
                if (i != 0) {
                    t += "<td style='text-align: center'> <button class='mod_btn' accountid=" + myData[i]['id'] + ">Modify</button> </td>";
                } else {
                    t += "<td></td>";
                }
                t += "</tr>";
            }
            
            t += "</table>";
            $('#mod_result_pane').html(t);

            //function to add modify functionality on each button
            $('.mod_btn').each((function() {
                $(this).on("click", function(event) {
                    $("#mod_accountEmail").prop("disabled", false);
                    $("#mod_accountType").prop("disabled", false);

                    $("#mod_submitSearch").css("display", "none");
                    $("#mod_submitSave").css("display", "inline-block");
                    $("#mod_submitCancel").css("display", "inline-block");
                    $("#mod_submitDelete").css("display", "inline-block");
                    window.scrollTo(0, 0);

                    $("#mod_accountID").val(($('#accountid' + $(this).attr("accountid"))).text());
                    $("#mod_accountUsername").val(($('#accountUsername' + $(this).attr("accountid"))).text());
                    $("#mod_accountEmail").val(($('#accountEmail' + $(this).attr("accountid"))).text());
                    $("#mod_accountDate").val(($('#accountDate' + $(this).attr("accountid"))).text());
                    $("#mod_accountType").val(($('#accountType' + $(this).attr("accountid"))).text());
                })
            }));
        }
        });
        
    });

    $('#mod_submitSave').click(function() {
        modifyAccount();
    });

    $('#mod_submitCancel').click(function() {
        cancelModification();
    });

    $('#mod_submitDelete').click(function() {
        deleteAccount();
    });

    function cancelModification() {
        $("#mod_accountUsername").val("");
        $("#mod_accountDate").val("");
        $("#mod_accountID").val("");
        $("#mod_accountType").val("");
        $("#mod_accountEmail").val("");

        $("#mod_accountEmail").prop("disabled", true);
        $("#mod_accountType").prop("disabled", true);

        $("#mod_submitSearch").css("display", "inline-block");
        $("#mod_submitSave").css("display", "none");
        $("#mod_submitCancel").css("display", "none");
        $("#mod_submitDelete").css("display", "none");
        $("#mod_submitAdd").css("display", "inline-block");
    }

    function modifyAccount() {
        $("#account-modifier").on("submit", function (e) {
            e.preventDefault();
        });
        if (!checkFormFields()) {
            alert("Please input all possible fields");
            return null;
        }
        $.ajax({
            type : "POST",
            url : "controller.php",
            data : {
                Page : "AdminHomePage",
                Command : "ModifyAccount",
                accountID: $('#mod_accountID').val(),
                newUsername: $('#mod_accountUsername').val(),
                newEmail: $('#mod_accountEmail').val(),
                newType: $('#mod_accountType').val(),
            },
            success: function(data) {
                alert(data);
            }
        });

    }

    function deleteAccount() {
        $("#account-modifier").on("submit", function (e) {
            e.preventDefault();
        });
        var id = $("#mod_accountID").val();
        var username = $('#mod_accountUsername').val();
        var email = $('#mod_accountEmail').val();
        var date = $('#mod_accountDate').val();
        var type = $('#mod_accountType').val();

        if (confirm("Are you sure you want to delete this item?\n" + "ID: " + id + "\nUsername: " + username + "\nEmail: " + email + "\nDate: " + date + "\nType: " + type)) {
            $("#mod_accountID").val("");
            $("#mod_accountUsername").val("");
            $("#mod_accountEmail").val("");
            $("#mod_accountDate").val("");
            $("#mod_accountType").val("");

            $.ajax({
                type : "POST",
                url : "controller.php",
                data : {
                    Page : "AdminHomePage",
                    Command : "DeleteAccount",
                    accountID : id,
                    // accountName : username,
                    // accountEmail: email,
                    // accountDate: date,
                    // accountType: type,
                },
                success : function(data) {
                    alert(data);
                }
            });
        } else {

        }
    }

    function checkFormFields() {
        if ($('#mod_accountUsername').val() == "" || $('#mod_accountEmail').val() == "" || $('#mod_accountType').val() == "") {
            $('#mod_accountID').val("");
            $("#mod_accountUsername").val("");
            $("#mod_accountEmail").val("");
            $("#mod_accountDate").val("");
            $("#mod_accountType").val("");
            return false;
        } else return true;
    }
</script>
</html>