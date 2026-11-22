# Spesifikasi Komponen UI Portofolio (Shadcn UI)

**Instruksi Penting untuk AI (Claude):** - Gunakan komponen-komponen di
bawah ini sesuai dengan fungsi dan konteks yang telah ditentukan. -
**Dilarang menambahkan warna kustom baru**; pertahankan styling, kelas
warna, dan tema bawaan persis seperti yang tertulis pada kode referensi
di bawah ini. - Untuk bagian terakhir yang terpotong
(`@/components/ui/avata...`), lengkapi struktur standar `Avatar` dari
Shadcn UI untuk pengelompokan tipe projek (UMKM, portofolio, dll) tanpa
mengubah skema warna.

------------------------------------------------------------------------

## 1. Buka Tautan

Digunakan untuk tombol atau badge tautan eksternal/internal.

``` tsx
import { ArrowUpRightIcon } from "lucide-react"

import { Badge } from "@/components/ui/badge"

export function BadgeAsLink() {
  return (
    <Badge render={<a href="#link">Open Link <ArrowUpRightIcon data-icon="inline-end" /></a>} />
  )
}
```

------------------------------------------------------------------------

## 2. Profil Ketika Online di Portofolio

Digunakan sebagai indikator status profil saat sedang online.

``` tsx
import {
  Avatar,
  AvatarBadge,
  AvatarFallback,
  AvatarImage,
} from "@/components/ui/avatar"

export function AvatarWithBadge() {
  return (
    <Avatar>
      <AvatarImage src="https://github.com/shadcn.png" alt="@shadcn" />
      <AvatarFallback>CN</AvatarFallback>
      <AvatarBadge className="bg-green-600 dark:bg-green-800" />
    </Avatar>
  )
}
```

------------------------------------------------------------------------

## 3. Avatar Ketika Offline dari Portofolio

Digunakan sebagai indikator status profil saat sedang offline.

``` tsx
import {
  Avatar,
  AvatarFallback,
  AvatarImage,
} from "@/components/ui/avatar"

export function AvatarDemo() {
  return (
    <Avatar>
      <AvatarImage
        src="https://github.com/shadcn.png"
        alt="@shadcn"
        className="grayscale"
      />
      <AvatarFallback>CN</AvatarFallback>
    </Avatar>
  )
}
```

------------------------------------------------------------------------

## 4. Ubah Profil Sendiri

Digunakan pada fitur edit atau ubah foto profil pemilik portofolio.

``` tsx
import { PlusIcon } from "lucide-react"

import {
  Avatar,
  AvatarBadge,
  AvatarFallback,
  AvatarImage,
} from "@/components/ui/avatar"

export function AvatarBadgeIconExample() {
  return (
    <Avatar className="grayscale">
      <AvatarImage src="https://github.com/pranathip.png" alt="@pranathip" />
      <AvatarFallback>PP</AvatarFallback>
      <AvatarBadge>
        <PlusIcon />
      </AvatarBadge>
    </Avatar>
  )
}
```

------------------------------------------------------------------------

## 5. Riwayat Pengunjung Profil

Digunakan untuk menampilkan daftar/grup avatar pengunjung yang melihat
profil.

``` tsx
import {
  Avatar,
  AvatarFallback,
  AvatarGroup,
  AvatarGroupCount,
  AvatarImage,
} from "@/components/ui/avatar"

export function AvatarGroupCountExample() {
  return (
    <AvatarGroup className="grayscale">
      <Avatar>
        <AvatarImage src="https://github.com/shadcn.png" alt="@shadcn" />
        <AvatarFallback>CN</AvatarFallback>
      </Avatar>
      <Avatar>
        <AvatarImage src="https://github.com/maxleiter.png" alt="@maxleiter" />
        <AvatarFallback>LR</AvatarFallback>
      </Avatar>
      <Avatar>
        <AvatarImage
          src="https://github.com/evilrabbit.png"
          alt="@evilrabbit"
        />
        <AvatarFallback>ER</AvatarFallback>
      </Avatar>
      <AvatarGroupCount>+3</AvatarGroupCount>
    </AvatarGroup>
  )
}
```

