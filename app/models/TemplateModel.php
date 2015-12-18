<?php
/**
 * @FileName    :   TemplateModel.php
 * @QQ          :   224156865
 * @date        :   2015/12/18 14:06:06
 * @link
 * @Auth        :   Mingshi <fivemingshi@gmail.com>
 */

class TemplateModel extends BaseModel
{
   	protected function _getOrmName()
    {
        return 'TemplateORM';
    }

    protected function _filter($sql, $params)
    {
        if (!empty($params['class'])) {
            $sql = $sql->where('class', '=', $params['class']);
        }

        return $sql;
    } 
}

