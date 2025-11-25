/**
 * SOS COMPAGNON - MAIN JAVASCRIPT
 * Mobile-optimized, modular, performant
 */

'use strict';

// ===== SITE MANAGER (Main Controller) =====
const SiteManager = {
  init() {
    this.initPromo();
    this.initNav();
    this.initCounters();
    this.initCarousel();
    this.initBackToTop();
    this.initAnimations();
    this.initPWA();
    this.initServiceWorker();
  },

  // ===== PROMO BANNER =====
  initPromo() {
    const banner = document.getElementById('promoBanner');
    const closeBtn = document.getElementById('closeBanner');
    const body = document.body;

    if (!banner) return;

    const bannerClosed = localStorage.getItem('promoBannerClosed');

    if (!bannerClosed) {
      body.classList.add('has-promo-banner');
    } else {
      banner.style.display = 'none';
    }

    closeBtn?.addEventListener('click', () => {
      banner.style.display = 'none';
      body.classList.remove('has-promo-banner');
      localStorage.setItem('promoBannerClosed', 'true');
    });
  },

  // ===== NAVIGATION =====
  initNav() {
    const nav = document.getElementById('mainNav');
    const mobileBtn = document.getElementById('mobileTrigger');
    const navLinks = document.getElementById('navLinks');
    const navBackdrop = document.getElementById('navBackdrop');
    let lastScroll = 0;

    // Scroll effect
    const onScroll = () => {
      const currentScroll = window.scrollY;

      if (currentScroll > 20) {
        nav?.classList.add('scrolled');
      } else {
        nav?.classList.remove('scrolled');
      }

      lastScroll = currentScroll;
    };

    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();

    // Mobile menu functions
    const closeMenu = () => {
      mobileBtn?.classList.remove('open');
      navLinks?.classList.remove('show');
      navBackdrop?.classList.remove('show');
      mobileBtn?.setAttribute('aria-expanded', 'false');
      document.body.style.overflow = '';
    };

    const toggleMenu = () => {
      const isOpen = mobileBtn?.classList.toggle('open');
      navLinks?.classList.toggle('show');
      navBackdrop?.classList.toggle('show');
      mobileBtn?.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
      document.body.style.overflow = isOpen ? 'hidden' : '';
    };

    mobileBtn?.addEventListener('click', toggleMenu);
    navBackdrop?.addEventListener('click', closeMenu);
    navLinks?.querySelectorAll('a').forEach(a => a.addEventListener('click', closeMenu));

    window.addEventListener('resize', () => {
      if (window.matchMedia('(min-width: 901px)').matches) {
        closeMenu();
      }
    });
  },

  // ===== KPI COUNTERS =====
  async initCounters() {
    const updateCounters = async () => {
      try {
        const [perdus, apercus] = await Promise.all([
          this.getTotal('/api/animals.php', { status: 'perdu' }),
          this.getTotal('/api/sightings.php')
        ]);

        const total = perdus + apercus;

        this.animateNumber('kpi-total', total);
        this.animateNumber('kpi-perdus', perdus);
        this.animateNumber('kpi-apercus', apercus);
      } catch (e) {
        console.error('Erreur compteurs:', e);
      }
    };

    await updateCounters();
    setInterval(updateCounters, 60000);

    document.addEventListener('visibilitychange', () => {
      if (!document.hidden) updateCounters();
    });
  },

  async getTotal(url, params = {}) {
    const u = new URL(url, location.origin);
    u.searchParams.set('limit', '1');
    u.searchParams.set('offset', '0');
    Object.entries(params).forEach(([k, v]) => {
      if (v !== undefined && v !== null && v !== '') u.searchParams.set(k, v);
    });

    try {
      const res = await fetch(u.toString(), { headers: { 'Accept': 'application/json' } });
      if (!res.ok) throw new Error('HTTP ' + res.status);
      const data = await res.json();
      return Number(data.total || 0);
    } catch {
      return 0;
    }
  },

  animateNumber(id, target) {
    const el = document.getElementById(id);
    if (!el) return;

    const duration = 1500;
    const start = parseInt(el.textContent) || 0;
    const increment = (target - start) / (duration / 16);
    let current = start;

    const timer = setInterval(() => {
      current += increment;
      if ((increment > 0 && current >= target) || (increment < 0 && current <= target)) {
        el.textContent = target.toString();
        clearInterval(timer);
      } else {
        el.textContent = Math.floor(current).toString();
      }
    }, 16);
  },

  // ===== LOST PETS CAROUSEL =====
  initCarousel() {
    if (!document.getElementById('carouselTrack')) return;
    new PetsCarousel();
  },

  // ===== BACK TO TOP BUTTON =====
  initBackToTop() {
    const backToTop = document.getElementById('backToTop');
    if (!backToTop) return;

    window.addEventListener('scroll', () => {
      if (window.scrollY > 500) {
        backToTop.style.display = 'flex';
      } else {
        backToTop.style.display = 'none';
      }
    }, { passive: true });

    backToTop.addEventListener('click', () => {
      window.scrollTo({ top: 0, behavior: 'smooth' });
    });
  },

  // ===== SCROLL ANIMATIONS =====
  initAnimations() {
    const elements = document.querySelectorAll('.animate-on-scroll');

    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('visible');
        }
      });
    }, {
      threshold: 0.1,
      rootMargin: '0px 0px -50px 0px'
    });

    elements.forEach(el => observer.observe(el));
  },

  // ===== PWA INSTALL =====
  initPWA() {
    const btn = document.getElementById('pwaInstallFab');
    if (!btn) return;

    const isStandalone = window.matchMedia('(display-mode: standalone)').matches || window.navigator.standalone;
    let deferredPrompt = null;

    if (isStandalone) {
      return;
    }

    window.addEventListener('beforeinstallprompt', (e) => {
      e.preventDefault();
      deferredPrompt = e;
      btn.style.display = 'flex';
    });

    btn.addEventListener('click', async () => {
      const ua = navigator.userAgent || '';
      const isIOS = /iPhone|iPad|iPod/i.test(ua) || (/Macintosh/.test(ua) && 'ontouchend' in document);

      if (isIOS) {
        this.showToast('📱 Pour installer sur iOS: Touchez le bouton Partager ⎋ puis "Sur l\'écran d\'accueil"', 'info');
        return;
      }

      if (deferredPrompt) {
        deferredPrompt.prompt();
        const choice = await deferredPrompt.userChoice;
        if (choice.outcome === 'accepted') {
          btn.style.display = 'none';
          this.showToast('✅ Application installée avec succès !', 'success');
        }
        deferredPrompt = null;
      } else {
        this.showToast('Pour installer: Menu ⋮ → "Installer l\'application"', 'info');
      }
    });

    window.addEventListener('appinstalled', () => {
      btn.style.display = 'none';
      this.showToast('✅ Application installée !', 'success');
    });
  },

  // ===== SERVICE WORKER =====
  initServiceWorker() {
    if ('serviceWorker' in navigator) {
      window.addEventListener('load', () => {
        navigator.serviceWorker.register('/sw.js')
          .then(reg => {
            console.log('✅ Service Worker enregistré:', reg.scope);
          })
          .catch(err => {
            console.error('❌ Erreur Service Worker:', err);
          });
      });
    }
  },

  // ===== TOAST NOTIFICATIONS =====
  showToast(message, type = 'success') {
    const toast = document.createElement('div');
    toast.className = `toast toast-${type}`;
    toast.textContent = message;
    document.body.appendChild(toast);

    setTimeout(() => {
      toast.style.animation = 'slideOut 0.3s ease';
      setTimeout(() => toast.remove(), 300);
    }, 4000);
  }
};

