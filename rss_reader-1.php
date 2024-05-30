<?php
function read_rss_feed1($url) {
    $rss = simplexml_load_file($url);
    $items = [];
    if ($rss) {
        foreach ($rss->channel->item as $item) {
            $enclosure = $item->enclosure ?? null;
            if ($enclosure) {
                $enclosure_attributes = $enclosure->attributes();
                $image_url = (string)$enclosure_attributes['url'];
            } else {
                // Définir une valeur par défaut pour $image_url si la balise <enclosure> est absente
                $image_url = ''; // Ou vous pouvez définir une URL par défaut appropriée
            }

            $items[] = [
                'title' => (string)$item->title,
                'description' => (string)$item->description,
                'date' => date('d/m/Y H:i', strtotime((string)$item->pubDate)),
                'link' => (string)$item->link,
                'image' => $image_url
            ];
        }
    }
    return $items;
}
?>




