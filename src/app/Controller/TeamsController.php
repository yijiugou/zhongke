<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/2
 * Time: 11:20
 */

App::uses('Controller', 'Controller');
class TeamsController  extends AppController {
    public $uses = array('Category', 'Articles',"Products","GrUser","Tuijian",'Comment');
    public $layout = "pc_new";
    public $pagesize=10;

   public function index(){
       
   }
}