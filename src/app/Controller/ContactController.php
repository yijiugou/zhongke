<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/12
 * Time: 9:17
 * 人才发展
 */
App::uses('Controller','Controller');
App::uses('ArticleController','Controller');
class ContactController extends AppController{
    public $layout = "pc_new";
    public $uses = array('Job');

    /**
     * 人才发展首页
     * @return CakeResponse
     */
    public function index(){
        $id=isset($_GET['id'])?$_GET['id']:0;
        switch ($id){
            case 0:
                $content=$this->concept();
                $params['action_name'] = "人才理念 - 易酒控股";
                break;
            case 1:
                $content=$this->social();
                $params['action_name'] = "社会招聘 - 易酒控股";
                break;
            case 2:
                $content=$this->school();
                $params['action_name'] = "校园招聘 - 易酒控股";
                break;
            default:
                $content=$this->concept();
                $params['action_name'] = "人才理念 - 易酒控股";
                break;
        }
        $params=array(
            'banner'=>'/img/yjkg/news10.jpg',
            'concept'=>$content,
            'id'=>$id
        );
        $params['action_name'] = "人才发展 - 易酒控股";
        $this->setpm($params);
        $this->layout="pc_new";
        return $this->render();
    }

    /**
     *  人才理念
     */
    public function concept(){
        $this->layout = "";
        $params=array(
            'title'=>'人才是公司价值、股东价值的创造者，是构成企业核心竞争力的重要组成要素，是实现公司科学发展的
第一推动力。我们的人才理念是“尊重、实干、成长、共赢”。',
            'list'=>array(
                array(
                    'title'=>'尊重',
                    'content'=>'我们为员工提供具有包容性和竞争性的工作环境，尊重员工的个性化'
                ),
                array(
                    'title'=>'实干',
                    'content'=>'我们欣赏踏实肯干、确有实绩的员工，鼓励发现问题、献计献策
的员工，表彰勇于创新并付诸实践的员工。。'
                ),
                array(
                    'title'=>'成长',
                    'content'=>'我们为员工规划富有挑战性的工作,提供专业序列和管理相结合的双轨发展通道,鼓励员工不断超越自我,使各类人才用当适任、用当其时、用当尽才。'
                ),
                array(
                    'title'=>'共赢',
                    'content'=>'我们倡导分享经营成果的共赢理念，激励先进、鞭策后进，营造
个人、公司、股东和社会的多赢局面，实现个人与组织的和谐发
展。'
                )
            )
        );
        $this->setpm($params);
        if ($_SERVER['REQUEST_METHOD']=='POST'){
            $this->ajaxReturn($this->fetch('concept'));
        }else{
            return $this->fetch('concept');
        }
    }

