#!/bin/bash

# Theme directory name
THEME_NAME="twentytwentyfive-child"
THEME_PATH="wp-content/themes/$THEME_NAME"

# Archive name
ARCHIVE_NAME="${THEME_NAME}.zip"

echo "Creating archive $ARCHIVE_NAME..."

# Check if theme directory exists
if [ ! -d "$THEME_PATH" ]; then
    echo "Error: Directory $THEME_PATH not found."
    exit 1
fi

# Remove old archive if exists
if [ -f "$ARCHIVE_NAME" ]; then
    rm "$ARCHIVE_NAME"
fi

# Navigate to themes directory to avoid including the full path in the zip
cd wp-content/themes/

# Create zip archive
# -r: recursive
# -x: exclude patterns
zip -r "../../$ARCHIVE_NAME" "$THEME_NAME" -x \
    "$THEME_NAME/node_modules/*" \
    "$THEME_NAME/.git/*" \
    "$THEME_NAME/.gitignore" \
    "$THEME_NAME/package-lock.json" \
    "$THEME_NAME/package.json" \
    "$THEME_NAME/tailwind.config.js" \
    "$THEME_NAME/postcss.config.js" \
    "$THEME_NAME/webpack.config.js" \
    "$THEME_NAME/assets/css/input.css" \
    "$THEME_NAME/src/*" \
    "$THEME_NAME/dev-tools/*" \
    "$THEME_NAME/resources/*" \
    "$THEME_NAME/theme-review.md" \
    "*.DS_Store"

cd ../../

if [ -f "$ARCHIVE_NAME" ]; then
    echo "Archive created successfully: $ARCHIVE_NAME"
else
    echo "Failed to create archive."
    exit 1
fi
