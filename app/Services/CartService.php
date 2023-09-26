<?php


namespace App\Services;
use App\Repositories\CartRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Routing\Exception\InvalidArgumentException;

class CartService
{

    protected $cartepository;

    public function __construct(CartRepository $cartepository)
    {
        $this->cartRepository = $cartepository;
    }

    public function addToCart($data){
        $validator = Validator::make($data,[
            'product_id'=>'required',
            'count' => 'required'
        ]);
        if ($validator->fails()){
            throw new InvalidArgumentException($validator->errors()->first());
        }
        return $this->cartRepository->add($data);
    }

    public function deleteFromCart($id){
        DB::beginTransaction();
        try {
            $cart = $this->cartRepository->delete($id);
        }catch (\Exception $ex){
            DB::rollBack();
           throw new InvalidArgumentException("Не удалось удалить данные!");
        }
        DB::commit();
        return $cart;
    }

    public function emptyCart(){
        DB::beginTransaction();
        try {
            $cart = $this->cartRepository->empty();
        }catch (\Exception $ex){
            DB::rollBack();
            throw new InvalidArgumentException("Не удалось удалить данные!");
        }
        DB::commit();
        return $cart;
    }

    public function plusProductToCart($data){
        $validator = Validator::make($data,[
            'cart_id'=>'required',
            'product_count' => 'required'
        ]);
        if ($validator->fails()){
            throw new InvalidArgumentException($validator->errors()->first());
        }
        return $this->cartRepository->plus($data);
    }

}
