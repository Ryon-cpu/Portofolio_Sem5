<template>
  <section id="hero" class="min-h-0 sm:min-h-screen flex items-center pt-20 pb-10 sm:pt-24 sm:pb-16 bg-white dark:bg-zinc-950 transition-colors overflow-x-hidden">
    <div class="max-w-6xl mx-auto px-6 w-full overflow-x-hidden">
      <div class="flex flex-col-reverse lg:flex-row items-center justify-between gap-8 sm:gap-12 lg:gap-16">
        <!-- Kiri: Detail Profil & Teks -->
        <div class="flex-1 space-y-4 sm:space-y-6 text-center lg:text-left">
          <!-- Headline / Judul Utama -->
          <div class="space-y-3">
            <h1 :aria-label="profile.headline" class="relative text-3xl sm:text-4xl lg:text-5xl font-bold tracking-tight text-zinc-900 dark:text-white leading-[1.15]">
              <span class="invisible" aria-hidden="true">{{ profile.headline }}</span>
              <span class="absolute inset-0" aria-hidden="true">{{ typedHeadline }}</span>
            </h1>
            <p class="text-base sm:text-lg text-zinc-600 dark:text-zinc-400 max-w-xl mx-auto lg:mx-0 leading-relaxed font-normal">
              Halo! Saya <span class="font-semibold text-zinc-900 dark:text-zinc-100">{{ profile.name }}</span>, {{ profile.role }}. {{ profile.bio }}
            </p>
          </div>
          <!-- Pencarian Cepat di Portofolio (Komponen 7: ButtonGroupInput) -->
          <div class="max-w-md mx-auto lg:mx-0">
            <div class="flex rounded-lg shadow-sm border border-zinc-200 dark:border-zinc-800 bg-white dark:bg-zinc-900 overflow-hidden focus-within:border-zinc-400 dark:focus-within:border-zinc-600 transition-colors">
              <input
                v-model="quickSearchQuery"
                @keyup.enter="handleSearch"
                type="text"
                placeholder="Cari proyek, teknologi, atau info (tekan Enter)..."
                class="flex-1 px-3.5 py-2 text-xs sm:text-sm bg-transparent text-zinc-900 dark:text-white placeholder-zinc-400 dark:placeholder-zinc-500 focus:outline-none"/>
              <button
                @click="handleSearch"
                type="button"
                aria-label="Search"
                class="px-3.5 py-2 border-l border-zinc-200 dark:border-zinc-800 text-zinc-500 hover:text-zinc-900 dark:text-zinc-400 dark:hover:text-white hover:bg-zinc-50 dark:hover:bg-zinc-800 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/>
                </svg>
              </button>
            </div>
          </div>
          <!-- Tombol Aksi & Ukuran Tombol Shadcn (Komponen 6) -->
          <div class="flex flex-wrap items-center justify-center lg:justify-start gap-3 pt-1">
            <!-- Button Utama (Shadcn default variant) -->
            <a
              href="#projects"
              class="inline-flex items-center gap-2 px-5 py-2.5 rounded-md text-sm font-medium bg-zinc-900 text-white hover:bg-zinc-800 dark:bg-blue-600 dark:text-white dark:hover:bg-blue-500 shadow-sm transition-colors">
              <span>Lihat Portofolio</span>
              <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M7 7h10v10M7 17 17 7"/>
              </svg>
            </a>
            <a
              href="#personal-info"
              class="inline-flex items-center gap-2 px-4 py-2 rounded-md text-sm font-medium border border-zinc-200 dark:border-zinc-800 text-zinc-800 dark:text-zinc-200 hover:bg-zinc-100 dark:hover:bg-zinc-900 transition-colors">
              <span>Data Diri</span>
            </a>
            <a
              href="#contact"
              class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-md text-xs font-medium border border-zinc-200 dark:border-zinc-800 text-zinc-600 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white hover:bg-zinc-50 dark:hover:bg-zinc-900 transition-colors">
              <span>Hubungi Saya</span>
              <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M7 7h10v10M7 17 17 7"/>
              </svg>
            </a>
          </div>
          <!-- Tautan Media Sosial (Komponen 6) -->
          <div class="flex flex-wrap items-center justify-center lg:justify-start gap-3 pt-2 text-xs text-zinc-500">
            <span class="text-zinc-400 dark:text-zinc-500">Sosial media:</span>
            <div class="flex items-center gap-2">
              <a
                v-for="item in socialLinks"
                :key="item.name"
                :href="item.href"
                target="_blank"
                rel="noreferrer"
                class="inline-flex items-center gap-1 px-2.5 py-1 border border-zinc-200 dark:border-zinc-800 rounded-md text-xs text-zinc-600 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white hover:border-zinc-300 dark:hover:border-zinc-700 transition-colors"
                :aria-label="item.name">
                <span>{{ item.name }}</span>
                <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M7 7h10v10M7 17 17 7"/>
                </svg>
              </a>
            </div>
          </div>
        </div>
        <!-- Kanan: Card Avatar & Status Visual Monokrom (Komponen 2, 3, 4) -->
        <div class="flex-shrink-0 flex flex-col items-center w-full lg:w-auto lg:self-start lg:mt-16">
          <div class="relative group px-4 pb-4">
            <!-- Bingkai Avatar Monokrom -->
            <div class="w-48 h-48 sm:w-60 sm:h-60 lg:w-64 lg:h-64 rounded-full p-2 border border-zinc-200 dark:border-zinc-800 bg-zinc-50 dark:bg-zinc-900 shadow-lg">
              <div class="w-full h-full rounded-full overflow-hidden bg-zinc-100 dark:bg-zinc-800 relative">
                <!-- Foto Profil -->
                <img
                  :src="profile.avatar"
                  :alt="profile.name"
                  class="w-full h-full object-cover transition-all duration-300 group-hover:scale-105"/>
              </div>
            </div>
            <!-- Avatar Badge Status Online (Komponen 2) / Offline (Komponen 3) -->
            <div
              v-if="profile.online"
              class="absolute -bottom-3 -right-3 border border-zinc-200 dark:border-zinc-800 rounded-xl bg-white dark:bg-zinc-900 px-3 py-1.5 shadow-md flex items-center gap-2">
              <span class="relative flex h-2.5 w-2.5">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-500 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-green-600 dark:bg-green-500"></span>
              </span>
              <span class="text-xs font-medium text-zinc-800 dark:text-zinc-200">Online</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { computed, onMounted, onUnmounted, ref } from 'vue';
