/**
 * Created by EdwardChor on 7/15/15.
 */
function User() {
    window.location.href("./index.php")
}

function Profile() {
    window.location.href("./profile.php")
}

function Logout() {
    $.post("submit/logout.php", {}, function (data, status) {
        if (status == "success") {
            location.reload(true);
        }
    });

}

function Favourite(){
    var obj = $("#favourite");
    if (obj.val() == "点个赞") {
        $.post("submit/favorite.php", {}, function (data, status) {
            if (!data.success) {
                alert("出现错误，点赞失败！");
            }
            else {
                alert("点赞成功!");
                obj.val("取消赞");
            }

        }, "json");
    }
    else {
        $.post("submit/cancelFavor.php", {}, function (data, status) {
            if (!data.success) {
                alert("出现错误，取消失败！");
            }
            else {
                alert("取消成功！");
                obj.val("点个赞");
            }
        }, "json")
    }

}

function Subnewpassword() {
    soldpassword = $("#spassword").val();
    snewpassword = $("#spassword0").val();
    $.ajaxFileUpload
    (
        {
            url: 'http://192.168.100.53/submit/newpassword.php', //用于文件上传的服务器端请求地址
            secureuri: false, //是否需要安全协议，一般设置为false
            fileElementId: 'savator', //文件上传域的ID
            dataType: 'text', //返回值类型 一般设置为json
            data: {
                oldpassword: soldpassword,
                newpassword: snewpassword
            },
            success: function (data, status)  //服务器成功响应处理函数
            {
                location.reload();
            },
            error: function (data, status, e)//服务器响应失败处理函数
            {
                alert(e);
                location.reload(true);
            }
        });


}

function Subnewprofile() {
    slocation = $("#slocation").val();

    $.ajaxFileUpload
    (
        {
            url: 'submit/edit.php', //用于文件上传的服务器端请求地址
            secureuri: false, //是否需要安全协议，一般设置为false
            fileElementId: 'savator', //文件上传域的ID
            dataType: 'text', //返回值类型 一般设置为json
            data: {
                location: slocation
            },
            success: function (data, status)  //服务器成功响应处理函数
            {
                location.href = "ordinaryuser.php";
            },
            error: function (data, status, e)//服务器响应失败处理函数
            {
                alert(e);
                location.reload();
            }
        }
    );
}

function login_submit() {
    lemail = $("#lemail").val();
    lpassword = $("#lpassword").val();
    $.post("submit/dologin.php", {username: lemail, password: lpassword}, function (data, status) {
        if (data.success) {
            location.reload();
        }
        else {
            alert(data.errormessage);
        }
    }, "json");
}

function signup_submit() {
    semail = $("#semail").val();
    susername = $("#susername").val();
    spassword = $("#spassword").val();
    slocation = $("#slocation").val();
    staste = $("#staste").val();

    $.ajaxFileUpload
    (
        {
            url: 'http://192.168.100.53/submit/submit.php', //用于文件上传的服务器端请求地址
            secureuri: false, //是否需要安全协议，一般设置为false
            fileElementId: 'savator', //文件上传域的ID
            dataType: 'text', //返回值类型 一般设置为json
            data: {
                email: semail,
                username: susername,
                taste: staste,
                password: spassword,
                location: slocation
            },
            success: function (data, status)  //服务器成功响应处理函数
            {
                location.reload();
            },
            error: function (data, status, e)//服务器响应失败处理函数
            {
                alert(e);
                location.reload(true);
            }
        }
    );


}


$(function () {
    $('#doc-vld-msg').validator({
        onValid: function (validity) {
            $(validity.field).closest('.am-form-group').find('.am-alert').hide();
        },

        onInValid: function (validity) {
            var $field = $(validity.field);
            var $group = $field.closest('.am-form-group');
            var $alert = $group.find('.am-alert');
            var msg = $field.data('validationMessage') || this.getValidationMessage(validity);

            if (!$alert.length) {
                $alert = $('<div class="am-alert am-alert-danger"></div>').hide().
                    appendTo($group);
            }

            $alert.html(msg).show();
        }
    });
});


function Confirm() {
    var obj = $("#confirm-order");
    if (obj.val() == "确认订餐") {
        $.post("submit/orderSubmit.php", {}, function (data, status) {
            if (!data.success) {
                alert("出现错误，订餐失败！");
            }
            else {
                alert("订餐成功！");
                obj.val("取消");
            }

        }, "json");
    }
    else {
        $.post("submit/orderCancel.php", {}, function (data, status) {
            if (!data.success) {
                alert("出现错误，取消失败！");
            }
            else {
                alert("取消成功！");
                obj.val("订餐");
            }
        }, "json")
    }
}


function Castanswer() {
    alert("castin!");
    var todaymeal = $("#answer").val();
    alert(todaymeal);

    $.post("submit/addMeal.php",{mealName:todaymeal},function(data,status){
        alert(status);
       alert(data);
    },"json");
}

$(document).ready(function () {
    $('.popup-with-zoom-anim').magnificPopup({
        type: 'inline',
        fixedContentPos: false,
        fixedBgPos: true,
        overflowY: 'auto',
        closeBtnInside: true,
        preloader: false,
        midClick: true,
        removalDelay: 300,
        mainClass: 'my-mfp-zoom-in'
    });

});


var $ = jQuery.noConflict();
$(function () {
    $('#activator').click(function () {
        $('#box').animate({'top': '0px'}, 500);
    });
    $('#boxclose').click(function () {
        $('#box').animate({'top': '-700px'}, 500);
    });
});
$(document).ready(function () {

    //Hide (Collapse) the toggle containers on load
    $(".toggle_container").hide();

    //Switch the "Open" and "Close" state per click then slide up/down (depending on open/close state)
    $(".trigger").click(function () {
        $(this).toggleClass("active").next().slideToggle("slow");
        return false; //Prevent the browser jump to the link anchor
    });

});