<?php
/**
 * @FileName    :   AlbumSourceModel.php
 * @QQ          :   224156865
 * @date        :   2015/12/21 14:26:38
 * @link
 * @Auth        :   Mingshi <fivemingshi@gmail.com>
 */

class AlbumSourceModel extends BaseModel
{
  	protected function _getOrmName()
    {
        return 'AlbumSourceORM';
    }

    protected function _filter($sql, $params)
    {
        if (!empty($params['album_id'])) {
            $sql = $sql->where('album_id', '=', $params['album_id']);
        }

        return $sql;
    }  
}

