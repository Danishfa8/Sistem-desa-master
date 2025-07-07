<footer class="w-full bg-blue-900 text-white py-6 border-t border-blue-800 mt-auto">
   <div class="container mx-auto px-4">
      <div class="flex flex-col md:flex-row md:justify-between md:items-start gap-6">
         <!-- Tentang Kami + Logo -->
         <div class="md:w-1/3">
            <div class="flex items-start space-x-3 mb-3">
               <img src="{{ asset('assets/images/Logo-brebes.png') }}" alt="Logo Kabupaten Brebes" class="w-12 h-12 object-contain" width="48" height="48" />
               <span class="text-gray-300 h-8 border-r border-gray-300 mx-1"></span>
               <div class="flex flex-col overflow-hidden">
                  <span class="text-xl font-bold text-white tracking-tight leading-tight slide-in-left">
                     Desa Cantik
                  </span>
                  <span class="text-xs text-gray-300 mt-0.5 slide-in-left delay-200">
                     Pemerintah Kabupaten Brebes
                  </span>
               </div>
            </div>
            <p class="leading-relaxed text-xs md:text-sm text-gray-200">
               Aplikasi Desa Cantik - Monografi Desa Brebes. Menyajikan data lengkap dan terpercaya untuk kemajuan desa.
            </p>
         </div>

         <!-- Kontak -->
         <div class="md:w-1/3">
            <h3 class="text-base font-semibold mb-2">Kontak</h3>
            <ul class="space-y-1 text-xs md:text-sm text-gray-200">
               <li>Email: <a href="mailto:info@desacantik.brebes.id" class="underline hover:text-white">info@desacantik.brebes.id</a></li>
               <li>Telepon: <a href="tel:+622812345678" class="underline hover:text-white">+62 281 2345678</a></li>
               <li>Alamat: Jl. Raya Brebes No.123, Kabupaten Brebes</li>
            </ul>
         </div>

         <!-- Sosial Media -->
         <div class="md:w-1/3">
            <h3 class="text-base font-semibold mb-2">Ikuti Kami</h3>
            <div class="flex space-x-4">
               <!-- Facebook -->
               <a href="#" aria-label="Facebook">
                  <svg class="w-6 h-6 text-white hover:text-blue-400 transition" fill="currentColor" viewBox="0 0 24 24">
                     <path d="M22 12a10 10 0 10-11.5 9.95v-7.05h-2v-2.9h2v-2.2c0-2 1.2-3.1 3-3.1.9 0 1.8.15 1.8.15v2h-1c-1 0-1.3.63-1.3 1.27v1.88h2.3l-.37 2.9h-1.93v7.05A10 10 0 0022 12z" />
                  </svg>
               </a>
               <!-- Instagram -->
               <a href="#" aria-label="Instagram">
                  <svg class="w-6 h-6 text-white hover:text-pink-400 transition" fill="currentColor" viewBox="0 0 24 24">
                     <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                  </svg>
               </a>
            </div>
         </div>
      </div>

      <hr class="my-6 border-blue-800" />

      <div class="text-center text-xs text-gray-300">
         <p>&copy; {{ date('Y') }} Desa Cantik Brebes. All rights reserved.</p>
         <p class="mt-1">Disclaimer: Data yang disajikan adalah untuk keperluan informasi dan dokumentasi.</p>
      </div>
   </div>
</footer>
