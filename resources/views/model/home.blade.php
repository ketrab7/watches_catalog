@extends('layout')

@section('sidebar')
    <div class="list-group">
        <!-- Dodawanie modelu model w zewnętrznym pliku-->
        <button class="list-group-item list-group-item-action rounded navbar-myButtonColor" type="button" data-toggle="modal" data-target="#addModel">
            <img src="{{ asset(('thumbnail/add.png')) }}" width=20 height=20 alt="add">
            Dodaj
        </button>
        <hr/>
        <!-- paginacja w przyszłości obsłużyć AJAX-EM -->
        <form action="/update-paginate" method="post">
            <label for="picture" class="m-1">Ustawienia paginacji:</label>
            <br/>
            <input type="text" name="pagination" class="form-control" value="{{ $paginationValue }}">
            <button class="list-group-item list-group-item-action mt-2 rounded navbar-myButtonColor" type="submit">
                <img class="pb-1" src="{{ asset(('thumbnail/edit.png')) }}" width=20 height=20 alt="search">
                Zmień
            </button>
        </form>
    </div>

@endsection

@section('content')
<div class="container-fluid">
    <!-- dostępne modele -->
    <div class="tasks row mt-4 mb-4">
        @foreach($data as $value)
        <div class="col-sm-12 col-md-6 col-lg-4 col-xl-2 mt-2 mb-4">
            <div class="task card shadow" data-id="{{ $value->id }}">
                <div class="myCard-color rounded">
                    <!-- zdjęcie -->
                    <div class="myCard-image">
                        <a href="/{{ $value->id }}/products-list">
                            <img class="shadow rounded" src="{{ asset(('photo/WatchModel/'.$value->file_path)) }}"/>
                        </a>
                    </div>                

                    <div class="card-body pt-2 pb-1">
                        <div class="myCard-title">
                            {{ $value->name }}
                        </div>
                        <div class="m-2">
                            <p class="card-text">{{ $value->short_desc }}</p>
                        </div>
                    </div>
                </div>
                <!-- wklejenie context menu -->
                <div class="task__actions"></div>
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
                <a type="button" class="context-menu__link" data-action="edit-model">
                    <img src="{{ asset(('thumbnail/edit.png')) }}" width=20 height=20 alt="edit">
                    Edytuj
                </a>
            </li>
            <li class="context-menu__item">
                <form action="/delete-model" method="POST">
                    @csrf
                    @method('DELETE')
                
                    <a type="button" class="context-menu__link" data-action="delete-model">
                        <img src="{{ asset(('thumbnail/delete.png')) }}" width=20 height=20 alt="delete">
                        Usuń
                    </a>
                </form>
            </li>
        </ul>
    </nav>

    <!-- context menu skrypt z generowaniem adresów URL -->
    <script src="{{asset('js/modelContextMenu.js')}}"></script>
</div>

@endsection

