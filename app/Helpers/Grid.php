<?php
use Illuminate\Pagination\Paginator;
class Grid
{
    private static $dsn;

    public static function runSql($grid)
    {
        $currentPage = $grid['page'];
        Paginator::currentPageResolver(function () use ($currentPage) {
            return $currentPage;
        });

        $sql = $grid['query'];
        $gridFields = (isset($grid['gridFields'])) ? $grid['gridFields'] : '';

        $records = $sql->paginate($grid['perPage'])->setPageName('page');
        $data = [
            'result' => $records->items(),
            'total' => $records->total(),
            'pager' => make_complete_pagination_block($records, 'short'),
            'gridFields' => $gridFields
        ];

        return $data;
    }

    public static function getDSN($dsn_name = 'default', $reBuild = false)
    {
        self::$dsn =  new GridDSN();

        return self::$dsn;
    }

    public static function tokenizeGridFields($fields)
    {
        return "'" . implode ( "', '", array_keys($fields)) . "'";
        return implode(',', array_keys($fields));
    }

    function quote_escape($str) {
       return self::getDSN()->escape($str);
    }
}