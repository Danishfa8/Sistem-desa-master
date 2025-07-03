/**
 * Utility functions untuk membuat batas wilayah administratif desa
 */

/**
 * Create Voronoi diagram boundaries based on desa coordinates
 * @param {Array} desaList - Array of desa objects with lat/lng
 * @returns {Array} - Array of polygon boundaries
 */
export function createVoronoiBoundaries(desaList) {
    if (!desaList || desaList.length < 2) return [];

    const boundaries = [];
    const validDesas = desaList.filter(
        (desa) =>
            desa.latitude &&
            desa.longitude &&
            !isNaN(parseFloat(desa.latitude)) &&
            !isNaN(parseFloat(desa.longitude))
    );

    if (validDesas.length < 2) return [];

    // Simple Voronoi implementation using Delaunay triangulation
    validDesas.forEach((desa, index) => {
        const centerLat = parseFloat(desa.latitude);
        const centerLng = parseFloat(desa.longitude);

        // Calculate approximate boundary using nearest neighbors
        const neighbors = findNearestNeighbors(desa, validDesas, 3);
        const boundaryPoints = calculateBoundaryPoints(desa, neighbors);

        boundaries.push({
            desa_id: desa.id,
            nama_desa: desa.nama_desa,
            center: [centerLat, centerLng],
            boundary: boundaryPoints,
            area: calculatePolygonArea(boundaryPoints),
        });
    });

    return boundaries;
}

/**
 * Find nearest neighbors for a desa
 * @param {Object} targetDesa - Target desa object
 * @param {Array} allDesas - All desa objects
 * @param {number} count - Number of neighbors to find
 * @returns {Array} - Array of nearest neighbors
 */
function findNearestNeighbors(targetDesa, allDesas, count = 3) {
    const targetLat = parseFloat(targetDesa.latitude);
    const targetLng = parseFloat(targetDesa.longitude);

    const distances = allDesas
        .filter((desa) => desa.id !== targetDesa.id)
        .map((desa) => {
            const lat = parseFloat(desa.latitude);
            const lng = parseFloat(desa.longitude);
            const distance = calculateDistance(targetLat, targetLng, lat, lng);

            return {
                desa,
                distance,
                bearing: calculateBearing(targetLat, targetLng, lat, lng),
            };
        })
        .sort((a, b) => a.distance - b.distance)
        .slice(0, count);

    return distances;
}

/**
 * Calculate boundary points based on center and neighbors
 * @param {Object} centerDesa - Center desa
 * @param {Array} neighbors - Array of neighbor objects
 * @returns {Array} - Array of boundary coordinates
 */
function calculateBoundaryPoints(centerDesa, neighbors) {
    const centerLat = parseFloat(centerDesa.latitude);
    const centerLng = parseFloat(centerDesa.longitude);

    if (neighbors.length === 0) {
        // Create default circular boundary
        return createCircularBoundary(centerLat, centerLng, 2000); // 2km radius
    }

    // Calculate midpoints between center and neighbors
    const midpoints = neighbors.map((neighbor) => {
        const neighborLat = parseFloat(neighbor.desa.latitude);
        const neighborLng = parseFloat(neighbor.desa.longitude);

        const midLat = (centerLat + neighborLat) / 2;
        const midLng = (centerLng + neighborLng) / 2;

        return {
            lat: midLat,
            lng: midLng,
            bearing: neighbor.bearing,
            distance: neighbor.distance / 2,
        };
    });

    // Sort by bearing to create proper polygon
    midpoints.sort((a, b) => a.bearing - b.bearing);

    // Create boundary points using perpendicular bisectors
    const boundaryPoints = [];

    for (let i = 0; i < midpoints.length; i++) {
        const current = midpoints[i];
        const next = midpoints[(i + 1) % midpoints.length];

        // Calculate perpendicular points
        const perpBearing = current.bearing + 90;
        const perpDistance = Math.min(current.distance, 1500); // Max 1.5km from midpoint

        const point1 = calculateDestination(
            current.lat,
            current.lng,
            perpBearing,
            perpDistance
        );
        const point2 = calculateDestination(
            current.lat,
            current.lng,
            perpBearing + 180,
            perpDistance
        );

        boundaryPoints.push([point1.lat, point1.lng]);
        boundaryPoints.push([point2.lat, point2.lng]);
    }

    // If no valid boundary points, create circular boundary
    if (boundaryPoints.length < 3) {
        return createCircularBoundary(centerLat, centerLng, 1500);
    }

    // Sort points to create proper polygon (convex hull)
    return createConvexHull(boundaryPoints);
}

