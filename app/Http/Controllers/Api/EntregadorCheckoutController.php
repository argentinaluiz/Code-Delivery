<?php

namespace CodeDelivery\Http\Controllers\Api;

use CodeDelivery\Repositories\PedidosRepository;
use CodeDelivery\Repositories\UserRepository;
use CodeDelivery\Services\PedidosService;
use Illuminate\Http\Request;

use CodeDelivery\Http\Requests;
use CodeDelivery\Http\Controllers\Controller;

class EntregadorCheckoutController extends Controller
{
    /**
     * @var PedidosRepository
     */
    private $pedidosRepository;
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var PedidosService
     */
    private $service;

    public function __construct(
        PedidosRepository $pedidosRepository,
        UserRepository $userRepository,
        PedidosService $service
    )
    {

        $this->pedidosRepository = $pedidosRepository;
        $this->userRepository = $userRepository;
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Authorizer::getResourceOwnerId();
        $pedidos = $this->pedidosRepository->with('items')->scopeQuery(function ($query) use ($id){
            return $query->where('entregador_id', '=', $id);
        })->paginate();

        return $pedidos;
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
        //
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
