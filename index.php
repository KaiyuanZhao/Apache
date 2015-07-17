<?php
    require 'entity/User.php';
    session_start();
    if(isset($_SESSION["user"])){
        $user = $_SESSION["user"];
        $id=$user->email;
        if($id=="1234@baixing.com") {
            $url = "./superuser.php";
            header("location:{$url}");
        }
        else{
            $url="./ordinaryuser.php";
           header("location: {$url}");
        }
    }
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Après-midi</title>
    <link rel="shortcut icon" href="./favicon.ico" />
    <meta charset=UTF-8 />
    <script src="js/jquery.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="amazeui/css/amazeui.flat.css" rel="stylesheet" type="text/css">
    <script src="amazeui/js/amazeui.js" rel="stylesheet" type="text/javascript"></script>
    <script src="js/jquery.ajaxfileupload.js" rel="stylesheet" type="text/javascript"></script>
    <script src="js/actionjs.js" rel="stylesheet" type="text/javascript"></script>
    <script src="js/ajaxfileupload.js" rel="stylesheet" type="text/javascript"></script>
    <link href="css/bootstrap.css" rel='stylesheet' type='text/css'/>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->

    <!-- Custom Theme files -->
    <link href="css/style.css" rel='stylesheet' type='text/css'/>
    <!-- Custom Theme files -->
    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,900' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800,300' rel='stylesheet' type='text/css'>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="application/x-javascript"> addEventListener("load", function () {
        setTimeout(hideURLbar, 0);
    }, false);
    function hideURLbar() {
        window.scrollTo(0, 1);
    } </script>
    <script type="text/javascript" src="js/move-top.js"></script>
    <script type="text/javascript" src="js/easing.js"></script>
    <script type="text/javascript">
        jQuery(document).ready(function ($) {
            $(".scroll").click(function (event) {
                event.preventDefault();
                $('html,body').animate({scrollTop: $(this.hash).offset().top}, 1000);
            });
        });
    </script>
    <script type="text/javascript" src="js/jquery.jscrollpane.min.js"></script>
    <script type="text/javascript" id="sourcecode">
        $(function () {
            $('.scroll-pane').jScrollPane();
        });
    </script>