------------------------------------------------------------------------

## 6. Link Sosial Media / Tautan Projek

Digunakan untuk link IG, TikTok, Telegram, dll. (tidak harus link
sosmed, sesuaikan ukuran dan kondisi projek).

``` tsx
import { ArrowUpRightIcon } from "lucide-react"

import { Button } from "@/components/ui/button"

export function ButtonSize() {
  return (
    <div className="flex flex-col items-start gap-8 sm:flex-row">
      <div className="flex items-start gap-2">
        <Button size="xs" variant="outline">
          Extra Small
        </Button>
        <Button size="icon-xs" aria-label="Submit" variant="outline">
          <ArrowUpRightIcon />
        </Button>
      </div>
      <div className="flex items-start gap-2">
        <Button size="sm" variant="outline">
          Small
        </Button>
        <Button size="icon-sm" aria-label="Submit" variant="outline">
          <ArrowUpRightIcon />
        </Button>
      </div>
      <div className="flex items-start gap-2">
        <Button variant="outline">Default</Button>
        <Button size="icon" aria-label="Submit" variant="outline">
          <ArrowUpRightIcon />
        </Button>
      </div>
      <div className="flex items-start gap-2">
        <Button variant="outline" size="lg">
          Large
        </Button>
        <Button size="icon-lg" aria-label="Submit" variant="outline">
          <ArrowUpRightIcon />
        </Button>
      </div>
    </div>
  )
}
```

------------------------------------------------------------------------

## 7. Pencarian di Portofolio (Opsional)

Digunakan untuk fitur pencarian konten/projek di dalam portofolio.

``` tsx
import { SearchIcon } from "lucide-react"

import { Button } from "@/components/ui/button"
import { ButtonGroup } from "@/components/ui/button-group"
import { Input } from "@/components/ui/input"

export function ButtonGroupInput() {
  return (
    <ButtonGroup>
      <Input placeholder="Search..." />
      <Button variant="outline" aria-label="Search">
        <SearchIcon />
      </Button>
    </ButtonGroup>
  )
}
```

------------------------------------------------------------------------

## 8. Kalender (Opsional)

Digunakan untuk tampilan jadwal atau pemilihan tanggal pemesanan jasa.

``` tsx
"use client"

import * as React from "react"

import { Calendar } from "@/components/ui/calendar"

export function CalendarDemo() {
  const [date, setDate] = React.useState<Date | undefined>(new Date())

  return (
    <Calendar
      mode="single"
      selected={date}
      onSelect={setDate}
      className="rounded-lg border"
      captionLayout="dropdown"
    />
  )
}
```

------------------------------------------------------------------------

## 9. Login Customer (Pemesanan Jasa)

Wajib ditampilkan ketika customer ingin memesan jasa.

``` tsx
import { Button } from "@/components/ui/button"
import {
  Card,
  CardAction,
  CardContent,
  CardDescription,
  CardFooter,
  CardHeader,
  CardTitle,
} from "@/components/ui/card"
import { Input } from "@/components/ui/input"
import { Label } from "@/components/ui/label"

export function CardDemo() {
  return (
    <Card className="w-full max-w-sm">
      <CardHeader>
        <CardTitle>Login to your account</CardTitle>
        <CardDescription>
          Enter your email below to login to your account
        </CardDescription>
        <CardAction>
          <Button variant="link">Sign Up</Button>
        </CardAction>
      </CardHeader>
      <CardContent>
        <form>
          <div className="flex flex-col gap-6">
            <div className="grid gap-2">
              <Label htmlFor="email">Email</Label>
              <Input
                id="email"
                type="email"
                placeholder="m@example.com"
                required
              />
            </div>
            <div className="grid gap-2">
              <div className="flex items-center">
                <Label htmlFor="password">Password</Label>
                <a
                  href="#"
                  className="ml-auto inline-block text-sm underline-offset-4 hover:underline"
                >
                  Forgot your password?
                </a>
              </div>
              <Input id="password" type="password" required />
            </div>
          </div>
        </form>
      </CardContent>
      <CardFooter className="flex-col gap-2">
        <Button type="submit" className="w-full">
          Login
        </Button>
        <Button variant="outline" className="w-full">
          Login with Google
        </Button>
      </CardFooter>
    </Card>
  )
}
```

