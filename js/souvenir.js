/**
 * SOUVENIR PAGE - MEMORIAL JAVASCRIPT
 * Grid rendering, filtering, modal, form submission
 */

'use strict';

// ===== HELPERS =====
const API = 'api/memorial.php';

function toast(msg) {
  const t = document.getElementById('toast');
  t.textContent = msg;
  t.classList.add('show');
  setTimeout(() => t.classList.remove('show'), 2500);
}

function esc(s) {
  if (!s) return '';
  return String(s).replace(/[&<>"']/g, c => ({
    '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;'
  }[c]));
}

function formatDate(ts) {
  try {
    const d = new Date(ts * 1000);
    return d.toLocaleDateString('fr-FR', { day: '2-digit', month: 'long', year: 'numeric' });
  } catch {
    return '';
  }
}

function specieLabel(s) {
  return s === 'chien' ? 'Chien' : s === 'chat' ? 'Chat' : 'NAC';
}

// ===== MEMORIAL MANAGER =====
const MemorialManager = {
  grid: null,
  empty: null,
  items: [],

  init() {
    this.grid = document.getElementById('grid');
    this.empty = document.getElementById('empty');

    this.initFilters();
    this.initModal();
    this.initDialog();
    this.loadItems('all');
  },

  // ===== GRID =====
  async loadItems(filter = 'all') {
    try {
      const url = new URL(API, location.origin);
      url.searchParams.set('limit', '100');
      if (filter !== 'all') url.searchParams.set('species', filter);

      const res = await fetch(url);
      const data = await res.json();

      if (!data.ok) throw new Error(data.error || 'Erreur API');

      this.items = data.items || [];
      this.renderGrid();
    } catch (err) {
      console.error(err);
      this.grid.innerHTML = '';
      this.empty.style.display = 'block';
    }
  },

  renderGrid() {
    if (this.items.length === 0) {
      this.grid.innerHTML = '';
      this.empty.style.display = 'block';
      return;
    }

    this.empty.style.display = 'none';
    this.grid.innerHTML = this.items.map(item => {
      const img = item.photo_url || 'img/logo.png';
      const sym = esc(item.symbol || '🕯️');
      return `
        <div class="card" data-id="${item.id}">
          <div class="card-img">
            <img src="${img}" alt="${esc(item.name)}" loading="lazy">
            <div class="badge">${sym} ${specieLabel(item.species)}</div>
            <div class="candle">
              <div class="flame"></div>
              <div class="wick"></div>
              <div class="wax"></div>
            </div>
          </div>
          <div class="card-body">
            <div class="card-name">${esc(item.name)}</div>
            <div class="card-msg">${esc(item.message)}</div>
            <div class="card-meta">Allumée le ${formatDate(item.created_at)}</div>
          </div>
        </div>
      `;
    }).join('');
  },

  // ===== FILTRES =====
  initFilters() {
    document.getElementById('filters').addEventListener('click', (e) => {
      const pill = e.target.closest('.pill');
      if (!pill) return;

      document.querySelectorAll('.pill').forEach(p => p.dataset.active = 'false');
      pill.dataset.active = 'true';
      this.loadItems(pill.dataset.species);
    });
  },

  // ===== MODAL =====
  initModal() {
    const modal = document.getElementById('modal');
    const modalTitle = document.getElementById('modalTitle');
    const modalImg = document.getElementById('modalImg');
    const modalMsg = document.getElementById('modalMsg');
    const modalMeta = document.getElementById('modalMeta');

    this.grid.addEventListener('click', (e) => {
      const card = e.target.closest('.card');
      if (!card) return;

      const id = parseInt(card.dataset.id);
      const item = this.items.find(x => x.id === id);
      if (!item) return;

      const sym = item.symbol || '🕯️';
      modalTitle.innerHTML = `<span style="font-size:1.6rem">${esc(sym)}</span> ${esc(item.name)}`;
      modalImg.src = item.photo_url || 'img/logo.png';
      modalMsg.textContent = item.message;
      modalMeta.textContent = `Espèce : ${specieLabel(item.species)} • Allumée le ${formatDate(item.created_at)}`;
      modal.classList.add('show');
      document.body.style.overflow = 'hidden';
    });

    document.getElementById('closeModal').addEventListener('click', () => {
      modal.classList.remove('show');
      document.body.style.overflow = '';
    });

    modal.addEventListener('click', (e) => {
      if (e.target === modal) {
        modal.classList.remove('show');
        document.body.style.overflow = '';
      }
    });
  },

  // ===== DIALOG =====
  initDialog() {
    const dlg = document.getElementById('dlg');
    const form = document.getElementById('form');

    document.getElementById('openDlg').addEventListener('click', () => dlg.showModal());
    document.getElementById('closeDlg').addEventListener('click', () => dlg.close());
    document.getElementById('cancel').addEventListener('click', () => dlg.close());

    // Compteur
    const message = document.getElementById('message');
    const count = document.getElementById('count');
    message.addEventListener('input', () => {
      count.textContent = message.value.length;
    });

    // Upload
    this.initUpload();

    // Submit
    form.addEventListener('submit', async (e) => {
      e.preventDefault();

      const fd = new FormData(form);
      const btn = document.getElementById('submitBtn');
      btn.disabled = true;
      btn.textContent = 'Envoi…';

      try {
        const res = await fetch(API, {
          method: 'POST',
          body: fd
        });

        const data = await res.json();

        if (!data.ok) throw new Error(data.error || 'Erreur');

        toast('Merci ✨ Votre pensée sera publiée après validation');
        form.reset();
        document.getElementById('preview').style.display = 'none';
        count.textContent = '0';
        dlg.close();

        const activeFilter = document.querySelector('.pill[data-active="true"]').dataset.species;
        this.loadItems(activeFilter);
      } catch (err) {
        console.error(err);
        toast('Erreur : ' + err.message);
      } finally {
        btn.disabled = false;
        btn.textContent = 'Allumer';
      }
    });
  },

  // ===== UPLOAD =====
  initUpload() {
    const drop = document.getElementById('drop');
    const photo = document.getElementById('photo');
    const preview = document.getElementById('preview');
    const imgPrev = document.getElementById('imgPrev');
    const fname = document.getElementById('fname');

    drop.addEventListener('click', (e) => {
      if (e.target === photo) return;
      photo.click();
    });

    drop.addEventListener('dragover', (e) => {
      e.preventDefault();
      drop.classList.add('drag');
    });

    drop.addEventListener('dragleave', () => drop.classList.remove('drag'));

    drop.addEventListener('drop', (e) => {
      e.preventDefault();
      drop.classList.remove('drag');
      if (e.dataTransfer.files[0]) {
        photo.files = e.dataTransfer.files;
        this.showPreview(e.dataTransfer.files[0], imgPrev, fname, preview);
      }
    });

    photo.addEventListener('change', () => {
      if (photo.files[0]) this.showPreview(photo.files[0], imgPrev, fname, preview);
    });
  },

  showPreview(file, imgPrev, fname, preview) {
    const url = URL.createObjectURL(file);
    imgPrev.src = url;
    fname.textContent = file.name;
    preview.style.display = 'flex';
  }
};

// ===== INIT =====
document.addEventListener('DOMContentLoaded', () => {
  MemorialManager.init();
});
