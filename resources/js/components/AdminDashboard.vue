<template>
  <div v-if="!isAuthenticated" class="min-h-screen bg-zinc-50 text-zinc-900 dark:bg-zinc-950 dark:text-zinc-100">
    <main class="flex min-h-screen items-center justify-center px-6 py-12">
      <div class="w-full max-w-[40rem]">
        <section class="relative w-full rounded-2xl border border-zinc-200 bg-white p-6 shadow-sm dark:border-zinc-800 dark:bg-zinc-900 sm:p-8">
        <div class="mb-7">
          <span class="mb-4 flex size-12 items-center justify-center rounded-xl border border-zinc-200 bg-zinc-50 dark:border-zinc-800 dark:bg-zinc-950">
            <UserRound class="size-5" />
          </span>
          <button
              type="button"
              class="absolute right-6 top-6 rounded-lg border border-zinc-200 p-2 text-zinc-600 transition hover:bg-zinc-100 dark:border-zinc-800 dark:text-zinc-300 dark:hover:bg-zinc-900 sm:right-8 sm:top-8"
              :aria-label="isDark ? 'Aktifkan tema terang' : 'Aktifkan tema gelap'"
              @click="$emit('toggle-theme')">
              <Sun v-if="isDark" class="size-4" />
              <Moon v-else class="size-4" />
            </button>
          <p class="text-xs font-semibold uppercase tracking-[0.18em] text-zinc-500">Area pribadi</p>
          <h1 class="mt-2 text-2xl font-bold tracking-tight">Masuk ke admin</h1>
          <p class="mt-2 text-sm leading-6 text-zinc-500 dark:text-zinc-400">
            Kelola profil, karya, dan dokumentasi portofolio dari satu tempat.
          </p>
        </div>
        <form class="space-y-5" @submit.prevent="login">
          <label class="block space-y-2">
            <span class="text-sm font-medium">Email</span>
            <input
              v-model.trim="loginEmail"
              type="email"
              autocomplete="username"
              required
              placeholder="nama@email.com"
              class="h-11 w-full rounded-lg border border-zinc-200 bg-white px-3 text-sm outline-none transition placeholder:text-zinc-400 focus:border-zinc-500 dark:border-zinc-800 dark:bg-zinc-950 dark:placeholder:text-zinc-600 dark:focus:border-zinc-500">
          </label>
          <label class="block space-y-2">
            <span class="text-sm font-medium">Kata sandi</span>
            <input
              v-model="loginPassword"
              type="password"
              autocomplete="current-password"
              required
              placeholder="Masukkan kata sandi"
              class="h-11 w-full rounded-lg border border-zinc-200 bg-white px-3 text-sm outline-none transition placeholder:text-zinc-400 focus:border-zinc-500 dark:border-zinc-800 dark:bg-zinc-950 dark:placeholder:text-zinc-600 dark:focus:border-zinc-500">
          </label>
          <p v-if="loginError" class="text-sm text-zinc-600 dark:text-zinc-300" role="alert">{{ loginError }}</p>
          <button type="submit" class="inline-flex h-11 w-full items-center justify-center gap-2 rounded-lg bg-zinc-900 px-4 text-sm font-semibold text-white transition hover:bg-zinc-700 dark:bg-white dark:text-zinc-950 dark:hover:bg-zinc-200">
            Masuk ke dashboard
            <ArrowUpRight class="size-4" />
          </button>
        </form>
        <div class="mt-6 rounded-lg border border-dashed border-zinc-300 bg-zinc-50 px-3 py-2.5 text-xs leading-5 text-zinc-500 dark:border-zinc-700 dark:bg-zinc-950 dark:text-zinc-400">
          Masuk menggunakan akun admin yang dikonfigurasi untuk aplikasi ini.
        </div>
        <a href="/" class="mt-5 inline-flex items-center gap-2 text-sm text-zinc-500 transition hover:text-zinc-900 dark:hover:text-white">
          <ArrowLeft class="size-4" />
          Kembali ke portofolio
        </a>
        </section>
      </div>
    </main>
  </div>
  <div v-else class="min-h-screen bg-zinc-50 text-zinc-900 dark:bg-zinc-950 dark:text-zinc-100">
    <div
      class="min-h-screen transition-[grid-template-columns] duration-300 md:grid"
      :class="sidebarCollapsed ? 'md:grid-cols-[72px_minmax(0,1fr)]' : 'md:grid-cols-[248px_minmax(0,1fr)]'">
      <button
        v-if="mobileSidebarOpen"
        type="button"
        class="fixed inset-0 z-40 bg-black/50 backdrop-blur-sm md:hidden"
        aria-label="Tutup navigasi admin"
        @click="mobileSidebarOpen = false">
      </button>
      <aside
        class="fixed inset-y-0 left-0 z-50 flex w-64 flex-col border-r border-zinc-200 bg-white transition-[width,transform] duration-300 dark:border-zinc-800 dark:bg-zinc-900 md:z-30 md:h-screen md:translate-x-0"
        :class="[mobileSidebarOpen ? 'translate-x-0' : '-translate-x-full', sidebarCollapsed ? 'md:w-[72px]' : 'md:w-[248px]']">
        <div
          class="flex h-[72px] shrink-0 items-center border-b border-zinc-200 dark:border-zinc-800"
          :class="showSidebarLabels ? 'justify-between gap-3 px-5' : 'justify-center px-2'">
          <a href="/" class="flex min-w-0 items-center gap-3" :title="sidebarCollapsed ? 'Kembali ke portofolio' : undefined">
            <span class="flex size-9 shrink-0 items-center justify-center rounded-lg bg-zinc-900 text-xs font-bold text-white dark:bg-white dark:text-zinc-950">FO</span>
            <div v-if="showSidebarLabels" class="min-w-0">
              <p class="text-sm font-semibold">Ruang Admin</p>
              <p class="text-[11px] text-zinc-500 dark:text-zinc-400">Portofolio pribadi</p>
            </div>
          </a>
          <button
            type="button"
            class="rounded-md p-2 text-zinc-500 transition hover:bg-zinc-100 hover:text-zinc-900 dark:text-zinc-400 dark:hover:bg-zinc-800 dark:hover:text-white md:hidden"
            aria-label="Tutup navigasi admin"
            @click="mobileSidebarOpen = false">
            <X class="size-4" />
          </button>
        </div>
        <nav class="flex-1 space-y-1 overflow-y-hidden px-3 py-5" aria-label="Navigasi admin">
          <p v-if="showSidebarLabels" class="mb-2 px-3 text-xs font-semibold text-zinc-500 dark:text-zinc-400"></p>
          <button
            v-for="item in navItems"
            :key="item.id"
            type="button"
            class="flex w-full items-center rounded-lg py-2.5 text-left text-sm transition"
            :class="[
              showSidebarLabels ? 'gap-3 px-3' : 'justify-center px-2',
              activeView === item.id
                ? 'bg-zinc-100 font-semibold text-zinc-950 dark:bg-zinc-800 dark:text-white'
                : 'text-zinc-500 hover:bg-zinc-50 hover:text-zinc-900 dark:text-zinc-400 dark:hover:bg-zinc-800/60 dark:hover:text-white',
            ]"
            :title="showSidebarLabels ? undefined : item.label"
            :aria-label="item.label"
            :aria-current="activeView === item.id ? 'page' : undefined"
            @click="selectAdminView(item.id)">
            <component :is="item.icon" class="size-4 shrink-0" />
            <span v-if="showSidebarLabels">{{ item.label }}</span>
          </button>
        </nav>
        <div class="shrink-0 border-t border-zinc-200 p-3 dark:border-zinc-800">
          <a
            href="/"
            class="flex items-center rounded-lg py-2.5 text-sm text-zinc-500 transition hover:bg-zinc-50 hover:text-zinc-900 dark:text-zinc-400 dark:hover:bg-zinc-800 dark:hover:text-white"
            :class="showSidebarLabels ? 'gap-3 px-3' : 'justify-center px-2'"
            :title="showSidebarLabels ? undefined : 'Lihat portofolio'">
            <ExternalLink class="size-4 shrink-0" />
            <span v-if="showSidebarLabels">Lihat portofolio</span>
          </a>
          <button
            type="button"
            class="mt-1 flex w-full items-center rounded-lg py-2.5 text-left text-sm text-zinc-500 transition hover:bg-zinc-50 hover:text-zinc-900 dark:text-zinc-400 dark:hover:bg-zinc-800 dark:hover:text-white"
            :class="showSidebarLabels ? 'gap-3 px-3' : 'justify-center px-2'"
            :title="showSidebarLabels ? undefined : 'Keluar'"
            @click="logout">
            <LogOut class="size-4 shrink-0" />
            <span v-if="showSidebarLabels">Keluar</span>
          </button>
          <div class="mt-3 border-t border-zinc-100 pt-3 dark:border-zinc-800">
            <button
              type="button"
              class="flex w-full items-center rounded-lg py-2 text-left transition hover:bg-zinc-50 dark:hover:bg-zinc-800"
              :class="showSidebarLabels ? 'gap-3 px-2' : 'justify-center px-1'"
              :title="showSidebarLabels ? undefined : content.profile.name"
              aria-label="Profil admin"
              @click="activeView = 'profile'; mobileSidebarOpen = false">
              <img :src="content.profile.avatar" :alt="content.profile.name" class="size-9 shrink-0 rounded-full border border-zinc-200 object-cover dark:border-zinc-700">
              <span v-if="showSidebarLabels" class="min-w-0 flex-1">
                <span class="block truncate text-sm font-semibold text-zinc-900 dark:text-white">{{ content.profile.name }}</span>
                <span class="block truncate text-xs text-zinc-500 dark:text-zinc-400">Admin portofolio</span>
              </span>
            </button>
          </div>
        </div>
      </aside>
      <div class="min-w-0 md:col-start-2">
        <header class="fixed inset-x-0 top-0 z-30 flex h-[72px] items-center justify-between border-b border-zinc-200 bg-white/95 px-4 backdrop-blur transition-[left] duration-300 dark:border-zinc-800 dark:bg-zinc-900/95 sm:px-7"
                :class="sidebarCollapsed ? 'md:left-[72px]' : 'md:left-[248px]'">
          <div class="flex min-w-0 items-center gap-3">
            <button
              type="button"
              class="rounded-lg border border-zinc-200 p-2 text-zinc-600 transition hover:bg-zinc-100 dark:border-zinc-800 dark:text-zinc-300 dark:hover:bg-zinc-800 md:hidden"
              aria-label="Buka navigasi admin"
              :aria-expanded="mobileSidebarOpen"
              @click="mobileSidebarOpen = true">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="3" width="18" height="18" rx="2" />
                <path d="M9 3v18" />
              </svg>
            </button>
            <button
              type="button"
              class="hidden rounded-lg border border-zinc-200 p-2 text-zinc-600 transition hover:bg-zinc-100 dark:border-zinc-800 dark:text-zinc-300 dark:hover:bg-zinc-800 md:inline-flex"
              :aria-label="sidebarCollapsed ? 'Perluas sidebar' : 'Ciutkan sidebar'"
              :aria-expanded="!sidebarCollapsed"
              @click="sidebarCollapsed = !sidebarCollapsed">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="3" width="18" height="18" rx="2" />
                <path d="M9 3v18" />
              </svg>
            </button>
            <span class="flex size-9 items-center justify-center rounded-lg bg-zinc-900 text-xs font-bold text-white dark:bg-white dark:text-zinc-950 md:hidden">FO</span>
            <div class="min-w-0">
              <p class="truncate text-sm font-semibold">{{ currentViewTitle }}</p>
              <p class="hidden text-xs text-zinc-500 dark:text-zinc-400 sm:block">Kelola konten portofolio Anda</p>
            </div>
          </div>
          <div class="flex items-center gap-2 sm:gap-3">
            <span class="hidden items-center gap-2 rounded-full border border-zinc-200 px-2.5 py-1 text-[11px] text-zinc-500 dark:border-zinc-800 dark:text-zinc-400 sm:inline-flex">
              <span class="size-1.5 rounded-full" :class="content.profile.online ? 'bg-green-600 dark:bg-green-500' : 'bg-zinc-400'"></span>
              {{ content.profile.online ? 'Tersedia' : 'Tidak tersedia' }}
            </span>
            <button type="button" class="rounded-lg border border-zinc-200 p-2 text-zinc-600 transition hover:bg-zinc-100 dark:border-zinc-800 dark:text-zinc-300 dark:hover:bg-zinc-800" :aria-label="isDark ? 'Aktifkan tema terang' : 'Aktifkan tema gelap'" @click="$emit('toggle-theme')">
              <Sun v-if="isDark" class="size-4" />
              <Moon v-else class="size-4" />
            </button>
            <button type="button" class="flex items-center gap-2 rounded-full" aria-label="Buka pengaturan profil" @click="activeView = 'profile'">
              <img :src="content.profile.avatar" :alt="content.profile.name" class="size-8 rounded-full border border-zinc-200 object-cover dark:border-zinc-700">
              <span class="hidden text-sm font-medium sm:block">{{ content.profile.name }}</span>
            </button>
          </div>
        </header>
        <main class="mx-auto w-full max-w-7xl space-y-4 px-4 pb-4 pt-[88px] sm:space-y-6 sm:px-7 sm:pb-7 sm:pt-[100px] lg:px-9 lg:pb-9 lg:pt-[108px]">
          <section v-if="activeView === 'overview'" class="space-y-4 sm:space-y-6">
            <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
              <button type="button" class="inline-flex h-9 items-center justify-center gap-1.5 rounded-lg bg-zinc-900 px-3 text-xs font-semibold text-white transition hover:bg-zinc-700 dark:bg-white dark:text-zinc-950 dark:hover:bg-zinc-200" @click="openProjectEditor()">
                <Plus class="size-3.5" />
                Tambah projek
              </button>
            </div>
            <div class="grid grid-cols-3 gap-2 sm:gap-3">
              <article v-for="stat in dashboardStats" :key="stat.label" class="min-w-0 rounded-xl border border-zinc-200 bg-white p-2.5 dark:border-zinc-800 dark:bg-zinc-900 sm:p-4">
                <div class="flex items-center justify-between">
                  <p class="min-w-0 text-[11px] leading-tight text-zinc-500 dark:text-zinc-400 sm:text-sm">{{ stat.label }}</p>
                  <component :is="stat.icon" class="size-3 shrink-0 text-zinc-400 sm:size-4" />
                </div>
                <p class="mt-2 text-xl font-bold sm:mt-3 sm:text-2xl">{{ stat.value }}</p>
                <p class="mt-1 text-[10px] leading-tight text-zinc-500 dark:text-zinc-400 sm:text-xs">{{ stat.description }}</p>
              </article>
            </div>
            <div class="grid gap-6 xl:grid-cols-[minmax(0,1.5fr)_minmax(260px,0.8fr)]">
              <section class="overflow-hidden rounded-xl border border-zinc-200 bg-white dark:border-zinc-800 dark:bg-zinc-900">
                <div class="flex items-center justify-between border-b border-zinc-200 px-5 py-4 dark:border-zinc-800">
                  <div>
                    <h2 class="text-sm font-semibold">Projek terbaru</h2>
                    <p class="mt-1 text-xs text-zinc-500 dark:text-zinc-400">Konten yang ditampilkan di koleksi karya</p>
                  </div>
                  <button type="button" class="text-xs font-medium text-zinc-500 hover:text-zinc-900 dark:hover:text-white" @click="activeView = 'projects'">Lihat semua</button>
                </div>
                <div v-if="content.projects.length" class="divide-y divide-zinc-100 dark:divide-zinc-800">
                  <article v-for="project in content.projects.slice(0, 4)" :key="project.id" class="flex items-center gap-3 px-5 py-3.5">
                    <img :src="project.image" :alt="project.title" class="size-12 shrink-0 rounded-lg border border-zinc-200 object-cover grayscale dark:border-zinc-800">
                    <div class="min-w-0 flex-1">
                      <p class="truncate text-sm font-medium">{{ project.title }}</p>
                      <p class="mt-1 text-xs text-zinc-500 dark:text-zinc-400">{{ project.category }} · {{ project.year }}</p>
                    </div>
                    <button type="button" class="rounded-md p-2 text-zinc-500 hover:bg-zinc-100 hover:text-zinc-900 dark:hover:bg-zinc-800 dark:hover:text-white" :aria-label="`Edit ${project.title}`" @click="openProjectEditor(project)">
                      <Pencil class="size-3.5" />
                    </button>
                  </article>
                </div>
                <div v-else class="p-8 text-center text-sm text-zinc-500">Belum ada projek. Tambahkan projek pertama Anda.</div>
              </section>
              <section class="rounded-xl border border-zinc-200 bg-white p-5 dark:border-zinc-800 dark:bg-zinc-900">
                <div class="flex items-start justify-between gap-3">
                  <div>
                    <h2 class="text-sm font-semibold">Profil portofolio</h2>
                    <p class="mt-1 text-xs text-zinc-500 dark:text-zinc-400">Informasi yang dilihat pengunjung</p>
                  </div>
                  <button type="button" class="rounded-md p-2 text-zinc-500 hover:bg-zinc-100 hover:text-zinc-900 dark:hover:bg-zinc-800 dark:hover:text-white" aria-label="Edit profil" @click="activeView = 'profile'">
                    <Pencil class="size-3.5" />
                  </button>
                </div>
                <div class="mt-5 flex items-center gap-3">
                  <img :src="content.profile.avatar" :alt="content.profile.name" class="size-12 rounded-full border border-zinc-200 object-cover dark:border-zinc-700">
                  <div class="min-w-0">
                    <p class="truncate text-sm font-semibold">{{ content.profile.name }}</p>
                    <p class="mt-1 truncate text-xs text-zinc-500 dark:text-zinc-400">{{ content.profile.role }}</p>
                  </div>
                </div>
                <p class="mt-4 line-clamp-3 text-xs leading-5 text-zinc-500 dark:text-zinc-400">{{ content.profile.bio }}</p>
                <div class="mt-4 border-t border-zinc-100 pt-4 dark:border-zinc-800">
                  <span class="inline-flex items-center gap-2 text-xs text-zinc-500 dark:text-zinc-400">
                    <span class="size-1.5 rounded-full" :class="content.profile.online ? 'bg-green-600 dark:bg-green-500' : 'bg-zinc-400'"></span>
                    {{ content.profile.online ? 'Siap menerima projek' : 'Sedang tidak tersedia' }}
                  </span>
                </div>
              </section>
            </div>
          </section>
          <section v-else-if="activeView === 'projects'" class="space-y-4 sm:space-y-5">
            <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
              <div>
                <p class="text-xs font-semibold uppercase tracking-[0.18em] text-zinc-500">Koleksi karya</p>
                <h1 class="mt-2 text-2xl font-bold tracking-tight">Projek</h1>
                <p class="mt-2 text-sm text-zinc-500 dark:text-zinc-400">Tambah, perbarui, atau hapus projek yang tampil di portofolio.</p>
              </div>
              <button type="button" class="inline-flex h-9 items-center justify-center gap-1.5 rounded-lg bg-zinc-900 px-3 text-xs font-semibold text-white transition hover:bg-zinc-700 dark:bg-white dark:text-zinc-950 dark:hover:bg-zinc-200" @click="openProjectEditor()">
                <Plus class="size-3.5" />
                Tambah projek
              </button>
            </div>
            <div class="flex flex-col gap-3 rounded-xl border border-zinc-200 bg-white p-3 dark:border-zinc-800 dark:bg-zinc-900 sm:flex-row sm:items-center">
              <div class="relative flex-1">
                <Search class="pointer-events-none absolute left-3 top-1/2 size-4 -translate-y-1/2 text-zinc-400" />
                <input v-model="projectSearch" type="search" placeholder="Cari nama atau kategori projek..." class="h-10 w-full rounded-lg border border-zinc-200 bg-white pl-9 pr-3 text-sm outline-none placeholder:text-zinc-400 focus:border-zinc-500 dark:border-zinc-800 dark:bg-zinc-950 dark:placeholder:text-zinc-600">
              </div>
              <span class="px-2 text-xs text-zinc-500 dark:text-zinc-400">{{ filteredProjects.length }} projek</span>
            </div>
            <div v-if="filteredProjects.length" class="grid gap-4 sm:grid-cols-2 2xl:grid-cols-3">
              <article v-for="project in filteredProjects" :key="project.id" class="group overflow-hidden rounded-xl border border-zinc-200 bg-white dark:border-zinc-800 dark:bg-zinc-900">
                <div class="relative aspect-video overflow-hidden bg-zinc-100 dark:bg-zinc-800">
                  <img :src="project.image" :alt="project.title" class="size-full object-cover grayscale transition duration-300 group-hover:scale-105">
                  <span class="absolute left-3 top-3 rounded-md border border-white/20 bg-black/65 px-2 py-1 text-[11px] text-white backdrop-blur">{{ project.category }}</span>
                  <span v-if="project.featured" class="absolute right-3 top-3 rounded-md border border-zinc-200 bg-white/90 px-2 py-1 text-[11px] font-medium text-zinc-900">Unggulan</span>
                </div>
                <div class="space-y-3 p-4">
                  <div>
                    <h2 class="line-clamp-1 text-sm font-semibold">{{ project.title }}</h2>
                    <p class="mt-1 line-clamp-2 min-h-9 text-xs leading-5 text-zinc-500 dark:text-zinc-400">{{ project.description }}</p>
                  </div>
                  <div class="flex flex-wrap gap-1.5">
                    <span v-for="tech in project.techs" :key="tech" class="rounded border border-zinc-200 bg-zinc-50 px-2 py-1 font-mono text-[10px] text-zinc-500 dark:border-zinc-800 dark:bg-zinc-950 dark:text-zinc-400">{{ tech }}</span>
                  </div>
                  <div class="flex items-center justify-between border-t border-zinc-100 pt-3 dark:border-zinc-800">
                    <span class="text-xs text-zinc-500 dark:text-zinc-400">{{ project.year }}</span>
                    <div class="flex items-center gap-1">
                      <button type="button" class="rounded-md p-2 text-zinc-500 hover:bg-zinc-100 hover:text-zinc-900 dark:hover:bg-zinc-800 dark:hover:text-white" :aria-label="`Edit ${project.title}`" @click="openProjectEditor(project)">
                        <Pencil class="size-3.5" />
                      </button>
                      <button type="button" class="rounded-md p-2 text-zinc-500 hover:bg-zinc-100 hover:text-zinc-900 dark:hover:bg-zinc-800 dark:hover:text-white" :aria-label="`Hapus ${project.title}`" @click="askDelete('project', project.id, project.title)">
                        <Trash2 class="size-3.5" />
                      </button>
                    </div>
                  </div>
                </div>
              </article>
            </div>
            <div v-else class="rounded-xl border border-dashed border-zinc-300 bg-white px-5 py-16 text-center dark:border-zinc-700 dark:bg-zinc-900">
              <FolderKanban class="mx-auto size-8 text-zinc-400" />
              <p class="mt-3 text-sm font-medium">Projek tidak ditemukan</p>
              <p class="mt-1 text-xs text-zinc-500 dark:text-zinc-400">Coba kata kunci lain atau tambahkan projek baru.</p>
            </div>
          </section>
          <section v-else-if="activeView === 'media'" class="space-y-4 sm:space-y-5">
            <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
              <div>
                <p class="text-xs font-semibold uppercase tracking-[0.18em] text-zinc-500">Aset visual</p>
                <h1 class="mt-2 text-2xl font-bold tracking-tight">Galeri gambar</h1>
                <p class="mt-2 text-sm text-zinc-500 dark:text-zinc-400">Kelola dokumentasi visual yang digunakan pada portofolio.</p>
              </div>
              <button type="button" class="inline-flex h-9 items-center justify-center gap-1.5 rounded-lg bg-zinc-900 px-3 text-xs font-semibold text-white transition hover:bg-zinc-700 dark:bg-white dark:text-zinc-950 dark:hover:bg-zinc-200" @click="galleryInput?.click()">
                <Upload class="size-3.5" />
                Unggah gambar
              </button>
              <input ref="galleryInput" type="file" accept="image/*" class="hidden" @change="handleGalleryUpload">
              <input ref="galleryReplaceInput" type="file" accept="image/*" class="hidden" @change="handleGalleryReplace">
            </div>
            <div class="rounded-xl border border-zinc-200 bg-white p-4 dark:border-zinc-800 dark:bg-zinc-900 sm:p-5">
              <div class="mb-4 flex items-center justify-between">
                <div>
                  <h2 class="text-sm font-semibold">Dokumentasi</h2>
                  <p class="mt-1 text-xs text-zinc-500 dark:text-zinc-400">{{ content.gallery.length }} gambar</p>
                </div>
                <Image class="size-4 text-zinc-400" />
              </div>
              <div v-if="content.gallery.length" class="grid grid-cols-2 gap-3 sm:grid-cols-3 lg:grid-cols-4">
                <article v-for="item in content.gallery" :key="item.id" class="group overflow-hidden rounded-lg border border-zinc-200 dark:border-zinc-800">
                  <div class="relative aspect-[4/3] overflow-hidden bg-zinc-100 dark:bg-zinc-800">
                    <img :src="item.image" :alt="item.title" class="size-full object-cover grayscale transition duration-300 group-hover:scale-105">
                    <button type="button" class="absolute left-2 top-2 rounded-md border border-white/20 bg-black/60 p-1.5 text-white opacity-100 backdrop-blur transition sm:opacity-0 sm:group-hover:opacity-100" :aria-label="`Ganti gambar ${item.title}`" @click="replaceGalleryImage(item)">
                      <Pencil class="size-3.5" />
                    </button>
                    <button type="button" class="absolute right-2 top-2 rounded-md border border-white/20 bg-black/60 p-1.5 text-white opacity-100 backdrop-blur transition sm:opacity-0 sm:group-hover:opacity-100" :aria-label="`Hapus ${item.title}`" @click="askDelete('gallery', item.id, item.title)">
                      <Trash2 class="size-3.5" />
                    </button>
                  </div>
                  <div class="flex items-center justify-between gap-2 px-2.5 py-2">
                    <p class="truncate text-xs text-zinc-600 dark:text-zinc-300">{{ item.title }}</p>
                    <button type="button" class="shrink-0 text-[11px] text-zinc-500 underline-offset-2 hover:underline" @click="renameGalleryItem(item)">Ubah nama</button>
                  </div>
                </article>
              </div>
              <div v-else class="rounded-lg border border-dashed border-zinc-300 py-12 text-center dark:border-zinc-700">
                <Image class="mx-auto size-7 text-zinc-400" />
                <p class="mt-2 text-sm font-medium">Belum ada gambar</p>
                <p class="mt-1 text-xs text-zinc-500 dark:text-zinc-400">Unggah gambar dokumentasi untuk memulai galeri.</p>
              </div>
              <p class="mt-4 text-[11px] leading-5 text-zinc-500 dark:text-zinc-400">Gambar disimpan di server. Format JPG, PNG, atau WebP dengan ukuran maksimum 1,5 MB.</p>
            </div>
          </section>
          <section v-else-if="activeView === 'content'" class="space-y-4 sm:space-y-5">
            <div>
              <p class="text-xs font-semibold uppercase tracking-[0.18em] text-zinc-500">Konten publik</p>
              <h1 class="mt-2 text-2xl font-bold tracking-tight">Konten lainnya</h1>
              <p class="mt-2 text-sm text-zinc-500 dark:text-zinc-400">Kelola statistik, keahlian, pencapaian, layanan, kontak, dan tautan media sosial dalam format JSON.</p>
            </div>
            <form class="space-y-4 rounded-xl border border-zinc-200 bg-white p-4 dark:border-zinc-800 dark:bg-zinc-900 sm:p-5" @submit.prevent="saveAdditionalContent">
              <label class="block space-y-2">
                <span class="text-sm font-medium">Data konten publik</span>
                <textarea v-model="additionalContentDraft" rows="24" spellcheck="false" class="w-full rounded-lg border border-zinc-200 bg-zinc-50 p-3 font-mono text-xs leading-5 outline-none focus:border-zinc-500 dark:border-zinc-800 dark:bg-zinc-950"></textarea>
                <span class="block text-xs leading-5 text-zinc-500 dark:text-zinc-400">Pertahankan struktur objek tiap bagian. Perubahan akan divalidasi server sebelum disimpan.</span>
              </label>
              <div class="flex justify-end border-t border-zinc-100 pt-4 dark:border-zinc-800">
                <button type="submit" class="inline-flex h-9 items-center justify-center gap-2 rounded-lg bg-zinc-900 px-4 text-xs font-semibold text-white transition hover:bg-zinc-700 dark:bg-white dark:text-zinc-950 dark:hover:bg-zinc-200">
                  <Check class="size-3.5" />
                  Simpan konten
                </button>
              </div>
            </form>
          </section>
          <section v-else-if="activeView === 'messages'" class="space-y-4 sm:space-y-5">
            <div class="flex items-end justify-between gap-3">
              <div>
                <p class="text-xs font-semibold uppercase tracking-[0.18em] text-zinc-500">Kotak masuk</p>
                <h1 class="mt-2 text-2xl font-bold tracking-tight">Pesan pengunjung</h1>
                <p class="mt-2 text-sm text-zinc-500 dark:text-zinc-400">{{ unreadMessageCount }} pesan belum dibaca</p>
              </div>
              <button type="button" class="h-9 rounded-lg border border-zinc-200 px-3 text-xs font-medium dark:border-zinc-700" @click="loadMessages">Muat ulang</button>
            </div>
            <div v-if="messageError" class="rounded-lg border border-zinc-200 bg-white p-4 text-sm text-zinc-600 dark:border-zinc-800 dark:bg-zinc-900 dark:text-zinc-300" role="alert">{{ messageError }}</div>
            <div v-else-if="messages.length" class="space-y-3">
              <article v-for="message in messages" :key="message.id" class="rounded-xl border border-zinc-200 bg-white p-4 dark:border-zinc-800 dark:bg-zinc-900 sm:p-5">
                <div class="flex items-start justify-between gap-3">
                  <div class="min-w-0">
                    <p class="truncate text-sm font-semibold">{{ message.name }} <span v-if="!message.is_read" class="ml-1 rounded-full bg-zinc-100 px-2 py-0.5 text-[10px] font-medium dark:bg-zinc-800">Baru</span></p>
                    <a :href="`mailto:${message.email}`" class="mt-1 block truncate text-xs text-zinc-500 underline">{{ message.email }}</a>
                    <p class="mt-1 text-[11px] text-zinc-500 dark:text-zinc-400">{{ new Date(message.created_at).toLocaleString('id-ID') }}<span v-if="message.service"> · {{ message.service }}</span></p>
                  </div>
                  <div class="flex shrink-0 items-center gap-1">
                    <button v-if="!message.is_read" type="button" class="rounded-md border border-zinc-200 px-2 py-1 text-[11px] dark:border-zinc-700" @click="markMessageRead(message.id)">Tandai dibaca</button>
                    <button type="button" class="rounded-md p-2 text-zinc-500 hover:bg-zinc-100 dark:hover:bg-zinc-800" :aria-label="`Hapus pesan dari ${message.name}`" @click="deleteMessage(message.id)"><Trash2 class="size-3.5" /></button>
                  </div>
                </div>
                <p v-if="message.subject" class="mt-3 text-xs font-semibold">{{ message.subject }}</p>
                <p class="mt-2 whitespace-pre-wrap text-sm leading-6 text-zinc-600 dark:text-zinc-300">{{ message.message }}</p>
                <p v-if="message.phone" class="mt-3 text-xs text-zinc-500 dark:text-zinc-400">Kontak: {{ message.phone }}</p>
              </article>
            </div>
            <div v-else class="rounded-xl border border-dashed border-zinc-300 bg-white px-5 py-16 text-center text-sm text-zinc-500 dark:border-zinc-700 dark:bg-zinc-900">Belum ada pesan yang masuk.</div>
          </section>
          <section v-else-if="activeView === 'profile'" class="space-y-4 sm:space-y-5">
            <div>
              <p class="text-xs font-semibold uppercase tracking-[0.18em] text-zinc-500">Identitas</p>
              <h1 class="mt-2 text-2xl font-bold tracking-tight">Profil portofolio</h1>
              <p class="mt-2 text-sm text-zinc-500 dark:text-zinc-400">Perbarui informasi yang tampil pada halaman utama.</p>
            </div>
            <form class="grid gap-5 xl:grid-cols-[minmax(0,1fr)_300px]" @submit.prevent="saveProfile">
              <div class="space-y-5 rounded-xl border border-zinc-200 bg-white p-5 dark:border-zinc-800 dark:bg-zinc-900 sm:p-6">
                <div class="grid gap-4 sm:grid-cols-2">
                  <label class="space-y-2">
                    <span class="text-sm font-medium">Nama lengkap</span>
                    <input v-model.trim="profileDraft.name" required maxlength="100" class="h-10 w-full rounded-lg border border-zinc-200 bg-white px-3 text-sm outline-none focus:border-zinc-500 dark:border-zinc-800 dark:bg-zinc-950">
                  </label>
                  <label class="space-y-2">
                    <span class="text-sm font-medium">Profesi</span>
                    <input v-model.trim="profileDraft.role" required maxlength="100" class="h-10 w-full rounded-lg border border-zinc-200 bg-white px-3 text-sm outline-none focus:border-zinc-500 dark:border-zinc-800 dark:bg-zinc-950">
                  </label>
                </div>
                <div class="grid gap-4 sm:grid-cols-2">
                  <label class="space-y-2">
                    <span class="text-sm font-medium">NIM</span>
                    <input v-model.trim="profileDraft.studentId" maxlength="50" placeholder="Nomor induk mahasiswa" class="h-10 w-full rounded-lg border border-zinc-200 bg-white px-3 text-sm outline-none focus:border-zinc-500 dark:border-zinc-800 dark:bg-zinc-950">
                  </label>
                  <label class="space-y-2">
                    <span class="text-sm font-medium">Tempat, tanggal lahir</span>
                    <input v-model.trim="profileDraft.birthInfo" maxlength="150" placeholder="Contoh: Bandung, 1 Januari 2000" class="h-10 w-full rounded-lg border border-zinc-200 bg-white px-3 text-sm outline-none focus:border-zinc-500 dark:border-zinc-800 dark:bg-zinc-950">
                  </label>
                </div>
                <div class="grid gap-4 sm:grid-cols-2">
                  <label class="space-y-2">
                    <span class="text-sm font-medium">Institusi pendidikan</span>
                    <input v-model.trim="profileDraft.institution" maxlength="120" placeholder="Nama sekolah atau universitas" class="h-10 w-full rounded-lg border border-zinc-200 bg-white px-3 text-sm outline-none focus:border-zinc-500 dark:border-zinc-800 dark:bg-zinc-950">
                  </label>
                  <label class="space-y-2">
                    <span class="text-sm font-medium">Program studi</span>
                    <input v-model.trim="profileDraft.studyProgram" maxlength="120" placeholder="Nama program studi" class="h-10 w-full rounded-lg border border-zinc-200 bg-white px-3 text-sm outline-none focus:border-zinc-500 dark:border-zinc-800 dark:bg-zinc-950">
                  </label>
                </div>
                <div class="grid gap-4 sm:grid-cols-2">
                  <label class="space-y-2">
                    <span class="text-sm font-medium">Jenis kelamin</span>
                    <input v-model.trim="profileDraft.gender" maxlength="40" class="h-10 w-full rounded-lg border border-zinc-200 bg-white px-3 text-sm outline-none focus:border-zinc-500 dark:border-zinc-800 dark:bg-zinc-950">
                  </label>
                  <label class="space-y-2">
                    <span class="text-sm font-medium">Kewarganegaraan</span>
                    <input v-model.trim="profileDraft.nationality" maxlength="80" placeholder="Contoh: Indonesia" class="h-10 w-full rounded-lg border border-zinc-200 bg-white px-3 text-sm outline-none focus:border-zinc-500 dark:border-zinc-800 dark:bg-zinc-950">
                  </label>
                </div>
                <label class="block space-y-2">
                  <span class="text-sm font-medium">Judul utama</span>
                  <input v-model.trim="profileDraft.headline" required maxlength="180" class="h-10 w-full rounded-lg border border-zinc-200 bg-white px-3 text-sm outline-none focus:border-zinc-500 dark:border-zinc-800 dark:bg-zinc-950">
                </label>
                <label class="block space-y-2">
                  <span class="text-sm font-medium">Deskripsi singkat</span>
                  <textarea v-model.trim="profileDraft.bio" required rows="5" maxlength="1000" class="w-full resize-y rounded-lg border border-zinc-200 bg-white px-3 py-2.5 text-sm leading-6 outline-none focus:border-zinc-500 dark:border-zinc-800 dark:bg-zinc-950"></textarea>
                  <span class="text-xs text-zinc-500 dark:text-zinc-400">{{ profileDraft.bio.length }}/1000 karakter</span>
                </label>
                <div class="flex flex-col justify-between gap-4 border-t border-zinc-100 pt-4 dark:border-zinc-800 sm:flex-row sm:items-center">
                  <div>
                    <p class="text-sm font-medium">Status ketersediaan</p>
                    <p class="mt-1 text-xs text-zinc-500 dark:text-zinc-400">Status online otomatis mengikuti sesi login admin.</p>
                  </div>
                  <span class="inline-flex h-9 items-center gap-2 self-start rounded-lg border border-zinc-200 px-3 text-xs font-medium dark:border-zinc-700 sm:self-auto">
                    <span class="size-2 rounded-full" :class="profileDraft.online ? 'bg-green-600 dark:bg-green-500' : 'bg-zinc-400'"></span>
                    {{ profileDraft.online ? 'Siap menerima projek' : 'Sedang tidak tersedia' }}
                  </span>
                </div>
                <div class="flex justify-end border-t border-zinc-100 pt-4 dark:border-zinc-800">
                  <button type="submit" class="inline-flex h-10 items-center justify-center gap-2 rounded-lg bg-zinc-900 px-4 text-sm font-semibold text-white transition hover:bg-zinc-700 dark:bg-white dark:text-zinc-950 dark:hover:bg-zinc-200">
                    <Check class="size-4" />
                    Simpan perubahan
                  </button>
                </div>
              </div>
              <aside class="h-fit rounded-xl border border-zinc-200 bg-white p-5 dark:border-zinc-800 dark:bg-zinc-900">
                <h2 class="text-sm font-semibold">Foto profil</h2>
                <p class="mt-1 text-xs leading-5 text-zinc-500 dark:text-zinc-400">Gunakan foto persegi agar tampil rapi di halaman portofolio.</p>
                <div class="mt-5 flex flex-col items-center">
                  <div class="relative">
                    <img :src="profileDraft.avatar" :alt="profileDraft.name" class="size-28 rounded-full border border-zinc-200 object-cover dark:border-zinc-700">
                    <button type="button" class="absolute bottom-0 right-0 rounded-full border border-zinc-200 bg-white p-2 shadow-sm transition hover:bg-zinc-100 dark:border-zinc-700 dark:bg-zinc-800 dark:hover:bg-zinc-700" aria-label="Ubah foto profil" @click="profileImageInput?.click()">
                      <Camera class="size-4" />
                    </button>
                    <input ref="profileImageInput" type="file" accept="image/*" class="hidden" @change="handleProfileImageUpload">
                  </div>
                  <p class="mt-3 text-xs text-zinc-500 dark:text-zinc-400">JPG, PNG, atau WebP · maks. 1,5 MB</p>
                </div>
              </aside>
            </form>
          </section>
        </main>
      </div>
    </div>
    <Transition>
      <div v-if="notice" class="fixed right-5 top-5 z-50 max-w-sm rounded-lg border border-zinc-200 bg-white px-4 py-3 text-sm shadow-lg dark:border-zinc-700 dark:bg-zinc-900" role="status">
        {{ notice }}
      </div>
    </Transition>
    <div v-if="projectEditorOpen" class="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto bg-black/45 p-4" @click.self="projectEditorOpen = false">
      <section class="my-auto max-h-[92vh] w-full max-w-xl overflow-y-auto rounded-xl border border-zinc-200 bg-white shadow-xl dark:border-zinc-800 dark:bg-zinc-900" role="dialog" aria-modal="true" aria-labelledby="project-dialog-title">
        <div class="flex items-start justify-between border-b border-zinc-200 px-5 py-4 dark:border-zinc-800">
          <div>
            <h2 id="project-dialog-title" class="text-base font-semibold">{{ projectDraft.id ? 'Edit projek' : 'Tambah projek' }}</h2>
            <p class="mt-1 text-xs text-zinc-500 dark:text-zinc-400">Informasi ini akan ditampilkan di koleksi karya.</p>
          </div>
          <button type="button" class="rounded-md p-1.5 text-zinc-500 hover:bg-zinc-100 dark:hover:bg-zinc-800" aria-label="Tutup" @click="projectEditorOpen = false"><X class="size-4" /></button>
        </div>
        <form class="space-y-4 p-5" @submit.prevent="saveProject">
          <div class="grid gap-4 sm:grid-cols-2">
            <label class="space-y-2">
              <span class="text-xs font-medium">Nama projek</span>
              <input v-model.trim="projectDraft.title" required maxlength="120" class="h-10 w-full rounded-lg border border-zinc-200 bg-white px-3 text-sm outline-none focus:border-zinc-500 dark:border-zinc-800 dark:bg-zinc-950">
            </label>
            <label class="space-y-2">
              <span class="text-xs font-medium">Jenis projek</span>
              <select v-model="projectDraft.category" class="h-10 w-full rounded-lg border border-zinc-200 bg-white px-3 text-sm outline-none focus:border-zinc-500 dark:border-zinc-800 dark:bg-zinc-950">
                <option v-for="category in projectCategories" :key="category" :value="category">{{ category }}</option>
              </select>
            </label>
          </div>
          <label class="block space-y-2">
            <span class="text-xs font-medium">Deskripsi</span>
            <textarea v-model.trim="projectDraft.description" required maxlength="500" rows="3" class="w-full resize-y rounded-lg border border-zinc-200 bg-white px-3 py-2.5 text-sm leading-5 outline-none focus:border-zinc-500 dark:border-zinc-800 dark:bg-zinc-950"></textarea>
          </label>
          <div class="grid gap-4 sm:grid-cols-2">
            <label class="space-y-2">
              <span class="text-xs font-medium">Tahun</span>
              <input v-model.trim="projectDraft.year" required inputmode="numeric" pattern="[0-9]{4}" maxlength="4" class="h-10 w-full rounded-lg border border-zinc-200 bg-white px-3 text-sm outline-none focus:border-zinc-500 dark:border-zinc-800 dark:bg-zinc-950">
            </label>
            <label class="space-y-2">
              <span class="text-xs font-medium">Teknologi (pisahkan dengan koma)</span>
              <input v-model.trim="projectDraft.techText" placeholder="Vue.js, Laravel" class="h-10 w-full rounded-lg border border-zinc-200 bg-white px-3 text-sm outline-none focus:border-zinc-500 dark:border-zinc-800 dark:bg-zinc-950">
            </label>
          </div>
          <label class="block space-y-2">
            <span class="text-xs font-medium">Tautan projek</span>
            <input v-model.trim="projectDraft.link" type="text" placeholder="https://... atau #" class="h-10 w-full rounded-lg border border-zinc-200 bg-white px-3 text-sm outline-none focus:border-zinc-500 dark:border-zinc-800 dark:bg-zinc-950">
          </label>
          <div class="space-y-2">
            <span class="text-xs font-medium">Gambar sampul</span>
            <div class="flex items-center gap-3">
              <img :src="projectDraft.image" alt="Pratinjau sampul projek" class="size-20 rounded-lg border border-zinc-200 object-cover grayscale dark:border-zinc-800">
              <div class="flex-1">
                <input ref="projectImageInput" type="file" accept="image/*" class="hidden" @change="handleProjectImageUpload">
                <button type="button" class="inline-flex h-9 items-center gap-2 rounded-lg border border-zinc-200 px-3 text-xs font-medium transition hover:bg-zinc-50 dark:border-zinc-700 dark:hover:bg-zinc-800" @click="projectImageInput?.click()">
                  <Upload class="size-3.5" />
                  Pilih gambar
                </button>
                <p class="mt-2 text-[11px] text-zinc-500 dark:text-zinc-400">JPG, PNG, atau WebP · maks. 1,5 MB</p>
              </div>
            </div>
          </div>
          <label class="flex items-center gap-2 text-xs text-zinc-600 dark:text-zinc-300">
            <input v-model="projectDraft.featured" type="checkbox" class="size-4 rounded border-zinc-300 accent-zinc-900 dark:accent-white">
            Tandai sebagai projek unggulan
          </label>
          <div class="flex justify-end gap-2 border-t border-zinc-100 pt-4 dark:border-zinc-800">
            <button type="button" class="h-9 rounded-lg border border-zinc-200 px-3 text-xs font-medium transition hover:bg-zinc-50 dark:border-zinc-700 dark:hover:bg-zinc-800" @click="projectEditorOpen = false">Batal</button>
            <button type="submit" class="h-9 rounded-lg bg-zinc-900 px-4 text-xs font-semibold text-white transition hover:bg-zinc-700 dark:bg-white dark:text-zinc-950 dark:hover:bg-zinc-200">Simpan projek</button>
          </div>
        </form>
      </section>
    </div>
    <div v-if="galleryRename" class="fixed inset-0 z-50 flex items-center justify-center bg-black/45 p-4" @click.self="galleryRename = null">
      <form class="w-full max-w-sm rounded-xl border border-zinc-200 bg-white p-5 shadow-xl dark:border-zinc-800 dark:bg-zinc-900" role="dialog" aria-modal="true" aria-labelledby="gallery-rename-title" @submit.prevent="saveGalleryName">
        <h2 id="gallery-rename-title" class="text-base font-semibold">Ubah nama gambar</h2>
        <label class="mt-4 block space-y-2">
          <span class="text-xs font-medium">Nama dokumentasi</span>
          <input v-model.trim="galleryRename.title" required maxlength="100" class="h-10 w-full rounded-lg border border-zinc-200 bg-white px-3 text-sm outline-none focus:border-zinc-500 dark:border-zinc-800 dark:bg-zinc-950">
        </label>
        <div class="mt-5 flex justify-end gap-2">
          <button type="button" class="h-9 rounded-lg border border-zinc-200 px-3 text-xs font-medium dark:border-zinc-700" @click="galleryRename = null">Batal</button>
          <button type="submit" class="h-9 rounded-lg bg-zinc-900 px-4 text-xs font-semibold text-white dark:bg-white dark:text-zinc-950">Simpan</button>
        </div>
      </form>
    </div>
    <div v-if="profileCropOpen" class="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto bg-black/55 p-4" @click.self="cancelProfileCrop">
      <section class="my-auto w-full max-w-md rounded-xl border border-zinc-200 bg-white shadow-xl dark:border-zinc-800 dark:bg-zinc-900" role="dialog" aria-modal="true" aria-labelledby="profile-crop-title">
        <div class="flex items-start justify-between border-b border-zinc-200 px-5 py-4 dark:border-zinc-800">
          <div>
            <h2 id="profile-crop-title" class="text-base font-semibold">Atur foto profil</h2>
            <p class="mt-1 text-xs text-zinc-500 dark:text-zinc-400">Geser foto dan atur zoom untuk memilih bagian yang ditampilkan.</p>
          </div>
          <button type="button" class="rounded-md p-1.5 text-zinc-500 hover:bg-zinc-100 dark:hover:bg-zinc-800" aria-label="Tutup crop foto" @click="cancelProfileCrop">
            <X class="size-4" />
          </button>
        </div>
        <div class="space-y-4 p-5">
          <div
            ref="cropViewport"
            class="relative mx-auto aspect-square w-full max-w-72 touch-none cursor-grab overflow-hidden rounded-xl bg-zinc-100 active:cursor-grabbing dark:bg-zinc-800"
            aria-label="Area crop foto persegi"
            @pointerdown="startCropDrag"
            @pointermove="moveCropImage"
            @pointerup="endCropDrag"
            @pointercancel="endCropDrag">
            <img
              v-if="cropImageUrl"
              :src="cropImageUrl"
              alt="Pratinjau crop foto profil"
              draggable="false"
              class="pointer-events-none absolute max-w-none select-none"
              :style="cropPreviewStyle">
            <div class="pointer-events-none absolute inset-0 ring-1 ring-inset ring-black/15 dark:ring-white/20"></div>
          </div>
          <label class="block space-y-2">
            <span class="flex items-center justify-between text-xs font-medium">
              <span>Zoom</span>
              <span class="text-zinc-500 dark:text-zinc-400">{{ Math.round(cropZoom * 100) }}%</span>
            </span>
            <input v-model.number="cropZoom" type="range" min="1" max="3" step="0.01" class="w-full accent-zinc-900 dark:accent-white">
          </label>
          <div class="flex justify-end gap-2 border-t border-zinc-100 pt-4 dark:border-zinc-800">
            <button type="button" class="h-9 rounded-lg border border-zinc-200 px-3 text-xs font-medium dark:border-zinc-700" @click="cancelProfileCrop">Batal</button>
            <button type="button" class="h-9 rounded-lg bg-zinc-900 px-4 text-xs font-semibold text-white dark:bg-white dark:text-zinc-950" @click="applyProfileCrop">Gunakan foto</button>
          </div>
        </div>
      </section>
    </div>
    <div v-if="pendingDelete" class="fixed inset-0 z-50 flex items-center justify-center bg-black/45 p-4">
      <section class="w-full max-w-sm rounded-xl border border-zinc-200 bg-white p-5 shadow-xl dark:border-zinc-800 dark:bg-zinc-900" role="alertdialog" aria-modal="true" aria-labelledby="delete-title">
        <h2 id="delete-title" class="text-base font-semibold">Hapus konten?</h2>
        <p class="mt-2 text-sm leading-6 text-zinc-500 dark:text-zinc-400">“{{ pendingDelete.title }}” akan dihapus dari pratinjau portofolio di browser ini.</p>
        <div class="mt-5 flex justify-end gap-2">
          <button type="button" class="h-9 rounded-lg border border-zinc-200 px-3 text-xs font-medium dark:border-zinc-700" @click="pendingDelete = null">Batal</button>
          <button type="button" class="h-9 rounded-lg bg-zinc-900 px-4 text-xs font-semibold text-white dark:bg-white dark:text-zinc-950" @click="confirmDelete">Hapus</button>
        </div>
      </section>
    </div>
  </div>
