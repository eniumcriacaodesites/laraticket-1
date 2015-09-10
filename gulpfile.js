var elixir = require('laravel-elixir');
var jsDir = './resources/assets/js/';
var bowerDir = './resources/assets/bower/';
/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function (mix) {
    //mix.phpUnit();
    mix.sass(
        [
            'app.scss'
        ],
        'public/assets/css/app.css'
    );
    mix.styles(
        [
            'bootstrap/dist/css/bootstrap.min.css',
            'dynatable/jquery.dynatable.css',
            'chosen/chosen.min.css'
        ],
        'public/assets/css/resources.css',
        bowerDir
    );
    mix.scripts(
        [
            'jquery/dist/jquery.min.js',
            'bootstrap/dist/js/bootstrap.min.js',
            'dynatable/jquery.dynatable.js',
            'chosen/chosen.jquery.min.js'
        ],
        'public/assets/js/resources.js',
        bowerDir
    );
    mix.scripts(
        [
            'app.js',
            'ticket.js'
        ],
        'public/assets/js/app.js',
        jsDir
    );
    mix.copy(
        bowerDir + 'bootstrap/dist/fonts',
        'public/assets/fonts'
    );
});
