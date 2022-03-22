@extends('layout')

@section('sidebar')
<div class="list-group">
    <a href="/" class="list-group-item list-group-item-action text-dark rounded" style="background-color: #ffffff; border: 1px solid white;">
        Powrót
    </a>
</div>
@endsection

@section('content')
<div class="container">
    <h4 class="mt-2">Edycja modelu:</h4>
    <form method="POST" action="/update-model" enctype="multipart/form-data">
        @csrf

        <div class="row mt-2">
            <div class="form-group col-md-4">
                <label for="name">ID modelu:</label>
                <input type="text" class="form-control" name="model_id" value="{{ $model->id }}" readonly>
            </div>

            <div class="form-group col-md-4">
                <label for="name">Data dodania:</label>
                <input type="text" class="form-control" value="{{ $model->created_at }}" readonly>
            </div>

            <div class="form-group col-md-4">
                <label for="short_desc">Data aktualizacji:</label>
                <input type="text" class="form-control" value="{{ $model->updated_at }}" readonly>
            </div>
        </div>

        <div class="form-group mt-1">
            <label for="name">Nazwa modelu:</label>
            <input type="text" class="form-control" name="name" value="{{ $model->name }}">
        </div>

        <div class="form-group mt-1">
            <label for="short_desc">Opis krótki:</label>
            <textarea class="form-control" name="short_desc" rows="3">{{ $model->short_desc }}</textarea>
        </div>

        <div class="form-group mt-1">
            <label for="long_desc">Opis długi:</label>
            <textarea class="form-control" name="long_desc" rows="6">{{ $model->long_desc }}</textarea>
        </div>

        <div class="custom-file mt-2">
            <label class="custom-file-label mb-1" for="image">Wybierz nowy obraz jeśli chcesz zamienić go, dla tego modelu:</label></br>
            <input type="file" class="custom-file-input" name="image" multiple>
            <!-- podpowiedź -->
            <div class="form-text">W przypadku gdy nie zostanie wybrany nowy obraz, stary pozostanie dalej aktualny.</div>
        </div>

        <button type="submit" class="btn mt-4" style="background-color: #4a3526; color:white; border:0px; border-radius: 5px; float:right">
            Zapisz
        </button>
    </form>
</div>

@endsection