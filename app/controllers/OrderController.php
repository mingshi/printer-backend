<?php
/**
 * @FileName    :   OrderController.php
 * @QQ          :   224156865
 * @date        :   2015/12/23 16:00:49
 * @link
 * @Auth        :   Mingshi <fivemingshi@gmail.com>
 */

class OrderController extends BaseController
{
    public function lists()
    {
        $page = intval(Input::get('page', 1));
        $mobile = trim(Input::get('mobile', ''));
        $status = intval(Input::get('status', -1));
        $pay_status = intval(Input::get('pay_status', -1)); 

        $user_id = 0;
        if (!empty($mobile)) {
            $user = UserORM::whereMobile($mobile)->first();
            if (!empty($user)) {
                $user_id = $user->id;
            } else {
                Session::flash('error', '用户未找到');
                return Redirect::route('orderLists');
            }
        }

        $sql = "SELECT o.*, u.real_name, u.address, u.mobile FROM orders as o LEFT JOIN user as u ON u.id = o.user_id WHERE 1";
        $sql1 = "SELECT count(*) as total FROM orders as o WHERE 1";

        if (!empty($user_id)) {
            $sql .= " AND o.user_id = $user_id";
            $sql1 .= " AND o.user_id = $user_id";
        }

        if ($status != -1) {
            $sql .= " AND o.status = $status";
            $sql1 .= " AND o.status = $status";
        }

        if ($pay_status != -1) {
            $sql .= " AND o.pay_status = $pay_status";
            $sql1 .= " AND o.pay_status = $pay_status";
        }
		
		$count = DB::select(DB::raw($sql1));
        $sql .= " ORDER BY o.id DESC LIMIT " . ($page - 1) * BaseORM::TAKE . "," . BaseORM::TAKE;

        $rows = DB::select(DB::raw($sql));
        $count = $count[0]->total;
        $page_size = Pagination::getPageSize($count, BaseORM::TAKE);

        return View::make('order.lists', [
            'rows'  =>  $rows,
            'page'  =>  $page,
            'page_size' =>  $page_size,
            'params'    =>  ['mobile' => $mobile, 'status' => $status, 'pay_status' => $pay_status]
        ]);
    }

    public function show()
    {
        $id = (int)Input::get('id', 0);
        $order = OrderORM::find($id);

        if ($id > 0 && empty($order)) {
            Session::flash('error', '订单未找到');
            return Redirect::route('orderLists');
        }

        $user = UserORM::whereId($order->user_id)->first();
        $album = AlbumORM::whereId($order->album_id)->first();
        $template = TemplateORM::whereId($album->template_id)->first();
        $template_class = TemplateClassORM::whereId($template->class)->first();
        $source = AlbumSourceORM::whereAlbumId($album->id)->get();


        return View::make('order.show', [
            'row'   =>  $order,
            'user'  =>  $user,
            'album' =>  $album,
            'template'  =>  $template,
            'class' =>  $template_class,
            'source'    =>  $source,
            'id'    =>  $id
        ]);
    }

    public function save()
    {
        $params = Input::all();
        $id = $params['id'];
        unset($params['id']);

        try {
            OrderORM::edit($id, $params);
            $this->_succ('保存成功');
        } catch (Exception $e) {
            $this->_fail('保存失败');
        }
    }
}

