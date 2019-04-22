<?php

namespace App\DataTables;

use App\Models\Pago;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\EloquentDataTable;

class PagoDataTable extends DataTable
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

        return $dataTable->addColumn('action', 'pagos.datatables_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Post $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Pago $model)
    {
         return $model->with('proveedor');
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
                    
                    'excel',
                    
                    
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
            'Fecha Inicial' => ['name' => 'fecha_hora', 'data' => 'fecha_hora'],
            'Proveedor' => ['name' => 'proveedor.razonsocial', 'data' => 'proveedor.razonsocial'],
            'medio_pago',
            'N° cheque/comprobante' => ['name' => 'num_cheque', 'data' => 'num_cheque'],
            'monto_pedido',
            'Fecha cobro/Aprox' => ['name' => 'fecha_cobro', 'data' => 'fecha_cobro'],
            'estado'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'pagosdatatable_' . time();
    }
}