<?php

namespace EveXMLAPI\Types;

class Call extends Type
{
    private $keyMask;

    public $accessMask;
    public $type;
    public $name;
    public $groupID;
    public $description;
    public $available;

    public function __construct($data, array $behaviour = [], $keyMask = null)
    {
        $this->keyMask = $keyMask;
        parent::__construct($data, $behaviour);

        if ($keyMask) {
            $this->available = (bool)($keyMask & $this->accessMask);
        }
    }
}
