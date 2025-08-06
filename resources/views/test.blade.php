<!DOCTYPE html>
<html>
<head>
    <title>Reverb Test</title>
    <script type="module" src="/resources/js/app.js"></script>
</head>
<body>
    <h1>Listening for numbers...</h1>
    <div id="output"></div>

    <script type="module">
        import Echo from 'laravel-echo';

        const echo = new Echo({
            broadcaster: 'reverb',
            key: '{{ env("REVERB_APP_KEY") }}',
            wsHost: window.location.hostname,
            wsPort: 6001,
            forceTLS: false,
            enabledTransports: ['ws'],
        });

        echo.channel('testing-channel')
            .listen('.number.generated', (e) => {
                document.getElementById('output').innerText = 'Received number: ' + e.number;
                console.log('Received:', e.number);
            });
    </script>
</body>
</html>
