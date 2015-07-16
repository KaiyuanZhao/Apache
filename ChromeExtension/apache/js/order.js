if (localStorage.apache_user == undefined)
    location.href = "popup.html";
$(document).ready(function(){
    var user = JSON.parse(localStorage.apache_user);
    $("#username").text(user.username);
    var userId = user.userId;
    $.post("http://192.168.100.53/extension/isordered.php",
        {
            userId: userId
        },
        function (data, status) {
            alert(data);
            if (status == "success") {
                var order_button = $("#order-button");
                if (data.success)
                {
                    order_button.text("取消订餐");
                    order_button.addClass("success");
                }
                else{
                    order_button.text("订餐");
                    order_button.removeClass("success");
                }
            }
        },
        "json");
});