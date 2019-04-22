<?php

namespace App\DataTables;

use App\Models\Domicilio;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class DomicilioDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $dataTable = new EloquentDataTable($query);

        return $dataTable->addColumn('action', 'domicilios.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Post $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Domicilio $model)
    {
        return $model->with('provincia','localidad','tipodomicilio','persona');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->addAction(['width' => '80px','printable' => false])
            ->parameters([
                'dom'     => 'Bfrtip',
                'order'   => [[0, 'desc']],
                'language' => ['url' => asset('js/SpanishDataTables.json')],
                'scrollX' => false,
                'responsive' => true,
                'buttons' => [
                    
                ],
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'Nombre' => ['name' => 'persona.nombre', 'data' => 'persona.nombre'],
            'Apellido' => ['name' => 'persona.apellido', 'data' => 'persona.apellido'],

         'Calle' => ['name' => 'calle', 'data' => 'calle'],
             'Descripcion' => ['name' => 'descripcion', 'data' => 'descripcion'],
            'Numeracion' => ['name' => 'calle_numero', 'data' => 'calle_numero'],
            'Tipo de Domicilio' => ['name' => 'tipodomicilio.tipo_descripcion', 'data' => 'tipodomicilio.tipo_descripcion'],
            'Provincia' => ['name' => 'provincia.descripcion', 'data' => 'provincia.descripcion'],
            'Localidad' => ['name' => 'localidad.localidad_descripcion', 'data' => 'localidad.localidad_descripcion']
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'domiciliosdatatable_' . time();
    }
}