------------------------------------------------------------------------

## 10. Kartu Prestasi atau Pengalaman

Digunakan untuk menampilkan daftar prestasi, acara, atau pengalaman
kerja.

``` tsx
import { Badge } from "@/components/ui/badge"
import { Button } from "@/components/ui/button"
import {
  Card,
  CardAction,
  CardDescription,
  CardFooter,
  CardHeader,
  CardTitle,
} from "@/components/ui/card"

export function CardImage() {
  return (
    <Card className="relative mx-auto w-full max-w-sm pt-0">
      <div className="absolute inset-0 z-30 aspect-video bg-black/35" />
      <img
        src="https://avatar.vercel.sh/shadcn1"
        alt="Event cover"
        className="relative z-20 aspect-video w-full object-cover brightness-60 grayscale dark:brightness-40"
      />
      <CardHeader>
        <CardAction>
          <Badge variant="secondary">Featured</Badge>
        </CardAction>
        <CardTitle>Design systems meetup</CardTitle>
        <CardDescription>
          A practical talk on component APIs, accessibility, and shipping
          faster.
        </CardDescription>
      </CardHeader>
      <CardFooter>
        <Button className="w-full">View Event</Button>
      </CardFooter>
    </Card>
  )
}
```

------------------------------------------------------------------------

## 11. Carousel Dokumentasi Prestasi (Opsional)

Digunakan untuk galeri foto dokumentasi dari prestasi atau pengalaman.

``` tsx
import * as React from "react"

import { Card, CardContent } from "@/components/ui/card"
import {
  Carousel,
  CarouselContent,
  CarouselItem,
  CarouselNext,
  CarouselPrevious,
} from "@/components/ui/carousel"

export function CarouselDemo() {
  return (
    <Carousel className="w-full max-w-[12rem] sm:max-w-xs">
      <CarouselContent>
        {Array.from({ length: 5 }).map((_, index) => (
          <CarouselItem key={index}>
            <div className="p-1">
              <Card>
                <CardContent className="flex aspect-square items-center justify-center p-6">
                  <span className="text-4xl font-semibold">{index + 1}</span>
                </CardContent>
              </Card>
            </div>
          </CarouselItem>
        ))}
      </CarouselContent>
      <CarouselPrevious />
      <CarouselNext />
    </Carousel>
  )
}
```

------------------------------------------------------------------------

## 12. Command Palette / Navigasi Cepat (Opsional)

Gunakan jika cocok untuk navigasi cepat di dalam portofolio.

``` tsx
import {
  Calculator,
  Calendar,
  CreditCard,
  Settings,
  Smile,
  User,
} from "lucide-react"

import {
  Command,
  CommandEmpty,
  CommandGroup,
  CommandInput,
  CommandItem,
  CommandList,
  CommandSeparator,
  CommandShortcut,
} from "@/components/ui/command"

export function CommandDemo() {
  return (
    <Command className="max-w-sm rounded-lg border">
      <CommandInput placeholder="Type a command or search..." />
      <CommandList>
        <CommandEmpty>No results found.</CommandEmpty>
        <CommandGroup heading="Suggestions">
          <CommandItem>
            <Calendar />
            <span>Calendar</span>
          </CommandItem>
          <CommandItem>
            <Smile />
            <span>Search Emoji</span>
          </CommandItem>
          <CommandItem disabled>
            <Calculator />
            <span>Calculator</span>
          </CommandItem>
        </CommandGroup>
        <CommandSeparator />
        <CommandGroup heading="Settings">
          <CommandItem>
            <User />
            <span>Profile</span>
            <CommandShortcut>⌘P</CommandShortcut>
          </CommandItem>
          <CommandItem>
            <CreditCard />
            <span>Billing</span>
            <CommandShortcut>⌘B</CommandShortcut>
          </CommandItem>
          <CommandItem>
            <Settings />
            <span>Settings</span>
            <CommandShortcut>⌘S</CommandShortcut>
          </CommandItem>
        </CommandGroup>
      </CommandList>
    </Command>
  )
}
```

