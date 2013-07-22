<?php
    /**
     * PennyArcade-Mailer
     *
     * Sends HTML-email containing latest Penny Arcade comic.
     *
     * Forked from Ismo Vuorinen's xkcd-Mailer:
     * https://github.com/ivuorinen/xkcd-Mailer
     *
     * @author Raam Dev 
     * @version 1.0.20130722
     * @license http://www.opensource.org/licenses/mit-license.php The MIT License
     * @package default
     **/

    // Use config.example.php as base for your configurations.
    $here = dirname( __FILE__ );
    if( !is_readable($here . '/config.php') ) {
        die("Please configure me. I don't know where I should send the comic. (Config file {$here}/config.php missing.)");
    } else {
        include_once($here . '/config.php');
    }

    // Feel free to clone this Yahoo Pipe and use your own feed address: http://pipes.yahoo.com/pipes/pipe.info?_id=ea47b3335aec76f3274aa54727484321
    $feed = "http://pipes.yahoo.com/pipes/pipe.run?_id=ea47b3335aec76f3274aa54727484321&_render=rss";

    // Retrieve feed using cURL 
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $feed);
    curl_setopt($ch, CURLOPT_FAILONERROR, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 15);
    $returned = curl_exec($ch);
    curl_close($ch);
  
    // $xml === False on failure
    $data = simplexml_load_string($returned);

    $item = $data->channel->item[0];

    // To send HTML mail, the Content-type header must be set
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
    $headers .= 'From: '. $from . "\r\n";

    $subject    = "[Penny Arcade] {$item->title}";

    $msg = "<h1>{$item->title}</h1>\n"
        . $item->description."<br />\n";

    mail($mail, $subject, $msg, $headers);