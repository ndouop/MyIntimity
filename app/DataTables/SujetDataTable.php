<?php

namespace App\DataTables;

use App\Models\Sujet;
use Form;
use Yajra\Datatables\Services\DataTable;

class SujetDataTable extends DataTable
{

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->addColumn('action', 'sujets.datatables_actions')
            ->make(true);
    }

    /**
     * Get the query object to be processed by datatables.
     *
     * @return \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $sujets = Sujet::query();

        return $this->applyScopes($sujets);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\Datatables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->addAction(['width' => '10%'])
            ->ajax('')
            ->parameters([
                'dom' => 'Bfrtip',
                'scrollX' => false,
                'buttons' => [
                    'print',
                    'reset',
                    'reload',
                    [
                         'extend'  => 'collection',
                         'text'    => '<i class="fa fa-download"></i> Export',
                         'buttons' => [
                             'csv',
                             'excel',
                             'pdf',
                         ],
                    ],
                    'colvis'
                ]
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    private function getColumns()
    {
        return [
            'age_debut' => ['name' => 'age_debut', 'data' => 'age_debut'],
            'age_fin' => ['name' => 'age_fin', 'data' => 'age_fin'],
            'anonyme' => ['name' => 'anonyme', 'data' => 'anonyme'],
            'categorie_id' => ['name' => 'categorie_id', 'data' => 'categorie_id'],
            'user_id' => ['name' => 'user_id', 'data' => 'user_id'],
            'description' => ['name' => 'description', 'data' => 'description'],
            'actif' => ['name' => 'actif', 'data' => 'actif'],
            'nblike' => ['name' => 'nblike', 'data' => 'nblike'],
            'nbcoment' => ['name' => 'nbcoment', 'data' => 'nbcoment']
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'sujets';
    }
}
