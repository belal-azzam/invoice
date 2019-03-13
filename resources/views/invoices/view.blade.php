@extends('layouts.default')
<style>
    .info-item{
        line-height: 2.5rem;
    }
    .info-item .info-item__title{
        font-weight: bold;
    }
</style>
@section('content')
    <div class="page-head">
        <h3>Invoice #{{$invoice->id}} ({{$statusesText[$invoice->status]}})</h3>
    </div>

    <div class="card">
        <div class="card-header">
            <h4>Details</h4>
        </div>
        <div class="card-body">
            <div class="row info-item ">
                <div class="col-md-3 info-item__title">Client</div>
                <div class="col-md-9 info-item__value">{{$invoice->client->name}}</div>
            </div>
            <div class="row info-item ">
                <div class="col-md-3 info-item__title">Date</div>
                <div class="col-md-9 info-item__value">{{$invoice->date}}</div>
            </div>
            <div class="row info-item">
                <div class="col-md-3  info-item__title">Total</div>
                <div class="col-md-9 info-item__value">{{$invoice->total}}</div>
            </div>
            <div class="row info-item">
                <div class="col-md-3 info-item__title  ">Created At</div>
                <div class="col-md-9 info-item__value">{{$invoice->created_at}}</div>
            </div>
        <hr class="mb-3"/>
            <h4>Invoice Items</h4>
        </div>

        <table class="table table-bordered">
            <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Product</th>
                <th scope="col">Price</th>
                <th scope="col">Qty</th>
                <th scope="col">Subtotal</th>
            </tr>
            </thead>
            <tbody>
            @foreach($invoice->invoiceItems as $k  => $invoiceItem)

            <tr>
                <th>{{$invoiceItem->id}}</th>
                <th>{{$invoiceItem->product->name}}</th>
                <th>{{$invoiceItem->item_price}}</th>
                <th>{{$invoiceItem->quantity}}</th>
                <th>{{$invoiceItem->item_total}}</th>

            </tr>
            @endforeach

            </tbody>
        </table>

    </div>
@stop