<?php

namespace App\DataTables;

use App\Room_of_prd;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;

class Room_of_prdDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($store)
    {
        return datatables()
            ->of($store)
            ->addColumn('part number', function($store) {
                  return  $store->prds->part_num;
                })
                ->addColumn('part number Hb', function($store) {
                      return  $store->prds->part_num_hp;
                    })
                ->addColumn('Descreption', function($store) {
                      return  $store->prds->dec->dec;
                    })
                      ->addColumn('quantity', function($store) {
                          return  $store->quantity;
                            })
                          ->addColumn('Unit price', function($store) {
                              return  $store->prds->cost;
                              })
                              ->addColumn('Total Price', function($store) {
                                  return  $store->prds->cost * $store->quantity;
                                  })
                                  ->addColumn('Unit price with Tax', function($store) {
                                      return  $store->prds->cost * app('tax')+$store->prds->cost;
                                      })
                                      ->addColumn('Total price with Tax', function($store) {
                                          return  $store->quantity * ($store->prds->cost * app('tax')+$store->prds->cost);
                                          })
                              ->addColumn('room', function($store) {
                                    return  $store->room->name_room;
                                  })
                                  ->addColumn('type', function($store) {
                                        return  $store->prds->type->prd_type;
                                      })
                                      ->addColumn('brand name', function($store) {
                                            return  $store->prds->brand->name;
                                          })
                        ->addColumn('model number', function($store) {
                            return  $store->prds->prdMod->prd_mod;
                              })
                          ->addColumn('Update', function($store) {
                                  return '<a class="btn btn-success" href="'.url('updateProduct/'.$store->prds->id).'">Update</a>';
                                })
                ->rawColumns(['Update']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Room_of_prd $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Room_of_prd $model)
    {
  $store = Room_of_prd::with('prds')->with('prds.dec')->with('prds.prdMod')->with('prds.brand')->with('prds.brand')->with('prds.type')->with('room');
        return $store->newQuery();
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
                  'order'   => [[1, 'desc']],
                  'buttons' => ['pageLength','reset','reload'],
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
                  'footerCallback' => "function ( row, data, start, end, display ) {
                      var api = this.api(), data;

                      // Remove the formatting to get integer data for summation
                      var intVal = function ( i ) {
                          return typeof i === 'string' ?
                              i.replace(/[\$,]/g, '')*1 :
                              typeof i === 'number' ?
                                  i : 0;
                      };
                      // Total over all pages
                      totalSale = api
                          .column( 10 )
                          .data()
                          .reduce( function (a, b) {
                              return intVal(a) + intVal(b);
                          }, 0 );

                      // Total over this page
                      pageTotalSale = api
                          .column( 10, { page: 'current'} )
                          .data()
                          .reduce( function (a, b) {
                              return intVal(a) + intVal(b);
                          }, 0 );
                      // Update footer
                           $('.costo').html(
                              'Tota purchases ='+ totalSale.toFixed(2) +''
                          );
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
            Column::computed('part number')
            ->name('prds.part_num')
            ->exportable(true)
            ->printable(true)
          //  ->width(60)
            ->addClass('text-center')
            ->searchable(true),
            Column::computed('part number Hb')
            ->name('prds.part_num_hp')
            ->exportable(true)
            ->printable(true)
            ->addClass('text-center')
            ->searchable(true),
            Column::computed('Descreption')
                  ->name('prds.dec.dec')
                  ->exportable(true)
                  ->printable(true)
                  ->addClass('text-center')
                  ->searchable(true),
           Column::computed('brand name')
                  ->name('prds.brand.name')
                  ->exportable(true)
                  ->printable(true)
                  ->addClass('text-center')
                  ->searchable(true),
           Column::computed('model number')
                  ->name('prds.prdMod.prd_mod')
                  ->exportable(true)
                  ->printable(true)
                  ->addClass('text-center')
                  ->searchable(true),
            Column::computed('quantity')
                    ->exportable(true)
                    ->printable(true)
                    ->addClass('text-center')
                    ->searchable(true),
              Column::computed('Unit price')
                        ->name('prds.cost')
                        ->exportable(true)
                        ->printable(true)
                        ->addClass('text-center')
                        ->searchable(true),
                        Column::computed('Total Price')
                          ->name('prds.cost')
                          ->exportable(true)
                          ->printable(true)
                          ->addClass('text-center')
                          ->searchable(true),
                       Column::computed('Unit price with Tax')
                            ->name('prds.cost')
                            ->exportable(true)
                            ->printable(true)
                            ->addClass('text-center')
                            ->searchable(true),
                        Column::computed('Total price with Tax')
                             ->name('prds.cost')
                             ->exportable(true)
                             ->printable(true)
                             ->addClass('text-center')
                             ->searchable(true),
                      Column::computed('type')
                        ->name('prds.type.prd_type')
                        ->exportable(true)
                        ->printable(true)
                        ->addClass('text-center')
                        ->searchable(true),
                        Column::computed('room')
                          ->name('room.name_room')
                          ->exportable(true)
                          ->printable(true)
                          ->addClass('text-center')
                          ->searchable(true),
                          Column::computed('Update')
                            ->exportable(false)
                            ->printable(false)
                            ->addClass('text-center')
                            ->searchable(false),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Room_of_prd_' . date('YmdHis');
    }
}
