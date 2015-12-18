<?php
/**
 * @FileName    :   UploadController.php
 * @QQ          :   224156865
 * @date        :   2015/12/18 10:48:53
 * @link
 * @Auth        :   Mingshi <fivemingshi@gmail.com>
 */

class UploadController extends BaseController
{
    public function index()
    {
        $res = $this->_send();
       	if ($res['status'] == 'err') {
            $retval = $this->getAjaxError($res['md5']);
        } else {
            $retval = $this->getAjaxSuccess($res['md5'], $res['path']);
        }
        echo $retval;
        exit; 
    }

	private function _send()
    {
        $md5_array = array();
        foreach ($_FILES as $name => $file) {
            if ($file['error'] != 0) {
                $md5_array[$name] = 'error';
                continue;
            }

            try {
                $content = file_get_contents($file['tmp_name'], true);
                $content_md5 = md5($content);
                $type_arr = explode('/', $file['type']);
                $type = $type_arr[1];
                $file_name = $content_md5;
                
                if ($type == 'jpeg') {
                    $file_name .= '.jpg';
                } else if ($type == 'png') {
                    $file_name .= '.png';
                } else {
                    continue;
                }
                
                $path = public_path() . "/images/$file_name";
                file_put_contents($path, $content);
                return [
                    'status'    =>  'ok',
                    'md5'       =>  $content_md5,
                    'file_name' =>  $file['name'],
                    'path'      =>  "/images/$file_name"
                ];
            } catch (Exception $e) {
                return array('status' => 'err', 'md5' => 'upload fail'); 
            }
        }
        return $md5_array;
    }

	private function getAjaxError($error_msg)
    {
        $std = new stdClass;
        $std->status = 0;
        $std->error = $error_msg;
        return json_encode($std);
    }

    private function getAjaxSuccess($success_val, $file_name)
    {
        $std = new stdClass;
        $std->status = 1;
        $std->md5 = $success_val;
        $std->path = $file_name;
        return json_encode($std);
    }
}

