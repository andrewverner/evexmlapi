<?php
/**
 * Created by PhpStorm.
 * User: dkhodakovskiy
 * Date: 28.02.17
 * Time: 12:11
 */

namespace EveXMLAPI\Character;

use EveXMLAPI\Core\Key;

/**
 * Class Character
 * @package EveXMLAPI\Character
 *
 * @method balance()
 * @method assets(\Sorter $sorter = null)
 * @method blueprints(\Sorter $sorter = null)
 * @method bookmarks(\Sorter $sorter = null)
 * @method sheet()
 * @method chats()
 * @method contacts()
 * @method contracts()
 * @method facWarStats()
 * @method industryJobs()
 * @method industryJobsHistory()
 */

class Character
{
    private $key;

    public $name;
    public $corporationName;
    public $corporationID;
    public $allianceName;
    public $allianceID;
    public $factionName;
    public $factionID;

    public function __construct(Key $key, $characterID, array $data = [])
    {
        $this->key = new CharacterKey($key->keyID, $key->vCode, $characterID);
        if (!empty($data)) {
            foreach ($data as $key => $value) {
                $this->{$key} = $value;
            }
        }
    }

    public function __call($name, $arguments)
    {
        switch ($name) {
            case 'balance':
                return new AccountBalance($this->key);
                break;

            case 'assets':
                return (new AssetList($this->key, isset($arguments[0]) ? $arguments[0] : null))->list;
                break;

            case 'blueprints':
                return (new Blueprints($this->key, isset($arguments[0]) ? $arguments[0] : null))->list;
                break;

            case 'bookmarks':
                return (new Bookmarks($this->key, isset($arguments[0]) ? $arguments[0] : null))->list;
                break;

            case 'sheet':
                return new Sheet($this->key);
                break;

            case 'chats':
                return new ChatChannels($this->key);
                break;

            case 'contacts':
                return new ContactList($this->key);
                break;

            case 'contracts':
                return (new Contracts($this->key))->contracts;
                break;

            case 'facWarStats':
                return new FacWarStats($this->key);
                break;

            case 'industryJobs':
                return (new IndustryJobs($this->key))->list;
                break;

            case 'industryJobsHistory':
                return (new IndustryJobsHistory($this->key))->list;
                break;

            default:
                break;
        }
    }
}
