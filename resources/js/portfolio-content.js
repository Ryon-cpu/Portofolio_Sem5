const csrfToken = () => document.querySelector('meta[name="csrf-token"]')?.content ?? '';

export const defaultProfile = {
  name: 'Fiqtoril Oyun',
  role: 'Individu yang terus berkembang',
  headline: 'Terus Belajar, Bertumbuh, dan Berkarya.',
  bio: 'Saya senang mengeksplorasi hal baru, memperluas wawasan, dan mengembangkan diri melalui berbagai pengalaman. Saya terbuka untuk berkenalan dan bertukar ide.',
  avatar: '/foto.png',
  online: false,
  studentId: '',
  birthInfo: '',
  address: '',
  gender: '',
  nationality: '',
  institution: '',
  studyProgram: '',
  email: '',
  phone: '',
};

export const defaultProjects = [
  { id: 'batik-catalog', title: 'Katalog Batik Tradisional UMKM', description: 'Sistem katalog dan pemesanan daring produk batik lokal dengan integrasi WhatsApp checkout.', category: 'UMKM', featured: true, year: '2024', image: '/img/foto13.jpeg', techs: ['Vue.js', 'Tailwind', 'PHP'], link: '#' },
  { id: 'architecture-portfolio', title: 'Website Profil Arsitektur & Interior', description: 'Landing page portofolio visual minimalis dengan galeri foto beresolusi tinggi dan interaksi cepat.', category: 'Portofolio', featured: true, year: '2024', image: '/img/foto14.jpeg', techs: ['Vue.js', 'Tailwind', 'Shadcn'], link: '#' },
  { id: 'inventory-management', title: 'Sistem Manajemen Inventaris Barang', description: 'Dashboard informasi pencatatan stok gudang, riwayat barang masuk/keluar, dan laporan PDF.', category: 'Sistem Informasi', featured: false, year: '2023', image: '/img/foto15.jpeg', techs: ['Laravel', 'MySQL', 'REST API'], link: '#' },
  { id: 'coffee-reservations', title: 'Menu & Reservasi Kedai Kopi Lokal', description: 'Aplikasi web pemesanan meja dan menu digital responsive untuk UMKM kedai kopi modern.', category: 'UMKM', featured: false, year: '2023', image: '/img/foto16.jpeg', techs: ['Vue.js', 'Tailwind CSS'], link: '#' },
  { id: 'music-portfolio', title: 'Platform Portofolio Kreator Musik', description: 'Halaman personal branding untuk musisi independen dengan pemutar audio dan jadwal konser.', category: 'Portofolio', featured: false, year: '2024', image: '/img/foto17.jpeg', techs: ['Vue.js', 'Tailwind'], link: '#' },
  { id: 'attendance-portal', title: 'Portal Presensi & Jadwal Karyawan', description: 'Sistem informasi pengelolaan absensi dan penjadwalan kerja tim secara daring.', category: 'Sistem Informasi', featured: true, year: '2024', image: '/img/foto18.jpeg', techs: ['Laravel', 'Vue.js', 'MySQL'], link: '#' },
  { id: 'featured-project-7', title: 'Projek Tambahan', description: 'Informasi proyek akan diperbarui.', category: 'Portofolio', featured: true, year: '2026', image: '/img/foto19.jpeg', techs: [], link: '#' },
  { id: 'featured-project-8', title: 'Karya Tambahan', description: 'Informasi proyek akan diperbarui.', category: 'Portofolio', featured: true, year: '2026', image: '/img/foto20.jpeg', techs: [], link: '#' },
];

const placeholderProjectImages = [
  'https://avatar.vercel.sh/batik1',
  'https://avatar.vercel.sh/arch1',
  'https://avatar.vercel.sh/inv1',
  'https://avatar.vercel.sh/coffee1',
  'https://avatar.vercel.sh/music1',
  'https://avatar.vercel.sh/attend1',
];

export const defaultGallery = Array.from({ length: 8 }, (_, index) => ({
  id: `documentation-${index + 1}`,
  title: 'Dokumentasi',
  image: `/img/foto${index + 1}.jpeg`,
}));

export const defaultStats = [
  { value: '15+', label: 'Projek Selesai' },
  { value: '10+', label: 'Klien Puas' },
  { value: '2+', label: 'Tahun Pengalaman' },
];

