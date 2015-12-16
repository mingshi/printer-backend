<?php
/**
 * @FileName    :   EntryController.php
 * @QQ          :   224156865
 * @date        :   2015/12/16 15:40:51
 * @link
 * @Auth        :   Mingshi <fivemingshi@gmail.com>
 */

require_once(app_path() . "/library/Captcha.php");

class EntryController extends BaseController
{
    public function home()
    {
        return Redirect::route('userLists');
    }

    public function login()
    {
        return View::make('login.login');
    }

    public function dologin()
    {
        $params = Input::all();
        if (empty($params['username'])) {
            Session::flash('error', '用户名必须填写');
            return Redirect::route('login');
        }

        if (empty($params['password'])) {
            Session::flash('error', '密码必须填写');
            return Redirect::route('login');
        }

        if (empty($params['captcha'])) {
            Session::flash('error', '验证码必须填写');
            return Redirect::route('login');
        }

        if (!$this->_validate_captcha($params['captcha'])) {
            Session::flash('error', '验证码错误');
            return Redirect::route('login');
        }

        $password = md5(md5($params['password']));
        $admin = AdminORM::whereUsername($params['username'])->wherePwd($password)->where('status', '<>', BaseORM::DISABLE)->first();
        if (!empty($admin)) {
            Session::flash('success', '登陆成功');
            $admin_id_cookie = Cookie::forever('admin_id', $admin->id);
            $admin_username_cookie = Cookie::forever('admin_username', $admin->username);
            $k_cookie = Cookie::forever('k', Crypt::encrypt($admin->id . $admin->username));
            $login_time_cookie = Cookie::forever('login_time', time());
            return Redirect::route('home')->withCookie($k_cookie)->withCookie($admin_id_cookie)->withCookie($admin_username_cookie)->withCookie($login_time_cookie);
        } else {
            Session::flash('error', '用户没找到');
            return Redirect::route('login');
        }
    }

   	public function logout()
    {
        $admin_id = Cookie::forget('admin_id');
        $admin_username = Cookie::forget('admin_username');
        $k = Cookie::forget('k');
        $login_time = Cookie::forget('login_time');
		return Redirect::route('thome')->withCookie($k)->withCookie($admin_id)
            ->withCookie($admin_username)->withCookie($login_time);
    } 

	public function captcha()
    {
        return $this->_create_captcha();
    }

    private function _create_captcha()
    {
        $fonts = array(
            public_path() . '/fonts/VeraBd.ttf',
            public_path() . '/fonts/VeraIt.ttf',
            public_path() . '/fonts/Vera.ttf',
        );

        $cap = new Util_Captcha($fonts, 100, 30);
        $cap->setNumChars(4);

        $cap->Create();

        Session::put('myCaptchaCode', $cap->sCode);
        Session::put('myCaptchaCodeTime', time());
    }

    private function _validate_captcha($sCode)
    {
        $code = Session::get('myCaptchaCode');
        $time = Session::get('myCaptchaCodeTime');
        $expire = 7200;
        return time() - $time < $expire && strtolower($sCode) == strtolower($code);
    }
}

