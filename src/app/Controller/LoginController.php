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
class LoginController  extends AppController {

	public $layout = "pc_login_view";

	public $uses = array('Retailer', 'Company', 'User', 'Userauth');

	public function index() {

		$params['action_name'] = '用户登录';

		$this->Session->delete('user_info');
		$this->Session->delete("user_login");
		$this->Session->delete("user_type");
		$this->Session->delete("user_auth");

		$params = array();
		$this->setpm($params);
	}

	public function retailer(){

		$this->Session->delete('user_info');
		$this->Session->delete("user_login");
		$this->Session->delete("user_type");
		$this->Session->delete("user_auth");


		if ($this->data) {
			$res = $this->Retailer->checkLogin($this->data);

			if (isset($res[0]) && isset($res[0]['retailer_tbl'])) {
				$this->Session->write('user_login', 1);
				$this->Session->write('user_type','retailer');
				$this->Session->write('user_info', $res[0]['retailer_tbl']);


				$params['data'] = $res[0]['retailer_tbl'];

				$this->Session->setFlash('登录成功。', 'flash_success');

				$this->setpm($params);
				$this->redirect('/ReRetailer/index');


			} else{
				$this->Session->setFlash('登录手机号与密码不正确，请重新登录。', 'flash_error');
				$params['data'] = $this->data;
				$this->setpm($params);
			}
		}
	}


	public function mng(){

		if ($this->data) {
		    $data=$this->User->getUser(trim($this->data['mng_name']));
			if (md5($this->data['mng_pwd']) == $data['pw']) {
				$this->Session->write('user_login', 1);
				$this->Session->write('user_type','admin');
				$this->Session->write('user_info', array());

				$this->Session->setFlash('登录成功。', 'flash_success');
				$this->redirect('/Mngaccount/view');

			} else{
				$this->Session->setFlash('用户名密码不正确，请重新登录。', 'flash_error');
				$params['data'] = $this->data;
				$this->setpm($params);
			}

			
		}
	}

	public function logout(){
		$this->Session->delete('user_info');
		$this->Session->delete("user_login");
		$this->Session->delete("user_type");
		$this->Session->delete("user_auth");
		$this->Session->delete("tp_login");
		
		$this->redirect("/login/mng");
		
		exit;
	}


	public function retailerregister(){

		$this->Session->delete('user_info');
		$this->Session->delete("user_login");
		$this->Session->delete("user_type");
		$this->Session->delete("user_auth");

		if(!empty($this->data)){
			$data = $this->data;
			$errs = $this->checkRetailerregister($data);

			if(empty($errs)){
		
				$data['retailer_shortname'] = trim($data['retailer_shortname']);
				$data['retailer_name'] = trim($data['retailer_name']);

				$this->Retailer->save($data);
				$this->Session->setFlash("零售商用户注册成功,请登录!",'flash_success');
				$this->redirect("/login/retailer");
			}else{

				$this->set("data" , $this->data);
				$this->set("errs" , $errs);
			}
		}
	}



	public function checkRetailerregister($data) {

		 $errs = array();

		 if(isEmpty($data['retailer_shortname'])){
		 	$errs['retailer_shortname'] = "请输入称零售商简称";
		 }
		  else {
		 	$retailer_shortname = trim($data['retailer_shortname']);
		 	$data['retailer_shortname'] = trim($data['retailer_shortname']);
		 	$res = $this->Retailer->find('all', array('conditions'=> array('retailer_shortname'=>$retailer_shortname)));
		 	if(count($res)){
		 		$errs['retailer_shortname'] = "零售商简已存在";
		 	}
		 }
		 
		 if(isEmpty($data['retailer_name'])){
		 	$errs['retailer_name'] = "请输入零售商全称";
		 } else {
		 	$retailer_name = trim($data['retailer_name']);

		 	$res =  $this->Retailer->find('all', array('conditions'=> array('retailer_name'=>$retailer_name)));
		 
		 	if($res){
		 		$errs['retailer_name'] = "零售商全称已存在";
		 	}	
		 }


		 if(!isset($data['retailer_county']) || ($data['retailer_county']) < 1){
		 	$errs['retailer_county'] = "请选择零售商地址";
		 }

		 if(isEmpty($data['retailer_address'])){
		 	$errs['retailer_address'] = "请输入街道详细";
		 }
		 if(isEmpty($data['retailer_username'])){
		 	$errs['retailer_username'] = "请输入负责人";
		 }
		 if(isEmpty($data['retailer_usertel'])){
		 	$errs['retailer_usertel'] = "请输入手机号";
		 } else {
		 	if (!isMobile($data['retailer_usertel'])) {
		 		$errs['retailer_usertel'] = "请输入正确的手机号";
		 	}

		 	$retailer_usertel = trim($data['retailer_usertel']);
			$res = $this->Retailer->find('all',array('conditions'=> array('retailer_usertel'=>$retailer_usertel)));
			if($res){
				$errs['retailer_usertel'] = "手机号已存在";
			}
		 }

		 if(isEmpty($data['retailer_usermail'])){
		 	$errs['retailer_usermail'] = "请输入邮箱地址";
		 } else {
		 	if (!isEmail($data['retailer_usermail'])) {
		 		$errs['retailer_usermail'] = "请输入正确的邮箱地址";
		 	}

		 	$retailer_usermail = trim($data['retailer_usermail']);
			$res = $this->Retailer->find('all',array('conditions'=> array('retailer_usermail'=>$retailer_usermail)));
			if($res){
				$errs['retailer_usermail'] = "邮箱地址已存在";
			}

		 }

		 if(isEmpty($data['retailer_pwd'])){
		 	$errs['retailer_pwd'] = "请输入登录密码";
		 }
		 
		 if(isEmpty($data['retailer_pwd2'])){
		 	$errs['retailer_pwd2'] = "请输入确认密码";
		 }

		 if (!isEmpty($data['retailer_pwd2']) && !isEmpty($data['retailer_pwd'])) {
		 	if ($data['retailer_pwd2'] != $data['retailer_pwd']) {
		 		$errs['retailer_pwd2'] = "确认密码不正确";
		 	}
		 }
		 

		return $errs;
	}

