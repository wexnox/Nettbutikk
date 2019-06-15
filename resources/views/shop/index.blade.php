{{--Dette er spash screen. dvs den vi lander på først--}}
{{--NOTE: denne henter layout fra master filen som ligger i views/layout/app, altså en blade templet--}}
@extends('layouts.app')

@section('title')
    Laravel Shopping Cart
@endsection

@section('content')
    @if(Session::has('success'))
        <div class="row">
            <div class="col-sm-6 col-md-4 col-md-offset-4 col-sm-offset-3">
                <div id="charge-message" class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
            </div>
        </div>
    @endif
    <div class="jumbotron" style="background-color: #e6f2ff !important;">
        <!---------------- Bildekarusell ------------->
        <div class="container">
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#myCarousel" data-slide-to="1"></li>
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    <div class="item active">
                        <img src="{{ asset('images/reklame1.png') }}" alt="reklame">
                    </div>

                    <div class="item">
                        <img src="{{ asset('images/reklame2.png') }}">
                    </div>

                    <!-- Left and right controls -->
                    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                        <span class="sr-only">Forige</span>
                    </a>
                    <a class="right carousel-control" href="#myCarousel" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                        <span class="sr-only">Neste</span>
                    </a>
                </div>
            </div>
        </div>
        <br/>
        @foreach($products->chunk(3) as $productChunk)

            <div class="row">

                @foreach($productChunk as $product)

                    <div class="col-sm-6 col-md-4">
                        <div class="thumbnail">
                            <img src="{{ $product->imagePath }}" class="img-responsive" alt="skjermkort">
                            <div class="caption">
                                <h3>{{ $product->title }}</h3>
                                <p class="description">{{ $product->description }}.</p>
                                <div class="clearfix">
                                    <div class="pull-left price">{{ $product->pris }}</div>
                                    <a href="{{ route('product.addToCart',['id' => $product->id] ) }}"
                                       class="btn btn-primary pull-right btn-success" role="button">Kjøp</a>
                                </div>
                            </div>
                        </div>
                    </div>

                @endforeach

            </div>

        @endforeach
    </div>

@endsection