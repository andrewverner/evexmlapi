#EVE Online XML API

##HIW?

Create an API-object `$api = new \EveXMLAPI\API();`

Now you have to define key identifier and verification code (you can find or create it here -
[EVE Online API key manager](https://api.eveonline.com/))
 
###Account

Create an account object
`$account = $api->account($keyID, $vCode);`

Example: `$account = $api->account(5421517,'H8dHemz5P1yQJZLTiyiFzJTAs71MvoY9jm2DmIU0d7ABrttO9vBpF3Qv5Drf4N0');`

| function | description |
| --- | --- |
| status() | Information about a player’s EVE account like creation time, minutes spent in game etc |
| keyInfo() | Specifies the access rights of an API key |
| characters() | Lists all characters included in this API key |

####Account::status(): AccountStatus

`$status = $account->status();`

Returns an information about user account:

| property  | description | type |
| --- | --- | --- |
| paidUntil | Paid until date | DateTime |
| createDate | Account create date | DateTime |
| logonCount | Logon count | Integer |
| logonMinutes | Logon minutes | Integer |

####Account::keyInfo(): APIKeyInfo

`$info = $account->keyInfo();`

Returns an information about API key:

| property  | description | type |
| --- | --- | --- |
| accessMask | Access mask of the key | Integer |
| expires | Expiration date | DateTime |

####Account::characters(): array

`$characters = $account->characters();`

Returns an array of `Character` instances.

###Character

If you have an ID of a character, than you can create a `Character` instance directly without using
`Account::characters()`

`$character = $api->character($keyID, $vCode, $characterID);`

Example:
`$character = $api->character(5421517,'H8dHemz5P1yQJZLTiyiFzJTAs71MvoY9jm2DmIU0d7ABrttO9vBpF3Qv5Drf4N0', 782653746);`

| scope | property | type | description |
| --- | --- | --- | --- |
| **private** | key | CharacterKey | Character API key instance |
| public | name | String | Character name |
| public | corporationName | String | Characters corporation name |
| public | corporationID | Integer | Character corporation ID |
| public | allianceName | String | Characters alliance name |
| public | allianceID | Integer | Characters alliance ID |
| public | factionName | String | Characters faction name |
| public | factionID | Integer | Characters faction ID |

| function | description |
| --- | --- |
| balance() | Retrieve character account balance |
| assets() | Lists everything a character owns |
| blueprints() | Lists blueprints in characters inventory |
| bookmarks() | Retrieve character Bookmarks |
| sheet() | Character, skills and roles information |
| chats() | Retrieve character Chat Channels |
| contacts() | Lists the character’s personal, corporation, and alliance contacts |
| contracts() | Returns available contracts to character |
| facWarStats() | Returns faction warfare information for characters enrolled in faction warfare |
| industryJobs() | Retrieve unfinished character industry jobs |
| industryJobsHistory() | Retrieve finished character industry jobs |
| killMails() | Retrieve a list of character kills and deaths |
| locations() | Retrieve location and name of specific items that belong to the character / corporation of the api key. This call can be used to retrieve the player-set name of containers and ships |

####Character::balance(): AccountBalance

Returns a balance of the character

`$balanceInstance = $character->balance();`

| property  | description | type |
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

**`AssetType`**

| property | type | description |
| --- | --- | --- |
| itemID | Integer | Unique ID for this item. The ID of an item is stable if that item is not repackaged, stacked, detached from a stack, assembled, or otherwise altered. If an item is changed in one of these ways, then the ID will also change |
| locationID | Integer | References a solar system or station. Note that in the nested XML response this column is not present in the sub-asset lists, as those share the locationID of their parent node. Example: a module in a container in a ship in a station.. Whereas the flat XML returns a locationID for each item |
| typeID | Integer | The type of this item |
| quantity | Integer | How many items are in this stack |
| flag | Integer | Indicates something about this item's storage location. The flag is used to differentiate between hangar divisions, drone bay, fitting location, and similar. Please see the Inventory Flags documentation |
| singleton | Boolean | If True (1), indicates that this item is a singleton. This means that the item is not packaged |
| rawQuantity | Integer | Items in the AssetList (and ContractItems) now include a rawQuantity attribute if the quantity in the DB is negative |
| nested | Array | Array of nested items |

####Character::blueprints([Sorter $sorter = null]): array

Returns an array of blueprints owned by a character.

```
$blueprints = $character->blueprints();
//or, if you want to get an array, that sorted by locationID
$blueprints = $character->blueprints(new LocationSorter());
```

**`BlueprintType`**

| property | type | description |
| --- | --- | --- |
| itemID | Integer | Unique ID for this item. The ID of an item is stable if that item is not repackaged, stacked, detached from a stack, assembled, or otherwise altered. If an item is changed in one of these ways, then the ID will also change |
| locationID | Integer | References a solar system, station or itemID if this blueprint is located within a container. If an itemID the Character - AssetList API must be queried to find the container using the itemID, from which the correct location of the Blueprint can be derived |
| typeID | Integer | The type of this item |
| typeName | String | The name of this item |
| quantity | Integer | Typically will be -1 or -2 designating a singleton item, where -1 is an original and -2 is a copy. It can be a positive integer if it is a stack of blueprint originals fresh from the market (no activities performed on them yet) |
| flagID | Integer | Indicates something about this item's storage location. The flag is used to differentiate between hangar divisions, drone bay, fitting location, and similar |
| timeEfficiency | Integer | Time Efficiency Level of the blueprint, can be any even integer between 0 and 20 |
| materialEfficiency | Integer | Material Efficiency Level of the blueprint, can be any integer between 0 and 10 |
| runs | Integer | Number of runs remaining if the blueprint is a copy, -1 if it is an original |

####Character::bookmarks([Sorter $sorter = null]): array

Returns an array of character bookmarks. See `BookmarkType` description.

```
$bookamrks = $character->bookmarks();
//or, if you want to get an array, that sorted by locationID
$bookamrks = $character->bookmarks(new LocationSorter());
```

**`BookmarkType`**

| property | type | description |
| --- | --- | --- |
| bookmarkID | Integer | Unique bookmark ID |
| creatorID | Integer | Bookmark creator ID. Can be character or corporation ID |
| created | DateTime | Date and time when bookmark was created |
| itemID | Integer | Item ID of the item to which the bookmark refers, or 0 if the bookmark refers to a location |
| typeID | Integer | Type ID of the item to which the bookmark refers (even if the bookmark refers to a location instead of an item) |
| locationID | Integer | Location ID of the solar sytem to which this bookmark refers |
| x | Float | X location of bookmark (relative to system sun) if this bookmark does not refer to an item |
| y	| Float | Y location of bookmark (relative to system sun) if this bookmark does not refer to an item |
| z | Float | Z location of bookmark (relative to system sun) if this bookmark does not refer to an item |
| memo | String | Bookmark description (owner specified) |
| note | String | Bookmark annotation (owner specified) |

####Character::sheet(): Sheet

Return common character information

`$sheet = $character->sheet();`

| property  | description | type |
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

`$chats = $character->chats();`

**`ChatChannel`**

| property | type | description |
| --- | --- | --- |
| channelID | Integer | Unique channel ID. Always negative for player-created channels. Permanent (CCP created) channels have a positive ID, but don't appear in the API |
| ownerID | Integer | Channel owner ID |
| ownerName | String | Channel owner name |
| displayName | String | Displayed name of channel |
| comparisonKey | String | Normalized, unique string used to compare channel names |
| hasPassword | Boolean | If true, then this is a password protected channel |
| motd | String | Current channel message of the day |
| allowed | Array of `AccessorType` | List of allowed channel member |
| operators | Array of `AccessorType` | List of channel operators |
| blocked | Array of `AccessorType` | List of blocked channel member |
| muted | Array of `AccessorType` | List of muted channel member |

**`AccessorType`**

| property | type | description |
| --- | --- | --- |
| accessorID | Integer | Character ID |
| accessorName | String | Character name |
| untilWhen | DateTime | Time at which accessor will no longer be blocked or muted (only for blocked or muted characters, **null** otherwise) |
| reason | String | Reason accessor is muted or blocked (only for blocked or muted characters, **null** otherwise) |

####Character::contacts(): ContactList

Returns characters contact list

`$chats = $character->contacts();`

| property  | description | type |
| --- | --- | --- |
| contactList | Personal contact list | Array |
| corporateContactList | Corporation contact list | Array |
| allianceContactList | Alliance contact list | Array |

See `ContactType` description.

####Character::contracts(): array

Returns an array of characters contracts. See `Contract` instance description.

`$contracts = $character->contracts();`

####Character::facWarStats(): FacWarStats

Returns faction warfare information for characters enrolled in faction warfare.

`$stats = $character->facWarStats();`

| property  | description | type |
| --- | --- | --- |
| factionID | ID number of the faction | Integer |
| factionName | Name of the faction | String |
| enlisted | Date character enlisted in the faction | DateTime |
| currentRank | Characters current faction rank | Integer |
| highestRank | Characters highest faction rank | Integer |
| killsYesterday | Number of ships character destroyed yesterday | Integer |
| killsLastWeek | Number of ships character destroyed last week | Integer |
| killsTotal | Number of total ships character destroyed | Integer |
| victoryPointsYesterday | Number of victory points character acquired yesterday | Integer |
| victoryPointsLastWeek | Number of victory points character acquired last week | Integer |
| victoryPointsTotal | Number of total victory points character acquired | Integer |

####Character::industryJobs(): array

Retrieve an array of unfinished character industry jobs. See `IndustryJob` instance description.

`$jobs = $character->industryJobs();`

####Character::industryJobsHistory(): array

Retrieve an array of finished character industry jobs. See `IndustryJob` instance description.

`$jobs = $character->industryJobsHistory();`

####Character::industryJobsHistory(): array

Retrieve a list of character kills and deaths. See `KillMail` instance description.

`$kills = $character->killMails(50);`

####Character::locations(): array

Retrieve location and name of specific items that belong to the character / corporation of the api key. This call can be
used to retrieve the player-set name of containers and ships. See `LocationType` instance description.

`$kills = $character->killMails(50);`
