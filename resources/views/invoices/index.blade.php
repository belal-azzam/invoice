@extends('layouts.default')

@section('content')
    <div class="card">
        <h5 class="card-header">Invoices</h5>
        @foreach($invoices as $invoice)
            <div class="card-body">
                <div class="row">

                    <div class="col">
                        <h5 class="card-title">{{$invoice->id}}</h5>
                        <h5 class="card-title">{{$invoice->client->name}}</h5>
                        <h5 class="card-title">{{$invoice->total}}</h5>
                    </div>
                    <div class="col ">
                        <div class="row">
                            <a href="{{route('invoices.show', [$invoice->id])}}" class=" btn btn-info">View</a>
                            <a href="{{route('invoices.edit', [$invoice->id])}}" class=" btn btn-primary">Edit</a>
                            <form action="{{route('invoices.destroy', [$invoice->id])}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button  type="submit " class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    @endforeach

    </div>

@stop