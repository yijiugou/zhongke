<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="format-detection" content="telephone=no">
    <link rel="stylesheet" type="text/css" href="static/css/iconfont.css">
    <link rel="stylesheet" type="text/css" href="static/css/style.css">
    <link rel="stylesheet" type="text/css" href="static/css/responsive.css">
    <script src="static/js/jquery.min.js"></script>

    <!--[if lt IE 9]>
        <script type="text/javascript" src="js/css3-mediaqueries.js"></script>
        <style type="text/css">
            html{ margin-left: 0 !important;}
        </style>
    <![endif]-->
    <title>
        四川中科赛亚生物科技有限公司
    </title>
    <meta name="keywords" content="四川中科赛亚生物科技有限公司">
    <meta name="description" content="四川中科赛亚生物科技有限公司">
    <meta name="author" content="四川中科赛亚生物科技有限公司">
    <meta name="Copyright" content="四川中科赛亚生物科技有限公司">
</head>
<?php
//prs($NET_SET['web_title']);



?>


<body>
    <!-- 头部start -->
    <header class="header">
        <div class="head-wrap clearfix">
            <h1 class="head-logo">
                <a href="">
                    <img src="static/picture/plogo.png" class="img1">
                    <!--<img src="images/mlogo.png" class="img2"/>-->
                </a>
            </h1>
            <nav class="nav clearfix">
                <ul class="yj-bot">
                    <?php
                    foreach($NET_SET['web_title'] as $row) {
                        ?>
                    <li><a href="<?php echo $row["url"]?>" target="_self" class="yj-link"><?php echo $row['title']?></a>
                    </li>
                    <?php
                    }
                    ?>


                </ul>
            </nav>
            <div class="headContact">
                <a href="#" class="hsearch"><i class="iconfont">&#xe629;</i></a>
            </div>
        </div>
    </header>
    <!-- 搜索框 -->
    <div class="searchBot clearfix">
        <div class="searchbox clearfix">
            <input type="text" placeholder="Search" id="searchs">
            <a href="javascript:void(0);" class="sbicon" id="submits"><i class="iconfont">&#xe629;</i></a>
        </div>
        <div class="closesearch"><i class="iconfont">&#xe608;</i></div>
    </div>
    <div class="menu-handler">
        <span></span>
    </div>
    <section class="menuBox" id="menuBox">
        <ul class="menuMoblie" id="menuMoblie">
            <?php
            foreach($NET_SET['web_title'] as $row) {
                $has_sub = isset($row['sub'])? 1:0;
                
            ?>
            <li><a href="<?php  if($has_sub ==0 ) echo $row["url"]; else echo 'javascript:;';?>"
                    class="nav-link"><?php echo $row['title']?><i class="nlicon"></i></a>
                <?php if(isset($row['sub'])):
                echo '<div class="subnav clearfix">';
                foreach($row['sub'] as $sub):
                ?>
                <p class="item"><a href="<?php echo $sub['url']?>"><?php echo $sub['title']?></a> </p>
                <?php
                endforeach;
            ?>

                <?php 
            echo '</div>';
            endif;?>
            </li>

            <?php
                }
            ?>
            <!-- <li><a href="javascript:;" class="nav-link">加入我们<i class="nlicon"></i></a>
                <div class="subnav clearfix">
                    <p class="item"><a href="javascript:;">工作生活</a> </p>
                    <p class="item"><a href="javascript:;">薪酬福利</a> </p>
                    <p class="item"><a href="javascript:;">人才招聘</a> </p>
                </div>
            </li> -->
        </ul>
        <!-- 语言切换 -->
        <div class="mlanguage">
            <a href="javascript:;" class="mltxt active">中文</a>
            <a href="javascript:;" class="mltxt">EN</a>
            <a href="javascript:void(0);" class="mltxt">हिन्दी</a>
        </div>
    </section>
    <!-- end -->
    <p class="mtop"></p>