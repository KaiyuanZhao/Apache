<?php
require "entity/User.php";
session_start();
if (!isset($_SESSION["user"])) {
    header("location: ./index.php");
} else {
    if ($_SESSION["user"]->email == "1234@baixing.com") {
        header("location: ./superuser.php");
    }
}
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Après-midi</title>
    <meta charset=UTF-8/>
    <script src="js/jquery.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="amazeui/css/amazeui.flat.css" rel="stylesheet" type="text/css">
    <link href="assets/css/style.css" rel="stylesheet"/>
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
                <li><img src="http://192.168.100.53/submit/<?php echo $_SESSION['user']->icon; ?>" class="avator"></li>
                <li><a class="play-icon popup-with-zoom-anim"
                       id="bar_username"><?php echo $username = $_SESSION["user"]->username; ?></a></li>

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
                            <li><a href="#" class="scroll">订餐页面</a></li>
                            <li><a href="./profile.php" onclick="Profile()" class="scroll">修改资料</a></li>
                            <li><a href="./password.php" class="scroll">修改密码</a></li>
                        </ul>
                    </div>
                    <a class="boxclose" id="boxclose"><img src="images/close.png" alt=""/></a>
                </div>
            </div>
            <script type="text/javascript" src="js/easing.js"></script>

        </div>

        <div class="lab">


            <div class="box1">

                <div class="today-menu">
                    <div class="greetings">
                        Bonjour,Chers Amis~
                    </div>
                    <div id="today-slogan">
                        <p class="slogan-area">

                            Of all the gin joints in all the towns in all the world，she walks into mine.  From
                            Casablanca
                        </p>


                    </div>

                    <div class="todaymeal-area">
                    </div>
                    <script>
                        $(document).ready(function () {
                            $.post("submit/getTodayMeals.php", {}, function (data, status) {
                                if (data.success) {
                                    if (data.meals == null) {
                                        var obj = $("<div></div>").innerHTML = "<div id='today-meal'>今天的加班餐:<br>" + "还没有发布噢~</div>";
                                    }
                                    else {
                                        var obj = $("<div></div>").innerHTML = "<div id='today-meal'>今天的加班餐:<br>" + data.meals[0].mealName + "</div>";
                                    }
                                    $(".todaymeal-area").append(obj);
                                }
                                else {
                                    alert("error!");
                                }
                            }, "json");

                        });


                    </script>

                </div>

            </div>
            <div class="box2">

                <div class="rank">
                    <h1 class="ranktitle">Like Rank</h1>

                    <div class="ranktable">
                        <div class="r0 r">
                            <div class="col00 col0"></div>
                            <div class="col01 col1"></div>
                        </div>
                        <div class="r1 r">
                            <div class="col10 col0"></div>
                            <div class="col11 col1"></div>
                        </div>
                        <div class="r2 r">
                            <div class="col20 col0"></div>
                            <div class="col21 col1"></div>
                        </div>
                        <div class="r3 r">
                            <div class="col30 col0"></div>
                            <div class="col31 col1"></div>
                        </div>
                        <div class="r4 r">
                            <div class="col40 col0"></div>
                            <div class="col41 col1"></div>
                        </div>
                        <div class="r5 r">
                            <div class="col50 col0"></div>
                            <div class="col51 col1"></div>
                        </div>
                        <div class="r6 r">
                            <div class="col60 col0"></div>
                            <div class="col61 col1"></div>
                        </div>
                        <div class="r7 r">
                            <div class="col70 col0"></div>
                            <div class="col71 col1"></div>
                        </div>
                        <div class="r8 r">
                            <div class="col80 col0"></div>
                            <div class="col81 col1"></div>
                        </div>
                        <div class="r9 r">
                            <div class="col90 col0"></div>
                            <div class="col91 col1"></div>
                        </div>

                        <script>
                            $(document).ready(function () {
                                /* var r1=["a","b"];
                                 var r2=["a","b"];
                                 var r3=["a","b"];
                                 var r4=["a","b"];
                                 var r5=["a","b"];
                                 var r6=["a","b"];
                                 var r7=["a","b"];
                                 var r8=["a","b"];
                                 var r9=["a","b"];
                                 var r10=["a","b"];
                                 var arr=[r1,r2,r3,r4,r5,r6,r7,r8,r9,r10];
                                 var length=arr.length;
                                 var obj;
                                 var count=0;
                                 arr.forEach(function(val){
                                 var col0=$("<p></p>").innerHTML=val[0];
                                 var col1=$("<p></p>").innerHTML=val[1];

                                 $(".col"+count.toString()+"0").append(col0);
                                 $(".col"+count.toString()+"1").append(col1);
                                 count++;
                                 });*/
                                $.post("submit/getTopTen.php", {}, function (data, status) {
                                    if (data.success) {/*
                                     var tr1=$("<p></p>").text(data.meals[0].meal.mealName);
                                     var tr2=$("<p></p>").text(data.meals[0].favorCount);
                                     $("#anchor").append(tr1);
                                     $("#anchor").append(tr2);
                                     */
                                        var count = 0;
                                        var Arr = data.meals;
                                        Arr.forEach(function (e) {
                                            var col0 = $("<p></p>").innerHTML = e.meal.mealName;
                                            var col1 = $("<p></p>").innerHTML = e.favorCount.toString() + "个赞";
                                            $(".col" + count.toString() + "0").append(col0);
                                            $(".col" + count.toString() + "1").append(col1);
                                            count++;
                                        })
                                    }
                                    else {
                                        alert("error!");
                                    }
                                }, "json");

                            });


                        </script>
                    </div>

                </div>


            </div>


            <div class="box3">


                <input class="control-button" onclick="Confirm(this)" id="confirm-order" value="" type="button">


                <input class="like-button" onclick="Favourite()" id="favourite" type="button" value="赞一个">

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

    $(document).ready(function () {
        $.post("submit/isOrdered.php", {}, function (data, status) {
            if (data.success) {
                $("#confirm-order").val("确认订餐");
            }
            else {
                $("#confirm-order").val("取消订餐");
            }

        }, "json");
        /*
         alert(myDate.getHours());*/

        $.post("submit/isLiked.php", {}, function (data, status) {
            if (data.success || $("#confirm-order").val() == "确认订餐") {
                $("#favourite").val("点个赞");
            }
            else {
                $("#favourite").val("取消赞");
            }


        }, "json");


    });


</script>
</body>
</html>