<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = ['name', 'created_by', 'active', 'status'];

    /**
     * This is use to get sub admin data
     *
     * @param $params
     * @return array
     */
    public static function getFiles($params)
    {
        $sql = \DB::table('files as f')->select(
            'f.id', 'f.name as file_name', 'u.name as user_name', 'u.email',
            \DB::raw("DATE_FORMAT(f.created_at, '%d %M, %Y') as created_at")
        );
        $sql->join('users as u', 'u.id', 'f.created_by');
        if (!empty($params['search'])) {
            $search = '%' . $params['search'] . '%';
            $sql->where(function ($query) use ($search) {
                $query->Where('f.name', 'LIKE', $search)
                    ->orWhere('u.name', 'LIKE', $search);
            });
        }

        if (!empty($params['sortColumn']) && !empty($params['sortType'])) {
            $sql->orderBy($params['sortColumn'], $params['sortType']);
        }

        $grid = [];
        $grid['query'] = $sql;
        $grid['perPage'] = $params['perPage'];
        $grid['page'] = $params['page'];
        $grid['gridFields'] = self::gridFields();

        return \Grid::runSql($grid);
    }

    /**
     * This is used to return cammp grid fields
     *
     * @return array
     */
    public static function gridFields()
    {
        $arrFields = [
            'file_name' => [
                'name' => 'file_name',
                'isDisplay' => true
            ],
            'user_name' => [
                'name' => 'user_name',
                'isDisplay' => true
            ],
            'created_at' => [
                'name' => 'created_at',
                'isDisplay' => true
            ]
        ];

        return $arrFields;
    }
}
