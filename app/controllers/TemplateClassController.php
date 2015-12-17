<?php
/**
 * @FileName    :   TemplateClassController.php
 * @QQ          :   224156865
 * @date        :   2015/12/17 15:23:50
 * @link
 * @Auth        :   Mingshi <fivemingshi@gmail.com>
 */

class TemplateClassController extends BaseController
{
    public function lists()
    {
        $page = intval(Input::get('page', 1));
        $name = trim(Input::get('name', ''));

        $args = ['name' =>  $name];

        $model = new TemplateClassModel();
		$count = $model->getCount($args);
        $rows = $model->getRows($page, $args);
        $page_size = Pagination::getPageSize($count);

		return View::make('templateClass.lists', [
			'rows'  =>  $rows,
            'page'  =>  $page,
            'page_size' =>  $page_size,
            'params'    =>  $args
		]);
    }

    public function show()
    {
        $id = (int)Input::get('id', 0);
        $class = TemplateClassORM::find($id);
        if ($id > 0 && empty($class)) {
            Session::flash('error', '分类未找到');
            return Redirect::route('templateClasses');
        }

        return View::make('templateClass.show', [
            'row'   =>  $class,
            'id'    =>  $id
        ]);
    }

    public function save()
    {
        $id = (int)Input::get('id', 0);
        $params = Input::all();
        unset($params['id']);
    
        $params['sort'] = intval(Input::get('sort', 0));

        if (empty($params['name'])) {
            $this->_fail('名称必填');
        }
        
        try {
            TemplateClassORM::edit($id, $params);
            $this->_succ('保存成功', URL::route('templateClasses'));
        } catch (Exception $e) {
            $this->_fail('保存失败');
        }
    } 
}