------------------------------------------------------------------------

## 13. Context Menu / Klik Kanan (Opsional)

Gunakan jika berguna untuk interaksi klik kanan atau tekan lama pada
area tertentu di portofolio.

``` tsx
import {
  ContextMenu,
  ContextMenuCheckboxItem,
  ContextMenuContent,
  ContextMenuGroup,
  ContextMenuItem,
  ContextMenuLabel,
  ContextMenuRadioGroup,
  ContextMenuRadioItem,
  ContextMenuSeparator,
  ContextMenuShortcut,
  ContextMenuSub,
  ContextMenuSubContent,
  ContextMenuSubTrigger,
  ContextMenuTrigger,
} from "@/components/ui/context-menu"

export function ContextMenuDemo() {
  return (
    <ContextMenu>
      <ContextMenuTrigger className="flex aspect-video w-full max-w-xs items-center justify-center rounded-xl border border-dashed text-sm">
        <span className="hidden pointer-fine:inline-block">
          Right click here
        </span>
        <span className="hidden pointer-coarse:inline-block">
          Long press here
        </span>
      </ContextMenuTrigger>
      <ContextMenuContent className="w-48">
        <ContextMenuGroup>
          <ContextMenuItem>
            Back
            <ContextMenuShortcut>⌘[</ContextMenuShortcut>
          </ContextMenuItem>
          <ContextMenuItem disabled>
            Forward
            <ContextMenuShortcut>⌘]</ContextMenuShortcut>
          </ContextMenuItem>
          <ContextMenuItem>
            Reload
            <ContextMenuShortcut>⌘R</ContextMenuShortcut>
          </ContextMenuItem>
          <ContextMenuSub>
            <ContextMenuSubTrigger>More Tools</ContextMenuSubTrigger>
            <ContextMenuSubContent className="w-44">
              <ContextMenuGroup>
                <ContextMenuItem>Save Page...</ContextMenuItem>
                <ContextMenuItem>Create Shortcut...</ContextMenuItem>
                <ContextMenuItem>Name Window...</ContextMenuItem>
              </ContextMenuGroup>
              <ContextMenuSeparator />
              <ContextMenuGroup>
                <ContextMenuItem>Developer Tools</ContextMenuItem>
              </ContextMenuGroup>
              <ContextMenuSeparator />
              <ContextMenuGroup>
                <ContextMenuItem variant="destructive">Delete</ContextMenuItem>
              </ContextMenuGroup>
            </ContextMenuSubContent>
          </ContextMenuSub>
        </ContextMenuGroup>
        <ContextMenuSeparator />
        <ContextMenuGroup>
          <ContextMenuCheckboxItem checked>
            Show Bookmarks
          </ContextMenuCheckboxItem>
          <ContextMenuCheckboxItem>Show Full URLs</ContextMenuCheckboxItem>
        </ContextMenuGroup>
        <ContextMenuSeparator />
        <ContextMenuGroup>
          <ContextMenuRadioGroup value="pedro">
            <ContextMenuLabel>People</ContextMenuLabel>
            <ContextMenuRadioItem value="pedro">
              Pedro Duarte
            </ContextMenuRadioItem>
            <ContextMenuRadioItem value="colm">Colm Tuite</ContextMenuRadioItem>
          </ContextMenuRadioGroup>
        </ContextMenuGroup>
      </ContextMenuContent>
    </ContextMenu>
  )
}
```

------------------------------------------------------------------------

## 14. Pilihan Metode Pembayaran