/**
 * Create circular boundary around a point
 * @param {number} centerLat - Center latitude
 * @param {number} centerLng - Center longitude
 * @param {number} radius - Radius in meters
 * @returns {Array} - Array of boundary coordinates
 */
function createCircularBoundary(centerLat, centerLng, radius) {
    const points = [];
    const numberOfPoints = 16; // Create 16-sided polygon

    for (let i = 0; i < numberOfPoints; i++) {
        const bearing = (360 / numberOfPoints) * i;
        const point = calculateDestination(
            centerLat,
            centerLng,
            bearing,
            radius
        );
        points.push([point.lat, point.lng]);
    }

    // Close the polygon
    points.push(points[0]);

    return points;
}

/**
 * Calculate distance between two points (Haversine formula)
 * @param {number} lat1 - First point latitude
 * @param {number} lng1 - First point longitude
 * @param {number} lat2 - Second point latitude
 * @param {number} lng2 - Second point longitude
 * @returns {number} - Distance in kilometers
 */
function calculateDistance(lat1, lng1, lat2, lng2) {
    const R = 6371; // Earth's radius in kilometers
    const dLat = toRadians(lat2 - lat1);
    const dLng = toRadians(lng2 - lng1);

    const a =
        Math.sin(dLat / 2) * Math.sin(dLat / 2) +
        Math.cos(toRadians(lat1)) *
            Math.cos(toRadians(lat2)) *
            Math.sin(dLng / 2) *
            Math.sin(dLng / 2);

    const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
    return R * c;
}

/**
 * Calculate bearing between two points
 * @param {number} lat1 - First point latitude
 * @param {number} lng1 - First point longitude
 * @param {number} lat2 - Second point latitude
 * @param {number} lng2 - Second point longitude
 * @returns {number} - Bearing in degrees
 */
function calculateBearing(lat1, lng1, lat2, lng2) {
    const dLng = toRadians(lng2 - lng1);
    const lat1Rad = toRadians(lat1);
    const lat2Rad = toRadians(lat2);

    const y = Math.sin(dLng) * Math.cos(lat2Rad);
    const x =
        Math.cos(lat1Rad) * Math.sin(lat2Rad) -
        Math.sin(lat1Rad) * Math.cos(lat2Rad) * Math.cos(dLng);

    const bearing = toDegrees(Math.atan2(y, x));
    return (bearing + 360) % 360;
}

/**
 * Calculate destination point given start point, bearing and distance
 * @param {number} lat - Start latitude
 * @param {number} lng - Start longitude
 * @param {number} bearing - Bearing in degrees
 * @param {number} distance - Distance in meters
 * @returns {Object} - Destination point {lat, lng}
 */
function calculateDestination(lat, lng, bearing, distance) {
    const R = 6371000; // Earth's radius in meters
    const bearingRad = toRadians(bearing);
    const latRad = toRadians(lat);
    const lngRad = toRadians(lng);

    const latDestRad = Math.asin(
        Math.sin(latRad) * Math.cos(distance / R) +
            Math.cos(latRad) * Math.sin(distance / R) * Math.cos(bearingRad)
    );

    const lngDestRad =
        lngRad +
        Math.atan2(
            Math.sin(bearingRad) * Math.sin(distance / R) * Math.cos(latRad),
            Math.cos(distance / R) - Math.sin(latRad) * Math.sin(latDestRad)
        );

    return {
        lat: toDegrees(latDestRad),
        lng: toDegrees(lngDestRad),
    };
}

/**
 * Create convex hull from array of points
 * @param {Array} points - Array of [lat, lng] coordinates
 * @returns {Array} - Convex hull points
 */
