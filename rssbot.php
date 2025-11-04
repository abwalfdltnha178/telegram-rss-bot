<?php
include 'config.php';

$rss_list = [
    "https://www.zoomit.ir/feed/",
    "https://digiato.com/feed/",
    "https://www.itna.ir/rssb5.0.xml?sectionsid=2",
    "https://www.mehrnews.com/rss/tp/8"
];

foreach ($rss_list as $rss_url) {
    $rss = @simplexml_load_file($rss_url);
    if (!$rss) continue;

    $count = 0;
    foreach ($rss->channel->item as $item) {
        $title = (string)$item->title;
        $link  = (string)$item->link;
        $desc  = strip_tags((string)$item->description);

        $text = "🧠 <b>$title</b>\n\n$desc\n\n🔗 <a href='$link'>مشاهده در منبع</a>";
        sendMessage($text);
        $count++;
        if ($count >= 3) break;
        sleep(2);
    }
}
?>
