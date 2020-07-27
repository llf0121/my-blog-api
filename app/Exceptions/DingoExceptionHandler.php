<?php


namespace App\Exceptions;
use Exception;
use Dingo\Api\Exception\Handler as DingoHandler;
use \Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use \Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use \Illuminate\Auth\Access\AuthorizationException;
use \Dingo\Api\Exception\ValidationHttpException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class DingoExceptionHandler extends  DingoHandler
{
    public function handle(Exception $exception)
    {

        switch ($exception){
            case $exception instanceof BusinessException:
                $message = $exception->getResponse()->getData()->msg?:"系统错误";
                throw new HttpException(500, $message );
            case  $exception instanceof ModelNotFoundException:
                throw new HttpException(404, '该资源不存在' );
                break;
            case  $exception instanceof NotFoundHttpException:
                throw new HttpException(400, '无效的访问路径' );
                break;
            case $exception instanceof UnauthorizedHttpException:
                throw new HttpException(401, '请先登录' );
                break;
            case  $exception instanceof AuthorizationException:
                throw new HttpException(403, '无权进行操作');
                break;

            case  $exception instanceof ValidationHttpException:
                $errors = $exception->getErrors();
                return response()->json(['message' => $errors->first(), 'status_code' => 422], 422);
        }
        return parent::handle($exception);
    }
}
