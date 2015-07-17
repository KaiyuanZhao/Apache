if (localStorage.apache_user == undefined)
    location.href = "popup.html";
$(document).ready(function () {
    var user = JSON.parse(localStorage.apache_user);
    $("#username").text(user.username);
    var userId = user.userId;
    $.post("http://192.168.100.53/extension/isordered.php",
        {
            userId: userId
        },
        function (data, status) {
            if (status == "success") {
                var order_button = $("#order-button");
                if (data.success) {
                    order_button.text("取消订餐");
                    order_button.addClass("success");
                }
                else {
                    order_button.text("订餐");
                    order_button.removeClass("success");
                }
            }
        },
        "json");

    $("#jump").click(function () {
        chrome.tabs.create({url: "http://192.168.100.53/"});
    });

    $("#logout").click(function () {
        $.post("http://192.168.100.53/extension/logout.php",
            {},
            function (data, status) {
                if (status == "success") {
                    localStorage.removeItem("apache_user");
                    location.href = "popup.html";
                }
            });
    });

    var order_button = $("#order-button");
    order_button.click(function () {
        if (order_button.hasClass("success")) {
            $.post("http://192.168.100.53/extension/order.php",
                {
                    type: 1,
                    userId: userId
                },
                function (data, status) {
                    if (status == "success") {
                        var order_button = $("#order-button");
                        if (data.success) {
                            order_button.text("订餐");
                            order_button.removeClass("success");
                        }
                        else {
                            alert(data.errorMessage);
                        }
                    }
                },
                "json");
        } else {
            $.post("http://192.168.100.53/extension/order.php",
                {
                    type: 0,
                    userId: userId
                },
                function (data, status) {
                    if (status == "success") {
                        var order_button = $("#order-button");
                        if (data.success) {
                            order_button.text("取消订餐");
                            order_button.addClass("success");
                        }
                        else {
                            alert(data.errorMessage);
                        }
                    }
                },
                "json");
        }
    });
});