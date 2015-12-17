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
}

