<!-- HIVE CONSENT ANALYTICS TOOLS -->
<script async src="https://www.googletagmanager.com/gtag/js?id={{ Config::get('hive-consent.google_analytics') }}"></script>
<script>
    // Get Cookie
    function getCookie(name) {
        const value = `; ${document.cookie}`;
        const parts = value.split(`; ${name}=`);
        if (parts.length === 2) return parts.pop().split(';').shift();
    }

    // Verified if cookie analytics accept
    const analyticsAccepted = getCookie('analytics_cookies');
    if (analyticsAccepted && analyticsAccepted === 'true' && '{{ Config::get('hive-consent.google_analytics') }}' !== ''){
        // Google Analytics
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', '{{ Config::get('hive-consent.google_analytics') }}');

        // Add your other analytics tools here
        // ...
    } else {
        console.log('Analytics not active for because analytics cookies are not accepted.');
    }
</script>