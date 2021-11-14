<?php

namespace App\Repositories\Api;

use App\Models\Order;
use App\Repositories\BaseRepository;
use Carbon\Carbon;

class OrderRepository extends BaseRepository
{
    protected $model;

    /**
     * Repository constructor.
     *
     * @param  Order  $mod
     */
    public function __construct(Order $mod)
    {
        $this->model = $mod;
    }

    public function orderNum()
    {
        $time_format = Carbon::today()->format('Ymd');
        $order_number = 'PSN'.$time_format.'-';
        $data = Order::whereRaw("LEFT(order_number,12)='$order_number'")->latest()->first();
        $i = $this->createOrderNum($data);
        
        return $order_number.$i;
    }

    private function createOrderNum($data)
    {
        if ($data){

            $str = explode("-",$data->order_number);
            $int = (int)$str[1]+1;
            
            return str_pad($int, 3, '0', STR_PAD_LEFT);

        }else{

            return "001";
        }
    }
}
