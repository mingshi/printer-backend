<?php
/**
 * @FileName    :   AdminModel.php
 * @QQ          :   224156865
 * @date        :   2015/12/16 16:37:25
 * @link
 * @Auth        :   Mingshi <fivemingshi@gmail.com>
 */

class AdminModel extends BaseModel
{
   	protected function _getOrmName()
    {
        return 'AdminORM';
    }

    protected function _filter($sql, $params)
    {
        if (!empty($params['username'])) {
            $sql = $sql->where('username', '=', $params['username']);
        }
        return $sql;
    } 
}

