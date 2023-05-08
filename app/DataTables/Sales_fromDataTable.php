<?php

namespace App\DataTables;

use App\Sales_from;
use Illuminate\Support\Carbon;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;

class Sales_fromDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($sales)
    {
        return datatables()
            ->of($sales)
            ->addColumn('id', function($sales) {
                 return  $sales->id;
                 })
                 ->addColumn('invoice_number', function($sales) {
                      return  $sales->sale->invoice_number;
                      })
                      ->addColumn('Date', function($sales) {
                           return $sales->sale->date;
                           })
      //        ->editColumn('Month', function($sales) {
            //       return date("m", strtotime($sales->sale->date));
    //        return Carbon::parse($sales->sale->date)->format('m');
    //               })
                   ->addColumn('Company', function($sales) {
                        return  $sales->sale->company;
                        })
               ->addColumn('Employe', function($sales) {
                    return  $sales->sale->name_emp;
                    })
           ->addColumn('Sales Man', function($sales) {
              if ($sales->sale->sal){
                return $sales->sale->sal->name;
                     }
             else {
                 return NULL;
                 }
                })
                ->addColumn('Sales Man', function($sales) {
                   if ($sales->sale->sal){
                     return $sales->sale->sal->name;
                   }
                     })
            ->addColumn('Customer Number', function($sales) {
                        return  $sales->sale->cus->number;
                        })
            ->addColumn('Customer Name', function($sales) {
                        return  $sales->sale->cus->name;
                        })
               ->addColumn('Check', function($sales) {
                      return  $sales->sale->check_num;
                        })
                ->addColumn('Part Number', function($sales) {
                        return  $sales->prds->part_num;
                        })
                ->addColumn('Part Number HP', function($sales) {
                        return  $sales->prds->part_num_hp;
                         })
                 ->addColumn('Description', function($sales) {
                       return  $sales->prds->dec->dec;
                         })
                 ->addColumn('brand name', function($sales) {
                        return  $sales->prds->brand->name;
                          })
                 ->addColumn('model number', function($sales) {
                         return  $sales->prds->prdMod->prd_mod;
                          })
                  ->addColumn('Unit price', function($sales) {
                         return  $sales->price;
                          })
                  ->addColumn('Unit Cost', function($sales) {
                         return  $sales->prds->cost ;
                          })
                  ->addColumn('Total Cost with Tax', function($sales) {
                         return  ($sales->prds->cost * $sales->quantity) * app('tax') + ($sales->prds->cost * $sales->quantity);
                          })
                 ->addColumn('Total Price', function($sales) {
                         return  $sales->price * $sales->quantity;
                           })
                 ->addColumn('Unit Tax', function($sales) {
                   if ($sales->sale->tax){
                          return  $sales->price * app('tax');
                  }
                   else{
                     return  0 ;
                   }
                           })
                  ->addColumn('Total price with Tax', function($sales) {
                       if ($sales->sale->tax){
                              return  ($sales->price * $sales->quantity)*app('tax') + $sales->price * $sales->quantity ;
                      }
                       else{
                         return  $sales->price * $sales->quantity ;
                       }
                           })
                  ->addColumn('type', function($sales) {
                          return  $sales->prds->type->prd_type;
                            })
                            ->addColumn('Delete', function($sales) {
                            return '<a class="btn btn-success" href="'.url('sale/delete/'.$sales->id).'">Delete</a>';
                              })
                    ->rawColumns(['Date','Descreption','quantity','Unit price','Employe','type','brand name','model number','Engineer','Part Number HB','Customer','Sales Man','Delete','Unit Cost','Total Cost with Tax']);
          }
    /**
     * Get query source of dataTable.
     *
     * @param \App\Sales_from $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Sales_from $model)
    {
      $sales = Sales_from::with('sale')->with('sale.eng')
      ->with('sale.cus')->with('sale.sal')->with('prds')
      ->with('prds.dec')->with('prds.prdMod')
       ->with('prds.brand')->with('prds.type');

        return $sales->newQuery();
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
                'lengthMenu' => [ 5,2, 10, 25, 75, 100, 500, 700 ],
                'order'   => [[1, 'asc']],
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
                    totalcost = api
                        .column( 14 )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );

                    // Total over this page
                    pageTotalcost = api
                        .column( 14, { page: 'current'} )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );

                    // Total over all pages
                    totalSale = api
                        .column( 18 )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );

                    // Total over this page
                    pageTotalSale = api
                        .column( 18, { page: 'current'} )
                        .data()
                        .reduce( function (a, b) {
                            return intVal(a) + intVal(b);
                        }, 0 );

                    percentage = ((totalSale - totalcost) / totalSale) * 100  ;
                    // Update footer
                     $('.costo').html(
                        ' TotalCost='+ totalcost.toFixed(2) +'<br />TotalSale ='+ totalSale.toFixed(2) +'<br />Profit percentage ='+ percentage.toFixed(2) +'%'
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
          Column::computed('invoice_number')
          ->name('sale.invoice_number')
          ->exportable(true)
          ->printable(true)
          ->addClass('text-center')
          ->searchable(true),
          Column::computed('Date')
          ->name('sale.date')
          ->exportable(true)
          ->printable(true)
          ->addClass('text-center')
          ->searchable(true),
          Column::computed('Company')
          ->name('sale.company')
          ->exportable(true)
          ->printable(true)
          ->addClass('text-center')
          ->searchable(true),
          Column::computed('Employe')
                ->name('sale.name_emp')
                ->exportable(true)
                ->printable(true)
                ->addClass('text-center')
                ->searchable(true),
          Column::computed('Sales Man')
                ->name('sale.sal.name')
                ->exportable(true)
                ->printable(true)
                ->addClass('text-center')
                ->searchable(true),
                Column::computed('Customer Number')
                      ->name('sale.cus.number')
                      ->exportable(true)
                      ->printable(true)
                      ->addClass('text-center')
                      ->searchable(true),
          Column::computed('Customer Name')
                ->name('sale.cus.name')
                ->exportable(true)
                ->printable(true)
                ->addClass('text-center')
                ->searchable(true),
         Column::computed('Part Number')
                      ->name('prds.part_num')
                      ->exportable(true)
                      ->printable(true)
                      ->addClass('text-center')
                      ->searchable(true),
          Column::computed('Part Number HP')
                      ->name('prds.part_num_hp')
                      ->exportable(true)
                      ->printable(true)
                      ->addClass('text-center')
                      ->searchable(true),
          Column::computed('Description')
                      ->name('prds.dec.dec')
                      ->exportable(true)
                      ->printable(true)
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
           Column::computed('Unit Cost')
                   ->name('prds.cost')
                   ->exportable(true)
                   ->printable(true)
                   ->addClass('text-center')
                   ->searchable(true),
           Column::computed('Total Cost with Tax')
                       ->name('prds.cost')
                       ->exportable(true)
                       ->printable(true)
                       ->addClass('text-center')
                       ->searchable(true),
           Column::computed('Unit price')
                       ->name('price')
                       ->exportable(true)
                       ->printable(true)
                       ->addClass('text-center')
                       ->searchable(true),
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
                      ->width(30)
                      ->searchable(true),
                           Column::computed('type')
                             ->name('prds.type.prd_type')
                             ->exportable(true)
                             ->printable(true)
                             ->addClass('text-center')
                             ->searchable(true)
                             ->width(10),
                             Column::computed('Delete')
                             ->exportable(false)
                             ->printable(false)
                             ->addClass('text-center')
                             ->searchable(false)
                             ->width(10),
                      ];
                }

                /**
                 * Get filename for export.
                 *
                 * @return string
                 */
                protected function filename()
                {
                    return 'Sales_from_' . date('YmdHis');
                }
            }