</template>

<script setup>
import { computed, nextTick, onMounted, onUnmounted, ref, shallowRef, watch } from 'vue';
import {
  ArrowLeft,
  ArrowUpRight,
  Camera,
  Check,
  ExternalLink,
  FolderKanban,
  Image,
  LayoutDashboard,
  LogOut,
  Mail,
  Moon,
  Pencil,
  Plus,
  Search,
  Sun,
  Trash2,
  Upload,
  UserRound,
  X,
} from 'lucide-vue-next';
import {
  getAdminSession,
  getAdminMessages,
  initializePortfolioContent,
  loadPortfolioContent,
  loginAdmin,
  markAdminMessageRead,
  deleteAdminMessage,
  logoutAdmin,
  refreshAdminPresence,
  savePortfolioContent,
  uploadPortfolioImage,
} from '../portfolio-content';

defineProps({
  isDark: {
    type: Boolean,
    default: false,
  },
});

defineEmits(['toggle-theme']);

const content = ref(loadPortfolioContent());
const isAuthenticated = ref(false);
const loginEmail = ref('');
const loginPassword = ref('');
const loginError = ref('');
const activeView = ref('overview');
const sidebarCollapsed = ref(false);
const mobileSidebarOpen = ref(false);
const showSidebarLabels = computed(() => !sidebarCollapsed.value || mobileSidebarOpen.value);
const projectSearch = ref('');
const projectEditorOpen = ref(false);
const projectImageInput = ref(null);
const profileImageInput = ref(null);
const profileCropOpen = ref(false);
const cropImageUrl = ref('');
const cropSourceImage = shallowRef(null);
const cropViewport = ref(null);
const cropFrameSize = ref(288);
const cropZoom = ref(1);
const cropOffset = ref({ x: 0, y: 0 });
const galleryInput = ref(null);
const galleryReplaceInput = ref(null);
const replaceGalleryItemId = ref(null);
const projectDraft = ref({});
const galleryRename = ref(null);
const pendingDelete = ref(null);
const notice = ref('');
const messages = ref([]);
const messageError = ref('');
const additionalContentDraft = ref('');
const projectCategories = ['UMKM', 'Portofolio', 'Sistem Informasi', 'Aplikasi'];
const additionalContentKeys = ['stats', 'skills', 'achievements', 'services', 'contacts', 'medsos', 'socialLinks'];
let noticeTimeout;
let presenceInterval;

