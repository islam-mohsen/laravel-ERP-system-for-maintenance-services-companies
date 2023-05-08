<?php

namespace App\DataTables;

use App\ServiceReport;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;

class ServiceReportDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($ServiceReport)
    {
        return datatables()
        ->of($ServiceReport)
        ->addColumn('Machine name', function($ServiceReport) {
              return  $ServiceReport->reportMachine->name;
            })
            ->addColumn('Model number', function($ServiceReport) {
                  return  $ServiceReport->reportMachine->model_number;
                })
                ->addColumn('Machine serial', function($ServiceReport) {
                      return  $ServiceReport->reportMachine->machine_serial;
                    })

            ->addColumn('Call number', function($ServiceReport) {
                  return  $ServiceReport->call->id;
                })
                ->addColumn('engineer name', function($ServiceReport) {
                      return  $ServiceReport->engineers->name;
                    })
                    ->addColumn('Product', function($ServiceReport) {
                      $optin = array();
                    foreach ($ServiceReport->prd as $prdo) {
                    $optin[] = ' '.$prdo->part_num.' ';
                      }
                      return $optin;
      })->rawColumns(['Product','engineer name']);
     }

    /**
     * Get query source of dataTable.
     *
     * @param \App\ServiceReport $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ServiceReport $model)
    {
      $ServiceReport = ServiceReport::with('call')->with('reportMachine')->with('engineers')->with('prd');
        return $ServiceReport->newQuery();
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
                    //  ->buttons(
                    //      Button::make('pageLength'),
                    //      Button::make('export'),
                    //      Button::make('print'),
                    //      Button::make('reset'),
                      //    Button::make('reload')
                    //  )
                      ->parameters([
                  'lengthMenu' => [ 5, 10, 25, 75, 100 ],
                  'order'   => [[1, 'desc']],
                  'buttons' => ['pageLength','reload'],
                  'initComplete' => "function () {
                      this.api().columns().every(function () {
                          var column = this;
                          var input = document.createElement(\"input\");
                          $(input).appendTo($(column.footer()).empty())
                          .on('change', function () {
                              column.search($(this).val(), false, false, true).draw();
                          });
                      });
                  }",
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
            Column::make('visite_date'),
            Column::computed('Machine name')
                  ->name('reportMachine.name')
                  ->exportable(true)
                  ->printable(true)
                  ->searchable(true)
                  ->addClass('text-center'),
          Column::computed('Model number')
                  ->name('reportMachine.model_number')
                  ->exportable(true)
                  ->searchable(true)
                  ->printable(true)
                  ->addClass('text-center'),
          Column::computed('Machine serial')
                  ->name('reportMachine.machine_serial')
                  ->exportable(true)
                  ->searchable(true)
                  ->printable(true)
                  ->addClass('text-center'),
            Column::computed('Call number')
                  ->name('call.id')
                  ->exportable(true)
                  ->searchable(true)
                  ->printable(true)
                  ->addClass('text-center'),
            Column::computed('engineer name')
                  ->name('engineers.name')
                  ->exportable(true)
                  ->searchable(true)
                  ->printable(true)
                  ->addClass('text-center'),
            Column::computed('Product')
                  ->name('prd.part_num')
                  ->exportable(true)
                  ->searchable(true)
                  ->printable(true)
                  ->addClass('text-center'),
            Column::make('job_complete'),
            Column::make('meter_reading'),
            Column::make('work_start'),
            Column::make('work_end'),
            Column::make('cust_time'),
            Column::make('store_time'),
            Column::make('comments'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'ServiceReport_' . date('YmdHis');
    }
}
