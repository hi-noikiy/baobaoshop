<?php
/**
 *      [HeYi] (C)2013-2099 HeYi Science and technology Yzh.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      http://www.yaozihao.cn
 *      tel:18519188969
 */
class admin_group_service extends service {	
	public function _initialize() {
		$this->model = $this->load->table('admin_group');
	}
	/**
	 * [获取所有团队角色]
	 * @param array $sqlmap 数据
	 * @return array
	 */
	public function getAll($sqlmap = array()) {
		$this->sqlmap = isset($this->sqlmap)?array_merge($this->sqlmap, $sqlmap):$sqlmap;
		return $this->model->where($this->sqlmap)->select();
	}
	/**
	 * [启用禁用角色]
	 * @param string $id 支付方式标识
	 * @return TRUE OR ERROR
	 */
	public function change_status($id) {
		$result = $this->model->where(array('id' => $id))->save(array('status' => array('exp', '1-status')));
		if ($result == 1) {
			$result = TRUE;
		} else {
			$result = $this->model->getError();
		}
		return $result;
	}
	/**
	 * [更新角色]
	 * @param array $data 数据
	 * @param bool $valid 是否M验证
	 * @return bool
	 */
	public function save($data, $valid = FALSE) {
		runhook('admin_group_save',$data);
		if($valid == TRUE){
			$result = $this->model->update($data);
		}else{
			$result = $this->model->update($data);
		}
		if($result === false) {
			$this->error = $this->model->getError();
			return false;
		}
		return TRUE;
	}
}
