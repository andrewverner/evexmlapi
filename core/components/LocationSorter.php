<?php
/**
 * Created by PhpStorm.
 * User: dkhodakovskiy
 * Date: 28.02.17
 * Time: 16:24
 */

class LocationSorter implements Sorter
{
    public function sort(array $items)
    {
        $data = [];

        /**
         * @var $asset AssetType
         */
        foreach ($items as $item) {
            if (!isset($data[$item->locationID])) $data[$item->locationID] = [];
            $data[$item->locationID][] = $item;
        }

        return $data;
    }
}
