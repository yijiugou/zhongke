<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/2
 * Time: 11:20
 */

App::uses('Controller', 'Controller');
class XfplController  extends AppController {
    public $uses = array('Category', 'Articles',"Products","GrUser","Tuijian",'Comment');
    public $layout = "pc_new";
    public $pagesize=10;
    public function xfgc($cate_id = 0,$action_name='') {
        $params['action_name'] = $action_name?:"消费评论 - 消费观察";
        $parent_id=isset($_GET['p_id'])?intval($_GET['p_id']):1;
        $pagenow=isset($_GET['p'])?intval($_GET['p']):1;
        $cate_id=$cate_id?$cate_id:17;
        $title=isset($_GET['title'])?htmlspecialchars($_GET['title']):'';
        $params['cate_id']=$cate_id;            //分类id
        $params['id']=$cate_id;            //分类id
        $params['title']=$title;                //查询时的标题
        //设置分页信息
        $this->Articles->pagenow=$pagenow;
        $this->Articles->pagesize=$this->pagesize;
        //文章
        $map=array('cate_id'=>$cate_id,'title'=>$title,'parent_id'=>$parent_id,'_orderBy'=>' ORDER BY pubdate DESC');
        $data=$this->Articles->getArticleList($map);
        $params['list']=$data;          //文章列表
        //分页
        $pagecount=$this->Articles->getArticleListCount($map);
        $pagenation=$this->pagenation($pagenow,$pagecount[0]['num'],$this->pagesize);   //总行数
        //页面设置
        $this->layout = "pc_new";    //分页里面吧layout清掉了
        $params['pagenation']=$pagenation;          //分页

        $params['tuijian'] = $this->Tuijian->getArticlesList(1, 20, 'pubdate');
        if(isset($_SERVER['HTTP_REFERER']))
            $params['back_url'] = $_SERVER['HTTP_REFERER'];
        $this->setpm($params);
        $this->render('xfgc');
    }
    /**
     * @param $pagenow  当前页
     * @param $pagecount    总数
     * @param $navsize   导航大小
     */
    public function pagenation($pagenow=1,$pagecount=1000,$pagesize=10,$navsize=10){
        $this->layout = "";
        //计算开始和结束
        $end=ceil($pagecount/$pagesize);
        $step=ceil($navsize/2);
        $start=1;
        if ($end<=$navsize){
            $stop=$end;
        }else{
            $stop=$start+$navsize-1;
            if($pagenow>=$stop ){
                $start=ceil(($pagenow-$navsize)/$step)*$step+$step;
                $stop=$start+$navsize-1;
            }
            if ($stop>$end){
                $stop=$end;
                $start=$stop-$navsize+1;
                if ($start<1){
                    $start=1;
                }
            }
        }
        //只有一页不显示
        if ($start==$stop){
            return ;
        }
        //打印
        $pages=array();
        $s=$start;
        while($start<=$stop){
            if ($pagenow==$start){
                $temp=array('content'=>$start);
            }else{
                $temp=array('content'=>$start,'pagenow'=>$start);
            }
            $pages[]=$temp;
            $start++;
        }
        //添加额外的
        if($pagenow<$end){
            $pages[]=array('content'=>'>','pagenow'=>$pagenow+1);
        }
        if ($pagenow>1){
            array_unshift($pages,array('content'=>'<','pagenow'=>$pagenow-1));
        }
        if ($stop<$end){
            $pages[]=array('content'=>'···');
            $pages[]=array('content'=>$end,'pagenow'=>$end);
        }
        if($s>1){
            array_unshift($pages,array('content'=>'···'));
            array_unshift($pages,array('content'=>1,'pagenow'=>1));
        }

        $uri=$this->geturiwithoutP();
        $this->setpm(array('pages'=>$pages,'uri'=>$uri));
        return $this->fetch('pagenation');
    }


