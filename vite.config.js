import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/shared.css',
                'resources/css/pages/dashboard.css',
                'resources/css/pages/profile.css',
                'resources/css/pages/welcome.css',
                'resources/css/pages/login.css',
                'resources/css/pages/register.css',
                'resources/css/pages/borrowings-index.css',
                'resources/css/pages/borrowings-create.css',
                'resources/css/pages/borrowings-show.css',
                'resources/css/pages/categories-index.css',
                'resources/css/pages/categories-create.css',
                'resources/css/pages/categories-edit.css',
                'resources/css/pages/equipment-index.css',
                'resources/css/pages/equipment-create.css',
                'resources/css/pages/equipment-edit.css',
                'resources/css/pages/equipment-show.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
