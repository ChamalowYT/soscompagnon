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
  <meta http-equiv="Content-Security-Policy" content="default-src 'self'; script-src 'self' https://www.googletagmanager.com; style-src 'self' 'unsafe-inline' https://fonts.googleapis.com; font-src 'self' https://fonts.gstatic.com; img-src 'self' data: https:; connect-src 'self' https://www.google-analytics.com; upgrade-insecure-requests;">
  <meta name="referrer" content="strict-origin-when-cross-origin">

  <!-- Primary Meta Tags -->
  <title>SOS Compagnon - Recherche d'Animaux Perdus | Services Professionnels</title>
  <meta name="title" content="SOS Compagnon - Recherche d'Animaux Perdus | Services Professionnels">
  <meta name="description" content="Service professionnel de recherche d'animaux perdus : affiches, enquêtes de voisinage, livraisons d'articles animaliers. Votre compagnon, notre priorité. Disponible 7j/7.">
  <meta name="keywords" content="animaux perdus, recherche animaux, chien perdu, chat perdu, affiches animaux, enquête voisinage, livraison croquettes, SOS Compagnon">
  <meta name="author" content="SOS Compagnon">
  <meta name="robots" content="index, follow">
  <link rel="canonical" href="https://soscompagnon.fr/">

  <!-- Open Graph / Facebook -->
  <meta property="og:type" content="website">
  <meta property="og:url" content="https://soscompagnon.fr/">
  <meta property="og:title" content="SOS Compagnon - Recherche d'Animaux Perdus">
  <meta property="og:description" content="Service professionnel de recherche d'animaux perdus, affiches, enquêtes de voisinage et livraisons d'articles animaliers. Votre compagnon, notre priorité.">
  <meta property="og:image" content="https://soscompagnon.fr/img/og-image.jpg">
  <meta property="og:image:width" content="1200">
  <meta property="og:image:height" content="630">
  <meta property="og:locale" content="fr_FR">
  <meta property="og:site_name" content="SOS Compagnon">

  <!-- Twitter Card -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:url" content="https://soscompagnon.fr/">
  <meta name="twitter:title" content="SOS Compagnon - Recherche d'Animaux Perdus">
  <meta name="twitter:description" content="Service professionnel de recherche d'animaux perdus, affiches, enquêtes de voisinage et livraisons d'articles animaliers.">
  <meta name="twitter:image" content="https://soscompagnon.fr/img/twitter-card.jpg">

  <!-- PWA Manifest & Icons -->
  <link rel="manifest" href="/manifest.json">
  <meta name="theme-color" content="#EF5D1C">
  <meta name="mobile-web-app-capable" content="yes">
  <meta name="application-name" content="SOS Compagnon">

  <!-- iOS PWA Meta Tags -->
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
  <meta name="apple-mobile-web-app-title" content="SOS Compagnon">

  <!-- iOS Icons -->
  <link rel="apple-touch-icon" href="/pwa/icons/icon-180.png">
  <link rel="apple-touch-icon" sizes="57x57" href="/pwa/icons/icon-57.png">
  <link rel="apple-touch-icon" sizes="60x60" href="/pwa/icons/icon-60.png">
  <link rel="apple-touch-icon" sizes="72x72" href="/pwa/icons/icon-72.png">
  <link rel="apple-touch-icon" sizes="76x76" href="/pwa/icons/icon-76.png">
  <link rel="apple-touch-icon" sizes="114x114" href="/pwa/icons/icon-114.png">
  <link rel="apple-touch-icon" sizes="120x120" href="/pwa/icons/icon-120.png">
  <link rel="apple-touch-icon" sizes="144x144" href="/pwa/icons/icon-144.png">
  <link rel="apple-touch-icon" sizes="152x152" href="/pwa/icons/icon-152.png">
  <link rel="apple-touch-icon" sizes="180x180" href="/pwa/icons/icon-180.png">

  <!-- Favicon -->
  <link rel="icon" type="image/png" sizes="32x32" href="/img/logo.png">
  <link rel="shortcut icon" href="/img/logo.png">

  <!-- Fonts - Preconnect for performance -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

  <!-- Preload critical assets -->
  <link rel="preload" href="/css/main.css" as="style">
  <link rel="preload" href="/js/main.js" as="script">

  <!-- Stylesheet -->
  <link rel="stylesheet" href="/css/main.css">

  <!-- Schema.org structured data -->
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "LocalBusiness",
    "name": "SOS Compagnon",
    "description": "Service professionnel de recherche d'animaux perdus, création d'affiches, enquêtes de voisinage et livraisons d'articles animaliers",
    "url": "https://soscompagnon.fr",
    "telephone": "+33781500855",
    "email": "contact@soscompagnon.fr",
    "address": {
      "@type": "PostalAddress",
      "addressCountry": "FR",
      "addressLocality": "France"
    },
    "geo": {
      "@type": "GeoCoordinates",
      "latitude": "48.8566",
      "longitude": "2.3522"
    },
    "openingHoursSpecification": {
      "@type": "OpeningHoursSpecification",
      "dayOfWeek": [
        "Monday",
        "Tuesday",
        "Wednesday",
        "Thursday",
        "Friday",
        "Saturday",
        "Sunday"
      ],
      "opens": "00:00",
      "closes": "23:59"
    },
    "priceRange": "€€",
    "image": "https://soscompagnon.fr/img/logo.png",
    "logo": "https://soscompagnon.fr/img/logo.png",
    "sameAs": [
      "https://facebook.com/chamsteam",
      "https://instagram.com/soscompagnon"
    ]
  }
  </script>

  <!-- Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-VR0Y2DL0XZ"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'G-VR0Y2DL0XZ', {
      'anonymize_ip': true,
      'cookie_flags': 'SameSite=None;Secure'
    });
  </script>
