<?php

namespace CodeDelivery\Http\Controllers\Api;

use CodeDelivery\Repositories\PedidosRepository;
use CodeDelivery\Repositories\ProdutosRepository;
use CodeDelivery\Repositories\UserRepository;
use CodeDelivery\Services\PedidosService;
use Illuminate\Http\Request;

use CodeDelivery\Http\Requests;
use CodeDelivery\Http\Controllers\Controller;
use LucaDegasperi\OAuth2Server\Facades\Authorizer;

class ClienteCheckoutController extends Controller
{
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var PedidosRepository
     */
    private $pedidosRepository;
    /**
     * @var ProdutosRepository
     */
    private $produtosRepository;
    /**
     * @var PedidosService
     */
    private $service;

    public function __construct(
        UserRepository $userRepository,
        PedidosRepository $pedidosRepository,
        ProdutosRepository $produtosRepository,
        PedidosService $service
    )
    {

        $this->userRepository = $userRepository;
        $this->pedidosRepository = $pedidosRepository;
        $this->produtosRepository = $produtosRepository;
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
        $clienteId = $this->userRepository->find($id)->cliente->id;
        $pedidos = $this->pedidosRepository->with('items')->scopeQuery(function ($query) use ($clienteId){
            return $query->where('cliente_id', '=', $clienteId);
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
        $data = $request->all();
        $id = Authorizer::getResourceOwnerId();
        $clienteId = $this->userRepository->find($id)->cliente->id;
        $data['cliente_id'] = $clienteId;
        $o = $this->service->create($data);
        $o = $this->pedidosRepository->with('items')->find($o->id);
        return $o;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $o = $this->pedidosRepository->with(['cliente', 'items','cupom'])->find($id);
        $o->items->each(function($item){
           $item->produto;
        });

        return $o;
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
