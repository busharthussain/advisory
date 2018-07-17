<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','sur_name', 'title', 'email', 'password', 'parent_id','type','mobile_number', 'city',
        'image', 'relative_path'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * This is use to get sub admin data
     *
     * @param $params
     * @return array
     */
    public static function getUsers($params)
    {
        $sql = \DB::table('users as u')->where('type', '=', 'user')->select('u.id', 'u.name', 'u.email', 'title', 'mobile_number', 'image', 'u.sur_name');
        if (!empty($params['companyId'])) {
            $sql->where('parent_id', '=', $params['companyId']);
        }

        if (!empty($params['search'])) {
            $search = '%' . $params['search'] . '%';
            $sql->where(function ($query) use ($search) {
                $query->Where('u.name', 'LIKE', $search)
                    ->orWhere('u.email', 'LIKE', $search);
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
            'image' => [
                'name' => 'image',
                'isDisplay' => true,
                'custom' => [
                    'width' => '7%',
                    'image' => true,
                    'imageURL' => asset(userThumbnailFile)
                ]
            ],
            'name' => [
                'name' => 'name',
                'isDisplay' => true,
                'custom' => [
                    'isAnchor' => true,
                    'url' => \URL::route('user.edit')
                ]
            ],
            'title' => [
                'name' => 'title',
                'isDisplay' => true
            ],
            'mobile_number' => [
                'name' => 'mobile_number',
                'isDisplay' => true
            ],
            'email' => [
                'name' => 'email',
                'isDisplay' => true
            ]
        ];

        return $arrFields;
    }

}
