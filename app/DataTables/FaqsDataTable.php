<?php

namespace App\DataTables;

use Yajra\DataTables\Services\DataTable;
use App\Models\Faq;

class FaqsDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function ($user) {
                // Add custom action buttons if needed
            });
    }

    public function query(Faq $model)
    {
        return $model->newQuery();
    }

    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->parameters([
                'responsive' => true,
                'dom' => 'Bfrtip',
                'buttons' => ['export', 'print'],
            ])->minifiedAjax()
            ->drawCallbackWithLivewire();
    }

    protected function getColumns()
    {
        return [
            'id',
            'question',
            'status',
            'created_at',
            'action',
            // Add more columns as needed
        ];
    }
}
