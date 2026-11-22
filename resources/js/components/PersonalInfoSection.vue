<template>
  <section id="personal-info" class="relative overflow-hidden border-t border-zinc-200 bg-zinc-50/70 py-14 transition-colors dark:border-zinc-800 dark:bg-zinc-950 sm:py-24">
    <div class="pointer-events-none absolute -right-24 -top-24 size-72 rounded-full bg-zinc-200/50 blur-3xl dark:bg-zinc-800/20"></div>
    <div class="relative mx-auto w-full max-w-6xl px-6">
      <header class="mb-8 flex flex-col gap-5 sm:mb-10 sm:flex-row sm:items-end sm:justify-between">
        <div>
          <div class="mb-3 flex items-center gap-2 text-[11px] font-semibold uppercase tracking-[0.2em] text-zinc-500">
            <span class="h-px w-8 bg-zinc-400 dark:bg-zinc-600"></span>
            Identitas
          </div>
          <h2 class="text-3xl font-bold tracking-tight text-zinc-950 dark:text-white sm:text-4xl">Data Diri</h2>
          <p class="mt-2 max-w-md text-sm leading-6 text-zinc-500 dark:text-zinc-400">
            Informasi profil dan latar belakang pendidikan.
          </p>
        </div>
        <span class="inline-flex w-fit items-center gap-2 rounded-full border border-zinc-200 bg-white/80 px-3 py-1.5 text-xs font-medium text-zinc-600 shadow-2xs dark:border-zinc-800 dark:bg-zinc-900/80 dark:text-zinc-300">
          <span class="size-1.5 rounded-full bg-zinc-900 dark:bg-white"></span>
          Curriculum Vitae
        </span>
      </header>
      <div class="grid gap-4 lg:grid-cols-[minmax(0,0.8fr)_minmax(0,1.2fr)]">
        <article class="relative isolate flex min-h-64 flex-col justify-between overflow-hidden rounded-2xl border border-zinc-800 bg-zinc-950 p-6 text-white shadow-sm sm:p-8">
          <div class="pointer-events-none absolute -right-12 -top-16 -z-10 size-56 rounded-full border border-white/10"></div>
          <div class="pointer-events-none absolute -right-2 -top-6 -z-10 size-36 rounded-full border border-white/10"></div>
          <div class="flex items-center gap-4">
            <img
              :src="profile.avatar"
              :alt="profile.name"
              class="size-16 rounded-2xl border border-white/15 object-cover sm:size-20">
            <div class="min-w-0">
              <span class="text-[10px] font-semibold uppercase tracking-[0.2em] text-zinc-400">Profil</span>
              <h3 class="mt-1 truncate text-xl font-semibold tracking-tight sm:text-2xl">{{ profile.name }}</h3>
              <p class="mt-1 text-sm text-zinc-400">{{ profile.role }}</p>
            </div>
          </div>
          <div class="mt-10 border-t border-white/10 pt-4">
            <span class="text-xs text-zinc-400">Informasi utama</span>
            <p class="mt-1 text-sm font-medium text-zinc-100">Profil personal dan pendidikan</p>
          </div>
        </article>

        <dl class="grid gap-3 sm:grid-cols-2">
          <div
            v-for="detail in personalDetails"
            :key="detail.label"
            class="group min-w-0 rounded-2xl border border-zinc-200 bg-white/90 p-4 shadow-2xs transition duration-200 hover:-translate-y-0.5 hover:border-zinc-400 hover:shadow-sm dark:border-zinc-800 dark:bg-zinc-900/70 dark:hover:border-zinc-600 sm:p-5">
            <div class="flex items-start gap-3">
              <span class="flex size-9 shrink-0 items-center justify-center rounded-xl border border-zinc-200 bg-zinc-50 font-mono text-[10px] font-semibold text-zinc-500 transition-colors group-hover:bg-zinc-900 group-hover:text-white dark:border-zinc-700 dark:bg-zinc-800 dark:text-zinc-400 dark:group-hover:bg-white dark:group-hover:text-zinc-900">
                {{ detail.initial }}
              </span>
              <div class="min-w-0 pt-0.5">
                <dt class="text-xs font-medium text-zinc-500 dark:text-zinc-400">{{ detail.label }}</dt>
                <dd
                  class="mt-1 break-words text-sm font-semibold"
                  :class="detail.value ? 'text-zinc-900 dark:text-white' : 'text-zinc-400 dark:text-zinc-500'">
                  {{ detail.value || 'Belum diisi' }}
                </dd>
              </div>
            </div>
          </div>
        </dl>
      </div>
    </div>
  </section>
</template>

<script setup>
import { computed, onMounted, onUnmounted, ref } from 'vue';
import { loadPortfolioContent } from '../portfolio-content';

const profile = ref(loadPortfolioContent().profile);
const personalDetails = computed(() => [
  { initial: 'N', label: 'NIM', value: profile.value.studentId },
  { initial: 'I', label: 'Institusi pendidikan', value: profile.value.institution },
  { initial: 'P', label: 'Program studi', value: profile.value.studyProgram },
  { initial: 'J', label: 'Jenis kelamin', value: profile.value.gender },
  { initial: 'K', label: 'Kewarganegaraan', value: profile.value.nationality },
]);

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
