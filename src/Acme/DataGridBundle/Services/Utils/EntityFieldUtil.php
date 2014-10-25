<?php

namespace Acme\DataGridBundle\Services\Utils;


class EntityFieldUtil {

    public static function getFieldName($fieldName)
    {
        return preg_replace("/[\\_\\*\\-]/", "", $fieldName);

    }

    public static function getEntityGetterName($fieldName)
    {
        $fName = self::getFieldName($fieldName);
        return 'get' . ucfirst($fName);

    }
} 