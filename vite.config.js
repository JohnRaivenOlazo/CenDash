import { defineConfig } from 'vite';
import { resolve } from 'path';

export default defineConfig({
  css: {
    preprocessorOptions: {
      scss: {
        // Specify the entry point for your Sass files
        additionalData: `@import "@/scss/main.scss";`,
      },
    },
  },
  build: {
    rollupOptions: {
      input: {
        main: resolve(__dirname, 'index.html'),
        login: resolve(__dirname, 'main/index.html'),
      },
    },
  },
});
