<link rel="stylesheet" href="/css/yjkg/rc.css" />
<script src="http://api.map.baidu.com/api?v=2.0&ak=A1LU7iHS0avqQwPLAxbhKn0UYSQCuRVH"></script>
<script src="http://www.jq22.com/jquery/jquery-1.10.2.js"></script>
<img class="banner" src="<?php echo $banner;?>" alt="">
<div class="contact-con-main">
    <div class="mess-con">
        <h3><?php echo $company_name;?></h3>
        <!--<p><?php echo $company_name;?></p>-->
        <p>地址：<?php echo $address;?></p>
        <p>电话：<?php echo $phone;?></p>
        <p>邮编：<?php echo $postcode;?></p>
    </div>
    <div id="map-container">

    </div>
</div>
<script>
    var map = new BMap.Map("map-container");          // 创建地图实例
    var point = new BMap.Point(103.9627224917,30.6867090478);  // 创建点坐标
    map.centerAndZoom(point, 20);// 初始化地图，设置中心点坐标和地图级别
    map.enableScrollWheelZoom(true);     //开启鼠标滚轮缩放
    var marker = new BMap.Marker(point);        // 创建标注
    map.addOverlay(marker);
    var opts = {
        width : 231,     // 信息窗口宽度
        height: 70,     // 信息窗口高度
        title : "四川易酒控股有限公司"  // 信息窗口标题
    }
    var infoWindow = new BMap.InfoWindow("四川省成都市青羊工业园区N区7栋", opts);  // 创建信息窗口对象
    map.openInfoWindow(infoWindow, map.getCenter());      // 打开信息窗口
</script>