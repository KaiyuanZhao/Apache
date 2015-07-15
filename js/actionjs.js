/**
 * Created by EdwardChor on 7/15/15.
 */
function login_submit() {
    lemail = $("#lemail").val();
    lpassword = $("#lpassword").val();

    $.post("submit/submit.php", {username: lemail, password: lpassword}, function (data, status) {
        alert("Data: " + data + "\nStatus: " + status);
    });
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
            url: 'upload.php', //用于文件上传的服务器端请求地址
            secureuri: false, //是否需要安全协议，一般设置为false
            fileElementId: 'savator', //文件上传域的ID
            dataType: 'text', //返回值类型 一般设置为json
            data: {
                email: semail,
                username: susername,
                taste: staste,
                password: spassword,
                location: slocation},
            success: function (data, status)  //服务器成功响应处理函数
            {
                alert(data);
            },
            error: function (data, status, e)//服务器响应失败处理函数
            {
                alert(e);
            }
        }
    );


}



$(function() {
    $('#doc-vld-msg').validator({
        onValid: function(validity) {
            $(validity.field).closest('.am-form-group').find('.am-alert').hide();
        },

        onInValid: function(validity) {
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