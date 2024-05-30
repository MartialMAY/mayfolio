$(document).ready(function() {
    const feedUrls = [
        'https://api.rss2json.com/v1/api.json?rss_url=https://jetbrains.developpez.com/index/rss',
        'https://api.rss2json.com/v1/api.json?rss_url=https://www.journaldugeek.com/feed/'
    ];

    // Tableau pour stocker les promesses de chaque requête AJAX
    const requests = [];

    // Parcourir les URL des flux RSS
    feedUrls.forEach(function(url) {
        // Effectuer une requête AJAX pour chaque URL
        const request = $.ajax({
            url: url,
            method: 'GET',
            dataType: 'json'
        });

        // Ajouter la promesse de la requête à notre tableau de promesses
        requests.push(request);
    });

    // Une fois que toutes les requêtes sont terminées
    $.when.apply($, requests).done(function() {
        // Parcourir les résultats de chaque requête
        for (let i = 0; i < arguments.length; i++) {
            const response = arguments[i][0]; // Récupérer la réponse JSON

            // Vérifier si la réponse est valide
            if (response && response.items) {
                const items = response.items;

                // Parcourir les éléments de chaque flux RSS
                items.forEach(function(item, index) {
                    const itemId = "item" + (index + 1);
                    $("#" + itemId + " .card-title").text($(item.title).text());
                    $("#" + itemId + " .img-cover").attr("src", item.thumbnail);
                    $("#" + itemId + " .details").text($(item.description).text());
                    $("#" + itemId + " .date").text("Dernière mise à jour : " + item.pubDate);
                    $("#" + itemId + " .state-layer").attr("href", item.link);
                });
            } else {
                console.error('La réponse du flux RSS est invalide :', response);
            }
        }
    }).fail(function(xhr, status, error) {
        console.error('Erreur lors du chargement des flux RSS :', error);
    });
});


