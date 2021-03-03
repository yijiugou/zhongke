<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/16
 * Time: 14:14
 */
App::uses('Controller', 'Controller');
App::uses('Upload', 'Vendor');
App::uses('Image', 'Vendor');
class ArticleController extends AppController{
    public $layout = "pc_admin_view";
    public $uses = array('Category', 'Articles','Products',"GrUser","Tuijian","Ad");
    public $pagesize=10;

    public function beforeFilter(){
        parent::beforeFilter();

        if ($this->Session->read('user_login') != 1 || $this->Session->read('user_type') != 'admin'){
            $this->redirect('/login/mng');
        }

    }

    /**
     * 文章列表
     * @param Int class_id 分类id 默认1
     * @param parent_id Int 顶级分类id
     * @param Int p 当前页
     */
    public function articlelist(){
//        $parent_id=isset($_GET['p_id'])?intval($_GET['p_id']):1;
        $pagenow=isset($_GET['p'])?intval($_GET['p']):1;
        $firstCate=$this->Category->query('select * from class where parent_id <> 0');
//        var_dump($firstCate);die;
//        foreach ($firstCate as $item){
//            if ($item['class_id']==$parent_id){
//                $cate_ids=array_column($item['child'],'class_id');
//            }
//        }
        $cate_id=isset($_GET['class_id'])?intval($_GET['class_id']):0;
        $title=isset($_GET['title'])?htmlspecialchars($_GET['title']):'';
        $params['catelist']=$firstCate;         //分类数组树
//        $params['parent_id']=$parent_id;        //顶级分类id
        $params['cate_id']=$cate_id;            //分类id
        $params['title']=$title;                //查询时的标题
        //设置分页信息
        $this->Articles->pagenow=$pagenow;
        $this->Articles->pagesize=$this->pagesize;
        //文章
        $map=array('cate_id'=>$cate_id,'_orderBy'=>' ORDER BY pubdate DESC');
        $data=$this->Articles->getArticleList($map);
        $params['list']=$data;          //文章列表
        //分页
        $pagecount=$this->Articles->getArticleListCount($map);
        $pagenation=$this->pagenation($pagenow,$pagecount[0]['num'],$this->pagesize);   //总行数
        //页面设置
        $this->layout = "pc_admin_view";    //分页里面吧layout清掉了
        $params['pagenation']=$pagenation;          //分页

        $this->setpm($params);
        $this->render('articlelist');
    }
    /**
     * 推荐位
     * @param Int class_id 分类id 默认1
     * @param parent_id Int 顶级分类id
     * @param Int p 当前页
     */
    public function tuijian(){
//        $parent_id=isset($_GET['p_id'])?intval($_GET['p_id']):1;
        $pagenow=isset($_GET['p'])?intval($_GET['p']):1;
        $firstCate=$this->Category->query('select * from class where parent_id <> 0');

        $cate_id=isset($_GET['class_id'])?intval($_GET['class_id']):0;
        $title=isset($_GET['title'])?htmlspecialchars($_GET['title']):'';
        $params['catelist']=$firstCate;         //分类数组树
//        $params['parent_id']=$parent_id;        //顶级分类id
        $params['cate_id']=$cate_id;            //分类id
        $params['title']=$title;                //查询时的标题
        //设置分页信息
        $this->Tuijian->pagenow=$pagenow;
        $this->Tuijian->pagesize=$this->pagesize;
        //文章
        $map=array('cate_id'=>$cate_id,'_orderBy'=>' ORDER BY pubdate DESC');
        $data=$this->Tuijian->getArticleList($map);
        $params['list']=$data;          //文章列表
        //分页
        $pagecount=$this->Tuijian->getArticleListCount($map);
        $pagenation=$this->pagenation($pagenow,$pagecount[0]['num'],$this->pagesize);   //总行数
        //页面设置
        $this->layout = "pc_admin_view";    //分页里面吧layout清掉了
        $params['pagenation']=$pagenation;          //分页

        $this->setpm($params);
        $this->render('tuijian');
    }

