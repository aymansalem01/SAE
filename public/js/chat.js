if (window.innerWidth >= 992) {
const container = document.getElementById('canvas-container');
const scene = new THREE.Scene();
scene.fog = new THREE.FogExp2(0x020617, 0.002);

const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
const renderer = new THREE.WebGLRenderer({ alpha: true, antialias: true });

renderer.setSize(window.innerWidth, window.innerHeight);
renderer.setPixelRatio(window.devicePixelRatio);
container.appendChild(renderer.domElement);


function createGradientTexture() {
    const canvas = document.createElement('canvas');
    canvas.width = 512;
    canvas.height = 512;
    const context = canvas.getContext('2d');


    const gradient = context.createLinearGradient(0, 0, 512, 512);
    gradient.addColorStop(0, '#6366f1');
    gradient.addColorStop(0.5, '#8b5cf6');
    gradient.addColorStop(1, '#a855f7');

    context.fillStyle = gradient;
    context.fillRect(0, 0, 512, 512);

    return new THREE.CanvasTexture(canvas);
}

const gradientMap = createGradientTexture();


const geometry = new THREE.SphereGeometry(2, 64, 64);

const material = new THREE.MeshPhysicalMaterial({
    map: gradientMap,
    color: 0xffffff,
    emissive: 0x1e1b4b,
    emissiveIntensity: 0.2,
    roughness: 0.1,
    metalness: 0.1,
    reflectivity: 1,
    clearcoat: 1.0,
    clearcoatRoughness: 0.1,
    transparent: true,
    opacity: 0.7,
    side: THREE.DoubleSide
});

const waterBall = new THREE.Mesh(geometry, material);
// Start scale at 0 for "pop-in" animation
waterBall.scale.set(0, 0, 0);
scene.add(waterBall);

// Lighting
const ambientLight = new THREE.AmbientLight(0x404040, 2);
scene.add(ambientLight);

const pointLight1 = new THREE.PointLight(0x8b5cf6, 2, 50);
pointLight1.position.set(5, 5, 5);
scene.add(pointLight1);

const pointLight2 = new THREE.PointLight(0x6366f1, 2, 50);
pointLight2.position.set(-5, -5, 5);
scene.add(pointLight2);

const rimLight = new THREE.PointLight(0xffffff, 1.5, 20);
rimLight.position.set(0, 5, -5);
scene.add(rimLight);

camera.position.z = 8;

// Interaction State
let mouseX = 0;
let mouseY = 0;
let targetX = 0;
let targetY = 0;
// isDragging no longer needed for movement, but kept for touch logic if needed
let isDragging = false;

const originalPositions = geometry.attributes.position.array.slice();
const count = geometry.attributes.position.count;

window.addEventListener('resize', onWindowResize, false);

document.addEventListener('mousedown', () => isDragging = true);
document.addEventListener('mouseup', () => isDragging = false);
document.addEventListener('mousemove', onMouseMove);

document.addEventListener('touchstart', () => isDragging = true);
document.addEventListener('touchend', () => isDragging = false);
document.addEventListener('touchmove', onTouchMove);

function onWindowResize() {
    camera.aspect = window.innerWidth / window.innerHeight;
    camera.updateProjectionMatrix();
    renderer.setSize(window.innerWidth, window.innerHeight);
}

function onMouseMove(event) {
    mouseX = (event.clientX / window.innerWidth) * 2 - 1;
    mouseY = -(event.clientY / window.innerHeight) * 2 + 1;
}

function onTouchMove(event) {
    if (event.touches.length > 0) {
        const touch = event.touches[0];
        mouseX = (touch.clientX / window.innerWidth) * 2 - 1;
        mouseY = -(touch.clientY / window.innerHeight) * 2 + 1;
    }
}

// Animation Loop
const clock = new THREE.Clock();

function animate() {
    requestAnimationFrame(animate);

    const time = clock.getElapsedTime();
    const positions = geometry.attributes.position.array;


    if (waterBall.scale.x < 1) {
        const growthSpeed = 0.05;
        waterBall.scale.x += growthSpeed;
        waterBall.scale.y += growthSpeed;
        waterBall.scale.z += growthSpeed;
        if (waterBall.scale.x > 1) waterBall.scale.set(1, 1, 1);
    }

    // --- 4. Water Wobble Effect ---
    for (let i = 0; i < count; i++) {
        const x = originalPositions[i * 3];
        const y = originalPositions[i * 3 + 1];
        const z = originalPositions[i * 3 + 2];

        // Wave pattern
        const wave1 = Math.sin(x * 2 + time * 1.5);
        const wave2 = Math.cos(y * 1.5 + time * 1.2);
        const wave3 = Math.sin(z * 2 + time * 0.8);

        const displacement = (wave1 + wave2 + wave3) * 0.15;
        const scale = 1 + displacement * 0.1;

        positions[i * 3] = x * scale;
        positions[i * 3 + 1] = y * scale;
        positions[i * 3 + 2] = z * scale;
    }

    geometry.attributes.position.needsUpdate = true;
    geometry.computeVertexNormals();

    // Movement Logic - Updated to Always Follow Cursor
    // Base movement on mouse position
    targetX = mouseX * 10;
    targetY = mouseY * 6;

    // Add a gentle idle float on top so it never looks "frozen"
    targetX += Math.sin(time * 0.5) * 1.0;
    targetY += Math.cos(time * 0.3) * 0.5;

    // Smoothly interpolate current position to target
    waterBall.position.x += (targetX - waterBall.position.x) * 0.05;
    waterBall.position.y += (targetY - waterBall.position.y) * 0.05;

    // Rotation adds to the gradient effect as texture spins
    waterBall.rotation.y += 0.005;
    waterBall.rotation.z += 0.002;

    renderer.render(scene, camera);
}

animate();
}
