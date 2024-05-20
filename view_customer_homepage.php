<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="customer_homepage.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="loadItems.js"></script>
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
                    echo($_SESSION["Username"]);
                ?>
            </div>
        </div>
        <button class='btn' id="locate_isle_btn" autofocus>Locate Isle Position</button>
        <button class='btn' id="search_item_btn">Search Items</button>
        
        <form action="controller.php" method="post">
            <input type="hidden" name="Page" value="CustomerHomePage">
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

        <div id="item-searcher">
            <h1>Search Products</h1>
            <form action="controller.php" method="GET" id="search-form">
                <input type="hidden" name="Page" value="CustomerHomePage">
                <input type="hidden" name="Command" value="SearchItem">

                <div class="form-group">
                    <label for="itemName">Item name:</label>
                    <input type="" class="form-control" name="itemName" id="itemName">
                </div>

                <div id="noItemMessage">
                    <p style='color: #8b0300;' id="noItemMessage">Item does not exist in records.</p>
                </div>

                <button type="submit" class="btn" id="submitSearch">Search</button>
            </form>
            
            <div id="result-pane">

            </div>
        </div>
    </div>
</body>

<script>

    $('.isle-position').each(function() {
        $(this).on("click", function() {
            showItemOnPosition($(this).parent().parent().find("td.isle-title").text(), $(this).text());
        })
    })

    $('#modal_close_btn').click(function() {
        closeModal();
    })

    $('#locate_isle_btn').click(function() {
        showLocateScreen();
    })

    $('#search_item_btn').click(function() {
        showSearchScreen();
    })

    function showLocateScreen() {
        $('#store-map').css("display", "block");
        $('#item-searcher').css("display", "none");
        $('#locate_isle_btn').addClass(".btn.active");
        $('#search_item_btn').removeClass("active");
    }

    function showSearchScreen() {
        $('#store-map').css("display", "none");
        $('#item-searcher').css("display", "block");
        $('#search_item_btn').addClass(".btn.active");
        $('#locate_isle_btn').removeClass("active");
    }

    showLocateScreen();
    
    $('#submitSearch').click(function() {
        $("#search-form").on("submit", function (e) {
            e.preventDefault();
        });

        $('#noItemMessage').css("display", "none");

        $.ajax({
        type : "POST",
        url : "controller.php",
        data : {Page : "CustomerHomePage", Command : "SearchItem", itemName : $('#itemName').val()},
        success: function (data) {
            if (data == "No data") {
                $('#noItemMessage').css("display", "block");
                //$('result-pane').css("display", "none");
                return null;
            }
            var myData = JSON.parse(data);
            var t = "<table id='search_result_table' class='table table-striped'>";

            //for table headers
            t += "<tr>";
            for (let key in myData[0]) {
                t += "<th id = col_" + key + ">" + key + "</th>";
            }
            t += "</tr>";

            //for table data
            for (let i = 0; i < myData.length; i++) {
                t += "<tr>";
                for (let key in myData[i]) {
                    t += "<td id=item" + key + myData[i]["id"] + ">" + myData[i][key] + "</td>";
                }
                t += "</tr>";
            }

            t += "</table>";
            $('#result-pane').html(t);
        }
        });
        
    });

    function closeModal() {
        $('#modal').css("display", "none");
    }

//change-delete user profile
</script>

</html>