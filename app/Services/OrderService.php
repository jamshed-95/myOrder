<?php


namespace App\Services;


use App\Repositories\OrderRepository;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Routing\Exception\InvalidArgumentException;
class OrderService
{

    protected $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function createOrder($data){
        try {
            foreach ($data as $object){
                $validator = Validator::make($object,[
                    'cart_id'=>'required'
                ]);
                if ($validator->fails()){
                    throw new InvalidArgumentException($validator->errors()->first());
                }
                $this->orderRepository->add($object);
            }
           return true;
        }catch (\Exception $ex){
            throw new InvalidArgumentException($ex->getMessage());
        }

    }

}
