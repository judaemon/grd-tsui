import Echo from "laravel-echo";

import Pusher from "pusher-js";
window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: "reverb",
    key: import.meta.env.VITE_REVERB_APP_KEY,
    wsHost: import.meta.env.VITE_REVERB_HOST,
    wsPort: import.meta.env.VITE_REVERB_PORT ?? 80,
    wssPort: import.meta.env.VITE_REVERB_PORT ?? 443,
    forceTLS: (import.meta.env.VITE_REVERB_SCHEME ?? "https") === "https",
    enabledTransports: ["ws", "wss"],
});

console.log("Reverb Config:", {
    key: import.meta.env.VITE_REVERB_APP_KEY,
    host: import.meta.env.VITE_REVERB_HOST,
    port: import.meta.env.VITE_REVERB_PORT,
    scheme: import.meta.env.VITE_REVERB_SCHEME,
});

window.Echo.connector.pusher.connection.bind("connected", function () {
    console.log("Connected to Reverb WebSocket server");
});

window.Echo.connector.pusher.connection.bind("disconnected", function () {
    console.log("Disconnected from Reverb WebSocket server");
});

window.Echo.connector.pusher.connection.bind("error", function (error) {
    console.log("Error with Reverb WebSocket connection:", error);
});

// php artisan reverb:start --host=0.0.0.0 --port=6001

window.Echo.channel("testing-channel").listen(".number.generated", (e) => {
    console.log("Received number:", e.number);
});

window.Echo.channel(`conversation.1`).listen(".MessageSent", (e) => {
    console.log("Received message:", e);
});