const navItems = [
  { id: 'overview', label: 'Ringkasan', icon: LayoutDashboard },
  { id: 'projects', label: 'Projek', icon: FolderKanban },
  { id: 'media', label: 'Galeri gambar', icon: Image },
  { id: 'messages', label: 'Pesan', icon: Mail },
  { id: 'content', label: 'Konten publik', icon: Check },
  { id: 'profile', label: 'Profil', icon: UserRound },
];

const profileDraft = ref({ ...content.value.profile });
let cropDragStart = null;

const cropScale = computed(() => {
  const image = cropSourceImage.value;

  if (!image) {
    return 1;
  }

  return Math.max(
    cropFrameSize.value / image.naturalWidth,
    cropFrameSize.value / image.naturalHeight,
  ) * cropZoom.value;
});

const cropPreviewStyle = computed(() => {
  const image = cropSourceImage.value;

  if (!image) {
    return {};
  }

  return {
    width: `${image.naturalWidth}px`,
    height: `${image.naturalHeight}px`,
    left: `calc(50% + ${cropOffset.value.x}px)`,
    top: `calc(50% + ${cropOffset.value.y}px)`,
    transform: `translate(-50%, -50%) scale(${cropScale.value})`,
  };
});

function selectAdminView(view) {
  activeView.value = view;
  mobileSidebarOpen.value = false;

  if (view === 'content') {
    const additionalContent = Object.fromEntries(
      additionalContentKeys.map((key) => [key, content.value[key]]),
    );
    additionalContentDraft.value = JSON.stringify(additionalContent, null, 2);
  }

  if (view === 'messages') {
    void loadMessages();
  }
}