// ===== PETS CAROUSEL CLASS =====
class PetsCarousel {
  constructor() {
    this.track = document.getElementById('carouselTrack');
    this.wrapper = document.getElementById('carouselWrapper');
    this.dotsContainer = document.getElementById('carouselDots');
    this.prevBtn = document.getElementById('carouselPrev');
    this.nextBtn = document.getElementById('carouselNext');

    this.currentIndex = 0;
    this.pets = [];
    this.autoPlayInterval = null;
    this.cardsPerView = this.getCardsPerView();

    // Drag & Swipe variables
    this.isDragging = false;
    this.startX = 0;
    this.currentX = 0;
    this.dragOffset = 0;
    this.startScrollLeft = 0;
    this.clickThreshold = 10;
    this.hasMoved = false;

    this.init();
  }

  getCardsPerView() {
    const width = window.innerWidth;
    if (width <= 768) return 2;
    if (width <= 1024) return 3;
    return 5;
  }

  async init() {
    await this.loadPets();
    this.setupEventListeners();
    this.setupDragAndSwipe();
    this.startAutoPlay();

    window.addEventListener('resize', () => {
      const newCardsPerView = this.getCardsPerView();
      if (newCardsPerView !== this.cardsPerView) {
        this.cardsPerView = newCardsPerView;
        this.currentIndex = 0;
        this.updateCarousel();
      }
    });
  }

  toAbsUrl(u) {
    if (!u) return 'img/logo.png';
    try {
      const url = new URL(u, window.location.origin);
      if (location.protocol === 'https:' && url.protocol !== 'https:') {
        url.protocol = 'https:';
      }
      return url.toString();
    } catch {
      return u;
    }
  }

