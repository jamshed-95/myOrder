<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CartService;
class CartController extends Controller
{

    protected $cartService;
    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function toCart(Request $request){
        $data = $request->only([
            'product_id',
            'count'
        ]);
        $result = ['status'=>200];
        try {
           $result["data"] = $this->cartService->addToCart($data);
        }catch (\Exception $ex){
            $result=[
                'status'=>500,
                'error'=>$ex->getMessage()
            ];
        }
        return response()->json($result,$result["status"]);
    }

    public function deleteFromCart($id){
        $result = ['status'=>200];
        try {
            $result["data"] = $this->cartService->deleteFromCart($id);
        }catch (\Exception $ex){
            $result=[
                'status'=>500,
                'error'=>$ex->getMessage()
            ];
        }
        return response()->json($result,$result["status"]);
    }

    public function emptyCart(){
        $result = ['status'=>200];
        try {
            $result["data"] = $this->cartService->emptyCart();
        }catch (\Exception $ex){
            $result=[
                'status'=>500,
                'error'=>$ex->getMessage()
            ];
        }
        return response()->json($result,$result["status"]);
    }

    public function plusProductToCart(Request $request){
        $data = $request->only([
            'cart_id',
            'product_count'
        ]);
        $result = ['status'=>200];
        try {
            $result["data"] = $this->cartService->plusProductToCart($data);
        }catch (\Exception $ex){
            $result=[
                'status'=>500,
                'error'=>$ex->getMessage()
            ];
        }
        return response()->json($result,$result["status"]);
    }
}
