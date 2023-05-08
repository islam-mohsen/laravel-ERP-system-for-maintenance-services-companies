<?php

namespace App\DataTables;

use App\BuyItem;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;

class BuyItemDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($buy)
    {
      return datatables()
          ->of($buy)
          ->addColumn('Date', function($buy) {
                return  $buy->buy_product->date;
              })
              ->addColumn('invoice_number', function($buy) {
                    return  $buy->buy_product->invoice_number;
                    })
            ->addColumn('Employe', function($buy) {
                  return  $buy->buy_product->name_emp;
                  })
              ->addColumn('Supplier Number', function($buy) {
                    return  $buy->buy_product->supplier->number;
                      })
                      ->addColumn('Supplier Name', function($buy) {
                            return  $buy->buy_product->supplier->name;
                              })
                  ->addColumn('Part Number', function($buy) {
                              return  $buy->product->part_num;
                                })
                     ->addColumn('Part Number HB', function($buy) {
                                 return  $buy->product->part_num_hp;
                                   })
                         ->addColumn('Discreption', function($buy) {
                               return  $buy->product->dec->dec;
                                    })
                       ->addColumn('brand name', function($buy) {
                          return  $buy->product->brand->name;
                                })
                         ->addColumn('model number', function($buy) {
                          return  $buy->product->prdMod->prd_mod;
                            })
                            ->addColumn('Unit price', function($buy) {
                             return  $buy->price;
                               })
                              ->addColumn('Total Price', function($buy) {
                                 return  $buy->price * $buy->quantity;
                                           })
                                  ->addColumn('Unit Tax', function($buy) {
                                        if ($buy->buy_product->tax){
                                          return  $buy->price * app('tax');
                                       }
                                        else{
                                          return  0 ;
                                        }
                                                })
                                      ->addColumn('Total price with Tax', function($buy) {
                                          if ($buy->buy_product->tax){
                                            return  ($buy->price * $buy->quantity)*app('tax') + $buy->price * $buy->quantity ;
                                         }
                                          else{
                                            return  $buy->price * $buy->quantity ;
                                          }
                                                })
                                                ->addColumn('type', function($buy) {
                                                      return  $buy->product->type->prd_type;
                                                        })
                                                        ->addColumn('Delete', function($buy) {
                                                                return '<a class="btn btn-success" href="'.url('buy/delete/'.$buy->id).'">Delete</a>';
                                                                  })
          ->rawColumns(['Date','Descreption','quantity','Unit price','cost','Employe','type','brand name','model number','Supplier','Part Number HB','Delete']);
  }

    /**
     * Get query source of dataTable.
     *
     * @param \App\BuyItem $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(BuyItem $model)
    {
      $buy = BuyItem::with('buy_product')->with('product')->with('product.dec')->with('product.prdMod')->with('product.brand')->with('product.brand')->with('product.type')
      ->with('buy_product.supplier');

        return $buy->newQuery();
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
                        .column( 15 )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );

                    // Total over this page
                    pageTotalSale = api
                        .column( 15, { page: 'current'} )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );
                    // Update footer
                         $('.costo').html(
                            'Tota purchases ='+ totalSale.toFixed(2) +''
                        );
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
            Column::computed('Date')
            ->name('buy_product.date')
            ->exportable(true)
            ->printable(true)
          //  ->width(60)
            ->addClass('text-center')
            ->searchable(true),
            Column::computed('invoice_number')
                  ->name('buy_product.invoice_number')
                  ->exportable(true)
                  ->printable(true)
                  ->addClass('text-center')
                  ->searchable(true),
            Column::computed('Employe')
                  ->name('buy_product.name_emp')
                  ->exportable(true)
                  ->printable(true)
                  ->addClass('text-center')
                  ->searchable(true),
            Column::computed('Supplier Number')
                  ->name('buy_product.supplier.number')
                  ->exportable(true)
                  ->printable(true)
                  ->addClass('text-center')
                  ->searchable(true),
                  Column::computed('Supplier Name')
                        ->name('buy_product.supplier.name')
                        ->exportable(true)
                        ->printable(true)
                        ->addClass('text-center')
                        ->searchable(true),
                  Column::computed('Part Number')
                               ->name('product.part_num')
                               ->exportable(true)
                               ->printable(true)
                               ->addClass('text-center')
                               ->searchable(true),
                   Column::computed('Part Number HB')
                               ->name('product.part_num_hp')
                               ->exportable(true)
                               ->printable(true)
                               ->addClass('text-center')
                               ->searchable(true),
                   Column::computed('Discreption')
                               ->name('product.dec.dec')
                               ->exportable(true)
                               ->printable(true)
                               ->addClass('text-center')
                               ->searchable(true),
                   Column::computed('brand name')
                               ->name('product.brand.name')
                               ->exportable(true)
                               ->printable(true)
                               ->addClass('text-center')
                               ->searchable(true),
                   Column::computed('model number')
                               ->name('product.prdMod.prd_mod')
                               ->exportable(true)
                               ->printable(true)
                               ->addClass('text-center')
                               ->searchable(true),
                   Column::make('quantity'),
                   Column::computed('Unit price')
                   ->name('cost'),
                            Column::computed('Total Price')
                                ->exportable(true)
                                ->printable(true)
                                ->addClass('text-center')
                                ->searchable(true),
                           Column::computed('Unit Tax')
                               ->exportable(true)
                               ->printable(true)
                               ->addClass('text-center')
                               ->searchable(true),
                            Column::computed('Total price with Tax')
                               ->exportable(true)
                               ->printable(true)
                               ->addClass('text-center')
                               ->searchable(true),
                               Column::computed('type')
                               ->name('product.type.prd_type')
                               ->exportable(true)
                               ->printable(true)
                               ->addClass('text-center')
                               ->searchable(true),
                               Column::computed('Delete')
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
               return 'BuyItem_' . date('YmdHis');
           }
       }
