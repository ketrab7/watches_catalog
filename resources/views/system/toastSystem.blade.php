<div class="toast toast-position" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header justify-content-between">
        <div>
            <strong class="mr-auto">System</strong>
        </div>
        <div>
            <small class="text-muted">chwilę temu...</small>
            <button type="button" class="ml-2 mb-1 close transparent-color" data-dismiss="toast">
                <span aria-hidden="true">&times;</span>
        </button>
        </div>
    </div>
    <div class="toast-body">
        {{ session('toast') }}
    </div>
</div>