	public function companyregister(){

		$this->Session->delete('user_info');
		$this->Session->delete("user_login");
		$this->Session->delete("user_type");
		$this->Session->delete("user_auth");

        if(!empty($this->data)){
			$data = $this->data;
			
			$errs = $this->checkCompanyregister($data);
			// var_dump(getPY($data['company_shortname']));

            if(empty($errs)){
            	
            	$data['company_py'] = getPY($data['company_shortname']);
            	

				//商城端 品牌插入
				App::import('controller','Api');
				$api = new ApiController();
				@$id = $api->companyAdd($data);
				$data['shop_id'] = $id;

				$data['company_account'] = 0;


				$res = $this->Company->save($data);
				if ($res) {
					$this->Session->setFlash("厂商用户注册成功,请登录!",'flash_success');
					$this->redirect("/login/company");	
				} else {
					$this->Session->setFlash("厂商用户注册失败!",'flash_error');
					$this->set("data" , $this->data);
				}
				
		    }else{
		    	$this->set("data" , $this->data);
				$this->set("errs" , $errs);
		    }
		}
	}

	public function checkCompanyregister($data) {

		$errs = array();

		if(isEmpty($data['company_shortname'])){
		 	$errs['company_shortname'] = "请输入厂家简称";
		} else {
		 	$company_shortname = trim($data['company_shortname']);
		 	$data['company_shortname'] = trim($data['company_shortname']);
		 	
		 	$res = $this->Company->find('all', array('conditions'=> array('company_shortname'=>$company_shortname)));
		 	if(count($res)){
		 		$errs['company_shortname'] = "厂家简称已存在";
		 	}else{
		 		$getPY = getPY($data['company_shortname']);
		 		if(empty($getPY)){
		 		$errs['company_shortname'] = "很抱歉,厂家拼音未取到,请重新输入";
		 	    }
		 		$getCompanyPy = $this->Company->find('all',array('conditions'=>array('company_py'=>$getPY)));
			 	if(count($getCompanyPy)){
			 		$errs['company_shortname'] = "厂家拼音已重复";
			 	}
		 	}
		}

		 
		if(isEmpty($data['company_name'])){
		 	$errs['company_name'] = "请输入厂家全称";
		} else {
		 	$company_name = trim($data['company_name']);

		 	$res =  $this->Company->find('all', array('conditions'=> array('company_name'=>$company_name)));
		 
		 	if($res){
		 		$errs['company_name'] = "厂家全称已存在";
		 	}	
	    }


		if(!isset($data['company_county']) || ($data['company_county']) < 1){
		 	$errs['company_county'] = "请选择厂家地址";
		}

		if(isEmpty($data['company_address'])){
		 	$errs['company_address'] = "请输入街道详细";
		}
		if(isEmpty($data['company_username'])){
		 	$errs['company_username'] = "请输入负责人";
		}
		if(isEmpty($data['company_usertel'])){
		 	$errs['company_usertel'] = "请输入手机号";
		}else{
			if (!isMobile($data['company_usertel'])) {
		 		$errs['company_usertel'] = "请输入正确的手机号";
		 	}

			$company_usertel = trim($data['company_usertel']);
			$res = $this->Company->find('all',array('conditions'=> array('company_usertel'=>$company_usertel)));
			if($res){
				$errs['company_usertel'] = "联系方式已存在";
			}
		}
		if(isEmpty($data['company_usermail'])){
		 	$errs['company_usermail'] = "请输入邮箱地址";
		}else{

			if (!isEmail($data['company_usermail'])) {
		 		$errs['company_usermail'] = "请输入正确的邮箱地址";
		 	}

			$company_usermail = trim($data['company_usermail']);
			$res = $this->Company->find('all',array('conditions'=> array('company_usermail'=>$company_usermail)));
			if($res){
				$errs['company_usermail'] = "邮箱地址已存在";
			} 	
		}
		if(isEmpty($data['company_pwd'])){
		 	$errs['company_pwd'] = "请输入登录密码";
		}
		 
		if(isEmpty($data['company_pwd2'])){
		 	$errs['company_pwd2'] = "请输入确认密码";
		}

		if (!isEmpty($data['company_pwd2']) && !isEmpty($data['company_pwd'])) {
		 	if ($data['company_pwd2'] != $data['company_pwd']) {
		 		$errs['company_pwd2'] = "确认密码不正确";
		 	}
		}
		 

		return $errs;
	}


