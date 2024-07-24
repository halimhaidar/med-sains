const mix = require('laravel-mix');
const tailwindcss = require('tailwindcss');
const BrowserSyncPlugin = require('browser-sync-webpack-plugin');

mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        tailwindcss('./tailwind.config.js'),
    ])
    .webpackConfig({
        plugins: [
            new BrowserSyncPlugin({
                proxy: 'http://127.0.0.1:8000', // Your local development URL
                files: [
                    'resources/views/**/*.blade.php',
                    'resources/css/**/*.css',
                    'resources/js/**/*.js',
                ],
                notify: false,
            }),
        ],
    });

// Optionally enable versioning in production
if (mix.inProduction()) {
    mix.version();
}
