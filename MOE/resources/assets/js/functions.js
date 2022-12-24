"use strict"

/**
 * Obtem a url relativa de um path
 * @param {string} path
 * @param {boolean?} baseUrl
 *
 * @return string
 */
function siteUrl(path) {

    var siteUrl = $('meta[name="site_url"]').attr('content');

    if (path[0] == "/") {
        path = path.substring(1);
    }

    return siteUrl + "/" + path;
}

/**
 * Bloquear o elemento (abrir loading)
 */
$.fn.wait = function(text) {
    $(this).append('<div class="loader-container"><div class="loader-content"><div class="loader"></div></div></div>');
}

/**
 * Desbloquear o elemento (remover loading)
 */
$.fn.closeWait = function() {
    $(this).find(".loader-container").fadeOut(300, function() {
        $(this).remove();
    });
};

/**
 * Bloqueia a tela no elemento 'main'
 */
function wait() {
    $('body').wait();
}

/**
 * Desbloqueia a tela no elemento 'main'
 */
function closeWait() {
    $('body').closeWait();
}
