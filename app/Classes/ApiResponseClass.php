<?php

namespace App\Classes;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Log;
class ApiResponseClass
{
    public static function rollback($e, $message ="Something went wrong! Process not completed"){
        DB::rollBack();
        self::throw($e, $message);
    }

    public static function throw($e){
        $output = new \Symfony\Component\Console\Output\ConsoleOutput();
        $output->writeln($e);
        throw new HttpResponseException(response()->json([
            "message"=> 'Oops sorry, something is wrong !',
            "status_code"=>$e->getCode(),
            "time_stamp"=>now(),
        ], 400));
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