onMounted(() => {
  void initializeAdmin();
});

onUnmounted(() => {
  window.clearInterval(presenceInterval);
});

const currentViewTitle = computed(() => navItems.find((item) => item.id === activeView.value)?.label ?? 'Admin');
const unreadMessageCount = computed(() => messages.value.filter((message) => !message.is_read).length);

const dashboardStats = computed(() => [
  {
    label: 'Total projek',
    value: content.value.projects.length,
    description: 'Karya dalam koleksi portofolio',
    icon: FolderKanban,
  },
  {
    label: 'Projek unggulan',
    value: content.value.projects.filter((project) => project.featured).length,
    description: 'Ditandai untuk ditampilkan',
    icon: Check,
  },
  {
    label: 'Gambar dokumentasi',
    value: content.value.gallery.length,
    description: 'Aset visual di galeri',
    icon: Image,
  },
]);

const filteredProjects = computed(() => {
  const query = projectSearch.value.trim().toLocaleLowerCase();

  if (!query) {
    return content.value.projects;
  }

  return content.value.projects.filter((project) =>
    `${project.title} ${project.category}`.toLocaleLowerCase().includes(query),
  );
});

watch(
  () => content.value.profile,
  (profile) => {
    profileDraft.value = { ...profile };
  },
);

async function initializeAdmin() {
  try {
    const session = await getAdminSession();

    if (session.authenticated) {
      await initializePortfolioContent();
      content.value = loadPortfolioContent();
      profileDraft.value = { ...content.value.profile };
      isAuthenticated.value = true;
      startPresenceHeartbeat();
    }
  } catch (error) {
    loginError.value = error.message || 'Status login admin tidak dapat diperiksa.';
  }
}