    public function pagenation1($pagenow=1,$pagecount=1000,$pagesize=10,$navsize=10){
        $this->layout = "";
        //计算开始和结束
        $end=ceil($pagecount/$pagesize);
        $step=ceil($navsize/2);
        $start=1;
        if ($end<=$navsize){
            $stop=$end;
        }else{
            $stop=$start+$navsize-1;
            if($pagenow>=$stop ){
                $start=ceil(($pagenow-$navsize)/$step)*$step+$step;
                $stop=$start+$navsize-1;
            }
            if ($stop>$end){
                $stop=$end;
                $start=$stop-$navsize+1;
                if ($start<1){
                    $start=1;
                }
            }
        }
        //只有一页不显示
        if ($start==$stop){
            return ;
        }
        //打印
        $pages=array();
        $s=$start;
        while($start<=$stop){
            if ($pagenow==$start){
                $temp=array('content'=>$start);
            }else{
                $temp=array('content'=>$start,'pagenow'=>$start);
            }
            $pages[]=$temp;
            $start++;
        }
        //添加额外的
        if($pagenow<$end){
            $pages[]=array('content'=>'下一页','pagenow'=>$pagenow+1);
        }
        if ($pagenow>1){
            array_unshift($pages,array('content'=>'上一页','pagenow'=>$pagenow-1));
        }
        if ($stop<$end){
            $pages[]=array('content'=>'···');
            $pages[]=array('content'=>$end,'pagenow'=>$end);
        }
        if($s>1){
            array_unshift($pages,array('content'=>'···'));
            array_unshift($pages,array('content'=>1,'pagenow'=>1));
        }

        $uri=$this->geturiwithoutP();
        $this->setpm(array('pages'=>$pages,'uri'=>$uri));
        return $this->fetch('pagenation1');
    }
    /**
     * 获取请求的地址,不要当前页的
     * @return string
     */
    protected function geturiwithoutP(){
        $z=strpos($_SERVER['REQUEST_URI'],'?');
        if ($z===false){
            return $_SERVER['REQUEST_URI'].'?';
        }else{
            $path[]=substr($_SERVER['REQUEST_URI'],0,$z);
            $path[]=substr($_SERVER['REQUEST_URI'],$z+1);
            $query_arr=explode('&',$path[1]);
            foreach ($query_arr as $k=>$item){
                if (strpos($item,'p=')===0){
                    unset($query_arr[$k]);
                }
            }
            $query_str=implode("&",$query_arr);
            return $path[0].'?'.$query_str;
        }
    }
    public function detail(){
        $params['action_name'] = " - 消费评论";
        $id = isset($_GET['id']) ? $_GET['id'] : 0;
        $params['tabID'] = isset($_GET['tabID']) ? $_GET['tabID'] : 2;
        $params['info'] = $this->Articles->getArticlesById($id)[0];
        $params['action_name'] = $params['info']['title'].$params['action_name'];
        $params['info']['body'] = explode('|>|<|',$params['info']['body']);
        $params['info']['body'] = array_map("stripcslashes", $params['info']['body']);
        $params['next'] = $this->Articles->getNextById($params['info']['id'], $params['info']['class']);
        $params['prev'] = $this->Articles->getPrevById($params['info']['id'], $params['info']['class']);
        //导航
        if ($params['next']) {
            $params['next'] = $params['next'][0];
        }
        if ($params['prev']) {
            $params['prev'] = $params['prev'][0];
        }


        $params['tui_read']=$this->Articles->getBefore($params['info']['pubdate']);

        //评论
        $params['comment_page_count'] = $this->Comment->getPageCount($id);
        $params['comment_count'] = $this->Comment->getListCount(['art_id'=>$id]);

        $params['cates'] = $this->Category->getIndexIdList();

        $params['about'] = $this->aboutp();
        $params['guanzhu'] = $this->xgguanzhu($params['about']);
        $params['tuijian'] = $this->Tuijian->getArticlesList(1, 20, 'pubdate');
        if(isset($_SERVER['HTTP_REFERER']))
            $params['back_url'] = $_SERVER['HTTP_REFERER'];
        $this->setpm($params);
        // if ($this->device_type != "pc" ) {
        // 	$this->layout = "mobi_view";
        // 	return $this->render('detail_m');
        // }
    }

    /**
     * 相关关注
     */
    public function xgguanzhu($except){
        $this->Articles->pagenow = 0;
        $data=$this->Articles->getArticle(' AND class in (17,18,20)');
        $num = count($data);
        if ($num>=5){
            $datas = array_rand($data,5);
        }else{
            $datas = array_rand($data,$num);
        }
        $returnData = array();
        foreach ($datas as $k=>$datam){
            if ($data[$datam]!=$except){
                $returnData[] = $data[$datam];
            }
        }
        return $returnData;
    }

    /**
     * 相关推荐
     * @return mixed
     */
    public function aboutp(){
        $this->Articles->pagenow = 0;
        $data=$this->Articles->getArticle(' AND class in (17,18)');
        return $data[array_rand($data)];
    }

