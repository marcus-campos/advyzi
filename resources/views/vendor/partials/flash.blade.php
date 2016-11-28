@if (Session::has('success'))
    <div class='alert alert-success center'>{!! Session::get('success') !!}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php
    // Because of ajax I have to unset the session value, or else message repeats
    // after selecting another filter, for example
    Session::forget('success');
    ?>
@endif
@if (Session::has('warning'))
    <div class='alert alert-danger center'>{!! Session::get('warning') !!}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php
    Session::forget('warning');
    ?>
@endif
<script>
    $('div.alert').not('.alert-important, .alert-danger').delay(3000).slideUp();
</script>