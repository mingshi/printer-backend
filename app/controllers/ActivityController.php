<?php
/**
 * @FileName    :   ActivityController.php
 * @QQ          :   224156865
 * @date        :   2015/12/21 17:02:49
 * @link
 * @Auth        :   Mingshi <fivemingshi@gmail.com>
 */

class ActivityController extends BaseController
{
    public function lists()
    {
        $page = intval(Input::get('page', 1));
        $start_time = Input::get('start_time', '');
        $expire = Input::get('expire', '');
    
        $args = ['start_time' => $start_time, 'expire'  =>  $expire];

        $model = new ActivityModel();
        $count = $model->getCount($args);
        $rows = $model->getRows($page, $args);
        $page_size = Pagination::getPageSize($count);

        return View::make('activity.lists', [
            'rows'  =>  $rows,
            'page'  =>  $page,
            'page_size' =>  $page_size,
            'params'    =>  $args
        ]); 
    }

    public function show()
    {
        $id = (int)Input::get('id', 0);
        $activiy = ActivityORM::find($id);
        if ($id > 0 && empty($activity)) {
            Session::flash('error', '活动未找到');
            return Redirect::route('activityLists');
        }

        return View::make('activity.show', [
            'row'   =>  $activiy,
            'id'    =>  $id
        ]); 
    }

    public function save()
    {
    }
}

