<?php

/**
 * Created by PhpStorm.
 * User: Denis.Khodakovskiy
 * Date: 01.03.17
 * Time: 23:25
 */

namespace EveXMLAPI\Corporation;

/**
 * Class Corporation
 * @package EveXMLAPI\Corporation
 *
 * @method balance($characterID)
 * @method assets(\Sorter $sorter = null)
 * @method blueprints(\Sorter $sorter = null)
 * @method bookmarks(\Sorter $sorter = null)
 * @method contacts()
 * @method containerLog()
 */
class Corporation
{
    private $key;

    public function __construct(CorporationKey $key)
    {
        $this->key = $key;
    }

    public function __call($name, $arguments)
    {
        switch ($name) {
            case 'balance':
                return (new AccountBalance($this->key, $arguments[0]))->list;
                break;

            case 'assets':
                return (new AssetList($this->key, $arguments[0]))->list;
                break;

            case 'blueprints':
                return (new Blueprints($this->key, $arguments[0]))->list;
                break;

            case 'bookmarks':
                return (new Bookmarks($this->key, $arguments[0]))->list;
                break;

            case 'contacts':
                return new ContactList($this->key);
                break;

            case 'containerLog':
                return (new ContainerLog($this->key))->list;
                break;

            default:
                return false;
                break;
        }
    }
}
