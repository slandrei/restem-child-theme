const { execSync } = require('child_process');
const path = require('path');
const fs = require('fs');

const slug = process.argv[2];

if (!slug) {
    console.error('Please provide a block name: npm run create my-block-name');
    process.exit(1);
}

// Define the target directory
const targetDir = path.join(__dirname, '..', 'src', 'blocks');

// Create the directory if it doesn't exist yet
if (!fs.existsSync(targetDir)){
    fs.mkdirSync(targetDir, { recursive: true });
}

// Run the command from within the target directory
// We use --no-plugin because we are creating the block files directly
const command = `npx @wordpress/create-block@latest ${slug} \
    --namespace restem \
    --short-description "Display restaurant product categories." \
    --category theme \
    --no-plugin`;

try {
    execSync(command, {
        cwd: targetDir, // This sets the execution path to src/blocks
        stdio: 'inherit'
    });
} catch (error) {
    // Error handled by inherit
}