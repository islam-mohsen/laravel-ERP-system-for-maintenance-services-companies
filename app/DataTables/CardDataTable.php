<?php

namespace App\DataTables;

use App\Card;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;

class CardDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($card)
    {
        return datatables()
            ->of($card)
            ->addColumn('Part Number', function($card) {
                 return  $card->prds->part_num;
                 })
                 ->addColumn('Part Number hp', function($card) {
                      return  $card->prds->part_num_hp;
                      })
                         ->addColumn('In', function($card) {
                                return  $card->come;
                                })
                                ->addColumn('Out', function($card) {
                                     return  $card->leave;
                                     })
                                     ->addColumn('Balance', function($card) {
                                          return  $card->count_of ;
                                          })

            ->rawColumns(['Part Number hp','Part Number','Price','In','Out','Balance']);

    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Card $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Card $model)
    {
      $card = Card::with('prds');
        return $card->newQuery();
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
                    ->orderBy(2)
                    //  ->buttons(
                    //      Button::make('pageLength'),
                    //      Button::make('export'),
                    //      Button::make('print'),
                    //      Button::make('reset'),
                      //    Button::make('reload')
                    //  )
                      ->parameters([
                  'lengthMenu' => [ 5,2, 10, 25, 75, 100 ],
                  'order'   => [[2, 'desc']],
                  'buttons' => ['pageLength','reset'],
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
              Column::make('id'),
               Column::computed('Part Number')
                 ->name('prds.part_num')
                 ->exportable(true)
                 ->printable(true)
                 ->addClass('text-center')
                 ->searchable(true),
              Column::computed('Part Number hp')
                  ->name('prds.part_num_hp')
                  ->exportable(true)
                  ->printable(true)
                  ->addClass('text-center')
                  ->searchable(true),
            Column::make('price'),
            Column::computed('In'),
            Column::computed('Out'),
            Column::computed('Balance'),
            Column::make('customer'),
            Column::make('supplier'),
            Column::make('date'),

        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Card_' . date('YmdHis');
    }
}
