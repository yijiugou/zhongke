<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/20
 * Time: 9:27
 */
App::uses('AppModel', 'Model');
class Products extends AppModel
{
    public  $useTable = "products";
    public $pagesize=0;
    public $pagenow=1;
    public function update(array $data,$condition){
        foreach ($data as $k=>$field){
            $data[$k]="'".$field."'";
        }
        $data['updatetime']=time();
        return $this->updateAll($data,$condition);
    }
    public function addproduct(array $data){
//        $data['pub_time']=date("Y-m-d H:i:s");
        $data['updatetime']=time();
        return $this->save($data);
    }

    public function getlist($where='',$etc='',$field=''){
        if ($this->pagenow>0){
            $etc.=' limit '.($this->pagenow-1)*$this->pagesize.','.$this->pagesize;
        }
        if ($field){
            $sql="select $field from products WHERE 1".$where.$etc;
        }else{
            $sql="select * from products WHERE 1".$where.$etc;
        }
        return $this->getAll($sql);
    }

    public function count($where=''){
        $pagenow=$this->pagenow;
        $this->pagenow=0;
        $data = $this->getlist($where,'','count(1) as num');
        $this->pagenow=$pagenow;
        return $data;
    }

}