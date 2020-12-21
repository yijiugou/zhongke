<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/16
 * Time: 15:35
 */
App::uses('AppModel', 'Model');
class Articles extends AppModel
{
    public  $useTable = "articles";
    public $pagenow=0;
    public $pagesize=10;
     //资讯分享查询数量
    public function count($category = 0){
        if ($category == 0) {
            $count = "select count(1) from articles";
        } else {
            $count = "select count(1) from articles where class=" . $category;
        }
        return $this->getCount($count, 'articles', 'id');
    }

    //资讯列表分类分页查询
    public function getArticlesList($category = 0, $pageindex = 1, $pagesize = 10, $sort = ''){
        $sql = "select * from articles where 1=1 and";
        if ($category == 0) {
            
        } else {
            $sql .= " class=" . $category;
        }

        if (!empty($sort)) {
            $sql .= " ORDER BY ".$sort." DESC";
        }

        $sql .= " limit " . (($pageindex - 1) * $pagesize) ."," . $pagesize;
        return $this->getAll($sql);
    }

    //资讯列表分类分页查询
    public function getArtAllList($pageindex = 1, $pagesize = 10, $sort = ''){
        $sql = "select * from articles ";

        if (!empty($sort)) {
            $sql .= " ORDER BY ".$sort." DESC";
        }

        $sql .= " limit " . (($pageindex - 1) * $pagesize) ."," . $pagesize;
        return $this->getAll($sql);
    }
    //根据ID获取文章条目
    public function getArticlesById($id){
        $sql = "select * from articles where id=" . $id;
        return $this->getAll($sql);
    }
    //根据ID查询该文章的下一条数据
    public function getNextById($id, $category){
        $sql = 'select id,title from articles where id > ' . $id . ' and class=' . $category . ' ORDER BY id ASC LIMIT 0,1';
        return $this->getAll($sql);
    }
    //根据ID查询该文章的下一条数据
    public function getPrevById($id, $category){
        $sql = 'select id,title from articles where id < ' . $id . ' and class=' . $category . ' ORDER BY id DESC LIMIT 0,1';
        return $this->getAll($sql);
    }
    /**
     * 获取文章列表 根据分类
     * @param Int cate_id 分类ID
     */
    public function getArticleList($map){
        $where='';$etc='';
        if (!empty($map['cate_id'])){
            $where.=" AND class=".$map['cate_id'];
        }
        if (!empty($map['title'])){
            $where.=" AND title like '%".$map['title']."%'";
        }
        if (!empty($map['cate_ids'])){
            $where.=" AND class in (".implode(',',$map['cate_ids']).")";
        }
        if (!empty($map['_orderBy'])){
            $etc=$map['_orderBy'];
        }
        return $this->getArticle($where,$etc);
    }
    /**
     * [getBefore 获取时间点之前的文章]
     * @param  [type] $datetime [description]
     * @param  [type] $num      [description]
     * @return [type]           [description]
     */
    public function getBefore($datetime,$num=5){
        $where='';$etc='';
        $pagenow = $this->pagenow;
        $pagesize= $this->pagesize;
        $this->pagenow = 1;
        $this->pagesize= $num;
        $where.=" AND pubdate < '".$datetime."'";
        $etc=' ORDER BY pubdate DESC';
        $res = $this->getArticle($where,$etc);
        $this->pagenow = $pagenow;
        $this->pagesize= $pagesize;
        return $res;
    }
    //总数
    public function getArticleListCount($map){
        $pagenow=$this->pagenow;
        $this->pagenow=0;
        $where='';
        if (!empty($map['cate_id'])){
            $where.=" AND class=".$map['cate_id'];
        }
        if (!empty($map['title'])){
            $where.=" AND title like '%".$map['title']."%'";
        }
        if (!empty($map['cate_ids'])){
            $where.=" AND class in (".implode(',',$map['cate_ids']).")";
        }
        $data=$this->getArticle($where,'','count(1) as num');
        $this->pagenow=$pagenow;
        return $data;
    }
    public function getArticle($where='',$etc='',$field=''){
        if ($this->pagenow>0){
            $etc.=' limit '.($this->pagenow-1)*$this->pagesize.','.$this->pagesize;
        }
        if ($field){
            $sql="select $field from articles WHERE 1".$where.$etc;
        }else{
            $sql="select * from articles WHERE 1".$where.$etc;
        }
        return $this->getAll($sql);
    }

    public function articleAdd($data){
        return $this->save($data);
    }
    public function articleEdit($data,$condition=array()){
        return $this->updateAll($data,$condition);
    }
    public function articleDelete($id){
        $sql="delete from articles WHERE id = ".$id;
        return $this->query($sql);
    }
}