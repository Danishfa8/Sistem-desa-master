<script>
    document.addEventListener('DOMContentLoaded', function() {
        const kecamatanSelect = document.getElementById('kecamatan');
        const desaSelect = document.getElementById('desa');
        const loadingDiv = document.getElementById('loading');
        const tampilkanBtn = document.getElementById('tampilkan-data');
        const resultDiv = document.getElementById('result');
        const selectedDataDiv = document.getElementById('selected-data');
        const visionMissionSection = document.getElementById('vision-mission-section');
        const regionalInfoSection = document.getElementById('regional-info-section');
        const desaContent = document.getElementById('desa-content');
        const contentContainer = document.getElementById('content-container');
        const navButtons = document.querySelectorAll('.nav-button');

        kecamatanSelect.addEventListener('change', function() {
            const kecamatanId = this.value;

            desaSelect.innerHTML = '<option value="">Pilih Desa</option>';
            desaSelect.disabled = true;
            resultDiv.classList.add('hidden');
            desaContent.classList.add('hidden');

            if (!kecamatanId) {
                visionMissionSection.classList.remove('hidden');
                regionalInfoSection.classList.remove('hidden');
                return;
            }

            loadingDiv.classList.remove('hidden');

            fetch(`/profile-desa/show-desa/${kecamatanId}`)
                .then(response => {
                    if (!response.ok) throw new Error('Network response was not ok');
                    return response.json();
                })
                .then(data => {
                    loadingDiv.classList.add('hidden');
                    if (data.length > 0) {
                        data.forEach(desa => {
                            const option = document.createElement('option');
                            option.value = desa.id;
                            option.textContent = desa.nama_desa;
                            desaSelect.appendChild(option);
                        });
                        desaSelect.disabled = false;
                    } else {
                        const noDataOption = document.createElement('option');
                        noDataOption.textContent = 'Tidak ada desa tersedia';
                        desaSelect.appendChild(noDataOption);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    loadingDiv.classList.add('hidden');
                    const errorOption = document.createElement('option');
                    errorOption.textContent = 'Error memuat data desa';
                    desaSelect.appendChild(errorOption);
                });
        });

        tampilkanBtn.addEventListener('click', function() {
            const kecamatanId = kecamatanSelect.value;
            const desaId = desaSelect.value;
            const kecamatanText = kecamatanSelect.options[kecamatanSelect.selectedIndex].text;
            const desaText = desaSelect.options[desaSelect.selectedIndex].text;

            if (kecamatanId && desaId) {
                selectedDataDiv.innerHTML = `
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-building text-green-500"></i>
                            <div>
                                <span class="font-medium text-gray-700">Kecamatan:</span>
                                <span class="text-gray-900">${kecamatanText}</span>
                            </div>
                        </div>
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-home text-green-500"></i>
                            <div>
                                <span class="font-medium text-gray-700">Desa:</span>
                                <span class="text-gray-900">${desaText}</span>
                            </div>
                        </div>
                    </div>
                `;
                resultDiv.classList.remove('hidden');
                visionMissionSection.classList.add('hidden');
                regionalInfoSection.classList.add('hidden');
                desaContent.classList.remove('hidden');

                // Reset dan aktifkan tab pertama (profil-desa)
                navButtons.forEach(btn => btn.classList.remove('active'));
                const defaultTab = navButtons[0];
                defaultTab.classList.add('active');
                const defaultTarget = defaultTab.getAttribute('data-target');

                loadSection(desaId, defaultTarget);

                resultDiv.scrollIntoView({
                    behavior: 'smooth',
                    block: 'nearest'
                });
            } else {
                showNotification('Silakan pilih kecamatan dan desa terlebih dahulu!', 'warning');
            }
        });

        navButtons.forEach(button => {
            button.addEventListener('click', function() {
                const target = this.getAttribute('data-target');
                const desaId = desaSelect.value;

                if (!desaId) {
                    showNotification('Silakan pilih desa terlebih dahulu!', 'warning');
                    return;
                }

                navButtons.forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');

                loadSection(desaId, target);
            });
        });

        function loadSection(desaId, section) {
            contentContainer.innerHTML = `
                <div class="flex justify-center items-center h-32">
                    <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-500"></div>
                    <span class="ml-2 text-gray-600">Memuat data...</span>
                </div>
            `;

            fetch(`/desa-section/${desaId}/${section}`)
                .then(response => {
                    if (!response.ok) throw new Error('Gagal memuat data');
                    return response.text();
                })
                .then(html => {
                    contentContainer.innerHTML = html;
                    console.log('Memuat section:', section, 'untuk desaId:', desaId);
                })
                .catch(error => {
                    console.error('Error:', error);
                    contentContainer.innerHTML = `
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
                            <strong>Error!</strong> Gagal memuat data. Silakan coba lagi.
                        </div>
                    `;
                });
        }

        function showNotification(message, type = 'info') {
            const notification = document.createElement('div');
            notification.className =
                `fixed top-4 right-4 z-50 p-4 rounded-lg shadow-lg max-w-sm transform transition-transform duration-300 translate-x-full`;

            const bgColor = type === 'warning' ? 'bg-yellow-500' : type === 'error' ? 'bg-red-500' :
                'bg-blue-500';
            notification.className += ` ${bgColor} text-white`;

            notification.innerHTML = `
                <div class="flex items-center space-x-2">
                    <i class="fas fa-${type === 'warning' ? 'exclamation-triangle' : type === 'error' ? 'times-circle' : 'info-circle'}"></i>
                    <span>${message}</span>
                    <button onclick="this.parentElement.parentElement.remove();" class="ml-2 text-white hover:text-gray-200">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            `;

            document.body.appendChild(notification);

            setTimeout(() => {
                notification.classList.remove('translate-x-full');
            }, 100);

            setTimeout(() => {
                notification.classList.add('translate-x-full');
                setTimeout(() => {
                    notification.remove();
                }, 300);
            }, 5000);
        }
    });
</script>