async function login() {
  if (!loginEmail.value || !loginPassword.value) {
    loginError.value = 'Isi email dan kata sandi admin.';
    return;
  }

  try {
    loginError.value = '';
    await loginAdmin(loginEmail.value, loginPassword.value);
    await initializePortfolioContent();
    content.value = loadPortfolioContent();
    profileDraft.value = { ...content.value.profile };
    isAuthenticated.value = true;
    startPresenceHeartbeat();
    loginPassword.value = '';
  } catch (error) {
    loginError.value = error.message || 'Email atau kata sandi tidak sesuai.';
  }
}

async function logout() {
  try {
    await logoutAdmin();
    window.clearInterval(presenceInterval);
    presenceInterval = undefined;
    isAuthenticated.value = false;
    loginPassword.value = '';
    activeView.value = 'overview';
    await initializePortfolioContent();
    content.value = loadPortfolioContent();
    profileDraft.value = { ...content.value.profile };
  } catch (error) {
    showNotice(error.message || 'Tidak dapat keluar dari akun admin.');
  }
}

function startPresenceHeartbeat() {
  window.clearInterval(presenceInterval);
  const refresh = () => {
    refreshAdminPresence().catch((error) => {
      console.error('Status admin tidak dapat diperbarui.', error);
    });
  };

  refresh();
  presenceInterval = window.setInterval(refresh, 60_000);
}

