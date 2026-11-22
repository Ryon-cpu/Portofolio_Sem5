<template>
  <section id="projects" class="py-12 sm:py-20 border-t border-zinc-200 dark:border-zinc-800 bg-zinc-50/50 dark:bg-zinc-950 transition-colors">
    <div class="max-w-6xl mx-auto px-4 sm:px-6">
      <!-- Header & Kategori Tipe Projek (Komponen 20) -->
      <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 sm:gap-6 mb-6 sm:mb-10">
        <div class="space-y-1.5 sm:space-y-2">
          <span class="text-xs font-semibold tracking-wider text-zinc-500 uppercase">Koleksi Karya</span>
          <h2 class="text-2xl font-bold text-zinc-900 dark:text-white">Portofolio & Karya</h2>
          <p class="text-xs text-zinc-500 dark:text-zinc-400 max-w-md">
            Pilihan karya dan proyek yang pernah dikerjakan.
          </p>
        </div>
        <!-- Pengelompokan Tipe Projek (Komponen 20 ProjectTypeGroup) -->
        <div class="flex flex-wrap items-center gap-2">
          <button
            v-for="cat in categories"
            :key="cat.name"
            @click="activeCategory = cat.name"
            type="button"
            class="inline-flex items-center gap-2 border rounded-full px-3 py-1.5 text-xs font-medium transition-all"
            :class="activeCategory === cat.name
              ? 'border-zinc-900 bg-zinc-900 text-white dark:border-blue-500 dark:bg-blue-600 dark:text-white shadow-xs'
              : 'border-zinc-200 dark:border-zinc-800 bg-white dark:bg-zinc-900 text-zinc-600 dark:text-zinc-400 hover:border-zinc-300 dark:hover:border-zinc-700 hover:text-zinc-900 dark:hover:text-white'">
            <!-- Avatar Tipe Projek (Komponen 20) -->
            <span
              v-if="cat.fallback"
              class="w-4 h-4 rounded-full border border-zinc-300 dark:border-zinc-700 bg-zinc-200 dark:bg-zinc-800 flex items-center justify-center text-[9px] font-mono grayscale">
              {{ cat.fallback }}
            </span>
            <span>{{ cat.name }}</span>
          </button>
        </div>
      </div>
      <!-- Grid Kartu Projek (Komponen 10 CardImage) -->
      <div class="grid grid-cols-2 gap-3 sm:gap-4 lg:grid-cols-3 lg:gap-6">
        <div
          v-for="project in filteredProjects"
          :key="project.id"
          class="rounded-xl border border-zinc-200 dark:border-zinc-800 bg-white dark:bg-zinc-900/70 overflow-hidden shadow-2xs hover:shadow-md hover:border-zinc-300 dark:hover:border-zinc-700 transition-all flex flex-col group">
          <!-- Gambar Banner Projek dengan Aspect Video (Komponen 10) -->
          <div class="relative aspect-[21/10] lg:aspect-video w-full overflow-hidden bg-zinc-100 dark:bg-zinc-800">
            <div class="absolute inset-0 z-10 bg-black/25 dark:bg-black/40 transition-opacity group-hover:opacity-10"></div>
            <img
              :src="project.image"
              :alt="project.title"
              class="relative z-0 size-full object-cover grayscale brightness-95 dark:brightness-60 group-hover:scale-105 group-hover:grayscale-0 transition-all duration-300"/>
            <!-- Badge Tipe & Featured (Komponen 1 & 10) -->
            <div class="absolute top-2 left-2 z-20 flex items-center gap-1 sm:top-3 sm:left-3 sm:gap-1.5">
              <span class="border border-white/20 bg-black/60 backdrop-blur-sm text-white px-2 py-0.5 rounded text-[11px] font-medium">
                {{ project.category }}
              </span>
              <span v-if="project.featured" class="border border-white/30 bg-white/90 text-zinc-900 px-1.5 sm:px-2 py-0.5 rounded text-[10px] sm:text-[11px] font-semibold">
                Featured
              </span>
            </div>
          </div>
          <!-- Isi Kartu (CardHeader & CardContent Shadcn) -->
          <div class="p-2.5 sm:p-5 flex-1 flex flex-col justify-between space-y-2.5 sm:space-y-4">
            <div class="space-y-1.5 sm:space-y-2">
              <h3 class="font-bold text-sm sm:text-base text-zinc-900 dark:text-white group-hover:underline underline-offset-4">
                {{ project.title }}
              </h3>
              <p class="text-xs text-zinc-500 dark:text-zinc-400 leading-relaxed">
                {{ project.description }}
              </p>
            </div>
            <div class="space-y-2 sm:space-y-3 pt-1.5 sm:pt-2">
              <!-- Tech Badges -->
              <div class="flex flex-wrap gap-1.5">
                <span
                  v-for="tech in project.techs"
                  :key="tech"
                  class="border border-zinc-200 dark:border-zinc-800 bg-zinc-50 dark:bg-zinc-800/80 rounded px-1.5 sm:px-2 py-0.5 text-[10px] font-mono text-zinc-600 dark:text-zinc-400">
                  {{ tech }}
                </span>
              </div>
              <!-- Tombol CardFooter: Buka Tautan (Komponen 1: BadgeAsLink) -->
              <div class="pt-1.5 sm:pt-2 border-t border-zinc-100 dark:border-zinc-800 flex items-center justify-between">
                <span class="text-[11px] text-zinc-400 dark:text-zinc-500">Tahun: {{ project.year }}</span>
                <a
                  v-if="hasProjectLink(project)"
                  :href="project.link"
                  target="_blank"
                  rel="noopener noreferrer"
                  class="inline-flex items-center gap-1 text-xs font-semibold text-zinc-900 dark:text-white hover:underline underline-offset-4">
                  <span>Buka Projek</span>
                  <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M7 7h10v10M7 17 17 7"/>
                  </svg>
                </a>
                <button
                  v-else
                  type="button"
                  class="inline-flex items-center gap-1 text-xs font-semibold text-zinc-900 dark:text-white hover:underline underline-offset-4"
                  @click="selectedProject = project">
                  <span>Buka Projek</span>
                  <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M7 7h10v10M7 17 17 7"/>
                  </svg>
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <Teleport to="body">
    <div
      v-if="selectedProject"
      class="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto overscroll-y-contain bg-black/55 p-3 sm:p-6"
      @click.self="selectedProject = null">
      <div
        class="my-auto w-fit max-w-[calc(100vw-1.5rem)] overflow-hidden rounded-2xl border border-zinc-200 bg-white shadow-sm dark:border-zinc-800 dark:bg-zinc-900 sm:max-w-[calc(100vw-3rem)]"
        :style="{ width: projectDialogWidth ? `${projectDialogWidth}px` : undefined }"
        role="dialog"
        aria-modal="true"
        aria-labelledby="project-detail-title">
        <div class="mx-auto w-full max-w-full p-5 sm:p-6">
          <div class="relative -mx-5 mb-7 h-[44vh] min-h-48 max-h-96 w-[calc(100%+2.5rem)] overflow-hidden rounded-2xl border border-zinc-200 bg-zinc-50 dark:border-zinc-800 dark:bg-zinc-950 sm:-mx-6 sm:mb-8 sm:w-[calc(100%+3rem)]">
            <img :src="selectedProject.image" :alt="selectedProject.title" class="h-full w-auto max-w-full object-contain" @load="setProjectDialogWidth">
            <button
              type="button"
              class="absolute right-4 top-4 rounded-lg border border-zinc-200 bg-white/90 p-2.5 text-zinc-600 shadow-sm backdrop-blur transition hover:bg-white dark:border-zinc-700 dark:bg-zinc-900/90 dark:text-zinc-300 dark:hover:bg-zinc-900"
              aria-label="Tutup detail projek"
              @click="selectedProject = null">
              <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="m18 6-12 12M6 6l12 12"/>
              </svg>
            </button>
          </div>
          <div class="space-y-4">
            <div class="flex flex-wrap items-center gap-2">
              <span class="rounded-md bg-zinc-100 px-2 py-1 text-xs font-medium text-zinc-700 dark:bg-zinc-800 dark:text-zinc-300">{{ selectedProject.category }}</span>
              <span v-if="selectedProject.featured" class="rounded-md bg-zinc-900 px-2 py-1 text-xs font-medium text-white dark:bg-white dark:text-zinc-900">Featured</span>
            </div>
            <div>
              <h2 id="project-detail-title" class="text-2xl font-bold text-zinc-900 dark:text-white">{{ selectedProject.title }}</h2>
              <p class="mt-2 text-base leading-7 text-zinc-600 dark:text-zinc-300">{{ selectedProject.description }}</p>
            </div>
            <div v-if="selectedProject.techs.length" class="flex flex-wrap gap-2">
              <span
                v-for="tech in selectedProject.techs"
                :key="tech"
                class="rounded border border-zinc-200 bg-zinc-50 px-2 py-1 font-mono text-xs text-zinc-600 dark:border-zinc-700 dark:bg-zinc-800 dark:text-zinc-300">
                {{ tech }}
              </span>
            </div>
            <div class="space-y-3 border-t border-zinc-100 pt-5 text-sm dark:border-zinc-800">
              <p class="text-zinc-500 dark:text-zinc-400">Tahun: {{ selectedProject.year }}</p>
              <a
                v-if="hasProjectLink(selectedProject)"
                :href="selectedProject.link"
                target="_blank"
                rel="noopener noreferrer"
                class="inline-flex h-11 w-full items-center justify-center rounded-lg bg-zinc-900 px-4 text-sm font-semibold text-white transition hover:bg-zinc-700 dark:bg-blue-600 dark:text-white dark:hover:bg-blue-500">
                Buka tautan projek
              </a>
              <p v-else class="text-xs text-zinc-500 dark:text-zinc-400">Tautan projek belum ditambahkan.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </Teleport>