    /**
     * 编辑新增文章
     * @param Int post 标志是否编辑
     * @param Int id 文章id
     * @param String title 标题
     * @param String body 内容
     * @param String from 文章出处
     * @param String author 文章作者
     */
    public function addeditTuijian(){
        if (isset($_POST['post'])){
            $pic = $this->getUploadImage();
            unset($_POST['post']);
            if (isset($_POST['id'])&&$_POST['id']=intval($_POST['id'])){
                //图片
                isset($pic['pic_01'])?$_POST["pic_01"]="'".$pic['pic_01']['urlpath']."'":$_POST["pic_01"]="'".$_POST["pic_01"]."'";
                
                isset($_POST['pubdate'])?$_POST["pubdate"]="'".date("Y-m-d H:i:s",strtotime($_POST['pubdate']))."'":0;      //大事记的时间
//                $_POST['sub_title']="'".$this->getsubtitle($_POST['body'])."'";
                $_POST['title']="'".htmlspecialchars($_POST['title'])."'";
                $_POST['from']="'".htmlspecialchars($_POST['from'])."'";
                $_POST['link']="'".htmlspecialchars($_POST['link'])."'";
                $condition=array('id'=>intval($_POST['id']));
                $_POST['updated']="'".date("Y-m-d H:i:s")."'";
                $res=$this->Tuijian->articleEdit($_POST,$condition);

            }else{
                isset($pic['pic_01'])?$_POST["pic_01"]=$pic['pic_01']['urlpath']:'/upload/images/default_a.png';
                isset($_POST['pubdate'])?$_POST['pubdate']=date("Y-m-d H:i:s",strtotime($_POST['pubdate'])):date("Y-m-d H:i:s");
//                $_POST['sub_title']=$this->getsubtitle($_POST['body']);
                $_POST['title']=htmlspecialchars($_POST['title']);
                $_POST['from']=htmlspecialchars($_POST['from']);
                $_POST['link']=htmlspecialchars($_POST['link']);
//                $_POST['pubdate']=date("Y-m-d H:i:s");
                $_POST['created']=date("Y-m-d H:i:s");
                $_POST['updated']=date("Y-m-d H:i:s");
                $_POST['public_flg']=1;
                $_POST['view_num']=0;
                $res=$this->Tuijian->articleAdd($_POST);
            }
            if ($res){
                if (is_array($res)){
                    $id=$res['Articles']['id'];
                }else{
                    $id=$condition['id'];
                }
//                $this->changeArticleImg($id,$_POST['body']);
                $this->redirect('/Article/tuijian');
            }else{
//                echo '失败';
            }

        }else{
            $id=isset($_GET['id'])?intval($_GET['id']):0;
            if ($id){
                $data=$this->Tuijian->getArticle(' AND id = '.$id,' limit 1')[0];
                $params['article']=$data;
            }
            $params['pubdates']=range(2014,date('Y'),1);
            $cate=$this->Category->getCategoryTree();
            $params['category']=$cate;
            $this->setpm($params);

        }
    }    


    /**
     * 推荐位
     * @param Int class_id 分类id 默认1
     * @param parent_id Int 顶级分类id
     * @param Int p 当前页
     */
    public function adlist(){
//        $parent_id=isset($_GET['p_id'])?intval($_GET['p_id']):1;
        $pagenow=isset($_GET['p'])?intval($_GET['p']):1;
        $firstCate=$this->Category->query('select * from class where parent_id <> 0');

        $cate_id=isset($_GET['class_id'])?intval($_GET['class_id']):0;
        $title=isset($_GET['title'])?htmlspecialchars($_GET['title']):'';
        $params['catelist']=$firstCate;         //分类数组树
//        $params['parent_id']=$parent_id;        //顶级分类id
        $params['cate_id']=$cate_id;            //分类id
        $params['title']=$title;                //查询时的标题
        //设置分页信息
        $this->Ad->pagenow=$pagenow;
        $this->Ad->pagesize=$this->pagesize;
        //文章
        $map=array('cate_id'=>$cate_id,'_orderBy'=>' ORDER BY pubdate DESC');
        $data=$this->Ad->getArticleList($map);
        $params['list']=$data;          //文章列表
        //分页
        $pagecount=$this->Ad->getArticleListCount($map);
        $pagenation=$this->pagenation($pagenow,$pagecount[0]['num'],$this->pagesize);   //总行数
        //页面设置
        $this->layout = "pc_admin_view";    //分页里面吧layout清掉了
        $params['pagenation']=$pagenation;          //分页

        $this->setpm($params);
        $this->render('adlist');
    }

