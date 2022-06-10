@extends('layout')

@section('sidebar')
<div class="list-group">
    <!-- edytowanie produktu -->
    <a href="/{{ $model_id }}/edit-product/{{ $product->id }}" class="list-group-item list-group-item-action rounded navbar-myButtonColor">
        <img src="{{ asset(('thumbnail/edit.png')) }}" width=20 height=20 alt="edit">
        Edytuj produkt
    </a>

    <hr/>

    <!-- usuwanie -->
    <form action="/delete-product" method="POST" onsubmit="return confirm('Na pewno chcesz usunąć ten produkt?')">
        @csrf
        @method('DELETE')
        
        <input type="hidden" name="product_id" value="{{ $product->id }}">
    
        <button type="submit" class="list-group-item list-group-item-action rounded navbar-myButtonColor">
            <img src="{{ asset(('thumbnail/delete.png')) }}" width=20 height=20 alt="delete">
            Usuń
        </button>
    </form>

    <hr/>
    <a href="/{{ $model_id }}/products-list" class="list-group-item list-group-item-action rounded navbar-myButtonColor">
        Powrót do listy produktów
    </a>
</div>
@endsection

@section('content')
<div class="container">
    <div class="row m-1">
        <!-- galeria zdjęć -->
        <div class="col-md-6">

             <!-- Obrazy o pełnej szerokości -->
             @foreach ($productImages as $image)
            <div class="mySlides">
                <a href="{{ asset(('photo/WatchProduct/'.$image->file_name)) }}" target="_blank">
                    <img src="{{ asset(('photo/WatchProduct/'.$image->file_name)) }}" style="width:100%">
                </a>
            </div>
            @endforeach

            <!-- Przyciski następne i poprzednie zdjęcie -->
            <div class="d-flex justify-content-center">
                <a class="prev btn" onclick="plusSlides(-1)">&#10094; Poprzedni</a>&nbsp;&nbsp;
                <a class="next btn" onclick="plusSlides(1)">Następny &#10095;</a>
            </div>

            <!-- Miniaturki zdjęć -->
            <div class="row">

                <?php $flag = 1; ?>
                @foreach ($productImages as $image)
                    <div class="col-md-3 p-1">
                        <img class="demo cursor" src="{{ asset(('photo/WatchProduct/'.$image->file_name)) }}" width=100 height=100 onclick="currentSlide({{ $flag }})">
                    </div>
                    <?php $flag++; ?>
                @endforeach

            </div>

        </div>
        
        <!-- informacje szczegółowe -->
        <div class="col-md-6 p-2 pt-4">
            <div class="p-3">
                @if($product->nominal_name)
                    <h3><b>{{ $product->nominal_name }}</b></h3>
                @endif

                @if($product->mechanism)
                <div class="d-flex justify-content-between mt-4 fontSize-18">
                    <span>Mechanizm:</span>
                    <span>{{ $product->mechanism }}</span>
                </div>
                <hr />
                @endif

                @if($product->years_of_production)
                <div class="d-flex justify-content-between mt-2 fontSize-18">
                    <span>Lata produkcji:</span>
                    <span>{{ $product->years_of_production }}</span>
                </div>
                <hr />
                @endif

                @if($product->watch_case_width)
                <div class="d-flex justify-content-between mt-2 fontSize-18">
                    <span>Szerokość koperty:</span>
                    <span>{{ $product->watch_case_width }}</span>
                </div>
                <hr />
                @endif

                @if($product->width_of_the_watchs_ear)
                <div class="d-flex justify-content-between mt-2 fontSize-18">
                    <span>Szerokość uszu:</span>
                    <span>{{ $product->width_of_the_watchs_ear }}</span>
                </div>
                <hr />
                @endif

                @if($product->ear_ear_dimension)
                <div class="d-flex justify-content-between mt-2 fontSize-18">
                    <span>Wymiar ucho-ucho:</span>
                    <span>{{ $product->ear_ear_dimension }}</span>
                </div>
                <hr />
                @endif

                @if($product->glass)
                <div class="d-flex justify-content-between mt-2 fontSize-18">
                    <span>Szkło:</span>
                    <span>{{ $product->glass }}</span>
                </div>
                <hr />
                @endif

                @if($product->number_of_stones)
                <div class="d-flex justify-content-between mt-2 fontSize-18">
                    <span>Liczba kamieni:</span>
                    <span>{{ $product->number_of_stones }}</span>
                </div>
                <hr />
                @endif

                <div class="d-flex justify-content-between mt-2 fontSize-18">
                    <span>Rodzaj zegarka:</span>
                    @switch ($product->gender)
                        @case ('men')
                            <span>męski</span>
                            @break
                        @case ('women')
                            <span>damski</span>
                            @break
                        @default
                            <span>dla obu płci</span>
                    @endswitch
                </div>
                <hr />
            </div>
        </div>
    </div>

    <!-- opisy długi i szczegółowy -->
    <div class="m-2 mt-4">
        @if($product->detailed_desc)
            <p class="fontSize-18">{{ $product->detailed_desc }}</p>
        @endif

        @if($longDescModel)
            <p class="fontSize-18">{{ $longDescModel }}</p>
        @endif
    </div>
</div>

<!-- Skrypt do wyświetlania galerii obrazów -->
<script src="{{ asset('js/showSlides.js') }}"></script>

@endsection