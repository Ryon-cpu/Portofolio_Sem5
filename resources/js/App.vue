<template>
  <AdminDashboard v-if="isAdminPage" :is-dark="isDark" @toggle-theme="toggleTheme" />

  <div v-else class="min-h-screen w-full overflow-x-hidden bg-white dark:bg-zinc-950 text-zinc-900 dark:text-zinc-100 transition-colors duration-200">
    <!-- Navbar -->
    <Navbar :is-dark="isDark" @toggle-theme="toggleTheme" @open-search="showCommand = true" />

    <!-- Main Content -->
    <main>
      <HeroSection @open-search="showCommand = true" />
      <PersonalInfoSection />
      <AboutSection />
      <SkillsSection />
      <ProjectsSection />
      <AchievementsSection />
      <ContactSection />
    </main>

    <!-- Footer -->
    <FooterSection />

    <!-- Command Palette Dialog (Komponen 12) -->
    <CommandDialog v-if="showCommand" @close="showCommand = false" />

    <!-- Back to Top Button -->
    <button
      v-if="showBackToTop"
      @click="scrollToTop"
      class="fixed bottom-6 right-6 border border-zinc-200 dark:border-zinc-800 rounded-lg p-2.5 bg-white/90 dark:bg-zinc-900/90 text-zinc-600 dark:text-zinc-400 hover:text-zinc-900 dark:hover:text-white hover:border-zinc-400 dark:hover:border-zinc-600 shadow-md backdrop-blur transition-all z-40"
      aria-label="Kembali ke atas"
    >
      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="m18 15-6-6-6 6"/>
      </svg>
    </button>
  </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue';

import AdminDashboard from './components/AdminDashboard.vue';
import Navbar from './components/Navbar.vue';
import HeroSection from './components/HeroSection.vue';
import AboutSection from './components/AboutSection.vue';
import SkillsSection from './components/SkillsSection.vue';
import ProjectsSection from './components/ProjectsSection.vue';
import AchievementsSection from './components/AchievementsSection.vue';
import PersonalInfoSection from './components/PersonalInfoSection.vue';
import ContactSection from './components/ContactSection.vue';
import FooterSection from './components/FooterSection.vue';
import CommandDialog from './components/CommandDialog.vue';
import { initializePortfolioContent } from './portfolio-content';

// === Dark Mode State (default sementara untuk meninjau palet baru) ===
const isDark = ref(true);
const showCommand = ref(false);
const showBackToTop = ref(false);
const isAdminPage = window.location.pathname.replace(/\/+$/, '') === '/admin';

function applyTheme(dark) {
  if (dark) {
    document.documentElement.classList.add('dark');
  } else {
    document.documentElement.classList.remove('dark');
  }
}

function toggleTheme() {
  isDark.value = !isDark.value;
  localStorage.setItem('theme', isDark.value ? 'dark' : 'light');
  applyTheme(isDark.value);
}

function handleScroll() {
  showBackToTop.value = window.scrollY > 400;
}

function scrollToTop() {
  window.scrollTo({ top: 0, behavior: 'smooth' });
}

function handleKeydown(e) {
  if ((e.metaKey || e.ctrlKey) && e.key === 'k') {
    e.preventDefault();
    showCommand.value = !showCommand.value;
  }
  if (e.key === 'Escape') {
    showCommand.value = false;
  }
}

onMounted(() => {
  const saved = localStorage.getItem('theme');
  if (saved === 'dark') {
    isDark.value = true;
  } else if (saved === 'light') {
    isDark.value = false;
  } else {
    isDark.value = true;
  }
  applyTheme(isDark.value);
  if (!isAdminPage) {
    initializePortfolioContent().catch((error) => {
      console.error('Konten portofolio dari server tidak dapat dimuat.', error);
    });
  }

  window.addEventListener('scroll', handleScroll);
  window.addEventListener('keydown', handleKeydown);
});

onUnmounted(() => {
  window.removeEventListener('scroll', handleScroll);
  window.removeEventListener('keydown', handleKeydown);
});
</script>
