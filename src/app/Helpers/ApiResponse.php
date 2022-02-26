<?php


namespace App\Helpers;


use Illuminate\Http\JsonResponse;

class ApiResponse
{
    public static function message(bool $success, string $message, $data=null):JsonResponse
    {
        $response=[
            'success'=>$success,
            'message'=>$message
        ];
        if($data){
            $response['data']=$data;
        }
        return ApiResponse::json($response);
    }

    public static function data($data):JsonResponse
    {
        return ApiResponse::json([
            'success'=>$data?true:false,
            'data'=>$data
        ]);
    }

    public static function pagination($data=null, array $pagination=null):JsonResponse
    {
        return ApiResponse::json([
            'success'=>true,
            'data'=>$data,
            'pagination'=>$pagination
        ]);
    }

    public static function exception(int $status, string $message, array $errors=null):JsonResponse
    {
        $response=[
            'success'=>false,
            'message'=>$message,
        ];
        if($errors){
            $response['errors']=$errors;
        }
        return ApiResponse::json($response, $status);
    }

    public static function fileStreamDownload($file, $fileName=null, $headers=[])
    {
        return response()->streamDownload(function () use ($file) {
            echo $file;
        }, $fileName, $headers);
    }

    private static function json($response, $status=null): JsonResponse
    {
        if (!$status){
            return response()->json($response);
        }
        return response()->json($response, $status);
    }
}