Digunakan saat customer memilih metode pembayaran untuk pemesanan jasa.

``` tsx
"use client"

import * as React from "react"
import { Building2Icon, CreditCardIcon, WalletIcon } from "lucide-react"

import { Button } from "@/components/ui/button"
import {
  DropdownMenu,
  DropdownMenuContent,
  DropdownMenuGroup,
  DropdownMenuLabel,
  DropdownMenuRadioGroup,
  DropdownMenuRadioItem,
  DropdownMenuTrigger,
} from "@/components/ui/dropdown-menu"

export function DropdownMenuRadioIcons() {
  const [paymentMethod, setPaymentMethod] = React.useState("card")

  return (
    <DropdownMenu>
      <DropdownMenuTrigger render={<Button variant="outline">Payment Method</Button>} />
      <DropdownMenuContent className="min-w-56">
        <DropdownMenuGroup>
          <DropdownMenuLabel>Select Payment Method</DropdownMenuLabel>
          <DropdownMenuRadioGroup
            value={paymentMethod}
            onValueChange={setPaymentMethod}
          >
            <DropdownMenuRadioItem value="card">
              <CreditCardIcon />
              Credit Card
            </DropdownMenuRadioItem>
            <DropdownMenuRadioItem value="paypal">
              <WalletIcon />
              PayPal
            </DropdownMenuRadioItem>
            <DropdownMenuRadioItem value="bank">
              <Building2Icon />
              Bank Transfer
            </DropdownMenuRadioItem>
          </DropdownMenuRadioGroup>
        </DropdownMenuGroup>
      </DropdownMenuContent>
    </DropdownMenu>
  )
}
```

------------------------------------------------------------------------

## 15. Tampilan Status Offline Portofolio

Ditampilkan ketika pemilik portofolio sedang dalam keadaan offline dan
pengunjung ingin meninggalkan pesan.

``` tsx
import {
  Avatar,
  AvatarFallback,
  AvatarImage,
} from "@/components/ui/avatar"
import { Button } from "@/components/ui/button"
import {
  Empty,
  EmptyContent,
  EmptyDescription,
  EmptyHeader,
  EmptyMedia,
  EmptyTitle,
} from "@/components/ui/empty"

export function EmptyAvatar() {
  return (
    <Empty>
      <EmptyHeader>
        <EmptyMedia variant="default">
          <Avatar className="size-12">
            <AvatarImage
              src="https://github.com/shadcn.png"
              className="grayscale"
            />
            <AvatarFallback>LR</AvatarFallback>
          </Avatar>
        </EmptyMedia>
        <EmptyTitle>User Offline</EmptyTitle>
        <EmptyDescription>
          This user is currently offline. You can leave a message to notify them
          or try again later.
        </EmptyDescription>
      </EmptyHeader>
      <EmptyContent>
        <Button size="sm">Leave Message</Button>
      </EmptyContent>
    </Empty>
  )
}
```

------------------------------------------------------------------------

## 16. Halaman Tidak Ditemukan (404)

Ditampilkan ketika user mengetik alamat halaman yang salah.

``` tsx
import { SearchIcon } from "lucide-react"

import {
  Empty,
  EmptyContent,
  EmptyDescription,
  EmptyHeader,
  EmptyTitle,
} from "@/components/ui/empty"
import {
  InputGroup,
  InputGroupAddon,
  InputGroupInput,
} from "@/components/ui/input-group"
import { Kbd } from "@/components/ui/kbd"

export function EmptyInputGroup() {
  return (
    <Empty>
      <EmptyHeader>
        <EmptyTitle>404 - Not Found</EmptyTitle>
        <EmptyDescription>
          The page you&apos;re looking for doesn&apos;t exist. Try searching for
          what you need below.
        </EmptyDescription>
      </EmptyHeader>
      <EmptyContent>
        <InputGroup className="sm:w-3/4">
          <InputGroupInput placeholder="Try searching for pages..." />
          <InputGroupAddon>
            <SearchIcon />
          </InputGroupAddon>
          <InputGroupAddon align="inline-end">
            <Kbd>/</Kbd>
          </InputGroupAddon>
        </InputGroup>
        <EmptyDescription>
          Need help? <a href="#">Contact support</a>
        </EmptyDescription>
      </EmptyContent>
    </Empty>
  )
}
```

