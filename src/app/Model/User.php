<?php
App::uses('AppModel', 'Model');

class User extends AppModel {

	public  $useTable = "admin";

	public function getUser($name){
	    $sql="select * from admin where name='".$name."'";
	    $data=$this->getAll($sql);
	    return $data[0];
    }
}