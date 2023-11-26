import { resolve } from 'path'

export default {
    build: {
        rollupOptions: {
            input: {
                main: resolve(__dirname, 'index.html'),
                login: resolve(__dirname, 'main/index.html'),
                ...globEntries(path.resolve(__dirname, 'src', '*.css'))
            }
        }
    }
}

function globEntries(globPath) {
    const glob = require('glob');
    const entries = {};
    glob.sync(globPath).forEach((entry) => {
      const chunkName = path.basename(entry, path.extname(entry));
      entries[chunkName] = entry;
    });
    return entries;
  }