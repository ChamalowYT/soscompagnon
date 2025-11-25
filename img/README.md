# 📸 Images requises pour SOS Compagnon

## Logo
- **logo.png** (obligatoire)
  - Format: PNG
  - Taille: 512x512px minimum
  - Transparent background
  - Usage: Favicon, footer, PWA

## SEO / Social Media

### Open Graph (Facebook, LinkedIn)
- **og-image.jpg**
  - Format: JPG
  - Taille: 1200x630px
  - Ratio: 1.91:1
  - Contenu: Logo + titre "SOS Compagnon - Recherche d'Animaux Perdus"
  - Texte lisible même en miniature

### Twitter Card
- **twitter-card.jpg**
  - Format: JPG
  - Taille: 1200x600px
  - Ratio: 2:1
  - Contenu: Similaire à og-image mais ratio différent

## Bannière
- **bannière.png** (déjà présente dans votre code)
  - Format: PNG ou JPG
  - Taille: 1920x1080px recommandé
  - Usage: Background du hero section

## Recommandations

### Optimisation
1. Compresser avec TinyPNG ou Squoosh
2. Créer versions WebP (30-50% plus léger)
   ```bash
   cwebp -q 80 logo.png -o logo.webp
   cwebp -q 85 og-image.jpg -o og-image.webp
   ```

### Outils
- [Canva](https://canva.com) - Créer les images
- [TinyPNG](https://tinypng.com) - Compression
- [Squoosh](https://squoosh.app) - WebP conversion
- [Meta Tags](https://metatags.io) - Preview social cards

### Structure finale
```
img/
├── logo.png (512x512px, transparent)
├── logo.webp
├── og-image.jpg (1200x630px)
├── og-image.webp
├── twitter-card.jpg (1200x600px)
├── twitter-card.webp
├── bannière.png (1920x1080px)
└── bannière.webp
```
