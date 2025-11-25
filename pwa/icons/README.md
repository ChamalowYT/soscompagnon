# 📱 Icônes PWA requises

## Liste complète des icônes

Toutes les icônes doivent être au format **PNG** avec un **fond transparent** ou de couleur.

### iOS (Apple Touch Icons)
- icon-57.png (57x57px)
- icon-60.png (60x60px)
- icon-72.png (72x72px)
- icon-76.png (76x76px)
- icon-114.png (114x114px) - iPhone Retina
- icon-120.png (120x120px) - iPhone Retina
- icon-144.png (144x144px) - iPad Retina
- icon-152.png (152x152px) - iPad Retina
- icon-180.png (180x180px) - iPhone X/11/12/13/14

### Android / Desktop PWA
- icon-192.png (192x192px) - Android home screen
- icon-512.png (512x512px) - Android splash screen

### Optionnel
- icon-96.png (96x96px) - Shortcuts
- icon-128.png (128x128px)
- icon-256.png (256x256px)
- icon-384.png (384x384px)

## Comment générer ces icônes ?

### Méthode 1 : PWA Asset Generator (automatique)
```bash
npm install -g pwa-asset-generator

# Générer toutes les icônes à partir d'une seule image source
pwa-asset-generator logo-source.png ./pwa/icons \
  --icon-only \
  --favicon \
  --type png \
  --padding "10%"
```

### Méthode 2 : Outils en ligne
1. **[RealFaviconGenerator](https://realfavicongenerator.net/)**
   - Upload votre logo
   - Génère toutes les tailles
   - Télécharge un ZIP

2. **[PWA Builder](https://www.pwabuilder.com/)**
   - Upload votre logo
   - Génère manifest + icônes

3. **[Favicon.io](https://favicon.io/)**
   - Convertir logo en toutes tailles

### Méthode 3 : ImageMagick (ligne de commande)
```bash
# Installer ImageMagick
sudo apt-get install imagemagick

# Générer toutes les tailles
convert logo-source.png -resize 57x57 icon-57.png
convert logo-source.png -resize 60x60 icon-60.png
convert logo-source.png -resize 72x72 icon-72.png
convert logo-source.png -resize 76x76 icon-76.png
convert logo-source.png -resize 114x114 icon-114.png
convert logo-source.png -resize 120x120 icon-120.png
convert logo-source.png -resize 144x144 icon-144.png
convert logo-source.png -resize 152x152 icon-152.png
convert logo-source.png -resize 180x180 icon-180.png
convert logo-source.png -resize 192x192 icon-192.png
convert logo-source.png -resize 512x512 icon-512.png
```

### Méthode 4 : Script automatique (inclus)
```bash
# Utiliser le script generate-icons.sh (si vous avez ImageMagick)
chmod +x ../generate-icons.sh
./generate-icons.sh logo-source.png
```

## Recommandations design

### Logo source
- **Taille minimale**: 1024x1024px
- **Format**: PNG avec transparence
- **Contenu**: Logo centré avec padding 10-15%
- **Couleurs**: Contraste élevé (lisible sur fond blanc ET noir)

### Maskable Icons (Android 13+)
Pour Android 13+, créer des versions "maskable":
- Icône centrée dans un cercle
- Safe zone: 80% du centre
- Éviter texte aux bords

### Test
Une fois les icônes créées, tester:
1. Chrome DevTools → Application → Manifest
2. Lighthouse → PWA check
3. Installation sur mobile réel

## Statut actuel
- ❌ Icônes manquantes
- ⏳ À générer à partir du logo SOS Compagnon

## Structure finale
```
pwa/icons/
├── icon-57.png
├── icon-60.png
├── icon-72.png
├── icon-76.png
├── icon-114.png
├── icon-120.png
├── icon-144.png
├── icon-152.png
├── icon-180.png
├── icon-192.png
└── icon-512.png
```