async function loadMessages() {
  try {
    messageError.value = '';
    messages.value = await getAdminMessages();
  } catch (error) {
    messageError.value = error.message || 'Pesan pengunjung tidak dapat dimuat.';
  }
}

async function markMessageRead(id) {
  try {
    const result = await markAdminMessageRead(id);
    messages.value = messages.value.map((message) => message.id === id ? result.data : message);
  } catch (error) {
    showNotice(error.message || 'Status pesan gagal diperbarui.');
  }
}

async function deleteMessage(id) {
  try {
    await deleteAdminMessage(id);
    messages.value = messages.value.filter((message) => message.id !== id);
    showNotice('Pesan berhasil dihapus.');
  } catch (error) {
    showNotice(error.message || 'Pesan gagal dihapus.');
  }
}

function showNotice(message) {
  notice.value = message;
  window.clearTimeout(noticeTimeout);
  noticeTimeout = window.setTimeout(() => {
    notice.value = '';
  }, 3500);
}

async function persistContent(updatedContent, successMessage) {
  try {
    content.value = await savePortfolioContent(updatedContent);
    showNotice(successMessage);
    return true;
  } catch (error) {
    console.error('Perubahan portofolio tidak dapat disimpan di server.', error);
    showNotice(error.message || 'Perubahan tidak dapat disimpan. Coba lagi.');
    return false;
  }
}