------------------------------------------------------------------------

## 17. Form Saran / Feedback dari User

Digunakan untuk menampung masukan atau saran dari pengunjung.

``` tsx
import {
  Field,
  FieldDescription,
  FieldGroup,
  FieldLabel,
  FieldSet,
} from "@/components/ui/field"
import { Textarea } from "@/components/ui/textarea"

export function FieldTextarea() {
  return (
    <FieldSet className="w-full max-w-xs">
      <FieldGroup>
        <Field>
          <FieldLabel htmlFor="feedback">Feedback</FieldLabel>
          <Textarea
            id="feedback"
            placeholder="Your feedback helps us improve..."
            rows={4}
          />
          <FieldDescription>
            Share your thoughts about our service.
          </FieldDescription>
        </Field>
      </FieldGroup>
    </FieldSet>
  )
}
```

------------------------------------------------------------------------

## 18. Hover Card Tech Stack (Bahasa Pemrograman / Framework)

Muncul ketika user mengarahkan kursor ke ikon/teks bahasa pemrograman,
framework, atau tools yang dikuasai.

``` tsx
import {
  Avatar,
  AvatarFallback,
  AvatarImage,
} from "@/components/ui/avatar"
import { Button } from "@/components/ui/button"
import {
  HoverCard,
  HoverCardContent,
  HoverCardTrigger,
} from "@/components/ui/hover-card"

export function HoverCardDemo() {
  return (
    <HoverCard>
      <HoverCardTrigger delay={10} closeDelay={100} render={<Button variant="link">Hover Here</Button>} />
      <HoverCardContent className="flex w-64 flex-col gap-0.5">
        <div className="font-semibold">@nextjs</div>
        <div>The React Framework – created and maintained by @vercel.</div>
        <div className="mt-1 text-xs text-muted-foreground">
          Joined December 2021
        </div>
      </HoverCardContent>
    </HoverCard>
  )
}
```

------------------------------------------------------------------------

## 19. Input Detail Pembayaran (Opsional)

Gunakan jika cocok untuk form detail pembayaran setelah customer memilih
metode payment.

``` tsx
import {
  CheckIcon,
  CreditCardIcon,
  InfoIcon,
  MailIcon,
  SearchIcon,
  StarIcon,
} from "lucide-react"

import {
  InputGroup,
  InputGroupAddon,
  InputGroupInput,
} from "@/components/ui/input-group"

export function InputGroupIcon() {
  return (
    <div className="grid w-full max-w-sm gap-6">
      <InputGroup>
        <InputGroupInput placeholder="Search..." />
        <InputGroupAddon>
          <SearchIcon />
        </InputGroupAddon>
      </InputGroup>
      <InputGroup>
        <InputGroupInput type="email" placeholder="Enter your email" />
        <InputGroupAddon>
          <MailIcon />
        </InputGroupAddon>
      </InputGroup>
      <InputGroup>
        <InputGroupInput placeholder="Card number" />
        <InputGroupAddon>
          <CreditCardIcon />
        </InputGroupAddon>
        <InputGroupAddon align="inline-end">
          <CheckIcon />
        </InputGroupAddon>
      </InputGroup>
      <InputGroup>
        <InputGroupInput placeholder="Card number" />
        <InputGroupAddon align="inline-end">
          <StarIcon />
          <InfoIcon />
        </InputGroupAddon>
      </InputGroup>
    </div>
  )
}
```

------------------------------------------------------------------------

## 20. Pengelompokan Tipe Projek (UMKM, Portofolio, dll)

Digunakan untuk menampilkan kategori atau jenis projek menggunakan
avatar. Contohnya UMKM, website portofolio, sistem informasi, dan
aplikasi.