</head>
<body>

<!-- Skip Navigation for Accessibility -->
<a href="#main-content" class="skip-link">Aller au contenu principal</a>

<!-- PROMO BANNER -->
<div class="promo-banner" id="promoBanner" role="banner" aria-label="Bannière promotionnelle">
  <div class="promo-banner-content">
    <span class="promo-banner-icon" aria-hidden="true">🎉</span>
    <span class="promo-banner-text">
      OFFRE DE LANCEMENT : Livraison à domicile <span class="highlight">9,99€</span> au lieu de 14,99€ !
    </span>
    <a href="services#livraison" class="promo-banner-cta">En profiter →</a>
    <button class="promo-banner-close" id="closeBanner" aria-label="Fermer la bannière" type="button">×</button>
  </div>
</div>

<!-- NAVIGATION -->
<nav class="nav" id="mainNav" role="navigation" aria-label="Navigation principale">
  <div class="nav-inner">
    <a class="brand" href="https://soscompagnon.fr/" aria-label="Retour à l'accueil SOS Compagnon">SOS COMPAGNON</a>

    <button class="mobile-trigger" id="mobileTrigger" aria-label="Menu de navigation" type="button" aria-expanded="false" aria-controls="navLinks">
      <svg class="burger-svg" viewBox="0 0 24 24" width="28" height="28" aria-hidden="true">
        <g stroke="white" stroke-linecap="round" stroke-width="2" fill="none">
          <line class="l1" x1="3" y1="6" x2="21" y2="6"/>
          <line class="l2" x1="3" y1="12" x2="21" y2="12"/>
          <line class="l3" x1="3" y1="18" x2="21" y2="18"/>
        </g>
      </svg>
    </button>

    <ul class="nav-links" id="navLinks" role="menubar">
      <li role="none"><a href="https://soscompagnon.fr/" role="menuitem">Accueil</a></li>
      <li role="none"><a href="services" role="menuitem">Services</a></li>
      <li role="none"><a href="animaux" role="menuitem">Animaux</a></li>
      <li role="none"><a href="carte" role="menuitem">Carte</a></li>
      <li role="none"><a href="souvenir" role="menuitem">Mémoire</a></li>
      <li role="none"><a href="contact" role="menuitem">Contact</a></li>
      <li class="nav-cta" role="none">
        <a href="tel:+33781500855" role="menuitem" onclick="trackEvent('Contact', 'Phone Click', 'Header CTA')">📞 Appeler</a>
      </li>
    </ul>
  </div>
  <div class="nav-backdrop" id="navBackdrop" aria-hidden="true"></div>
</nav>