async function saveAdditionalContent() {
  let additionalContent;

  try {
    additionalContent = JSON.parse(additionalContentDraft.value);
  } catch (error) {
    showNotice('Format JSON tidak valid. Periksa tanda kurung dan koma.');
    return;
  }

  if (
    !additionalContent
    || Array.isArray(additionalContent)
    || typeof additionalContent !== 'object'
    || Object.keys(additionalContent).some((key) => !additionalContentKeys.includes(key))
    || additionalContentKeys.some((key) => !Array.isArray(additionalContent[key]))
  ) {
    showNotice('JSON harus berisi daftar stats, skills, achievements, services, contacts, medsos, dan socialLinks.');
    return;
  }

  if (await persistContent({ ...content.value, ...additionalContent }, 'Konten publik berhasil disimpan.')) {
    additionalContentDraft.value = JSON.stringify(additionalContent, null, 2);
  }
}

function openProjectEditor(project = null) {
  projectDraft.value = project
    ? { ...project, techText: project.techs.join(', ') }
    : {
        id: '',
        title: '',
        description: '',
        category: projectCategories[0],
        featured: false,
        year: String(new Date().getFullYear()),
        image: 'https://avatar.vercel.sh/project',
        techs: [],
        techText: '',
        link: '',
      };
  projectEditorOpen.value = true;
}

