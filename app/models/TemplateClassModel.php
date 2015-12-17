<?php
/**
 * @FileName    :   TemplateClassModel.php
 * @QQ          :   224156865
 * @date        :   2015/12/17 15:19:42
 * @link
 * @Auth        :   Mingshi <fivemingshi@gmail.com>
 */

class TemplateClassModel extends BaseModel
{
   	protected function _getOrmName()
    {
        return 'TemplateClassORM';
    }

    protected function _filter($sql, $params)
    {
        if (!empty($params['name'])) {
            $sql = $sql->where('name', '=', $params['name']);
        }

        return $sql;
    } 
}