function createConvexHull(points) {
    if (points.length < 3) return points;

    // Sort points lexicographically
    points.sort((a, b) => a[0] - b[0] || a[1] - b[1]);

    // Build lower hull
    const lower = [];
    for (let i = 0; i < points.length; i++) {
        while (
            lower.length >= 2 &&
            crossProduct(
                lower[lower.length - 2],
                lower[lower.length - 1],
                points[i]
            ) <= 0
        ) {
            lower.pop();
        }
        lower.push(points[i]);
    }

    // Build upper hull
    const upper = [];
    for (let i = points.length - 1; i >= 0; i--) {
        while (
            upper.length >= 2 &&
            crossProduct(
                upper[upper.length - 2],
                upper[upper.length - 1],
                points[i]
            ) <= 0
        ) {
            upper.pop();
        }
        upper.push(points[i]);
    }

    // Remove last point of each half because it's repeated
    upper.pop();
    lower.pop();

    // Concatenate lower and upper hull
    const hull = lower.concat(upper);

    // Close the polygon
    if (hull.length > 0) {
        hull.push(hull[0]);
    }

    return hull;
}

/**
 * Calculate cross product for convex hull algorithm
 * @param {Array} O - Origin point [lat, lng]
 * @param {Array} A - Point A [lat, lng]
 * @param {Array} B - Point B [lat, lng]
 * @returns {number} - Cross product
 */
function crossProduct(O, A, B) {
    return (A[0] - O[0]) * (B[1] - O[1]) - (A[1] - O[1]) * (B[0] - O[0]);
}

/**
 * Calculate area of polygon
 * @param {Array} points - Array of [lat, lng] coordinates
 * @returns {number} - Area in square meters (approximate)
 */
function calculatePolygonArea(points) {
    if (points.length < 3) return 0;

    let area = 0;
    for (let i = 0; i < points.length - 1; i++) {
        const lat1 = toRadians(points[i][0]);
        const lng1 = toRadians(points[i][1]);
        const lat2 = toRadians(points[i + 1][0]);
        const lng2 = toRadians(points[i + 1][1]);

        area += (lng2 - lng1) * (2 + Math.sin(lat1) + Math.sin(lat2));
    }

    area = Math.abs((area * 6378137 * 6378137) / 2); // Earth radius squared
    return area;
}

/**
 * Create buffer zone around a point
 * @param {number} lat - Center latitude
 * @param {number} lng - Center longitude
 * @param {number} bufferDistance - Buffer distance in meters
 * @param {number} points - Number of points in buffer polygon
 * @returns {Array} - Buffer polygon coordinates
 */
export function createBufferZone(lat, lng, bufferDistance, points = 32) {
    const bufferPoints = [];

    for (let i = 0; i < points; i++) {
        const bearing = (360 / points) * i;
        const point = calculateDestination(lat, lng, bearing, bufferDistance);
        bufferPoints.push([point.lat, point.lng]);
    }

    // Close the polygon
    bufferPoints.push(bufferPoints[0]);

    return bufferPoints;
}

/**
 * Create administrative boundaries using multiple algorithms
 * @param {Array} desaList - Array of desa objects
 * @param {Object} options - Configuration options
 * @returns {Object} - Boundaries data
 */
