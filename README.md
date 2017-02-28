#EVE Online XML API

##HIW?

Create an API-object `$api = new \EveXMLAPI\API();`

Now you have to define key identifier and verification code (you can find or create it here -
[EVE Online API key manager](https://api.eveonline.com/))
 
###Account

Create an account object
`$account = $api->account($keyID, $vCode);`

Example: `$account = $api->account(5421517,'H8dHemz5P1yQJZLTiyiFzJTAs71MvoY9jm2DmIU0d7ABrttO9vBpF3Qv5Drf4N0');`

####Account::status(): AccountStatus

`$status = $account->status();`

Returns an information about user account:

| variable  | description | type | usage |
| --- | --- | --- | --- |
| paidUntil | Paid until date | DateTime | `$status->paidUntil->format('Y-m-d H:i:s')` |
| createDate | Account create date | DateTime | `$status->paidUntil->format('Y-m-d H:i:s')` |
| logonCount | Logon count | Integer | `$status->logonCount` |
| logonMinutes | Logon minutes | Integer | `$status->logonCount` |

####Account::keyInfo(): APIKeyInfo

`$info = $account->keyInfo();`

Returns an information about API key:

| variable  | description | type | usage |
| --- | --- | --- | --- |
| accessMask | Access mask of the key | Integer | `$info->assessMask` |
| expires | Expiration date | DateTime | `$info->expires->format('Y-m-d H:i:s')` |

####Account::characters(): array

`$characters = $account->characters();`

Returns an array of `Character` instances. See `Character` instance description

###Character

If you have an ID of a character, than you can create a `Character` instance directly without using
`Account::characters()`

`$character = $api->character($keyID, $vCode, $characterID);`

Example:
`$character = $api->character(5421517,'H8dHemz5P1yQJZLTiyiFzJTAs71MvoY9jm2DmIU0d7ABrttO9vBpF3Qv5Drf4N0', 782653746);`

####Character::balance(): AccountBalance

Returns a balance of the character

`$balanceInstance = $character->balance();`

| variable  | description | type | usage |
| --- | --- | --- | --- |
| balance | Character balance | Integer | `$balanceInstance->balance` |

If you want to get a formatted string like `25 180 000.60 ISK`, than you can do `echo $balanceInstance`.
`AccountBalance` class has a `__toString()` magic method.

####Character::assets([Sorter $sorter = null]): array

Returns a character assets array. See `AssetType` description.

```
$assets = $character->assets();

foreach ($assets as $index => $asset) {
    //do something with the asset
}
```

Originally this function returns unsorted array of assets `$index => $asset`. If you want to sort the array by
location, you shell pass a `Sorter` instance to the function:

```
$assets = $character->assets(new LocationSorter());

foreach ($assets as $locationID => $assetList) {
    foreach ($assetList as $index => $asset) {
        //do something with the asset
    }
}
```

In that case, you'll get an array `$locationID => $assetList`, where `$assesList` is an array `$index => $asset`.

####Character::blueprints([Sorter $sorter = null]): array

Returns an array of blueprints owned by a character. See `BlueprintType` description.

```
$blueprints = $character->blueprints();
//or, if you want to get an array, that sorted by locationID
$blueprints = $character->blueprints(new LocationSorter());
```

####Character::bookmarks([Sorter $sorter = null]): array

Returns an array of character bookmarks. See `BookmarkType` description.

```
$bookamrks = $character->bookmarks();
//or, if you want to get an array, that sorted by locationID
$bookamrks = $character->bookmarks(new LocationSorter());
```

####Character::sheet(): Sheet

Return common character information

`$sheet = $character->sheet();`

| variable  | description | type | usage |
| --- | --- | --- | --- |
| name | Character name | String | `$sheet->name` |
| homeStationID | ID for station where clone will spawn on demise | Integer | `$sheet->homeStationID` |
| DoB | Date character was created | DateTime | `$sheet->DoB->format('Y-m-d H:i:s')` |
| race | Characters race | String | `$sheet->race` |
| bloodLineID | ID for characters bloodline | Integer | `$sheet->bloodLineID` |
| bloodLine | Characters bloodline | String | `$sheet->bloodLine` |
| ancestryID | ID for characters ancestry | Integer | `$sheet->ancestryID` |
| ancestry | Characters ancestry | String | `$sheet->ancestry` |
| gender | Characters gender | String | `$sheet->gender` |
| corporationName | Characters corporation | String | `$sheet->corporationName` |
| corporationID | ID for characters corporation | Integer | `$sheet->corporationID` |
| allianceName | Characters alliance | String | `$sheet->allianceName` |
| allianceID | ID for characters alliance | Integer | `$sheet->allianceID` |
| freeSkillPoints | Skillpoints available to be assigned | Integer | `$sheet->freeSkillPoints` |
| freeRespecs | Number of available character attribute respecs | Integer | `$sheet->freeRespecs` |
| cloneJumpDate | Characters last clone jump | DateTime | `$sheet->cloneJumpDate->format('Y-m-d H:i:s')` |
| lastRespecDate | Characters last character attribute respec | DateTime | `$sheet->lastRespecDate->format('Y-m-d H:i:s')` |
| lastTimedRespec | Characters last character attribute respec (Using respec accrued over time (1 year)) | DateTime | `$sheet->lastTimedRespec->format('Y-m-d H:i:s')` |
| remoteStationDate | Characters last change of home station remotely | DateTime | `$sheet->remoteStationDate->format('Y-m-d H:i:s')` |
| jumpActivation | Characters last capital jump activation | DateTime | `$sheet->jumpActivation->format('Y-m-d H:i:s')` |
| jumpFatigue | Characters jump fatigue expiry | DateTime | `$sheet->jumpFatigue->format('Y-m-d H:i:s')` |
| jumpLastUpdate | Characters last jump update | DateTime | `$sheet->jumpLastUpdate	->format('Y-m-d H:i:s')` |
| balance | Characters wallet balance | Float | `$sheet->balance` |
| attributes | Characters attributes | stdObject | `$sheet->attributes` |
| **attributes**->intelligence | Characters intelligence attribute | Integer | `$sheet->attributes->intelligence` |
| **attributes**->memory | Characters memory attribute | Integer | `$sheet->attributes->memory` |
| **attributes**->charisma | Characters charisma attribute | Integer | `$sheet->attributes->charisma` |
| **attributes**->perception | Characters perception attribute | Integer | `$sheet->attributes->perception` |
| **attributes**->willpower | Characters willpower attribute | Integer | `$sheet->attributes->willpower` |
| jumpClones | Characters jump clones | Array | **not implemented yet** |
| implants | Characters implants (see `ImplantType` description) | Array | `$sheet->implants` |
| corporationRoles | Characters corporation roles (see `RoleType` description) | Array | `$sheet->corporationRoles` |
| corporationRolesAtHQ | Characters corporation HQ roles (see `RoleType` description) | Array | `$sheet->corporationRolesAtHQ` |
| corporationRolesAtBase | Characters corporation base roles (see `RoleType` description) | Array | `$sheet->corporationRolesAtBase` |
| corporationRolesAtOther | Characters other corporation roles (see `RoleType` description) | Array | `$sheet->corporationRolesAtOther` |
| corporationTitles | Characters corporation titles (see `TitleType` description) | Array | `$sheet->corporationTitles` |
