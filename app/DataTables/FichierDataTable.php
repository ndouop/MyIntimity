<?php

namespace App\DataTables;

use App\Models\Fichier;
use Form;
use Yajra\Datatables\Services\DataTable;

class FichierDataTable extends DataTable
{

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->addColumn('action', 'fichiers.datatables_actions')
            ->make(true);
    }

    /**
     * Get the query object to be processed by datatables.
     *
     * @return \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $fichiers = Fichier::query();

        return $this->applyScopes($fichiers);
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
            'sujet_id' => ['name' => 'sujet_id', 'data' => 'sujet_id'],
            'reponse_id' => ['name' => 'reponse_id', 'data' => 'reponse_id'],
            'fichier' => ['name' => 'fichier', 'data' => 'fichier'],
            'actif' => ['name' => 'actif', 'data' => 'actif'],
            'user_id' => ['name' => 'user_id', 'data' => 'user_id'],
            'type_f' => ['name' => 'type_f', 'data' => 'type_f'],
            'taille' => ['name' => 'taille', 'data' => 'taille']
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'fichiers';
    }
}
