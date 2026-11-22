<template>
  <nav
    class="fixed top-0 left-0 right-0 z-40 border-b border-white/60 backdrop-blur-xl backdrop-saturate-150 transition-colors duration-300 dark:border-white/10 md:hidden"
    :class="isScrolled ? 'bg-white/70 dark:bg-zinc-950/70' : 'bg-white/85 dark:bg-zinc-950/85'">
    <div class="mx-auto flex h-16 max-w-6xl items-center justify-between gap-4 px-6">
      <a href="#hero" class="flex items-center gap-2 text-sm font-semibold tracking-tight text-zinc-900 dark:text-white">
        <span>{{ profile.name }}</span>
        <span class="inline-block size-1.5 rounded-full bg-zinc-900 dark:bg-white"></span>
      </a>
      <div class="flex items-center gap-2 sm:gap-3">
        <button
          type="button"
          class="hidden items-center gap-2 rounded-md border border-zinc-200 bg-zinc-50 px-2.5 py-1.5 text-xs text-zinc-500 transition-colors hover:border-zinc-300 hover:text-zinc-900 dark:border-zinc-800 dark:bg-zinc-900 dark:text-zinc-400 dark:hover:border-zinc-700 dark:hover:text-white sm:inline-flex"
          aria-label="Cari di portofolio"
          @click="$emit('open-search')">
          <Search class="size-3.5" />
          <span>Cari...</span>
          <kbd class="hidden rounded border border-zinc-200 bg-white px-1.5 py-0.5 font-mono text-[10px] text-zinc-400 dark:border-zinc-700 dark:bg-zinc-800 md:inline-block">⌘K</kbd>
        </button>
        <div class="hidden items-center gap-2 px-1 sm:flex" aria-label="Status profil">
          <span class="relative flex size-2">
            <span v-if="profile.online" class="absolute inline-flex size-full animate-ping rounded-full bg-green-500 opacity-75"></span>
            <span class="relative inline-flex size-2 rounded-full" :class="profile.online ? 'bg-green-600 dark:bg-green-500' : 'bg-zinc-400'"></span>
          </span>
          <span class="text-xs text-zinc-500 dark:text-zinc-400">{{ profile.online ? 'Online' : 'Offline' }}</span>
        </div>
        <a
          href="#contact"
          class="inline-flex items-center gap-1.5 rounded-md border border-zinc-200 px-3 py-1.5 text-xs font-medium text-zinc-800 transition-colors hover:bg-zinc-100 dark:border-zinc-800 dark:text-zinc-200 dark:hover:bg-zinc-900"
          @click="activateLink('#contact')">
          <span>Kontak</span>
        </a>
        <button
          type="button"
          class="rounded-md border border-zinc-200 p-2 text-zinc-600 transition-colors hover:bg-zinc-100 hover:text-zinc-900 dark:border-zinc-800 dark:text-zinc-400 dark:hover:bg-zinc-900 dark:hover:text-white"
          :aria-label="isDark ? 'Aktifkan tema terang' : 'Aktifkan tema gelap'"
          @click="$emit('toggle-theme')">
          <Sun v-if="isDark" class="size-4" />
          <Moon v-else class="size-4" />
        </button>
        <button
          type="button"
          class="rounded-md border border-zinc-200 p-2 text-zinc-600 hover:text-zinc-900 dark:border-zinc-800 dark:text-zinc-400 dark:hover:text-white"
          :aria-expanded="mobileMenuOpen"
          aria-label="Toggle menu navigasi"
          @click="mobileMenuOpen = !mobileMenuOpen">
          <Menu class="size-4" />
        </button>
      </div>
    </div>
    <div v-if="mobileMenuOpen" class="flex flex-col gap-3 border-t border-zinc-200 bg-white px-6 py-4 text-sm text-zinc-600 dark:border-zinc-800 dark:bg-zinc-950 dark:text-zinc-400">
      <a
        v-for="link in navLinks"
        :key="link.href"
        :href="link.href"
        class="py-1 transition-colors hover:text-zinc-900 dark:hover:text-white"
        @click="activateLink(link.href)">
        {{ link.label }}
      </a>
      <button
        type="button"
        class="flex items-center gap-2 py-1 text-left text-zinc-500 hover:text-zinc-900 dark:hover:text-white"
        @click="$emit('open-search'); mobileMenuOpen = false">
        <Search class="size-3.5" />
        <span>Pencarian Cepat (⌘K)</span>
      </button>
    </div>
  </nav>
  <nav class="fixed inset-x-0 top-4 z-40 hidden px-4 md:block" aria-label="Navigasi utama">
    <div
      class="mx-auto flex w-fit max-w-full items-center gap-1 rounded-full border border-zinc-300/80 p-1.5 backdrop-blur-xl backdrop-saturate-150 transition-colors duration-300 dark:border-zinc-700/80"
      :class="isScrolled ? 'bg-white/70 dark:bg-zinc-950/70' : 'bg-white/85 dark:bg-zinc-950/85'">
      <a
        href="#hero"
        class="hidden size-9 shrink-0 items-center justify-center rounded-full text-zinc-600 transition-colors hover:bg-zinc-100 hover:text-zinc-900 dark:text-zinc-400 dark:hover:bg-zinc-800 dark:hover:text-white md:inline-flex lg:hidden"
        :class="activeSection === '#hero' ? 'bg-zinc-100 text-zinc-900 dark:bg-blue-600 dark:text-white' : ''"
        aria-label="Beranda"
        :aria-current="activeSection === '#hero' ? 'page' : undefined"
        @click="activateLink('#hero')">
        <Home class="size-4" />
      </a>
      <a href="#hero" class="hidden shrink-0 items-center gap-2 rounded-full px-3 text-sm font-semibold tracking-tight text-zinc-900 dark:text-white lg:flex" @click="activateLink('#hero')">
        <span>{{ profile.name }}</span>
        <span class="size-1.5 rounded-full" :class="profile.online ? 'bg-green-600 dark:bg-green-500' : 'bg-zinc-400'"></span>
      </a>
      <div class="flex items-center gap-0.5">
        <a
          v-for="link in navLinks"
          :key="link.href"
          :href="link.href"
          class="whitespace-nowrap rounded-full px-2.5 py-2 text-xs transition-colors lg:px-3"
          :class="activeSection === link.href
            ? 'bg-zinc-900 font-medium text-white dark:bg-blue-600 dark:text-white'
            : 'text-zinc-600 hover:bg-zinc-100 hover:text-zinc-900 dark:text-zinc-400 dark:hover:bg-zinc-800 dark:hover:text-white'"
          :aria-current="activeSection === link.href ? 'page' : undefined"
          @click="activateLink(link.href)">
          {{ link.label }}
        </a>
      </div>
      <div class="mx-1 hidden h-6 w-px bg-zinc-200 dark:bg-zinc-800 lg:block"></div>
      <div class="hidden items-center gap-1.5 px-1.5 xl:flex">
        <span class="relative flex size-2">
          <span v-if="profile.online" class="absolute inline-flex size-full animate-ping rounded-full bg-green-500 opacity-75"></span>
          <span class="relative inline-flex size-2 rounded-full" :class="profile.online ? 'bg-green-600 dark:bg-green-500' : 'bg-zinc-400'"></span>
        </span>
        <span class="text-xs text-zinc-500 dark:text-zinc-400">{{ profile.online ? 'Online' : 'Offline' }}</span>
      </div>
      <button
        type="button"
        class="inline-flex size-9 shrink-0 items-center justify-center rounded-full text-zinc-600 transition-colors hover:bg-zinc-100 hover:text-zinc-900 dark:text-zinc-400 dark:hover:bg-zinc-800 dark:hover:text-white"
        aria-label="Cari di portofolio"
        @click="$emit('open-search')">
        <Search class="size-4" />
      </button>
      <a
        href="#contact"
        class="hidden shrink-0 items-center gap-1.5 rounded-full border border-zinc-200 px-3 py-2 text-xs font-medium text-zinc-800 transition-colors hover:bg-zinc-100 dark:border-zinc-800 dark:text-zinc-200 dark:hover:bg-zinc-900 lg:inline-flex"
        @click="activateLink('#contact')">
        Kontak
      </a>
      <button
        type="button"
        class="inline-flex size-9 shrink-0 items-center justify-center rounded-full text-zinc-600 transition-colors hover:bg-zinc-100 hover:text-zinc-900 dark:text-zinc-400 dark:hover:bg-zinc-800 dark:hover:text-white"
        :aria-label="isDark ? 'Aktifkan tema terang' : 'Aktifkan tema gelap'"
        @click="$emit('toggle-theme')">
        <Sun v-if="isDark" class="size-4" />
        <Moon v-else class="size-4" />
      </button>
    </div>
  </nav>
