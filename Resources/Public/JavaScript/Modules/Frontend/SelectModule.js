define(["TYPO3/CMS/In2studyfinder/Vendor/select2","jquery"],function(e,f){"use strict";var r={identifiers:{select:".js-in2studyfinder-select2"},initialize:function(){this.updatePlaceholderLabel(),f(r.identifiers.select).select2({matcher:function(e,t){return e,r.matcher(e,t)},sorter:function(e){var t=e.slice(0);return t.sort(function(e,t){return e.text.toUpperCase()<t.text.toUpperCase()?-1:e.text.toUpperCase()>t.text.toUpperCase()?1:0}),t},allowClear:!1,placeholder:"select degree program or enter keyword",language:"de"}),this.redirectOnSelect()},matcher:function(e,r){if(""===f.trim(e.term))return r;var t=r.text.toUpperCase(),n=e.term.toUpperCase(),i=r.element,l=f(i).attr("alt"),a=!1;if(void 0!==l&&""!==l){var c=l.split(",");f.each(c,function(e,t){t=t.trim(),(-1<r.text.toUpperCase().indexOf(n.toUpperCase())||-1<t.toUpperCase().indexOf(n.toUpperCase()))&&(a=!0)})}if(-1<t.indexOf(n)||!0===a)return r;if(r.children&&0<r.children.length){for(var d=f.extend(!0,{},r),s=r.children.length-1;0<=s;s--){var o=r.children[s];null===this.matcher(e,o)&&d.children.splice(s,1)}return 0<d.children.length?d:this.matcher(e,d)}return null},redirectOnSelect:function(){f(r.identifiers.select).on("select2:select",function(){var e=f(r.identifiers.select).select2("data")[0].element.dataset.url;e.length&&(window.location.href=e)})},updatePlaceholderLabel:function(){"de"===f("html").attr("lang")?f(r.identifiers.select).attr("data-placeholder","Studiengang wählen oder Suchbegriff eingeben"):f(r.identifiers.select).attr("data-placeholder","Select degree program or enter keyword")}};return r});