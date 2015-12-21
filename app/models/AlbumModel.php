<?php
/**
 * @FileName    :   AlbumModel.php
 * @QQ          :   224156865
 * @date        :   2015/12/21 14:24:19
 * @link
 * @Auth        :   Mingshi <fivemingshi@gmail.com>
 */

class AlbumModel extends BaseModel
{
   	protected function _getOrmName()
    {
        return 'AlbumORM';
    }

    protected function _filter($sql, $params)
    {
        if (!empty($params['user_id'])) {
            $sql = $sql->where('user_id', '=', $params['user_id']);
        }

        return $sql;
    } 
}

