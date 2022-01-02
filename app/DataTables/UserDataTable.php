<?php

namespace App\DataTables;

use App\Models\User;
use Form;
use Yajra\Datatables\Services\DataTable;

class UserDataTable extends DataTable
{

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function ajax()
    {
        return $this->datatables
            ->eloquent($this->query())
            ->addColumn('action', 'users.datatables_actions')
            ->make(true);
    }

    /**
     * Get the query object to be processed by datatables.
     *
     * @return \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $users = User::query();

        return $this->applyScopes($users);
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
            'login' => ['name' => 'login', 'data' => 'login'],
            'email' => ['name' => 'email', 'data' => 'email'],
            'actif' => ['name' => 'actif', 'data' => 'actif'],
            'password' => ['name' => 'password', 'data' => 'password'],
            'langue' => ['name' => 'langue', 'data' => 'langue'],
            'remember_token' => ['name' => 'remember_token', 'data' => 'remember_token'],
            'paramettre_id' => ['name' => 'paramettre_id', 'data' => 'paramettre_id'],
            'tel1' => ['name' => 'tel1', 'data' => 'tel1'],
            'tel2' => ['name' => 'tel2', 'data' => 'tel2'],
            'name' => ['name' => 'name', 'data' => 'name'],
            'prenom' => ['name' => 'prenom', 'data' => 'prenom'],
            'sexe' => ['name' => 'sexe', 'data' => 'sexe'],
            'avatar' => ['name' => 'avatar', 'data' => 'avatar'],
            'date_naissance' => ['name' => 'date_naissance', 'data' => 'date_naissance'],
            'pay_id' => ['name' => 'pay_id', 'data' => 'pay_id'],
            'region_id' => ['name' => 'region_id', 'data' => 'region_id'],
            'ville_id' => ['name' => 'ville_id', 'data' => 'ville_id'],
            'addresse_detaille' => ['name' => 'addresse_detaille', 'data' => 'addresse_detaille'],
            'couverture' => ['name' => 'couverture', 'data' => 'couverture'],
            'bp_user' => ['name' => 'bp_user', 'data' => 'bp_user'],
            'ddr' => ['name' => 'ddr', 'data' => 'ddr'],
            'duree_ecoulement' => ['name' => 'duree_ecoulement', 'data' => 'duree_ecoulement'],
            'duree_cycle' => ['name' => 'duree_cycle', 'data' => 'duree_cycle'],
            'heure_notification' => ['name' => 'heure_notification', 'data' => 'heure_notification']
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'users';
    }
}
