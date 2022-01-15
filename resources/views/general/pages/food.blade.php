@extends('general.app')
@section('title', $food->name)
@section('content')
    <section class="section-pagetop bg-dark">
        <div class="container clearfix">
            <h2 class="title-page">{{ $food->name }}</h2>
        </div>
    </section>
    <section class="section-content bg padding-y border-top" id="site">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    @if (Session::has('message'))
                        <p class="alert alert-success">{{ Session::get('message') }}</p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="row no-gutters">
                            <aside class="col-sm-5 border-right">
                                <article class="gallery-wrap">
                                    @if ($food->images->count() > 0)
                                        <div class="img-big-wrap">
                                            <div class="padding-y">
                                                <a href="{{ asset('storage/'.$food->images->first()->full) }}" data-fancybox="">
                                                    <img src="{{ asset('storage/'.$food->images->first()->full) }}" alt="">
                                                </a>
                                            </div>
                                        </div>
                                    @else
                                        <div class="img-big-wrap">
                                            <div>
                                                <a href="https://www.superhealthykids.com/wp-content/uploads/2019/08/July-Recipes-26.jpg" data-fancybox=""><img src="https://www.superhealthykids.com/wp-content/uploads/2019/08/July-Recipes-26.jpg"></a>
                                            </div>
                                        </div>
                                    @endif
                                     @if ($food->images->count() > 0)
                                        <div class="img-small-wrap">
                                            @foreach($food->images as $image)
                                                <div class="item-gallery">
                                                    <img src="{{ asset('storage/'.$image->full) }}" alt="">
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </article>
                            </aside>
                            <aside class="col-sm-7">
                                <article class="p-5">
                                    <h3 class="title mb-3">{{ $food->name }}</h3>
      
                                    <div class="mb-3">
                                            <var class="price h3 text-success">
                                                <span class="currency">{{ config('settings.currency_symbol') }}</span><span class="num" id="foodPrice">{{ $food->price }}</span>
                                            </var>
                                    </div>
                                    <hr>
                                    <form action="{{ route('food.add.cart') }}" method="POST" role="form" id="addToCart">
                                        @csrf
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <dl class="dlist-inline">
                                                    <dt>Quantity: </dt>
                                                    <dd>
                                                        <input class="form-control" type="number" min="1" value="1" max="{{ $food->quantity }}" name="qty" style="width:70px;">
                                                        <input type="hidden" name="foodId" value="{{ $food->id }}">
                                                        <input type="hidden" name="price" id="finalPrice" value="{{ $food->sale_price != '' ? $food->sale_price : $food->price }}">
                                                    </dd>
                                                </dl>
                                            </div>
                                        </div>
                                        <hr>
                                        <button type="submit" class="btn btn-success"><i class="fas fa-shopping-cart"></i> Add To Cart</button>
                                    </form>
                                </article>
                            </aside>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <article class="card mt-4">
                        <div class="card-body">
                            {!! $food->description !!}
                        </div>
                    </article>
                </div>
            </div>
        </div>
    </section>
@stop
@push('scripts')
    <script type="module">
        $('#addToCart').submit(function (e) {
            if ($('.option').val() == 0) {
                e.preventDefault();
                alert('Please select an option');
            }
        });
        $('.option').change(function () {
            $('#foodPrice').html("{{ $food->sale_price != '' ? $food->sale_price : $food->price }}");
            let extraPrice = $(this).find(':selected').data('price');
            let price = parseFloat($('#foodPrice').html());
            let finalPrice = (Number(extraPrice) + price).toFixed(2);
            $('#finalPrice').val(finalPrice);
            $('#foodPrice').html(finalPrice);
        });
    </script>
@endpush
