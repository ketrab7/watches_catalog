<div class="modal fade" id="addModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" style="background-color: #e3d9c6;">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Dodaj nowy model:</h5>
                <button type="button" style="background-color: Transparent; border: 0px; font-size:22px;" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" id="create-model" action="/create-model" enctype="multipart/form-data">
                    <!--    enctype wymagany do przesłania zdjęcia w formularzu
                            token wymagany do działania POST -->
                    @csrf

                    <div class="form-group">
                        <label for="name">Nazwa modelu:</label>
                        <input type="text" class="form-control" name="name">
                    </div>

                    <div class="form-group mt-1">
                        <label for="short_desc">Opis krótki:</label>
                        <textarea class="form-control" name="short_desc" rows="3"></textarea>
                    </div>

                    <div class="form-group mt-1">
                        <label for="long_desc">Opis długi:</label>
                        <textarea class="form-control" name="long_desc" rows="6"></textarea>
                    </div>

                    <div class="form-group mt-2">
                        <label for="image">Dodaj zdjęcie:</label><br/>
                        <input type="file" class="form-control-file" name="image">
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" form="create-model" class="btn" style="background-color: #4a3526; color:white;  border:0px;">
                    <img src="{{ asset(('thumbnail/add.png')) }}" width=20 height=20 alt="add">
                    Dodaj
                </button>
            </div>
        </div>
    </div>
</div>