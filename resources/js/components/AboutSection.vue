<template>
  <section id="about" class="relative overflow-hidden border-t border-zinc-200 bg-white py-14 transition-colors dark:border-zinc-800 dark:bg-zinc-950 sm:py-24">
    <div class="pointer-events-none absolute -left-32 top-20 size-80 rounded-full bg-zinc-100 blur-3xl dark:bg-zinc-900/50"></div>
    <div class="relative mx-auto max-w-6xl px-6">
      <header class="mb-8 flex flex-col gap-5 sm:mb-10 lg:flex-row lg:items-end lg:justify-between">
        <div>
          <div class="mb-3 flex items-center gap-2 text-[11px] font-semibold uppercase tracking-[0.2em] text-zinc-500">
            <span class="h-px w-8 bg-zinc-400 dark:bg-zinc-600"></span>
            Tentang Saya
          </div>
          <h2 class="text-3xl font-bold tracking-tight text-zinc-950 dark:text-white sm:text-4xl">Kehidupan Mahasiswa</h2>
        </div>
        <p class="max-w-md text-sm leading-6 text-zinc-500 dark:text-zinc-400 lg:text-right">
          Cerita singkat tentang proses belajar, rasa ingin tahu, dan hal-hal yang terus ingin dikembangkan.
        </p>
      </header>
      <div class="grid gap-4 lg:grid-cols-[minmax(0,0.82fr)_minmax(0,1.18fr)]">
        <aside class="relative isolate flex min-h-80 flex-col justify-between overflow-hidden rounded-2xl border border-zinc-800 bg-zinc-950 p-6 text-white shadow-sm sm:p-8">
          <div class="pointer-events-none absolute -right-14 -top-20 -z-10 size-64 rounded-full border border-white/10"></div>
          <div class="pointer-events-none absolute -right-2 -top-8 -z-10 size-40 rounded-full border border-white/10"></div>
          <div>
            <span class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/5 px-3 py-1.5 text-[10px] font-semibold uppercase tracking-[0.18em] text-zinc-300">
              <span class="size-1.5 rounded-full bg-white"></span>
              Catatan pribadi
            </span>
            <p class="mt-8 max-w-sm text-2xl font-semibold leading-snug tracking-tight sm:text-3xl">
              Belajar adalah proses yang terus berjalan.
            </p>
            <p class="mt-3 max-w-sm text-sm leading-6 text-zinc-400">
              Setiap pengalaman memberi ruang untuk mengenal diri dan bertumbuh.
            </p>
          </div>

        </aside>

        <div class="grid gap-4 sm:grid-cols-2">
          <article class="group rounded-2xl border border-zinc-200 bg-zinc-50/70 p-5 transition duration-200 hover:-translate-y-0.5 hover:border-zinc-400 hover:bg-white hover:shadow-sm dark:border-zinc-800 dark:bg-zinc-900/50 dark:hover:border-zinc-600 dark:hover:bg-zinc-900 sm:p-6">
            <h3 class="text-lg font-semibold tracking-tight text-zinc-900 dark:text-white">Rasa ingin tahu</h3>
            <p class="mt-2 text-sm leading-6 text-zinc-500 dark:text-zinc-400">
              Saya senang mengeksplorasi hal baru dan memperluas wawasan melalui proses belajar.
            </p>
          </article>
          <article class="group rounded-2xl border border-zinc-200 bg-zinc-50/70 p-5 transition duration-200 hover:-translate-y-0.5 hover:border-zinc-400 hover:bg-white hover:shadow-sm dark:border-zinc-800 dark:bg-zinc-900/50 dark:hover:border-zinc-600 dark:hover:bg-zinc-900 sm:p-6">
            <h3 class="text-lg font-semibold tracking-tight text-zinc-900 dark:text-white">Terus bertumbuh</h3>
            <p class="mt-2 text-sm leading-6 text-zinc-500 dark:text-zinc-400">
              Saya berusaha mengenali potensi diri dan mengambil pelajaran dari berbagai pengalaman.
            </p>
          </article>
          <div class="flex flex-col justify-between gap-5 rounded-2xl border border-zinc-200 bg-white p-5 dark:border-zinc-800 dark:bg-zinc-900/60 sm:col-span-2 sm:flex-row sm:items-center sm:p-6">
            <div>
              <span class="text-[10px] font-semibold uppercase tracking-[0.18em] text-zinc-400">Langkah berikutnya</span>
              <p class="mt-1 text-sm font-medium text-zinc-800 dark:text-zinc-200">Melangkah dengan terbuka pada kesempatan dan pengalaman baru.</p>
            </div>
            <a href="#projects" class="inline-flex w-fit shrink-0 items-center gap-2 rounded-lg border border-zinc-200 px-3.5 py-2 text-xs font-semibold text-zinc-700 transition hover:border-zinc-400 hover:bg-zinc-50 dark:border-zinc-700 dark:text-zinc-300 dark:hover:bg-zinc-800">
              Lihat karya
              <span aria-hidden="true">↗</span>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
</script>
