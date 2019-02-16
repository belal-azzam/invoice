<style>
    .card{
        margin-bottom: 2rem;
    }
    #form-container{
        margin-top: 4rem;
    }
</style>
@extends('layouts.default')
@section('content')
    <h1 class="text-center">Create Invoice</h1>
    <div id="form-container">


    <form class="repeater" method="post" action="{{route('invoices.store')}}">
        {{csrf_field()}}

        <div class="card">
            <div class="card-header">
                <h4>Invoice Details</h4>
            </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div class="form-group row">
                       <label class="col-sm-2 col-form-label" for="date">Date</label>
                        <div class="col-sm-10">
                            <input @if(isset($invoice)) value="{{date('Y/m/d H:i',strtotime($invoice->date))}}" @endif data-parsley-required="true"	 id="date" type="text" name="date" class="form-control"/>
                        </div>
                    </div>
                    <div class=" row form-group">
                        <label class="col-sm-2 col-form-label" for="client_id">Client</label>
                        <div class="col-sm-10">
                        <select
                                data-parsley-required="true"	 class="form-control" id="client_id" name="client_id">
                            <option value="1">belal</option>
                            <option value="2">ahmed</option>
                        </select>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h4>
                Invoice Items
                </h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>SubTotal</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <tbody data-repeater-list="InvoiceItem">
                            <tr data-repeater-item class="invoice-item">
                                <td>
                                    <select  data-parsley-required="true" data-id="product_id" class="form-control" id="product_id-1" name="product_id">

                                        <option value="1">belal</option>
                                        <option value="2">ahmed</option>
                                    </select>
                                </td>
                                <td>
                                    <input  data-parsley-required="true" data-id="quantity" id="quantity-1" type="text" name="quantity" class="invoice-item__qunatity form-control"/>
                                </td>
                                <td>
                                    <input  data-parsley-required="true" data-id="price" id="price-1" type="text" name="item_price" class="invoice-item__price form-control"/>
                                </td>
                                <td>
                                    <input  value="0" data-id="subtotal" readonly id="subtotal-1" name="item_total" type="text"  class=" invoice-item__subtotal form-control"/>
                                </td>
                                <td>
                                    <input class="btn btn-danger" data-repeater-delete type="button" value="X"/>
                                </td>
                            </tr>


                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="4">
                                    Total
                                </td>
                                <td >
                                    <input type="number" id="total" readonly name="total" class="form-control">
                                </td>
                                <td></td>
                            </tr>
                            </tfoot>
                        </table>
                        <div class="row">
                            <div class="col-12 text-right">
                                <button type="button" data-repeater-create class="text-center btn btn-success">+</button>
                            </div>
                        </div>
                    </div>
            <div class="mt-5 col-12 text-center">
                <button  class="btn btn-lg btn-success" type="submit">Submit</button>
            </div>
        </div>
            </div>
        </div>
    </form>
        </div>


@endsection
@section('scripts')
    <script type="text/javascript" src="{{URL::asset('js/invoice_add/invoice-add.js')}}"></script>
@endsection
