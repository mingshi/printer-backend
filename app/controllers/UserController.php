<?php
/**
 * @FileName    :   UserController.php
 * @QQ          :   224156865
 * @date        :   2015/12/16 16:44:43
 * @link
 * @Auth        :   Mingshi <fivemingshi@gmail.com>
 */

class UserController extends BaseController
{
    public function lists()
    {
        $page = intval(Input::get('page', 1));
        $real_name = trim(Input::get('real_name', ''));
        $mobile = trim(Input::get('mobile', ''));

        $args = [
            'mobile'    =>  $mobile,
            'real_name' =>  $real_name
        ];

        $model = new UserModel();
        $count = $model->getCount($args);
        $rows = $model->getRows($page, $args);
        $page_size = Pagination::getPageSize($count);
        
        return View::make('user.lists', [
            'rows'  =>  $rows,
            'page'  =>  $page,
            'page_size' =>  $page_size,
            'params'    =>  $args
        ]); 
    }

    public function show()
    {
        $id = (int)Input::get('id', 0);
        $user = UserORM::find($id);
        if ($id > 0 && empty($user)) {
            Session::flash('error', '用户未找到');
            return Redirect::route('userLists');           
        }

        return View::make('user.show', [
            'row'   =>  $user,
            'id'    =>  $id
        ]);
    }

    public function save()
    {
        $id = (int)Input::get('id', 0);
        $params = Input::all();
        unset($params['id']);
        if (empty($params['real_name'])) {
            $this->_fail('姓名必填');
        }

        if (empty($params['mobile'])) {
            $this->_fail('电话必填');
        }

        if (empty($params['address'])) {
            $this->_fail('地址必填');
        }

        try {
            UserORM::edit($id, $params);
            $this->_succ('保存成功', URL::route('userLists'));
        } catch (Exception $e) {
            $this->_fail('保存失败');
        }
    }
}

