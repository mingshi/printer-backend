<?php
/**
 * @FileName    :   AlbumController.php
 * @QQ          :   224156865
 * @date        :   2015/12/21 14:18:04
 * @link
 * @Auth        :   Mingshi <fivemingshi@gmail.com>
 */

class AlbumController extends BaseController
{
    public function lists()
    {
        $page = intval(Input::get('page', 1));
        $mobile = trim(Input::get('mobile', ''));
        $class = intval(Input::get('class', 0));

        $search_user_id = 0;
        if (!empty($mobile)) 
        {
            $user = UserORM::whereMobile($mobile)->first();
            if (empty($user)) {
                Session::flash('error', '用户未找到');
                return Redirect::route('albumLists');
            } else {
                $search_user_id = $user->id;
            }
        }

        $sql = "SELECT a.*, u.mobile, u.real_name, u.address FROM album as a LEFT JOIN user as u ON u.id = a.user_id WHERE 1";
        $sql1 = "SELECT count(*) as total FROM album as a WHERE 1";

        if (!empty($search_user_id)) {
            $sql .= " AND a.user_id = $search_user_id";
            $sql1 .= " AND a.user_id = $search_user_id";
        }

        if (!empty($class)) {
            $sql .= " AND a.class = $class";
            $sql1 .= " AND a.class = $class";
        }

        $count = DB::select(DB::raw($sql1));
        $sql .= " ORDER BY a.id DESC LIMIT " . ($page - 1) * BaseORM::TAKE . "," . BaseORM::TAKE;

        $rows = DB::select(DB::raw($sql));
        $count = $count[0]->total;
        $page_size = Pagination::getPageSize($count, BaseORM::TAKE);

		//获得所有分类
        $classes = TemplateClassORM::all();
        array_ch_key('id', $classes);
        $format_classes = array_ch_key('id', $classes);

        return View::make('album.lists', [
            'rows'  =>  $rows,
            'page'  =>  $page,
            'page_size' =>  $page_size,
            'params'    =>  ['mobile' => $mobile, 'class' => $class],
            'classes'   =>  $format_classes,
        ]);
    }

    public function show()
    {
        $id = (int)Input::get('id', 0);
        $album = AlbumORM::find($id);
        if ($id > 0 && empty($album)) {
            Session::flash('error', '相册未找到');
            return Redirect::route('albumLists');
        }

        $sources = AlbumSourceORM::whereAlbumId($id)->get();
       	
		$classes = TemplateClassORM::all();
        array_ch_key('id', $classes);
        $format_classes = array_ch_key('id', $classes);  
    
        $user = UserORM::find($album->user_id);

        return View::make('album.show', [
            'row'   =>  $album,
            'user'  =>  $user,
            'source'    =>  $sources,
            'classes'   =>  $format_classes
        ]);
	}
}

