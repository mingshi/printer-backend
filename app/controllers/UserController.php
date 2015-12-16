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
}

