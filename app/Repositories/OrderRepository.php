<?php


namespace App\Repositories;
use App\Models\Order;

class OrderRepository
{

    protected $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function add($data){
        $order = new $this->order;
        $order->cart_id = $data["cart_id"];
        $order->comment = $data["comment"];
        return $order->save();
    }
}
