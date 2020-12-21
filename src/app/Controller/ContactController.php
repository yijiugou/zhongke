<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/12
 * Time: 9:17
 * 人才发展
 */
App::uses('Controller','Controller');
class ContactController extends AppController{
    public $layout = "pc_new";

    /**
     * 联系我们
     */
    public function index(){
        $params=array(
            'banner'=>'/img/yjkg/news9.jpg',
            'company_name'=>'四川易酒控股有限公司',
            'phone'=>'028 8673 7358',
            'address'=>'四川省成都市青羊工业园区N区7栋',
            'postcode'=>'610073'
        );
        $params['action_name'] = "联系我们 - 易酒控股";
        $this->setpm($params);
    }
}