<!-- HERO SECTION -->
<section class="hero" id="main-content">
  <div class="hero-inner">
    <div class="hero-content">
      <h1>
        Tous les services pour votre <span class="accent-text">compagnon</span>
      </h1>

      <p class="hero-subtitle">
        De la recherche d'animaux perdus à la livraison de produits essentiels,
        notre équipe vous accompagne au quotidien pour le bien-être de votre compagnon.
      </p>

      <div class="hero-cta">
        <div class="primary-actions">
          <a href="animaux" class="btn btn-primary" onclick="trackEvent('Engagement', 'View Animals Click', 'Hero CTA')">
            <span class="btn-icon" aria-hidden="true">🐶</span>
            <span>Consulter les animaux</span>
          </a>
          <a href="ajouter" class="btn btn-secondary" onclick="trackEvent('Engagement', 'Add Animal Click', 'Hero CTA')">
            <span class="btn-icon" aria-hidden="true">➕</span>
            <span>Signaler un animal gratuitement</span>
          </a>
        </div>

        <div class="secondary-actions">
          <button class="btn btn-ghost see-more-btn" onclick="toggleMore()" aria-expanded="false" aria-controls="moreMenu">
            <span class="btn-icon" aria-hidden="true">➕</span>
            <span>Voir plus</span>
          </button>

          <div id="moreMenu" class="more-menu" aria-hidden="true">
            <a href="carte" class="btn btn-ghost">
              <span class="btn-icon" aria-hidden="true">🗺️</span>
              <span>Carte interactive</span>
            </a>

            <a href="services" class="btn btn-ghost">
              <span class="btn-icon" aria-hidden="true">📋</span>
              <span>Nos services</span>
            </a>

            <a href="souvenir" class="btn btn-ghost">
              <span class="btn-icon" aria-hidden="true">🕊️</span>
              <span>En mémoire</span>
            </a>
          </div>
        </div>
      </div>

      <div class="hero-stats">
        <div class="stat-card animate-on-scroll">
          <span class="stat-number" id="kpi-total" aria-live="polite">—</span>
          <span class="stat-label">Animaux signalés</span>
        </div>
        <div class="stat-card animate-on-scroll">
          <span class="stat-number" id="kpi-perdus" aria-live="polite">—</span>
          <span class="stat-label">Recherches actives</span>
        </div>
        <div class="stat-card animate-on-scroll">
          <span class="stat-number" id="kpi-apercus" aria-live="polite">—</span>
          <span class="stat-label">Signalements</span>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- LOST PETS CAROUSEL -->
<section class="lost-pets-section animate-on-scroll" aria-labelledby="carousel-title">
  <div class="lost-pets-header">
    <h2 id="carousel-title">🔍 Aidez-nous à les retrouver</h2>
    <p>Ces compagnons attendent de rentrer chez eux. Chaque partage compte !</p>
  </div>

  <div class="carousel-container">
    <button class="carousel-nav carousel-nav-prev" id="carouselPrev" aria-label="Animal précédent">‹</button>
    <button class="carousel-nav carousel-nav-next" id="carouselNext" aria-label="Animal suivant">›</button>

    <div class="carousel-wrapper" id="carouselWrapper" role="region" aria-label="Carrousel des animaux perdus">
      <div class="carousel-track" id="carouselTrack">
        <div class="carousel-loading">Chargement des animaux perdus...</div>
      </div>
    </div>

    <div class="carousel-dots" id="carouselDots" role="tablist" aria-label="Navigation du carrousel"></div>
    <div class="carousel-hint" aria-hidden="true">💡 Glissez pour naviguer</div>
  </div>

  <div class="carousel-cta">
    <a href="animaux" class="btn btn-primary">
      <span class="btn-icon" aria-hidden="true">🐾</span>
      <span>Voir tous les animaux</span>
    </a>
  </div>
</section>

<!-- SERVICES SECTION -->
<section class="services" aria-labelledby="services-title">
  <div class="services-header animate-on-scroll">
    <h2 id="services-title">Nos Services Premium</h2>
    <p>Solutions professionnelles pour retrouver et prendre soin de vos compagnons</p>
  </div>

  <div class="services-grid">
    <article class="service-card">
      <div class="service-icon" aria-hidden="true">🔍</div>
      <h3>Recherche d'Animaux</h3>
      <p>
        Service complet incluant création d'affiches professionnelles,
        distribution massive en boîtes aux lettres, enquêtes de voisinage approfondies
        et rondes terrain régulières pour maximiser vos chances de retrouver votre compagnon.
      </p>
      <a href="services#recherche" class="btn btn-primary">Découvrir le service</a>
    </article>

    <article class="service-card">
      <div class="service-icon" aria-hidden="true">🛒</div>
      <h3>Courses & Livraison</h3>
      <p>
        Retrait et livraison à domicile de croquettes, litières, pâtées et tous
        accessoires animaliers. Service pratique et rapide pour les propriétaires
        occupés ou à mobilité réduite.
      </p>
      <a href="services#livraison" class="btn btn-primary">Commander maintenant</a>
    </article>
  </div>
