# TempUserWordNames

MediaWiki extension which allows you to define a word list that is used for creating temporary usernames, inspired by [gfycat](https://medium.com/gfycat/naming-conventions-97960fc40179). The usernames will look something like `ApplePearBanana13` (the `13` is the unique, auto-generated numerical index, similar to [MediaWiki\User\TempUser\PlainNumericSerialMapping](https://doc.wikimedia.org/mediawiki-core/master/php/classMediaWiki_1_1User_1_1TempUser_1_1PlainNumericSerialMapping.html)).

## Configuration
```php
/**
* To configure a list of words, $wgTempUserWordNamesList can be set. It should have either a 'pages' or 'words' key.
*
* If 'page' is provided, it should contain a single string that points to a wiki page containing a list of words.
* By default, the extension uses 'MediaWiki:TempUserWordList'. Each word should be separated by a new line.
* $wgTempUserWordNamesCentralWiki can be set to a different wiki that uses the same shared user table to fetch words from there instead.
*
* If 'words' is provided, it should contain an array of strings.
*/
$wgTempUserWordNamesList['page'] = 'MediaWiki:TempUserWordList';
$wgTempUserWordNamesLength = 3;

// Ensure that MediaWiki uses the extension
$wgAutoCreateTempUser['serialMapping']['type'] = 'words';
```

Try and use a lot of words to ensure that a lot of combinations are possible. 500 is more than enough. There is no possibility of collision even with a small number of words, as the numerical index is inserted at the end of the username.

### Troubleshooting

If there any problems with word list, the extension will log them to the channel `TempUserWordNames` and use a default list of words instead.

### Risk of collisions

This extension makes temporary account usernames more readable while still ensuring there is no collision by appending the index at the end. However, if you'd like to turn off the indexes and risk collision, you can set `$wgTempUserWordNamesUseIndex = false;`.
