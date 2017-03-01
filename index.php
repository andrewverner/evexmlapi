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
            }
        }
    }
});


$api = new \EveXMLAPI\API();
$account = $api->account(3787235,'KAcD1yK2wrH5UjZ3EtnNtMutyjAKcHgSecfmR9hISQcW7gGoHL9j8g01sBBtcDuN');
//print_r($account->characters());

$character = $api->character(3782616, 'ZU78sX2nA41yQJZLTiyiFzJTAs71MvoY9jm2DmIU0d7ABrttO9vBpF3Qv1QYElU0', 523375194);
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
//print_r($character->locations());
//print_r($character->mails());
//print_r($character->marketOrders());
//print_r($character->medals());
//print_r($character->notifications());
//print_r($character->planetaryColonies());
//print_r($character->research());
//print_r($character->skillInTraining());
//print_r($character->skillQueue());
//print_r($character->skills());
//print_r($character->standings());
//print_r($character->walletJournal());
//print_r($character->walletTransactions());

$corporation = $api->corporation(6038178, '2OoSzgLgyniSeXwLQbkdi3V6z8SCv6gdbuswZhKCTlhlpRKnkTD0Gwq55lirc9Nr', 98482170);
//print_r($corporation->balance(523375194));
//print_r($corporation->assets(new LocationSorter()));
//print_r($corporation->blueprints(new LocationSorter()));
//print_r($corporation->bookmarks(new LocationSorter()));
//print_r($corporation->contacts());
//print_r($corporation->containerLog());
