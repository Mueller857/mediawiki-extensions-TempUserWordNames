# TempUserWordNames

MediaWiki extension which allows you to define a word list that is used for creating temporary usernames, inspired by [gfycat](https://medium.com/gfycat/naming-conventions-97960fc40179). The usernames will look something like `ApplePearBanana13` (the `13` is the unique, auto-generated numerical index, similar to [MediaWiki\User\TempUser\PlainNumericSerialMapping](https://doc.wikimedia.org/mediawiki-core/master/php/classMediaWiki_1_1User_1_1TempUser_1_1PlainNumericSerialMapping.html)).

## Configuration
```php
// Configure the extension
$wgTempUserWordNamesList = [ 'apple', 'pear', 'banana', 'pineapple', 'mango', ... ];
$wgTempUserWordNamesLength = 3;

// Ensure that MediaWiki uses the extension
$wgAutoCreateTempUser['serialMapping']['type'] = 'words';
```

Try and use a lot of words to ensure that a lot of combinations are possible. 500 is more than enough. There is no possibility of collision even with a small number of words, as the numerical index is inserted at the end of the username.

This extension makes temporary account usernames more readable while still ensuring there is no collision by appending the index at the end. However, if you'd like to turn off the indexes and risk collision, you can set `$wgTempUserWordNamesUseIndex = false;`.
