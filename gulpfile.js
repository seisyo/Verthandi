var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {

    mix.styles([
        "animate.css",
        "bootstrap.css",
        "style.css"
    ], "public/assets/css");

    mix.scripts([
        "jquery-2.1.1.js",
        "bootstrap.js",
        "inspinia.js",
        "jquery-ui-1.10.4.min.js",
        "jquery-ui.custom.min.js"
    ], "public/assets/js");

    // mix.copy("resources/assets/email_templates", "public/assets/email_templates");
    mix.copy("resources/assets/font-awesome", "public/assets/font-awesome");
    mix.copy("resources/assets/fonts", "public/assets/fonts");
    mix.copy("resources/assets/img", "public/assets/img");
    
    mix.copy("resources/assets/css/patterns", "public/assets/css/patterns");
    mix.copy("resources/assets/css/plugins", "public/assets/css/plugins");
    
    mix.copy("resources/assets/js/plugins", "public/assets/js/plugins");

    //custom js
    mix.copy("resources/assets/js/custom/add_transaction.js", "public/assets/js/custom/add_transaction.js");
    mix.copy("resources/assets/js/custom/delete_transaction.js", "public/assets/js/custom/delete_transaction.js");
});
