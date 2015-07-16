$(document).ready(function (e) {
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
                alert(data);
                if (status == "success") {
                    if (!data.success)
                    {
                        var error = $("#error");
                        error.text(data.errormessage);
                        error.show();
                    }
                    else
                    {
                        alert(data.userId);
                        location.href = "order.html";
                    }
                }
            },
            "text");
    });
});