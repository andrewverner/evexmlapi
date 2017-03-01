<?php
/**
 * Created by PhpStorm.
 * User: Denis.Khodakovskiy
 * Date: 01.03.17
 * Time: 0:41
 */

namespace EveXMLAPI\Corporation;

use EveXMLAPI\Core\Request;
use EveXMLAPI\types\ContactType;

class ContactList extends Request
{
    public $url = '/corp/ContactList.xml.aspx';
    public $corporateContactList = [];
    public $allianceContactList = [];

    public function parse($xml)
    {
        foreach ($xml->rowset as $rowset) {
            switch ($rowset['name']) {
                case 'corporateContactList':
                case 'allianceContactList':
                    foreach ($rowset->row as $contact) {
                        $this->{$rowset['name']}[] = new ContactType(
                            $contact,
                            [
                                'contactID, standing, contactTypeID, labelMask' => 'int',
                                'contactName' => 'str',
                            ]
                        );
                    }
                    break;

                default:
                    break;
            }
        }
    }
}
