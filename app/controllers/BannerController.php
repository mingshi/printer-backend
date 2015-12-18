<?php
/**
 * @FileName    :   BannerController.php
 * @QQ          :   224156865
 * @date        :   2015/12/17 17:37:35
 * @link
 * @Auth        :   Mingshi <fivemingshi@gmail.com>
 */

class BannerController extends BaseController
{
    public function lists()
    {
        $page = intval(Input::get('page', 1));
        $args = [];

        $model = new BannerModel();
		$count = $model->getCount($args);
        $rows = $model->getRows($page, $args);
        $page_size = Pagination::getPageSize($count);

        return View::make('banner.lists', [
            'rows'  =>  $rows,
            'page'  =>  $page,
            'page_size' =>  $page_size
        ]); 
    }

    public function show()
    {
        $id = (int)Input::get('id', 0);
        $banner = BannerORM::find($id);
        if ($id > 0 && empty($banner)) {
            Session::flash('error', 'Banner未找到');
            return Redirect::route('bannerLists');
        }

        return View::make('banner.show', [
            'row'   =>  $banner,
            'id'    =>  $id
        ]);
    }

    public function save()
    {
        $id = (int)Input::get('id', 0);
        $params = Input::all();
        $params['sort'] = intval(Input::get('sort', 0));

        unset($params['id']);
        if (empty($params['expire'])) {
            $this->_fail('过期时间必填');
        }

        try {
            BannerORM::edit($id, $params);
            $this->_succ('保存成功', URL::route('bannerLists'));
        } catch (Exception $e) {
            $this->_fail('保存失败');
        }
    }
}

