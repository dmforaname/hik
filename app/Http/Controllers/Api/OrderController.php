<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Api\OrderRepository;
use App\Repositories\Api\ItemRepository;
use App\Traits\ApiResponser;

class OrderController extends Controller
{
    use ApiResponser;
    /**
     * @param OrderRepository $orderRep
     * @param ItemRepository $itemRep
     */
    public function __construct(OrderRepository $orderRep,ItemRepository $itemRep)
    {
        $this->order = $orderRep;
        $this->item = $itemRep;
    }   

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $order_num = $this->order->orderNum();

        $orders['table'] = $data['table'];
        $orders['status'] = 'open';
        $orders['order_number'] = $order_num;

        $order = $this->order->create($orders);

        foreach($data['order'] as $item):
            
            $item['order_id'] = $order->id;
            $this->item->create($item);

        endforeach;

        
        
        return $this->success($data,trans('message.create',['X'=> 'Menu']),201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
