<template>
  <section id="contact" class="overflow-hidden border-t border-zinc-200 bg-zinc-50/50 py-14 transition-colors dark:border-zinc-800 dark:bg-zinc-950 sm:py-24">
    <div class="mx-auto w-full max-w-6xl px-6">
      <header class="mb-8 flex flex-col gap-5 sm:mb-10 lg:flex-row lg:items-end lg:justify-between">
        <div>
          <div class="mb-3 flex items-center gap-2 text-[11px] font-semibold uppercase tracking-[0.2em] text-zinc-500">
            <span class="h-px w-8 bg-zinc-400 dark:bg-zinc-600"></span>
            Kontak
          </div>
          <h2 class="text-3xl font-bold tracking-tight text-zinc-950 dark:text-white sm:text-4xl">Hubungi Saya</h2>
        </div>
        <p class="max-w-md text-sm leading-6 text-zinc-500 dark:text-zinc-400 lg:text-right">
          Untuk pertanyaan, diskusi, atau kolaborasi, hubungi saya melalui salah satu kanal berikut.
        </p>
      </header>

      <div class="grid gap-4 lg:grid-cols-[minmax(0,0.8fr)_minmax(0,1.2fr)]">
        <article class="relative isolate flex min-h-64 flex-col justify-between overflow-hidden rounded-2xl border border-zinc-800 bg-zinc-950 p-6 text-white shadow-sm sm:p-8">
          <div class="pointer-events-none absolute -right-14 -top-20 -z-10 size-64 rounded-full border border-white/10"></div>
          <div class="pointer-events-none absolute -right-2 -top-8 -z-10 size-40 rounded-full border border-white/10"></div>
          <div class="flex items-center gap-5">
            <img
              :src="portfolioContent.profile.avatar"
              :alt="portfolioContent.profile.name"
              class="size-20 shrink-0 rounded-2xl border border-white/15 object-cover sm:size-24">
            <div class="min-w-0">
              <span class="text-[10px] font-semibold uppercase tracking-[0.2em] text-zinc-400">Profil</span>
              <div class="mt-1 flex items-center gap-2">
                <h3 class="truncate text-xl font-semibold tracking-tight sm:text-2xl">{{ portfolioContent.profile.name }}</h3>
                <span class="relative flex size-2 shrink-0">
                  <span class="absolute inline-flex size-full animate-ping rounded-full bg-green-500 opacity-75"></span>
                  <span class="relative inline-flex size-2 rounded-full bg-green-500"></span>
                </span>
              </div>
              <p class="mt-1 text-sm text-zinc-400">Tersedia untuk menerima pesan</p>
            </div>
          </div>
          <p class="mt-8 border-t border-white/10 pt-5 text-sm leading-6 text-zinc-300">
            Pilih kanal kontak langsung atau media sosial untuk menghubungi saya.
          </p>
        </article>

        <div class="grid gap-4">
          <section
            v-for="group in contactGroups"
            :key="group.label"
            :aria-label="group.label"
            class="rounded-2xl border border-zinc-200 bg-white p-5 shadow-2xs dark:border-zinc-800 dark:bg-zinc-900/60 sm:p-6">
            <div>
              <h3 class="text-sm font-semibold text-zinc-900 dark:text-white">{{ group.label }}</h3>
            </div>
            <div class="mt-4 grid gap-2.5 sm:grid-cols-2">
              <a
                v-for="item in group.items"
                :key="item.label"
                :href="item.href"
                target="_blank"
                rel="noopener noreferrer"
                class="group/link inline-flex min-h-14 items-center justify-between gap-3 rounded-xl border border-zinc-200 bg-zinc-50/70 px-4 py-3 text-sm font-medium text-zinc-700 transition duration-200 hover:-translate-y-0.5 hover:border-zinc-400 hover:bg-white hover:text-zinc-950 hover:shadow-sm dark:border-zinc-800 dark:bg-zinc-950/60 dark:text-zinc-300 dark:hover:border-zinc-600 dark:hover:bg-zinc-800 dark:hover:text-white">
                <span class="truncate">{{ item.label }}</span>
                <svg class="size-4 shrink-0 text-zinc-400 transition-transform group-hover/link:-translate-y-0.5 group-hover/link:translate-x-0.5 group-hover/link:text-zinc-900 dark:group-hover/link:text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                  <path d="M7 7h10v10M7 17 17 7"/>
                </svg>
              </a>
            </div>
          </section>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import { computed, onMounted, onUnmounted, ref } from 'vue';
import { loadPortfolioContent } from '../portfolio-content';

const portfolioContent = ref(loadPortfolioContent());
const contactGroups = computed(() => {
  const contacts = portfolioContent.value.contacts.filter((item) => item.label.toLowerCase() !== 'email');
  const socialLinks = portfolioContent.value.medsos.filter((item) => item.label.toLowerCase() !== 'email');
  const movedContactLabels = new Set(['instagram', 'telegram']);
  const movedContacts = socialLinks.filter((item) => (
    movedContactLabels.has(item.label.toLowerCase())
    && !contacts.some((contact) => contact.label.toLowerCase() === item.label.toLowerCase())
  ));

  return [
    { label: 'Kontak langsung', items: [...contacts, ...movedContacts] },
    { label: 'Media sosial', items: socialLinks.filter((item) => !movedContactLabels.has(item.label.toLowerCase())) },
  ];
});

function updatePortfolioContent(event) {
  portfolioContent.value = event.detail;
}

onMounted(() => {
  window.addEventListener('portfolio-content-updated', updatePortfolioContent);
});

onUnmounted(() => {
  window.removeEventListener('portfolio-content-updated', updatePortfolioContent);
});
</script>
