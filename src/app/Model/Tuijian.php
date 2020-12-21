<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/16
 * Time: 15:35
 */
App::uses('AppModel', 'Model');
class Tuijian extends AppModel
{
    public  $useTable = "tuijian";
    public $pagenow=0;
    public $pagesize=10;
     //资讯分享查询数量
    public function count($category = 0){
        if ($category == 0) {
            $count = "select count(1) from tuijian";
        } else {
            $count = "select count(1) from tuijian where class=" . $category;
        }
        return $this->getCount($count, 'tuijian', 'id');
    }

    //资讯列表分类分页查询
    public function getArticlesList($pageindex = 1, $pagesize = 10, $sort = ''){
        $sql = "select * from tuijian ";

        if (!empty($sort)) {
            $sql .= " ORDER BY ".$sort." DESC";
        }

        $sql .= " limit " . (($pageindex - 1) * $pagesize) ."," . $pagesize;
        return $this->getAll($sql);
    }
    //根据ID获取文章条目
    public function getArticlesById($id){
        $sql = "select * from tuijian where id=" . $id;
        return $this->getAll($sql);
    }
    //根据ID查询该文章的下一条数据
    public function getNextById($id, $category){
        $sql = 'select id,title from tuijian where id > ' . $id . ' and class=' . $category . ' ORDER BY id ASC LIMIT 0,1';
        return $this->getAll($sql);
    }
    //根据ID查询该文章的下一条数据
    public function getPrevById($id, $category){
        $sql = 'select id,title from tuijian where id < ' . $id . ' and class=' . $category . ' ORDER BY id DESC LIMIT 0,1';
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
            $sql="select $field from tuijian WHERE 1".$where.$etc;
        }else{
            $sql="select * from tuijian WHERE 1".$where.$etc;
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
        $sql="delete from tuijian WHERE id = ".$id;
        return $this->query($sql);
    }
}