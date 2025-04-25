import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react';

export default defineConfig({
    plugins: [
        laravel({
            input: 'resources/js/app.jsx',
            refresh: true,  // Включено по умолчанию, но лучше явно указать
        }),
        react(),
    ],
    server: {
        host: '0.0.0.0',  // 🔥 Важно для работы в Docker!
        port: 3000,
        strictPort: true,  // Не пытаться использовать другой порт, если 3000 занят
        hmr: {
            host: 'localhost',  // 🔥 Для HMR в Docker
            clientPort: 3000,   // 🔥 Порт, который использует браузер
        },
        watch: {
            usePolling: true,   // 🔥 Принудительно проверять изменения (работает в Docker)
            interval: 1000,     // Проверять изменения каждую секунду
        },
    },
});