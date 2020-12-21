<?php
App::uses('Controller', 'Controller');
 
class MngaccountController  extends AppController {
	public $uses = array(   'Company', 'Accountlog');
	public $layout = "pc_admin_view";

	public function beforeFilter(){
		parent::beforeFilter();

		if ($this->Session->read('user_login') != 1 || $this->Session->read('user_type') != 'admin'){
			$this->redirect('/login/mng');
		}
		
	}

	public function index() {
		
	}

    public function view() {
		
	}

	public function recharge(){
		$params['action_name'] = '账户日志一览';



		$data = $_REQUEST;

		$data['company_id'] = $_GET['id'];
		$cmpInfo = $this->Company->getCmpInfoById($data['id']);



		if(!empty($this->data)){


			$in['company_id'] = $_GET['id'];
			$in['account_type'] = 0;
			$in['inout_flg'] = 1;
			$in['accunt_size'] = $data['input_account'];
			$in['pay_way'] = 'admin';
			$in['remain'] = $cmpInfo[0]['company_account'] + $this->data['input_account'];
			$in['createtime'] = getTime();

			$cmpInfo[0]['company_account']  = $in['remain'];

			$log = $this->Accountlog->save($in);
	
			if ($log) {
				$res = $this->Company->updateAll( array('company_account'=> 'company_account + '.$this->data['input_account']), array('id'=>$in['company_id']) );
				if ($res) {
					$this->Session->setFlash("充值成功", 'flash_success');
					$this->redirect('/Mngaccount/recharge?id='.$_GET['id']);
				} else {
					$this->Session->setFlash("充值失败", 'flash_error');
				}
			} else{
				$this->Session->setFlash("日志添加失败", 'flash_error');
			}
		}

		$logs = $this->Company->getAllCompanylogs($data);


		$cmpInfo = $this->Company->getCmpInfoById($data['id']);
		$params['info'] = $cmpInfo[0];

		$params['data'] = $data;
		$params['logs'] = $logs['data'];
		$params['count'] = $logs['count'];
		$this->setpm($params);
		

	}
}
