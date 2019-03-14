define(["TYPO3/CMS/In2studyfinder/Utility/UiUtility","TYPO3/CMS/In2studyfinder/Utility/UrlUtility","TYPO3/CMS/In2studyfinder/Utility/AjaxUtility"],function(c,u,e){"use strict";var a={identifiers:{in2studyfinderContainer:".in2studyfinder",filterForm:".js-in2studyfinder-filter",filterContainer:".js-in2studyfinder-filter-options",filterFieldset:".js-in2studyfinder-filter-section",filterLegend:".js-in2studyfinder-filter-legend",filterCheckbox:".in2studyfinder-js-checkbox",filterCheckboxAll:".in2studyfinder-js-checkbox-all",showFilterButton:".js-in2studyfinder-filter-button-show",hideFilterButton:".js-in2studyfinder-filter-button-reset",hideElement:".u-in2studyfinder-hide",isHidden:".is-hidden"},filter:[],initialize:function(){a.setEventListener(),a.prepareFilter()},prepareFilter:function(){if(a.prepareCheckboxes(),0<a.filter.length){a.toggleFilterVisibility();for(var e=0;e<a.filter.length;e++){var t=document.querySelector('[data-filtergroup="'+a.filter[e]+'"]').querySelector(a.identifiers.filterContainer);c.toggleClassForElement(t,a.identifiers.isHidden.substr(1))}}},setEventListener:function(){document.querySelector(a.identifiers.hideFilterButton).addEventListener("click",a.resetAllFilter),document.querySelector(a.identifiers.showFilterButton).addEventListener("click",a.toggleFilterVisibility),a.setFilterVisibilityEventListener(),a.setFilterCheckboxEventListener()},setFilterCheckboxEventListener:function(){document.querySelector(".c-in2studyfinder-filter__sections").addEventListener("click",function(e){var t=e.target;if("INPUT"===t.tagName){if(t.classList.contains(a.identifiers.filterCheckboxAll.substr(1))){var i=t.parentNode;a.resetFilter(i)}if(t.classList.contains(a.identifiers.filterCheckbox.substr(1))){var r=t.parentNode.querySelector(a.identifiers.filterCheckboxAll);r.checked=!1,r.disabled=!1}a.updateFilter()}})},resetAllFilter:function(){if(0===a.filter.length)a.toggleFilterVisibility();else{var e=document.querySelectorAll(a.identifiers.filterContainer);a.toggleFilterVisibility();for(var t=0;t<e.length;t++)a.resetFilter(e[t]);a.updateFilter()}},resetFilter:function(e){var t=e.querySelector(a.identifiers.filterCheckboxAll),i=e.querySelectorAll(a.identifiers.filterCheckbox);t.checked=!0,t.disabled=!0;for(var r=0;r<i.length;r++)i[r].checked=!1;var n=a.filter.indexOf(e.parentNode.getAttribute("data-filtergroup"));-1!==n&&a.filter.splice(n,1)},updateFilter:function(){var e=document.querySelector(a.identifiers.in2studyfinderContainer),t=document.querySelector(a.identifiers.filterForm),i=e.getAttribute("data-plugin-uid"),r=e.getAttribute("data-pid"),n=e.getAttribute("data-in2studyfinder-language"),l="",d="",s="",o="";void 0!==i&&(l="&ce="+i),null!=n&&(d="&L="+n),s="&tx_in2studyfinder_pi1[@widget_0][currentPage]=1",o=null!=r?"/index.php?id="+r+"&type=1308171055&studyFinderAjaxRequest=1"+l+d+s:"/?type=1308171055&studyFinderAjaxRequest=1"+l+d+s;var f=new XMLHttpRequest;f.onreadystatechange=function(){if(1===this.readyState&&c.enableLoader(),4===this.readyState&&200===this.status){a.setSelectedFilterToUrl(1);var e=document.createElement("div");e.innerHTML=f.responseText,document.querySelector(a.identifiers.in2studyfinderContainer).parentNode.replaceChild(e.querySelector(a.identifiers.in2studyfinderContainer),document.querySelector(a.identifiers.in2studyfinderContainer)),require("TYPO3/CMS/In2studyfinder/Frontend").initialize(),c.disableLoader()}},f.open("POST",o,!0),f.setRequestHeader("Content-type","application/x-www-form-urlencoded"),f.send(u.serialize(t))},setSelectedFilterToUrl:function(e){for(var t={},i="",r=document.querySelector(a.identifiers.filterForm).querySelectorAll(a.identifiers.filterCheckbox+":checked"),n=0;n<r.length;n++)console.log(r[n]);console.log(r);var l=$(".js-in2studyfinder-filter").find("input.in2studyfinder-js-checkbox:checked");$(l).each(function(){var e=$(this).closest("fieldset").data("filtergroup");void 0===t[e]&&(t[e]=[]),t[e].push($(this).val())}),$(t).each(function(e,t){$.each(t,function(e,t){i+=e+"--",$.each(t,function(e,t){i+=t+"+"}),i=i.replace(/\+$/,""),i+="__"}),i=i.replace(/__$/,"")}),e&&(i+="page="+e),window.location=location.protocol+"//"+location.host+location.pathname+(location.search?location.search:"")+"#"+i},setFilterVisibilityEventListener:function(){for(var e=document.querySelectorAll(a.identifiers.filterFieldset),t=0;t<e.length;t++)e[t].querySelector(a.identifiers.filterLegend).addEventListener("click",function(){var e=this.parentNode.querySelector(a.identifiers.filterContainer);c.toggleClassForElement(e,a.identifiers.isHidden.substr(1))})},toggleFilterVisibility:function(){for(var e=document.querySelectorAll(a.identifiers.filterFieldset),t=0;t<e.length;t++)c.toggleClassForElement(e[t],a.identifiers.hideElement.substr(1));var i=document.querySelector(a.identifiers.showFilterButton),r=document.querySelector(a.identifiers.hideFilterButton);c.toggleClassForElement(i,a.identifiers.hideElement.substr(1)),c.toggleClassForElement(r,a.identifiers.hideElement.substr(1))},prepareCheckboxes:function(){for(var e=document.querySelectorAll(a.identifiers.filterContainer),t=0;t<e.length;t++){if(a.isFilterSet(e[t])){-1===a.filter.indexOf(e[t].parentNode.getAttribute("data-filtergroup"))&&a.filter.push(e[t].parentNode.getAttribute("data-filtergroup"));var i=e[t].querySelector(a.identifiers.filterCheckboxAll);i.checked=!1,i.disabled=!1}}},isFilterSet:function(e){for(var t=!1,i=e.querySelectorAll(a.identifiers.filterCheckbox),r=0;r<i.length;r++)i[r].checked&&(t=!0);return t}};return a});