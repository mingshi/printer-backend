<?php
/**
 * @FileName    :   TemplateController.php
 * @QQ          :   224156865
 * @date        :   2015/12/18 14:09:21
 * @link
 * @Auth        :   Mingshi <fivemingshi@gmail.com>
 */

class TemplateController extends BaseController
{
    public function lists()
    {
        $page = intval(Input::get('page', 1));
        $class = intval(Input::get('class', 0)); 

        $sql = "SELECT t.*, ts.source FROM template as t LEFT JOIN template_source as ts ON ts.template_id = t.id WHERE ts.is_front=" . BaseORM::ENABLE;
        $sql1 = "SELECT count(*) as total FROM template as t WHERE 1";
        if (!empty($class)) {
            $sql .= ' AND t.class=' . $class;
            $sql1 .= ' AND t.class=' . $class;
        }

        $count = DB::select(DB::raw($sql1));
        $sql .= " ORDER BY t.id DESC LIMIT " . ($page - 1) * BaseORM::TAKE . "," . BaseORM::TAKE;

        $rows = DB::select(DB::raw($sql));
        $count = $count[0]->total;
        $page_size = Pagination::getPageSize($count, BaseORM::TAKE);
        
        //获得所有分类
        $classes = TemplateClassORM::all();
        array_ch_key('id', $classes);
        $format_classes = array_ch_key('id', $classes);

        return View::make('template.lists', [
            'rows'   => $rows,
            'page'  =>  $page,
            'page_size' =>  $page_size,
            'classes'   =>  $format_classes            
        ]);
    }
}

