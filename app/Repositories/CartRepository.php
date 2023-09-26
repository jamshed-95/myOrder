<?php


namespace App\Repositories;

use App\Models\Cart;
class CartRepository
{

    protected $cart;

    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }


    public function  add($data){
        $cart = new $this->cart;
        $cart->product_id = $data["product_id"];
        $cart->count = $data["count"];
        $cart->save();
        return $cart->fresh();
    }

    public function delete($id){
         return $this->cart->find($id)->delete();
    }

    public function empty($user_id = ""){
        //return $this->cart->where('user_id',$user_id)->delete();
        return $this->cart->truncate();
    }

    public function plus($data){
       $cart =  $this->cart
                ->find($data["cart_id"])
                ->update(['count'=>$data["product_count"]]);
       return $cart;
    }
}
