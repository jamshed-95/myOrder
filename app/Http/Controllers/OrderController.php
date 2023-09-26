<?php

namespace App\Http\Controllers;

use App\Services\OrderService;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $orderService;
    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function createOrder(Request $request){

        $result = ['status'=>200];
        try {
            $result["data"] = $this->orderService->createOrder($request->all());
        }catch (\Exception $ex){
            $result=[
                'status'=>500,
                'error'=>$ex->getMessage()
            ];
        }
        return response()->json($result,$result["status"]);
    }
}