async function saveProject() {
  if (!projectDraft.value.title || !projectDraft.value.description) {
    return;
  }

  const project = {
    id: projectDraft.value.id || `project-${Date.now().toString(36)}`,
    title: projectDraft.value.title,
    description: projectDraft.value.description,
    category: projectDraft.value.category,
    featured: projectDraft.value.featured,
    year: projectDraft.value.year,
    image: projectDraft.value.image || 'https://avatar.vercel.sh/project',
    techs: projectDraft.value.techText.split(',').map((tech) => tech.trim()).filter(Boolean),
    link: projectDraft.value.link || '#',
  };
  const projects = projectDraft.value.id
    ? content.value.projects.map((item) => (item.id === project.id ? project : item))
    : [project, ...content.value.projects];

  if (await persistContent({ ...content.value, projects }, 'Projek berhasil disimpan.')) {
    projectEditorOpen.value = false;
  }
}

function readImage(file, onLoad) {
  if (!file) {
    return;
  }

  if (!file.type.startsWith('image/')) {
    showNotice('Pilih berkas gambar yang valid.');
    return;
  }

  if (file.size > 1.5 * 1024 * 1024) {
    showNotice('Ukuran gambar melebihi batas 1,5 MB.');
    return;
  }

  const reader = new FileReader();
  reader.onload = () => {
    if (typeof reader.result === 'string') {
      onLoad(reader.result);
    } else {
      showNotice('Gambar tidak dapat dibaca. Coba berkas lain.');
    }
  };
  reader.onerror = () => {
    showNotice('Gambar tidak dapat dibaca. Coba berkas lain.');
  };
  reader.readAsDataURL(file);
}

async function handleProjectImageUpload(event) {
  const file = event.target.files?.[0];
  event.target.value = '';

  if (!file) {
    return;
  }

  try {
    projectDraft.value.image = await uploadPortfolioImage(file);
  } catch (error) {
    showNotice(error.message || 'Gambar projek gagal diunggah.');
  }
}

function handleProfileImageUpload(event) {
  const file = event.target.files?.[0];
  readImage(file, (image) => {
    void openProfileCrop(image);
  });
  event.target.value = '';
}

async function openProfileCrop(imageUrl) {
  const image = new window.Image();
  image.src = imageUrl;

  try {
    await image.decode();
  } catch (error) {
    console.error('Foto profil tidak dapat dimuat untuk dicrop.', error);
    showNotice('Foto profil tidak dapat dibuka. Coba pilih gambar lain.');
    return;
  }

  cropSourceImage.value = image;
  cropImageUrl.value = imageUrl;
  cropZoom.value = 1;
  cropOffset.value = { x: 0, y: 0 };
  profileCropOpen.value = true;
  await nextTick();
  cropFrameSize.value = cropViewport.value?.getBoundingClientRect().width || 288;
}

function clampCropOffset() {
  const image = cropSourceImage.value;

  if (!image) {
    return;
  }

  const renderedWidth = image.naturalWidth * cropScale.value;
  const renderedHeight = image.naturalHeight * cropScale.value;
  const maxOffsetX = Math.max(0, (renderedWidth - cropFrameSize.value) / 2);
  const maxOffsetY = Math.max(0, (renderedHeight - cropFrameSize.value) / 2);

  cropOffset.value = {
    x: Math.max(-maxOffsetX, Math.min(maxOffsetX, cropOffset.value.x)),
    y: Math.max(-maxOffsetY, Math.min(maxOffsetY, cropOffset.value.y)),
  };
}

watch(cropZoom, clampCropOffset);

function startCropDrag(event) {
  if (!cropSourceImage.value) {
    return;
  }

  event.preventDefault();
  event.currentTarget.setPointerCapture(event.pointerId);
  cropDragStart = {
    pointerX: event.clientX,
    pointerY: event.clientY,
    offsetX: cropOffset.value.x,
    offsetY: cropOffset.value.y,
  };
}

function moveCropImage(event) {
  if (!cropDragStart) {
    return;
  }

  cropOffset.value = {
    x: cropDragStart.offsetX + event.clientX - cropDragStart.pointerX,
    y: cropDragStart.offsetY + event.clientY - cropDragStart.pointerY,
  };
  clampCropOffset();
}

function endCropDrag() {
  cropDragStart = null;
}

function cancelProfileCrop() {
  profileCropOpen.value = false;
  cropImageUrl.value = '';
  cropSourceImage.value = null;
  cropDragStart = null;
}

function applyProfileCrop() {
  const image = cropSourceImage.value;
  const frameSize = cropViewport.value?.getBoundingClientRect().width || cropFrameSize.value;

  if (!image || frameSize <= 0) {
    showNotice('Area crop foto tidak siap. Coba pilih gambarnya lagi.');
    return;
  }

  const sourceSize = frameSize / cropScale.value;
  const sourceX = Math.max(
    0,
    Math.min(image.naturalWidth - sourceSize, (image.naturalWidth - sourceSize) / 2 - cropOffset.value.x / cropScale.value),
  );
  const sourceY = Math.max(
    0,
    Math.min(image.naturalHeight - sourceSize, (image.naturalHeight - sourceSize) / 2 - cropOffset.value.y / cropScale.value),
  );
  const canvas = document.createElement('canvas');
  canvas.width = 512;
  canvas.height = 512;

  const context = canvas.getContext('2d');

  if (!context) {
    showNotice('Foto tidak dapat diproses oleh browser ini.');
    return;
  }

  try {
    context.drawImage(image, sourceX, sourceY, sourceSize, sourceSize, 0, 0, canvas.width, canvas.height);
    profileDraft.value.avatar = canvas.toDataURL('image/jpeg', 0.9);
    cancelProfileCrop();
    showNotice('Crop foto diterapkan. Simpan perubahan profil untuk menyimpan foto.');
  } catch (error) {
    console.error('Foto profil hasil crop tidak dapat dibuat.', error);
    showNotice('Foto gagal diproses. Coba gambar lain.');
  }
}

async function handleGalleryUpload(event) {
  const file = event.target.files?.[0];
  event.target.value = '';

  if (!file) {
    return;
  }

  try {
    const galleryItem = {
      id: `image-${Date.now().toString(36)}`,
      title: file.name.replace(/\.[^.]+$/, ''),
      image: await uploadPortfolioImage(file),
    };

    await persistContent({ ...content.value, gallery: [galleryItem, ...content.value.gallery] }, 'Gambar ditambahkan ke galeri.');
  } catch (error) {
    showNotice(error.message || 'Gambar galeri gagal diunggah.');
  }
}

async function handleGalleryReplace(event) {
  const file = event.target.files?.[0];
  const itemId = replaceGalleryItemId.value;
  replaceGalleryItemId.value = null;
  event.target.value = '';

  if (!file) {
    return;
  }

  try {
    const image = await uploadPortfolioImage(file);
    const gallery = content.value.gallery.map((item) =>
      item.id === itemId ? { ...item, image } : item,
    );

    await persistContent({ ...content.value, gallery }, 'Gambar dokumentasi berhasil diperbarui.');
  } catch (error) {
    showNotice(error.message || 'Gambar galeri gagal diperbarui.');
  }
}

function replaceGalleryImage(item) {
  replaceGalleryItemId.value = item.id;
  galleryReplaceInput.value?.click();
}

async function saveProfile() {
  try {
    const profile = {
      ...profileDraft.value,
      avatar: await uploadPortfolioImage(profileDraft.value.avatar),
    };

    if (await persistContent({ ...content.value, profile }, 'Profil portofolio berhasil diperbarui.')) {
      activeView.value = 'profile';
    }
  } catch (error) {
    showNotice(error.message || 'Foto profil gagal diunggah.');
  }
}

function askDelete(type, id, title) {
  pendingDelete.value = { type, id, title };
}

async function confirmDelete() {
  const target = pendingDelete.value;

  if (!target) {
    return;
  }

  const updatedContent = target.type === 'project'
    ? { ...content.value, projects: content.value.projects.filter((project) => project.id !== target.id) }
    : { ...content.value, gallery: content.value.gallery.filter((item) => item.id !== target.id) };

  if (await persistContent(updatedContent, 'Konten berhasil dihapus.')) {
    pendingDelete.value = null;
  }
}

function renameGalleryItem(item) {
  galleryRename.value = { id: item.id, title: item.title };
}

async function saveGalleryName() {
  const gallery = content.value.gallery.map((item) =>
    item.id === galleryRename.value.id ? { ...item, title: galleryRename.value.title } : item,
  );

  if (await persistContent({ ...content.value, gallery }, 'Nama gambar berhasil diperbarui.')) {
    galleryRename.value = null;
  }
}
</script>
