@if ($errors->any())
    @foreach($errors->all() as $error)
        <div class='alert alert-danger center'>{!! $error !!}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endforeach
    <input type='hidden' id='error_flag' value="<?=!empty($errorFlag)?$errorFlag:''?>" />
@endif