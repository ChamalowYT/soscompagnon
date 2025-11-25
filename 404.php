<?php
http_response_code(404);
header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>404 - Page non trouvée | SOS Compagnon</title>
  <link rel="icon" type="image/png" href="/img/logo.png">
  <link rel="stylesheet" href="/css/main.css">
  <style>
    .error-page {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: var(--spacing-md);
      text-align: center;
      background: linear-gradient(135deg, #0a0a0a 0%, #1a0a0a 100%);
    }

    .error-content {
      max-width: 600px;
    }

    .error-code {
      font-size: clamp(4rem, 15vw, 8rem);
      font-weight: 900;
      background: linear-gradient(135deg, var(--accent), var(--accent-2));
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
      line-height: 1;
      margin-bottom: var(--spacing-md);
    }

    .error-title {
      font-size: clamp(1.5rem, 4vw, 2.5rem);
      font-weight: 800;
      margin-bottom: var(--spacing-md);
      color: var(--dark-text);
    }

    .error-description {
      font-size: 1.1rem;
      opacity: 0.8;
      margin-bottom: var(--spacing-xl);
      line-height: 1.6;
    }

    .error-actions {
      display: flex;
      gap: var(--spacing-md);
      justify-content: center;
      flex-wrap: wrap;
    }

    .error-icon {
      font-size: 5rem;
      margin-bottom: var(--spacing-lg);
      animation: float 3s ease-in-out infinite;
    }
  </style>
</head>
<body>
  <div class="error-page">
    <div class="error-content">
      <div class="error-icon">🐾</div>
      <div class="error-code">404</div>
      <h1 class="error-title">Page non trouvée</h1>
      <p class="error-description">
        Oups ! La page que vous cherchez semble avoir disparu,
        comme un compagnon égaré... Mais ne vous inquiétez pas,
        nous allons vous aider à retrouver votre chemin !
      </p>
      <div class="error-actions">
        <a href="/" class="btn btn-primary">
          <span class="btn-icon">🏠</span>
          <span>Retour à l'accueil</span>
        </a>
        <a href="/animaux" class="btn btn-ghost">
          <span class="btn-icon">🐶</span>
          <span>Voir les animaux</span>
        </a>
      </div>
    </div>
  </div>

  <script>
    // Track 404 errors
    if (typeof gtag !== 'undefined') {
      gtag('event', 'exception', {
        'description': '404: ' + window.location.pathname,
        'fatal': false
      });
    }
  </script>
</body>
</html>
