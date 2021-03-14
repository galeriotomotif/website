{{-- delete comfimation --}}

<div class="modal fade" tabindex="-1" role="dialog" id="delete-comfirmation-modal">
    <div class="modal-dialog" role="document">
        <form id="delete-comfirmation-form" method="POST">
            @csrf
            @method('DELETE')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Comfimation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this item</p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger btn-sm">Delete Item</button>
                    <button type="button" class="btn btn-dark btn-sm" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- end delete comfimation --}}

{{-- notification modal --}}

@if (Session::get('status'))
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="notification-modal"
    aria-hidden="true" id="notification-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="text-{{ Session::get('status') }}"><i class="fas fa-{{ Session::get('status') == 'success' ? 'check' : 'times' }}"></i> {{ Session::get('status') }}
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{ Session::get('message') }}
            </div>
        </div>
    </div>
</div>
@endif

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="notification-modal"
    aria-hidden="true" id="modal-notification">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Notification</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p id="modal-notification-message"></p>
            </div>
        </div>
    </div>
</div>

{{-- end notification modal --}}
