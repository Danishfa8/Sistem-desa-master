@extends('layouts.appweb2')

@section('content')
<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Data Desa CANTIK</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: '#5D5CDE',
                        'primary-dark': '#4A4BC9',
                        'primary-light': '#8B8AEF'
                    },
                    fontFamily: {
                        'sans': ['Inter', 'system-ui', 'sans-serif']
                    },
                    backgroundImage: {
                        'gradient-radial': 'radial-gradient(var(--tw-gradient-stops))',
                        'gradient-conic': 'conic-gradient(from 180deg at 50% 50%, var(--tw-gradient-stops))',
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        [x-cloak] { display: none !important; }

        .glass-effect {
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
        }

        .card-hover {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .card-hover:hover {
            transform: translateY(-2px);
        }

        .gradient-text {
            background: linear-gradient(135deg, #5D5CDE 0%, #8B8AEF 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.6s ease-out forwards;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .stagger-1 { animation-delay: 0.1s; }
        .stagger-2 { animation-delay: 0.2s; }
        .stagger-3 { animation-delay: 0.3s; }
    </style>
</head>
<body class="bg-gradient-to-br from-gray-50 via-white to-blue-50 dark:from-gray-900 dark:via-gray-900 dark:to-purple-900 text-gray-900 dark:text-gray-100 min-h-full transition-all duration-500 font-sans">
    <div class="container mx-auto px-4 py-16">
        <!-- Header Section -->
        <div class="text-center mb-16">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-br from-primary to-primary-light rounded-2xl mb-6 shadow-lg animate-fade-in-up">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
            <h1 class="text-5xl md:text-6xl font-bold gradient-text mb-6 animate-fade-in-up stagger-1">
                Informasi Data
            </h1>
            <p class="text-lg text-gray-600 dark:text-gray-300 max-w-3xl mx-auto leading-relaxed animate-fade-in-up stagger-2">
                Informasi Data membantu Anda memahami detail penting dari data desa secara jelas dan sistematis dengan teknologi modern dan antarmuka yang intuitif.
            </p>
        </div>

        <div x-data="accordionApp()" x-cloak class="max-w-5xl mx-auto space-y-6 animate-fade-in-up stagger-3" role="region" aria-label="Informasi Data Accordion">
            <!-- Accordion -->
            <template x-for="(item, index) in items" :key="index">
                <div class="group card-hover" :aria-expanded="open === index">
                    <div class="relative overflow-hidden rounded-2xl bg-white/70 dark:bg-gray-800/70 glass-effect border border-white/20 dark:border-gray-700/50 shadow-xl shadow-gray-100/50 dark:shadow-purple-900/20">
                        <!-- Gradient overlay -->
                        <div class="absolute inset-0 bg-gradient-to-r from-primary/5 to-primary-light/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

                        <button
                            :id="'accordion-header-' + index"
                            @click="toggle(index)"
                            @keydown.enter.prevent="toggle(index)"
                            @keydown.space.prevent="toggle(index)"
                            :aria-controls="'accordion-panel-' + index"
                            :aria-expanded="open === index"
                            class="relative w-full flex justify-between items-center px-8 py-6 text-left font-semibold focus:outline-none focus:ring-2 focus:ring-primary/50 focus:ring-offset-2 focus:ring-offset-transparent transition-all duration-300"
                        >
                            <div class="flex items-center space-x-4">
                                <!-- Icon -->
                                <div class="flex-shrink-0 w-10 h-10 bg-gradient-to-br from-primary to-primary-light rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                                    <span x-text="String(index + 1).padStart(2, '0')" class="text-white font-bold text-sm"></span>
                                </div>
                                <!-- Title -->
                                <span x-text="item.title" class="text-lg text-gray-800 dark:text-gray-200 group-hover:text-primary dark:group-hover:text-primary-light transition-colors duration-300"></span>
                            </div>

                            <!-- Chevron with enhanced animation -->
                            <div class="flex-shrink-0 ml-4">
                                <div :class="open === index ? 'rotate-180 bg-primary/10' : 'bg-gray-100 dark:bg-gray-700'" class="w-10 h-10 rounded-xl flex items-center justify-center transition-all duration-300 group-hover:bg-primary/10">
                                    <svg class="w-5 h-5 text-gray-600 dark:text-gray-400 group-hover:text-primary" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                                    </svg>
                                </div>
                            </div>
                        </button>

                        <!-- Content Panel -->
                        <div
                            x-show="open === index"
                            x-collapse
                            :id="'accordion-panel-' + index"
                            :aria-labelledby="'accordion-header-' + index"
                            class="relative"
                            style="display: none;"
                        >
                            <div class="px-8 pb-8">
                                <!-- Separator line -->
                                <div class="h-px bg-gradient-to-r from-transparent via-gray-200 dark:via-gray-700 to-transparent mb-6"></div>

                                <!-- Content -->
                                <div class="bg-gray-50/50 dark:bg-gray-700/30 rounded-xl p-6 border border-gray-100 dark:border-gray-600/50">
                                    <p x-text="item.desc" class="text-base leading-relaxed text-gray-700 dark:text-gray-300"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </div>

    <script>
        // Dark mode detection
        if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
            document.documentElement.classList.add('dark');
        }
        window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', event => {
            if (event.matches) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        });

        function accordionApp() {
            return {
                open: null,
                items: [
                    { title: 'Abstraksi', desc: 'Sistem Informasi Desa CANTIK menyediakan data yang terintegrasi, akurat, dan mudah diakses untuk mendukung perencanaan, pengambilan keputusan, dan pelayanan publik di tingkat desa.' },
                    { title: 'Tujuan dan Manfaat', desc: 'Mengoptimalkan pengelolaan data desa agar lebih sistematis, meningkatkan kualitas pelayanan, mendukung pembangunan desa yang berbasis data, serta memberikan kemudahan akses informasi bagi masyarakat dan pemangku kepentingan.' },
                    { title: 'Penanggungjawab Kegiatan', desc: 'Dinas Komunikasi dan Informatika Kabupaten bersama Pemerintah Desa dan Tim Pengelola Data Desa CANTIK bertanggung jawab dalam pengelolaan dan pemutakhiran data.' },
                    { title: 'Informasi Pengumpulan Data', desc: 'Data dikumpulkan secara berkala melalui survei desa, laporan administrasi, dan pemutakhiran data lapangan oleh petugas yang telah dilatih, dengan tetap menjaga validitas dan akurasi.' },
                    { title: 'Metodologi', desc: 'Pengumpulan data dilakukan dengan metode survei langsung, wawancara, dan pencatatan administrasi desa, serta verifikasi silang antar sumber untuk memastikan keakuratan data.' },
                    { title: 'Rancangan Sampel Probabilitas', desc: 'Pengambilan sampel dilakukan secara acak berdasarkan wilayah dusun atau RT/RW untuk memastikan representasi seluruh penduduk dan kondisi desa.' },
                    { title: 'Pengumpulan Data', desc: 'Data dikumpulkan menggunakan kuesioner elektronik dan manual, serta melalui aplikasi mobile yang telah terintegrasi dengan sistem pusat untuk efisiensi waktu dan peningkatan akurasi.' },
                    { title: 'Pengolahan Data', desc: 'Data yang terkumpul akan dibersihkan dari duplikasi, diklasifikasikan, dan dianalisis menggunakan perangkat lunak statistik untuk menghasilkan informasi yang dapat diandalkan.' },
                    { title: 'Analisis Data', desc: 'Data dianalisis secara deskriptif dan komparatif untuk mendapatkan gambaran kondisi desa yang faktual dan menjadi dasar dalam penyusunan kebijakan desa.' },
                    { title: 'Kualitas dan Interpretasi Data', desc: 'Data dievaluasi dari segi kelengkapan, konsistensi, dan akurasi. Interpretasi dilakukan dengan mempertimbangkan konteks sosial dan ekonomi desa untuk mendapatkan pemahaman yang komprehensif.' },
                    { title: 'Evaluasi', desc: 'Proses evaluasi melibatkan verifikasi lapangan dan tinjauan berkala terhadap kualitas data yang digunakan dalam perencanaan dan pelaksanaan program desa.' },
                    { title: 'Diseminasi', desc: 'Informasi yang telah terverifikasi akan dipublikasikan melalui website, laporan tahunan desa, dan media sosial resmi agar dapat diakses oleh masyarakat secara transparan.' }
                ],
                toggle(index) {
                    this.open = this.open === index ? null : index;
                }
            }
        }
    </script>
</body>
</html>
@endsection