</template>

<script setup>
import { ref, computed, watch, onMounted, onUnmounted } from 'vue';
import { loadPortfolioContent } from '../portfolio-content';

const activeCategory = ref('Semua');
const projects = ref(loadPortfolioContent().projects);
const selectedProject = ref(null);
const projectDialogWidth = ref(null);
let previousDocumentOverflow = '';
let previousBodyOverflow = '';
let pageScrollLocked = false;

const categoryFallbacks = {
  UMKM: 'UM',
  Portofolio: 'PF',
  'Sistem Informasi': 'SI',
  Aplikasi: 'AP',
};

const categories = computed(() => [
  { name: 'Semua', fallback: '' },
  ...[...new Set(projects.value.map((project) => project.category))].map((name) => ({
    name,
    fallback: categoryFallbacks[name] ?? name.slice(0, 2).toUpperCase(),
  })),
]);

const filteredProjects = computed(() => {
  if (activeCategory.value === 'Semua') return projects.value;
  return projects.value.filter((project) => project.category === activeCategory.value);
});

function hasProjectLink(project) {
  return typeof project.link === 'string'
    && project.link.trim() !== ''
    && project.link.trim() !== '#';
}

function setPageScrollLocked(locked) {
  if (locked === pageScrollLocked) {
    return;
  }

  if (locked) {
    previousDocumentOverflow = document.documentElement.style.overflow;
    previousBodyOverflow = document.body.style.overflow;
    document.documentElement.style.overflow = 'hidden';
    document.body.style.overflow = 'hidden';
  } else {
    document.documentElement.style.overflow = previousDocumentOverflow;
    document.body.style.overflow = previousBodyOverflow;
  }

  pageScrollLocked = locked;
}

