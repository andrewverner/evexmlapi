#EVE Online XML API

##HIW?

Create an API-object `$api = new \EveXMLAPI\API();`

Now you have to define key identifier and verification code (you can find or create it here -
[EVE Online API key manager](https://api.eveonline.com/))
 
###Account

Create an account object
`$account = $api->account($keyID, $vCode);`

Example: `$account = $api->account(5421517,'H8dHemz5P1yQJZLTiyiFzJTAs71MvoY9jm2DmIU0d7ABrttO9vBpF3Qv5Drf4N0');`

#####Account::status(): AccountStatus

`$status = $account->status();`

Returns an information about user account:

| variable  | description | type | usage |
| --- | --- | --- | --- |
| paidUntil | Paid until date | DateTime | `$status->paidUntil->format('Y-m-d H:i:s')` |
| createDate | Account create date | DateTime | `$status->paidUntil->format('Y-m-d H:i:s')` |
| logonCount | Logon count | Integer | `$status->logonCount` |
| logonMinutes | Logon minutes | Integer | `$status->logonCount` |

#####Account::keyInfo(): APIKeyInfo

`$info = $account->keyInfo();`

Returns an information about API key:

| variable  | description | type | usage |
| --- | --- | --- | --- |
| accessMask | Access mask of the key | Integer | `$info->assessMask` |
| expires | Expiration date | DateTime | `$info->expires->format('Y-m-d H:i:s')` |

#####Account::characters(): array

`$characters = $account->characters();`

Returns an array of `Character` instances. See `Character` instance description

###Character

If you have an ID of a character, than you can create a `Character` instance directly without using
`Account::characters()`

`$character = $api->character($keyID, $vCode, $characterID);`

Example:
`$character = $api->character(5421517,'H8dHemz5P1yQJZLTiyiFzJTAs71MvoY9jm2DmIU0d7ABrttO9vBpF3Qv5Drf4N0', 782653746);`

#####Character::balance(): AccountBalance

Returns a balance of the character

`$balanceInstance = $character->balance();`

| variable  | description | type | usage |
| --- | --- | --- | --- |
| balance | Character balance | Integer | `$balanceInstance->balance` |

If you want to get a formatted string like `25 180 000.60 ISK`, than you can do `echo $balanceInstance`.
`AccountBalance` class has a `__toString()` magic method.

#####Character::assets([Sorter $sorter = null]): array

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

#####Character::blueprints([Sorter $sorter = null]): array

Returns an array of blueprints owned by a character. See `BlueprintType` description.

```
$blueprints = $character->blueprints();
//or, if you want to get an array, that sorted by locationID
$blueprints = $character->blueprints(new LocationSorter());
```

#####Character::bookmarks([Sorter $sorter = null]): array

Returns an array of character bookmarks. See `BookmarkType` description.

```
$bookamrks = $character->bookmarks();
//or, if you want to get an array, that sorted by locationID
$bookamrks = $character->bookmarks(new LocationSorter());
```
