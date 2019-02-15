@extends('layouts.default')
@section('content')
    <h1 class="text-center">Invoice</h1>
    <form class="repeater">
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <label for="date">Date</label>
                    <input  data-parsley-required="true"	 id="date" type="text" name="date" class="form-control"/>
                </div>
                <div class="form-group">
                    <label for="client_id">Client</label>
                    <select
                            data-parsley-required="true"	 class="form-control" id="client_id" name="client_id">
                        <option value="1">belal</option>
                        <option value="2">ahmed</option>
                    </select>
                </div>
            </div>
            <div class="my-2 col-12 text-center"><h2>Invoice Items</h2></div>
            <div class="col-12">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>SubTotal</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody data-repeater-list="InvoiceItem">
                    <tr data-repeater-item class="invoice-item">
                        <td>1</td>
                        <td>
                            <select  data-parsley-required="true" data-id="product_id" class="form-control" id="product_id-1" name="InvoiceItem[0][product_id]">
                                <option value="1">belal</option>
                                <option value="2">ahmed</option>
                            </select>
                        </td>
                        <td>
                            <input  data-parsley-required="true" data-id="quantity" id="quantity-1" type="text" name="InvoiceItem[0][quantity]" class="invoice-item__qunatity form-control"/>
                        </td>
                        <td>
                            <input  data-parsley-required="true" data-id="price" id="price-1" type="text" name="InvoiceItem[0][price]" class="invoice-item__price form-control"/>
                        </td>
                        <td>
                            <input  value="0" data-id="subtotal" readonly id="subtotal-1" name="InvoiceItem[0][subtotal]" type="text"  class=" invoice-item__subtotal form-control"/>
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
                            <input type="number" id="total" readonly name="Invoice[total]" class="form-control">
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
                <button name="submit" class="btn btn-lg btn-success" type="submit">Submit</button>
            </div>
        </div>
    </form>
@endsection
@section('scripts')
    <script type="text/javascript" src="{{URL::asset('js/app.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('js/invoice_add/invoice-add.js')}}"></script>
@endsection
