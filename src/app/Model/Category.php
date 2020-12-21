<?php
App::uses('AppModel', 'Model');

class Category extends AppModel {

    public  $useTable = "class";
    public $primaryKey = 'class_id';
    public function getCategoryTree(){
        $data=$this->getAllCategory();
        return $this->getTree($data);
    }
    protected function getTree($data,$pId=0){
        $tree = array();
        foreach($data as $k => $v)
        {
            if($v['parent_id'] == $pId)
            {        //父亲找到儿子
                $v['child'] = $this->getTree($data, $v['class_id']);
                $tree[] = $v;
            }
        }
        return $tree;
    }
    public function getAllCategory(){
        return $this->getCategory();
    }
    public function getIndexIdList(){
        $list = $this->getCategory();
        $tmp = [];
        foreach($list as $v){
            $tmp[$v['class_id']] = $v;
        }
        return $tmp;
    }
    public function getCategory($where=''){
        $sql="select * from class WHERE 1 ".$where;
        return $data=$this->getAll($sql);
    }

    public function categoryAdd($data){
        return $this->save($data);
    }

    public function categoryEdit($data,$condition){
        return $this->updateAll($data,$condition);
    }
    public function categoryDelete($id){
        return $this->delete($id);
    }
}