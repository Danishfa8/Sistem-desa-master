// Final versi app.js dengan urutan: Kategori → Kecamatan → Desa

import "./bootstrap";
import L from "leaflet";
import "leaflet/dist/leaflet.css";
import { parseKategoriResponse } from "./parseKategori.js";

let kecamatanData = [];
let desaData = [];
let kategoriData = [];

const map = L.map("map").setView([-6.9591793, 108.902683], 12);
L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
    attribution: "© OpenStreetMap contributors",
}).addTo(map);

const desaMarkers = L.layerGroup().addTo(map);
const kategoriMarkers = L.layerGroup().addTo(map);
const boundaryLayers = L.layerGroup().addTo(map);

const kecamatanSelect = document.getElementById("kecamatan");
const desaSelect = document.getElementById("desa");
const kategoriSelect = document.getElementById("kategori");
const infoPanel = document.getElementById("infoPanel");
const infoContent = document.getElementById("infoContent");

// Inisialisasi select
kecamatanSelect.disabled = true;
desaSelect.disabled = true;
kategoriSelect.disabled = true;

// Fungsi menampilkan loading
function showLoading(element, text = "Loading...") {
    element.innerHTML = `<option value="">${text}</option>`;
    element.disabled = true;
}

function showError(message) {
    console.error(message);
}

// Fungsi load kategori awal saat halaman dimuat
async function loadKategoriList() {
    try {
        showLoading(kategoriSelect, "Memuat kategori...");
        const res = await fetch("map/kategori-list");
        if (!res.ok) throw new Error(`HTTP error! status: ${res.status}`);

        const data = await res.json();
        kategoriSelect.innerHTML = '<option value="">-- Pilih Kategori --</option>';
        data.forEach((kat) => {
            const option = document.createElement("option");
            option.value = kat.id;
            option.textContent = kat.nama;
            kategoriSelect.appendChild(option);
        });
        kategoriSelect.disabled = false;
    } catch (err) {
        showError("Gagal memuat data kategori: " + err.message);
        kategoriSelect.innerHTML = '<option value="">Gagal memuat</option>';
        kategoriSelect.disabled = true;
    }
}

// Ubah loadKecamatan agar hanya bisa dipanggil jika kategori dipilih
async function loadKecamatan() {
    if (!kategoriSelect.value) return;
    try {
        showLoading(kecamatanSelect, "Memuat kecamatan...");
        const res = await fetch("map/kecamatan");
        if (!res.ok) throw new Error(`HTTP error! status: ${res.status}`);

        kecamatanData = await res.json();
        kecamatanSelect.innerHTML = '<option value="">-- Pilih Kecamatan --</option>';
        kecamatanData.forEach((kec) => {
            const option = document.createElement("option");
            option.value = kec.id;
            option.textContent = kec.nama_kecamatan;
            kecamatanSelect.appendChild(option);
        });
        kecamatanSelect.disabled = false;
        desaSelect.innerHTML = '<option value="">-- Pilih Desa --</option>';
        desaSelect.disabled = true;
    } catch (err) {
        showError("Gagal memuat data kecamatan: " + err.message);
    }
}

// kategoriSelect berubah menjadi trigger pertama
kategoriSelect.addEventListener("change", () => {
    const kategoriId = kategoriSelect.value;
    infoPanel.classList.add("hidden");

    // Reset semua
    kecamatanSelect.innerHTML = '<option value="">-- Pilih Kecamatan --</option>';
    desaSelect.innerHTML = '<option value="">-- Pilih Desa --</option>';
    kecamatanSelect.disabled = true;
    desaSelect.disabled = true;
    boundaryLayers.clearLayers();
    desaMarkers.clearLayers();
    kategoriMarkers.clearLayers();

    if (!kategoriId) return;
    loadKecamatan();
});

kecamatanSelect.addEventListener("change", () => {
    const kecId = kecamatanSelect.value;
    loadDesa(kecId);
    infoPanel.classList.add("hidden");
    desaSelect.value = "";
});

desaSelect.addEventListener("change", () => {
    const desaId = desaSelect.value;

    if (!desaId) {
        loadKategori(null);
        infoPanel.classList.add("hidden");
        kategoriSelect.value = "";

        const currentKecId = kecamatanSelect.value;
        if (currentKecId) {
            showBoundary(currentKecId);
        }
        return;
    }

    highlightSelectedDesaBoundary(desaId);
    loadKategori(desaId);
    infoPanel.classList.add("hidden");
    kategoriSelect.value = kategoriSelect.value; // tetap aktif
});

// Panggil loadKategoriList saat halaman dimuat
loadKategoriList();
