import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import vueDevTools from "vite-plugin-vue-devtools";
import vue from "@vitejs/plugin-vue";

export default defineConfig({
    server: {
        host: "0.0.0.0",
        port: 5173,
        strictPort: true,
        hmr: {
            host: "localhost",
        },
    },
    define: {
        __VUE_OPTIONS_API__: true,
        __VUE_PROD_DEVTOOLS__: true,
    },
    plugins: [
        vueDevTools(),
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),
        vue(),
    ],
});
