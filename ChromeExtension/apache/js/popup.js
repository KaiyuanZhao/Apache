if (localStorage.apache_user != undefined)
    location.href = "order.html";
$(document).ready(function (e) {
    $.post("http://192.168.100.53/extension/islogin.php",
        {},
        function (data, status) {
            if (status == "success") {
                if (data.success)
                {
                    localStorage.apache_user = JSON.stringify(data);
                    location.href = "order.html";
                }
            }
        },
        "json");
    $("#register").click(function () {
        chrome.tabs.create({url: "http://192.168.100.53/"});
    });
    $("#error").hide();
    $("#login").click(function () {
        var email = $("#username").val();
        var password = $("#password").val();
        $.post("http://192.168.100.53/extension/login.php",
            {
                username: email,
                password: password
            },
            function (data, status) {
                if (status == "success") {
                    if (!data.success) {
                        var error = $("#error");
                        error.text(data.errorMessage);
                        error.show();
                    }
                    else {
                        localStorage.apache_user = JSON.stringify(data);
                        location.href = "order.html";
                    }
                }
            },
            "json");
    });
});