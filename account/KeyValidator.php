<?php

namespace EveXMLAPI\Account;

use EveXMLAPI\Core\Key;
use EveXMLAPI\Core\Request;
use EveXMLAPI\Types\Call;

class KeyValidator extends Request
{
    public $url = '/api/CallList.xml.aspx';
    public $list;
    private $keyInfo;

    public function __construct(Key $key, APIKeyInfo $keyInfo)
    {
        $this->keyInfo = $keyInfo;
        parent::__construct($key);
    }

    public function parse($xml)
    {
        foreach ($xml->rowset as $rowset) {
            if ($rowset['name'] == 'calls') {
                $this->list = [];
                foreach ($rowset->row as $call) {
                    if (strval($call['type']) == 'Character') {
                        $this->list[] = new Call(
                            $call,
                            [
                                'accessMask, groupID' => 'int',
                                'name, type, description' => 'str'
                            ],
                            $this->keyInfo->accessMask
                        );
                    }
                }
            }
        }
    }
}
