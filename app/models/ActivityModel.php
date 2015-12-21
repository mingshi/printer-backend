<?php
/**
 * @FileName    :   ActivityModel.php
 * @QQ          :   224156865
 * @date        :   2015/12/21 17:35:03
 * @link
 * @Auth        :   Mingshi <fivemingshi@gmail.com>
 */

class ActivityModel extends BaseModel
{
   	protected function _getOrmName()
    {
        return 'ActivityORM';
    }

    protected function _filter($sql, $params)
    {
        if (!empty($params['start_time'])) {
            $sql = $sql->where('start_time', '>=', $params['start_time']);
        }
        if (!empty($params['expire'])) {
            $sql = $sql->where('expire', '<=', $params['expire']);
        }

        return $sql;
    } 
}

