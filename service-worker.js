var cacheName = 'cache-v1';
/*
var filesToCache = [
	'./index.php',
	'./index.php?utm=homescreen', //Query strings are treated as seperate page
  './images/logo.png',
  'scrollmagic.js',
  'tweenmax.min.js',
  'animation.gsap.js'

];
const offlineFallbackPage = "ToDo-replace-this-name.html";

const networkFirstPaths = [
  //* Add an array of regex of paths that should go network first 
  // Example: /\/api\/.
];

const avoidCachingPaths = [
  //* Add an array of regex of paths that shouldn't be cached 
  // Example: /\/api\/.
];
//Adding 'install' event listener
self.addEventListener('install', function (event) {
  console.log('Event: Install');

  //Adding the static resources to cache
  event.waitUntil(
    //Open the cache
    caches.open(cacheName)
      .then(function (cache) {
        //Adding the files to cache
        return cache.addAll(filesToCache)
          .then(function () {
            console.log("All files are cached.");
          })
      })
      .catch(function (err) {
        console.log("Error occurred while caching ", err);
      })
  );
});

//Adding 'activate' event listener
self.addEventListener('activate', function (event) {
  console.log('Event: Activate');
  
  //Delete unwanted and old caches here
  event.waitUntil(
    caches.keys().then(function(cacheNames) {
      return Promise.all(
        cacheNames.map(function(cache) {
          console.log(cache)
          if (cache !== cacheName) {
            return caches.delete(cache); //Deleting the cache
          }
        })
      );
    })
  );
});
  */
//Adding 'fetch' event listener
self.addEventListener('fetch', function (event) {
  console.log('Event: Fetch');

  var request = event.request; // request made by the app
  
  //Tell the browser to wait for network request and respond with below
  event.respondWith(
    //If request is already in cache, return it
    caches.match(request).then(function(response) {
      if (response) {
        return response;
      }

      //else make a request and add it to cache and return the response
      return fetch(request).then(function(response) {
        var responseToCache = response.clone(); //Cloning the response stream in order to add it to cache
        caches.open(cacheName).then(
          function(cache) {
            cache.put(request, responseToCache); //Adding to cache
          });

        return response;
      });
    })
  );
});
