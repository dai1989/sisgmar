<?php

namespace App\DataTables;

use App\Models\DomicilioProveedor;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class DomicilioProveedorDataTable extends DataTable
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

        return $dataTable->addColumn('action', 'domicilio_proveedors.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Post $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(DomicilioProveedor $model)
    {
         return $model->with('provincia','localidad','tipodomicilio','proveedor');
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
             'Proveedor' => ['name' => 'proveedor.razonsocial', 'data' => 'proveedor.razonsocial'],
             'Calle' => ['name' => 'calle', 'data' => 'calle'],
             'Descripcion' => ['name' => 'descripcion', 'data' => 'descripcion'],
            'Numeracion' => ['name' => 'calle_numero', 'data' => 'calle_numero'],
            
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
        return 'domicilio_proveedorsdatatable_' . time();
    }
}