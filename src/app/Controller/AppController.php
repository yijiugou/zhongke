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

/**a
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {


	public $device_type = 'pc';
	function __construct($request = null, $response = null){
		parent::__construct($request, $response);
		$this->siteInfo();
	}
	public function siteInfo(){
		$params = [
			'site_name'=>'中科赛亚',
			'keywords'=>''
		];
		$params['menus'] = [
			['name'=>'细胞工程','url'=>'','action'=>''],
			['name'=>'基因药物','url'=>'','action'=>''],
			['name'=>'医疗器械','url'=>'','action'=>''],
			['name'=>'技术服务','url'=>'','action'=>'']
		];
		$this->setpm($params);
	}
	public function checkRetailer(){
		if ($this->Session->read('user_login') != 1 || $this->Session->read('user_type') != 'retailer'){
			$this->redirect('/login/retailer');
		}
	}

	public function checkCompany(){
		if ($this->Session->read('user_login') != 1 || $this->Session->read('user_type') != 'company'){
			$this->redirect('/login/company');
		}
	}

	public function checkLogin(){
		if ($this->Session->read('user_login') != 1){
			$this->redirect('/login');
		}
	}


	public function setBk() {
		if (isset($_GET['bk'])) {
			$this->Session->write("bk_url", $_GET['bk']);	
		}
	}
	
	public function getBk() {
		$bk = "";
		if ($this->Session->check('bk_url')) {
			$bk = $this->Session->read('bk_url');
		}
		$this->Session->delete('bk_url');
		return $bk;
	}


	public function beforeFilter(){

		$params['name'] = strtolower($this->name);
		$params['action'] = strtolower($this->action);
		$this->device_type = $this->get_device_type();
		$params['device_type'] = $this->device_type;

		$params['back_url'] = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : "";

		if ($this->Session->read('user_login') == 1) {
			$this->loginUser  = $this->Session->read('user_info');
			$this->loginType  = $this->Session->read('user_type');
			$this->isLogin    = $this->Session->read('user_login');	
			$this->userAuth   = $this->Session->read('user_auth');	

			if (isset($this->userAuth) && $this->userAuth['user_type'] != 'company_admin') {
				$this->staff_id = $this->userAuth['user_id'];
				$this->staff_name = $this->userAuth['user_name'];
				$this->auth_type = $this->userAuth['auth_type'];
			} else {
				$this->staff_id = 0;
				$this->staff_name = "后台管理员";
				$this->auth_type = 'company_admin';
			}
			
			$params['isLogin']    = $this->isLogin;
			$params['loginType']  = $this->loginType;
			$params['loginUser']  = $this->loginUser;
			$params['userAuth']   = $this->userAuth;
			$params['authType']   = $this->auth_type;

		} else {
			$this->isLogin = 0;
		}


    	global $NET_SET;
		$this->set("NET_SET" , $NET_SET);

		$b_name = "";
		switch ($params['name']) {
			case 'company':
			$b_name = '厂家信息管理';
			break;
			case 'mngcompany':
			$b_name = '厂家信息管理';
			break;
			case 'product':
			$b_name = "产品管理";
			break;
			case 'retailer':
			$b_name = "零售商管理";
			break;
			case 'mngretailer':
			$b_name = "零售商管理";
			break;
			case 'mngcustomer':
			$b_name = "消费者管理";
			break;
			case 'prize':
			$b_name = "红包管理";
			break;
			case 'mngprize':
			$b_name = "红包管理";
			break;
			case 'sell':
			$b_name = "销售返点管理";
			break;
			case 'mngsell':
			$b_name = "销售返点管理";
			break;
			case 'ad':
			$b_name = "图文广告管理";
			break;
			case 'account':
			$b_name = "账户余额管理";
			break;
			case 'reretailer':
			$b_name = "零售商管理";
			break;
			case 'oa':
			$b_name = "进销存管理";
			break;
		}

		//$this->checkAuth();


		$params['b_name'] = $b_name;
		$this->setpm($params);
	}

	private function checkAuth(){
		$auth = $this->userAuth;
		$c_name = $this->name;

		$error = 1;
		$a_name = $this->action;

		if ($c_name == 'Login') return ;

		if ($auth['user_type'] != 'company_admin') {
			//prs($this->userAuth);

			//库存管理
			if ($c_name == 'Oa') {
				if ($a_name == 'stockdetail') {
					if (!in_array('oa-detail',$auth['auth_set'])) {
						$error = 0;
					}
				}
			}

			if ($error != 1) {
				$this->Session->setFlash("用户权限不足", 'flash_error');
				$this->redirect("/login");
			}
		}
		
	}

	public function setpm($params) {
		if (is_array($params) && count($params) > 0){
			foreach($params as $k=>$v){

				$this->set($k, $v);
			}
		}
	}


	public function get_device_type() {
	 //全部变成小写字母
	 $agent = strtolower($_SERVER['HTTP_USER_AGENT']);
	 $type = 'pc';
	 //分别进行判断
	 if(strpos($agent, 'iphone') || strpos($agent, 'ipad'))
	{
	   $type = 'ios';
	 } 
	 
	 if(strpos($agent, 'android'))
	{
	   $type = 'android';
	 }
	 return $type;
	}
}

