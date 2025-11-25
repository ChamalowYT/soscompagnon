#!/bin/bash

# SOS COMPAGNON - Setup Verification Script
# This script checks if all required files are present

echo "🔍 Vérification de l'installation SOS Compagnon..."
echo ""

# Colors
GREEN='\033[0;32m'
RED='\033[0;31m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

errors=0
warnings=0

# Function to check file
check_file() {
  if [ -f "$1" ]; then
    echo -e "${GREEN}✓${NC} $1"
  else
    echo -e "${RED}✗${NC} $1 (MANQUANT)"
    ((errors++))
  fi
}

# Function to check directory
check_dir() {
  if [ -d "$1" ]; then
    echo -e "${GREEN}✓${NC} $1/"
  else
    echo -e "${RED}✗${NC} $1/ (MANQUANT)"
    ((errors++))
  fi
}

# Function to check optional file
check_optional() {
  if [ -f "$1" ]; then
    echo -e "${GREEN}✓${NC} $1"
  else
    echo -e "${YELLOW}⚠${NC} $1 (recommandé)"
    ((warnings++))
  fi
}

echo "📁 Fichiers principaux:"
check_file "index.php"
check_file "manifest.json"
check_file "sw.js"
check_file ".htaccess"
check_file "404.php"
check_file "500.php"

echo ""
echo "📂 Dossiers:"
check_dir "css"
check_dir "js"
check_dir "img"
check_dir "pwa/icons"

echo ""
echo "🎨 Assets:"
check_file "css/main.css"
check_file "js/main.js"
check_file "img/logo.png"

echo ""
echo "📱 PWA Icons:"
check_file "pwa/icons/icon-57.png"
check_file "pwa/icons/icon-60.png"
check_file "pwa/icons/icon-72.png"
check_file "pwa/icons/icon-76.png"
check_file "pwa/icons/icon-114.png"
check_file "pwa/icons/icon-120.png"
check_file "pwa/icons/icon-144.png"
check_file "pwa/icons/icon-152.png"
check_file "pwa/icons/icon-180.png"
check_file "pwa/icons/icon-192.png"
check_file "pwa/icons/icon-512.png"

echo ""
echo "🔍 SEO Images (optionnel):"
check_optional "img/og-image.jpg"
check_optional "img/twitter-card.jpg"

echo ""
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"

if [ $errors -eq 0 ]; then
  echo -e "${GREEN}✅ Installation complète !${NC}"
  if [ $warnings -gt 0 ]; then
    echo -e "${YELLOW}⚠ $warnings avertissement(s)${NC}"
    echo ""
    echo "💡 Pour améliorer le SEO, créez:"
    echo "   - img/og-image.jpg (1200x630px)"
    echo "   - img/twitter-card.jpg (1200x600px)"
  fi
else
  echo -e "${RED}❌ $errors fichier(s) manquant(s)${NC}"
  exit 1
fi

echo ""
echo "🚀 Prochaines étapes:"
echo "1. Uploader tous les fichiers sur le serveur"
echo "2. Vérifier les permissions (chmod 644 pour fichiers, 755 pour dossiers)"
echo "3. Tester le site: https://soscompagnon.fr/"
echo "4. Tester PWA: Chrome DevTools → Application"
echo "5. Tester SEO: PageSpeed Insights"
echo ""
