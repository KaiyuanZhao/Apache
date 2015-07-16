<?php
session_start();
if(!isset($_SESSION["user"])){
    header("location: ./index.php");
}
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Après-midi</title>
    <meta charset=UTF-8 />
    <script src="js/jquery.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="amazeui/css/amazeui.flat.css" rel="stylesheet" type="text/css">
    <link href="assets/css/style.css" rel="stylesheet" />
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
<!--    <script type="text/javascript">
        jQuery(document).ready(function ($) {
            $(".scroll").click(function (event) {
                event.preventDefault();
                $('html,body').animate({scrollTop: $(this.hash).offset().top}, 1000);
            });
        });
    </script>-->
    <script type="text/javascript" src="js/jquery.jscrollpane.min.js"></script>
    <script type="text/javascript" id="sourcecode">
        $(function () {
            $('.scroll-pane').jScrollPane();
        });
    </script>
</head>
<body>
<div class="header" style="background-image:url('images/alpha.jpg')">
    <div class="container">
        <div class="logo invisible">
            <a href="index.php"><img src="images/logo.png" alt=""></a>
        </div>
        <div class="menu">
            <ul class="menu-top">
                <li><img src="" id="bar_useravator"></li>
                <li><a class="play-icon popup-with-zoom-anim" id="bar_username"  >Username</a></li>

            </ul>
            <!---pop-up-box---->
            <script type="text/javascript" src="js/modernizr.custom.min.js"></script>
            <link href="css/popuo-box.css" rel="stylesheet" type="text/css" media="all"/>
            <script src="js/jquery.magnific-popup.js" type="text/javascript"></script>
            <!---//pop-up-box---->


            <a href="#" class="right_bt" id="activator"><img src="images/nav.png" alt=""/></a>

            <div class="box" id="box">
                <div class="box_content_center">
                    <div class="menu_box_list">
                        <ul>
                            <li><a href="#" onclick="Logout()" class="scroll">退出登录</a></li>
                            <li><a href="#" onclick="Profilejump()" class="scroll">订餐页面</a></li>
                            <li><a href="#" class="scroll">修改资料</a></li>
                        </ul>
                    </div>
                    <a class="boxclose" id="boxclose"><img src="images/close.png" alt=""/></a>
                </div>
            </div>
            <script type="text/javascript" src="js/easing.js"></script>

        </div>

        <div class="lab">


            <div class="box1">

                <div class="menu">
                    <h1 class="greetings">
                        Bonjour,Chers Amis~
                    </h1>

                </div>

            </div>
            <div class="box2">

                <div class="rank">
                    <h1 class="ranktitle" >Like Rank</h1>
                    <div class="ranktable">
                        <div class="rankrow">
                            <p class="col1">
                                Rank.1
                            </p>
                            <p class="col2">
                                aaaa
                            </p>
                        </div>

                        <div class="rankrow">
                            <p class="col1">
                                Rank.2
                            </p>
                            <p class="col2">
                                bbbb
                            </p>
                        </div>
                    </div>
                </div>


            </div>




            <div class="box3">



                <input class="control-button"  onclick="Confirm(this)" id="confirm-order" type="button" value="订餐">

            </div>



            <div class="box4">
                <div class="clock-area">
                    <div id="clock" class="dark">
                        <div class="display">
                            <div class="weekdays"></div>
                            <div class="ampm"></div>
                            <div class="digits"></div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>

<!--- Part 2 Starts Here --->

<div class="interduce">

</div>

<!--- Part 2 Ends Here --->


<!-- Footer Starts Here ---->
<div class="footer">
    <div class="container">
        <div class="logo invisible">
            <a href="index.php"><img src="images/f_logo.png" class="foot-img" alt=""></a>
        </div>
        <p class="footer-head">Produced By <a href="http://tumblr.com/">Team Apache</a></p>

        <div class="clearfix"></div>
    </div>

</div>
<!-- Footer Ends Here ---->


<script src="http://cdnjs.cloudflare.com/ajax/libs/moment.js/2.0.0/moment.min.js"></script>
<script src="assets/js/script.js"></script>
<script type="text/javascript">

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


        $("")
    });



</script>
</body>
</html>