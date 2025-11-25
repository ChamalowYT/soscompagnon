#!/bin/bash

# SOS COMPAGNON - Icon Generator Script
# Génère toutes les icônes PWA à partir d'un logo source

if [ $# -eq 0 ]; then
  echo "❌ Usage: $0 <logo-source.png>"
  echo ""
  echo "Exemple:"
  echo "  $0 logo.png"
  echo ""
  exit 1
fi

SOURCE=$1

if [ ! -f "$SOURCE" ]; then
  echo "❌ Erreur: Fichier '$SOURCE' introuvable"
  exit 1
fi

# Check if ImageMagick is installed
if ! command -v convert &> /dev/null; then
  echo "❌ ImageMagick n'est pas installé"
  echo ""
  echo "Installation:"
  echo "  Ubuntu/Debian: sudo apt-get install imagemagick"
  echo "  macOS: brew install imagemagick"
  echo "  Windows: https://imagemagick.org/script/download.php"
  echo ""
  exit 1
fi

echo "🎨 Génération des icônes PWA..."
echo "Source: $SOURCE"
echo ""

# Create directories
mkdir -p pwa/icons img

# Array of sizes
declare -a SIZES=(
  "57"
  "60"
  "72"
  "76"
  "96"
  "114"
  "120"
  "144"
  "152"
  "180"
  "192"
  "512"
)

# Generate icons
for SIZE in "${SIZES[@]}"; do
  OUTPUT="pwa/icons/icon-${SIZE}.png"
  echo "Génération: ${OUTPUT} (${SIZE}x${SIZE})"

  convert "$SOURCE" \
    -resize "${SIZE}x${SIZE}" \
    -background none \
    -gravity center \
    -extent "${SIZE}x${SIZE}" \
    "$OUTPUT"

  if [ $? -eq 0 ]; then
    echo "✓ ${OUTPUT}"
  else
    echo "✗ Erreur lors de la création de ${OUTPUT}"
  fi
done

# Copy to img directory
echo ""
echo "📁 Copie du logo principal..."
convert "$SOURCE" -resize 512x512 img/logo.png
echo "✓ img/logo.png"

echo ""
echo "✅ Terminé !"
echo ""
echo "📋 Icônes générées:"
ls -lh pwa/icons/icon-*.png
echo ""
echo "🚀 Prochaines étapes:"
echo "1. Vérifier les icônes générées"
echo "2. Créer og-image.jpg (1200x630px) dans img/"
echo "3. Créer twitter-card.jpg (1200x600px) dans img/"
echo "4. Tester avec: ./check-setup.sh"
echo ""
