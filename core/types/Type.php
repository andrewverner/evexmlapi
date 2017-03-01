<?php
/**
 * Created by PhpStorm.
 * User: dkhodakovskiy
 * Date: 28.02.17
 * Time: 16:00
 */

namespace EveXMLAPI\Types;

class Type
{
    public function __construct($data, $behaviour = [])
    {
        $behaviour = $this->parseBehaviour($behaviour);
        if (!empty($data)) {
            foreach (current($data) as $key => $value) {
                $this->{$key} = (!empty($behaviour) && isset($behaviour[$key])) ?
                    $this->format($value, $behaviour[$key]) : $value;
            }
        }
    }

    private function format($value, $filter)
    {
        switch ($filter) {
            case 'date':
                return new \DateTime($value);
                break;

            case 'int':
                return intval($value);
                break;

            case 'float':
                return floatval($value);
                break;

            case 'str':
                return strval($value);
                break;

            case 'bool':
                return (strval($value) == 'True' || intval($value) == 1);
                break;

            default:
                return false;
                break;
        }
    }

    private function parseBehaviour($behaviour)
    {
        $data = [];

        if (!empty($behaviour)) {
            foreach ($behaviour as $params => $rule) {
                $data = array_merge($data, array_combine(
                    explode(', ', $params),
                    array_fill(0, substr_count($params, ',') + 1, $rule)
                ));
            }
        }

        return $data;
    }
}