function setProjectDialogWidth(event) {
  const image = event.currentTarget;

  if (!image.naturalWidth || !image.naturalHeight) {
    return;
  }

  const overlayPadding = window.innerWidth >= 640 ? 48 : 24;
  const maxDialogWidth = Math.min(1024, window.innerWidth - overlayPadding);
  const maxImageHeight = Math.min(Math.max(window.innerHeight * 0.44, 192), 384);
  const maxImageWidth = Math.max(0, maxDialogWidth - 2);
  const imageWidth = Math.min(maxImageHeight * (image.naturalWidth / image.naturalHeight), maxImageWidth);

  projectDialogWidth.value = Math.ceil(imageWidth + 2);
}

function updatePortfolioContent(event) {
  projects.value = event.detail.projects;
}

function handleKeydown(event) {
  if (event.key === 'Escape') {
    selectedProject.value = null;
  }
}

onMounted(() => {
  window.addEventListener('portfolio-content-updated', updatePortfolioContent);
  window.addEventListener('keydown', handleKeydown);
});

watch(selectedProject, (project) => {
  projectDialogWidth.value = null;
  setPageScrollLocked(Boolean(project));
});

onUnmounted(() => {
  setPageScrollLocked(false);
  window.removeEventListener('portfolio-content-updated', updatePortfolioContent);
  window.removeEventListener('keydown', handleKeydown);
});
</script>
