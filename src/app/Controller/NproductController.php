<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/11
 * Time: 14:59
 */
App::uses('Controller', 'Controller');
class NproductController extends AppController{
    public $layout = "pc_new";
    public function service(){
        $params=array(
            'banner'=>'/img/yjkg/news8.jpg',
            'list'=>array(
                array(
                    'title'=>'易酒购（四川）电子商务有限公司',
                    'content'=>'<p style="text-indent:28px;">
	<span style="font-family:&quot;">易酒购（四川）电子商务有限公司是买原酒平台科技股份有限公司发起投资，以酒类</span><span style="font-family:Microsoft YaHei;">B2C+O2O</span><span style="font-family:&quot;">复合商业模式，实现酒企、消费者等参与各方的利益最大化。</span> 
</p>
<p style="text-indent:28px;">
	<span style="font-family:&quot;">易酒购坚持通过科学有效的品控方法，严格仔细的检验检测措施，背靠背的价值评定结果去保障消费者喝上“品质有保证、性价比最高”的酒水。</span> 
</p>
<p style="text-indent:28px;">
	<span style="font-family:&quot;">易酒购拥有经验丰富的职业品酒师和酿酒师团队，上架的每一款酒水都要经过至少三轮品鉴筛选，同时委托第三方专业的检验检测机构对每一款产品展开检验检测，对不符合平台品控标准的产品一律排除在外，确保消费者喝到的任何一杯白酒都能充分体验到白酒之美。</span> 
</p>
<p style="text-indent:28px;">
	<span style="font-family:&quot;">易酒购坚持不通过任何中间商或代理商，直接和全国白酒主要产区的原酒生产企业建立合作关系，借此免除一切中间环节，实现原酒企业通过易酒购服务平台，直接将产品到达消费者手中，以此降低消费者消费成本，确保消费者购买的每一瓶白酒都物有所值。</span> 
</p>
<p>
	<span style="font-family:&quot;">“易酒购”的目标：让百姓少花钱、买真酒、喝好酒</span> 
</p>
<p>
	<span style="font-family:&quot;">“易酒购”的特点：品质有保证、性价比最高</span> 
</p>
<p>
	<span style="font-family:&quot;">“易酒购”的愿景：打造中国第一民酒电商服务平台</span> 
</p>',
                    'image'=>['/upload/company/yjg1.jpg','/upload/company/yjg2.jpg'],
                    'url'=>'https://www.yijiugou.com'
                ),array(
                    'title'=>'买原酒平台科技股份有限公司（maiyuanjiu.com，简称“买原酒网”）',
                    'content'=>'<p style="text-indent:28px;">
	<span style="font-family:&quot;">买原酒平台科技股份有限公司是由易酒控股的实际控股公司联合多位互联网技术、市场运营、酒类专家共同创立，是一个基于中国白酒</span><span style="font-family:Microsoft YaHei;">·</span><span style="font-family:&quot;">原酒交易的采购执行商务平台。</span> 
</p>
<p style="text-indent:28px;">
	<span style="font-family:&quot;">买原酒网本着“服务优先、同生共荣”的服务理念，始终“专注白酒产业、服务中小酒企”为目标，以白酒领域的“价值评定、技术服务、撮合交易、供应链金融”为主体，以原酒使用者（企业及个体消费者）及原酒投资者为目标客户，通过线上线下相结合的手段打通酒企与酒企、酒企与个人相互之间的关系，以更有效、更便捷、更快速、更互联网化的方式为交易各方提供</span><span style="font-family:Microsoft YaHei;">360</span><span style="font-family:&quot;">°无死角的商务服务。</span> 
</p>
<p style="text-indent:28px;">
	<span style="font-family:&quot;">三年多来，买原酒网聚合超千家原酒企业和原酒采购商，并一以贯之的通过邀请国内外酒界知名专家开展“知识讲座、参观考察、分享交流”等活动，为买原酒网会员企业做好贴身服务，此举有效解决了交易双方的互不信任问题，使交易双方降低了交易成本，提升了企业产品竞争力。</span> 
</p>',
                    'image'=>['/upload/company/myj1.jpg','/upload/company/myj2.jpg'],
                    'url'=>'http://www.maiyuanjiu.com'
                ),array(
                    'title'=>'四川味工坊酒类平台科技有限公司',
                    'content'=>'<p style="text-indent:28px;">
	<span style="font-family:&quot;">味工坊酒类平台科技有限公司（</span><span style="font-family:Microsoft YaHei;">99wgf.com</span><span style="font-family:&quot;">是中国第一家“以酒为媒”，依托丰富“酒界泰斗、优质原酒、行业精英”等资源，致力于为高端商务人群打造集“资源、财富、信息”于一体的闭环式云共享“社交商务平台”。</span> 
</p>
<p style="text-indent:28px;">
	<span style="font-family:宋体;"><span style="font-family:Microsoft YaHei;">味工坊</span><span style="font-family:Microsoft YaHei;">在最适合酿造优质纯正蒸馏酒的生态区——中国白酒金三角产区，拥有强大的高端白酒研发团队和全国最大的原酒交易平台，有效保障了其产品无与伦比的高端品质。</span></span> 
</p>
<p style="text-indent:28px;">
	<span style="font-family:&quot;">味工坊在“买原酒网”、“北京东方黄埔白酒技术研究院”、“四川省酿酒研究所”、“四川省原酒质量鉴评中心”的支持下，精心打造以酿酒大师亲自调制的限量版“大师匠心”酒，或由酿酒大师亲自鉴评的“大师鉴评”酒，以及优选自白酒金三角产区的高品质“个性化定制”酒水。产品涵盖浓香、酱香、清香等</span><span style="font-family:Microsoft YaHei;">12</span><span style="font-family:&quot;">种香型。</span> 
</p>
<p style="text-indent:28px;">
	<span style="font-family:&quot;">味工坊将中国行政区域网格化为</span><span style="font-family:Microsoft YaHei;">3000</span><span style="font-family:&quot;">多个单位，并在这</span><span style="font-family:Microsoft YaHei;">3000</span><span style="font-family:&quot;">个单位对应选取</span><span style="font-family:Microsoft YaHei;">600</span><span style="font-family:&quot;">个相对发达的行政单位设立“味工坊·白酒体验馆”，为味工坊精英会员提供最优质的酒类产品和最有效的社交服务。</span> 
</p>',
                    'image'=>['/upload/company/wgf1.jpg','/upload/company/wgf2.jpg'],
                    'url'=>'http://99wgf.com'
                ),array(
                    'title'=>'易酒天成（上海）有限公司',
                    'content'=>'<p style="text-indent:28px;">
	<span style="font-family:宋体;"><span style="font-family:Microsoft YaHei;"></span><span style="font-family:Microsoft YaHei;">易酒天成（上海）有限公司（简称“易酒天成”）是在上海市浦东区所辖相关领导和部门的支持下，由上海经亦信息技术公司于</span></span><span style="font-family:Microsoft YaHei;">2017</span><span style="font-family:&quot;">年联合多家机构和天使投资人投资设立，是国内唯一专注于中国酒业发展，与酒企展开“股权合作、运营托管、供应链金融服务”的专业投资、管理和运营的综合类服务机构。</span> 
</p>
<p style="text-indent:28px;">
	<span style="font-family:&quot;">易酒天成坚持以“资源互换、利益共享”的合作原则，着力通过“引进资本、导入资源、做好市场”的方式，用积极的价值投资理念，即“用产业的眼光探寻中国酒业市场的价值，相对长期持有卓越的、最有潜力的区域性酒类领袖企业，分享企业持续成长带来的高收益”。</span> 
</p>
<p style="text-indent:28px;">
	<span style="font-family:&quot;">目前，易酒天成的行业研究和运营执行团队，堪称中国酒业最出色的精英团队之一，我们擅长研究和运营新时代快消品消费升级和新型的服务型企业，亦把合作重点放在区域内唯一目标企业上，同时兼顾可能被低估，但有潜力的区域市场内其它酒企的合作机会。</span> 
</p>',
                    'image'=>['/upload/company/yjtc1.jpg','/upload/company/yjtc2.jpg'],
                    'url'=>'#'
                ),array(
                    'title'=>'北京东方黄埔白酒技术研究院',
                    'content'=>'<p style="text-indent:28px;">
	<span style="font-family:宋体;"><span style="font-family:Microsoft YaHei;"></span><span style="font-family:Microsoft YaHei;">北京东方黄埔白酒技术研究院（</span></span><span style="font-family:Microsoft YaHei;">ohltr.com ,</span><span style="font-family:&quot;">简称“东方黄埔”）是在中国白酒金三角协会、四川省酿酒研究所等机构的支持下，由买原酒平台科技股份有限公司投资设立，以中国著名白酒专家杨官荣先生为首的白酒“</span><span style="font-family:Microsoft YaHei;">G</span><span style="font-family:&quot;">·</span><span style="font-family:Microsoft YaHei;">R</span><span style="font-family:&quot;">评分”团队为核心，以开展“产业研究、技术服务、技能培训”为业务方向的实战型技术研究院。</span> 
</p>
<p style="text-indent:28px;">
	<span style="font-family:&quot;">东方黄埔聚集国内顶尖“学术专家、酿酒大师、品酒大师、营销咨询大师、金融专家、资深管理专家”等一批专家学者。开展白酒产业发展研究、酿酒及勾调技术、酒类产品检验检测、酒企信息咨询等服务，并在中酒协的支持下组织实施“品酒师、酿酒师、营销师、高级经营管理者”的培训。</span> 
</p>
<p style="text-indent:28px;">
	<span style="font-family:&quot;">东方黄埔集“产业研究、酒体设计、检验检测、咨询服务”为一体。始终秉承“创新</span> <span style="font-family:&quot;">务实</span> <span style="font-family:&quot;">专业</span> <span style="font-family:&quot;">发展”的精神。目前除北京设立总部外，已在“上海、武汉、成都、宜宾、仁怀”等地建立了地方服务机构，以此更好的满足中国白酒产业发展需求，提高客户满意度，为实现白酒产业科学发展、和谐发展、率先发展作出积极贡献。</span> 
</p>',
                    'image'=>['/upload/company/dfhpyjy2.jpg','/upload/company/dfhpyjy1.jpg'],
                    'url'=>'http://www.ohltr.com'
                ),array(
                    'title'=>'北京华易蓝标营销服务有限公司',
                    'content'=>'<p style="text-indent:28px;">
	<span style="font-family:&quot;">华易蓝标营销服务有限公司（</span><span style="font-family:Microsoft YaHei;">huayilanb.com ,</span><span style="font-family:&quot;">简称“华易蓝标”）是一家具有“蓝色光标”等国内领先公关、咨询基因的，以专注酒类行业全产业链整合营销咨询的服务机构，团队主要来自国内顶尖公关、咨询、传媒行业。</span> 
</p>
<p style="text-indent:28px;">
	<span style="font-family:&quot;">华易蓝标成功将消费品类的“品牌传播、公关咨询、营销服务”等先进营销理念和品牌公关模式嫁接到酒类行业，并强势整合白酒上、下游产业链核心资源，此举不仅为企业提供智业服务，更为企业发展注入更为有效的产业资源，如“战略规划与产品开发、酿造与酒体设计、原酒交易与质量管控、品牌传播与营销执行、金融服务与产品保险”等，以此形成华易蓝标立足于酒类咨询行业的核心竞争力。</span> 
</p>
<p style="text-indent:28px;">
	<span style="font-family:宋体;"><span style="font-family:Microsoft YaHei;">华易蓝标</span><span style="font-family:Microsoft YaHei;">自成立以来，经过</span></span><span style="font-family:Microsoft YaHei;">3</span><span style="font-family:&quot;">年多的发展，团队先后服务了以“贵州茅台、湖北武当酒业、江西金庐陵酒业、贵州义酒坊酒业、江苏河川酒业、安徽扬子福酒业”等近</span><span style="font-family:Microsoft YaHei;">30</span><span style="font-family:&quot;">家酒水企业，并创造了一夜之间将整个县城“忽如一夜春风来，千树万树梨花开”的传播奇迹。</span> 
</p>',
                    'image'=>['/upload/company/hylbfu1.jpg','/upload/company/hylbfu2.jpg'],
                    'url'=>'http://www.huayilanb.com'
                ),array(
                    'title'=>'消费评论（四川）传媒有限公司',
                    'content'=>'<p style="text-indent:28px;">
	<span style="font-family:宋体;"><span style="font-family:Microsoft YaHei;"></span><span style="font-family:Microsoft YaHei;">消费评论（四川）传媒有限公司（简称：消费评论融媒体）是在“中国酒业协会文化委员会、中国白酒金三角协会、知音传媒集团股份有限公司，中国著名白酒大师季克良、高景炎、赖登燡、杨官荣等大师”在内的机构和专家的支持下创立。</span></span> 
</p>
<p style="text-indent:28px;">
	<span style="font-family:&quot;">消费评论融媒体独立运营“《消费评论》杂志、消费评论酒类新闻网、消费评论酒类融媒体”微信公众号。其中，《消费评论》杂志系知音传媒集团股份有限公司主管主办，《消费评论》编辑部编辑出版。国内统一刊号：</span><span style="font-family:Microsoft YaHei;">CN42-1894/F</span><span style="font-family:&quot;">，国际标准刊号：</span><span style="font-family:Microsoft YaHei;">ISSN 2095-4093</span><span style="font-family:&quot;">。</span> 
</p>
<p style="text-indent:28px;">
	<span style="font-family:&quot;">消费评论融媒体本着服务中国酒业，重塑酒类消费市场为目标，专注于国内酒类生产、流通及消费者之间的关系，一以贯之的坚持以引导和帮助酒类消费者实现“知酒、识酒、鉴酒”能力的创立使命。</span> 
</p>
<p style="text-indent:28px;">
	<span style="font-family:&quot;">消费评论融媒体自创立以来，先后与“北京东方黄埔白酒技术研究院、四川省酿酒研究所、百姓健康消费媒体联盟”成员媒体建立了良好的协作关系，此举有效的保障了消费评论融媒体服务中国酒业发展和消费者权益的初衷。</span> 
</p>',
                    'image'=>['/upload/company/xfpl1.jpg','/upload/company/xfpl2.jpg'],
                    'url'=>'http://www.xiaofeipinglun.cn'
                )
            )
        );
        foreach ($params['list'] as $k=>$item){
            $params['list'][$k]['content'] = preg_replace_callback(
                '/<script\b[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/i', // %24 = $
                function (&$matches) {
                    return '';
                },
                $item['content']
            );
        }
        $this->setpm($params);
        return $this->render();
    }
}