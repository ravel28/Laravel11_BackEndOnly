<?php

namespace App\Http\Controllers;

use Exception;
use Throwable;
use App\Models\Division;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Interfaces\DivisionRepositoryInterface;
use App\Classes\ApiResponseClass;
use App\Http\Resources\DivisionResource;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DivisionController extends Controller
{
    private DivisionRepositoryInterface $divisionRepositoryInterface;
    
    public function __construct(DivisionRepositoryInterface $divisionRepositoryInterface)
    {
        $this->divisionRepositoryInterface = $divisionRepositoryInterface;
    }

    public function index(int $take, Request $request) {
        try{
            $query = [
                'take' => $take,
                'page' => $request->input('page')
            ];

            $data       = $this->divisionRepositoryInterface->index($query);
            $meta       = $data['meta'];
            $status_code= 200;

            return ApiResponseClass::sendResponse(DivisionResource::collection($data['items']),$meta,$status_code);
            return 'kok bisa';
        } catch(Throwable $e) {
            ApiResponseClass::throw($e);
        }
    }

    public function createDivision(Request $request) {
        try{
            $data = [
                'division' => $request->input('division'),
            ];

            $result     = $this->divisionRepositoryInterface->createDivision($data);
            $meta       = [];
            $status_code= 201;

            return ApiResponseClass::sendResponse(DivisionResource::make($result),$meta,$status_code);
        } catch(Throwable $e) {
            ApiResponseClass::throw($e);
        }
    }
    
    public function updateDivision(int $id,Request $request) {
        try{
            $data = [
                'division' => $request->input('division'),
            ];

            $result     = $this->divisionRepositoryInterface->updateDivision($id,$data);
            $meta       = [];
            $status_code= 200;

            return ApiResponseClass::sendResponse(DivisionResource::make($result),$meta,$status_code);
        } catch(Throwable $e) {
            ApiResponseClass::throw($e);
        }
    }

    public function deleteDivision(int $id) {
        try{
            $result     = $this->divisionRepositoryInterface->deleteDivision($id);
            $meta       = [];
            $status_code= 204;

            return ApiResponseClass::sendResponse(DivisionResource::make($result),$meta,$status_code);
        } catch(Throwable $e) {
            ApiResponseClass::throw($e);
        }
    }
}
