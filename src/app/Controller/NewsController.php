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
class NewsController extends AppController{
    public $layout = "pc_new";
    public $uses = array('Category', 'Articles','Products',"GrUser","Tuijian","Ad");
    public $pagesize=10;

    public function index(){
        
    }
}