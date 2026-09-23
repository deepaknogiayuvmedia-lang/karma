/*! jQuery v2.2.4 | (c) jQuery Foundation | jquery.org/license */
!function(a,b){"object"==typeof module&&"object"==typeof module.exports?module.exports=a.document?b(a,!0):function(a){if(!a.document)throw new Error("jQuery requires a window with a document");return b(a)}:b(a)}("undefined"!=typeof window?window:this,function(a,b){var c=[],d=a.document,e=c.slice,f=c.concat,g=c.push,h=c.indexOf,i={},j=i.toString,k=i.hasOwnProperty,l={},m="2.2.4",n=function(a,b){return new n.fn.init(a,b)},o=/^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g,p=/^-ms-/,q=/-([\da-z])/gi,r=function(a,b){return b.toUpperCase()};n.fn=n.prototype={jquery:m,constructor:n,selector:"",length:0,toArray:function(){return e.call(this)},get:function(a){return null!=a?0>a?this[a+this.length]:this[a]:e.call(this)},pushStack:function(a){var b=n.merge(this.constructor(),a);return b.prevObject=this,b.context=this.context,b},each:function(a){return n.each(this,a)},map:function(a){return this.pushStack(n.map(this,function(b,c){return a.call(b,c,b)}))},slice:function(){return this.pushStack(e.apply(this,arguments))},first:function(){return this.eq(0)},last:function(){return this.eq(-1)},eq:function(a){var b=this.length,c=+a+(0>a?b:0);return this.pushStack(c>=0&&b>c?[this[c]]:[])},end:function(){return this.prevObject||this.constructor()},push:g,sort:c.sort,splice:c.splice},n.extend=n.fn.extend=function(){var a,b,c,d,e,f,g=arguments[0]||{},h=1,i=arguments.length,j=!1;for("boolean"==typeof g&&(j=g,g=arguments[h]||{},h++),"object"==typeof g||n.isFunction(g)||(g={}),h===i&&(g=this,h--);i>h;h++)if(null!=(a=arguments[h]))for(b in a)c=g[b],d=a[b],g!==d&&(j&&d&&(n.isPlainObject(d)||(e=n.isArray(d)))?(e?(e=!1,f=c&&n.isArray(c)?c:[]):f=c&&n.isPlainObject(c)?c:{},g[b]=n.extend(j,f,d)):void 0!==d&&(g[b]=d));return g},n.extend({expando:"jQuery"+(m+Math.random()).replace(/\D/g,""),isReady:!0,error:function(a){throw new Error(a)},noop:function(){},isFunction:function(a){return"function"===n.type(a)},isArray:Array.isArray,isWindow:function(a){return null!=a&&a===a.window},isNumeric:function(a){var b=a&&a.toString();return!n.isArray(a)&&b-parseFloat(b)+1>=0},isPlainObject:function(a){var b;if("object"!==n.type(a)||a.nodeType||n.isWindow(a))return!1;if(a.constructor&&!k.call(a,"constructor")&&!k.call(a.constructor.prototype||{},"isPrototypeOf"))return!1;for(b in a);return void 0===b||k.call(a,b)},isEmptyObject:function(a){var b;for(b in a)return!1;return!0},type:function(a){return null==a?a+"":"object"==typeof a||"function"==typeof a?i[j.call(a)]||"object":typeof a},globalEval:function(a){var b,c=eval;a=n.trim(a),a&&(1===a.indexOf("use strict")?(b=d.createElement("script"),b.text=a,d.head.appendChild(b).parentNode.removeChild(b)):c(a))},camelCase:function(a){return a.replace(p,"ms-").replace(q,r)},nodeName:function(a,b){return a.nodeName&&a.nodeName.toLowerCase()===b.toLowerCase()},each:function(a,b){var c,d=0;if(s(a)){for(c=a.length;c>d;d++)if(b.call(a[d],d,a[d])===!1)break}else for(d in a)if(b.call(a[d],d,a[d])===!1)break;return a},trim:function(a){return null==a?"":(a+"").replace(o,"")},makeArray:function(a,b){var c=b||[];return null!=a&&(s(Object(a))?n.merge(c,"string"==typeof a?[a]:a):g.call(c,a)),c},inArray:function(a,b,c){return null==b?-1:h.call(b,a,c)},merge:function(a,b){for(var c=+b.length,d=0,e=a.length;c>d;d++)a[e++]=b[d];return a.length=e,a},grep:function(a,b,c){for(var d,e=[],f=0,g=a.length,h=!c;g>f;f++)d=!b(a[f],f),d!==h&&e.push(a[f]);return e},map:function(a,b,c){var d,e,g=0,h=[];if(s(a))for(d=a.length;d>g;g++)e=b(a[g],g,c),null!=e&&h.push(e);else for(g in a)e=b(a[g],g,c),null!=e&&h.push(e);return f.apply([],h)},guid:1,proxy:function(a,b){var c,d,f;return"string"==typeof b&&(c=a[b],b=a,a=c),n.isFunction(a)?(d=e.call(arguments,2),f=function(){return a.apply(b||this,d.concat(e.call(arguments)))},f.guid=a.guid=a.guid||n.guid++,f):void 0},now:Date.now,support:l}),"function"==typeof Symbol&&(n.fn[Symbol.iterator]=c[Symbol.iterator]),n.each("Boolean Number String Function Array Date RegExp Object Error Symbol".split(" "),function(a,b){i["[object "+b+"]"]=b.toLowerCase()});function s(a){var b=!!a&&"length"in a&&a.length,c=n.type(a);return"function"===c||n.isWindow(a)?!1:"array"===c||0===b||"number"==typeof b&&b>0&&b-1 in a}var t=function(a){var b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r,s,t,u="sizzle"+1*new Date,v=a.document,w=0,x=0,y=ga(),z=ga(),A=ga(),B=function(a,b){return a===b&&(l=!0),0},C=1<<31,D={}.hasOwnProperty,E=[],F=E.pop,G=E.push,H=E.push,I=E.slice,J=function(a,b){for(var c=0,d=a.length;d>c;c++)if(a[c]===b)return c;return-1},K="checked|selected|async|autofocus|autoplay|controls|defer|disabled|hidden|ismap|loop|multiple|open|readonly|required|scoped",L="[\\x20\\t\\r\\n\\f]",M="(?:\\\\.|[\\w-]|[^\\x00-\\xa0])+",N="\\["+L+"*("+M+")(?:"+L+"*([*^$|!~]?=)"+L+"*(?:'((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\"|("+M+"))|)"+L+"*\\]",O=":("+M+")(?:\\((('((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\")|((?:\\\\.|[^\\\\()[\\]]|"+N+")*)|.*)\\)|)",P=new RegExp(L+"+","g"),Q=new RegExp("^"+L+"+|((?:^|[^\\\\])(?:\\\\.)*)"+L+"+$","g"),R=new RegExp("^"+L+"*,"+L+"*"),S=new RegExp("^"+L+"*([>+~]|"+L+")"+L+"*"),T=new RegExp("="+L+"*([^\\]'\"]*?)"+L+"*\\]","g"),U=new RegExp(O),V=new RegExp("^"+M+"$"),W={ID:new RegExp("^#("+M+")"),CLASS:new RegExp("^\\.("+M+")"),TAG:new RegExp("^("+M+"|[*])"),ATTR:new RegExp("^"+N),PSEUDO:new RegExp("^"+O),CHILD:new RegExp("^:(only|first|last|nth|nth-last)-(child|of-type)(?:\\("+L+"*(even|odd|(([+-]|)(\\d*)n|)"+L+"*(?:([+-]|)"+L+"*(\\d+)|))"+L+"*\\)|)","i"),bool:new RegExp("^(?:"+K+")$","i"),needsContext:new RegExp("^"+L+"*[>+~]|:(even|odd|eq|gt|lt|nth|first|last)(?:\\("+L+"*((?:-\\d)?\\d*)"+L+"*\\)|)(?=[^-]|$)","i")},X=/^(?:input|select|textarea|button)$/i,Y=/^h\d$/i,Z=/^[^{]+\{\s*\[native \w/,$=/^(?:#([\w-]+)|(\w+)|\.([\w-]+))$/,_=/[+~]/,aa=/'|\\/g,ba=new RegExp("\\\\([\\da-f]{1,6}"+L+"?|("+L+")|.)","ig"),ca=function(a,b,c){var d="0x"+b-65536;return d!==d||c?b:0>d?String.fromCharCode(d+65536):String.fromCharCode(d>>10|55296,1023&d|56320)},da=function(){m()};try{H.apply(E=I.call(v.childNodes),v.childNodes),E[v.childNodes.length].nodeType}catch(ea){H={apply:E.length?function(a,b){G.apply(a,I.call(b))}:function(a,b){var c=a.length,d=0;while(a[c++]=b[d++]);a.length=c-1}}}function fa(a,b,d,e){var f,h,j,k,l,o,r,s,w=b&&b.ownerDocument,x=b?b.nodeType:9;if(d=d||[],"string"!=typeof a||!a||1!==x&&9!==x&&11!==x)return d;if(!e&&((b?b.ownerDocument||b:v)!==n&&m(b),b=b||n,p)){if(11!==x&&(o=$.exec(a)))if(f=o[1]){if(9===x){if(!(j=b.getElementById(f)))return d;if(j.id===f)return d.push(j),d}else if(w&&(j=w.getElementById(f))&&t(b,j)&&j.id===f)return d.push(j),d}else{if(o[2])return H.apply(d,b.getElementsByTagName(a)),d;if((f=o[3])&&c.getElementsByClassName&&b.getElementsByClassName)return H.apply(d,b.getElementsByClassName(f)),d}if(c.qsa&&!A[a+" "]&&(!q||!q.test(a))){if(1!==x)w=b,s=a;else if("object"!==b.nodeName.toLowerCase()){(k=b.getAttribute("id"))?k=k.replace(aa,"\\$&"):b.setAttribute("id",k=u),r=g(a),h=r.length,l=V.test(k)?"#"+k:"[id='"+k+"']";while(h--)r[h]=l+" "+qa(r[h]);s=r.join(","),w=_.test(a)&&oa(b.parentNode)||b}if(s)try{return H.apply(d,w.querySelectorAll(s)),d}catch(y){}finally{k===u&&b.removeAttribute("id")}}}return i(a.replace(Q,"$1"),b,d,e)}function ga(){var a=[];function b(c,e){return a.push(c+" ")>d.cacheLength&&delete b[a.shift()],b[c+" "]=e}return b}function ha(a){return a[u]=!0,a}function ia(a){var b=n.createElement("div");try{return!!a(b)}catch(c){return!1}finally{b.parentNode&&b.parentNode.removeChild(b),b=null}}function ja(a,b){var c=a.split("|"),e=c.length;while(e--)d.attrHandle[c[e]]=b}function ka(a,b){var c=b&&a,d=c&&1===a.nodeType&&1===b.nodeType&&(~b.sourceIndex||C)-(~a.sourceIndex||C);if(d)return d;if(c)while(c=c.nextSibling)if(c===b)return-1;return a?1:-1}function la(a){return function(b){var c=b.nodeName.toLowerCase();return"input"===c&&b.type===a}}function ma(a){return function(b){var c=b.nodeName.toLowerCase();return("input"===c||"button"===c)&&b.type===a}}function na(a){return ha(function(b){return b=+b,ha(function(c,d){var e,f=a([],c.length,b),g=f.length;while(g--)c[e=f[g]]&&(c[e]=!(d[e]=c[e]))})})}function oa(a){return a&&"undefined"!=typeof a.getElementsByTagName&&a}c=fa.support={},f=fa.isXML=function(a){var b=a&&(a.ownerDocument||a).documentElement;return b?"HTML"!==b.nodeName:!1},m=fa.setDocument=function(a){var b,e,g=a?a.ownerDocument||a:v;return g!==n&&9===g.nodeType&&g.documentElement?(n=g,o=n.documentElement,p=!f(n),(e=n.defaultView)&&e.top!==e&&(e.addEventListener?e.addEventListener("unload",da,!1):e.attachEvent&&e.attachEvent("onunload",da)),c.attributes=ia(function(a){return a.className="i",!a.getAttribute("className")}),c.getElementsByTagName=ia(function(a){return a.appendChild(n.createComment("")),!a.getElementsByTagName("*").length}),c.getElementsByClassName=Z.test(n.getElementsByClassName),c.getById=ia(function(a){return o.appendChild(a).id=u,!n.getElementsByName||!n.getElementsByName(u).length}),c.getById?(d.find.ID=function(a,b){if("undefined"!=typeof b.getElementById&&p){var c=b.getElementById(a);return c?[c]:[]}},d.filter.ID=function(a){var b=a.replace(ba,ca);return function(a){return a.getAttribute("id")===b}}):(delete d.find.ID,d.filter.ID=function(a){var b=a.replace(ba,ca);return function(a){var c="undefined"!=typeof a.getAttributeNode&&a.getAttributeNode("id");return c&&c.value===b}}),d.find.TAG=c.getElementsByTagName?function(a,b){return"undefined"!=typeof b.getElementsByTagName?b.getElementsByTagName(a):c.qsa?b.querySelectorAll(a):void 0}:function(a,b){var c,d=[],e=0,f=b.getElementsByTagName(a);if("*"===a){while(c=f[e++])1===c.nodeType&&d.push(c);return d}return f},d.find.CLASS=c.getElementsByClassName&&function(a,b){return"undefined"!=typeof b.getElementsByClassName&&p?b.getElementsByClassName(a):void 0},r=[],q=[],(c.qsa=Z.test(n.querySelectorAll))&&(ia(function(a){o.appendChild(a).innerHTML="<a id='"+u+"'></a><select id='"+u+"-\r\\' msallowcapture=''><option selected=''></option></select>",a.querySelectorAll("[msallowcapture^='']").length&&q.push("[*^$]="+L+"*(?:''|\"\")"),a.querySelectorAll("[selected]").length||q.push("\\["+L+"*(?:value|"+K+")"),a.querySelectorAll("[id~="+u+"-]").length||q.push("~="),a.querySelectorAll(":checked").length||q.push(":checked"),a.querySelectorAll("a#"+u+"+*").length||q.push(".#.+[+~]")}),ia(function(a){var b=n.createElement("input");b.setAttribute("type","hidden"),a.appendChild(b).setAttribute("name","D"),a.querySelectorAll("[name=d]").length&&q.push("name"+L+"*[*^$|!~]?="),a.querySelectorAll(":enabled").length||q.push(":enabled",":disabled"),a.querySelectorAll("*,:x"),q.push(",.*:")})),(c.matchesSelector=Z.test(s=o.matches||o.webkitMatchesSelector||o.mozMatchesSelector||o.oMatchesSelector||o.msMatchesSelector))&&ia(function(a){c.disconnectedMatch=s.call(a,"div"),s.call(a,"[s!='']:x"),r.push("!=",O)}),q=q.length&&new RegExp(q.join("|")),r=r.length&&new RegExp(r.join("|")),b=Z.test(o.compareDocumentPosition),t=b||Z.test(o.contains)?function(a,b){var c=9===a.nodeType?a.documentElement:a,d=b&&b.parentNode;return a===d||!(!d||1!==d.nodeType||!(c.contains?c.contains(d):a.compareDocumentPosition&&16&a.compareDocumentPosition(d)))}:function(a,b){if(b)while(b=b.parentNode)if(b===a)return!0;return!1},B=b?function(a,b){if(a===b)return l=!0,0;var d=!a.compareDocumentPosition-!b.compareDocumentPosition;return d?d:(d=(a.ownerDocument||a)===(b.ownerDocument||b)?a.compareDocumentPosition(b):1,1&d||!c.sortDetached&&b.compareDocumentPosition(a)===d?a===n||a.ownerDocument===v&&t(v,a)?-1:b===n||b.ownerDocument===v&&t(v,b)?1:k?J(k,a)-J(k,b):0:4&d?-1:1)}:function(a,b){if(a===b)return l=!0,0;var c,d=0,e=a.parentNode,f=b.parentNode,g=[a],h=[b];if(!e||!f)return a===n?-1:b===n?1:e?-1:f?1:k?J(k,a)-J(k,b):0;if(e===f)return ka(a,b);c=a;while(c=c.parentNode)g.unshift(c);c=b;while(c=c.parentNode)h.unshift(c);while(g[d]===h[d])d++;return d?ka(g[d],h[d]):g[d]===v?-1:h[d]===v?1:0},n):n},fa.matches=function(a,b){return fa(a,null,null,b)},fa.matchesSelector=function(a,b){if((a.ownerDocument||a)!==n&&m(a),b=b.replace(T,"='$1']"),c.matchesSelector&&p&&!A[b+" "]&&(!r||!r.test(b))&&(!q||!q.test(b)))try{var d=s.call(a,b);if(d||c.disconnectedMatch||a.document&&11!==a.document.nodeType)return d}catch(e){}return fa(b,n,null,[a]).length>0},fa.contains=function(a,b){return(a.ownerDocument||a)!==n&&m(a),t(a,b)},fa.attr=function(a,b){(a.ownerDocument||a)!==n&&m(a);var e=d.attrHandle[b.toLowerCase()],f=e&&D.call(d.attrHandle,b.toLowerCase())?e(a,b,!p):void 0;return void 0!==f?f:c.attributes||!p?a.getAttribute(b):(f=a.getAttributeNode(b))&&f.specified?f.value:null},fa.error=function(a){throw new Error("Syntax error, unrecognized expression: "+a)},fa.uniqueSort=function(a){var b,d=[],e=0,f=0;if(l=!c.detectDuplicates,k=!c.sortStable&&a.slice(0),a.sort(B),l){while(b=a[f++])b===a[f]&&(e=d.push(f));while(e--)a.splice(d[e],1)}return k=null,a},e=fa.getText=function(a){var b,c="",d=0,f=a.nodeType;if(f){if(1===f||9===f||11===f){if("string"==typeof a.textContent)return a.textContent;for(a=a.firstChild;a;a=a.nextSibling)c+=e(a)}else if(3===f||4===f)return a.nodeValue}else while(b=a[d++])c+=e(b);return c},d=fa.selectors={cacheLength:50,createPseudo:ha,match:W,attrHandle:{},find:{},relative:{">":{dir:"parentNode",first:!0}," ":{dir:"parentNode"},"+":{dir:"previousSibling",first:!0},"~":{dir:"previousSibling"}},preFilter:{ATTR:function(a){return a[1]=a[1].replace(ba,ca),a[3]=(a[3]||a[4]||a[5]||"").replace(ba,ca),"~="===a[2]&&(a[3]=" "+a[3]+" "),a.slice(0,4)},CHILD:function(a){return a[1]=a[1].toLowerCase(),"nth"===a[1].slice(0,3)?(a[3]||fa.error(a[0]),a[4]=+(a[4]?a[5]+(a[6]||1):2*("even"===a[3]||"odd"===a[3])),a[5]=+(a[7]+a[8]||"odd"===a[3])):a[3]&&fa.error(a[0]),a},PSEUDO:function(a){var b,c=!a[6]&&a[2];return W.CHILD.test(a[0])?null:(a[3]?a[2]=a[4]||a[5]||"":c&&U.test(c)&&(b=g(c,!0))&&(b=c.indexOf(")",c.length-b)-c.length)&&(a[0]=a[0].slice(0,b),a[2]=c.slice(0,b)),a.slice(0,3))}},filter:{TAG:function(a){var b=a.replace(ba,ca).toLowerCase();return"*"===a?function(){return!0}:function(a){return a.nodeName&&a.nodeName.toLowerCase()===b}},CLASS:function(a){var b=y[a+" "];return b||(b=new RegExp("(^|"+L+")"+a+"("+L+"|$)"))&&y(a,function(a){return b.test("string"==typeof a.className&&a.className||"undefined"!=typeof a.getAttribute&&a.getAttribute("class")||"")})},ATTR:function(a,b,c){return function(d){var e=fa.attr(d,a);return null==e?"!="===b:b?(e+="","="===b?e===c:"!="===b?e!==c:"^="===b?c&&0===e.indexOf(c):"*="===b?c&&e.indexOf(c)>-1:"$="===b?c&&e.slice(-c.length)===c:"~="===b?(" "+e.replace(P," ")+" ").indexOf(c)>-1:"|="===b?e===c||e.slice(0,c.length+1)===c+"-":!1):!0}},CHILD:function(a,b,c,d,e){var f="nth"!==a.slice(0,3),g="last"!==a.slice(-4),h="of-type"===b;return 1===d&&0===e?function(a){return!!a.parentNode}:function(b,c,i){var j,k,l,m,n,o,p=f!==g?"nextSibling":"previousSibling",q=b.parentNode,r=h&&b.nodeName.toLowerCase(),s=!i&&!h,t=!1;if(q){if(f){while(p){m=b;while(m=m[p])if(h?m.nodeName.toLowerCase()===r:1===m.nodeType)return!1;o=p="only"===a&&!o&&"nextSibling"}return!0}if(o=[g?q.firstChild:q.lastChild],g&&s){m=q,l=m[u]||(m[u]={}),k=l[m.uniqueID]||(l[m.uniqueID]={}),j=k[a]||[],n=j[0]===w&&j[1],t=n&&j[2],m=n&&q.childNodes[n];while(m=++n&&m&&m[p]||(t=n=0)||o.pop())if(1===m.nodeType&&++t&&m===b){k[a]=[w,n,t];break}}else if(s&&(m=b,l=m[u]||(m[u]={}),k=l[m.uniqueID]||(l[m.uniqueID]={}),j=k[a]||[],n=j[0]===w&&j[1],t=n),t===!1)while(m=++n&&m&&m[p]||(t=n=0)||o.pop())if((h?m.nodeName.toLowerCase()===r:1===m.nodeType)&&++t&&(s&&(l=m[u]||(m[u]={}),k=l[m.uniqueID]||(l[m.uniqueID]={}),k[a]=[w,t]),m===b))break;return t-=e,t===d||t%d===0&&t/d>=0}}},PSEUDO:function(a,b){var c,e=d.pseudos[a]||d.setFilters[a.toLowerCase()]||fa.error("unsupported pseudo: "+a);return e[u]?e(b):e.length>1?(c=[a,a,"",b],d.setFilters.hasOwnProperty(a.toLowerCase())?ha(function(a,c){var d,f=e(a,b),g=f.length;while(g--)d=J(a,f[g]),a[d]=!(c[d]=f[g])}):function(a){return e(a,0,c)}):e}},pseudos:{not:ha(function(a){var b=[],c=[],d=h(a.replace(Q,"$1"));return d[u]?ha(function(a,b,c,e){var f,g=d(a,null,e,[]),h=a.length;while(h--)(f=g[h])&&(a[h]=!(b[h]=f))}):function(a,e,f){return b[0]=a,d(b,null,f,c),b[0]=null,!c.pop()}}),has:ha(function(a){return function(b){return fa(a,b).length>0}}),contains:ha(function(a){return a=a.replace(ba,ca),function(b){return(b.textContent||b.innerText||e(b)).indexOf(a)>-1}}),lang:ha(function(a){return V.test(a||"")||fa.error("unsupported lang: "+a),a=a.replace(ba,ca).toLowerCase(),function(b){var c;do if(c=p?b.lang:b.getAttribute("xml:lang")||b.getAttribute("lang"))return c=c.toLowerCase(),c===a||0===c.indexOf(a+"-");while((b=b.parentNode)&&1===b.nodeType);return!1}}),target:function(b){var c=a.location&&a.location.hash;return c&&c.slice(1)===b.id},root:function(a){return a===o},focus:function(a){return a===n.activeElement&&(!n.hasFocus||n.hasFocus())&&!!(a.type||a.href||~a.tabIndex)},enabled:function(a){return a.disabled===!1},disabled:function(a){return a.disabled===!0},checked:function(a){var b=a.nodeName.toLowerCase();return"input"===b&&!!a.checked||"option"===b&&!!a.selected},selected:function(a){return a.parentNode&&a.parentNode.selectedIndex,a.selected===!0},empty:function(a){for(a=a.firstChild;a;a=a.nextSibling)if(a.nodeType<6)return!1;return!0},parent:function(a){return!d.pseudos.empty(a)},header:function(a){return Y.test(a.nodeName)},input:function(a){return X.test(a.nodeName)},button:function(a){var b=a.nodeName.toLowerCase();return"input"===b&&"button"===a.type||"button"===b},text:function(a){var b;return"input"===a.nodeName.toLowerCase()&&"text"===a.type&&(null==(b=a.getAttribute("type"))||"text"===b.toLowerCase())},first:na(function(){return[0]}),last:na(function(a,b){return[b-1]}),eq:na(function(a,b,c){return[0>c?c+b:c]}),even:na(function(a,b){for(var c=0;b>c;c+=2)a.push(c);return a}),odd:na(function(a,b){for(var c=1;b>c;c+=2)a.push(c);return a}),lt:na(function(a,b,c){for(var d=0>c?c+b:c;--d>=0;)a.push(d);return a}),gt:na(function(a,b,c){for(var d=0>c?c+b:c;++d<b;)a.push(d);return a})}},d.pseudos.nth=d.pseudos.eq;for(b in{radio:!0,checkbox:!0,file:!0,password:!0,image:!0})d.pseudos[b]=la(b);for(b in{submit:!0,reset:!0})d.pseudos[b]=ma(b);function pa(){}pa.prototype=d.filters=d.pseudos,d.setFilters=new pa,g=fa.tokenize=function(a,b){var c,e,f,g,h,i,j,k=z[a+" "];if(k)return b?0:k.slice(0);h=a,i=[],j=d.preFilter;while(h){c&&!(e=R.exec(h))||(e&&(h=h.slice(e[0].length)||h),i.push(f=[])),c=!1,(e=S.exec(h))&&(c=e.shift(),f.push({value:c,type:e[0].replace(Q," ")}),h=h.slice(c.length));for(g in d.filter)!(e=W[g].exec(h))||j[g]&&!(e=j[g](e))||(c=e.shift(),f.push({value:c,type:g,matches:e}),h=h.slice(c.length));if(!c)break}return b?h.length:h?fa.error(a):z(a,i).slice(0)};function qa(a){for(var b=0,c=a.length,d="";c>b;b++)d+=a[b].value;return d}function ra(a,b,c){var d=b.dir,e=c&&"parentNode"===d,f=x++;return b.first?function(b,c,f){while(b=b[d])if(1===b.nodeType||e)return a(b,c,f)}:function(b,c,g){var h,i,j,k=[w,f];if(g){while(b=b[d])if((1===b.nodeType||e)&&a(b,c,g))return!0}else while(b=b[d])if(1===b.nodeType||e){if(j=b[u]||(b[u]={}),i=j[b.uniqueID]||(j[b.uniqueID]={}),(h=i[d])&&h[0]===w&&h[1]===f)return k[2]=h[2];if(i[d]=k,k[2]=a(b,c,g))return!0}}}function sa(a){return a.length>1?function(b,c,d){var e=a.length;while(e--)if(!a[e](b,c,d))return!1;return!0}:a[0]}function ta(a,b,c){for(var d=0,e=b.length;e>d;d++)fa(a,b[d],c);return c}function ua(a,b,c,d,e){for(var f,g=[],h=0,i=a.length,j=null!=b;i>h;h++)(f=a[h])&&(c&&!c(f,d,e)||(g.push(f),j&&b.push(h)));return g}function va(a,b,c,d,e,f){return d&&!d[u]&&(d=va(d)),e&&!e[u]&&(e=va(e,f)),ha(function(f,g,h,i){var j,k,l,m=[],n=[],o=g.length,p=f||ta(b||"*",h.nodeType?[h]:h,[]),q=!a||!f&&b?p:ua(p,m,a,h,i),r=c?e||(f?a:o||d)?[]:g:q;if(c&&c(q,r,h,i),d){j=ua(r,n),d(j,[],h,i),k=j.length;while(k--)(l=j[k])&&(r[n[k]]=!(q[n[k]]=l))}if(f){if(e||a){if(e){j=[],k=r.length;while(k--)(l=r[k])&&j.push(q[k]=l);e(null,r=[],j,i)}k=r.length;while(k--)(l=r[k])&&(j=e?J(f,l):m[k])>-1&&(f[j]=!(g[j]=l))}}else r=ua(r===g?r.splice(o,r.length):r),e?e(null,g,r,i):H.apply(g,r)})}function wa(a){for(var b,c,e,f=a.length,g=d.relative[a[0].type],h=g||d.relative[" "],i=g?1:0,k=ra(function(a){return a===b},h,!0),l=ra(function(a){return J(b,a)>-1},h,!0),m=[function(a,c,d){var e=!g&&(d||c!==j)||((b=c).nodeType?k(a,c,d):l(a,c,d));return b=null,e}];f>i;i++)if(c=d.relative[a[i].type])m=[ra(sa(m),c)];else{if(c=d.filter[a[i].type].apply(null,a[i].matches),c[u]){for(e=++i;f>e;e++)if(d.relative[a[e].type])break;return va(i>1&&sa(m),i>1&&qa(a.slice(0,i-1).concat({value:" "===a[i-2].type?"*":""})).replace(Q,"$1"),c,e>i&&wa(a.slice(i,e)),f>e&&wa(a=a.slice(e)),f>e&&qa(a))}m.push(c)}return sa(m)}function xa(a,b){var c=b.length>0,e=a.length>0,f=function(f,g,h,i,k){var l,o,q,r=0,s="0",t=f&&[],u=[],v=j,x=f||e&&d.find.TAG("*",k),y=w+=null==v?1:Math.random()||.1,z=x.length;for(k&&(j=g===n||g||k);s!==z&&null!=(l=x[s]);s++){if(e&&l){o=0,g||l.ownerDocument===n||(m(l),h=!p);while(q=a[o++])if(q(l,g||n,h)){i.push(l);break}k&&(w=y)}c&&((l=!q&&l)&&r--,f&&t.push(l))}if(r+=s,c&&s!==r){o=0;while(q=b[o++])q(t,u,g,h);if(f){if(r>0)while(s--)t[s]||u[s]||(u[s]=F.call(i));u=ua(u)}H.apply(i,u),k&&!f&&u.length>0&&r+b.length>1&&fa.uniqueSort(i)}return k&&(w=y,j=v),t};return c?ha(f):f}return h=fa.compile=function(a,b){var c,d=[],e=[],f=A[a+" "];if(!f){b||(b=g(a)),c=b.length;while(c--)f=wa(b[c]),f[u]?d.push(f):e.push(f);f=A(a,xa(e,d)),f.selector=a}return f},i=fa.select=function(a,b,e,f){var i,j,k,l,m,n="function"==typeof a&&a,o=!f&&g(a=n.selector||a);if(e=e||[],1===o.length){if(j=o[0]=o[0].slice(0),j.length>2&&"ID"===(k=j[0]).type&&c.getById&&9===b.nodeType&&p&&d.relative[j[1].type]){if(b=(d.find.ID(k.matches[0].replace(ba,ca),b)||[])[0],!b)return e;n&&(b=b.parentNode),a=a.slice(j.shift().value.length)}i=W.needsContext.test(a)?0:j.length;while(i--){if(k=j[i],d.relative[l=k.type])break;if((m=d.find[l])&&(f=m(k.matches[0].replace(ba,ca),_.test(j[0].type)&&oa(b.parentNode)||b))){if(j.splice(i,1),a=f.length&&qa(j),!a)return H.apply(e,f),e;break}}}return(n||h(a,o))(f,b,!p,e,!b||_.test(a)&&oa(b.parentNode)||b),e},c.sortStable=u.split("").sort(B).join("")===u,c.detectDuplicates=!!l,m(),c.sortDetached=ia(function(a){return 1&a.compareDocumentPosition(n.createElement("div"))}),ia(function(a){return a.innerHTML="<a href='#'></a>","#"===a.firstChild.getAttribute("href")})||ja("type|href|height|width",function(a,b,c){return c?void 0:a.getAttribute(b,"type"===b.toLowerCase()?1:2)}),c.attributes&&ia(function(a){return a.innerHTML="<input/>",a.firstChild.setAttribute("value",""),""===a.firstChild.getAttribute("value")})||ja("value",function(a,b,c){return c||"input"!==a.nodeName.toLowerCase()?void 0:a.defaultValue}),ia(function(a){return null==a.getAttribute("disabled")})||ja(K,function(a,b,c){var d;return c?void 0:a[b]===!0?b.toLowerCase():(d=a.getAttributeNode(b))&&d.specified?d.value:null}),fa}(a);n.find=t,n.expr=t.selectors,n.expr[":"]=n.expr.pseudos,n.uniqueSort=n.unique=t.uniqueSort,n.text=t.getText,n.isXMLDoc=t.isXML,n.contains=t.contains;var u=function(a,b,c){var d=[],e=void 0!==c;while((a=a[b])&&9!==a.nodeType)if(1===a.nodeType){if(e&&n(a).is(c))break;d.push(a)}return d},v=function(a,b){for(var c=[];a;a=a.nextSibling)1===a.nodeType&&a!==b&&c.push(a);return c},w=n.expr.match.needsContext,x=/^<([\w-]+)\s*\/?>(?:<\/\1>|)$/,y=/^.[^:#\[\.,]*$/;function z(a,b,c){if(n.isFunction(b))return n.grep(a,function(a,d){return!!b.call(a,d,a)!==c});if(b.nodeType)return n.grep(a,function(a){return a===b!==c});if("string"==typeof b){if(y.test(b))return n.filter(b,a,c);b=n.filter(b,a)}return n.grep(a,function(a){return h.call(b,a)>-1!==c})}n.filter=function(a,b,c){var d=b[0];return c&&(a=":not("+a+")"),1===b.length&&1===d.nodeType?n.find.matchesSelector(d,a)?[d]:[]:n.find.matches(a,n.grep(b,function(a){return 1===a.nodeType}))},n.fn.extend({find:function(a){var b,c=this.length,d=[],e=this;if("string"!=typeof a)return this.pushStack(n(a).filter(function(){for(b=0;c>b;b++)if(n.contains(e[b],this))return!0}));for(b=0;c>b;b++)n.find(a,e[b],d);return d=this.pushStack(c>1?n.unique(d):d),d.selector=this.selector?this.selector+" "+a:a,d},filter:function(a){return this.pushStack(z(this,a||[],!1))},not:function(a){return this.pushStack(z(this,a||[],!0))},is:function(a){return!!z(this,"string"==typeof a&&w.test(a)?n(a):a||[],!1).length}});var A,B=/^(?:\s*(<[\w\W]+>)[^>]*|#([\w-]*))$/,C=n.fn.init=function(a,b,c){var e,f;if(!a)return this;if(c=c||A,"string"==typeof a){if(e="<"===a[0]&&">"===a[a.length-1]&&a.length>=3?[null,a,null]:B.exec(a),!e||!e[1]&&b)return!b||b.jquery?(b||c).find(a):this.constructor(b).find(a);if(e[1]){if(b=b instanceof n?b[0]:b,n.merge(this,n.parseHTML(e[1],b&&b.nodeType?b.ownerDocument||b:d,!0)),x.test(e[1])&&n.isPlainObject(b))for(e in b)n.isFunction(this[e])?this[e](b[e]):this.attr(e,b[e]);return this}return f=d.getElementById(e[2]),f&&f.parentNode&&(this.length=1,this[0]=f),this.context=d,this.selector=a,this}return a.nodeType?(this.context=this[0]=a,this.length=1,this):n.isFunction(a)?void 0!==c.ready?c.ready(a):a(n):(void 0!==a.selector&&(this.selector=a.selector,this.context=a.context),n.makeArray(a,this))};C.prototype=n.fn,A=n(d);var D=/^(?:parents|prev(?:Until|All))/,E={children:!0,contents:!0,next:!0,prev:!0};n.fn.extend({has:function(a){var b=n(a,this),c=b.length;return this.filter(function(){for(var a=0;c>a;a++)if(n.contains(this,b[a]))return!0})},closest:function(a,b){for(var c,d=0,e=this.length,f=[],g=w.test(a)||"string"!=typeof a?n(a,b||this.context):0;e>d;d++)for(c=this[d];c&&c!==b;c=c.parentNode)if(c.nodeType<11&&(g?g.index(c)>-1:1===c.nodeType&&n.find.matchesSelector(c,a))){f.push(c);break}return this.pushStack(f.length>1?n.uniqueSort(f):f)},index:function(a){return a?"string"==typeof a?h.call(n(a),this[0]):h.call(this,a.jquery?a[0]:a):this[0]&&this[0].parentNode?this.first().prevAll().length:-1},add:function(a,b){return this.pushStack(n.uniqueSort(n.merge(this.get(),n(a,b))))},addBack:function(a){return this.add(null==a?this.prevObject:this.prevObject.filter(a))}});function F(a,b){while((a=a[b])&&1!==a.nodeType);return a}n.each({parent:function(a){var b=a.parentNode;return b&&11!==b.nodeType?b:null},parents:function(a){return u(a,"parentNode")},parentsUntil:function(a,b,c){return u(a,"parentNode",c)},next:function(a){return F(a,"nextSibling")},prev:function(a){return F(a,"previousSibling")},nextAll:function(a){return u(a,"nextSibling")},prevAll:function(a){return u(a,"previousSibling")},nextUntil:function(a,b,c){return u(a,"nextSibling",c)},prevUntil:function(a,b,c){return u(a,"previousSibling",c)},siblings:function(a){return v((a.parentNode||{}).firstChild,a)},children:function(a){return v(a.firstChild)},contents:function(a){return a.contentDocument||n.merge([],a.childNodes)}},function(a,b){n.fn[a]=function(c,d){var e=n.map(this,b,c);return"Until"!==a.slice(-5)&&(d=c),d&&"string"==typeof d&&(e=n.filter(d,e)),this.length>1&&(E[a]||n.uniqueSort(e),D.test(a)&&e.reverse()),this.pushStack(e)}});var G=/\S+/g;function H(a){var b={};return n.each(a.match(G)||[],function(a,c){b[c]=!0}),b}n.Callbacks=function(a){a="string"==typeof a?H(a):n.extend({},a);var b,c,d,e,f=[],g=[],h=-1,i=function(){for(e=a.once,d=b=!0;g.length;h=-1){c=g.shift();while(++h<f.length)f[h].apply(c[0],c[1])===!1&&a.stopOnFalse&&(h=f.length,c=!1)}a.memory||(c=!1),b=!1,e&&(f=c?[]:"")},j={add:function(){return f&&(c&&!b&&(h=f.length-1,g.push(c)),function d(b){n.each(b,function(b,c){n.isFunction(c)?a.unique&&j.has(c)||f.push(c):c&&c.length&&"string"!==n.type(c)&&d(c)})}(arguments),c&&!b&&i()),this},remove:function(){return n.each(arguments,function(a,b){var c;while((c=n.inArray(b,f,c))>-1)f.splice(c,1),h>=c&&h--}),this},has:function(a){return a?n.inArray(a,f)>-1:f.length>0},empty:function(){return f&&(f=[]),this},disable:function(){return e=g=[],f=c="",this},disabled:function(){return!f},lock:function(){return e=g=[],c||(f=c=""),this},locked:function(){return!!e},fireWith:function(a,c){return e||(c=c||[],c=[a,c.slice?c.slice():c],g.push(c),b||i()),this},fire:function(){return j.fireWith(this,arguments),this},fired:function(){return!!d}};return j},n.extend({Deferred:function(a){var b=[["resolve","done",n.Callbacks("once memory"),"resolved"],["reject","fail",n.Callbacks("once memory"),"rejected"],["notify","progress",n.Callbacks("memory")]],c="pending",d={state:function(){return c},always:function(){return e.done(arguments).fail(arguments),this},then:function(){var a=arguments;return n.Deferred(function(c){n.each(b,function(b,f){var g=n.isFunction(a[b])&&a[b];e[f[1]](function(){var a=g&&g.apply(this,arguments);a&&n.isFunction(a.promise)?a.promise().progress(c.notify).done(c.resolve).fail(c.reject):c[f[0]+"With"](this===d?c.promise():this,g?[a]:arguments)})}),a=null}).promise()},promise:function(a){return null!=a?n.extend(a,d):d}},e={};return d.pipe=d.then,n.each(b,function(a,f){var g=f[2],h=f[3];d[f[1]]=g.add,h&&g.add(function(){c=h},b[1^a][2].disable,b[2][2].lock),e[f[0]]=function(){return e[f[0]+"With"](this===e?d:this,arguments),this},e[f[0]+"With"]=g.fireWith}),d.promise(e),a&&a.call(e,e),e},when:function(a){var b=0,c=e.call(arguments),d=c.length,f=1!==d||a&&n.isFunction(a.promise)?d:0,g=1===f?a:n.Deferred(),h=function(a,b,c){return function(d){b[a]=this,c[a]=arguments.length>1?e.call(arguments):d,c===i?g.notifyWith(b,c):--f||g.resolveWith(b,c)}},i,j,k;if(d>1)for(i=new Array(d),j=new Array(d),k=new Array(d);d>b;b++)c[b]&&n.isFunction(c[b].promise)?c[b].promise().progress(h(b,j,i)).done(h(b,k,c)).fail(g.reject):--f;return f||g.resolveWith(k,c),g.promise()}});var I;n.fn.ready=function(a){return n.ready.promise().done(a),this},n.extend({isReady:!1,readyWait:1,holdReady:function(a){a?n.readyWait++:n.ready(!0)},ready:function(a){(a===!0?--n.readyWait:n.isReady)||(n.isReady=!0,a!==!0&&--n.readyWait>0||(I.resolveWith(d,[n]),n.fn.triggerHandler&&(n(d).triggerHandler("ready"),n(d).off("ready"))))}});function J(){d.removeEventListener("DOMContentLoaded",J),a.removeEventListener("load",J),n.ready()}n.ready.promise=function(b){return I||(I=n.Deferred(),"complete"===d.readyState||"loading"!==d.readyState&&!d.documentElement.doScroll?a.setTimeout(n.ready):(d.addEventListener("DOMContentLoaded",J),a.addEventListener("load",J))),I.promise(b)},n.ready.promise();var K=function(a,b,c,d,e,f,g){var h=0,i=a.length,j=null==c;if("object"===n.type(c)){e=!0;for(h in c)K(a,b,h,c[h],!0,f,g)}else if(void 0!==d&&(e=!0,n.isFunction(d)||(g=!0),j&&(g?(b.call(a,d),b=null):(j=b,b=function(a,b,c){return j.call(n(a),c)})),b))for(;i>h;h++)b(a[h],c,g?d:d.call(a[h],h,b(a[h],c)));return e?a:j?b.call(a):i?b(a[0],c):f},L=function(a){return 1===a.nodeType||9===a.nodeType||!+a.nodeType};function M(){this.expando=n.expando+M.uid++}M.uid=1,M.prototype={register:function(a,b){var c=b||{};return a.nodeType?a[this.expando]=c:Object.defineProperty(a,this.expando,{value:c,writable:!0,configurable:!0}),a[this.expando]},cache:function(a){if(!L(a))return{};var b=a[this.expando];return b||(b={},L(a)&&(a.nodeType?a[this.expando]=b:Object.defineProperty(a,this.expando,{value:b,configurable:!0}))),b},set:function(a,b,c){var d,e=this.cache(a);if("string"==typeof b)e[b]=c;else for(d in b)e[d]=b[d];return e},get:function(a,b){return void 0===b?this.cache(a):a[this.expando]&&a[this.expando][b]},access:function(a,b,c){var d;return void 0===b||b&&"string"==typeof b&&void 0===c?(d=this.get(a,b),void 0!==d?d:this.get(a,n.camelCase(b))):(this.set(a,b,c),void 0!==c?c:b)},remove:function(a,b){var c,d,e,f=a[this.expando];if(void 0!==f){if(void 0===b)this.register(a);else{n.isArray(b)?d=b.concat(b.map(n.camelCase)):(e=n.camelCase(b),b in f?d=[b,e]:(d=e,d=d in f?[d]:d.match(G)||[])),c=d.length;while(c--)delete f[d[c]]}(void 0===b||n.isEmptyObject(f))&&(a.nodeType?a[this.expando]=void 0:delete a[this.expando])}},hasData:function(a){var b=a[this.expando];return void 0!==b&&!n.isEmptyObject(b)}};var N=new M,O=new M,P=/^(?:\{[\w\W]*\}|\[[\w\W]*\])$/,Q=/[A-Z]/g;function R(a,b,c){var d;if(void 0===c&&1===a.nodeType)if(d="data-"+b.replace(Q,"-$&").toLowerCase(),c=a.getAttribute(d),"string"==typeof c){try{c="true"===c?!0:"false"===c?!1:"null"===c?null:+c+""===c?+c:P.test(c)?n.parseJSON(c):c;
}catch(e){}O.set(a,b,c)}else c=void 0;return c}n.extend({hasData:function(a){return O.hasData(a)||N.hasData(a)},data:function(a,b,c){return O.access(a,b,c)},removeData:function(a,b){O.remove(a,b)},_data:function(a,b,c){return N.access(a,b,c)},_removeData:function(a,b){N.remove(a,b)}}),n.fn.extend({data:function(a,b){var c,d,e,f=this[0],g=f&&f.attributes;if(void 0===a){if(this.length&&(e=O.get(f),1===f.nodeType&&!N.get(f,"hasDataAttrs"))){c=g.length;while(c--)g[c]&&(d=g[c].name,0===d.indexOf("data-")&&(d=n.camelCase(d.slice(5)),R(f,d,e[d])));N.set(f,"hasDataAttrs",!0)}return e}return"object"==typeof a?this.each(function(){O.set(this,a)}):K(this,function(b){var c,d;if(f&&void 0===b){if(c=O.get(f,a)||O.get(f,a.replace(Q,"-$&").toLowerCase()),void 0!==c)return c;if(d=n.camelCase(a),c=O.get(f,d),void 0!==c)return c;if(c=R(f,d,void 0),void 0!==c)return c}else d=n.camelCase(a),this.each(function(){var c=O.get(this,d);O.set(this,d,b),a.indexOf("-")>-1&&void 0!==c&&O.set(this,a,b)})},null,b,arguments.length>1,null,!0)},removeData:function(a){return this.each(function(){O.remove(this,a)})}}),n.extend({queue:function(a,b,c){var d;return a?(b=(b||"fx")+"queue",d=N.get(a,b),c&&(!d||n.isArray(c)?d=N.access(a,b,n.makeArray(c)):d.push(c)),d||[]):void 0},dequeue:function(a,b){b=b||"fx";var c=n.queue(a,b),d=c.length,e=c.shift(),f=n._queueHooks(a,b),g=function(){n.dequeue(a,b)};"inprogress"===e&&(e=c.shift(),d--),e&&("fx"===b&&c.unshift("inprogress"),delete f.stop,e.call(a,g,f)),!d&&f&&f.empty.fire()},_queueHooks:function(a,b){var c=b+"queueHooks";return N.get(a,c)||N.access(a,c,{empty:n.Callbacks("once memory").add(function(){N.remove(a,[b+"queue",c])})})}}),n.fn.extend({queue:function(a,b){var c=2;return"string"!=typeof a&&(b=a,a="fx",c--),arguments.length<c?n.queue(this[0],a):void 0===b?this:this.each(function(){var c=n.queue(this,a,b);n._queueHooks(this,a),"fx"===a&&"inprogress"!==c[0]&&n.dequeue(this,a)})},dequeue:function(a){return this.each(function(){n.dequeue(this,a)})},clearQueue:function(a){return this.queue(a||"fx",[])},promise:function(a,b){var c,d=1,e=n.Deferred(),f=this,g=this.length,h=function(){--d||e.resolveWith(f,[f])};"string"!=typeof a&&(b=a,a=void 0),a=a||"fx";while(g--)c=N.get(f[g],a+"queueHooks"),c&&c.empty&&(d++,c.empty.add(h));return h(),e.promise(b)}});var S=/[+-]?(?:\d*\.|)\d+(?:[eE][+-]?\d+|)/.source,T=new RegExp("^(?:([+-])=|)("+S+")([a-z%]*)$","i"),U=["Top","Right","Bottom","Left"],V=function(a,b){return a=b||a,"none"===n.css(a,"display")||!n.contains(a.ownerDocument,a)};function W(a,b,c,d){var e,f=1,g=20,h=d?function(){return d.cur()}:function(){return n.css(a,b,"")},i=h(),j=c&&c[3]||(n.cssNumber[b]?"":"px"),k=(n.cssNumber[b]||"px"!==j&&+i)&&T.exec(n.css(a,b));if(k&&k[3]!==j){j=j||k[3],c=c||[],k=+i||1;do f=f||".5",k/=f,n.style(a,b,k+j);while(f!==(f=h()/i)&&1!==f&&--g)}return c&&(k=+k||+i||0,e=c[1]?k+(c[1]+1)*c[2]:+c[2],d&&(d.unit=j,d.start=k,d.end=e)),e}var X=/^(?:checkbox|radio)$/i,Y=/<([\w:-]+)/,Z=/^$|\/(?:java|ecma)script/i,$={option:[1,"<select multiple='multiple'>","</select>"],thead:[1,"<table>","</table>"],col:[2,"<table><colgroup>","</colgroup></table>"],tr:[2,"<table><tbody>","</tbody></table>"],td:[3,"<table><tbody><tr>","</tr></tbody></table>"],_default:[0,"",""]};$.optgroup=$.option,$.tbody=$.tfoot=$.colgroup=$.caption=$.thead,$.th=$.td;function _(a,b){var c="undefined"!=typeof a.getElementsByTagName?a.getElementsByTagName(b||"*"):"undefined"!=typeof a.querySelectorAll?a.querySelectorAll(b||"*"):[];return void 0===b||b&&n.nodeName(a,b)?n.merge([a],c):c}function aa(a,b){for(var c=0,d=a.length;d>c;c++)N.set(a[c],"globalEval",!b||N.get(b[c],"globalEval"))}var ba=/<|&#?\w+;/;function ca(a,b,c,d,e){for(var f,g,h,i,j,k,l=b.createDocumentFragment(),m=[],o=0,p=a.length;p>o;o++)if(f=a[o],f||0===f)if("object"===n.type(f))n.merge(m,f.nodeType?[f]:f);else if(ba.test(f)){g=g||l.appendChild(b.createElement("div")),h=(Y.exec(f)||["",""])[1].toLowerCase(),i=$[h]||$._default,g.innerHTML=i[1]+n.htmlPrefilter(f)+i[2],k=i[0];while(k--)g=g.lastChild;n.merge(m,g.childNodes),g=l.firstChild,g.textContent=""}else m.push(b.createTextNode(f));l.textContent="",o=0;while(f=m[o++])if(d&&n.inArray(f,d)>-1)e&&e.push(f);else if(j=n.contains(f.ownerDocument,f),g=_(l.appendChild(f),"script"),j&&aa(g),c){k=0;while(f=g[k++])Z.test(f.type||"")&&c.push(f)}return l}!function(){var a=d.createDocumentFragment(),b=a.appendChild(d.createElement("div")),c=d.createElement("input");c.setAttribute("type","radio"),c.setAttribute("checked","checked"),c.setAttribute("name","t"),b.appendChild(c),l.checkClone=b.cloneNode(!0).cloneNode(!0).lastChild.checked,b.innerHTML="<textarea>x</textarea>",l.noCloneChecked=!!b.cloneNode(!0).lastChild.defaultValue}();var da=/^key/,ea=/^(?:mouse|pointer|contextmenu|drag|drop)|click/,fa=/^([^.]*)(?:\.(.+)|)/;function ga(){return!0}function ha(){return!1}function ia(){try{return d.activeElement}catch(a){}}function ja(a,b,c,d,e,f){var g,h;if("object"==typeof b){"string"!=typeof c&&(d=d||c,c=void 0);for(h in b)ja(a,h,c,d,b[h],f);return a}if(null==d&&null==e?(e=c,d=c=void 0):null==e&&("string"==typeof c?(e=d,d=void 0):(e=d,d=c,c=void 0)),e===!1)e=ha;else if(!e)return a;return 1===f&&(g=e,e=function(a){return n().off(a),g.apply(this,arguments)},e.guid=g.guid||(g.guid=n.guid++)),a.each(function(){n.event.add(this,b,e,d,c)})}n.event={global:{},add:function(a,b,c,d,e){var f,g,h,i,j,k,l,m,o,p,q,r=N.get(a);if(r){c.handler&&(f=c,c=f.handler,e=f.selector),c.guid||(c.guid=n.guid++),(i=r.events)||(i=r.events={}),(g=r.handle)||(g=r.handle=function(b){return"undefined"!=typeof n&&n.event.triggered!==b.type?n.event.dispatch.apply(a,arguments):void 0}),b=(b||"").match(G)||[""],j=b.length;while(j--)h=fa.exec(b[j])||[],o=q=h[1],p=(h[2]||"").split(".").sort(),o&&(l=n.event.special[o]||{},o=(e?l.delegateType:l.bindType)||o,l=n.event.special[o]||{},k=n.extend({type:o,origType:q,data:d,handler:c,guid:c.guid,selector:e,needsContext:e&&n.expr.match.needsContext.test(e),namespace:p.join(".")},f),(m=i[o])||(m=i[o]=[],m.delegateCount=0,l.setup&&l.setup.call(a,d,p,g)!==!1||a.addEventListener&&a.addEventListener(o,g)),l.add&&(l.add.call(a,k),k.handler.guid||(k.handler.guid=c.guid)),e?m.splice(m.delegateCount++,0,k):m.push(k),n.event.global[o]=!0)}},remove:function(a,b,c,d,e){var f,g,h,i,j,k,l,m,o,p,q,r=N.hasData(a)&&N.get(a);if(r&&(i=r.events)){b=(b||"").match(G)||[""],j=b.length;while(j--)if(h=fa.exec(b[j])||[],o=q=h[1],p=(h[2]||"").split(".").sort(),o){l=n.event.special[o]||{},o=(d?l.delegateType:l.bindType)||o,m=i[o]||[],h=h[2]&&new RegExp("(^|\\.)"+p.join("\\.(?:.*\\.|)")+"(\\.|$)"),g=f=m.length;while(f--)k=m[f],!e&&q!==k.origType||c&&c.guid!==k.guid||h&&!h.test(k.namespace)||d&&d!==k.selector&&("**"!==d||!k.selector)||(m.splice(f,1),k.selector&&m.delegateCount--,l.remove&&l.remove.call(a,k));g&&!m.length&&(l.teardown&&l.teardown.call(a,p,r.handle)!==!1||n.removeEvent(a,o,r.handle),delete i[o])}else for(o in i)n.event.remove(a,o+b[j],c,d,!0);n.isEmptyObject(i)&&N.remove(a,"handle events")}},dispatch:function(a){a=n.event.fix(a);var b,c,d,f,g,h=[],i=e.call(arguments),j=(N.get(this,"events")||{})[a.type]||[],k=n.event.special[a.type]||{};if(i[0]=a,a.delegateTarget=this,!k.preDispatch||k.preDispatch.call(this,a)!==!1){h=n.event.handlers.call(this,a,j),b=0;while((f=h[b++])&&!a.isPropagationStopped()){a.currentTarget=f.elem,c=0;while((g=f.handlers[c++])&&!a.isImmediatePropagationStopped())a.rnamespace&&!a.rnamespace.test(g.namespace)||(a.handleObj=g,a.data=g.data,d=((n.event.special[g.origType]||{}).handle||g.handler).apply(f.elem,i),void 0!==d&&(a.result=d)===!1&&(a.preventDefault(),a.stopPropagation()))}return k.postDispatch&&k.postDispatch.call(this,a),a.result}},handlers:function(a,b){var c,d,e,f,g=[],h=b.delegateCount,i=a.target;if(h&&i.nodeType&&("click"!==a.type||isNaN(a.button)||a.button<1))for(;i!==this;i=i.parentNode||this)if(1===i.nodeType&&(i.disabled!==!0||"click"!==a.type)){for(d=[],c=0;h>c;c++)f=b[c],e=f.selector+" ",void 0===d[e]&&(d[e]=f.needsContext?n(e,this).index(i)>-1:n.find(e,this,null,[i]).length),d[e]&&d.push(f);d.length&&g.push({elem:i,handlers:d})}return h<b.length&&g.push({elem:this,handlers:b.slice(h)}),g},props:"altKey bubbles cancelable ctrlKey currentTarget detail eventPhase metaKey relatedTarget shiftKey target timeStamp view which".split(" "),fixHooks:{},keyHooks:{props:"char charCode key keyCode".split(" "),filter:function(a,b){return null==a.which&&(a.which=null!=b.charCode?b.charCode:b.keyCode),a}},mouseHooks:{props:"button buttons clientX clientY offsetX offsetY pageX pageY screenX screenY toElement".split(" "),filter:function(a,b){var c,e,f,g=b.button;return null==a.pageX&&null!=b.clientX&&(c=a.target.ownerDocument||d,e=c.documentElement,f=c.body,a.pageX=b.clientX+(e&&e.scrollLeft||f&&f.scrollLeft||0)-(e&&e.clientLeft||f&&f.clientLeft||0),a.pageY=b.clientY+(e&&e.scrollTop||f&&f.scrollTop||0)-(e&&e.clientTop||f&&f.clientTop||0)),a.which||void 0===g||(a.which=1&g?1:2&g?3:4&g?2:0),a}},fix:function(a){if(a[n.expando])return a;var b,c,e,f=a.type,g=a,h=this.fixHooks[f];h||(this.fixHooks[f]=h=ea.test(f)?this.mouseHooks:da.test(f)?this.keyHooks:{}),e=h.props?this.props.concat(h.props):this.props,a=new n.Event(g),b=e.length;while(b--)c=e[b],a[c]=g[c];return a.target||(a.target=d),3===a.target.nodeType&&(a.target=a.target.parentNode),h.filter?h.filter(a,g):a},special:{load:{noBubble:!0},focus:{trigger:function(){return this!==ia()&&this.focus?(this.focus(),!1):void 0},delegateType:"focusin"},blur:{trigger:function(){return this===ia()&&this.blur?(this.blur(),!1):void 0},delegateType:"focusout"},click:{trigger:function(){return"checkbox"===this.type&&this.click&&n.nodeName(this,"input")?(this.click(),!1):void 0},_default:function(a){return n.nodeName(a.target,"a")}},beforeunload:{postDispatch:function(a){void 0!==a.result&&a.originalEvent&&(a.originalEvent.returnValue=a.result)}}}},n.removeEvent=function(a,b,c){a.removeEventListener&&a.removeEventListener(b,c)},n.Event=function(a,b){return this instanceof n.Event?(a&&a.type?(this.originalEvent=a,this.type=a.type,this.isDefaultPrevented=a.defaultPrevented||void 0===a.defaultPrevented&&a.returnValue===!1?ga:ha):this.type=a,b&&n.extend(this,b),this.timeStamp=a&&a.timeStamp||n.now(),void(this[n.expando]=!0)):new n.Event(a,b)},n.Event.prototype={constructor:n.Event,isDefaultPrevented:ha,isPropagationStopped:ha,isImmediatePropagationStopped:ha,isSimulated:!1,preventDefault:function(){var a=this.originalEvent;this.isDefaultPrevented=ga,a&&!this.isSimulated&&a.preventDefault()},stopPropagation:function(){var a=this.originalEvent;this.isPropagationStopped=ga,a&&!this.isSimulated&&a.stopPropagation()},stopImmediatePropagation:function(){var a=this.originalEvent;this.isImmediatePropagationStopped=ga,a&&!this.isSimulated&&a.stopImmediatePropagation(),this.stopPropagation()}},n.each({mouseenter:"mouseover",mouseleave:"mouseout",pointerenter:"pointerover",pointerleave:"pointerout"},function(a,b){n.event.special[a]={delegateType:b,bindType:b,handle:function(a){var c,d=this,e=a.relatedTarget,f=a.handleObj;return e&&(e===d||n.contains(d,e))||(a.type=f.origType,c=f.handler.apply(this,arguments),a.type=b),c}}}),n.fn.extend({on:function(a,b,c,d){return ja(this,a,b,c,d)},one:function(a,b,c,d){return ja(this,a,b,c,d,1)},off:function(a,b,c){var d,e;if(a&&a.preventDefault&&a.handleObj)return d=a.handleObj,n(a.delegateTarget).off(d.namespace?d.origType+"."+d.namespace:d.origType,d.selector,d.handler),this;if("object"==typeof a){for(e in a)this.off(e,b,a[e]);return this}return b!==!1&&"function"!=typeof b||(c=b,b=void 0),c===!1&&(c=ha),this.each(function(){n.event.remove(this,a,c,b)})}});var ka=/<(?!area|br|col|embed|hr|img|input|link|meta|param)(([\w:-]+)[^>]*)\/>/gi,la=/<script|<style|<link/i,ma=/checked\s*(?:[^=]|=\s*.checked.)/i,na=/^true\/(.*)/,oa=/^\s*<!(?:\[CDATA\[|--)|(?:\]\]|--)>\s*$/g;function pa(a,b){return n.nodeName(a,"table")&&n.nodeName(11!==b.nodeType?b:b.firstChild,"tr")?a.getElementsByTagName("tbody")[0]||a.appendChild(a.ownerDocument.createElement("tbody")):a}function qa(a){return a.type=(null!==a.getAttribute("type"))+"/"+a.type,a}function ra(a){var b=na.exec(a.type);return b?a.type=b[1]:a.removeAttribute("type"),a}function sa(a,b){var c,d,e,f,g,h,i,j;if(1===b.nodeType){if(N.hasData(a)&&(f=N.access(a),g=N.set(b,f),j=f.events)){delete g.handle,g.events={};for(e in j)for(c=0,d=j[e].length;d>c;c++)n.event.add(b,e,j[e][c])}O.hasData(a)&&(h=O.access(a),i=n.extend({},h),O.set(b,i))}}function ta(a,b){var c=b.nodeName.toLowerCase();"input"===c&&X.test(a.type)?b.checked=a.checked:"input"!==c&&"textarea"!==c||(b.defaultValue=a.defaultValue)}function ua(a,b,c,d){b=f.apply([],b);var e,g,h,i,j,k,m=0,o=a.length,p=o-1,q=b[0],r=n.isFunction(q);if(r||o>1&&"string"==typeof q&&!l.checkClone&&ma.test(q))return a.each(function(e){var f=a.eq(e);r&&(b[0]=q.call(this,e,f.html())),ua(f,b,c,d)});if(o&&(e=ca(b,a[0].ownerDocument,!1,a,d),g=e.firstChild,1===e.childNodes.length&&(e=g),g||d)){for(h=n.map(_(e,"script"),qa),i=h.length;o>m;m++)j=e,m!==p&&(j=n.clone(j,!0,!0),i&&n.merge(h,_(j,"script"))),c.call(a[m],j,m);if(i)for(k=h[h.length-1].ownerDocument,n.map(h,ra),m=0;i>m;m++)j=h[m],Z.test(j.type||"")&&!N.access(j,"globalEval")&&n.contains(k,j)&&(j.src?n._evalUrl&&n._evalUrl(j.src):n.globalEval(j.textContent.replace(oa,"")))}return a}function va(a,b,c){for(var d,e=b?n.filter(b,a):a,f=0;null!=(d=e[f]);f++)c||1!==d.nodeType||n.cleanData(_(d)),d.parentNode&&(c&&n.contains(d.ownerDocument,d)&&aa(_(d,"script")),d.parentNode.removeChild(d));return a}n.extend({htmlPrefilter:function(a){return a.replace(ka,"<$1></$2>")},clone:function(a,b,c){var d,e,f,g,h=a.cloneNode(!0),i=n.contains(a.ownerDocument,a);if(!(l.noCloneChecked||1!==a.nodeType&&11!==a.nodeType||n.isXMLDoc(a)))for(g=_(h),f=_(a),d=0,e=f.length;e>d;d++)ta(f[d],g[d]);if(b)if(c)for(f=f||_(a),g=g||_(h),d=0,e=f.length;e>d;d++)sa(f[d],g[d]);else sa(a,h);return g=_(h,"script"),g.length>0&&aa(g,!i&&_(a,"script")),h},cleanData:function(a){for(var b,c,d,e=n.event.special,f=0;void 0!==(c=a[f]);f++)if(L(c)){if(b=c[N.expando]){if(b.events)for(d in b.events)e[d]?n.event.remove(c,d):n.removeEvent(c,d,b.handle);c[N.expando]=void 0}c[O.expando]&&(c[O.expando]=void 0)}}}),n.fn.extend({domManip:ua,detach:function(a){return va(this,a,!0)},remove:function(a){return va(this,a)},text:function(a){return K(this,function(a){return void 0===a?n.text(this):this.empty().each(function(){1!==this.nodeType&&11!==this.nodeType&&9!==this.nodeType||(this.textContent=a)})},null,a,arguments.length)},append:function(){return ua(this,arguments,function(a){if(1===this.nodeType||11===this.nodeType||9===this.nodeType){var b=pa(this,a);b.appendChild(a)}})},prepend:function(){return ua(this,arguments,function(a){if(1===this.nodeType||11===this.nodeType||9===this.nodeType){var b=pa(this,a);b.insertBefore(a,b.firstChild)}})},before:function(){return ua(this,arguments,function(a){this.parentNode&&this.parentNode.insertBefore(a,this)})},after:function(){return ua(this,arguments,function(a){this.parentNode&&this.parentNode.insertBefore(a,this.nextSibling)})},empty:function(){for(var a,b=0;null!=(a=this[b]);b++)1===a.nodeType&&(n.cleanData(_(a,!1)),a.textContent="");return this},clone:function(a,b){return a=null==a?!1:a,b=null==b?a:b,this.map(function(){return n.clone(this,a,b)})},html:function(a){return K(this,function(a){var b=this[0]||{},c=0,d=this.length;if(void 0===a&&1===b.nodeType)return b.innerHTML;if("string"==typeof a&&!la.test(a)&&!$[(Y.exec(a)||["",""])[1].toLowerCase()]){a=n.htmlPrefilter(a);try{for(;d>c;c++)b=this[c]||{},1===b.nodeType&&(n.cleanData(_(b,!1)),b.innerHTML=a);b=0}catch(e){}}b&&this.empty().append(a)},null,a,arguments.length)},replaceWith:function(){var a=[];return ua(this,arguments,function(b){var c=this.parentNode;n.inArray(this,a)<0&&(n.cleanData(_(this)),c&&c.replaceChild(b,this))},a)}}),n.each({appendTo:"append",prependTo:"prepend",insertBefore:"before",insertAfter:"after",replaceAll:"replaceWith"},function(a,b){n.fn[a]=function(a){for(var c,d=[],e=n(a),f=e.length-1,h=0;f>=h;h++)c=h===f?this:this.clone(!0),n(e[h])[b](c),g.apply(d,c.get());return this.pushStack(d)}});var wa,xa={HTML:"block",BODY:"block"};function ya(a,b){var c=n(b.createElement(a)).appendTo(b.body),d=n.css(c[0],"display");return c.detach(),d}function za(a){var b=d,c=xa[a];return c||(c=ya(a,b),"none"!==c&&c||(wa=(wa||n("<iframe frameborder='0' width='0' height='0'/>")).appendTo(b.documentElement),b=wa[0].contentDocument,b.write(),b.close(),c=ya(a,b),wa.detach()),xa[a]=c),c}var Aa=/^margin/,Ba=new RegExp("^("+S+")(?!px)[a-z%]+$","i"),Ca=function(b){var c=b.ownerDocument.defaultView;return c&&c.opener||(c=a),c.getComputedStyle(b)},Da=function(a,b,c,d){var e,f,g={};for(f in b)g[f]=a.style[f],a.style[f]=b[f];e=c.apply(a,d||[]);for(f in b)a.style[f]=g[f];return e},Ea=d.documentElement;!function(){var b,c,e,f,g=d.createElement("div"),h=d.createElement("div");if(h.style){h.style.backgroundClip="content-box",h.cloneNode(!0).style.backgroundClip="",l.clearCloneStyle="content-box"===h.style.backgroundClip,g.style.cssText="border:0;width:8px;height:0;top:0;left:-9999px;padding:0;margin-top:1px;position:absolute",g.appendChild(h);function i(){h.style.cssText="-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box;position:relative;display:block;margin:auto;border:1px;padding:1px;top:1%;width:50%",h.innerHTML="",Ea.appendChild(g);var d=a.getComputedStyle(h);b="1%"!==d.top,f="2px"===d.marginLeft,c="4px"===d.width,h.style.marginRight="50%",e="4px"===d.marginRight,Ea.removeChild(g)}n.extend(l,{pixelPosition:function(){return i(),b},boxSizingReliable:function(){return null==c&&i(),c},pixelMarginRight:function(){return null==c&&i(),e},reliableMarginLeft:function(){return null==c&&i(),f},reliableMarginRight:function(){var b,c=h.appendChild(d.createElement("div"));return c.style.cssText=h.style.cssText="-webkit-box-sizing:content-box;box-sizing:content-box;display:block;margin:0;border:0;padding:0",c.style.marginRight=c.style.width="0",h.style.width="1px",Ea.appendChild(g),b=!parseFloat(a.getComputedStyle(c).marginRight),Ea.removeChild(g),h.removeChild(c),b}})}}();function Fa(a,b,c){var d,e,f,g,h=a.style;return c=c||Ca(a),g=c?c.getPropertyValue(b)||c[b]:void 0,""!==g&&void 0!==g||n.contains(a.ownerDocument,a)||(g=n.style(a,b)),c&&!l.pixelMarginRight()&&Ba.test(g)&&Aa.test(b)&&(d=h.width,e=h.minWidth,f=h.maxWidth,h.minWidth=h.maxWidth=h.width=g,g=c.width,h.width=d,h.minWidth=e,h.maxWidth=f),void 0!==g?g+"":g}function Ga(a,b){return{get:function(){return a()?void delete this.get:(this.get=b).apply(this,arguments)}}}var Ha=/^(none|table(?!-c[ea]).+)/,Ia={position:"absolute",visibility:"hidden",display:"block"},Ja={letterSpacing:"0",fontWeight:"400"},Ka=["Webkit","O","Moz","ms"],La=d.createElement("div").style;function Ma(a){if(a in La)return a;var b=a[0].toUpperCase()+a.slice(1),c=Ka.length;while(c--)if(a=Ka[c]+b,a in La)return a}function Na(a,b,c){var d=T.exec(b);return d?Math.max(0,d[2]-(c||0))+(d[3]||"px"):b}function Oa(a,b,c,d,e){for(var f=c===(d?"border":"content")?4:"width"===b?1:0,g=0;4>f;f+=2)"margin"===c&&(g+=n.css(a,c+U[f],!0,e)),d?("content"===c&&(g-=n.css(a,"padding"+U[f],!0,e)),"margin"!==c&&(g-=n.css(a,"border"+U[f]+"Width",!0,e))):(g+=n.css(a,"padding"+U[f],!0,e),"padding"!==c&&(g+=n.css(a,"border"+U[f]+"Width",!0,e)));return g}function Pa(a,b,c){var d=!0,e="width"===b?a.offsetWidth:a.offsetHeight,f=Ca(a),g="border-box"===n.css(a,"boxSizing",!1,f);if(0>=e||null==e){if(e=Fa(a,b,f),(0>e||null==e)&&(e=a.style[b]),Ba.test(e))return e;d=g&&(l.boxSizingReliable()||e===a.style[b]),e=parseFloat(e)||0}return e+Oa(a,b,c||(g?"border":"content"),d,f)+"px"}function Qa(a,b){for(var c,d,e,f=[],g=0,h=a.length;h>g;g++)d=a[g],d.style&&(f[g]=N.get(d,"olddisplay"),c=d.style.display,b?(f[g]||"none"!==c||(d.style.display=""),""===d.style.display&&V(d)&&(f[g]=N.access(d,"olddisplay",za(d.nodeName)))):(e=V(d),"none"===c&&e||N.set(d,"olddisplay",e?c:n.css(d,"display"))));for(g=0;h>g;g++)d=a[g],d.style&&(b&&"none"!==d.style.display&&""!==d.style.display||(d.style.display=b?f[g]||"":"none"));return a}n.extend({cssHooks:{opacity:{get:function(a,b){if(b){var c=Fa(a,"opacity");return""===c?"1":c}}}},cssNumber:{animationIterationCount:!0,columnCount:!0,fillOpacity:!0,flexGrow:!0,flexShrink:!0,fontWeight:!0,lineHeight:!0,opacity:!0,order:!0,orphans:!0,widows:!0,zIndex:!0,zoom:!0},cssProps:{"float":"cssFloat"},style:function(a,b,c,d){if(a&&3!==a.nodeType&&8!==a.nodeType&&a.style){var e,f,g,h=n.camelCase(b),i=a.style;return b=n.cssProps[h]||(n.cssProps[h]=Ma(h)||h),g=n.cssHooks[b]||n.cssHooks[h],void 0===c?g&&"get"in g&&void 0!==(e=g.get(a,!1,d))?e:i[b]:(f=typeof c,"string"===f&&(e=T.exec(c))&&e[1]&&(c=W(a,b,e),f="number"),null!=c&&c===c&&("number"===f&&(c+=e&&e[3]||(n.cssNumber[h]?"":"px")),l.clearCloneStyle||""!==c||0!==b.indexOf("background")||(i[b]="inherit"),g&&"set"in g&&void 0===(c=g.set(a,c,d))||(i[b]=c)),void 0)}},css:function(a,b,c,d){var e,f,g,h=n.camelCase(b);return b=n.cssProps[h]||(n.cssProps[h]=Ma(h)||h),g=n.cssHooks[b]||n.cssHooks[h],g&&"get"in g&&(e=g.get(a,!0,c)),void 0===e&&(e=Fa(a,b,d)),"normal"===e&&b in Ja&&(e=Ja[b]),""===c||c?(f=parseFloat(e),c===!0||isFinite(f)?f||0:e):e}}),n.each(["height","width"],function(a,b){n.cssHooks[b]={get:function(a,c,d){return c?Ha.test(n.css(a,"display"))&&0===a.offsetWidth?Da(a,Ia,function(){return Pa(a,b,d)}):Pa(a,b,d):void 0},set:function(a,c,d){var e,f=d&&Ca(a),g=d&&Oa(a,b,d,"border-box"===n.css(a,"boxSizing",!1,f),f);return g&&(e=T.exec(c))&&"px"!==(e[3]||"px")&&(a.style[b]=c,c=n.css(a,b)),Na(a,c,g)}}}),n.cssHooks.marginLeft=Ga(l.reliableMarginLeft,function(a,b){return b?(parseFloat(Fa(a,"marginLeft"))||a.getBoundingClientRect().left-Da(a,{marginLeft:0},function(){return a.getBoundingClientRect().left}))+"px":void 0}),n.cssHooks.marginRight=Ga(l.reliableMarginRight,function(a,b){return b?Da(a,{display:"inline-block"},Fa,[a,"marginRight"]):void 0}),n.each({margin:"",padding:"",border:"Width"},function(a,b){n.cssHooks[a+b]={expand:function(c){for(var d=0,e={},f="string"==typeof c?c.split(" "):[c];4>d;d++)e[a+U[d]+b]=f[d]||f[d-2]||f[0];return e}},Aa.test(a)||(n.cssHooks[a+b].set=Na)}),n.fn.extend({css:function(a,b){return K(this,function(a,b,c){var d,e,f={},g=0;if(n.isArray(b)){for(d=Ca(a),e=b.length;e>g;g++)f[b[g]]=n.css(a,b[g],!1,d);return f}return void 0!==c?n.style(a,b,c):n.css(a,b)},a,b,arguments.length>1)},show:function(){return Qa(this,!0)},hide:function(){return Qa(this)},toggle:function(a){return"boolean"==typeof a?a?this.show():this.hide():this.each(function(){V(this)?n(this).show():n(this).hide()})}});function Ra(a,b,c,d,e){return new Ra.prototype.init(a,b,c,d,e)}n.Tween=Ra,Ra.prototype={constructor:Ra,init:function(a,b,c,d,e,f){this.elem=a,this.prop=c,this.easing=e||n.easing._default,this.options=b,this.start=this.now=this.cur(),this.end=d,this.unit=f||(n.cssNumber[c]?"":"px")},cur:function(){var a=Ra.propHooks[this.prop];return a&&a.get?a.get(this):Ra.propHooks._default.get(this)},run:function(a){var b,c=Ra.propHooks[this.prop];return this.options.duration?this.pos=b=n.easing[this.easing](a,this.options.duration*a,0,1,this.options.duration):this.pos=b=a,this.now=(this.end-this.start)*b+this.start,this.options.step&&this.options.step.call(this.elem,this.now,this),c&&c.set?c.set(this):Ra.propHooks._default.set(this),this}},Ra.prototype.init.prototype=Ra.prototype,Ra.propHooks={_default:{get:function(a){var b;return 1!==a.elem.nodeType||null!=a.elem[a.prop]&&null==a.elem.style[a.prop]?a.elem[a.prop]:(b=n.css(a.elem,a.prop,""),b&&"auto"!==b?b:0)},set:function(a){n.fx.step[a.prop]?n.fx.step[a.prop](a):1!==a.elem.nodeType||null==a.elem.style[n.cssProps[a.prop]]&&!n.cssHooks[a.prop]?a.elem[a.prop]=a.now:n.style(a.elem,a.prop,a.now+a.unit)}}},Ra.propHooks.scrollTop=Ra.propHooks.scrollLeft={set:function(a){a.elem.nodeType&&a.elem.parentNode&&(a.elem[a.prop]=a.now)}},n.easing={linear:function(a){return a},swing:function(a){return.5-Math.cos(a*Math.PI)/2},_default:"swing"},n.fx=Ra.prototype.init,n.fx.step={};var Sa,Ta,Ua=/^(?:toggle|show|hide)$/,Va=/queueHooks$/;function Wa(){return a.setTimeout(function(){Sa=void 0}),Sa=n.now()}function Xa(a,b){var c,d=0,e={height:a};for(b=b?1:0;4>d;d+=2-b)c=U[d],e["margin"+c]=e["padding"+c]=a;return b&&(e.opacity=e.width=a),e}function Ya(a,b,c){for(var d,e=(_a.tweeners[b]||[]).concat(_a.tweeners["*"]),f=0,g=e.length;g>f;f++)if(d=e[f].call(c,b,a))return d}function Za(a,b,c){var d,e,f,g,h,i,j,k,l=this,m={},o=a.style,p=a.nodeType&&V(a),q=N.get(a,"fxshow");c.queue||(h=n._queueHooks(a,"fx"),null==h.unqueued&&(h.unqueued=0,i=h.empty.fire,h.empty.fire=function(){h.unqueued||i()}),h.unqueued++,l.always(function(){l.always(function(){h.unqueued--,n.queue(a,"fx").length||h.empty.fire()})})),1===a.nodeType&&("height"in b||"width"in b)&&(c.overflow=[o.overflow,o.overflowX,o.overflowY],j=n.css(a,"display"),k="none"===j?N.get(a,"olddisplay")||za(a.nodeName):j,"inline"===k&&"none"===n.css(a,"float")&&(o.display="inline-block")),c.overflow&&(o.overflow="hidden",l.always(function(){o.overflow=c.overflow[0],o.overflowX=c.overflow[1],o.overflowY=c.overflow[2]}));for(d in b)if(e=b[d],Ua.exec(e)){if(delete b[d],f=f||"toggle"===e,e===(p?"hide":"show")){if("show"!==e||!q||void 0===q[d])continue;p=!0}m[d]=q&&q[d]||n.style(a,d)}else j=void 0;if(n.isEmptyObject(m))"inline"===("none"===j?za(a.nodeName):j)&&(o.display=j);else{q?"hidden"in q&&(p=q.hidden):q=N.access(a,"fxshow",{}),f&&(q.hidden=!p),p?n(a).show():l.done(function(){n(a).hide()}),l.done(function(){var b;N.remove(a,"fxshow");for(b in m)n.style(a,b,m[b])});for(d in m)g=Ya(p?q[d]:0,d,l),d in q||(q[d]=g.start,p&&(g.end=g.start,g.start="width"===d||"height"===d?1:0))}}function $a(a,b){var c,d,e,f,g;for(c in a)if(d=n.camelCase(c),e=b[d],f=a[c],n.isArray(f)&&(e=f[1],f=a[c]=f[0]),c!==d&&(a[d]=f,delete a[c]),g=n.cssHooks[d],g&&"expand"in g){f=g.expand(f),delete a[d];for(c in f)c in a||(a[c]=f[c],b[c]=e)}else b[d]=e}function _a(a,b,c){var d,e,f=0,g=_a.prefilters.length,h=n.Deferred().always(function(){delete i.elem}),i=function(){if(e)return!1;for(var b=Sa||Wa(),c=Math.max(0,j.startTime+j.duration-b),d=c/j.duration||0,f=1-d,g=0,i=j.tweens.length;i>g;g++)j.tweens[g].run(f);return h.notifyWith(a,[j,f,c]),1>f&&i?c:(h.resolveWith(a,[j]),!1)},j=h.promise({elem:a,props:n.extend({},b),opts:n.extend(!0,{specialEasing:{},easing:n.easing._default},c),originalProperties:b,originalOptions:c,startTime:Sa||Wa(),duration:c.duration,tweens:[],createTween:function(b,c){var d=n.Tween(a,j.opts,b,c,j.opts.specialEasing[b]||j.opts.easing);return j.tweens.push(d),d},stop:function(b){var c=0,d=b?j.tweens.length:0;if(e)return this;for(e=!0;d>c;c++)j.tweens[c].run(1);return b?(h.notifyWith(a,[j,1,0]),h.resolveWith(a,[j,b])):h.rejectWith(a,[j,b]),this}}),k=j.props;for($a(k,j.opts.specialEasing);g>f;f++)if(d=_a.prefilters[f].call(j,a,k,j.opts))return n.isFunction(d.stop)&&(n._queueHooks(j.elem,j.opts.queue).stop=n.proxy(d.stop,d)),d;return n.map(k,Ya,j),n.isFunction(j.opts.start)&&j.opts.start.call(a,j),n.fx.timer(n.extend(i,{elem:a,anim:j,queue:j.opts.queue})),j.progress(j.opts.progress).done(j.opts.done,j.opts.complete).fail(j.opts.fail).always(j.opts.always)}n.Animation=n.extend(_a,{tweeners:{"*":[function(a,b){var c=this.createTween(a,b);return W(c.elem,a,T.exec(b),c),c}]},tweener:function(a,b){n.isFunction(a)?(b=a,a=["*"]):a=a.match(G);for(var c,d=0,e=a.length;e>d;d++)c=a[d],_a.tweeners[c]=_a.tweeners[c]||[],_a.tweeners[c].unshift(b)},prefilters:[Za],prefilter:function(a,b){b?_a.prefilters.unshift(a):_a.prefilters.push(a)}}),n.speed=function(a,b,c){var d=a&&"object"==typeof a?n.extend({},a):{complete:c||!c&&b||n.isFunction(a)&&a,duration:a,easing:c&&b||b&&!n.isFunction(b)&&b};return d.duration=n.fx.off?0:"number"==typeof d.duration?d.duration:d.duration in n.fx.speeds?n.fx.speeds[d.duration]:n.fx.speeds._default,null!=d.queue&&d.queue!==!0||(d.queue="fx"),d.old=d.complete,d.complete=function(){n.isFunction(d.old)&&d.old.call(this),d.queue&&n.dequeue(this,d.queue)},d},n.fn.extend({fadeTo:function(a,b,c,d){return this.filter(V).css("opacity",0).show().end().animate({opacity:b},a,c,d)},animate:function(a,b,c,d){var e=n.isEmptyObject(a),f=n.speed(b,c,d),g=function(){var b=_a(this,n.extend({},a),f);(e||N.get(this,"finish"))&&b.stop(!0)};return g.finish=g,e||f.queue===!1?this.each(g):this.queue(f.queue,g)},stop:function(a,b,c){var d=function(a){var b=a.stop;delete a.stop,b(c)};return"string"!=typeof a&&(c=b,b=a,a=void 0),b&&a!==!1&&this.queue(a||"fx",[]),this.each(function(){var b=!0,e=null!=a&&a+"queueHooks",f=n.timers,g=N.get(this);if(e)g[e]&&g[e].stop&&d(g[e]);else for(e in g)g[e]&&g[e].stop&&Va.test(e)&&d(g[e]);for(e=f.length;e--;)f[e].elem!==this||null!=a&&f[e].queue!==a||(f[e].anim.stop(c),b=!1,f.splice(e,1));!b&&c||n.dequeue(this,a)})},finish:function(a){return a!==!1&&(a=a||"fx"),this.each(function(){var b,c=N.get(this),d=c[a+"queue"],e=c[a+"queueHooks"],f=n.timers,g=d?d.length:0;for(c.finish=!0,n.queue(this,a,[]),e&&e.stop&&e.stop.call(this,!0),b=f.length;b--;)f[b].elem===this&&f[b].queue===a&&(f[b].anim.stop(!0),f.splice(b,1));for(b=0;g>b;b++)d[b]&&d[b].finish&&d[b].finish.call(this);delete c.finish})}}),n.each(["toggle","show","hide"],function(a,b){var c=n.fn[b];n.fn[b]=function(a,d,e){return null==a||"boolean"==typeof a?c.apply(this,arguments):this.animate(Xa(b,!0),a,d,e)}}),n.each({slideDown:Xa("show"),slideUp:Xa("hide"),slideToggle:Xa("toggle"),fadeIn:{opacity:"show"},fadeOut:{opacity:"hide"},fadeToggle:{opacity:"toggle"}},function(a,b){n.fn[a]=function(a,c,d){return this.animate(b,a,c,d)}}),n.timers=[],n.fx.tick=function(){var a,b=0,c=n.timers;for(Sa=n.now();b<c.length;b++)a=c[b],a()||c[b]!==a||c.splice(b--,1);c.length||n.fx.stop(),Sa=void 0},n.fx.timer=function(a){n.timers.push(a),a()?n.fx.start():n.timers.pop()},n.fx.interval=13,n.fx.start=function(){Ta||(Ta=a.setInterval(n.fx.tick,n.fx.interval))},n.fx.stop=function(){a.clearInterval(Ta),Ta=null},n.fx.speeds={slow:600,fast:200,_default:400},n.fn.delay=function(b,c){return b=n.fx?n.fx.speeds[b]||b:b,c=c||"fx",this.queue(c,function(c,d){var e=a.setTimeout(c,b);d.stop=function(){a.clearTimeout(e)}})},function(){var a=d.createElement("input"),b=d.createElement("select"),c=b.appendChild(d.createElement("option"));a.type="checkbox",l.checkOn=""!==a.value,l.optSelected=c.selected,b.disabled=!0,l.optDisabled=!c.disabled,a=d.createElement("input"),a.value="t",a.type="radio",l.radioValue="t"===a.value}();var ab,bb=n.expr.attrHandle;n.fn.extend({attr:function(a,b){return K(this,n.attr,a,b,arguments.length>1)},removeAttr:function(a){return this.each(function(){n.removeAttr(this,a)})}}),n.extend({attr:function(a,b,c){var d,e,f=a.nodeType;if(3!==f&&8!==f&&2!==f)return"undefined"==typeof a.getAttribute?n.prop(a,b,c):(1===f&&n.isXMLDoc(a)||(b=b.toLowerCase(),e=n.attrHooks[b]||(n.expr.match.bool.test(b)?ab:void 0)),void 0!==c?null===c?void n.removeAttr(a,b):e&&"set"in e&&void 0!==(d=e.set(a,c,b))?d:(a.setAttribute(b,c+""),c):e&&"get"in e&&null!==(d=e.get(a,b))?d:(d=n.find.attr(a,b),null==d?void 0:d))},attrHooks:{type:{set:function(a,b){if(!l.radioValue&&"radio"===b&&n.nodeName(a,"input")){var c=a.value;return a.setAttribute("type",b),c&&(a.value=c),b}}}},removeAttr:function(a,b){var c,d,e=0,f=b&&b.match(G);if(f&&1===a.nodeType)while(c=f[e++])d=n.propFix[c]||c,n.expr.match.bool.test(c)&&(a[d]=!1),a.removeAttribute(c)}}),ab={set:function(a,b,c){return b===!1?n.removeAttr(a,c):a.setAttribute(c,c),c}},n.each(n.expr.match.bool.source.match(/\w+/g),function(a,b){var c=bb[b]||n.find.attr;bb[b]=function(a,b,d){var e,f;return d||(f=bb[b],bb[b]=e,e=null!=c(a,b,d)?b.toLowerCase():null,bb[b]=f),e}});var cb=/^(?:input|select|textarea|button)$/i,db=/^(?:a|area)$/i;n.fn.extend({prop:function(a,b){return K(this,n.prop,a,b,arguments.length>1)},removeProp:function(a){return this.each(function(){delete this[n.propFix[a]||a]})}}),n.extend({prop:function(a,b,c){var d,e,f=a.nodeType;if(3!==f&&8!==f&&2!==f)return 1===f&&n.isXMLDoc(a)||(b=n.propFix[b]||b,e=n.propHooks[b]),
        void 0!==c?e&&"set"in e&&void 0!==(d=e.set(a,c,b))?d:a[b]=c:e&&"get"in e&&null!==(d=e.get(a,b))?d:a[b]},propHooks:{tabIndex:{get:function(a){var b=n.find.attr(a,"tabindex");return b?parseInt(b,10):cb.test(a.nodeName)||db.test(a.nodeName)&&a.href?0:-1}}},propFix:{"for":"htmlFor","class":"className"}}),l.optSelected||(n.propHooks.selected={get:function(a){var b=a.parentNode;return b&&b.parentNode&&b.parentNode.selectedIndex,null},set:function(a){var b=a.parentNode;b&&(b.selectedIndex,b.parentNode&&b.parentNode.selectedIndex)}}),n.each(["tabIndex","readOnly","maxLength","cellSpacing","cellPadding","rowSpan","colSpan","useMap","frameBorder","contentEditable"],function(){n.propFix[this.toLowerCase()]=this});var eb=/[\t\r\n\f]/g;function fb(a){return a.getAttribute&&a.getAttribute("class")||""}n.fn.extend({addClass:function(a){var b,c,d,e,f,g,h,i=0;if(n.isFunction(a))return this.each(function(b){n(this).addClass(a.call(this,b,fb(this)))});if("string"==typeof a&&a){b=a.match(G)||[];while(c=this[i++])if(e=fb(c),d=1===c.nodeType&&(" "+e+" ").replace(eb," ")){g=0;while(f=b[g++])d.indexOf(" "+f+" ")<0&&(d+=f+" ");h=n.trim(d),e!==h&&c.setAttribute("class",h)}}return this},removeClass:function(a){var b,c,d,e,f,g,h,i=0;if(n.isFunction(a))return this.each(function(b){n(this).removeClass(a.call(this,b,fb(this)))});if(!arguments.length)return this.attr("class","");if("string"==typeof a&&a){b=a.match(G)||[];while(c=this[i++])if(e=fb(c),d=1===c.nodeType&&(" "+e+" ").replace(eb," ")){g=0;while(f=b[g++])while(d.indexOf(" "+f+" ")>-1)d=d.replace(" "+f+" "," ");h=n.trim(d),e!==h&&c.setAttribute("class",h)}}return this},toggleClass:function(a,b){var c=typeof a;return"boolean"==typeof b&&"string"===c?b?this.addClass(a):this.removeClass(a):n.isFunction(a)?this.each(function(c){n(this).toggleClass(a.call(this,c,fb(this),b),b)}):this.each(function(){var b,d,e,f;if("string"===c){d=0,e=n(this),f=a.match(G)||[];while(b=f[d++])e.hasClass(b)?e.removeClass(b):e.addClass(b)}else void 0!==a&&"boolean"!==c||(b=fb(this),b&&N.set(this,"__className__",b),this.setAttribute&&this.setAttribute("class",b||a===!1?"":N.get(this,"__className__")||""))})},hasClass:function(a){var b,c,d=0;b=" "+a+" ";while(c=this[d++])if(1===c.nodeType&&(" "+fb(c)+" ").replace(eb," ").indexOf(b)>-1)return!0;return!1}});var gb=/\r/g,hb=/[\x20\t\r\n\f]+/g;n.fn.extend({val:function(a){var b,c,d,e=this[0];{if(arguments.length)return d=n.isFunction(a),this.each(function(c){var e;1===this.nodeType&&(e=d?a.call(this,c,n(this).val()):a,null==e?e="":"number"==typeof e?e+="":n.isArray(e)&&(e=n.map(e,function(a){return null==a?"":a+""})),b=n.valHooks[this.type]||n.valHooks[this.nodeName.toLowerCase()],b&&"set"in b&&void 0!==b.set(this,e,"value")||(this.value=e))});if(e)return b=n.valHooks[e.type]||n.valHooks[e.nodeName.toLowerCase()],b&&"get"in b&&void 0!==(c=b.get(e,"value"))?c:(c=e.value,"string"==typeof c?c.replace(gb,""):null==c?"":c)}}}),n.extend({valHooks:{option:{get:function(a){var b=n.find.attr(a,"value");return null!=b?b:n.trim(n.text(a)).replace(hb," ")}},select:{get:function(a){for(var b,c,d=a.options,e=a.selectedIndex,f="select-one"===a.type||0>e,g=f?null:[],h=f?e+1:d.length,i=0>e?h:f?e:0;h>i;i++)if(c=d[i],(c.selected||i===e)&&(l.optDisabled?!c.disabled:null===c.getAttribute("disabled"))&&(!c.parentNode.disabled||!n.nodeName(c.parentNode,"optgroup"))){if(b=n(c).val(),f)return b;g.push(b)}return g},set:function(a,b){var c,d,e=a.options,f=n.makeArray(b),g=e.length;while(g--)d=e[g],(d.selected=n.inArray(n.valHooks.option.get(d),f)>-1)&&(c=!0);return c||(a.selectedIndex=-1),f}}}}),n.each(["radio","checkbox"],function(){n.valHooks[this]={set:function(a,b){return n.isArray(b)?a.checked=n.inArray(n(a).val(),b)>-1:void 0}},l.checkOn||(n.valHooks[this].get=function(a){return null===a.getAttribute("value")?"on":a.value})});var ib=/^(?:focusinfocus|focusoutblur)$/;n.extend(n.event,{trigger:function(b,c,e,f){var g,h,i,j,l,m,o,p=[e||d],q=k.call(b,"type")?b.type:b,r=k.call(b,"namespace")?b.namespace.split("."):[];if(h=i=e=e||d,3!==e.nodeType&&8!==e.nodeType&&!ib.test(q+n.event.triggered)&&(q.indexOf(".")>-1&&(r=q.split("."),q=r.shift(),r.sort()),l=q.indexOf(":")<0&&"on"+q,b=b[n.expando]?b:new n.Event(q,"object"==typeof b&&b),b.isTrigger=f?2:3,b.namespace=r.join("."),b.rnamespace=b.namespace?new RegExp("(^|\\.)"+r.join("\\.(?:.*\\.|)")+"(\\.|$)"):null,b.result=void 0,b.target||(b.target=e),c=null==c?[b]:n.makeArray(c,[b]),o=n.event.special[q]||{},f||!o.trigger||o.trigger.apply(e,c)!==!1)){if(!f&&!o.noBubble&&!n.isWindow(e)){for(j=o.delegateType||q,ib.test(j+q)||(h=h.parentNode);h;h=h.parentNode)p.push(h),i=h;i===(e.ownerDocument||d)&&p.push(i.defaultView||i.parentWindow||a)}g=0;while((h=p[g++])&&!b.isPropagationStopped())b.type=g>1?j:o.bindType||q,m=(N.get(h,"events")||{})[b.type]&&N.get(h,"handle"),m&&m.apply(h,c),m=l&&h[l],m&&m.apply&&L(h)&&(b.result=m.apply(h,c),b.result===!1&&b.preventDefault());return b.type=q,f||b.isDefaultPrevented()||o._default&&o._default.apply(p.pop(),c)!==!1||!L(e)||l&&n.isFunction(e[q])&&!n.isWindow(e)&&(i=e[l],i&&(e[l]=null),n.event.triggered=q,e[q](),n.event.triggered=void 0,i&&(e[l]=i)),b.result}},simulate:function(a,b,c){var d=n.extend(new n.Event,c,{type:a,isSimulated:!0});n.event.trigger(d,null,b)}}),n.fn.extend({trigger:function(a,b){return this.each(function(){n.event.trigger(a,b,this)})},triggerHandler:function(a,b){var c=this[0];return c?n.event.trigger(a,b,c,!0):void 0}}),n.each("blur focus focusin focusout load resize scroll unload click dblclick mousedown mouseup mousemove mouseover mouseout mouseenter mouseleave change select submit keydown keypress keyup error contextmenu".split(" "),function(a,b){n.fn[b]=function(a,c){return arguments.length>0?this.on(b,null,a,c):this.trigger(b)}}),n.fn.extend({hover:function(a,b){return this.mouseenter(a).mouseleave(b||a)}}),l.focusin="onfocusin"in a,l.focusin||n.each({focus:"focusin",blur:"focusout"},function(a,b){var c=function(a){n.event.simulate(b,a.target,n.event.fix(a))};n.event.special[b]={setup:function(){var d=this.ownerDocument||this,e=N.access(d,b);e||d.addEventListener(a,c,!0),N.access(d,b,(e||0)+1)},teardown:function(){var d=this.ownerDocument||this,e=N.access(d,b)-1;e?N.access(d,b,e):(d.removeEventListener(a,c,!0),N.remove(d,b))}}});var jb=a.location,kb=n.now(),lb=/\?/;n.parseJSON=function(a){return JSON.parse(a+"")},n.parseXML=function(b){var c;if(!b||"string"!=typeof b)return null;try{c=(new a.DOMParser).parseFromString(b,"text/xml")}catch(d){c=void 0}return c&&!c.getElementsByTagName("parsererror").length||n.error("Invalid XML: "+b),c};var mb=/#.*$/,nb=/([?&])_=[^&]*/,ob=/^(.*?):[ \t]*([^\r\n]*)$/gm,pb=/^(?:about|app|app-storage|.+-extension|file|res|widget):$/,qb=/^(?:GET|HEAD)$/,rb=/^\/\//,sb={},tb={},ub="*/".concat("*"),vb=d.createElement("a");vb.href=jb.href;function wb(a){return function(b,c){"string"!=typeof b&&(c=b,b="*");var d,e=0,f=b.toLowerCase().match(G)||[];if(n.isFunction(c))while(d=f[e++])"+"===d[0]?(d=d.slice(1)||"*",(a[d]=a[d]||[]).unshift(c)):(a[d]=a[d]||[]).push(c)}}function xb(a,b,c,d){var e={},f=a===tb;function g(h){var i;return e[h]=!0,n.each(a[h]||[],function(a,h){var j=h(b,c,d);return"string"!=typeof j||f||e[j]?f?!(i=j):void 0:(b.dataTypes.unshift(j),g(j),!1)}),i}return g(b.dataTypes[0])||!e["*"]&&g("*")}function yb(a,b){var c,d,e=n.ajaxSettings.flatOptions||{};for(c in b)void 0!==b[c]&&((e[c]?a:d||(d={}))[c]=b[c]);return d&&n.extend(!0,a,d),a}function zb(a,b,c){var d,e,f,g,h=a.contents,i=a.dataTypes;while("*"===i[0])i.shift(),void 0===d&&(d=a.mimeType||b.getResponseHeader("Content-Type"));if(d)for(e in h)if(h[e]&&h[e].test(d)){i.unshift(e);break}if(i[0]in c)f=i[0];else{for(e in c){if(!i[0]||a.converters[e+" "+i[0]]){f=e;break}g||(g=e)}f=f||g}return f?(f!==i[0]&&i.unshift(f),c[f]):void 0}function Ab(a,b,c,d){var e,f,g,h,i,j={},k=a.dataTypes.slice();if(k[1])for(g in a.converters)j[g.toLowerCase()]=a.converters[g];f=k.shift();while(f)if(a.responseFields[f]&&(c[a.responseFields[f]]=b),!i&&d&&a.dataFilter&&(b=a.dataFilter(b,a.dataType)),i=f,f=k.shift())if("*"===f)f=i;else if("*"!==i&&i!==f){if(g=j[i+" "+f]||j["* "+f],!g)for(e in j)if(h=e.split(" "),h[1]===f&&(g=j[i+" "+h[0]]||j["* "+h[0]])){g===!0?g=j[e]:j[e]!==!0&&(f=h[0],k.unshift(h[1]));break}if(g!==!0)if(g&&a["throws"])b=g(b);else try{b=g(b)}catch(l){return{state:"parsererror",error:g?l:"No conversion from "+i+" to "+f}}}return{state:"success",data:b}}n.extend({active:0,lastModified:{},etag:{},ajaxSettings:{url:jb.href,type:"GET",isLocal:pb.test(jb.protocol),global:!0,processData:!0,async:!0,contentType:"application/x-www-form-urlencoded; charset=UTF-8",accepts:{"*":ub,text:"text/plain",html:"text/html",xml:"application/xml, text/xml",json:"application/json, text/javascript"},contents:{xml:/\bxml\b/,html:/\bhtml/,json:/\bjson\b/},responseFields:{xml:"responseXML",text:"responseText",json:"responseJSON"},converters:{"* text":String,"text html":!0,"text json":n.parseJSON,"text xml":n.parseXML},flatOptions:{url:!0,context:!0}},ajaxSetup:function(a,b){return b?yb(yb(a,n.ajaxSettings),b):yb(n.ajaxSettings,a)},ajaxPrefilter:wb(sb),ajaxTransport:wb(tb),ajax:function(b,c){"object"==typeof b&&(c=b,b=void 0),c=c||{};var e,f,g,h,i,j,k,l,m=n.ajaxSetup({},c),o=m.context||m,p=m.context&&(o.nodeType||o.jquery)?n(o):n.event,q=n.Deferred(),r=n.Callbacks("once memory"),s=m.statusCode||{},t={},u={},v=0,w="canceled",x={readyState:0,getResponseHeader:function(a){var b;if(2===v){if(!h){h={};while(b=ob.exec(g))h[b[1].toLowerCase()]=b[2]}b=h[a.toLowerCase()]}return null==b?null:b},getAllResponseHeaders:function(){return 2===v?g:null},setRequestHeader:function(a,b){var c=a.toLowerCase();return v||(a=u[c]=u[c]||a,t[a]=b),this},overrideMimeType:function(a){return v||(m.mimeType=a),this},statusCode:function(a){var b;if(a)if(2>v)for(b in a)s[b]=[s[b],a[b]];else x.always(a[x.status]);return this},abort:function(a){var b=a||w;return e&&e.abort(b),z(0,b),this}};if(q.promise(x).complete=r.add,x.success=x.done,x.error=x.fail,m.url=((b||m.url||jb.href)+"").replace(mb,"").replace(rb,jb.protocol+"//"),m.type=c.method||c.type||m.method||m.type,m.dataTypes=n.trim(m.dataType||"*").toLowerCase().match(G)||[""],null==m.crossDomain){j=d.createElement("a");try{j.href=m.url,j.href=j.href,m.crossDomain=vb.protocol+"//"+vb.host!=j.protocol+"//"+j.host}catch(y){m.crossDomain=!0}}if(m.data&&m.processData&&"string"!=typeof m.data&&(m.data=n.param(m.data,m.traditional)),xb(sb,m,c,x),2===v)return x;k=n.event&&m.global,k&&0===n.active++&&n.event.trigger("ajaxStart"),m.type=m.type.toUpperCase(),m.hasContent=!qb.test(m.type),f=m.url,m.hasContent||(m.data&&(f=m.url+=(lb.test(f)?"&":"?")+m.data,delete m.data),m.cache===!1&&(m.url=nb.test(f)?f.replace(nb,"$1_="+kb++):f+(lb.test(f)?"&":"?")+"_="+kb++)),m.ifModified&&(n.lastModified[f]&&x.setRequestHeader("If-Modified-Since",n.lastModified[f]),n.etag[f]&&x.setRequestHeader("If-None-Match",n.etag[f])),(m.data&&m.hasContent&&m.contentType!==!1||c.contentType)&&x.setRequestHeader("Content-Type",m.contentType),x.setRequestHeader("Accept",m.dataTypes[0]&&m.accepts[m.dataTypes[0]]?m.accepts[m.dataTypes[0]]+("*"!==m.dataTypes[0]?", "+ub+"; q=0.01":""):m.accepts["*"]);for(l in m.headers)x.setRequestHeader(l,m.headers[l]);if(m.beforeSend&&(m.beforeSend.call(o,x,m)===!1||2===v))return x.abort();w="abort";for(l in{success:1,error:1,complete:1})x[l](m[l]);if(e=xb(tb,m,c,x)){if(x.readyState=1,k&&p.trigger("ajaxSend",[x,m]),2===v)return x;m.async&&m.timeout>0&&(i=a.setTimeout(function(){x.abort("timeout")},m.timeout));try{v=1,e.send(t,z)}catch(y){if(!(2>v))throw y;z(-1,y)}}else z(-1,"No Transport");function z(b,c,d,h){var j,l,t,u,w,y=c;2!==v&&(v=2,i&&a.clearTimeout(i),e=void 0,g=h||"",x.readyState=b>0?4:0,j=b>=200&&300>b||304===b,d&&(u=zb(m,x,d)),u=Ab(m,u,x,j),j?(m.ifModified&&(w=x.getResponseHeader("Last-Modified"),w&&(n.lastModified[f]=w),w=x.getResponseHeader("etag"),w&&(n.etag[f]=w)),204===b||"HEAD"===m.type?y="nocontent":304===b?y="notmodified":(y=u.state,l=u.data,t=u.error,j=!t)):(t=y,!b&&y||(y="error",0>b&&(b=0))),x.status=b,x.statusText=(c||y)+"",j?q.resolveWith(o,[l,y,x]):q.rejectWith(o,[x,y,t]),x.statusCode(s),s=void 0,k&&p.trigger(j?"ajaxSuccess":"ajaxError",[x,m,j?l:t]),r.fireWith(o,[x,y]),k&&(p.trigger("ajaxComplete",[x,m]),--n.active||n.event.trigger("ajaxStop")))}return x},getJSON:function(a,b,c){return n.get(a,b,c,"json")},getScript:function(a,b){return n.get(a,void 0,b,"script")}}),n.each(["get","post"],function(a,b){n[b]=function(a,c,d,e){return n.isFunction(c)&&(e=e||d,d=c,c=void 0),n.ajax(n.extend({url:a,type:b,dataType:e,data:c,success:d},n.isPlainObject(a)&&a))}}),n._evalUrl=function(a){return n.ajax({url:a,type:"GET",dataType:"script",async:!1,global:!1,"throws":!0})},n.fn.extend({wrapAll:function(a){var b;return n.isFunction(a)?this.each(function(b){n(this).wrapAll(a.call(this,b))}):(this[0]&&(b=n(a,this[0].ownerDocument).eq(0).clone(!0),this[0].parentNode&&b.insertBefore(this[0]),b.map(function(){var a=this;while(a.firstElementChild)a=a.firstElementChild;return a}).append(this)),this)},wrapInner:function(a){return n.isFunction(a)?this.each(function(b){n(this).wrapInner(a.call(this,b))}):this.each(function(){var b=n(this),c=b.contents();c.length?c.wrapAll(a):b.append(a)})},wrap:function(a){var b=n.isFunction(a);return this.each(function(c){n(this).wrapAll(b?a.call(this,c):a)})},unwrap:function(){return this.parent().each(function(){n.nodeName(this,"body")||n(this).replaceWith(this.childNodes)}).end()}}),n.expr.filters.hidden=function(a){return!n.expr.filters.visible(a)},n.expr.filters.visible=function(a){return a.offsetWidth>0||a.offsetHeight>0||a.getClientRects().length>0};var Bb=/%20/g,Cb=/\[\]$/,Db=/\r?\n/g,Eb=/^(?:submit|button|image|reset|file)$/i,Fb=/^(?:input|select|textarea|keygen)/i;function Gb(a,b,c,d){var e;if(n.isArray(b))n.each(b,function(b,e){c||Cb.test(a)?d(a,e):Gb(a+"["+("object"==typeof e&&null!=e?b:"")+"]",e,c,d)});else if(c||"object"!==n.type(b))d(a,b);else for(e in b)Gb(a+"["+e+"]",b[e],c,d)}n.param=function(a,b){var c,d=[],e=function(a,b){b=n.isFunction(b)?b():null==b?"":b,d[d.length]=encodeURIComponent(a)+"="+encodeURIComponent(b)};if(void 0===b&&(b=n.ajaxSettings&&n.ajaxSettings.traditional),n.isArray(a)||a.jquery&&!n.isPlainObject(a))n.each(a,function(){e(this.name,this.value)});else for(c in a)Gb(c,a[c],b,e);return d.join("&").replace(Bb,"+")},n.fn.extend({serialize:function(){return n.param(this.serializeArray())},serializeArray:function(){return this.map(function(){var a=n.prop(this,"elements");return a?n.makeArray(a):this}).filter(function(){var a=this.type;return this.name&&!n(this).is(":disabled")&&Fb.test(this.nodeName)&&!Eb.test(a)&&(this.checked||!X.test(a))}).map(function(a,b){var c=n(this).val();return null==c?null:n.isArray(c)?n.map(c,function(a){return{name:b.name,value:a.replace(Db,"\r\n")}}):{name:b.name,value:c.replace(Db,"\r\n")}}).get()}}),n.ajaxSettings.xhr=function(){try{return new a.XMLHttpRequest}catch(b){}};var Hb={0:200,1223:204},Ib=n.ajaxSettings.xhr();l.cors=!!Ib&&"withCredentials"in Ib,l.ajax=Ib=!!Ib,n.ajaxTransport(function(b){var c,d;return l.cors||Ib&&!b.crossDomain?{send:function(e,f){var g,h=b.xhr();if(h.open(b.type,b.url,b.async,b.username,b.password),b.xhrFields)for(g in b.xhrFields)h[g]=b.xhrFields[g];b.mimeType&&h.overrideMimeType&&h.overrideMimeType(b.mimeType),b.crossDomain||e["X-Requested-With"]||(e["X-Requested-With"]="XMLHttpRequest");for(g in e)h.setRequestHeader(g,e[g]);c=function(a){return function(){c&&(c=d=h.onload=h.onerror=h.onabort=h.onreadystatechange=null,"abort"===a?h.abort():"error"===a?"number"!=typeof h.status?f(0,"error"):f(h.status,h.statusText):f(Hb[h.status]||h.status,h.statusText,"text"!==(h.responseType||"text")||"string"!=typeof h.responseText?{binary:h.response}:{text:h.responseText},h.getAllResponseHeaders()))}},h.onload=c(),d=h.onerror=c("error"),void 0!==h.onabort?h.onabort=d:h.onreadystatechange=function(){4===h.readyState&&a.setTimeout(function(){c&&d()})},c=c("abort");try{h.send(b.hasContent&&b.data||null)}catch(i){if(c)throw i}},abort:function(){c&&c()}}:void 0}),n.ajaxSetup({accepts:{script:"text/javascript, application/javascript, application/ecmascript, application/x-ecmascript"},contents:{script:/\b(?:java|ecma)script\b/},converters:{"text script":function(a){return n.globalEval(a),a}}}),n.ajaxPrefilter("script",function(a){void 0===a.cache&&(a.cache=!1),a.crossDomain&&(a.type="GET")}),n.ajaxTransport("script",function(a){if(a.crossDomain){var b,c;return{send:function(e,f){b=n("<script>").prop({charset:a.scriptCharset,src:a.url}).on("load error",c=function(a){b.remove(),c=null,a&&f("error"===a.type?404:200,a.type)}),d.head.appendChild(b[0])},abort:function(){c&&c()}}}});var Jb=[],Kb=/(=)\?(?=&|$)|\?\?/;n.ajaxSetup({jsonp:"callback",jsonpCallback:function(){var a=Jb.pop()||n.expando+"_"+kb++;return this[a]=!0,a}}),n.ajaxPrefilter("json jsonp",function(b,c,d){var e,f,g,h=b.jsonp!==!1&&(Kb.test(b.url)?"url":"string"==typeof b.data&&0===(b.contentType||"").indexOf("application/x-www-form-urlencoded")&&Kb.test(b.data)&&"data");return h||"jsonp"===b.dataTypes[0]?(e=b.jsonpCallback=n.isFunction(b.jsonpCallback)?b.jsonpCallback():b.jsonpCallback,h?b[h]=b[h].replace(Kb,"$1"+e):b.jsonp!==!1&&(b.url+=(lb.test(b.url)?"&":"?")+b.jsonp+"="+e),b.converters["script json"]=function(){return g||n.error(e+" was not called"),g[0]},b.dataTypes[0]="json",f=a[e],a[e]=function(){g=arguments},d.always(function(){void 0===f?n(a).removeProp(e):a[e]=f,b[e]&&(b.jsonpCallback=c.jsonpCallback,Jb.push(e)),g&&n.isFunction(f)&&f(g[0]),g=f=void 0}),"script"):void 0}),n.parseHTML=function(a,b,c){if(!a||"string"!=typeof a)return null;"boolean"==typeof b&&(c=b,b=!1),b=b||d;var e=x.exec(a),f=!c&&[];return e?[b.createElement(e[1])]:(e=ca([a],b,f),f&&f.length&&n(f).remove(),n.merge([],e.childNodes))};var Lb=n.fn.load;n.fn.load=function(a,b,c){if("string"!=typeof a&&Lb)return Lb.apply(this,arguments);var d,e,f,g=this,h=a.indexOf(" ");return h>-1&&(d=n.trim(a.slice(h)),a=a.slice(0,h)),n.isFunction(b)?(c=b,b=void 0):b&&"object"==typeof b&&(e="POST"),g.length>0&&n.ajax({url:a,type:e||"GET",dataType:"html",data:b}).done(function(a){f=arguments,g.html(d?n("<div>").append(n.parseHTML(a)).find(d):a)}).always(c&&function(a,b){g.each(function(){c.apply(this,f||[a.responseText,b,a])})}),this},n.each(["ajaxStart","ajaxStop","ajaxComplete","ajaxError","ajaxSuccess","ajaxSend"],function(a,b){n.fn[b]=function(a){return this.on(b,a)}}),n.expr.filters.animated=function(a){return n.grep(n.timers,function(b){return a===b.elem}).length};function Mb(a){return n.isWindow(a)?a:9===a.nodeType&&a.defaultView}n.offset={setOffset:function(a,b,c){var d,e,f,g,h,i,j,k=n.css(a,"position"),l=n(a),m={};"static"===k&&(a.style.position="relative"),h=l.offset(),f=n.css(a,"top"),i=n.css(a,"left"),j=("absolute"===k||"fixed"===k)&&(f+i).indexOf("auto")>-1,j?(d=l.position(),g=d.top,e=d.left):(g=parseFloat(f)||0,e=parseFloat(i)||0),n.isFunction(b)&&(b=b.call(a,c,n.extend({},h))),null!=b.top&&(m.top=b.top-h.top+g),null!=b.left&&(m.left=b.left-h.left+e),"using"in b?b.using.call(a,m):l.css(m)}},n.fn.extend({offset:function(a){if(arguments.length)return void 0===a?this:this.each(function(b){n.offset.setOffset(this,a,b)});var b,c,d=this[0],e={top:0,left:0},f=d&&d.ownerDocument;if(f)return b=f.documentElement,n.contains(b,d)?(e=d.getBoundingClientRect(),c=Mb(f),{top:e.top+c.pageYOffset-b.clientTop,left:e.left+c.pageXOffset-b.clientLeft}):e},position:function(){if(this[0]){var a,b,c=this[0],d={top:0,left:0};return"fixed"===n.css(c,"position")?b=c.getBoundingClientRect():(a=this.offsetParent(),b=this.offset(),n.nodeName(a[0],"html")||(d=a.offset()),d.top+=n.css(a[0],"borderTopWidth",!0),d.left+=n.css(a[0],"borderLeftWidth",!0)),{top:b.top-d.top-n.css(c,"marginTop",!0),left:b.left-d.left-n.css(c,"marginLeft",!0)}}},offsetParent:function(){return this.map(function(){var a=this.offsetParent;while(a&&"static"===n.css(a,"position"))a=a.offsetParent;return a||Ea})}}),n.each({scrollLeft:"pageXOffset",scrollTop:"pageYOffset"},function(a,b){var c="pageYOffset"===b;n.fn[a]=function(d){return K(this,function(a,d,e){var f=Mb(a);return void 0===e?f?f[b]:a[d]:void(f?f.scrollTo(c?f.pageXOffset:e,c?e:f.pageYOffset):a[d]=e)},a,d,arguments.length)}}),n.each(["top","left"],function(a,b){n.cssHooks[b]=Ga(l.pixelPosition,function(a,c){return c?(c=Fa(a,b),Ba.test(c)?n(a).position()[b]+"px":c):void 0})}),n.each({Height:"height",Width:"width"},function(a,b){n.each({padding:"inner"+a,content:b,"":"outer"+a},function(c,d){n.fn[d]=function(d,e){var f=arguments.length&&(c||"boolean"!=typeof d),g=c||(d===!0||e===!0?"margin":"border");return K(this,function(b,c,d){var e;return n.isWindow(b)?b.document.documentElement["client"+a]:9===b.nodeType?(e=b.documentElement,Math.max(b.body["scroll"+a],e["scroll"+a],b.body["offset"+a],e["offset"+a],e["client"+a])):void 0===d?n.css(b,c,g):n.style(b,c,d,g)},b,f?d:void 0,f,null)}})}),n.fn.extend({bind:function(a,b,c){return this.on(a,null,b,c)},unbind:function(a,b){return this.off(a,null,b)},delegate:function(a,b,c,d){return this.on(b,a,c,d)},undelegate:function(a,b,c){return 1===arguments.length?this.off(a,"**"):this.off(b,a||"**",c)},size:function(){return this.length}}),n.fn.andSelf=n.fn.addBack,"function"==typeof define&&define.amd&&define("jquery",[],function(){return n});var Nb=a.jQuery,Ob=a.$;return n.noConflict=function(b){return a.$===n&&(a.$=Ob),b&&a.jQuery===n&&(a.jQuery=Nb),n},b||(a.jQuery=a.$=n),n});

/*!
  * Bootstrap v4.5.0 (https://getbootstrap.com/)
  * Copyright 2011-2020 The Bootstrap Authors (https://github.com/twbs/bootstrap/graphs/contributors)
  * Licensed under MIT (https://github.com/twbs/bootstrap/blob/master/LICENSE)
  */
!function(t,e){"object"==typeof exports&&"undefined"!=typeof module?e(exports,require("jquery")):"function"==typeof define&&define.amd?define(["exports","jquery"],e):e((t=t||self).bootstrap={},t.jQuery)}(this,(function(t,e){"use strict";function n(t,e){for(var n=0;n<e.length;n++){var i=e[n];i.enumerable=i.enumerable||!1,i.configurable=!0,"value"in i&&(i.writable=!0),Object.defineProperty(t,i.key,i)}}function i(t,e,i){return e&&n(t.prototype,e),i&&n(t,i),t}function o(t,e,n){return e in t?Object.defineProperty(t,e,{value:n,enumerable:!0,configurable:!0,writable:!0}):t[e]=n,t}function r(t,e){var n=Object.keys(t);if(Object.getOwnPropertySymbols){var i=Object.getOwnPropertySymbols(t);e&&(i=i.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),n.push.apply(n,i)}return n}function s(t){for(var e=1;e<arguments.length;e++){var n=null!=arguments[e]?arguments[e]:{};e%2?r(Object(n),!0).forEach((function(e){o(t,e,n[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(n)):r(Object(n)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(n,e))}))}return t}e=e&&Object.prototype.hasOwnProperty.call(e,"default")?e.default:e;function a(t){var n=this,i=!1;return e(this).one(l.TRANSITION_END,(function(){i=!0})),setTimeout((function(){i||l.triggerTransitionEnd(n)}),t),this}var l={TRANSITION_END:"bsTransitionEnd",getUID:function(t){do{t+=~~(1e6*Math.random())}while(document.getElementById(t));return t},getSelectorFromElement:function(t){var e=t.getAttribute("data-target");if(!e||"#"===e){var n=t.getAttribute("href");e=n&&"#"!==n?n.trim():""}try{return document.querySelector(e)?e:null}catch(t){return null}},getTransitionDurationFromElement:function(t){if(!t)return 0;var n=e(t).css("transition-duration"),i=e(t).css("transition-delay"),o=parseFloat(n),r=parseFloat(i);return o||r?(n=n.split(",")[0],i=i.split(",")[0],1e3*(parseFloat(n)+parseFloat(i))):0},reflow:function(t){return t.offsetHeight},triggerTransitionEnd:function(t){e(t).trigger("transitionend")},supportsTransitionEnd:function(){return Boolean("transitionend")},isElement:function(t){return(t[0]||t).nodeType},typeCheckConfig:function(t,e,n){for(var i in n)if(Object.prototype.hasOwnProperty.call(n,i)){var o=n[i],r=e[i],s=r&&l.isElement(r)?"element":null===(a=r)||"undefined"==typeof a?""+a:{}.toString.call(a).match(/\s([a-z]+)/i)[1].toLowerCase();if(!new RegExp(o).test(s))throw new Error(t.toUpperCase()+': Option "'+i+'" provided type "'+s+'" but expected type "'+o+'".')}var a},findShadowRoot:function(t){if(!document.documentElement.attachShadow)return null;if("function"==typeof t.getRootNode){var e=t.getRootNode();return e instanceof ShadowRoot?e:null}return t instanceof ShadowRoot?t:t.parentNode?l.findShadowRoot(t.parentNode):null},jQueryDetection:function(){if("undefined"==typeof e)throw new TypeError("Bootstrap's JavaScript requires jQuery. jQuery must be included before Bootstrap's JavaScript.");var t=e.fn.jquery.split(" ")[0].split(".");if(t[0]<2&&t[1]<9||1===t[0]&&9===t[1]&&t[2]<1||t[0]>=4)throw new Error("Bootstrap's JavaScript requires at least jQuery v1.9.1 but less than v4.0.0")}};l.jQueryDetection(),e.fn.emulateTransitionEnd=a,e.event.special[l.TRANSITION_END]={bindType:"transitionend",delegateType:"transitionend",handle:function(t){if(e(t.target).is(this))return t.handleObj.handler.apply(this,arguments)}};var c="alert",u=e.fn[c],h=function(){function t(t){this._element=t}var n=t.prototype;return n.close=function(t){var e=this._element;t&&(e=this._getRootElement(t)),this._triggerCloseEvent(e).isDefaultPrevented()||this._removeElement(e)},n.dispose=function(){e.removeData(this._element,"bs.alert"),this._element=null},n._getRootElement=function(t){var n=l.getSelectorFromElement(t),i=!1;return n&&(i=document.querySelector(n)),i||(i=e(t).closest(".alert")[0]),i},n._triggerCloseEvent=function(t){var n=e.Event("close.bs.alert");return e(t).trigger(n),n},n._removeElement=function(t){var n=this;if(e(t).removeClass("show"),e(t).hasClass("fade")){var i=l.getTransitionDurationFromElement(t);e(t).one(l.TRANSITION_END,(function(e){return n._destroyElement(t,e)})).emulateTransitionEnd(i)}else this._destroyElement(t)},n._destroyElement=function(t){e(t).detach().trigger("closed.bs.alert").remove()},t._jQueryInterface=function(n){return this.each((function(){var i=e(this),o=i.data("bs.alert");o||(o=new t(this),i.data("bs.alert",o)),"close"===n&&o[n](this)}))},t._handleDismiss=function(t){return function(e){e&&e.preventDefault(),t.close(this)}},i(t,null,[{key:"VERSION",get:function(){return"4.5.0"}}]),t}();e(document).on("click.bs.alert.data-api",'[data-dismiss="alert"]',h._handleDismiss(new h)),e.fn[c]=h._jQueryInterface,e.fn[c].Constructor=h,e.fn[c].noConflict=function(){return e.fn[c]=u,h._jQueryInterface};var f=e.fn.button,d=function(){function t(t){this._element=t}var n=t.prototype;return n.toggle=function(){var t=!0,n=!0,i=e(this._element).closest('[data-toggle="buttons"]')[0];if(i){var o=this._element.querySelector('input:not([type="hidden"])');if(o){if("radio"===o.type)if(o.checked&&this._element.classList.contains("active"))t=!1;else{var r=i.querySelector(".active");r&&e(r).removeClass("active")}t&&("checkbox"!==o.type&&"radio"!==o.type||(o.checked=!this._element.classList.contains("active")),e(o).trigger("change")),o.focus(),n=!1}}this._element.hasAttribute("disabled")||this._element.classList.contains("disabled")||(n&&this._element.setAttribute("aria-pressed",!this._element.classList.contains("active")),t&&e(this._element).toggleClass("active"))},n.dispose=function(){e.removeData(this._element,"bs.button"),this._element=null},t._jQueryInterface=function(n){return this.each((function(){var i=e(this).data("bs.button");i||(i=new t(this),e(this).data("bs.button",i)),"toggle"===n&&i[n]()}))},i(t,null,[{key:"VERSION",get:function(){return"4.5.0"}}]),t}();e(document).on("click.bs.button.data-api",'[data-toggle^="button"]',(function(t){var n=t.target,i=n;if(e(n).hasClass("btn")||(n=e(n).closest(".btn")[0]),!n||n.hasAttribute("disabled")||n.classList.contains("disabled"))t.preventDefault();else{var o=n.querySelector('input:not([type="hidden"])');if(o&&(o.hasAttribute("disabled")||o.classList.contains("disabled")))return void t.preventDefault();"LABEL"===i.tagName&&o&&"checkbox"===o.type&&t.preventDefault(),d._jQueryInterface.call(e(n),"toggle")}})).on("focus.bs.button.data-api blur.bs.button.data-api",'[data-toggle^="button"]',(function(t){var n=e(t.target).closest(".btn")[0];e(n).toggleClass("focus",/^focus(in)?$/.test(t.type))})),e(window).on("load.bs.button.data-api",(function(){for(var t=[].slice.call(document.querySelectorAll('[data-toggle="buttons"] .btn')),e=0,n=t.length;e<n;e++){var i=t[e],o=i.querySelector('input:not([type="hidden"])');o.checked||o.hasAttribute("checked")?i.classList.add("active"):i.classList.remove("active")}for(var r=0,s=(t=[].slice.call(document.querySelectorAll('[data-toggle="button"]'))).length;r<s;r++){var a=t[r];"true"===a.getAttribute("aria-pressed")?a.classList.add("active"):a.classList.remove("active")}})),e.fn.button=d._jQueryInterface,e.fn.button.Constructor=d,e.fn.button.noConflict=function(){return e.fn.button=f,d._jQueryInterface};var p="carousel",m=".bs.carousel",g=e.fn[p],v={interval:5e3,keyboard:!0,slide:!1,pause:"hover",wrap:!0,touch:!0},_={interval:"(number|boolean)",keyboard:"boolean",slide:"(boolean|string)",pause:"(string|boolean)",wrap:"boolean",touch:"boolean"},b={TOUCH:"touch",PEN:"pen"},y=function(){function t(t,e){this._items=null,this._interval=null,this._activeElement=null,this._isPaused=!1,this._isSliding=!1,this.touchTimeout=null,this.touchStartX=0,this.touchDeltaX=0,this._config=this._getConfig(e),this._element=t,this._indicatorsElement=this._element.querySelector(".carousel-indicators"),this._touchSupported="ontouchstart"in document.documentElement||navigator.maxTouchPoints>0,this._pointerEvent=Boolean(window.PointerEvent||window.MSPointerEvent),this._addEventListeners()}var n=t.prototype;return n.next=function(){this._isSliding||this._slide("next")},n.nextWhenVisible=function(){!document.hidden&&e(this._element).is(":visible")&&"hidden"!==e(this._element).css("visibility")&&this.next()},n.prev=function(){this._isSliding||this._slide("prev")},n.pause=function(t){t||(this._isPaused=!0),this._element.querySelector(".carousel-item-next, .carousel-item-prev")&&(l.triggerTransitionEnd(this._element),this.cycle(!0)),clearInterval(this._interval),this._interval=null},n.cycle=function(t){t||(this._isPaused=!1),this._interval&&(clearInterval(this._interval),this._interval=null),this._config.interval&&!this._isPaused&&(this._interval=setInterval((document.visibilityState?this.nextWhenVisible:this.next).bind(this),this._config.interval))},n.to=function(t){var n=this;this._activeElement=this._element.querySelector(".active.carousel-item");var i=this._getItemIndex(this._activeElement);if(!(t>this._items.length-1||t<0))if(this._isSliding)e(this._element).one("slid.bs.carousel",(function(){return n.to(t)}));else{if(i===t)return this.pause(),void this.cycle();var o=t>i?"next":"prev";this._slide(o,this._items[t])}},n.dispose=function(){e(this._element).off(m),e.removeData(this._element,"bs.carousel"),this._items=null,this._config=null,this._element=null,this._interval=null,this._isPaused=null,this._isSliding=null,this._activeElement=null,this._indicatorsElement=null},n._getConfig=function(t){return t=s(s({},v),t),l.typeCheckConfig(p,t,_),t},n._handleSwipe=function(){var t=Math.abs(this.touchDeltaX);if(!(t<=40)){var e=t/this.touchDeltaX;this.touchDeltaX=0,e>0&&this.prev(),e<0&&this.next()}},n._addEventListeners=function(){var t=this;this._config.keyboard&&e(this._element).on("keydown.bs.carousel",(function(e){return t._keydown(e)})),"hover"===this._config.pause&&e(this._element).on("mouseenter.bs.carousel",(function(e){return t.pause(e)})).on("mouseleave.bs.carousel",(function(e){return t.cycle(e)})),this._config.touch&&this._addTouchEventListeners()},n._addTouchEventListeners=function(){var t=this;if(this._touchSupported){var n=function(e){t._pointerEvent&&b[e.originalEvent.pointerType.toUpperCase()]?t.touchStartX=e.originalEvent.clientX:t._pointerEvent||(t.touchStartX=e.originalEvent.touches[0].clientX)},i=function(e){t._pointerEvent&&b[e.originalEvent.pointerType.toUpperCase()]&&(t.touchDeltaX=e.originalEvent.clientX-t.touchStartX),t._handleSwipe(),"hover"===t._config.pause&&(t.pause(),t.touchTimeout&&clearTimeout(t.touchTimeout),t.touchTimeout=setTimeout((function(e){return t.cycle(e)}),500+t._config.interval))};e(this._element.querySelectorAll(".carousel-item img")).on("dragstart.bs.carousel",(function(t){return t.preventDefault()})),this._pointerEvent?(e(this._element).on("pointerdown.bs.carousel",(function(t){return n(t)})),e(this._element).on("pointerup.bs.carousel",(function(t){return i(t)})),this._element.classList.add("pointer-event")):(e(this._element).on("touchstart.bs.carousel",(function(t){return n(t)})),e(this._element).on("touchmove.bs.carousel",(function(e){return function(e){e.originalEvent.touches&&e.originalEvent.touches.length>1?t.touchDeltaX=0:t.touchDeltaX=e.originalEvent.touches[0].clientX-t.touchStartX}(e)})),e(this._element).on("touchend.bs.carousel",(function(t){return i(t)})))}},n._keydown=function(t){if(!/input|textarea/i.test(t.target.tagName))switch(t.which){case 37:t.preventDefault(),this.prev();break;case 39:t.preventDefault(),this.next()}},n._getItemIndex=function(t){return this._items=t&&t.parentNode?[].slice.call(t.parentNode.querySelectorAll(".carousel-item")):[],this._items.indexOf(t)},n._getItemByDirection=function(t,e){var n="next"===t,i="prev"===t,o=this._getItemIndex(e),r=this._items.length-1;if((i&&0===o||n&&o===r)&&!this._config.wrap)return e;var s=(o+("prev"===t?-1:1))%this._items.length;return-1===s?this._items[this._items.length-1]:this._items[s]},n._triggerSlideEvent=function(t,n){var i=this._getItemIndex(t),o=this._getItemIndex(this._element.querySelector(".active.carousel-item")),r=e.Event("slide.bs.carousel",{relatedTarget:t,direction:n,from:o,to:i});return e(this._element).trigger(r),r},n._setActiveIndicatorElement=function(t){if(this._indicatorsElement){var n=[].slice.call(this._indicatorsElement.querySelectorAll(".active"));e(n).removeClass("active");var i=this._indicatorsElement.children[this._getItemIndex(t)];i&&e(i).addClass("active")}},n._slide=function(t,n){var i,o,r,s=this,a=this._element.querySelector(".active.carousel-item"),c=this._getItemIndex(a),u=n||a&&this._getItemByDirection(t,a),h=this._getItemIndex(u),f=Boolean(this._interval);if("next"===t?(i="carousel-item-left",o="carousel-item-next",r="left"):(i="carousel-item-right",o="carousel-item-prev",r="right"),u&&e(u).hasClass("active"))this._isSliding=!1;else if(!this._triggerSlideEvent(u,r).isDefaultPrevented()&&a&&u){this._isSliding=!0,f&&this.pause(),this._setActiveIndicatorElement(u);var d=e.Event("slid.bs.carousel",{relatedTarget:u,direction:r,from:c,to:h});if(e(this._element).hasClass("slide")){e(u).addClass(o),l.reflow(u),e(a).addClass(i),e(u).addClass(i);var p=parseInt(u.getAttribute("data-interval"),10);p?(this._config.defaultInterval=this._config.defaultInterval||this._config.interval,this._config.interval=p):this._config.interval=this._config.defaultInterval||this._config.interval;var m=l.getTransitionDurationFromElement(a);e(a).one(l.TRANSITION_END,(function(){e(u).removeClass(i+" "+o).addClass("active"),e(a).removeClass("active "+o+" "+i),s._isSliding=!1,setTimeout((function(){return e(s._element).trigger(d)}),0)})).emulateTransitionEnd(m)}else e(a).removeClass("active"),e(u).addClass("active"),this._isSliding=!1,e(this._element).trigger(d);f&&this.cycle()}},t._jQueryInterface=function(n){return this.each((function(){var i=e(this).data("bs.carousel"),o=s(s({},v),e(this).data());"object"==typeof n&&(o=s(s({},o),n));var r="string"==typeof n?n:o.slide;if(i||(i=new t(this,o),e(this).data("bs.carousel",i)),"number"==typeof n)i.to(n);else if("string"==typeof r){if("undefined"==typeof i[r])throw new TypeError('No method named "'+r+'"');i[r]()}else o.interval&&o.ride&&(i.pause(),i.cycle())}))},t._dataApiClickHandler=function(n){var i=l.getSelectorFromElement(this);if(i){var o=e(i)[0];if(o&&e(o).hasClass("carousel")){var r=s(s({},e(o).data()),e(this).data()),a=this.getAttribute("data-slide-to");a&&(r.interval=!1),t._jQueryInterface.call(e(o),r),a&&e(o).data("bs.carousel").to(a),n.preventDefault()}}},i(t,null,[{key:"VERSION",get:function(){return"4.5.0"}},{key:"Default",get:function(){return v}}]),t}();e(document).on("click.bs.carousel.data-api","[data-slide], [data-slide-to]",y._dataApiClickHandler),e(window).on("load.bs.carousel.data-api",(function(){for(var t=[].slice.call(document.querySelectorAll('[data-ride="carousel"]')),n=0,i=t.length;n<i;n++){var o=e(t[n]);y._jQueryInterface.call(o,o.data())}})),e.fn[p]=y._jQueryInterface,e.fn[p].Constructor=y,e.fn[p].noConflict=function(){return e.fn[p]=g,y._jQueryInterface};var w="collapse",E=e.fn[w],T={toggle:!0,parent:""},C={toggle:"boolean",parent:"(string|element)"},S=function(){function t(t,e){this._isTransitioning=!1,this._element=t,this._config=this._getConfig(e),this._triggerArray=[].slice.call(document.querySelectorAll('[data-toggle="collapse"][href="#'+t.id+'"],[data-toggle="collapse"][data-target="#'+t.id+'"]'));for(var n=[].slice.call(document.querySelectorAll('[data-toggle="collapse"]')),i=0,o=n.length;i<o;i++){var r=n[i],s=l.getSelectorFromElement(r),a=[].slice.call(document.querySelectorAll(s)).filter((function(e){return e===t}));null!==s&&a.length>0&&(this._selector=s,this._triggerArray.push(r))}this._parent=this._config.parent?this._getParent():null,this._config.parent||this._addAriaAndCollapsedClass(this._element,this._triggerArray),this._config.toggle&&this.toggle()}var n=t.prototype;return n.toggle=function(){e(this._element).hasClass("show")?this.hide():this.show()},n.show=function(){var n,i,o=this;if(!this._isTransitioning&&!e(this._element).hasClass("show")&&(this._parent&&0===(n=[].slice.call(this._parent.querySelectorAll(".show, .collapsing")).filter((function(t){return"string"==typeof o._config.parent?t.getAttribute("data-parent")===o._config.parent:t.classList.contains("collapse")}))).length&&(n=null),!(n&&(i=e(n).not(this._selector).data("bs.collapse"))&&i._isTransitioning))){var r=e.Event("show.bs.collapse");if(e(this._element).trigger(r),!r.isDefaultPrevented()){n&&(t._jQueryInterface.call(e(n).not(this._selector),"hide"),i||e(n).data("bs.collapse",null));var s=this._getDimension();e(this._element).removeClass("collapse").addClass("collapsing"),this._element.style[s]=0,this._triggerArray.length&&e(this._triggerArray).removeClass("collapsed").attr("aria-expanded",!0),this.setTransitioning(!0);var a="scroll"+(s[0].toUpperCase()+s.slice(1)),c=l.getTransitionDurationFromElement(this._element);e(this._element).one(l.TRANSITION_END,(function(){e(o._element).removeClass("collapsing").addClass("collapse show"),o._element.style[s]="",o.setTransitioning(!1),e(o._element).trigger("shown.bs.collapse")})).emulateTransitionEnd(c),this._element.style[s]=this._element[a]+"px"}}},n.hide=function(){var t=this;if(!this._isTransitioning&&e(this._element).hasClass("show")){var n=e.Event("hide.bs.collapse");if(e(this._element).trigger(n),!n.isDefaultPrevented()){var i=this._getDimension();this._element.style[i]=this._element.getBoundingClientRect()[i]+"px",l.reflow(this._element),e(this._element).addClass("collapsing").removeClass("collapse show");var o=this._triggerArray.length;if(o>0)for(var r=0;r<o;r++){var s=this._triggerArray[r],a=l.getSelectorFromElement(s);if(null!==a)e([].slice.call(document.querySelectorAll(a))).hasClass("show")||e(s).addClass("collapsed").attr("aria-expanded",!1)}this.setTransitioning(!0);this._element.style[i]="";var c=l.getTransitionDurationFromElement(this._element);e(this._element).one(l.TRANSITION_END,(function(){t.setTransitioning(!1),e(t._element).removeClass("collapsing").addClass("collapse").trigger("hidden.bs.collapse")})).emulateTransitionEnd(c)}}},n.setTransitioning=function(t){this._isTransitioning=t},n.dispose=function(){e.removeData(this._element,"bs.collapse"),this._config=null,this._parent=null,this._element=null,this._triggerArray=null,this._isTransitioning=null},n._getConfig=function(t){return(t=s(s({},T),t)).toggle=Boolean(t.toggle),l.typeCheckConfig(w,t,C),t},n._getDimension=function(){return e(this._element).hasClass("width")?"width":"height"},n._getParent=function(){var n,i=this;l.isElement(this._config.parent)?(n=this._config.parent,"undefined"!=typeof this._config.parent.jquery&&(n=this._config.parent[0])):n=document.querySelector(this._config.parent);var o='[data-toggle="collapse"][data-parent="'+this._config.parent+'"]',r=[].slice.call(n.querySelectorAll(o));return e(r).each((function(e,n){i._addAriaAndCollapsedClass(t._getTargetFromElement(n),[n])})),n},n._addAriaAndCollapsedClass=function(t,n){var i=e(t).hasClass("show");n.length&&e(n).toggleClass("collapsed",!i).attr("aria-expanded",i)},t._getTargetFromElement=function(t){var e=l.getSelectorFromElement(t);return e?document.querySelector(e):null},t._jQueryInterface=function(n){return this.each((function(){var i=e(this),o=i.data("bs.collapse"),r=s(s(s({},T),i.data()),"object"==typeof n&&n?n:{});if(!o&&r.toggle&&"string"==typeof n&&/show|hide/.test(n)&&(r.toggle=!1),o||(o=new t(this,r),i.data("bs.collapse",o)),"string"==typeof n){if("undefined"==typeof o[n])throw new TypeError('No method named "'+n+'"');o[n]()}}))},i(t,null,[{key:"VERSION",get:function(){return"4.5.0"}},{key:"Default",get:function(){return T}}]),t}();e(document).on("click.bs.collapse.data-api",'[data-toggle="collapse"]',(function(t){"A"===t.currentTarget.tagName&&t.preventDefault();var n=e(this),i=l.getSelectorFromElement(this),o=[].slice.call(document.querySelectorAll(i));e(o).each((function(){var t=e(this),i=t.data("bs.collapse")?"toggle":n.data();S._jQueryInterface.call(t,i)}))})),e.fn[w]=S._jQueryInterface,e.fn[w].Constructor=S,e.fn[w].noConflict=function(){return e.fn[w]=E,S._jQueryInterface};var D="undefined"!=typeof window&&"undefined"!=typeof document&&"undefined"!=typeof navigator,k=function(){for(var t=["Edge","Trident","Firefox"],e=0;e<t.length;e+=1)if(D&&navigator.userAgent.indexOf(t[e])>=0)return 1;return 0}();var N=D&&window.Promise?function(t){var e=!1;return function(){e||(e=!0,window.Promise.resolve().then((function(){e=!1,t()})))}}:function(t){var e=!1;return function(){e||(e=!0,setTimeout((function(){e=!1,t()}),k))}};function O(t){return t&&"[object Function]"==={}.toString.call(t)}function A(t,e){if(1!==t.nodeType)return[];var n=t.ownerDocument.defaultView.getComputedStyle(t,null);return e?n[e]:n}function I(t){return"HTML"===t.nodeName?t:t.parentNode||t.host}function x(t){if(!t)return document.body;switch(t.nodeName){case"HTML":case"BODY":return t.ownerDocument.body;case"#document":return t.body}var e=A(t),n=e.overflow,i=e.overflowX,o=e.overflowY;return/(auto|scroll|overlay)/.test(n+o+i)?t:x(I(t))}function j(t){return t&&t.referenceNode?t.referenceNode:t}var L=D&&!(!window.MSInputMethodContext||!document.documentMode),P=D&&/MSIE 10/.test(navigator.userAgent);function F(t){return 11===t?L:10===t?P:L||P}function R(t){if(!t)return document.documentElement;for(var e=F(10)?document.body:null,n=t.offsetParent||null;n===e&&t.nextElementSibling;)n=(t=t.nextElementSibling).offsetParent;var i=n&&n.nodeName;return i&&"BODY"!==i&&"HTML"!==i?-1!==["TH","TD","TABLE"].indexOf(n.nodeName)&&"static"===A(n,"position")?R(n):n:t?t.ownerDocument.documentElement:document.documentElement}function M(t){return null!==t.parentNode?M(t.parentNode):t}function B(t,e){if(!(t&&t.nodeType&&e&&e.nodeType))return document.documentElement;var n=t.compareDocumentPosition(e)&Node.DOCUMENT_POSITION_FOLLOWING,i=n?t:e,o=n?e:t,r=document.createRange();r.setStart(i,0),r.setEnd(o,0);var s,a,l=r.commonAncestorContainer;if(t!==l&&e!==l||i.contains(o))return"BODY"===(a=(s=l).nodeName)||"HTML"!==a&&R(s.firstElementChild)!==s?R(l):l;var c=M(t);return c.host?B(c.host,e):B(t,M(e).host)}function q(t){var e=arguments.length>1&&void 0!==arguments[1]?arguments[1]:"top",n="top"===e?"scrollTop":"scrollLeft",i=t.nodeName;if("BODY"===i||"HTML"===i){var o=t.ownerDocument.documentElement,r=t.ownerDocument.scrollingElement||o;return r[n]}return t[n]}function H(t,e){var n=arguments.length>2&&void 0!==arguments[2]&&arguments[2],i=q(e,"top"),o=q(e,"left"),r=n?-1:1;return t.top+=i*r,t.bottom+=i*r,t.left+=o*r,t.right+=o*r,t}function Q(t,e){var n="x"===e?"Left":"Top",i="Left"===n?"Right":"Bottom";return parseFloat(t["border"+n+"Width"],10)+parseFloat(t["border"+i+"Width"],10)}function W(t,e,n,i){return Math.max(e["offset"+t],e["scroll"+t],n["client"+t],n["offset"+t],n["scroll"+t],F(10)?parseInt(n["offset"+t])+parseInt(i["margin"+("Height"===t?"Top":"Left")])+parseInt(i["margin"+("Height"===t?"Bottom":"Right")]):0)}function U(t){var e=t.body,n=t.documentElement,i=F(10)&&getComputedStyle(n);return{height:W("Height",e,n,i),width:W("Width",e,n,i)}}var V=function(t,e){if(!(t instanceof e))throw new TypeError("Cannot call a class as a function")},Y=function(){function t(t,e){for(var n=0;n<e.length;n++){var i=e[n];i.enumerable=i.enumerable||!1,i.configurable=!0,"value"in i&&(i.writable=!0),Object.defineProperty(t,i.key,i)}}return function(e,n,i){return n&&t(e.prototype,n),i&&t(e,i),e}}(),z=function(t,e,n){return e in t?Object.defineProperty(t,e,{value:n,enumerable:!0,configurable:!0,writable:!0}):t[e]=n,t},X=Object.assign||function(t){for(var e=1;e<arguments.length;e++){var n=arguments[e];for(var i in n)Object.prototype.hasOwnProperty.call(n,i)&&(t[i]=n[i])}return t};function K(t){return X({},t,{right:t.left+t.width,bottom:t.top+t.height})}function G(t){var e={};try{if(F(10)){e=t.getBoundingClientRect();var n=q(t,"top"),i=q(t,"left");e.top+=n,e.left+=i,e.bottom+=n,e.right+=i}else e=t.getBoundingClientRect()}catch(t){}var o={left:e.left,top:e.top,width:e.right-e.left,height:e.bottom-e.top},r="HTML"===t.nodeName?U(t.ownerDocument):{},s=r.width||t.clientWidth||o.width,a=r.height||t.clientHeight||o.height,l=t.offsetWidth-s,c=t.offsetHeight-a;if(l||c){var u=A(t);l-=Q(u,"x"),c-=Q(u,"y"),o.width-=l,o.height-=c}return K(o)}function $(t,e){var n=arguments.length>2&&void 0!==arguments[2]&&arguments[2],i=F(10),o="HTML"===e.nodeName,r=G(t),s=G(e),a=x(t),l=A(e),c=parseFloat(l.borderTopWidth,10),u=parseFloat(l.borderLeftWidth,10);n&&o&&(s.top=Math.max(s.top,0),s.left=Math.max(s.left,0));var h=K({top:r.top-s.top-c,left:r.left-s.left-u,width:r.width,height:r.height});if(h.marginTop=0,h.marginLeft=0,!i&&o){var f=parseFloat(l.marginTop,10),d=parseFloat(l.marginLeft,10);h.top-=c-f,h.bottom-=c-f,h.left-=u-d,h.right-=u-d,h.marginTop=f,h.marginLeft=d}return(i&&!n?e.contains(a):e===a&&"BODY"!==a.nodeName)&&(h=H(h,e)),h}function J(t){var e=arguments.length>1&&void 0!==arguments[1]&&arguments[1],n=t.ownerDocument.documentElement,i=$(t,n),o=Math.max(n.clientWidth,window.innerWidth||0),r=Math.max(n.clientHeight,window.innerHeight||0),s=e?0:q(n),a=e?0:q(n,"left"),l={top:s-i.top+i.marginTop,left:a-i.left+i.marginLeft,width:o,height:r};return K(l)}function Z(t){var e=t.nodeName;if("BODY"===e||"HTML"===e)return!1;if("fixed"===A(t,"position"))return!0;var n=I(t);return!!n&&Z(n)}function tt(t){if(!t||!t.parentElement||F())return document.documentElement;for(var e=t.parentElement;e&&"none"===A(e,"transform");)e=e.parentElement;return e||document.documentElement}function et(t,e,n,i){var o=arguments.length>4&&void 0!==arguments[4]&&arguments[4],r={top:0,left:0},s=o?tt(t):B(t,j(e));if("viewport"===i)r=J(s,o);else{var a=void 0;"scrollParent"===i?"BODY"===(a=x(I(e))).nodeName&&(a=t.ownerDocument.documentElement):a="window"===i?t.ownerDocument.documentElement:i;var l=$(a,s,o);if("HTML"!==a.nodeName||Z(s))r=l;else{var c=U(t.ownerDocument),u=c.height,h=c.width;r.top+=l.top-l.marginTop,r.bottom=u+l.top,r.left+=l.left-l.marginLeft,r.right=h+l.left}}var f="number"==typeof(n=n||0);return r.left+=f?n:n.left||0,r.top+=f?n:n.top||0,r.right-=f?n:n.right||0,r.bottom-=f?n:n.bottom||0,r}function nt(t){return t.width*t.height}function it(t,e,n,i,o){var r=arguments.length>5&&void 0!==arguments[5]?arguments[5]:0;if(-1===t.indexOf("auto"))return t;var s=et(n,i,r,o),a={top:{width:s.width,height:e.top-s.top},right:{width:s.right-e.right,height:s.height},bottom:{width:s.width,height:s.bottom-e.bottom},left:{width:e.left-s.left,height:s.height}},l=Object.keys(a).map((function(t){return X({key:t},a[t],{area:nt(a[t])})})).sort((function(t,e){return e.area-t.area})),c=l.filter((function(t){var e=t.width,i=t.height;return e>=n.clientWidth&&i>=n.clientHeight})),u=c.length>0?c[0].key:l[0].key,h=t.split("-")[1];return u+(h?"-"+h:"")}function ot(t,e,n){var i=arguments.length>3&&void 0!==arguments[3]?arguments[3]:null,o=i?tt(e):B(e,j(n));return $(n,o,i)}function rt(t){var e=t.ownerDocument.defaultView.getComputedStyle(t),n=parseFloat(e.marginTop||0)+parseFloat(e.marginBottom||0),i=parseFloat(e.marginLeft||0)+parseFloat(e.marginRight||0);return{width:t.offsetWidth+i,height:t.offsetHeight+n}}function st(t){var e={left:"right",right:"left",bottom:"top",top:"bottom"};return t.replace(/left|right|bottom|top/g,(function(t){return e[t]}))}function at(t,e,n){n=n.split("-")[0];var i=rt(t),o={width:i.width,height:i.height},r=-1!==["right","left"].indexOf(n),s=r?"top":"left",a=r?"left":"top",l=r?"height":"width",c=r?"width":"height";return o[s]=e[s]+e[l]/2-i[l]/2,o[a]=n===a?e[a]-i[c]:e[st(a)],o}function lt(t,e){return Array.prototype.find?t.find(e):t.filter(e)[0]}function ct(t,e,n){return(void 0===n?t:t.slice(0,function(t,e,n){if(Array.prototype.findIndex)return t.findIndex((function(t){return t[e]===n}));var i=lt(t,(function(t){return t[e]===n}));return t.indexOf(i)}(t,"name",n))).forEach((function(t){t.function&&console.warn("`modifier.function` is deprecated, use `modifier.fn`!");var n=t.function||t.fn;t.enabled&&O(n)&&(e.offsets.popper=K(e.offsets.popper),e.offsets.reference=K(e.offsets.reference),e=n(e,t))})),e}function ut(){if(!this.state.isDestroyed){var t={instance:this,styles:{},arrowStyles:{},attributes:{},flipped:!1,offsets:{}};t.offsets.reference=ot(this.state,this.popper,this.reference,this.options.positionFixed),t.placement=it(this.options.placement,t.offsets.reference,this.popper,this.reference,this.options.modifiers.flip.boundariesElement,this.options.modifiers.flip.padding),t.originalPlacement=t.placement,t.positionFixed=this.options.positionFixed,t.offsets.popper=at(this.popper,t.offsets.reference,t.placement),t.offsets.popper.position=this.options.positionFixed?"fixed":"absolute",t=ct(this.modifiers,t),this.state.isCreated?this.options.onUpdate(t):(this.state.isCreated=!0,this.options.onCreate(t))}}function ht(t,e){return t.some((function(t){var n=t.name;return t.enabled&&n===e}))}function ft(t){for(var e=[!1,"ms","Webkit","Moz","O"],n=t.charAt(0).toUpperCase()+t.slice(1),i=0;i<e.length;i++){var o=e[i],r=o?""+o+n:t;if("undefined"!=typeof document.body.style[r])return r}return null}function dt(){return this.state.isDestroyed=!0,ht(this.modifiers,"applyStyle")&&(this.popper.removeAttribute("x-placement"),this.popper.style.position="",this.popper.style.top="",this.popper.style.left="",this.popper.style.right="",this.popper.style.bottom="",this.popper.style.willChange="",this.popper.style[ft("transform")]=""),this.disableEventListeners(),this.options.removeOnDestroy&&this.popper.parentNode.removeChild(this.popper),this}function pt(t){var e=t.ownerDocument;return e?e.defaultView:window}function mt(t,e,n,i){n.updateBound=i,pt(t).addEventListener("resize",n.updateBound,{passive:!0});var o=x(t);return function t(e,n,i,o){var r="BODY"===e.nodeName,s=r?e.ownerDocument.defaultView:e;s.addEventListener(n,i,{passive:!0}),r||t(x(s.parentNode),n,i,o),o.push(s)}(o,"scroll",n.updateBound,n.scrollParents),n.scrollElement=o,n.eventsEnabled=!0,n}function gt(){this.state.eventsEnabled||(this.state=mt(this.reference,this.options,this.state,this.scheduleUpdate))}function vt(){var t,e;this.state.eventsEnabled&&(cancelAnimationFrame(this.scheduleUpdate),this.state=(t=this.reference,e=this.state,pt(t).removeEventListener("resize",e.updateBound),e.scrollParents.forEach((function(t){t.removeEventListener("scroll",e.updateBound)})),e.updateBound=null,e.scrollParents=[],e.scrollElement=null,e.eventsEnabled=!1,e))}function _t(t){return""!==t&&!isNaN(parseFloat(t))&&isFinite(t)}function bt(t,e){Object.keys(e).forEach((function(n){var i="";-1!==["width","height","top","right","bottom","left"].indexOf(n)&&_t(e[n])&&(i="px"),t.style[n]=e[n]+i}))}var yt=D&&/Firefox/i.test(navigator.userAgent);function wt(t,e,n){var i=lt(t,(function(t){return t.name===e})),o=!!i&&t.some((function(t){return t.name===n&&t.enabled&&t.order<i.order}));if(!o){var r="`"+e+"`",s="`"+n+"`";console.warn(s+" modifier is required by "+r+" modifier in order to work, be sure to include it before "+r+"!")}return o}var Et=["auto-start","auto","auto-end","top-start","top","top-end","right-start","right","right-end","bottom-end","bottom","bottom-start","left-end","left","left-start"],Tt=Et.slice(3);function Ct(t){var e=arguments.length>1&&void 0!==arguments[1]&&arguments[1],n=Tt.indexOf(t),i=Tt.slice(n+1).concat(Tt.slice(0,n));return e?i.reverse():i}var St="flip",Dt="clockwise",kt="counterclockwise";function Nt(t,e,n,i){var o=[0,0],r=-1!==["right","left"].indexOf(i),s=t.split(/(\+|\-)/).map((function(t){return t.trim()})),a=s.indexOf(lt(s,(function(t){return-1!==t.search(/,|\s/)})));s[a]&&-1===s[a].indexOf(",")&&console.warn("Offsets separated by white space(s) are deprecated, use a comma (,) instead.");var l=/\s*,\s*|\s+/,c=-1!==a?[s.slice(0,a).concat([s[a].split(l)[0]]),[s[a].split(l)[1]].concat(s.slice(a+1))]:[s];return(c=c.map((function(t,i){var o=(1===i?!r:r)?"height":"width",s=!1;return t.reduce((function(t,e){return""===t[t.length-1]&&-1!==["+","-"].indexOf(e)?(t[t.length-1]=e,s=!0,t):s?(t[t.length-1]+=e,s=!1,t):t.concat(e)}),[]).map((function(t){return function(t,e,n,i){var o=t.match(/((?:\-|\+)?\d*\.?\d*)(.*)/),r=+o[1],s=o[2];if(!r)return t;if(0===s.indexOf("%")){var a=void 0;switch(s){case"%p":a=n;break;case"%":case"%r":default:a=i}return K(a)[e]/100*r}if("vh"===s||"vw"===s){return("vh"===s?Math.max(document.documentElement.clientHeight,window.innerHeight||0):Math.max(document.documentElement.clientWidth,window.innerWidth||0))/100*r}return r}(t,o,e,n)}))}))).forEach((function(t,e){t.forEach((function(n,i){_t(n)&&(o[e]+=n*("-"===t[i-1]?-1:1))}))})),o}var Ot={placement:"bottom",positionFixed:!1,eventsEnabled:!0,removeOnDestroy:!1,onCreate:function(){},onUpdate:function(){},modifiers:{shift:{order:100,enabled:!0,fn:function(t){var e=t.placement,n=e.split("-")[0],i=e.split("-")[1];if(i){var o=t.offsets,r=o.reference,s=o.popper,a=-1!==["bottom","top"].indexOf(n),l=a?"left":"top",c=a?"width":"height",u={start:z({},l,r[l]),end:z({},l,r[l]+r[c]-s[c])};t.offsets.popper=X({},s,u[i])}return t}},offset:{order:200,enabled:!0,fn:function(t,e){var n=e.offset,i=t.placement,o=t.offsets,r=o.popper,s=o.reference,a=i.split("-")[0],l=void 0;return l=_t(+n)?[+n,0]:Nt(n,r,s,a),"left"===a?(r.top+=l[0],r.left-=l[1]):"right"===a?(r.top+=l[0],r.left+=l[1]):"top"===a?(r.left+=l[0],r.top-=l[1]):"bottom"===a&&(r.left+=l[0],r.top+=l[1]),t.popper=r,t},offset:0},preventOverflow:{order:300,enabled:!0,fn:function(t,e){var n=e.boundariesElement||R(t.instance.popper);t.instance.reference===n&&(n=R(n));var i=ft("transform"),o=t.instance.popper.style,r=o.top,s=o.left,a=o[i];o.top="",o.left="",o[i]="";var l=et(t.instance.popper,t.instance.reference,e.padding,n,t.positionFixed);o.top=r,o.left=s,o[i]=a,e.boundaries=l;var c=e.priority,u=t.offsets.popper,h={primary:function(t){var n=u[t];return u[t]<l[t]&&!e.escapeWithReference&&(n=Math.max(u[t],l[t])),z({},t,n)},secondary:function(t){var n="right"===t?"left":"top",i=u[n];return u[t]>l[t]&&!e.escapeWithReference&&(i=Math.min(u[n],l[t]-("right"===t?u.width:u.height))),z({},n,i)}};return c.forEach((function(t){var e=-1!==["left","top"].indexOf(t)?"primary":"secondary";u=X({},u,h[e](t))})),t.offsets.popper=u,t},priority:["left","right","top","bottom"],padding:5,boundariesElement:"scrollParent"},keepTogether:{order:400,enabled:!0,fn:function(t){var e=t.offsets,n=e.popper,i=e.reference,o=t.placement.split("-")[0],r=Math.floor,s=-1!==["top","bottom"].indexOf(o),a=s?"right":"bottom",l=s?"left":"top",c=s?"width":"height";return n[a]<r(i[l])&&(t.offsets.popper[l]=r(i[l])-n[c]),n[l]>r(i[a])&&(t.offsets.popper[l]=r(i[a])),t}},arrow:{order:500,enabled:!0,fn:function(t,e){var n;if(!wt(t.instance.modifiers,"arrow","keepTogether"))return t;var i=e.element;if("string"==typeof i){if(!(i=t.instance.popper.querySelector(i)))return t}else if(!t.instance.popper.contains(i))return console.warn("WARNING: `arrow.element` must be child of its popper element!"),t;var o=t.placement.split("-")[0],r=t.offsets,s=r.popper,a=r.reference,l=-1!==["left","right"].indexOf(o),c=l?"height":"width",u=l?"Top":"Left",h=u.toLowerCase(),f=l?"left":"top",d=l?"bottom":"right",p=rt(i)[c];a[d]-p<s[h]&&(t.offsets.popper[h]-=s[h]-(a[d]-p)),a[h]+p>s[d]&&(t.offsets.popper[h]+=a[h]+p-s[d]),t.offsets.popper=K(t.offsets.popper);var m=a[h]+a[c]/2-p/2,g=A(t.instance.popper),v=parseFloat(g["margin"+u],10),_=parseFloat(g["border"+u+"Width"],10),b=m-t.offsets.popper[h]-v-_;return b=Math.max(Math.min(s[c]-p,b),0),t.arrowElement=i,t.offsets.arrow=(z(n={},h,Math.round(b)),z(n,f,""),n),t},element:"[x-arrow]"},flip:{order:600,enabled:!0,fn:function(t,e){if(ht(t.instance.modifiers,"inner"))return t;if(t.flipped&&t.placement===t.originalPlacement)return t;var n=et(t.instance.popper,t.instance.reference,e.padding,e.boundariesElement,t.positionFixed),i=t.placement.split("-")[0],o=st(i),r=t.placement.split("-")[1]||"",s=[];switch(e.behavior){case St:s=[i,o];break;case Dt:s=Ct(i);break;case kt:s=Ct(i,!0);break;default:s=e.behavior}return s.forEach((function(a,l){if(i!==a||s.length===l+1)return t;i=t.placement.split("-")[0],o=st(i);var c=t.offsets.popper,u=t.offsets.reference,h=Math.floor,f="left"===i&&h(c.right)>h(u.left)||"right"===i&&h(c.left)<h(u.right)||"top"===i&&h(c.bottom)>h(u.top)||"bottom"===i&&h(c.top)<h(u.bottom),d=h(c.left)<h(n.left),p=h(c.right)>h(n.right),m=h(c.top)<h(n.top),g=h(c.bottom)>h(n.bottom),v="left"===i&&d||"right"===i&&p||"top"===i&&m||"bottom"===i&&g,_=-1!==["top","bottom"].indexOf(i),b=!!e.flipVariations&&(_&&"start"===r&&d||_&&"end"===r&&p||!_&&"start"===r&&m||!_&&"end"===r&&g),y=!!e.flipVariationsByContent&&(_&&"start"===r&&p||_&&"end"===r&&d||!_&&"start"===r&&g||!_&&"end"===r&&m),w=b||y;(f||v||w)&&(t.flipped=!0,(f||v)&&(i=s[l+1]),w&&(r=function(t){return"end"===t?"start":"start"===t?"end":t}(r)),t.placement=i+(r?"-"+r:""),t.offsets.popper=X({},t.offsets.popper,at(t.instance.popper,t.offsets.reference,t.placement)),t=ct(t.instance.modifiers,t,"flip"))})),t},behavior:"flip",padding:5,boundariesElement:"viewport",flipVariations:!1,flipVariationsByContent:!1},inner:{order:700,enabled:!1,fn:function(t){var e=t.placement,n=e.split("-")[0],i=t.offsets,o=i.popper,r=i.reference,s=-1!==["left","right"].indexOf(n),a=-1===["top","left"].indexOf(n);return o[s?"left":"top"]=r[n]-(a?o[s?"width":"height"]:0),t.placement=st(e),t.offsets.popper=K(o),t}},hide:{order:800,enabled:!0,fn:function(t){if(!wt(t.instance.modifiers,"hide","preventOverflow"))return t;var e=t.offsets.reference,n=lt(t.instance.modifiers,(function(t){return"preventOverflow"===t.name})).boundaries;if(e.bottom<n.top||e.left>n.right||e.top>n.bottom||e.right<n.left){if(!0===t.hide)return t;t.hide=!0,t.attributes["x-out-of-boundaries"]=""}else{if(!1===t.hide)return t;t.hide=!1,t.attributes["x-out-of-boundaries"]=!1}return t}},computeStyle:{order:850,enabled:!0,fn:function(t,e){var n=e.x,i=e.y,o=t.offsets.popper,r=lt(t.instance.modifiers,(function(t){return"applyStyle"===t.name})).gpuAcceleration;void 0!==r&&console.warn("WARNING: `gpuAcceleration` option moved to `computeStyle` modifier and will not be supported in future versions of Popper.js!");var s=void 0!==r?r:e.gpuAcceleration,a=R(t.instance.popper),l=G(a),c={position:o.position},u=function(t,e){var n=t.offsets,i=n.popper,o=n.reference,r=Math.round,s=Math.floor,a=function(t){return t},l=r(o.width),c=r(i.width),u=-1!==["left","right"].indexOf(t.placement),h=-1!==t.placement.indexOf("-"),f=e?u||h||l%2==c%2?r:s:a,d=e?r:a;return{left:f(l%2==1&&c%2==1&&!h&&e?i.left-1:i.left),top:d(i.top),bottom:d(i.bottom),right:f(i.right)}}(t,window.devicePixelRatio<2||!yt),h="bottom"===n?"top":"bottom",f="right"===i?"left":"right",d=ft("transform"),p=void 0,m=void 0;if(m="bottom"===h?"HTML"===a.nodeName?-a.clientHeight+u.bottom:-l.height+u.bottom:u.top,p="right"===f?"HTML"===a.nodeName?-a.clientWidth+u.right:-l.width+u.right:u.left,s&&d)c[d]="translate3d("+p+"px, "+m+"px, 0)",c[h]=0,c[f]=0,c.willChange="transform";else{var g="bottom"===h?-1:1,v="right"===f?-1:1;c[h]=m*g,c[f]=p*v,c.willChange=h+", "+f}var _={"x-placement":t.placement};return t.attributes=X({},_,t.attributes),t.styles=X({},c,t.styles),t.arrowStyles=X({},t.offsets.arrow,t.arrowStyles),t},gpuAcceleration:!0,x:"bottom",y:"right"},applyStyle:{order:900,enabled:!0,fn:function(t){var e,n;return bt(t.instance.popper,t.styles),e=t.instance.popper,n=t.attributes,Object.keys(n).forEach((function(t){!1!==n[t]?e.setAttribute(t,n[t]):e.removeAttribute(t)})),t.arrowElement&&Object.keys(t.arrowStyles).length&&bt(t.arrowElement,t.arrowStyles),t},onLoad:function(t,e,n,i,o){var r=ot(o,e,t,n.positionFixed),s=it(n.placement,r,e,t,n.modifiers.flip.boundariesElement,n.modifiers.flip.padding);return e.setAttribute("x-placement",s),bt(e,{position:n.positionFixed?"fixed":"absolute"}),n},gpuAcceleration:void 0}}},At=function(){function t(e,n){var i=this,o=arguments.length>2&&void 0!==arguments[2]?arguments[2]:{};V(this,t),this.scheduleUpdate=function(){return requestAnimationFrame(i.update)},this.update=N(this.update.bind(this)),this.options=X({},t.Defaults,o),this.state={isDestroyed:!1,isCreated:!1,scrollParents:[]},this.reference=e&&e.jquery?e[0]:e,this.popper=n&&n.jquery?n[0]:n,this.options.modifiers={},Object.keys(X({},t.Defaults.modifiers,o.modifiers)).forEach((function(e){i.options.modifiers[e]=X({},t.Defaults.modifiers[e]||{},o.modifiers?o.modifiers[e]:{})})),this.modifiers=Object.keys(this.options.modifiers).map((function(t){return X({name:t},i.options.modifiers[t])})).sort((function(t,e){return t.order-e.order})),this.modifiers.forEach((function(t){t.enabled&&O(t.onLoad)&&t.onLoad(i.reference,i.popper,i.options,t,i.state)})),this.update();var r=this.options.eventsEnabled;r&&this.enableEventListeners(),this.state.eventsEnabled=r}return Y(t,[{key:"update",value:function(){return ut.call(this)}},{key:"destroy",value:function(){return dt.call(this)}},{key:"enableEventListeners",value:function(){return gt.call(this)}},{key:"disableEventListeners",value:function(){return vt.call(this)}}]),t}();At.Utils=("undefined"!=typeof window?window:global).PopperUtils,At.placements=Et,At.Defaults=Ot;var It="dropdown",xt=e.fn[It],jt=new RegExp("38|40|27"),Lt={offset:0,flip:!0,boundary:"scrollParent",reference:"toggle",display:"dynamic",popperConfig:null},Pt={offset:"(number|string|function)",flip:"boolean",boundary:"(string|element)",reference:"(string|element)",display:"string",popperConfig:"(null|object)"},Ft=function(){function t(t,e){this._element=t,this._popper=null,this._config=this._getConfig(e),this._menu=this._getMenuElement(),this._inNavbar=this._detectNavbar(),this._addEventListeners()}var n=t.prototype;return n.toggle=function(){if(!this._element.disabled&&!e(this._element).hasClass("disabled")){var n=e(this._menu).hasClass("show");t._clearMenus(),n||this.show(!0)}},n.show=function(n){if(void 0===n&&(n=!1),!(this._element.disabled||e(this._element).hasClass("disabled")||e(this._menu).hasClass("show"))){var i={relatedTarget:this._element},o=e.Event("show.bs.dropdown",i),r=t._getParentFromElement(this._element);if(e(r).trigger(o),!o.isDefaultPrevented()){if(!this._inNavbar&&n){if("undefined"==typeof At)throw new TypeError("Bootstrap's dropdowns require Popper.js (https://popper.js.org/)");var s=this._element;"parent"===this._config.reference?s=r:l.isElement(this._config.reference)&&(s=this._config.reference,"undefined"!=typeof this._config.reference.jquery&&(s=this._config.reference[0])),"scrollParent"!==this._config.boundary&&e(r).addClass("position-static"),this._popper=new At(s,this._menu,this._getPopperConfig())}"ontouchstart"in document.documentElement&&0===e(r).closest(".navbar-nav").length&&e(document.body).children().on("mouseover",null,e.noop),this._element.focus(),this._element.setAttribute("aria-expanded",!0),e(this._menu).toggleClass("show"),e(r).toggleClass("show").trigger(e.Event("shown.bs.dropdown",i))}}},n.hide=function(){if(!this._element.disabled&&!e(this._element).hasClass("disabled")&&e(this._menu).hasClass("show")){var n={relatedTarget:this._element},i=e.Event("hide.bs.dropdown",n),o=t._getParentFromElement(this._element);e(o).trigger(i),i.isDefaultPrevented()||(this._popper&&this._popper.destroy(),e(this._menu).toggleClass("show"),e(o).toggleClass("show").trigger(e.Event("hidden.bs.dropdown",n)))}},n.dispose=function(){e.removeData(this._element,"bs.dropdown"),e(this._element).off(".bs.dropdown"),this._element=null,this._menu=null,null!==this._popper&&(this._popper.destroy(),this._popper=null)},n.update=function(){this._inNavbar=this._detectNavbar(),null!==this._popper&&this._popper.scheduleUpdate()},n._addEventListeners=function(){var t=this;e(this._element).on("click.bs.dropdown",(function(e){e.preventDefault(),e.stopPropagation(),t.toggle()}))},n._getConfig=function(t){return t=s(s(s({},this.constructor.Default),e(this._element).data()),t),l.typeCheckConfig(It,t,this.constructor.DefaultType),t},n._getMenuElement=function(){if(!this._menu){var e=t._getParentFromElement(this._element);e&&(this._menu=e.querySelector(".dropdown-menu"))}return this._menu},n._getPlacement=function(){var t=e(this._element.parentNode),n="bottom-start";return t.hasClass("dropup")?n=e(this._menu).hasClass("dropdown-menu-right")?"top-end":"top-start":t.hasClass("dropright")?n="right-start":t.hasClass("dropleft")?n="left-start":e(this._menu).hasClass("dropdown-menu-right")&&(n="bottom-end"),n},n._detectNavbar=function(){return e(this._element).closest(".navbar").length>0},n._getOffset=function(){var t=this,e={};return"function"==typeof this._config.offset?e.fn=function(e){return e.offsets=s(s({},e.offsets),t._config.offset(e.offsets,t._element)||{}),e}:e.offset=this._config.offset,e},n._getPopperConfig=function(){var t={placement:this._getPlacement(),modifiers:{offset:this._getOffset(),flip:{enabled:this._config.flip},preventOverflow:{boundariesElement:this._config.boundary}}};return"static"===this._config.display&&(t.modifiers.applyStyle={enabled:!1}),s(s({},t),this._config.popperConfig)},t._jQueryInterface=function(n){return this.each((function(){var i=e(this).data("bs.dropdown");if(i||(i=new t(this,"object"==typeof n?n:null),e(this).data("bs.dropdown",i)),"string"==typeof n){if("undefined"==typeof i[n])throw new TypeError('No method named "'+n+'"');i[n]()}}))},t._clearMenus=function(n){if(!n||3!==n.which&&("keyup"!==n.type||9===n.which))for(var i=[].slice.call(document.querySelectorAll('[data-toggle="dropdown"]')),o=0,r=i.length;o<r;o++){var s=t._getParentFromElement(i[o]),a=e(i[o]).data("bs.dropdown"),l={relatedTarget:i[o]};if(n&&"click"===n.type&&(l.clickEvent=n),a){var c=a._menu;if(e(s).hasClass("show")&&!(n&&("click"===n.type&&/input|textarea/i.test(n.target.tagName)||"keyup"===n.type&&9===n.which)&&e.contains(s,n.target))){var u=e.Event("hide.bs.dropdown",l);e(s).trigger(u),u.isDefaultPrevented()||("ontouchstart"in document.documentElement&&e(document.body).children().off("mouseover",null,e.noop),i[o].setAttribute("aria-expanded","false"),a._popper&&a._popper.destroy(),e(c).removeClass("show"),e(s).removeClass("show").trigger(e.Event("hidden.bs.dropdown",l)))}}}},t._getParentFromElement=function(t){var e,n=l.getSelectorFromElement(t);return n&&(e=document.querySelector(n)),e||t.parentNode},t._dataApiKeydownHandler=function(n){if(!(/input|textarea/i.test(n.target.tagName)?32===n.which||27!==n.which&&(40!==n.which&&38!==n.which||e(n.target).closest(".dropdown-menu").length):!jt.test(n.which))&&!this.disabled&&!e(this).hasClass("disabled")){var i=t._getParentFromElement(this),o=e(i).hasClass("show");if(o||27!==n.which){if(n.preventDefault(),n.stopPropagation(),!o||o&&(27===n.which||32===n.which))return 27===n.which&&e(i.querySelector('[data-toggle="dropdown"]')).trigger("focus"),void e(this).trigger("click");var r=[].slice.call(i.querySelectorAll(".dropdown-menu .dropdown-item:not(.disabled):not(:disabled)")).filter((function(t){return e(t).is(":visible")}));if(0!==r.length){var s=r.indexOf(n.target);38===n.which&&s>0&&s--,40===n.which&&s<r.length-1&&s++,s<0&&(s=0),r[s].focus()}}}},i(t,null,[{key:"VERSION",get:function(){return"4.5.0"}},{key:"Default",get:function(){return Lt}},{key:"DefaultType",get:function(){return Pt}}]),t}();e(document).on("keydown.bs.dropdown.data-api",'[data-toggle="dropdown"]',Ft._dataApiKeydownHandler).on("keydown.bs.dropdown.data-api",".dropdown-menu",Ft._dataApiKeydownHandler).on("click.bs.dropdown.data-api keyup.bs.dropdown.data-api",Ft._clearMenus).on("click.bs.dropdown.data-api",'[data-toggle="dropdown"]',(function(t){t.preventDefault(),t.stopPropagation(),Ft._jQueryInterface.call(e(this),"toggle")})).on("click.bs.dropdown.data-api",".dropdown form",(function(t){t.stopPropagation()})),e.fn[It]=Ft._jQueryInterface,e.fn[It].Constructor=Ft,e.fn[It].noConflict=function(){return e.fn[It]=xt,Ft._jQueryInterface};var Rt=e.fn.modal,Mt={backdrop:!0,keyboard:!0,focus:!0,show:!0},Bt={backdrop:"(boolean|string)",keyboard:"boolean",focus:"boolean",show:"boolean"},qt=function(){function t(t,e){this._config=this._getConfig(e),this._element=t,this._dialog=t.querySelector(".modal-dialog"),this._backdrop=null,this._isShown=!1,this._isBodyOverflowing=!1,this._ignoreBackdropClick=!1,this._isTransitioning=!1,this._scrollbarWidth=0}var n=t.prototype;return n.toggle=function(t){return this._isShown?this.hide():this.show(t)},n.show=function(t){var n=this;if(!this._isShown&&!this._isTransitioning){e(this._element).hasClass("fade")&&(this._isTransitioning=!0);var i=e.Event("show.bs.modal",{relatedTarget:t});e(this._element).trigger(i),this._isShown||i.isDefaultPrevented()||(this._isShown=!0,this._checkScrollbar(),this._setScrollbar(),this._adjustDialog(),this._setEscapeEvent(),this._setResizeEvent(),e(this._element).on("click.dismiss.bs.modal",'[data-dismiss="modal"]',(function(t){return n.hide(t)})),e(this._dialog).on("mousedown.dismiss.bs.modal",(function(){e(n._element).one("mouseup.dismiss.bs.modal",(function(t){e(t.target).is(n._element)&&(n._ignoreBackdropClick=!0)}))})),this._showBackdrop((function(){return n._showElement(t)})))}},n.hide=function(t){var n=this;if(t&&t.preventDefault(),this._isShown&&!this._isTransitioning){var i=e.Event("hide.bs.modal");if(e(this._element).trigger(i),this._isShown&&!i.isDefaultPrevented()){this._isShown=!1;var o=e(this._element).hasClass("fade");if(o&&(this._isTransitioning=!0),this._setEscapeEvent(),this._setResizeEvent(),e(document).off("focusin.bs.modal"),e(this._element).removeClass("show"),e(this._element).off("click.dismiss.bs.modal"),e(this._dialog).off("mousedown.dismiss.bs.modal"),o){var r=l.getTransitionDurationFromElement(this._element);e(this._element).one(l.TRANSITION_END,(function(t){return n._hideModal(t)})).emulateTransitionEnd(r)}else this._hideModal()}}},n.dispose=function(){[window,this._element,this._dialog].forEach((function(t){return e(t).off(".bs.modal")})),e(document).off("focusin.bs.modal"),e.removeData(this._element,"bs.modal"),this._config=null,this._element=null,this._dialog=null,this._backdrop=null,this._isShown=null,this._isBodyOverflowing=null,this._ignoreBackdropClick=null,this._isTransitioning=null,this._scrollbarWidth=null},n.handleUpdate=function(){this._adjustDialog()},n._getConfig=function(t){return t=s(s({},Mt),t),l.typeCheckConfig("modal",t,Bt),t},n._triggerBackdropTransition=function(){var t=this;if("static"===this._config.backdrop){var n=e.Event("hidePrevented.bs.modal");if(e(this._element).trigger(n),n.defaultPrevented)return;this._element.classList.add("modal-static");var i=l.getTransitionDurationFromElement(this._element);e(this._element).one(l.TRANSITION_END,(function(){t._element.classList.remove("modal-static")})).emulateTransitionEnd(i),this._element.focus()}else this.hide()},n._showElement=function(t){var n=this,i=e(this._element).hasClass("fade"),o=this._dialog?this._dialog.querySelector(".modal-body"):null;this._element.parentNode&&this._element.parentNode.nodeType===Node.ELEMENT_NODE||document.body.appendChild(this._element),this._element.style.display="block",this._element.removeAttribute("aria-hidden"),this._element.setAttribute("aria-modal",!0),e(this._dialog).hasClass("modal-dialog-scrollable")&&o?o.scrollTop=0:this._element.scrollTop=0,i&&l.reflow(this._element),e(this._element).addClass("show"),this._config.focus&&this._enforceFocus();var r=e.Event("shown.bs.modal",{relatedTarget:t}),s=function(){n._config.focus&&n._element.focus(),n._isTransitioning=!1,e(n._element).trigger(r)};if(i){var a=l.getTransitionDurationFromElement(this._dialog);e(this._dialog).one(l.TRANSITION_END,s).emulateTransitionEnd(a)}else s()},n._enforceFocus=function(){var t=this;e(document).off("focusin.bs.modal").on("focusin.bs.modal",(function(n){document!==n.target&&t._element!==n.target&&0===e(t._element).has(n.target).length&&t._element.focus()}))},n._setEscapeEvent=function(){var t=this;this._isShown?e(this._element).on("keydown.dismiss.bs.modal",(function(e){t._config.keyboard&&27===e.which?(e.preventDefault(),t.hide()):t._config.keyboard||27!==e.which||t._triggerBackdropTransition()})):this._isShown||e(this._element).off("keydown.dismiss.bs.modal")},n._setResizeEvent=function(){var t=this;this._isShown?e(window).on("resize.bs.modal",(function(e){return t.handleUpdate(e)})):e(window).off("resize.bs.modal")},n._hideModal=function(){var t=this;this._element.style.display="none",this._element.setAttribute("aria-hidden",!0),this._element.removeAttribute("aria-modal"),this._isTransitioning=!1,this._showBackdrop((function(){e(document.body).removeClass("modal-open"),t._resetAdjustments(),t._resetScrollbar(),e(t._element).trigger("hidden.bs.modal")}))},n._removeBackdrop=function(){this._backdrop&&(e(this._backdrop).remove(),this._backdrop=null)},n._showBackdrop=function(t){var n=this,i=e(this._element).hasClass("fade")?"fade":"";if(this._isShown&&this._config.backdrop){if(this._backdrop=document.createElement("div"),this._backdrop.className="modal-backdrop",i&&this._backdrop.classList.add(i),e(this._backdrop).appendTo(document.body),e(this._element).on("click.dismiss.bs.modal",(function(t){n._ignoreBackdropClick?n._ignoreBackdropClick=!1:t.target===t.currentTarget&&n._triggerBackdropTransition()})),i&&l.reflow(this._backdrop),e(this._backdrop).addClass("show"),!t)return;if(!i)return void t();var o=l.getTransitionDurationFromElement(this._backdrop);e(this._backdrop).one(l.TRANSITION_END,t).emulateTransitionEnd(o)}else if(!this._isShown&&this._backdrop){e(this._backdrop).removeClass("show");var r=function(){n._removeBackdrop(),t&&t()};if(e(this._element).hasClass("fade")){var s=l.getTransitionDurationFromElement(this._backdrop);e(this._backdrop).one(l.TRANSITION_END,r).emulateTransitionEnd(s)}else r()}else t&&t()},n._adjustDialog=function(){var t=this._element.scrollHeight>document.documentElement.clientHeight;!this._isBodyOverflowing&&t&&(this._element.style.paddingLeft=this._scrollbarWidth+"px"),this._isBodyOverflowing&&!t&&(this._element.style.paddingRight=this._scrollbarWidth+"px")},n._resetAdjustments=function(){this._element.style.paddingLeft="",this._element.style.paddingRight=""},n._checkScrollbar=function(){var t=document.body.getBoundingClientRect();this._isBodyOverflowing=Math.round(t.left+t.right)<window.innerWidth,this._scrollbarWidth=this._getScrollbarWidth()},n._setScrollbar=function(){var t=this;if(this._isBodyOverflowing){var n=[].slice.call(document.querySelectorAll(".fixed-top, .fixed-bottom, .is-fixed, .sticky-top")),i=[].slice.call(document.querySelectorAll(".sticky-top"));e(n).each((function(n,i){var o=i.style.paddingRight,r=e(i).css("padding-right");e(i).data("padding-right",o).css("padding-right",parseFloat(r)+t._scrollbarWidth+"px")})),e(i).each((function(n,i){var o=i.style.marginRight,r=e(i).css("margin-right");e(i).data("margin-right",o).css("margin-right",parseFloat(r)-t._scrollbarWidth+"px")}));var o=document.body.style.paddingRight,r=e(document.body).css("padding-right");e(document.body).data("padding-right",o).css("padding-right",parseFloat(r)+this._scrollbarWidth+"px")}e(document.body).addClass("modal-open")},n._resetScrollbar=function(){var t=[].slice.call(document.querySelectorAll(".fixed-top, .fixed-bottom, .is-fixed, .sticky-top"));e(t).each((function(t,n){var i=e(n).data("padding-right");e(n).removeData("padding-right"),n.style.paddingRight=i||""}));var n=[].slice.call(document.querySelectorAll(".sticky-top"));e(n).each((function(t,n){var i=e(n).data("margin-right");"undefined"!=typeof i&&e(n).css("margin-right",i).removeData("margin-right")}));var i=e(document.body).data("padding-right");e(document.body).removeData("padding-right"),document.body.style.paddingRight=i||""},n._getScrollbarWidth=function(){var t=document.createElement("div");t.className="modal-scrollbar-measure",document.body.appendChild(t);var e=t.getBoundingClientRect().width-t.clientWidth;return document.body.removeChild(t),e},t._jQueryInterface=function(n,i){return this.each((function(){var o=e(this).data("bs.modal"),r=s(s(s({},Mt),e(this).data()),"object"==typeof n&&n?n:{});if(o||(o=new t(this,r),e(this).data("bs.modal",o)),"string"==typeof n){if("undefined"==typeof o[n])throw new TypeError('No method named "'+n+'"');o[n](i)}else r.show&&o.show(i)}))},i(t,null,[{key:"VERSION",get:function(){return"4.5.0"}},{key:"Default",get:function(){return Mt}}]),t}();e(document).on("click.bs.modal.data-api",'[data-toggle="modal"]',(function(t){var n,i=this,o=l.getSelectorFromElement(this);o&&(n=document.querySelector(o));var r=e(n).data("bs.modal")?"toggle":s(s({},e(n).data()),e(this).data());"A"!==this.tagName&&"AREA"!==this.tagName||t.preventDefault();var a=e(n).one("show.bs.modal",(function(t){t.isDefaultPrevented()||a.one("hidden.bs.modal",(function(){e(i).is(":visible")&&i.focus()}))}));qt._jQueryInterface.call(e(n),r,this)})),e.fn.modal=qt._jQueryInterface,e.fn.modal.Constructor=qt,e.fn.modal.noConflict=function(){return e.fn.modal=Rt,qt._jQueryInterface};var Ht=["background","cite","href","itemtype","longdesc","poster","src","xlink:href"],Qt={"*":["class","dir","id","lang","role",/^aria-[\w-]*$/i],a:["target","href","title","rel"],area:[],b:[],br:[],col:[],code:[],div:[],em:[],hr:[],h1:[],h2:[],h3:[],h4:[],h5:[],h6:[],i:[],img:["src","srcset","alt","title","width","height"],li:[],ol:[],p:[],pre:[],s:[],small:[],span:[],sub:[],sup:[],strong:[],u:[],ul:[]},Wt=/^(?:(?:https?|mailto|ftp|tel|file):|[^#&/:?]*(?:[#/?]|$))/gi,Ut=/^data:(?:image\/(?:bmp|gif|jpeg|jpg|png|tiff|webp)|video\/(?:mpeg|mp4|ogg|webm)|audio\/(?:mp3|oga|ogg|opus));base64,[\d+/a-z]+=*$/i;function Vt(t,e,n){if(0===t.length)return t;if(n&&"function"==typeof n)return n(t);for(var i=(new window.DOMParser).parseFromString(t,"text/html"),o=Object.keys(e),r=[].slice.call(i.body.querySelectorAll("*")),s=function(t,n){var i=r[t],s=i.nodeName.toLowerCase();if(-1===o.indexOf(i.nodeName.toLowerCase()))return i.parentNode.removeChild(i),"continue";var a=[].slice.call(i.attributes),l=[].concat(e["*"]||[],e[s]||[]);a.forEach((function(t){(function(t,e){var n=t.nodeName.toLowerCase();if(-1!==e.indexOf(n))return-1===Ht.indexOf(n)||Boolean(t.nodeValue.match(Wt)||t.nodeValue.match(Ut));for(var i=e.filter((function(t){return t instanceof RegExp})),o=0,r=i.length;o<r;o++)if(n.match(i[o]))return!0;return!1})(t,l)||i.removeAttribute(t.nodeName)}))},a=0,l=r.length;a<l;a++)s(a);return i.body.innerHTML}var Yt="tooltip",zt=e.fn[Yt],Xt=new RegExp("(^|\\s)bs-tooltip\\S+","g"),Kt=["sanitize","whiteList","sanitizeFn"],Gt={animation:"boolean",template:"string",title:"(string|element|function)",trigger:"string",delay:"(number|object)",html:"boolean",selector:"(string|boolean)",placement:"(string|function)",offset:"(number|string|function)",container:"(string|element|boolean)",fallbackPlacement:"(string|array)",boundary:"(string|element)",sanitize:"boolean",sanitizeFn:"(null|function)",whiteList:"object",popperConfig:"(null|object)"},$t={AUTO:"auto",TOP:"top",RIGHT:"right",BOTTOM:"bottom",LEFT:"left"},Jt={animation:!0,template:'<div class="tooltip" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>',trigger:"hover focus",title:"",delay:0,html:!1,selector:!1,placement:"top",offset:0,container:!1,fallbackPlacement:"flip",boundary:"scrollParent",sanitize:!0,sanitizeFn:null,whiteList:Qt,popperConfig:null},Zt={HIDE:"hide.bs.tooltip",HIDDEN:"hidden.bs.tooltip",SHOW:"show.bs.tooltip",SHOWN:"shown.bs.tooltip",INSERTED:"inserted.bs.tooltip",CLICK:"click.bs.tooltip",FOCUSIN:"focusin.bs.tooltip",FOCUSOUT:"focusout.bs.tooltip",MOUSEENTER:"mouseenter.bs.tooltip",MOUSELEAVE:"mouseleave.bs.tooltip"},te=function(){function t(t,e){if("undefined"==typeof At)throw new TypeError("Bootstrap's tooltips require Popper.js (https://popper.js.org/)");this._isEnabled=!0,this._timeout=0,this._hoverState="",this._activeTrigger={},this._popper=null,this.element=t,this.config=this._getConfig(e),this.tip=null,this._setListeners()}var n=t.prototype;return n.enable=function(){this._isEnabled=!0},n.disable=function(){this._isEnabled=!1},n.toggleEnabled=function(){this._isEnabled=!this._isEnabled},n.toggle=function(t){if(this._isEnabled)if(t){var n=this.constructor.DATA_KEY,i=e(t.currentTarget).data(n);i||(i=new this.constructor(t.currentTarget,this._getDelegateConfig()),e(t.currentTarget).data(n,i)),i._activeTrigger.click=!i._activeTrigger.click,i._isWithActiveTrigger()?i._enter(null,i):i._leave(null,i)}else{if(e(this.getTipElement()).hasClass("show"))return void this._leave(null,this);this._enter(null,this)}},n.dispose=function(){clearTimeout(this._timeout),e.removeData(this.element,this.constructor.DATA_KEY),e(this.element).off(this.constructor.EVENT_KEY),e(this.element).closest(".modal").off("hide.bs.modal",this._hideModalHandler),this.tip&&e(this.tip).remove(),this._isEnabled=null,this._timeout=null,this._hoverState=null,this._activeTrigger=null,this._popper&&this._popper.destroy(),this._popper=null,this.element=null,this.config=null,this.tip=null},n.show=function(){var t=this;if("none"===e(this.element).css("display"))throw new Error("Please use show on visible elements");var n=e.Event(this.constructor.Event.SHOW);if(this.isWithContent()&&this._isEnabled){e(this.element).trigger(n);var i=l.findShadowRoot(this.element),o=e.contains(null!==i?i:this.element.ownerDocument.documentElement,this.element);if(n.isDefaultPrevented()||!o)return;var r=this.getTipElement(),s=l.getUID(this.constructor.NAME);r.setAttribute("id",s),this.element.setAttribute("aria-describedby",s),this.setContent(),this.config.animation&&e(r).addClass("fade");var a="function"==typeof this.config.placement?this.config.placement.call(this,r,this.element):this.config.placement,c=this._getAttachment(a);this.addAttachmentClass(c);var u=this._getContainer();e(r).data(this.constructor.DATA_KEY,this),e.contains(this.element.ownerDocument.documentElement,this.tip)||e(r).appendTo(u),e(this.element).trigger(this.constructor.Event.INSERTED),this._popper=new At(this.element,r,this._getPopperConfig(c)),e(r).addClass("show"),"ontouchstart"in document.documentElement&&e(document.body).children().on("mouseover",null,e.noop);var h=function(){t.config.animation&&t._fixTransition();var n=t._hoverState;t._hoverState=null,e(t.element).trigger(t.constructor.Event.SHOWN),"out"===n&&t._leave(null,t)};if(e(this.tip).hasClass("fade")){var f=l.getTransitionDurationFromElement(this.tip);e(this.tip).one(l.TRANSITION_END,h).emulateTransitionEnd(f)}else h()}},n.hide=function(t){var n=this,i=this.getTipElement(),o=e.Event(this.constructor.Event.HIDE),r=function(){"show"!==n._hoverState&&i.parentNode&&i.parentNode.removeChild(i),n._cleanTipClass(),n.element.removeAttribute("aria-describedby"),e(n.element).trigger(n.constructor.Event.HIDDEN),null!==n._popper&&n._popper.destroy(),t&&t()};if(e(this.element).trigger(o),!o.isDefaultPrevented()){if(e(i).removeClass("show"),"ontouchstart"in document.documentElement&&e(document.body).children().off("mouseover",null,e.noop),this._activeTrigger.click=!1,this._activeTrigger.focus=!1,this._activeTrigger.hover=!1,e(this.tip).hasClass("fade")){var s=l.getTransitionDurationFromElement(i);e(i).one(l.TRANSITION_END,r).emulateTransitionEnd(s)}else r();this._hoverState=""}},n.update=function(){null!==this._popper&&this._popper.scheduleUpdate()},n.isWithContent=function(){return Boolean(this.getTitle())},n.addAttachmentClass=function(t){e(this.getTipElement()).addClass("bs-tooltip-"+t)},n.getTipElement=function(){return this.tip=this.tip||e(this.config.template)[0],this.tip},n.setContent=function(){var t=this.getTipElement();this.setElementContent(e(t.querySelectorAll(".tooltip-inner")),this.getTitle()),e(t).removeClass("fade show")},n.setElementContent=function(t,n){"object"!=typeof n||!n.nodeType&&!n.jquery?this.config.html?(this.config.sanitize&&(n=Vt(n,this.config.whiteList,this.config.sanitizeFn)),t.html(n)):t.text(n):this.config.html?e(n).parent().is(t)||t.empty().append(n):t.text(e(n).text())},n.getTitle=function(){var t=this.element.getAttribute("data-original-title");return t||(t="function"==typeof this.config.title?this.config.title.call(this.element):this.config.title),t},n._getPopperConfig=function(t){var e=this;return s(s({},{placement:t,modifiers:{offset:this._getOffset(),flip:{behavior:this.config.fallbackPlacement},arrow:{element:".arrow"},preventOverflow:{boundariesElement:this.config.boundary}},onCreate:function(t){t.originalPlacement!==t.placement&&e._handlePopperPlacementChange(t)},onUpdate:function(t){return e._handlePopperPlacementChange(t)}}),this.config.popperConfig)},n._getOffset=function(){var t=this,e={};return"function"==typeof this.config.offset?e.fn=function(e){return e.offsets=s(s({},e.offsets),t.config.offset(e.offsets,t.element)||{}),e}:e.offset=this.config.offset,e},n._getContainer=function(){return!1===this.config.container?document.body:l.isElement(this.config.container)?e(this.config.container):e(document).find(this.config.container)},n._getAttachment=function(t){return $t[t.toUpperCase()]},n._setListeners=function(){var t=this;this.config.trigger.split(" ").forEach((function(n){if("click"===n)e(t.element).on(t.constructor.Event.CLICK,t.config.selector,(function(e){return t.toggle(e)}));else if("manual"!==n){var i="hover"===n?t.constructor.Event.MOUSEENTER:t.constructor.Event.FOCUSIN,o="hover"===n?t.constructor.Event.MOUSELEAVE:t.constructor.Event.FOCUSOUT;e(t.element).on(i,t.config.selector,(function(e){return t._enter(e)})).on(o,t.config.selector,(function(e){return t._leave(e)}))}})),this._hideModalHandler=function(){t.element&&t.hide()},e(this.element).closest(".modal").on("hide.bs.modal",this._hideModalHandler),this.config.selector?this.config=s(s({},this.config),{},{trigger:"manual",selector:""}):this._fixTitle()},n._fixTitle=function(){var t=typeof this.element.getAttribute("data-original-title");(this.element.getAttribute("title")||"string"!==t)&&(this.element.setAttribute("data-original-title",this.element.getAttribute("title")||""),this.element.setAttribute("title",""))},n._enter=function(t,n){var i=this.constructor.DATA_KEY;(n=n||e(t.currentTarget).data(i))||(n=new this.constructor(t.currentTarget,this._getDelegateConfig()),e(t.currentTarget).data(i,n)),t&&(n._activeTrigger["focusin"===t.type?"focus":"hover"]=!0),e(n.getTipElement()).hasClass("show")||"show"===n._hoverState?n._hoverState="show":(clearTimeout(n._timeout),n._hoverState="show",n.config.delay&&n.config.delay.show?n._timeout=setTimeout((function(){"show"===n._hoverState&&n.show()}),n.config.delay.show):n.show())},n._leave=function(t,n){var i=this.constructor.DATA_KEY;(n=n||e(t.currentTarget).data(i))||(n=new this.constructor(t.currentTarget,this._getDelegateConfig()),e(t.currentTarget).data(i,n)),t&&(n._activeTrigger["focusout"===t.type?"focus":"hover"]=!1),n._isWithActiveTrigger()||(clearTimeout(n._timeout),n._hoverState="out",n.config.delay&&n.config.delay.hide?n._timeout=setTimeout((function(){"out"===n._hoverState&&n.hide()}),n.config.delay.hide):n.hide())},n._isWithActiveTrigger=function(){for(var t in this._activeTrigger)if(this._activeTrigger[t])return!0;return!1},n._getConfig=function(t){var n=e(this.element).data();return Object.keys(n).forEach((function(t){-1!==Kt.indexOf(t)&&delete n[t]})),"number"==typeof(t=s(s(s({},this.constructor.Default),n),"object"==typeof t&&t?t:{})).delay&&(t.delay={show:t.delay,hide:t.delay}),"number"==typeof t.title&&(t.title=t.title.toString()),"number"==typeof t.content&&(t.content=t.content.toString()),l.typeCheckConfig(Yt,t,this.constructor.DefaultType),t.sanitize&&(t.template=Vt(t.template,t.whiteList,t.sanitizeFn)),t},n._getDelegateConfig=function(){var t={};if(this.config)for(var e in this.config)this.constructor.Default[e]!==this.config[e]&&(t[e]=this.config[e]);return t},n._cleanTipClass=function(){var t=e(this.getTipElement()),n=t.attr("class").match(Xt);null!==n&&n.length&&t.removeClass(n.join(""))},n._handlePopperPlacementChange=function(t){this.tip=t.instance.popper,this._cleanTipClass(),this.addAttachmentClass(this._getAttachment(t.placement))},n._fixTransition=function(){var t=this.getTipElement(),n=this.config.animation;null===t.getAttribute("x-placement")&&(e(t).removeClass("fade"),this.config.animation=!1,this.hide(),this.show(),this.config.animation=n)},t._jQueryInterface=function(n){return this.each((function(){var i=e(this).data("bs.tooltip"),o="object"==typeof n&&n;if((i||!/dispose|hide/.test(n))&&(i||(i=new t(this,o),e(this).data("bs.tooltip",i)),"string"==typeof n)){if("undefined"==typeof i[n])throw new TypeError('No method named "'+n+'"');i[n]()}}))},i(t,null,[{key:"VERSION",get:function(){return"4.5.0"}},{key:"Default",get:function(){return Jt}},{key:"NAME",get:function(){return Yt}},{key:"DATA_KEY",get:function(){return"bs.tooltip"}},{key:"Event",get:function(){return Zt}},{key:"EVENT_KEY",get:function(){return".bs.tooltip"}},{key:"DefaultType",get:function(){return Gt}}]),t}();e.fn[Yt]=te._jQueryInterface,e.fn[Yt].Constructor=te,e.fn[Yt].noConflict=function(){return e.fn[Yt]=zt,te._jQueryInterface};var ee="popover",ne=e.fn[ee],ie=new RegExp("(^|\\s)bs-popover\\S+","g"),oe=s(s({},te.Default),{},{placement:"right",trigger:"click",content:"",template:'<div class="popover" role="tooltip"><div class="arrow"></div><h3 class="popover-header"></h3><div class="popover-body"></div></div>'}),re=s(s({},te.DefaultType),{},{content:"(string|element|function)"}),se={HIDE:"hide.bs.popover",HIDDEN:"hidden.bs.popover",SHOW:"show.bs.popover",SHOWN:"shown.bs.popover",INSERTED:"inserted.bs.popover",CLICK:"click.bs.popover",FOCUSIN:"focusin.bs.popover",FOCUSOUT:"focusout.bs.popover",MOUSEENTER:"mouseenter.bs.popover",MOUSELEAVE:"mouseleave.bs.popover"},ae=function(t){var n,o;function r(){return t.apply(this,arguments)||this}o=t,(n=r).prototype=Object.create(o.prototype),n.prototype.constructor=n,n.__proto__=o;var s=r.prototype;return s.isWithContent=function(){return this.getTitle()||this._getContent()},s.addAttachmentClass=function(t){e(this.getTipElement()).addClass("bs-popover-"+t)},s.getTipElement=function(){return this.tip=this.tip||e(this.config.template)[0],this.tip},s.setContent=function(){var t=e(this.getTipElement());this.setElementContent(t.find(".popover-header"),this.getTitle());var n=this._getContent();"function"==typeof n&&(n=n.call(this.element)),this.setElementContent(t.find(".popover-body"),n),t.removeClass("fade show")},s._getContent=function(){return this.element.getAttribute("data-content")||this.config.content},s._cleanTipClass=function(){var t=e(this.getTipElement()),n=t.attr("class").match(ie);null!==n&&n.length>0&&t.removeClass(n.join(""))},r._jQueryInterface=function(t){return this.each((function(){var n=e(this).data("bs.popover"),i="object"==typeof t?t:null;if((n||!/dispose|hide/.test(t))&&(n||(n=new r(this,i),e(this).data("bs.popover",n)),"string"==typeof t)){if("undefined"==typeof n[t])throw new TypeError('No method named "'+t+'"');n[t]()}}))},i(r,null,[{key:"VERSION",get:function(){return"4.5.0"}},{key:"Default",get:function(){return oe}},{key:"NAME",get:function(){return ee}},{key:"DATA_KEY",get:function(){return"bs.popover"}},{key:"Event",get:function(){return se}},{key:"EVENT_KEY",get:function(){return".bs.popover"}},{key:"DefaultType",get:function(){return re}}]),r}(te);e.fn[ee]=ae._jQueryInterface,e.fn[ee].Constructor=ae,e.fn[ee].noConflict=function(){return e.fn[ee]=ne,ae._jQueryInterface};var le="scrollspy",ce=e.fn[le],ue={offset:10,method:"auto",target:""},he={offset:"number",method:"string",target:"(string|element)"},fe=function(){function t(t,n){var i=this;this._element=t,this._scrollElement="BODY"===t.tagName?window:t,this._config=this._getConfig(n),this._selector=this._config.target+" .nav-link,"+this._config.target+" .list-group-item,"+this._config.target+" .dropdown-item",this._offsets=[],this._targets=[],this._activeTarget=null,this._scrollHeight=0,e(this._scrollElement).on("scroll.bs.scrollspy",(function(t){return i._process(t)})),this.refresh(),this._process()}var n=t.prototype;return n.refresh=function(){var t=this,n=this._scrollElement===this._scrollElement.window?"offset":"position",i="auto"===this._config.method?n:this._config.method,o="position"===i?this._getScrollTop():0;this._offsets=[],this._targets=[],this._scrollHeight=this._getScrollHeight(),[].slice.call(document.querySelectorAll(this._selector)).map((function(t){var n,r=l.getSelectorFromElement(t);if(r&&(n=document.querySelector(r)),n){var s=n.getBoundingClientRect();if(s.width||s.height)return[e(n)[i]().top+o,r]}return null})).filter((function(t){return t})).sort((function(t,e){return t[0]-e[0]})).forEach((function(e){t._offsets.push(e[0]),t._targets.push(e[1])}))},n.dispose=function(){e.removeData(this._element,"bs.scrollspy"),e(this._scrollElement).off(".bs.scrollspy"),this._element=null,this._scrollElement=null,this._config=null,this._selector=null,this._offsets=null,this._targets=null,this._activeTarget=null,this._scrollHeight=null},n._getConfig=function(t){if("string"!=typeof(t=s(s({},ue),"object"==typeof t&&t?t:{})).target&&l.isElement(t.target)){var n=e(t.target).attr("id");n||(n=l.getUID(le),e(t.target).attr("id",n)),t.target="#"+n}return l.typeCheckConfig(le,t,he),t},n._getScrollTop=function(){return this._scrollElement===window?this._scrollElement.pageYOffset:this._scrollElement.scrollTop},n._getScrollHeight=function(){return this._scrollElement.scrollHeight||Math.max(document.body.scrollHeight,document.documentElement.scrollHeight)},n._getOffsetHeight=function(){return this._scrollElement===window?window.innerHeight:this._scrollElement.getBoundingClientRect().height},n._process=function(){var t=this._getScrollTop()+this._config.offset,e=this._getScrollHeight(),n=this._config.offset+e-this._getOffsetHeight();if(this._scrollHeight!==e&&this.refresh(),t>=n){var i=this._targets[this._targets.length-1];this._activeTarget!==i&&this._activate(i)}else{if(this._activeTarget&&t<this._offsets[0]&&this._offsets[0]>0)return this._activeTarget=null,void this._clear();for(var o=this._offsets.length;o--;){this._activeTarget!==this._targets[o]&&t>=this._offsets[o]&&("undefined"==typeof this._offsets[o+1]||t<this._offsets[o+1])&&this._activate(this._targets[o])}}},n._activate=function(t){this._activeTarget=t,this._clear();var n=this._selector.split(",").map((function(e){return e+'[data-target="'+t+'"],'+e+'[href="'+t+'"]'})),i=e([].slice.call(document.querySelectorAll(n.join(","))));i.hasClass("dropdown-item")?(i.closest(".dropdown").find(".dropdown-toggle").addClass("active"),i.addClass("active")):(i.addClass("active"),i.parents(".nav, .list-group").prev(".nav-link, .list-group-item").addClass("active"),i.parents(".nav, .list-group").prev(".nav-item").children(".nav-link").addClass("active")),e(this._scrollElement).trigger("activate.bs.scrollspy",{relatedTarget:t})},n._clear=function(){[].slice.call(document.querySelectorAll(this._selector)).filter((function(t){return t.classList.contains("active")})).forEach((function(t){return t.classList.remove("active")}))},t._jQueryInterface=function(n){return this.each((function(){var i=e(this).data("bs.scrollspy");if(i||(i=new t(this,"object"==typeof n&&n),e(this).data("bs.scrollspy",i)),"string"==typeof n){if("undefined"==typeof i[n])throw new TypeError('No method named "'+n+'"');i[n]()}}))},i(t,null,[{key:"VERSION",get:function(){return"4.5.0"}},{key:"Default",get:function(){return ue}}]),t}();e(window).on("load.bs.scrollspy.data-api",(function(){for(var t=[].slice.call(document.querySelectorAll('[data-spy="scroll"]')),n=t.length;n--;){var i=e(t[n]);fe._jQueryInterface.call(i,i.data())}})),e.fn[le]=fe._jQueryInterface,e.fn[le].Constructor=fe,e.fn[le].noConflict=function(){return e.fn[le]=ce,fe._jQueryInterface};var de=e.fn.tab,pe=function(){function t(t){this._element=t}var n=t.prototype;return n.show=function(){var t=this;if(!(this._element.parentNode&&this._element.parentNode.nodeType===Node.ELEMENT_NODE&&e(this._element).hasClass("active")||e(this._element).hasClass("disabled"))){var n,i,o=e(this._element).closest(".nav, .list-group")[0],r=l.getSelectorFromElement(this._element);if(o){var s="UL"===o.nodeName||"OL"===o.nodeName?"> li > .active":".active";i=(i=e.makeArray(e(o).find(s)))[i.length-1]}var a=e.Event("hide.bs.tab",{relatedTarget:this._element}),c=e.Event("show.bs.tab",{relatedTarget:i});if(i&&e(i).trigger(a),e(this._element).trigger(c),!c.isDefaultPrevented()&&!a.isDefaultPrevented()){r&&(n=document.querySelector(r)),this._activate(this._element,o);var u=function(){var n=e.Event("hidden.bs.tab",{relatedTarget:t._element}),o=e.Event("shown.bs.tab",{relatedTarget:i});e(i).trigger(n),e(t._element).trigger(o)};n?this._activate(n,n.parentNode,u):u()}}},n.dispose=function(){e.removeData(this._element,"bs.tab"),this._element=null},n._activate=function(t,n,i){var o=this,r=(!n||"UL"!==n.nodeName&&"OL"!==n.nodeName?e(n).children(".active"):e(n).find("> li > .active"))[0],s=i&&r&&e(r).hasClass("fade"),a=function(){return o._transitionComplete(t,r,i)};if(r&&s){var c=l.getTransitionDurationFromElement(r);e(r).removeClass("show").one(l.TRANSITION_END,a).emulateTransitionEnd(c)}else a()},n._transitionComplete=function(t,n,i){if(n){e(n).removeClass("active");var o=e(n.parentNode).find("> .dropdown-menu .active")[0];o&&e(o).removeClass("active"),"tab"===n.getAttribute("role")&&n.setAttribute("aria-selected",!1)}if(e(t).addClass("active"),"tab"===t.getAttribute("role")&&t.setAttribute("aria-selected",!0),l.reflow(t),t.classList.contains("fade")&&t.classList.add("show"),t.parentNode&&e(t.parentNode).hasClass("dropdown-menu")){var r=e(t).closest(".dropdown")[0];if(r){var s=[].slice.call(r.querySelectorAll(".dropdown-toggle"));e(s).addClass("active")}t.setAttribute("aria-expanded",!0)}i&&i()},t._jQueryInterface=function(n){return this.each((function(){var i=e(this),o=i.data("bs.tab");if(o||(o=new t(this),i.data("bs.tab",o)),"string"==typeof n){if("undefined"==typeof o[n])throw new TypeError('No method named "'+n+'"');o[n]()}}))},i(t,null,[{key:"VERSION",get:function(){return"4.5.0"}}]),t}();e(document).on("click.bs.tab.data-api",'[data-toggle="tab"], [data-toggle="pill"], [data-toggle="list"]',(function(t){t.preventDefault(),pe._jQueryInterface.call(e(this),"show")})),e.fn.tab=pe._jQueryInterface,e.fn.tab.Constructor=pe,e.fn.tab.noConflict=function(){return e.fn.tab=de,pe._jQueryInterface};var me=e.fn.toast,ge={animation:"boolean",autohide:"boolean",delay:"number"},ve={animation:!0,autohide:!0,delay:500},_e=function(){function t(t,e){this._element=t,this._config=this._getConfig(e),this._timeout=null,this._setListeners()}var n=t.prototype;return n.show=function(){var t=this,n=e.Event("show.bs.toast");if(e(this._element).trigger(n),!n.isDefaultPrevented()){this._config.animation&&this._element.classList.add("fade");var i=function(){t._element.classList.remove("showing"),t._element.classList.add("show"),e(t._element).trigger("shown.bs.toast"),t._config.autohide&&(t._timeout=setTimeout((function(){t.hide()}),t._config.delay))};if(this._element.classList.remove("hide"),l.reflow(this._element),this._element.classList.add("showing"),this._config.animation){var o=l.getTransitionDurationFromElement(this._element);e(this._element).one(l.TRANSITION_END,i).emulateTransitionEnd(o)}else i()}},n.hide=function(){if(this._element.classList.contains("show")){var t=e.Event("hide.bs.toast");e(this._element).trigger(t),t.isDefaultPrevented()||this._close()}},n.dispose=function(){clearTimeout(this._timeout),this._timeout=null,this._element.classList.contains("show")&&this._element.classList.remove("show"),e(this._element).off("click.dismiss.bs.toast"),e.removeData(this._element,"bs.toast"),this._element=null,this._config=null},n._getConfig=function(t){return t=s(s(s({},ve),e(this._element).data()),"object"==typeof t&&t?t:{}),l.typeCheckConfig("toast",t,this.constructor.DefaultType),t},n._setListeners=function(){var t=this;e(this._element).on("click.dismiss.bs.toast",'[data-dismiss="toast"]',(function(){return t.hide()}))},n._close=function(){var t=this,n=function(){t._element.classList.add("hide"),e(t._element).trigger("hidden.bs.toast")};if(this._element.classList.remove("show"),this._config.animation){var i=l.getTransitionDurationFromElement(this._element);e(this._element).one(l.TRANSITION_END,n).emulateTransitionEnd(i)}else n()},t._jQueryInterface=function(n){return this.each((function(){var i=e(this),o=i.data("bs.toast");if(o||(o=new t(this,"object"==typeof n&&n),i.data("bs.toast",o)),"string"==typeof n){if("undefined"==typeof o[n])throw new TypeError('No method named "'+n+'"');o[n](this)}}))},i(t,null,[{key:"VERSION",get:function(){return"4.5.0"}},{key:"DefaultType",get:function(){return ge}},{key:"Default",get:function(){return ve}}]),t}();e.fn.toast=_e._jQueryInterface,e.fn.toast.Constructor=_e,e.fn.toast.noConflict=function(){return e.fn.toast=me,_e._jQueryInterface},t.Alert=h,t.Button=d,t.Carousel=y,t.Collapse=S,t.Dropdown=Ft,t.Modal=qt,t.Popover=ae,t.Scrollspy=fe,t.Tab=pe,t.Toast=_e,t.Tooltip=te,t.Util=l,Object.defineProperty(t,"__esModule",{value:!0})}));
//# sourceMappingURL=bootstrap.bundle.min.js.map
/*!
 * bsCustomFileInput v1.3.4 (https://github.com/Johann-S/bs-custom-file-input)
 * Copyright 2018 - 2020 Johann-S <johann.servoire@gmail.com>
 * Licensed under MIT (https://github.com/Johann-S/bs-custom-file-input/blob/master/LICENSE)
 */
!function(e,t){"object"==typeof exports&&"undefined"!=typeof module?module.exports=t():"function"==typeof define&&define.amd?define(t):(e=e||self).bsCustomFileInput=t()}(this,function(){"use strict";var s={CUSTOMFILE:'.custom-file input[type="file"]',CUSTOMFILELABEL:".custom-file-label",FORM:"form",INPUT:"input"},l=function(e){if(0<e.childNodes.length)for(var t=[].slice.call(e.childNodes),n=0;n<t.length;n++){var l=t[n];if(3!==l.nodeType)return l}return e},u=function(e){var t=e.bsCustomFileInput.defaultText,n=e.parentNode.querySelector(s.CUSTOMFILELABEL);n&&(l(n).textContent=t)},n=!!window.File,r=function(e){if(e.hasAttribute("multiple")&&n)return[].slice.call(e.files).map(function(e){return e.name}).join(", ");if(-1===e.value.indexOf("fakepath"))return e.value;var t=e.value.split("\\");return t[t.length-1]};function d(){var e=this.parentNode.querySelector(s.CUSTOMFILELABEL);if(e){var t=l(e),n=r(this);n.length?t.textContent=n:u(this)}}function v(){for(var e=[].slice.call(this.querySelectorAll(s.INPUT)).filter(function(e){return!!e.bsCustomFileInput}),t=0,n=e.length;t<n;t++)u(e[t])}var p="bsCustomFileInput",m="reset",h="change";return{init:function(e,t){void 0===e&&(e=s.CUSTOMFILE),void 0===t&&(t=s.FORM);for(var n,l,r=[].slice.call(document.querySelectorAll(e)),i=[].slice.call(document.querySelectorAll(t)),o=0,u=r.length;o<u;o++){var c=r[o];Object.defineProperty(c,p,{value:{defaultText:(n=void 0,n="",(l=c.parentNode.querySelector(s.CUSTOMFILELABEL))&&(n=l.textContent),n)},writable:!0}),d.call(c),c.addEventListener(h,d)}for(var f=0,a=i.length;f<a;f++)i[f].addEventListener(m,v),Object.defineProperty(i[f],p,{value:!0,writable:!0})},destroy:function(){for(var e=[].slice.call(document.querySelectorAll(s.FORM)).filter(function(e){return!!e.bsCustomFileInput}),t=[].slice.call(document.querySelectorAll(s.INPUT)).filter(function(e){return!!e.bsCustomFileInput}),n=0,l=t.length;n<l;n++){var r=t[n];u(r),r[p]=void 0,r.removeEventListener(h,d)}for(var i=0,o=e.length;i<o;i++)e[i].removeEventListener(m,v),e[i][p]=void 0}}});
//# sourceMappingURL=bs-custom-file-input.min.js.map

/**
 * SimpleBar.js - v5.2.1
 * Scrollbars, simpler.
 * https://grsmto.github.io/simplebar/
 *
 * Made by Adrien Denat from a fork by Jonathan Nicol
 * Under MIT License
 */

!function(t,e){"object"==typeof exports&&"undefined"!=typeof module?module.exports=e():"function"==typeof define&&define.amd?define(e):(t=t||self).SimpleBar=e()}(this,(function(){"use strict";var t="undefined"!=typeof globalThis?globalThis:"undefined"!=typeof window?window:"undefined"!=typeof global?global:"undefined"!=typeof self?self:{};function e(t,e){return t(e={exports:{}},e.exports),e.exports}var r,n,i,o="object",s=function(t){return t&&t.Math==Math&&t},a=s(typeof globalThis==o&&globalThis)||s(typeof window==o&&window)||s(typeof self==o&&self)||s(typeof t==o&&t)||Function("return this")(),c=function(t){try{return!!t()}catch(t){return!0}},l=!c((function(){return 7!=Object.defineProperty({},"a",{get:function(){return 7}}).a})),u={}.propertyIsEnumerable,f=Object.getOwnPropertyDescriptor,h={f:f&&!u.call({1:2},1)?function(t){var e=f(this,t);return!!e&&e.enumerable}:u},d=function(t,e){return{enumerable:!(1&t),configurable:!(2&t),writable:!(4&t),value:e}},p={}.toString,v=function(t){return p.call(t).slice(8,-1)},g="".split,y=c((function(){return!Object("z").propertyIsEnumerable(0)}))?function(t){return"String"==v(t)?g.call(t,""):Object(t)}:Object,b=function(t){if(null==t)throw TypeError("Can't call method on "+t);return t},m=function(t){return y(b(t))},x=function(t){return"object"==typeof t?null!==t:"function"==typeof t},E=function(t,e){if(!x(t))return t;var r,n;if(e&&"function"==typeof(r=t.toString)&&!x(n=r.call(t)))return n;if("function"==typeof(r=t.valueOf)&&!x(n=r.call(t)))return n;if(!e&&"function"==typeof(r=t.toString)&&!x(n=r.call(t)))return n;throw TypeError("Can't convert object to primitive value")},w={}.hasOwnProperty,O=function(t,e){return w.call(t,e)},_=a.document,S=x(_)&&x(_.createElement),A=function(t){return S?_.createElement(t):{}},k=!l&&!c((function(){return 7!=Object.defineProperty(A("div"),"a",{get:function(){return 7}}).a})),L=Object.getOwnPropertyDescriptor,M={f:l?L:function(t,e){if(t=m(t),e=E(e,!0),k)try{return L(t,e)}catch(t){}if(O(t,e))return d(!h.f.call(t,e),t[e])}},T=function(t){if(!x(t))throw TypeError(String(t)+" is not an object");return t},j=Object.defineProperty,R={f:l?j:function(t,e,r){if(T(t),e=E(e,!0),T(r),k)try{return j(t,e,r)}catch(t){}if("get"in r||"set"in r)throw TypeError("Accessors not supported");return"value"in r&&(t[e]=r.value),t}},W=l?function(t,e,r){return R.f(t,e,d(1,r))}:function(t,e,r){return t[e]=r,t},z=function(t,e){try{W(a,t,e)}catch(r){a[t]=e}return e},C=e((function(t){var e=a["__core-js_shared__"]||z("__core-js_shared__",{});(t.exports=function(t,r){return e[t]||(e[t]=void 0!==r?r:{})})("versions",[]).push({version:"3.2.1",mode:"global",copyright:"© 2019 Denis Pushkarev (zloirock.ru)"})})),N=C("native-function-to-string",Function.toString),I=a.WeakMap,D="function"==typeof I&&/native code/.test(N.call(I)),P=0,V=Math.random(),F=function(t){return"Symbol("+String(void 0===t?"":t)+")_"+(++P+V).toString(36)},B=C("keys"),H=function(t){return B[t]||(B[t]=F(t))},q={},$=a.WeakMap;if(D){var X=new $,Y=X.get,G=X.has,U=X.set;r=function(t,e){return U.call(X,t,e),e},n=function(t){return Y.call(X,t)||{}},i=function(t){return G.call(X,t)}}else{var Q=H("state");q[Q]=!0,r=function(t,e){return W(t,Q,e),e},n=function(t){return O(t,Q)?t[Q]:{}},i=function(t){return O(t,Q)}}var K={set:r,get:n,has:i,enforce:function(t){return i(t)?n(t):r(t,{})},getterFor:function(t){return function(e){var r;if(!x(e)||(r=n(e)).type!==t)throw TypeError("Incompatible receiver, "+t+" required");return r}}},J=e((function(t){var e=K.get,r=K.enforce,n=String(N).split("toString");C("inspectSource",(function(t){return N.call(t)})),(t.exports=function(t,e,i,o){var s=!!o&&!!o.unsafe,c=!!o&&!!o.enumerable,l=!!o&&!!o.noTargetGet;"function"==typeof i&&("string"!=typeof e||O(i,"name")||W(i,"name",e),r(i).source=n.join("string"==typeof e?e:"")),t!==a?(s?!l&&t[e]&&(c=!0):delete t[e],c?t[e]=i:W(t,e,i)):c?t[e]=i:z(e,i)})(Function.prototype,"toString",(function(){return"function"==typeof this&&e(this).source||N.call(this)}))})),Z=a,tt=function(t){return"function"==typeof t?t:void 0},et=function(t,e){return arguments.length<2?tt(Z[t])||tt(a[t]):Z[t]&&Z[t][e]||a[t]&&a[t][e]},rt=Math.ceil,nt=Math.floor,it=function(t){return isNaN(t=+t)?0:(t>0?nt:rt)(t)},ot=Math.min,st=function(t){return t>0?ot(it(t),9007199254740991):0},at=Math.max,ct=Math.min,lt=function(t){return function(e,r,n){var i,o=m(e),s=st(o.length),a=function(t,e){var r=it(t);return r<0?at(r+e,0):ct(r,e)}(n,s);if(t&&r!=r){for(;s>a;)if((i=o[a++])!=i)return!0}else for(;s>a;a++)if((t||a in o)&&o[a]===r)return t||a||0;return!t&&-1}},ut={includes:lt(!0),indexOf:lt(!1)}.indexOf,ft=function(t,e){var r,n=m(t),i=0,o=[];for(r in n)!O(q,r)&&O(n,r)&&o.push(r);for(;e.length>i;)O(n,r=e[i++])&&(~ut(o,r)||o.push(r));return o},ht=["constructor","hasOwnProperty","isPrototypeOf","propertyIsEnumerable","toLocaleString","toString","valueOf"],dt=ht.concat("length","prototype"),pt={f:Object.getOwnPropertyNames||function(t){return ft(t,dt)}},vt={f:Object.getOwnPropertySymbols},gt=et("Reflect","ownKeys")||function(t){var e=pt.f(T(t)),r=vt.f;return r?e.concat(r(t)):e},yt=function(t,e){for(var r=gt(e),n=R.f,i=M.f,o=0;o<r.length;o++){var s=r[o];O(t,s)||n(t,s,i(e,s))}},bt=/#|\.prototype\./,mt=function(t,e){var r=Et[xt(t)];return r==Ot||r!=wt&&("function"==typeof e?c(e):!!e)},xt=mt.normalize=function(t){return String(t).replace(bt,".").toLowerCase()},Et=mt.data={},wt=mt.NATIVE="N",Ot=mt.POLYFILL="P",_t=mt,St=M.f,At=function(t,e){var r,n,i,o,s,c=t.target,l=t.global,u=t.stat;if(r=l?a:u?a[c]||z(c,{}):(a[c]||{}).prototype)for(n in e){if(o=e[n],i=t.noTargetGet?(s=St(r,n))&&s.value:r[n],!_t(l?n:c+(u?".":"#")+n,t.forced)&&void 0!==i){if(typeof o==typeof i)continue;yt(o,i)}(t.sham||i&&i.sham)&&W(o,"sham",!0),J(r,n,o,t)}},kt=function(t){if("function"!=typeof t)throw TypeError(String(t)+" is not a function");return t},Lt=function(t,e,r){if(kt(t),void 0===e)return t;switch(r){case 0:return function(){return t.call(e)};case 1:return function(r){return t.call(e,r)};case 2:return function(r,n){return t.call(e,r,n)};case 3:return function(r,n,i){return t.call(e,r,n,i)}}return function(){return t.apply(e,arguments)}},Mt=function(t){return Object(b(t))},Tt=Array.isArray||function(t){return"Array"==v(t)},jt=!!Object.getOwnPropertySymbols&&!c((function(){return!String(Symbol())})),Rt=a.Symbol,Wt=C("wks"),zt=function(t){return Wt[t]||(Wt[t]=jt&&Rt[t]||(jt?Rt:F)("Symbol."+t))},Ct=zt("species"),Nt=function(t,e){var r;return Tt(t)&&("function"!=typeof(r=t.constructor)||r!==Array&&!Tt(r.prototype)?x(r)&&null===(r=r[Ct])&&(r=void 0):r=void 0),new(void 0===r?Array:r)(0===e?0:e)},It=[].push,Dt=function(t){var e=1==t,r=2==t,n=3==t,i=4==t,o=6==t,s=5==t||o;return function(a,c,l,u){for(var f,h,d=Mt(a),p=y(d),v=Lt(c,l,3),g=st(p.length),b=0,m=u||Nt,x=e?m(a,g):r?m(a,0):void 0;g>b;b++)if((s||b in p)&&(h=v(f=p[b],b,d),t))if(e)x[b]=h;else if(h)switch(t){case 3:return!0;case 5:return f;case 6:return b;case 2:It.call(x,f)}else if(i)return!1;return o?-1:n||i?i:x}},Pt={forEach:Dt(0),map:Dt(1),filter:Dt(2),some:Dt(3),every:Dt(4),find:Dt(5),findIndex:Dt(6)},Vt=function(t,e){var r=[][t];return!r||!c((function(){r.call(null,e||function(){throw 1},1)}))},Ft=Pt.forEach,Bt=Vt("forEach")?function(t){return Ft(this,t,arguments.length>1?arguments[1]:void 0)}:[].forEach;At({target:"Array",proto:!0,forced:[].forEach!=Bt},{forEach:Bt});var Ht={CSSRuleList:0,CSSStyleDeclaration:0,CSSValueList:0,ClientRectList:0,DOMRectList:0,DOMStringList:0,DOMTokenList:1,DataTransferItemList:0,FileList:0,HTMLAllCollection:0,HTMLCollection:0,HTMLFormElement:0,HTMLSelectElement:0,MediaList:0,MimeTypeArray:0,NamedNodeMap:0,NodeList:1,PaintRequestList:0,Plugin:0,PluginArray:0,SVGLengthList:0,SVGNumberList:0,SVGPathSegList:0,SVGPointList:0,SVGStringList:0,SVGTransformList:0,SourceBufferList:0,StyleSheetList:0,TextTrackCueList:0,TextTrackList:0,TouchList:0};for(var qt in Ht){var $t=a[qt],Xt=$t&&$t.prototype;if(Xt&&Xt.forEach!==Bt)try{W(Xt,"forEach",Bt)}catch(t){Xt.forEach=Bt}}var Yt=!("undefined"==typeof window||!window.document||!window.document.createElement),Gt=zt("species"),Ut=Pt.filter;At({target:"Array",proto:!0,forced:!function(t){return!c((function(){var e=[];return(e.constructor={})[Gt]=function(){return{foo:1}},1!==e[t](Boolean).foo}))}("filter")},{filter:function(t){return Ut(this,t,arguments.length>1?arguments[1]:void 0)}});var Qt=Object.keys||function(t){return ft(t,ht)},Kt=l?Object.defineProperties:function(t,e){T(t);for(var r,n=Qt(e),i=n.length,o=0;i>o;)R.f(t,r=n[o++],e[r]);return t},Jt=et("document","documentElement"),Zt=H("IE_PROTO"),te=function(){},ee=function(){var t,e=A("iframe"),r=ht.length;for(e.style.display="none",Jt.appendChild(e),e.src=String("javascript:"),(t=e.contentWindow.document).open(),t.write("<script>document.F=Object<\/script>"),t.close(),ee=t.F;r--;)delete ee.prototype[ht[r]];return ee()},re=Object.create||function(t,e){var r;return null!==t?(te.prototype=T(t),r=new te,te.prototype=null,r[Zt]=t):r=ee(),void 0===e?r:Kt(r,e)};q[Zt]=!0;var ne=zt("unscopables"),ie=Array.prototype;null==ie[ne]&&W(ie,ne,re(null));var oe,se,ae,ce=function(t){ie[ne][t]=!0},le={},ue=!c((function(){function t(){}return t.prototype.constructor=null,Object.getPrototypeOf(new t)!==t.prototype})),fe=H("IE_PROTO"),he=Object.prototype,de=ue?Object.getPrototypeOf:function(t){return t=Mt(t),O(t,fe)?t[fe]:"function"==typeof t.constructor&&t instanceof t.constructor?t.constructor.prototype:t instanceof Object?he:null},pe=zt("iterator"),ve=!1;[].keys&&("next"in(ae=[].keys())?(se=de(de(ae)))!==Object.prototype&&(oe=se):ve=!0),null==oe&&(oe={}),O(oe,pe)||W(oe,pe,(function(){return this}));var ge={IteratorPrototype:oe,BUGGY_SAFARI_ITERATORS:ve},ye=R.f,be=zt("toStringTag"),me=function(t,e,r){t&&!O(t=r?t:t.prototype,be)&&ye(t,be,{configurable:!0,value:e})},xe=ge.IteratorPrototype,Ee=function(){return this},we=Object.setPrototypeOf||("__proto__"in{}?function(){var t,e=!1,r={};try{(t=Object.getOwnPropertyDescriptor(Object.prototype,"__proto__").set).call(r,[]),e=r instanceof Array}catch(t){}return function(r,n){return T(r),function(t){if(!x(t)&&null!==t)throw TypeError("Can't set "+String(t)+" as a prototype")}(n),e?t.call(r,n):r.__proto__=n,r}}():void 0),Oe=ge.IteratorPrototype,_e=ge.BUGGY_SAFARI_ITERATORS,Se=zt("iterator"),Ae=function(){return this},ke=function(t,e,r,n,i,o,s){!function(t,e,r){var n=e+" Iterator";t.prototype=re(xe,{next:d(1,r)}),me(t,n,!1),le[n]=Ee}(r,e,n);var a,c,l,u=function(t){if(t===i&&g)return g;if(!_e&&t in p)return p[t];switch(t){case"keys":case"values":case"entries":return function(){return new r(this,t)}}return function(){return new r(this)}},f=e+" Iterator",h=!1,p=t.prototype,v=p[Se]||p["@@iterator"]||i&&p[i],g=!_e&&v||u(i),y="Array"==e&&p.entries||v;if(y&&(a=de(y.call(new t)),Oe!==Object.prototype&&a.next&&(de(a)!==Oe&&(we?we(a,Oe):"function"!=typeof a[Se]&&W(a,Se,Ae)),me(a,f,!0))),"values"==i&&v&&"values"!==v.name&&(h=!0,g=function(){return v.call(this)}),p[Se]!==g&&W(p,Se,g),le[e]=g,i)if(c={values:u("values"),keys:o?g:u("keys"),entries:u("entries")},s)for(l in c)!_e&&!h&&l in p||J(p,l,c[l]);else At({target:e,proto:!0,forced:_e||h},c);return c},Le=K.set,Me=K.getterFor("Array Iterator"),Te=ke(Array,"Array",(function(t,e){Le(this,{type:"Array Iterator",target:m(t),index:0,kind:e})}),(function(){var t=Me(this),e=t.target,r=t.kind,n=t.index++;return!e||n>=e.length?(t.target=void 0,{value:void 0,done:!0}):"keys"==r?{value:n,done:!1}:"values"==r?{value:e[n],done:!1}:{value:[n,e[n]],done:!1}}),"values");le.Arguments=le.Array,ce("keys"),ce("values"),ce("entries");var je=Object.assign,Re=!je||c((function(){var t={},e={},r=Symbol();return t[r]=7,"abcdefghijklmnopqrst".split("").forEach((function(t){e[t]=t})),7!=je({},t)[r]||"abcdefghijklmnopqrst"!=Qt(je({},e)).join("")}))?function(t,e){for(var r=Mt(t),n=arguments.length,i=1,o=vt.f,s=h.f;n>i;)for(var a,c=y(arguments[i++]),u=o?Qt(c).concat(o(c)):Qt(c),f=u.length,d=0;f>d;)a=u[d++],l&&!s.call(c,a)||(r[a]=c[a]);return r}:je;At({target:"Object",stat:!0,forced:Object.assign!==Re},{assign:Re});var We=zt("toStringTag"),ze="Arguments"==v(function(){return arguments}()),Ce=function(t){var e,r,n;return void 0===t?"Undefined":null===t?"Null":"string"==typeof(r=function(t,e){try{return t[e]}catch(t){}}(e=Object(t),We))?r:ze?v(e):"Object"==(n=v(e))&&"function"==typeof e.callee?"Arguments":n},Ne={};Ne[zt("toStringTag")]="z";var Ie="[object z]"!==String(Ne)?function(){return"[object "+Ce(this)+"]"}:Ne.toString,De=Object.prototype;Ie!==De.toString&&J(De,"toString",Ie,{unsafe:!0});var Pe="\t\n\v\f\r                　\u2028\u2029\ufeff",Ve="["+Pe+"]",Fe=RegExp("^"+Ve+Ve+"*"),Be=RegExp(Ve+Ve+"*$"),He=function(t){return function(e){var r=String(b(e));return 1&t&&(r=r.replace(Fe,"")),2&t&&(r=r.replace(Be,"")),r}},qe={start:He(1),end:He(2),trim:He(3)}.trim,$e=a.parseInt,Xe=/^[+-]?0[Xx]/,Ye=8!==$e(Pe+"08")||22!==$e(Pe+"0x16")?function(t,e){var r=qe(String(t));return $e(r,e>>>0||(Xe.test(r)?16:10))}:$e;At({global:!0,forced:parseInt!=Ye},{parseInt:Ye});var Ge=function(t){return function(e,r){var n,i,o=String(b(e)),s=it(r),a=o.length;return s<0||s>=a?t?"":void 0:(n=o.charCodeAt(s))<55296||n>56319||s+1===a||(i=o.charCodeAt(s+1))<56320||i>57343?t?o.charAt(s):n:t?o.slice(s,s+2):i-56320+(n-55296<<10)+65536}},Ue={codeAt:Ge(!1),charAt:Ge(!0)},Qe=Ue.charAt,Ke=K.set,Je=K.getterFor("String Iterator");ke(String,"String",(function(t){Ke(this,{type:"String Iterator",string:String(t),index:0})}),(function(){var t,e=Je(this),r=e.string,n=e.index;return n>=r.length?{value:void 0,done:!0}:(t=Qe(r,n),e.index+=t.length,{value:t,done:!1})}));var Ze=function(t,e,r){for(var n in e)J(t,n,e[n],r);return t},tr=!c((function(){return Object.isExtensible(Object.preventExtensions({}))})),er=e((function(t){var e=R.f,r=F("meta"),n=0,i=Object.isExtensible||function(){return!0},o=function(t){e(t,r,{value:{objectID:"O"+ ++n,weakData:{}}})},s=t.exports={REQUIRED:!1,fastKey:function(t,e){if(!x(t))return"symbol"==typeof t?t:("string"==typeof t?"S":"P")+t;if(!O(t,r)){if(!i(t))return"F";if(!e)return"E";o(t)}return t[r].objectID},getWeakData:function(t,e){if(!O(t,r)){if(!i(t))return!0;if(!e)return!1;o(t)}return t[r].weakData},onFreeze:function(t){return tr&&s.REQUIRED&&i(t)&&!O(t,r)&&o(t),t}};q[r]=!0})),rr=(er.REQUIRED,er.fastKey,er.getWeakData,er.onFreeze,zt("iterator")),nr=Array.prototype,ir=zt("iterator"),or=function(t,e,r,n){try{return n?e(T(r)[0],r[1]):e(r)}catch(e){var i=t.return;throw void 0!==i&&T(i.call(t)),e}},sr=e((function(t){var e=function(t,e){this.stopped=t,this.result=e};(t.exports=function(t,r,n,i,o){var s,a,c,l,u,f,h,d=Lt(r,n,i?2:1);if(o)s=t;else{if("function"!=typeof(a=function(t){if(null!=t)return t[ir]||t["@@iterator"]||le[Ce(t)]}(t)))throw TypeError("Target is not iterable");if(void 0!==(h=a)&&(le.Array===h||nr[rr]===h)){for(c=0,l=st(t.length);l>c;c++)if((u=i?d(T(f=t[c])[0],f[1]):d(t[c]))&&u instanceof e)return u;return new e(!1)}s=a.call(t)}for(;!(f=s.next()).done;)if((u=or(s,d,f.value,i))&&u instanceof e)return u;return new e(!1)}).stop=function(t){return new e(!0,t)}})),ar=function(t,e,r){if(!(t instanceof e))throw TypeError("Incorrect "+(r?r+" ":"")+"invocation");return t},cr=zt("iterator"),lr=!1;try{var ur=0,fr={next:function(){return{done:!!ur++}},return:function(){lr=!0}};fr[cr]=function(){return this},Array.from(fr,(function(){throw 2}))}catch(t){}var hr=function(t,e,r,n,i){var o=a[t],s=o&&o.prototype,l=o,u=n?"set":"add",f={},h=function(t){var e=s[t];J(s,t,"add"==t?function(t){return e.call(this,0===t?0:t),this}:"delete"==t?function(t){return!(i&&!x(t))&&e.call(this,0===t?0:t)}:"get"==t?function(t){return i&&!x(t)?void 0:e.call(this,0===t?0:t)}:"has"==t?function(t){return!(i&&!x(t))&&e.call(this,0===t?0:t)}:function(t,r){return e.call(this,0===t?0:t,r),this})};if(_t(t,"function"!=typeof o||!(i||s.forEach&&!c((function(){(new o).entries().next()})))))l=r.getConstructor(e,t,n,u),er.REQUIRED=!0;else if(_t(t,!0)){var d=new l,p=d[u](i?{}:-0,1)!=d,v=c((function(){d.has(1)})),g=function(t,e){if(!e&&!lr)return!1;var r=!1;try{var n={};n[cr]=function(){return{next:function(){return{done:r=!0}}}},t(n)}catch(t){}return r}((function(t){new o(t)})),y=!i&&c((function(){for(var t=new o,e=5;e--;)t[u](e,e);return!t.has(-0)}));g||((l=e((function(e,r){ar(e,l,t);var i=function(t,e,r){var n,i;return we&&"function"==typeof(n=e.constructor)&&n!==r&&x(i=n.prototype)&&i!==r.prototype&&we(t,i),t}(new o,e,l);return null!=r&&sr(r,i[u],i,n),i}))).prototype=s,s.constructor=l),(v||y)&&(h("delete"),h("has"),n&&h("get")),(y||p)&&h(u),i&&s.clear&&delete s.clear}return f[t]=l,At({global:!0,forced:l!=o},f),me(l,t),i||r.setStrong(l,t,n),l},dr=er.getWeakData,pr=K.set,vr=K.getterFor,gr=Pt.find,yr=Pt.findIndex,br=0,mr=function(t){return t.frozen||(t.frozen=new xr)},xr=function(){this.entries=[]},Er=function(t,e){return gr(t.entries,(function(t){return t[0]===e}))};xr.prototype={get:function(t){var e=Er(this,t);if(e)return e[1]},has:function(t){return!!Er(this,t)},set:function(t,e){var r=Er(this,t);r?r[1]=e:this.entries.push([t,e])},delete:function(t){var e=yr(this.entries,(function(e){return e[0]===t}));return~e&&this.entries.splice(e,1),!!~e}};var wr={getConstructor:function(t,e,r,n){var i=t((function(t,o){ar(t,i,e),pr(t,{type:e,id:br++,frozen:void 0}),null!=o&&sr(o,t[n],t,r)})),o=vr(e),s=function(t,e,r){var n=o(t),i=dr(T(e),!0);return!0===i?mr(n).set(e,r):i[n.id]=r,t};return Ze(i.prototype,{delete:function(t){var e=o(this);if(!x(t))return!1;var r=dr(t);return!0===r?mr(e).delete(t):r&&O(r,e.id)&&delete r[e.id]},has:function(t){var e=o(this);if(!x(t))return!1;var r=dr(t);return!0===r?mr(e).has(t):r&&O(r,e.id)}}),Ze(i.prototype,r?{get:function(t){var e=o(this);if(x(t)){var r=dr(t);return!0===r?mr(e).get(t):r?r[e.id]:void 0}},set:function(t,e){return s(this,t,e)}}:{add:function(t){return s(this,t,!0)}}),i}},Or=(e((function(t){var e,r=K.enforce,n=!a.ActiveXObject&&"ActiveXObject"in a,i=Object.isExtensible,o=function(t){return function(){return t(this,arguments.length?arguments[0]:void 0)}},s=t.exports=hr("WeakMap",o,wr,!0,!0);if(D&&n){e=wr.getConstructor(o,"WeakMap",!0),er.REQUIRED=!0;var c=s.prototype,l=c.delete,u=c.has,f=c.get,h=c.set;Ze(c,{delete:function(t){if(x(t)&&!i(t)){var n=r(this);return n.frozen||(n.frozen=new e),l.call(this,t)||n.frozen.delete(t)}return l.call(this,t)},has:function(t){if(x(t)&&!i(t)){var n=r(this);return n.frozen||(n.frozen=new e),u.call(this,t)||n.frozen.has(t)}return u.call(this,t)},get:function(t){if(x(t)&&!i(t)){var n=r(this);return n.frozen||(n.frozen=new e),u.call(this,t)?f.call(this,t):n.frozen.get(t)}return f.call(this,t)},set:function(t,n){if(x(t)&&!i(t)){var o=r(this);o.frozen||(o.frozen=new e),u.call(this,t)?h.call(this,t,n):o.frozen.set(t,n)}else h.call(this,t,n);return this}})}})),zt("iterator")),_r=zt("toStringTag"),Sr=Te.values;for(var Ar in Ht){var kr=a[Ar],Lr=kr&&kr.prototype;if(Lr){if(Lr[Or]!==Sr)try{W(Lr,Or,Sr)}catch(t){Lr[Or]=Sr}if(Lr[_r]||W(Lr,_r,Ar),Ht[Ar])for(var Mr in Te)if(Lr[Mr]!==Te[Mr])try{W(Lr,Mr,Te[Mr])}catch(t){Lr[Mr]=Te[Mr]}}}var Tr="Expected a function",jr=NaN,Rr="[object Symbol]",Wr=/^\s+|\s+$/g,zr=/^[-+]0x[0-9a-f]+$/i,Cr=/^0b[01]+$/i,Nr=/^0o[0-7]+$/i,Ir=parseInt,Dr="object"==typeof t&&t&&t.Object===Object&&t,Pr="object"==typeof self&&self&&self.Object===Object&&self,Vr=Dr||Pr||Function("return this")(),Fr=Object.prototype.toString,Br=Math.max,Hr=Math.min,qr=function(){return Vr.Date.now()};function $r(t,e,r){var n,i,o,s,a,c,l=0,u=!1,f=!1,h=!0;if("function"!=typeof t)throw new TypeError(Tr);function d(e){var r=n,o=i;return n=i=void 0,l=e,s=t.apply(o,r)}function p(t){var r=t-c;return void 0===c||r>=e||r<0||f&&t-l>=o}function v(){var t=qr();if(p(t))return g(t);a=setTimeout(v,function(t){var r=e-(t-c);return f?Hr(r,o-(t-l)):r}(t))}function g(t){return a=void 0,h&&n?d(t):(n=i=void 0,s)}function y(){var t=qr(),r=p(t);if(n=arguments,i=this,c=t,r){if(void 0===a)return function(t){return l=t,a=setTimeout(v,e),u?d(t):s}(c);if(f)return a=setTimeout(v,e),d(c)}return void 0===a&&(a=setTimeout(v,e)),s}return e=Yr(e)||0,Xr(r)&&(u=!!r.leading,o=(f="maxWait"in r)?Br(Yr(r.maxWait)||0,e):o,h="trailing"in r?!!r.trailing:h),y.cancel=function(){void 0!==a&&clearTimeout(a),l=0,n=c=i=a=void 0},y.flush=function(){return void 0===a?s:g(qr())},y}function Xr(t){var e=typeof t;return!!t&&("object"==e||"function"==e)}function Yr(t){if("number"==typeof t)return t;if(function(t){return"symbol"==typeof t||function(t){return!!t&&"object"==typeof t}(t)&&Fr.call(t)==Rr}(t))return jr;if(Xr(t)){var e="function"==typeof t.valueOf?t.valueOf():t;t=Xr(e)?e+"":e}if("string"!=typeof t)return 0===t?t:+t;t=t.replace(Wr,"");var r=Cr.test(t);return r||Nr.test(t)?Ir(t.slice(2),r?2:8):zr.test(t)?jr:+t}var Gr=function(t,e,r){var n=!0,i=!0;if("function"!=typeof t)throw new TypeError(Tr);return Xr(r)&&(n="leading"in r?!!r.leading:n,i="trailing"in r?!!r.trailing:i),$r(t,e,{leading:n,maxWait:e,trailing:i})},Ur="Expected a function",Qr=NaN,Kr="[object Symbol]",Jr=/^\s+|\s+$/g,Zr=/^[-+]0x[0-9a-f]+$/i,tn=/^0b[01]+$/i,en=/^0o[0-7]+$/i,rn=parseInt,nn="object"==typeof t&&t&&t.Object===Object&&t,on="object"==typeof self&&self&&self.Object===Object&&self,sn=nn||on||Function("return this")(),an=Object.prototype.toString,cn=Math.max,ln=Math.min,un=function(){return sn.Date.now()};function fn(t){var e=typeof t;return!!t&&("object"==e||"function"==e)}function hn(t){if("number"==typeof t)return t;if(function(t){return"symbol"==typeof t||function(t){return!!t&&"object"==typeof t}(t)&&an.call(t)==Kr}(t))return Qr;if(fn(t)){var e="function"==typeof t.valueOf?t.valueOf():t;t=fn(e)?e+"":e}if("string"!=typeof t)return 0===t?t:+t;t=t.replace(Jr,"");var r=tn.test(t);return r||en.test(t)?rn(t.slice(2),r?2:8):Zr.test(t)?Qr:+t}var dn=function(t,e,r){var n,i,o,s,a,c,l=0,u=!1,f=!1,h=!0;if("function"!=typeof t)throw new TypeError(Ur);function d(e){var r=n,o=i;return n=i=void 0,l=e,s=t.apply(o,r)}function p(t){var r=t-c;return void 0===c||r>=e||r<0||f&&t-l>=o}function v(){var t=un();if(p(t))return g(t);a=setTimeout(v,function(t){var r=e-(t-c);return f?ln(r,o-(t-l)):r}(t))}function g(t){return a=void 0,h&&n?d(t):(n=i=void 0,s)}function y(){var t=un(),r=p(t);if(n=arguments,i=this,c=t,r){if(void 0===a)return function(t){return l=t,a=setTimeout(v,e),u?d(t):s}(c);if(f)return a=setTimeout(v,e),d(c)}return void 0===a&&(a=setTimeout(v,e)),s}return e=hn(e)||0,fn(r)&&(u=!!r.leading,o=(f="maxWait"in r)?cn(hn(r.maxWait)||0,e):o,h="trailing"in r?!!r.trailing:h),y.cancel=function(){void 0!==a&&clearTimeout(a),l=0,n=c=i=a=void 0},y.flush=function(){return void 0===a?s:g(un())},y},pn="Expected a function",vn="__lodash_hash_undefined__",gn="[object Function]",yn="[object GeneratorFunction]",bn=/^\[object .+?Constructor\]$/,mn="object"==typeof t&&t&&t.Object===Object&&t,xn="object"==typeof self&&self&&self.Object===Object&&self,En=mn||xn||Function("return this")();var wn=Array.prototype,On=Function.prototype,_n=Object.prototype,Sn=En["__core-js_shared__"],An=function(){var t=/[^.]+$/.exec(Sn&&Sn.keys&&Sn.keys.IE_PROTO||"");return t?"Symbol(src)_1."+t:""}(),kn=On.toString,Ln=_n.hasOwnProperty,Mn=_n.toString,Tn=RegExp("^"+kn.call(Ln).replace(/[\\^$.*+?()[\]{}|]/g,"\\$&").replace(/hasOwnProperty|(function).*?(?=\\\()| for .+?(?=\\\])/g,"$1.*?")+"$"),jn=wn.splice,Rn=Vn(En,"Map"),Wn=Vn(Object,"create");function zn(t){var e=-1,r=t?t.length:0;for(this.clear();++e<r;){var n=t[e];this.set(n[0],n[1])}}function Cn(t){var e=-1,r=t?t.length:0;for(this.clear();++e<r;){var n=t[e];this.set(n[0],n[1])}}function Nn(t){var e=-1,r=t?t.length:0;for(this.clear();++e<r;){var n=t[e];this.set(n[0],n[1])}}function In(t,e){for(var r,n,i=t.length;i--;)if((r=t[i][0])===(n=e)||r!=r&&n!=n)return i;return-1}function Dn(t){return!(!Bn(t)||(e=t,An&&An in e))&&(function(t){var e=Bn(t)?Mn.call(t):"";return e==gn||e==yn}(t)||function(t){var e=!1;if(null!=t&&"function"!=typeof t.toString)try{e=!!(t+"")}catch(t){}return e}(t)?Tn:bn).test(function(t){if(null!=t){try{return kn.call(t)}catch(t){}try{return t+""}catch(t){}}return""}(t));var e}function Pn(t,e){var r,n,i=t.__data__;return("string"==(n=typeof(r=e))||"number"==n||"symbol"==n||"boolean"==n?"__proto__"!==r:null===r)?i["string"==typeof e?"string":"hash"]:i.map}function Vn(t,e){var r=function(t,e){return null==t?void 0:t[e]}(t,e);return Dn(r)?r:void 0}function Fn(t,e){if("function"!=typeof t||e&&"function"!=typeof e)throw new TypeError(pn);var r=function(){var n=arguments,i=e?e.apply(this,n):n[0],o=r.cache;if(o.has(i))return o.get(i);var s=t.apply(this,n);return r.cache=o.set(i,s),s};return r.cache=new(Fn.Cache||Nn),r}function Bn(t){var e=typeof t;return!!t&&("object"==e||"function"==e)}zn.prototype.clear=function(){this.__data__=Wn?Wn(null):{}},zn.prototype.delete=function(t){return this.has(t)&&delete this.__data__[t]},zn.prototype.get=function(t){var e=this.__data__;if(Wn){var r=e[t];return r===vn?void 0:r}return Ln.call(e,t)?e[t]:void 0},zn.prototype.has=function(t){var e=this.__data__;return Wn?void 0!==e[t]:Ln.call(e,t)},zn.prototype.set=function(t,e){return this.__data__[t]=Wn&&void 0===e?vn:e,this},Cn.prototype.clear=function(){this.__data__=[]},Cn.prototype.delete=function(t){var e=this.__data__,r=In(e,t);return!(r<0)&&(r==e.length-1?e.pop():jn.call(e,r,1),!0)},Cn.prototype.get=function(t){var e=this.__data__,r=In(e,t);return r<0?void 0:e[r][1]},Cn.prototype.has=function(t){return In(this.__data__,t)>-1},Cn.prototype.set=function(t,e){var r=this.__data__,n=In(r,t);return n<0?r.push([t,e]):r[n][1]=e,this},Nn.prototype.clear=function(){this.__data__={hash:new zn,map:new(Rn||Cn),string:new zn}},Nn.prototype.delete=function(t){return Pn(this,t).delete(t)},Nn.prototype.get=function(t){return Pn(this,t).get(t)},Nn.prototype.has=function(t){return Pn(this,t).has(t)},Nn.prototype.set=function(t,e){return Pn(this,t).set(t,e),this},Fn.Cache=Nn;var Hn=Fn,qn=function(){if("undefined"!=typeof Map)return Map;function t(t,e){var r=-1;return t.some((function(t,n){return t[0]===e&&(r=n,!0)})),r}return function(){function e(){this.__entries__=[]}return Object.defineProperty(e.prototype,"size",{get:function(){return this.__entries__.length},enumerable:!0,configurable:!0}),e.prototype.get=function(e){var r=t(this.__entries__,e),n=this.__entries__[r];return n&&n[1]},e.prototype.set=function(e,r){var n=t(this.__entries__,e);~n?this.__entries__[n][1]=r:this.__entries__.push([e,r])},e.prototype.delete=function(e){var r=this.__entries__,n=t(r,e);~n&&r.splice(n,1)},e.prototype.has=function(e){return!!~t(this.__entries__,e)},e.prototype.clear=function(){this.__entries__.splice(0)},e.prototype.forEach=function(t,e){void 0===e&&(e=null);for(var r=0,n=this.__entries__;r<n.length;r++){var i=n[r];t.call(e,i[1],i[0])}},e}()}(),$n="undefined"!=typeof window&&"undefined"!=typeof document&&window.document===document,Xn="undefined"!=typeof global&&global.Math===Math?global:"undefined"!=typeof self&&self.Math===Math?self:"undefined"!=typeof window&&window.Math===Math?window:Function("return this")(),Yn="function"==typeof requestAnimationFrame?requestAnimationFrame.bind(Xn):function(t){return setTimeout((function(){return t(Date.now())}),1e3/60)},Gn=2;var Un=20,Qn=["top","right","bottom","left","width","height","size","weight"],Kn="undefined"!=typeof MutationObserver,Jn=function(){function t(){this.connected_=!1,this.mutationEventsAdded_=!1,this.mutationsObserver_=null,this.observers_=[],this.onTransitionEnd_=this.onTransitionEnd_.bind(this),this.refresh=function(t,e){var r=!1,n=!1,i=0;function o(){r&&(r=!1,t()),n&&a()}function s(){Yn(o)}function a(){var t=Date.now();if(r){if(t-i<Gn)return;n=!0}else r=!0,n=!1,setTimeout(s,e);i=t}return a}(this.refresh.bind(this),Un)}return t.prototype.addObserver=function(t){~this.observers_.indexOf(t)||this.observers_.push(t),this.connected_||this.connect_()},t.prototype.removeObserver=function(t){var e=this.observers_,r=e.indexOf(t);~r&&e.splice(r,1),!e.length&&this.connected_&&this.disconnect_()},t.prototype.refresh=function(){this.updateObservers_()&&this.refresh()},t.prototype.updateObservers_=function(){var t=this.observers_.filter((function(t){return t.gatherActive(),t.hasActive()}));return t.forEach((function(t){return t.broadcastActive()})),t.length>0},t.prototype.connect_=function(){$n&&!this.connected_&&(document.addEventListener("transitionend",this.onTransitionEnd_),window.addEventListener("resize",this.refresh),Kn?(this.mutationsObserver_=new MutationObserver(this.refresh),this.mutationsObserver_.observe(document,{attributes:!0,childList:!0,characterData:!0,subtree:!0})):(document.addEventListener("DOMSubtreeModified",this.refresh),this.mutationEventsAdded_=!0),this.connected_=!0)},t.prototype.disconnect_=function(){$n&&this.connected_&&(document.removeEventListener("transitionend",this.onTransitionEnd_),window.removeEventListener("resize",this.refresh),this.mutationsObserver_&&this.mutationsObserver_.disconnect(),this.mutationEventsAdded_&&document.removeEventListener("DOMSubtreeModified",this.refresh),this.mutationsObserver_=null,this.mutationEventsAdded_=!1,this.connected_=!1)},t.prototype.onTransitionEnd_=function(t){var e=t.propertyName,r=void 0===e?"":e;Qn.some((function(t){return!!~r.indexOf(t)}))&&this.refresh()},t.getInstance=function(){return this.instance_||(this.instance_=new t),this.instance_},t.instance_=null,t}(),Zn=function(t,e){for(var r=0,n=Object.keys(e);r<n.length;r++){var i=n[r];Object.defineProperty(t,i,{value:e[i],enumerable:!1,writable:!1,configurable:!0})}return t},ti=function(t){return t&&t.ownerDocument&&t.ownerDocument.defaultView||Xn},ei=ai(0,0,0,0);function ri(t){return parseFloat(t)||0}function ni(t){for(var e=[],r=1;r<arguments.length;r++)e[r-1]=arguments[r];return e.reduce((function(e,r){return e+ri(t["border-"+r+"-width"])}),0)}function ii(t){var e=t.clientWidth,r=t.clientHeight;if(!e&&!r)return ei;var n=ti(t).getComputedStyle(t),i=function(t){for(var e={},r=0,n=["top","right","bottom","left"];r<n.length;r++){var i=n[r],o=t["padding-"+i];e[i]=ri(o)}return e}(n),o=i.left+i.right,s=i.top+i.bottom,a=ri(n.width),c=ri(n.height);if("border-box"===n.boxSizing&&(Math.round(a+o)!==e&&(a-=ni(n,"left","right")+o),Math.round(c+s)!==r&&(c-=ni(n,"top","bottom")+s)),!function(t){return t===ti(t).document.documentElement}(t)){var l=Math.round(a+o)-e,u=Math.round(c+s)-r;1!==Math.abs(l)&&(a-=l),1!==Math.abs(u)&&(c-=u)}return ai(i.left,i.top,a,c)}var oi="undefined"!=typeof SVGGraphicsElement?function(t){return t instanceof ti(t).SVGGraphicsElement}:function(t){return t instanceof ti(t).SVGElement&&"function"==typeof t.getBBox};function si(t){return $n?oi(t)?function(t){var e=t.getBBox();return ai(0,0,e.width,e.height)}(t):ii(t):ei}function ai(t,e,r,n){return{x:t,y:e,width:r,height:n}}var ci=function(){function t(t){this.broadcastWidth=0,this.broadcastHeight=0,this.contentRect_=ai(0,0,0,0),this.target=t}return t.prototype.isActive=function(){var t=si(this.target);return this.contentRect_=t,t.width!==this.broadcastWidth||t.height!==this.broadcastHeight},t.prototype.broadcastRect=function(){var t=this.contentRect_;return this.broadcastWidth=t.width,this.broadcastHeight=t.height,t},t}(),li=function(t,e){var r,n,i,o,s,a,c,l=(n=(r=e).x,i=r.y,o=r.width,s=r.height,a="undefined"!=typeof DOMRectReadOnly?DOMRectReadOnly:Object,c=Object.create(a.prototype),Zn(c,{x:n,y:i,width:o,height:s,top:i,right:n+o,bottom:s+i,left:n}),c);Zn(this,{target:t,contentRect:l})},ui=function(){function t(t,e,r){if(this.activeObservations_=[],this.observations_=new qn,"function"!=typeof t)throw new TypeError("The callback provided as parameter 1 is not a function.");this.callback_=t,this.controller_=e,this.callbackCtx_=r}return t.prototype.observe=function(t){if(!arguments.length)throw new TypeError("1 argument required, but only 0 present.");if("undefined"!=typeof Element&&Element instanceof Object){if(!(t instanceof ti(t).Element))throw new TypeError('parameter 1 is not of type "Element".');var e=this.observations_;e.has(t)||(e.set(t,new ci(t)),this.controller_.addObserver(this),this.controller_.refresh())}},t.prototype.unobserve=function(t){if(!arguments.length)throw new TypeError("1 argument required, but only 0 present.");if("undefined"!=typeof Element&&Element instanceof Object){if(!(t instanceof ti(t).Element))throw new TypeError('parameter 1 is not of type "Element".');var e=this.observations_;e.has(t)&&(e.delete(t),e.size||this.controller_.removeObserver(this))}},t.prototype.disconnect=function(){this.clearActive(),this.observations_.clear(),this.controller_.removeObserver(this)},t.prototype.gatherActive=function(){var t=this;this.clearActive(),this.observations_.forEach((function(e){e.isActive()&&t.activeObservations_.push(e)}))},t.prototype.broadcastActive=function(){if(this.hasActive()){var t=this.callbackCtx_,e=this.activeObservations_.map((function(t){return new li(t.target,t.broadcastRect())}));this.callback_.call(t,e,t),this.clearActive()}},t.prototype.clearActive=function(){this.activeObservations_.splice(0)},t.prototype.hasActive=function(){return this.activeObservations_.length>0},t}(),fi="undefined"!=typeof WeakMap?new WeakMap:new qn,hi=function t(e){if(!(this instanceof t))throw new TypeError("Cannot call a class as a function.");if(!arguments.length)throw new TypeError("1 argument required, but only 0 present.");var r=Jn.getInstance(),n=new ui(e,r,this);fi.set(this,n)};["observe","unobserve","disconnect"].forEach((function(t){hi.prototype[t]=function(){var e;return(e=fi.get(this))[t].apply(e,arguments)}}));var di=void 0!==Xn.ResizeObserver?Xn.ResizeObserver:hi,pi=null,vi=null;function gi(){if(null===pi){if("undefined"==typeof document)return pi=0;var t=document.body,e=document.createElement("div");e.classList.add("simplebar-hide-scrollbar"),t.appendChild(e);var r=e.getBoundingClientRect().right;t.removeChild(e),pi=r}return pi}Yt&&window.addEventListener("resize",(function(){vi!==window.devicePixelRatio&&(vi=window.devicePixelRatio,pi=null)}));var yi=function(t){return function(e,r,n,i){kt(r);var o=Mt(e),s=y(o),a=st(o.length),c=t?a-1:0,l=t?-1:1;if(n<2)for(;;){if(c in s){i=s[c],c+=l;break}if(c+=l,t?c<0:a<=c)throw TypeError("Reduce of empty array with no initial value")}for(;t?c>=0:a>c;c+=l)c in s&&(i=r(i,s[c],c,o));return i}},bi={left:yi(!1),right:yi(!0)}.left;At({target:"Array",proto:!0,forced:Vt("reduce")},{reduce:function(t){return bi(this,t,arguments.length,arguments.length>1?arguments[1]:void 0)}});var mi=R.f,xi=Function.prototype,Ei=xi.toString,wi=/^\s*function ([^ (]*)/;!l||"name"in xi||mi(xi,"name",{configurable:!0,get:function(){try{return Ei.call(this).match(wi)[1]}catch(t){return""}}});var Oi,_i,Si=function(){var t=T(this),e="";return t.global&&(e+="g"),t.ignoreCase&&(e+="i"),t.multiline&&(e+="m"),t.dotAll&&(e+="s"),t.unicode&&(e+="u"),t.sticky&&(e+="y"),e},Ai=RegExp.prototype.exec,ki=String.prototype.replace,Li=Ai,Mi=(Oi=/a/,_i=/b*/g,Ai.call(Oi,"a"),Ai.call(_i,"a"),0!==Oi.lastIndex||0!==_i.lastIndex),Ti=void 0!==/()??/.exec("")[1];(Mi||Ti)&&(Li=function(t){var e,r,n,i,o=this;return Ti&&(r=new RegExp("^"+o.source+"$(?!\\s)",Si.call(o))),Mi&&(e=o.lastIndex),n=Ai.call(o,t),Mi&&n&&(o.lastIndex=o.global?n.index+n[0].length:e),Ti&&n&&n.length>1&&ki.call(n[0],r,(function(){for(i=1;i<arguments.length-2;i++)void 0===arguments[i]&&(n[i]=void 0)})),n});var ji=Li;At({target:"RegExp",proto:!0,forced:/./.exec!==ji},{exec:ji});var Ri=zt("species"),Wi=!c((function(){var t=/./;return t.exec=function(){var t=[];return t.groups={a:"7"},t},"7"!=="".replace(t,"$<a>")})),zi=!c((function(){var t=/(?:)/,e=t.exec;t.exec=function(){return e.apply(this,arguments)};var r="ab".split(t);return 2!==r.length||"a"!==r[0]||"b"!==r[1]})),Ci=function(t,e,r,n){var i=zt(t),o=!c((function(){var e={};return e[i]=function(){return 7},7!=""[t](e)})),s=o&&!c((function(){var e=!1,r=/a/;return r.exec=function(){return e=!0,null},"split"===t&&(r.constructor={},r.constructor[Ri]=function(){return r}),r[i](""),!e}));if(!o||!s||"replace"===t&&!Wi||"split"===t&&!zi){var a=/./[i],l=r(i,""[t],(function(t,e,r,n,i){return e.exec===ji?o&&!i?{done:!0,value:a.call(e,r,n)}:{done:!0,value:t.call(r,e,n)}:{done:!1}})),u=l[0],f=l[1];J(String.prototype,t,u),J(RegExp.prototype,i,2==e?function(t,e){return f.call(t,this,e)}:function(t){return f.call(t,this)}),n&&W(RegExp.prototype[i],"sham",!0)}},Ni=Ue.charAt,Ii=function(t,e,r){return e+(r?Ni(t,e).length:1)},Di=function(t,e){var r=t.exec;if("function"==typeof r){var n=r.call(t,e);if("object"!=typeof n)throw TypeError("RegExp exec method returned something other than an Object or null");return n}if("RegExp"!==v(t))throw TypeError("RegExp#exec called on incompatible receiver");return ji.call(t,e)};Ci("match",1,(function(t,e,r){return[function(e){var r=b(this),n=null==e?void 0:e[t];return void 0!==n?n.call(e,r):new RegExp(e)[t](String(r))},function(t){var n=r(e,t,this);if(n.done)return n.value;var i=T(t),o=String(this);if(!i.global)return Di(i,o);var s=i.unicode;i.lastIndex=0;for(var a,c=[],l=0;null!==(a=Di(i,o));){var u=String(a[0]);c[l]=u,""===u&&(i.lastIndex=Ii(o,st(i.lastIndex),s)),l++}return 0===l?null:c}]}));var Pi=Math.max,Vi=Math.min,Fi=Math.floor,Bi=/\$([$&'`]|\d\d?|<[^>]*>)/g,Hi=/\$([$&'`]|\d\d?)/g;Ci("replace",2,(function(t,e,r){return[function(r,n){var i=b(this),o=null==r?void 0:r[t];return void 0!==o?o.call(r,i,n):e.call(String(i),r,n)},function(t,i){var o=r(e,t,this,i);if(o.done)return o.value;var s=T(t),a=String(this),c="function"==typeof i;c||(i=String(i));var l=s.global;if(l){var u=s.unicode;s.lastIndex=0}for(var f=[];;){var h=Di(s,a);if(null===h)break;if(f.push(h),!l)break;""===String(h[0])&&(s.lastIndex=Ii(a,st(s.lastIndex),u))}for(var d,p="",v=0,g=0;g<f.length;g++){h=f[g];for(var y=String(h[0]),b=Pi(Vi(it(h.index),a.length),0),m=[],x=1;x<h.length;x++)m.push(void 0===(d=h[x])?d:String(d));var E=h.groups;if(c){var w=[y].concat(m,b,a);void 0!==E&&w.push(E);var O=String(i.apply(void 0,w))}else O=n(y,a,b,m,E,i);b>=v&&(p+=a.slice(v,b)+O,v=b+y.length)}return p+a.slice(v)}];function n(t,r,n,i,o,s){var a=n+t.length,c=i.length,l=Hi;return void 0!==o&&(o=Mt(o),l=Bi),e.call(s,l,(function(e,s){var l;switch(s.charAt(0)){case"$":return"$";case"&":return t;case"`":return r.slice(0,n);case"'":return r.slice(a);case"<":l=o[s.slice(1,-1)];break;default:var u=+s;if(0===u)return e;if(u>c){var f=Fi(u/10);return 0===f?e:f<=c?void 0===i[f-1]?s.charAt(1):i[f-1]+s.charAt(1):e}l=i[u-1]}return void 0===l?"":l}))}}));var qi=function(t){return Array.prototype.reduce.call(t,(function(t,e){var r=e.name.match(/data-simplebar-(.+)/);if(r){var n=r[1].replace(/\W+(.)/g,(function(t,e){return e.toUpperCase()}));switch(e.value){case"true":t[n]=!0;break;case"false":t[n]=!1;break;case void 0:t[n]=!0;break;default:t[n]=e.value}}return t}),{})};function $i(t){return t&&t.ownerDocument&&t.ownerDocument.defaultView?t.ownerDocument.defaultView:window}function Xi(t){return t&&t.ownerDocument?t.ownerDocument:document}var Yi=function(){function t(e,r){var n=this;this.onScroll=function(){var t=$i(n.el);n.scrollXTicking||(t.requestAnimationFrame(n.scrollX),n.scrollXTicking=!0),n.scrollYTicking||(t.requestAnimationFrame(n.scrollY),n.scrollYTicking=!0)},this.scrollX=function(){n.axis.x.isOverflowing&&(n.showScrollbar("x"),n.positionScrollbar("x")),n.scrollXTicking=!1},this.scrollY=function(){n.axis.y.isOverflowing&&(n.showScrollbar("y"),n.positionScrollbar("y")),n.scrollYTicking=!1},this.onMouseEnter=function(){n.showScrollbar("x"),n.showScrollbar("y")},this.onMouseMove=function(t){n.mouseX=t.clientX,n.mouseY=t.clientY,(n.axis.x.isOverflowing||n.axis.x.forceVisible)&&n.onMouseMoveForAxis("x"),(n.axis.y.isOverflowing||n.axis.y.forceVisible)&&n.onMouseMoveForAxis("y")},this.onMouseLeave=function(){n.onMouseMove.cancel(),(n.axis.x.isOverflowing||n.axis.x.forceVisible)&&n.onMouseLeaveForAxis("x"),(n.axis.y.isOverflowing||n.axis.y.forceVisible)&&n.onMouseLeaveForAxis("y"),n.mouseX=-1,n.mouseY=-1},this.onWindowResize=function(){n.scrollbarWidth=n.getScrollbarWidth(),n.hideNativeScrollbar()},this.hideScrollbars=function(){n.axis.x.track.rect=n.axis.x.track.el.getBoundingClientRect(),n.axis.y.track.rect=n.axis.y.track.el.getBoundingClientRect(),n.isWithinBounds(n.axis.y.track.rect)||(n.axis.y.scrollbar.el.classList.remove(n.classNames.visible),n.axis.y.isVisible=!1),n.isWithinBounds(n.axis.x.track.rect)||(n.axis.x.scrollbar.el.classList.remove(n.classNames.visible),n.axis.x.isVisible=!1)},this.onPointerEvent=function(t){var e,r;n.axis.x.track.rect=n.axis.x.track.el.getBoundingClientRect(),n.axis.y.track.rect=n.axis.y.track.el.getBoundingClientRect(),(n.axis.x.isOverflowing||n.axis.x.forceVisible)&&(e=n.isWithinBounds(n.axis.x.track.rect)),(n.axis.y.isOverflowing||n.axis.y.forceVisible)&&(r=n.isWithinBounds(n.axis.y.track.rect)),(e||r)&&(t.preventDefault(),t.stopPropagation(),"mousedown"===t.type&&(e&&(n.axis.x.scrollbar.rect=n.axis.x.scrollbar.el.getBoundingClientRect(),n.isWithinBounds(n.axis.x.scrollbar.rect)?n.onDragStart(t,"x"):n.onTrackClick(t,"x")),r&&(n.axis.y.scrollbar.rect=n.axis.y.scrollbar.el.getBoundingClientRect(),n.isWithinBounds(n.axis.y.scrollbar.rect)?n.onDragStart(t,"y"):n.onTrackClick(t,"y"))))},this.drag=function(e){var r=n.axis[n.draggedAxis].track,i=r.rect[n.axis[n.draggedAxis].sizeAttr],o=n.axis[n.draggedAxis].scrollbar,s=n.contentWrapperEl[n.axis[n.draggedAxis].scrollSizeAttr],a=parseInt(n.elStyles[n.axis[n.draggedAxis].sizeAttr],10);e.preventDefault(),e.stopPropagation();var c=(("y"===n.draggedAxis?e.pageY:e.pageX)-r.rect[n.axis[n.draggedAxis].offsetAttr]-n.axis[n.draggedAxis].dragOffset)/(i-o.size)*(s-a);"x"===n.draggedAxis&&(c=n.isRtl&&t.getRtlHelpers().isRtlScrollbarInverted?c-(i+o.size):c,c=n.isRtl&&t.getRtlHelpers().isRtlScrollingInverted?-c:c),n.contentWrapperEl[n.axis[n.draggedAxis].scrollOffsetAttr]=c},this.onEndDrag=function(t){var e=Xi(n.el),r=$i(n.el);t.preventDefault(),t.stopPropagation(),n.el.classList.remove(n.classNames.dragging),e.removeEventListener("mousemove",n.drag,!0),e.removeEventListener("mouseup",n.onEndDrag,!0),n.removePreventClickId=r.setTimeout((function(){e.removeEventListener("click",n.preventClick,!0),e.removeEventListener("dblclick",n.preventClick,!0),n.removePreventClickId=null}))},this.preventClick=function(t){t.preventDefault(),t.stopPropagation()},this.el=e,this.minScrollbarWidth=20,this.options=Object.assign({},t.defaultOptions,{},r),this.classNames=Object.assign({},t.defaultOptions.classNames,{},this.options.classNames),this.axis={x:{scrollOffsetAttr:"scrollLeft",sizeAttr:"width",scrollSizeAttr:"scrollWidth",offsetSizeAttr:"offsetWidth",offsetAttr:"left",overflowAttr:"overflowX",dragOffset:0,isOverflowing:!0,isVisible:!1,forceVisible:!1,track:{},scrollbar:{}},y:{scrollOffsetAttr:"scrollTop",sizeAttr:"height",scrollSizeAttr:"scrollHeight",offsetSizeAttr:"offsetHeight",offsetAttr:"top",overflowAttr:"overflowY",dragOffset:0,isOverflowing:!0,isVisible:!1,forceVisible:!1,track:{},scrollbar:{}}},this.removePreventClickId=null,t.instances.has(this.el)||(this.recalculate=Gr(this.recalculate.bind(this),64),this.onMouseMove=Gr(this.onMouseMove.bind(this),64),this.hideScrollbars=dn(this.hideScrollbars.bind(this),this.options.timeout),this.onWindowResize=dn(this.onWindowResize.bind(this),64,{leading:!0}),t.getRtlHelpers=Hn(t.getRtlHelpers),this.init())}t.getRtlHelpers=function(){var e=document.createElement("div");e.innerHTML='<div class="hs-dummy-scrollbar-size"><div style="height: 200%; width: 200%; margin: 10px 0;"></div></div>';var r=e.firstElementChild;document.body.appendChild(r);var n=r.firstElementChild;r.scrollLeft=0;var i=t.getOffset(r),o=t.getOffset(n);r.scrollLeft=999;var s=t.getOffset(n);return{isRtlScrollingInverted:i.left!==o.left&&o.left-s.left!=0,isRtlScrollbarInverted:i.left!==o.left}},t.getOffset=function(t){var e=t.getBoundingClientRect(),r=Xi(t),n=$i(t);return{top:e.top+(n.pageYOffset||r.documentElement.scrollTop),left:e.left+(n.pageXOffset||r.documentElement.scrollLeft)}};var e=t.prototype;return e.init=function(){t.instances.set(this.el,this),Yt&&(this.initDOM(),this.scrollbarWidth=this.getScrollbarWidth(),this.recalculate(),this.initListeners())},e.initDOM=function(){var t=this;if(Array.prototype.filter.call(this.el.children,(function(e){return e.classList.contains(t.classNames.wrapper)})).length)this.wrapperEl=this.el.querySelector("."+this.classNames.wrapper),this.contentWrapperEl=this.options.scrollableNode||this.el.querySelector("."+this.classNames.contentWrapper),this.contentEl=this.options.contentNode||this.el.querySelector("."+this.classNames.contentEl),this.offsetEl=this.el.querySelector("."+this.classNames.offset),this.maskEl=this.el.querySelector("."+this.classNames.mask),this.placeholderEl=this.findChild(this.wrapperEl,"."+this.classNames.placeholder),this.heightAutoObserverWrapperEl=this.el.querySelector("."+this.classNames.heightAutoObserverWrapperEl),this.heightAutoObserverEl=this.el.querySelector("."+this.classNames.heightAutoObserverEl),this.axis.x.track.el=this.findChild(this.el,"."+this.classNames.track+"."+this.classNames.horizontal),this.axis.y.track.el=this.findChild(this.el,"."+this.classNames.track+"."+this.classNames.vertical);else{for(this.wrapperEl=document.createElement("div"),this.contentWrapperEl=document.createElement("div"),this.offsetEl=document.createElement("div"),this.maskEl=document.createElement("div"),this.contentEl=document.createElement("div"),this.placeholderEl=document.createElement("div"),this.heightAutoObserverWrapperEl=document.createElement("div"),this.heightAutoObserverEl=document.createElement("div"),this.wrapperEl.classList.add(this.classNames.wrapper),this.contentWrapperEl.classList.add(this.classNames.contentWrapper),this.offsetEl.classList.add(this.classNames.offset),this.maskEl.classList.add(this.classNames.mask),this.contentEl.classList.add(this.classNames.contentEl),this.placeholderEl.classList.add(this.classNames.placeholder),this.heightAutoObserverWrapperEl.classList.add(this.classNames.heightAutoObserverWrapperEl),this.heightAutoObserverEl.classList.add(this.classNames.heightAutoObserverEl);this.el.firstChild;)this.contentEl.appendChild(this.el.firstChild);this.contentWrapperEl.appendChild(this.contentEl),this.offsetEl.appendChild(this.contentWrapperEl),this.maskEl.appendChild(this.offsetEl),this.heightAutoObserverWrapperEl.appendChild(this.heightAutoObserverEl),this.wrapperEl.appendChild(this.heightAutoObserverWrapperEl),this.wrapperEl.appendChild(this.maskEl),this.wrapperEl.appendChild(this.placeholderEl),this.el.appendChild(this.wrapperEl)}if(!this.axis.x.track.el||!this.axis.y.track.el){var e=document.createElement("div"),r=document.createElement("div");e.classList.add(this.classNames.track),r.classList.add(this.classNames.scrollbar),e.appendChild(r),this.axis.x.track.el=e.cloneNode(!0),this.axis.x.track.el.classList.add(this.classNames.horizontal),this.axis.y.track.el=e.cloneNode(!0),this.axis.y.track.el.classList.add(this.classNames.vertical),this.el.appendChild(this.axis.x.track.el),this.el.appendChild(this.axis.y.track.el)}this.axis.x.scrollbar.el=this.axis.x.track.el.querySelector("."+this.classNames.scrollbar),this.axis.y.scrollbar.el=this.axis.y.track.el.querySelector("."+this.classNames.scrollbar),this.options.autoHide||(this.axis.x.scrollbar.el.classList.add(this.classNames.visible),this.axis.y.scrollbar.el.classList.add(this.classNames.visible)),this.el.setAttribute("data-simplebar","init")},e.initListeners=function(){var t=this,e=$i(this.el);this.options.autoHide&&this.el.addEventListener("mouseenter",this.onMouseEnter),["mousedown","click","dblclick"].forEach((function(e){t.el.addEventListener(e,t.onPointerEvent,!0)})),["touchstart","touchend","touchmove"].forEach((function(e){t.el.addEventListener(e,t.onPointerEvent,{capture:!0,passive:!0})})),this.el.addEventListener("mousemove",this.onMouseMove),this.el.addEventListener("mouseleave",this.onMouseLeave),this.contentWrapperEl.addEventListener("scroll",this.onScroll),e.addEventListener("resize",this.onWindowResize);var r=!1,n=e.ResizeObserver||di;this.resizeObserver=new n((function(){r&&t.recalculate()})),this.resizeObserver.observe(this.el),this.resizeObserver.observe(this.contentEl),e.requestAnimationFrame((function(){r=!0})),this.mutationObserver=new e.MutationObserver(this.recalculate),this.mutationObserver.observe(this.contentEl,{childList:!0,subtree:!0,characterData:!0})},e.recalculate=function(){var t=$i(this.el);this.elStyles=t.getComputedStyle(this.el),this.isRtl="rtl"===this.elStyles.direction;var e=this.contentEl.offsetWidth,r=this.heightAutoObserverEl.offsetHeight<=1,n=this.heightAutoObserverEl.offsetWidth<=1||e>0,i=this.contentWrapperEl.offsetWidth,o=this.elStyles.overflowX,s=this.elStyles.overflowY;this.contentEl.style.padding=this.elStyles.paddingTop+" "+this.elStyles.paddingRight+" "+this.elStyles.paddingBottom+" "+this.elStyles.paddingLeft,this.wrapperEl.style.margin="-"+this.elStyles.paddingTop+" -"+this.elStyles.paddingRight+" -"+this.elStyles.paddingBottom+" -"+this.elStyles.paddingLeft;var a=this.contentEl.scrollHeight,c=this.contentEl.scrollWidth;this.contentWrapperEl.style.height=r?"auto":"100%",this.placeholderEl.style.width=n?(e||c)+"px":"auto",this.placeholderEl.style.height=a+"px";var l=this.contentWrapperEl.offsetHeight;this.axis.x.isOverflowing=0!==e&&c>e,this.axis.y.isOverflowing=a>l,this.axis.x.isOverflowing="hidden"!==o&&this.axis.x.isOverflowing,this.axis.y.isOverflowing="hidden"!==s&&this.axis.y.isOverflowing,this.axis.x.forceVisible="x"===this.options.forceVisible||!0===this.options.forceVisible,this.axis.y.forceVisible="y"===this.options.forceVisible||!0===this.options.forceVisible,this.hideNativeScrollbar();var u=this.axis.x.isOverflowing?this.scrollbarWidth:0,f=this.axis.y.isOverflowing?this.scrollbarWidth:0;this.axis.x.isOverflowing=this.axis.x.isOverflowing&&c>i-f,this.axis.y.isOverflowing=this.axis.y.isOverflowing&&a>l-u,this.axis.x.scrollbar.size=this.getScrollbarSize("x"),this.axis.y.scrollbar.size=this.getScrollbarSize("y"),this.axis.x.scrollbar.el.style.width=this.axis.x.scrollbar.size+"px",this.axis.y.scrollbar.el.style.height=this.axis.y.scrollbar.size+"px",this.positionScrollbar("x"),this.positionScrollbar("y"),this.toggleTrackVisibility("x"),this.toggleTrackVisibility("y")},e.getScrollbarSize=function(t){if(void 0===t&&(t="y"),!this.axis[t].isOverflowing)return 0;var e,r=this.contentEl[this.axis[t].scrollSizeAttr],n=this.axis[t].track.el[this.axis[t].offsetSizeAttr],i=n/r;return e=Math.max(~~(i*n),this.options.scrollbarMinSize),this.options.scrollbarMaxSize&&(e=Math.min(e,this.options.scrollbarMaxSize)),e},e.positionScrollbar=function(e){if(void 0===e&&(e="y"),this.axis[e].isOverflowing){var r=this.contentWrapperEl[this.axis[e].scrollSizeAttr],n=this.axis[e].track.el[this.axis[e].offsetSizeAttr],i=parseInt(this.elStyles[this.axis[e].sizeAttr],10),o=this.axis[e].scrollbar,s=this.contentWrapperEl[this.axis[e].scrollOffsetAttr],a=(s="x"===e&&this.isRtl&&t.getRtlHelpers().isRtlScrollingInverted?-s:s)/(r-i),c=~~((n-o.size)*a);c="x"===e&&this.isRtl&&t.getRtlHelpers().isRtlScrollbarInverted?c+(n-o.size):c,o.el.style.transform="x"===e?"translate3d("+c+"px, 0, 0)":"translate3d(0, "+c+"px, 0)"}},e.toggleTrackVisibility=function(t){void 0===t&&(t="y");var e=this.axis[t].track.el,r=this.axis[t].scrollbar.el;this.axis[t].isOverflowing||this.axis[t].forceVisible?(e.style.visibility="visible",this.contentWrapperEl.style[this.axis[t].overflowAttr]="scroll"):(e.style.visibility="hidden",this.contentWrapperEl.style[this.axis[t].overflowAttr]="hidden"),this.axis[t].isOverflowing?r.style.display="block":r.style.display="none"},e.hideNativeScrollbar=function(){this.offsetEl.style[this.isRtl?"left":"right"]=this.axis.y.isOverflowing||this.axis.y.forceVisible?"-"+this.scrollbarWidth+"px":0,this.offsetEl.style.bottom=this.axis.x.isOverflowing||this.axis.x.forceVisible?"-"+this.scrollbarWidth+"px":0},e.onMouseMoveForAxis=function(t){void 0===t&&(t="y"),this.axis[t].track.rect=this.axis[t].track.el.getBoundingClientRect(),this.axis[t].scrollbar.rect=this.axis[t].scrollbar.el.getBoundingClientRect(),this.isWithinBounds(this.axis[t].scrollbar.rect)?this.axis[t].scrollbar.el.classList.add(this.classNames.hover):this.axis[t].scrollbar.el.classList.remove(this.classNames.hover),this.isWithinBounds(this.axis[t].track.rect)?(this.showScrollbar(t),this.axis[t].track.el.classList.add(this.classNames.hover)):this.axis[t].track.el.classList.remove(this.classNames.hover)},e.onMouseLeaveForAxis=function(t){void 0===t&&(t="y"),this.axis[t].track.el.classList.remove(this.classNames.hover),this.axis[t].scrollbar.el.classList.remove(this.classNames.hover)},e.showScrollbar=function(t){void 0===t&&(t="y");var e=this.axis[t].scrollbar.el;this.axis[t].isVisible||(e.classList.add(this.classNames.visible),this.axis[t].isVisible=!0),this.options.autoHide&&this.hideScrollbars()},e.onDragStart=function(t,e){void 0===e&&(e="y");var r=Xi(this.el),n=$i(this.el),i=this.axis[e].scrollbar,o="y"===e?t.pageY:t.pageX;this.axis[e].dragOffset=o-i.rect[this.axis[e].offsetAttr],this.draggedAxis=e,this.el.classList.add(this.classNames.dragging),r.addEventListener("mousemove",this.drag,!0),r.addEventListener("mouseup",this.onEndDrag,!0),null===this.removePreventClickId?(r.addEventListener("click",this.preventClick,!0),r.addEventListener("dblclick",this.preventClick,!0)):(n.clearTimeout(this.removePreventClickId),this.removePreventClickId=null)},e.onTrackClick=function(t,e){var r=this;if(void 0===e&&(e="y"),this.options.clickOnTrack){var n=$i(this.el);this.axis[e].scrollbar.rect=this.axis[e].scrollbar.el.getBoundingClientRect();var i=this.axis[e].scrollbar.rect[this.axis[e].offsetAttr],o=parseInt(this.elStyles[this.axis[e].sizeAttr],10),s=this.contentWrapperEl[this.axis[e].scrollOffsetAttr],a=("y"===e?this.mouseY-i:this.mouseX-i)<0?-1:1,c=-1===a?s-o:s+o;!function t(){var i,o;-1===a?s>c&&(s-=40,r.contentWrapperEl.scrollTo(((i={})[r.axis[e].offsetAttr]=s,i)),n.requestAnimationFrame(t)):s<c&&(s+=40,r.contentWrapperEl.scrollTo(((o={})[r.axis[e].offsetAttr]=s,o)),n.requestAnimationFrame(t))}()}},e.getContentElement=function(){return this.contentEl},e.getScrollElement=function(){return this.contentWrapperEl},e.getScrollbarWidth=function(){try{return"none"===getComputedStyle(this.contentWrapperEl,"::-webkit-scrollbar").display||"scrollbarWidth"in document.documentElement.style||"-ms-overflow-style"in document.documentElement.style?0:gi()}catch(t){return gi()}},e.removeListeners=function(){var t=this,e=$i(this.el);this.options.autoHide&&this.el.removeEventListener("mouseenter",this.onMouseEnter),["mousedown","click","dblclick"].forEach((function(e){t.el.removeEventListener(e,t.onPointerEvent,!0)})),["touchstart","touchend","touchmove"].forEach((function(e){t.el.removeEventListener(e,t.onPointerEvent,{capture:!0,passive:!0})})),this.el.removeEventListener("mousemove",this.onMouseMove),this.el.removeEventListener("mouseleave",this.onMouseLeave),this.contentWrapperEl.removeEventListener("scroll",this.onScroll),e.removeEventListener("resize",this.onWindowResize),this.mutationObserver.disconnect(),this.resizeObserver.disconnect(),this.recalculate.cancel(),this.onMouseMove.cancel(),this.hideScrollbars.cancel(),this.onWindowResize.cancel()},e.unMount=function(){this.removeListeners(),t.instances.delete(this.el)},e.isWithinBounds=function(t){return this.mouseX>=t.left&&this.mouseX<=t.left+t.width&&this.mouseY>=t.top&&this.mouseY<=t.top+t.height},e.findChild=function(t,e){var r=t.matches||t.webkitMatchesSelector||t.mozMatchesSelector||t.msMatchesSelector;return Array.prototype.filter.call(t.children,(function(t){return r.call(t,e)}))[0]},t}();return Yi.defaultOptions={autoHide:!0,forceVisible:!1,clickOnTrack:!0,classNames:{contentEl:"simplebar-content",contentWrapper:"simplebar-content-wrapper",offset:"simplebar-offset",mask:"simplebar-mask",wrapper:"simplebar-wrapper",placeholder:"simplebar-placeholder",scrollbar:"simplebar-scrollbar",track:"simplebar-track",heightAutoObserverWrapperEl:"simplebar-height-auto-observer-wrapper",heightAutoObserverEl:"simplebar-height-auto-observer",visible:"simplebar-visible",horizontal:"simplebar-horizontal",vertical:"simplebar-vertical",hover:"simplebar-hover",dragging:"simplebar-dragging"},scrollbarMinSize:25,scrollbarMaxSize:0,timeout:1e3},Yi.instances=new WeakMap,Yi.initDOMLoadedElements=function(){document.removeEventListener("DOMContentLoaded",this.initDOMLoadedElements),window.removeEventListener("load",this.initDOMLoadedElements),Array.prototype.forEach.call(document.querySelectorAll("[data-simplebar]"),(function(t){"init"===t.getAttribute("data-simplebar")||Yi.instances.has(t)||new Yi(t,qi(t.attributes))}))},Yi.removeObserver=function(){this.globalObserver.disconnect()},Yi.initHtmlApi=function(){this.initDOMLoadedElements=this.initDOMLoadedElements.bind(this),"undefined"!=typeof MutationObserver&&(this.globalObserver=new MutationObserver(Yi.handleMutations),this.globalObserver.observe(document,{childList:!0,subtree:!0})),"complete"===document.readyState||"loading"!==document.readyState&&!document.documentElement.doScroll?window.setTimeout(this.initDOMLoadedElements):(document.addEventListener("DOMContentLoaded",this.initDOMLoadedElements),window.addEventListener("load",this.initDOMLoadedElements))},Yi.handleMutations=function(t){t.forEach((function(t){Array.prototype.forEach.call(t.addedNodes,(function(t){1===t.nodeType&&(t.hasAttribute("data-simplebar")?!Yi.instances.has(t)&&new Yi(t,qi(t.attributes)):Array.prototype.forEach.call(t.querySelectorAll("[data-simplebar]"),(function(t){"init"===t.getAttribute("data-simplebar")||Yi.instances.has(t)||new Yi(t,qi(t.attributes))})))})),Array.prototype.forEach.call(t.removedNodes,(function(t){1===t.nodeType&&(t.hasAttribute('[data-simplebar="init"]')?Yi.instances.has(t)&&Yi.instances.get(t).unMount():Array.prototype.forEach.call(t.querySelectorAll('[data-simplebar="init"]'),(function(t){Yi.instances.has(t)&&Yi.instances.get(t).unMount()})))}))}))},Yi.getOptions=qi,Yt&&Yi.initHtmlApi(),Yi}));

var tns=function(){Object.keys||(Object.keys=function(t){var e=[];for(var n in t)Object.prototype.hasOwnProperty.call(t,n)&&e.push(n);return e}),"remove"in Element.prototype||(Element.prototype.remove=function(){this.parentNode&&this.parentNode.removeChild(this)});var t=window,Oi=t.requestAnimationFrame||t.webkitRequestAnimationFrame||t.mozRequestAnimationFrame||t.msRequestAnimationFrame||function(t){return setTimeout(t,16)},e=window,Di=e.cancelAnimationFrame||e.mozCancelAnimationFrame||function(t){clearTimeout(t)};function Hi(){for(var t,e,n,i=arguments[0]||{},a=1,r=arguments.length;a<r;a++)if(null!==(t=arguments[a]))for(e in t)i!==(n=t[e])&&void 0!==n&&(i[e]=n);return i}function ki(t){return 0<=["true","false"].indexOf(t)?JSON.parse(t):t}function Ri(t,e,n,i){if(i)try{t.setItem(e,n)}catch(t){}return n}function Ii(){var t=document,e=t.body;return e||((e=t.createElement("body")).fake=!0),e}var n=document.documentElement;function Pi(t){var e="";return t.fake&&(e=n.style.overflow,t.style.background="",t.style.overflow=n.style.overflow="hidden",n.appendChild(t)),e}function zi(t,e){t.fake&&(t.remove(),n.style.overflow=e,n.offsetHeight)}function Wi(t,e,n,i){"insertRule"in t?t.insertRule(e+"{"+n+"}",i):t.addRule(e,n,i)}function Fi(t){return("insertRule"in t?t.cssRules:t.rules).length}function qi(t,e,n){for(var i=0,a=t.length;i<a;i++)e.call(n,t[i],i)}var i="classList"in document.createElement("_"),ji=i?function(t,e){return t.classList.contains(e)}:function(t,e){return 0<=t.className.indexOf(e)},Vi=i?function(t,e){ji(t,e)||t.classList.add(e)}:function(t,e){ji(t,e)||(t.className+=" "+e)},Gi=i?function(t,e){ji(t,e)&&t.classList.remove(e)}:function(t,e){ji(t,e)&&(t.className=t.className.replace(e,""))};function Qi(t,e){return t.hasAttribute(e)}function Xi(t,e){return t.getAttribute(e)}function r(t){return void 0!==t.item}function Yi(t,e){if(t=r(t)||t instanceof Array?t:[t],"[object Object]"===Object.prototype.toString.call(e))for(var n=t.length;n--;)for(var i in e)t[n].setAttribute(i,e[i])}function Ki(t,e){t=r(t)||t instanceof Array?t:[t];for(var n=(e=e instanceof Array?e:[e]).length,i=t.length;i--;)for(var a=n;a--;)t[i].removeAttribute(e[a])}function Ji(t){for(var e=[],n=0,i=t.length;n<i;n++)e.push(t[n]);return e}function Ui(t,e){"none"!==t.style.display&&(t.style.display="none")}function _i(t,e){"none"===t.style.display&&(t.style.display="")}function Zi(t){return"none"!==window.getComputedStyle(t).display}function $i(e){if("string"==typeof e){var n=[e],i=e.charAt(0).toUpperCase()+e.substr(1);["Webkit","Moz","ms","O"].forEach(function(t){"ms"===t&&"transform"!==e||n.push(t+i)}),e=n}for(var t=document.createElement("fakeelement"),a=(e.length,0);a<e.length;a++){var r=e[a];if(void 0!==t.style[r])return r}return!1}function ta(t,e){var n=!1;return/^Webkit/.test(t)?n="webkit"+e+"End":/^O/.test(t)?n="o"+e+"End":t&&(n=e.toLowerCase()+"end"),n}var a=!1;try{var o=Object.defineProperty({},"passive",{get:function(){a=!0}});window.addEventListener("test",null,o)}catch(t){}var u=!!a&&{passive:!0};function ea(t,e,n){for(var i in e){var a=0<=["touchstart","touchmove"].indexOf(i)&&!n&&u;t.addEventListener(i,e[i],a)}}function na(t,e){for(var n in e){var i=0<=["touchstart","touchmove"].indexOf(n)&&u;t.removeEventListener(n,e[n],i)}}function ia(){return{topics:{},on:function(t,e){this.topics[t]=this.topics[t]||[],this.topics[t].push(e)},off:function(t,e){if(this.topics[t])for(var n=0;n<this.topics[t].length;n++)if(this.topics[t][n]===e){this.topics[t].splice(n,1);break}},emit:function(e,n){n.type=e,this.topics[e]&&this.topics[e].forEach(function(t){t(n,e)})}}}var aa=function(O){O=Hi({container:".slider",mode:"carousel",axis:"horizontal",items:1,gutter:0,edgePadding:0,fixedWidth:!1,autoWidth:!1,viewportMax:!1,slideBy:1,center:!1,controls:!0,controlsPosition:"top",controlsText:["prev","next"],controlsContainer:!1,prevButton:!1,nextButton:!1,nav:!0,navPosition:"top",navContainer:!1,navAsThumbnails:!1,arrowKeys:!1,speed:300,autoplay:!1,autoplayPosition:"top",autoplayTimeout:5e3,autoplayDirection:"forward",autoplayText:["start","stop"],autoplayHoverPause:!1,autoplayButton:!1,autoplayButtonOutput:!0,autoplayResetOnVisibility:!0,animateIn:"tns-fadeIn",animateOut:"tns-fadeOut",animateNormal:"tns-normal",animateDelay:!1,loop:!0,rewind:!1,autoHeight:!1,responsive:!1,lazyload:!1,lazyloadSelector:".tns-lazy-img",touch:!0,mouseDrag:!1,swipeAngle:15,nested:!1,preventActionWhenRunning:!1,preventScrollOnTouch:!1,freezable:!0,onInit:!1,useLocalStorage:!0},O||{});var D=document,h=window,a={ENTER:13,SPACE:32,LEFT:37,RIGHT:39},e={},n=O.useLocalStorage;if(n){var t=navigator.userAgent,i=new Date;try{(e=h.localStorage)?(e.setItem(i,i),n=e.getItem(i)==i,e.removeItem(i)):n=!1,n||(e={})}catch(t){n=!1}n&&(e.tnsApp&&e.tnsApp!==t&&["tC","tPL","tMQ","tTf","t3D","tTDu","tTDe","tADu","tADe","tTE","tAE"].forEach(function(t){e.removeItem(t)}),localStorage.tnsApp=t)}var r,o,u,l,s,c,f,y=e.tC?ki(e.tC):Ri(e,"tC",function(){var t=document,e=Ii(),n=Pi(e),i=t.createElement("div"),a=!1;e.appendChild(i);try{for(var r,o="(10px * 10)",u=["calc"+o,"-moz-calc"+o,"-webkit-calc"+o],l=0;l<3;l++)if(r=u[l],i.style.width=r,100===i.offsetWidth){a=r.replace(o,"");break}}catch(t){}return e.fake?zi(e,n):i.remove(),a}(),n),g=e.tPL?ki(e.tPL):Ri(e,"tPL",function(){var t,e=document,n=Ii(),i=Pi(n),a=e.createElement("div"),r=e.createElement("div"),o="";a.className="tns-t-subp2",r.className="tns-t-ct";for(var u=0;u<70;u++)o+="<div></div>";return r.innerHTML=o,a.appendChild(r),n.appendChild(a),t=Math.abs(a.getBoundingClientRect().left-r.children[67].getBoundingClientRect().left)<2,n.fake?zi(n,i):a.remove(),t}(),n),H=e.tMQ?ki(e.tMQ):Ri(e,"tMQ",(o=document,u=Ii(),l=Pi(u),s=o.createElement("div"),c=o.createElement("style"),f="@media all and (min-width:1px){.tns-mq-test{position:absolute}}",c.type="text/css",s.className="tns-mq-test",u.appendChild(c),u.appendChild(s),c.styleSheet?c.styleSheet.cssText=f:c.appendChild(o.createTextNode(f)),r=window.getComputedStyle?window.getComputedStyle(s).position:s.currentStyle.position,u.fake?zi(u,l):s.remove(),"absolute"===r),n),d=e.tTf?ki(e.tTf):Ri(e,"tTf",$i("transform"),n),v=e.t3D?ki(e.t3D):Ri(e,"t3D",function(t){if(!t)return!1;if(!window.getComputedStyle)return!1;var e,n=document,i=Ii(),a=Pi(i),r=n.createElement("p"),o=9<t.length?"-"+t.slice(0,-9).toLowerCase()+"-":"";return o+="transform",i.insertBefore(r,null),r.style[t]="translate3d(1px,1px,1px)",e=window.getComputedStyle(r).getPropertyValue(o),i.fake?zi(i,a):r.remove(),void 0!==e&&0<e.length&&"none"!==e}(d),n),x=e.tTDu?ki(e.tTDu):Ri(e,"tTDu",$i("transitionDuration"),n),p=e.tTDe?ki(e.tTDe):Ri(e,"tTDe",$i("transitionDelay"),n),b=e.tADu?ki(e.tADu):Ri(e,"tADu",$i("animationDuration"),n),m=e.tADe?ki(e.tADe):Ri(e,"tADe",$i("animationDelay"),n),C=e.tTE?ki(e.tTE):Ri(e,"tTE",ta(x,"Transition"),n),w=e.tAE?ki(e.tAE):Ri(e,"tAE",ta(b,"Animation"),n),M=h.console&&"function"==typeof h.console.warn,T=["container","controlsContainer","prevButton","nextButton","navContainer","autoplayButton"],E={};if(T.forEach(function(t){if("string"==typeof O[t]){var e=O[t],n=D.querySelector(e);if(E[t]=e,!n||!n.nodeName)return void(M&&console.warn("Can't find",O[t]));O[t]=n}}),!(O.container.children.length<1)){var k=O.responsive,R=O.nested,I="carousel"===O.mode;if(k){0 in k&&(O=Hi(O,k[0]),delete k[0]);var A={};for(var N in k){var L=k[N];L="number"==typeof L?{items:L}:L,A[N]=L}k=A,A=null}if(I||function t(e){for(var n in e)I||("slideBy"===n&&(e[n]="page"),"edgePadding"===n&&(e[n]=!1),"autoHeight"===n&&(e[n]=!1)),"responsive"===n&&t(e[n])}(O),!I){O.axis="horizontal",O.slideBy="page",O.edgePadding=!1;var P=O.animateIn,z=O.animateOut,B=O.animateDelay,W=O.animateNormal}var S,F,q="horizontal"===O.axis,j=D.createElement("div"),V=D.createElement("div"),G=O.container,Q=G.parentNode,X=G.outerHTML,Y=G.children,K=Y.length,J=sn(),U=!1;k&&Bn(),I&&(G.className+=" tns-vpfix");var _,Z,$,tt,et,nt,it,at,rt=O.autoWidth,ot=vn("fixedWidth"),ut=vn("edgePadding"),lt=vn("gutter"),st=fn(),ct=vn("center"),ft=rt?1:Math.floor(vn("items")),dt=vn("slideBy"),vt=O.viewportMax||O.fixedWidthViewportWidth,pt=vn("arrowKeys"),mt=vn("speed"),ht=O.rewind,yt=!ht&&O.loop,gt=vn("autoHeight"),xt=vn("controls"),bt=vn("controlsText"),Ct=vn("nav"),wt=vn("touch"),Mt=vn("mouseDrag"),Tt=vn("autoplay"),Et=vn("autoplayTimeout"),At=vn("autoplayText"),Nt=vn("autoplayHoverPause"),Lt=vn("autoplayResetOnVisibility"),Bt=(at=document.createElement("style"),it&&at.setAttribute("media",it),document.querySelector("head").appendChild(at),at.sheet?at.sheet:at.styleSheet),St=O.lazyload,Ot=(O.lazyloadSelector,[]),Dt=yt?(et=function(){{if(rt||ot&&!vt)return K-1;var t=ot?"fixedWidth":"items",e=[];if((ot||O[t]<K)&&e.push(O[t]),k)for(var n in k){var i=k[n][t];i&&(ot||i<K)&&e.push(i)}return e.length||e.push(0),Math.ceil(ot?vt/Math.min.apply(null,e):Math.max.apply(null,e))}}(),nt=I?Math.ceil((5*et-K)/2):4*et-K,nt=Math.max(et,nt),dn("edgePadding")?nt+1:nt):0,Ht=I?K+2*Dt:K+Dt,kt=!(!ot&&!rt||yt),Rt=ot?ni():null,It=!I||!yt,Pt=q?"left":"top",zt="",Wt="",Ft=ot?function(){return ct&&!yt?K-1:Math.ceil(-Rt/(ot+lt))}:rt?function(){for(var t=Ht;t--;)if(_[t]>=-Rt)return t}:function(){return ct&&I&&!yt?K-1:yt||I?Math.max(0,Ht-Math.ceil(ft)):Ht-1},qt=on(vn("startIndex")),jt=qt,Vt=(rn(),0),Gt=rt?null:Ft(),Qt=O.preventActionWhenRunning,Xt=O.swipeAngle,Yt=!Xt||"?",Kt=!1,Jt=O.onInit,Ut=new ia,_t=" tns-slider tns-"+O.mode,Zt=G.id||(tt=window.tnsId,window.tnsId=tt?tt+1:1,"tns"+window.tnsId),$t=vn("disable"),te=!1,ee=O.freezable,ne=!(!ee||rt)&&Ln(),ie=!1,ae={click:fi,keydown:function(t){t=xi(t);var e=[a.LEFT,a.RIGHT].indexOf(t.keyCode);0<=e&&(0===e?Ee.disabled||fi(t,-1):Ae.disabled||fi(t,1))}},re={click:function(t){if(Kt){if(Qt)return;si()}var e=bi(t=xi(t));for(;e!==Se&&!Qi(e,"data-nav");)e=e.parentNode;if(Qi(e,"data-nav")){var n=ke=Number(Xi(e,"data-nav")),i=ot||rt?n*K/De:n*ft,a=ve?n:Math.min(Math.ceil(i),K-1);ci(a,t),Re===n&&(qe&&hi(),ke=-1)}},keydown:function(t){t=xi(t);var e=D.activeElement;if(!Qi(e,"data-nav"))return;var n=[a.LEFT,a.RIGHT,a.ENTER,a.SPACE].indexOf(t.keyCode),i=Number(Xi(e,"data-nav"));0<=n&&(0===n?0<i&&gi(Be[i-1]):1===n?i<De-1&&gi(Be[i+1]):ci(ke=i,t))}},oe={mouseover:function(){qe&&(vi(),je=!0)},mouseout:function(){je&&(di(),je=!1)}},ue={visibilitychange:function(){D.hidden?qe&&(vi(),Ge=!0):Ge&&(di(),Ge=!1)}},le={keydown:function(t){t=xi(t);var e=[a.LEFT,a.RIGHT].indexOf(t.keyCode);0<=e&&fi(t,0===e?-1:1)}},se={touchstart:Ti,touchmove:Ei,touchend:Ai,touchcancel:Ai},ce={mousedown:Ti,mousemove:Ei,mouseup:Ai,mouseleave:Ai},fe=dn("controls"),de=dn("nav"),ve=!!rt||O.navAsThumbnails,pe=dn("autoplay"),me=dn("touch"),he=dn("mouseDrag"),ye="tns-slide-active",ge="tns-complete",xe={load:function(t){zn(bi(t))},error:function(t){e=bi(t),Vi(e,"failed"),Wn(e);var e}},be="force"===O.preventScrollOnTouch;if(fe)var Ce,we,Me=O.controlsContainer,Te=O.controlsContainer?O.controlsContainer.outerHTML:"",Ee=O.prevButton,Ae=O.nextButton,Ne=O.prevButton?O.prevButton.outerHTML:"",Le=O.nextButton?O.nextButton.outerHTML:"";if(de)var Be,Se=O.navContainer,Oe=O.navContainer?O.navContainer.outerHTML:"",De=rt?K:Li(),He=0,ke=-1,Re=ln(),Ie=Re,Pe="tns-nav-active",ze="Carousel Page ",We=" (Current Slide)";if(pe)var Fe,qe,je,Ve,Ge,Qe="forward"===O.autoplayDirection?1:-1,Xe=O.autoplayButton,Ye=O.autoplayButton?O.autoplayButton.outerHTML:"",Ke=["<span class='tns-visually-hidden'>"," animation</span>"];if(me||he)var Je,Ue,_e={},Ze={},$e=!1,tn=q?function(t,e){return t.x-e.x}:function(t,e){return t.y-e.y};rt||an($t||ne),d&&(Pt=d,zt="translate",v?(zt+=q?"3d(":"3d(0px, ",Wt=q?", 0px, 0px)":", 0px)"):(zt+=q?"X(":"Y(",Wt=")")),I&&(G.className=G.className.replace("tns-vpfix","")),function(){dn("gutter");j.className="tns-outer",V.className="tns-inner",j.id=Zt+"-ow",V.id=Zt+"-iw",""===G.id&&(G.id=Zt);_t+=g||rt?" tns-subpixel":" tns-no-subpixel",_t+=y?" tns-calc":" tns-no-calc",rt&&(_t+=" tns-autowidth");_t+=" tns-"+O.axis,G.className+=_t,I?((S=D.createElement("div")).id=Zt+"-mw",S.className="tns-ovh",j.appendChild(S),S.appendChild(V)):j.appendChild(V);if(gt){var t=S||V;t.className+=" tns-ah"}if(Q.insertBefore(j,G),V.appendChild(G),qi(Y,function(t,e){Vi(t,"tns-item"),t.id||(t.id=Zt+"-item"+e),!I&&W&&Vi(t,W),Yi(t,{"aria-hidden":"true",tabindex:"-1"})}),Dt){for(var e=D.createDocumentFragment(),n=D.createDocumentFragment(),i=Dt;i--;){var a=i%K,r=Y[a].cloneNode(!0);if(Ki(r,"id"),n.insertBefore(r,n.firstChild),I){var o=Y[K-1-a].cloneNode(!0);Ki(o,"id"),e.appendChild(o)}}G.insertBefore(e,G.firstChild),G.appendChild(n),Y=G.children}}(),function(){if(!I)for(var t=qt,e=qt+Math.min(K,ft);t<e;t++){var n=Y[t];n.style.left=100*(t-qt)/ft+"%",Vi(n,P),Gi(n,W)}q&&(g||rt?(Wi(Bt,"#"+Zt+" > .tns-item","font-size:"+h.getComputedStyle(Y[0]).fontSize+";",Fi(Bt)),Wi(Bt,"#"+Zt,"font-size:0;",Fi(Bt))):I&&qi(Y,function(t,e){var n;t.style.marginLeft=(n=e,y?y+"("+100*n+"% / "+Ht+")":100*n/Ht+"%")}));if(H){if(x){var i=S&&O.autoHeight?xn(O.speed):"";Wi(Bt,"#"+Zt+"-mw",i,Fi(Bt))}i=pn(O.edgePadding,O.gutter,O.fixedWidth,O.speed,O.autoHeight),Wi(Bt,"#"+Zt+"-iw",i,Fi(Bt)),I&&(i=q&&!rt?"width:"+mn(O.fixedWidth,O.gutter,O.items)+";":"",x&&(i+=xn(mt)),Wi(Bt,"#"+Zt,i,Fi(Bt))),i=q&&!rt?hn(O.fixedWidth,O.gutter,O.items):"",O.gutter&&(i+=yn(O.gutter)),I||(x&&(i+=xn(mt)),b&&(i+=bn(mt))),i&&Wi(Bt,"#"+Zt+" > .tns-item",i,Fi(Bt))}else{Gn(),V.style.cssText=pn(ut,lt,ot,gt),I&&q&&!rt&&(G.style.width=mn(ot,lt,ft));var i=q&&!rt?hn(ot,lt,ft):"";lt&&(i+=yn(lt)),i&&Wi(Bt,"#"+Zt+" > .tns-item",i,Fi(Bt))}if(k&&H)for(var a in k){a=parseInt(a);var r=k[a],i="",o="",u="",l="",s="",c=rt?null:vn("items",a),f=vn("fixedWidth",a),d=vn("speed",a),v=vn("edgePadding",a),p=vn("autoHeight",a),m=vn("gutter",a);x&&S&&vn("autoHeight",a)&&"speed"in r&&(o="#"+Zt+"-mw{"+xn(d)+"}"),("edgePadding"in r||"gutter"in r)&&(u="#"+Zt+"-iw{"+pn(v,m,f,d,p)+"}"),I&&q&&!rt&&("fixedWidth"in r||"items"in r||ot&&"gutter"in r)&&(l="width:"+mn(f,m,c)+";"),x&&"speed"in r&&(l+=xn(d)),l&&(l="#"+Zt+"{"+l+"}"),("fixedWidth"in r||ot&&"gutter"in r||!I&&"items"in r)&&(s+=hn(f,m,c)),"gutter"in r&&(s+=yn(m)),!I&&"speed"in r&&(x&&(s+=xn(d)),b&&(s+=bn(d))),s&&(s="#"+Zt+" > .tns-item{"+s+"}"),(i=o+u+l+s)&&Bt.insertRule("@media (min-width: "+a/16+"em) {"+i+"}",Bt.cssRules.length)}}(),Cn();var en=yt?I?function(){var t=Vt,e=Gt;t+=dt,e-=dt,ut?(t+=1,e-=1):ot&&(st+lt)%(ot+lt)&&(e-=1),Dt&&(e<qt?qt-=K:qt<t&&(qt+=K))}:function(){if(Gt<qt)for(;Vt+K<=qt;)qt-=K;else if(qt<Vt)for(;qt<=Gt-K;)qt+=K}:function(){qt=Math.max(Vt,Math.min(Gt,qt))},nn=I?function(){var e,n,i,a,t,r,o,u,l,s,c;ti(G,""),x||!mt?(ri(),mt&&Zi(G)||si()):(e=G,n=Pt,i=zt,a=Wt,t=ii(),r=mt,o=si,u=Math.min(r,10),l=0<=t.indexOf("%")?"%":"px",t=t.replace(l,""),s=Number(e.style[n].replace(i,"").replace(a,"").replace(l,"")),c=(t-s)/r*u,setTimeout(function t(){r-=u,s+=c,e.style[n]=i+s+l+a,0<r?setTimeout(t,u):o()},u)),q||Ni()}:function(){Ot=[];var t={};t[C]=t[w]=si,na(Y[jt],t),ea(Y[qt],t),oi(jt,P,z,!0),oi(qt,W,P),C&&w&&mt&&Zi(G)||si()};return{version:"2.9.2",getInfo:Si,events:Ut,goTo:ci,play:function(){Tt&&!qe&&(mi(),Ve=!1)},pause:function(){qe&&(hi(),Ve=!0)},isOn:U,updateSliderHeight:Xn,refresh:Cn,destroy:function(){if(Bt.disabled=!0,Bt.ownerNode&&Bt.ownerNode.remove(),na(h,{resize:An}),pt&&na(D,le),Me&&na(Me,ae),Se&&na(Se,re),na(G,oe),na(G,ue),Xe&&na(Xe,{click:yi}),Tt&&clearInterval(Fe),I&&C){var t={};t[C]=si,na(G,t)}wt&&na(G,se),Mt&&na(G,ce);var r=[X,Te,Ne,Le,Oe,Ye];for(var e in T.forEach(function(t,e){var n="container"===t?j:O[t];if("object"==typeof n){var i=!!n.previousElementSibling&&n.previousElementSibling,a=n.parentNode;n.outerHTML=r[e],O[t]=i?i.nextElementSibling:a.firstElementChild}}),T=P=z=B=W=q=j=V=G=Q=X=Y=K=F=J=rt=ot=ut=lt=st=ft=dt=vt=pt=mt=ht=yt=gt=Bt=St=_=Ot=Dt=Ht=kt=Rt=It=Pt=zt=Wt=Ft=qt=jt=Vt=Gt=Xt=Yt=Kt=Jt=Ut=_t=Zt=$t=te=ee=ne=ie=ae=re=oe=ue=le=se=ce=fe=de=ve=pe=me=he=ye=ge=xe=Z=xt=bt=Me=Te=Ee=Ae=Ce=we=Ct=Se=Oe=Be=De=He=ke=Re=Ie=Pe=ze=We=Tt=Et=Qe=At=Nt=Xe=Ye=Lt=Ke=Fe=qe=je=Ve=Ge=_e=Ze=Je=$e=Ue=tn=wt=Mt=null,this)"rebuild"!==e&&(this[e]=null);U=!1},rebuild:function(){return aa(Hi(O,E))}}}function an(t){t&&(xt=Ct=wt=Mt=pt=Tt=Nt=Lt=!1)}function rn(){for(var t=I?qt-Dt:qt;t<0;)t+=K;return t%K+1}function on(t){return t=t?Math.max(0,Math.min(yt?K-1:K-ft,t)):0,I?t+Dt:t}function un(t){for(null==t&&(t=qt),I&&(t-=Dt);t<0;)t+=K;return Math.floor(t%K)}function ln(){var t,e=un();return t=ve?e:ot||rt?Math.ceil((e+1)*De/K-1):Math.floor(e/ft),!yt&&I&&qt===Gt&&(t=De-1),t}function sn(){return h.innerWidth||D.documentElement.clientWidth||D.body.clientWidth}function cn(t){return"top"===t?"afterbegin":"beforeend"}function fn(){var t=ut?2*ut-lt:0;return function t(e){var n,i,a=D.createElement("div");return e.appendChild(a),i=(n=a.getBoundingClientRect()).right-n.left,a.remove(),i||t(e.parentNode)}(Q)-t}function dn(t){if(O[t])return!0;if(k)for(var e in k)if(k[e][t])return!0;return!1}function vn(t,e){if(null==e&&(e=J),"items"===t&&ot)return Math.floor((st+lt)/(ot+lt))||1;var n=O[t];if(k)for(var i in k)e>=parseInt(i)&&t in k[i]&&(n=k[i][t]);return"slideBy"===t&&"page"===n&&(n=vn("items")),I||"slideBy"!==t&&"items"!==t||(n=Math.floor(n)),n}function pn(t,e,n,i,a){var r="";if(void 0!==t){var o=t;e&&(o-=e),r=q?"margin: 0 "+o+"px 0 "+t+"px;":"margin: "+t+"px 0 "+o+"px 0;"}else if(e&&!n){var u="-"+e+"px";r="margin: 0 "+(q?u+" 0 0":"0 "+u+" 0")+";"}return!I&&a&&x&&i&&(r+=xn(i)),r}function mn(t,e,n){return t?(t+e)*Ht+"px":y?y+"("+100*Ht+"% / "+n+")":100*Ht/n+"%"}function hn(t,e,n){var i;if(t)i=t+e+"px";else{I||(n=Math.floor(n));var a=I?Ht:n;i=y?y+"(100% / "+a+")":100/a+"%"}return i="width:"+i,"inner"!==R?i+";":i+" !important;"}function yn(t){var e="";!1!==t&&(e=(q?"padding-":"margin-")+(q?"right":"bottom")+": "+t+"px;");return e}function gn(t,e){var n=t.substring(0,t.length-e).toLowerCase();return n&&(n="-"+n+"-"),n}function xn(t){return gn(x,18)+"transition-duration:"+t/1e3+"s;"}function bn(t){return gn(b,17)+"animation-duration:"+t/1e3+"s;"}function Cn(){if(dn("autoHeight")||rt||!q){var t=G.querySelectorAll("img");qi(t,function(t){var e=t.src;e&&e.indexOf("data:image")<0?(ea(t,xe),t.src="",t.src=e,Vi(t,"loading")):St||zn(t)}),Oi(function(){jn(Ji(t),function(){Z=!0})}),!rt&&q&&(t=Fn(qt,Math.min(qt+ft-1,Ht-1))),St?wn():Oi(function(){jn(Ji(t),wn)})}else I&&ai(),Tn(),En()}function wn(){if(rt){var e=yt?qt:K-1;!function t(){Y[e-1].getBoundingClientRect().right.toFixed(2)===Y[e].getBoundingClientRect().left.toFixed(2)?Mn():setTimeout(function(){t()},16)}()}else Mn()}function Mn(){q&&!rt||(Yn(),rt?(Rt=ni(),ee&&(ne=Ln()),Gt=Ft(),an($t||ne)):Ni()),I&&ai(),Tn(),En()}function Tn(){if(Kn(),j.insertAdjacentHTML("afterbegin",'<div class="tns-liveregion tns-visually-hidden" aria-live="polite" aria-atomic="true">slide <span class="current">'+Rn()+"</span>  of "+K+"</div>"),$=j.querySelector(".tns-liveregion .current"),pe){var t=Tt?"stop":"start";Xe?Yi(Xe,{"data-action":t}):O.autoplayButtonOutput&&(j.insertAdjacentHTML(cn(O.autoplayPosition),'<button data-action="'+t+'">'+Ke[0]+t+Ke[1]+At[0]+"</button>"),Xe=j.querySelector("[data-action]")),Xe&&ea(Xe,{click:yi}),Tt&&(mi(),Nt&&ea(G,oe),Lt&&ea(G,ue))}if(de){if(Se)Yi(Se,{"aria-label":"Carousel Pagination"}),qi(Be=Se.children,function(t,e){Yi(t,{"data-nav":e,tabindex:"-1","aria-label":ze+(e+1),"aria-controls":Zt})});else{for(var e="",n=ve?"":'style="display:none"',i=0;i<K;i++)e+='<button data-nav="'+i+'" tabindex="-1" aria-controls="'+Zt+'" '+n+' aria-label="'+ze+(i+1)+'"></button>';e='<div class="tns-nav" aria-label="Carousel Pagination">'+e+"</div>",j.insertAdjacentHTML(cn(O.navPosition),e),Se=j.querySelector(".tns-nav"),Be=Se.children}if(Bi(),x){var a=x.substring(0,x.length-18).toLowerCase(),r="transition: all "+mt/1e3+"s";a&&(r="-"+a+"-"+r),Wi(Bt,"[aria-controls^="+Zt+"-item]",r,Fi(Bt))}Yi(Be[Re],{"aria-label":ze+(Re+1)+We}),Ki(Be[Re],"tabindex"),Vi(Be[Re],Pe),ea(Se,re)}fe&&(Me||Ee&&Ae||(j.insertAdjacentHTML(cn(O.controlsPosition),'<div class="tns-controls" aria-label="Carousel Navigation" tabindex="0"><button data-controls="prev" tabindex="-1" aria-controls="'+Zt+'">'+bt[0]+'</button><button data-controls="next" tabindex="-1" aria-controls="'+Zt+'">'+bt[1]+"</button></div>"),Me=j.querySelector(".tns-controls")),Ee&&Ae||(Ee=Me.children[0],Ae=Me.children[1]),O.controlsContainer&&Yi(Me,{"aria-label":"Carousel Navigation",tabindex:"0"}),(O.controlsContainer||O.prevButton&&O.nextButton)&&Yi([Ee,Ae],{"aria-controls":Zt,tabindex:"-1"}),(O.controlsContainer||O.prevButton&&O.nextButton)&&(Yi(Ee,{"data-controls":"prev"}),Yi(Ae,{"data-controls":"next"})),Ce=Un(Ee),we=Un(Ae),$n(),Me?ea(Me,ae):(ea(Ee,ae),ea(Ae,ae))),Sn()}function En(){if(I&&C){var t={};t[C]=si,ea(G,t)}wt&&ea(G,se,O.preventScrollOnTouch),Mt&&ea(G,ce),pt&&ea(D,le),"inner"===R?Ut.on("outerResized",function(){Nn(),Ut.emit("innerLoaded",Si())}):(k||ot||rt||gt||!q)&&ea(h,{resize:An}),gt&&("outer"===R?Ut.on("innerLoaded",qn):$t||qn()),Pn(),$t?Hn():ne&&Dn(),Ut.on("indexChanged",Vn),"inner"===R&&Ut.emit("innerLoaded",Si()),"function"==typeof Jt&&Jt(Si()),U=!0}function An(t){Oi(function(){Nn(xi(t))})}function Nn(t){if(U){"outer"===R&&Ut.emit("outerResized",Si(t)),J=sn();var e,n=F,i=!1;k&&(Bn(),(e=n!==F)&&Ut.emit("newBreakpointStart",Si(t)));var a,r,o,u,l=ft,s=$t,c=ne,f=pt,d=xt,v=Ct,p=wt,m=Mt,h=Tt,y=Nt,g=Lt,x=qt;if(e){var b=ot,C=gt,w=bt,M=ct,T=At;if(!H)var E=lt,A=ut}if(pt=vn("arrowKeys"),xt=vn("controls"),Ct=vn("nav"),wt=vn("touch"),ct=vn("center"),Mt=vn("mouseDrag"),Tt=vn("autoplay"),Nt=vn("autoplayHoverPause"),Lt=vn("autoplayResetOnVisibility"),e&&($t=vn("disable"),ot=vn("fixedWidth"),mt=vn("speed"),gt=vn("autoHeight"),bt=vn("controlsText"),At=vn("autoplayText"),Et=vn("autoplayTimeout"),H||(ut=vn("edgePadding"),lt=vn("gutter"))),an($t),st=fn(),q&&!rt||$t||(Yn(),q||(Ni(),i=!0)),(ot||rt)&&(Rt=ni(),Gt=Ft()),(e||ot)&&(ft=vn("items"),dt=vn("slideBy"),(r=ft!==l)&&(ot||rt||(Gt=Ft()),en())),e&&$t!==s&&($t?Hn():function(){if(!te)return;if(Bt.disabled=!1,G.className+=_t,ai(),yt)for(var t=Dt;t--;)I&&_i(Y[t]),_i(Y[Ht-t-1]);if(!I)for(var e=qt,n=qt+K;e<n;e++){var i=Y[e],a=e<qt+ft?P:W;i.style.left=100*(e-qt)/ft+"%",Vi(i,a)}On(),te=!1}()),ee&&(e||ot||rt)&&(ne=Ln())!==c&&(ne?(ri(ii(on(0))),Dn()):(!function(){if(!ie)return;ut&&H&&(V.style.margin="");if(Dt)for(var t="tns-transparent",e=Dt;e--;)I&&Gi(Y[e],t),Gi(Y[Ht-e-1],t);On(),ie=!1}(),i=!0)),an($t||ne),Tt||(Nt=Lt=!1),pt!==f&&(pt?ea(D,le):na(D,le)),xt!==d&&(xt?Me?_i(Me):(Ee&&_i(Ee),Ae&&_i(Ae)):Me?Ui(Me):(Ee&&Ui(Ee),Ae&&Ui(Ae))),Ct!==v&&(Ct?_i(Se):Ui(Se)),wt!==p&&(wt?ea(G,se,O.preventScrollOnTouch):na(G,se)),Mt!==m&&(Mt?ea(G,ce):na(G,ce)),Tt!==h&&(Tt?(Xe&&_i(Xe),qe||Ve||mi()):(Xe&&Ui(Xe),qe&&hi())),Nt!==y&&(Nt?ea(G,oe):na(G,oe)),Lt!==g&&(Lt?ea(D,ue):na(D,ue)),e){if(ot===b&&ct===M||(i=!0),gt!==C&&(gt||(V.style.height="")),xt&&bt!==w&&(Ee.innerHTML=bt[0],Ae.innerHTML=bt[1]),Xe&&At!==T){var N=Tt?1:0,L=Xe.innerHTML,B=L.length-T[N].length;L.substring(B)===T[N]&&(Xe.innerHTML=L.substring(0,B)+At[N])}}else ct&&(ot||rt)&&(i=!0);if((r||ot&&!rt)&&(De=Li(),Bi()),(a=qt!==x)?(Ut.emit("indexChanged",Si()),i=!0):r?a||Vn():(ot||rt)&&(Pn(),Kn(),kn()),r&&!I&&function(){for(var t=qt+Math.min(K,ft),e=Ht;e--;){var n=Y[e];qt<=e&&e<t?(Vi(n,"tns-moving"),n.style.left=100*(e-qt)/ft+"%",Vi(n,P),Gi(n,W)):n.style.left&&(n.style.left="",Vi(n,W),Gi(n,P)),Gi(n,z)}setTimeout(function(){qi(Y,function(t){Gi(t,"tns-moving")})},300)}(),!$t&&!ne){if(e&&!H&&(gt===autoheightTem&&mt===speedTem||Gn(),ut===A&&lt===E||(V.style.cssText=pn(ut,lt,ot,mt,gt)),q)){I&&(G.style.width=mn(ot,lt,ft));var S=hn(ot,lt,ft)+yn(lt);u=Fi(o=Bt)-1,"deleteRule"in o?o.deleteRule(u):o.removeRule(u),Wi(Bt,"#"+Zt+" > .tns-item",S,Fi(Bt))}gt&&qn(),i&&(ai(),jt=qt)}e&&Ut.emit("newBreakpointEnd",Si(t))}}function Ln(){if(!ot&&!rt)return K<=(ct?ft-(ft-1)/2:ft);var t=ot?(ot+lt)*K:_[K],e=ut?st+2*ut:st+lt;return ct&&(e-=ot?(st-ot)/2:(st-(_[qt+1]-_[qt]-lt))/2),t<=e}function Bn(){for(var t in F=0,k)(t=parseInt(t))<=J&&(F=t)}function Sn(){!Tt&&Xe&&Ui(Xe),!Ct&&Se&&Ui(Se),xt||(Me?Ui(Me):(Ee&&Ui(Ee),Ae&&Ui(Ae)))}function On(){Tt&&Xe&&_i(Xe),Ct&&Se&&_i(Se),xt&&(Me?_i(Me):(Ee&&_i(Ee),Ae&&_i(Ae)))}function Dn(){if(!ie){if(ut&&(V.style.margin="0px"),Dt)for(var t="tns-transparent",e=Dt;e--;)I&&Vi(Y[e],t),Vi(Y[Ht-e-1],t);Sn(),ie=!0}}function Hn(){if(!te){if(Bt.disabled=!0,G.className=G.className.replace(_t.substring(1),""),Ki(G,["style"]),yt)for(var t=Dt;t--;)I&&Ui(Y[t]),Ui(Y[Ht-t-1]);if(q&&I||Ki(V,["style"]),!I)for(var e=qt,n=qt+K;e<n;e++){var i=Y[e];Ki(i,["style"]),Gi(i,P),Gi(i,W)}Sn(),te=!0}}function kn(){var t=Rn();$.innerHTML!==t&&($.innerHTML=t)}function Rn(){var t=In(),e=t[0]+1,n=t[1]+1;return e===n?e+"":e+" to "+n}function In(t){null==t&&(t=ii());var n,i,a,r=qt;if(ct||ut?(rt||ot)&&(i=-(parseFloat(t)+ut),a=i+st+2*ut):rt&&(i=_[qt],a=i+st),rt)_.forEach(function(t,e){e<Ht&&((ct||ut)&&t<=i+.5&&(r=e),.5<=a-t&&(n=e))});else{if(ot){var e=ot+lt;ct||ut?(r=Math.floor(i/e),n=Math.ceil(a/e-1)):n=r+Math.ceil(st/e)-1}else if(ct||ut){var o=ft-1;if(ct?(r-=o/2,n=qt+o/2):n=qt+o,ut){var u=ut*ft/st;r-=u,n+=u}r=Math.floor(r),n=Math.ceil(n)}else n=r+ft-1;r=Math.max(r,0),n=Math.min(n,Ht-1)}return[r,n]}function Pn(){St&&!$t&&Fn.apply(null,In()).forEach(function(t){if(!ji(t,ge)){var e={};e[C]=function(t){t.stopPropagation()},ea(t,e),ea(t,xe),t.src=Xi(t,"data-src");var n=Xi(t,"data-srcset");n&&(t.srcset=n),Vi(t,"loading")}})}function zn(t){Vi(t,"loaded"),Wn(t)}function Wn(t){Vi(t,"tns-complete"),Gi(t,"loading"),na(t,xe)}function Fn(t,e){for(var n=[];t<=e;)qi(Y[t].querySelectorAll("img"),function(t){n.push(t)}),t++;return n}function qn(){var t=Fn.apply(null,In());Oi(function(){jn(t,Xn)})}function jn(n,t){return Z?t():(n.forEach(function(t,e){ji(t,ge)&&n.splice(e,1)}),n.length?void Oi(function(){jn(n,t)}):t())}function Vn(){Pn(),Kn(),kn(),$n(),function(){if(Ct&&(Re=0<=ke?ke:ln(),ke=-1,Re!==Ie)){var t=Be[Ie],e=Be[Re];Yi(t,{tabindex:"-1","aria-label":ze+(Ie+1)}),Gi(t,Pe),Yi(e,{"aria-label":ze+(Re+1)+We}),Ki(e,"tabindex"),Vi(e,Pe),Ie=Re}}()}function Gn(){I&&gt&&(S.style[x]=mt/1e3+"s")}function Qn(t,e){for(var n=[],i=t,a=Math.min(t+e,Ht);i<a;i++)n.push(Y[i].offsetHeight);return Math.max.apply(null,n)}function Xn(){var t=gt?Qn(qt,ft):Qn(Dt,K),e=S||V;e.style.height!==t&&(e.style.height=t+"px")}function Yn(){_=[0];var n=q?"left":"top",i=q?"right":"bottom",a=Y[0].getBoundingClientRect()[n];qi(Y,function(t,e){e&&_.push(t.getBoundingClientRect()[n]-a),e===Ht-1&&_.push(t.getBoundingClientRect()[i]-a)})}function Kn(){var t=In(),n=t[0],i=t[1];qi(Y,function(t,e){n<=e&&e<=i?Qi(t,"aria-hidden")&&(Ki(t,["aria-hidden","tabindex"]),Vi(t,ye)):Qi(t,"aria-hidden")||(Yi(t,{"aria-hidden":"true",tabindex:"-1"}),Gi(t,ye))})}function Jn(t){return t.nodeName.toLowerCase()}function Un(t){return"button"===Jn(t)}function _n(t){return"true"===t.getAttribute("aria-disabled")}function Zn(t,e,n){t?e.disabled=n:e.setAttribute("aria-disabled",n.toString())}function $n(){if(xt&&!ht&&!yt){var t=Ce?Ee.disabled:_n(Ee),e=we?Ae.disabled:_n(Ae),n=qt<=Vt,i=!ht&&Gt<=qt;n&&!t&&Zn(Ce,Ee,!0),!n&&t&&Zn(Ce,Ee,!1),i&&!e&&Zn(we,Ae,!0),!i&&e&&Zn(we,Ae,!1)}}function ti(t,e){x&&(t.style[x]=e)}function ei(t){return null==t&&(t=qt),rt?(st-(ut?lt:0)-(_[t+1]-_[t]-lt))/2:ot?(st-ot)/2:(ft-1)/2}function ni(){var t=st+(ut?lt:0)-(ot?(ot+lt)*Ht:_[Ht]);return ct&&!yt&&(t=ot?-(ot+lt)*(Ht-1)-ei():ei(Ht-1)-_[Ht-1]),0<t&&(t=0),t}function ii(t){var e;if(null==t&&(t=qt),q&&!rt)if(ot)e=-(ot+lt)*t,ct&&(e+=ei());else{var n=d?Ht:ft;ct&&(t-=ei()),e=100*-t/n}else e=-_[t],ct&&rt&&(e+=ei());return kt&&(e=Math.max(e,Rt)),e+=!q||rt||ot?"px":"%"}function ai(t){ti(G,"0s"),ri(t)}function ri(t){null==t&&(t=ii()),G.style[Pt]=zt+t+Wt}function oi(t,e,n,i){var a=t+ft;yt||(a=Math.min(a,Ht));for(var r=t;r<a;r++){var o=Y[r];i||(o.style.left=100*(r-qt)/ft+"%"),B&&p&&(o.style[p]=o.style[m]=B*(r-t)/1e3+"s"),Gi(o,e),Vi(o,n),i&&Ot.push(o)}}function ui(t,e){It&&en(),(qt!==jt||e)&&(Ut.emit("indexChanged",Si()),Ut.emit("transitionStart",Si()),gt&&qn(),qe&&t&&0<=["click","keydown"].indexOf(t.type)&&hi(),Kt=!0,nn())}function li(t){return t.toLowerCase().replace(/-/g,"")}function si(t){if(I||Kt){if(Ut.emit("transitionEnd",Si(t)),!I&&0<Ot.length)for(var e=0;e<Ot.length;e++){var n=Ot[e];n.style.left="",m&&p&&(n.style[m]="",n.style[p]=""),Gi(n,z),Vi(n,W)}if(!t||!I&&t.target.parentNode===G||t.target===G&&li(t.propertyName)===li(Pt)){if(!It){var i=qt;en(),qt!==i&&(Ut.emit("indexChanged",Si()),ai())}"inner"===R&&Ut.emit("innerLoaded",Si()),Kt=!1,jt=qt}}}function ci(t,e){if(!ne)if("prev"===t)fi(e,-1);else if("next"===t)fi(e,1);else{if(Kt){if(Qt)return;si()}var n=un(),i=0;if("first"===t?i=-n:"last"===t?i=I?K-ft-n:K-1-n:("number"!=typeof t&&(t=parseInt(t)),isNaN(t)||(e||(t=Math.max(0,Math.min(K-1,t))),i=t-n)),!I&&i&&Math.abs(i)<ft){var a=0<i?1:-1;i+=Vt<=qt+i-K?K*a:2*K*a*-1}qt+=i,I&&yt&&(qt<Vt&&(qt+=K),Gt<qt&&(qt-=K)),un(qt)!==un(jt)&&ui(e)}}function fi(t,e){if(Kt){if(Qt)return;si()}var n;if(!e){for(var i=bi(t=xi(t));i!==Me&&[Ee,Ae].indexOf(i)<0;)i=i.parentNode;var a=[Ee,Ae].indexOf(i);0<=a&&(n=!0,e=0===a?-1:1)}if(ht){if(qt===Vt&&-1===e)return void ci("last",t);if(qt===Gt&&1===e)return void ci("first",t)}e&&(qt+=dt*e,rt&&(qt=Math.floor(qt)),ui(n||t&&"keydown"===t.type?t:null))}function di(){Fe=setInterval(function(){fi(null,Qe)},Et),qe=!0}function vi(){clearInterval(Fe),qe=!1}function pi(t,e){Yi(Xe,{"data-action":t}),Xe.innerHTML=Ke[0]+t+Ke[1]+e}function mi(){di(),Xe&&pi("stop",At[1])}function hi(){vi(),Xe&&pi("start",At[0])}function yi(){qe?(hi(),Ve=!0):(mi(),Ve=!1)}function gi(t){t.focus()}function xi(t){return Ci(t=t||h.event)?t.changedTouches[0]:t}function bi(t){return t.target||h.event.srcElement}function Ci(t){return 0<=t.type.indexOf("touch")}function wi(t){t.preventDefault?t.preventDefault():t.returnValue=!1}function Mi(){return a=Ze.y-_e.y,r=Ze.x-_e.x,t=Math.atan2(a,r)*(180/Math.PI),e=Xt,n=!1,i=Math.abs(90-Math.abs(t)),90-e<=i?n="horizontal":i<=e&&(n="vertical"),n===O.axis;var t,e,n,i,a,r}function Ti(t){if(Kt){if(Qt)return;si()}Tt&&qe&&vi(),$e=!0,Ue&&(Di(Ue),Ue=null);var e=xi(t);Ut.emit(Ci(t)?"touchStart":"dragStart",Si(t)),!Ci(t)&&0<=["img","a"].indexOf(Jn(bi(t)))&&wi(t),Ze.x=_e.x=e.clientX,Ze.y=_e.y=e.clientY,I&&(Je=parseFloat(G.style[Pt].replace(zt,"")),ti(G,"0s"))}function Ei(t){if($e){var e=xi(t);Ze.x=e.clientX,Ze.y=e.clientY,I?Ue||(Ue=Oi(function(){!function t(e){if(!Yt)return void($e=!1);Di(Ue);$e&&(Ue=Oi(function(){t(e)}));"?"===Yt&&(Yt=Mi());if(Yt){!be&&Ci(e)&&(be=!0);try{e.type&&Ut.emit(Ci(e)?"touchMove":"dragMove",Si(e))}catch(t){}var n=Je,i=tn(Ze,_e);if(!q||ot||rt)n+=i,n+="px";else{var a=d?i*ft*100/((st+lt)*Ht):100*i/(st+lt);n+=a,n+="%"}G.style[Pt]=zt+n+Wt}}(t)})):("?"===Yt&&(Yt=Mi()),Yt&&(be=!0)),be&&t.preventDefault()}}function Ai(i){if($e){Ue&&(Di(Ue),Ue=null),I&&ti(G,""),$e=!1;var t=xi(i);Ze.x=t.clientX,Ze.y=t.clientY;var a=tn(Ze,_e);if(Math.abs(a)){if(!Ci(i)){var n=bi(i);ea(n,{click:function t(e){wi(e),na(n,{click:t})}})}I?Ue=Oi(function(){if(q&&!rt){var t=-a*ft/(st+lt);t=0<a?Math.floor(t):Math.ceil(t),qt+=t}else{var e=-(Je+a);if(e<=0)qt=Vt;else if(e>=_[Ht-1])qt=Gt;else for(var n=0;n<Ht&&e>=_[n];)e>_[qt=n]&&a<0&&(qt+=1),n++}ui(i,a),Ut.emit(Ci(i)?"touchEnd":"dragEnd",Si(i))}):Yt&&fi(i,0<a?-1:1)}}"auto"===O.preventScrollOnTouch&&(be=!1),Xt&&(Yt="?"),Tt&&!qe&&di()}function Ni(){(S||V).style.height=_[qt+ft]-_[qt]+"px"}function Li(){var t=ot?(ot+lt)*K/st:K/ft;return Math.min(Math.ceil(t),K)}function Bi(){if(Ct&&!ve&&De!==He){var t=He,e=De,n=_i;for(De<He&&(t=De,e=He,n=Ui);t<e;)n(Be[t]),t++;He=De}}function Si(t){return{container:G,slideItems:Y,navContainer:Se,navItems:Be,controlsContainer:Me,hasControls:fe,prevButton:Ee,nextButton:Ae,items:ft,slideBy:dt,cloneCount:Dt,slideCount:K,slideCountNew:Ht,index:qt,indexCached:jt,displayIndex:rn(),navCurrentIndex:Re,navCurrentIndexCached:Ie,pages:De,pagesCached:He,sheet:Bt,isOn:U,event:t||{}}}M&&console.warn("No slides found in",O.container)};return aa}();
//# sourceMappingURL=../sourcemaps/tiny-slider.js.map

/*! smooth-scroll v16.1.3 | (c) 2020 Chris Ferdinandi | MIT License | http://github.com/cferdinandi/smooth-scroll */
window.Element&&!Element.prototype.closest&&(Element.prototype.closest=function(e){var t,n=(this.document||this.ownerDocument).querySelectorAll(e),o=this;do{for(t=n.length;0<=--t&&n.item(t)!==o;);}while(t<0&&(o=o.parentElement));return o}),(function(){if("function"==typeof window.CustomEvent)return;function e(e,t){t=t||{bubbles:!1,cancelable:!1,detail:void 0};var n=document.createEvent("CustomEvent");return n.initCustomEvent(e,t.bubbles,t.cancelable,t.detail),n}e.prototype=window.Event.prototype,window.CustomEvent=e})(),(function(){for(var r=0,e=["ms","moz","webkit","o"],t=0;t<e.length&&!window.requestAnimationFrame;++t)window.requestAnimationFrame=window[e[t]+"RequestAnimationFrame"],window.cancelAnimationFrame=window[e[t]+"CancelAnimationFrame"]||window[e[t]+"CancelRequestAnimationFrame"];window.requestAnimationFrame||(window.requestAnimationFrame=function(e,t){var n=(new Date).getTime(),o=Math.max(0,16-(n-r)),a=window.setTimeout((function(){e(n+o)}),o);return r=n+o,a}),window.cancelAnimationFrame||(window.cancelAnimationFrame=function(e){clearTimeout(e)})})(),(function(e,t){"function"==typeof define&&define.amd?define([],(function(){return t(e)})):"object"==typeof exports?module.exports=t(e):e.SmoothScroll=t(e)})("undefined"!=typeof global?global:"undefined"!=typeof window?window:this,(function(M){"use strict";var q={ignore:"[data-scroll-ignore]",header:null,topOnEmptyHash:!0,speed:500,speedAsDuration:!1,durationMax:null,durationMin:null,clip:!0,offset:0,easing:"easeInOutCubic",customEasing:null,updateURL:!0,popstate:!0,emitEvents:!0},I=function(){var n={};return Array.prototype.forEach.call(arguments,(function(e){for(var t in e){if(!e.hasOwnProperty(t))return;n[t]=e[t]}})),n},r=function(e){"#"===e.charAt(0)&&(e=e.substr(1));for(var t,n=String(e),o=n.length,a=-1,r="",i=n.charCodeAt(0);++a<o;){if(0===(t=n.charCodeAt(a)))throw new InvalidCharacterError("Invalid character: the input contains U+0000.");1<=t&&t<=31||127==t||0===a&&48<=t&&t<=57||1===a&&48<=t&&t<=57&&45===i?r+="\\"+t.toString(16)+" ":r+=128<=t||45===t||95===t||48<=t&&t<=57||65<=t&&t<=90||97<=t&&t<=122?n.charAt(a):"\\"+n.charAt(a)}return"#"+r},F=function(){return Math.max(document.body.scrollHeight,document.documentElement.scrollHeight,document.body.offsetHeight,document.documentElement.offsetHeight,document.body.clientHeight,document.documentElement.clientHeight)},L=function(e){return e?(t=e,parseInt(M.getComputedStyle(t).height,10)+e.offsetTop):0;var t},x=function(e,t,n){0===e&&document.body.focus(),n||(e.focus(),document.activeElement!==e&&(e.setAttribute("tabindex","-1"),e.focus(),e.style.outline="none"),M.scrollTo(0,t))},H=function(e,t,n,o){if(t.emitEvents&&"function"==typeof M.CustomEvent){var a=new CustomEvent(e,{bubbles:!0,detail:{anchor:n,toggle:o}});document.dispatchEvent(a)}};return function(o,e){var b,a,A,O,C={};C.cancelScroll=function(e){cancelAnimationFrame(O),O=null,e||H("scrollCancel",b)},C.animateScroll=function(a,r,e){C.cancelScroll();var i=I(b||q,e||{}),c="[object Number]"===Object.prototype.toString.call(a),t=c||!a.tagName?null:a;if(c||t){var s=M.pageYOffset;i.header&&!A&&(A=document.querySelector(i.header));var n,o,u,l,m,d,f,h,p=L(A),g=c?a:(function(e,t,n,o){var a=0;if(e.offsetParent)for(;a+=e.offsetTop,e=e.offsetParent;);return a=Math.max(a-t-n,0),o&&(a=Math.min(a,F()-M.innerHeight)),a})(t,p,parseInt("function"==typeof i.offset?i.offset(a,r):i.offset,10),i.clip),y=g-s,v=F(),w=0,S=(n=y,u=(o=i).speedAsDuration?o.speed:Math.abs(n/1e3*o.speed),o.durationMax&&u>o.durationMax?o.durationMax:o.durationMin&&u<o.durationMin?o.durationMin:parseInt(u,10)),E=function(e){var t,n,o;l||(l=e),w+=e-l,d=s+y*(n=m=1<(m=0===S?0:w/S)?1:m,"easeInQuad"===(t=i).easing&&(o=n*n),"easeOutQuad"===t.easing&&(o=n*(2-n)),"easeInOutQuad"===t.easing&&(o=n<.5?2*n*n:(4-2*n)*n-1),"easeInCubic"===t.easing&&(o=n*n*n),"easeOutCubic"===t.easing&&(o=--n*n*n+1),"easeInOutCubic"===t.easing&&(o=n<.5?4*n*n*n:(n-1)*(2*n-2)*(2*n-2)+1),"easeInQuart"===t.easing&&(o=n*n*n*n),"easeOutQuart"===t.easing&&(o=1- --n*n*n*n),"easeInOutQuart"===t.easing&&(o=n<.5?8*n*n*n*n:1-8*--n*n*n*n),"easeInQuint"===t.easing&&(o=n*n*n*n*n),"easeOutQuint"===t.easing&&(o=1+--n*n*n*n*n),"easeInOutQuint"===t.easing&&(o=n<.5?16*n*n*n*n*n:1+16*--n*n*n*n*n),t.customEasing&&(o=t.customEasing(n)),o||n),M.scrollTo(0,Math.floor(d)),(function(e,t){var n=M.pageYOffset;if(e==t||n==t||(s<t&&M.innerHeight+n)>=v)return C.cancelScroll(!0),x(a,t,c),H("scrollStop",i,a,r),!(O=l=null)})(d,g)||(O=M.requestAnimationFrame(E),l=e)};0===M.pageYOffset&&M.scrollTo(0,0),f=a,h=i,c||history.pushState&&h.updateURL&&history.pushState({smoothScroll:JSON.stringify(h),anchor:f.id},document.title,f===document.documentElement?"#top":"#"+f.id),"matchMedia"in M&&M.matchMedia("(prefers-reduced-motion)").matches?x(a,Math.floor(g),!1):(H("scrollStart",i,a,r),C.cancelScroll(!0),M.requestAnimationFrame(E))}};var t=function(e){if(!e.defaultPrevented&&!(0!==e.button||e.metaKey||e.ctrlKey||e.shiftKey)&&"closest"in e.target&&(a=e.target.closest(o))&&"a"===a.tagName.toLowerCase()&&!e.target.closest(b.ignore)&&a.hostname===M.location.hostname&&a.pathname===M.location.pathname&&/#/.test(a.href)){var t,n;try{t=r(decodeURIComponent(a.hash))}catch(e){t=r(a.hash)}if("#"===t){if(!b.topOnEmptyHash)return;n=document.documentElement}else n=document.querySelector(t);(n=n||"#top"!==t?n:document.documentElement)&&(e.preventDefault(),(function(e){if(history.replaceState&&e.updateURL&&!history.state){var t=M.location.hash;t=t||"",history.replaceState({smoothScroll:JSON.stringify(e),anchor:t||M.pageYOffset},document.title,t||M.location.href)}})(b),C.animateScroll(n,a))}},n=function(e){if(null!==history.state&&history.state.smoothScroll&&history.state.smoothScroll===JSON.stringify(b)){var t=history.state.anchor;"string"==typeof t&&t&&!(t=document.querySelector(r(history.state.anchor)))||C.animateScroll(t,null,{updateURL:!1})}};C.destroy=function(){b&&(document.removeEventListener("click",t,!1),M.removeEventListener("popstate",n,!1),C.cancelScroll(),O=A=a=b=null)};return (function(){if(!("querySelector"in document&&"addEventListener"in M&&"requestAnimationFrame"in M&&"closest"in M.Element.prototype))throw"Smooth Scroll: This browser does not support the required JavaScript methods and browser APIs.";C.destroy(),b=I(q,e||{}),A=b.header?document.querySelector(b.header):null,document.addEventListener("click",t,!1),b.updateURL&&b.popstate&&M.addEventListener("popstate",n,!1)})(),C}}));
/*!
 * Lightbox v2.11.3
 * by Lokesh Dhakar
 *
 * More info:
 * http://lokeshdhakar.com/projects/lightbox2/
 *
 * Copyright Lokesh Dhakar
 * Released under the MIT license
 * https://github.com/lokesh/lightbox2/blob/master/LICENSE
 *
 * @preserve
 */
!function(a,b){"function"==typeof define&&define.amd?define(["jquery"],b):"object"==typeof exports?module.exports=b(require("jquery")):a.lightbox=b(a.jQuery)}(this,function(a){function b(b){this.album=[],this.currentImageIndex=void 0,this.init(),this.options=a.extend({},this.constructor.defaults),this.option(b)}return b.defaults={albumLabel:"Image %1 of %2",alwaysShowNavOnTouchDevices:!1,fadeDuration:600,fitImagesInViewport:!0,imageFadeDuration:600,positionFromTop:50,resizeDuration:700,showImageNumberLabel:!0,wrapAround:!1,disableScrolling:!1,sanitizeTitle:!1},b.prototype.option=function(b){a.extend(this.options,b)},b.prototype.imageCountLabel=function(a,b){return this.options.albumLabel.replace(/%1/g,a).replace(/%2/g,b)},b.prototype.init=function(){var b=this;a(document).ready(function(){b.enable(),b.build()})},b.prototype.enable=function(){var b=this;a("body").on("click","a[rel^=lightbox], area[rel^=lightbox], a[data-lightbox], area[data-lightbox]",function(c){return b.start(a(c.currentTarget)),!1})},b.prototype.build=function(){if(!(a("#lightbox").length>0)){var b=this;a('<div id="lightboxOverlay" tabindex="-1" class="lightboxOverlay"></div><div id="lightbox" tabindex="-1" class="lightbox"><div class="lb-outerContainer"><div class="lb-container"><img class="lb-image" src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" alt=""/><div class="lb-nav"><a class="lb-prev" aria-label="Previous image" href="" ></a><a class="lb-next" aria-label="Next image" href="" ></a></div><div class="lb-loader"><a class="lb-cancel"></a></div></div></div><div class="lb-dataContainer"><div class="lb-data"><div class="lb-details"><span class="lb-caption"></span><span class="lb-number"></span></div><div class="lb-closeContainer"><a class="lb-close"></a></div></div></div></div>').appendTo(a("body")),this.$lightbox=a("#lightbox"),this.$overlay=a("#lightboxOverlay"),this.$outerContainer=this.$lightbox.find(".lb-outerContainer"),this.$container=this.$lightbox.find(".lb-container"),this.$image=this.$lightbox.find(".lb-image"),this.$nav=this.$lightbox.find(".lb-nav"),this.containerPadding={top:parseInt(this.$container.css("padding-top"),10),right:parseInt(this.$container.css("padding-right"),10),bottom:parseInt(this.$container.css("padding-bottom"),10),left:parseInt(this.$container.css("padding-left"),10)},this.imageBorderWidth={top:parseInt(this.$image.css("border-top-width"),10),right:parseInt(this.$image.css("border-right-width"),10),bottom:parseInt(this.$image.css("border-bottom-width"),10),left:parseInt(this.$image.css("border-left-width"),10)},this.$overlay.hide().on("click",function(){return b.end(),!1}),this.$lightbox.hide().on("click",function(c){"lightbox"===a(c.target).attr("id")&&b.end()}),this.$outerContainer.on("click",function(c){return"lightbox"===a(c.target).attr("id")&&b.end(),!1}),this.$lightbox.find(".lb-prev").on("click",function(){return 0===b.currentImageIndex?b.changeImage(b.album.length-1):b.changeImage(b.currentImageIndex-1),!1}),this.$lightbox.find(".lb-next").on("click",function(){return b.currentImageIndex===b.album.length-1?b.changeImage(0):b.changeImage(b.currentImageIndex+1),!1}),this.$nav.on("mousedown",function(a){3===a.which&&(b.$nav.css("pointer-events","none"),b.$lightbox.one("contextmenu",function(){setTimeout(function(){this.$nav.css("pointer-events","auto")}.bind(b),0)}))}),this.$lightbox.find(".lb-loader, .lb-close").on("click",function(){return b.end(),!1})}},b.prototype.start=function(b){function c(a){d.album.push({alt:a.attr("data-alt"),link:a.attr("href"),title:a.attr("data-title")||a.attr("title")})}var d=this,e=a(window);e.on("resize",a.proxy(this.sizeOverlay,this)),this.sizeOverlay(),this.album=[];var f,g=0,h=b.attr("data-lightbox");if(h){f=a(b.prop("tagName")+'[data-lightbox="'+h+'"]');for(var i=0;i<f.length;i=++i)c(a(f[i])),f[i]===b[0]&&(g=i)}else if("lightbox"===b.attr("rel"))c(b);else{f=a(b.prop("tagName")+'[rel="'+b.attr("rel")+'"]');for(var j=0;j<f.length;j=++j)c(a(f[j])),f[j]===b[0]&&(g=j)}var k=e.scrollTop()+this.options.positionFromTop,l=e.scrollLeft();this.$lightbox.css({top:k+"px",left:l+"px"}).fadeIn(this.options.fadeDuration),this.options.disableScrolling&&a("body").addClass("lb-disable-scrolling"),this.changeImage(g)},b.prototype.changeImage=function(b){var c=this,d=this.album[b].link,e=d.split(".").slice(-1)[0],f=this.$lightbox.find(".lb-image");this.disableKeyboardNav(),this.$overlay.fadeIn(this.options.fadeDuration),a(".lb-loader").fadeIn("slow"),this.$lightbox.find(".lb-image, .lb-nav, .lb-prev, .lb-next, .lb-dataContainer, .lb-numbers, .lb-caption").hide(),this.$outerContainer.addClass("animating");var g=new Image;g.onload=function(){var h,i,j,k,l,m;f.attr({alt:c.album[b].alt,src:d}),a(g),f.width(g.width),f.height(g.height),m=a(window).width(),l=a(window).height(),k=m-c.containerPadding.left-c.containerPadding.right-c.imageBorderWidth.left-c.imageBorderWidth.right-20,j=l-c.containerPadding.top-c.containerPadding.bottom-c.imageBorderWidth.top-c.imageBorderWidth.bottom-c.options.positionFromTop-70,"svg"===e&&(f.width(k),f.height(j)),c.options.fitImagesInViewport?(c.options.maxWidth&&c.options.maxWidth<k&&(k=c.options.maxWidth),c.options.maxHeight&&c.options.maxHeight<j&&(j=c.options.maxHeight)):(k=c.options.maxWidth||g.width||k,j=c.options.maxHeight||g.height||j),(g.width>k||g.height>j)&&(g.width/k>g.height/j?(i=k,h=parseInt(g.height/(g.width/i),10),f.width(i),f.height(h)):(h=j,i=parseInt(g.width/(g.height/h),10),f.width(i),f.height(h))),c.sizeContainer(f.width(),f.height())},g.src=this.album[b].link,this.currentImageIndex=b},b.prototype.sizeOverlay=function(){var b=this;setTimeout(function(){b.$overlay.width(a(document).width()).height(a(document).height())},0)},b.prototype.sizeContainer=function(a,b){function c(){d.$lightbox.find(".lb-dataContainer").width(g),d.$lightbox.find(".lb-prevLink").height(h),d.$lightbox.find(".lb-nextLink").height(h),d.$overlay.focus(),d.showImage()}var d=this,e=this.$outerContainer.outerWidth(),f=this.$outerContainer.outerHeight(),g=a+this.containerPadding.left+this.containerPadding.right+this.imageBorderWidth.left+this.imageBorderWidth.right,h=b+this.containerPadding.top+this.containerPadding.bottom+this.imageBorderWidth.top+this.imageBorderWidth.bottom;e!==g||f!==h?this.$outerContainer.animate({width:g,height:h},this.options.resizeDuration,"swing",function(){c()}):c()},b.prototype.showImage=function(){this.$lightbox.find(".lb-loader").stop(!0).hide(),this.$lightbox.find(".lb-image").fadeIn(this.options.imageFadeDuration),this.updateNav(),this.updateDetails(),this.preloadNeighboringImages(),this.enableKeyboardNav()},b.prototype.updateNav=function(){var a=!1;try{document.createEvent("TouchEvent"),a=!!this.options.alwaysShowNavOnTouchDevices}catch(a){}this.$lightbox.find(".lb-nav").show(),this.album.length>1&&(this.options.wrapAround?(a&&this.$lightbox.find(".lb-prev, .lb-next").css("opacity","1"),this.$lightbox.find(".lb-prev, .lb-next").show()):(this.currentImageIndex>0&&(this.$lightbox.find(".lb-prev").show(),a&&this.$lightbox.find(".lb-prev").css("opacity","1")),this.currentImageIndex<this.album.length-1&&(this.$lightbox.find(".lb-next").show(),a&&this.$lightbox.find(".lb-next").css("opacity","1"))))},b.prototype.updateDetails=function(){var a=this;if(void 0!==this.album[this.currentImageIndex].title&&""!==this.album[this.currentImageIndex].title){var b=this.$lightbox.find(".lb-caption");this.options.sanitizeTitle?b.text(this.album[this.currentImageIndex].title):b.html(this.album[this.currentImageIndex].title),b.fadeIn("fast")}if(this.album.length>1&&this.options.showImageNumberLabel){var c=this.imageCountLabel(this.currentImageIndex+1,this.album.length);this.$lightbox.find(".lb-number").text(c).fadeIn("fast")}else this.$lightbox.find(".lb-number").hide();this.$outerContainer.removeClass("animating"),this.$lightbox.find(".lb-dataContainer").fadeIn(this.options.resizeDuration,function(){return a.sizeOverlay()})},b.prototype.preloadNeighboringImages=function(){if(this.album.length>this.currentImageIndex+1){(new Image).src=this.album[this.currentImageIndex+1].link}if(this.currentImageIndex>0){(new Image).src=this.album[this.currentImageIndex-1].link}},b.prototype.enableKeyboardNav=function(){this.$lightbox.on("keyup.keyboard",a.proxy(this.keyboardAction,this)),this.$overlay.on("keyup.keyboard",a.proxy(this.keyboardAction,this))},b.prototype.disableKeyboardNav=function(){this.$lightbox.off(".keyboard"),this.$overlay.off(".keyboard")},b.prototype.keyboardAction=function(a){var b=a.keyCode;27===b?(a.stopPropagation(),this.end()):37===b?0!==this.currentImageIndex?this.changeImage(this.currentImageIndex-1):this.options.wrapAround&&this.album.length>1&&this.changeImage(this.album.length-1):39===b&&(this.currentImageIndex!==this.album.length-1?this.changeImage(this.currentImageIndex+1):this.options.wrapAround&&this.album.length>1&&this.changeImage(0))},b.prototype.end=function(){this.disableKeyboardNav(),a(window).off("resize",this.sizeOverlay),this.$lightbox.fadeOut(this.options.fadeDuration),this.$overlay.fadeOut(this.options.fadeDuration),this.options.disableScrolling&&a("body").removeClass("lb-disable-scrolling")},new b});
//# sourceMappingURL=lightbox.min.map
var u="undefined"!=typeof window&&window===this?this:"undefined"!=typeof global&&null!=global?global:this;function v(){v=function(){},u.Symbol||(u.Symbol=A)}var B=0;function A(t){return"jscomp_symbol_"+(t||"")+B++}!function(t){function i(n){if(e[n])return e[n].T;var s=e[n]={ja:n,fa:!1,T:{}};return t[n].call(s.T,s,s.T,i),s.fa=!0,s.T}var e={};i.u=t,i.h=e,i.c=function(t,e,n){i.g(t,e)||Object.defineProperty(t,e,{enumerable:!0,get:n})},i.r=function(t){v(),v(),"undefined"!=typeof Symbol&&Symbol.toStringTag&&(v(),Object.defineProperty(t,Symbol.toStringTag,{value:"Module"})),Object.defineProperty(t,"__esModule",{value:!0})},i.m=function(t,e){if(1&e&&(t=i(t)),8&e)return t;if(4&e&&"object"==typeof t&&t&&t.ba)return t;var n=Object.create(null);if(i.r(n),Object.defineProperty(n,"default",{enumerable:!0,value:t}),2&e&&"string"!=typeof t)for(var s in t)i.c(n,s,function(i){return t[i]}.bind(null,s));return n},i.i=function(t){var e=t&&t.ba?function(){return t.default}:function(){return t};return i.c(e,"a",e),e},i.g=function(t,i){return Object.prototype.hasOwnProperty.call(t,i)},i.o="",i(i.v=0)}([function(t,i,e){function n(t,i){if(i=void 0===i?{}:i,this.h=t,this.g=this.g.bind(this),!a(this.h))throw new TypeError("`new Drift` requires a DOM element as its first argument.");t=i.namespace||null;var e=i.showWhitespaceAtEdges||!1,n=i.containInline||!1,s=i.inlineOffsetX||0,o=i.inlineOffsetY||0,h=i.inlineContainer||document.body,r=i.sourceAttribute||"data-zoom",d=i.zoomFactor||3,u=void 0===i.paneContainer?document.body:i.paneContainer,c=i.inlinePane||375,f=!("handleTouch"in i)||!!i.handleTouch,p=i.onShow||null,l=i.onHide||null,b=!("injectBaseStyles"in i)||!!i.injectBaseStyles,v=i.hoverDelay||0,m=i.touchDelay||0,y=i.hoverBoundingBox||!1,g=i.touchBoundingBox||!1;if(i=i.boundingBoxContainer||document.body,!0!==c&&!a(u))throw new TypeError("`paneContainer` must be a DOM element when `inlinePane !== true`");if(!a(h))throw new TypeError("`inlineContainer` must be a DOM element");this.a={j:t,P:e,I:n,K:s,L:o,w:h,R:r,f:d,ga:u,ea:c,C:f,O:p,N:l,da:b,F:v,A:m,D:y,G:g,H:i},this.a.da&&!document.querySelector(".drift-base-styles")&&((i=document.createElement("style")).type="text/css",i.classList.add("drift-base-styles"),i.appendChild(document.createTextNode(".drift-bounding-box,.drift-zoom-pane{position:absolute;pointer-events:none}@keyframes noop{0%{zoom:1}}@-webkit-keyframes noop{0%{zoom:1}}.drift-zoom-pane.drift-open{display:block}.drift-zoom-pane.drift-closing,.drift-zoom-pane.drift-opening{animation:noop 1ms;-webkit-animation:noop 1ms}.drift-zoom-pane{overflow:hidden;width:100%;height:100%;top:0;left:0}.drift-zoom-pane-loader{display:none}.drift-zoom-pane img{position:absolute;display:block;max-width:none;max-height:none}")),(t=document.head).insertBefore(i,t.firstChild)),this.v(),this.u()}function s(t){t=void 0===t?{}:t,this.h=this.h.bind(this),this.g=this.g.bind(this),this.m=this.m.bind(this),this.s=!1;var i=void 0===t.J?null:t.J,e=void 0===t.f?c():t.f,n=void 0===t.U?c():t.U,s=void 0===t.j?null:t.j,o=void 0===t.P?c():t.P,h=void 0===t.I?c():t.I;this.a={J:i,f:e,U:n,j:s,P:o,I:h,K:void 0===t.K?0:t.K,L:void 0===t.L?0:t.L,w:void 0===t.w?document.body:t.w},this.o=this.i("open"),this.Y=this.i("opening"),this.u=this.i("closing"),this.v=this.i("inline"),this.V=this.i("loading"),this.ha()}function o(t){t=void 0===t?{}:t,this.m=this.m.bind(this),this.B=this.B.bind(this),this.g=this.g.bind(this),this.c=this.c.bind(this);var i=t;t=void 0===i.b?c():i.b;var e=void 0===i.l?c():i.l,n=void 0===i.R?c():i.R,s=void 0===i.C?c():i.C,o=void 0===i.O?null:i.O,a=void 0===i.N?null:i.N,r=void 0===i.F?0:i.F,d=void 0===i.A?0:i.A,u=void 0===i.D?c():i.D,f=void 0===i.G?c():i.G,p=void 0===i.j?null:i.j,l=void 0===i.f?c():i.f;i=void 0===i.H?c():i.H,this.a={b:t,l:e,R:n,C:s,O:o,N:a,F:r,A:d,D:u,G:f,j:p,f:l,H:i},(this.a.D||this.a.G)&&(this.o=new h({j:this.a.j,f:this.a.f,S:this.a.H})),this.enabled=!0,this.M()}function h(t){this.s=!1;var i=void 0===t.j?null:t.j,e=void 0===t.f?c():t.f;t=void 0===t.S?c():t.S,this.a={j:i,f:e,S:t},this.c=this.g("open"),this.h()}function a(t){return f?t instanceof HTMLElement:t&&"object"==typeof t&&null!==t&&1===t.nodeType&&"string"==typeof t.nodeName}function r(t,i){i.forEach(function(i){t.classList.add(i)})}function d(t,i){i.forEach(function(i){t.classList.remove(i)})}function c(){throw Error("Missing parameter")}e.r(i);var f="object"==typeof HTMLElement;h.prototype.g=function(t){var i=["drift-"+t],e=this.a.j;return e&&i.push(e+"-"+t),i},h.prototype.h=function(){this.b=document.createElement("div"),r(this.b,this.g("bounding-box"))},h.prototype.show=function(t,i){this.s=!0,this.a.S.appendChild(this.b);var e=this.b.style;e.width=Math.round(t/this.a.f)+"px",e.height=Math.round(i/this.a.f)+"px",r(this.b,this.c)},h.prototype.W=function(){this.s&&this.a.S.removeChild(this.b),this.s=!1,d(this.b,this.c)},h.prototype.setPosition=function(t,i,e){var n=window.pageXOffset,s=window.pageYOffset;t=e.left+t*e.width-this.b.clientWidth/2+n,i=e.top+i*e.height-this.b.clientHeight/2+s,t<e.left+n?t=e.left+n:t+this.b.clientWidth>e.left+e.width+n&&(t=e.left+e.width-this.b.clientWidth+n),i<e.top+s?i=e.top+s:i+this.b.clientHeight>e.top+e.height+s&&(i=e.top+e.height-this.b.clientHeight+s),this.b.style.left=t+"px",this.b.style.top=i+"px"},o.prototype.i=function(t){t.preventDefault()},o.prototype.u=function(t){this.a.A&&this.V(t)&&!this.s||t.preventDefault()},o.prototype.V=function(t){return!!t.touches},o.prototype.M=function(){this.a.b.addEventListener("mouseenter",this.g,!1),this.a.b.addEventListener("mouseleave",this.B,!1),this.a.b.addEventListener("mousemove",this.c,!1),this.a.C?(this.a.b.addEventListener("touchstart",this.g,!1),this.a.b.addEventListener("touchend",this.B,!1),this.a.b.addEventListener("touchmove",this.c,!1)):(this.a.b.addEventListener("touchstart",this.i,!1),this.a.b.addEventListener("touchend",this.i,!1),this.a.b.addEventListener("touchmove",this.i,!1))},o.prototype.ca=function(){this.a.b.removeEventListener("mouseenter",this.g,!1),this.a.b.removeEventListener("mouseleave",this.B,!1),this.a.b.removeEventListener("mousemove",this.c,!1),this.a.C?(this.a.b.removeEventListener("touchstart",this.g,!1),this.a.b.removeEventListener("touchend",this.B,!1),this.a.b.removeEventListener("touchmove",this.c,!1)):(this.a.b.removeEventListener("touchstart",this.i,!1),this.a.b.removeEventListener("touchend",this.i,!1),this.a.b.removeEventListener("touchmove",this.i,!1))},o.prototype.g=function(t){this.u(t),this.h=t,"mouseenter"==t.type&&this.a.F?this.v=setTimeout(this.m,this.a.F):this.a.A?this.v=setTimeout(this.m,this.a.A):this.m()},o.prototype.m=function(){if(this.enabled){var t=this.a.O;t&&"function"==typeof t&&t(),this.a.l.show(this.a.b.getAttribute(this.a.R),this.a.b.clientWidth,this.a.b.clientHeight),this.h&&((t=this.h.touches)&&this.a.G||!t&&this.a.D)&&this.o.show(this.a.l.b.clientWidth,this.a.l.b.clientHeight),this.c()}},o.prototype.B=function(t){t&&this.u(t),this.h=null,this.v&&clearTimeout(this.v),this.o&&this.o.W(),(t=this.a.N)&&"function"==typeof t&&t(),this.a.l.W()},o.prototype.c=function(t){if(t)this.u(t),this.h=t;else{if(!this.h)return;t=this.h}if(t.touches)var i=(t=t.touches[0]).clientX,e=t.clientY;else i=t.clientX,e=t.clientY;i=(i-(t=this.a.b.getBoundingClientRect()).left)/this.a.b.clientWidth,e=(e-t.top)/this.a.b.clientHeight,this.o&&this.o.setPosition(i,e,t),this.a.l.setPosition(i,e,t)},u.Object.defineProperties(o.prototype,{s:{configurable:!0,enumerable:!0,get:function(){return this.a.l.s}}}),t=document.createElement("div").style;var p="undefined"!=typeof document&&("animation"in t||"webkitAnimation"in t);s.prototype.i=function(t){var i=["drift-"+t],e=this.a.j;return e&&i.push(e+"-"+t),i},s.prototype.ha=function(){this.b=document.createElement("div"),r(this.b,this.i("zoom-pane"));var t=document.createElement("div");r(t,this.i("zoom-pane-loader")),this.b.appendChild(t),this.c=document.createElement("img"),this.b.appendChild(this.c)},s.prototype.X=function(t){this.c.setAttribute("src",t)},s.prototype.Z=function(t,i){this.c.style.width=t*this.a.f+"px",this.c.style.height=i*this.a.f+"px"},s.prototype.setPosition=function(t,i,e){var n=this.c.offsetWidth,s=this.c.offsetHeight,o=this.b.offsetWidth,h=this.b.offsetHeight,a=o/2-n*t,r=h/2-s*i,d=o-n,u=h-s,c=0<d,f=0<u;s=c?d/2:0,n=f?u/2:0,d=c?d/2:d,u=f?u/2:u,this.b.parentElement===this.a.w&&(f=window.pageXOffset,c=window.pageYOffset,t=e.left+t*e.width-o/2+this.a.K+f,i=e.top+i*e.height-h/2+this.a.L+c,this.a.I&&(t<e.left+f?t=e.left+f:t+o>e.left+e.width+f&&(t=e.left+e.width-o+f),i<e.top+c?i=e.top+c:i+h>e.top+e.height+c&&(i=e.top+e.height-h+c)),this.b.style.left=t+"px",this.b.style.top=i+"px"),this.a.P||(a>s?a=s:a<d&&(a=d),r>n?r=n:r<u&&(r=u)),this.c.style.transform="translate("+a+"px, "+r+"px)",this.c.style.webkitTransform="translate("+a+"px, "+r+"px)"},s.prototype.M=function(){this.b.removeEventListener("animationend",this.h,!1),this.b.removeEventListener("animationend",this.g,!1),this.b.removeEventListener("webkitAnimationEnd",this.h,!1),this.b.removeEventListener("webkitAnimationEnd",this.g,!1),d(this.b,this.o),d(this.b,this.u)},s.prototype.show=function(t,i,e){this.M(),this.s=!0,r(this.b,this.o),this.c.getAttribute("src")!=t&&(r(this.b,this.V),this.c.addEventListener("load",this.m,!1),this.X(t)),this.Z(i,e),this.ia?this.aa():this.$(),p&&(this.b.addEventListener("animationend",this.h,!1),this.b.addEventListener("webkitAnimationEnd",this.h,!1),r(this.b,this.Y))},s.prototype.aa=function(){this.a.w.appendChild(this.b),r(this.b,this.v)},s.prototype.$=function(){this.a.J.appendChild(this.b)},s.prototype.W=function(){this.M(),this.s=!1,p?(this.b.addEventListener("animationend",this.g,!1),this.b.addEventListener("webkitAnimationEnd",this.g,!1),r(this.b,this.u)):(d(this.b,this.o),d(this.b,this.v))},s.prototype.h=function(){this.b.removeEventListener("animationend",this.h,!1),this.b.removeEventListener("webkitAnimationEnd",this.h,!1),d(this.b,this.Y)},s.prototype.g=function(){this.b.removeEventListener("animationend",this.g,!1),this.b.removeEventListener("webkitAnimationEnd",this.g,!1),d(this.b,this.o),d(this.b,this.u),d(this.b,this.v),this.b.setAttribute("style",""),this.b.parentElement===this.a.J?this.a.J.removeChild(this.b):this.b.parentElement===this.a.w&&this.a.w.removeChild(this.b)},s.prototype.m=function(){this.c.removeEventListener("load",this.m,!1),d(this.b,this.V)},u.Object.defineProperties(s.prototype,{ia:{configurable:!0,enumerable:!0,get:function(){var t=this.a.U;return!0===t||"number"==typeof t&&window.innerWidth<=t}}}),n.prototype.v=function(){this.l=new s({J:this.a.ga,f:this.a.f,P:this.a.P,I:this.a.I,U:this.a.ea,j:this.a.j,K:this.a.K,L:this.a.L,w:this.a.w})},n.prototype.u=function(){this.c=new o({b:this.h,l:this.l,C:this.a.C,O:this.a.O,N:this.a.N,R:this.a.R,F:this.a.F,A:this.a.A,D:this.a.D,G:this.a.G,j:this.a.j,f:this.a.f,H:this.a.H})},n.prototype.M=function(t){this.l.X(t)},n.prototype.i=function(){this.c.enabled=!1},n.prototype.m=function(){this.c.enabled=!0},n.prototype.g=function(){this.c.B(),this.c.ca()},u.Object.defineProperties(n.prototype,{s:{configurable:!0,enumerable:!0,get:function(){return this.l.s}},f:{configurable:!0,enumerable:!0,get:function(){return this.a.f},set:function(t){this.a.f=t,this.l.a.f=t,this.c.a.f=t,this.o.a.f=t}}}),Object.defineProperty(n.prototype,"isShowing",{get:function(){return this.s}}),Object.defineProperty(n.prototype,"zoomFactor",{get:function(){return this.f},set:function(t){this.f=t}}),n.prototype.setZoomImageURL=n.prototype.M,n.prototype.disable=n.prototype.i,n.prototype.enable=n.prototype.m,n.prototype.destroy=n.prototype.g,window.Drift=n}]);
//# sourceMappingURL=Drift.min.js.map
/**!
 * lightgallery.js | 1.2.0 | May 20th 2020
 * http://sachinchoolur.github.io/lightgallery.js/
 * Copyright (c) 2016 Sachin N; 
 * @license GPLv3 
 */
!function(e){if("object"==typeof exports&&"undefined"!=typeof module)module.exports=e();else if("function"==typeof define&&define.amd)define([],e);else{var t;t="undefined"!=typeof window?window:"undefined"!=typeof global?global:"undefined"!=typeof self?self:this,t.Lightgallery=e()}}(function(){var e,t,s;return function(){function e(t,s,l){function i(r,a){if(!s[r]){if(!t[r]){var d="function"==typeof require&&require;if(!a&&d)return d(r,!0);if(o)return o(r,!0);var n=new Error("Cannot find module '"+r+"'");throw n.code="MODULE_NOT_FOUND",n}var u=s[r]={exports:{}};t[r][0].call(u.exports,function(e){return i(t[r][1][e]||e)},u,u.exports,e,t,s,l)}return s[r].exports}for(var o="function"==typeof require&&require,r=0;r<l.length;r++)i(l[r]);return i}return e}()({1:[function(t,s,l){!function(t,s){if("function"==typeof e&&e.amd)e(["exports"],s);else if(void 0!==l)s(l);else{var i={exports:{}};s(i.exports),t.lgUtils=i.exports}}(this,function(e){"use strict";Object.defineProperty(e,"__esModule",{value:!0});var t={getAttribute:function e(t,s){return t[s]},setAttribute:function e(t,s,l){t[s]=l},wrap:function e(t,s){if(t){var l=document.createElement("div");l.className=s,t.parentNode.insertBefore(l,t),t.parentNode.removeChild(t),l.appendChild(t)}},addClass:function e(t,s){t&&(t.classList?t.classList.add(s):t.className+=" "+s)},removeClass:function e(t,s){t&&(t.classList?t.classList.remove(s):t.className=t.className.replace(new RegExp("(^|\\b)"+s.split(" ").join("|")+"(\\b|$)","gi")," "))},hasClass:function e(t,s){return t.classList?t.classList.contains(s):new RegExp("(^| )"+s+"( |$)","gi").test(t.className)},setVendor:function e(t,s,l){t&&(t.style[s.charAt(0).toLowerCase()+s.slice(1)]=l,t.style["webkit"+s]=l,t.style["moz"+s]=l,t.style["ms"+s]=l,t.style["o"+s]=l)},trigger:function e(t,s){var l=arguments.length>2&&void 0!==arguments[2]?arguments[2]:null;if(t){var i=new CustomEvent(s,{detail:l});t.dispatchEvent(i)}},Listener:{uid:0},on:function e(s,l,i){var o=this;s&&l.split(" ").forEach(function(e){var l=o.getAttribute(s,"lg-event-uid")||"";t.Listener.uid++,l+="&"+t.Listener.uid,o.setAttribute(s,"lg-event-uid",l),t.Listener[e+t.Listener.uid]=i,s.addEventListener(e.split(".")[0],i,!1)})},off:function e(s,l){if(s){var i=this.getAttribute(s,"lg-event-uid");if(i){i=i.split("&");for(var o=0;o<i.length;o++)if(i[o]){var r=l+i[o];if("."===r.substring(0,1))for(var a in t.Listener)t.Listener.hasOwnProperty(a)&&a.split(".").indexOf(r.split(".")[1])>-1&&(s.removeEventListener(a.split(".")[0],t.Listener[a]),this.setAttribute(s,"lg-event-uid",this.getAttribute(s,"lg-event-uid").replace("&"+i[o],"")),delete t.Listener[a]);else s.removeEventListener(r.split(".")[0],t.Listener[r]),this.setAttribute(s,"lg-event-uid",this.getAttribute(s,"lg-event-uid").replace("&"+i[o],"")),delete t.Listener[r]}}}},param:function e(t){return Object.keys(t).map(function(e){return encodeURIComponent(e)+"="+encodeURIComponent(t[e])}).join("&")}};e.default=t})},{}],2:[function(t,s,l){!function(s,i){if("function"==typeof e&&e.amd)e(["./lg-utils"],i);else if(void 0!==l)i(t("./lg-utils"));else{var o={exports:{}};i(s.lgUtils),s.lightgallery=o.exports}}(this,function(e){"use strict";function t(e){return e&&e.__esModule?e:{default:e}}function s(e,t){if(this.el=e,this.s=i({},o,t),this.s.dynamic&&"undefined"!==this.s.dynamicEl&&this.s.dynamicEl.constructor===Array&&!this.s.dynamicEl.length)throw"When using dynamic mode, you must also define dynamicEl as an Array.";return this.modules={},this.lGalleryOn=!1,this.lgBusy=!1,this.hideBartimeout=!1,this.isTouch="ontouchstart"in document.documentElement,this.s.slideEndAnimatoin&&(this.s.hideControlOnEnd=!1),this.items=[],this.s.dynamic?this.items=this.s.dynamicEl:"this"===this.s.selector?this.items.push(this.el):""!==this.s.selector?this.s.selectWithin?this.items=document.querySelector(this.s.selectWithin).querySelectorAll(this.s.selector):this.items=this.el.querySelectorAll(this.s.selector):this.items=this.el.children,this.___slide="",this.outer="",this.init(),this}var l=t(e),i=Object.assign||function(e){for(var t=1;t<arguments.length;t++){var s=arguments[t];for(var l in s)Object.prototype.hasOwnProperty.call(s,l)&&(e[l]=s[l])}return e};!function(){function e(e,t){t=t||{bubbles:!1,cancelable:!1,detail:void 0};var s=document.createEvent("CustomEvent");return s.initCustomEvent(e,t.bubbles,t.cancelable,t.detail),s}if("function"==typeof window.CustomEvent)return!1;e.prototype=window.Event.prototype,window.CustomEvent=e}(),window.utils=l.default,window.lgData={uid:0},window.lgModules={};var o={mode:"lg-slide",cssEasing:"ease",easing:"linear",speed:600,height:"100%",width:"100%",addClass:"",startClass:"lg-start-zoom",backdropDuration:150,hideBarsDelay:6e3,useLeft:!1,ariaLabelledby:"",ariaDescribedby:"",closable:!0,loop:!0,escKey:!0,keyPress:!0,controls:!0,slideEndAnimatoin:!0,hideControlOnEnd:!1,mousewheel:!1,getCaptionFromTitleOrAlt:!0,appendSubHtmlTo:".lg-sub-html",subHtmlSelectorRelative:!1,preload:1,showAfterLoad:!0,selector:"",selectWithin:"",nextHtml:"",prevHtml:"",index:!1,iframeMaxWidth:"100%",download:!0,counter:!0,appendCounterTo:".lg-toolbar",swipeThreshold:50,enableSwipe:!0,enableDrag:!0,dynamic:!1,dynamicEl:[],galleryId:1};s.prototype.init=function(){var e=this;e.s.preload>e.items.length&&(e.s.preload=e.items.length);var t=window.location.hash;if(t.indexOf("lg="+this.s.galleryId)>0&&(e.index=parseInt(t.split("&slide=")[1],10),l.default.addClass(document.body,"lg-from-hash"),l.default.hasClass(document.body,"lg-on")||(l.default.addClass(document.body,"lg-on"),setTimeout(function(){e.build(e.index)}))),e.s.dynamic)l.default.trigger(this.el,"onBeforeOpen"),e.index=e.s.index||0,l.default.hasClass(document.body,"lg-on")||(l.default.addClass(document.body,"lg-on"),setTimeout(function(){e.build(e.index)}));else for(var s=0;s<e.items.length;s++)!function(t){l.default.on(e.items[t],"click.lgcustom",function(s){s.preventDefault(),l.default.trigger(e.el,"onBeforeOpen"),e.index=e.s.index||t,l.default.hasClass(document.body,"lg-on")||(e.build(e.index),l.default.addClass(document.body,"lg-on"))})}(s)},s.prototype.build=function(e){var t=this;t.structure();for(var s in window.lgModules)t.modules[s]=new window.lgModules[s](t.el);t.slide(e,!1,!1),t.s.keyPress&&t.keyPress(),t.items.length>1&&(t.arrow(),setTimeout(function(){t.enableDrag(),t.enableSwipe()},50),t.s.mousewheel&&t.mousewheel()),t.counter(),t.closeGallery(),l.default.trigger(t.el,"onAfterOpen"),l.default.on(t.outer,"mousemove.lg click.lg touchstart.lg",function(){l.default.removeClass(t.outer,"lg-hide-items"),clearTimeout(t.hideBartimeout),t.hideBartimeout=setTimeout(function(){l.default.addClass(t.outer,"lg-hide-items")},t.s.hideBarsDelay)})},s.prototype.structure=function(){var e="",t="",s=0,i="",o,r=this;for(document.body.insertAdjacentHTML("beforeend",'<div class="lg-backdrop"></div>'),l.default.setVendor(document.querySelector(".lg-backdrop"),"TransitionDuration",this.s.backdropDuration+"ms"),s=0;s<this.items.length;s++)e+='<div class="lg-item"></div>';if(this.s.controls&&this.items.length>1&&(t='<div class="lg-actions"><button aria-label="Previous slide" class="lg-prev lg-icon">'+this.s.prevHtml+'</button><button aria-label="Next slide" class="lg-next lg-icon">'+this.s.nextHtml+"</button></div>"),".lg-sub-html"===this.s.appendSubHtmlTo&&(i='<div role="status" aria-live="polite" class="lg-sub-html"></div>'),o='<div tabindex="-1" aria-modal="true" '+(this.s.ariaLabelledby?'aria-labelledby="'+this.s.ariaLabelledby+'"':"")+" "+(this.s.ariaDescribedby?'aria-describedby="'+this.s.ariaDescribedby+'"':"")+' role="dialog" class="lg-outer '+this.s.addClass+" "+this.s.startClass+'"><div class="lg" style="width:'+this.s.width+"; height:"+this.s.height+'"><div class="lg-inner">'+e+'</div><div class="lg-toolbar group"><button aria-label="Close gallery" class="lg-close lg-icon"></button></div>'+t+i+"</div></div>",document.body.insertAdjacentHTML("beforeend",o),this.outer=document.querySelector(".lg-outer"),this.outer.focus(),this.___slide=this.outer.querySelectorAll(".lg-item"),this.s.useLeft?(l.default.addClass(this.outer,"lg-use-left"),this.s.mode="lg-slide"):l.default.addClass(this.outer,"lg-use-css3"),r.setTop(),l.default.on(window,"resize.lg orientationchange.lg",function(){setTimeout(function(){r.setTop()},100)}),l.default.addClass(this.___slide[this.index],"lg-current"),this.doCss()?l.default.addClass(this.outer,"lg-css3"):(l.default.addClass(this.outer,"lg-css"),this.s.speed=0),l.default.addClass(this.outer,this.s.mode),this.s.enableDrag&&this.items.length>1&&l.default.addClass(this.outer,"lg-grab"),this.s.showAfterLoad&&l.default.addClass(this.outer,"lg-show-after-load"),this.doCss()){var a=this.outer.querySelector(".lg-inner");l.default.setVendor(a,"TransitionTimingFunction",this.s.cssEasing),l.default.setVendor(a,"TransitionDuration",this.s.speed+"ms")}setTimeout(function(){l.default.addClass(document.querySelector(".lg-backdrop"),"in")}),setTimeout(function(){l.default.addClass(r.outer,"lg-visible")},this.s.backdropDuration),this.s.download&&this.outer.querySelector(".lg-toolbar").insertAdjacentHTML("beforeend",'<a id="lg-download" aria-label="Download" target="_blank" download class="lg-download lg-icon"></a>'),this.prevScrollTop=document.documentElement.scrollTop||document.body.scrollTop},s.prototype.setTop=function(){if("100%"!==this.s.height){var e=window.innerHeight,t=(e-parseInt(this.s.height,10))/2,s=this.outer.querySelector(".lg");e>=parseInt(this.s.height,10)?s.style.top=t+"px":s.style.top="0px"}},s.prototype.doCss=function(){return!!function e(){var t=["transition","MozTransition","WebkitTransition","OTransition","msTransition","KhtmlTransition"],s=document.documentElement,l=0;for(l=0;l<t.length;l++)if(t[l]in s.style)return!0}()},s.prototype.isVideo=function(e,t){var s;if(s=this.s.dynamic?this.s.dynamicEl[t].html:this.items[t].getAttribute("data-html"),!e&&s)return{html5:!0};var l=e.match(/\/\/(?:www\.)?youtu(?:\.be|be\.com|be-nocookie\.com)\/(?:watch\?v=|embed\/)?([a-z0-9\-\_\%]+)/i),i=e.match(/\/\/(?:www\.)?vimeo.com\/([0-9a-z\-_]+)/i),o=e.match(/\/\/(?:www\.)?dai.ly\/([0-9a-z\-_]+)/i),r=e.match(/\/\/(?:www\.)?(?:vk\.com|vkontakte\.ru)\/(?:video_ext\.php\?)(.*)/i);return l?{youtube:l}:i?{vimeo:i}:o?{dailymotion:o}:r?{vk:r}:void 0},s.prototype.counter=function(){this.s.counter&&this.outer.querySelector(this.s.appendCounterTo).insertAdjacentHTML("beforeend",'<div id="lg-counter" role="status" aria-live="polite"><span id="lg-counter-current">'+(parseInt(this.index,10)+1)+'</span> / <span id="lg-counter-all">'+this.items.length+"</span></div>")},s.prototype.addHtml=function(e){var t=null,s;if(this.s.dynamic?t=this.s.dynamicEl[e].subHtml:(s=this.items[e],t=s.getAttribute("data-sub-html"),this.s.getCaptionFromTitleOrAlt&&!t&&(t=s.getAttribute("title"))&&s.querySelector("img")&&(t=s.querySelector("img").getAttribute("alt"))),void 0!==t&&null!==t){var i=t.substring(0,1);"."!==i&&"#"!==i||(t=this.s.subHtmlSelectorRelative&&!this.s.dynamic?s.querySelector(t).innerHTML:document.querySelector(t).innerHTML)}else t="";".lg-sub-html"===this.s.appendSubHtmlTo?this.outer.querySelector(this.s.appendSubHtmlTo).innerHTML=t:this.___slide[e].insertAdjacentHTML("beforeend",t),void 0!==t&&null!==t&&(""===t?l.default.addClass(this.outer.querySelector(this.s.appendSubHtmlTo),"lg-empty-html"):l.default.removeClass(this.outer.querySelector(this.s.appendSubHtmlTo),"lg-empty-html")),l.default.trigger(this.el,"onAfterAppendSubHtml",{index:e})},s.prototype.preload=function(e){var t=1,s=1;for(t=1;t<=this.s.preload&&!(t>=this.items.length-e);t++)this.loadContent(e+t,!1,0);for(s=1;s<=this.s.preload&&!(e-s<0);s++)this.loadContent(e-s,!1,0)},s.prototype.loadContent=function(e,t,s){var i=this,o=!1,r,a,d,n,u,c,g,f=function e(t){for(var s=[],l=[],i=0;i<t.length;i++){var o=t[i].split(" ");""===o[0]&&o.splice(0,1),l.push(o[0]),s.push(o[1])}for(var r=window.innerWidth,d=0;d<s.length;d++)if(parseInt(s[d],10)>r){a=l[d];break}};if(i.s.dynamic){if(i.s.dynamicEl[e].poster&&(o=!0,d=i.s.dynamicEl[e].poster),c=i.s.dynamicEl[e].html,a=i.s.dynamicEl[e].src,g=i.s.dynamicEl[e].alt,i.s.dynamicEl[e].responsive){f(i.s.dynamicEl[e].responsive.split(","))}n=i.s.dynamicEl[e].srcset,u=i.s.dynamicEl[e].sizes}else{if(i.items[e].getAttribute("data-poster")&&(o=!0,d=i.items[e].getAttribute("data-poster")),c=i.items[e].getAttribute("data-html"),a=i.items[e].getAttribute("href")||i.items[e].getAttribute("data-src"),g=i.items[e].getAttribute("title"),i.items[e].querySelector("img")&&(g=g||i.items[e].querySelector("img").getAttribute("alt")),i.items[e].getAttribute("data-responsive")){f(i.items[e].getAttribute("data-responsive").split(","))}n=i.items[e].getAttribute("data-srcset"),u=i.items[e].getAttribute("data-sizes")}var h=!1;i.s.dynamic?i.s.dynamicEl[e].iframe&&(h=!0):"true"===i.items[e].getAttribute("data-iframe")&&(h=!0);var m=i.isVideo(a,e);if(!l.default.hasClass(i.___slide[e],"lg-loaded")){if(h)i.___slide[e].insertAdjacentHTML("afterbegin",'<div class="lg-video-cont" style="max-width:'+i.s.iframeMaxWidth+'"><div class="lg-video"><iframe class="lg-object" frameborder="0" src="'+a+'"  allowfullscreen="true"></iframe></div></div>');else if(o){var p="";p=m&&m.youtube?"lg-has-youtube":m&&m.vimeo?"lg-has-vimeo":"lg-has-html5",i.___slide[e].insertAdjacentHTML("beforeend",'<div class="lg-video-cont '+p+' "><div class="lg-video"><span class="lg-video-play"></span><img class="lg-object lg-has-poster" src="'+d+'" /></div></div>')}else m?(i.___slide[e].insertAdjacentHTML("beforeend",'<div class="lg-video-cont "><div class="lg-video"></div></div>'),l.default.trigger(i.el,"hasVideo",{index:e,src:a,html:c})):(g=g?'alt="'+g+'"':"",i.___slide[e].insertAdjacentHTML("beforeend",'<div class="lg-img-wrap"><img class="lg-object lg-image" '+g+' src="'+a+'" /></div>'));if(l.default.trigger(i.el,"onAferAppendSlide",{index:e}),r=i.___slide[e].querySelector(".lg-object"),u&&r.setAttribute("sizes",u),n){r.setAttribute("srcset",n);try{picturefill({elements:[r[0]]})}catch(e){console.error("Make sure you have included Picturefill version 2")}}".lg-sub-html"!==this.s.appendSubHtmlTo&&i.addHtml(e),l.default.addClass(i.___slide[e],"lg-loaded")}l.default.on(i.___slide[e].querySelector(".lg-object"),"load.lg error.lg",function(){var t=0;s&&!l.default.hasClass(document.body,"lg-from-hash")&&(t=s),setTimeout(function(){l.default.addClass(i.___slide[e],"lg-complete"),l.default.trigger(i.el,"onSlideItemLoad",{index:e,delay:s||0})},t)}),m&&m.html5&&!o&&l.default.addClass(i.___slide[e],"lg-complete"),!0===t&&(l.default.hasClass(i.___slide[e],"lg-complete")?i.preload(e):l.default.on(i.___slide[e].querySelector(".lg-object"),"load.lg error.lg",function(){i.preload(e)}))},s.prototype.slide=function(e,t,s){for(var i=0,o=0;o<this.___slide.length;o++)if(l.default.hasClass(this.___slide[o],"lg-current")){i=o;break}var r=this;if(!r.lGalleryOn||i!==e){var a=this.___slide.length,d=r.lGalleryOn?this.s.speed:0,n=!1,u=!1;if(!r.lgBusy){if(this.s.download){var c;c=r.s.dynamic?!1!==r.s.dynamicEl[e].downloadUrl&&(r.s.dynamicEl[e].downloadUrl||r.s.dynamicEl[e].src):"false"!==r.items[e].getAttribute("data-download-url")&&(r.items[e].getAttribute("data-download-url")||r.items[e].getAttribute("href")||r.items[e].getAttribute("data-src")),c?(document.getElementById("lg-download").setAttribute("href",c),l.default.removeClass(r.outer,"lg-hide-download")):l.default.addClass(r.outer,"lg-hide-download")}if(l.default.trigger(r.el,"onBeforeSlide",{prevIndex:i,index:e,fromTouch:t,fromThumb:s}),r.lgBusy=!0,clearTimeout(r.hideBartimeout),".lg-sub-html"===this.s.appendSubHtmlTo&&setTimeout(function(){r.addHtml(e)},d),this.arrowDisable(e),t){var g=e-1,f=e+1;0===e&&i===a-1?(f=0,g=a-1):e===a-1&&0===i&&(f=0,g=a-1),l.default.removeClass(r.outer.querySelector(".lg-prev-slide"),"lg-prev-slide"),l.default.removeClass(r.outer.querySelector(".lg-current"),"lg-current"),l.default.removeClass(r.outer.querySelector(".lg-next-slide"),"lg-next-slide"),l.default.addClass(r.___slide[g],"lg-prev-slide"),l.default.addClass(r.___slide[f],"lg-next-slide"),l.default.addClass(r.___slide[e],"lg-current")}else{l.default.addClass(r.outer,"lg-no-trans");for(var h=0;h<this.___slide.length;h++)l.default.removeClass(this.___slide[h],"lg-prev-slide"),l.default.removeClass(this.___slide[h],"lg-next-slide");e<i?(u=!0,0!==e||i!==a-1||s||(u=!1,n=!0)):e>i&&(n=!0,e!==a-1||0!==i||s||(u=!0,n=!1)),u?(l.default.addClass(this.___slide[e],"lg-prev-slide"),l.default.addClass(this.___slide[i],"lg-next-slide")):n&&(l.default.addClass(this.___slide[e],"lg-next-slide"),l.default.addClass(this.___slide[i],"lg-prev-slide")),setTimeout(function(){l.default.removeClass(r.outer.querySelector(".lg-current"),"lg-current"),l.default.addClass(r.___slide[e],"lg-current"),l.default.removeClass(r.outer,"lg-no-trans")},50)}r.lGalleryOn?(setTimeout(function(){r.loadContent(e,!0,0)},this.s.speed+50),setTimeout(function(){r.lgBusy=!1,l.default.trigger(r.el,"onAfterSlide",{prevIndex:i,index:e,fromTouch:t,fromThumb:s})},this.s.speed)):(r.loadContent(e,!0,r.s.backdropDuration),r.lgBusy=!1,l.default.trigger(r.el,"onAfterSlide",{prevIndex:i,index:e,fromTouch:t,fromThumb:s})),r.lGalleryOn=!0,this.s.counter&&document.getElementById("lg-counter-current")&&(document.getElementById("lg-counter-current").innerHTML=e+1)}}},s.prototype.goToNextSlide=function(e){var t=this;t.lgBusy||(t.index+1<t.___slide.length?(t.index++,l.default.trigger(t.el,"onBeforeNextSlide",{index:t.index}),t.slide(t.index,e,!1)):t.s.loop?(t.index=0,l.default.trigger(t.el,"onBeforeNextSlide",{index:t.index}),t.slide(t.index,e,!1)):t.s.slideEndAnimatoin&&(l.default.addClass(t.outer,"lg-right-end"),setTimeout(function(){l.default.removeClass(t.outer,"lg-right-end")},400)))},s.prototype.goToPrevSlide=function(e){var t=this;t.lgBusy||(t.index>0?(t.index--,l.default.trigger(t.el,"onBeforePrevSlide",{index:t.index,fromTouch:e}),t.slide(t.index,e,!1)):t.s.loop?(t.index=t.items.length-1,l.default.trigger(t.el,"onBeforePrevSlide",{index:t.index,fromTouch:e}),t.slide(t.index,e,!1)):t.s.slideEndAnimatoin&&(l.default.addClass(t.outer,"lg-left-end"),setTimeout(function(){l.default.removeClass(t.outer,"lg-left-end")},400)))},s.prototype.keyPress=function(){var e=this;this.items.length>1&&l.default.on(window,"keyup.lg",function(t){e.items.length>1&&(37===t.keyCode&&(t.preventDefault(),e.goToPrevSlide()),39===t.keyCode&&(t.preventDefault(),e.goToNextSlide()))}),l.default.on(window,"keydown.lg",function(t){!0===e.s.escKey&&27===t.keyCode&&(t.preventDefault(),l.default.hasClass(e.outer,"lg-thumb-open")?l.default.removeClass(e.outer,"lg-thumb-open"):e.destroy())})},s.prototype.arrow=function(){var e=this;l.default.on(this.outer.querySelector(".lg-prev"),"click.lg",function(){e.goToPrevSlide()}),l.default.on(this.outer.querySelector(".lg-next"),"click.lg",function(){e.goToNextSlide()})},s.prototype.arrowDisable=function(e){if(!this.s.loop&&this.s.hideControlOnEnd){var t=this.outer.querySelector(".lg-next"),s=this.outer.querySelector(".lg-prev");e+1<this.___slide.length?(t.removeAttribute("disabled"),l.default.removeClass(t,"disabled")):(t.setAttribute("disabled","disabled"),l.default.addClass(t,"disabled")),e>0?(s.removeAttribute("disabled"),l.default.removeClass(s,"disabled")):(s.setAttribute("disabled","disabled"),l.default.addClass(s,"disabled"))}},s.prototype.setTranslate=function(e,t,s){this.s.useLeft?e.style.left=t:l.default.setVendor(e,"Transform","translate3d("+t+"px, "+s+"px, 0px)")},s.prototype.touchMove=function(e,t){var s=t-e;Math.abs(s)>15&&(l.default.addClass(this.outer,"lg-dragging"),this.setTranslate(this.___slide[this.index],s,0),this.setTranslate(document.querySelector(".lg-prev-slide"),-this.___slide[this.index].clientWidth+s,0),this.setTranslate(document.querySelector(".lg-next-slide"),this.___slide[this.index].clientWidth+s,0))},s.prototype.touchEnd=function(e){var t=this;"lg-slide"!==t.s.mode&&l.default.addClass(t.outer,"lg-slide");for(var s=0;s<this.___slide.length;s++)l.default.hasClass(this.___slide[s],"lg-current")||l.default.hasClass(this.___slide[s],"lg-prev-slide")||l.default.hasClass(this.___slide[s],"lg-next-slide")||(this.___slide[s].style.opacity="0");setTimeout(function(){l.default.removeClass(t.outer,"lg-dragging"),e<0&&Math.abs(e)>t.s.swipeThreshold?t.goToNextSlide(!0):e>0&&Math.abs(e)>t.s.swipeThreshold?t.goToPrevSlide(!0):Math.abs(e)<5&&l.default.trigger(t.el,"onSlideClick");for(var s=0;s<t.___slide.length;s++)t.___slide[s].removeAttribute("style")}),setTimeout(function(){l.default.hasClass(t.outer,"lg-dragging")||"lg-slide"===t.s.mode||l.default.removeClass(t.outer,"lg-slide")},t.s.speed+100)},s.prototype.enableSwipe=function(){var e=this,t=0,s=0,i=!1;if(e.s.enableSwipe&&e.isTouch&&e.doCss()){for(var o=0;o<e.___slide.length;o++)l.default.on(e.___slide[o],"touchstart.lg",function(s){l.default.hasClass(e.outer,"lg-zoomed")||e.lgBusy||(s.preventDefault(),e.manageSwipeClass(),t=s.targetTouches[0].pageX)});for(var r=0;r<e.___slide.length;r++)l.default.on(e.___slide[r],"touchmove.lg",function(o){l.default.hasClass(e.outer,"lg-zoomed")||(o.preventDefault(),s=o.targetTouches[0].pageX,e.touchMove(t,s),i=!0)});for(var a=0;a<e.___slide.length;a++)l.default.on(e.___slide[a],"touchend.lg",function(){l.default.hasClass(e.outer,"lg-zoomed")||(i?(i=!1,e.touchEnd(s-t)):l.default.trigger(e.el,"onSlideClick"))})}},s.prototype.enableDrag=function(){var e=this,t=0,s=0,i=!1,o=!1;if(e.s.enableDrag&&!e.isTouch&&e.doCss()){for(var r=0;r<e.___slide.length;r++)l.default.on(e.___slide[r],"mousedown.lg",function(s){l.default.hasClass(e.outer,"lg-zoomed")||(l.default.hasClass(s.target,"lg-object")||l.default.hasClass(s.target,"lg-video-play"))&&(s.preventDefault(),e.lgBusy||(e.manageSwipeClass(),t=s.pageX,i=!0,e.outer.scrollLeft+=1,e.outer.scrollLeft-=1,l.default.removeClass(e.outer,"lg-grab"),l.default.addClass(e.outer,"lg-grabbing"),l.default.trigger(e.el,"onDragstart")))});l.default.on(window,"mousemove.lg",function(r){i&&(o=!0,s=r.pageX,e.touchMove(t,s),l.default.trigger(e.el,"onDragmove"))}),l.default.on(window,"mouseup.lg",function(r){o?(o=!1,e.touchEnd(s-t),l.default.trigger(e.el,"onDragend")):(l.default.hasClass(r.target,"lg-object")||l.default.hasClass(r.target,"lg-video-play"))&&l.default.trigger(e.el,"onSlideClick"),i&&(i=!1,l.default.removeClass(e.outer,"lg-grabbing"),l.default.addClass(e.outer,"lg-grab"))})}},s.prototype.manageSwipeClass=function(){var e=this.index+1,t=this.index-1,s=this.___slide.length;this.s.loop&&(0===this.index?t=s-1:this.index===s-1&&(e=0));for(var i=0;i<this.___slide.length;i++)l.default.removeClass(this.___slide[i],"lg-next-slide"),l.default.removeClass(this.___slide[i],"lg-prev-slide");t>-1&&l.default.addClass(this.___slide[t],"lg-prev-slide"),l.default.addClass(this.___slide[e],"lg-next-slide")},s.prototype.mousewheel=function(){var e=this;l.default.on(e.outer,"mousewheel.lg",function(t){t.deltaY&&(t.deltaY>0?e.goToPrevSlide():e.goToNextSlide(),t.preventDefault())})},s.prototype.closeGallery=function(){var e=this,t=!1;l.default.on(this.outer.querySelector(".lg-close"),"click.lg",function(){e.destroy()}),e.s.closable&&(l.default.on(e.outer,"mousedown.lg",function(e){t=!!(l.default.hasClass(e.target,"lg-outer")||l.default.hasClass(e.target,"lg-item")||l.default.hasClass(e.target,"lg-img-wrap"))}),l.default.on(e.outer,"mouseup.lg",function(s){(l.default.hasClass(s.target,"lg-outer")||l.default.hasClass(s.target,"lg-item")||l.default.hasClass(s.target,"lg-img-wrap")&&t)&&(l.default.hasClass(e.outer,"lg-dragging")||e.destroy())}))},s.prototype.destroy=function(e){var t=this;if(e||l.default.trigger(t.el,"onBeforeClose"),document.body.scrollTop=t.prevScrollTop,document.documentElement.scrollTop=t.prevScrollTop,e){if(!t.s.dynamic)for(var s=0;s<this.items.length;s++)l.default.off(this.items[s],".lg"),l.default.off(this.items[s],".lgcustom");var i=t.el.getAttribute("lg-uid");delete window.lgData[i],t.el.removeAttribute("lg-uid")}l.default.off(this.el,".lgtm");for(var o in window.lgModules)t.modules[o]&&t.modules[o].destroy(e);this.lGalleryOn=!1,clearTimeout(t.hideBartimeout),this.hideBartimeout=!1,l.default.off(window,".lg"),l.default.removeClass(document.body,"lg-on"),l.default.removeClass(document.body,"lg-from-hash"),t.outer&&l.default.removeClass(t.outer,"lg-visible"),l.default.removeClass(document.querySelector(".lg-backdrop"),"in"),setTimeout(function(){try{t.outer&&t.outer.parentNode.removeChild(t.outer),document.querySelector(".lg-backdrop")&&document.querySelector(".lg-backdrop").parentNode.removeChild(document.querySelector(".lg-backdrop")),e||l.default.trigger(t.el,"onCloseAfter"),t.el.focus()}catch(e){}},t.s.backdropDuration+50)},window.lightGallery=function(e,t){if(e)try{if(e.getAttribute("lg-uid"))try{window.lgData[e.getAttribute("lg-uid")].init()}catch(e){console.error("lightGallery has not initiated properly")}else{var l="lg"+window.lgData.uid++;window.lgData[l]=new s(e,t),e.setAttribute("lg-uid",l)}}catch(e){console.error("lightGallery has not initiated properly")}}})},{"./lg-utils":1}]},{},[2])(2)});
/**!
 * lg-video.js | 1.2.0 | May 20th 2020
 * http://sachinchoolur.github.io/lg-video.js
 * Copyright (c) 2016 Sachin N; 
 * @license GPLv3 
 */
!function(e){if("object"==typeof exports&&"undefined"!=typeof module)module.exports=e();else if("function"==typeof define&&define.amd)define([],e);else{var o;o="undefined"!=typeof window?window:"undefined"!=typeof global?global:"undefined"!=typeof self?self:this,o.LgVideo=e()}}(function(){var e,o,i;return function(){function e(o,i,t){function r(s,a){if(!i[s]){if(!o[s]){var d="function"==typeof require&&require;if(!a&&d)return d(s,!0);if(l)return l(s,!0);var c=new Error("Cannot find module '"+s+"'");throw c.code="MODULE_NOT_FOUND",c}var n=i[s]={exports:{}};o[s][0].call(n.exports,function(e){return r(o[s][1][e]||e)},n,n.exports,e,o,i,t)}return i[s].exports}for(var l="function"==typeof require&&require,s=0;s<t.length;s++)r(t[s]);return r}return e}()({1:[function(o,i,t){!function(o,i){if("function"==typeof e&&e.amd)e([],i);else if(void 0!==t)i();else{var r={exports:{}};i(),o.lgVideo=r.exports}}(this,function(){"use strict";var e=Object.assign||function(e){for(var o=1;o<arguments.length;o++){var i=arguments[o];for(var t in i)Object.prototype.hasOwnProperty.call(i,t)&&(e[t]=i[t])}return e},o={videoMaxWidth:"855px",youtubePlayerParams:!1,vimeoPlayerParams:!1,dailymotionPlayerParams:!1,vkPlayerParams:!1,videojs:!1,videojsOptions:{}},i=function i(t){return this.el=t,this.core=window.lgData[this.el.getAttribute("lg-uid")],this.core.s=e({},o,this.core.s),this.videoLoaded=!1,this.init(),this};i.prototype.init=function(){var e=this;utils.on(e.core.el,"hasVideo.lgtm",function(o){if(e.core.___slide[o.detail.index].querySelector(".lg-video").insertAdjacentHTML("beforeend",e.loadVideo(o.detail.src,"lg-object",!0,o.detail.index,o.detail.html)),o.detail.html)if(e.core.s.videojs)try{videojs(e.core.___slide[o.detail.index].querySelector(".lg-html5"),e.core.s.videojsOptions,function(){e.videoLoaded||this.play()})}catch(e){console.error("Make sure you have included videojs")}else e.core.___slide[o.detail.index].querySelector(".lg-html5").play()}),utils.on(e.core.el,"onAferAppendSlide.lgtm",function(o){e.core.___slide[o.detail.index].querySelector(".lg-video-cont")&&(e.core.___slide[o.detail.index].querySelector(".lg-video-cont").style.maxWidth=e.core.s.videoMaxWidth,e.videoLoaded=!0)});var o=function o(i){if(utils.hasClass(i.querySelector(".lg-object"),"lg-has-poster")&&"none"!==i.querySelector(".lg-object").style.display)if(utils.hasClass(i,"lg-has-video")){var t=i.querySelector(".lg-youtube"),r=i.querySelector(".lg-vimeo"),l=i.querySelector(".lg-dailymotion"),s=i.querySelector(".lg-html5");if(t)t.contentWindow.postMessage('{"event":"command","func":"playVideo","args":""}',"*");else if(r)try{$f(r).api("play")}catch(e){console.error("Make sure you have included froogaloop2 js")}else if(l)l.contentWindow.postMessage("play","*");else if(s)if(e.core.s.videojs)try{videojs(s).play()}catch(e){console.error("Make sure you have included videojs")}else s.play();utils.addClass(i,"lg-video-playing")}else{utils.addClass(i,"lg-video-playing"),utils.addClass(i,"lg-has-video");var a,d,c=function o(t,r){if(i.querySelector(".lg-video").insertAdjacentHTML("beforeend",e.loadVideo(t,"",!1,e.core.index,r)),r)if(e.core.s.videojs)try{videojs(e.core.___slide[e.core.index].querySelector(".lg-html5"),e.core.s.videojsOptions,function(){this.play()})}catch(e){console.error("Make sure you have included videojs")}else e.core.___slide[e.core.index].querySelector(".lg-html5").play()};e.core.s.dynamic?(a=e.core.s.dynamicEl[e.core.index].src,d=e.core.s.dynamicEl[e.core.index].html,c(a,d)):(a=e.core.items[e.core.index].getAttribute("href")||e.core.items[e.core.index].getAttribute("data-src"),d=e.core.items[e.core.index].getAttribute("data-html"),c(a,d));var n=i.querySelector(".lg-object");i.querySelector(".lg-video").appendChild(n),utils.hasClass(i.querySelector(".lg-video-object"),"lg-html5")||(utils.removeClass(i,"lg-complete"),utils.on(i.querySelector(".lg-video-object"),"load.lg error.lg",function(){utils.addClass(i,"lg-complete")}))}};if(e.core.doCss()&&e.core.items.length>1&&(e.core.s.enableSwipe&&e.core.isTouch||e.core.s.enableDrag&&!e.core.isTouch))utils.on(e.core.el,"onSlideClick.lgtm",function(){var i=e.core.___slide[e.core.index];o(i)});else for(var i=0;i<e.core.___slide.length;i++)!function(i){utils.on(e.core.___slide[i],"click.lg",function(){o(e.core.___slide[i])})}(i);utils.on(e.core.el,"onBeforeSlide.lgtm",function(o){var i=e.core.___slide[o.detail.prevIndex],t=i.querySelector(".lg-youtube"),r=i.querySelector(".lg-vimeo"),l=i.querySelector(".lg-dailymotion"),s=i.querySelector(".lg-vk"),a=i.querySelector(".lg-html5");if(t)t.contentWindow.postMessage('{"event":"command","func":"pauseVideo","args":""}',"*");else if(r)try{$f(r).api("pause")}catch(e){console.error("Make sure you have included froogaloop2 js")}else if(l)l.contentWindow.postMessage("pause","*");else if(a)if(e.core.s.videojs)try{videojs(a).pause()}catch(e){console.error("Make sure you have included videojs")}else a.pause();s&&s.setAttribute("src",s.getAttribute("src").replace("&autoplay","&noplay"));var d;d=e.core.s.dynamic?e.core.s.dynamicEl[o.detail.index].src:e.core.items[o.detail.index].getAttribute("href")||e.core.items[o.detail.index].getAttribute("data-src");var c=e.core.isVideo(d,o.detail.index)||{};(c.youtube||c.vimeo||c.dailymotion||c.vk)&&utils.addClass(e.core.outer,"lg-hide-download")}),utils.on(e.core.el,"onAfterSlide.lgtm",function(o){utils.removeClass(e.core.___slide[o.detail.prevIndex],"lg-video-playing")})},i.prototype.loadVideo=function(e,o,i,t,r){var l="",s=1,a="",d=this.core.isVideo(e,t)||{};i&&(s=this.videoLoaded?0:1);var c;c=this.core.s.dynamic?this.core.s.dynamicEl[t].title:this.core.items[t].getAttribute("title");var n=this.core.items[t].querySelector("img");if(n&&(c=c||n.getAttribute("alt")),c=c?'title="'+c+'"':"",d.youtube)a="?wmode=opaque&autoplay="+s+"&enablejsapi=1",this.core.s.youtubePlayerParams&&(a=a+"&"+utils.param(this.core.s.youtubePlayerParams)),l='<iframe class="lg-video-object lg-youtube '+o+'" '+c+' width="560" height="315" src="//www.youtube.com/embed/'+d.youtube[1]+a+'" frameborder="0" allowfullscreen></iframe>';else if(d.vimeo)a="?autoplay="+s+"&api=1",this.core.s.vimeoPlayerParams&&(a=a+"&"+utils.param(this.core.s.vimeoPlayerParams)),l='<iframe class="lg-video-object lg-vimeo '+o+'" '+c+' width="560" height="315"  src="//player.vimeo.com/video/'+d.vimeo[1]+a+'" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';else if(d.dailymotion)a="?wmode=opaque&autoplay="+s+"&api=postMessage",this.core.s.dailymotionPlayerParams&&(a=a+"&"+utils.param(this.core.s.dailymotionPlayerParams)),l='<iframe class="lg-video-object lg-dailymotion '+o+'" '+c+' width="560" height="315" src="//www.dailymotion.com/embed/video/'+d.dailymotion[1]+a+'" frameborder="0" allowfullscreen></iframe>';else if(d.html5){var u=r.substring(0,1);"."!==u&&"#"!==u||(r=document.querySelector(r).innerHTML),l=r}else d.vk&&(a="&autoplay="+s,this.core.s.vkPlayerParams&&(a=a+"&"+utils.param(this.core.s.vkPlayerParams)),l='<iframe class="lg-video-object lg-vk '+o+'" '+c+'  width="560" height="315" src="http://vk.com/video_ext.php?'+d.vk[1]+a+'" frameborder="0" allowfullscreen></iframe>');return l},i.prototype.destroy=function(){this.videoLoaded=!1},window.lgModules.video=i})},{}]},{},[1])(1)});
/*
 * Note that this is toastr v2.1.3, the "latest" version in url has no more maintenance,
 * please go to https://cdnjs.com/libraries/toastr.js and pick a certain version you want to use,
 * make sure you copy the url from the website since the url may change between versions.
 * */
!(function (e) {
    e(["jquery"], function (e) {
        return (function () {
            function t(e, t, n) {
                return g({ type: O.error, iconClass: m().iconClasses.error, message: e, optionsOverride: n, title: t });
            }
            function n(t, n) {
                return t || (t = m()), (v = e("#" + t.containerId)), v.length ? v : (n && (v = d(t)), v);
            }
            function o(e, t, n) {
                return g({ type: O.info, iconClass: m().iconClasses.info, message: e, optionsOverride: n, title: t });
            }
            function s(e) {
                C = e;
            }
            function i(e, t, n) {
                return g({ type: O.success, iconClass: m().iconClasses.success, message: e, optionsOverride: n, title: t });
            }
            function a(e, t, n) {
                return g({ type: O.warning, iconClass: m().iconClasses.warning, message: e, optionsOverride: n, title: t });
            }
            function r(e, t) {
                var o = m();
                v || n(o), u(e, o, t) || l(o);
            }
            function c(t) {
                var o = m();
                return v || n(o), t && 0 === e(":focus", t).length ? void h(t) : void (v.children().length && v.remove());
            }
            function l(t) {
                for (var n = v.children(), o = n.length - 1; o >= 0; o--) u(e(n[o]), t);
            }
            function u(t, n, o) {
                var s = !(!o || !o.force) && o.force;
                return (
                    !(!t || (!s && 0 !== e(":focus", t).length)) &&
                    (t[n.hideMethod]({
                        duration: n.hideDuration,
                        easing: n.hideEasing,
                        complete: function () {
                            h(t);
                        },
                    }),
                        !0)
                );
            }
            function d(t) {
                return (v = e("<div/>").attr("id", t.containerId).addClass(t.positionClass)), v.appendTo(e(t.target)), v;
            }
            function p() {
                return {
                    tapToDismiss: !0,
                    toastClass: "toast",
                    containerId: "toast-container",
                    debug: !1,
                    showMethod: "fadeIn",
                    showDuration: 100,
                    showEasing: "swing",
                    onShown: void 0,
                    hideMethod: "fadeOut",
                    hideDuration: 100,
                    hideEasing: "swing",
                    onHidden: void 0,
                    closeMethod: !1,
                    closeDuration: !1,
                    closeEasing: !1,
                    closeOnHover: !0,
                    extendedTimeOut: 1e3,
                    iconClasses: { error: "toast-error", info: "toast-info", success: "toast-success", warning: "toast-warning" },
                    iconClass: "toast-info",
                    positionClass: "toast-bottom-left",
                    timeOut: 15000,
                    titleClass: "toast-title",
                    messageClass: "toast-message",
                    escapeHtml: !1,
                    target: "body",
                    closeHtml: '<button type="button">&times;</button>',
                    closeClass: "toast-close-button",
                    newestOnTop: !0,
                    preventDuplicates: 1,
                    progressBar: 1,
                    progressClass: "toast-progress",
                    rtl: !1,
                };
            }
            function f(e) {
                C && C(e);
            }
            function g(t) {
                function o(e) {
                    return null == e && (e = ""), e.replace(/&/g, "&amp;").replace(/"/g, "&quot;").replace(/'/g, "&#39;").replace(/</g, "&lt;").replace(/>/g, "&gt;");
                }
                function s() {
                    c(), u(), d(), p(), g(), C(), l(), i();
                }
                function i() {
                    var e = "";
                    switch (t.iconClass) {
                        case "toast-success":
                        case "toast-info":
                            e = "polite";
                            break;
                        default:
                            e = "assertive";
                    }
                    I.attr("aria-live", e);
                }
                function a() {
                    E.closeOnHover && I.hover(H, D),
                    !E.onclick && E.tapToDismiss && I.click(b),
                    E.closeButton &&
                    j &&
                    j.click(function (e) {
                        e.stopPropagation ? e.stopPropagation() : void 0 !== e.cancelBubble && e.cancelBubble !== !0 && (e.cancelBubble = !0), E.onCloseClick && E.onCloseClick(e), b(!0);
                    }),
                    E.onclick &&
                    I.click(function (e) {
                        E.onclick(e), b();
                    });
                }
                function r() {
                    I.hide(),
                        I[E.showMethod]({ duration: E.showDuration, easing: E.showEasing, complete: E.onShown }),
                    E.timeOut > 0 && ((k = setTimeout(b, E.timeOut)), (F.maxHideTime = parseFloat(E.timeOut)), (F.hideEta = new Date().getTime() + F.maxHideTime), E.progressBar && (F.intervalId = setInterval(x, 10)));
                }
                function c() {
                    t.iconClass && I.addClass(E.toastClass).addClass(y);
                }
                function l() {
                    E.newestOnTop ? v.prepend(I) : v.append(I);
                }
                function u() {
                    if (t.title) {
                        var e = t.title;
                        E.escapeHtml && (e = o(t.title)), M.append(e).addClass(E.titleClass), I.append(M);
                    }
                }
                function d() {
                    if (t.message) {
                        var e = t.message;
                        E.escapeHtml && (e = o(t.message)), B.append(e).addClass(E.messageClass), I.append(B);
                    }
                }
                function p() {
                    E.closeButton && (j.addClass(E.closeClass).attr("role", "button"), I.prepend(j));
                }
                function g() {
                    E.progressBar && (q.addClass(E.progressClass), I.prepend(q));
                }
                function C() {
                    E.rtl && I.addClass("rtl");
                }
                function O(e, t) {
                    if (e.preventDuplicates) {
                        if (t.message === w) return !0;
                        w = t.message;
                    }
                    return !1;
                }
                function b(t) {
                    var n = t && E.closeMethod !== !1 ? E.closeMethod : E.hideMethod,
                        o = t && E.closeDuration !== !1 ? E.closeDuration : E.hideDuration,
                        s = t && E.closeEasing !== !1 ? E.closeEasing : E.hideEasing;
                    if (!e(":focus", I).length || t)
                        return (
                            clearTimeout(F.intervalId),
                                I[n]({
                                    duration: o,
                                    easing: s,
                                    complete: function () {
                                        h(I), clearTimeout(k), E.onHidden && "hidden" !== P.state && E.onHidden(), (P.state = "hidden"), (P.endTime = new Date()), f(P);
                                    },
                                })
                        );
                }
                function D() {
                    (E.timeOut > 0 || E.extendedTimeOut > 0) && ((k = setTimeout(b, E.extendedTimeOut)), (F.maxHideTime = parseFloat(E.extendedTimeOut)), (F.hideEta = new Date().getTime() + F.maxHideTime));
                }
                function H() {
                    clearTimeout(k), (F.hideEta = 0), I.stop(!0, !0)[E.showMethod]({ duration: E.showDuration, easing: E.showEasing });
                }
                function x() {
                    var e = ((F.hideEta - new Date().getTime()) / F.maxHideTime) * 100;
                    q.width(e + "%");
                }
                var E = m(),
                    y = t.iconClass || E.iconClass;
                if (("undefined" != typeof t.optionsOverride && ((E = e.extend(E, t.optionsOverride)), (y = t.optionsOverride.iconClass || y)), !O(E, t))) {
                    T++, (v = n(E, !0));
                    var k = null,
                        I = e("<div/>"),
                        M = e("<div/>"),
                        B = e("<div/>"),
                        q = e("<div/>"),
                        j = e(E.closeHtml),
                        F = { intervalId: null, hideEta: null, maxHideTime: null },
                        P = { toastId: T, state: "visible", startTime: new Date(), options: E, map: t };
                    return s(), r(), a(), f(P), E.debug && console && console.log(P), I;
                }
            }
            function m() {
                return e.extend({}, p(), b.options);
            }
            function h(e) {
                v || (v = n()), e.is(":visible") || (e.remove(), (e = null), 0 === v.children().length && (v.remove(), (w = void 0)));
            }
            var v,
                C,
                w,
                T = 0,
                O = { error: "error", info: "info", success: "success", warning: "warning" },
                b = { clear: r, remove: c, error: t, getContainer: n, info: o, options: {}, subscribe: s, success: i, version: "2.1.3", warning: a };
            return b;
        })();
    });
})(
    "function" == typeof define && define.amd
        ? define
        : function (e, t) {
            "undefined" != typeof module && module.exports ? (module.exports = t(require("jquery"))) : (window.toastr = t(window.jQuery));
        }
);
//# sourceMappingURL=toastr.js.map

"use strict";

function _typeof(e) {
    return (_typeof =
        "function" == typeof Symbol && "symbol" == typeof Symbol.iterator
            ? function (e) {
                  return typeof e;
              }
            : function (e) {
                  return e &&
                      "function" == typeof Symbol &&
                      e.constructor === Symbol &&
                      e !== Symbol.prototype
                      ? "symbol"
                      : typeof e;
              })(e);
}

function ownKeys(t, e) {
    var r = Object.keys(t);
    if (Object.getOwnPropertySymbols) {
        var n = Object.getOwnPropertySymbols(t);
        e &&
            (n = n.filter(function (e) {
                return Object.getOwnPropertyDescriptor(t, e).enumerable;
            })),
            r.push.apply(r, n);
    }
    return r;
}

function _objectSpread(t) {
    for (var e = 1; e < arguments.length; e++) {
        var r = null != arguments[e] ? arguments[e] : {};
        e % 2
            ? ownKeys(Object(r), !0).forEach(function (e) {
                  _defineProperty(t, e, r[e]);
              })
            : Object.getOwnPropertyDescriptors
            ? Object.defineProperties(t, Object.getOwnPropertyDescriptors(r))
            : ownKeys(Object(r)).forEach(function (e) {
                  Object.defineProperty(
                      t,
                      e,
                      Object.getOwnPropertyDescriptor(r, e)
                  );
              });
    }
    return t;
}

function _defineProperty(e, t, r) {
    return (
        t in e
            ? Object.defineProperty(e, t, {
                  value: r,
                  enumerable: !0,
                  configurable: !0,
                  writable: !0,
              })
            : (e[t] = r),
        e
    );
}

!(function (t) {
    var e = {
        init: function () {
            e.masonryGrid(),
                e.stickyNavbar(),
                e.stuckNavbarMenuToggle(),
                e.passwordVisibilityToggle(),
                e.customFileInput(),
                e.fileDropArea(),
                e.formValidation(),
                e.multilevelDropdown(),
                e.smoothScroll(),
                e.scrollTopButton(),
                e.offcanvasSidebar(),
                e.tooltips(),
                e.popovers(),
                e.toasts(),
                e.disableDropdownAutohide(),
                e.carousel(),
                e.gallery(),
                e.productGallery(),
                e.imageZoom(),
                e.videoPopupBtn(),
                e.ajaxifySubscribeForm(),
                e.rangeSlider(),
                e.filterList(),
                e.dataFilter(),
                e.labelUpdate(),
                e.radioTabs(),
                e.countdown(),
                e.creditCard(),
                e.charts();
        },
        masonryGrid: function () {
            var e,
                t = document.querySelectorAll(".cz-masonry-grid");
            if (null !== t)
                for (var r = 0; r < t.length; r++)
                    (e = new Shuffle(t[r], {
                        itemSelector: ".grid-item",
                        sizer: ".grid-item",
                    })),
                        imagesLoaded(t[r]).on("progress", function () {
                            e.layout();
                        });
        },
        stickyNavbar: function () {
            var t = document.querySelector(".navbar-sticky");
            if (null != t) {
                var e = t.classList,
                    r = t.offsetHeight;
                e.contains("navbar-floating") && e.contains("navbar-dark")
                    ? window.addEventListener("scroll", function (e) {
                          100 < e.currentTarget.pageYOffset
                              ? (t.classList.remove("navbar-dark"),
                                t.classList.add("navbar-light", "navbar-stuck"))
                              : (t.classList.remove(
                                    "navbar-light",
                                    "navbar-stuck"
                                ),
                                t.classList.add("navbar-dark"));
                      })
                    : e.contains("navbar-floating") &&
                      e.contains("navbar-light")
                    ? window.addEventListener("scroll", function (e) {
                          100 < e.currentTarget.pageYOffset
                              ? t.classList.add("navbar-stuck")
                              : t.classList.remove("navbar-stuck");
                      })
                    : window.addEventListener("scroll", function (e) {
                          100 < e.currentTarget.pageYOffset
                              ? ((document.body.style.paddingTop = r + "px"),
                                t.classList.add("navbar-stuck"))
                              : ((document.body.style.paddingTop = ""),
                                t.classList.remove("navbar-stuck"));
                      });
            }
        },
        stuckNavbarMenuToggle: function () {
            var e = document.querySelector(".navbar-stuck-toggler"),
                t = document.querySelector(".navbar-stuck-menu");
            e.addEventListener("click", function (e) {
                t.classList.toggle("show"), e.preventDefault();
                this.classList.toggle("show");
            });
        },
        passwordVisibilityToggle: function () {
            for (
                var r = document.querySelectorAll(".password-toggle"),
                    e = function (e) {
                        var t = r[e].querySelector(".form-control");
                        r[e]
                            .querySelector(".password-toggle-btn")
                            .addEventListener(
                                "click",
                                function (e) {
                                    "checkbox" === e.target.type &&
                                        (e.target.checked
                                            ? (t.type = "text")
                                            : (t.type = "password"));
                                },
                                !1
                            );
                    },
                    t = 0;
                t < r.length;
                t++
            )
                e(t);
        },
        customFileInput: function () {
            bsCustomFileInput.init();
        },
        fileDropArea: function () {
            for (
                var t = document.querySelectorAll(".cz-file-drop-area"),
                    e = function (e) {
                        var o = t[e].querySelector(".cz-file-drop-input"),
                            a = t[e].querySelector(".cz-file-drop-message"),
                            i = t[e].querySelector(".cz-file-drop-icon");
                        t[e]
                            .querySelector(".cz-file-drop-btn")
                            .addEventListener("click", function () {
                                o.click();
                            }),
                            o.addEventListener("change", function () {
                                if (o.files && o.files[0]) {
                                    var e = new FileReader();
                                    (e.onload = function (e) {
                                        var t = e.target.result,
                                            r = o.files[0].name;
                                        if (
                                            ((a.innerHTML = r),
                                            t.startsWith("data:image"))
                                        ) {
                                            var n = new Image();
                                            (n.src = t),
                                                (n.onload = function () {
                                                    (i.className =
                                                        "cz-file-drop-preview img-thumbnail rounded"),
                                                        (i.innerHTML =
                                                            '<img src="' +
                                                            n.src +
                                                            '" alt="' +
                                                            r +
                                                            '">'),
                                                        console.log(this.width);
                                                });
                                        } else
                                            t.startsWith("data:video")
                                                ? ((i.innerHTML = ""),
                                                  (i.className = ""),
                                                  (i.className =
                                                      "cz-file-drop-icon czi-video"))
                                                : ((i.innerHTML = ""),
                                                  (i.className = ""),
                                                  (i.className =
                                                      "cz-file-drop-icon czi-document"));
                                    }),
                                        e.readAsDataURL(o.files[0]);
                                }
                            });
                    },
                    r = 0;
                r < t.length;
                r++
            )
                e(r);
        },
        formValidation: function () {
            window.addEventListener(
                "load",
                function () {
                    var e = document.getElementsByClassName("needs-validation");
                    Array.prototype.filter.call(e, function (t) {
                        t.addEventListener(
                            "submit",
                            function (e) {
                                !1 === t.checkValidity() &&
                                    (e.preventDefault(), e.stopPropagation()),
                                    t.classList.add("was-validated");
                            },
                            !1
                        );
                    });
                },
                !1
            );
        },
        multilevelDropdown: function () {
            t(".dropdown-menu [data-toggle='dropdown']").on(
                "click",
                function (e) {
                    e.preventDefault(),
                        e.stopPropagation(),
                        t(this).siblings().toggleClass("show"),
                        t(this).next().hasClass("show") ||
                            t(this)
                                .parents(".dropdown-menu")
                                .first()
                                .find(".show")
                                .removeClass("show"),
                        t(this)
                            .parents("li.nav-item.dropdown.show")
                            .on("hidden.bs.dropdown", function () {
                                t(".dropdown-submenu .show").removeClass(
                                    "show"
                                );
                            });
                }
            );
        },
        smoothScroll: function () {
            new SmoothScroll("[data-scroll]", {
                speed: 800,
                speedAsDuration: !0,
                offset: 40,
                header: "[data-scroll-header]",
                updateURL: !1,
            });
        },
        scrollTopButton: function () {
            var t = document.querySelector(".btn-scroll-top");
            if (null != t) {
                var r = parseInt(600, 10);
                window.addEventListener("scroll", function (e) {
                    e.currentTarget.pageYOffset > r
                        ? t.classList.add("show")
                        : t.classList.remove("show");
                });
            }
        },
        offcanvasSidebar: function () {
            for (
                var e = document.querySelectorAll('[data-toggle="sidebar"]'),
                    t = document.querySelectorAll('[data-dismiss="sidebar"]'),
                    r = document.querySelector("body"),
                    n = 0;
                n < e.length;
                n++
            )
                e[n].addEventListener("click", function (e) {
                    e.preventDefault();
                    var t = e.currentTarget.getAttribute("href");
                    document.querySelector(t).classList.add("show"),
                        r.classList.add("offcanvas-open");
                });
            for (var o = 0; o < t.length; o++)
                t[o].addEventListener("click", function (e) {
                    e.currentTarget
                        .closest(".cz-sidebar")
                        .classList.remove("show"),
                        r.classList.remove("offcanvas-open");
                });
        },
        tooltips: function () {
            t('[data-toggle="tooltip"]').tooltip();
        },
        popovers: function () {
            t('[data-toggle="popover"]').popover();
        },
        toasts: function () {
            t('[data-toggle="toast"]').on("click", function () {
                var e = t(this).data("target");
                t(e).toast("show");
            });
        },
        disableDropdownAutohide: function () {
            for (
                var e = document.querySelectorAll(
                        ".disable-autohide .custom-select"
                    ),
                    t = 0;
                t < e.length;
                t++
            )
                e[t].addEventListener("click", function (e) {
                    e.stopPropagation();
                });
        },
        carousel: function () {
            !(function (e, t, r) {
                for (var n = 0; n < e.length; n++) t.call(r, n, e[n]);
            })(
                document.querySelectorAll(".cz-carousel .cz-carousel-inner"),
                function (e, t) {
                    var r,
                        n = {
                            container: t,
                            controlsText: [
                                '<i class="czi-arrow-left"></i>',
                                '<i class="czi-arrow-right"></i>',
                            ],
                            navPosition: "bottom",
                            mouseDrag: !0,
                            speed: 500,
                            autoplayHoverPause: !0,
                            autoplayButtonOutput: !1,
                        };
                    null != t.dataset.carouselOptions &&
                        (r = JSON.parse(t.dataset.carouselOptions));
                    var o = _objectSpread(_objectSpread({}, n), r);
                    tns(o);
                }
            );
        },
        gallery: function () {
            var e = document.querySelectorAll(".cz-gallery");
            if (e.length)
                for (var t = 0; t < e.length; t++)
                    lightGallery(e[t], {
                        selector: ".gallery-item",
                        download: !1,
                        videojs: !0,
                        youtubePlayerParams: {
                            modestbranding: 1,
                            showinfo: 0,
                            rel: 0,
                            controls: 0,
                        },
                        vimeoPlayerParams: {
                            byline: 0,
                            portrait: 0,
                            color: "fe696a",
                        },
                    });
        },
        productGallery: function () {
            var s = document.querySelectorAll(".cz-product-gallery");
            if (s.length)
                for (
                    var e = function (r) {
                            for (
                                var n = s[r].querySelectorAll(
                                        ".cz-thumblist-item:not(.video-item)"
                                    ),
                                    o =
                                        s[r].querySelectorAll(
                                            ".cz-preview-item"
                                        ),
                                    e = s[r].querySelectorAll(
                                        ".cz-thumblist-item.video-item"
                                    ),
                                    t = 0;
                                t < n.length;
                                t++
                            )
                                n[t].addEventListener("click", a);

                            function a(e) {
                                e.preventDefault();
                                for (var t = 0; t < n.length; t++)
                                    o[t].classList.remove("active"),
                                        n[t].classList.remove("active");
                                this.classList.add("active"),
                                    s[r]
                                        .querySelector(
                                            this.getAttribute("href")
                                        )
                                        .classList.add("active");
                            }

                            for (var i = 0; i < e.length; i++)
                                lightGallery(e[i], {
                                    selector: "this",
                                    download: !1,
                                    videojs: !0,
                                    youtubePlayerParams: {
                                        modestbranding: 1,
                                        showinfo: 0,
                                        rel: 0,
                                        controls: 0,
                                    },
                                    vimeoPlayerParams: {
                                        byline: 0,
                                        portrait: 0,
                                        color: "fe696a",
                                    },
                                });
                        },
                        t = 0;
                    t < s.length;
                    t++
                )
                    e(t);
        },
        imageZoom: function () {
            for (
                var e = document.querySelectorAll(".cz-image-zoom"), t = 0;
                t < e.length;
                t++
            )
                new Drift(e[t], {
                    paneContainer: e[t].parentElement.querySelector(
                        ".cz-image-zoom-pane"
                    ),
                });
        },
        videoPopupBtn: function () {
            var e = document.querySelectorAll(".video-popup-btn");
            if (e.length)
                for (var t = 0; t < e.length; t++)
                    lightGallery(e[t], {
                        selector: "this",
                        download: !1,
                        videojs: !0,
                        youtubePlayerParams: {
                            modestbranding: 1,
                            showinfo: 0,
                            rel: 0,
                            controls: 0,
                        },
                        vimeoPlayerParams: {
                            byline: 0,
                            portrait: 0,
                            color: "fe696a",
                        },
                    });
        },
        ajaxifySubscribeForm: function () {
            var i = document.querySelectorAll(".cz-subscribe-form");
            if (null !== i) {
                for (
                    var e = function (e) {
                            var t = i[e].querySelector('button[type="submit"]'),
                                r = t.innerHTML,
                                n = i[e].querySelector(".form-control"),
                                o = i[e].querySelector(
                                    ".cz-subscribe-form-antispam"
                                ),
                                a = i[e].querySelector(".subscribe-status");
                            i[e].addEventListener("submit", function (e) {
                                e && e.preventDefault(),
                                    "" === o.value && s(this, t, n, r, a);
                            });
                        },
                        t = 0;
                    t < i.length;
                    t++
                )
                    e(t);
                var s = function (e, t, r, n, o) {
                    t.innerHTML = "Sending...";
                    var a = e.action.replace("/post?", "/post-json?"),
                        i = "&" + r.name + "=" + encodeURIComponent(r.value),
                        s = document.createElement("script");
                    (s.src = a + "&c=callback" + i),
                        document.body.appendChild(s);
                    var c = "callback";
                    window[c] = function (e) {
                        delete window[c],
                            document.body.removeChild(s),
                            (t.innerHTML = n),
                            "success" == e.result
                                ? (r.classList.remove("is-invalid"),
                                  r.classList.add("is-valid"),
                                  o.classList.remove("status-error"),
                                  o.classList.add("status-success"),
                                  (o.innerHTML = e.msg),
                                  setTimeout(function () {
                                      r.classList.remove("is-valid"),
                                          (o.innerHTML = ""),
                                          o.classList.remove("status-success");
                                  }, 6e3))
                                : (r.classList.remove("is-valid"),
                                  r.classList.add("is-invalid"),
                                  o.classList.remove("status-success"),
                                  o.classList.add("status-error"),
                                  (o.innerHTML = e.msg.substring(4)),
                                  setTimeout(function () {
                                      r.classList.remove("is-invalid"),
                                          (o.innerHTML = ""),
                                          o.classList.remove("status-error");
                                  }, 6e3));
                    };
                };
            }
        },
        rangeSlider: function () {
            for (
                var a = document.querySelectorAll(".cz-range-slider"),
                    e = function (e) {
                        var t = a[e].querySelector(".cz-range-slider-ui"),
                            n = a[e].querySelector(
                                ".cz-range-slider-value-min"
                            ),
                            o = a[e].querySelector(
                                ".cz-range-slider-value-max"
                            ),
                            r = {
                                dataStartMin: parseInt(
                                    a[e].dataset.startMin,
                                    10
                                ),
                                dataStartMax: parseInt(
                                    a[e].dataset.startMax,
                                    10
                                ),
                                dataMin: parseInt(a[e].dataset.min, 10),
                                dataMax: parseInt(a[e].dataset.max, 10),
                                dataStep: parseInt(a[e].dataset.step, 10),
                            };
                        noUiSlider.create(t, {
                            start: [r.dataStartMin, r.dataStartMax],
                            connect: !0,
                            step: r.dataStep,
                            pips: { mode: "count", values: 5 },
                            tooltips: !0,
                            range: { min: r.dataMin, max: r.dataMax },
                            format: {
                                to: function (e) {
                                    return "$" + parseInt(e, 10);
                                },
                                from: function (e) {
                                    return Number(e);
                                },
                            },
                        }),
                            t.noUiSlider.on("update", function (e, t) {
                                var r = e[t];
                                (r = r.replace(/\D/g, "")),
                                    t
                                        ? (o.value = Math.round(r))
                                        : (n.value = Math.round(r));
                            }),
                            n.addEventListener("change", function () {
                                t.noUiSlider.set([this.value, null]);
                            }),
                            o.addEventListener("change", function () {
                                t.noUiSlider.set([null, this.value]);
                            });
                    },
                    t = 0;
                t < a.length;
                t++
            )
                e(t);
        },
        filterList: function () {
            for (
                var t = document.querySelectorAll(".cz-filter"),
                    e = function (e) {
                        var r = t[e].querySelector(".cz-filter-search"),
                            n = t[e]
                                .querySelector(".cz-filter-list")
                                .querySelectorAll(".cz-filter-item");
                        if (!r) return "continue";
                        r.addEventListener("keyup", function () {
                            for (
                                var e = r.value.toLowerCase(), t = 0;
                                t < n.length;
                                t++
                            ) {
                                -1 <
                                n[t]
                                    .querySelector(".cz-filter-item-text")
                                    .innerHTML.toLowerCase()
                                    .indexOf(e)
                                    ? n[t].classList.remove("d-none")
                                    : n[t].classList.add("d-none");
                            }
                        });
                    },
                    r = 0;
                r < t.length;
                r++
            )
                e(r);
        },
        dataFilter: function () {
            var e = document.querySelector('[data-filter="trigger"]'),
                n = document.querySelectorAll('[data-filter="target"]');
            null !== e &&
                e.addEventListener("change", function () {
                    var e =
                        this.options[this.selectedIndex].value.toLowerCase();
                    if ("all" === e)
                        for (var t = 0; t < n.length; t++)
                            n[t].classList.remove("d-none");
                    else {
                        for (var r = 0; r < n.length; r++)
                            n[r].classList.add("d-none");
                        document
                            .querySelector("#" + e)
                            .classList.remove("d-none");
                    }
                });
        },
        labelUpdate: function () {
            for (
                var e = document.querySelectorAll("[data-label]"), t = 0;
                t < e.length;
                t++
            )
                e[t].addEventListener("change", function () {
                    var e = this.dataset.label;
                    try {
                        document.getElementById(e).textContent = this.value;
                    } catch (e) {
                        (e.message =
                            "Cannot set property 'textContent' of null"),
                            console.error(
                                "Make sure the [data-label] matches with the id of the target element you want to change text of!"
                            );
                    }
                });
        },
        radioTabs: function () {
            for (
                var e = document.querySelectorAll('[data-toggle="radioTab"]'),
                    t = 0;
                t < e.length;
                t++
            )
                e[t].addEventListener("click", function () {
                    var e = this.dataset.target;
                    document
                        .querySelector(this.dataset.parent)
                        .querySelectorAll(".radio-tab-pane")
                        .forEach(function (e) {
                            e.classList.remove("active");
                        }),
                        document.querySelector(e).classList.add("active");
                });
        },
        countdown: function () {
            var t = document.querySelectorAll(".cz-countdown");
            if (null != t)
                for (
                    var e = function (e) {
                            var r = t[e].dataset.countdown,
                                n = t[e].querySelector(
                                    ".cz-countdown-days .cz-countdown-value"
                                ),
                                o = t[e].querySelector(
                                    ".cz-countdown-hours .cz-countdown-value"
                                ),
                                a = t[e].querySelector(
                                    ".cz-countdown-minutes .cz-countdown-value"
                                ),
                                i = t[e].querySelector(
                                    ".cz-countdown-seconds .cz-countdown-value"
                                ),
                                s = void 0,
                                c = void 0,
                                l = void 0,
                                d = void 0;
                            if (((r = new Date(r).getTime()), isNaN(r)))
                                return { v: void 0 };
                            setInterval(function () {
                                var e = new Date().getTime(),
                                    t = parseInt((r - e) / 1e3);
                                {
                                    if (!(0 <= t)) return;
                                    (s = parseInt(t / 86400)),
                                        (t %= 86400),
                                        (c = parseInt(t / 3600)),
                                        (t %= 3600),
                                        (l = parseInt(t / 60)),
                                        (t %= 60),
                                        (d = parseInt(t)),
                                        null != n &&
                                            (n.innerHTML = parseInt(s, 10)),
                                        null != o &&
                                            (o.innerHTML =
                                                c < 10 ? "0" + c : c),
                                        null != a &&
                                            (a.innerHTML =
                                                l < 10 ? "0" + l : l),
                                        null != i &&
                                            (i.innerHTML =
                                                d < 10 ? "0" + d : d);
                                }
                            }, 1e3);
                        },
                        r = 0;
                    r < t.length;
                    r++
                ) {
                    var n = e(r);
                    if ("object" === _typeof(n)) return n.v;
                }
        },
        creditCard: function () {
            var e = document.querySelector(".interactive-credit-card");
            if (null !== e) new Card({ form: e, container: ".card-wrapper" });
        },
        charts: function () {
            function a(e, t) {
                return e + t;
            }

            var e = document.querySelectorAll("[data-line-chart]"),
                t = document.querySelectorAll("[data-bar-chart]"),
                i = document.querySelectorAll("[data-pie-chart]");
            if (0 !== e.length || 0 !== t.length || 0 !== i.length) {
                var s,
                    r =
                        document.head ||
                        document.getElementsByTagName("head")[0],
                    c = document.createElement("style");
                r.appendChild(c);
                for (var n = 0; n < e.length; n++) {
                    var o = JSON.parse(e[n].dataset.lineChart),
                        l =
                            null != e[n].dataset.options
                                ? JSON.parse(e[n].dataset.options)
                                : "",
                        d = e[n].dataset.seriesColor,
                        u = void 0;
                    if ((e[n].classList.add("cz-line-chart-" + n), null != d)) {
                        u = JSON.parse(d);
                        for (var f = 0; f < u.colors.length; f++)
                            (s = "\n              .cz-line-chart-"
                                .concat(n, " .ct-series:nth-child(")
                                .concat(
                                    f + 1,
                                    ") .ct-line,\n              .cz-line-chart-"
                                )
                                .concat(n, " .ct-series:nth-child(")
                                .concat(
                                    f + 1,
                                    ") .ct-point {\n                stroke: "
                                )
                                .concat(
                                    u.colors[f],
                                    " !important;\n              }\n            "
                                )),
                                c.appendChild(document.createTextNode(s));
                    }
                    new Chartist.Line(e[n], o, l);
                }
                for (var v = 0; v < t.length; v++) {
                    var p = JSON.parse(t[v].dataset.barChart),
                        m =
                            null != t[v].dataset.options
                                ? JSON.parse(t[v].dataset.options)
                                : "",
                        g = t[v].dataset.seriesColor,
                        h = void 0;
                    if ((t[v].classList.add("cz-bar-chart-" + v), null != g)) {
                        h = JSON.parse(g);
                        for (var y = 0; y < h.colors.length; y++)
                            (s = "\n            .cz-bar-chart-"
                                .concat(v, " .ct-series:nth-child(")
                                .concat(
                                    y + 1,
                                    ") .ct-bar {\n                stroke: "
                                )
                                .concat(
                                    h.colors[y],
                                    " !important;\n              }\n            "
                                )),
                                c.appendChild(document.createTextNode(s));
                    }
                    new Chartist.Bar(t[v], p, m);
                }
                for (
                    var b = function (e) {
                            var t = JSON.parse(i[e].dataset.pieChart),
                                r = i[e].dataset.seriesColor,
                                n = void 0;
                            if (
                                (i[e].classList.add("cz-pie-chart-" + e),
                                null != r)
                            ) {
                                n = JSON.parse(r);
                                for (var o = 0; o < n.colors.length; o++)
                                    (s = "\n            .cz-pie-chart-"
                                        .concat(e, " .ct-series:nth-child(")
                                        .concat(
                                            o + 1,
                                            ") .ct-slice-pie {\n                fill: "
                                        )
                                        .concat(
                                            n.colors[o],
                                            " !important;\n              }\n            "
                                        )),
                                        c.appendChild(
                                            document.createTextNode(s)
                                        );
                            }
                            new Chartist.Pie(i[e], t, {
                                labelInterpolationFnc: function (e) {
                                    return (
                                        Math.round(
                                            (e / t.series.reduce(a)) * 100
                                        ) + "%"
                                    );
                                },
                            });
                        },
                        S = 0;
                    S < i.length;
                    S++
                )
                    b(S);
            }
        },
    };
    e.init();
})(jQuery);

!function (i) {
    "use strict";
    "function" == typeof define && define.amd ? define(["jquery"], i) : "undefined" != typeof exports ? module.exports = i(require("jquery")) : i(jQuery)
}(function (i) {
    "use strict";
    var e = window.Slick || {};
    (e = function () {
        var e = 0;
        return function (t, o) {
            var s, n = this;
            n.defaults = {
                accessibility: !0,
                adaptiveHeight: !1,
                appendArrows: i(t),
                appendDots: i(t),
                arrows: !0,
                asNavFor: null,
                prevArrow: '<button class="slick-prev" aria-label="Previous" type="button">Previous</button>',
                nextArrow: '<button class="slick-next" aria-label="Next" type="button">Next</button>',
                autoplay: !1,
                autoplaySpeed: 3e3,
                centerMode: !1,
                centerPadding: "50px",
                cssEase: "ease",
                customPaging: function (e, t) {
                    return i('<button type="button" />').text(t + 1)
                },
                dots: !1,
                dotsClass: "slick-dots",
                draggable: !0,
                easing: "linear",
                edgeFriction: .35,
                fade: !1,
                focusOnSelect: !1,
                focusOnChange: !1,
                infinite: !0,
                initialSlide: 0,
                lazyLoad: "ondemand",
                mobileFirst: !1,
                pauseOnHover: !0,
                pauseOnFocus: !0,
                pauseOnDotsHover: !1,
                respondTo: "window",
                responsive: null,
                rows: 1,
                rtl: !1,
                slide: "",
                slidesPerRow: 1,
                slidesToShow: 1,
                slidesToScroll: 1,
                speed: 500,
                swipe: !0,
                swipeToSlide: !1,
                touchMove: !0,
                touchThreshold: 5,
                useCSS: !0,
                useTransform: !0,
                variableWidth: !1,
                vertical: !1,
                verticalSwiping: !1,
                waitForAnimate: !0,
                zIndex: 1e3
            }, n.initials = {
                animating: !1,
                dragging: !1,
                autoPlayTimer: null,
                currentDirection: 0,
                currentLeft: null,
                currentSlide: 0,
                direction: 1,
                $dots: null,
                listWidth: null,
                listHeight: null,
                loadIndex: 0,
                $nextArrow: null,
                $prevArrow: null,
                scrolling: !1,
                slideCount: null,
                slideWidth: null,
                $slideTrack: null,
                $slides: null,
                sliding: !1,
                slideOffset: 0,
                swipeLeft: null,
                swiping: !1,
                $list: null,
                touchObject: {},
                transformsEnabled: !1,
                unslicked: !1
            }, i.extend(n, n.initials), n.activeBreakpoint = null, n.animType = null, n.animProp = null, n.breakpoints = [], n.breakpointSettings = [], n.cssTransitions = !1, n.focussed = !1, n.interrupted = !1, n.hidden = "hidden", n.paused = !0, n.positionProp = null, n.respondTo = null, n.rowCount = 1, n.shouldClick = !0, n.$slider = i(t), n.$slidesCache = null, n.transformType = null, n.transitionType = null, n.visibilityChange = "visibilitychange", n.windowWidth = 0, n.windowTimer = null, s = i(t).data("slick") || {}, n.options = i.extend({}, n.defaults, o, s), n.currentSlide = n.options.initialSlide, n.originalSettings = n.options, void 0 !== document.mozHidden ? (n.hidden = "mozHidden", n.visibilityChange = "mozvisibilitychange") : void 0 !== document.webkitHidden && (n.hidden = "webkitHidden", n.visibilityChange = "webkitvisibilitychange"), n.autoPlay = i.proxy(n.autoPlay, n), n.autoPlayClear = i.proxy(n.autoPlayClear, n), n.autoPlayIterator = i.proxy(n.autoPlayIterator, n), n.changeSlide = i.proxy(n.changeSlide, n), n.clickHandler = i.proxy(n.clickHandler, n), n.selectHandler = i.proxy(n.selectHandler, n), n.setPosition = i.proxy(n.setPosition, n), n.swipeHandler = i.proxy(n.swipeHandler, n), n.dragHandler = i.proxy(n.dragHandler, n), n.keyHandler = i.proxy(n.keyHandler, n), n.instanceUid = e++, n.htmlExpr = /^(?:\s*(<[\w\W]+>)[^>]*)$/, n.registerBreakpoints(), n.init(!0)
        }
    }()).prototype.activateADA = function () {
        this.$slideTrack.find(".slick-active").attr({"aria-hidden": "false"}).find("a, input, button, select").attr({tabindex: "0"})
    }, e.prototype.addSlide = e.prototype.slickAdd = function (e, t, o) {
        var s = this;
        if ("boolean" == typeof t) o = t, t = null; else if (t < 0 || t >= s.slideCount) return !1;
        s.unload(), "number" == typeof t ? 0 === t && 0 === s.$slides.length ? i(e).appendTo(s.$slideTrack) : o ? i(e).insertBefore(s.$slides.eq(t)) : i(e).insertAfter(s.$slides.eq(t)) : !0 === o ? i(e).prependTo(s.$slideTrack) : i(e).appendTo(s.$slideTrack), s.$slides = s.$slideTrack.children(this.options.slide), s.$slideTrack.children(this.options.slide).detach(), s.$slideTrack.append(s.$slides), s.$slides.each(function (e, t) {
            i(t).attr("data-slick-index", e)
        }), s.$slidesCache = s.$slides, s.reinit()
    }, e.prototype.animateHeight = function () {
        var i = this;
        if (1 === i.options.slidesToShow && !0 === i.options.adaptiveHeight && !1 === i.options.vertical) {
            var e = i.$slides.eq(i.currentSlide).outerHeight(!0);
            i.$list.animate({height: e}, i.options.speed)
        }
    }, e.prototype.animateSlide = function (e, t) {
        var o = {}, s = this;
        s.animateHeight(), !0 === s.options.rtl && !1 === s.options.vertical && (e = -e), !1 === s.transformsEnabled ? !1 === s.options.vertical ? s.$slideTrack.animate({left: e}, s.options.speed, s.options.easing, t) : s.$slideTrack.animate({top: e}, s.options.speed, s.options.easing, t) : !1 === s.cssTransitions ? (!0 === s.options.rtl && (s.currentLeft = -s.currentLeft), i({animStart: s.currentLeft}).animate({animStart: e}, {
            duration: s.options.speed,
            easing: s.options.easing,
            step: function (i) {
                i = Math.ceil(i), !1 === s.options.vertical ? (o[s.animType] = "translate(" + i + "px, 0px)", s.$slideTrack.css(o)) : (o[s.animType] = "translate(0px," + i + "px)", s.$slideTrack.css(o))
            },
            complete: function () {
                t && t.call()
            }
        })) : (s.applyTransition(), e = Math.ceil(e), !1 === s.options.vertical ? o[s.animType] = "translate3d(" + e + "px, 0px, 0px)" : o[s.animType] = "translate3d(0px," + e + "px, 0px)", s.$slideTrack.css(o), t && setTimeout(function () {
            s.disableTransition(), t.call()
        }, s.options.speed))
    }, e.prototype.getNavTarget = function () {
        var e = this, t = e.options.asNavFor;
        return t && null !== t && (t = i(t).not(e.$slider)), t
    }, e.prototype.asNavFor = function (e) {
        var t = this.getNavTarget();
        null !== t && "object" == typeof t && t.each(function () {
            var t = i(this).slick("getSlick");
            t.unslicked || t.slideHandler(e, !0)
        })
    }, e.prototype.applyTransition = function (i) {
        var e = this, t = {};
        !1 === e.options.fade ? t[e.transitionType] = e.transformType + " " + e.options.speed + "ms " + e.options.cssEase : t[e.transitionType] = "opacity " + e.options.speed + "ms " + e.options.cssEase, !1 === e.options.fade ? e.$slideTrack.css(t) : e.$slides.eq(i).css(t)
    }, e.prototype.autoPlay = function () {
        var i = this;
        i.autoPlayClear(), i.slideCount > i.options.slidesToShow && (i.autoPlayTimer = setInterval(i.autoPlayIterator, i.options.autoplaySpeed))
    }, e.prototype.autoPlayClear = function () {
        var i = this;
        i.autoPlayTimer && clearInterval(i.autoPlayTimer)
    }, e.prototype.autoPlayIterator = function () {
        var i = this, e = i.currentSlide + i.options.slidesToScroll;
        i.paused || i.interrupted || i.focussed || (!1 === i.options.infinite && (1 === i.direction && i.currentSlide + 1 === i.slideCount - 1 ? i.direction = 0 : 0 === i.direction && (e = i.currentSlide - i.options.slidesToScroll, i.currentSlide - 1 == 0 && (i.direction = 1))), i.slideHandler(e))
    }, e.prototype.buildArrows = function () {
        var e = this;
        !0 === e.options.arrows && (e.$prevArrow = i(e.options.prevArrow).addClass("slick-arrow"), e.$nextArrow = i(e.options.nextArrow).addClass("slick-arrow"), e.slideCount > e.options.slidesToShow ? (e.$prevArrow.removeClass("slick-hidden").removeAttr("aria-hidden tabindex"), e.$nextArrow.removeClass("slick-hidden").removeAttr("aria-hidden tabindex"), e.htmlExpr.test(e.options.prevArrow) && e.$prevArrow.prependTo(e.options.appendArrows), e.htmlExpr.test(e.options.nextArrow) && e.$nextArrow.appendTo(e.options.appendArrows), !0 !== e.options.infinite && e.$prevArrow.addClass("slick-disabled").attr("aria-disabled", "true")) : e.$prevArrow.add(e.$nextArrow).addClass("slick-hidden").attr({
            "aria-disabled": "true",
            tabindex: "-1"
        }))
    }, e.prototype.buildDots = function () {
        var e, t, o = this;
        if (!0 === o.options.dots) {
            for (o.$slider.addClass("slick-dotted"), t = i("<ul />").addClass(o.options.dotsClass), e = 0; e <= o.getDotCount(); e += 1) t.append(i("<li />").append(o.options.customPaging.call(this, o, e)));
            o.$dots = t.appendTo(o.options.appendDots), o.$dots.find("li").first().addClass("slick-active")
        }
    }, e.prototype.buildOut = function () {
        var e = this;
        e.$slides = e.$slider.children(e.options.slide + ":not(.slick-cloned)").addClass("slick-slide"), e.slideCount = e.$slides.length, e.$slides.each(function (e, t) {
            i(t).attr("data-slick-index", e).data("originalStyling", i(t).attr("style") || "")
        }), e.$slider.addClass("slick-slider"), e.$slideTrack = 0 === e.slideCount ? i('<div class="slick-track"/>').appendTo(e.$slider) : e.$slides.wrapAll('<div class="slick-track"/>').parent(), e.$list = e.$slideTrack.wrap('<div class="slick-list"/>').parent(), e.$slideTrack.css("opacity", 0), !0 !== e.options.centerMode && !0 !== e.options.swipeToSlide || (e.options.slidesToScroll = 1), i("img[data-lazy]", e.$slider).not("[src]").addClass("slick-loading"), e.setupInfinite(), e.buildArrows(), e.buildDots(), e.updateDots(), e.setSlideClasses("number" == typeof e.currentSlide ? e.currentSlide : 0), !0 === e.options.draggable && e.$list.addClass("draggable")
    }, e.prototype.buildRows = function () {
        var i, e, t, o, s, n, r, l = this;
        if (o = document.createDocumentFragment(), n = l.$slider.children(), l.options.rows > 1) {
            for (r = l.options.slidesPerRow * l.options.rows, s = Math.ceil(n.length / r), i = 0; i < s; i++) {
                var d = document.createElement("div");
                for (e = 0; e < l.options.rows; e++) {
                    var a = document.createElement("div");
                    for (t = 0; t < l.options.slidesPerRow; t++) {
                        var c = i * r + (e * l.options.slidesPerRow + t);
                        n.get(c) && a.appendChild(n.get(c))
                    }
                    d.appendChild(a)
                }
                o.appendChild(d)
            }
            l.$slider.empty().append(o), l.$slider.children().children().children().css({
                width: 100 / l.options.slidesPerRow + "%",
                display: "inline-block"
            })
        }
    }, e.prototype.checkResponsive = function (e, t) {
        var o, s, n, r = this, l = !1, d = r.$slider.width(), a = window.innerWidth || i(window).width();
        if ("window" === r.respondTo ? n = a : "slider" === r.respondTo ? n = d : "min" === r.respondTo && (n = Math.min(a, d)), r.options.responsive && r.options.responsive.length && null !== r.options.responsive) {
            s = null;
            for (o in r.breakpoints) r.breakpoints.hasOwnProperty(o) && (!1 === r.originalSettings.mobileFirst ? n < r.breakpoints[o] && (s = r.breakpoints[o]) : n > r.breakpoints[o] && (s = r.breakpoints[o]));
            null !== s ? null !== r.activeBreakpoint ? (s !== r.activeBreakpoint || t) && (r.activeBreakpoint = s, "unslick" === r.breakpointSettings[s] ? r.unslick(s) : (r.options = i.extend({}, r.originalSettings, r.breakpointSettings[s]), !0 === e && (r.currentSlide = r.options.initialSlide), r.refresh(e)), l = s) : (r.activeBreakpoint = s, "unslick" === r.breakpointSettings[s] ? r.unslick(s) : (r.options = i.extend({}, r.originalSettings, r.breakpointSettings[s]), !0 === e && (r.currentSlide = r.options.initialSlide), r.refresh(e)), l = s) : null !== r.activeBreakpoint && (r.activeBreakpoint = null, r.options = r.originalSettings, !0 === e && (r.currentSlide = r.options.initialSlide), r.refresh(e), l = s), e || !1 === l || r.$slider.trigger("breakpoint", [r, l])
        }
    }, e.prototype.changeSlide = function (e, t) {
        var o, s, n, r = this, l = i(e.currentTarget);
        switch (l.is("a") && e.preventDefault(), l.is("li") || (l = l.closest("li")), n = r.slideCount % r.options.slidesToScroll != 0, o = n ? 0 : (r.slideCount - r.currentSlide) % r.options.slidesToScroll, e.data.message) {
            case"previous":
                s = 0 === o ? r.options.slidesToScroll : r.options.slidesToShow - o, r.slideCount > r.options.slidesToShow && r.slideHandler(r.currentSlide - s, !1, t);
                break;
            case"next":
                s = 0 === o ? r.options.slidesToScroll : o, r.slideCount > r.options.slidesToShow && r.slideHandler(r.currentSlide + s, !1, t);
                break;
            case"index":
                var d = 0 === e.data.index ? 0 : e.data.index || l.index() * r.options.slidesToScroll;
                r.slideHandler(r.checkNavigable(d), !1, t), l.children().trigger("focus");
                break;
            default:
                return
        }
    }, e.prototype.checkNavigable = function (i) {
        var e, t;
        if (e = this.getNavigableIndexes(), t = 0, i > e[e.length - 1]) i = e[e.length - 1]; else for (var o in e) {
            if (i < e[o]) {
                i = t;
                break
            }
            t = e[o]
        }
        return i
    }, e.prototype.cleanUpEvents = function () {
        var e = this;
        e.options.dots && null !== e.$dots && (i("li", e.$dots).off("click.slick", e.changeSlide).off("mouseenter.slick", i.proxy(e.interrupt, e, !0)).off("mouseleave.slick", i.proxy(e.interrupt, e, !1)), !0 === e.options.accessibility && e.$dots.off("keydown.slick", e.keyHandler)), e.$slider.off("focus.slick blur.slick"), !0 === e.options.arrows && e.slideCount > e.options.slidesToShow && (e.$prevArrow && e.$prevArrow.off("click.slick", e.changeSlide), e.$nextArrow && e.$nextArrow.off("click.slick", e.changeSlide), !0 === e.options.accessibility && (e.$prevArrow && e.$prevArrow.off("keydown.slick", e.keyHandler), e.$nextArrow && e.$nextArrow.off("keydown.slick", e.keyHandler))), e.$list.off("touchstart.slick mousedown.slick", e.swipeHandler), e.$list.off("touchmove.slick mousemove.slick", e.swipeHandler), e.$list.off("touchend.slick mouseup.slick", e.swipeHandler), e.$list.off("touchcancel.slick mouseleave.slick", e.swipeHandler), e.$list.off("click.slick", e.clickHandler), i(document).off(e.visibilityChange, e.visibility), e.cleanUpSlideEvents(), !0 === e.options.accessibility && e.$list.off("keydown.slick", e.keyHandler), !0 === e.options.focusOnSelect && i(e.$slideTrack).children().off("click.slick", e.selectHandler), i(window).off("orientationchange.slick.slick-" + e.instanceUid, e.orientationChange), i(window).off("resize.slick.slick-" + e.instanceUid, e.resize), i("[draggable!=true]", e.$slideTrack).off("dragstart", e.preventDefault), i(window).off("load.slick.slick-" + e.instanceUid, e.setPosition)
    }, e.prototype.cleanUpSlideEvents = function () {
        var e = this;
        e.$list.off("mouseenter.slick", i.proxy(e.interrupt, e, !0)), e.$list.off("mouseleave.slick", i.proxy(e.interrupt, e, !1))
    }, e.prototype.cleanUpRows = function () {
        var i, e = this;
        e.options.rows > 1 && ((i = e.$slides.children().children()).removeAttr("style"), e.$slider.empty().append(i))
    }, e.prototype.clickHandler = function (i) {
        !1 === this.shouldClick && (i.stopImmediatePropagation(), i.stopPropagation(), i.preventDefault())
    }, e.prototype.destroy = function (e) {
        var t = this;
        t.autoPlayClear(), t.touchObject = {}, t.cleanUpEvents(), i(".slick-cloned", t.$slider).detach(), t.$dots && t.$dots.remove(), t.$prevArrow && t.$prevArrow.length && (t.$prevArrow.removeClass("slick-disabled slick-arrow slick-hidden").removeAttr("aria-hidden aria-disabled tabindex").css("display", ""), t.htmlExpr.test(t.options.prevArrow) && t.$prevArrow.remove()), t.$nextArrow && t.$nextArrow.length && (t.$nextArrow.removeClass("slick-disabled slick-arrow slick-hidden").removeAttr("aria-hidden aria-disabled tabindex").css("display", ""), t.htmlExpr.test(t.options.nextArrow) && t.$nextArrow.remove()), t.$slides && (t.$slides.removeClass("slick-slide slick-active slick-center slick-visible slick-current").removeAttr("aria-hidden").removeAttr("data-slick-index").each(function () {
            i(this).attr("style", i(this).data("originalStyling"))
        }), t.$slideTrack.children(this.options.slide).detach(), t.$slideTrack.detach(), t.$list.detach(), t.$slider.append(t.$slides)), t.cleanUpRows(), t.$slider.removeClass("slick-slider"), t.$slider.removeClass("slick-initialized"), t.$slider.removeClass("slick-dotted"), t.unslicked = !0, e || t.$slider.trigger("destroy", [t])
    }, e.prototype.disableTransition = function (i) {
        var e = this, t = {};
        t[e.transitionType] = "", !1 === e.options.fade ? e.$slideTrack.css(t) : e.$slides.eq(i).css(t)
    }, e.prototype.fadeSlide = function (i, e) {
        var t = this;
        !1 === t.cssTransitions ? (t.$slides.eq(i).css({zIndex: t.options.zIndex}), t.$slides.eq(i).animate({opacity: 1}, t.options.speed, t.options.easing, e)) : (t.applyTransition(i), t.$slides.eq(i).css({
            opacity: 1,
            zIndex: t.options.zIndex
        }), e && setTimeout(function () {
            t.disableTransition(i), e.call()
        }, t.options.speed))
    }, e.prototype.fadeSlideOut = function (i) {
        var e = this;
        !1 === e.cssTransitions ? e.$slides.eq(i).animate({
            opacity: 0,
            zIndex: e.options.zIndex - 2
        }, e.options.speed, e.options.easing) : (e.applyTransition(i), e.$slides.eq(i).css({
            opacity: 0,
            zIndex: e.options.zIndex - 2
        }))
    }, e.prototype.filterSlides = e.prototype.slickFilter = function (i) {
        var e = this;
        null !== i && (e.$slidesCache = e.$slides, e.unload(), e.$slideTrack.children(this.options.slide).detach(), e.$slidesCache.filter(i).appendTo(e.$slideTrack), e.reinit())
    }, e.prototype.focusHandler = function () {
        var e = this;
        e.$slider.off("focus.slick blur.slick").on("focus.slick blur.slick", "*", function (t) {
            t.stopImmediatePropagation();
            var o = i(this);
            setTimeout(function () {
                e.options.pauseOnFocus && (e.focussed = o.is(":focus"), e.autoPlay())
            }, 0)
        })
    }, e.prototype.getCurrent = e.prototype.slickCurrentSlide = function () {
        return this.currentSlide
    }, e.prototype.getDotCount = function () {
        var i = this, e = 0, t = 0, o = 0;
        if (!0 === i.options.infinite) if (i.slideCount <= i.options.slidesToShow) ++o; else for (; e < i.slideCount;) ++o, e = t + i.options.slidesToScroll, t += i.options.slidesToScroll <= i.options.slidesToShow ? i.options.slidesToScroll : i.options.slidesToShow; else if (!0 === i.options.centerMode) o = i.slideCount; else if (i.options.asNavFor) for (; e < i.slideCount;) ++o, e = t + i.options.slidesToScroll, t += i.options.slidesToScroll <= i.options.slidesToShow ? i.options.slidesToScroll : i.options.slidesToShow; else o = 1 + Math.ceil((i.slideCount - i.options.slidesToShow) / i.options.slidesToScroll);
        return o - 1
    }, e.prototype.getLeft = function (i) {
        var e, t, o, s, n = this, r = 0;
        return n.slideOffset = 0, t = n.$slides.first().outerHeight(!0), !0 === n.options.infinite ? (n.slideCount > n.options.slidesToShow && (n.slideOffset = n.slideWidth * n.options.slidesToShow * -1, s = -1, !0 === n.options.vertical && !0 === n.options.centerMode && (2 === n.options.slidesToShow ? s = -1.5 : 1 === n.options.slidesToShow && (s = -2)), r = t * n.options.slidesToShow * s), n.slideCount % n.options.slidesToScroll != 0 && i + n.options.slidesToScroll > n.slideCount && n.slideCount > n.options.slidesToShow && (i > n.slideCount ? (n.slideOffset = (n.options.slidesToShow - (i - n.slideCount)) * n.slideWidth * -1, r = (n.options.slidesToShow - (i - n.slideCount)) * t * -1) : (n.slideOffset = n.slideCount % n.options.slidesToScroll * n.slideWidth * -1, r = n.slideCount % n.options.slidesToScroll * t * -1))) : i + n.options.slidesToShow > n.slideCount && (n.slideOffset = (i + n.options.slidesToShow - n.slideCount) * n.slideWidth, r = (i + n.options.slidesToShow - n.slideCount) * t), n.slideCount <= n.options.slidesToShow && (n.slideOffset = 0, r = 0), !0 === n.options.centerMode && n.slideCount <= n.options.slidesToShow ? n.slideOffset = n.slideWidth * Math.floor(n.options.slidesToShow) / 2 - n.slideWidth * n.slideCount / 2 : !0 === n.options.centerMode && !0 === n.options.infinite ? n.slideOffset += n.slideWidth * Math.floor(n.options.slidesToShow / 2) - n.slideWidth : !0 === n.options.centerMode && (n.slideOffset = 0, n.slideOffset += n.slideWidth * Math.floor(n.options.slidesToShow / 2)), e = !1 === n.options.vertical ? i * n.slideWidth * -1 + n.slideOffset : i * t * -1 + r, !0 === n.options.variableWidth && (o = n.slideCount <= n.options.slidesToShow || !1 === n.options.infinite ? n.$slideTrack.children(".slick-slide").eq(i) : n.$slideTrack.children(".slick-slide").eq(i + n.options.slidesToShow), e = !0 === n.options.rtl ? o[0] ? -1 * (n.$slideTrack.width() - o[0].offsetLeft - o.width()) : 0 : o[0] ? -1 * o[0].offsetLeft : 0, !0 === n.options.centerMode && (o = n.slideCount <= n.options.slidesToShow || !1 === n.options.infinite ? n.$slideTrack.children(".slick-slide").eq(i) : n.$slideTrack.children(".slick-slide").eq(i + n.options.slidesToShow + 1), e = !0 === n.options.rtl ? o[0] ? -1 * (n.$slideTrack.width() - o[0].offsetLeft - o.width()) : 0 : o[0] ? -1 * o[0].offsetLeft : 0, e += (n.$list.width() - o.outerWidth()) / 2)), e
    }, e.prototype.getOption = e.prototype.slickGetOption = function (i) {
        return this.options[i]
    }, e.prototype.getNavigableIndexes = function () {
        var i, e = this, t = 0, o = 0, s = [];
        for (!1 === e.options.infinite ? i = e.slideCount : (t = -1 * e.options.slidesToScroll, o = -1 * e.options.slidesToScroll, i = 2 * e.slideCount); t < i;) s.push(t), t = o + e.options.slidesToScroll, o += e.options.slidesToScroll <= e.options.slidesToShow ? e.options.slidesToScroll : e.options.slidesToShow;
        return s
    }, e.prototype.getSlick = function () {
        return this
    }, e.prototype.getSlideCount = function () {
        var e, t, o = this;
        return t = !0 === o.options.centerMode ? o.slideWidth * Math.floor(o.options.slidesToShow / 2) : 0, !0 === o.options.swipeToSlide ? (o.$slideTrack.find(".slick-slide").each(function (s, n) {
            if (n.offsetLeft - t + i(n).outerWidth() / 2 > -1 * o.swipeLeft) return e = n, !1
        }), Math.abs(i(e).attr("data-slick-index") - o.currentSlide) || 1) : o.options.slidesToScroll
    }, e.prototype.goTo = e.prototype.slickGoTo = function (i, e) {
        this.changeSlide({data: {message: "index", index: parseInt(i)}}, e)
    }, e.prototype.init = function (e) {
        var t = this;
        i(t.$slider).hasClass("slick-initialized") || (i(t.$slider).addClass("slick-initialized"), t.buildRows(), t.buildOut(), t.setProps(), t.startLoad(), t.loadSlider(), t.initializeEvents(), t.updateArrows(), t.updateDots(), t.checkResponsive(!0), t.focusHandler()), e && t.$slider.trigger("init", [t]), !0 === t.options.accessibility && t.initADA(), t.options.autoplay && (t.paused = !1, t.autoPlay())
    }, e.prototype.initADA = function () {
        var e = this, t = Math.ceil(e.slideCount / e.options.slidesToShow),
            o = e.getNavigableIndexes().filter(function (i) {
                return i >= 0 && i < e.slideCount
            });
        e.$slides.add(e.$slideTrack.find(".slick-cloned")).attr({
            "aria-hidden": "true",
            tabindex: "-1"
        }).find("a, input, button, select").attr({tabindex: "-1"}), null !== e.$dots && (e.$slides.not(e.$slideTrack.find(".slick-cloned")).each(function (t) {
            var s = o.indexOf(t);
            i(this).attr({
                role: "tabpanel",
                id: "slick-slide" + e.instanceUid + t,
                tabindex: -1
            }), -1 !== s && i(this).attr({"aria-describedby": "slick-slide-control" + e.instanceUid + s})
        }), e.$dots.attr("role", "tablist").find("li").each(function (s) {
            var n = o[s];
            i(this).attr({role: "presentation"}), i(this).find("button").first().attr({
                role: "tab",
                id: "slick-slide-control" + e.instanceUid + s,
                "aria-controls": "slick-slide" + e.instanceUid + n,
                "aria-label": s + 1 + " of " + t,
                "aria-selected": null,
                tabindex: "-1"
            })
        }).eq(e.currentSlide).find("button").attr({"aria-selected": "true", tabindex: "0"}).end());
        for (var s = e.currentSlide, n = s + e.options.slidesToShow; s < n; s++) e.$slides.eq(s).attr("tabindex", 0);
        e.activateADA()
    }, e.prototype.initArrowEvents = function () {
        var i = this;
        !0 === i.options.arrows && i.slideCount > i.options.slidesToShow && (i.$prevArrow.off("click.slick").on("click.slick", {message: "previous"}, i.changeSlide), i.$nextArrow.off("click.slick").on("click.slick", {message: "next"}, i.changeSlide), !0 === i.options.accessibility && (i.$prevArrow.on("keydown.slick", i.keyHandler), i.$nextArrow.on("keydown.slick", i.keyHandler)))
    }, e.prototype.initDotEvents = function () {
        var e = this;
        !0 === e.options.dots && (i("li", e.$dots).on("click.slick", {message: "index"}, e.changeSlide), !0 === e.options.accessibility && e.$dots.on("keydown.slick", e.keyHandler)), !0 === e.options.dots && !0 === e.options.pauseOnDotsHover && i("li", e.$dots).on("mouseenter.slick", i.proxy(e.interrupt, e, !0)).on("mouseleave.slick", i.proxy(e.interrupt, e, !1))
    }, e.prototype.initSlideEvents = function () {
        var e = this;
        e.options.pauseOnHover && (e.$list.on("mouseenter.slick", i.proxy(e.interrupt, e, !0)), e.$list.on("mouseleave.slick", i.proxy(e.interrupt, e, !1)))
    }, e.prototype.initializeEvents = function () {
        var e = this;
        e.initArrowEvents(), e.initDotEvents(), e.initSlideEvents(), e.$list.on("touchstart.slick mousedown.slick", {action: "start"}, e.swipeHandler), e.$list.on("touchmove.slick mousemove.slick", {action: "move"}, e.swipeHandler), e.$list.on("touchend.slick mouseup.slick", {action: "end"}, e.swipeHandler), e.$list.on("touchcancel.slick mouseleave.slick", {action: "end"}, e.swipeHandler), e.$list.on("click.slick", e.clickHandler), i(document).on(e.visibilityChange, i.proxy(e.visibility, e)), !0 === e.options.accessibility && e.$list.on("keydown.slick", e.keyHandler), !0 === e.options.focusOnSelect && i(e.$slideTrack).children().on("click.slick", e.selectHandler), i(window).on("orientationchange.slick.slick-" + e.instanceUid, i.proxy(e.orientationChange, e)), i(window).on("resize.slick.slick-" + e.instanceUid, i.proxy(e.resize, e)), i("[draggable!=true]", e.$slideTrack).on("dragstart", e.preventDefault), i(window).on("load.slick.slick-" + e.instanceUid, e.setPosition), i(e.setPosition)
    }, e.prototype.initUI = function () {
        var i = this;
        !0 === i.options.arrows && i.slideCount > i.options.slidesToShow && (i.$prevArrow.show(), i.$nextArrow.show()), !0 === i.options.dots && i.slideCount > i.options.slidesToShow && i.$dots.show()
    }, e.prototype.keyHandler = function (i) {
        var e = this;
        i.target.tagName.match("TEXTAREA|INPUT|SELECT") || (37 === i.keyCode && !0 === e.options.accessibility ? e.changeSlide({data: {message: !0 === e.options.rtl ? "next" : "previous"}}) : 39 === i.keyCode && !0 === e.options.accessibility && e.changeSlide({data: {message: !0 === e.options.rtl ? "previous" : "next"}}))
    }, e.prototype.lazyLoad = function () {
        function e(e) {
            i("img[data-lazy]", e).each(function () {
                var e = i(this), t = i(this).attr("data-lazy"), o = i(this).attr("data-srcset"),
                    s = i(this).attr("data-sizes") || n.$slider.attr("data-sizes"), r = document.createElement("img");
                r.onload = function () {
                    e.animate({opacity: 0}, 100, function () {
                        o && (e.attr("srcset", o), s && e.attr("sizes", s)), e.attr("src", t).animate({opacity: 1}, 200, function () {
                            e.removeAttr("data-lazy data-srcset data-sizes").removeClass("slick-loading")
                        }), n.$slider.trigger("lazyLoaded", [n, e, t])
                    })
                }, r.onerror = function () {
                    e.removeAttr("data-lazy").removeClass("slick-loading").addClass("slick-lazyload-error"), n.$slider.trigger("lazyLoadError", [n, e, t])
                }, r.src = t
            })
        }

        var t, o, s, n = this;
        if (!0 === n.options.centerMode ? !0 === n.options.infinite ? s = (o = n.currentSlide + (n.options.slidesToShow / 2 + 1)) + n.options.slidesToShow + 2 : (o = Math.max(0, n.currentSlide - (n.options.slidesToShow / 2 + 1)), s = n.options.slidesToShow / 2 + 1 + 2 + n.currentSlide) : (o = n.options.infinite ? n.options.slidesToShow + n.currentSlide : n.currentSlide, s = Math.ceil(o + n.options.slidesToShow), !0 === n.options.fade && (o > 0 && o--, s <= n.slideCount && s++)), t = n.$slider.find(".slick-slide").slice(o, s), "anticipated" === n.options.lazyLoad) for (var r = o - 1, l = s, d = n.$slider.find(".slick-slide"), a = 0; a < n.options.slidesToScroll; a++) r < 0 && (r = n.slideCount - 1), t = (t = t.add(d.eq(r))).add(d.eq(l)), r--, l++;
        e(t), n.slideCount <= n.options.slidesToShow ? e(n.$slider.find(".slick-slide")) : n.currentSlide >= n.slideCount - n.options.slidesToShow ? e(n.$slider.find(".slick-cloned").slice(0, n.options.slidesToShow)) : 0 === n.currentSlide && e(n.$slider.find(".slick-cloned").slice(-1 * n.options.slidesToShow))
    }, e.prototype.loadSlider = function () {
        var i = this;
        i.setPosition(), i.$slideTrack.css({opacity: 1}), i.$slider.removeClass("slick-loading"), i.initUI(), "progressive" === i.options.lazyLoad && i.progressiveLazyLoad()
    }, e.prototype.next = e.prototype.slickNext = function () {
        this.changeSlide({data: {message: "next"}})
    }, e.prototype.orientationChange = function () {
        var i = this;
        i.checkResponsive(), i.setPosition()
    }, e.prototype.pause = e.prototype.slickPause = function () {
        var i = this;
        i.autoPlayClear(), i.paused = !0
    }, e.prototype.play = e.prototype.slickPlay = function () {
        var i = this;
        i.autoPlay(), i.options.autoplay = !0, i.paused = !1, i.focussed = !1, i.interrupted = !1
    }, e.prototype.postSlide = function (e) {
        var t = this;
        t.unslicked || (t.$slider.trigger("afterChange", [t, e]), t.animating = !1, t.slideCount > t.options.slidesToShow && t.setPosition(), t.swipeLeft = null, t.options.autoplay && t.autoPlay(), !0 === t.options.accessibility && (t.initADA(), t.options.focusOnChange && i(t.$slides.get(t.currentSlide)).attr("tabindex", 0).focus()))
    }, e.prototype.prev = e.prototype.slickPrev = function () {
        this.changeSlide({data: {message: "previous"}})
    }, e.prototype.preventDefault = function (i) {
        i.preventDefault()
    }, e.prototype.progressiveLazyLoad = function (e) {
        e = e || 1;
        var t, o, s, n, r, l = this, d = i("img[data-lazy]", l.$slider);
        d.length ? (t = d.first(), o = t.attr("data-lazy"), s = t.attr("data-srcset"), n = t.attr("data-sizes") || l.$slider.attr("data-sizes"), (r = document.createElement("img")).onload = function () {
            s && (t.attr("srcset", s), n && t.attr("sizes", n)), t.attr("src", o).removeAttr("data-lazy data-srcset data-sizes").removeClass("slick-loading"), !0 === l.options.adaptiveHeight && l.setPosition(), l.$slider.trigger("lazyLoaded", [l, t, o]), l.progressiveLazyLoad()
        }, r.onerror = function () {
            e < 3 ? setTimeout(function () {
                l.progressiveLazyLoad(e + 1)
            }, 500) : (t.removeAttr("data-lazy").removeClass("slick-loading").addClass("slick-lazyload-error"), l.$slider.trigger("lazyLoadError", [l, t, o]), l.progressiveLazyLoad())
        }, r.src = o) : l.$slider.trigger("allImagesLoaded", [l])
    }, e.prototype.refresh = function (e) {
        var t, o, s = this;
        o = s.slideCount - s.options.slidesToShow, !s.options.infinite && s.currentSlide > o && (s.currentSlide = o), s.slideCount <= s.options.slidesToShow && (s.currentSlide = 0), t = s.currentSlide, s.destroy(!0), i.extend(s, s.initials, {currentSlide: t}), s.init(), e || s.changeSlide({
            data: {
                message: "index",
                index: t
            }
        }, !1)
    }, e.prototype.registerBreakpoints = function () {
        var e, t, o, s = this, n = s.options.responsive || null;
        if ("array" === i.type(n) && n.length) {
            s.respondTo = s.options.respondTo || "window";
            for (e in n) if (o = s.breakpoints.length - 1, n.hasOwnProperty(e)) {
                for (t = n[e].breakpoint; o >= 0;) s.breakpoints[o] && s.breakpoints[o] === t && s.breakpoints.splice(o, 1), o--;
                s.breakpoints.push(t), s.breakpointSettings[t] = n[e].settings
            }
            s.breakpoints.sort(function (i, e) {
                return s.options.mobileFirst ? i - e : e - i
            })
        }
    }, e.prototype.reinit = function () {
        var e = this;
        e.$slides = e.$slideTrack.children(e.options.slide).addClass("slick-slide"), e.slideCount = e.$slides.length, e.currentSlide >= e.slideCount && 0 !== e.currentSlide && (e.currentSlide = e.currentSlide - e.options.slidesToScroll), e.slideCount <= e.options.slidesToShow && (e.currentSlide = 0), e.registerBreakpoints(), e.setProps(), e.setupInfinite(), e.buildArrows(), e.updateArrows(), e.initArrowEvents(), e.buildDots(), e.updateDots(), e.initDotEvents(), e.cleanUpSlideEvents(), e.initSlideEvents(), e.checkResponsive(!1, !0), !0 === e.options.focusOnSelect && i(e.$slideTrack).children().on("click.slick", e.selectHandler), e.setSlideClasses("number" == typeof e.currentSlide ? e.currentSlide : 0), e.setPosition(), e.focusHandler(), e.paused = !e.options.autoplay, e.autoPlay(), e.$slider.trigger("reInit", [e])
    }, e.prototype.resize = function () {
        var e = this;
        i(window).width() !== e.windowWidth && (clearTimeout(e.windowDelay), e.windowDelay = window.setTimeout(function () {
            e.windowWidth = i(window).width(), e.checkResponsive(), e.unslicked || e.setPosition()
        }, 50))
    }, e.prototype.removeSlide = e.prototype.slickRemove = function (i, e, t) {
        var o = this;
        if (i = "boolean" == typeof i ? !0 === (e = i) ? 0 : o.slideCount - 1 : !0 === e ? --i : i, o.slideCount < 1 || i < 0 || i > o.slideCount - 1) return !1;
        o.unload(), !0 === t ? o.$slideTrack.children().remove() : o.$slideTrack.children(this.options.slide).eq(i).remove(), o.$slides = o.$slideTrack.children(this.options.slide), o.$slideTrack.children(this.options.slide).detach(), o.$slideTrack.append(o.$slides), o.$slidesCache = o.$slides, o.reinit()
    }, e.prototype.setCSS = function (i) {
        var e, t, o = this, s = {};
        !0 === o.options.rtl && (i = -i), e = "left" == o.positionProp ? Math.ceil(i) + "px" : "0px", t = "top" == o.positionProp ? Math.ceil(i) + "px" : "0px", s[o.positionProp] = i, !1 === o.transformsEnabled ? o.$slideTrack.css(s) : (s = {}, !1 === o.cssTransitions ? (s[o.animType] = "translate(" + e + ", " + t + ")", o.$slideTrack.css(s)) : (s[o.animType] = "translate3d(" + e + ", " + t + ", 0px)", o.$slideTrack.css(s)))
    }, e.prototype.setDimensions = function () {
        var i = this;
        !1 === i.options.vertical ? !0 === i.options.centerMode && i.$list.css({padding: "0px " + i.options.centerPadding}) : (i.$list.height(i.$slides.first().outerHeight(!0) * i.options.slidesToShow), !0 === i.options.centerMode && i.$list.css({padding: i.options.centerPadding + " 0px"})), i.listWidth = i.$list.width(), i.listHeight = i.$list.height(), !1 === i.options.vertical && !1 === i.options.variableWidth ? (i.slideWidth = Math.ceil(i.listWidth / i.options.slidesToShow), i.$slideTrack.width(Math.ceil(i.slideWidth * i.$slideTrack.children(".slick-slide").length))) : !0 === i.options.variableWidth ? i.$slideTrack.width(5e3 * i.slideCount) : (i.slideWidth = Math.ceil(i.listWidth), i.$slideTrack.height(Math.ceil(i.$slides.first().outerHeight(!0) * i.$slideTrack.children(".slick-slide").length)));
        var e = i.$slides.first().outerWidth(!0) - i.$slides.first().width();
        !1 === i.options.variableWidth && i.$slideTrack.children(".slick-slide").width(i.slideWidth - e)
    }, e.prototype.setFade = function () {
        var e, t = this;
        t.$slides.each(function (o, s) {
            e = t.slideWidth * o * -1, !0 === t.options.rtl ? i(s).css({
                position: "relative",
                right: e,
                top: 0,
                zIndex: t.options.zIndex - 2,
                opacity: 0
            }) : i(s).css({position: "relative", left: e, top: 0, zIndex: t.options.zIndex - 2, opacity: 0})
        }), t.$slides.eq(t.currentSlide).css({zIndex: t.options.zIndex - 1, opacity: 1})
    }, e.prototype.setHeight = function () {
        var i = this;
        if (1 === i.options.slidesToShow && !0 === i.options.adaptiveHeight && !1 === i.options.vertical) {
            var e = i.$slides.eq(i.currentSlide).outerHeight(!0);
            i.$list.css("height", e)
        }
    }, e.prototype.setOption = e.prototype.slickSetOption = function () {
        var e, t, o, s, n, r = this, l = !1;
        if ("object" === i.type(arguments[0]) ? (o = arguments[0], l = arguments[1], n = "multiple") : "string" === i.type(arguments[0]) && (o = arguments[0], s = arguments[1], l = arguments[2], "responsive" === arguments[0] && "array" === i.type(arguments[1]) ? n = "responsive" : void 0 !== arguments[1] && (n = "single")), "single" === n) r.options[o] = s; else if ("multiple" === n) i.each(o, function (i, e) {
            r.options[i] = e
        }); else if ("responsive" === n) for (t in s) if ("array" !== i.type(r.options.responsive)) r.options.responsive = [s[t]]; else {
            for (e = r.options.responsive.length - 1; e >= 0;) r.options.responsive[e].breakpoint === s[t].breakpoint && r.options.responsive.splice(e, 1), e--;
            r.options.responsive.push(s[t])
        }
        l && (r.unload(), r.reinit())
    }, e.prototype.setPosition = function () {
        var i = this;
        i.setDimensions(), i.setHeight(), !1 === i.options.fade ? i.setCSS(i.getLeft(i.currentSlide)) : i.setFade(), i.$slider.trigger("setPosition", [i])
    }, e.prototype.setProps = function () {
        var i = this, e = document.body.style;
        i.positionProp = !0 === i.options.vertical ? "top" : "left", "top" === i.positionProp ? i.$slider.addClass("slick-vertical") : i.$slider.removeClass("slick-vertical"), void 0 === e.WebkitTransition && void 0 === e.MozTransition && void 0 === e.msTransition || !0 === i.options.useCSS && (i.cssTransitions = !0), i.options.fade && ("number" == typeof i.options.zIndex ? i.options.zIndex < 3 && (i.options.zIndex = 3) : i.options.zIndex = i.defaults.zIndex), void 0 !== e.OTransform && (i.animType = "OTransform", i.transformType = "-o-transform", i.transitionType = "OTransition", void 0 === e.perspectiveProperty && void 0 === e.webkitPerspective && (i.animType = !1)), void 0 !== e.MozTransform && (i.animType = "MozTransform", i.transformType = "-moz-transform", i.transitionType = "MozTransition", void 0 === e.perspectiveProperty && void 0 === e.MozPerspective && (i.animType = !1)), void 0 !== e.webkitTransform && (i.animType = "webkitTransform", i.transformType = "-webkit-transform", i.transitionType = "webkitTransition", void 0 === e.perspectiveProperty && void 0 === e.webkitPerspective && (i.animType = !1)), void 0 !== e.msTransform && (i.animType = "msTransform", i.transformType = "-ms-transform", i.transitionType = "msTransition", void 0 === e.msTransform && (i.animType = !1)), void 0 !== e.transform && !1 !== i.animType && (i.animType = "transform", i.transformType = "transform", i.transitionType = "transition"), i.transformsEnabled = i.options.useTransform && null !== i.animType && !1 !== i.animType
    }, e.prototype.setSlideClasses = function (i) {
        var e, t, o, s, n = this;
        if (t = n.$slider.find(".slick-slide").removeClass("slick-active slick-center slick-current").attr("aria-hidden", "true"), n.$slides.eq(i).addClass("slick-current"), !0 === n.options.centerMode) {
            var r = n.options.slidesToShow % 2 == 0 ? 1 : 0;
            e = Math.floor(n.options.slidesToShow / 2), !0 === n.options.infinite && (i >= e && i <= n.slideCount - 1 - e ? n.$slides.slice(i - e + r, i + e + 1).addClass("slick-active").attr("aria-hidden", "false") : (o = n.options.slidesToShow + i, t.slice(o - e + 1 + r, o + e + 2).addClass("slick-active").attr("aria-hidden", "false")), 0 === i ? t.eq(t.length - 1 - n.options.slidesToShow).addClass("slick-center") : i === n.slideCount - 1 && t.eq(n.options.slidesToShow).addClass("slick-center")), n.$slides.eq(i).addClass("slick-center")
        } else i >= 0 && i <= n.slideCount - n.options.slidesToShow ? n.$slides.slice(i, i + n.options.slidesToShow).addClass("slick-active").attr("aria-hidden", "false") : t.length <= n.options.slidesToShow ? t.addClass("slick-active").attr("aria-hidden", "false") : (s = n.slideCount % n.options.slidesToShow, o = !0 === n.options.infinite ? n.options.slidesToShow + i : i, n.options.slidesToShow == n.options.slidesToScroll && n.slideCount - i < n.options.slidesToShow ? t.slice(o - (n.options.slidesToShow - s), o + s).addClass("slick-active").attr("aria-hidden", "false") : t.slice(o, o + n.options.slidesToShow).addClass("slick-active").attr("aria-hidden", "false"));
        "ondemand" !== n.options.lazyLoad && "anticipated" !== n.options.lazyLoad || n.lazyLoad()
    }, e.prototype.setupInfinite = function () {
        var e, t, o, s = this;
        if (!0 === s.options.fade && (s.options.centerMode = !1), !0 === s.options.infinite && !1 === s.options.fade && (t = null, s.slideCount > s.options.slidesToShow)) {
            for (o = !0 === s.options.centerMode ? s.options.slidesToShow + 1 : s.options.slidesToShow, e = s.slideCount; e > s.slideCount - o; e -= 1) t = e - 1, i(s.$slides[t]).clone(!0).attr("id", "").attr("data-slick-index", t - s.slideCount).prependTo(s.$slideTrack).addClass("slick-cloned");
            for (e = 0; e < o + s.slideCount; e += 1) t = e, i(s.$slides[t]).clone(!0).attr("id", "").attr("data-slick-index", t + s.slideCount).appendTo(s.$slideTrack).addClass("slick-cloned");
            s.$slideTrack.find(".slick-cloned").find("[id]").each(function () {
                i(this).attr("id", "")
            })
        }
    }, e.prototype.interrupt = function (i) {
        var e = this;
        i || e.autoPlay(), e.interrupted = i
    }, e.prototype.selectHandler = function (e) {
        var t = this, o = i(e.target).is(".slick-slide") ? i(e.target) : i(e.target).parents(".slick-slide"),
            s = parseInt(o.attr("data-slick-index"));
        s || (s = 0), t.slideCount <= t.options.slidesToShow ? t.slideHandler(s, !1, !0) : t.slideHandler(s)
    }, e.prototype.slideHandler = function (i, e, t) {
        var o, s, n, r, l, d = null, a = this;
        if (e = e || !1, !(!0 === a.animating && !0 === a.options.waitForAnimate || !0 === a.options.fade && a.currentSlide === i)) if (!1 === e && a.asNavFor(i), o = i, d = a.getLeft(o), r = a.getLeft(a.currentSlide), a.currentLeft = null === a.swipeLeft ? r : a.swipeLeft, !1 === a.options.infinite && !1 === a.options.centerMode && (i < 0 || i > a.getDotCount() * a.options.slidesToScroll)) !1 === a.options.fade && (o = a.currentSlide, !0 !== t ? a.animateSlide(r, function () {
            a.postSlide(o)
        }) : a.postSlide(o)); else if (!1 === a.options.infinite && !0 === a.options.centerMode && (i < 0 || i > a.slideCount - a.options.slidesToScroll)) !1 === a.options.fade && (o = a.currentSlide, !0 !== t ? a.animateSlide(r, function () {
            a.postSlide(o)
        }) : a.postSlide(o)); else {
            if (a.options.autoplay && clearInterval(a.autoPlayTimer), s = o < 0 ? a.slideCount % a.options.slidesToScroll != 0 ? a.slideCount - a.slideCount % a.options.slidesToScroll : a.slideCount + o : o >= a.slideCount ? a.slideCount % a.options.slidesToScroll != 0 ? 0 : o - a.slideCount : o, a.animating = !0, a.$slider.trigger("beforeChange", [a, a.currentSlide, s]), n = a.currentSlide, a.currentSlide = s, a.setSlideClasses(a.currentSlide), a.options.asNavFor && (l = (l = a.getNavTarget()).slick("getSlick")).slideCount <= l.options.slidesToShow && l.setSlideClasses(a.currentSlide), a.updateDots(), a.updateArrows(), !0 === a.options.fade) return !0 !== t ? (a.fadeSlideOut(n), a.fadeSlide(s, function () {
                a.postSlide(s)
            })) : a.postSlide(s), void a.animateHeight();
            !0 !== t ? a.animateSlide(d, function () {
                a.postSlide(s)
            }) : a.postSlide(s)
        }
    }, e.prototype.startLoad = function () {
        var i = this;
        !0 === i.options.arrows && i.slideCount > i.options.slidesToShow && (i.$prevArrow.hide(), i.$nextArrow.hide()), !0 === i.options.dots && i.slideCount > i.options.slidesToShow && i.$dots.hide(), i.$slider.addClass("slick-loading")
    }, e.prototype.swipeDirection = function () {
        var i, e, t, o, s = this;
        return i = s.touchObject.startX - s.touchObject.curX, e = s.touchObject.startY - s.touchObject.curY, t = Math.atan2(e, i), (o = Math.round(180 * t / Math.PI)) < 0 && (o = 360 - Math.abs(o)), o <= 45 && o >= 0 ? !1 === s.options.rtl ? "left" : "right" : o <= 360 && o >= 315 ? !1 === s.options.rtl ? "left" : "right" : o >= 135 && o <= 225 ? !1 === s.options.rtl ? "right" : "left" : !0 === s.options.verticalSwiping ? o >= 35 && o <= 135 ? "down" : "up" : "vertical"
    }, e.prototype.swipeEnd = function (i) {
        var e, t, o = this;
        if (o.dragging = !1, o.swiping = !1, o.scrolling) return o.scrolling = !1, !1;
        if (o.interrupted = !1, o.shouldClick = !(o.touchObject.swipeLength > 10), void 0 === o.touchObject.curX) return !1;
        if (!0 === o.touchObject.edgeHit && o.$slider.trigger("edge", [o, o.swipeDirection()]), o.touchObject.swipeLength >= o.touchObject.minSwipe) {
            switch (t = o.swipeDirection()) {
                case"left":
                case"down":
                    e = o.options.swipeToSlide ? o.checkNavigable(o.currentSlide + o.getSlideCount()) : o.currentSlide + o.getSlideCount(), o.currentDirection = 0;
                    break;
                case"right":
                case"up":
                    e = o.options.swipeToSlide ? o.checkNavigable(o.currentSlide - o.getSlideCount()) : o.currentSlide - o.getSlideCount(), o.currentDirection = 1
            }
            "vertical" != t && (o.slideHandler(e), o.touchObject = {}, o.$slider.trigger("swipe", [o, t]))
        } else o.touchObject.startX !== o.touchObject.curX && (o.slideHandler(o.currentSlide), o.touchObject = {})
    }, e.prototype.swipeHandler = function (i) {
        var e = this;
        if (!(!1 === e.options.swipe || "ontouchend" in document && !1 === e.options.swipe || !1 === e.options.draggable && -1 !== i.type.indexOf("mouse"))) switch (e.touchObject.fingerCount = i.originalEvent && void 0 !== i.originalEvent.touches ? i.originalEvent.touches.length : 1, e.touchObject.minSwipe = e.listWidth / e.options.touchThreshold, !0 === e.options.verticalSwiping && (e.touchObject.minSwipe = e.listHeight / e.options.touchThreshold), i.data.action) {
            case"start":
                e.swipeStart(i);
                break;
            case"move":
                e.swipeMove(i);
                break;
            case"end":
                e.swipeEnd(i)
        }
    }, e.prototype.swipeMove = function (i) {
        var e, t, o, s, n, r, l = this;
        return n = void 0 !== i.originalEvent ? i.originalEvent.touches : null, !(!l.dragging || l.scrolling || n && 1 !== n.length) && (e = l.getLeft(l.currentSlide), l.touchObject.curX = void 0 !== n ? n[0].pageX : i.clientX, l.touchObject.curY = void 0 !== n ? n[0].pageY : i.clientY, l.touchObject.swipeLength = Math.round(Math.sqrt(Math.pow(l.touchObject.curX - l.touchObject.startX, 2))), r = Math.round(Math.sqrt(Math.pow(l.touchObject.curY - l.touchObject.startY, 2))), !l.options.verticalSwiping && !l.swiping && r > 4 ? (l.scrolling = !0, !1) : (!0 === l.options.verticalSwiping && (l.touchObject.swipeLength = r), t = l.swipeDirection(), void 0 !== i.originalEvent && l.touchObject.swipeLength > 4 && (l.swiping = !0, i.preventDefault()), s = (!1 === l.options.rtl ? 1 : -1) * (l.touchObject.curX > l.touchObject.startX ? 1 : -1), !0 === l.options.verticalSwiping && (s = l.touchObject.curY > l.touchObject.startY ? 1 : -1), o = l.touchObject.swipeLength, l.touchObject.edgeHit = !1, !1 === l.options.infinite && (0 === l.currentSlide && "right" === t || l.currentSlide >= l.getDotCount() && "left" === t) && (o = l.touchObject.swipeLength * l.options.edgeFriction, l.touchObject.edgeHit = !0), !1 === l.options.vertical ? l.swipeLeft = e + o * s : l.swipeLeft = e + o * (l.$list.height() / l.listWidth) * s, !0 === l.options.verticalSwiping && (l.swipeLeft = e + o * s), !0 !== l.options.fade && !1 !== l.options.touchMove && (!0 === l.animating ? (l.swipeLeft = null, !1) : void l.setCSS(l.swipeLeft))))
    }, e.prototype.swipeStart = function (i) {
        var e, t = this;
        if (t.interrupted = !0, 1 !== t.touchObject.fingerCount || t.slideCount <= t.options.slidesToShow) return t.touchObject = {}, !1;
        void 0 !== i.originalEvent && void 0 !== i.originalEvent.touches && (e = i.originalEvent.touches[0]), t.touchObject.startX = t.touchObject.curX = void 0 !== e ? e.pageX : i.clientX, t.touchObject.startY = t.touchObject.curY = void 0 !== e ? e.pageY : i.clientY, t.dragging = !0
    }, e.prototype.unfilterSlides = e.prototype.slickUnfilter = function () {
        var i = this;
        null !== i.$slidesCache && (i.unload(), i.$slideTrack.children(this.options.slide).detach(), i.$slidesCache.appendTo(i.$slideTrack), i.reinit())
    }, e.prototype.unload = function () {
        var e = this;
        i(".slick-cloned", e.$slider).remove(), e.$dots && e.$dots.remove(), e.$prevArrow && e.htmlExpr.test(e.options.prevArrow) && e.$prevArrow.remove(), e.$nextArrow && e.htmlExpr.test(e.options.nextArrow) && e.$nextArrow.remove(), e.$slides.removeClass("slick-slide slick-active slick-visible slick-current").attr("aria-hidden", "true").css("width", "")
    }, e.prototype.unslick = function (i) {
        var e = this;
        e.$slider.trigger("unslick", [e, i]), e.destroy()
    }, e.prototype.updateArrows = function () {
        var i = this;
        Math.floor(i.options.slidesToShow / 2), !0 === i.options.arrows && i.slideCount > i.options.slidesToShow && !i.options.infinite && (i.$prevArrow.removeClass("slick-disabled").attr("aria-disabled", "false"), i.$nextArrow.removeClass("slick-disabled").attr("aria-disabled", "false"), 0 === i.currentSlide ? (i.$prevArrow.addClass("slick-disabled").attr("aria-disabled", "true"), i.$nextArrow.removeClass("slick-disabled").attr("aria-disabled", "false")) : i.currentSlide >= i.slideCount - i.options.slidesToShow && !1 === i.options.centerMode ? (i.$nextArrow.addClass("slick-disabled").attr("aria-disabled", "true"), i.$prevArrow.removeClass("slick-disabled").attr("aria-disabled", "false")) : i.currentSlide >= i.slideCount - 1 && !0 === i.options.centerMode && (i.$nextArrow.addClass("slick-disabled").attr("aria-disabled", "true"), i.$prevArrow.removeClass("slick-disabled").attr("aria-disabled", "false")))
    }, e.prototype.updateDots = function () {
        var i = this;
        null !== i.$dots && (i.$dots.find("li").removeClass("slick-active").end(), i.$dots.find("li").eq(Math.floor(i.currentSlide / i.options.slidesToScroll)).addClass("slick-active"))
    }, e.prototype.visibility = function () {
        var i = this;
        i.options.autoplay && (document[i.hidden] ? i.interrupted = !0 : i.interrupted = !1)
    }, i.fn.slick = function () {
        var i, t, o = this, s = arguments[0], n = Array.prototype.slice.call(arguments, 1), r = o.length;
        for (i = 0; i < r; i++) if ("object" == typeof s || void 0 === s ? o[i].slick = new e(o[i], s) : t = o[i].slick[s].apply(o[i].slick, n), void 0 !== t) return t;
        return o
    }
});

!(function (e, t) {
    "object" == typeof exports && "undefined" != typeof module ? (module.exports = t()) : "function" == typeof define && define.amd ? define(t) : (e.Sweetalert2 = t());
})(this, function () {
    "use strict";
    function q(e) {
        return (q =
            "function" == typeof Symbol && "symbol" == typeof Symbol.iterator
                ? function (e) {
                    return typeof e;
                }
                : function (e) {
                    return e && "function" == typeof Symbol && e.constructor === Symbol && e !== Symbol.prototype ? "symbol" : typeof e;
                })(e);
    }
    function a(e, t) {
        if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function");
    }
    function o(e, t) {
        for (var n = 0; n < t.length; n++) {
            var o = t[n];
            (o.enumerable = o.enumerable || !1), (o.configurable = !0), "value" in o && (o.writable = !0), Object.defineProperty(e, o.key, o);
        }
    }
    function i(e, t, n) {
        return t && o(e.prototype, t), n && o(e, n), e;
    }
    function r() {
        return (r =
            Object.assign ||
            function (e) {
                for (var t = 1; t < arguments.length; t++) {
                    var n = arguments[t];
                    for (var o in n) Object.prototype.hasOwnProperty.call(n, o) && (e[o] = n[o]);
                }
                return e;
            }).apply(this, arguments);
    }
    function s(e, t) {
        if ("function" != typeof t && null !== t) throw new TypeError("Super expression must either be null or a function");
        (e.prototype = Object.create(t && t.prototype, { constructor: { value: e, writable: !0, configurable: !0 } })), t && u(e, t);
    }
    function c(e) {
        return (c = Object.setPrototypeOf
            ? Object.getPrototypeOf
            : function (e) {
                return e.__proto__ || Object.getPrototypeOf(e);
            })(e);
    }
    function u(e, t) {
        return (u =
            Object.setPrototypeOf ||
            function (e, t) {
                return (e.__proto__ = t), e;
            })(e, t);
    }
    function l(e, t, n) {
        return (l = (function () {
            if ("undefined" == typeof Reflect || !Reflect.construct) return !1;
            if (Reflect.construct.sham) return !1;
            if ("function" == typeof Proxy) return !0;
            try {
                return Date.prototype.toString.call(Reflect.construct(Date, [], function () {})), !0;
            } catch (e) {
                return !1;
            }
        })()
            ? Reflect.construct
            : function (e, t, n) {
                var o = [null];
                o.push.apply(o, t);
                var i = new (Function.bind.apply(e, o))();
                return n && u(i, n.prototype), i;
            }).apply(null, arguments);
    }
    function d(e, t) {
        return !t || ("object" != typeof t && "function" != typeof t)
            ? (function (e) {
                if (void 0 === e) throw new ReferenceError("this hasn't been initialised - super() hasn't been called");
                return e;
            })(e)
            : t;
    }
    function p(e, t, n) {
        return (p =
            "undefined" != typeof Reflect && Reflect.get
                ? Reflect.get
                : function (e, t, n) {
                    var o = (function (e, t) {
                        for (; !Object.prototype.hasOwnProperty.call(e, t) && null !== (e = c(e)); );
                        return e;
                    })(e, t);
                    if (o) {
                        var i = Object.getOwnPropertyDescriptor(o, t);
                        return i.get ? i.get.call(n) : i.value;
                    }
                })(e, t, n || e);
    }
    var t = "SweetAlert2:",
        f = function (e) {
            return Array.prototype.slice.call(e);
        },
        R = function (e) {
            console.warn("".concat(t, " ").concat(e));
        },
        I = function (e) {
            console.error("".concat(t, " ").concat(e));
        },
        n = [],
        m = function (e) {
            -1 === n.indexOf(e) && (n.push(e), R(e));
        },
        H = function (e) {
            return "function" == typeof e ? e() : e;
        },
        D = function (e) {
            return e && Promise.resolve(e) === e;
        },
        e = Object.freeze({ cancel: "cancel", backdrop: "overlay", close: "close", esc: "esc", timer: "timer" }),
        h = function (e) {
            var t = {};
            for (var n in e) t[e[n]] = "swal2-" + e[n];
            return t;
        },
        _ = h([
            "container",
            "shown",
            "height-auto",
            "iosfix",
            "popup",
            "modal",
            "no-backdrop",
            "toast",
            "toast-shown",
            "toast-column",
            "fade",
            "show",
            "hide",
            "noanimation",
            "close",
            "title",
            "header",
            "content",
            "actions",
            "confirm",
            "cancel",
            "footer",
            "icon",
            "icon-text",
            "image",
            "input",
            "file",
            "range",
            "select",
            "radio",
            "checkbox",
            "label",
            "textarea",
            "inputerror",
            "validation-message",
            "progresssteps",
            "activeprogressstep",
            "progresscircle",
            "progressline",
            "loading",
            "styled",
            "top",
            "top-start",
            "top-end",
            "top-left",
            "top-right",
            "center",
            "center-start",
            "center-end",
            "center-left",
            "center-right",
            "bottom",
            "bottom-start",
            "bottom-end",
            "bottom-left",
            "bottom-right",
            "grow-row",
            "grow-column",
            "grow-fullscreen",
            "rtl",
        ]),
        g = h(["success", "warning", "info", "question", "error"]),
        b = { previousBodyPadding: null },
        v = function (e, t) {
            return e.classList.contains(t);
        },
        N = function (e) {
            if ((e.focus(), "file" !== e.type)) {
                var t = e.value;
                (e.value = ""), (e.value = t);
            }
        },
        y = function (e, t, n) {
            e &&
            t &&
            ("string" == typeof t && (t = t.split(/\s+/).filter(Boolean)),
                t.forEach(function (t) {
                    e.forEach
                        ? e.forEach(function (e) {
                            n ? e.classList.add(t) : e.classList.remove(t);
                        })
                        : n
                        ? e.classList.add(t)
                        : e.classList.remove(t);
                }));
        },
        z = function (e, t) {
            y(e, t, !0);
        },
        W = function (e, t) {
            y(e, t, !1);
        },
        U = function (e, t) {
            for (var n = 0; n < e.childNodes.length; n++) if (v(e.childNodes[n], t)) return e.childNodes[n];
        },
        K = function (e) {
            (e.style.opacity = ""), (e.style.display = e.id === _.content ? "block" : "flex");
        },
        F = function (e) {
            (e.style.opacity = ""), (e.style.display = "none");
        },
        Z = function (e) {
            return e && (e.offsetWidth || e.offsetHeight || e.getClientRects().length);
        },
        w = function () {
            return document.body.querySelector("." + _.container);
        },
        C = function (e) {
            var t = w();
            return t ? t.querySelector("." + e) : null;
        },
        k = function () {
            return C(_.popup);
        },
        x = function () {
            var e = k();
            return f(e.querySelectorAll("." + _.icon));
        },
        A = function () {
            return C(_.title);
        },
        B = function () {
            return C(_.content);
        },
        S = function () {
            return C(_.image);
        },
        P = function () {
            return C(_.progresssteps);
        },
        E = function () {
            return C(_["validation-message"]);
        },
        L = function () {
            return C(_.confirm);
        },
        O = function () {
            return C(_.cancel);
        },
        Q = function () {
            return C(_.actions);
        },
        Y = function () {
            return C(_.footer);
        },
        $ = function () {
            return C(_.close);
        },
        J = function () {
            var e = f(k().querySelectorAll('[tabindex]:not([tabindex="-1"]):not([tabindex="0"])')).sort(function (e, t) {
                    return (e = parseInt(e.getAttribute("tabindex"))), (t = parseInt(t.getAttribute("tabindex"))) < e ? 1 : e < t ? -1 : 0;
                }),
                t = f(
                    k().querySelectorAll(
                        'a[href], area[href], input:not([disabled]), select:not([disabled]), textarea:not([disabled]), button:not([disabled]), iframe, object, embed, [tabindex="0"], [contenteditable], audio[controls], video[controls]'
                    )
                ).filter(function (e) {
                    return "-1" !== e.getAttribute("tabindex");
                });
            return (function (e) {
                for (var t = [], n = 0; n < e.length; n++) -1 === t.indexOf(e[n]) && t.push(e[n]);
                return t;
            })(e.concat(t)).filter(function (e) {
                return Z(e);
            });
        },
        T = function () {
            return !M() && !document.body.classList.contains(_["no-backdrop"]);
        },
        M = function () {
            return document.body.classList.contains(_["toast-shown"]);
        },
        j = function () {
            return "undefined" == typeof window || "undefined" == typeof document;
        },
        V = '\n <div aria-labelledby="'
            .concat(_.title, '" aria-describedby="')
            .concat(_.content, '" class="')
            .concat(_.popup, '" tabindex="-1">\n   <div class="')
            .concat(_.header, '">\n     <ul class="')
            .concat(_.progresssteps, '"></ul>\n     <div class="')
            .concat(_.icon, " ")
            .concat(g.error, '">\n       <span class="swal2-x-mark"><span class="swal2-x-mark-line-left"></span><span class="swal2-x-mark-line-right"></span></span>\n     </div>\n     <div class="')
            .concat(_.icon, " ")
            .concat(g.question, '">\n       <span class="')
            .concat(_["icon-text"], '">?</span>\n      </div>\n     <div class="')
            .concat(_.icon, " ")
            .concat(g.warning, '">\n       <span class="')
            .concat(_["icon-text"], '">!</span>\n      </div>\n     <div class="')
            .concat(_.icon, " ")
            .concat(g.info, '">\n       <span class="')
            .concat(_["icon-text"], '">i</span>\n      </div>\n     <div class="')
            .concat(_.icon, " ")
            .concat(
                g.success,
                '">\n       <div class="swal2-success-circular-line-left"></div>\n       <span class="swal2-success-line-tip"></span> <span class="swal2-success-line-long"></span>\n       <div class="swal2-success-ring"></div> <div class="swal2-success-fix"></div>\n       <div class="swal2-success-circular-line-right"></div>\n     </div>\n     <img class="'
            )
            .concat(_.image, '" />\n     <h2 class="')
            .concat(_.title, '" id="')
            .concat(_.title, '"></h2>\n     <button type="button" class="')
            .concat(_.close, '">×</button>\n   </div>\n   <div class="')
            .concat(_.content, '">\n     <div id="')
            .concat(_.content, '"></div>\n     <input class="')
            .concat(_.input, '" />\n     <input type="file" class="')
            .concat(_.file, '" />\n     <div class="')
            .concat(_.range, '">\n       <input type="range" />\n       <output></output>\n     </div>\n     <select class="')
            .concat(_.select, '"></select>\n     <div class="')
            .concat(_.radio, '"></div>\n     <label for="')
            .concat(_.checkbox, '" class="')
            .concat(_.checkbox, '">\n       <input type="checkbox" />\n       <span class="')
            .concat(_.label, '"></span>\n     </label>\n     <textarea class="')
            .concat(_.textarea, '"></textarea>\n     <div class="')
            .concat(_["validation-message"], '" id="')
            .concat(_["validation-message"], '"></div>\n   </div>\n   <div class="')
            .concat(_.actions, '">\n     <button type="button" class="')
            .concat(_.confirm, '">OK</button>\n     <button type="button" class="')
            .concat(_.cancel, '">Cancel</button>\n   </div>\n   <div class="')
            .concat(_.footer, '">\n   </div>\n </div>\n')
            .replace(/(^|\n)\s*/g, ""),
        X = function (e) {
            var t = w();
            if ((t && (t.parentNode.removeChild(t), W([document.documentElement, document.body], [_["no-backdrop"], _["toast-shown"], _["has-column"]])), !j())) {
                var n = document.createElement("div");
                (n.className = _.container), (n.innerHTML = V);
                var o = "string" == typeof e.target ? document.querySelector(e.target) : e.target;
                o.appendChild(n);
                var i,
                    r = k(),
                    a = B(),
                    s = U(a, _.input),
                    c = U(a, _.file),
                    u = a.querySelector(".".concat(_.range, " input")),
                    l = a.querySelector(".".concat(_.range, " output")),
                    d = U(a, _.select),
                    p = a.querySelector(".".concat(_.checkbox, " input")),
                    f = U(a, _.textarea);
                r.setAttribute("role", e.toast ? "alert" : "dialog"),
                    r.setAttribute("aria-live", e.toast ? "polite" : "assertive"),
                e.toast || r.setAttribute("aria-modal", "true"),
                "rtl" === window.getComputedStyle(o).direction && z(w(), _.rtl);
                var m = function (e) {
                    De.isVisible() && i !== e.target.value && De.resetValidationMessage(), (i = e.target.value);
                };
                return (
                    (s.oninput = m),
                        (c.onchange = m),
                        (d.onchange = m),
                        (p.onchange = m),
                        (f.oninput = m),
                        (u.oninput = function (e) {
                            m(e), (l.value = u.value);
                        }),
                        (u.onchange = function (e) {
                            m(e), (u.nextSibling.value = u.value);
                        }),
                        r
                );
            }
            I("SweetAlert2 requires document to initialize");
        },
        G = function (e, t) {
            if (!e) return F(t);
            if (e instanceof HTMLElement) t.appendChild(e);
            else if ("object" === q(e))
                if (((t.innerHTML = ""), 0 in e)) for (var n = 0; n in e; n++) t.appendChild(e[n].cloneNode(!0));
                else t.appendChild(e.cloneNode(!0));
            else e && (t.innerHTML = e);
            K(t);
        },
        ee = (function () {
            if (j()) return !1;
            var e = document.createElement("div"),
                t = { WebkitAnimation: "webkitAnimationEnd", OAnimation: "oAnimationEnd oanimationend", animation: "animationend" };
            for (var n in t) if (t.hasOwnProperty(n) && void 0 !== e.style[n]) return t[n];
            return !1;
        })(),
        te = function (e) {
            var t = Q(),
                n = L(),
                o = O();
            if (
                (e.showConfirmButton || e.showCancelButton ? K(t) : F(t),
                    e.showCancelButton ? (o.style.display = "inline-block") : F(o),
                    e.showConfirmButton ? n.style.removeProperty("display") : F(n),
                    (n.innerHTML = e.confirmButtonText),
                    (o.innerHTML = e.cancelButtonText),
                    n.setAttribute("aria-label", e.confirmButtonAriaLabel),
                    o.setAttribute("aria-label", e.cancelButtonAriaLabel),
                    (n.className = _.confirm),
                    z(n, e.confirmButtonClass),
                    (o.className = _.cancel),
                    z(o, e.cancelButtonClass),
                    e.buttonsStyling)
            ) {
                z([n, o], _.styled), e.confirmButtonColor && (n.style.backgroundColor = e.confirmButtonColor), e.cancelButtonColor && (o.style.backgroundColor = e.cancelButtonColor);
                var i = window.getComputedStyle(n).getPropertyValue("background-color");
                (n.style.borderLeftColor = i), (n.style.borderRightColor = i);
            } else W([n, o], _.styled), (n.style.backgroundColor = n.style.borderLeftColor = n.style.borderRightColor = ""), (o.style.backgroundColor = o.style.borderLeftColor = o.style.borderRightColor = "");
        },
        ne = function (e) {
            var t = B().querySelector("#" + _.content);
            e.html ? G(e.html, t) : e.text ? ((t.textContent = e.text), K(t)) : F(t);
        },
        oe = function (e) {
            for (var t = x(), n = 0; n < t.length; n++) F(t[n]);
            if (e.type)
                if (-1 !== Object.keys(g).indexOf(e.type)) {
                    var o = De.getPopup().querySelector(".".concat(_.icon, ".").concat(g[e.type]));
                    K(o), e.animation && z(o, "swal2-animate-".concat(e.type, "-icon"));
                } else I('Unknown type! Expected "success", "error", "warning", "info" or "question", got "'.concat(e.type, '"'));
        },
        ie = function (e) {
            var t = S();
            e.imageUrl
                ? (t.setAttribute("src", e.imageUrl),
                    t.setAttribute("alt", e.imageAlt),
                    K(t),
                    e.imageWidth ? t.setAttribute("width", e.imageWidth) : t.removeAttribute("width"),
                    e.imageHeight ? t.setAttribute("height", e.imageHeight) : t.removeAttribute("height"),
                    (t.className = _.image),
                e.imageClass && z(t, e.imageClass))
                : F(t);
        },
        re = function (i) {
            var r = P(),
                a = parseInt(null === i.currentProgressStep ? De.getQueueStep() : i.currentProgressStep, 10);
            i.progressSteps && i.progressSteps.length
                ? (K(r),
                    (r.innerHTML = ""),
                a >= i.progressSteps.length && R("Invalid currentProgressStep parameter, it should be less than progressSteps.length (currentProgressStep like JS arrays starts from 0)"),
                    i.progressSteps.forEach(function (e, t) {
                        var n = document.createElement("li");
                        if ((z(n, _.progresscircle), (n.innerHTML = e), t === a && z(n, _.activeprogressstep), r.appendChild(n), t !== i.progressSteps.length - 1)) {
                            var o = document.createElement("li");
                            z(o, _.progressline), i.progressStepsDistance && (o.style.width = i.progressStepsDistance), r.appendChild(o);
                        }
                    }))
                : F(r);
        },
        ae = function (e) {
            var t = A();
            e.titleText ? (t.innerText = e.titleText) : e.title && ("string" == typeof e.title && (e.title = e.title.split("\n").join("<br />")), G(e.title, t));
        },
        se = function () {
            null === b.previousBodyPadding &&
            document.body.scrollHeight > window.innerHeight &&
            ((b.previousBodyPadding = parseInt(window.getComputedStyle(document.body).getPropertyValue("padding-right"))),
                (document.body.style.paddingRight =
                    b.previousBodyPadding +
                    (function () {
                        if ("ontouchstart" in window || navigator.msMaxTouchPoints) return 0;
                        var e = document.createElement("div");
                        (e.style.width = "50px"), (e.style.height = "50px"), (e.style.overflow = "scroll"), document.body.appendChild(e);
                        var t = e.offsetWidth - e.clientWidth;
                        return document.body.removeChild(e), t;
                    })() +
                    "px"));
        },
        ce = function () {
            return !!window.MSInputMethodContext && !!document.documentMode;
        },
        ue = function () {
            var e = w(),
                t = k();
            e.style.removeProperty("align-items"), t.offsetTop < 0 && (e.style.alignItems = "flex-start");
        },
        le = {},
        de = function (e, t) {
            var n = w(),
                o = k();
            if (o) {
                null !== e && "function" == typeof e && e(o), W(o, _.show), z(o, _.hide);
                var i = function () {
                    M()
                        ? pe(t)
                        : (new Promise(function (e) {
                            var t = window.scrollX,
                                n = window.scrollY;
                            (le.restoreFocusTimeout = setTimeout(function () {
                                le.previousActiveElement && le.previousActiveElement.focus ? (le.previousActiveElement.focus(), (le.previousActiveElement = null)) : document.body && document.body.focus(), e();
                            }, 100)),
                            void 0 !== t && void 0 !== n && window.scrollTo(t, n);
                        }).then(function () {
                            return pe(t);
                        }),
                            le.keydownTarget.removeEventListener("keydown", le.keydownHandler, { capture: le.keydownListenerCapture }),
                            (le.keydownHandlerAdded = !1)),
                    n.parentNode && n.parentNode.removeChild(n),
                        W([document.documentElement, document.body], [_.shown, _["height-auto"], _["no-backdrop"], _["toast-shown"], _["toast-column"]]),
                    T() &&
                    (null !== b.previousBodyPadding && ((document.body.style.paddingRight = b.previousBodyPadding), (b.previousBodyPadding = null)),
                        (function () {
                            if (v(document.body, _.iosfix)) {
                                var e = parseInt(document.body.style.top, 10);
                                W(document.body, _.iosfix), (document.body.style.top = ""), (document.body.scrollTop = -1 * e);
                            }
                        })(),
                    "undefined" != typeof window && ce() && window.removeEventListener("resize", ue),
                        f(document.body.children).forEach(function (e) {
                            e.hasAttribute("data-previous-aria-hidden") ? (e.setAttribute("aria-hidden", e.getAttribute("data-previous-aria-hidden")), e.removeAttribute("data-previous-aria-hidden")) : e.removeAttribute("aria-hidden");
                        }));
                };
                ee && !v(o, _.noanimation)
                    ? o.addEventListener(ee, function e() {
                        o.removeEventListener(ee, e), v(o, _.hide) && i();
                    })
                    : i();
            }
        },
        pe = function (e) {
            null !== e &&
            "function" == typeof e &&
            setTimeout(function () {
                e();
            });
        };
    function fe(e) {
        var t = function e() {
            for (var t = arguments.length, n = new Array(t), o = 0; o < t; o++) n[o] = arguments[o];
            if (!(this instanceof e)) return l(e, n);
            Object.getPrototypeOf(e).apply(this, n);
        };
        return (t.prototype = r(Object.create(e.prototype), { constructor: t })), "function" == typeof Object.setPrototypeOf ? Object.setPrototypeOf(t, e) : (t.__proto__ = e), t;
    }
    var me = {
            title: "",
            titleText: "",
            text: "",
            html: "",
            footer: "",
            type: null,
            toast: !1,
            customClass: "",
            customContainerClass: "",
            target: "body",
            backdrop: !0,
            animation: !0,
            heightAuto: !0,
            allowOutsideClick: !0,
            allowEscapeKey: !0,
            allowEnterKey: !0,
            stopKeydownPropagation: !0,
            keydownListenerCapture: !1,
            showConfirmButton: !0,
            showCancelButton: !1,
            preConfirm: null,
            confirmButtonText: "OK",
            confirmButtonAriaLabel: "",
            confirmButtonColor: null,
            confirmButtonClass: null,
            cancelButtonText: "Cancel",
            cancelButtonAriaLabel: "",
            cancelButtonColor: null,
            cancelButtonClass: null,
            buttonsStyling: !0,
            reverseButtons: !1,
            focusConfirm: !0,
            focusCancel: !1,
            showCloseButton: !1,
            closeButtonAriaLabel: "Close this dialog",
            showLoaderOnConfirm: !1,
            imageUrl: null,
            imageWidth: null,
            imageHeight: null,
            imageAlt: "",
            imageClass: null,
            timer: null,
            width: null,
            padding: null,
            background: null,
            input: null,
            inputPlaceholder: "",
            inputValue: "",
            inputOptions: {},
            inputAutoTrim: !0,
            inputClass: null,
            inputAttributes: {},
            inputValidator: null,
            validationMessage: null,
            grow: !1,
            position: "center",
            progressSteps: [],
            currentProgressStep: null,
            progressStepsDistance: null,
            onBeforeOpen: null,
            onAfterClose: null,
            onOpen: null,
            onClose: null,
            useRejections: !1,
            expectRejections: !1,
        },
        he = ["useRejections", "expectRejections", "extraParams"],
        ge = ["allowOutsideClick", "allowEnterKey", "backdrop", "focusConfirm", "focusCancel", "heightAuto", "keydownListenerCapture"],
        be = function (e) {
            return me.hasOwnProperty(e) || "extraParams" === e;
        },
        ve = function (e) {
            return -1 !== he.indexOf(e);
        },
        ye = function (e) {
            for (var t in e)
                be(t) || R('Unknown parameter "'.concat(t, '"')),
                e.toast && -1 !== ge.indexOf(t) && R('The parameter "'.concat(t, '" is incompatible with toasts')),
                ve(t) && m('The parameter "'.concat(t, '" is deprecated and will be removed in the next major release.'));
        },
        we =
            '"setDefaults" & "resetDefaults" methods are deprecated in favor of "mixin" method and will be removed in the next major release. For new projects, use "mixin". For past projects already using "setDefaults", support will be provided through an additional package.',
        Ce = {};
    var ke = [],
        xe = function () {
            var e = k();
            e || De(""), (e = k());
            var t = Q(),
                n = L(),
                o = O();
            K(t), K(n), z([e, t], _.loading), (n.disabled = !0), (o.disabled = !0), e.setAttribute("data-loading", !0), e.setAttribute("aria-busy", !0), e.focus();
        },
        Ae = Object.freeze({
            isValidParameter: be,
            isDeprecatedParameter: ve,
            argsToParams: function (n) {
                var o = {};
                switch (q(n[0])) {
                    case "object":
                        r(o, n[0]);
                        break;
                    default:
                        ["title", "html", "type"].forEach(function (e, t) {
                            switch (q(n[t])) {
                                case "string":
                                    o[e] = n[t];
                                    break;
                                case "undefined":
                                    break;
                                default:
                                    I("Unexpected type of ".concat(e, '! Expected "string", got ').concat(q(n[t])));
                            }
                        });
                }
                return o;
            },
            adaptInputValidator: function (n) {
                return function (e, t) {
                    return n.call(this, e, t).then(
                        function () {},
                        function (e) {
                            return e;
                        }
                    );
                };
            },
            close: de,
            closePopup: de,
            closeModal: de,
            closeToast: de,
            isVisible: function () {
                return !!k();
            },
            clickConfirm: function () {
                return L().click();
            },
            clickCancel: function () {
                return O().click();
            },
            getContainer: w,
            getPopup: k,
            getTitle: A,
            getContent: B,
            getImage: S,
            getIcons: x,
            getCloseButton: $,
            getButtonsWrapper: function () {
                return m("swal.getButtonsWrapper() is deprecated and will be removed in the next major release, use swal.getActions() instead"), C(_.actions);
            },
            getActions: Q,
            getConfirmButton: L,
            getCancelButton: O,
            getFooter: Y,
            getFocusableElements: J,
            getValidationMessage: E,
            isLoading: function () {
                return k().hasAttribute("data-loading");
            },
            fire: function () {
                for (var e = arguments.length, t = new Array(e), n = 0; n < e; n++) t[n] = arguments[n];
                return l(this, t);
            },
            mixin: function (n) {
                return fe(
                    (function (e) {
                        function t() {
                            return a(this, t), d(this, c(t).apply(this, arguments));
                        }
                        return (
                            s(t, e),
                                i(t, [
                                    {
                                        key: "_main",
                                        value: function (e) {
                                            return p(c(t.prototype), "_main", this).call(this, r({}, n, e));
                                        },
                                    },
                                ]),
                                t
                        );
                    })(this)
                );
            },
            queue: function (e) {
                var r = this;
                ke = e;
                var a = function () {
                        (ke = []), document.body.removeAttribute("data-swal2-queue-step");
                    },
                    s = [];
                return new Promise(function (i) {
                    !(function t(n, o) {
                        n < ke.length
                            ? (document.body.setAttribute("data-swal2-queue-step", n),
                                r(ke[n]).then(function (e) {
                                    void 0 !== e.value ? (s.push(e.value), t(n + 1, o)) : (a(), i({ dismiss: e.dismiss }));
                                }))
                            : (a(), i({ value: s }));
                    })(0);
                });
            },
            getQueueStep: function () {
                return document.body.getAttribute("data-swal2-queue-step");
            },
            insertQueueStep: function (e, t) {
                return t && t < ke.length ? ke.splice(t, 0, e) : ke.push(e);
            },
            deleteQueueStep: function (e) {
                void 0 !== ke[e] && ke.splice(e, 1);
            },
            showLoading: xe,
            enableLoading: xe,
            getTimerLeft: function () {
                return le.timeout && le.timeout.getTimerLeft();
            },
            stopTimer: function () {
                return le.timeout && le.timeout.stop();
            },
            resumeTimer: function () {
                return le.timeout && le.timeout.start();
            },
            toggleTimer: function () {
                var e = le.timeout;
                return e && (e.running ? e.stop() : e.start());
            },
            increaseTimer: function (e) {
                return le.timeout && le.timeout.increase(e);
            },
            isTimerRunning: function () {
                return le.timeout && le.timeout.isRunning();
            },
        }),
        Be =
            "function" == typeof Symbol
                ? Symbol
                : (function () {
                    var t = 0;
                    function e(e) {
                        return "__" + e + "_" + Math.floor(1e9 * Math.random()) + "_" + ++t + "__";
                    }
                    return (e.iterator = e("Symbol.iterator")), e;
                })(),
        Se =
            "function" == typeof WeakMap
                ? WeakMap
                : (function (n, o, t) {
                    function e() {
                        o(this, n, { value: Be("WeakMap") });
                    }
                    return (
                        (e.prototype = {
                            delete: function (e) {
                                delete e[this[n]];
                            },
                            get: function (e) {
                                return e[this[n]];
                            },
                            has: function (e) {
                                return t.call(e, this[n]);
                            },
                            set: function (e, t) {
                                o(e, this[n], { configurable: !0, value: t });
                            },
                        }),
                            e
                    );
                })(Be("WeakMap"), Object.defineProperty, {}.hasOwnProperty),
        Pe = { promise: new Se(), innerParams: new Se(), domCache: new Se() };
    function Ee() {
        var e = Pe.innerParams.get(this),
            t = Pe.domCache.get(this);
        e.showConfirmButton || (F(t.confirmButton), e.showCancelButton || F(t.actions)),
            W([t.popup, t.actions], _.loading),
            t.popup.removeAttribute("aria-busy"),
            t.popup.removeAttribute("data-loading"),
            (t.confirmButton.disabled = !1),
            (t.cancelButton.disabled = !1);
    }
    function Le(e) {
        var t = Pe.domCache.get(this);
        t.validationMessage.innerHTML = e;
        var n = window.getComputedStyle(t.popup);
        (t.validationMessage.style.marginLeft = "-".concat(n.getPropertyValue("padding-left"))), (t.validationMessage.style.marginRight = "-".concat(n.getPropertyValue("padding-right"))), K(t.validationMessage);
        var o = this.getInput();
        o && (o.setAttribute("aria-invalid", !0), o.setAttribute("aria-describedBy", _["validation-message"]), N(o), z(o, _.inputerror));
    }
    function Oe() {
        var e = Pe.domCache.get(this);
        e.validationMessage && F(e.validationMessage);
        var t = this.getInput();
        t && (t.removeAttribute("aria-invalid"), t.removeAttribute("aria-describedBy"), W(t, _.inputerror));
    }
    var Te = function e(t, n) {
            a(this, e);
            var o,
                i,
                r = n;
            (this.running = !1),
                (this.start = function () {
                    return this.running || ((this.running = !0), (i = new Date()), (o = setTimeout(t, r))), r;
                }),
                (this.stop = function () {
                    return this.running && ((this.running = !1), clearTimeout(o), (r -= new Date() - i)), r;
                }),
                (this.increase = function (e) {
                    var t = this.running;
                    return t && this.stop(), (r += e), t && this.start(), r;
                }),
                (this.getTimerLeft = function () {
                    return this.running && (this.stop(), this.start()), r;
                }),
                (this.isRunning = function () {
                    return this.running;
                }),
                this.start();
        },
        Me = {
            email: function (e, t) {
                return /^[a-zA-Z0-9.+_-]+@[a-zA-Z0-9.-]+\.[a-zA-Z0-9-]{2,24}$/.test(e) ? Promise.resolve() : Promise.reject(t && t.validationMessage ? t.validationMessage : "Invalid email address");
            },
            url: function (e, t) {
                return /^https?:\/\/(www\.)?[-a-zA-Z0-9@:%._+~#=]{2,256}\.[a-z]{2,63}\b([-a-zA-Z0-9@:%_+.~#?&//=]*)$/.test(e) ? Promise.resolve() : Promise.reject(t && t.validationMessage ? t.validationMessage : "Invalid URL");
            },
        };
    var je = function (e) {
        var t = w(),
            n = k();
        null !== e.onBeforeOpen && "function" == typeof e.onBeforeOpen && e.onBeforeOpen(n),
            e.animation ? (z(n, _.show), z(t, _.fade), W(n, _.hide)) : W(n, _.fade),
            K(n),
            (t.style.overflowY = "hidden"),
            ee && !v(n, _.noanimation)
                ? n.addEventListener(ee, function e() {
                    n.removeEventListener(ee, e), (t.style.overflowY = "auto");
                })
                : (t.style.overflowY = "auto"),
            z([document.documentElement, document.body, t], _.shown),
        e.heightAuto && e.backdrop && !e.toast && z([document.documentElement, document.body], _["height-auto"]),
        T() &&
        (se(),
            (function () {
                if (/iPad|iPhone|iPod/.test(navigator.userAgent) && !window.MSStream && !v(document.body, _.iosfix)) {
                    var e = document.body.scrollTop;
                    (document.body.style.top = -1 * e + "px"), z(document.body, _.iosfix);
                }
            })(),
        "undefined" != typeof window && ce() && (ue(), window.addEventListener("resize", ue)),
            f(document.body.children).forEach(function (e) {
                e === w() ||
                (function (e, t) {
                    if ("function" == typeof e.contains) return e.contains(t);
                })(e, w()) ||
                (e.hasAttribute("aria-hidden") && e.setAttribute("data-previous-aria-hidden", e.getAttribute("aria-hidden")), e.setAttribute("aria-hidden", "true"));
            }),
            setTimeout(function () {
                t.scrollTop = 0;
            })),
        M() || le.previousActiveElement || (le.previousActiveElement = document.activeElement),
        null !== e.onOpen &&
        "function" == typeof e.onOpen &&
        setTimeout(function () {
            e.onOpen(n);
        });
    };
    var Ve,
        qe = Object.freeze({
            hideLoading: Ee,
            disableLoading: Ee,
            getInput: function (e) {
                var t = Pe.innerParams.get(this),
                    n = Pe.domCache.get(this);
                if (!(e = e || t.input)) return null;
                switch (e) {
                    case "select":
                    case "textarea":
                    case "file":
                        return U(n.content, _[e]);
                    case "checkbox":
                        return n.popup.querySelector(".".concat(_.checkbox, " input"));
                    case "radio":
                        return n.popup.querySelector(".".concat(_.radio, " input:checked")) || n.popup.querySelector(".".concat(_.radio, " input:first-child"));
                    case "range":
                        return n.popup.querySelector(".".concat(_.range, " input"));
                    default:
                        return U(n.content, _.input);
                }
            },
            enableButtons: function () {
                var e = Pe.domCache.get(this);
                (e.confirmButton.disabled = !1), (e.cancelButton.disabled = !1);
            },
            disableButtons: function () {
                var e = Pe.domCache.get(this);
                (e.confirmButton.disabled = !0), (e.cancelButton.disabled = !0);
            },
            enableConfirmButton: function () {
                Pe.domCache.get(this).confirmButton.disabled = !1;
            },
            disableConfirmButton: function () {
                Pe.domCache.get(this).confirmButton.disabled = !0;
            },
            enableInput: function () {
                var e = this.getInput();
                if (!e) return !1;
                if ("radio" === e.type) for (var t = e.parentNode.parentNode.querySelectorAll("input"), n = 0; n < t.length; n++) t[n].disabled = !1;
                else e.disabled = !1;
            },
            disableInput: function () {
                var e = this.getInput();
                if (!e) return !1;
                if (e && "radio" === e.type) for (var t = e.parentNode.parentNode.querySelectorAll("input"), n = 0; n < t.length; n++) t[n].disabled = !0;
                else e.disabled = !0;
            },
            showValidationMessage: Le,
            resetValidationMessage: Oe,
            resetValidationError: function () {
                m("Swal.resetValidationError() is deprecated and will be removed in the next major release, use Swal.resetValidationMessage() instead"), Oe.bind(this)();
            },
            showValidationError: function (e) {
                m("Swal.showValidationError() is deprecated and will be removed in the next major release, use Swal.showValidationMessage() instead"), Le.bind(this)(e);
            },
            getProgressSteps: function () {
                return Pe.innerParams.get(this).progressSteps;
            },
            setProgressSteps: function (e) {
                var t = r({}, Pe.innerParams.get(this), { progressSteps: e });
                Pe.innerParams.set(this, t), re(t);
            },
            showProgressSteps: function () {
                var e = Pe.domCache.get(this);
                K(e.progressSteps);
            },
            hideProgressSteps: function () {
                var e = Pe.domCache.get(this);
                F(e.progressSteps);
            },
            _main: function (e) {
                var T = this;
                ye(e);
                var M = r({}, me, e);
                !(function (t) {
                    var e;
                    t.inputValidator ||
                    Object.keys(Me).forEach(function (e) {
                        t.input === e && (t.inputValidator = t.expectRejections ? Me[e] : De.adaptInputValidator(Me[e]));
                    }),
                    t.validationMessage && ("object" !== q(t.extraParams) && (t.extraParams = {}), (t.extraParams.validationMessage = t.validationMessage)),
                    (!t.target || ("string" == typeof t.target && !document.querySelector(t.target)) || ("string" != typeof t.target && !t.target.appendChild)) &&
                    (R('Target parameter is not valid, defaulting to "body"'), (t.target = "body")),
                    "function" == typeof t.animation && (t.animation = t.animation.call());
                    var n = k(),
                        o = "string" == typeof t.target ? document.querySelector(t.target) : t.target;
                    (e = n && o && n.parentNode !== o.parentNode ? X(t) : n || X(t)),
                    t.width && (e.style.width = "number" == typeof t.width ? t.width + "px" : t.width),
                    t.padding && (e.style.padding = "number" == typeof t.padding ? t.padding + "px" : t.padding),
                    t.background && (e.style.background = t.background);
                    for (var i = window.getComputedStyle(e).getPropertyValue("background-color"), r = e.querySelectorAll("[class^=swal2-success-circular-line], .swal2-success-fix"), a = 0; a < r.length; a++) r[a].style.backgroundColor = i;
                    var s = w(),
                        c = $(),
                        u = Y();
                    if (
                        (ae(t),
                            ne(t),
                            "string" == typeof t.backdrop ? (w().style.background = t.backdrop) : t.backdrop || z([document.documentElement, document.body], _["no-backdrop"]),
                        !t.backdrop && t.allowOutsideClick && R('"allowOutsideClick" parameter requires `backdrop` parameter to be set to `true`'),
                            t.position in _ ? z(s, _[t.position]) : (R('The "position" parameter is not valid, defaulting to "center"'), z(s, _.center)),
                        t.grow && "string" == typeof t.grow)
                    ) {
                        var l = "grow-" + t.grow;
                        l in _ && z(s, _[l]);
                    }
                    t.showCloseButton ? (c.setAttribute("aria-label", t.closeButtonAriaLabel), K(c)) : F(c),
                        (e.className = _.popup),
                        t.toast ? (z([document.documentElement, document.body], _["toast-shown"]), z(e, _.toast)) : z(e, _.modal),
                    t.customClass && z(e, t.customClass),
                    t.customContainerClass && z(s, t.customContainerClass),
                        re(t),
                        oe(t),
                        ie(t),
                        te(t),
                        G(t.footer, u),
                        !0 === t.animation ? W(e, _.noanimation) : z(e, _.noanimation),
                    t.showLoaderOnConfirm &&
                    !t.preConfirm &&
                    R("showLoaderOnConfirm is set to true, but preConfirm is not defined.\nshowLoaderOnConfirm should be used together with preConfirm, see usage example:\nhttps://sweetalert2.github.io/#ajax-request");
                })(M),
                    Object.freeze(M),
                    Pe.innerParams.set(this, M),
                le.timeout && (le.timeout.stop(), delete le.timeout),
                    clearTimeout(le.restoreFocusTimeout);
                var j = { popup: k(), container: w(), content: B(), actions: Q(), confirmButton: L(), cancelButton: O(), closeButton: $(), validationMessage: E(), progressSteps: P() };
                Pe.domCache.set(this, j);
                var V = this.constructor;
                return new Promise(function (t, n) {
                    var o = function (e) {
                            V.closePopup(M.onClose, M.onAfterClose), M.useRejections ? t(e) : t({ value: e });
                        },
                        c = function (e) {
                            V.closePopup(M.onClose, M.onAfterClose), M.useRejections ? n(e) : t({ dismiss: e });
                        },
                        u = function (e) {
                            V.closePopup(M.onClose, M.onAfterClose), n(e);
                        };
                    M.timer &&
                    (le.timeout = new Te(function () {
                        c("timer"), delete le.timeout;
                    }, M.timer)),
                    M.input &&
                    setTimeout(function () {
                        var e = T.getInput();
                        e && N(e);
                    }, 0);
                    for (
                        var l = function (t) {
                                if ((M.showLoaderOnConfirm && V.showLoading(), M.preConfirm)) {
                                    T.resetValidationMessage();
                                    var e = Promise.resolve().then(function () {
                                        return M.preConfirm(t, M.extraParams);
                                    });
                                    M.expectRejections
                                        ? e.then(
                                        function (e) {
                                            return o(e || t);
                                        },
                                        function (e) {
                                            T.hideLoading(), e && T.showValidationMessage(e);
                                        }
                                        )
                                        : e.then(
                                        function (e) {
                                            Z(j.validationMessage) || !1 === e ? T.hideLoading() : o(e || t);
                                        },
                                        function (e) {
                                            return u(e);
                                        }
                                        );
                                } else o(t);
                            },
                            e = function (e) {
                                var t = e.target,
                                    n = j.confirmButton,
                                    o = j.cancelButton,
                                    i = n && (n === t || n.contains(t)),
                                    r = o && (o === t || o.contains(t));
                                switch (e.type) {
                                    case "click":
                                        if (i && V.isVisible())
                                            if ((T.disableButtons(), M.input)) {
                                                var a = (function () {
                                                    var e = T.getInput();
                                                    if (!e) return null;
                                                    switch (M.input) {
                                                        case "checkbox":
                                                            return e.checked ? 1 : 0;
                                                        case "radio":
                                                            return e.checked ? e.value : null;
                                                        case "file":
                                                            return e.files.length ? e.files[0] : null;
                                                        default:
                                                            return M.inputAutoTrim ? e.value.trim() : e.value;
                                                    }
                                                })();
                                                if (M.inputValidator) {
                                                    T.disableInput();
                                                    var s = Promise.resolve().then(function () {
                                                        return M.inputValidator(a, M.extraParams);
                                                    });
                                                    M.expectRejections
                                                        ? s.then(
                                                        function () {
                                                            T.enableButtons(), T.enableInput(), l(a);
                                                        },
                                                        function (e) {
                                                            T.enableButtons(), T.enableInput(), e && T.showValidationMessage(e);
                                                        }
                                                        )
                                                        : s.then(
                                                        function (e) {
                                                            T.enableButtons(), T.enableInput(), e ? T.showValidationMessage(e) : l(a);
                                                        },
                                                        function (e) {
                                                            return u(e);
                                                        }
                                                        );
                                                } else T.getInput().checkValidity() ? l(a) : (T.enableButtons(), T.showValidationMessage(M.validationMessage));
                                            } else l(!0);
                                        else r && V.isVisible() && (T.disableButtons(), c(V.DismissReason.cancel));
                                }
                            },
                            i = j.popup.querySelectorAll("button"),
                            r = 0;
                        r < i.length;
                        r++
                    )
                        (i[r].onclick = e), (i[r].onmouseover = e), (i[r].onmouseout = e), (i[r].onmousedown = e);
                    if (
                        ((j.closeButton.onclick = function () {
                            c(V.DismissReason.close);
                        }),
                            M.toast)
                    )
                        j.popup.onclick = function () {
                            M.showConfirmButton || M.showCancelButton || M.showCloseButton || M.input || c(V.DismissReason.close);
                        };
                    else {
                        var a = !1;
                        (j.popup.onmousedown = function () {
                            j.container.onmouseup = function (e) {
                                (j.container.onmouseup = void 0), e.target === j.container && (a = !0);
                            };
                        }),
                            (j.container.onmousedown = function () {
                                j.popup.onmouseup = function (e) {
                                    (j.popup.onmouseup = void 0), (e.target === j.popup || j.popup.contains(e.target)) && (a = !0);
                                };
                            }),
                            (j.container.onclick = function (e) {
                                a ? (a = !1) : e.target === j.container && H(M.allowOutsideClick) && c(V.DismissReason.backdrop);
                            });
                    }
                    M.reverseButtons ? j.confirmButton.parentNode.insertBefore(j.cancelButton, j.confirmButton) : j.confirmButton.parentNode.insertBefore(j.confirmButton, j.cancelButton);
                    var s = function (e, t) {
                        for (var n = J(M.focusCancel), o = 0; o < n.length; o++) return (e += t) === n.length ? (e = 0) : -1 === e && (e = n.length - 1), n[e].focus();
                        j.popup.focus();
                    };
                    le.keydownHandlerAdded && (le.keydownTarget.removeEventListener("keydown", le.keydownHandler, { capture: le.keydownListenerCapture }), (le.keydownHandlerAdded = !1)),
                    M.toast ||
                    ((le.keydownHandler = function (e) {
                        return (function (e, t) {
                            if ((t.stopKeydownPropagation && e.stopPropagation(), "Enter" !== e.key || e.isComposing))
                                if ("Tab" === e.key) {
                                    for (var n = e.target, o = J(t.focusCancel), i = -1, r = 0; r < o.length; r++)
                                        if (n === o[r]) {
                                            i = r;
                                            break;
                                        }
                                    e.shiftKey ? s(i, -1) : s(i, 1), e.stopPropagation(), e.preventDefault();
                                } else
                                    -1 !== ["ArrowLeft", "ArrowRight", "ArrowUp", "ArrowDown", "Left", "Right", "Up", "Down"].indexOf(e.key)
                                        ? document.activeElement === j.confirmButton && Z(j.cancelButton)
                                        ? j.cancelButton.focus()
                                        : document.activeElement === j.cancelButton && Z(j.confirmButton) && j.confirmButton.focus()
                                        : ("Escape" !== e.key && "Esc" !== e.key) || !0 !== H(t.allowEscapeKey) || (e.preventDefault(), c(V.DismissReason.esc));
                            else if (e.target && T.getInput() && e.target.outerHTML === T.getInput().outerHTML) {
                                if (-1 !== ["textarea", "file"].indexOf(t.input)) return;
                                V.clickConfirm(), e.preventDefault();
                            }
                        })(e, M);
                    }),
                        (le.keydownTarget = M.keydownListenerCapture ? window : j.popup),
                        (le.keydownListenerCapture = M.keydownListenerCapture),
                        le.keydownTarget.addEventListener("keydown", le.keydownHandler, { capture: le.keydownListenerCapture }),
                        (le.keydownHandlerAdded = !0)),
                        T.enableButtons(),
                        T.hideLoading(),
                        T.resetValidationMessage(),
                        M.toast && (M.input || M.footer || M.showCloseButton) ? z(document.body, _["toast-column"]) : W(document.body, _["toast-column"]);
                    for (
                        var d,
                            p,
                            f = ["input", "file", "range", "select", "radio", "checkbox", "textarea"],
                            m = function (e) {
                                (e.placeholder && !M.inputPlaceholder) || (e.placeholder = M.inputPlaceholder);
                            },
                            h = 0;
                        h < f.length;
                        h++
                    ) {
                        var g = _[f[h]],
                            b = U(j.content, g);
                        if ((d = T.getInput(f[h]))) {
                            for (var v in d.attributes)
                                if (d.attributes.hasOwnProperty(v)) {
                                    var y = d.attributes[v].name;
                                    "type" !== y && "value" !== y && d.removeAttribute(y);
                                }
                            for (var w in M.inputAttributes) ("range" === f[h] && "placeholder" === w) || d.setAttribute(w, M.inputAttributes[w]);
                        }
                        (b.className = g), M.inputClass && z(b, M.inputClass), F(b);
                    }
                    switch (M.input) {
                        case "text":
                        case "email":
                        case "password":
                        case "number":
                        case "tel":
                        case "url":
                            (d = U(j.content, _.input)),
                                "string" == typeof M.inputValue || "number" == typeof M.inputValue
                                    ? (d.value = M.inputValue)
                                    : D(M.inputValue) || R('Unexpected type of inputValue! Expected "string", "number" or "Promise", got "'.concat(q(M.inputValue), '"')),
                                m(d),
                                (d.type = M.input),
                                K(d);
                            break;
                        case "file":
                            m((d = U(j.content, _.file))), (d.type = M.input), K(d);
                            break;
                        case "range":
                            var C = U(j.content, _.range),
                                k = C.querySelector("input"),
                                x = C.querySelector("output");
                            (k.value = M.inputValue), (k.type = M.input), (x.value = M.inputValue), K(C);
                            break;
                        case "select":
                            var A = U(j.content, _.select);
                            if (((A.innerHTML = ""), M.inputPlaceholder)) {
                                var B = document.createElement("option");
                                (B.innerHTML = M.inputPlaceholder), (B.value = ""), (B.disabled = !0), (B.selected = !0), A.appendChild(B);
                            }
                            p = function (e) {
                                e.forEach(function (e) {
                                    var t = e[0],
                                        n = e[1],
                                        o = document.createElement("option");
                                    (o.value = t), (o.innerHTML = n), M.inputValue.toString() === t.toString() && (o.selected = !0), A.appendChild(o);
                                }),
                                    K(A),
                                    A.focus();
                            };
                            break;
                        case "radio":
                            var S = U(j.content, _.radio);
                            (S.innerHTML = ""),
                                (p = function (e) {
                                    e.forEach(function (e) {
                                        var t = e[0],
                                            n = e[1],
                                            o = document.createElement("input"),
                                            i = document.createElement("label");
                                        (o.type = "radio"), (o.name = _.radio), (o.value = t), M.inputValue.toString() === t.toString() && (o.checked = !0);
                                        var r = document.createElement("span");
                                        (r.innerHTML = n), (r.className = _.label), i.appendChild(o), i.appendChild(r), S.appendChild(i);
                                    }),
                                        K(S);
                                    var t = S.querySelectorAll("input");
                                    t.length && t[0].focus();
                                });
                            break;
                        case "checkbox":
                            var P = U(j.content, _.checkbox),
                                E = T.getInput("checkbox");
                            (E.type = "checkbox"), (E.value = 1), (E.id = _.checkbox), (E.checked = Boolean(M.inputValue)), (P.querySelector("span").innerHTML = M.inputPlaceholder), K(P);
                            break;
                        case "textarea":
                            var L = U(j.content, _.textarea);
                            (L.value = M.inputValue), m(L), K(L);
                            break;
                        case null:
                            break;
                        default:
                            I('Unexpected type of input! Expected "text", "email", "password", "number", "tel", "select", "radio", "checkbox", "textarea", "file" or "url", got "'.concat(M.input, '"'));
                    }
                    if ("select" === M.input || "radio" === M.input) {
                        var O = function (e) {
                            return p(
                                ((t = e),
                                    (n = []),
                                    "undefined" != typeof Map && t instanceof Map
                                        ? t.forEach(function (e, t) {
                                            n.push([t, e]);
                                        })
                                        : Object.keys(t).forEach(function (e) {
                                            n.push([e, t[e]]);
                                        }),
                                    n)
                            );
                            var t, n;
                        };
                        D(M.inputOptions)
                            ? (V.showLoading(),
                                M.inputOptions.then(function (e) {
                                    T.hideLoading(), O(e);
                                }))
                            : "object" === q(M.inputOptions)
                            ? O(M.inputOptions)
                            : I("Unexpected type of inputOptions! Expected object, Map or Promise, got ".concat(q(M.inputOptions)));
                    } else
                        -1 !== ["text", "email", "number", "tel", "textarea"].indexOf(M.input) &&
                        D(M.inputValue) &&
                        (V.showLoading(),
                            F(d),
                            M.inputValue
                                .then(function (e) {
                                    (d.value = "number" === M.input ? parseFloat(e) || 0 : e + ""), K(d), d.focus(), T.hideLoading();
                                })
                                .catch(function (e) {
                                    I("Error in inputValue promise: " + e), (d.value = ""), K(d), d.focus(), T.hideLoading();
                                }));
                    je(M),
                    M.toast ||
                    (H(M.allowEnterKey)
                        ? M.focusCancel && Z(j.cancelButton)
                            ? j.cancelButton.focus()
                            : M.focusConfirm && Z(j.confirmButton)
                                ? j.confirmButton.focus()
                                : s(-1, 1)
                        : document.activeElement && "function" == typeof document.activeElement.blur && document.activeElement.blur()),
                        (j.container.scrollTop = 0);
                });
            },
        });
    function Re() {
        if ("undefined" != typeof window) {
            "undefined" == typeof Promise &&
            I("This package requires a Promise library, please include a shim to enable it in this browser (See: https://github.com/sweetalert2/sweetalert2/wiki/Migration-from-SweetAlert-to-SweetAlert2#1-ie-support)"),
                (Ve = this);
            for (var e = arguments.length, t = new Array(e), n = 0; n < e; n++) t[n] = arguments[n];
            var o = Object.freeze(this.constructor.argsToParams(t));
            Object.defineProperties(this, { params: { value: o, writable: !1, enumerable: !0 } });
            var i = this._main(this.params);
            Pe.promise.set(this, i);
        }
    }
    (Re.prototype.then = function (e, t) {
        return Pe.promise.get(this).then(e, t);
    }),
        (Re.prototype.catch = function (e) {
            return Pe.promise.get(this).catch(e);
        }),
        (Re.prototype.finally = function (e) {
            return Pe.promise.get(this).finally(e);
        }),
        r(Re.prototype, qe),
        r(Re, Ae),
        Object.keys(qe).forEach(function (t) {
            Re[t] = function () {
                var e;
                if (Ve) return (e = Ve)[t].apply(e, arguments);
            };
        }),
        (Re.DismissReason = e),
        (Re.noop = function () {});
    var Ie,
        He,
        De = fe(
            ((Ie = Re),
                (He = (function (e) {
                    function t() {
                        return a(this, t), d(this, c(t).apply(this, arguments));
                    }
                    return (
                        s(t, Ie),
                            i(
                                t,
                                [
                                    {
                                        key: "_main",
                                        value: function (e) {
                                            return p(c(t.prototype), "_main", this).call(this, r({}, Ce, e));
                                        },
                                    },
                                ],
                                [
                                    {
                                        key: "setDefaults",
                                        value: function (t) {
                                            if ((m(we), !t || "object" !== q(t))) throw new TypeError("SweetAlert2: The argument for setDefaults() is required and has to be a object");
                                            ye(t),
                                                Object.keys(t).forEach(function (e) {
                                                    Ie.isValidParameter(e) && (Ce[e] = t[e]);
                                                });
                                        },
                                    },
                                    {
                                        key: "resetDefaults",
                                        value: function () {
                                            m(we), (Ce = {});
                                        },
                                    },
                                ]
                            ),
                            t
                    );
                })()),
            "undefined" != typeof window && "object" === q(window._swalDefaults) && He.setDefaults(window._swalDefaults),
                He)
        );
    return (De.default = De);
}),
"undefined" != typeof window && window.Sweetalert2 && ((window.Sweetalert2.version = "7.33.1"), (window.swal = window.sweetAlert = window.Swal = window.SweetAlert = window.Sweetalert2));
"undefined" != typeof document &&
(function (e, t) {
    var n = e.createElement("style");
    if ((e.getElementsByTagName("head")[0].appendChild(n), n.styleSheet)) n.styleSheet.disabled || (n.styleSheet.cssText = t);
    else
        try {
            n.innerHTML = t;
        } catch (e) {
            n.innerText = t;
        }
})(
    document,
    "@-webkit-keyframes swal2-show{0%{-webkit-transform:scale(.7);transform:scale(.7)}45%{-webkit-transform:scale(1.05);transform:scale(1.05)}80%{-webkit-transform:scale(.95);transform:scale(.95)}100%{-webkit-transform:scale(1);transform:scale(1)}}@keyframes swal2-show{0%{-webkit-transform:scale(.7);transform:scale(.7)}45%{-webkit-transform:scale(1.05);transform:scale(1.05)}80%{-webkit-transform:scale(.95);transform:scale(.95)}100%{-webkit-transform:scale(1);transform:scale(1)}}@-webkit-keyframes swal2-hide{0%{-webkit-transform:scale(1);transform:scale(1);opacity:1}100%{-webkit-transform:scale(.5);transform:scale(.5);opacity:0}}@keyframes swal2-hide{0%{-webkit-transform:scale(1);transform:scale(1);opacity:1}100%{-webkit-transform:scale(.5);transform:scale(.5);opacity:0}}@-webkit-keyframes swal2-animate-success-line-tip{0%{top:1.1875em;left:.0625em;width:0}54%{top:1.0625em;left:.125em;width:0}70%{top:2.1875em;left:-.375em;width:3.125em}84%{top:3em;left:1.3125em;width:1.0625em}100%{top:2.8125em;left:.875em;width:1.5625em}}@keyframes swal2-animate-success-line-tip{0%{top:1.1875em;left:.0625em;width:0}54%{top:1.0625em;left:.125em;width:0}70%{top:2.1875em;left:-.375em;width:3.125em}84%{top:3em;left:1.3125em;width:1.0625em}100%{top:2.8125em;left:.875em;width:1.5625em}}@-webkit-keyframes swal2-animate-success-line-long{0%{top:3.375em;right:2.875em;width:0}65%{top:3.375em;right:2.875em;width:0}84%{top:2.1875em;right:0;width:3.4375em}100%{top:2.375em;right:.5em;width:2.9375em}}@keyframes swal2-animate-success-line-long{0%{top:3.375em;right:2.875em;width:0}65%{top:3.375em;right:2.875em;width:0}84%{top:2.1875em;right:0;width:3.4375em}100%{top:2.375em;right:.5em;width:2.9375em}}@-webkit-keyframes swal2-rotate-success-circular-line{0%{-webkit-transform:rotate(-45deg);transform:rotate(-45deg)}5%{-webkit-transform:rotate(-45deg);transform:rotate(-45deg)}12%{-webkit-transform:rotate(-405deg);transform:rotate(-405deg)}100%{-webkit-transform:rotate(-405deg);transform:rotate(-405deg)}}@keyframes swal2-rotate-success-circular-line{0%{-webkit-transform:rotate(-45deg);transform:rotate(-45deg)}5%{-webkit-transform:rotate(-45deg);transform:rotate(-45deg)}12%{-webkit-transform:rotate(-405deg);transform:rotate(-405deg)}100%{-webkit-transform:rotate(-405deg);transform:rotate(-405deg)}}@-webkit-keyframes swal2-animate-error-x-mark{0%{margin-top:1.625em;-webkit-transform:scale(.4);transform:scale(.4);opacity:0}50%{margin-top:1.625em;-webkit-transform:scale(.4);transform:scale(.4);opacity:0}80%{margin-top:-.375em;-webkit-transform:scale(1.15);transform:scale(1.15)}100%{margin-top:0;-webkit-transform:scale(1);transform:scale(1);opacity:1}}@keyframes swal2-animate-error-x-mark{0%{margin-top:1.625em;-webkit-transform:scale(.4);transform:scale(.4);opacity:0}50%{margin-top:1.625em;-webkit-transform:scale(.4);transform:scale(.4);opacity:0}80%{margin-top:-.375em;-webkit-transform:scale(1.15);transform:scale(1.15)}100%{margin-top:0;-webkit-transform:scale(1);transform:scale(1);opacity:1}}@-webkit-keyframes swal2-animate-error-icon{0%{-webkit-transform:rotateX(100deg);transform:rotateX(100deg);opacity:0}100%{-webkit-transform:rotateX(0);transform:rotateX(0);opacity:1}}@keyframes swal2-animate-error-icon{0%{-webkit-transform:rotateX(100deg);transform:rotateX(100deg);opacity:0}100%{-webkit-transform:rotateX(0);transform:rotateX(0);opacity:1}}body.swal2-toast-shown .swal2-container{background-color:transparent}body.swal2-toast-shown .swal2-container.swal2-shown{background-color:transparent}body.swal2-toast-shown .swal2-container.swal2-top{top:0;right:auto;bottom:auto;left:50%;-webkit-transform:translateX(-50%);transform:translateX(-50%)}body.swal2-toast-shown .swal2-container.swal2-top-end,body.swal2-toast-shown .swal2-container.swal2-top-right{top:0;right:0;bottom:auto;left:auto}body.swal2-toast-shown .swal2-container.swal2-top-left,body.swal2-toast-shown .swal2-container.swal2-top-start{top:0;right:auto;bottom:auto;left:0}body.swal2-toast-shown .swal2-container.swal2-center-left,body.swal2-toast-shown .swal2-container.swal2-center-start{top:50%;right:auto;bottom:auto;left:0;-webkit-transform:translateY(-50%);transform:translateY(-50%)}body.swal2-toast-shown .swal2-container.swal2-center{top:50%;right:auto;bottom:auto;left:50%;-webkit-transform:translate(-50%,-50%);transform:translate(-50%,-50%)}body.swal2-toast-shown .swal2-container.swal2-center-end,body.swal2-toast-shown .swal2-container.swal2-center-right{top:50%;right:0;bottom:auto;left:auto;-webkit-transform:translateY(-50%);transform:translateY(-50%)}body.swal2-toast-shown .swal2-container.swal2-bottom-left,body.swal2-toast-shown .swal2-container.swal2-bottom-start{top:auto;right:auto;bottom:0;left:0}body.swal2-toast-shown .swal2-container.swal2-bottom{top:auto;right:auto;bottom:0;left:50%;-webkit-transform:translateX(-50%);transform:translateX(-50%)}body.swal2-toast-shown .swal2-container.swal2-bottom-end,body.swal2-toast-shown .swal2-container.swal2-bottom-right{top:auto;right:0;bottom:0;left:auto}body.swal2-toast-column .swal2-toast{flex-direction:column;align-items:stretch}body.swal2-toast-column .swal2-toast .swal2-actions{flex:1;align-self:stretch;height:2.2em;margin-top:.3125em}body.swal2-toast-column .swal2-toast .swal2-loading{justify-content:center}body.swal2-toast-column .swal2-toast .swal2-input{height:2em;margin:.3125em auto;font-size:1em}body.swal2-toast-column .swal2-toast .swal2-validation-message{font-size:1em}.swal2-popup.swal2-toast{flex-direction:row;align-items:center;width:auto;padding:.625em;box-shadow:0 0 .625em #d9d9d9;overflow-y:hidden}.swal2-popup.swal2-toast .swal2-header{flex-direction:row}.swal2-popup.swal2-toast .swal2-title{flex-grow:1;justify-content:flex-start;margin:0 .6em;font-size:1em}.swal2-popup.swal2-toast .swal2-footer{margin:.5em 0 0;padding:.5em 0 0;font-size:.8em}.swal2-popup.swal2-toast .swal2-close{position:initial;width:.8em;height:.8em;line-height:.8}.swal2-popup.swal2-toast .swal2-content{justify-content:flex-start;font-size:1em}.swal2-popup.swal2-toast .swal2-icon{width:2em;min-width:2em;height:2em;margin:0}.swal2-popup.swal2-toast .swal2-icon-text{font-size:2em;font-weight:700;line-height:1em}.swal2-popup.swal2-toast .swal2-icon.swal2-success .swal2-success-ring{width:2em;height:2em}.swal2-popup.swal2-toast .swal2-icon.swal2-error [class^=swal2-x-mark-line]{top:.875em;width:1.375em}.swal2-popup.swal2-toast .swal2-icon.swal2-error [class^=swal2-x-mark-line][class$=left]{left:.3125em}.swal2-popup.swal2-toast .swal2-icon.swal2-error [class^=swal2-x-mark-line][class$=right]{right:.3125em}.swal2-popup.swal2-toast .swal2-actions{height:auto;margin:0 .3125em}.swal2-popup.swal2-toast .swal2-styled{margin:0 .3125em;padding:.3125em .625em;font-size:1em}.swal2-popup.swal2-toast .swal2-styled:focus{box-shadow:0 0 0 .0625em #fff,0 0 0 .125em rgba(50,100,150,.4)}.swal2-popup.swal2-toast .swal2-success{border-color:#a5dc86}.swal2-popup.swal2-toast .swal2-success [class^=swal2-success-circular-line]{position:absolute;width:2em;height:2.8125em;-webkit-transform:rotate(45deg);transform:rotate(45deg);border-radius:50%}.swal2-popup.swal2-toast .swal2-success [class^=swal2-success-circular-line][class$=left]{top:-.25em;left:-.9375em;-webkit-transform:rotate(-45deg);transform:rotate(-45deg);-webkit-transform-origin:2em 2em;transform-origin:2em 2em;border-radius:4em 0 0 4em}.swal2-popup.swal2-toast .swal2-success [class^=swal2-success-circular-line][class$=right]{top:-.25em;left:.9375em;-webkit-transform-origin:0 2em;transform-origin:0 2em;border-radius:0 4em 4em 0}.swal2-popup.swal2-toast .swal2-success .swal2-success-ring{width:2em;height:2em}.swal2-popup.swal2-toast .swal2-success .swal2-success-fix{top:0;left:.4375em;width:.4375em;height:2.6875em}.swal2-popup.swal2-toast .swal2-success [class^=swal2-success-line]{height:.3125em}.swal2-popup.swal2-toast .swal2-success [class^=swal2-success-line][class$=tip]{top:1.125em;left:.1875em;width:.75em}.swal2-popup.swal2-toast .swal2-success [class^=swal2-success-line][class$=long]{top:.9375em;right:.1875em;width:1.375em}.swal2-popup.swal2-toast.swal2-show{-webkit-animation:showSweetToast .5s;animation:showSweetToast .5s}.swal2-popup.swal2-toast.swal2-hide{-webkit-animation:hideSweetToast .2s forwards;animation:hideSweetToast .2s forwards}.swal2-popup.swal2-toast .swal2-animate-success-icon .swal2-success-line-tip{-webkit-animation:animate-toast-success-tip .75s;animation:animate-toast-success-tip .75s}.swal2-popup.swal2-toast .swal2-animate-success-icon .swal2-success-line-long{-webkit-animation:animate-toast-success-long .75s;animation:animate-toast-success-long .75s}@-webkit-keyframes showSweetToast{0%{-webkit-transform:translateY(-.625em) rotateZ(2deg);transform:translateY(-.625em) rotateZ(2deg);opacity:0}33%{-webkit-transform:translateY(0) rotateZ(-2deg);transform:translateY(0) rotateZ(-2deg);opacity:.5}66%{-webkit-transform:translateY(.3125em) rotateZ(2deg);transform:translateY(.3125em) rotateZ(2deg);opacity:.7}100%{-webkit-transform:translateY(0) rotateZ(0);transform:translateY(0) rotateZ(0);opacity:1}}@keyframes showSweetToast{0%{-webkit-transform:translateY(-.625em) rotateZ(2deg);transform:translateY(-.625em) rotateZ(2deg);opacity:0}33%{-webkit-transform:translateY(0) rotateZ(-2deg);transform:translateY(0) rotateZ(-2deg);opacity:.5}66%{-webkit-transform:translateY(.3125em) rotateZ(2deg);transform:translateY(.3125em) rotateZ(2deg);opacity:.7}100%{-webkit-transform:translateY(0) rotateZ(0);transform:translateY(0) rotateZ(0);opacity:1}}@-webkit-keyframes hideSweetToast{0%{opacity:1}33%{opacity:.5}100%{-webkit-transform:rotateZ(1deg);transform:rotateZ(1deg);opacity:0}}@keyframes hideSweetToast{0%{opacity:1}33%{opacity:.5}100%{-webkit-transform:rotateZ(1deg);transform:rotateZ(1deg);opacity:0}}@-webkit-keyframes animate-toast-success-tip{0%{top:.5625em;left:.0625em;width:0}54%{top:.125em;left:.125em;width:0}70%{top:.625em;left:-.25em;width:1.625em}84%{top:1.0625em;left:.75em;width:.5em}100%{top:1.125em;left:.1875em;width:.75em}}@keyframes animate-toast-success-tip{0%{top:.5625em;left:.0625em;width:0}54%{top:.125em;left:.125em;width:0}70%{top:.625em;left:-.25em;width:1.625em}84%{top:1.0625em;left:.75em;width:.5em}100%{top:1.125em;left:.1875em;width:.75em}}@-webkit-keyframes animate-toast-success-long{0%{top:1.625em;right:1.375em;width:0}65%{top:1.25em;right:.9375em;width:0}84%{top:.9375em;right:0;width:1.125em}100%{top:.9375em;right:.1875em;width:1.375em}}@keyframes animate-toast-success-long{0%{top:1.625em;right:1.375em;width:0}65%{top:1.25em;right:.9375em;width:0}84%{top:.9375em;right:0;width:1.125em}100%{top:.9375em;right:.1875em;width:1.375em}}body.swal2-shown:not(.swal2-no-backdrop):not(.swal2-toast-shown){overflow:hidden}body.swal2-height-auto{height:auto!important}body.swal2-no-backdrop .swal2-shown{top:auto;right:auto;bottom:auto;left:auto;background-color:transparent}body.swal2-no-backdrop .swal2-shown>.swal2-modal{box-shadow:0 0 10px rgba(0,0,0,.4)}body.swal2-no-backdrop .swal2-shown.swal2-top{top:0;left:50%;-webkit-transform:translateX(-50%);transform:translateX(-50%)}body.swal2-no-backdrop .swal2-shown.swal2-top-left,body.swal2-no-backdrop .swal2-shown.swal2-top-start{top:0;left:0}body.swal2-no-backdrop .swal2-shown.swal2-top-end,body.swal2-no-backdrop .swal2-shown.swal2-top-right{top:0;right:0}body.swal2-no-backdrop .swal2-shown.swal2-center{top:50%;left:50%;-webkit-transform:translate(-50%,-50%);transform:translate(-50%,-50%)}body.swal2-no-backdrop .swal2-shown.swal2-center-left,body.swal2-no-backdrop .swal2-shown.swal2-center-start{top:50%;left:0;-webkit-transform:translateY(-50%);transform:translateY(-50%)}body.swal2-no-backdrop .swal2-shown.swal2-center-end,body.swal2-no-backdrop .swal2-shown.swal2-center-right{top:50%;right:0;-webkit-transform:translateY(-50%);transform:translateY(-50%)}body.swal2-no-backdrop .swal2-shown.swal2-bottom{bottom:0;left:50%;-webkit-transform:translateX(-50%);transform:translateX(-50%)}body.swal2-no-backdrop .swal2-shown.swal2-bottom-left,body.swal2-no-backdrop .swal2-shown.swal2-bottom-start{bottom:0;left:0}body.swal2-no-backdrop .swal2-shown.swal2-bottom-end,body.swal2-no-backdrop .swal2-shown.swal2-bottom-right{right:0;bottom:0}.swal2-container{display:flex;position:fixed;top:0;right:0;bottom:0;left:0;flex-direction:row;align-items:center;justify-content:center;padding:10px;background-color:transparent;z-index:1060;overflow-x:hidden;-webkit-overflow-scrolling:touch}.swal2-container.swal2-top{align-items:flex-start}.swal2-container.swal2-top-left,.swal2-container.swal2-top-start{align-items:flex-start;justify-content:flex-start}.swal2-container.swal2-top-end,.swal2-container.swal2-top-right{align-items:flex-start;justify-content:flex-end}.swal2-container.swal2-center{align-items:center}.swal2-container.swal2-center-left,.swal2-container.swal2-center-start{align-items:center;justify-content:flex-start}.swal2-container.swal2-center-end,.swal2-container.swal2-center-right{align-items:center;justify-content:flex-end}.swal2-container.swal2-bottom{align-items:flex-end}.swal2-container.swal2-bottom-left,.swal2-container.swal2-bottom-start{align-items:flex-end;justify-content:flex-start}.swal2-container.swal2-bottom-end,.swal2-container.swal2-bottom-right{align-items:flex-end;justify-content:flex-end}.swal2-container.swal2-grow-fullscreen>.swal2-modal{display:flex!important;flex:1;align-self:stretch;justify-content:center}.swal2-container.swal2-grow-row>.swal2-modal{display:flex!important;flex:1;align-content:center;justify-content:center}.swal2-container.swal2-grow-column{flex:1;flex-direction:column}.swal2-container.swal2-grow-column.swal2-bottom,.swal2-container.swal2-grow-column.swal2-center,.swal2-container.swal2-grow-column.swal2-top{align-items:center}.swal2-container.swal2-grow-column.swal2-bottom-left,.swal2-container.swal2-grow-column.swal2-bottom-start,.swal2-container.swal2-grow-column.swal2-center-left,.swal2-container.swal2-grow-column.swal2-center-start,.swal2-container.swal2-grow-column.swal2-top-left,.swal2-container.swal2-grow-column.swal2-top-start{align-items:flex-start}.swal2-container.swal2-grow-column.swal2-bottom-end,.swal2-container.swal2-grow-column.swal2-bottom-right,.swal2-container.swal2-grow-column.swal2-center-end,.swal2-container.swal2-grow-column.swal2-center-right,.swal2-container.swal2-grow-column.swal2-top-end,.swal2-container.swal2-grow-column.swal2-top-right{align-items:flex-end}.swal2-container.swal2-grow-column>.swal2-modal{display:flex!important;flex:1;align-content:center;justify-content:center}.swal2-container:not(.swal2-top):not(.swal2-top-start):not(.swal2-top-end):not(.swal2-top-left):not(.swal2-top-right):not(.swal2-center-start):not(.swal2-center-end):not(.swal2-center-left):not(.swal2-center-right):not(.swal2-bottom):not(.swal2-bottom-start):not(.swal2-bottom-end):not(.swal2-bottom-left):not(.swal2-bottom-right):not(.swal2-grow-fullscreen)>.swal2-modal{margin:auto}@media all and (-ms-high-contrast:none),(-ms-high-contrast:active){.swal2-container .swal2-modal{margin:0!important}}.swal2-container.swal2-fade{transition:background-color .1s}.swal2-container.swal2-shown{background-color:rgba(0,0,0,.4)}.swal2-popup{display:none;position:relative;flex-direction:column;justify-content:center;width:32em;max-width:100%;padding:1.25em;border-radius:.3125em;background:#fff;font-family:inherit;font-size:1rem;box-sizing:border-box}.swal2-popup:focus{outline:0}.swal2-popup.swal2-loading{overflow-y:hidden}.swal2-popup .swal2-header{display:flex;flex-direction:column;align-items:center}.swal2-popup .swal2-title{display:block;position:relative;max-width:100%;margin:0 0 .4em;padding:0;color:#595959;font-size:1.875em;font-weight:600;text-align:center;text-transform:none;word-wrap:break-word}.swal2-popup .swal2-actions{flex-wrap:wrap;align-items:center;justify-content:center;margin:1.25em auto 0;z-index:1}.swal2-popup .swal2-actions:not(.swal2-loading) .swal2-styled[disabled]{opacity:.4}.swal2-popup .swal2-actions:not(.swal2-loading) .swal2-styled:hover{background-image:linear-gradient(rgba(0,0,0,.1),rgba(0,0,0,.1))}.swal2-popup .swal2-actions:not(.swal2-loading) .swal2-styled:active{background-image:linear-gradient(rgba(0,0,0,.2),rgba(0,0,0,.2))}.swal2-popup .swal2-actions.swal2-loading .swal2-styled.swal2-confirm{width:2.5em;height:2.5em;margin:.46875em;padding:0;border:.25em solid transparent;border-radius:100%;border-color:transparent;background-color:transparent!important;color:transparent;cursor:default;box-sizing:border-box;-webkit-animation:swal2-rotate-loading 1.5s linear 0s infinite normal;animation:swal2-rotate-loading 1.5s linear 0s infinite normal;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none}.swal2-popup .swal2-actions.swal2-loading .swal2-styled.swal2-cancel{margin-right:30px;margin-left:30px}.swal2-popup .swal2-actions.swal2-loading :not(.swal2-styled).swal2-confirm::after{display:inline-block;width:15px;height:15px;margin-left:5px;border:3px solid #999;border-radius:50%;border-right-color:transparent;box-shadow:1px 1px 1px #fff;content:'';-webkit-animation:swal2-rotate-loading 1.5s linear 0s infinite normal;animation:swal2-rotate-loading 1.5s linear 0s infinite normal}.swal2-popup .swal2-styled{margin:.3125em;padding:.625em 2em;font-weight:500;box-shadow:none}.swal2-popup .swal2-styled:not([disabled]){cursor:pointer}.swal2-popup .swal2-styled.swal2-confirm{border:0;border-radius:.25em;background:initial;background-color:#3085d6;color:#fff;font-size:1.0625em}.swal2-popup .swal2-styled.swal2-cancel{border:0;border-radius:.25em;background:initial;background-color:#aaa;color:#fff;font-size:1.0625em}.swal2-popup .swal2-styled:focus{outline:0;box-shadow:0 0 0 2px #fff,0 0 0 4px rgba(50,100,150,.4)}.swal2-popup .swal2-styled::-moz-focus-inner{border:0}.swal2-popup .swal2-footer{justify-content:center;margin:1.25em 0 0;padding:1em 0 0;border-top:1px solid #eee;color:#545454;font-size:1em}.swal2-popup .swal2-image{max-width:100%;margin:1.25em auto}.swal2-popup .swal2-close{position:absolute;top:0;right:0;justify-content:center;width:1.2em;height:1.2em;padding:0;transition:color .1s ease-out;border:none;border-radius:0;outline:initial;background:0 0;color:#ccc;font-family:serif;font-size:2.5em;line-height:1.2;cursor:pointer;overflow:hidden}.swal2-popup .swal2-close:hover{-webkit-transform:none;transform:none;color:#f27474}.swal2-popup>.swal2-checkbox,.swal2-popup>.swal2-file,.swal2-popup>.swal2-input,.swal2-popup>.swal2-radio,.swal2-popup>.swal2-select,.swal2-popup>.swal2-textarea{display:none}.swal2-popup .swal2-content{justify-content:center;margin:0;padding:0;color:#545454;font-size:1.125em;font-weight:300;line-height:normal;z-index:1;word-wrap:break-word}.swal2-popup #swal2-content{text-align:center}.swal2-popup .swal2-checkbox,.swal2-popup .swal2-file,.swal2-popup .swal2-input,.swal2-popup .swal2-radio,.swal2-popup .swal2-select,.swal2-popup .swal2-textarea{margin:1em auto}.swal2-popup .swal2-file,.swal2-popup .swal2-input,.swal2-popup .swal2-textarea{width:100%;transition:border-color .3s,box-shadow .3s;border:1px solid #d9d9d9;border-radius:.1875em;font-size:1.125em;box-shadow:inset 0 1px 1px rgba(0,0,0,.06);box-sizing:border-box}.swal2-popup .swal2-file.swal2-inputerror,.swal2-popup .swal2-input.swal2-inputerror,.swal2-popup .swal2-textarea.swal2-inputerror{border-color:#f27474!important;box-shadow:0 0 2px #f27474!important}.swal2-popup .swal2-file:focus,.swal2-popup .swal2-input:focus,.swal2-popup .swal2-textarea:focus{border:1px solid #b4dbed;outline:0;box-shadow:0 0 3px #c4e6f5}.swal2-popup .swal2-file::-webkit-input-placeholder,.swal2-popup .swal2-input::-webkit-input-placeholder,.swal2-popup .swal2-textarea::-webkit-input-placeholder{color:#ccc}.swal2-popup .swal2-file:-ms-input-placeholder,.swal2-popup .swal2-input:-ms-input-placeholder,.swal2-popup .swal2-textarea:-ms-input-placeholder{color:#ccc}.swal2-popup .swal2-file::-ms-input-placeholder,.swal2-popup .swal2-input::-ms-input-placeholder,.swal2-popup .swal2-textarea::-ms-input-placeholder{color:#ccc}.swal2-popup .swal2-file::placeholder,.swal2-popup .swal2-input::placeholder,.swal2-popup .swal2-textarea::placeholder{color:#ccc}.swal2-popup .swal2-range input{width:80%}.swal2-popup .swal2-range output{width:20%;font-weight:600;text-align:center}.swal2-popup .swal2-range input,.swal2-popup .swal2-range output{height:2.625em;margin:1em auto;padding:0;font-size:1.125em;line-height:2.625em}.swal2-popup .swal2-input{height:2.625em;padding:0 .75em}.swal2-popup .swal2-input[type=number]{max-width:10em}.swal2-popup .swal2-file{font-size:1.125em}.swal2-popup .swal2-textarea{height:6.75em;padding:.75em}.swal2-popup .swal2-select{min-width:50%;max-width:100%;padding:.375em .625em;color:#545454;font-size:1.125em}.swal2-popup .swal2-checkbox,.swal2-popup .swal2-radio{align-items:center;justify-content:center}.swal2-popup .swal2-checkbox label,.swal2-popup .swal2-radio label{margin:0 .6em;font-size:1.125em}.swal2-popup .swal2-checkbox input,.swal2-popup .swal2-radio input{margin:0 .4em}.swal2-popup .swal2-validation-message{display:none;align-items:center;justify-content:center;padding:.625em;background:#f0f0f0;color:#666;font-size:1em;font-weight:300;overflow:hidden}.swal2-popup .swal2-validation-message::before{display:inline-block;width:1.5em;min-width:1.5em;height:1.5em;margin:0 .625em;border-radius:50%;background-color:#f27474;color:#fff;font-weight:600;line-height:1.5em;text-align:center;content:'!';zoom:normal}@supports (-ms-accelerator:true){.swal2-range input{width:100%!important}.swal2-range output{display:none}}@media all and (-ms-high-contrast:none),(-ms-high-contrast:active){.swal2-range input{width:100%!important}.swal2-range output{display:none}}@-moz-document url-prefix(){.swal2-close:focus{outline:2px solid rgba(50,100,150,.4)}}.swal2-icon{position:relative;justify-content:center;width:5em;height:5em;margin:1.25em auto 1.875em;border:.25em solid transparent;border-radius:50%;line-height:5em;cursor:default;box-sizing:content-box;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none;zoom:normal}.swal2-icon-text{font-size:3.75em}.swal2-icon.swal2-error{border-color:#f27474}.swal2-icon.swal2-error .swal2-x-mark{position:relative;flex-grow:1}.swal2-icon.swal2-error [class^=swal2-x-mark-line]{display:block;position:absolute;top:2.3125em;width:2.9375em;height:.3125em;border-radius:.125em;background-color:#f27474}.swal2-icon.swal2-error [class^=swal2-x-mark-line][class$=left]{left:1.0625em;-webkit-transform:rotate(45deg);transform:rotate(45deg)}.swal2-icon.swal2-error [class^=swal2-x-mark-line][class$=right]{right:1em;-webkit-transform:rotate(-45deg);transform:rotate(-45deg)}.swal2-icon.swal2-warning{border-color:#facea8;color:#f8bb86}.swal2-icon.swal2-info{border-color:#9de0f6;color:#3fc3ee}.swal2-icon.swal2-question{border-color:#c9dae1;color:#87adbd}.swal2-icon.swal2-success{border-color:#a5dc86}.swal2-icon.swal2-success [class^=swal2-success-circular-line]{position:absolute;width:3.75em;height:7.5em;-webkit-transform:rotate(45deg);transform:rotate(45deg);border-radius:50%}.swal2-icon.swal2-success [class^=swal2-success-circular-line][class$=left]{top:-.4375em;left:-2.0635em;-webkit-transform:rotate(-45deg);transform:rotate(-45deg);-webkit-transform-origin:3.75em 3.75em;transform-origin:3.75em 3.75em;border-radius:7.5em 0 0 7.5em}.swal2-icon.swal2-success [class^=swal2-success-circular-line][class$=right]{top:-.6875em;left:1.875em;-webkit-transform:rotate(-45deg);transform:rotate(-45deg);-webkit-transform-origin:0 3.75em;transform-origin:0 3.75em;border-radius:0 7.5em 7.5em 0}.swal2-icon.swal2-success .swal2-success-ring{position:absolute;top:-.25em;left:-.25em;width:100%;height:100%;border:.25em solid rgba(165,220,134,.3);border-radius:50%;z-index:2;box-sizing:content-box}.swal2-icon.swal2-success .swal2-success-fix{position:absolute;top:.5em;left:1.625em;width:.4375em;height:5.625em;-webkit-transform:rotate(-45deg);transform:rotate(-45deg);z-index:1}.swal2-icon.swal2-success [class^=swal2-success-line]{display:block;position:absolute;height:.3125em;border-radius:.125em;background-color:#a5dc86;z-index:2}.swal2-icon.swal2-success [class^=swal2-success-line][class$=tip]{top:2.875em;left:.875em;width:1.5625em;-webkit-transform:rotate(45deg);transform:rotate(45deg)}.swal2-icon.swal2-success [class^=swal2-success-line][class$=long]{top:2.375em;right:.5em;width:2.9375em;-webkit-transform:rotate(-45deg);transform:rotate(-45deg)}.swal2-progresssteps{align-items:center;margin:0 0 1.25em;padding:0;font-weight:600}.swal2-progresssteps li{display:inline-block;position:relative}.swal2-progresssteps .swal2-progresscircle{width:2em;height:2em;border-radius:2em;background:#3085d6;color:#fff;line-height:2em;text-align:center;z-index:20}.swal2-progresssteps .swal2-progresscircle:first-child{margin-left:0}.swal2-progresssteps .swal2-progresscircle:last-child{margin-right:0}.swal2-progresssteps .swal2-progresscircle.swal2-activeprogressstep{background:#3085d6}.swal2-progresssteps .swal2-progresscircle.swal2-activeprogressstep~.swal2-progresscircle{background:#add8e6}.swal2-progresssteps .swal2-progresscircle.swal2-activeprogressstep~.swal2-progressline{background:#add8e6}.swal2-progresssteps .swal2-progressline{width:2.5em;height:.4em;margin:0 -1px;background:#3085d6;z-index:10}[class^=swal2]{-webkit-tap-highlight-color:transparent}.swal2-show{-webkit-animation:swal2-show .3s;animation:swal2-show .3s}.swal2-show.swal2-noanimation{-webkit-animation:none;animation:none}.swal2-hide{-webkit-animation:swal2-hide .15s forwards;animation:swal2-hide .15s forwards}.swal2-hide.swal2-noanimation{-webkit-animation:none;animation:none}.swal2-rtl .swal2-close{right:auto;left:0}.swal2-animate-success-icon .swal2-success-line-tip{-webkit-animation:swal2-animate-success-line-tip .75s;animation:swal2-animate-success-line-tip .75s}.swal2-animate-success-icon .swal2-success-line-long{-webkit-animation:swal2-animate-success-line-long .75s;animation:swal2-animate-success-line-long .75s}.swal2-animate-success-icon .swal2-success-circular-line-right{-webkit-animation:swal2-rotate-success-circular-line 4.25s ease-in;animation:swal2-rotate-success-circular-line 4.25s ease-in}.swal2-animate-error-icon{-webkit-animation:swal2-animate-error-icon .5s;animation:swal2-animate-error-icon .5s}.swal2-animate-error-icon .swal2-x-mark{-webkit-animation:swal2-animate-error-x-mark .5s;animation:swal2-animate-error-x-mark .5s}@-webkit-keyframes swal2-rotate-loading{0%{-webkit-transform:rotate(0);transform:rotate(0)}100%{-webkit-transform:rotate(360deg);transform:rotate(360deg)}}@keyframes swal2-rotate-loading{0%{-webkit-transform:rotate(0);transform:rotate(0)}100%{-webkit-transform:rotate(360deg);transform:rotate(360deg)}}@media print{body.swal2-shown:not(.swal2-no-backdrop):not(.swal2-toast-shown){overflow-y:scroll!important}body.swal2-shown:not(.swal2-no-backdrop):not(.swal2-toast-shown)>[aria-hidden=true]{display:none}body.swal2-shown:not(.swal2-no-backdrop):not(.swal2-toast-shown) .swal2-container{position:initial!important}}"
);


/* ============ EXTRACTED INLINE JS ============ */

/* From app.blade.php inline script */
(function(w, d, s, l, i) {
                w[l] = w[l] || [];
                w[l].push({
                    'gtm.start': new Date().getTime(),
                    event: 'gtm.js'
                });
                var f = d.getElementsByTagName(s)[0],
                    j = d.createElement(s),
                    dl = l != 'dataLayer' ? '&l=' + l : '';
                j.async = true;
                j.src =
                    'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
                f.parentNode.insertBefore(j, f);
            })(window, document, 'script', 'dataLayer', '{{ $google_tag_manager_id }}');


/* From app.blade.php inline script */
! function(f, b, e, v, n, t, s) {
                if (f.fbq) return;
                n = f.fbq = function() {
                    n.callMethod ?
                        n.callMethod.apply(n, arguments) : n.queue.push(arguments)
                };
                if (!f._fbq) f._fbq = n;
                n.push = n;
                n.loaded = !0;
                n.version = '2.0';
                n.queue = [];
                t = b.createElement(e);
                t.async = !0;
                t.src = v;
                s = b.getElementsByTagName(e)[0];
                s.parentNode.insertBefore(t, s)
            }(window, document, 'script',
                'https://connect.facebook.net/en_US/fbevents.js');
            fbq('init', '{your-pixel-id-goes-here}');
            fbq('track', 'PageView');


/* From app.blade.php inline script */
const firebaseConfig = {
            apiKey: "{{ \App\CPU\Helpers::get_business_settings('fcm_api_key') }}",
            authDomain: "{{ \App\CPU\Helpers::get_business_settings('fcm_auth_domain') }}",
            projectId: "{{ \App\CPU\Helpers::get_business_settings('fcm_project_id') }}",
            storageBucket: "{{ \App\CPU\Helpers::get_business_settings('fcm_storage_bucket') }}",
            messagingSenderId: "{{ \App\CPU\Helpers::get_business_settings('fcm_messaging_sender_id') }}",
            appId: "{{ \App\CPU\Helpers::get_business_settings('fcm_app_id') }}",
        };

        // Init
        if (!firebase.apps.length) {
            firebase.initializeApp(firebaseConfig);
        }

        const messaging = firebase.messaging();

        // Register SW
        function registerServiceWorker() {
            if ('serviceWorker' in navigator) {
                navigator.serviceWorker.register('/firebase-messaging-sw.js')
                    .then(function(registration) {
                        getToken(registration);
                    })
                    .catch(function(err) {
                        console.error('SW registration failed:', err);
                    });
            }
        }

        // Get Token
        function getToken(registration) {
            messaging.getToken({
                    vapidKey: "{{ \App\CPU\Helpers::get_business_settings('fcm_vapid_key') }}",
                    serviceWorkerRegistration: registration
                })
                .then((currentToken) => {
                    if (currentToken) {
                     
                        saveToken(currentToken);
                    } else {
                        console.warn("No token available");
                    }
                })
                .catch((err) => {
                    console.error("Token Error:", err);
                });
        }

        // Save Token
        function saveToken(token) {
            $.ajax({
                type: "POST",
                url: "{{ route('update-fcm-token') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    token: token
                },
                success: function() {
                    
                }
            });
        }

        // Foreground message
        messaging.onMessage((payload) => {
            console.log("🔥 Foreground:", payload);

            alert("Notification aayi");
        });


        // Permission
        Notification.requestPermission().then(permission => {
           
            if (permission === "granted") {
                registerServiceWorker();
            }
        });


/* From app.blade.php inline script */
function addWishlist(product_id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('store-wishlist') }}",
                method: 'POST',
                data: {
                    product_id: product_id
                },
                success: function(data) {
                    if (data.value == 1) {
                        Swal.fire({
                            position: 'top-end',
                            type: 'success',
                            title: data.success,
                            showConfirmButton: false,
                            timer: 1500
                        });
                        $('.countWishlist').html(data.count);
                        $('.countWishlist-' + product_id).text(data.product_count);
                        $('.tooltip').html('');

                    } else if (data.value == 2) {
                        Swal.fire({
                            type: 'info',
                            title: 'WishList',
                            text: data.error
                        });
                    } else {
                        Swal.fire({
                            type: 'error',
                            title: 'WishList',
                            text: data.error
                        });
                    }
                }
            });
        }

        function removeWishlist(product_id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('delete-wishlist') }}",
                method: 'POST',
                data: {
                    id: product_id
                },
                beforeSend: function() {
                    $('#loading').show();
                },
                success: function(data) {
                    Swal.fire({
                        type: 'success',
                        title: 'WishList',
                        text: data.success
                    });
                    $('.countWishlist').html(data.count);
                    $('#set-wish-list').html(data.wishlist);
                    $('.tooltip').html('');
                },
                complete: function() {
                    $('#loading').hide();
                },
            });
        }

        function quickView(product_id) {
            $.get({
                url: '{{ route('quick-view') }}',
                dataType: 'json',
                data: {
                    product_id: product_id
                },
                beforeSend: function() {
                    $('#loading').show();
                },
                success: function(data) {
                    console.log("success...")
                    $('#quick-view').modal('show');
                    $('#quick-view-modal').empty().html(data.view);
                },
                complete: function() {
                    $('#loading').hide();
                },
            });
        }

        function addToCart(form_id = 'add-to-cart-form', redirect_to_checkout = false) {
            var $form = $('#' + form_id);
            var maxQty = parseInt($form.find('.cart-qty-field').attr('max')) || 0;
            var currentQty = parseInt($form.find('input[name=quantity]').val()) || 0;

            if (maxQty <= 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Out of Stock',
                    text: '{{ \App\CPU\translate("This variant is currently out of stock") }}'
                });
                return false;
            }

            if (checkAddToCartValidity()) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                $.post({
                    url: '{{ route('cart.add') }}',
                    data: $('#' + form_id).serializeArray(),
                    beforeSend: function() {
                        $('#loading').show();
                    },
                    success: function(response) {
                        console.log(response);
                        if (response.status == 1) {
                            updateNavCart();
                            toastr.success(response.message, {
                                CloseButton: true,
                                ProgressBar: true
                            });
                            $('.call-when-done').click();
                            if (redirect_to_checkout) {
                                location.href = "{{ route('checkout-details') }}";
                            }
                            return false;
                        } else if (response.status == 0) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Cart',
                                text: response.message
                            });
                            return false;
                        }
                    },
                    complete: function() {
                        $('#loading').hide();

                    }
                });
            } else {
                Swal.fire({
                    type: 'info',
                    title: 'Cart',
                    text: '{{ \App\CPU\translate('please_choose_all_the_options') }}'
                });
            }
        }

        function buy_now() {
            addToCart('add-to-cart-form', true);
            /* location.href = "{{ route('checkout-details') }}"; */
        }

        // Phase 4: Language Search Functionality
        $(document).ready(function() {
            $('#langSearchInput').on('keyup', function() {
                var value = $(this).val().toLowerCase();
                $('#langList .lang-item').filter(function() {
                    $(this).toggle($(this).data('name').indexOf(value) > -1);
                });
            });
            // Keep dropdown open when clicking inside
            $('.__language-bar .dropdown-menu').on('click', function(e) {
                e.stopPropagation();
            });
        });

        function removeFromCart(key) {
            $.post('{{ route('cart.remove') }}', {
                _token: '{{ csrf_token() }}',
                key: key
            }, function(response) {
                $('#cod-for-cart').hide();
                updateNavCart();
                $('#cart-summary').empty().html(response.data);
                toastr.info('{{ \App\CPU\translate('Item has been removed from cart') }}', {
                    CloseButton: true,
                    ProgressBar: true
                });
                let segment_array = window.location.pathname.split('/');
                let segment = segment_array[segment_array.length - 1];
                if (segment === 'checkout-payment' || segment === 'checkout-details') {
                    location.reload();
                }
            });
        }

        function updateNavCart() {
            $.post('{{ route('cart.nav-cart') }}', {
                _token: '{{ csrf_token() }}'
            }, function(response) {
                $('#cart_items').html(response.data);
            });
        }

        function cartQuantityInitialize() {
            $('.btn-number').click(function(e) {
                e.preventDefault();

                fieldName = $(this).attr('data-field');
                type = $(this).attr('data-type');
                productType = $(this).attr('product-type');
                var input = $("input[name='" + fieldName + "']");
                var currentVal = parseInt(input.val());

                if (!isNaN(currentVal)) {
                    console.log(productType)
                    if (type == 'minus') {

                        if (currentVal > input.attr('min')) {
                            input.val(currentVal - 1).change();
                        }
                        if (parseInt(input.val()) == input.attr('min')) {
                            $(this).attr('disabled', true);
                        }

                    } else if (type == 'plus') {

                        if (currentVal < input.attr('max') || (productType === 'digital')) {
                            input.val(currentVal + 1).change();
                        }

                        if ((parseInt(input.val()) == input.attr('max')) && (productType === 'physical')) {
                            $(this).attr('disabled', true);
                        }

                    }
                } else {
                    input.val(0);
                }
            });

            $('.input-number, .cart-qty-field').focusin(function() {
                $(this).data('oldValue', $(this).val());
            });

            $('.input-number, .cart-qty-field').change(function() {
                productType = $(this).attr('product-type');
                minValue = parseInt($(this).attr('min'));
                maxValue = parseInt($(this).attr('max'));
                valueCurrent = parseInt($(this).val());

                var name = $(this).attr('name');
                if (valueCurrent >= minValue) {
                    $(".btn-number[data-type='minus'][data-field='" + name + "']").removeAttr('disabled')
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Cart',
                        text: '{{ \App\CPU\translate('Sorry, the minimum order quantity does not match') }}'
                    });
                    $(this).val($(this).data('oldValue'));
                }
                if (productType === 'digital' || valueCurrent <= maxValue) {
                    $(".btn-number[data-type='plus'][data-field='" + name + "']").removeAttr('disabled')
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Cart',
                        text: '{{ \App\CPU\translate('Sorry, stock limit exceeded') }}.'
                    });
                    $(this).val($(this).data('oldValue'));
                }


            });
            $(".input-number, .cart-qty-field").keydown(function(e) {
                // Allow: backspace, delete, tab, escape, enter and .
                if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
                    // Allow: Ctrl+A
                    (e.keyCode == 65 && e.ctrlKey === true) ||
                    // Allow: home, end, left, right
                    (e.keyCode >= 35 && e.keyCode <= 39)) {
                    // let it happen, don't do anything
                    return;
                }
                // Ensure that it is a number and stop the keypress
                if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
                    e.preventDefault();
                }
            });
        }

        function updateQuantity(key, element) {
            $.post('<?php echo e(route('cart.updateQuantity')); ?>', {
                _token: '<?php echo e(csrf_token()); ?>',
                key: key,
                quantity: element.value
            }, function(data) {
                updateNavCart();
                $('#cart-summary').empty().html(data);
            });
        }

        function updateCartQuantity(minimum_order_qty, key) {
            /* var quantity = $("#cartQuantity" + key).children("option:selected").val(); */
            var quantity = $("#cartQuantity" + key).val();
            if (minimum_order_qty > quantity) {
                toastr.error('{{ \App\CPU\translate('minimum_order_quantity_cannot_be_less_than_') }}' +
                    minimum_order_qty);
                $("#cartQuantity" + key).val(minimum_order_qty);
                return false;
            }

            $.post('{{ route('cart.updateQuantity') }}', {
                _token: '{{ csrf_token() }}',
                key: key,
                quantity: quantity
            }, function(response) {
                if (response.status == 0) {
                    toastr.error(response.message, {
                        CloseButton: true,
                        ProgressBar: true
                    });
                    $("#cartQuantity" + key).val(response['qty']);
                } else {
                    updateNavCart();
                    $('#cart-summary').empty().html(response);
                }
            });
        }

        $('#add-to-cart-form input').on('change', function() {
            getVariantPrice();
        });

        function getVariantPrice() {
            var $form = $('#add-to-cart-form');
            if ($form.find('input[name=quantity]').val() > 0 && checkAddToCartValidity()) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                $.ajax({
                    type: "POST",
                    url: '{{ route('cart.variant_price') }}',
                    data: $form.serializeArray(),
                    success: function(data) {
                        $form.find('#chosen_price_div').removeClass('d-none');
                        $form.find('#chosen_price_div #chosen_price').html(data.price);
                        $form.find('#set-tax-amount').html(data.tax);
                        $form.find('#set-discount-amount').html(data.discount);
                        $form.find('#available-quantity').html(data.quantity);
                        $form.find('.cart-qty-field').attr('max', data.quantity);

                        // Out of stock handling
                        if (data.quantity <= 0) {
                            $form.find('#variant-out-of-stock, #qv-variant-out-of-stock').removeClass('d-none');
                            $form.find('.cart-qty-field').val(0).attr('max', 0);
                            $form.find('.btn-buy-now, .btn-add-to-cart').addClass('d-none');
                            $form.find('.btn-oos').removeClass('d-none');
                        } else {
                            $form.find('#variant-out-of-stock, #qv-variant-out-of-stock').addClass('d-none');
                            $form.find('.btn-buy-now, .btn-add-to-cart').removeClass('d-none');
                            $form.find('.btn-oos').addClass('d-none');
                        }
                    }
                });
            }
        }

        function checkAddToCartValidity() {
            var names = {};
            $('#add-to-cart-form input:radio').each(function() { // find unique names
                names[$(this).attr('name')] = true;
            });
            var count = 0;
            $.each(names, function() { // then count them
                count++;
            });
            if ($('input:radio:checked').length == count) {
                return true;
            }
            return false;
        }

        @if (Request::is('/') && \Illuminate\Support\Facades\Cookie::has('popup_banner') == false)
            $(document).ready(function() {
                $('#popup-modal').appendTo("body").modal('show');
            });
            @php(\Illuminate\Support\Facades\Cookie::queue('popup_banner', 'off', 1))
        @endif

        $(".clickable").click(function() {
            let link = $(this).find("a").attr("href");
            if (!link) {
                link = $(this).closest('.product-single-hover').find("a[href*='product/']").attr("href");
            }
            if (!link) {
                link = $(this).siblings().find("a").attr("href");
            }
            if (link) {
                window.location = link;
            }
            return false;
        });


/* From app.blade.php inline script */
@foreach ($errors->all() as $error)
                toastr.error('{{ $error }}', Error, {
                    CloseButton: true,
                    ProgressBar: true
                });
            @endforeach


/* From app.blade.php inline script */
function couponCode() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: '{{ route('coupon.apply') }}',
                data: $('#coupon-code-ajax').serializeArray(),
                success: function(data) {
                    /* console.log(data);
                    return false; */
                    if (data.status == 1) {
                        let ms = data.messages;
                        ms.forEach(
                            function(m, index) {
                                toastr.success(m, index, {
                                    CloseButton: true,
                                    ProgressBar: true
                                });
                            }
                        );
                    } else {
                        let ms = data.messages;
                        ms.forEach(
                            function(m, index) {
                                toastr.error(m, index, {
                                    CloseButton: true,
                                    ProgressBar: true
                                });
                            }
                        );
                    }
                    setInterval(function() {
                        location.reload();
                    }, 2000);
                }
            });
        }

        jQuery(document).mouseup(function(e) {
            var container = jQuery(".search-card");
            if (!container.is(e.target) && container.has(e.target).length === 0) {
                container.hide();
            }
        });

    

        document.querySelectorAll('img').forEach(function(img) {
            img.addEventListener('error', function(event) {
                event.target.src = '{{ asset('assets/front-end/img/image-place-holder.png') }}';
                event.onerror = null;
            });
        });

        function route_alert(route, message) {
            Swal.fire({
                title: '{{ \App\CPU\translate('Are you sure') }}?',
                text: message,
                type: 'warning',
                showCancelButton: true,
                cancelButtonColor: 'default',
                confirmButtonColor: '{{ $web_config['primary_color'] }}',
                cancelButtonText: '{{ \App\CPU\translate('No') }}',
                confirmButtonText: '{{ \App\CPU\translate('Yes') }}',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    location.href = route;
                }
            })
        }


/* From app.blade.php inline script */
$('.filter-show-btn').on('click', function() {
            $('#shop-sidebar').toggleClass('show')
        })


/* From app.blade.php inline script */
@php($cookie = $web_config['cookie_setting'] ? json_decode($web_config['cookie_setting']['value'], true) : null)
        let cookie_content = `
        <div class="cookie-section">
            <div class="container">
                <div class="d-flex flex-wrap align-items-center justify-content-between column-gap-4 row-gap-3">
                    <div class="text-wrapper">
                        <h5 class="title">{{ \App\CPU\translate('Your_Privacy_Matter') }}</h5>
                        <div>{{ $cookie ? $cookie['cookie_text'] : '' }}</div>
                    </div>
                    <div class="btn-wrapper">
                        <span class="text-white cursor-pointer" id="cookie-reject">{{ \App\CPU\translate('no') }}, {{ \App\CPU\translate('thanks') }}</span>
                        <button class="btn btn-success cookie-accept" id="cookie-accept">{{ \App\CPU\translate('yes') }}, {{ \App\CPU\translate('i_Accept') }}</button>
                    </div>
                </div>
            </div>
        </div>
    `;
        $(document).on('click', '#cookie-accept', function() {
            document.cookie = '6valley_cookie_consent=accepted; max-age=' + 60 * 60 * 24 * 30;
            $('#cookie-section').hide();
        });
        $(document).on('click', '#cookie-reject', function() {
            document.cookie = '6valley_cookie_consent=reject; max-age=' + 60 * 60 * 24;
            $('#cookie-section').hide();
        });

        $(document).ready(function() {
            if (document.cookie.indexOf("6valley_cookie_consent=accepted") !== -1) {
                $('#cookie-section').hide();
            } else {
                $('#cookie-section').html(cookie_content).show();
            }
        });


/* From app.blade.php inline script */
document.addEventListener('DOMContentLoaded', function() {

            var links = document.querySelectorAll('a');

            var urlParams = new URLSearchParams(window.location.search);

            if (urlParams.toString() === '') {

                return;

            }

            for (var i = 0; i < links.length; i++) {

                var link = links[i];

                var linkUrl = link.href;

                var hashIndex = linkUrl.indexOf('#');

                var urlWithoutHash = linkUrl;

                var urlHash = '';

                if (hashIndex !== -1) {

                    urlWithoutHash = linkUrl.substring(0, hashIndex);

                    urlHash = linkUrl.substring(hashIndex);

                }

                var existingParams = new URLSearchParams(urlWithoutHash.split('?')[1]);

                urlParams.forEach(function(value, key) {

                    if (!existingParams.has(key)) {

                        existingParams.append(key, value);

                    }

                });

                link.href = urlWithoutHash.split('?')[0] + '?' + existingParams.toString() + urlHash;

            }

        });


/* From home.blade.php inline script */
$('#flash-deal-slider').owlCarousel({
            loop: false,
            autoplay: false,
            margin: 20,
            nav: true,
            navText: ["<i class='czi-arrow-left'></i>", "<i class='czi-arrow-right'></i>"],
            dots: false,
            autoplayHoverPause: true,
            '{{ session('direction') }}': false,
            // center: true,
            responsive: {
                //X-Small
                0: {
                    items: 1
                },
                360: {
                    items: 1
                },
                375: {
                    items: 1
                },
                540: {
                    items: 2
                },
                //Small
                576: {
                    items: 2
                },
                //Medium
                768: {
                    items: 2
                },
                //Large
                992: {
                    items: 2
                },
                //Extra large
                1200: {
                    items: 2
                },
                //Extra extra large
                1400: {
                    items: 3
                }
            }
        })

        $('#web-feature-deal-slider').owlCarousel({
            loop: false,
            autoplay: true,
            margin: 20,
            nav: false,
            //navText: ["<i class='czi-arrow-left'></i>", "<i class='czi-arrow-right'></i>"],
            dots: false,
            autoplayHoverPause: true,
            '{{ session(' direction ') }}': true,
            // center: true,
            responsive: {
                //X-Small
                0: {
                    items: 1
                },
                360: {
                    items: 1
                },
                375: {
                    items: 1
                },
                540: {
                    items: 2
                },
                //Small
                576: {
                    items: 2
                },
                //Medium
                768: {
                    items: 2
                },
                //Large
                992: {
                    items: 2
                },
                //Extra large
                1200: {
                    items: 2
                },
                //Extra extra large
                1400: {
                    items: 2
                }
            }
        })


        $('#featured_products_list').owlCarousel({
            loop: true,
            autoplay: true,
            margin: 15,
            nav: true,
            navText: ["<i class='czi-arrow-left'></i>", "<i class='czi-arrow-right'></i>"],
            dots: false,
            autoplayHoverPause: true,
            '{{ session(' direction ') }}': true,
            responsive: {
                0: {
                    items: 2,
                    margin: 8
                },
                360: {
                    items: 2,
                    margin: 10
                },
                576: {
                    items: 3,
                    margin: 12
                },
                768: {
                    items: 3,
                    margin: 15
                },
                992: {
                    items: 5,
                    margin: 15
                },
                1200: {
                    items: 5,
                    margin: 15
                },
                1400: {
                    items: 6,
                    margin: 15
                }
            }
        });

        $('#recently_viewed_products_list').owlCarousel({
            loop: true,
            autoplay: true,
            autoplayTimeout: 3000,
            smartSpeed: 800,
            margin: 15,
            nav: true,
            navText: ["<i class='czi-arrow-left'></i>", "<i class='czi-arrow-right'></i>"],
            dots: false,
            autoplayHoverPause: true,
            '{{ session('direction') }}': false,
            responsive: {
                0: {
                    items: 2,
                    margin: 8
                },
                360: {
                    items: 2,
                    margin: 10
                },
                576: {
                    items: 3,
                    margin: 12
                },
                768: {
                    items: 3,
                    margin: 15
                },
                992: {
                    items: 5,
                    margin: 15
                },
                1200: {
                    items: 5,
                    margin: 15
                },
                1400: {
                    items: 6,
                    margin: 15
                }
            }
        });

        $('#new-arrivals-slider').owlCarousel({
            loop: true,
            autoplay: true,
            margin: 15,
            nav: true,
            navText: ["<i class='czi-arrow-left'></i>", "<i class='czi-arrow-right'></i>"],
            dots: false,
            autoplayHoverPause: true,
            '{{ session('direction') }}': true,
            responsive: {
                0: {
                    items: 2,
                    margin: 8
                },
                360: {
                    items: 2,
                    margin: 10
                },
                576: {
                    items: 3,
                    margin: 12
                },
                768: {
                    items: 3,
                    margin: 15
                },
                992: {
                    items: 5,
                    margin: 15
                },
                1200: {
                    items: 5,
                    margin: 15
                },
                1400: {
                    items: 6,
                    margin: 15
                }
            }
        });

        $('#mobile-category-slider').owlCarousel({
            loop: false,
            autoplay: false,
            margin: 0,
            nav: false,
            dots: false,
            pullDrag: true,
            freeDrag: false,
            mouseDrag: true,
            touchDrag: true,
            responsive: {
                0: {
                    items: 3
                },
                480: {
                    items: 5
                },
                640: {
                    items: 6
                }
            }
        });

        $('#categorylist_slider').owlCarousel({
            loop: true,
            autoplay: true,
            autoplayTimeout: 3000,
            smartSpeed: 800,
            margin: 50,
            nav: true,
            navText: ["<i class='czi-arrow-left'></i>", "<i class='czi-arrow-right'></i>"],
            dots: false,
            autoplayHoverPause: true,
            '{{ session('direction') }}': true,
            responsive: {
                0: {
                    items: 1,
                    margin: 10,
                },
                360: {
                    items: 2,
                    margin: 10,
                },
                375: {
                    items: 2,
                    margin: 10,
                },
                425: {
                    items: 2,
                    margin: 10,
                },
                540: {
                    items: 2,
                    margin: 10,
                },
                576: {
                    items: 2,
                    margin: 10,
                },
                768: {
                    items: 3
                },
                992: {
                    items: 4
                },
                1200: {
                    items: 5
                },
                1400: {
                    items: 6
                }
            }
        });

        $('#main_section_banner').owlCarousel({
            loop: true,
            autoplay: false,
            margin: 20,
            nav: false,
            dots: false,
            autoplayHoverPause: true,
            '{{ session(' direction ') }}': false,
            // center: true,
            responsive: {
                //X-Small
                0: {
                    items: 1
                },
                360: {
                    items: 1
                },
                375: {
                    items: 1
                },
                540: {
                    items: 1
                },
                //Small
                576: {
                    items: 1
                },
                //Medium
                768: {
                    items: 2
                },
                //Large
                992: {
                    items: 2
                },
                //Extra large
                1200: {
                    items: 2
                },
                //Extra extra large
                1400: {
                    items: 3
                }
            }
        });

        $('#footer_banner_list').owlCarousel({
            loop: true,
            autoplay: false,
            margin: 50,
            nav: true,
            navText: ["<i class='czi-arrow-left'></i>", "<i class='czi-arrow-right'></i>"],
            dots: false,
            autoplayHoverPause: true,
            '{{ session(' direction ') }}': false,
            // center: true,
            responsive: {
                //X-Small
                0: {
                    items: 1
                },
                360: {
                    items: 1
                },
                375: {
                    items: 2
                },
                540: {
                    items: 2
                },
                //Small
                576: {
                    items: 2
                },
                //Medium
                768: {
                    items: 1
                },
                //Large
                992: {
                    items: 1
                },
                //Extra large
                1200: {
                    items: 4
                },
                //Extra extra large
                1400: {
                    items: 4
                }
            }
        });

        $('#brands-slider').owlCarousel({
            loop: true,
            autoplay: true,
            autoplayTimeout: 3000,
            margin: 12,
            nav: false,
            dots: false,
            autoplayHoverPause: true,
            responsive: {
                0: {
                    items: 3,
                    margin: 8
                },
                360: {
                    items: 3,
                    margin: 8
                },
                576: {
                    items: 5,
                    margin: 10
                },
                768: {
                    items: 7,
                    margin: 12
                },
                992: {
                    items: 8,
                    margin: 12
                },
                1200: {
                    items: 9,
                    margin: 12
                },
                1400: {
                    items: 10,
                    margin: 12
                }
            }
        });

        $('#category-slider, #top-seller-slider').owlCarousel({
            loop: false,
            autoplay: false,
            margin: 20,
            nav: false,
            navText: ["<i class='czi-arrow-left'></i>", "<i class='czi-arrow-right'></i>"],
            dots: true,
            autoplayHoverPause: true,
            '{{ session('direction ') }}': false,
            // center: true,
            responsive: {
                //X-Small
                0: {
                    items: 2
                },
                360: {
                    items: 3
                },
                375: {
                    items: 3
                },
                540: {
                    items: 4
                },
                //Small
                576: {
                    items: 5
                },
                //Medium
                768: {
                    items: 6
                },
                //Large
                992: {
                    items: 8
                },
                //Extra large
                1200: {
                    items: 10
                },
                //Extra extra large
                1400: {
                    items: 11
                }
            }
        })

        $('#latest-products-slider').owlCarousel({
            loop: true,
            autoplay: true,
            autoplayTimeout: 3000,
            margin: 10,
            nav: false,
            dots: true,
            autoplayHoverPause: true,
            '{{ session('direction') }}': false,
            responsive: {
                0: {
                    items: 2
                },
                360: {
                    items: 2
                },
                375: {
                    items: 2
                },
                480: {
                    items: 2
                }
            }
        });

        $('#main_section_banner_slider').owlCarousel({
            loop: true,
            autoplay: true,
            autoplayTimeout: 3500,
            margin: 10,
            nav: false,
            dots: true,
            autoplayHoverPause: true,
            '{{ session('direction') }}': true,
            responsive: {
                0: {
                    items: 1
                }
            }
        });

        $('#footer_banner_list').owlCarousel({
            loop: true,
            autoplay: true,
            autoplayTimeout: 3500,
            margin: 10,
            nav: true,
            navText: ["<i class='czi-arrow-left'></i>", "<i class='czi-arrow-right'></i>"],
            dots: true,
            autoplayHoverPause: true,
            '{{ session('direction') }}': true,
            responsive: {
                0: {
                    items: 1
                }
            }
        });


/* From home.blade.php inline script */
function updateStickyCategoryTop() {
            var header = document.querySelector('.navbar-sticky');
            var catBar = document.querySelector('.mobile-sticky-category');
            if (header && catBar) {
                var headerHeight = header.offsetHeight;
                catBar.style.top = headerHeight + 'px';
            }
        }
        updateStickyCategoryTop();
        window.addEventListener('resize', updateStickyCategoryTop);
        var observer = new MutationObserver(updateStickyCategoryTop);
        var header = document.querySelector('.navbar-sticky');
        if (header) {
            observer.observe(header, {
                attributes: true,
                attributeFilter: ['class', 'style']
            });
        }

