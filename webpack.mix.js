const mix = require('laravel-mix');
const lodash = require("lodash");
const WebpackRTLPlugin = require('webpack-rtl-plugin');
const folder = {
    src: "resources/", // source files
    dist: "public/", // build files
    dist_assets: "public/assets/" //build assets files
};

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

// mix.js('resources/js/app.js', 'public/js')
//     .sass('resources/sass/app.scss', 'public/css')
//     .sourceMaps();

var third_party_assets = {
    css_js: [

        {
            "name": "fullcalendar",
            "assets": ["./node_modules/fullcalendar/main.min.css",
                "./node_modules/fullcalendar/main.min.js"]
        },

        { "name": "apexcharts", "assets": ["./node_modules/apexcharts/dist/apexcharts.min.js"] },

        {
            "name": "glightbox",
            "assets": [
                "./node_modules/glightbox/dist/css/glightbox.min.css",
                "./node_modules/glightbox/dist/js/glightbox.min.js"]
        },

        { "name": "isotope-layout", "assets": ["./node_modules/isotope-layout/dist/isotope.pkgd.min.js"] },

        {
            "name": "dragula",
            "assets": [
                "./node_modules/dragula/dist/dragula.min.css",
                "./node_modules/dragula/dist/dragula.min.js"],
        },

        { "name": "moment", "assets": ["./node_modules/moment/min/moment.min.js"] },

        {
            "name": "choices.js",
            "assets": [
                "./node_modules/choices.js/public/assets/styles/choices.min.css",
                "./node_modules/choices.js/public/assets/scripts/choices.min.js"]
        },

        {
            "name": "flatpickr",
            "assets": ["./node_modules/flatpickr/dist/flatpickr.min.css",
                "./node_modules/flatpickr/dist/flatpickr.min.js"]
        },

        {
            "name": "dropzone",
            "assets": [
                "./node_modules/dropzone/dist/dropzone.css",
                "./node_modules/dropzone/dist/dropzone-min.js"]
        },

        { "name": "metismenujs", "assets": ["./node_modules/metismenujs/dist/metismenujs.min.js"] },

        { "name": "simplebar", "assets": ["./node_modules/simplebar/dist/simplebar.min.js"] },

        { "name": "bootstrap", "assets": ["./node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"] },

        { "name": "feather-icons", "assets": ["./node_modules/feather-icons/dist/feather.min.js"] },

        {
            "name": "swiper",
            "assets": [
                "./node_modules/swiper/swiper-bundle.min.css",
                "./node_modules/swiper/swiper-bundle.min.js"]
        },


        {
            "name": "nouislider",
            "assets": [
                "./node_modules/nouislider/dist/nouislider.min.css",
                "./node_modules/nouislider/dist/nouislider.min.js"]
        },

        { "name": "wnumb", "assets": ["./node_modules/wnumb/wNumb.min.js"] },

        { "name": "@ckeditor", "assets": ["./node_modules/@ckeditor/ckeditor5-build-classic/build/ckeditor.js"] },

        {
            "name": "alertifyjs",
            "assets": ["./node_modules/alertifyjs/build/css/alertify.min.css",
                "./node_modules/alertifyjs/build/css/themes/default.min.css",
                "./node_modules/alertifyjs/build/alertify.min.js"
            ]
        },

        {
            "name": "rater-js",
            "assets": [
                "./node_modules/rater-js/index.js"]
        },

        {
            "name": "sweetalert2",
            "assets": [
                "./node_modules/sweetalert2/dist/sweetalert2.min.css",
                "./node_modules/sweetalert2/dist/sweetalert2.min.js"]
        },

        {
            "name": "@simonwep",
            "assets": [
                "./node_modules/@simonwep/pickr/dist/themes/classic.min.css",
                "./node_modules/@simonwep/pickr/dist/themes/monolith.min.css",
                "./node_modules/@simonwep/pickr/dist/themes/nano.min.css",
                "./node_modules/@simonwep/pickr/dist/pickr.min.js"
            ]
        },

        {
            "name": "quill",
            "assets": [
                "./node_modules/quill/dist/quill.core.css",
                "./node_modules/quill/dist/quill.bubble.css",
                "./node_modules/quill/dist/quill.snow.css",
                "./node_modules/quill/dist/quill.min.js"
            ]
        },

        { "name": "imask", "assets": ["./node_modules/imask/dist/imask.min.js"] },

        {
            "name": "jsvectormap",
            "assets": [
                "./node_modules/jsvectormap/dist/css/jsvectormap.min.css",
                "./node_modules/jsvectormap/dist/js/jsvectormap.min.js",
                "./node_modules/jsvectormap/dist/maps/world-merc.js",
                // "./node_modules/jsvectormap/dist/maps/us-merc-en.js",
                // "./node_modules/jsvectormap/dist/maps/canada.js",
            ]
        },

        { "name": "gmaps", "assets": ["./node_modules/gmaps/gmaps.min.js"] },

        {
            "name": "leaflet",
            "assets": [
                "./node_modules/leaflet/dist/leaflet.css",
                "./node_modules/leaflet/dist/leaflet.js"
            ]
        },

        {
            "name": "gridjs",
            "assets": [
                "./node_modules/gridjs/dist/theme/mermaid.min.css",
                "./node_modules/gridjs/dist/gridjs.umd.js"
            ]
        },

        { "name": "masonry-layout", "assets": ["./node_modules/masonry-layout/dist/masonry.pkgd.min.js"] },

    ]
};


