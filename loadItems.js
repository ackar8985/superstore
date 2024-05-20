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