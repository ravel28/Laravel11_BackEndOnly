<?php

namespace App\Classes;

use App\Classes\FlattenException;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;
class ApiResponseClass
{
    public static function rollback($e, $message ="Something went wrong! Process not completed"){
        DB::rollBack();
        self::throw($e, $message);
    }

    public static function throw($e){
        $status_code    = method_exists($e,'getStatusCode') ? $e->getStatusCode() : 500;
        $output         = new \Symfony\Component\Console\Output\ConsoleOutput();
        $output->writeln($e);

        throw new HttpResponseException(response()->json([
            "message"       => $e->getMessage(),
            "status_code"   => $status_code,
            "time_stamp"    => now(),
        ], $status_code));
    }

    public static function sendResponse($result , $meta, $code){
        $response=[
            'item'  => $result,
            'meta'  => $meta ? $meta : null,
            'time'  => now(),
        ];
        $data['data']   = $code!=204 ? $response : "";
        $code           = $code!=204 ? $code : 204;
        return response()->json($data, $code);
    }

    public static function sendResponsePagination($result){
        return response()->json($result);
    }

}