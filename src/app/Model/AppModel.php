<?php
App::uses('Model', 'Model');

class AppModel extends Model {

    
	public function checkLogin($data){
        $this->useTable = "users";
        if(!empty($data['username']) && !empty($data['password'])){
            $userName = mysql_escape_string($data['username']);
            $passWord = mysql_escape_string($data['password']);
            $sql = "SELECT * FROM manages WHERE userid = '$userName' AND password = '$passWord' AND delete_flag=0";
            $res = $this->query($sql);
            return $res;
        }
    }

    public function strarray2string($strs){
    	$s = '';
    	if (is_array($strs) && count($strs)) {
    		$s = implode("\",\"", $strs);
    	}

    	return '"'.$s.'"';
    }
	
	public function idarray2string($ids) {
		if (!is_array($ids)) {
			$ids = array($ids);
		}
		
		$ids = array_unique($ids);
		$res =  implode(',', $ids);
		return sf($res);
	}
	
	public function getAll($sql, $k_str='') {
		
		global $echo_sql;
		if (isset($echo_sql) && $echo_sql) {
			prs($sql);
		}
		
		$res = $this->query($sql);
		$data = array();
		if (count($res) >0) {
			foreach($res as $row) {
				if (count($row) > 0) {
					foreach($row as $k=>$v) {
						if ($k_str != "" && isset($v[$k_str])) {
							$data[$v[$k_str]] = $v;
						} else {
							$data[] = $v;
						}
					}
				}
			}
		}
		return $data;
	}
	
	public function getCount($sql, $tb_name, $id_name , $col_name='cnt') {
		$res = $this->query($sql);		
		$data = array();
		if (count($res) > 0) {
			foreach($res as $row) {
				$data[$row[$tb_name][$id_name]] = $row[0][$col_name];
			}
			
			return $data;
		} else {
			return array();
		}
	}
	

	

	


}
