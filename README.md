# PennyArcade-Mailer #

Takes the first/latest item from a Penny Arcade RSS-feed (the feed needs to be mashed together using Yahoo Pipes, as [described by Scott Sinclair](http://www.nullis.net/weblog/2011/02/penny-arcade-comics-feed/) and retrieves the latest comic image, and then mails that image to a specified email address.

The project is based on [xkcd-Mailer](https://github.com/ivuorinen/xkcd-Mailer) by [Ismo Vuorinen](https://github.com/ivuorinen).

## configuration ##

The script needs a simple configuration. Modify ``config.example.php`` to fit your needs and save as ``config.php``

```php
<?php
/**
 * PennyArcade-Mailer configuration example
 * Save me as config.php
 */

// Your timezone, PHP5 required.
// See full list: http://www.php.net/manual/en/timezones.php
date_default_timezone_set("America/New_York");

// Your destination
$mail = "your@email.com";
$from = "PennyArcade mailer <pennyarcade_mailer@example.com>";
```


## crontab example ##

15 minutes over 7am on monday, wednesday and friday.

    15 7 * * 1,3,5 /usr/bin/php /full/path/to/pennyarcade-mailer.php


## caveats ##

- Script doesn't check if the feed has been updated, possibly causing old comic delivery


## contributing ##

- Fork the code
- Do your changes
- Send pull request
- Bask in glory of open source love