export const defaultSkills = [
  {
    name: 'Frontend Framework & Styling',
    skills: [
      { name: 'Vue.js', tag: '01', initial: 'VU', handle: '@vuejs', description: 'Framework progresif untuk membangun antarmuka web reaktif dengan Composition API.', level: 'Mahir', since: '2023' },
      { name: 'Tailwind CSS', tag: '02', initial: 'TW', handle: '@tailwindcss', description: 'Utility-first CSS framework untuk pembuatan layout responsif dan sistem desain yang konsisten.', level: 'Mahir', since: '2022' },
      { name: 'Shadcn UI', tag: '03', initial: 'SC', handle: '@shadcn', description: 'Kumpulan komponen UI monokrom berbasis aksesibilitas Radix & Tailwind.', level: 'Mahir', since: '2024' },
      { name: 'TypeScript', tag: '04', initial: 'TS', handle: '@typescript', description: 'JavaScript dengan sistem tipe statis untuk kode yang aman dan terdokumentasi.', level: 'Menengah', since: '2023' },
    ],
  },
  {
    name: 'Backend & Database',
    skills: [
      { name: 'PHP', tag: '05', initial: 'PH', handle: '@php', description: 'Bahasa pemrograman server-side yang andal dan menjadi pondasi backend web.', level: 'Mahir', since: '2022' },
      { name: 'Laravel', tag: '06', initial: 'LV', handle: '@laravel', description: 'Framework PHP modern dengan ekosistem routing, Eloquent ORM, dan migrasi database Laravel.', level: 'Mahir', since: '2022' },
      { name: 'MySQL', tag: '07', initial: 'SQL', handle: '@mysql', description: 'Sistem manajemen basis data relasional untuk penyimpanan data yang terstruktur.', level: 'Mahir', since: '2022' },
      { name: 'RESTful API', tag: '08', initial: 'API', handle: '@restapi', description: 'Desain integrasi stateless endpoint komunikasi backend dan frontend.', level: 'Mahir', since: '2023' },
    ],
  },
  {
    name: 'Tooling & Arsitektur',
    skills: [
      { name: 'Vite', tag: '09', initial: 'VT', handle: '@vitejs', description: 'Frontend tooling dengan Hot Module Replacement (HMR) super cepat.', level: 'Mahir', since: '2023' },
      { name: 'Git & GitHub', tag: '10', initial: 'GH', handle: '@git', description: 'Version control system untuk manajemen cabang dan kolaborasi repository kode.', level: 'Mahir', since: '2022' },
      { name: 'Figma', tag: '11', initial: 'FG', handle: '@figma', description: 'Perancangan wireframe, prototipe antarmuka, dan sistem desain visual.', level: 'Menengah', since: '2023' },
    ],
  },
];

export const defaultAchievements = [
  { title: 'Juara 2 Hackathon Web Dev 2023', description: 'Kompetisi pengembangan web tingkat nasional digitalisasi UMKM.', image: '/img/foto9.jpeg', badge: 'Featured' },
  { title: 'Pembicara Workshop UI/UX 2024', description: 'Narasumber perancangan antarmuka monokrom modern.', image: '/img/foto10.jpeg', badge: null },
  { title: 'Sertifikat Laravel Expert', description: 'Sertifikasi penguasaan arsitektur backend & database Laravel.', image: '/img/foto11.jpeg', badge: null },
  { title: 'Kontributor Open Source Vue', description: 'Kolaborasi pustaka komponen antarmuka web komunitas lokal.', image: '/img/foto12.jpeg', badge: 'Featured' },
];

const placeholderAchievementImages = [
  'https://avatar.vercel.sh/hack1',
  'https://avatar.vercel.sh/speak1',
  'https://avatar.vercel.sh/cert1',
  'https://avatar.vercel.sh/oss1',
];

export const defaultServices = [
  { name: 'Landing Page UMKM', description: 'Website profil & katalog produk responsif untuk usaha mikro, kecil, dan menengah dengan fitur integrasi WhatsApp.', icon: '🏪', tags: ['Vue.js', 'Tailwind', 'Laravel'], price: 'Rp 500.000' },
  { name: 'Web Portofolio Personal', description: 'Halaman portofolio minimalis modern untuk freelancer, kreator, dan developer dengan dukungan tema gelap/terang.', icon: '💼', tags: ['Vue.js', 'Tailwind', 'Shadcn UI'], price: 'Rp 350.000' },
  { name: 'Sistem Informasi Web', description: 'Aplikasi manajemen data, inventaris, atau absensi berbasis web dengan dashboard interaktif dan ekspor laporan.', icon: '🗂️', tags: ['Laravel', 'MySQL', 'REST API'], price: 'Rp 1.500.000' },
  { name: 'UI/UX Design', description: 'Rancangan antarmuka wireframe & prototipe interaktif Figma untuk produk digital web maupun aplikasi mobile.', icon: '🎨', tags: ['Figma', 'Design System', 'Wireframe'], price: 'Rp 300.000' },
];

export const defaultContacts = [
  { label: 'WhatsApp', href: 'https://wa.me' },
  { label: 'Lynkid', href: 'https://lynkid.com' },
];

export const defaultMedsos = [
  { label: 'Github', href: 'https://github.com' },
  { label: 'Tiktok', href: 'https://tiktok.com' },
  { label: 'Instagram', href: 'https://instagram.com' },
  { label: 'Telegram', href: 'https://t.me' },
];

export const defaultSocialLinks = [
  { name: 'GitHub', href: 'https://github.com/Ryon-cpu' },
  { name: 'Instagram', href: 'https://instagram.com' },
  { name: 'Telegram', href: 'https://t.me' },
  { name: 'LinkedIn', href: 'https://linkedin.com' },
];

let portfolioContent = getDefaultContent();

