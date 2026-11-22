<template>
  <footer class="border-t border-zinc-200 dark:border-zinc-800 bg-white dark:bg-zinc-950 transition-colors py-8 sm:py-10">
    <div class="max-w-6xl mx-auto px-6 space-y-4 sm:space-y-6">
      <!-- Row Atas -->
      <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-6">
        <!-- Branding -->
        <div class="space-y-1">
          <div class="font-semibold text-zinc-900 dark:text-white text-sm tracking-tight">{{ profile.name }}</div>
          <p class="text-xs text-zinc-500 dark:text-zinc-400">{{ profile.role }} · Indonesia</p>
        </div>
      </div>
      <!-- Row Tengah: Nav & Sosial -->
      <div class="flex flex-col sm:flex-row justify-between gap-4 pt-4 border-t border-zinc-100 dark:border-zinc-900">
        <div class="flex flex-wrap gap-4 text-xs text-zinc-500 dark:text-zinc-400">
          <a v-for="link in footerLinks" :key="link.href" :href="link.href"
            class="hover:text-zinc-900 dark:hover:text-white transition-colors">
            {{ link.label }}
          </a>
        </div>
        <div class="flex items-center gap-2 text-[11px] text-zinc-400">
          <span class="relative flex h-1.5 w-1.5">
          <span v-if="profile.online" class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-500 opacity-75"></span>
          <span class="relative inline-flex rounded-full h-1.5 w-1.5" :class="profile.online ? 'bg-green-600 dark:bg-green-500' : 'bg-zinc-400'"></span>
          </span>
          {{ profile.online ? 'Siap menerima projek' : 'Sedang tidak tersedia' }}
        </div>
      </div>
      <!-- Row Bawah: Hak Cipta -->
      <div class="pt-4 border-t border-zinc-100 dark:border-zinc-900 flex flex-col sm:flex-row items-center justify-between gap-2 text-[11px] text-zinc-400 dark:text-zinc-500">
        <span>© {{ year }} {{ profile.name }}. Hak Cipta Dilindungi.</span>
      </div>
    </div>
  </footer>
</template>

<script setup>
import { onMounted, onUnmounted, ref } from 'vue';
import { loadPortfolioContent } from '../portfolio-content';

const year = new Date().getFullYear();
const profile = ref(loadPortfolioContent().profile);

const footerLinks = [
  { href: '#personal-info', label: 'Data Diri' },
  { href: '#about', label: 'Ringkasan' },
  { href: '#skills', label: 'Keahlian' },
  { href: '#projects', label: 'Portofolio' },
  { href: '#achievements', label: 'Prestasi' },
  { href: '#contact', label: 'Kontak' },
];

function updatePortfolioContent(event) {
  profile.value = event.detail.profile;
}

onMounted(() => {
  window.addEventListener('portfolio-content-updated', updatePortfolioContent);
});

onUnmounted(() => {
  window.removeEventListener('portfolio-content-updated', updatePortfolioContent);
});
</script>
