<?php
App::uses('Controller', 'Controller');

class AjaxappController  extends Controller {
	

	public $uses = array('Articles');

	public $layout = "ajax";

	public function getNewsList(){
		$id = isset($_POST['id']) ? $_POST['id'] : 2;
		$p = isset($_POST['pageIndex']) ? $_POST['pageIndex'] : 1;
		$s = isset($_POST['pageSize']) ? $_POST['pageSize'] : 2;
		$sort = isset($_POST['sort']) ? $_POST['sort'] : '';

		if ($id == 2) {
			$category = 14;
		} elseif($id == 1) {
			$category = 15;
		} else if($id == 0) {
			$category = 16;
		}else {
			$category = 13;
		}
		
		$a_info = $this->Articles->getArticlesList($category, $p, $s, $sort);
		$total = intval($this->Articles->getArticleListCount(array('cate_id' => $category))[0]['num']);
		$tot = ($total%2 == 0) ? (floor($total/2)) : (floor($total/2) + 1);
		echo json_encode(array('data' => $a_info, 'total' => $tot, 'pageIndex' => $p, 'pageSize' => $s, 'allcount' => $total));
		exit;
	}
}