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
<<<<<<< HEAD
                url: 'upload.php', //用于文件上传的服务器端请求地址
                secureuri: false, //是否需要安全协议，一般设置为false
                fileElementId: 'savator', //文件上传域的ID
                data:{

                }
                dataType: 'text', //返回值类型 一般设置为json
                success: function (data, status)  //服务器成功响应处理函数
                {
                    alert(data);
                },
                error: function (data, status, e)//服务器响应失败处理函数
                {
                    alert(e);
                }
=======
                alert(e);
>>>>>>> 3633edfd0857efa6ca798334f730accd42a3cf80
            }
        }
    );


}