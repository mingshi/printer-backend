<?php
/**
 * @FileName    :   ForbiddenController.php
 * @QQ          :   224156865
 * @date        :   2015/12/17 14:02:44
 * @link
 * @Auth        :   Mingshi <fivemingshi@gmail.com>
 */

class ForbiddenController extends BaseController
{
    public function index()
    {
        return View::make('errors.403');
    }
}

