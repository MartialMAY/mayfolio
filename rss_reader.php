<?php
function read_rss_feed($url) {
    $rss = simplexml_load_file($url);
    $items = [];
    if ($rss) {
        foreach ($rss->channel->item as $item) {
            $media = $item->children('media', true);
            $thumbnail = $media->thumbnail ?? null;
            if ($thumbnail) {
                $thumbnail_attributes = $thumbnail->attributes();
                $image_url = (string)$thumbnail_attributes['url'];
            } else {
                // Définir une valeur par défaut pour $image_url si la balise <media:thumbnail> est absente
                $image_url = ''; // Ou vous pouvez définir une URL par défaut appropriée
            }

            // Récupération de la description
            $description = (string)$item->description;

            // Modification de la taille des images
            $description = preg_replace_callback('/<img[^>]+>/', function($match) {
                // Modification de la taille de l'image en ajoutant ou en modifiant les attributs width et height
                $modified_image = preg_replace('/(width|height)="[^"]*"/i', '', $match[0]);
                // Ici, tu peux spécifier la nouvelle largeur et la nouvelle hauteur pour l'image, par exemple :
                $modified_image = str_replace('<img ', '<img style="max-width:500px; max-height:300px;" ', $modified_image);
                return $modified_image;
            }, $description);

            $items[] = [
                'title' => (string)$item->title,
                'description' => $description,
                'date' => date('d/m/Y H:i', strtotime((string)$item->pubDate)),
                'link' => (string)$item->link,
                'image' => $image_url
            ];
        }
    }
    return $items;
}
?>



