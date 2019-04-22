
                {!! Form::open(['route' => ['ingreso.destroy', $ingreso->idingreso], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('ingreso.show', [$ingreso->idingreso]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{{ url('ingreso/pdf/' . $ingreso->idingreso) }}"class='btn btn-success btn-xs'><i class="fa fa-file-pdf-o"></i></a>
                    <a href="" data-target="#modal-delete-{{$ingreso->idingreso}}" data-toggle="modal" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></a>
                