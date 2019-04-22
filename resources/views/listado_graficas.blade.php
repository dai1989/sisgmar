@extends('layouts.app')

@section('htmlheader_title')
  {{ trans('adminlte_lang::message.home') }}
@endsection


@section('content')
  <div class="content">
    @include('flash::message')

   
     <div class="container-fluit">
    @include('flash::message')
  </div>
  <?php  $nombremes=array("","ENERO","FEBRERO","MARZO","ABRIL","MAYO","JUNIO","JULIO","AGOSTO","SEPTIEMBRE","OCTUBRE","NOVIEMBRE","DICIEMBRE"); ?>

<div  class="row" >
<div class="col-md-6">
                  <label>Año</label>
                  <select class="form-control" id="anio_sel"  onchange="cambiar_fecha_grafica();">

                  <?php  echo '<option value="'.$anio.'" >'.$anio.'</option>';   ?>
                    <option value="2018" >2018</option>
                    <option value="2019" >2019</option>
                    <option value="2020" >2020</option>
                    <option value="2021">2021</option>
                    <option value="2022" >2022</option>
                  </select>
                </div>
                <div class="col-md-6">
                  <label>Mes</label>
                  <select class="form-control" id="mes_sel" onchange="cambiar_fecha_grafica();" >
                  <?php  echo '<option value="'.$mes.'" >'.$nombremes[intval($mes)].'</option>';   ?>
                    <option value="1">ENERO</option>
                    <option value="2">FEBRERO</option>
                    <option value="3">MARZO</option>
                    <option value="4">ABRIL</option>
                    <option value="5">MAYO</option>
                    <option value="6">JUNIO</option>
                    <option value="7">JULIO</option>
                    <option value="8">AGOSTO</option>
                    <option value="9">SEPTIEMBRE</option>
                    <option value="10">OCTUBRE</option>
                    <option value="11">NOVIEMBRE</option>
                    <option value="12">DICIEMBRE</option>
                  
                  </select>

</div>
</div>

<div  class="row" >
<br/>
  <div class="box box-primary">
    <div class="box-header">
    </div>

    <div class="box-body" id="div_grafica_barras">
    </div>

      <div class="box-footer">
    </div>
  </div>



    <br/>



  <br/>
 


</div>


@endsection

@section('js')

  

  
  
  
  <script>
cargar_grafica_barras(<?= $anio; ?>,<?= intval($mes); ?>);


</script>
 <!-- javascript del sistema laravel -->
   <script src="js/sistemalaravel.js"></script>
  <script src="js/highcharts.js"></script>
  <script src="js/grafico.js"></script>

   {{--<script>cargarlistado(1);</script>--}}
  </div>
   

@endsection
