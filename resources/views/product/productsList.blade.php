@extends('layout')

@section('sidebar')
<div class="list-group">
    <!-- Dodawanie produktu- przekierownaie do nowego blade
        w href bez / na początku odzyskujemy id modelu -->
    <a href="create-product" class="list-group-item list-group-item-action rounded navbar-myButtonColor">
        <img src="{{ asset(('thumbnail/add.png')) }}" width=20 height=20 alt="add">
        Dodaj nowy produkt
    </a>
    <hr/>
    <!-- TODO: paginacja w przyszłości obsłużyć AJAX-EM -->
    <form action="/update-paginate" method="post">
        <label for="picture" class="m-1">Ustawienia paginacji:</label><br/>
        <input type="text" name="pagination" class="form-control" value="{{ $paginationValue }}">
        <button class="list-group-item list-group-item-action mt-2 rounded navbar-myButtonColor" type="submit">
            <img class="pb-1" src="{{ asset(('thumbnail/edit.png')) }}" width=20 height=20 alt="edit">
            Zmień
        </button>
    </form>

    <hr/>
    <a href="/" class="list-group-item list-group-item-action rounded navbar-myButtonColor">
        Powrót do modeli
    </a>
</div>
@endsection

@section('content')

<!-- carty z produktami -->
<div class="container-fluid">
    <div class="row mt-4 mb-4">
        @foreach($data as $value)
        <div class="col-sm-12 col-md-6 col-lg-4 col-xl-2 mt-2 mb-4">
            <div class="card shadow">
                <div class="myCard-color rounded">
                    <!-- zdjęcie -->
                    <div class="myCard-image">
                        <a href="product-card/{{ $value->id }}">
                            <img class="shadow rounded" src="{{ asset(('photo/WatchProduct/'.$value->file_name)) }}" width=200 height=200/>
                        </a>
                    </div>                

                    <div class="card-body pt-2 pb-1">
                        <div class="row">
                            <div class="col-10">
                                <div class="myCard-title">
                                    {{ $value->nominal_name }}
                                </div>
                            </div>
                                
                            <div class="col-2 mt-2">
                                <div class="dropdown">
                                    <button type="button" class="dropdown-toggle transparent-color" data-toggle="dropdown"></button>
                                    <div class="dropdown-menu">
                                        <!-- edytowanie produktu -->
                                        <a class="dropdown-item" href="edit-product/{{ $value->id }}">
                                            <img src="{{ asset(('thumbnail/edit.png')) }}" width=20 height=20 alt="search">
                                            Edytuj
                                        </a>
                                        <!-- usuwanie -->
                                        <form action="/delete-product" method="POST" onsubmit="return confirm('Na pewno chcesz usunąć ten produkt?')">
                                            @csrf
                                            @method('DELETE')
                                            
                                            <input type="hidden" name="product_id" value="{{ $value->id }}">
                                        
                                            <button type="submit" class="dropdown-item">
                                                <img src="{{ asset(('thumbnail/delete.png')) }}" width=20 height=20 alt="delete">
                                                Usuń
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <!-- wyśrodkowanie paginacji - domyślna klasa bootstrapa -->
    <div class="d-flex justify-content-center">
        {{ $data->onEachSide(5)->links() }}
    </div>

</div>

@endsection