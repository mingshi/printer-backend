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
            'classes'   =>  $format_classes,
            'params'    =>  ['class' => $class] 
        ]);
    }

    public function show()
    {
        $id = (int)Input::get('id', 0);
        $template = TemplateORM::find($id);
        if ($id > 0 && empty($template)) {
            Session::flash('error', '模版未找到');
            return Redirect::route('templateLists');
        }
    
        $sources = TemplateSourceORM::whereTemplateId($id)->get();
        
        $classes = TemplateClassORM::all();
        array_ch_key('id', $classes);
        $format_classes = array_ch_key('id', $classes);
        
        return View::make('template.show', [
            'row'   =>  $template,
            'id'    =>  $id,
            'sources'   =>  $sources,
            'classes'   =>  $format_classes
        ]); 
    }

    public function save()
    {
        $id = (int)Input::get('id', 0);
        $params = Input::all();
        $params['sort'] = intval(Input::get('sort', 0));

        unset($params['id']);

        if (empty($params['name'])) {
            $this->_fail('名称必须填写');
        }

        $source = [];
        if (isset($params['source'])) {
            $source = $params['source'];
            unset($params['source']);
        }

        if (isset($params['is_front'])) {
            unset($params['is_front']);
        }

        if (isset($params['front_index'])) {
            $front_index = $params['front_index'];
            unset($params['front_index']);
        }

        try {
            $model = new TemplateModel();
            if ($id == 0) {
                $r = $model->insert($params);
            } else {
                $r = $model->update($id, $params);
            }

            $template_id = $r->id;

            if (!empty($source)) {
                TemplateSourceORM::whereTemplateId($template_id)->delete();
                foreach ($source as $k => $s) {
                    $ins = [];
                    $ins['source']  = $s;
                    $ins['template_id'] = $template_id;
                    if ($k == $front_index) {
                        $ins['is_front'] = BaseORM::ENABLE;
                    }

                    $m = new TemplateSourceModel();
                    $m->insert($ins);
                }
            }
            $this->_succ('保存成功', URL::route('templateLists')); 
        } catch (Exception $e) {
            $this->_fail('保存失败');
        }
    }
}