    /**
     * 编辑新增文章
     * @param Int post 标志是否编辑
     * @param Int id 文章id
     * @param String title 标题
     * @param String body 内容
     * @param String from 文章出处
     * @param String author 文章作者
     */
    public function addeditAd(){
        if (isset($_POST['post'])){
            $pic = $this->getUploadImage();
            unset($_POST['post']);
            if (isset($_POST['id'])&&$_POST['id']=intval($_POST['id'])){
                //图片
                isset($pic['pic_01'])?$_POST["pic_01"]="'".$pic['pic_01']['urlpath']."'":$_POST["pic_01"]="'".$_POST["pic_01"]."'";
                
                isset($_POST['pubdate'])?$_POST["pubdate"]="'".date("Y-m-d H:i:s",strtotime($_POST['pubdate']))."'":0;      //大事记的时间
//                $_POST['sub_title']="'".$this->getsubtitle($_POST['body'])."'";
                $_POST['title']="'".htmlspecialchars($_POST['title'])."'";
                $_POST['from']="'".htmlspecialchars($_POST['from'])."'";
                $_POST['link']="'".htmlspecialchars($_POST['link'])."'";
                $condition=array('id'=>intval($_POST['id']));
                $_POST['updated']="'".date("Y-m-d H:i:s")."'";
                $res=$this->Ad->articleEdit($_POST,$condition);

            }else{
                isset($pic['pic_01'])?$_POST["pic_01"]=$pic['pic_01']['urlpath']:'/upload/images/default_a.png';
                isset($_POST['pubdate'])?$_POST['pubdate']=date("Y-m-d H:i:s",strtotime($_POST['pubdate'])):date("Y-m-d H:i:s");
//                $_POST['sub_title']=$this->getsubtitle($_POST['body']);
                $_POST['title']=htmlspecialchars($_POST['title']);
                $_POST['from']=htmlspecialchars($_POST['from']);
                $_POST['link']=htmlspecialchars($_POST['link']);
//                $_POST['pubdate']=date("Y-m-d H:i:s");
                $_POST['created']=date("Y-m-d H:i:s");
                $_POST['updated']=date("Y-m-d H:i:s");
                $_POST['public_flg']=1;
                $_POST['view_num']=0;
                $res=$this->Ad->articleAdd($_POST);
            }
            if ($res){
                if (is_array($res)){
                    $id=$res['Articles']['id'];
                }else{
                    $id=$condition['id'];
                }
//                $this->changeArticleImg($id,$_POST['body']);
                $this->redirect('/Article/adlist');
            }else{
//                echo '失败';
            }

        }else{
            $id=isset($_GET['id'])?intval($_GET['id']):0;
            if ($id){
                $data=$this->Ad->getArticle(' AND id = '.$id,' limit 1')[0];
                $params['article']=$data;
            }
            $params['pubdates']=range(2014,date('Y'),1);
            $cate=$this->Category->getCategoryTree();
            $params['category']=$cate;
            $this->setpm($params);

        }
    }    
    /**
     * 删除推荐专题
     * @param Int id 文章id
     */
    public function delTuijian(){
        $res=0;
        if (isset($_POST['id'])&&intval($_POST['id'])){
            $id=intval($_POST['id']);
            $res=$this->Tuijian->articleDelete($id);
        }
        echo 1;die;
    }
    /**
     * [delAd 删除广告]
     * @return [type] [description]
     */
    public function delAd(){
        $res=0;
        if (isset($_POST['id'])&&intval($_POST['id'])){
            $id=intval($_POST['id']);
            $res=$this->Ad->articleDelete($id);
        }
        echo 1;die;
    }
    /**
     * 文章列表
     * @param Int class_id 分类id 默认1
     * @param parent_id Int 顶级分类id
     * @param Int p 当前页
     */
    public function gruserlist(){
        $pagenow=isset($_GET['p'])?intval($_GET['p']):1;
        //设置分页信息
        $this->GrUser->pagenow=$pagenow;
        $this->GrUser->pagesize=10;
        //文章
//        $map=array('cate_id'=>$cate_id,'cate_ids'=>$cate_ids,'title'=>$title,'parent_id'=>$parent_id,'_orderBy'=>' ORDER BY pubdate DESC');
        $where = '';
        isset($_GET['names'])?$where = " AND `gr_name` like '%".$_GET['names']."%'":0;
        $data=$this->GrUser->getlist($where);
        $params['list']=$data;          //文章列表
        //分页
        $pagecount=$this->GrUser->count($where);
        $pagenation=$this->pagenation($pagenow,$pagecount[0]['num'],$this->pagesize);   //总行数
        //页面设置
        $this->layout = "pc_admin_view";    //分页里面吧layout清掉了
        $params['pagenation']=$pagenation;          //分页
        $params['name']=isset($_GET['names'])?$_GET['names']:'';          //分页

        $this->setpm($params);
        $this->render('gruserlist');
    }