</head>
<body>
<!--- Header Starts Here --->
<div class="header">
    <div class="container">
        <div class="logo invisible">
            <a href="index.html"><img src="images/logo.png" alt=""></a>
        </div>
        <div class="menu">
            <ul class="menu-top">
                <li><a class="play-icon popup-with-zoom-anim" href="#small-dialog" >登陆</a></li>
                <li><a class="play-icon popup-with-zoom-anim" href="#small-dialog1" >注册</a></li>
            </ul>
            <!---pop-up-box---->
            <script type="text/javascript" src="js/modernizr.custom.min.js"></script>
            <link href="css/popuo-box.css" rel="stylesheet" type="text/css" media="all"/>
            <script src="js/jquery.magnific-popup.js" type="text/javascript"></script>
            <!---//pop-up-box---->

            <div id="small-dialog" class="mfp-hide">
                    <div class="login am-form" id>
                        <h3>登陆</h3>
                        <fieldset>
                            <h4>Salut~</h4>
                            <form id="login_form">
                                <div class="am-form-group">
                                    <label class="hint" for="lemail">请输入公司邮箱:</label>
                                    <input class="input" name="lemail" type="email" id="lemail" data-validation-message="这个邮箱貌似不属于百姓网或地球...请重新输入"placeholder="输入邮箱" required/>
                                </div>

                                <div class="am-form-group">
                                    <label class="hint" for="lpassword">请输入密码：</label>
                                    <input class="input" type="password" id="lpassword" placeholder="长度在6~18之间，只能包含字符、数字和下划线"
                                           pattern=^[a-zA-Z]\w{5,17}$ data-validation-message="这个密码不属于地球...请重新输入" required/>
                                </div>

                                <input type="button" onclick="login_submit()" value="LogIn"/>
                            </form>
                        </fieldset>
                    </div>
                </div>

            <div id="small-dialog1" class="mfp-hide">
              <div class="signup am-form" id="doc-vld-msg">
                    <h3>注册</h3>
                    <fieldset>
                        <h4>Bonjour Chers Amis～</h4>
                        <form id="signup_form">
                       <div class="am-form-group">
                            <label class="hint" for="semail">请输入公司邮箱:</label>
                            <input class="input" name="semail" type="email" id="semail" data-validation-message="这个邮箱貌似不属于百姓网或地球...请重新输入"placeholder="输入邮箱" required/>
                        </div>

                        <div class="am-form-group">
                            <label class="hint" for="susername">请输入你的姓名:</label>
                            <input class="input" name="susername" type="text" id="susername" minlength="2"
                              pattern= [\u4e00-\u9fa5]  data-validation-message="请确保正确的中文字符及字符数"   placeholder="输入用户名（至少 2 个的中文字符）" required/>
                        </div>

                            <div class="am-form-group">
                                <label class="hint" for="slocation">请输入四位楼层房间编号（如:0206，1808):</label>
                                <input class="input" name="slocation" type="text" id="slocation" minlength="2"
                                       pattern= ^\d{4}$  data-validation-message="请输入四位楼层房间编号（如:0206，1808)"   placeholder="请输入四位楼层房间编号（如:0206，1808)" required/>
                            </div>


                            <div class="am-form-group">
                                <label class="hint" name="spassword" for="spassword">请输入密码：</label>
                                <input class="input" type="password" id="spassword" placeholder="以字母开头，长度在6~18之间，只能包含字符、数字和下划线"
                                       pattern=^\w{6,18}$ data-validation-message="这个密码不属于地球...请重新输入" required/>
                            </div>

                            <div class="am-form-group">
                                <label class="hint" for="spassword2">请确认密码：</label>
                                <input class="input" type="password" id="spassword2" placeholder="请与上面输入的值一致"
                                       data-equal-to="#spassword" data-validation-message="Ops...两次密码不一致，请重新输入" required/>
                            </div>

                            <div class="am-form-group">
                                <label class="hint" for="savator" >选择头像(可选):</label>
                                <input class="input" name="savator" type="file" id="savator" data-validation-massage="Ops...文件大小不正确" />
                            </div>


                        <div class="am-form-group">
                            <label class="hint" for="staste">个人口味偏好</label>
                            <select class="input" name="staste" id="staste" required>
                                <option value=""></option>
                                <option value="口味偏咸">口味偏咸</option>
                                <option value="口味偏淡">口味偏淡</option>
                                <option value="口味偏甜">口味偏甜</option>
                            </select>
                            <span class="am-form-caret"></span>
                        </div>



                        <input type="button" onclick="signup_submit()" value="SignUp"/>
                        </form>
                    </fieldset>
                </div>
            </div>

<!--            <a href="#" class="right_bt" id="activator"><img src="images/nav.png" alt=""/></a>
-->
            <div class="box" id="box">
                <div class="box_content_center">
                    <div class="menu_box_list">
                        <ul>
                            <li><a href="#" onclick="User()" class="scroll">订餐页面</a></li>
                            <li><a href="#" onclick="Profile()" class="scroll">修改资料</a></li>
                        </ul>
                    </div>
                    <a class="boxclose" id="boxclose"><img src="images/close.png" alt=""/></a>
                </div>
            </div>
            <script type="text/javascript" src="js/easing.js"></script>


        </div>
        <div class="clearfix"></div>
        <div class="header-bottom">
            <p>Ready for your</p>

            <h1>Après Midi</h1>
        </div>
    </div>
</div>
<!--- Header Ends Here --->

<!--- Part 2 Starts Here --->

<div class="interduce">

</div>

<!--- Part 2 Ends Here --->


<!-- Footer Starts Here ---->
<div class="footer">
    <div class="container">
        <div class="logo invisible">
            <a href="index.html"><img src="images/f_logo.png" class="foot-img" alt=""></a>
        </div>
        <p class="footer-head">Produced By <a href="http://tumblr.com/">Team Apache</a></p>

        <div class="clearfix"></div>
    </div>

</div>
<!-- Footer Ends Here ---->
</body>
</html>


