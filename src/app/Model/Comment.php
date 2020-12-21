<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/20
 * Time: 9:27
 */
App::uses('AppModel', 'Model');
class Comment extends AppModel
{
    public  $useTable = "comment";
    public $pagesize=5;
    public $pagenow=1;
    public function update(array $data,$condition){
        foreach ($data as $k=>$field){
            $data[$k]="'".$field."'";
        }
        $data['update_time']="'".date("Y-m-d H:i:s")."'";
        return $this->updateAll($data,$condition);
    }
    public function reply(array $data){
        $res = $this->save($data);
        if($res){
            $d['reply_num'] = 'reply_num+1';
            $w['id'] = $data['reply_id'];
            return $this->updateAll($d,$w);
        }
        return false;
    }
    public function add(array $data){
        $data['pub_time']=date("Y-m-d H:i:s");
        $data['update_time']=date("Y-m-d H:i:s");
        return $this->save($data);
    }

    public  function getPageCount($art_id){
        $map = ['art_id'=>$art_id,'reply_id'=>0];
        $num=$this->getList($map,'count(0) as num')[0]['num'];
        return ceil($num/$this->pagesize);
    }
    public  function getListCount(array $map,$ext='',$whereExt=''){
        $pagesize=$this->pagesize;
        $this->pagesize=0;
        $num=$this->getList($map,'count(0) as num',$ext,$whereExt)[0]['num'];
        $this->pagesize=$pagesize;
        return $num;
    }
    public function getList(array $map,$field='',$ext='',$whereExt=''){
        $where='';
        if (count($map)>0){
            foreach($map as $key=>$item){
                $where.=" AND ".$key.'='.$item;
            }
        }
        if ($whereExt){
            $where .= ' AND '.$whereExt;
        }
        return $this->getComment($where,$field,$ext);
    }
    public function getReply($where,$field='',$ext){
        $sql='select ';
        $sql.=$field!=''?$field:"*";
        $sql.=' from comment where 1 '.$where.' '.$ext;
        if ($this->pagesize>0){
            $sql.=' limit '.($this->pagenow-1)*$this->pagesize.','.$this->pagesize;
        }
//        echo $sql;die;
        return $this->getAll($sql);
    }
    public function getComment($where,$field='',$ext){
        $sql='select ';
        $sql.=$field!=''?$field:"*";
        $sql.=' from comment where 1 '.$where.' '.$ext;
        if ($this->pagesize>0){
            $sql.=' limit '.($this->pagenow-1)*$this->pagesize.','.$this->pagesize;
        }
        //echo $sql;die;
        return $this->getAll($sql);
    }
}