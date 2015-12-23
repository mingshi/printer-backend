<?php
/**
 * @FileName    :   OrderModel.php
 * @QQ          :   224156865
 * @date        :   2015/12/23 15:50:33
 * @link
 * @Auth        :   Mingshi <fivemingshi@gmail.com>
 */

class OrderModel extends BaseModel
{
   	protected function _getOrmName()
    {
        return 'OrderORM';
    }

    protected function _filter($sql, $params)
    {
        if (!empty($params['user_id'])) {
            $sql = $sql->where('user_id', '=', $params['user_id']);
        }
        
        if (!empty($params['status'])) {
            $sql = $sql->where('status', '=', $params['status']);
        }
        
        if (!empty($params['pay_status'])) {
            $sql = $sql->where('pay_status', '=', $params['pay_status']);
        }
        return $sql;
    } 
}

