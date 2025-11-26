<?php
declare(strict_types=1);
header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <!-- Security & Performance -->
  <meta name="referrer" content="strict-origin-when-cross-origin">

  <!-- Primary Meta Tags -->
  <title>Mur des Souvenirs – SOS Compagnon</title>
  <meta name="title" content="Mur des Souvenirs – SOS Compagnon">
  <meta name="description" content="Jardin du souvenir – allumez une pensée en mémoire de votre compagnon.">
  <meta name="keywords" content="mémoire animaux, hommage animaux, souvenir compagnon, animaux décédés, memorial animaux">
  <meta name="author" content="SOS Compagnon">
  <meta name="robots" content="index, follow">
  <link rel="canonical" href="https://soscompagnon.fr/souvenir">

  <!-- Open Graph / Facebook -->
  <meta property="og:type" content="website">
  <meta property="og:url" content="https://soscompagnon.fr/souvenir">
  <meta property="og:title" content="Mur des Souvenirs – SOS Compagnon">
  <meta property="og:description" content="Jardin du souvenir – allumez une pensée en mémoire de votre compagnon disparu.">
  <meta property="og:image" content="https://soscompagnon.fr/img/og-image.jpg">
  <meta property="og:locale" content="fr_FR">

  <!-- Twitter Card -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:url" content="https://soscompagnon.fr/souvenir">
  <meta name="twitter:title" content="Mur des Souvenirs – SOS Compagnon">
  <meta name="twitter:description" content="Jardin du souvenir – allumez une pensée en mémoire de votre compagnon.">
  <meta name="twitter:image" content="https://soscompagnon.fr/img/twitter-card.jpg">

  <!-- Theme Color for Mobile -->
  <meta name="theme-color" content="#EF5D1C">

  <!-- Favicon -->
  <link rel="icon" type="image/png" href="img/logo.png">
  <link rel="shortcut icon" href="img/logo.png">

  <!-- Fonts - Preconnect for performance -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;900&display=swap" rel="stylesheet">

  <!-- Preload critical assets -->
  <link rel="preload" href="css/main.css" as="style">
  <link rel="preload" href="css/souvenir.css" as="style">
  <link rel="preload" href="js/main.js" as="script">
  <link rel="preload" href="js/souvenir.js" as="script">

  <!-- Stylesheets -->
  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="css/souvenir.css">

  <!-- Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-VR0Y2DL0XZ"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'G-VR0Y2DL0XZ');
  </script>
</head>
<body>

<!-- Arc-en-ciel -->
<svg class="rainbow-arc" viewBox="0 0 1200 600" aria-hidden="true">
  <defs>
    <linearGradient id="rbw" x1="0%" x2="0%" y1="0%" y2="100%">
      <stop offset="0%" stop-color="#FF4B4B"/>
      <stop offset="16%" stop-color="#FF7A3C"/>
      <stop offset="33%" stop-color="#FFD24A"/>
      <stop offset="50%" stop-color="#78E37E"/>
      <stop offset="66%" stop-color="#55B7FF"/>
      <stop offset="83%" stop-color="#7C5CFF"/>
      <stop offset="100%" stop-color="#B85CFF"/>
    </linearGradient>
  </defs>
  <path d="M80,560 A520,520 0 0 1 1120,560" fill="none" stroke="url(#rbw)" stroke-width="40" opacity="1"/>
</svg>

<!-- Navigation -->
<nav class="nav" id="mainNav">
  <div class="nav-inner">
    <a class="brand" href="/">SOS COMPAGNON</a>
    <button class="mobile-trigger" id="mobileTrigger" aria-label="Menu" aria-expanded="false">
      <span></span>
      <span></span>
      <span></span>
    </button>
    <ul class="nav-links" id="navLinks">
      <li><a href="/">Accueil</a></li>
      <li><a href="/services">Services</a></li>
      <li><a href="/animaux">Animaux</a></li>
      <li><a href="/carte">Carte</a></li>
      <li><a href="/souvenir" aria-current="page">Mémoire 🕊️</a></li>
      <li><a href="/contact">Contact</a></li>
      <li class="nav-cta"><a href="tel:+33781500855">📞 Appeler</a></li>
    </ul>
  </div>
  <div class="nav-backdrop" id="navBackdrop"></div>
</nav>

<!-- Hero -->
<section class="hero">
  <div class="chip">✨ Jardin du souvenir</div>
  <h1>Mur du SOUVENIR</h1>
  <p class="sub">Un espace lumineux et apaisant pour honorer nos compagnons disparus</p>
</section>

<!-- Contenu -->
<div class="wrap">
  <!-- Filtres -->
  <div class="controls" id="filters">
    <div class="pill" data-species="all" data-active="true">✨ Toutes pensées</div>
    <div class="pill" data-species="chat">🐱 Chats</div>
    <div class="pill" data-species="chien">🐶 Chiens</div>
    <div class="pill" data-species="nac">🐾 NAC</div>
  </div>

  <!-- Grille -->
  <div class="grid" id="grid"></div>
  <div id="empty">Aucune pensée pour ce filtre</div>