import { loadPortfolioContent } from '../portfolio-content';

const emit = defineEmits(['open-search']);

const portfolioContent = ref(loadPortfolioContent());
const profile = computed(() => portfolioContent.value.profile);
const typedHeadline = ref('');
const quickSearchQuery = ref('');
const socialLinks = computed(() => portfolioContent.value.socialLinks);
let headlineTypingInterval = null;

function typeHeadline(headline) {
  if (headlineTypingInterval !== null) {
    window.clearInterval(headlineTypingInterval);
    headlineTypingInterval = null;
  }

  const characters = Array.from(headline);
  let visibleCharacters = 0;
  let isDeleting = false;
  let pauseUntil = 0;
  typedHeadline.value = '';
  headlineTypingInterval = window.setInterval(() => {
    const now = Date.now();

    if (now < pauseUntil) {
      return;
    }

    if (isDeleting && visibleCharacters > 0) {
      visibleCharacters -= 1;
      typedHeadline.value = characters.slice(0, visibleCharacters).join('');
      return;
    }

    if (isDeleting) {
      isDeleting = false;
      pauseUntil = now + 300;
      return;
    }

    if (visibleCharacters < characters.length) {
      visibleCharacters += 1;
      typedHeadline.value = characters.slice(0, visibleCharacters).join('');
      return;
    }

    isDeleting = true;
    pauseUntil = now + 1100;
  }, 70);
}

function handleSearch() {
  emit('open-search');
}

function updatePortfolioContent(event) {
  const previousHeadline = profile.value.headline;
  portfolioContent.value = event.detail;

  if (profile.value.headline !== previousHeadline) {
    typeHeadline(profile.value.headline);
  }
}

onMounted(() => {
  typeHeadline(profile.value.headline);
  window.addEventListener('portfolio-content-updated', updatePortfolioContent);
});

onUnmounted(() => {
  window.removeEventListener('portfolio-content-updated', updatePortfolioContent);

  if (headlineTypingInterval !== null) {
    window.clearInterval(headlineTypingInterval);
  }
});
</script>
