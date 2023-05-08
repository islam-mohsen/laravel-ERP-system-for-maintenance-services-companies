<?php

namespace App\DataTables;

use App\MachineInformation;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;

class MachineInformationDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($machine)
    {
        return datatables()
            ->of($machine)
            ->addColumn('Engineer', function($machine) {
                 return $machine->engineer->name;
               })
            ->addColumn('Update', function($machine) {
                 return '<a class="btn btn-danger" href="'.url('machineUpdate/'.$machine->id).'">Update</a>';
               })
               ->addColumn('Reports', function($machine) {
                    return '<a class="btn btn-danger" href="'.url('machineReports/'.$machine->id).'">Reports</a>';
                  })
         ->rawColumns(['Update','Reports']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\MachineInformation $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(MachineInformation $machine)
    {
          $machine = MachineInformation::with('engineer');
        return $machine->newQuery($machine);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('id')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->scrollX(true)
                    ->parameters([
                'lengthMenu' => [ 5, 10, 25, 75, 100 ],
                'order'   => [[1, 'desc']],
                'buttons' => ['pageLength','reset','excel'],
                'initComplete' => "function () {
        this.api().columns().every(function () {
            var column = this;
            var input = document.createElement(\"input\");
            $(input).appendTo($(column.footer()).empty())
            .on('change', function () {
                column.search($(this).val(), false, false, true).draw();
            });
        });
    }"

                ]) ;
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
           Column::make('id'),
           Column::computed('name')
                   ->exportable(true)
                   ->printable(true)
                   ->searchable(true)
                   ->addClass('text-center'),
            Column::make('machine_serial'),
            Column::make('model_number'),
            Column::make('machine_serial'),
            Column::make('machine_place'),
            Column::make('contract'),
            Column::make('address'),
            Column::make('phone'),
            Column::make('telephone'),
            Column::make('contact_name'),
            Column::make('day_of_week'),
            Column::make('open_time'),
            Column::make('close_time'),
            Column::make('contract_start'),
            Column::make('billing_period'),
            Column::make('minimum_charge'),
            Column::make('free_copies'),
            Column::make('excess_copies'),
            Column::make('notes'),
            Column::make('Engineer'),
            Column::computed('Update')
                    ->exportable(false)
                    ->printable(false)
                    ->width(150)
                    ->addClass('text-center'),
                    Column::computed('Reports')
                            ->exportable(false)
                            ->printable(false)
                            ->width(150)
                            ->addClass('text-center'),

        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'MachineInformation_' . date('YmdHis');
    }
}
