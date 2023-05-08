<?php

namespace App\DataTables;

use App\Call;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;
use App\MachineInformation;

class CallDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($call)
    {

        return datatables()
            ->of($call)
            ->addColumn('machineName', function($call) {
                  return  $call->machineInformation->name;
                })
                ->addColumn('machineSerial', function($call) {
                      return  $call->machineInformation->machine_serial;
                    })
                    ->addColumn('complete', function($call) {
                      if ($call->servicereports->last()['job_complete']) {
                        return 'completed';
                      } else {
                        return 'UNcompleted';
                      }
                       })
               ->addColumn('add', function($call) {
                    return '<a class="btn btn-info" href="'.url('chooseEnginner/'.$call->id).'">Add report</a>';
                  })
                  ->addColumn('view', function($call) {
                    if ($call->servicereports->isEmpty()) {
                      return '<button class="btn btn-primary" >No reports</button>';
                    } else {
                      return '<a class="btn btn-secondary" href="'.url('viewReport/'.$call->id).'">View reports</a>';
                    }
                  })->addColumn('print', function($call) {
                        return '<a class="btn btn-success" href="'.url('printReport/'.$call->id).'">Print report</a>';
                      })
                      ->addColumn('Delete', function($call) {
                      return '<a class="btn btn-success" href="'.url('call/delete/'.$call->id).'" data-confirm="Are you sure to delete this item?">Delete</a>';
                       })

                  ->rawColumns(['machineInformation','add','view','print','complete','Delete']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Call $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Call $call)
    {
      $call = Call::with('machineInformation');
        return $call->newQuery($call);
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
                    ->orderBy(0)
                    //  ->buttons(
                    //      Button::make('pageLength'),
                    //      Button::make('export'),
                    //      Button::make('print'),
                    //      Button::make('reset'),
                      //    Button::make('reload')
                    //  )
                      ->parameters([
                  'lengthMenu' => [ 5, 10, 25, 75, 100 ],
                  'order'   => [[0, 'desc']],
                  'buttons' => ['pageLength','reset'],
                  "scrollX"=> true,
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
            Column::make('created_at'),
            Column::make('call_time'),
            Column::computed('machineName')
                  ->name('machineInformation.name')
                  ->exportable(true)
                  ->printable(true)
                  ->searchable(true)
                  ->addClass('text-center'),
                  Column::computed('machineSerial')
                        ->name('machineInformation.machine_serial')
                        ->exportable(true)
                        ->printable(true)
                        ->searchable(true)
                        ->addClass('text-center'),
                  Column::computed('complete')
                          ->exportable(false)
                          ->printable(false)
                          ->searchable(false)
                          ->addClass('text-center'),
            Column::computed('view')
                  ->exportable(false)
                  ->printable(false)
                  ->searchable(false)
                  ->addClass('text-center'),
            Column::computed('add')
                  ->exportable(false)
                  ->searchable(false)
                  ->printable(false)
                  ->addClass('text-center'),
            Column::computed('print')
                  ->exportable(false)
                  ->searchable(false)
                  ->printable(false)
                  ->addClass('text-center'),
            Column::computed('Delete')
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
        return 'Call_' . date('YmdHis');
    }
}
