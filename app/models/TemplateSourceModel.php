<?php
/**
 * @FileName    :   TemplateSourceModel.php
 * @QQ          :   224156865
 * @date        :   2015/12/18 14:07:20
 * @link
 * @Auth        :   Mingshi <fivemingshi@gmail.com>
 */

class TemplateSourceModel extends BaseModel
{
   	protected function _getOrmName()
    {
        return 'TemplateSourceORM';
    }

    protected function _filter($sql, $params)
    {
        if (!empty($params['template_id'])) {
            $sql = $sql->where('template_id', '=', $params['template_id']);
        }
        
        if (!empty($params['is_front'])) {
            $sql = $sql->where('is_front', '=', $params['is_front']);
        }
		return $sql;
    } 
}

