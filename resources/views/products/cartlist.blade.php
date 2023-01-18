@extends('layout.master')
@section('title', 'Cart Item List')


@section('content')
    <div class="row justify-content-center">
        <div class="col-9">
            <div class="trending-wrapper">
                <h4>Result for Products</h4>


                @foreach ($products as $item)
                    <div class="row searched-item py-3 border-bottom">
                        <div class="col-3">
                            <a href="detail/{{ $item->id }}">
                                <img class="trending-img" src="{{ $item->gallery }}">
                            </a>
                        </div>

                        <div class="col-6">
                            <div>
                                <h3>{{ $item->name }}</h3>
                                    <h6>{{ $item->description }}</h6>
                            </div>
                            </a>
                        </div>


                        <div class="col-3 my-auto">
                            <a  class="btn btn-warning" href="{{ route('remove_cart_item',$item->cartId) }}" >Remove from Cart</a>
                        </div>

                    </div>
                @endforeach

                <div class="row justify-content-center mb-3">
                    <div class="col-2 pt-2">
                        <a href="{{ route('make_order') }}" class="btn btn-success">Buy Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
