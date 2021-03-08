<?php
/**
 * Created By PhpStorm
 * Date 2019-7-31
 * Time 10:55
 * Name 马哥
 */
namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class UploadImg extends Controller
{
    /**
     * @普通文件上传
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function uploadImg(Request $request)
    {
        $type = empty($_SERVER['HTTP_TYPE']) ? '' : $_SERVER['HTTP_TYPE'];

        $file = $_FILES["file"];
        $path = '';
        //dd($file);
        if ((($file["type"] == "image/gif")
                || ($file["type"] == "image/jpeg")
                || ($file["type"] == "image/png")
                || ($file["type"] == "image/jpg")
                || ($file["type"] == "image/jpg")
            )
            && ($file["size"] < 5000000)) {

            if ($file["error"] > 0) {

                $msg = $file["error"] . "<br />";
                return response([
                    'code' => '1',
                    'msg' => $msg,
                    'data' => [
                        'src' => $path,
                    ]
                ]);

            } else {

                $file_path = './upload/' . date("Y") . '/' . date("m") . '/' . date("d");          //路径

                //dd($file_path);

                $name = substr($file["name"], strpos($file["name"], '.') + 1);                //图片后缀

                $file_name = time() . rand(0000, 9999) . '.' . $name;                                           //文件名字

                function create_folders($file_path)
                {

                    return is_dir($file_path) or (create_folders(dirname($file_path)) and mkdir($file_path, 0777));

                }

                create_folders($file_path);

                if (move_uploaded_file($file["tmp_name"], $file_path . '/' . $file_name)) {

                    $path = substr($file_path, strrpos($file_path, 's') + 1) . '/' . $file_name;

                    if ($type == 'full') {

                        return response([
                            'code' => '0',
                            'msg' => '',
                            'data' => [
                                'src' => $path,
                            ]
                        ]);

                    } else {

                        return response([
                            'code' => '0',
                            'msg' => '',
                            'data' => [
                                'src' => $path
                            ]
                        ]);

                    }

                }
            }
        } else {

            return response([
                'code' => '1',
                'msg' => 'Excessive size or type error',
                'data' => [
                    'src' => $path,
                ]

            ]);
        }
    }

    /**
     * @视频图片上传
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function laravelUploadImg(Request $request)
    {
        #判断文件是否是 POST的方式上传
        if ($request->isMethod('POST')) {

            $tmp = $request->file('file');

            $file_path =  '/upload/' . date("Y") . '/' . date("m") . '/' . date("d");          //路径

            $this -> mkdirs($file_path);

            if(empty($tmp)){
                return response([
                    'code' => '1',
                    'msg' => '请选择图片！',
                    'data' => [
                    ]
                ]);
            }

            //判断文件上传是否有效
            if ($tmp->isValid()) {

                $FileType = $tmp -> getClientOriginalExtension(); #获取文件后缀

                $FilePath = $tmp -> getRealPath(); #获取文件临时存放位置

                $FileName = time() . rand(0000, 9999) . '.' . $FileType; #文件名字

                Storage::disk('article') -> put($file_path . '/' . $FileName, file_get_contents($FilePath)); //存储文件

                return response([
                    'code' => '0',
                    'msg' => '',
                    'data' => [
                        'src' => $file_path . '/' . $FileName //文件路径,
                    ]
                ]);

            }
        }
    }

    /**
     * @检测文件是否存在 --- 递归创建目录
     * @param $dir
     * @param int $mode
     * @return bool
     */
    protected function  mkdirs($dir, $mode = 0777)
    {
        if (is_dir($dir) || @mkdir($dir, $mode)) return TRUE;
        if (!$this -> mkdirs(dirname($dir), $mode)) return FALSE;

        return @mkdir($dir, $mode);
    }
}


