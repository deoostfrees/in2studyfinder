define(["TYPO3/CMS/In2studyfinder/Utility/UiUtility","TYPO3/CMS/In2studyfinder/Utility/AjaxUtility","TYPO3/CMS/In2studyfinder/Utility/UrlUtility"],function(n,t,r){"use strict";var s={coursesList:[],identifiers:{checkAllCheckbox:".js-in2studyfinder-check-all",paginationContainer:".js-in2studyfinder-pagebrowser",itemsPerPageSelect:".js-in2studyfinder-itemsPerPage",changeLanguageSelect:".js-in2studyfinder-recordLanguage",courseListTableBody:".js-in2studyfinder-course-list",loader:".in2js-in2studyfinder-loader",loaderActive:".in2js-in2studyfinder-loader--active"},initialize:function(){s.preparePagination(),s.prepareSelectedCourses(),s.addEventListener()},addEventListener:function(){document.querySelector(s.identifiers.checkAllCheckbox).addEventListener("click",s.toggleAllCoursesSelect),document.querySelector(s.identifiers.paginationContainer).addEventListener("click",s.callPagination),document.querySelector(s.identifiers.itemsPerPageSelect).onchange=function(e){s.updateItemsPerPage(e)},document.querySelector(s.identifiers.changeLanguageSelect).onchange=function(e){s.updateRecordLanguage(e)},document.querySelector(s.identifiers.courseListTableBody).addEventListener("click",s.toggleCourseSelection)},toggleAllCoursesSelect:function(e){var t,i=document.querySelectorAll(".js-in2studyfinder-select-course");t=e.target.checked?1:0;for(var n=0;n<i.length;n++){var r=i[n],o=r.getAttribute("data-in2studyfinder-course-uid");0===t&&r.checked&&o&&s.removeCourseFromList(o),1!==t||r.checked||o&&s.addCourseToList(o),r.checked=t}s.updateSelectedCoursesCount()},prepareSelectedCourses:function(){if(0<s.coursesList.length)for(var e=0;e<s.coursesList.length;e++){var t=document.querySelector("#course-"+s.coursesList[e]);null!==t&&(t.checked=1)}},updateItemsPerPage:function(e){var t=e.target.selectedOptions[0].getAttribute("data-action");void 0!==t&&s.paginationAjaxCall(t)},updateRecordLanguage:function(e){var t=e.target.selectedOptions[0].getAttribute("data-action");void 0!==t&&s.resetCourseList()&&s.paginationAjaxCall(t)},callPagination:function(e){e.preventDefault();var t=e.target.href,i=document.querySelector(".js-in2studyfinder-itemsPerPage").value;void 0!==t&&(t=r.addAttributeToUrl(t,"tx_in2studyfinder_web_in2studyfinderm1[@widget_0][itemsPerPage]",i),s.paginationAjaxCall(t))},paginationAjaxCall:function(e){t.ajaxCall(e,s.onPaginationCallStart,s.onPaginationCallSuccess)},onPaginationCallStart:function(){n.toggleClassForElement(document.querySelector(s.identifiers.loader),s.identifiers.loaderActive)},onPaginationCallSuccess:function(e){var t=document.createElement("div"),i="js-in2studyfinder-select-course-container";t.innerHTML=e.responseText,document.querySelector("."+i).innerHTML=t.querySelector("."+i).innerHTML,s.initialize(),s.updateSelectedCoursesCount(),n.toggleClassForElement(document.querySelector(s.identifiers.loader),s.identifiers.loaderActive)},toggleCourseSelection:function(e){var t=e.target;t.classList.contains("js-in2studyfinder-select-course")&&(t.checked?s.addCourseToList(t.value):s.removeCourseFromList(t.value),s.updateSelectedCoursesCount())},addCourseToList:function(e){s.coursesList.push(e)},removeCourseFromList:function(e){s.coursesList.pop(e)},updateSelectedCoursesCount:function(){document.querySelector(".js-in2studyfinder-selected-courses-count").innerHTML=s.coursesList.length},getCourseList:function(){return s.coursesList},preparePagination:function(){var e=document.querySelector(s.identifiers.paginationContainer);document.querySelector(".js-in2studyfinder-pagination").appendChild(e)},resetCourseList:function(){var e=!0;return 0<s.coursesList.length&&(confirm("all currently selected courses will be deselected. Will you proceed?")?(s.coursesList=[],s.updateSelectedCoursesCount()):e=!1),e}};return s});