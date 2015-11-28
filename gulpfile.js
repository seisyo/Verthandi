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
    ], "public/css");

    mix.scripts([
        "jquery-2.1.1.js",
        "bootstrap.js",
        "inspinia.js",
        "jquery-ui-1.10.4.min.js",
        "jquery-ui.custom.min.js"
    ], "public/js");

    mix.copy("resources/assets/email_templates", "public/email_templates");
    mix.copy("resources/assets/font-awesome", "public/font-awesome");
    mix.copy("resources/assets/fonts", "public/fonts");
    mix.copy("resources/assets/img", "public/img");
    
    mix.copy("resources/assets/css/patterns", "public/css/patterns");
    mix.copy("resources/assets/css/plugins", "public/css/plugins");
    
    mix.copy("resources/assets/js/demo", "public/js/demo");
    mix.copy("resources/assets/js/plugins", "public/js/plugins");
});
