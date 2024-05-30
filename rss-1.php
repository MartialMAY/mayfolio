<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    .items {
  display: flex;
  flex-flow: column;
  align-items: flex-start;
  max-width: 850px;
  width: 100%;
  margin: 0 auto;
  padding: 0 15px;
}
.items .item {
  display: flex;
  text-decoration: none;
  margin-bottom: 40px;
}
.items .item .image {
  border-radius: 15px;
  max-width: 200px;
}
.items .item .details {
  padding-left: 30px;
  font-size: 13px;
}
.items .item .details .title {
  margin: 0;
  padding: 10px 0;
  color: #556071;
  font-size: 16px;
}
.items .item .details .date {
  display: block;
  color: #b3bac6;
  font-size: 11px;
  font-weight: 500;
  padding-top: 10px;
}
.items .item .details .description {
  color: #8792a5;
  font-size: 16px;
  margin: 0;
  padding: 5px 0;
}
</style>
<body>
    
</body>
</html>
<?php
                    include 'rss_reader.php';

                    // URL du flux RSS
                  $rss_feed_urls = ['https://www.journaldugeek.com/category/sur-le-web/feed/'];

                    // Appel de la fonction pour lire le flux RSS
                    $items = [];
                    foreach ($rss_feed_urls as $url) {
                        $items = array_merge($items, read_rss_feed($url));
                    }

                    // Limite du nombre d'éléments à afficher
                    $limit = 3;

                    // Compteur d'éléments
                    $item_count = 0;

                    // Affichage des éléments
                    foreach ($items as $item) {
                        // Vérifier si le nombre maximum d'éléments est atteint
                        if ($item_count >= $limit) {
                            break;
                        }
                        preg_match('/<img[^>]+src="([^"]+)"/', $item['description'], $matches);
$image_url = isset($matches[1]) ? $matches[1] : '';
$description_without_image = preg_replace('/<img[^>]+>/', '', $item['description']);
                        echo '<main class="items" id="item' . ($item_count + 1) . '">';
                        echo '<a href="' . $item['link'] . '" class="item">';
                        echo '<img src="' . $image_url . '" alt="' . $item['title'] . '"  class="image">';
                        echo ' <div class="details">';
                        echo ' <span class="date">' . $item['date'] . '</span>';
                        echo ' <h2 class="title">' . $item['title'] . '</h2>';
                        echo '  <p class="description">' . $description_without_image . '</p>';
                        


                        // echo '<figure class="card-banner img-holder" style="--width: 334; --height: 180;"> ';
                        
                        // echo '<img src="' . $item['image'] . '" alt="' . $item['title'] . '" width="334" height="180"
                        // class="img-cover">';
                        // echo '</figure>';
                        // echo '<div class="card-content">';
                        // echo '<span class="label-large card-subtitle">Web App</span>';
                        
                        // echo '<h3 class="title-large card-title">' . $item['title'] . '</h3>' ;
                        // echo '<p class="details" style=" white-space: nowrap;
                        // overflow: hidden; text-overflow: ellipsis; ">' . $item['description'] . '</p>';
                        // echo '<p class="date">' . $item['date'] . '</p>';
                        // echo '</div>';

                        echo '</div>';
                        echo '</a>';
                        echo '</main>';
                        
                       
                        // Incrémenter le compteur
                        $item_count++;
                    }
                    ?>
