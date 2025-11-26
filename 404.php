<?php
http_response_code(404);
header('Content-Type: text/html; charset=utf-8');

// Get the base URL for correct paths
$baseUrl = dirname($_SERVER['REQUEST_URI']);
if ($baseUrl === '/') $baseUrl = '';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>404 - Page non trouvée | SOS Compagnon</title>
  <link rel="icon" type="image/png" href="<?php echo $baseUrl; ?>/img/logo.png">
  <link rel="stylesheet" href="<?php echo $baseUrl; ?>/css/main.css">
  <style>
    body {
      margin: 0;
      padding: 0;
    }

    .error-page {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 20px;
      text-align: center;
      background: linear-gradient(135deg, #0a0a0a 0%, #1a0a0a 100%);
      position: relative;
      overflow: hidden;
    }

    .error-page::before {
      content: "";
      position: absolute;
      top: -50%;
      left: -50%;
      width: 200%;
      height: 200%;
      background: radial-gradient(circle, rgba(239, 93, 28, 0.1) 0%, transparent 70%);
      animation: pulse-glow 6s ease-in-out infinite;
    }

    .error-content {
      max-width: 600px;
      position: relative;
      z-index: 2;
      animation: fadeInUp 0.6s ease;
    }

    .error-icon {
      font-size: 5rem;
      margin-bottom: 20px;
      animation: float 3s ease-in-out infinite;
    }

    .error-code {
      font-size: clamp(4rem, 15vw, 8rem);
      font-weight: 900;
      background: linear-gradient(135deg, var(--accent), var(--accent-2));
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
      line-height: 1;
      margin-bottom: 20px;
    }

    .error-title {
      font-size: clamp(1.5rem, 4vw, 2.5rem);
      font-weight: 800;
      margin-bottom: 20px;
      color: var(--dark-text);
    }

    .error-description {
      font-size: 1.1rem;
      opacity: 0.8;
      margin-bottom: 40px;
      line-height: 1.6;
      color: var(--dark-text);
    }

    .error-actions {
      display: flex;
      gap: 16px;
      justify-content: center;
      flex-wrap: wrap;
    }

    @keyframes float {
      0%, 100% { transform: translateY(0); }
      50% { transform: translateY(-10px); }
    }

    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @keyframes pulse-glow {
      0%, 100% {
        opacity: 0.5;
      }
      50% {
        opacity: 1;
      }
    }

    @media (max-width: 600px) {
      .error-actions {
        flex-direction: column;
        width: 100%;
      }

      .btn {
        width: 100%;
      }
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
        <a href="<?php echo $baseUrl; ?>/" class="btn btn-primary">
          <span class="btn-icon">🏠</span>
          <span>Retour à l'accueil</span>
        </a>
        <a href="<?php echo $baseUrl; ?>/animaux" class="btn btn-ghost">
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
