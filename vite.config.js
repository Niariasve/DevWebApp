import { defineConfig } from "vite";
import path from 'path';
import fs from 'fs';

function getEntries() {
  const dir = path.resolve(__dirname, 'src/js/pages')
  const files = fs.readdirSync(dir)

  const entries = {}

  files.forEach(file => {
    if (file.endsWith('.js')) {
      const name = file.replace('.js', '')
      entries[name] = path.join(dir, file)
    }
  })

  // incluir app global
  entries['app'] = path.resolve(__dirname, 'src/js/app.js')

  return entries
}

export default defineConfig({
  publicDir: false,
  base: '/build/',

  css: {
    preprocessorOptions: {
      scss: {
        loadPaths: ['src/scss']
      }
    }
  },

  build: {
    outDir: 'public/build',
    emptyOutDir: false,
    sourcemap: true,

    rollupOptions: {
      input: getEntries(),

      output: {
        entryFileNames: (chunk) => {
          // app global
          if (chunk.name === 'app') {
            return 'js/[name].min.js'
          }

          // scripts de páginas
          return 'js/pages/[name].min.js'
        },
        chunkFileNames: 'js/chunks/[name].js',
        assetFileNames: (asset) => {
          const names = asset.names || [];

          const isCss = names.some(n => n.endsWith('.css'));

          if (isCss) {
            return 'css/app.css';
          }

          return 'assets/[name][extname]'
        }
      }
    }
  }
})