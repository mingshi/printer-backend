<?php
/**
 * @FileName    :   BaseORM.php
 * @QQ          :   224156865
 * @date        :   2015/12/16 16:32:55
 * @link
 * @Auth        :   Mingshi <fivemingshi@gmail.com>
 */

use Illuminate\Database\Eloquent\Model as Eloquent;

class BaseORM extends Eloquent
{
   	const ENABLE = 1;
    const DISABLE = 0;
    const TAKE = 20;

    public static $status_map = [
        self::ENABLE    =>  '启用',
        self::DISABLE   =>  '禁用',
    ];

	public static function statusMap()
    {
        return [
            self::DISABLE => '禁用',
            self::ENABLE => '启用',
        ];

    }

	public static function edit($id, $params)
    {
        $orm_name = get_called_class();
        $orm = $orm_name::find($id);
        if (!$orm) {
            $orm = new $orm_name;
        }
        foreach ($params as $key => $value) {
            $orm->$key = $value;
        }
        $result = $orm->save();
        return array($result, $orm);
    }

	public static function softDel($id)
    {
        $orm_name = get_called_class();
        $orm = $orm_name::find($id);
        if (!$orm) {
            return 0;
        }
        $orm->status = self::DISABLE;
        return $orm->save();
    }

    public static function statusName($status)
    {
        $status_map = self::statusMap();
        if (isset($status_map[$status])) {
            return $status_map[$status];
        } else {
            return '';
        }
    } 
}

