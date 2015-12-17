<?php
/**
 * @FileName    :   AdminController.php
 * @QQ          :   224156865
 * @date        :   2015/12/17 11:05:27
 * @link
 * @Auth        :   Mingshi <fivemingshi@gmail.com>
 */

class AdminController extends BaseController
{
    public function lists()
    {
        $page = intval(Input::get('page', 1));
        $username = trim(Input::get('username', '')); 
        
        $args = ['username' => $username];

        $model = new AdminModel();
        $count = $model->getCount($args);
        $rows = $model->getRows($page, $args);
        $page_size = Pagination::getPageSize($count);

        return View::make('admin.lists', [
            'rows'  =>  $rows,
            'page'  =>  $page,
            'page_size' =>  $page_size,
            'params'    =>  $args
        ]);
    }

    public function show()
    {
        $id = (int)Input::get('id', 0);
        $admin = AdminORM::find($id);
        if ($id > 0 && empty($admin)) {
            Session::flash('error', '管理员未找到');
            return Redirect::route('adminLists');
        }

        return View::make('admin.show', [
            'row'   =>  $admin,
            'id'    =>  $id
        ]);
    }

    public function password()
    {
        $admin_id = Cookie::get('admin_id');
        $row = AdminORM::find($admin_id);
        
        return View::make('admin.password', [
            'id'    =>  $admin_id,
            'row'   =>  $row
        ]);
    }

    public function save()
    {
        $params = Input::all();
        $check = $this->_check($params);

        if (!empty($check)) {
            $this->_fail($check);
        }

        $id = $params['id'];
        unset($params['id']);

        if (empty($params['pwd'])) {
            unset($params['pwd']);
        } else {
            $params['pwd'] = md5(md5($params['pwd']));
        }

        unset($params['currentpwd']);
        unset($params['confirmpwd']);

        try {
            AdminORM::edit($id, $params);
            $this->_succ('保存成功', $this->is_super_admin ? URL::route('adminLists') : URL::route('userLists'));
        } catch (Exception $e) {
            $this->_fail('保存失败'); 
        }
    }

    private function _check($params)
    {
        $msg = '';
        if (empty($params['username'])) {
            $msg = '用户名必须填写';
        }

        $admin = AdminORM::whereUsername($params['username'])->first();
        if (isset($params['currentpwd'])) {
            $password = md5(md5($params['currentpwd']));
            if ($password != $admin->pwd) {
                $msg = '当前密码不正确';
            }

            if ($params['pwd'] != $params['confirmpwd']) {
                $msg = '两次密码填写不一致';
            }
        }

        if (!empty($admin) && $params['id'] == 0) {
            $msg = '用户名重复';
        }

        return $msg;
    }
}

