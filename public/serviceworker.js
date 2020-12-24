(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["/serviceworker"],{

/***/ "./resources/js/serviceworker.js":
/*!***************************************!*\
  !*** ./resources/js/serviceworker.js ***!
  \***************************************/
/*! no static exports found */
/***/ (function(module, exports) {

eval("var _this = this;\n\nvar staticCacheName = \"pwa-v\" + new Date().getTime();\nvar filesToCache = ['/offline', '/css/app.css', '/js/app.js']; // Cache on install\n\nself.addEventListener(\"install\", function (event) {\n  _this.skipWaiting();\n\n  event.waitUntil(caches.open(staticCacheName).then(function (cache) {\n    return cache.addAll(filesToCache);\n  }));\n}); // Clear cache on activate\n\nself.addEventListener('activate', function (event) {\n  event.waitUntil(caches.keys().then(function (cacheNames) {\n    return Promise.all(cacheNames.filter(function (cacheName) {\n      return cacheName.startsWith(\"pwa-\");\n    }).filter(function (cacheName) {\n      return cacheName !== staticCacheName;\n    }).map(function (cacheName) {\n      return caches[\"delete\"](cacheName);\n    }));\n  }));\n}); // Serve from Cache\n\nself.addEventListener(\"fetch\", function (event) {\n  event.respondWith(caches.match(event.request).then(function (response) {\n    return response || fetch(event.request);\n  })[\"catch\"](function () {\n    return caches.match('offline');\n  }));\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvanMvc2VydmljZXdvcmtlci5qcz85ZGE3Il0sIm5hbWVzIjpbInN0YXRpY0NhY2hlTmFtZSIsIkRhdGUiLCJnZXRUaW1lIiwiZmlsZXNUb0NhY2hlIiwic2VsZiIsImFkZEV2ZW50TGlzdGVuZXIiLCJldmVudCIsInNraXBXYWl0aW5nIiwid2FpdFVudGlsIiwiY2FjaGVzIiwib3BlbiIsInRoZW4iLCJjYWNoZSIsImFkZEFsbCIsImtleXMiLCJjYWNoZU5hbWVzIiwiUHJvbWlzZSIsImFsbCIsImZpbHRlciIsImNhY2hlTmFtZSIsInN0YXJ0c1dpdGgiLCJtYXAiLCJyZXNwb25kV2l0aCIsIm1hdGNoIiwicmVxdWVzdCIsInJlc3BvbnNlIiwiZmV0Y2giXSwibWFwcGluZ3MiOiI7O0FBQUEsSUFBSUEsZUFBZSxHQUFHLFVBQVUsSUFBSUMsSUFBSixHQUFXQyxPQUFYLEVBQWhDO0FBQ0EsSUFBSUMsWUFBWSxHQUFHLENBQ2YsVUFEZSxFQUVmLGNBRmUsRUFHZixZQUhlLENBQW5CLEMsQ0FNQTs7QUFDQUMsSUFBSSxDQUFDQyxnQkFBTCxDQUFzQixTQUF0QixFQUFpQyxVQUFBQyxLQUFLLEVBQUk7QUFDdEMsT0FBSSxDQUFDQyxXQUFMOztBQUNBRCxPQUFLLENBQUNFLFNBQU4sQ0FDSUMsTUFBTSxDQUFDQyxJQUFQLENBQVlWLGVBQVosRUFDS1csSUFETCxDQUNVLFVBQUFDLEtBQUssRUFBSTtBQUNYLFdBQU9BLEtBQUssQ0FBQ0MsTUFBTixDQUFhVixZQUFiLENBQVA7QUFDSCxHQUhMLENBREo7QUFNSCxDQVJELEUsQ0FVQTs7QUFDQUMsSUFBSSxDQUFDQyxnQkFBTCxDQUFzQixVQUF0QixFQUFrQyxVQUFBQyxLQUFLLEVBQUk7QUFDdkNBLE9BQUssQ0FBQ0UsU0FBTixDQUNJQyxNQUFNLENBQUNLLElBQVAsR0FBY0gsSUFBZCxDQUFtQixVQUFBSSxVQUFVLEVBQUk7QUFDN0IsV0FBT0MsT0FBTyxDQUFDQyxHQUFSLENBQ0hGLFVBQVUsQ0FDTEcsTUFETCxDQUNZLFVBQUFDLFNBQVM7QUFBQSxhQUFLQSxTQUFTLENBQUNDLFVBQVYsQ0FBcUIsTUFBckIsQ0FBTDtBQUFBLEtBRHJCLEVBRUtGLE1BRkwsQ0FFWSxVQUFBQyxTQUFTO0FBQUEsYUFBS0EsU0FBUyxLQUFLbkIsZUFBbkI7QUFBQSxLQUZyQixFQUdLcUIsR0FITCxDQUdTLFVBQUFGLFNBQVM7QUFBQSxhQUFJVixNQUFNLFVBQU4sQ0FBY1UsU0FBZCxDQUFKO0FBQUEsS0FIbEIsQ0FERyxDQUFQO0FBTUgsR0FQRCxDQURKO0FBVUgsQ0FYRCxFLENBYUE7O0FBQ0FmLElBQUksQ0FBQ0MsZ0JBQUwsQ0FBc0IsT0FBdEIsRUFBK0IsVUFBQUMsS0FBSyxFQUFJO0FBQ3BDQSxPQUFLLENBQUNnQixXQUFOLENBQ0liLE1BQU0sQ0FBQ2MsS0FBUCxDQUFhakIsS0FBSyxDQUFDa0IsT0FBbkIsRUFDS2IsSUFETCxDQUNVLFVBQUFjLFFBQVEsRUFBSTtBQUNkLFdBQU9BLFFBQVEsSUFBSUMsS0FBSyxDQUFDcEIsS0FBSyxDQUFDa0IsT0FBUCxDQUF4QjtBQUNILEdBSEwsV0FJVyxZQUFNO0FBQ1QsV0FBT2YsTUFBTSxDQUFDYyxLQUFQLENBQWEsU0FBYixDQUFQO0FBQ0gsR0FOTCxDQURKO0FBU0gsQ0FWRCIsImZpbGUiOiIuL3Jlc291cmNlcy9qcy9zZXJ2aWNld29ya2VyLmpzLmpzIiwic291cmNlc0NvbnRlbnQiOlsidmFyIHN0YXRpY0NhY2hlTmFtZSA9IFwicHdhLXZcIiArIG5ldyBEYXRlKCkuZ2V0VGltZSgpO1xudmFyIGZpbGVzVG9DYWNoZSA9IFtcbiAgICAnL29mZmxpbmUnLFxuICAgICcvY3NzL2FwcC5jc3MnLFxuICAgICcvanMvYXBwLmpzJywgXG5dO1xuXG4vLyBDYWNoZSBvbiBpbnN0YWxsXG5zZWxmLmFkZEV2ZW50TGlzdGVuZXIoXCJpbnN0YWxsXCIsIGV2ZW50ID0+IHtcbiAgICB0aGlzLnNraXBXYWl0aW5nKCk7XG4gICAgZXZlbnQud2FpdFVudGlsKFxuICAgICAgICBjYWNoZXMub3BlbihzdGF0aWNDYWNoZU5hbWUpXG4gICAgICAgICAgICAudGhlbihjYWNoZSA9PiB7XG4gICAgICAgICAgICAgICAgcmV0dXJuIGNhY2hlLmFkZEFsbChmaWxlc1RvQ2FjaGUpO1xuICAgICAgICAgICAgfSlcbiAgICApXG59KTtcblxuLy8gQ2xlYXIgY2FjaGUgb24gYWN0aXZhdGVcbnNlbGYuYWRkRXZlbnRMaXN0ZW5lcignYWN0aXZhdGUnLCBldmVudCA9PiB7XG4gICAgZXZlbnQud2FpdFVudGlsKFxuICAgICAgICBjYWNoZXMua2V5cygpLnRoZW4oY2FjaGVOYW1lcyA9PiB7XG4gICAgICAgICAgICByZXR1cm4gUHJvbWlzZS5hbGwoXG4gICAgICAgICAgICAgICAgY2FjaGVOYW1lc1xuICAgICAgICAgICAgICAgICAgICAuZmlsdGVyKGNhY2hlTmFtZSA9PiAoY2FjaGVOYW1lLnN0YXJ0c1dpdGgoXCJwd2EtXCIpKSlcbiAgICAgICAgICAgICAgICAgICAgLmZpbHRlcihjYWNoZU5hbWUgPT4gKGNhY2hlTmFtZSAhPT0gc3RhdGljQ2FjaGVOYW1lKSlcbiAgICAgICAgICAgICAgICAgICAgLm1hcChjYWNoZU5hbWUgPT4gY2FjaGVzLmRlbGV0ZShjYWNoZU5hbWUpKVxuICAgICAgICAgICAgKTtcbiAgICAgICAgfSlcbiAgICApO1xufSk7XG5cbi8vIFNlcnZlIGZyb20gQ2FjaGVcbnNlbGYuYWRkRXZlbnRMaXN0ZW5lcihcImZldGNoXCIsIGV2ZW50ID0+IHtcbiAgICBldmVudC5yZXNwb25kV2l0aChcbiAgICAgICAgY2FjaGVzLm1hdGNoKGV2ZW50LnJlcXVlc3QpXG4gICAgICAgICAgICAudGhlbihyZXNwb25zZSA9PiB7XG4gICAgICAgICAgICAgICAgcmV0dXJuIHJlc3BvbnNlIHx8IGZldGNoKGV2ZW50LnJlcXVlc3QpO1xuICAgICAgICAgICAgfSlcbiAgICAgICAgICAgIC5jYXRjaCgoKSA9PiB7XG4gICAgICAgICAgICAgICAgcmV0dXJuIGNhY2hlcy5tYXRjaCgnb2ZmbGluZScpO1xuICAgICAgICAgICAgfSlcbiAgICApXG59KTsiXSwic291cmNlUm9vdCI6IiJ9\n//# sourceURL=webpack-internal:///./resources/js/serviceworker.js\n");

/***/ }),

/***/ "./resources/sass/app.scss":
/*!*********************************!*\
  !*** ./resources/sass/app.scss ***!
  \*********************************/
/*! no static exports found */
/***/ (function(module, exports) {

eval("// removed by extract-text-webpack-plugin//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvc2Fzcy9hcHAuc2Nzcz8wZTE1Il0sIm5hbWVzIjpbXSwibWFwcGluZ3MiOiJBQUFBIiwiZmlsZSI6Ii4vcmVzb3VyY2VzL3Nhc3MvYXBwLnNjc3MuanMiLCJzb3VyY2VzQ29udGVudCI6WyIvLyByZW1vdmVkIGJ5IGV4dHJhY3QtdGV4dC13ZWJwYWNrLXBsdWdpbiJdLCJzb3VyY2VSb290IjoiIn0=\n//# sourceURL=webpack-internal:///./resources/sass/app.scss\n");

/***/ }),

/***/ 0:
/*!***********************************************************************!*\
  !*** multi ./resources/js/serviceworker.js ./resources/sass/app.scss ***!
  \***********************************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! D:\dev\repos\samiobah\resources\js\serviceworker.js */"./resources/js/serviceworker.js");
module.exports = __webpack_require__(/*! D:\dev\repos\samiobah\resources\sass\app.scss */"./resources/sass/app.scss");


/***/ })

},[[0,"/js/manifest","/js/vendor"]]]);