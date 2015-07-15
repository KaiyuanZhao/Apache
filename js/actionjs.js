/**
 * Created by EdwardChor on 7/15/15.
 */

function signup_submit() {
    semail = $("#semail").val();
    susername = $("#susername").val();
    spassword = $("#spassword").val();
    slocation = $("#slocation").val();
    staste = $("#staste").val();


    /* $.post("stest.php",{email:semail,username:susername,taste:staste,password:spassword,location:slocation},function(data,status){
     alert("Data: " + data + "\nStatus: " + status);
     });
     */
    alert("!");
    $.fn.AjaxFileUpload
    (
        {
            url: '/ftest.php', //用于文件上传的服务器端请求地址
            method: 'post',
            secureuri: false, //是否需要安全协议，一般设置为false
            fileElementId: 'savator', //文件上传域的ID
            dataType: 'json', //返回值类型 一般设置为json
            success: function (data, status)  //服务器成功响应处理函数
            {
                alert(status);
                alert(data);
                $("#img1").attr("src", data.imgurl);
                if (typeof (data.error) != 'undefined') {
                    if (data.error != '') {
                        alert(data.error);
                    } else {
                        alert(data.msg);
                    }
                }
            },
            error: function (data, status, e)//服务器响应失败处理函数
            {
                alert(e);
            }
        }
    );
    alert("?");
}