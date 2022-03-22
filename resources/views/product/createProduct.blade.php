@extends('layout')

@section('sidebar')
<div class="list-group">
    <a href="/{{ $model_id }}/products-list" class="list-group-item list-group-item-action text-dark rounded" style="background-color: #ffffff; border: 1px solid white;">
        Powrót
    </a>
</div>
@endsection

@section('content')

<div class="container">
    <h4 class="mt-2">Dodanie nowego produktu:</h4>
    <form method="POST" action="store-product" enctype="multipart/form-data">
        @csrf

        <div class="form-group mt-2">
            <label for="nominal_name">Nazwa znamionowa:</label>
            <input type="text" class="form-control" name="nominal_name">
        </div>

        <div class="row mt-1">
            <div class="form-group col-md-6">
                <label for="mechanism">Mechanizm:</label>
                <input type="text" class="form-control" name="mechanism">
            </div>

            <div class="form-group col-md-6">
                <label for="years_of_production">Lata produkcji:</label>
                <input type="text" class="form-control" name="years_of_production">
            </div>
        </div>

        <div class="row mt-1">
            <div class="form-group col-md-6">
                <label for="watch_case_width">Szerokość koperty:</label>
                <input type="text" class="form-control" name="watch_case_width">
            </div>

            <div class="form-group col-md-6">
                <label for="width_of_the_watchs_ear">Szerokość uszu:</label>
                <input type="text" class="form-control" name="width_of_the_watchs_ear">
            </div>
        </div>

        <div class="row mt-1">
            <div class="form-group col-md-6">
                <label for="ear_ear_dimension">Wymiar ucho-ucho:</label>
                <input type="text" class="form-control" name="ear_ear_dimension">
            </div>

            <div class="form-group col-md-6">
                <label for="glass">Szkło:</label>
                <input type="text" class="form-control" name="glass">
            </div>
        </div>

        <div class="form-group mt-1">
            <label for="detailed_desc">Opis szczegółowy:</label>
            <textarea class="form-control" name="detailed_desc" rows="6"></textarea>
        </div>

        <div class="custom-file mt-2">
            <label class="custom-file-label mb-1" for="images[]">Wybierz obrazy:</label></br>
            <input type="file" class="custom-file-input" name="images[]" multiple>
            <!-- podpowiedź -->
            <div class="form-text">Aby dodać kilka zdjęć naraz, należy wybrać zdjęcia z wciśniętym klawiszem CTRL.</div>
        </div>

        <button type="submit" class="btn mt-4 rounded" style="background-color: #4a3526; color:white; border:0px; float:right">
            <img src="{{ asset(('thumbnail/add.png')) }}" width=20 height=20 alt="add">    
            Dodaj
        </button>
    </form>
</div>

@endsection