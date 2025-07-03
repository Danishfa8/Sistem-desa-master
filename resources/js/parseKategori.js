// parseKategori.js - Module untuk parsing data kategori dari API response

/**
 * Parse raw kategori response dari API menjadi format yang dapat digunakan frontend
 * @param {Object} rawResponse - Response dari API
 * @returns {Array} Array of kategori objects
 */
export function parseKategoriResponse(rawResponse) {
    console.log("Raw kategori response:", rawResponse);

    // Handle different response formats
    let kategoriData = [];

    // Check if response has 'data' property (new format)
    if (rawResponse && rawResponse.data) {
        kategoriData = rawResponse.data;
    }
    // Check if response is raw data (old format)
    else if (rawResponse && typeof rawResponse === "object") {
        kategoriData = parseRawKategoriData(rawResponse);
    }

    console.log("Parsed kategori data:", kategoriData);
    return kategoriData;
}

/**
 * Parse raw kategori data (old format) ke format baru
 * @param {Object} rawData - Raw data dari controller lama
 * @returns {Array} Array of parsed kategori objects
 */
function parseRawKategoriData(rawData) {
    const parsed = [];
    const iconMap = getKategoriIconMap();
    let globalId = 1;

    // Iterate through each kategori type
    for (const [kategoriName, items] of Object.entries(rawData)) {
        if (!Array.isArray(items)) continue;

        items.forEach((item) => {
            const parsedItem = {
                id: globalId++,
                nama: determineItemName(item, kategoriName),
                tipe: kategoriName,
                alamat: determineItemAddress(item, kategoriName),
                latitude: parseFloat(item.latitude),
                longitude: parseFloat(item.longitude),
                desa_id: item.desa_id,
                original_id: item.id,
                icon: iconMap[kategoriName] || "📍",
                raw_data: item,
            };

            // Validate coordinates
            if (!isNaN(parsedItem.latitude) && !isNaN(parsedItem.longitude)) {
                parsed.push(parsedItem);
            }
        });
    }

    return parsed;
}

/**
 * Determine item name based on category type and available fields
 * @param {Object} item - Item data
 * @param {string} kategoriName - Category name
 * @returns {string} Item name
 */
function determineItemName(item, kategoriName) {
    const nameFieldMap = {
        "Jalan Desa": ["nama_jalan", "nama"],
        "Jalan Kabupaten": ["nama_jalan", "nama"],
        Jembatan: ["nama_jembatan", "nama"],
        Pendidikan: ["jenis_pendidikan", "nama_sekolah", "nama"],
        "Sarana Ibadah": ["jenis_sarana_ibadah", "nama_sarana", "nama"],
        Irigasi: ["nama_irigasi", "nama"],
        Pasar: ["nama_pasar", "nama"],
        "Pembuangan Sampah": ["nama_tps", "nama"],
        "Pusat Perdagangan": ["nama_pusat", "nama"],
        "Rumah Potong Hewan": ["nama_rph", "nama"],
    };

    const possibleFields = nameFieldMap[kategoriName] || ["nama"];

    for (const field of possibleFields) {
        if (item[field] && item[field].trim() !== "") {
            return item[field];
        }
    }

    return `${kategoriName} #${item.id || "Unknown"}`;
}

/**
 * Determine item address based on category type and available fields
 * @param {Object} item - Item data
 * @param {string} kategoriName - Category name
 * @returns {string} Item address
 */
function determineItemAddress(item, kategoriName) {
    const addressFieldMap = {
        "Jalan Desa": ["lokasi", "alamat", "keterangan"],
        "Jalan Kabupaten": ["lokasi", "alamat", "keterangan"],
        Jembatan: ["lokasi", "alamat", "keterangan"],
        Pendidikan: ["alamat", "lokasi", "keterangan"],
        "Sarana Ibadah": ["alamat", "lokasi", "keterangan"],
        Irigasi: ["lokasi", "alamat", "keterangan"],
        Pasar: ["alamat", "lokasi", "keterangan"],
        "Pembuangan Sampah": ["lokasi", "alamat", "keterangan"],
        "Pusat Perdagangan": ["alamat", "lokasi", "keterangan"],
        "Rumah Potong Hewan": ["alamat", "lokasi", "keterangan"],
    };

    const possibleFields = addressFieldMap[kategoriName] || [
        "alamat",
        "lokasi",
    ];

    for (const field of possibleFields) {
        if (item[field] && item[field].trim() !== "") {
            return item[field];
        }
    }

    return "Alamat tidak tersedia";
}

