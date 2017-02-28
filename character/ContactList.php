<?php
/**
 * Created by PhpStorm.
 * User: Denis.Khodakovskiy
 * Date: 01.03.17
 * Time: 0:41
 */

namespace EveXMLAPI\Character;

use EveXMLAPI\Core\Request;
use EveXMLAPI\types\ContactType;

class ContactList extends Request
{
    public $url = '/char/ContactList.xml.aspx';
    public $contactList = [];
    public $corporateContactList = [];
    public $allianceContactList = [];

    public function parse($xml)
    {
        foreach ($xml->rowset as $rowset) {
            switch ($rowset['name']) {
                case 'contactList':
                case 'corporateContactList':
                case 'allianceContactList':
                    foreach ($rowset->row as $contact) {
                        $this->{$rowset['name']}[] = new ContactType([
                            'contactID' => intval($contact['contactID']),
                            'contactName' => strval($contact['contactName']),
                            'standing' => intval($contact['standing']),
                            'contactTypeID' => intval($contact['contactTypeID']),
                            'labelMask' => intval($contact['labelMask']),
                            'inWatchlist' => (strval($rowset['name']) == 'contactList') ?
                                (strval($contact['inWatchlist']) == 'True') : null
                        ]);
                    }
                    break;

                default:
                    break;
            }
        }
    }
}
