<?php
/**
 *      后台支付设置控制器
 *      [HeYi] (C)2013-2099 HeYi Science and technology Yzh.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      http://www.yaozihao.cn
 *      tel:18519188969
 */
hd_core::load_class('init', 'admin');
class admin_control extends init_control {

    public function _initialize() {
        parent::_initialize();
        $this->service = $this->load->service('payment');
        $this->payments = $this->service->fetch_all();
    }

    /**
     * 获取支付方式列表
     */
    public function setting() {
        $payments = $this->payments;
        $this->load->librarys('View')->assign('payments',$payments)->display('setting');
    }

    /**
     * 配置支付方式
     */
    public function config() {

        $pay_code = $_GET['pay_code'];
        $payment = $this->payments[$pay_code];
        if (checksubmit('dosubmit')) {
            $_POST['config'] = serialize($_POST['config']);
            if ($this->service->save($_POST)) {
            	$this->service->build_cache();
                showmessage(lang('_enabled_success_','pay/language'), url('setting'), 1);
            } else {
                showmessage(lang('_enabled_error_','pay/language'), url('setting'), 0);
            }
        } else {
            $this->load->librarys('View')->assign('pay_code',$pay_code)->assign('payment',$payment)->display('config');
        }
    }

    /**
     * 启用禁用支付方式
     */
    public function ajax_enabled() {
        $paycode = $_POST['paycode'];
        if ($this->service->change_enabled($paycode)) {
            showmessage(lang('_enabled_success_','pay/language'), '', 1);
        } else {
            showmessage(lang('_enabled_error_','pay/language'), '', 0);
        }
    }

    /**
     * 卸载支付方式
     */
    public function uninstall() {
        $pay_code = $_GET['pay_code'];
        $data = array();
        $data['pay_code'] = $pay_code;
        $this->load->table('payment')->where(array('pay_code'=>$pay_code))->delete();
		$this->service->build_cache();
        showmessage(lang('_uninstall_success_','pay/language'), url('setting'), 1);
    }

}
