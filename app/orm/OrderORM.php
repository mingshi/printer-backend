<?php
/**
 * @FileName    :   OrderORM.php
 * @QQ          :   224156865
 * @date        :   2015/12/23 15:46:06
 * @link
 * @Auth        :   Mingshi <fivemingshi@gmail.com>
 */

class OrderORM extends BaseORM
{
    protected $table = 'orders';

    const STATUS_ORDER = 1;
    const STATUS_PRINT = 2;
    const STATUS_DELIVER = 3;
    const STATUS_COMPLETE = 4;

    const PAY_STATUS_NO = 0;
    const PAY_STATUS_YES = 1;

    public static $status = [
        self::STATUS_ORDER  =>  '已下单',
        self::STATUS_PRINT  =>  '已打印',
        self::STATUS_DELIVER    =>  '已发货',
        self::STATUS_COMPLETE   =>  '已完成',
    ];

    public static $pay_status = [
        self::PAY_STATUS_NO =>  '未支付',
        self::PAY_STATUS_YES    =>  '已支付',
    ];
}

