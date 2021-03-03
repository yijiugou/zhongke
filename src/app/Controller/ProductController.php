<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/11
 * Time: 14:59
 */
App::uses('Controller', 'Controller');
class ProductController extends AppController{
    public $layout = "pc_new";

    public function index() {

	}

    public function service(){
       
        $params['action_name'] = "产业布局 - 易酒控股";
        $this->setpm($params);
        return $this->render();
    }
}