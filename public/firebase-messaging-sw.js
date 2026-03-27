importScripts('https://www.gstatic.com/firebasejs/9.0.0/firebase-app-compat.js');
importScripts('https://www.gstatic.com/firebasejs/9.0.0/firebase-messaging-compat.js');

firebase.initializeApp({
    apiKey: "AIzaSyAB2BkJP_9iQiFVyjLeRftIfs7DJEumWoo",
    authDomain: "multi-vendor-5d507.firebaseapp.com",
    databaseURL: "https://multi-vendor-5d507-default-rtdb.firebaseio.com",
    projectId: "multi-vendor-5d507",
    storageBucket: "multi-vendor-5d507.firebasestorage.app",
    messagingSenderId: "593155222746",
    appId: "1:593155222746:web:107a9a6d16bd534f4309e3",
    measurementId: "G-PCMW9Y2JHT"
});

const messaging = firebase.messaging();

messaging.onBackgroundMessage(function(payload) {
    console.log("Background Message:", payload);
    self.registration.showNotification(payload.notification.title, {
        body: payload.notification.body,
        icon: payload.notification.image
    });
});