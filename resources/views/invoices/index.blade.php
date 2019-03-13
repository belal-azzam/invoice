@extends('layouts.default')

@section('content')
    <div class="page-head">
    <h2 class="section-title d-inline">Invoices</h2>
    <a href="{{route('invoices.create')}}" class="btn  btn-lg btn-success pull-right">
        <i class="fa fa-plus" aria-hidden="true"></i>
    </a>
    </div>
        <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Client</th>
            <th scope="col">Status</th>
            <th scope="col">Total</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($invoices as $invoice)

            <tr>
                <th scope="row"> {{$invoice->id}}</th>
                <td>{{$invoice->client->name}}</td>
                <td>{{$statuses[$invoice->status]}}</td>
                <td>{{$invoice->total}}</td>
                <td>
                    <a href="{{route('invoices.show', [$invoice->id])}}" class=" btn btn-sm btn-light">
                        <i class="fa fa-eye" aria-hidden="true"></i>
                        View</a>
                    <a href="{{route('invoices.edit', [$invoice->id])}}" class=" btn btn-sm btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i>
                        Edit</a>
                    <form class="d-inline" action="{{route('invoices.destroy', [$invoice->id])}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button  type="submit " class="btn  btn-sm btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i>
                            Delete</button>
                    </form>
                    <a href="{{route('invoices.send_email', [$invoice->id])}}" class="btn btn-sm"><i class="fa fa-envelope-o" aria-hidden="true"></i>
                        Send Email</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@stop