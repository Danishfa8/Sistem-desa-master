// CoordinateUtils.js - Utility functions untuk menangani koordinat

export class CoordinateUtils {
    // Validasi koordinat
    static isValidCoordinate(lat, lng) {
        const latitude = parseFloat(lat);
        const longitude = parseFloat(lng);

        return (
            !isNaN(latitude) &&
            !isNaN(longitude) &&
            latitude >= -90 &&
            latitude <= 90 &&
            longitude >= -180 &&
            longitude <= 180
        );
    }

    // Parse koordinat dari string/number ke float
    static parseCoordinates(lat, lng) {
        const latitude = parseFloat(lat);
        const longitude = parseFloat(lng);

        if (this.isValidCoordinate(latitude, longitude)) {
            return { lat: latitude, lng: longitude };
        }

        return null;
    }

    // Hitung jarak antara dua koordinat (dalam km)
    static calculateDistance(lat1, lng1, lat2, lng2) {
        const R = 6371; // Radius bumi dalam km
        const dLat = this.toRad(lat2 - lat1);
        const dLng = this.toRad(lng2 - lng1);

        const a =
            Math.sin(dLat / 2) * Math.sin(dLat / 2) +
            Math.cos(this.toRad(lat1)) *
                Math.cos(this.toRad(lat2)) *
                Math.sin(dLng / 2) *
                Math.sin(dLng / 2);

        const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
        return R * c;
    }

    // Convert degrees ke radians
    static toRad(degrees) {
        return degrees * (Math.PI / 180);
    }

    // Hitung center point dari array koordinat
    static calculateCenter(coordinates) {
        if (!coordinates || coordinates.length === 0) {
            return null;
        }

        let latSum = 0;
        let lngSum = 0;
        let validCount = 0;

        coordinates.forEach((coord) => {
            const parsed = this.parseCoordinates(
                coord.lat || coord.latitude,
                coord.lng || coord.longitude
            );
            if (parsed) {
                latSum += parsed.lat;
                lngSum += parsed.lng;
                validCount++;
            }
        });

        if (validCount === 0) return null;

        return {
            lat: latSum / validCount,
            lng: lngSum / validCount,
        };
    }

    // Hitung bounds dari array koordinat
    static calculateBounds(coordinates) {
        if (!coordinates || coordinates.length === 0) {
            return null;
        }

        let minLat = Infinity;
        let maxLat = -Infinity;
        let minLng = Infinity;
        let maxLng = -Infinity;
        let hasValidCoord = false;

        coordinates.forEach((coord) => {
            const parsed = this.parseCoordinates(
                coord.lat || coord.latitude,
                coord.lng || coord.longitude
            );
            if (parsed) {
                minLat = Math.min(minLat, parsed.lat);
                maxLat = Math.max(maxLat, parsed.lat);
                minLng = Math.min(minLng, parsed.lng);
                maxLng = Math.max(maxLng, parsed.lng);
                hasValidCoord = true;
            }
        });

        if (!hasValidCoord) return null;

        return {
            southWest: [minLat, minLng],
            northEast: [maxLat, maxLng],
        };
    }

    // Group koordinat berdasarkan jarak tertentu (clustering)
    static groupByDistance(coordinates, maxDistance = 1) {
        const groups = [];
        const processed = new Set();

        coordinates.forEach((coord, index) => {
            if (processed.has(index)) return;

            const parsed = this.parseCoordinates(
                coord.lat || coord.latitude,
                coord.lng || coord.longitude
            );
            if (!parsed) return;

            const group = [coord];
            processed.add(index);

            // Cari koordinat lain yang dekat
            coordinates.forEach((otherCoord, otherIndex) => {
                if (processed.has(otherIndex)) return;

                const otherParsed = this.parseCoordinates(
                    otherCoord.lat || otherCoord.latitude,
                    otherCoord.lng || otherCoord.longitude
                );

                if (!otherParsed) return;

                const distance = this.calculateDistance(
                    parsed.lat,
                    parsed.lng,
                    otherParsed.lat,
                    otherParsed.lng
                );

                if (distance <= maxDistance) {
                    group.push(otherCoord);
                    processed.add(otherIndex);
                }
            });

            groups.push(group);
        });

        return groups;
    }

    // Format koordinat untuk display
    static formatCoordinates(lat, lng, precision = 6) {
        const parsed = this.parseCoordinates(lat, lng);
        if (!parsed) return "Koordinat tidak valid";

        return `${parsed.lat.toFixed(precision)}, ${parsed.lng.toFixed(
            precision
        )}`;
    }

    // Konversi DMS (Degrees Minutes Seconds) ke Decimal
    static dmsToDecimal(degrees, minutes, seconds, direction) {
        let decimal = Math.abs(degrees) + minutes / 60 + seconds / 3600;

        if (direction === "S" || direction === "W") {
            decimal = -decimal;
        }

        return decimal;
    }

    // Konversi Decimal ke DMS
    static decimalToDms(decimal) {
        const absolute = Math.abs(decimal);
        const degrees = Math.floor(absolute);
        const minutesFloat = (absolute - degrees) * 60;
        const minutes = Math.floor(minutesFloat);
        const seconds = (minutesFloat - minutes) * 60;

        const direction = decimal >= 0 ? "N" : "S"; // atau 'E'/'W' untuk longitude

        return {
            degrees,
            minutes,
            seconds: Math.round(seconds * 1000) / 1000,
            direction,
        };
    }

    // Check apakah koordinat berada dalam batas tertentu
    static isWithinBounds(lat, lng, bounds) {
        const coord = this.parseCoordinates(lat, lng);
        if (!coord || !bounds) return false;

        return (
            coord.lat >= bounds.southWest[0] &&
            coord.lat <= bounds.northEast[0] &&
            coord.lng >= bounds.southWest[1] &&
            coord.lng <= bounds.northEast[1]
        );
    }
}

// Export juga sebagai default untuk backward compatibility
export default CoordinateUtils;
