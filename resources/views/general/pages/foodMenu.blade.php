@extends('general.app')
@section('title', $foodMenu->name)
@section('content')
<section class="section-pagetop bg-dark">
    <div class="container clearfix">
        <h2 class="title-page">{{ $foodMenu->name }}</h2>
    </div>
</section>
<section class="section-content bg padding-y">
    <div class="container">
        <div id="code_prod_complex">
            <div class="row">
                @forelse($foodMenu->foods as $food)
                    <div class="col-md-4">
                        <figure class="card card-food">
                            @if ($food->images->count() > 0)
                                <div class="img-wrap padding-y"><img src="{{ asset('storage/'.$food->images->first()->full) }}" alt=""></div>
                            @else
                                <div class="img-wrap padding-y"><img src="https://pic.pikbest.com/01/71/00/12X888piCVQr.jpg-0.jpg!bw700" alt=""></div>
                            @endif
                            <figcaption class="info-wrap">
                                <h4 class="title"><a href="{{ route('food.show', $food->id) }}">{{ $food->name }}</a></h4>
                            </figcaption>
                            <div class="bottom-wrap">
                                <a href="{{ route('food.show', $food->id) }}" class="btn btn-sm btn-success float-right">View Details</a>

                                    <div class="price-wrap h5">
                                        <span class="price"> {{ config('settings.currency_symbol').$food->price }} </span>
                                    </div>
                                
                            </div>
                        </figure>
                    </div>
                @empty
                    <p>No Foods found in {{ $foodMenu->name }}.</p>
                @endforelse
            </div>
        </div>
    </div>
</section>
@stop
