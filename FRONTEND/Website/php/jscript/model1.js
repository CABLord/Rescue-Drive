// Importiere Three.js und den STLLoader
import * as THREE from "https://cdn.skypack.dev/three@0.129.0/build/three.module.js";
import { OrbitControls } from "https://cdn.skypack.dev/three@0.129.0/examples/jsm/controls/OrbitControls.js";
import { STLLoader } from "https://cdn.skypack.dev/three@0.129.0/examples/jsm/loaders/STLLoader.js";

// Szene, Kamera und Renderer erstellen
const scene = new THREE.Scene();
const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
const renderer = new THREE.WebGLRenderer({ alpha: true });
renderer.setSize(window.innerWidth, window.innerHeight);
document.getElementById("stl-container").appendChild(renderer.domElement);

// Kamera-Position setzen
camera.position.z = 50;

// Licht hinzufügen
const light = new THREE.DirectionalLight(0xffffff, 1);
light.position.set(50, 50, 50);
scene.add(light);

const ambientLight = new THREE.AmbientLight(0x404040);
scene.add(ambientLight);

// STL-Loader initialisieren
const loader = new STLLoader();
loader.load("./models/dropCard.stl", function (geometry) {
    const material = new THREE.MeshStandardMaterial({ color: 0x00ff00 });
    const mesh = new THREE.Mesh(geometry, material);
    
    // Modell skalieren und positionieren
    mesh.scale.set(0.5, 0.5, 0.5);
    mesh.position.set(0, -10, 0);
    
    scene.add(mesh);

    // Animation
    function animate() {
        requestAnimationFrame(animate);
        mesh.rotation.y += 0.01;
        renderer.render(scene, camera);
    }
    animate();
});

// Kamera-Steuerung mit Maus aktivieren
const controls = new OrbitControls(camera, renderer.domElement);

// Fenstergröße anpassen
window.addEventListener("resize", function () {
    camera.aspect = window.innerWidth / window.innerHeight;
    camera.updateProjectionMatrix();
    renderer.setSize(window.innerWidth, window.innerHeight);
});