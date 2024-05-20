<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="employee_homepage.css">
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
        <button class='btn' id="locate_isle_btn" autofocus>Locate Isle Position</button>
        <button class='btn' id="modify_item_btn">Modify Items</button>
        <!-- <button class='btn' id="search_item_btn">Search Items</button> -->
        
        <form action="controller.php" method="post">
            <input type="hidden" name="Page" value="EmployeeHomePage">
            <input type="hidden" name="Command" value="SignOut">
            <button type="submit" class='btn btn-danger' id="signout_btn">Sign Out</button>
        </form>
    </div>
    <div id="right-pane">
        <div id="store-map">
            <h1>Locate Isle Position</h1>
            <table class="isle-table">
                <tr>
                    <td class="isle-position">1</td>
                    <td class="isle-title" rowspan="12">1</td>
                    <td class="isle-position">2</td>
                </tr>
                <tr>
                    <td class="isle-position">3</td>
                    <td class="isle-position">4</td>
                </tr>
                <tr>
                    <td class="isle-position">5</td>
                    <td class="isle-position">6</td>
                </tr>
                <tr>
                    <td class="isle-position">7</td>
                    <td class="isle-position">8</td>
                </tr>
                <tr>
                    <td class="isle-position">9</td>
                    <td class="isle-position">10</td>
                </tr>
                <tr>
                    <td class="isle-position">11</td>
                    <td class="isle-position">12</td>
                </tr>
            </table>
            <table class="isle-table">
                <tr>
                    <td class="isle-position">1</td>
                    <td class="isle-title" rowspan="12">2</td>
                    <td class="isle-position">2</td>
                </tr>
                <tr>
                    <td class="isle-position">3</td>
                    <td class="isle-position">4</td>
                </tr>
                <tr>
                    <td class="isle-position">5</td>
                    <td class="isle-position">6</td>
                </tr>
                <tr>
                    <td class="isle-position">7</td>
                    <td class="isle-position">8</td>
                </tr>
                <tr>
                    <td class="isle-position">9</td>
                    <td class="isle-position">10</td>
                </tr>
                <tr>
                    <td class="isle-position">11</td>
                    <td class="isle-position">12</td>
                </tr>
            </table>
            <table class="isle-table">
                <tr>
                    <td class="isle-position">1</td>
                    <td class="isle-title" rowspan="12">3</td>
                    <td class="isle-position">2</td>
                </tr>
                <tr>
                    <td class="isle-position">3</td>
                    <td class="isle-position">4</td>
                </tr>
                <tr>
                    <td class="isle-position">5</td>
                    <td class="isle-position">6</td>
                </tr>
                <tr>
                    <td class="isle-position">7</td>
                    <td class="isle-position">8</td>
                </tr>
                <tr>
                    <td class="isle-position">9</td>
                    <td class="isle-position">10</td>
                </tr>
                <tr>
                    <td class="isle-position">11</td>
                    <td class="isle-position">12</td>
                </tr>
            </table>
        </div>

        <div id="item-modifier">
            <h1>Modify Items</h1>
            <form action="controller.php" method="GET" id="search-form">
                <input type="hidden" name="Page" value="EmployeeHomePage">
                <input type="hidden" name="Command" value="SearchItem">

                <div class="form-group" style="display:none">
                    <label for="itemID">Item ID:</label>
                    <input type="" class="form-control" name="mod_itemID" id="mod_itemID">
                </div>

                <div class="form-group">
                    <label for="itemName">Item name:</label>
                    <input type="" class="form-control" name="mod_itemName" id="mod_itemName">
                </div>

                <div class="form-group">
                    <label for="itemCode">Item code:</label>
                    <input type="" class="form-control" name="mod_itemCode" id="mod_itemCode">
                </div>

                <div class="form-group">
                    <div style="width: 45%; margin-right:10px; display: inline-block">
                        <label for="isle">Isle:</label>
                        <input type="" class="form-control" name="isle" id="isle">
                    </div>
                    
                    <div style="width: 45%; margin-right:10px; display: inline-block">
                        <label for="position">Position:</label>
                        <input type="" class="form-control" name="position" id="position">
                    </div>
                </div>

                <div id="noItemMessage">
                    <p style='color: #8b0300;'>Item does not exist in records.</p>
                </div>
                
                <button type="" class="btn" id="mod_submitAdd">Add Item</button>
                <button type="" class="btn" id="mod_submitSearch">Search</button>
                <button type="" class="btn" id="mod_submitSave">Save</button>
                <button type="" class="btn" id="mod_submitCancel">Cancel</button>
                <button type="" class="btn" id="mod_submitDelete">Delete</button>

            </form>
            
            <div id="mod_result_pane">
                

            </div>
        </div>

        <div class="popup_modal" id="modal">
            <h3 style="display: inline-block; margin-top: 10px">Isle:</h3><h3 id="modal_isle" style="display: inline-block; margin-right: 20px; margin-top: 10px">[test]</h3>
            <h3 style="display: inline-block; margin-top: 10px">Position:</h3><h3 id="modal_position" style="display: inline-block; margin-top: 10px">[test]</h3>
            <div style="margin-top: 10px;">
                <p id="modal_nameDisplay">Item Name: </p>
                <p id="modal_name">[test name]</p>
            </div>
            <div>
                <p id="modal_codeDisplay">Item Code: </p>
                <p id="modal_code">[test code]</p>
            </div>
            <button class="btn" id="modal_close_btn">Close</button>
        </div>

    </div>