``` tsx
import * as React from "react"
import { PlusIcon } from "lucide-react"

import {
  Avatar,
  AvatarFallback,
  AvatarImage,
} from "@/components/ui/avatar"

const projectTypes = [
  {
    name: "UMKM",
    image: "/images/projects/umkm.png",
    fallback: "UM",
  },
  {
    name: "Portofolio",
    image: "/images/projects/portfolio.png",
    fallback: "PF",
  },
  {
    name: "Sistem Informasi",
    image: "/images/projects/information-system.png",
    fallback: "SI",
  },
]

export function ProjectTypeGroup() {
  return (
    <div className="flex flex-wrap items-center gap-3">
      {projectTypes.map((project) => (
        <div key={project.name} className="flex items-center gap-2">
          <Avatar className="grayscale">
            <AvatarImage src={project.image} alt={project.name} />
            <AvatarFallback>{project.fallback}</AvatarFallback>
          </Avatar>
          <span className="text-sm">{project.name}</span>
        </div>
      ))}
      <Avatar className="grayscale">
        <AvatarFallback>
          <PlusIcon />
        </AvatarFallback>
      </Avatar>
    </div>
  )
}
```

Catatan: - Ganti lokasi gambar pada properti `image` sesuai aset projek
yang tersedia. - Daftar kategori dapat ditambah atau dikurangi sesuai
jenis projek yang benar-benar dimiliki. - `grayscale` dipakai agar
tampilan avatar tetap konsisten dengan gaya visual monokrom.


    ---

    ## 21. Tema Gelap dan Tema Terang

    Portofolio wajib menyediakan **tema terang (light mode)** dan **tema gelap (dark mode)**. Pengunjung dapat mengganti tema sesuai kenyamanan masing-masing.

    ### Aturan tampilan tema

    - Tema terang menggunakan latar terang dan teks gelap.
    - Tema gelap menggunakan latar gelap dan teks terang.
    - Gunakan sistem warna bawaan Shadcn UI melalui CSS variables dan semantic tokens seperti `background`, `foreground`, `card`, `border`, dan `muted`.
    - Jangan menambahkan warna kustom baru. Pertahankan tampilan monokrom hitam-putih dan komponen bawaan Shadcn UI.
    - Seluruh halaman dan komponen harus mengikuti tema aktif, termasuk navbar, card, input, dialog, dropdown, menu, dan footer.
    - Perubahan tema tidak boleh mengubah susunan layout atau isi konten.

    ### Tombol pengubah tema

    Gunakan **satu tombol saja** untuk berpindah antara tema terang dan gelap. Jangan membuat dua tombol terpisah untuk masing-masing tema.

    Perilaku tombol:
    - Saat tema terang aktif, tombol menampilkan ikon `Moon` untuk berpindah ke tema gelap.
    - Saat tema gelap aktif, tombol menampilkan ikon `Sun` untuk berpindah ke tema terang.
    - Ikon dan tema harus berubah bersamaan setelah tombol ditekan.
    - Gunakan komponen `Button` dari Shadcn UI dengan varian `outline` dan ukuran ikon.
    - Simpan pilihan tema menggunakan `next-themes`, sehingga preferensi tema dapat dipertahankan saat halaman dimuat ulang.

    ### Theme Provider

    Pasang provider satu kali pada root aplikasi, misalnya di `app/layout.tsx` pada Next.js.

    ```tsx
    "use client"

    import * as React from "react"
    import { ThemeProvider as NextThemesProvider } from "next-themes"

    export function ThemeProvider({
      children,
    }: React.PropsWithChildren) {
      return (
        <NextThemesProvider
          attribute="class"
          defaultTheme="light"
          enableSystem={false}
          disableTransitionOnChange
        >
          {children}
        </NextThemesProvider>
      )
    }

Contoh pemasangan pada root layout:

``` tsx
import { ThemeProvider } from "@/components/theme-provider"