	public function user() {
		$this->Session->delete('user_info');
		$this->Session->delete("user_login");
		$this->Session->delete("user_type");
		$this->Session->delete("user_auth");

		if ($this->data) {
			$data = $this->data;
			$res =  $this->User->find('all', array('conditions'=> array('user_tel'=>trim($data['user_tel']), 'user_pwd'=>trim($data['user_pwd']))));

			if (isset($res[0]) && isset($res[0]['User'])) {

				$cmpInfo = $this->Company->find('all', array('conditions'=> array('id'=> $res[0]['User']['company_id'])));
				$auth = $this->Userauth->find('all', array('conditions'=> array('id'=> $res[0]['User']['auth_id'])));

				$userInfo['user_type'] = 'company_user';
				$userInfo['user_id']   = $res[0]['User']['id'];
				$userInfo['auth_type'] = $res[0]['User']['auth_type'];
				$userInfo['auth_name'] = $auth[0]['Userauth']['auth_name'];
				$userInfo['user_name'] = $res[0]['User']['user_name'];
				$userInfo['user_tel']  = $res[0]['User']['user_tel'];
				$userInfo['auth_set']  = json_decode($auth[0]['Userauth']['auth_set']);



				$this->Session->write('user_login', 1);
				$this->Session->write('user_type','company');
				$this->Session->write('user_info', $cmpInfo[0]['Company']);
				$this->Session->write('user_auth', $userInfo);

				$params['data'] = $cmpInfo[0]['Company'];

				$this->Session->setFlash('登录成功。', 'flash_success');

				$this->setpm($params);
				$this->redirect('/Company/userlogin');


			} else{
				$this->Session->setFlash('登录手机号与密码不正确，请重新登录。', 'flash_error');
				$params['data'] = $this->data;
				$this->setpm($params);
			}

			
		}

	}

	public function tp() {
		if ($this->data) {
			$data = $this->data;
			if ($data['user_tel'] == '95dingzhi'  && $data['user_pwd'] == '95dingzhi') {
				$this->Session->write('tp_login', 1);
				$this->Session->setFlash('登录成功。', 'flash_success');
				$this->redirect('/Tp/show');

			} else {
				$this->Session->write('tp_login', 0);
				$this->Session->setFlash('登录用户名或密码不正确，请重新登录。', 'flash_error');
			}
		}
		$this->render('user');
	}

	public function company(){

		$this->Session->delete('user_info');
		$this->Session->delete("user_login");
		$this->Session->delete("user_type");
		$this->Session->delete("user_auth");

		if ($this->data) {
			$res = $this->Company->checkLogin($this->data);

			if (isset($res[0]) && isset($res[0]['company_tbl'])) {
				$this->Session->write('user_login', 1);
				$this->Session->write('user_type','company');
				$this->Session->write('user_info', $res[0]['company_tbl']);

				$userInfo['user_type'] = 'company_admin';

				$this->Session->write('user_auth', $userInfo);


				$params['data'] = $res[0]['company_tbl'];

				$this->Session->setFlash('登录成功。', 'flash_success');

				$this->setpm($params);
				$this->redirect('/Company/index');


			} else{
				$this->Session->setFlash('用户名密码不正确，请重新登录。', 'flash_error');
				$params['data'] = $this->data;
				$this->setpm($params);
			}

			
		}
	}


}
