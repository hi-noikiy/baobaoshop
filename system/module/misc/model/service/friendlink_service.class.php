<?php
/**
 *		友情链接服务层
 *      [HeYi] (C)2013-2099 HeYi Science and technology Yzh.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      http://www.yaozihao.cn
 *      tel:18519188969
 */

class friendlink_service extends service {
	public function _initialize() {
		$this->db = $this->load->table('misc/friendlink');	
		$this->article_service = $this->load->service('misc/article');	
	}
	/**
	 * [add 添加]
	 * @return [type] [description]
	 */
	public function add($params){
		$data = array();
		if($params['id']) $data['id'] = $params['id'];
		$data['name'] = $params['name'];
		$data['display'] = $params['display'];
		$data['target'] = $params['target'];
		$data['logo'] = $params['logo'] ? $params['logo'] : '';
		$data['url'] = $params['url'];
		$data['sort'] = $params['sort'];
		runhook('friendlink_add',$data);
		$result = $this->db->update($data);
		if(!$result){
			$this->error = $this->db->getError();
		}
		return $result;
	}
	/**
	 * [get_friendlink_by_id 查询某条数据]
	 * @id [number] 传入的id
	 * @return [type] [description]
	 */
	public function get_friendlink_by_id($id){
		if((int)$id < 1){
			$this->error = lang('_param_error_');
			return FALSE;
		}
		$result = $this->db->find($id);
		if(!$result){
			$this->error = $this->db->getError();
		}
		return $result;
	}
	/**
	 * [edit 编辑]
	 * @return [type] [description]
	 */
	public function edit($params){
		if(!isset($params['id'])){
			$this->error = lang('link_no_exist','misc/language');
			return FALSE;
		}
		$data = array();
		$data['id'] = $params['id'];
		$data['name'] = $params['name'];
		$data['display'] = $params['display'];
		$data['target'] = $params['target'];
		if($params['logo']){
			$data['logo'] = $params['logo'];
		}
		$data['url'] = $params['url'];
		$data['sort'] = $params['sort'];
		runhook('friendlink_edit',$data);
		$result = $this->db->update($data);
		if($result === FALSE){
			$this->error = $this->db->getError();
		}
		return TRUE;
	}
		/**
	 * [ajax_edit 编辑]
	 * @return [type] [description]
	 */
	public function ajax_edit($params){
		if(!isset($params['id'])){
			$this->error = lang('link_no_exist','misc/language');
			return FALSE;
		}
		$result = $this->db->update($this->article_service->assembl_array($params));
		if(!$result){
			$this->error = $this->db->getError();
		}
		return $result;
	}
	/**
	 * [delete 删除]
	 * @return [type] [description]
	 */
	public function delete($params){
		if(!$this->article_service->is_array_null($params)){
			$this->error = lang('link_no_exist','misc/language');
			return FALSE;
		}
		$data = array();
		$data['id'] = array('IN', $params['id']);
		runhook('friendlink_delete',$data);
		$result = $this->db->where($data)->delete();
		if(!$result){
			$this->error = $this->db->getError();
		}
		return $result;
	}
}