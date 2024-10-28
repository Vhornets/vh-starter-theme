import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";
import typography from "@tailwindcss/typography";

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: ["./**/*.{html,php}", "./blocks/src/**/*.js"],
    darkMode: "media",
    theme: {
        extend: {
            fontFamily: {
                sans: ["Sen", ...defaultTheme.fontFamily.sans],
            },
            screens: {
                sm: "640px",
                md: "768px",
                lg: "1024px",
                xl: "1280px",
                "2xl": "1440px",
                "3xl": "1920px",
            },
            colors: {},
        },
    },
    plugins: [forms, typography],
};
