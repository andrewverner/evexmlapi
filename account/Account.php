<?php

/**
 * Created by PhpStorm.
 * User: dkhodakovskiy
 * Date: 28.02.17
 * Time: 12:04
  */

namespace EveXMLAPI\Account;

use EveXMLAPI\Core\Key;

/**
 * Class Account
 * @package EveXMLAPI\Account
 *
 * @method status()
 * @method keyInfo()
 * @method keyCalls()
 * @method characters()
 */

class Account
{
    private $key;

    public function __construct($keyID, $vCode)
    {
        $this->key = new Key($keyID, $vCode);
    }

    public function __call($name, $arguments)
    {
        switch ($name) {
            case 'status':
                return new AccountStatus($this->key);
                break;

            case 'keyInfo':
                return new APIKeyInfo($this->key);
                break;

            case 'keyCalls':
                return (new KeyValidator($this->key, new APIKeyInfo($this->key)))->list;
                break;

            case 'characters':
                return (new Characters($this->key))->characters;
                break;

            default:
                return null;
                break;
        }
    }

}
