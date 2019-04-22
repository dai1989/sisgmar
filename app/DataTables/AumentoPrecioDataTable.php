<?php

namespace App\DataTables;

use App\Models\AumentoPrecio;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable; 

class AumentoPrecioDataTable extends DataTable
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

        return $dataTable->addColumn('action', 'aumento_precios.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Post $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(AumentoPrecio $model)
    {
        return $model->with('producto','user');
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
                    'create',
                    'export',
                    'print',
                    'reset',
                    'reload',
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
            
            'Producto' => ['name' => 'productos.descripcion', 'data' => 'productos.descripcion'],
            'Vendedor' => ['name' => 'user.name', 'data' => 'user.name'],
            'Fecha-Hora' => ['name' => 'fecha_hora', 'data' => 'fecha_hora'],
            'Aumento %' => ['name' => 'aumento', 'data' => 'aumento'],
            
            
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'aumento_preciosdatatable_' . time();
    }
}