</body>

<script>
    
    $('.isle-position').each(function() {
        $(this).on("click", function() {
            showItemOnPosition($(this).parent().parent().find("td.isle-title").text(), $(this).text());
        })
    })
    
    showLocateScreen();

    $('#locate_isle_btn').click(function() {
        showLocateScreen();
    })

    $('#modify_item_btn').click(function() {
        showModifyScreen();
    })


    function showLocateScreen() {
        $('#store-map').css("display", "block");
        $('#item-searcher').css("display", "none");
        $('#item-modifier').css("display", "none");

        $('#locate_isle_btn').addClass(".btn.active");
        $('#search_item_btn').removeClass(".btn.active");
        $('#modify_item_btn').removeClass(".btn.active");
    }

    function showModifyScreen() {
        $('#store-map').css("display", "none");
        $('#item-modifier').css("display", "block");
        $('#item-searcher').css("display", "none");
        
        $('#locate_isle_btn').removeClass(".btn.active");
        $('#modify_item_btn').addClass(".btn.active");
        $('#search_item_btn').removeClass(".btn.active");
    }

    $('#mod_submitSearch').click(function() {
        $("#search-form").on("submit", function (e) {
            e.preventDefault();
        });

        $('#noItemMessage').css("display", "none");

        $.ajax({
        type : "POST",
        url : "controller.php",
        data : {Page : "EmployeeHomePage", Command : "SearchItem", itemName : $('#mod_itemName').val()},
        success: function (data) {
            if (data == "No data") {
                $('#noItemMessage').css("display", "block");
                //$('#mod_result_pane').css("display", "none");
                return null;
            }
            var myData = JSON.parse(data);
            var t = "<table id='search_result_table' class='table table-striped'>";

            //for table headers
            t += "<tr>";
            for (let key in myData[0]) {
                t += "<th id = col_" + key + ">" + key + "</th>";
            }
            t += "<th></th>";
            t += "</tr>";

            //for table data
            for (let i = 0; i < myData.length; i++) {
                t += "<tr>";
                for (let key in myData[i]) {
                    t += "<td id=item" + key + myData[i]["id"] + ">" + myData[i][key] + "</td>";
                }
                t += "<td style='text-align: center'> <button class='mod_btn' itemid=" + myData[i]['id'] + ">Modify</button> </td>";
                t += "</tr>";
            }

            t += "</table>";
            $('#mod_result_pane').html(t);

            //function to add modify functionality on each button
            $('.mod_btn').each((function() {
                $(this).on("click", function(event) {
                    $("#mod_itemCode").prop("disabled", false);
                    $("#isle").prop("disabled", false);
                    $("#position").prop("disabled", false);

                    $("#mod_submitSearch").css("display", "none");
                    $("#mod_submitSave").css("display", "inline-block");
                    $("#mod_submitCancel").css("display", "inline-block");
                    $("#mod_submitDelete").css("display", "inline-block");
                    $("#mod_submitAdd").css("display", "none");
                    window.scrollTo(0, 0);

                    $("#mod_itemID").val(($('#itemid' + $(this).attr("itemid"))).text());
                    $("#mod_itemName").val(($('#itemName' + $(this).attr("itemid"))).text());
                    $("#mod_itemCode").val(($('#itemCode' + $(this).attr("itemid"))).text());
                    $("#isle").val(($('#itemIsle' + $(this).attr("itemid"))).text());
                    $("#position").val(($('#itemPosition' + $(this).attr("itemid"))).text());
                })
            }));
        }
        });
        
    });

    $('#mod_submitAdd').click(function() {
        addItem();
    })

    $('#mod_submitSave').click(function() {
        modifyItem();
    });

    $('#mod_submitCancel').click(function() {
        cancelModification();
    });

    $('#mod_submitDelete').click(function() {
        deleteItem();
    })

    $("#modal_close_btn").click(function() {
        closeModal();
    })

    function cancelModification() {
        $("#mod_itemName").val("");
        $("#mod_itemCode").val("");
        $("#isle").val("");
        $("#position").val("");

        $("#mod_submitSearch").css("display", "inline-block");
        $("#mod_submitSave").css("display", "none");
        $("#mod_submitCancel").css("display", "none");
        $("#mod_submitDelete").css("display", "none");
        $("#mod_submitAdd").css("display", "inline-block");
    }

    function addItem() {
        $("#search-form").on("submit", function (e) {
            e.preventDefault();
        });
        if (!checkFormFields()) {
            alert("Please input all fields");
            return null;
        }
        var newName = $('#mod_itemName').val();
        var newCode = $('#mod_itemCode').val();
        var newIsle = $('#isle').val();
        var newPosition = $('#position').val();

        alert(newName + " " + newCode);
        $("#mod_itemName").val("");
        $("#mod_itemCode").val("");
        $("#isle").val("");
        $("#position").val("");

        $.ajax({
            type : "POST",
            url : "controller.php",
            data : {
                Page : "EmployeeHomePage",
                Command : "AddItem",
                itemCode : newCode,
                itemName : newName,
                isle: newIsle,
                position: newPosition,
            },
            success : function(data) {
                alert(data);
            }
        }) 
    }
    
    function modifyItem() {
        $("#search-form").on("submit", function (e) {
            e.preventDefault();
        });
        if (!checkFormFields()) {
            alert("Please input all fields");
            return null;
        }
        $.ajax({
            type : "POST",
            url : "controller.php",
            data : {
                Page : "EmployeeHomePage",
                Command : "ModifyItems",
                itemID: $('#mod_itemID').val(),
                newitemCode: $('#mod_itemCode').val(),
                newitemName: $('#mod_itemName').val(),
                newitemIsle: $('#isle').val(),
                newitemPosition: $('#position').val(),
            },
            success: function(data) {
                alert("Successful modification for item");
            }
        });

    }

    function deleteItem() {
        $("#search-form").on("submit", function (e) {
            e.preventDefault();
        });
        var id = $("#mod_itemID").val();
        var name = $('#mod_itemName').val();
        var code = $('#mod_itemCode').val();
        var isle = $('#isle').val();
        var position = $('#position').val();

        if (confirm("Are you sure you want to delete this item?\n" + name + "\nCode: " + code + "\nIlse: " + isle + "\nPosition: " + position)) {
            $("#mod_itemID").val("");
            $("#mod_itemName").val("");
            $("#mod_itemCode").val("");
            $("#isle").val("");
            $("#position").val("");

            $.ajax({
                type : "POST",
                url : "controller.php",
                data : {
                    Page : "EmployeeHomePage",
                    Command : "DeleteItem",
                    itemID : id,
                    itemCode : code,
                    itemName : name,
                    isle: isle,
                    position: position,
                },
                success : function(data) {
                    alert(data);
                }
            });
        } else {

        }
    }

    function showItemOnPosition(selected_isle, selected_position) {
        $.ajax({
            url : "controller.php",
            type : "POST",
            data : {
                Page : "EmployeeHomePage",
                Command : "ShowItemOnPosition",
                isle : selected_isle,
                position : selected_position,
            },
            success : function(data) {
                if (data == "no data") {
                    alert("There is no item in this position");
                    return null;
                }
                var myData = JSON.parse(data);
                $('#modal_isle').text(selected_isle);
                $('#modal_position').text(selected_position);
                $('#modal_name').text(myData[0]["Name"]);
                $('#modal_code').text(myData[0]["Code"]);
                $('#modal').css("display", "block");
            }
        });
    }

    function closeModal() {
        $('#modal').css("display", "none");
    }

    function checkFormFields() {
        if ($('#mod_itemName').val() == "" || $('#mod_itemCode').val() == "" || $('#isle').val() == "" || $('#position').val() == "") {
            $("#mod_itemName").val("");
            $("#mod_itemCode").val("");
            $("#isle").val("");
            $("#position").val("");
            return false;
        } else return true;
    }
</script>

</html>