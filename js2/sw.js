const cacheName = 'mll';
const staticAssets = [
 './mll.png',
 './head.php',
'./app/u.php',
 './index.js',
 './index.php',
 './index2.html',
'./footer.php',
'./css2/suneditor.min.css',
'./reg.php',
'./contact.php',
'./sub.php',
'./user.php',
'https://fonts.googleapis.com/css?family=Aguafina+Script',
'https://fonts.googleapis.com/css?family=Almendra',
'https://fonts.googleapis.com/css?family=Amita',
'https://fonts.googleapis.com/css?family=Bad+Script',
'https://fonts.googleapis.com/css?family=Berkshire+Swash',
'https://fonts.googleapis.com/css?family=Bilbo+Swash+Caps',
'https://fonts.googleapis.com/css?family=IM+Fell+Great+Primer+SC',
'https://fonts.googleapis.com/css?family=Lora',
'https://fonts.googleapis.com/css?family=Modern+Antiqua',
'https://fonts.googleapis.com/css?family=Poppins',
'https://fonts.googleapis.com/css?family=Roboto',
'https://fonts.googleapis.com/css?family=Roboto+Mono',
'assets/fonts/ionicons.min.css?h=9db842b3dc3336737559eb4abc0f1b3d',
'assets/css/Article-Clean.css?h=799280649f6ebada87bd9c97d22c0efa',
'assets/css/Article-List.css?h=cec575f25bba55cfaa10100750e76412',
'assets/css/Bold-BS4-CSS-Image-Slider.css?h=51e0848d9bed77713f6de3832c08becc',
'assets/css/Contact-Form-Clean.css?h=c942239c91f94a6b90d67fb2496c21bf',
'assets/css/Footer-Dark.css?h=cabc25193678a4e8700df5b6f6e02b7c',
'assets/css/Highlight-Clean.css?h=22f5c37d9256feae966552e68b9ff2f3',
'https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css',
'https://cdnjs.cloudflare.com/ajax/libs/aos/2.2.0/aos.css',
'https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/css/lightbox.min.css',
'assets/css/Lightbox-Gallery.css?h=6fd900423297e690e0f2ff0372fc3ee6',
'assets/css/Login-Form-Clean.css?h=587ac2057624923cd5be3eaf8b1158cd',
'assets/css/Navigation-Clean.css?h=bd36a0e1e15ca19cbc401cc5f46ca8ca',
'assets/css/Newsletter-Subscription-Form.css?h=c8a4c01ed2ebafc942c6c14c1f21db9a',
'assets/css/Parallax-Scroll-Effect.css?h=1855c11a7e62de8aaeae084e42b4902f',
'assets/css/Registration-Form-with-Photo.css?h=4402da0232a849dd1a07429aa2c17f66',
'assets/css/sidebar-with-button.css?h=efae503532b57a52388a67646ef07ff9',
'assets/css/Social-Icons.css?h=0f9a464676f49120048997381494874d',
'assets/css/styles.css?h=d2c5506b5e093aa847c3c559e78f8290',
'assets/css/Team-Boxed.css?h=82bbec4cae98efe5fc4bdd3d9d621fc2',
'assets/css/untitled.css?h=d41d8cd98f00b204e9800998ecf8427e',
'css2/css.css',
'suneditor/css/suneditor.min.css" ',
'./assets/bootstrap/css/bootstrap.min.css',
'./assets/bootstrap/js/bootstrap.min.js',
'assets/js/jquery.min.js?h=89312d34339dcd686309fe284b3f226f',
'assets/bootstrap/js/bootstrap.min.js?h=0168f7c1e0d08faa2f4b13f4a1dc8c98',
'assets/js/bs-init.js?h=a24a748d1ebf2b30dec97d2c79b26872',
'https://cdnjs.cloudflare.com/ajax/libs/aos/2.2.0/aos.js',
'https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.8.2/js/lightbox.min.js',
'assets/js/sidebar-with-button.js?h=1b8952d8cba47110081772478660f37b'

];

self.addEventListener('install', async e => {
    const cache = await caches.open(cacheName);
    await cache.addAll(staticAssets);
    return self.skipWaiting();
});

self.addEventListener('activate', e => {
    self.clients.claim();
});

self.addEventListener('fetch', async e => {
    const req = e.request;
    const url = new URL(req.url);

    e.respondWith(cacheFirst(req));
    
    if (url.origin === location.origin) {
        
    } else {
        e.respondWith(networkAndCache(req));
    }
});

async function cacheFirst(req) {
    const cache = await caches.open(cacheName);
    const cached = await cache.match(req);
    return cached || fetch(req);
}

async function networkAndCache(req) {
    const cache = await caches.open(cacheName);
    try {
        const fresh = await fetch(req);
        await cache.put(req, fresh.clone());
        return fresh;
    } catch (e) {
        const cached = await cache.match(req);
        return cached;
    }
}