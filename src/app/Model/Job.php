<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/20
 * Time: 9:27
 */
App::uses('AppModel', 'Model');
class Job extends AppModel
{
    public  $useTable = "job";
    public $pagesize=0;
    public $pagenow=1;
    public function update(array $data,$condition){
        foreach ($data as $k=>$field){
            $data[$k]="'".$field."'";
        }
        $data['update_time']="'".date("Y-m-d H:i:s")."'";
        return $this->updateAll($data,$condition);
    }
    public function add(array $data){
        $data['pub_time']=date("Y-m-d H:i:s");
        $data['update_time']=date("Y-m-d H:i:s");
        return $this->save($data);
    }

    public  function getJobListCount(array $map,$ext='',$whereExt=''){
        $pagesize=$this->pagesize;
        $this->pagesize=0;
        $num=$this->getJobList($map,'count(0) as num',$ext,$whereExt)[0]['num'];
        $this->pagesize=$pagesize;
        return $num;
    }
    public function getJobList(array $map,$field='',$ext='',$whereExt=''){
        $where='';
        if (count($map)>0){
            foreach($map as $key=>$item){
                $where.=" AND ".$key.'='.$item;
            }
        }
        if ($whereExt){
            $where .= ' AND '.$whereExt;
        }
        return $this->getJob($where,$field,$ext);
    }

    public function getJob($where,$field='',$ext){
        $sql='select ';
        $sql.=$field!=''?$field:"*";
        $sql.=' from job where 1 '.$where.' '.$ext;
        if ($this->pagesize>0){
            $sql.=' limit '.($this->pagenow-1)*$this->pagesize.','.$this->pagesize;
        }
//        echo $sql;die;
        return $this->getAll($sql);
    }
}