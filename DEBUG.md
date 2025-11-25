# 🔧 GUIDE DE DÉBOGAGE - CSS ne s'affiche pas

## ✅ CORRECTIONS APPLIQUÉES

1. **CSP supprimée temporairement** (bloquait peut-être le CSS)
2. **Chemins relatifs** (au lieu de `/css/` → `css/`)
3. **Permissions corrigées** (644 pour fichiers, 755 pour dossiers)

---

## 🧪 TEST RAPIDE

### 1. Ouvrir test.html
```bash
# Ouvrir dans le navigateur :
open test.html    # macOS
xdg-open test.html  # Linux
start test.html   # Windows
```

**Si tu vois du texte stylé (fond noir, titre orange)** → CSS OK ✅
**Si tu vois du texte brut (fond blanc, texte noir)** → Problème ❌

---

## ❌ PROBLÈMES COURANTS

### Problème 1 : Ouverture directe du fichier
**Symptôme** : URL commence par `file:///`

**Cause** : Tu ouvres le fichier HTML directement au lieu d'utiliser un serveur web

**Solution** : Utilise un serveur local

#### Option A : PHP built-in server (RECOMMANDÉ)
```bash
cd /home/user/soscompagnon
php -S localhost:8000

# Puis ouvre : http://localhost:8000/index.php
```

#### Option B : Python server
```bash
cd /home/user/soscompagnon
python3 -m http.server 8000

# Puis ouvre : http://localhost:8000/index.php
```

#### Option C : Node.js (http-server)
```bash
npm install -g http-server
cd /home/user/soscompagnon
http-server -p 8000

# Puis ouvre : http://localhost:8000/index.php
```

---

### Problème 2 : Chemins incorrects
**Symptôme** : Erreur 404 dans la console (F12)

**Vérifier dans la console** :
```
Failed to load resource: css/main.css (404)
```

**Solution** : Vérifier que la structure est correcte
```
soscompagnon/
├── index.php
├── css/
│   └── main.css
└── js/
    └── main.js
```

**Test** :
```bash
ls -la css/main.css js/main.js
# Doit afficher les deux fichiers
```

---

### Problème 3 : Permissions incorrectes
**Symptôme** : Erreur 403 Forbidden

**Vérifier** :
```bash
ls -la css/main.css
# Doit afficher : -rw-r--r-- (644)
```

**Corriger** :
```bash
chmod 644 css/main.css js/main.js index.php
chmod 755 css/ js/ img/ pwa/
```

---

### Problème 4 : Cache navigateur
**Symptôme** : Modifications CSS non visibles

**Solution** :
1. Ouvrir DevTools (F12)
2. Clic droit sur refresh → "Empty Cache and Hard Reload"
3. Ou : Ctrl+Shift+R (Windows/Linux) / Cmd+Shift+R (macOS)

---

### Problème 5 : .htaccess bloque le CSS
**Symptôme** : CSS bloqué sur serveur Apache

**Solution temporaire** :
```bash
mv .htaccess .htaccess.bak
# Tester
# Si ça marche, le problème vient du .htaccess
```

**Fix** : Modifier .htaccess ligne 6 :
```apache
# Commenter cette ligne :
# Options -Indexes
```

---

## 🔍 DIAGNOSTIC COMPLET

### Étape 1 : Vérifier les fichiers
```bash
./check-setup.sh
# Doit afficher : ✓ css/main.css
```

### Étape 2 : Vérifier le serveur web
```bash
# Démarrer PHP server
php -S localhost:8000

# Dans un autre terminal :
curl -I http://localhost:8000/css/main.css

# Doit afficher :
# HTTP/1.1 200 OK
# Content-Type: text/css
```

### Étape 3 : Console navigateur
1. Ouvrir index.php dans le navigateur
2. F12 → Console
3. Vérifier erreurs :

**Pas d'erreurs** → CSS chargé ✅
**404 Not Found** → Chemin incorrect ❌
**403 Forbidden** → Permissions ❌
**CORS error** → Serveur web requis ❌

### Étape 4 : Network tab
1. F12 → Network → Reload
2. Chercher `main.css`
3. Vérifier :
   - Status : 200 OK ✅
   - Type : text/css ✅
   - Size : ~40KB ✅

---

## 🚀 SOLUTION RAPIDE (EN CAS D'URGENCE)

Si rien ne marche, voici une version **avec CSS inline** :

```bash
# Créer index-inline.php avec CSS embarqué
cat css/main.css > /tmp/css-inline.txt

# Remplacer dans index.php :
# <link rel="stylesheet" href="css/main.css">
# Par :
# <style><?php include 'css/main.css'; ?></style>
```

Ou utiliser cette commande rapide :
```bash
sed -i 's|<link rel="stylesheet" href="css/main.css">|<style><?php readfile("css/main.css"); ?></style>|' index.php
```

⚠️ **Attention** : Solution temporaire uniquement ! Revenir aux fichiers externes après débogage.

---

## ✅ VÉRIFICATION FINALE

Une fois le problème résolu :

1. ✅ CSS s'affiche (fond noir, texte orange)
2. ✅ Console sans erreurs (F12)
3. ✅ Network → main.css → 200 OK
4. ✅ Animations fonctionnent (hover sur boutons)

---

## 📞 BESOIN D'AIDE ?

**Copie-colle ces informations** :

```bash
# Système
uname -a

# Structure fichiers
ls -la index.php css/main.css js/main.js

# Permissions
stat -c "%a %n" css/main.css js/main.js index.php

# Test serveur
php -S localhost:8000 &
curl -I http://localhost:8000/css/main.css
```

Envoie le résultat pour diagnostic !

---

## 🎯 CHECKLIST RAPIDE

- [ ] Serveur web lancé (pas file://)
- [ ] Fichiers présents (check-setup.sh)
- [ ] Permissions correctes (644/755)
- [ ] Console sans erreur (F12)
- [ ] Cache vidé (Ctrl+Shift+R)
- [ ] test.html fonctionne
- [ ] index.php fonctionne

**Tout coché ?** → CSS devrait fonctionner ! 🎉
