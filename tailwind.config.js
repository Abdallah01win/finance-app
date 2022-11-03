const defaultTheme = require("tailwindcss/defaultTheme");

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.vue",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Nunito", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'myDark': {
                    100: "#181818ff",
                    200: "#0f0f0fff",
                    300: "#0a0a0aff",
                },
                'myBlue': "#2f66eeff",
                'myGreen': "#1fbe6dff",
                'myRed': "#e50201ff",
                'myPurpel': "#d055d3ff",
                'myYellow': "#ffc35dff",
            },
        },
        
    },
    plugins: [require("@tailwindcss/forms")],
};

/*
$rich-black-fogra-39: #0a0a0aff;
$smoky-black: #0f0f0fff;
$eerie-black: #181818ff;
$bluetiful: #2f66eeff;
$medium-sea-green: #1fbe6dff; green
$vermilion: #e50201ff; red
$fuchsia-crayola: #d055d3ff; purple
$maximum-yellow-red: #ffc35dff; orangy

*/