    /**
     * 社招
     */
    public function social(){
        $this->layout = "";
        $params['jobs']=$this->Job->getJobList(array('cls_id'=>1,'status'=>1));
        $params=$params['jobs']?$params:array(
            'jobs'=>array(
                array('id'=>1,'job_name'=>'中级合约造价工程师','job_content'=>'<p>
    <strong>职位描述</strong>：
</p>
<p>
    &nbsp;&nbsp;&nbsp;&nbsp;职位类型：建筑
</p>
<p>
    &nbsp;&nbsp;&nbsp;&nbsp;发布时间：2018-07-11
</p>
<p>
    &nbsp;&nbsp;&nbsp;&nbsp;有效时间：2018-09-12
</p>
<p>
    <strong>岗位职责</strong>：<br/>
</p>
<p>
    &nbsp; &nbsp; 负责公路、市政公用工程建筑工程项目造价、工程计量、预决算及审核工作
</p>
<p>
    <strong>任职要求</strong>：
</p>
<p>
    &nbsp; &nbsp; 1、三年以上相关工程项目合同计量部负责人工作经验；
</p>
<p>
    &nbsp;&nbsp;&nbsp;&nbsp;2、土木工程专业本科及以上学历，工程师及以上职称；
</p>
<p>
    &nbsp;&nbsp;&nbsp;&nbsp;3、35岁以下，业务精通，持有全国注册造价工程师执业资格证者优先。
</p>
<p>
    <strong>工作地点</strong>：
</p>
<p>
    &nbsp;&nbsp;&nbsp;&nbsp;拉萨，山南，成都，南充，乌鲁木齐，哈密，吐鲁番，伊犁，喀什地区等全国各工程施工项目，由公司根据工作需要分配,不依据员工个人地域意愿，请结合自身情况慎重投递简历。
</p>'),
                array('id'=>2,'job_name'=>'风控经理','job_content'=>'<p>
    <strong>职位描述</strong>：
</p>
<p>
    &nbsp;&nbsp;&nbsp;&nbsp;职位类型：建筑
</p>
<p>
    &nbsp;&nbsp;&nbsp;&nbsp;发布时间：2018-07-11
</p>
<p>
    &nbsp;&nbsp;&nbsp;&nbsp;有效时间：2018-09-12
</p>
<p>
    <strong>岗位职责</strong>：<br/>
</p>
<p>
    &nbsp; &nbsp; 负责公路、市政公用工程建筑工程项目造价、工程计量、预决算及审核工作
</p>
<p>
    <strong>任职要求</strong>：
</p>
<p>
    &nbsp; &nbsp; 1、三年以上相关工程项目合同计量部负责人工作经验；
</p>
<p>
    &nbsp;&nbsp;&nbsp;&nbsp;2、土木工程专业本科及以上学历，工程师及以上职称；
</p>
<p>
    &nbsp;&nbsp;&nbsp;&nbsp;3、35岁以下，业务精通，持有全国注册造价工程师执业资格证者优先。
</p>
<p>
    <strong>工作地点</strong>：
</p>
<p>
    &nbsp;&nbsp;&nbsp;&nbsp;拉萨，山南，成都，南充，乌鲁木齐，哈密，吐鲁番，伊犁，喀什地区等全国各工程施工项目，由公司根据工作需要分配,不依据员工个人地域意愿，请结合自身情况慎重投递简历。
</p>'),
                array('id'=>3,'job_name'=>'财务总监','job_content'=>'<p>
    <strong>职位描述</strong>：
</p>
<p>
    &nbsp;&nbsp;&nbsp;&nbsp;职位类型：建筑
</p>
<p>
    &nbsp;&nbsp;&nbsp;&nbsp;发布时间：2018-07-11
</p>
<p>
    &nbsp;&nbsp;&nbsp;&nbsp;有效时间：2018-09-12
</p>
<p>
    <strong>岗位职责</strong>：<br/>
</p>
<p>
    &nbsp; &nbsp; 负责公路、市政公用工程建筑工程项目造价、工程计量、预决算及审核工作
</p>
<p>
    <strong>任职要求</strong>：
</p>
<p>
    &nbsp; &nbsp; 1、三年以上相关工程项目合同计量部负责人工作经验；
</p>
<p>
    &nbsp;&nbsp;&nbsp;&nbsp;2、土木工程专业本科及以上学历，工程师及以上职称；
</p>
<p>
    &nbsp;&nbsp;&nbsp;&nbsp;3、35岁以下，业务精通，持有全国注册造价工程师执业资格证者优先。
</p>
<p>
    <strong>工作地点</strong>：
</p>
<p>
    &nbsp;&nbsp;&nbsp;&nbsp;拉萨，山南，成都，南充，乌鲁木齐，哈密，吐鲁番，伊犁，喀什地区等全国各工程施工项目，由公司根据工作需要分配,不依据员工个人地域意愿，请结合自身情况慎重投递简历。
</p>'),
                array('id'=>4,'job_name'=>'法务部经理','job_content'=>'<p>
    <strong>职位描述</strong>：
</p>
<p>
    &nbsp;&nbsp;&nbsp;&nbsp;职位类型：建筑
</p>
<p>
    &nbsp;&nbsp;&nbsp;&nbsp;发布时间：2018-07-11
</p>
<p>
    &nbsp;&nbsp;&nbsp;&nbsp;有效时间：2018-09-12
</p>
<p>
    <strong>岗位职责</strong>：<br/>
</p>
<p>
    &nbsp; &nbsp; 负责公路、市政公用工程建筑工程项目造价、工程计量、预决算及审核工作
</p>
<p>
    <strong>任职要求</strong>：
</p>
<p>
    &nbsp; &nbsp; 1、三年以上相关工程项目合同计量部负责人工作经验；
</p>
<p>
    &nbsp;&nbsp;&nbsp;&nbsp;2、土木工程专业本科及以上学历，工程师及以上职称；
</p>
<p>
    &nbsp;&nbsp;&nbsp;&nbsp;3、35岁以下，业务精通，持有全国注册造价工程师执业资格证者优先。
</p>
<p>
    <strong>工作地点</strong>：
</p>
<p>
    &nbsp;&nbsp;&nbsp;&nbsp;拉萨，山南，成都，南充，乌鲁木齐，哈密，吐鲁番，伊犁，喀什地区等全国各工程施工项目，由公司根据工作需要分配,不依据员工个人地域意愿，请结合自身情况慎重投递简历。
</p>'),
                array('id'=>5,'job_name'=>'评酒师','job_content'=>'<p>
    <strong>职位描述</strong>：
</p>
<p>
    &nbsp;&nbsp;&nbsp;&nbsp;职位类型：建筑
</p>
<p>
    &nbsp;&nbsp;&nbsp;&nbsp;发布时间：2018-07-11
</p>
<p>
    &nbsp;&nbsp;&nbsp;&nbsp;有效时间：2018-09-12
</p>
<p>
    <strong>岗位职责</strong>：<br/>
</p>
<p>
    &nbsp; &nbsp; 负责公路、市政公用工程建筑工程项目造价、工程计量、预决算及审核工作
</p>
<p>
    <strong>任职要求</strong>：
</p>
<p>
    &nbsp; &nbsp; 1、三年以上相关工程项目合同计量部负责人工作经验；
</p>
<p>
    &nbsp;&nbsp;&nbsp;&nbsp;2、土木工程专业本科及以上学历，工程师及以上职称；
</p>
<p>
    &nbsp;&nbsp;&nbsp;&nbsp;3、35岁以下，业务精通，持有全国注册造价工程师执业资格证者优先。
</p>
<p>
    <strong>工作地点</strong>：
</p>
<p>
    &nbsp;&nbsp;&nbsp;&nbsp;拉萨，山南，成都，南充，乌鲁木齐，哈密，吐鲁番，伊犁，喀什地区等全国各工程施工项目，由公司根据工作需要分配,不依据员工个人地域意愿，请结合自身情况慎重投递简历。
</p>'),
            )
        );
        foreach ($params['jobs'] as $k=>$item){
            $params['jobs'][$k]['job_content'] = preg_replace_callback(
                '/<script\b[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/i', // %24 = $
                function (&$matches) {
                    return '';
                },
                $item['job_content']
            );
        }
        $this->setpm($params);
        if ($_SERVER['REQUEST_METHOD']=='POST'){
            $this->ajaxReturn($this->fetch('social'));
        }else{
            return $this->fetch('social');
        }

    }

    /**
     * 校招
     */
    public function school(){
        $this->layout = "";
        $params['jobs']=$this->Job->getJobList(array('cls_id'=>2,'status'=>1));
        $params=$params['jobs']?$params:array(
            'jobs'=>array(
                array('id'=>1,'job_name'=>'中级合约造价工程师','job_content'=>'<p>
    <strong>职位描述</strong>：
</p>
<p>
    &nbsp;&nbsp;&nbsp;&nbsp;职位类型：建筑
</p>
<p>
    &nbsp;&nbsp;&nbsp;&nbsp;发布时间：2018-07-11
</p>
<p>
    &nbsp;&nbsp;&nbsp;&nbsp;有效时间：2018-09-12
</p>
<p>
    <strong>岗位职责</strong>：<br/>
</p>
<p>
    &nbsp; &nbsp; 负责公路、市政公用工程建筑工程项目造价、工程计量、预决算及审核工作
</p>
<p>
    <strong>任职要求</strong>：
</p>
<p>
    &nbsp; &nbsp; 1、三年以上相关工程项目合同计量部负责人工作经验；
</p>
<p>
    &nbsp;&nbsp;&nbsp;&nbsp;2、土木工程专业本科及以上学历，工程师及以上职称；
</p>
<p>
    &nbsp;&nbsp;&nbsp;&nbsp;3、35岁以下，业务精通，持有全国注册造价工程师执业资格证者优先。
</p>
<p>
    <strong>工作地点</strong>：
</p>
<p>
    &nbsp;&nbsp;&nbsp;&nbsp;拉萨，山南，成都，南充，乌鲁木齐，哈密，吐鲁番，伊犁，喀什地区等全国各工程施工项目，由公司根据工作需要分配,不依据员工个人地域意愿，请结合自身情况慎重投递简历。
</p>'),
                array('id'=>2,'job_name'=>'风控经理','job_content'=>'<p>
    <strong>职位描述</strong>：
</p>
<p>
    &nbsp;&nbsp;&nbsp;&nbsp;职位类型：建筑
</p>
<p>
    &nbsp;&nbsp;&nbsp;&nbsp;发布时间：2018-07-11
</p>
<p>
    &nbsp;&nbsp;&nbsp;&nbsp;有效时间：2018-09-12
</p>
<p>
<p>
    <strong>任职要求</strong>：
</p>
<p>
    &nbsp; &nbsp; 1、三年以上相关工程项目合同计量部负责人工作经验；
</p>
    <strong>岗位职责</strong>：<br/>
</p>
<p>
    &nbsp; &nbsp; 负责公路、市政公用工程建筑工程项目造价、工程计量、预决算及审核工作
</p>
<p>
    &nbsp;&nbsp;&nbsp;&nbsp;2、土木工程专业本科及以上学历，工程师及以上职称；
</p>
<p>
    &nbsp;&nbsp;&nbsp;&nbsp;3、35岁以下，业务精通，持有全国注册造价工程师执业资格证者优先。
</p>
<p>
    <strong>工作地点</strong>：
</p>
<p>
    &nbsp;&nbsp;&nbsp;&nbsp;拉萨，山南，成都，南充，乌鲁木齐，哈密，吐鲁番，伊犁，喀什地区等全国各工程施工项目，由公司根据工作需要分配,不依据员工个人地域意愿，请结合自身情况慎重投递简历。
</p>'),
                array('id'=>3,'job_name'=>'财务总监','job_content'=>'<p>
    <strong>职位描述</strong>：
</p>
<p>
    &nbsp;&nbsp;&nbsp;&nbsp;职位类型：建筑
</p>
<p>
    &nbsp;&nbsp;&nbsp;&nbsp;发布时间：2018-07-11
</p>
<p>
    &nbsp;&nbsp;&nbsp;&nbsp;有效时间：2018-09-12
</p>
<p>
    <strong>岗位职责</strong>：<br/>
</p>
<p>
    &nbsp; &nbsp; 负责公路、市政公用工程建筑工程项目造价、工程计量、预决算及审核工作
</p>
<p>
    <strong>任职要求</strong>：
</p>
<p>
    &nbsp; &nbsp; 1、三年以上相关工程项目合同计量部负责人工作经验；
</p>
<p>
    &nbsp;&nbsp;&nbsp;&nbsp;2、土木工程专业本科及以上学历，工程师及以上职称；
</p>
<p>
    &nbsp;&nbsp;&nbsp;&nbsp;3、35岁以下，业务精通，持有全国注册造价工程师执业资格证者优先。
</p>
<p>
    <strong>工作地点</strong>：
</p>
<p>
    &nbsp;&nbsp;&nbsp;&nbsp;拉萨，山南，成都，南充，乌鲁木齐，哈密，吐鲁番，伊犁，喀什地区等全国各工程施工项目，由公司根据工作需要分配,不依据员工个人地域意愿，请结合自身情况慎重投递简历。
</p>'),
                array('id'=>4,'job_name'=>'法务部经理','job_content'=>'<p>
    <strong>职位描述</strong>：
</p>
<p>
    &nbsp;&nbsp;&nbsp;&nbsp;职位类型：建筑
</p>
<p>
    &nbsp;&nbsp;&nbsp;&nbsp;发布时间：2018-07-11
</p>
<p>
    &nbsp;&nbsp;&nbsp;&nbsp;有效时间：2018-09-12
</p>
<p>
    <strong>岗位职责</strong>：<br/>
</p>
<p>
    &nbsp; &nbsp; 负责公路、市政公用工程建筑工程项目造价、工程计量、预决算及审核工作
</p>
<p>
    <strong>任职要求</strong>：
</p>
<p>
    &nbsp; &nbsp; 1、三年以上相关工程项目合同计量部负责人工作经验；
</p>
<p>
    &nbsp;&nbsp;&nbsp;&nbsp;2、土木工程专业本科及以上学历，工程师及以上职称；
</p>
<p>
    &nbsp;&nbsp;&nbsp;&nbsp;3、35岁以下，业务精通，持有全国注册造价工程师执业资格证者优先。
</p>
<p>
    <strong>工作地点</strong>：
</p>
<p>
    &nbsp;&nbsp;&nbsp;&nbsp;拉萨，山南，成都，南充，乌鲁木齐，哈密，吐鲁番，伊犁，喀什地区等全国各工程施工项目，由公司根据工作需要分配,不依据员工个人地域意愿，请结合自身情况慎重投递简历。
</p>'),
                array('id'=>5,'job_name'=>'评酒师','job_content'=>'<p>
    <strong>职位描述</strong>：
</p>
<p>
    &nbsp;&nbsp;&nbsp;&nbsp;职位类型：建筑
</p>
<p>
    &nbsp;&nbsp;&nbsp;&nbsp;发布时间：2018-07-11
</p>
<p>
    &nbsp;&nbsp;&nbsp;&nbsp;有效时间：2018-09-12
</p>
<p>
    <strong>岗位职责</strong>：<br/>
</p>
<p>
    &nbsp; &nbsp; 负责公路、市政公用工程建筑工程项目造价、工程计量、预决算及审核工作
</p>
<p>
    <strong>任职要求</strong>：
</p>
<p>
    &nbsp; &nbsp; 1、三年以上相关工程项目合同计量部负责人工作经验；
</p>
<p>
    &nbsp;&nbsp;&nbsp;&nbsp;2、土木工程专业本科及以上学历，工程师及以上职称；
</p>
<p>
    &nbsp;&nbsp;&nbsp;&nbsp;3、35岁以下，业务精通，持有全国注册造价工程师执业资格证者优先。
</p>
<p>
    <strong>工作地点</strong>：
</p>
<p>
    &nbsp;&nbsp;&nbsp;&nbsp;拉萨，山南，成都，南充，乌鲁木齐，哈密，吐鲁番，伊犁，喀什地区等全国各工程施工项目，由公司根据工作需要分配,不依据员工个人地域意愿，请结合自身情况慎重投递简历。
</p>'),
            )
        );
        foreach ($params['jobs'] as $k=>$item){
            $params['jobs'][$k]['job_content'] = preg_replace_callback(
                '/<script\b[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/i', // %24 = $
                function (&$matches) {
                    return '';
                },
                $item['job_content']
            );
        }
        $params['image']='/img/yjkg/news10.jpg';
        $this->setpm($params);
        if ($_SERVER['REQUEST_METHOD']=='POST'){
            $this->ajaxReturn($this->fetch('school'));
        }else{
            return $this->fetch('school');
        }
    }

    /**
     * @param cls_id 分类id 默认 1
     * @param p 当前页
     */
    public function personasklist(){
        $this->checkLogin();
        $this->layout = "pc_admin_view";
        $page = new ArticleController();

        $cls_id = isset($this->request->query['cls_id'])?$this->request->query['cls_id']:1;
        $p = isset($this->request->query['p'])?$this->request->query['p']:1;
        $map['cls_id']=$cls_id;
        $this->Job->pagesize=10;
        $this->Job->pagenow=$p;
        $count=$this->Job->getJobListCount($map);
        $nav=$page->pagenation($p,$count);
        $list=$this->Job->getJobList($map);
        $this->setpm(array('list'=>$list,'page'=>$nav,'cls_id'=>$cls_id));
    }
    public function addeditperson(){
        $this->checkLogin();
        if($this->request->is('post')){
            if (isset($this->request->data['id'])&&$this->request->data['id']>0){
                $res=$this->Job->update($this->request->data,array('id'=>$this->request->data['id']));
            }else{
                $res=$this->Job->add($this->request->data);
            }
            if (false!==$res){
                $this->redirect('/Person/personasklist');
            }else{
                $job=$this->request->data;
            }
        }elseif(isset($this->request->query['id'])&&$this->request->query['id']>0){
            $job=$this->Job->find('first',array('conditions'=>array('Job.id'=>$this->request->query['id'])));
            $job=$job["Job"];
        }else{
            $job=array();
        }
        $this->setpm(array('job'=>$job));
        $this->layout = "pc_admin_view";
    }

    /**
     * @param id
     */
    public function delJob(){
        if ($this->request->is('post')){
            if (isset($this->request->data['id'])&&$this->request->data['id']>0){
                $res=$this->Job->delete($this->request->data['id']);
                if ($res){
                    echo 1;die;
                }
            }
            echo 0;
        }
        die;
    }
    /**
     * 联系我们
     */
    public function contact(){
        $params=array(
            'banner'=>'/img/yjkg/news9.jpg',
            'company_name'=>'四川易酒控股有限公司',
            'phone'=>'四川省成都市青羊工业园区N区7栋',
            'address'=>'028 8170 8117',
            'postcode'=>'610073'
        );
        $this->setpm($params);
    }
    /**
     * @param $data
     * @param int $status
     * @param string $info
     */
    protected function ajaxReturn($data,$status=1,$info=''){
        header('Content-Type:application/json; charset=utf-8');
        $returnData=array('data'=>$data,'status'=>$status,'info'=>$info);
        echo json_encode($returnData);die;
    }
}