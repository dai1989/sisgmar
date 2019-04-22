@section('css')
	<link rel="stylesheet" href="{{URL::to('/')}}/plantilla/datepicker/datetimepicker.css">
@stop
{!! Form::open(array('url'=>'disminucionPrecios', 'method'=>'GET', 'autocomplete'=>'off', 'role'=>'search')) !!}


<div class="row">
	<div class="col-lg-11 col-md-11 col-sm-11 col-xs-12">
		<div class="row">
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<div class="form-group">
					<input type="text" class="form-control" name="searchText"  placeholder="Buscar marca de producto..." value="{{$searchText}}">
				</div>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<div class="row">
					<div class='col-lg-6 col-md-6 col-sm-6 col-xs-12'>
						<div class="form-group">
							<div class='input-group date' id='datetimepicker6'>
								<input type='text' name="inicio" placeholder="Fecha Inicio..." value="{{$inicio}}" class="form-control" />
								<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                </span>
							</div>
						</div>
					</div>
					<div class='col-lg-6 col-md-6 col-sm-6 col-xs-12'>
						<div class="form-group">
							<div class='input-group date' id='datetimepicker7'>
								<input type='text' name="fin" value="{{$fin}}" placeholder="Fecha Final..." class="form-control" />
								<span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">
		<span class="input-group-btn">
			<button class="btn btn-primary">Buscar</button>
		</span>
	</div>
</div>


{{Form::close()}}

@section('js')

	<script src="{{URL::to('/')}}/plantilla/datepicker/moment.js" ></script>
	<script src="{{URL::to('/')}}/plantilla/datepicker/datetimepicker.js" ></script>
	<script src="{{URL::to('/')}}/plantilla/datepicker/es.js" ></script>

    <script>

        $(function () {
            $('#datetimepicker6').datetimepicker({
                locale: 'es',
                format: 'YYYY-MM-DD'
			});

            $('#datetimepicker7').datetimepicker({
                useCurrent: false, //Important! See issue #1075
                locale: 'es',
                format: 'YYYY-MM-DD'
            });
            $("#datetimepicker6").on("dp.change", function (e) {
                $('#datetimepicker7').data("DateTimePicker").minDate(e.date);
            });
            $("#datetimepicker7").on("dp.change", function (e) {
                $('#datetimepicker6').data("DateTimePicker").maxDate(e.date);
            });
        });
	</script>
@stop

