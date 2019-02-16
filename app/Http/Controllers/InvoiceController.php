<?php

namespace App\Http\Controllers;

use App\Repositories\InvoiceItemRepositoryInterface;
use App\Repositories\InvoiceRepositoryInterface;
use Illuminate\Http\Request;

class InvoiceController extends BaseController
{

    var $invoiceRepo;
    var $invoiceItemRepo;
    function __construct( InvoiceRepositoryInterface $invoiceRepository, InvoiceItemRepositoryInterface $invoiceItemRepo)
    {
        $this->invoiceRepo = $invoiceRepository;
        $this->invoiceItemRepo = $invoiceItemRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $result = $this->invoiceRepo->all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('invoices.create');
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
        $data = $request->all();
        $data['paid'] = $data['total'];
        $data['unpaid'] = 0;
        $data['status'] = 1;
        $data['type'] = 1;
        $invoiceItemsData = $data['InvoiceItem'];
        unset($data['InvoiceItem']);
        $result = $this->invoiceRepo->create($data);
        if($result)
        {
            foreach ($invoiceItemsData as $k => &$invoiceItem)
            {
                $invoiceItem['invoice_id'] = $result->id;
            }
            $this->invoiceItemRepo->insertAll($invoiceItemsData);
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
