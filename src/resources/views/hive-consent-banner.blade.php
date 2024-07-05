<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

@if(request()->cookie('cookies_accepted') != true)
    <div x-data="{manage: false}" x-cloak id="cookiesBanner" class="fixed hidden overflow-hidden bottom-5 left-0 right-0 m-auto md:left-5 md:m-0 bg-white/40 dark:bg-slate-900/40 dark:border-slate-800 backdrop-blur-md drop-shadow rounded-lg w-[350px] md:w-[400px] z-50 border">
        <div class="p-5">
            <div class="inline-flex items-center w-full justify-between mb-3">
                <h2 class="font-title font-bold text-xl">Réglages des cookies</h2>
                <button id="closeBanner" class="hover:text-red-500"><i class="fa-regular fa-xmark"></i></button>
            </div>
            <p class="">
                Nous utilisons des cookies pour améliorer votre expérience et à des fins marketing. Consultez notre
                <a href="{{ config('hive-consent.url_cookies')}}" class="text-blue-500 hover:underline underline-offset-4">politique en matière de cookies</a> pour en savoir plus.
            </p>
            <div class="flex items-center gap-3 mt-3">
                <button id="acceptCookies" class="bg-blue-500 py-3 rounded-md flex-1 text-white duration-300 hover:bg-blue-700 hover:ring-1">Acceptez tout</button>
                <button id="declineCookies" class="bg-blue-500 py-3 rounded-md flex-1 text-white duration-300 hover:bg-blue-700 hover:ring-1">Refusez tout</button>
            </div>
            <button @click="manage = !manage" class="bg-white dark:bg-slate-900 dark:border-slate-800 dark:hover:bg-slate-800 hover:ring-1 dark:text-white border py-3 rounded-md w-full mt-3 duration-300 hover:bg-accent">Configurer les cookies</button>
        </div>
        <div class="border-t dark:border-slate-800 p-5 bg-white dark:bg-slate-900" x-show="manage" x-transition>
            <div class="inline-flex items-center w-full justify-between mb-3">
                <h2 class="font-title font-bold text-xl">Configuration</h2>
                <button @click="manage = false" class="hover:text-blue-500"><i class="fa-regular fa-chevron-up"></i></button>
            </div>
            <div class="mt-3">
                <label class="inline-flex items-center cursor-pointer">
                    <input type="checkbox" id="necessaryCookies" class="sr-only peer" checked>
                    <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                    <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Cookies nécessaires</span>
                </label>
            </div>
            <p class="text-slate-400 text-sm">Utile pour les fonctionnalités avancée du site</p>
            <div class="mt-3 border-t dark:border-slate-800 pt-3">
                <label class="inline-flex items-center cursor-pointer">
                    <input type="checkbox" id="analyticsCookies" class="sr-only peer">
                    <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                    <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Cookies analytiques</span>
                </label>
            </div>
            <p class="text-slate-400 text-sm">Utile pour le suivi et analyse des performances du site</p>
            <div class="mt-3 border-t dark:border-slate-800 pt-3">
                <label class="inline-flex items-center cursor-pointer">
                    <input type="checkbox" id="advertisingCookies" class="sr-only peer">
                    <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                    <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Cookies publicitaires</span>
                </label>
            </div>
            <p class="text-slate-400 text-sm">Utile afin de proposer des publicités ciblées</p>
            <button id="acceptSelection" class="bg-blue-500 py-3 rounded-md w-full text-white duration-300 hover:bg-blue-700 mt-5">Accepter la sélection</button>
        </div>
    </div>
@endif

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const cookiesBanner = document.getElementById('cookiesBanner');
        const acceptCookies = document.getElementById('acceptCookies');
        const declineCookies = document.getElementById('declineCookies');
        const closeBanner = document.getElementById('closeBanner');
        const acceptSelection = document.getElementById('acceptSelection');

        const necessaryCookies = document.getElementById('necessaryCookies');
        const analyticsCookies = document.getElementById('analyticsCookies');
        const advertisingCookies = document.getElementById('advertisingCookies');


        // Vérifier si les cookies sont acceptés
        const cookiesAccepted = document.cookie.split(';').find(row => row.startsWith('cookies_accepted='));
        if(cookiesAccepted) {
            cookiesBanner.style.display = 'none';
        } else {
            cookiesBanner.style.display = 'block';
        }

        // Fonction accepter tous les cookies
        acceptCookies.addEventListener('click', function () {
            document.cookie = 'cookies_accepted=true; expires=Fri, 31 Dec 9999 23:59:59 GMT';
            document.cookie = 'necessary_cookies=true; expires=Fri, 31 Dec 9999 23:59:59 GMT';
            document.cookie = 'analytics_cookies=true; expires=Fri, 31 Dec 9999 23:59:59 GMT';
            document.cookie = 'advertising_cookies=true; expires=Fri, 31 Dec 9999 23:59:59 GMT';
            cookiesBanner.style.display = 'none';
        });

        // Fonction refuser les cookies
        declineCookies.addEventListener('click', function () {
            document.cookie = 'cookies_accepted=false; expires=Fri, 31 Dec 9999 23:59:59 GMT';
            document.cookie = 'necessary_cookies=false; expires=Fri, 31 Dec 9999 23:59:59 GMT';
            document.cookie = 'analytics_cookies=false; expires=Fri, 31 Dec 9999 23:59:59 GMT';
            document.cookie = 'advertising_cookies=false; expires=Fri, 31 Dec 9999 23:59:59 GMT';
            cookiesBanner.style.display = 'none';
        });

        // Fonction accepter la sélection
        acceptSelection.addEventListener('click', function() {
            document.cookie = 'cookies_accepted=true; expires=Fri, 31 Dec 9999 23:59:59 GMT';
            if(necessaryCookies.checked) {
                document.cookie = 'necessary_cookies=true; expires=Fri, 31 Dec 9999 23:59:59 GMT';
            } else {
                document.cookie = 'necessary_cookies=false; expires=Fri, 31 Dec 9999 23:59:59 GMT';
            }
            if(analyticsCookies.checked) {
                document.cookie = 'analytics_cookies=true; expires=Fri, 31 Dec 9999 23:59:59 GMT';
            } else {
                document.cookie = 'analytics_cookies=false; expires=Fri, 31 Dec 9999 23:59:59 GMT';
            }
            if(advertisingCookies.checked) {
                document.cookie = 'advertising_cookies=true; expires=Fri, 31 Dec 9999 23:59:59 GMT';
            } else {
                document.cookie = 'advertising_cookies=false; expires=Fri, 31 Dec 9999 23:59:59 GMT';
            }
            cookiesBanner.style.display = 'none';
        });

        // Fonction fermer la bannière
        closeBanner.addEventListener('click', function () {
            cookiesBanner.style.display = 'none';
        });
    });
</script>
