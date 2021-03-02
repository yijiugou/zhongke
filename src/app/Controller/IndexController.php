<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Controller', 'Controller');
/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class IndexController  extends AppController {
	public $uses = array('Articles','Tuijian','Category','Ad');
	public $layout = "pc_new";
	public function index() {
		
	}
    public function more() {
        $pagenow=isset($_GET['p'])?intval($_GET['p']):1;
        //设置分页信息
        $this->Articles->pagenow=$pagenow;
        $this->Articles->pagesize=10;
        //文章
        $map=array('_orderBy'=>' ORDER BY pubdate DESC');
        $params['cates'] = $this->Category->getIndexIdList();
        $data=$this->Articles->getArticleList($map);
        $params['list']=$data;          //文章列表
        //页面设置
        $this->layout = "";    //分页里面吧layout清掉了
        $this->setpm($params);
        $this->render('more');
    }
	public function detail(){
		$params['action_name'] = "资讯详情 - 消费评论";
		$id = isset($_GET['id']) ? $_GET['id'] : 0;
		$params['tabID'] = isset($_GET['tabID']) ? $_GET['tabID'] : 2;
		$params['info'] = $this->Articles->getArticlesById($id)[0];
		$params['next'] = $this->Articles->getNextById($params['info']['id'], $params['info']['class']);
		if ($params['next']) {
			$params['next'] = $params['next'][0];
		}
		if(isset($_SERVER['HTTP_REFERER']))
			$params['back_url'] = $_SERVER['HTTP_REFERER'];
		$this->setpm($params);
		// if ($this->device_type != "pc" ) {
		// 	$this->layout = "mobi_view";
		// 	return $this->render('detail_m');
		// }
	}
}
