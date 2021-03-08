<?php

namespace App\Exceptions;

use App\Model\HeaderModel;
use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception  $e)
    {
        //如果$exception 是 ApiException的一个实例，则自定义返回的错误信息
        if($e instanceof ApiException){
            $result = [
                "code" => 9999,
                "msg" => $e -> getMessage(),
                "data" => ""
            ];
            return response() -> json($result);
        }
        //自定义错误页面
        if ($e instanceof ModelNotFoundException) {
            $e = new NotFoundHttpException($e->getMessage(), $e);
        }

        if($e instanceof \Symfony\Component\Debug\Exception\FatalErrorException
            && !config('app.debug')) {
            return response() -> view('errors.default', [], 500);
        }
        //如果不是，则使用 父类的处理方法
        return parent::render($request, $e);
    }

    /**
     * 获取header头部信息
     * @return mixed
     */
    public function getInfo()
    {
        $data['header'] = HeaderModel::getHeaderInfo();

        //设置搜索后的变量
        $data['column']['search']['column'] = '123';

        return $data;
    }
}