export function createAdministrativeBoundaries(desaList, options = {}) {
    const config = {
        method: "voronoi", // 'voronoi', 'buffer', 'convex'
        bufferDistance: 2000, // meters
        minDistance: 500, // minimum distance between boundaries
        ...options,
    };

    const boundaries = {
        type: "FeatureCollection",
        features: [],
    };

    switch (config.method) {
        case "voronoi":
            const voronoiBoundaries = createVoronoiBoundaries(desaList);
            voronoiBoundaries.forEach((boundary) => {
                boundaries.features.push({
                    type: "Feature",
                    properties: {
                        desa_id: boundary.desa_id,
                        nama_desa: boundary.nama_desa,
                        area: boundary.area,
                        method: "voronoi",
                    },
                    geometry: {
                        type: "Polygon",
                        coordinates: [boundary.boundary],
                    },
                });
            });
            break;

        case "buffer":
            desaList.forEach((desa) => {
                if (desa.latitude && desa.longitude) {
                    const lat = parseFloat(desa.latitude);
                    const lng = parseFloat(desa.longitude);

                    if (!isNaN(lat) && !isNaN(lng)) {
                        const buffer = createBufferZone(
                            lat,
                            lng,
                            config.bufferDistance
                        );

                        boundaries.features.push({
                            type: "Feature",
                            properties: {
                                desa_id: desa.id,
                                nama_desa: desa.nama_desa,
                                area: calculatePolygonArea(buffer),
                                method: "buffer",
                            },
                            geometry: {
                                type: "Polygon",
                                coordinates: [buffer],
                            },
                        });
                    }
                }
            });
            break;

        default:
            console.warn("Unknown boundary method:", config.method);
    }

    return boundaries;
}

// Helper functions
function toRadians(degrees) {
    return degrees * (Math.PI / 180);
}

function toDegrees(radians) {
    return radians * (180 / Math.PI);
}

/**
 * Validate boundary data
 * @param {Object} boundary - Boundary object to validate
 * @returns {boolean} - True if valid
 */
export function validateBoundary(boundary) {
    return (
        boundary &&
        boundary.boundary &&
        Array.isArray(boundary.boundary) &&
        boundary.boundary.length >= 3 &&
        boundary.desa_id &&
        boundary.nama_desa
    );
}

/**
 * Simplify polygon to reduce complexity
 * @param {Array} points - Array of [lat, lng] coordinates
 * @param {number} tolerance - Simplification tolerance
 * @returns {Array} - Simplified polygon
 */
export function simplifyPolygon(points, tolerance = 0.0001) {
    if (points.length <= 3) return points;

    // Douglas-Peucker algorithm implementation
    function douglasPeucker(points, tolerance) {
        if (points.length <= 2) return points;

        // Find the point with maximum distance from line between start and end
        let maxDistance = 0;
        let index = 0;

        for (let i = 1; i < points.length - 1; i++) {
            const distance = perpendicularDistance(
                points[i],
                points[0],
                points[points.length - 1]
            );
            if (distance > maxDistance) {
                maxDistance = distance;
                index = i;
            }
        }

        // If max distance is greater than tolerance, recursively simplify
        if (maxDistance > tolerance) {
            const left = douglasPeucker(points.slice(0, index + 1), tolerance);
            const right = douglasPeucker(points.slice(index), tolerance);

            return left.slice(0, -1).concat(right);
        } else {
            return [points[0], points[points.length - 1]];
        }
    }

    const simplified = douglasPeucker(points, tolerance);

    // Ensure polygon is closed
    if (
        simplified.length > 0 &&
        (simplified[0][0] !== simplified[simplified.length - 1][0] ||
            simplified[0][1] !== simplified[simplified.length - 1][1])
    ) {
        simplified.push(simplified[0]);
    }

    return simplified;
}

/**
 * Calculate perpendicular distance from point to line
 * @param {Array} point - Point [lat, lng]
 * @param {Array} lineStart - Line start [lat, lng]
 * @param {Array} lineEnd - Line end [lat, lng]
 * @returns {number} - Distance
 */
function perpendicularDistance(point, lineStart, lineEnd) {
    const A = point[0] - lineStart[0];
    const B = point[1] - lineStart[1];
    const C = lineEnd[0] - lineStart[0];
    const D = lineEnd[1] - lineStart[1];

    const dot = A * C + B * D;
    const lenSq = C * C + D * D;

    if (lenSq === 0) return Math.sqrt(A * A + B * B);

    const param = dot / lenSq;

    let xx, yy;

    if (param < 0) {
        xx = lineStart[0];
        yy = lineStart[1];
    } else if (param > 1) {
        xx = lineEnd[0];
        yy = lineEnd[1];
    } else {
        xx = lineStart[0] + param * C;
        yy = lineStart[1] + param * D;
    }

    const dx = point[0] - xx;
    const dy = point[1] - yy;

    return Math.sqrt(dx * dx + dy * dy);
}