export default function RootLayout({
  children,
}: Readonly<{
  children: React.ReactNode
}>) {
  return (
    <html lang="id" suppressHydrationWarning>
      <body>
        <ThemeProvider>{children}</ThemeProvider>
      </body>
    </html>
  )
}
```

### Satu tombol toggle tema

Buat komponen tombol terpisah agar dapat dipakai di navbar atau bagian
header.

``` tsx
"use client"

import { Moon, Sun } from "lucide-react"
import { useTheme } from "next-themes"

import { Button } from "@/components/ui/button"

export function ThemeToggle() {
  const { theme, setTheme } = useTheme()

  const isDark = theme === "dark"

  return (
    <Button
      variant="outline"
      size="icon"
      aria-label={isDark ? "Aktifkan tema terang" : "Aktifkan tema gelap"}
      onClick={() => setTheme(isDark ? "light" : "dark")}
    >
      {isDark ? <Sun /> : <Moon />}
    </Button>
  )
}
```

Catatan implementasi: - Pastikan dependency `next-themes` sudah
terpasang. - Pastikan konfigurasi tema Shadcn UI menggunakan class
`dark` pada elemen root, sesuai konfigurasi proyek. - Jangan menambahkan
tombol tema kedua di halaman lain. Jika dibutuhkan di beberapa tempat,
gunakan komponen `ThemeToggle` yang sama. - `defaultTheme="light"`
berarti tema awal adalah terang. Pengaturan ini boleh diubah jika ada
keputusan desain lain, tetapi mekanisme tetap satu tombol.

------------------------------------------------------------------------

## 22. Ketentuan Desain dan Implementasi Portofolio

Ketentuan ini menjadi pedoman untuk menyusun seluruh komponen menjadi
satu halaman portofolio yang utuh.

1.  **Gaya visual:** gunakan pendekatan minimalis dan monokrom.
    Prioritaskan hitam, putih, serta warna netral bawaan Shadcn UI.
    Jangan menambahkan palet warna kustom.
2.  **Tema:** sediakan light mode dan dark mode sesuai Bagian 21.
    Penggantian tema dilakukan melalui satu tombol toggle.
3.  **Konsistensi:** seluruh komponen harus mengikuti tema aktif dan
    memakai gaya bawaan Shadcn UI. Hindari styling yang membuat satu
    komponen terlihat berasal dari desain berbeda.
4.  **Responsif:** halaman harus nyaman digunakan pada ponsel, tablet,
    dan desktop. Susunan elemen boleh menyesuaikan ukuran layar tanpa
    menghilangkan fungsi.
5.  **Navigasi:** sediakan navigasi yang jelas ke bagian utama
    portofolio. Jika aplikasi memiliki navigasi halaman atau tampilan
    detail, sediakan cara kembali yang terlihat dan berfungsi.
6.  **Konten:** gunakan data portofolio yang benar-benar tersedia.
    Jangan mengarang pengalaman kerja, sertifikat, prestasi, jumlah
    pengunjung, atau testimoni.
7.  **Komponen:** gunakan komponen pada daftar Bagian 1--20 sesuai
    fungsi dan konteksnya. Komponen opsional hanya dipakai jika memang
    dibutuhkan.
8.  **Interaksi:** tombol, tautan, pencarian, form, carousel, menu, dan
    kontrol lainnya harus memiliki fungsi yang sesuai. Jangan
    menampilkan kontrol yang hanya terlihat aktif tetapi tidak melakukan
    apa pun.
9.  **Kualitas tampilan:** contoh preview atau mockup hanya berfungsi
    sebagai gambaran awal. Layout final tidak harus meniru preview
    secara persis. Utamakan hierarki informasi, jarak antarbagian,
    keterbacaan, dan keseimbangan visual.
10. **Batasan warna:** jangan mengubah skema warna referensi komponen
    atau menambahkan warna dekoratif baru. Status online yang pada
    snippet awal memakai warna hijau merupakan indikator status khusus,
    bukan alasan untuk menambah palet warna lain.
