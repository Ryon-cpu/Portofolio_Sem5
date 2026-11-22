<template>
  <!-- Command Palette Dialog (Komponen 12: CommandDemo) -->
  <Teleport to="body">
    <div
      class="fixed inset-0 z-50 flex items-start justify-center pt-24 px-4"
      @click.self="$emit('close')">
      <!-- Overlay -->
      <div class="absolute inset-0 bg-black/40 dark:bg-black/60 backdrop-blur-sm"></div>
      <!-- Panel Command -->
      <div class="relative w-full max-w-md rounded-xl border border-zinc-200 dark:border-zinc-800 bg-white dark:bg-zinc-900 shadow-2xl overflow-hidden">
        <!-- Input Pencarian -->
        <div class="flex items-center gap-2 px-4 py-3 border-b border-zinc-200 dark:border-zinc-800">
          <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-zinc-400 flex-shrink-0">
            <circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/>
          </svg>
          <input
            ref="cmdInput"
            v-model="query"
            type="text"
            placeholder="Ketik perintah atau cari..."
            class="flex-1 text-sm bg-transparent text-zinc-900 dark:text-white placeholder-zinc-400 dark:placeholder-zinc-500 focus:outline-none"
          />
          <kbd
            @click="$emit('close')"
            class="hidden sm:inline-flex border border-zinc-200 dark:border-zinc-700 bg-zinc-100 dark:bg-zinc-800 rounded px-1.5 py-0.5 text-[10px] font-mono text-zinc-500 cursor-pointer hover:bg-zinc-200 dark:hover:bg-zinc-700 transition-colors"
          >Esc</kbd>
        </div>

        <!-- Command List -->
        <div class="max-h-80 overflow-y-auto py-2">
          <div v-for="group in filteredGroups" :key="group.heading">
            <div v-if="group.items.length" class="px-4 py-1.5">
              <span class="text-[10px] font-semibold uppercase tracking-widest text-zinc-400 dark:text-zinc-500">
                {{ group.heading }}
              </span>
            </div>
            <button
              v-for="item in group.items"
              :key="item.label"
              @click="runCommand(item)"
              type="button"
              class="w-full flex items-center justify-between gap-3 px-4 py-2.5 text-sm text-zinc-700 dark:text-zinc-300 hover:bg-zinc-100 dark:hover:bg-zinc-800 hover:text-zinc-900 dark:hover:text-white transition-colors text-left"
            >
              <div class="flex items-center gap-3">
                <span class="w-5 h-5 flex items-center justify-center text-zinc-400 dark:text-zinc-500 flex-shrink-0" v-html="item.icon"></span>
                <span>{{ item.label }}</span>
              </div>
              <kbd v-if="item.shortcut" class="border border-zinc-200 dark:border-zinc-700 bg-zinc-100 dark:bg-zinc-800 rounded px-1.5 py-0.5 text-[10px] font-mono text-zinc-400 dark:text-zinc-500 flex-shrink-0">
                {{ item.shortcut }}
              </kbd>
            </button>

            <!-- Separator -->
            <div v-if="group.items.length" class="my-1 border-t border-zinc-100 dark:border-zinc-800 last:hidden"></div>
          </div>

          <!-- Empty State (Komponen 16 404-style) -->
          <div v-if="filteredGroups.every(g => g.items.length === 0)" class="px-4 py-8 text-center text-sm text-zinc-500 dark:text-zinc-400">
            Tidak ada hasil untuk "<span class="font-medium text-zinc-700 dark:text-zinc-300">{{ query }}</span>"
          </div>
        </div>

      </div>
    </div>
  </Teleport>
</template>

<script setup>
import { ref, computed, onMounted, nextTick } from 'vue';

const emit = defineEmits(['close']);
const query = ref('');
const cmdInput = ref(null);

onMounted(async () => {
  await nextTick();
  cmdInput.value?.focus();
});

const commandGroups = [
  {
    heading: 'Navigasi',
    items: [
      { label: 'Tentang Saya',    shortcut: null, href: '#about',        icon: '<circle cx="12" cy="8" r="4"/><path d="M6 20v-2a6 6 0 0 1 12 0v2"/>' },
      { label: 'Keahlian',        shortcut: null, href: '#skills',       icon: '<polyline points="22 12 18 12 15 21 9 3 6 12 2 12"/>' },
      { label: 'Projek Saya',     shortcut: null, href: '#projects',     icon: '<rect width="18" height="18" x="3" y="3" rx="2"/><path d="M9 9h6M9 13h6"/>' },
      { label: 'Hubungi Saya',    shortcut: null, href: '#contact',      icon: '<path d="m22 2-7 20-4-9-9-4Z"/><path d="M22 2 11 13"/>' },
    ],
  },
  {
    heading: 'Pengaturan',
    items: [
      { label: 'Profil Saya',     shortcut: '⌘P', href: null, action: 'profile' },
      { label: 'Tagihan / Invoice', shortcut: '⌘B', href: null, action: 'billing' },
      { label: 'Pengaturan',      shortcut: '⌘S', href: null, action: 'settings' },
    ],
  },
];

const filteredGroups = computed(() => {
  if (!query.value.trim()) return commandGroups;
  const q = query.value.toLowerCase();
  return commandGroups.map(group => ({
    ...group,
    items: group.items.filter(i => i.label.toLowerCase().includes(q)),
  }));
});

function runCommand(item) {
  if (item.href) {
    document.querySelector(item.href)?.scrollIntoView({ behavior: 'smooth' });
  }
  emit('close');
}
</script>

