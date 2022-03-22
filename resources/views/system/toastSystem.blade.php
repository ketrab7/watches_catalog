<div class="toast" role="alert" aria-live="assertive" aria-atomic="true" style="position: absolute; bottom: 10px; right: 10px;">
    <div class="toast-header justify-content-between">
        <div>
            <strong class="mr-auto">System</strong>
        </div>
        <div>
            <small class="text-muted">chwilę temu...</small>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast"  style="background-color: Transparent; border: 0px;">
                <span aria-hidden="true">&times;</span>
        </button>
        </div>
    </div>
    <div class="toast-body">
        {{ session('toast') }}
    </div>
</div>