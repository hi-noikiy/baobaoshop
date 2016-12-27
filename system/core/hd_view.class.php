<?php
/**
 *      [HeYi] (C)2013-2099 HeYi Science and technology Yzh.
 *      This is NOT a freeware, use is subject to license terms
 *
 *      http://www.yaozihao.cn
 *      tel:18519188969
 */
class hd_view {
	//模版变量
	private $data = array();
    protected static $_instance;
    
    private function __construct(){}

    private function __clone(){}

    public static function getInstance(){
        if (self::$_instance === null) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
	/**
	 * [assign 模版变量赋值]
	 * @param  [type] $name  [description]
	 * @param  string $value [description]
	 * @return [type]        [description]
	 */
	public function assign($name,$value = ''){
		if (is_array($name)) {
            $this->data = array_merge($this->data, $name);
            return $this;
        } else {
            $this->data[$name] = $value;
        }
        return $this;
    }
    /**
     * [get 获取变量]
     * @return [type] [description]
     */
    public function get($name = ''){
        runhook('pre_response');
        return $this->fetch($name);
    }
     /**
     * [get 获取变量]
     * @return [type] [description]
     */
    public function fetch($name = ''){
        $data = array();
        if(empty($name)){
            $data = $this->data;
        }else{
            $data = $this->data[$name];
        }
        return $data;
    }
    /**
     * [display 输出模版]
     * @param  [type] $template [description]
     * @param  string $type     [description]
     * @return [type]           [description]
     */
    public function display($_display_template = ''){
        // 视图开始
        runhook('pre_output');
        extract($this->data, EXTR_OVERWRITE);
    	include template($_display_template);
    }
}