    /**
     * 文章列表
     * @param Int class_id 分类id 默认1
     * @param parent_id Int 顶级分类id
     * @param Int p 当前页
     */
    public function productlist(){
        $pagenow=isset($_GET['p'])?intval($_GET['p']):1;
        //设置分页信息
        $this->Products->pagenow=$pagenow;
        $this->Products->pagesize=10;
        //文章
//        $map=array('cate_id'=>$cate_id,'cate_ids'=>$cate_ids,'title'=>$title,'parent_id'=>$parent_id,'_orderBy'=>' ORDER BY pubdate DESC');
        $where = '';
        isset($_GET['names'])?$where = " AND `name` like '%".$_GET['names']."%'":0;
        $data=$this->Products->getlist($where);
        $params['list']=$data;          //文章列表
        //分页
        $pagecount=$this->Products->count($where);
        $pagenation=$this->pagenation($pagenow,$pagecount[0]['num'],$this->pagesize);   //总行数
        //页面设置
        $this->layout = "pc_admin_view";    //分页里面吧layout清掉了
        $params['pagenation']=$pagenation;          //分页
        $params['name']=isset($_GET['names'])?$_GET['names']:'';          //分页

        $this->setpm($params);
        $this->render('productlist');
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
            $pages[]=array('content'=>'下一页 >','pagenow'=>$pagenow+1);
        }
        if ($pagenow>1){
            array_unshift($pages,array('content'=>'< 上一页','pagenow'=>$pagenow-1));
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

    /**
     * 编辑新增文章
     * @param Int post 标志是否编辑
     * @param Int id 文章id
     * @param String title 标题
     * @param String body 内容
     * @param String from 文章出处
     * @param String author 文章作者
     */
    public function addeditarticle(){
        if (isset($_POST['post'])){
            $pic = $this->getUploadImage();
            unset($_POST['post']);
            if (isset($_POST['id'])&&$_POST['id']=intval($_POST['id'])){
                //图片
                isset($pic['pic_01'])?$_POST["pic_01"]="'".$pic['pic_01']['urlpath']."'":$_POST["pic_01"]="'".$_POST["pic_01"]."'";
                isset($pic['pic_02'])?$_POST["pic_02"]="'".$pic['pic_02']['urlpath']."'":$_POST["pic_02"]="'".$_POST["pic_02"]."'";
                isset($pic['pic_03'])?$_POST["pic_03"]="'".$pic['pic_03']['urlpath']."'":$_POST["pic_03"]="'".$_POST["pic_03"]."'";
                isset($pic['pic_04'])?$_POST["pic_04"]="'".$pic['pic_04']['urlpath']."'":$_POST["pic_04"]="'".$_POST["pic_04"]."'";
                isset($_POST['pubdate'])?$_POST["pubdate"]="'".date("Y-m-d H:i:s",strtotime($_POST['pubdate']))."'":0;      //大事记的时间
//                $_POST['sub_title']="'".$this->getsubtitle($_POST['body'])."'";
                $_POST['sub_title']="'".addslashes($_POST['sub_title'])."'";
                $_POST['body'] = implode('|>|<|',array_map("addslashes", $_POST['body']));
                $_POST['body']="'".$this->fitterScript($_POST['body'])."'";
                $_POST['title']="'".htmlspecialchars($_POST['title'])."'";
                $_POST['from']="'".htmlspecialchars($_POST['from'])."'";
                $_POST['author']="'".htmlspecialchars($_POST['author'])."'";
                $condition=array('id'=>intval($_POST['id']));
                $_POST['updated']="'".date("Y-m-d H:i:s")."'";
                $res=$this->Articles->articleEdit($_POST,$condition);

            }else{
                isset($pic['pic_01'])?$_POST["pic_01"]=$pic['pic_01']['urlpath']:'/upload/images/default_a.png';
                isset($pic['pic_02'])?$_POST["pic_02"]=$pic['pic_02']['urlpath']:0;
                isset($pic['pic_03'])?$_POST["pic_03"]=$pic['pic_03']['urlpath']:0;
                isset($pic['pic_04'])?$_POST["pic_04"]=$pic['pic_04']['urlpath']:0;
                isset($_POST['pubdate'])?$_POST['pubdate']=date("Y-m-d H:i:s",strtotime($_POST['pubdate'])):date("Y-m-d H:i:s");
//                $_POST['sub_title']=$this->getsubtitle($_POST['body']);
                $_POST['sub_title']="'".addslashes($_POST['sub_title'])."'";
                $_POST['body'] = implode('|>|<|',array_map("addslashes", $_POST['body']));
                $_POST['body']=$this->fitterScript($_POST['body']);
                $_POST['title']=htmlspecialchars($_POST['title']);
                $_POST['from']=htmlspecialchars($_POST['from']);
                $_POST['author']=htmlspecialchars($_POST['author']);
//                $_POST['pubdate']=date("Y-m-d H:i:s");
                $_POST['created']=date("Y-m-d H:i:s");
                $_POST['updated']=date("Y-m-d H:i:s");
                $_POST['public_flg']=1;
                $_POST['view_num']=0;
                $res=$this->Articles->articleAdd($_POST);
            }
            if ($res){
                if (is_array($res)){
                    $id=$res['Articles']['id'];
                }else{
                    $id=$condition['id'];
                }
//                $this->changeArticleImg($id,$_POST['body']);
                $this->redirect('/Article/articlelist');
            }else{
//                echo '失败';
            }

        }else{
            $id=isset($_GET['id'])?intval($_GET['id']):0;
            if ($id){
                $data=$this->Articles->getArticle(' AND id = '.$id,' limit 1')[0];
                $data['body'] = explode('|>|<|',$data['body']);
                $data['body'] = array_map("stripcslashes", $data['body']);
                $params['article']=$data;
            }
            $params['pubdates']=range(2014,date('Y'),1);
            $cate=$this->Category->getCategoryTree();
            $params['category']=$cate;
            $this->setpm($params);

        }
    }

    /**
     * 删除文章
     * @param Int id 文章id
     */
    public function del(){
        $res=0;
        if (isset($_POST['id'])&&intval($_POST['id'])){
            $id=intval($_POST['id']);
            $res=$this->Articles->articleDelete($id);
        }
        echo 1;die;
    }
    /**
     * 删除产品
     * @param Int id 文章id
     */
    public function productdel(){
        $res=0;
        if (isset($_POST['id'])&&intval($_POST['id'])){
            $id=intval($_POST['id']);
            $res=$this->Products->delete($id);
        }
        echo 1;die;
    }
    /**
     * 删除检测人员
     * @param Int id 文章id
     */
    public function gruserdel(){
        $res=0;
        if (isset($_POST['id'])&&intval($_POST['id'])){
            $id=intval($_POST['id']);
            $res=$this->GrUser->delete($id);
        }
        echo 1;die;
    }

    /**
     * 文章分类
     */
    public function category(){
        $data=$this->Category->getCategoryTree();
//        var_dump($data);
        $params['list']=$data;
        $this->setpm($params);
    }

    /**
     * 编辑新增文章分类
     * @param Int post 标志是否是编辑
     * @param Int class 分类id
     * @param String class_name 分类名称
     */
    public function addeditcategory(){
        $parentid=0;
        if (isset($_POST['post'])){
            unset($_POST['post']);
            if (isset($_POST['class'])&&$_POST['class']=intval($_POST['class'])){
                $_POST['class_name']="'".$_POST['class_name']."'";
                $condition=array('class_id'=>$_POST['class']);
                unset($_POST['class']);
                $res=$this->Category->categoryEdit($_POST,$condition);
                if ($res){
                    $this->redirect('/Article/category');
                }else{
                    echo '修改失败';
                }
            }else{
                $res=$this->Category->categoryAdd($_POST);
                if ($res){
                    $this->redirect('/Article/category');
                }else{
                    echo '添加失败';
                }
            }
        }else{
            $id=isset($_GET['class'])?intval($_GET['class']):0;
            if ($id>0){
                $cate_item=$this->Category->getCategory(' AND class_id='.$id);
                $params['cate_item']=$cate_item[0];
                $parentid=$params['cate_item']['parent_id'];
            }
            $params['parent_id']=$parentid;
            $cate=$this->Category->getCategoryTree();
            $params['category']=$cate;
            $this->setpm($params);
        }
    }
    /**
     * 编辑新增产品
     * @param Int post 标志是否是编辑
     * @param Int class 分类id
     * @param String class_name 分类名称
     */
    public function addeditproduct(){
        $parentid=0;
        if (isset($_POST['post'])){
//            try{


            $pic = $this->getUploadImage();
            unset($_POST['post']);
            if (isset($_POST['id'])&&$_POST['id']=intval($_POST['id'])){
                $_POST['attr'] = array_filter($_POST['attr']);
                $_POST['intro'] = array_filter($_POST['intro']);
                $_POST['attr']=implode('<|>',$_POST['attr']);
                $_POST['intro']=implode('<|>',$_POST['intro']);
                isset($pic['pic_01'])?$_POST["pic_01"]=$pic['pic_01']['urlpath']:$_POST["pic_01"]=$_POST["pic_01"];
                isset($pic['pic_02'])?$_POST["pic_02"]=$pic['pic_02']['urlpath']:$_POST["pic_02"]=$_POST["pic_02"];
                $condition=array('id'=>$_POST['id']);
                unset($_POST['class']);
                $_POST = array_map("addslashes", $_POST);
                $res=$this->Products->update($_POST,$condition);
                if ($res){
                    $this->redirect('/Article/productlist');
                }else{
                    echo '修改失败';
                }
            }else{
                $_POST['attr'] = array_filter($_POST['attr']);
                $_POST['intro'] = array_filter($_POST['intro']);
                $_POST['attr']=implode('<|>',$_POST['attr']);
                $_POST['intro']=implode('<|>',$_POST['intro']);
                isset($pic['pic_01'])?$_POST["pic_01"]=$pic['pic_01']['urlpath']:$_POST["pic_01"]=$_POST["pic_01"];
                isset($pic['pic_02'])?$_POST["pic_02"]=$pic['pic_02']['urlpath']:$_POST["pic_02"]=$_POST["pic_02"];
                unset($_POST['id']);
                $_POST = array_map("addslashes", $_POST);
                $res=$this->Products->addproduct($_POST);
                if ($res){
                    $this->redirect('/Article/productlist');
                }else{
                    echo '添加失败';
                }
            }
//            }catch(Exception $e){
//                echo $e->getMessage();
//            }
        }else{
            $this->GrUser->pagenow = 0;
            $grData=$this->GrUser->getlist();
            $id=isset($_GET['id'])?intval($_GET['id']):0;
            if ($id>0){
                $this->Products->pagenow = 0;
                $cate_item=$this->Products->getlist(' AND id='.$id)[0];

                $cate_item = array_map("stripslashes", $cate_item);
                $cate_item['intro'] = explode('<|>',$cate_item['intro']);
                $cate_item['attr'] = explode('<|>',$cate_item['attr']);
                $params['article']=$cate_item;
            }
            $params['grdata']=$grData;
            $this->setpm($params);
        }
    }
/**
     * 编辑新增官荣人员
     * @param Int post 标志是否是编辑
     * @param Int class 分类id
     * @param String class_name 分类名称
     */
    public function addeditgruser(){
        $parentid=0;
        if (isset($_POST['post'])){
            $pic = $this->getUploadImage();
//            $_POST['gr_id'] = 1;
            unset($_POST['post']);
            try{


            if (isset($_POST['id'])&&$_POST['id']=intval($_POST['id'])){
                $_POST['gr_attr'] = array_filter($_POST['gr_attr']);
                $_POST['gr_attr']=implode('<|>',$_POST['gr_attr']);
                isset($pic['pic_01'])?$_POST["gr_head_pic"]=$pic['pic_01']['urlpath']:0;
                $condition=array('id'=>$_POST['id']);
                unset($_POST['class']);
                unset($_POST['attr']);
                $_POST = array_map("addslashes", $_POST);
                $res=$this->GrUser->update($_POST,$condition);
                if ($res){
                    $this->redirect('/Article/gruserlist');
                }else{
                    echo '修改失败';
                }
            }else{
                $_POST['gr_attr'] = array_filter($_POST['gr_attr']);
                $_POST['gr_attr']=implode('<|>',$_POST['gr_attr']);
                isset($pic['pic_01'])?$_POST["gr_head_pic"]=$pic['pic_01']['urlpath']:$_POST["gr_head_pic"]=$_POST["pic_01"];
                unset($_POST['id']);
                $_POST = array_map("addslashes", $_POST);
                $res=$this->GrUser->addgruser($_POST);
                if ($res){
                    $this->redirect('/Article/gruserlist');
                }else{
                    echo '添加失败';
                }
            }
            }catch (Exception $e){
                echo $e->getMessage();
            }
        }else{
            $id=isset($_GET['id'])?intval($_GET['id']):0;
            if ($id>0){
                $this->GrUser->pagenow = 0;
                $cate_item=$this->GrUser->getlist(' AND id='.$id)[0];
                $cate_item = array_map("stripslashes", $cate_item);
                $cate_item['gr_attr'] = explode('<|>',$cate_item['gr_attr']);
                $params['article']=$cate_item;
                $this->setpm($params);
            }
        }
    }


    /**
     * 删除分类
     */
    public function delcate(){
        $res=0;
        if (isset($_POST['id'])&&intval($_POST['id'])){
            $id=intval($_POST['id']);
            $res=$this->Category->categoryDelete($id);
        }
        echo 1;die;
    }

    /**
     * 过滤javascript
     * @param $str
     * @return mixed
     */
    protected function fitterScript($str){
        return preg_replace_callback(
            '/<script\b[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/i', // %24 = $
            function (&$matches) {
                return '';
            },
            $str
        );
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

    /**
     * 获取字符串中的img标签中的src,并写入article表
     * @param $id   文章id
     * @param $body  文章内容
     */
    protected function changeArticleImg($id,$body){
        $s="/<img[^>]*?src=\"([^\"]*?)\"[^>]*?>/i";
        preg_match_all($s,$body,$matchs);
        $condition=array('id'=>$id);
        if(!empty($matchs[0])){
            $data=array();
            foreach ($matchs[1] as $k=>$url){
                if ($k>5){
                    break;
                }
                $key=$k+2;
                $data['pic_0'.$key]="'".$url."'";
            }
        }else{
            $data['pic_01']= "'/upload/images/default_a.png'";
        }
        $this->Articles->articleEdit($data,$condition);
    }

    protected function getsubtitle($body){
        preg_match_all('/<p[^>]*>(?:(?!<\/p>)[\s\S])*<\/p>/',$body,$matchs);
        $subtitle='';
        if (!empty($matchs[0])){
            foreach ($matchs[0] as $match){         //取出至少一段 p标签的内容
                $subtitle=trim(preg_replace('/(<.+?>)|(&nbsp);/','',$match));
                if ($subtitle){
                    break;
                }
            }
        }else{
            $subtitle=preg_replace('/(<.+?>)|(&nbsp);/','',$body);
        }
        $subtitle=ltrim($subtitle,'&nbsp;');
        $subtitle=addslashes(mb_substr($subtitle,0,150));
        return $subtitle;
    }
    protected function getUploadImage(){
        $config = array(
            'maxSize'       =>  2*1024*1024, //上传的文件大小限制 (0-不做限制)
            'exts'          =>  array('jpg','jpeg','png'), //允许上传的文件后缀
        );
        $upload= new Upload($config);
        $info = $upload->upload();
//        if (isset($info['pic_01'])){
//            $image = new Image();
//            $file=substr($info['pic_01']['urlpath'],1);
//            if (file_exists($file)){
//                $image->open($file);
//                $image->thumb(270,180,Image::IMAGE_THUMB_CENTER);
//                $image->save($file);
//            }
//        }
        return $info;
    }
    function getUploadDocx(){
        $config = array(
            'maxSize'       =>  10*1024*1024, //上传的文件大小限制 (0-不做限制)
            'exts'          =>  array('docx'), //允许上传的文件后缀
        );
        $upload= new Upload($config);
        $info = $upload->upload();
//        if (isset($info['pic_01'])){
//            $image = new Image();
//            $file=substr($info['pic_01']['urlpath'],1);
//            if (file_exists($file)){
//                $image->open($file);
//                $image->thumb(270,180,Image::IMAGE_THUMB_CENTER);
//                $image->save($file);
//            }
//        }
        //var_dump($info);
        $dir = WWW_ROOT.$info['file']['urlpath'];
        //echo $dir;
        echo $this->docx2html($dir);
        die;
    }
    function docx2html($source)
    {
        $phpWord = \PhpOffice\PhpWord\IOFactory::load($source);
        $html = '';
        $i = 0;
        foreach ($phpWord->getSections() as $section) {
            
            foreach ($section->getElements() as $ele1) {
                $paragraphStyle = $ele1->getParagraphStyle();

                if ($paragraphStyle) {
                    $html .= '<p style="text-align:'. $paragraphStyle->getAlignment() .';">';
                } else {
                    $html .= '<p>';
                }

               
                if ($ele1 instanceof \PhpOffice\PhpWord\Element\TextRun) {
                    foreach ($ele1->getElements() as $ele2) {
                        
                        if ($ele2 instanceof \PhpOffice\PhpWord\Element\Text) {
                            $i++;

                            $style = $ele2->getFontStyle();

                            $fontFamily = $style->getName();
                            $encode = mb_detect_encoding($fontFamily, array("ASCII",'UTF-8',"GB2312","GBK",'BIG5'));
                            if($encode!='UTF-8'){
                                $fontFamily = mb_convert_encoding($fontFamily, 'UTF-8', $encode);
                            }

                            
                            $fontSize = $style->getSize();
                            //echo $fontSize.'-'.$ele2->getText().'<br>';
                            $isBold = $style->isBold();
                            $styleString = '';
                            $fontFamily && $styleString .= "font-family:{$fontFamily};";
                            $fontSize && $styleString .= "font-size:{$fontSize}px;";
                            $isBold && $styleString .= "font-weight:bold;";
                            $html .= sprintf('<span style="%s">%s</span>',
                                $styleString,
                                mb_convert_encoding($ele2->getText(), 'GBK', 'UTF-8')
                            );
                        } elseif ($ele2 instanceof \PhpOffice\PhpWord\Element\Image) {
                            $xdir = 'upload/'. date('Y-m-d'). '/' . md5($ele2->getSource()) . '.' . $ele2->getImageExtension();
                            $imageSrc = WWW_ROOT.$xdir;
                            $imageData = $ele2->getImageStringData(true);
                            // $imageData = 'data:' . $ele2->getImageType() . ';base64,' . $imageData;
                            file_put_contents($imageSrc, base64_decode($imageData));
                            $imageSrc = '/'.$xdir;
                            $html .= '<img src="'. $imageSrc .'" style="width:100%;height:auto">';
                        }
                    }
                }
                $html .= '</p>';
            }
        }

        return mb_convert_encoding($html, 'UTF-8', 'GBK');
    }
//    public function query(){
//        try{
//            $this->Products->query("UPDATE `class` SET `class_name`='消费观察' WHERE (`class_id`='观察消费')");
//        }catch(Exception $e){
//            echo $e->getMessage();
//        }
//    }
}
