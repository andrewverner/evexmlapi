<pre>
<?php
/**
 * Created by PhpStorm.
 * User: dkhodakovskiy
 * Date: 28.02.17
 * Time: 11:55
 */

error_reporting(E_ALL ^ E_STRICT);

spl_autoload_register(function ($className) {
    $className = end(explode('\\', $className));
    if (file_exists("{$className}.php")) {
        require_once "{$className}.php";
    } else {
        foreach (['account', 'character', 'core', 'core/types', 'core/components', 'corporation', 'eve', 'map'] as $dir) {
            if (file_exists("{$dir}/{$className}.php")) {
                require_once "{$dir}/{$className}.php";
                break;
            }
        }
    }
});


$api = new \EveXMLAPI\API();
/*$account = $api->account(3782616,'ZU78sX2nA41yQJZLTiyiFzJTAs71MvoY9jm2DmIU0d7ABrttO9vBpF3Qv1QYElU0');
$t = $account->characters();*/

$character = $api->character(3782616, 'ZU78sX2nA41yQJZLTiyiFzJTAs71MvoY9jm2DmIU0d7ABrttO9vBpF3Qv1QYElU0', 656916134);
//print_r($character->assets(new LocationSorter()));
//print_r($character->blueprints(new LocationSorter()));
//print_r($character->bookmarks(new LocationSorter()));
//print_r($character->sheet());
//print_r($character->chats());
//print_r($character->contacts());
//print_r($character->contracts());
//print_r($character->facWarStats());
//print_r($character->industryJobs());
//print_r($character->industryJobsHistory());
//print_r($character->killMails(50));
print_r($character->locations());