</template>

<script setup>
import { onMounted, onUnmounted, ref } from 'vue';
import { Home, Menu, Moon, Search, Sun } from 'lucide-vue-next';
import { loadPortfolioContent } from '../portfolio-content';

defineProps({
  isDark: Boolean,
});

defineEmits(['toggle-theme', 'open-search']);

const mobileMenuOpen = ref(false);
const profile = ref(loadPortfolioContent().profile);
const activeSection = ref('#hero');
const isScrolled = ref(false);
const navLinks = [
  { href: '#personal-info', label: 'Data Diri' },
  { href: '#about', label: 'Ringkasan' },
  { href: '#skills', label: 'Keahlian' },
  { href: '#projects', label: 'Portofolio' },
  { href: '#achievements', label: 'Prestasi' },
  { href: '#contact', label: 'Kontak' },
];
let sectionObserver;

function updatePortfolioContent(event) {
  profile.value = event.detail.profile;
}

function updateScrollState() {
  isScrolled.value = window.scrollY > 16;
}

function activateLink(href) {
  activeSection.value = href;
  mobileMenuOpen.value = false;
}

function updateActiveSection(entries) {
  const visibleSections = entries
    .filter((entry) => entry.isIntersecting)
    .sort((first, second) => first.boundingClientRect.top - second.boundingClientRect.top);

  if (visibleSections.length > 0) {
    activeSection.value = `#${visibleSections[0].target.id}`;
  }
}

onMounted(() => {
  window.addEventListener('portfolio-content-updated', updatePortfolioContent);
  window.addEventListener('scroll', updateScrollState, { passive: true });
  updateScrollState();
  sectionObserver = new IntersectionObserver(updateActiveSection, {
    rootMargin: '-20% 0px -65% 0px',
    threshold: 0,
  });

  ['hero', ...navLinks.map((link) => link.href.slice(1))].forEach((sectionId) => {
    const section = document.getElementById(sectionId);

    if (section) {
      sectionObserver.observe(section);
    }
  });
});

onUnmounted(() => {
  window.removeEventListener('portfolio-content-updated', updatePortfolioContent);
  window.removeEventListener('scroll', updateScrollState);
  sectionObserver?.disconnect();
});
</script>