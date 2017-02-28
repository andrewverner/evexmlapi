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

| variable  | description | type |
| --- | --- | --- |
| paidUntil | Paid until date | DateTime |
| createDate | Account create date | DateTime |
| logonCount | Logon count | Integer |
| logonMinutes | Logon minutes | Integer |

####Account::keyInfo(): APIKeyInfo

`$info = $account->keyInfo();`

Returns an information about API key:

| variable  | description | type |
| --- | --- | --- |
| accessMask | Access mask of the key | Integer |
| expires | Expiration date | DateTime |

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

| variable  | description | type |
| --- | --- | --- |
| balance | Character balance | Integer |

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

| variable  | description | type |
| --- | --- | --- |
| name | Character name | String |
| homeStationID | ID for station where clone will spawn on demise | Integer |
| DoB | Date character was created | DateTime |
| race | Characters race | String |
| bloodLineID | ID for characters bloodline | Integer |
| bloodLine | Characters bloodline | String |
| ancestryID | ID for characters ancestry | Integer |
| ancestry | Characters ancestry | String |
| gender | Characters gender | String |
| corporationName | Characters corporation | String |
| corporationID | ID for characters corporation | Integer |
| allianceName | Characters alliance | String |
| allianceID | ID for characters alliance | Integer |
| freeSkillPoints | Skillpoints available to be assigned | Integer |
| freeRespecs | Number of available character attribute respecs | Integer |
| cloneJumpDate | Characters last clone jump | DateTime |
| lastRespecDate | Characters last character attribute respec | DateTime |
| lastTimedRespec | Characters last character attribute respec (Using respec accrued over time (1 year)) | DateTime |
| remoteStationDate | Characters last change of home station remotely | DateTime |
| jumpActivation | Characters last capital jump activation | DateTime |
| jumpFatigue | Characters jump fatigue expiry | DateTime |
| jumpLastUpdate | Characters last jump update | DateTime |
| balance | Characters wallet balance | Float |
| attributes | Characters attributes | stdObject |
| **attributes**->intelligence | Characters intelligence attribute | Integer |
| **attributes**->memory | Characters memory attribute | Integer |
| **attributes**->charisma | Characters charisma attribute | Integer |
| **attributes**->perception | Characters perception attribute | Integer |
| **attributes**->willpower | Characters willpower attribute | Integer |
| jumpClones | Characters jump clones | Array |
| implants | Characters implants (see `ImplantType` description) | Array |
| corporationRoles | Characters corporation roles (see `RoleType` description) | Array |
| corporationRolesAtHQ | Characters corporation HQ roles (see `RoleType` description) | Array |
| corporationRolesAtBase | Characters corporation base roles (see `RoleType` description) | Array |
| corporationRolesAtOther | Characters other corporation roles (see `RoleType` description) | Array |
| corporationTitles | Characters corporation titles (see `TitleType` description) | Array |

####Character::chats(): array

Returns an array of characters chat channels. See `ChatChannel` description.

`$chats = $character->chats()`

####Character::contacts(): ContactList

Returns characters contact list

`$chats = $character->contacts()`

| variable  | description | type |
| --- | --- | --- |
| contactList | Personal contact list | Array |
| corporateContactList | Corporation contact list | Array |
| allianceContactList | Alliance contact list | Array |

See `ContactType` description.
