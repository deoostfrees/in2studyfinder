define([],function(){"use strict";var e={identifiers:{loader:".in2studyfinder-loader",loaderActive:".in2studyfinder-loader--active"},toggleClassForElement:function(e,s){e.classList.contains(s)?e.classList.remove(s):e.classList.add(s)},removeClass:function(e,s){e.classList.contains(s)&&e.classList.remove(s)},addClass:function(e,s){e.classList.contains(s)||e.classList.add(s)},hideElement:function(e){e.style.display="none"},showElement:function(e){e.style.display="inline-block"},showElementAsBlock:function(e){e.style.display="block"},removeStyles:function(e){e.removeAttribute("style")},enableLoader:function(){e.toggleClassForElement(document.querySelector(e.identifiers.loader),e.identifiers.loaderActive.substr(1))},disableLoader:function(){e.toggleClassForElement(document.querySelector(e.identifiers.loaderActive),e.identifiers.loaderActive.substr(1))}};return e});