/**
 * Get icon mapping for different kategori types
 * @returns {Object} Icon mapping object
 */
function getKategoriIconMap() {
    return {
        "Jalan Desa": "🛣️",
        "Jalan Kabupaten": "🛤️",
        Jembatan: "🌉",
        Pendidikan: "🏫",
        "Sarana Ibadah": "🕌",
        Irigasi: "💧",
        Pasar: "🏪",
        "Pembuangan Sampah": "🗑️",
        "Pusat Perdagangan": "🏢",
        "Rumah Potong Hewan": "🏭",
        Kesehatan: "🏥",
        Transportasi: "✈️",
        Pemerintahan: "🏛️",
        Perdagangan: "🏪",
        Wisata: "🏖️",
        Perkantoran: "🏢",
        Olahraga: "⚽",
    };
}

/**
 * Validate kategori item data
 * @param {Object} item - Item to validate
 * @returns {boolean} True if valid
 */
export function validateKategoriItem(item) {
    // Required fields
    const requiredFields = ["id", "nama", "tipe", "latitude", "longitude"];

    for (const field of requiredFields) {
        if (
            !item.hasOwnProperty(field) ||
            item[field] === null ||
            item[field] === undefined
        ) {
            console.warn(`Missing required field: ${field}`, item);
            return false;
        }
    }

    // Validate coordinates
    const lat = parseFloat(item.latitude);
    const lng = parseFloat(item.longitude);

    if (isNaN(lat) || isNaN(lng)) {
        console.warn("Invalid coordinates:", item);
        return false;
    }

    // Validate coordinate ranges (assuming Indonesia coordinates)
    if (lat < -11 || lat > 6 || lng < 95 || lng > 141) {
        console.warn("Coordinates out of Indonesia range:", item);
        return false;
    }

    return true;
}

/**
 * Group kategori items by type
 * @param {Array} items - Array of kategori items
 * @returns {Object} Grouped items by type
 */
export function groupKategoriByType(items) {
    const grouped = {};

    items.forEach((item) => {
        if (!grouped[item.tipe]) {
            grouped[item.tipe] = [];
        }
        grouped[item.tipe].push(item);
    });

    return grouped;
}

/**
 * Filter kategori items by search term
 * @param {Array} items - Array of kategori items
 * @param {string} searchTerm - Search term
 * @returns {Array} Filtered items
 */
export function filterKategoriItems(items, searchTerm) {
    if (!searchTerm || searchTerm.trim() === "") {
        return items;
    }

    const term = searchTerm.toLowerCase().trim();

    return items.filter((item) => {
        return (
            item.nama.toLowerCase().includes(term) ||
            item.tipe.toLowerCase().includes(term) ||
            item.alamat.toLowerCase().includes(term)
        );
    });
}

/**
 * Sort kategori items by specified field
 * @param {Array} items - Array of kategori items
 * @param {string} field - Field to sort by
 * @param {string} order - Sort order ('asc' or 'desc')
 * @returns {Array} Sorted items
 */
export function sortKategoriItems(items, field = "nama", order = "asc") {
    return items.sort((a, b) => {
        let valueA = a[field];
        let valueB = b[field];

        // Handle string comparison
        if (typeof valueA === "string" && typeof valueB === "string") {
            valueA = valueA.toLowerCase();
            valueB = valueB.toLowerCase();
        }

        if (order === "desc") {
            return valueA < valueB ? 1 : valueA > valueB ? -1 : 0;
        } else {
            return valueA > valueB ? 1 : valueA < valueB ? -1 : 0;
        }
    });
}

// Export default function
export default {
    parseKategoriResponse,
    validateKategoriItem,
    groupKategoriByType,
    filterKategoriItems,
    sortKategoriItems,
};
