@extends('layouts.app')
@section('content')
  <section class="content">
    <div class="box">
      <div class="box-header with-border">
        <h3>Título principal
          <a href="#"><button class="btn btn-success">Nuevo</button></a>
        </h3>
        <div class="input-group">
          <input type="text" class="form-control" name="searchText"  placeholder="Buscar..." value="">
          <span class="input-group-btn">
            <button class="btn btn-primary">Buscar</button>
          </span>
        </div>
        <div class="table-responsive">
          <table class="table table-striped table-bordered table-condensed table-hover">
            <thead>
              <th>Campo 1</th>
              <th>Campo 2</th>
              <th>Campo 3</th>
              <th>Campo 4</th>
              <th>Estado</th>
              <th>Opciones</th>
            </thead>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td><span class="label label-info">Positivo</span><span class="label label-danger">Negativo</span></td>
              <td><button class="btn btn-primary">Bonton 1</button> <button class="btn btn-danger">Boton 2</button></td>

            <tbody>

            </tbody>
          </table>
          <ul class="pagination">

                    <li class="disabled"><span>«</span></li>

<li class="active"><span>1</span></li>
 <li><a href="http://localhost/oficial/public/clientes?page=2">2</a></li>


                    <li><a href="" rel="next">»</a></li>
            </ul>
        </div>
      </div>
    </div>
  </section>
@endsection
