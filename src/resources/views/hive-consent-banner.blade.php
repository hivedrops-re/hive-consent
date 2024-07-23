<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

@if(request()->cookie('cookies_accepted') != true)
    @php
        $lang = config('hive-consent.language');
    @endphp
    <div x-data="{manage: false}" x-cloak id="cookiesBanner" class="fixed hidden overflow-hidden bottom-5 left-0 right-0 dark:text-white m-auto md:left-5 md:m-0 bg-white/40 dark:bg-slate-900/40 dark:border-slate-800 backdrop-blur-md drop-shadow rounded-lg w-[350px] md:w-[400px] z-50 border overflow-y-auto max-h-[80vh]">
        <div class="p-5">
            <div class="inline-flex items-center w-full justify-between mb-3">
                <h2 class="font-title font-bold text-xl">{{ __('hive-consent::messages.banner_title', [], $lang) }}</h2>
                <button id="closeBanner" class="hover:text-red-500"><i class="fa-regular fa-xmark"></i></button>
            </div>
            <p class="">
                {{ __('hive-consent::messages.banner_description.part_1', [], $lang) }}
                <a href="{{ config('hive-consent.url_cookies')}}" class="text-blue-500 hover:underline underline-offset-4">{{ __('hive-consent::messages.banner_description.part_2', [], $lang) }}</a>{{ __('hive-consent::messages.banner_description.part_3', [], $lang) }}
            </p>
            <div class="flex items-center gap-3 mt-3">
                <button id="acceptCookies" class="bg-blue-500 py-3 rounded-md flex-1 text-white duration-300 hover:bg-blue-700 hover:ring-1">{{ __('hive-consent::messages.banner_button_accept_all', [], $lang) }}</button>
                <button id="declineCookies" class="bg-blue-500 py-3 rounded-md flex-1 text-white duration-300 hover:bg-blue-700 hover:ring-1">{{ __('hive-consent::messages.banner_button_refuse_all', [], $lang) }}</button>
            </div>
            <button @click="manage = !manage" class="bg-white dark:bg-slate-900 dark:border-slate-800 dark:hover:bg-slate-800 hover:ring-1 dark:text-white border py-3 rounded-md w-full mt-3 duration-300 hover:bg-accent">{{ __('hive-consent::messages.banner_button_manage', [], $lang) }}</button>
        </div>
        <div class="border-t dark:border-slate-800 p-5 bg-white dark:bg-slate-900" x-show="manage" x-transition>
            <div class="inline-flex items-center w-full justify-between mb-3">
                <h2 class="font-title font-bold text-xl">{{ __('hive-consent::messages.banner_title_manage', [], $lang) }}</h2>
                <button @click="manage = false" class="hover:text-blue-500"><i class="fa-regular fa-chevron-up"></i></button>
            </div>
            <div class="mt-3">
                <label class="inline-flex items-center cursor-pointer">
                    <input type="checkbox" id="necessaryCookies" class="sr-only peer" checked>
                    <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                    <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">{{ __('hive-consent::messages.banner_manage.nessecary_title', [], $lang) }}</span>
                </label>
            </div>
            <p class="text-slate-400 text-sm">{{ __('hive-consent::messages.banner_manage.nessecary_description', [], $lang) }}</p>
            <div class="mt-3 border-t dark:border-slate-800 pt-3">
                <label class="inline-flex items-center cursor-pointer">
                    <input type="checkbox" id="analyticsCookies" class="sr-only peer">
                    <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                    <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">{{ __('hive-consent::messages.banner_manage.analytics_title', [], $lang) }}</span>
                </label>
            </div>
            <p class="text-slate-400 text-sm">{{ __('hive-consent::messages.banner_manage.analytics_description', [], $lang) }}</p>
            <div class="mt-3 border-t dark:border-slate-800 pt-3">
                <label class="inline-flex items-center cursor-pointer">
                    <input type="checkbox" id="advertisingCookies" class="sr-only peer">
                    <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                    <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">{{ __('hive-consent::messages.banner_manage.advertising_title', [], $lang) }}</span>
                </label>
            </div>
            <p class="text-slate-400 text-sm">{{ __('hive-consent::messages.banner_manage.advertising_description', [], $lang) }}</p>
            <button id="acceptSelection" class="bg-blue-500 py-3 rounded-md w-full text-white duration-300 hover:bg-blue-700 mt-5">{{ __('hive-consent::messages.banner_button_accept_selected', [], $lang) }}</button>
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

        // Define cookie with SameSite and Secure
        function setCookie(name, value, days, secure = false) {
            const date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            const expires = "expires=" + date.toUTCString();
            const secureFlag = secure ? "secure" : "";
            document.cookie = name + "=" + value + ";" + expires + ";path=/" + secureFlag;
        }

        const isSecure = window.location.protocol === 'https:';

        // Get Cookie
        function getCookie(name) {
            const value = `; ${document.cookie}`;
            const parts = value.split(`; ${name}=`);
            if (parts.length === 2) return parts.pop().split(';').shift();
        }

        // Verified if cookie accept
        const cookiesAccepted = getCookie('cookies_accepted');
        if (cookiesAccepted && cookiesAccepted === 'true') {
            cookiesBanner.style.display = 'none';
        } else {
            cookiesBanner.style.display = 'block';
        }

        // Accept all cookies
        acceptCookies.addEventListener('click', function () {
            setCookie('cookies_accepted', 'true', 365);
            setCookie('necessary_cookies', 'true', 365);
            setCookie('analytics_cookies', 'true', 365);
            setCookie('advertising_cookies', 'true', 365);
            cookiesBanner.style.display = 'none';
        });

        // Refuse all cookies
        declineCookies.addEventListener('click', function () {
            setCookie('cookies_accepted', 'false', 365);
            setCookie('necessary_cookies', 'false', 365);
            setCookie('analytics_cookies', 'false', 365);
            setCookie('advertising_cookies', 'false', 365);
            cookiesBanner.style.display = 'none';
        });

        // Accept selection
        acceptSelection.addEventListener('click', function() {
            setCookie('cookies_accepted', 'true', 365);
            setCookie('necessary_cookies', necessaryCookies.checked ? 'true' : 'false', 365);
            setCookie('analytics_cookies', analyticsCookies.checked ? 'true' : 'false', 365);
            setCookie('advertising_cookies', advertisingCookies.checked ? 'true' : 'false', 365);
            cookiesBanner.style.display = 'none';
        });

        // Close banner function
        closeBanner.addEventListener('click', function () {
            cookiesBanner.style.display = 'none';
        });
    });
</script>
