var oldP = 1,
    cate_id = parseInt($("#cate_id").val()),
    total = 0,
    pStr = "";

function getData(t, a) {
    $.ajax({ url: "/ajaxapp/getNewsList", type: "POST", dataType: "json", data: { id: t, pageIndex: a, pageSize: 10, sort:"pubdate"} }).done(function(t) {
        var i = "";
        total = t.total, t.data.length < parseInt(t.pageSize) ? $(".moreNews").hide() : $(".moreNews").show(), t.data.length < 1 && parseInt(t.pageIndex) == 1 ? ($(".pagenation").hide(), $(".nodata").show()) : ($(".pagenation").show(), $(".nodata").hide()), $.each(t.data, function(t, a) { i += '<div class="qywh"><div class="qywh_img"><div class="nextCont"><img src="' + (iSnull(a.pic_01) ? "/img/yjkg/newsdefault.jpg" : a.pic_01) + '"></div></div><div class="qywh_text"><div class="txtWrap"><div class="titBig">' + a.title + '</div><div class="titMall"><div class="titMall_con">' + a.sub_title + '</div><div class="titMall_time">' + subTime(a.pubdate, 8, 10) + '</div></div><div class="titMall_mon">' + subTime(a.pubdate, 0, 7) + '</div><div class="titBtn"><a href="/index/detail?id=' + a.id + "&tabID=" + cate_id + '" title="" target="_blank">查看详情</a></div></div></div></div>' }), $(".news_dsj_con").append(i)
    }).fail(function(t) { layer.msg("服务器内部错误!") }).always(function() {})
}
$(function() {
    getData(cate_id, oldP), $(".jaxGetMore").on("click", function(t) { t.preventDefault(), total <= oldP || getData(cate_id, ++oldP) }), $(".page_prev").on("click", function(t) { t.preventDefault(), oldP <= 1 || getData(cate_id, --oldP) }), $(".tabc").on("click", function(t) {
        t.preventDefault();
        var a = parseInt($(this).attr("data-id"));
        if (a !== cate_id) { $(".news_dsj_con").empty() };
        a !== cate_id && ($(".tabc").removeClass("active"), $(this).addClass("active"), getData(cate_id = a, oldP = 1))
    })
});