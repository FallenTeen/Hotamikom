import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
                Poppins: ["Poppins", ...defaultTheme.fontFamily.sans],
                Dmserif: ['"DM Serif Text"', ...defaultTheme.fontFamily.serif],
                righteous: ['"Righteous"', "cursive"],
            },
            colors: {
                maincolor: "#8ecae6",
                secondarycolor: "#219ebc",
                oren: "#fb8500",
            },
        },
    },

    plugins: [forms, require("@tailwindcss/typography")],
};