  formatDateFR(s) {
    if (!s) return '';
    const match = String(s).match(/^(\d{4})-(\d{2})-(\d{2})/);
    if (!match) return s;
    const d = new Date(Number(match[1]), Number(match[2]) - 1, Number(match[3]));
    return d.toLocaleDateString('fr-FR', { day: 'numeric', month: 'long' });
  }

  normalize(s) {
    return (s || '').toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, '');
  }

  async loadPets() {
    try {
      const url = new URL('./api/animals.php', window.location.origin);
      url.searchParams.set('status', 'perdu');
      url.searchParams.set('limit', '20');
      url.searchParams.set('offset', '0');

      const response = await fetch(url.toString(), {
        headers: { 'Accept': 'application/json' }
      });

      if (!response.ok) {
        throw new Error('API error: ' + response.status);
      }

      const data = await response.json();
      const items = data.items || [];

      if (items.length === 0) {
        this.track.innerHTML = '<div class="carousel-loading">Aucun animal perdu pour le moment 😔</div>';
        return;
      }

      this.pets = items.map((item) => {
        const lat = item.lat != null ? item.lat : (item.latitude != null ? item.latitude : null);
        const lng = item.lng != null ? item.lng : (item.longitude != null ? item.longitude : null);

        return {
          name: item.name || 'Animal',
          type: item.type || '',
          ville: item.ville || 'Ville inconnue',
          date: item.date_perte || '',
          imageUrl: item.image_file || '',
          lat: lat !== undefined && lat !== null ? Number(lat) : null,
          lng: lng !== undefined && lng !== null ? Number(lng) : null
        };
      });

      this.renderPets();
      this.renderDots();

    } catch (error) {
      console.error('❌ Erreur chargement:', error);
      this.track.innerHTML = '<div class="carousel-loading">Erreur de chargement 😞</div>';
    }
  }

  renderPets() {
    this.track.innerHTML = this.pets.map((pet) => {
      let imageUrl = this.toAbsUrl(pet.imageUrl);

      if (location.protocol === 'https:' && /^http:\/\//i.test(imageUrl)) {
        imageUrl = '/img/proxy.php?u=' + encodeURIComponent(imageUrl);
      }

      const date = this.formatDateFR(pet.date);
      const typeNorm = this.normalize(pet.type);
      const icon = typeNorm === 'chien' ? '🐶' :
                   typeNorm === 'chat' ? '🐱' : '🐾';

      const encodedName = encodeURIComponent(pet.name);

      return `
        <div class="pet-card" data-href="/animaux#${encodedName}">
          <div class="pet-card-image">
            <img src="${imageUrl}" alt="${pet.name}" loading="lazy" onerror="this.src='img/logo.png'">
            <span class="pet-status-badge">Perdu</span>
          </div>
          <div class="pet-card-content">
            <h3 class="pet-card-title">
              <span class="icon">${icon}</span>
              <span>${pet.name}</span>
            </h3>
            <div class="pet-card-breed">${pet.type ? pet.type.charAt(0).toUpperCase() + pet.type.slice(1) : 'Animal'}</div>
            <div class="pet-card-location">📍 ${pet.ville}</div>
            <div class="pet-card-date">${date}</div>
          </div>
        </div>
      `;
    }).join('');
  }

  renderDots() {
    const totalPages = Math.ceil(this.pets.length / this.cardsPerView);

    this.dotsContainer.innerHTML = Array.from({ length: totalPages }, (_, i) =>
      `<div class="carousel-dot ${i === 0 ? 'active' : ''}" data-index="${i}"></div>`
    ).join('');

    this.dotsContainer.querySelectorAll('.carousel-dot').forEach(dot => {
      dot.addEventListener('click', () => {
        this.currentIndex = parseInt(dot.dataset.index);
        this.updateCarousel(true);
        this.resetAutoPlay();
      });
    });
  }

  setupEventListeners() {
    this.prevBtn?.addEventListener('click', () => {
      this.prev();
      this.resetAutoPlay();
    });

    this.nextBtn?.addEventListener('click', () => {
      this.next();
      this.resetAutoPlay();
    });

    this.wrapper?.addEventListener('mouseenter', () => this.stopAutoPlay());
    this.wrapper?.addEventListener('mouseleave', () => {
      if (!this.isDragging) this.startAutoPlay();
    });
  }

  setupDragAndSwipe() {
    // Mouse events
    this.wrapper.addEventListener('mousedown', this.onDragStart.bind(this));
    this.wrapper.addEventListener('mousemove', this.onDragMove.bind(this));
    this.wrapper.addEventListener('mouseup', this.onDragEnd.bind(this));
    this.wrapper.addEventListener('mouseleave', this.onDragEnd.bind(this));

    // Touch events
    this.wrapper.addEventListener('touchstart', this.onDragStart.bind(this), { passive: true });
    this.wrapper.addEventListener('touchmove', this.onDragMove.bind(this), { passive: false });
    this.wrapper.addEventListener('touchend', this.onDragEnd.bind(this));

    // Click on cards
    this.track.addEventListener('click', (e) => {
      if (this.hasMoved) {
        e.preventDefault();
        e.stopPropagation();
        return;
      }

      const card = e.target.closest('.pet-card');
      if (card && card.dataset.href) {
        window.location.href = card.dataset.href;
      }
    });
  }

  onDragStart(e) {
    this.isDragging = true;
    this.hasMoved = false;
    this.startX = e.type.includes('mouse') ? e.pageX : e.touches[0].pageX;
    this.currentX = this.startX;
    this.startScrollLeft = this.getCurrentOffset();

    this.track.classList.add('dragging');
    this.stopAutoPlay();
  }

  onDragMove(e) {
    if (!this.isDragging) return;

    this.currentX = e.type.includes('mouse') ? e.pageX : e.touches[0].pageX;
    const diff = this.currentX - this.startX;

    if (Math.abs(diff) > this.clickThreshold) {
      this.hasMoved = true;
      if (e.cancelable) e.preventDefault();
    }

    const newOffset = this.startScrollLeft + diff;
    this.track.style.transform = `translateX(${newOffset}px)`;
  }

  onDragEnd(e) {
    if (!this.isDragging) return;

    this.isDragging = false;
    this.track.classList.remove('dragging');
    this.track.classList.add('smooth');

    const diff = this.currentX - this.startX;
    const threshold = 50;

    if (Math.abs(diff) > threshold) {
      if (diff > 0) {
        this.prev();
      } else {
        this.next();
      }
    } else {
      this.updateCarousel(true);
    }

    setTimeout(() => {
      this.track.classList.remove('smooth');
      this.hasMoved = false;
    }, 400);

    setTimeout(() => {
      if (!this.isDragging) this.startAutoPlay();
    }, 1000);
  }

  getCurrentOffset() {
    const cardWidth = window.innerWidth <= 768 ? 140 : (window.innerWidth <= 1024 ? 160 : 180);
    const gap = window.innerWidth <= 768 ? 12 : 16;
    return -(this.currentIndex * this.cardsPerView * (cardWidth + gap));
  }

  prev() {
    const totalPages = Math.ceil(this.pets.length / this.cardsPerView);
    this.currentIndex = (this.currentIndex - 1 + totalPages) % totalPages;
    this.updateCarousel(true);
  }

  next() {
    const totalPages = Math.ceil(this.pets.length / this.cardsPerView);
    this.currentIndex = (this.currentIndex + 1) % totalPages;
    this.updateCarousel(true);
  }

  updateCarousel(smooth = false) {
    const offset = this.getCurrentOffset();

    if (this.track) {
      if (smooth) {
        this.track.classList.add('smooth');
        setTimeout(() => this.track.classList.remove('smooth'), 400);
      }
      this.track.style.transform = `translateX(${offset}px)`;
    }

    this.dotsContainer?.querySelectorAll('.carousel-dot').forEach((dot, i) => {
      dot.classList.toggle('active', i === this.currentIndex);
    });
  }

  startAutoPlay() {
    this.stopAutoPlay();
    this.autoPlayInterval = setInterval(() => {
      this.next();
    }, 5000);
  }

  stopAutoPlay() {
    if (this.autoPlayInterval) {
      clearInterval(this.autoPlayInterval);
      this.autoPlayInterval = null;
    }
  }

  resetAutoPlay() {
    this.stopAutoPlay();
    this.startAutoPlay();
  }
}

// ===== MORE MENU TOGGLE =====
function toggleMore() {
  const menu = document.getElementById('moreMenu');
  menu?.classList.toggle('open');
}

// ===== ANALYTICS TRACKING =====
function trackEvent(category, action, label) {
  if (typeof gtag !== 'undefined') {
    gtag('event', action, {
      'event_category': category,
      'event_label': label
    });
  }
}

// ===== INITIALIZE ON DOM READY =====
if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', () => SiteManager.init());
} else {
  SiteManager.init();
}

// ===== EXPORT FOR GLOBAL USE =====
window.SiteManager = SiteManager;
window.toggleMore = toggleMore;
window.trackEvent = trackEvent;
