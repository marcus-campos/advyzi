<div class="row">
    <div class="form-group contracts col-xs-12">
        <div class="row">
            <div class="col-md-12">
                <label class="pull-left">O que contratou?</label>
                {!! Form::text('which_hired', null,['class' => 'form-control', 'placeholder' => 'Ex: Internet, tv...']) !!}

            </div>
        </div>
        <div class="form-group">
            <label>Operadora:</label>

        {{ Form::select('operator_id', $operators, null, ['id'=>'category_id', 'class' => 'form-control']) }}
        <!-- /.input group -->
        </div>
        <div class="form-group">
            <label>Início contrato:</label>

            <div class="input-group date">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </div>
                {!! Form::text('start_date', null,['id' => 'start_datemask', 'class' => 'form-control']) !!}
            </div>
            <!-- /.input group -->
        </div>
        <div class="form-group">
            <label>Fim contrato:</label>

            <div class="input-group date">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </div>
                {!! Form::text('end_date', null,['id' => 'end_datemask', 'class' => 'form-control']) !!}
            </div>
            <!-- /.input group -->
        </div>
        <div class="row">
            <div class="col-md-12">
                <label class="pull-left">Observações</label>
                {!! Form::textarea('description', null,['class' => 'form-control', 'placeholder' => 'Ex: Pacote de internet com velocidade de ...']) !!}
            </div>
        </div>
    </div>
</div>