</section>

<!-- FOOTER -->
<footer role="contentinfo">
  <div class="footer-content">
    <!-- Section À propos -->
    <div class="footer-section footer-about">
      <div class="footer-logo">SOS COMPAGNON</div>
      <p class="footer-description">
        Service professionnel de recherche d'animaux perdus et livraison
        d'articles animaliers. Nous mettons tout en œuvre pour réunir les
        familles avec leurs compagnons disparus.
      </p>
      <div class="social-links">
        <a href="https://facebook.com/chamsteam" target="_blank" rel="noopener noreferrer" class="social-link facebook" aria-label="Suivez-nous sur Facebook">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <path d="M24 12.073C24 5.405 18.627 0 12 0S0 5.405 0 12.073C0 18.1 4.388 23.094 10.125 24v-8.437H7.078v-3.49h3.047v-2.66c0-3.025 1.792-4.697 4.533-4.697 1.312 0 2.686.236 2.686.236v2.971H15.83c-1.491 0-1.956.93-1.956 1.886v2.264h3.328l-.532 3.49h-2.796V24C19.612 23.094 24 18.1 24 12.073z" fill="white"/>
          </svg>
        </a>
        <a href="https://instagram.com/soscompagnon" target="_blank" rel="noopener noreferrer" class="social-link instagram" aria-label="Suivez-nous sur Instagram">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z" fill="white"/>
          </svg>
        </a>
      </div>
    </div>

    <!-- Section Navigation -->
    <div class="footer-section">
      <h3>Navigation</h3>
      <ul class="footer-links">
        <li><a href="https://soscompagnon.fr/">Accueil</a></li>
        <li><a href="services">Nos Services</a></li>
        <li><a href="animaux">Liste des Animaux</a></li>
        <li><a href="carte">Carte Interactive</a></li>
        <li><a href="souvenir">En Mémoire</a></li>
      </ul>
    </div>

    <!-- Section Services -->
    <div class="footer-section">
      <h3>Services</h3>
      <ul class="footer-links">
        <li><a href="services#recherche">Recherche d'Animaux</a></li>
        <li><a href="services#affiches">Affiches Professionnelles</a></li>
        <li><a href="services#enquete">Enquête de Voisinage</a></li>
        <li><a href="services#livraison">Courses & Livraison</a></li>
        <li><a href="ajouter">Signaler un Animal</a></li>
      </ul>
    </div>

    <!-- Section Contact -->
    <div class="footer-section">
      <h3>Contact</h3>
      <div class="contact-info">
        <div class="contact-item">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z" fill="currentColor"/>
          </svg>
          <a href="tel:+33781500855">07 81 50 08 55</a>
        </div>
        <div class="contact-item">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z" fill="currentColor"/>
          </svg>
          <a href="mailto:contact@soscompagnon.fr">contact@soscompagnon.fr</a>
        </div>
        <div class="contact-item">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z" fill="currentColor"/>
          </svg>
          <span>Service disponible en France</span>
        </div>
        <div class="contact-item">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
            <path d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11zM7 10h5v5H7z" fill="currentColor"/>
          </svg>
          <span>SIRET : 92894225900013</span>
        </div>
      </div>
    </div>
  </div>

  <div class="footer-divider"></div>

  <div class="footer-bottom">
    <div class="footer-copyright">
      © <?php echo date('Y'); ?> SOS Compagnon • Site créé par <strong>KYLIAN EBERLE</strong>
    </div>
    <div class="footer-legal">
      <a href="mentions-legales">Mentions Légales</a>
      <a href="politique-confidentialite">Confidentialité</a>
      <a href="cgv">CGV</a>
    </div>
  </div>
</footer>

<!-- BACK TO TOP BUTTON -->
<button id="backToTop" class="back-to-top" aria-label="Retour en haut de la page">↑</button>

<!-- PWA INSTALL BUTTON -->
<button id="pwaInstallFab" class="pwa-fab" aria-label="Installer l'application">
  <img src="/img/logo.png" alt="" aria-hidden="true">
  <span>Installer l'app</span>
</button>

<!-- JavaScript - Defer for performance -->
<script defer src="/js/main.js"></script>

</body>
</html>
