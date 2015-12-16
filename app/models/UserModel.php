<?php
/**
 * @FileName    :   UserModel.php
 * @QQ          :   224156865
 * @date        :   2015/12/16 17:01:03
 * @link
 * @Auth        :   Mingshi <fivemingshi@gmail.com>
 */

class UserModel extends BaseModel
{
   	protected function _getOrmName()
    {
        return 'UserORM';
    }

    protected function _filter($sql, $params)
    {
        if (!empty($params['mobile'])) {
            $sql = $sql->where('mobile', '=', $params['mobile']);
        }
		
        if (!empty($params['real_name'])) {
            $sql = $sql->where('real_name', '=', $params['real_name']);
        }
        return $sql;
    } 
}

