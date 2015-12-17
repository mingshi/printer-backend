<?php
/**
 * @FileName    :   BannerModel.php
 * @QQ          :   224156865
 * @date        :   2015/12/17 17:20:21
 * @link
 * @Auth        :   Mingshi <fivemingshi@gmail.com>
 */

class BannerModel extends BaseModel
{
   	protected function _getOrmName()
    {
        return 'BannerORM';
    }

    protected function _filter($sql, $params)
    {
        return $sql;
    } 
}

