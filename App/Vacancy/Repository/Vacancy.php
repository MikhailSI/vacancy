<?php
namespace App\Vacancy\Repository;

use Base\Repository;

class Vacancy extends Repository
{
    public function table()
    {
        return "vacancies";
    }

    public function advTable()
    {
        return "vacancies_languages";
    }

    public function model()
    {
        return "\\App\\Vacancy\\Model\\Vacancy";
    }

    /**
     * @param bool $department
     * @param bool $language
     * @param bool $toArray
     * @return \App\Vacancy\Model\Vacancy[]
     */
    public function getFilter($department = false, $language = false, $toArray = false)
    {
        $where = [];
        $params = [];
        $join = '';
        $select = ['t.`id`', 't.`name`', 't.`desc`', 't.`dept_id`', "'en' AS `lang`"];

        if ((int) $department) {
            $where[] = "dept_id = :department";
            $params['department'] = $department;
        }

        if ((int) $language) {
            $select[1] = "IF(t_j.`name` != '', t_j.`name`, t.`name`) AS `name`";
            $select[2] = "IF(t_j.`desc` != '', t_j.`desc`, t.`desc`) AS `desc`";
            $select[4] = "IF(t_j.`lang` != '', t_j.`lang`, 'en') AS `lang`";
            $join = "LEFT JOIN " . $this->advTable() . " AS t_j ON t_j.`vid` = t.`id` AND t_j.`lang` = :language";
            $params['language'] = $language;
        }

        $where = count($where) ? " WHERE " . implode(" AND ", $where) : "";
        $query = "SELECT " . implode(', ', $select) . " FROM " . static::table() . " AS t " . $join . $where;
        $qResult = $this->prepareExecute($query, $params);
        $result = [];

        foreach ($qResult as $params) {
            $model = $this->newModel($params);
            $result[] = $toArray ? $model->toArray() : $model;
        }

        return $result;
    }
}