//copying third party assets
lodash(third_party_assets).forEach(function (assets, type) {
    if (type == "css_js") {
        lodash(assets).forEach(function (plugin) {
            var name = plugin['name'],
                assetlist = plugin['assets'],
                css = [],
                js = [];
            lodash(assetlist).forEach(function (asset) {
                var ass = asset.split(',');
                for (let i = 0; i < ass.length; ++i) {
                    if (ass[i].substr(ass[i].length - 3) == ".js") {
                        js.push(ass[i]);
                    } else {
                        css.push(ass[i]);
                    }
                };
            });
            if (js.length > 0) {
                mix.combine(js, folder.dist_assets + "/libs/" + name + "/" + name + ".min.js");
            }
            if (css.length > 0) {
                mix.combine(css, folder.dist_assets + "/libs/" + name + "/" + name + ".min.css");
            }
        });
    }
});

// mix.copyDirectory("./node_modules/tinymce", folder.dist_assets + "/libs/tinymce");
mix.copyDirectory("./node_modules/leaflet/dist/images", folder.dist_assets + "/libs/leaflet/images");
// mix.copyDirectory("./node_modules/bootstrap-editable/img", folder.dist_assets + "/libs/img");

// copy all fonts
var out = folder.dist_assets + "fonts";
mix.copyDirectory(folder.src + "fonts", out);

// copy all images
var out = folder.dist_assets + "images";
mix.copyDirectory(folder.src + "images", out);

// copy all language
var out = folder.dist_assets + "lang";
mix.copyDirectory(folder.src + "lang", out);

//copy all json
var out = folder.dist_assets + "json";
mix.copyDirectory(folder.src + "json", out);

mix.sass('resources/scss/bootstrap.scss', folder.dist_assets + "css").minify(folder.dist_assets + "css/bootstrap.css");
mix.sass('resources/scss/icons.scss', folder.dist_assets + "css").options({ processCssUrls: false }).minify(folder.dist_assets + "css/icons.css");
mix.sass('resources/scss/app.scss', folder.dist_assets + "css").options({ processCssUrls: false }).minify(folder.dist_assets + "css/app.css");


mix.webpackConfig({
    plugins: [
        new WebpackRTLPlugin()
    ],
    stats: {
        children: true,
    },
});


