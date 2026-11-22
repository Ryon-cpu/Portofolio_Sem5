<template>
  <section id="achievements" class="py-12 sm:py-20 border-t border-zinc-200 dark:border-zinc-800 bg-white dark:bg-zinc-950 transition-colors overflow-x-hidden">
    <div class="max-w-6xl mx-auto px-2 w-full">
      <!-- Header di atas agar tidak memojokkan kartu ke kanan -->
      <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-6 sm:mb-8">
        <div class="space-y-1">
          <span class="text-xs font-semibold tracking-wider text-zinc-500 uppercase">Prestasi</span>
          <h2 class="text-2xl font-bold text-zinc-900 dark:text-white">Pencapaian & Pengalaman</h2>
        </div>
        <p class="text-xs text-zinc-500 dark:text-zinc-400 max-w-sm">
          Dokumentasi pencapaian utama.
        </p>
      </div>
      <!-- 4 Kartu Pencapaian dalam satu baris (lg:grid-cols-4) - Ukuran 19:6 Ringkas -->
      <div class="grid grid-cols-2 gap-3 sm:gap-4 lg:grid-cols-4 w-full">
        <div
          v-for="item in achievements"
          :key="item.title"
          class="rounded-xl border border-zinc-200 dark:border-zinc-800 overflow-hidden bg-white dark:bg-zinc-900 hover:border-zinc-300 dark:hover:border-zinc-700 transition-all group flex flex-col justify-between shadow-2xs hover:shadow-xs">
          <!-- Gambar Rasio 19:6 Sesuai Permintaan -->
          <div class="relative w-full overflow-hidden bg-zinc-100 dark:bg-zinc-800 shrink-0" style="aspect-ratio: 19 / 6;">
            <div class="absolute inset-0 z-10 bg-black/25 dark:bg-black/45"></div>
            <img
              :src="item.image"
              :alt="item.title"
              class="relative z-0 w-full h-full object-cover grayscale brightness-90 dark:brightness-60 group-hover:scale-105 group-hover:grayscale-0 transition-all duration-300"/>
            <!-- Badge Featured jika ada -->
            <div v-if="item.badge" class="absolute top-1.5 right-1.5 z-20">
              <span class="border border-white/20 bg-white/90 dark:bg-zinc-900/90 text-zinc-900 dark:text-white px-2 py-0.5 rounded-full text-[9px] font-semibold">
                {{ item.badge }}
              </span>
            </div>
          </div>
          <!-- Konten Kartu Ringkas -->
          <div class="p-2.5 sm:p-3.5 flex-1 flex flex-col justify-between gap-2 sm:gap-3">
            <div class="space-y-1">
              <h3 class="font-bold text-[11px] sm:text-xs text-zinc-900 dark:text-white leading-snug line-clamp-1">
                {{ item.title }}
              </h3>
              <p class="text-[10px] sm:text-[11px] text-zinc-500 dark:text-zinc-400 leading-relaxed line-clamp-2">
                {{ item.description }}
              </p>
            </div>
            <!-- Tombol Aksi -->
            <button
              @click="selectedAchievement = item"
              type="button"
              class="w-full border border-zinc-200 dark:border-zinc-700 rounded-md py-1 text-[10px] sm:py-1.5 sm:text-[11px] font-medium text-zinc-700 dark:text-zinc-300 hover:bg-zinc-50 dark:hover:bg-zinc-800 hover:text-zinc-950 dark:hover:text-white transition-colors">
              Lihat Detail
            </button>
          </div>
        </div>
      </div>
      <!-- Galeri dokumentasi -->
      <div class="mt-8 pt-6 sm:mt-12 sm:pt-8 border-t border-zinc-100 dark:border-zinc-900 space-y-3 sm:space-y-4">
        <div class="flex items-center justify-between">
          <div>
            <span class="text-[10px] font-semibold text-zinc-400 uppercase tracking-widest">Dokumentasi</span>
            <h3 class="text-sm font-bold text-zinc-900 dark:text-white">Galeri Foto Dokumentasi</h3>
          </div>
        </div>
        <div class="grid grid-cols-2 gap-3 sm:grid-cols-3 sm:gap-4 lg:grid-cols-4">
          <div
            v-for="doc in docs"
            :key="doc.id"
            class="group/item relative aspect-[4/3] overflow-hidden rounded-xl border border-zinc-200 bg-zinc-100 dark:border-zinc-800 dark:bg-zinc-900">
            <img
              :src="doc.image"
              :alt="doc.title"
              class="h-full w-full object-cover grayscale transition-all duration-300 brightness-90 group-hover/item:grayscale-0 dark:brightness-60"/>
            <div class="absolute inset-x-0 bottom-0 bg-linear-to-t from-black/70 to-transparent px-3 pb-2 pt-8 text-[10px] text-white">
              {{ doc.title }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <Teleport to="body">
    <div
      v-if="selectedAchievement"
      class="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto overscroll-y-contain bg-black/55 p-3 sm:p-6"
      @click.self="selectedAchievement = null">
      <div
        class="my-auto w-fit max-w-[calc(100vw-1.5rem)] overflow-hidden rounded-2xl border border-zinc-200 bg-white shadow-sm dark:border-zinc-800 dark:bg-zinc-900 sm:max-w-[calc(100vw-3rem)]"
        :style="{ width: achievementDialogWidth ? `${achievementDialogWidth}px` : undefined }"
        role="dialog"
        aria-modal="true"
        aria-labelledby="achievement-detail-title">
        <div class="mx-auto w-full max-w-full p-5 sm:p-6">
          <div class="relative -mx-5 mb-7 h-[44vh] min-h-48 max-h-96 w-[calc(100%+2.5rem)] overflow-hidden rounded-2xl border border-zinc-200 bg-zinc-50 dark:border-zinc-800 dark:bg-zinc-950 sm:-mx-6 sm:mb-8 sm:w-[calc(100%+3rem)]">
            <img :src="selectedAchievement.image" :alt="selectedAchievement.title" class="h-full w-auto max-w-full object-contain" @load="setAchievementDialogWidth">
            <button
              type="button"
              class="absolute right-4 top-4 rounded-lg border border-zinc-200 bg-white/90 p-2.5 text-zinc-600 shadow-sm backdrop-blur transition hover:bg-white dark:border-zinc-700 dark:bg-zinc-900/90 dark:text-zinc-300 dark:hover:bg-zinc-900"
              aria-label="Tutup detail pencapaian"
              @click="selectedAchievement = null">
              <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="m18 6-12 12M6 6l12 12"/>
              </svg>
            </button>
          </div>
          <div class="space-y-3">
            <span v-if="selectedAchievement.badge" class="inline-flex rounded-full border border-zinc-200 px-2.5 py-1 text-xs font-semibold text-zinc-700 dark:border-zinc-700 dark:text-zinc-300">
              {{ selectedAchievement.badge }}
            </span>
            <div>
              <h2 id="achievement-detail-title" class="text-2xl font-bold text-zinc-900 dark:text-white">{{ selectedAchievement.title }}</h2>
              <p class="mt-2 text-base leading-7 text-zinc-600 dark:text-zinc-300">{{ selectedAchievement.description }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </Teleport>
</template>

<script setup>
import { ref, watch, onMounted, onUnmounted } from 'vue';
import { loadPortfolioContent } from '../portfolio-content';

const docs = ref(loadPortfolioContent().gallery);

const achievements = ref(loadPortfolioContent().achievements);
const selectedAchievement = ref(null);
const achievementDialogWidth = ref(null);
let previousDocumentOverflow = '';
let previousBodyOverflow = '';
let pageScrollLocked = false;

function updatePortfolioContent(event) {
  docs.value = event.detail.gallery;
  achievements.value = event.detail.achievements;
}

function handleKeydown(event) {
  if (event.key === 'Escape') {
    selectedAchievement.value = null;
  }
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

function setAchievementDialogWidth(event) {
  const image = event.currentTarget;

  if (!image.naturalWidth || !image.naturalHeight) {
    return;
  }

  const overlayPadding = window.innerWidth >= 640 ? 48 : 24;
  const maxDialogWidth = Math.min(1024, window.innerWidth - overlayPadding);
  const maxImageHeight = Math.min(Math.max(window.innerHeight * 0.44, 192), 384);
  const maxImageWidth = Math.max(0, maxDialogWidth - 2);
  const imageWidth = Math.min(maxImageHeight * (image.naturalWidth / image.naturalHeight), maxImageWidth);

  achievementDialogWidth.value = Math.ceil(imageWidth + 2);
}

onMounted(() => {
  window.addEventListener('portfolio-content-updated', updatePortfolioContent);
  window.addEventListener('keydown', handleKeydown);
});

watch(selectedAchievement, (achievement) => {
  achievementDialogWidth.value = null;
  setPageScrollLocked(Boolean(achievement));
});

onUnmounted(() => {
  setPageScrollLocked(false);
  window.removeEventListener('portfolio-content-updated', updatePortfolioContent);
  window.removeEventListener('keydown', handleKeydown);
});
</script>
