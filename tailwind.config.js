import { plugin } from 'postcss';

/** @type {import('tailwindcss').config} */
export default {
    content: [
        "./resources/**/*.blade.php" ,
        "./resources/**/*.js" ,
        "./resources/**/*.vue" ,
    ] ,
    theme: {
        extend: {},
    }, 
    plugins: [] ,
}