function getDefaultContent() {
  return {
    profile: { ...defaultProfile },
    projects: defaultProjects.map((project) => ({ ...project, techs: [...project.techs] })),
    gallery: defaultGallery.map((item) => ({ ...item })),
    stats: defaultStats.map((item) => ({ ...item })),
    skills: defaultSkills.map((category) => ({
      ...category,
      skills: category.skills.map((skill) => ({ ...skill })),
    })),
    achievements: defaultAchievements.map((item) => ({ ...item })),
    services: defaultServices.map((item) => ({ ...item, tags: [...item.tags] })),
    contacts: defaultContacts.map((item) => ({ ...item })),
    medsos: defaultMedsos.map((item) => ({ ...item })),
    socialLinks: defaultSocialLinks.map((item) => ({ ...item })),
  };
}

export function loadPortfolioContent() {
  return portfolioContent;
}

async function requestJson(url, options = {}) {
  const headers = {
    Accept: 'application/json',
    ...(options.body && !(options.body instanceof FormData) ? { 'Content-Type': 'application/json' } : {}),
    ...(options.method && options.method !== 'GET' ? { 'X-CSRF-TOKEN': csrfToken() } : {}),
    ...options.headers,
  };
  const response = await fetch(url, { ...options, credentials: 'same-origin', headers });
  const result = await response.json().catch(() => ({}));

  if (!response.ok) {
    const validationMessage = result.errors
      ? Object.values(result.errors).flat().join(' ')
      : '';
    throw new Error(validationMessage || result.message || 'Permintaan ke server gagal.');
  }

  return result;
}

function updatePortfolioContent(content) {
  const isPlaceholderProjects = Array.isArray(content.projects)
    && content.projects.length === placeholderProjectImages.length
    && content.projects.every((item, index) => (
      item?.id === defaultProjects[index].id
      && item.title === defaultProjects[index].title
      && item.image === placeholderProjectImages[index]
    ));
  const isPlaceholderGallery = Array.isArray(content.gallery)
    && content.gallery.length === defaultGallery.length
    && content.gallery.every((item, index) => (
      item?.id === defaultGallery[index].id
      && item.image === `https://avatar.vercel.sh/doc${index + 1}`
    ));
  const isPlaceholderAchievements = Array.isArray(content.achievements)
    && content.achievements.length === defaultAchievements.length
    && content.achievements.every((item, index) => (
      item?.title === defaultAchievements[index].title
      && item.image === placeholderAchievementImages[index]
    ));
  const defaultContent = getDefaultContent();

  portfolioContent = {
    ...defaultContent,
    ...content,
    projects: isPlaceholderProjects || !Array.isArray(content.projects)
      ? defaultContent.projects
      : content.projects,
    gallery: isPlaceholderGallery || !Array.isArray(content.gallery)
      ? defaultContent.gallery
      : content.gallery,
    achievements: isPlaceholderAchievements || !Array.isArray(content.achievements)
      ? defaultContent.achievements
      : content.achievements,
    profile: { ...defaultProfile, ...content.profile },
  };
  window.dispatchEvent(new CustomEvent('portfolio-content-updated', { detail: portfolioContent }));

  return portfolioContent;
}

export async function initializePortfolioContent() {
  const result = await requestJson('/api/portfolio');
  return updatePortfolioContent(result.data);
}

export async function savePortfolioContent(content) {
  const result = await requestJson('/api/admin/portfolio', {
    method: 'PUT',
    body: JSON.stringify({ content }),
  });

  return updatePortfolioContent(result.data);
}

export async function getAdminSession() {
  return requestJson('/api/admin/session');
}

export async function loginAdmin(email, password) {
  return requestJson('/api/admin/login', {
    method: 'POST',
    body: JSON.stringify({ email, password }),
  });
}

export async function logoutAdmin() {
  return requestJson('/api/admin/logout', { method: 'POST' });
}

export async function refreshAdminPresence() {
  return requestJson('/api/admin/presence', { method: 'POST' });
}

export async function uploadPortfolioImage(image) {
  let file = image;

  if (typeof image === 'string' && image.startsWith('data:image/')) {
    const imageResponse = await fetch(image);
    const blob = await imageResponse.blob();
    file = new File([blob], 'portfolio-image.jpg', { type: blob.type });
  }

  if (!(file instanceof File)) {
    return image;
  }

  const formData = new FormData();
  formData.append('image', file);

  const result = await requestJson('/api/admin/images', {
    method: 'POST',
    headers: { 'X-CSRF-TOKEN': csrfToken() },
    body: formData,
  });

  return result.url;
}

export async function sendContactMessage(message) {
  return requestJson('/api/contact', {
    method: 'POST',
    body: JSON.stringify(message),
  });
}

export async function getAdminMessages() {
  const result = await requestJson('/api/admin/messages');
  return result.data.data;
}

export async function markAdminMessageRead(id) {
  return requestJson(`/api/admin/messages/${id}/read`, { method: 'PATCH' });
}

export async function deleteAdminMessage(id) {
  return requestJson(`/api/admin/messages/${id}`, { method: 'DELETE' });
}

