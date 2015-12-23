<?php
/**
 * @FileName    :   PaymentModel.php
 * @QQ          :   224156865
 * @date        :   2015/12/23 15:56:45
 * @link
 * @Auth        :   Mingshi <fivemingshi@gmail.com>
 */

class PaymentModel extends BaseModel
{
   	protected function _getOrmName()
    {
        return 'PaymentORM';
    }

    protected function _filter($sql, $params)
    {
        return $sql;
    } 
}