//copying demo pages related assets
var app_pages_assets = {
    js: [
        folder.src + "js/pages/calendar.init.js",
        folder.src + "js/pages/file-manager.init.js",
        folder.src + "js/pages/gallery.init.js",
        folder.src + "js/pages/kanbanboard.init.js",
        folder.src + "js/pages/two-step-verification.init.js",
        folder.src + "js/pages/apexcharts-area.init.js",
        folder.src + "js/pages/apexcharts-bar.init.js",
        folder.src + "js/pages/apexcharts-boxplot.init.js",
        folder.src + "js/pages/apexcharts-bubble.init.js",
        folder.src + "js/pages/apexcharts-column.init.js",
        folder.src + "js/pages/apexcharts-candlestick.init.js",
        folder.src + "js/pages/apexcharts-heatmap.init.js",
        folder.src + "js/pages/apexcharts-line.init.js",
        folder.src + "js/pages/apexcharts-mixed.init.js",
        folder.src + "js/pages/apexcharts-pie.init.js",
        folder.src + "js/pages/apexcharts-polararea.init.js",
        folder.src + "js/pages/apexcharts-radar.init.js",
        folder.src + "js/pages/apexcharts-radialbar.init.js",
        folder.src + "js/pages/apexcharts-scatter.init.js",
        folder.src + "js/pages/apexcharts-timeline.init.js",
        folder.src + "js/pages/apexcharts-treemap.init.js",
        folder.src + "js/pages/coming-soon.init.js",
        folder.src + "js/pages/user-settings.init.js",
        folder.src + "js/pages/ecommerce-choices.init.js",
        folder.src + "js/pages/ecommerce-customers.init.js",
        folder.src + "js/pages/ecommerce-orders.init.js",
        folder.src + "js/pages/ecommerce-product-detail.init.js",
        folder.src + "js/pages/ecommerce-shops.init.js",
        folder.src + "js/pages/email-editor.init.js",
        folder.src + "js/pages/lightbox.init.js",
        folder.src + "js/pages/notification.init.js",
        folder.src + "js/pages/range-sliders.init.js",
        folder.src + "js/pages/rating.init.js",
        folder.src + "js/pages/sweet-alerts.init.js",
        folder.src + "js/pages/swiper-slider.init.js",
        folder.src + "js/pages/form-advanced.init.js",
        folder.src + "js/pages/form-editor.init.js",
        folder.src + "js/pages/form-mask.init.js",
        folder.src + "js/pages/form-validation.init.js",
        folder.src + "js/pages/form-wizard.init.js",
        folder.src + "js/pages/fontawesome.init.js",
        folder.src + "js/pages/materialdesign.init.js",
        folder.src + "js/pages/dashboard.init.js",
        folder.src + "js/pages/gmaps.init.js",
        folder.src + "js/pages/leaflet-us-states.js",
        folder.src + "js/pages/leaflet-map.init.js",
        folder.src + "js/pages/vector-maps.init.js",
        folder.src + "js/pages/profile.init.js",
        //folder.src + "js/pages/pricing.init.js",
        folder.src + "js/pages/project-create.init.js",
        folder.src + "js/pages/gridjs.init.js",
        folder.src + "js/pages/timeline.init.js",
        folder.src + "js/pages/widgets.init.js",
        folder.src + "js/pages/invoice-list.init.js",
        folder.src + "js/pages/product-filter-range.init.js",

    ]
};


var out = folder.dist_assets + "js/";
lodash(app_pages_assets).forEach(function (assets, type) {
    for (let i = 0; i < assets.length; ++i) {
        mix.js(assets[i], out + "pages");
    };
});

mix.combine('resources/js/app.js', folder.dist_assets + "js/app.js");
mix.combine('resources/js/pages/pricing.init.js', folder.dist_assets + "js/pages/pricing.init.js");
mix.combine('./node_modules/bootstrap/dist/js/bootstrap.bundle.min.js', folder.dist_assets + "libs/bootstrap/bootstrap.bundle.min.js");
mix.combine('./node_modules/swiper/swiper-bundle.min.css', folder.dist_assets + "libs/swiper/swiper-bundle.min.css");
mix.combine('./node_modules/swiper/swiper-bundle.min.js', folder.dist_assets + "libs/swiper/swiper-bundle.min.js");
mix.combine('./node_modules/feather-icons/dist/feather.min.js', folder.dist_assets + "libs/feather-icons/feather.min.js");
mix.combine('./node_modules/jsvectormap/dist/maps/world-merc.js', folder.dist_assets + "libs/jsvectormap/maps/world-merc.js");
// mix.combine('./node_modules/jsvectormap/src/maps/us-merc-en.js', folder.dist_assets + "libs/jsvectormap/maps/us-merc-en.js");
// mix.combine('./node_modules/jsvectormap/src/maps/canada.js', folder.dist_assets + "libs/jsvectormap/maps/canada.js");
mix.combine('./node_modules/masonry-layout/dist/masonry.pkgd.min.js', folder.dist_assets + "libs/masonry-layout/masonry.pkgd.min.js");
mix.combine('./node_modules/rater-js/example/index.js', folder.dist_assets + "libs/rater-js/index.js");
mix.combine('./node_modules/alertifyjs/build/css/themes/default.min.css', folder.dist_assets + "libs/alertifyjs/default.min.css");
