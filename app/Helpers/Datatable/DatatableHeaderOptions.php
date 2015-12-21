<?php

namespace App\Helpers\Datatable;

use App\Database\Queries;
use App\Helpers\Datatable\Filter\Select;
use App\Helpers\Formatters\String;
use Closure;
use UnexpectedValueException;

class DatatableHeaderOptions {

    public static function build($columnName, $overrides, $defaultProperties) {
        $default = [
            'align'  => 'left',
            'label'  => String::labelize($columnName),
            'width'  => null,
            'order'  => $defaultProperties['order'],
            'filter' => $defaultProperties['filter'],
            'name'   => $columnName
        ];

        if (isset($overrides['filter_select'])) {
            $overrides['filter_select'] = self::getSelectFilterList($overrides['filter_select']);
        }

        return array_merge($default, $overrides);
    }

    public static function fill($columns, $columnsOverrides, $defaultProperties) {
        $normalizedColumns = [];

        foreach ($columns as $numColumn => $columnName) {
            if (isset($columnsOverrides[$columnName])) {
                $normalizedColumns[] = self::build($columnName, $columnsOverrides[$columnName], $defaultProperties);
                continue;
            }

            $normalizedColumns[] = self::build($columnName, [], $defaultProperties);
        }

        return $normalizedColumns;
    }

    public static function getSelectFilterList($filter) {
        if ($filter instanceof Select) {
            return Queries::getTableSelect($filter->getTable(), $filter->getKeyColumn(), $filter->getDescriptionColumn());

        } else if ($filter instanceof Closure) {
            return $filter();

        } else if (is_array($filter)) {
            return $filter;
        }

        throw new UnexpectedValueException("Select filter not formatted correctly.");
    }

}