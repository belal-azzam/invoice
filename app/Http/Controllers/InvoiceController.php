<?php

namespace App\Http\Controllers;

use App\Repositories\ClientRepositoryInterface;
use App\Repositories\InvoiceItemRepositoryInterface;
use App\Repositories\ProductRepositoryInterface;
use App\Services\InvoiceService;
use Illuminate\Http\Request;

class InvoiceController extends BaseController
{

    var $invoiceItemRepo;
    var $clientRepo;
    var $productRepo;
    var $invoiceService = null;
    function __construct(
                          InvoiceItemRepositoryInterface $invoiceItemRepo,
                          ProductRepositoryInterface $productRepository,
                          ClientRepositoryInterface $clientRepository,
                        InvoiceService  $invoiceService
    )
    {
        $this->invoiceItemRepo = $invoiceItemRepo;
        $this->clientRepo = $clientRepository;
        $this->productRepo = $productRepository;
        $this->invoiceService = $invoiceService;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $invoices = $this->invoiceService->all();
        $statuses = $this->invoiceService->invoiceStatusList();
        return view('invoices.index', compact('invoices', 'statuses'));
    }

    private function __formCommon()
    {
        $products = $this->productRepo->all();
        $clients = $this->clientRepo->all();
        return ['clients' => $clients, 'products' => $products];
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('invoices.create', $this->__formCommon());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $result = $this->invoiceService->add($request);
        if($result)
        {
            return redirect()->route('invoices.index')->with('alert-success','Invoice Saved');
        }else{
            return redirect()->route('invoices.index')->with('alert-danger','Invoice Couldn\'t be saved');
        }
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
        $invoice = $this->invoiceService->find($id);
        if($invoice){
            return view('invoices.create', array_merge($this->__formCommon(), ['invoice' => $invoice]));
        }
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
        $result = $this->invoiceService->update($id, $request);
        if($result)
        {
            return redirect()->route('invoices.index')->with('alert-success','Invoice Saved');
        }else{
            return redirect()->route('invoices.index')->with('alert-danger','Invoice Couldn\'t be saved');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->invoiceService->delete($id);
        return redirect()->route('invoices.index')->with('alert-success','Invoice Deleted');
    }
}
