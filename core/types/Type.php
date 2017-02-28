<?php
/**
 * Created by PhpStorm.
 * User: dkhodakovskiy
 * Date: 28.02.17
 * Time: 16:00
 */

class Type
{
    public function __construct(array $data = [], $behaviour = [])
    {
        if (!empty($data)) {
            foreach ($data as $key => $value) {
                $this->{$key} = (!empty($behaviour) && isset($behaviour[$key])) ?
                    $this->format($value, $behaviour[$key]) : $value;
            }
        }
    }

    private function format($value, $filter)
    {
        switch ($filter) {
            case 'date':
                return new DateTime($value);
                break;

            default:
                return false;
                break;
        }
    }
}