    public function jiutan(){
        $this->xfgc(18,"消费评论 - 酒谈");
    }
    public function portray(){
        $cate_id = 19;
        $params['action_name'] = "消费评论 - 酒徒故事";
        $parent_id=isset($_GET['p_id'])?intval($_GET['p_id']):1;
        $pagenow=isset($_GET['p'])?intval($_GET['p']):1;
        $cate_id=$cate_id?$cate_id:17;
        $title=isset($_GET['title'])?htmlspecialchars($_GET['title']):'';
        $params['cate_id']=$cate_id;            //分类id
        $params['id']=$cate_id;            //分类id
        $params['title']=$title;                //查询时的标题
        //设置分页信息
        $this->Articles->pagenow=$pagenow;
        $this->Articles->pagesize=$this->pagesize;
        //文章
        $map=array('cate_id'=>$cate_id,'title'=>$title,'parent_id'=>$parent_id,'_orderBy'=>' ORDER BY pubdate DESC');
        $data=$this->Articles->getArticleList($map);
        $params['list']=$data;          //文章列表
        //分页
        $pagecount=$this->Articles->getArticleListCount($map);
        $pagenation=$this->pagenation1($pagenow,$pagecount[0]['num'],$this->pagesize);   //总行数
        //页面设置
        $this->layout = "pc_new";    //分页里面吧layout清掉了
        $params['pagenation']=$pagenation;          //分页
        $params['about']=$this->aboutp();          //分页

        $this->setpm($params);
//        $this->render('xfgc');
        $this->render('portray');
    }
    public function concern(){
        $this->xfgc(20,'消费评论 - 话题关注');
    }
    public function activity(){
        $params['action_name'] = "消费评论 - 官荣评分";
        $this->Products->pagenow = 0;
        $data = $this->Products->getlist('',' order by id desc');
        foreach ($data as $k=>$d){
            $data[$k]['attr'] = explode('<|>',$d['attr']);
        }
        $params['lists']=$data;
        $this->setpm($params);
        $this->render('activity');
//        $this->xfgc(21);
    }
    public function activity_detail(){
        if(!$id = $_REQUEST['id']){
            $this->redirect('xfpl/activity');
        }
        $this->Products->pagenow = 0;
        $data = $this->Products->getlist(' AND id = '.$id);
        $data = $data[0];
        $data['intro'] = explode(',',$data['intro']);
        $gr_id = $data['gr_id'];
        $this->GrUser->pagenow = 0;
        $grData = $this->GrUser->getlist(' AND id = '.$gr_id);
        $grData = $grData[0];
        $grData['gr_attr'] = explode('<|>',$grData['gr_attr']);
        $data['grdata'] = $grData;
        $params['data']=$data;
        $params['next']=$this->Products->getlist(' AND id > '.$id)[0]['id'];
        $params['prev']=$this->Products->getlist(' AND id < '.$id,' order by id desc')[0]['id'];
        $params['back_url'] = $_SERVER['HTTP_REFERER'];
        $this->setpm($params);
    }

    public function style(){
        $this->xfgc(22,'消费评论 - 品牌活动');
    }
    public function jjgc(){
        $this->xfgc(29,"消费评论 - 酒界观察");
    }
    public function qykx(){
        $this->xfgc(30,"消费评论 - 前沿快讯");
    }
    public function xfxc(){
        $this->xfgc(31,"消费评论 - 消费现场");
    }
    public function jygd(){
        $this->xfgc(32,"消费评论 - 酒业观点");
    }
    public function jjhb(){
        $this->xfgc(33,"消费评论 - 酒界黑榜");
    }
    public function jwqz(){
        $this->xfgc(34,"消费评论 - 酒问千知");
    }
    public function contact(){
        $params=array(
            'banner'=>'/img/yjkg/news9.jpg',
            'company_name'=>'四川易酒控股有限公司',
            'phone'=>'028 8673 7358',
            'address'=>'四川省成都市青羊工业园区N区7栋',
            'postcode'=>'610073'
        );
        $params['action_name'] = "联系我们 - 消费评论";
        if(isset($_SERVER['HTTP_REFERER']))
            $params['back_url'] = $_SERVER['HTTP_REFERER'];
        $this->setpm($params);
    }
    /**
     * [commentList 评论列表]
     * @return [type] [description]
     */
    public function commentList(){
        $p = intval($_GET['p']);
        $art_id = intval($_GET['art_id']);
        $this->layout = "";
        $params = [];
        $this->Comment->pagenow = $p;
        $params['list'] = $this->Comment->getList(['art_id'=>$art_id,'reply_id'=>0]);
        
        $this->setpm($params);
    }
    /**
     * [replyList 回复列表]
     * @return [type] [description]
     */
    public function replyList(){
        $reply_id = intval($_POST['reply_id']);
        $this->layout = "";
        $params = [];
        $this->Comment->pagesize=0;
        $params['list'] = $this->Comment->getList(['reply_id'=>$reply_id]);
        
        $this->setpm($params);
    }
    /**
     * [reply 回复]
     * @return [type] [description]
     */
    public function reply(){
        die;
        $data['reply_id'] = intval($_POST['reply_id']);
        $data['art_id'] = intval($_POST['art_id']);
        $_POST['content'] = addcslashes($_POST['content'],"'");
        $preg = "/<script[\s\S]*?<\/script>/i";
        $_POST['content'] = preg_replace($preg,"",$_POST['content']); 
        //stripcslashes ( string $str )
        $data['content'] = htmlspecialchars($_POST['content']);
        if(isset($_SESSION['uniqid'])){
            $uniqid = $_SESSION['uniqid'];
            $data['ukcode'] = $uniqid;
            $res = $this->Comment->reply($data);
            var_dump($res);
        }

        die;
    }
    /**
     * [comment 评论]
     * @return [type] [description]
     */
    public function comment(){
        die;
        $this->layout='';
        $data['art_id'] = intval($_POST['art_id']);
        $_POST['content'] = addcslashes($_POST['content'],"'");
        $preg = "/<script[\s\S]*?<\/script>/i";
        $_POST['content'] = preg_replace($preg,"",$_POST['content']);
        //stripcslashes ( string $str )
        $data['content'] = htmlspecialchars($_POST['content']);
        if(isset($_SESSION['uniqid'])){
            $uniqid = $_SESSION['uniqid'];
            $data['ukcode'] = $uniqid;
            $this->Comment->add($data);
        }
        die;
    }
}
