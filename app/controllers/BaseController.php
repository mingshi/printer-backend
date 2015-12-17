<?php
define('ERR_MSG_DATABASE', '数据库错误。');
define('ERR_MSG_USER_NOT_EXISTS', '用户不存在。');
define('ERR_MSG_PARAM_MISSING', '缺少参数。');
define('ERR_MSG_PARAM_INVALID', '无效的参数。');
define('ERR_MSG_ACCESS_DENY', '你没有权限进行该操作。');
define('ERR_MSG_SAVE_SUCC', '保存成功。');
define('ERR_MSG_REDIRECT', 'ERR_MSG_REDIRECT');


class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
     */

    public $isAjax = FALSE;
	protected $admin_id = 0;
    protected $is_super_admin = FALSE;

    public function __construct()
    {
   		if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
            $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'
        ) {
            $this->isAjax = TRUE;
        } 
		$admin_id = Cookie::get('admin_id');
        $this->admin_id = $admin_id;

		        $is_super_admin = FALSE;
        if ($admin_id) {
            $admin = AdminORM::find($admin_id);
            if ($admin->is_super_admin == 1) {
                $is_super_admin = TRUE;
                $this->is_super_admin = TRUE;
            }
        }

		View::share(
            'g',
            array(
                'is_super_admin' => $is_super_admin,
            )
        );
    }

	protected function _fail($msg, $redirect_uri = '')
    {
        if ($this->isAjax) {
            $ret = array(
                'code' => -1,
                'msg' => $msg,
            );

            if (!empty($redirect_uri)) {
                $ret['redirect_uri'] = $redirect_uri;
            }

            echo json_encode($ret);
            exit;
        }

        $this->_setFlashMsg('error', $msg);
    }

	protected function _succ($msg = ERR_MSG_SAVE_SUCC, $data = array(), $onlySet = FALSE)
    {
        if ($this->isAjax && !$onlySet) {
            if ($msg == ERR_MSG_REDIRECT || (isset($data) && !empty($data))) {
                if ($msg == ERR_MSG_REDIRECT) {
                    $ret = array(
                        'code' => 0,
                        'redirect_uri' => $data,
                    );
                } else {
                    $ret = array(
                        'code' => 0,
                        'msg' => $msg,
                        'redirect_uri' => $data,
                    );
                }
                if (is_array($data)) {
                    $ret['redirect_uri'] = $data['redirect_uri'];
                    $ret['msg'] = $data['msg'];
                }
            } else {
                $ret = array(
                    'code' => 0,
                    'msg' => $msg,
                    'data' => $data,
                );
            }
            echo json_encode($ret);
            exit;
        }

        $this->_setFlashMsg('succ', $msg);
    }

	protected function _setFlashMsg($type, $msg)
    {
        $option = array(
            'type' => $type,
            'msg' => $msg,
            'time' => time(),
        );
        $this->set_default_cookie('F_MSG', $option);
    }

    protected function set_default_cookie($name, $value, $expires = 0)
    {
        if (is_array($value)) {
            $value = json_encode($value);
        }
        $domain = $_SERVER['HTTP_HOST'];
        setcookie($name, $value, $expires, '/', $domain);
        $_COOKIE[$name] = $value;
    }

    protected function unset_default_cookie($name)
    {
        $domain = $_SERVER['HTTP_HOST'];
        setcookie($name, '', time() - 3600 * 24 * 365, '/', $domain);
        unset($_COOKIE[$name]);
    }

	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

}
