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
        <div class="tasks col-sm-12 col-md-6 col-lg-4 col-xl-2 mt-2 mb-4">
        <div class="task card shadow" data-id="{{ $value->id }}">
                <div class="myCard-color rounded">
                    <!-- zdjęcie -->
                    <div class="myCard-image">
                        <a href="product-card/{{ $value->id }}">
                            <img class="shadow rounded" src="{{ asset(('photo/WatchProduct/'.$value->file_name)) }}" width=200 height=200/>
                        </a>
                    </div>                

                    <div class="card-body pt-2 pb-1">
                        <div class="myCard-title">
                            {{ $value->nominal_name }}
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

    <!-- context menu - wyswietlane po nacisnieciu PPM -->
    <nav id="context-menu" class="context-menu rounded">
        <ul class="context-menu__items">
            <li class="context-menu__item">
                <a type="button" class="context-menu__link" data-action="edit-product">
                    <img src="{{ asset(('thumbnail/edit.png')) }}" width=20 height=20 alt="edit">
                    Edytuj
                </a>
            </li>
            <li class="context-menu__item">
                <form action="/delete-model" method="POST">
                    @csrf
                    @method('DELETE')
                
                    <a type="button" class="context-menu__link" data-action="delete-product">
                        <img src="{{ asset(('thumbnail/delete.png')) }}" width=20 height=20 alt="delete">
                        Usuń
                    </a>
                </form>
            </li>
        </ul>
    </nav>

    <!-- context menu skrypt z generowaniem adresów URL -->
    <script src="{{asset('js/productContextMenu.js')}}"></script>
</div>

@endsection