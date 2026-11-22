<template>
  <section id="skills" class="py-12 sm:py-20 border-t border-zinc-200 dark:border-zinc-800 bg-white dark:bg-zinc-950 transition-colors overflow-x-hidden">
    <div class="max-w-6xl mx-auto px-6 w-full">
      <!-- Header di atas agar layout simetris & seimbang -->
      <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-6 sm:mb-8">
        <div class="space-y-1">
          <span class="text-xs font-semibold tracking-wider text-zinc-500 uppercase">Keahlian</span>
          <h2 class="text-2xl font-bold text-zinc-900 dark:text-white">Tech Stack & Tools</h2>
        </div>
        <p class="text-xs text-zinc-500 dark:text-zinc-400 max-w-sm">
          Keahlian yang saya miliki saat ini.
        </p>
      </div>
      <!-- Grid 3 Kolom Kategori (Memanfaatkan Ruang Penuh Kiri-Kanan) -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-4 sm:gap-6 w-full">
        <div
          v-for="category in skillCategories"
          :key="category.name"
          class="p-4 sm:p-5 rounded-xl border border-zinc-200 dark:border-zinc-800 bg-zinc-50/50 dark:bg-zinc-900/40 space-y-3 sm:space-y-4 shadow-2xs">
          <div class="flex items-center justify-between border-b border-zinc-200/70 dark:border-zinc-800 pb-2.5">
            <h3 class="text-xs font-semibold text-zinc-600 dark:text-zinc-400 uppercase tracking-wider">
              {{ category.name }}
            </h3>
          </div>

          <div class="flex flex-wrap gap-2">
            <div
              v-for="skill in category.skills"
              :key="skill.name"
              class="relative group">
              <!-- Trigger Button/Badge (Shadcn style) -->
              <button
                type="button"
                class="inline-flex items-center gap-2 border border-zinc-200 dark:border-zinc-800 rounded-lg px-2.5 py-1.5 text-xs font-medium text-zinc-700 dark:text-zinc-300 bg-white dark:bg-zinc-900 hover:bg-zinc-100 dark:hover:bg-zinc-800 hover:border-zinc-400 dark:hover:border-zinc-600 hover:text-zinc-950 dark:hover:text-white transition-all shadow-2xs">
                <span>{{ skill.name }}</span>
              </button>
              <!-- Hover Card Content (Komponen 18 HoverCardDemo) -->
              <div class="absolute bottom-full left-0 mb-2 w-64 p-3.5 bg-white dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-xl shadow-lg opacity-0 pointer-events-none group-hover:opacity-100 group-hover:pointer-events-auto transition-all duration-150 z-30">
                <div class="flex items-start gap-3">
                  <div class="w-8 h-8 rounded-full border border-zinc-200 dark:border-zinc-700 bg-zinc-100 dark:bg-zinc-800 flex items-center justify-center text-xs font-bold font-mono text-zinc-700 dark:text-zinc-300 flex-shrink-0">
                    {{ skill.initial }}
                  </div>
                  <div class="flex-1 min-w-0">
                    <div class="text-xs font-semibold text-zinc-900 dark:text-white">{{ skill.handle }}</div>
                    <p class="text-[11px] text-zinc-500 dark:text-zinc-400 mt-1 leading-normal">{{ skill.description }}</p>
                    <div class="mt-2 text-[10px] text-zinc-400 border-t border-zinc-100 dark:border-zinc-800 pt-1.5 flex items-center justify-between">
                      <span>Tingkat: {{ skill.level }}</span>
                      <span>Sejak: {{ skill.since }}</span>
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>

    </div>
  </section>
</template>

<script setup>
import { onMounted, onUnmounted, ref } from 'vue';
import { loadPortfolioContent } from '../portfolio-content';

const fallbackSkillCategories = [
  {
    name: 'Frontend Framework & Styling',
    skills: [
      {
        name: 'Vue.js',
        tag: '01',
        initial: 'VU',
        handle: '@vuejs',
        description: 'Framework progresif untuk membangun antarmuka web reaktif dengan Composition API.',
        level: 'Mahir',
        since: '2023',
      },
      {
        name: 'Tailwind CSS',
        tag: '02',
        initial: 'TW',
        handle: '@tailwindcss',
        description: 'Utility-first CSS framework untuk pembuatan layout responsif dan sistem desain yang konsisten.',
        level: 'Mahir',
        since: '2022',
      },
      {
        name: 'Shadcn UI',
        tag: '03',
        initial: 'SC',
        handle: '@shadcn',
        description: 'Kumpulan komponen UI monokrom berbasis aksesibilitas Radix & Tailwind.',
        level: 'Mahir',
        since: '2024',
      },
      {
        name: 'TypeScript',
        tag: '04',
        initial: 'TS',
        handle: '@typescript',
        description: 'JavaScript dengan sistem tipe statis untuk kode yang aman dan terdokumentasi.',
        level: 'Menengah',
        since: '2023',
      },
    ],
  },
  {
    name: 'Backend & Database',
    skills: [
      {
        name: 'PHP',
        tag: '05',
        initial: 'PH',
        handle: '@php',
        description: 'Bahasa pemrograman server-side yang andal dan menjadi pondasi backend web.',
        level: 'Mahir',
        since: '2022',
      },
      {
        name: 'Laravel',
        tag: '06',
        initial: 'LV',
        handle: '@laravel',
        description: 'Framework PHP modern dengan ekosistem routing, Eloquent ORM, dan migrasi database.',
        level: 'Mahir',
        since: '2022',
      },
      {
        name: 'MySQL',
        tag: '07',
        initial: 'SQL',
        handle: '@mysql',
        description: 'Sistem manajemen basis data relasional untuk penyimpanan data yang terstruktur.',
        level: 'Mahir',
        since: '2022',
      },
      {
        name: 'RESTful API',
        tag: '08',
        initial: 'API',
        handle: '@restapi',
        description: 'Desain integrasi stateless endpoint komunikasi backend dan frontend.',
        level: 'Mahir',
        since: '2023',
      },
    ],
  },
  {
    name: 'Tooling & Arsitektur',
    skills: [
      {
        name: 'Vite',
        tag: '09',
        initial: 'VT',
        handle: '@vitejs',
        description: 'Frontend tooling dengan Hot Module Replacement (HMR) super cepat.',
        level: 'Mahir',
        since: '2023',
      },
      {
        name: 'Git & GitHub',
        tag: '10',
        initial: 'GH',
        handle: '@git',
        description: 'Version control system untuk manajemen cabang dan kolaborasi repository kode.',
        level: 'Mahir',
        since: '2022',
      },
      {
        name: 'Figma',
        tag: '11',
        initial: 'FG',
        handle: '@figma',
        description: 'Perancangan wireframe, prototipe antarmuka, dan sistem desain visual.',
        level: 'Menengah',
        since: '2023',
      },
    ],
  },
];

const skillCategories = ref(loadPortfolioContent().skills ?? fallbackSkillCategories);

function updatePortfolioContent(event) {
  skillCategories.value = event.detail.skills;
}

onMounted(() => {
  window.addEventListener('portfolio-content-updated', updatePortfolioContent);
});

onUnmounted(() => {
  window.removeEventListener('portfolio-content-updated', updatePortfolioContent);
});
</script>
