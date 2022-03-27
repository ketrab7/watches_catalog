@extends('layout')

@section('sidebar')
<div class="list-group">
    <a href="/{{ $model_id }}/products-list" class="list-group-item list-group-item-action rounded navbar-myButtonColor">
        Powrót
    </a>
</div>
@endsection

@section('content')

<div class="container">
    <form class="card m-2" method="POST" action="/{{ $model_id }}/update-product" enctype="multipart/form-data">
        <div class="card-body">

            <h4 class="card-title">Edycja produktu:</h4>
            <hr/>

            @csrf

            <div class="row mt-2">
                <div class="form-group col-md-4">
                    <label for="name">ID produktu:</label>
                    <input type="text" class="form-control" name="product_id" value="{{ $product_data->id }}" readonly>
                </div>

                <div class="form-group col-md-4">
                    <label for="name">Data dodania:</label>
                    <input type="text" class="form-control" value="{{ $product_data->created_at }}" readonly>
                </div>

                <div class="form-group col-md-4">
                    <label for="short_desc">Data aktualizacji:</label>
                    <input type="text" class="form-control" value="{{ $product_data->updated_at }}" readonly>
                </div>
            </div>

            <div class="form-group mt-2">
                <label for="nominal_name">Nazwa znamionowa:</label>
                <input type="text" class="form-control" name="nominal_name" value="{{ $product_data->nominal_name }}">
            </div>

            <div class="row mt-1">
                <div class="form-group col-md-6">
                    <label for="mechanism">Mechanizm:</label>
                    <input type="text" class="form-control" name="mechanism" value="{{ $product_data->mechanism }}">
                </div>

                <div class="form-group col-md-6">
                    <label for="years_of_production">Lata produkcji:</label>
                    <input type="text" class="form-control" name="years_of_production" value="{{ $product_data->years_of_production }}">
                </div>
            </div>

            <div class="row mt-1">
                <div class="form-group col-md-6">
                    <label for="watch_case_width">Szerokość koperty:</label>
                    <input type="text" class="form-control" name="watch_case_width" value="{{ $product_data->watch_case_width }}">
                </div>

                <div class="form-group col-md-6">
                    <label for="width_of_the_watchs_ear">Szerokość uszu:</label>
                    <input type="text" class="form-control" name="width_of_the_watchs_ear" value="{{ $product_data->width_of_the_watchs_ear }}">
                </div>
            </div>

            <div class="row mt-1">
                <div class="form-group col-md-6">
                    <label for="ear_ear_dimension">Wymiar ucho-ucho:</label>
                    <input type="text" class="form-control" name="ear_ear_dimension" value="{{ $product_data->ear_ear_dimension }}">
                </div>

                <div class="form-group col-md-6">
                    <label for="glass">Szkło:</label>
                    <input type="text" class="form-control" name="glass" value="{{ $product_data->glass }}">
                </div>
            </div>

            <div class="row mt-1">
                <div class="form-group col-md-6">
                    <label for="number_of_stones">Liczba kamieni:</label>
                    <input type="text" class="form-control" name="number_of_stones" value="{{ $product_data->number_of_stones }}">
                </div>

                <div class="form-group col-md-6">
                    <label for="gender">Rodzaj zegarka:</label>
                    <select class="form-control" name="gender">
                        @switch ($product_data->gender)
                            @case ('men')
                                <option value="men">męski</option>
                                <option value="women">damski</option>
                                <option value="unisex">dla obu płci</option>
                                @break
                            @case ('women')
                                <option value="women">damski</option>
                                <option value="men">męski</option>
                                <option value="unisex">dla obu płci</option>
                                @break
                            @default
                                <option value="unisex">dla obu płci</option>
                                <option value="men">męski</option>
                                <option value="women">damski</option>
                        @endswitch
                    </select>
                </div>
            </div>

            <div class="form-group mt-1">
                <label for="detailed_desc">Opis szczegółowy:</label>
                <textarea class="form-control" name="detailed_desc" rows="6">{{ $product_data->detailed_desc }}</textarea>
            </div>

            <div class="custom-file mt-2">
                <label class="custom-file-label mb-1" for="images[]">Wybierz obrazy jeśli chcesz dodać nowe dla tego produktu:</label></br>
                <input type="file" class="custom-file-input" name="images[]" multiple>
                <!-- podpowiedź -->
                <div class="form-text">Aby dodać kilka zdjęć naraz, należy wybrać zdjęcia z wciśniętym klawiszem CTRL.</div>
            </div>

            <hr/>
            <button type="submit" class="btn-myButtonColor mt-1">
                <img src="{{ asset(('thumbnail/edit.png')) }}" width=20 height=20 alt="edit">    
                edytuj
            </button>
        </div>     
    </form>
    
    <div class="pt-4">

        <!-- karty ze zdjęciami a po zaznaczeniu przycisk usuń -->
        <form class="card m-2" method="POST" action="/{{ $model_id }}/delete-product-images" onsubmit="return confirm('Na pewno chcesz usunąć te zdjęcia?')">
            <div class="card-body">

                <h4 class="card-title">Usuwanie poszczególnych zdjęć produktu:</h4>
                <hr/>

                @csrf
                @method('DELETE')

                <div class="row">
                    @foreach($product_images as $image)
                    <!-- zdjęcia z checkbox'em -->
                    <div class="col-md-2 form-check">
                        <input type="checkbox" class="form-check-input" id="check{{ $image->id }}" name="checkedPhotos[]" value="{{ $image->id }}">
                        <label class="form-check-label" for="check{{ $image->id }}">
                            <img src="{{ asset(('photo/WatchProduct/'.$image->file_name)) }}" width=100 height=100>
                        </label>
                    </div>
                    @endforeach
                </div>
                
                <hr/>
                <button type="submit" class="btn-myButtonColor mt-1">
                    <img src="{{ asset(('thumbnail/delete.png')) }}" width=20 height=20 alt="delete">    
                    Usuń zdjęcia
                </button>
            </div>     
        </form>
    </div>
    
</div>

@endsection