</div>

<!-- CTA Floating Button -->
<div class="fab">
  <button class="btn" id="openDlg">✨ Allumer</button>
</div>

<!-- Dialog for adding tribute -->
<dialog id="dlg">
  <div class="dlg-head">
    <div>Allumer une pensée</div>
    <button class="btn-light" id="closeDlg">Fermer</button>
  </div>
  <form class="form" id="form" enctype="multipart/form-data">
    <div class="field">
      <label for="name">Prénom de l'animal *</label>
      <input id="name" name="name" class="input" type="text" maxlength="30" placeholder="Ex : Nino" required>
    </div>
    <div class="field">
      <label for="species">Espèce *</label>
      <select id="species" name="species" required>
        <option value="chat">Chat</option>
        <option value="chien">Chien</option>
        <option value="nac">NAC</option>
      </select>
    </div>
    <div class="field">
      <label for="symbol">Symbole</label>
      <select id="symbol" name="symbol">
        <option value="🐾">🐾 Patte</option>
        <option value="🕊️">🕊️ Colombe</option>
        <option value="✨">✨ Étoile</option>
        <option value="🌈">🌈 Arc-en-ciel</option>
        <option value="💐">💐 Fleurs</option>
        <option value="🕯️" selected>🕯️ Bougie</option>
        <option value="❤️">❤️ Cœur</option>
      </select>
    </div>
    <div class="field row-2">
      <label for="message">Votre pensée *</label>
      <textarea id="message" name="message" maxlength="220" placeholder="Un petit mot d'amour…" required></textarea>
      <div style="font-size:0.75rem;color:rgba(255,255,255,0.5);margin-top:3px"><span id="count">0</span>/220</div>
    </div>
    <div class="field row-2">
      <label>Photo *</label>
      <div class="drop" id="drop">
        <div>Cliquez ou déposez une image</div>
        <input id="photo" type="file" name="photo" accept="image/*" required style="display:none">
        <div class="preview" id="preview" style="display:none">
          <img id="imgPrev" alt="Aperçu">
          <span id="fname"></span>
        </div>
      </div>
      <div style="font-size:0.75rem;color:rgba(255,255,255,0.5);margin-top:5px">
        ℹ️ Votre pensée sera affichée après validation
      </div>
    </div>
    <div class="actions row-2">
      <button type="button" class="btn-light" id="cancel">Annuler</button>
      <button type="submit" class="btn" id="submitBtn">Allumer</button>
    </div>
  </form>
</dialog>

<!-- Modal for viewing tribute -->
<div class="modal" id="modal">
  <div class="modal-card">
    <div class="modal-head">
      <div class="modal-title" id="modalTitle">—</div>
      <button class="close-x" id="closeModal" aria-label="Fermer">×</button>
    </div>
    <div class="modal-body">
      <div class="modal-photo">
        <img id="modalImg" alt="">
        <div class="candle modal-candle">
          <div class="flame"></div>
          <div class="wick"></div>
          <div class="wax"></div>
        </div>
      </div>
      <div class="modal-info">
        <div class="modal-msg" id="modalMsg"></div>
        <div class="modal-meta" id="modalMeta"></div>
      </div>
    </div>
  </div>
</div>

<!-- Toast -->
<div class="toast" id="toast"></div>

<!-- Footer -->
<footer class="footer">
  <div class="footer-content">
    <div class="footer-main">
      <div class="footer-brand">
        <div class="brand">SOS COMPAGNON</div>
        <p>Service professionnel de recherche d'animaux perdus</p>
      </div>
      <div class="footer-links">
        <div class="footer-col">
          <h4>Contact</h4>
          <a href="tel:+33781500855">📞 07 81 50 08 55</a>
          <a href="mailto:contact@soscompagnon.fr">✉️ contact@soscompagnon.fr</a>
        </div>
        <div class="footer-col">
          <h4>Navigation</h4>
          <a href="/">Accueil</a>
          <a href="/services">Services</a>
          <a href="/animaux">Animaux</a>
          <a href="/carte">Carte</a>
          <a href="/souvenir">Mémoire 🕊️</a>
          <a href="/contact">Contact</a>
        </div>
        <div class="footer-col">
          <h4>Réseaux sociaux</h4>
          <a href="https://facebook.com/chamsteam" target="_blank" rel="noopener">Facebook</a>
          <a href="https://instagram.com/soscompagnon" target="_blank" rel="noopener">Instagram</a>
        </div>
      </div>
    </div>
    <div class="footer-bottom">
      <p>© <?php echo date('Y'); ?> SOS Compagnon • SIRET : 92894225900013 • Tous droits réservés</p>
      <p>Site créé par <strong>KYLIAN EBERLE</strong></p>
    </div>
  </div>
</footer>

<!-- Scripts -->
<script src="js/main.js"></script>
<script src="js/souvenir.js"></script>

</body>
</html>
