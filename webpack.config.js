import path from 'path';
import fs from 'fs';
import { fileURLToPath } from 'url';
import defaultConfig from '@wordpress/scripts/config/webpack.config.js';
import CopyWebpackPlugin from 'copy-webpack-plugin';

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

const blocksPath = path.resolve(__dirname, 'src/blocks');
const blockDirs = fs.readdirSync(blocksPath).filter(dir => 
    fs.statSync(path.join(blocksPath, dir)).isDirectory() && 
    fs.existsSync(path.join(blocksPath, dir, 'block.json'))
);

const entry = {};
blockDirs.forEach(dir => {
    entry[`blocks/${dir}/index`] = `./src/blocks/${dir}/index.js`;
    if (fs.existsSync(path.join(blocksPath, dir, 'view.js'))) {
        entry[`blocks/${dir}/view`] = `./src/blocks/${dir}/view.js`;
    }
});

export default {
    ...defaultConfig,
    entry,
    output: {
        ...defaultConfig.output,
        path: path.resolve(__dirname, 'build'),
    },
    plugins: [
        ...defaultConfig.plugins.filter(plugin => plugin.constructor.name !== 'CopyWebpackPlugin'),
        new CopyWebpackPlugin({
            patterns: blockDirs.map(dir => ({
                from: `src/blocks/${dir}/block.json`,
                to: `blocks/${dir}/block.json`,
            })),
        }),
    ],
};