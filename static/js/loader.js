var requirejs,require,define;!function(e){function t(e,t){return y.call(e,t)}function n(e,t){var n,r,o,i,s,a,l,u,c,p,f,d=t&&t.split("/"),h=m.map,v=h&&h["*"]||{};if(e){for(s=(e=e.split("/")).length-1,m.nodeIdCompat&&b.test(e[s])&&(e[s]=e[s].replace(b,"")),"."===e[0].charAt(0)&&d&&(e=d.slice(0,d.length-1).concat(e)),c=0;c<e.length;c++)if("."===(f=e[c]))e.splice(c,1),c-=1;else if(".."===f){if(0===c||1===c&&".."===e[2]||".."===e[c-1])continue;c>0&&(e.splice(c-1,2),c-=2)}e=e.join("/")}if((d||v)&&h){for(c=(n=e.split("/")).length;c>0;c-=1){if(r=n.slice(0,c).join("/"),d)for(p=d.length;p>0;p-=1)if((o=h[d.slice(0,p).join("/")])&&(o=o[r])){i=o,a=c;break}if(i)break;!l&&v&&v[r]&&(l=v[r],u=c)}!i&&l&&(i=l,a=u),i&&(n.splice(0,a,i),e=n.join("/"))}return e}function r(t,n){return function(){var r=g.call(arguments,0);return"string"!=typeof r[0]&&1===r.length&&r.push(null),p.apply(e,r.concat([t,n]))}}function o(e){return function(t){return n(t,e)}}function i(e){return function(t){h[e]=t}}function s(n){if(t(v,n)){var r=v[n];delete v[n],_[n]=!0,c.apply(e,r)}if(!t(h,n)&&!t(_,n))throw new Error("No "+n);return h[n]}function a(e){var t,n=e?e.indexOf("!"):-1;return n>-1&&(t=e.substring(0,n),e=e.substring(n+1,e.length)),[t,e]}function l(e){return e?a(e):[]}function u(e){return function(){return m&&m.config&&m.config[e]||{}}}var c,p,f,d,h={},v={},m={},_={},y=Object.prototype.hasOwnProperty,g=[].slice,b=/\.js$/;f=function(e,t){var r,i=a(e),l=i[0],u=t[1];return e=i[1],l&&(r=s(l=n(l,u))),l?e=r&&r.normalize?r.normalize(e,o(u)):n(e,u):(l=(i=a(e=n(e,u)))[0],e=i[1],l&&(r=s(l))),{f:l?l+"!"+e:e,n:e,pr:l,p:r}},d={require:function(e){return r(e)},exports:function(e){var t=h[e];return void 0!==t?t:h[e]={}},module:function(e){return{id:e,uri:"",exports:h[e],config:u(e)}}},c=function(n,o,a,u){var c,p,m,y,g,b,w,x=[],k=typeof a;if(u=u||n,b=l(u),"undefined"===k||"function"===k){for(o=!o.length&&a.length?["require","exports","module"]:o,g=0;g<o.length;g+=1)if(y=f(o[g],b),"require"===(p=y.f))x[g]=d.require(n);else if("exports"===p)x[g]=d.exports(n),w=!0;else if("module"===p)c=x[g]=d.module(n);else if(t(h,p)||t(v,p)||t(_,p))x[g]=s(p);else{if(!y.p)throw new Error(n+" missing "+p);y.p.load(y.n,r(u,!0),i(p),{}),x[g]=h[p]}m=a?a.apply(h[n],x):void 0,n&&(c&&c.exports!==e&&c.exports!==h[n]?h[n]=c.exports:m===e&&w||(h[n]=m))}else n&&(h[n]=a)},requirejs=require=p=function(t,n,r,o,i){if("string"==typeof t)return d[t]?d[t](n):s(f(t,l(n)).f);if(!t.splice){if((m=t).deps&&p(m.deps,m.callback),!n)return;n.splice?(t=n,n=r,r=null):t=e}return n=n||function(){},"function"==typeof r&&(r=o,o=i),o?c(e,t,n,r):setTimeout(function(){c(e,t,n,r)},4),p},p.config=function(e){return p(e)},requirejs._defined=h,(define=function(e,n,r){if("string"!=typeof e)throw new Error("See almond README: incorrect module build, no module name");n.splice||(r=n,n=[]),t(h,e)||t(v,e)||(v[e]=[e,n,r])}).amd={jQuery:!0}}(),define("almond",function(){}),define("events",["require","exports","module"],function(e,t,n){function r(){this._events=this._events||{},this._maxListeners=this._maxListeners||void 0}function o(e){return"function"==typeof e}function i(e){return"number"==typeof e}function s(e){return"object"==typeof e&&null!==e}function a(e){return void 0===e}n.exports=r,r.EventEmitter=r,r.prototype._events=void 0,r.prototype._maxListeners=void 0,r.defaultMaxListeners=10,r.prototype.setMaxListeners=function(e){if(!i(e)||e<0||isNaN(e))throw TypeError("n must be a positive number");return this._maxListeners=e,this},r.prototype.emit=function(e){var t,n,r,i,l,u;if(this._events||(this._events={}),"error"===e&&(!this._events.error||s(this._events.error)&&!this._events.error.length)){if((t=arguments[1])instanceof Error)throw t;var c=new Error('Uncaught, unspecified "error" event. ('+t+")");throw c.context=t,c}if(n=this._events[e],a(n))return!1;if(o(n))switch(arguments.length){case 1:n.call(this);break;case 2:n.call(this,arguments[1]);break;case 3:n.call(this,arguments[1],arguments[2]);break;default:i=Array.prototype.slice.call(arguments,1),n.apply(this,i)}else if(s(n))for(i=Array.prototype.slice.call(arguments,1),r=(u=n.slice()).length,l=0;l<r;l++)u[l].apply(this,i);return!0},r.prototype.addListener=function(e,t){var n;if(!o(t))throw TypeError("listener must be a function");return this._events||(this._events={}),this._events.newListener&&this.emit("newListener",e,o(t.listener)?t.listener:t),this._events[e]?s(this._events[e])?this._events[e].push(t):this._events[e]=[this._events[e],t]:this._events[e]=t,s(this._events[e])&&!this._events[e].warned&&(n=a(this._maxListeners)?r.defaultMaxListeners:this._maxListeners)&&n>0&&this._events[e].length>n&&(this._events[e].warned=!0,console.error("(node) warning: possible EventEmitter memory leak detected. %d listeners added. Use emitter.setMaxListeners() to increase limit.",this._events[e].length),"function"==typeof console.trace&&console.trace()),this},r.prototype.on=r.prototype.addListener,r.prototype.once=function(e,t){function n(){this.removeListener(e,n),r||(r=!0,t.apply(this,arguments))}if(!o(t))throw TypeError("listener must be a function");var r=!1;return n.listener=t,this.on(e,n),this},r.prototype.removeListener=function(e,t){var n,r,i,a;if(!o(t))throw TypeError("listener must be a function");if(!this._events||!this._events[e])return this;if(n=this._events[e],i=n.length,r=-1,n===t||o(n.listener)&&n.listener===t)delete this._events[e],this._events.removeListener&&this.emit("removeListener",e,t);else if(s(n)){for(a=i;a-- >0;)if(n[a]===t||n[a].listener&&n[a].listener===t){r=a;break}if(r<0)return this;1===n.length?(n.length=0,delete this._events[e]):n.splice(r,1),this._events.removeListener&&this.emit("removeListener",e,t)}return this},r.prototype.removeAllListeners=function(e){var t,n;if(!this._events)return this;if(!this._events.removeListener)return 0===arguments.length?this._events={}:this._events[e]&&delete this._events[e],this;if(0===arguments.length){for(t in this._events)"removeListener"!==t&&this.removeAllListeners(t);return this.removeAllListeners("removeListener"),this._events={},this}if(n=this._events[e],o(n))this.removeListener(e,n);else if(n)for(;n.length;)this.removeListener(e,n[n.length-1]);return delete this._events[e],this},r.prototype.listeners=function(e){return this._events&&this._events[e]?o(this._events[e])?[this._events[e]]:this._events[e].slice():[]},r.prototype.listenerCount=function(e){if(this._events){var t=this._events[e];if(o(t))return 1;if(t)return t.length}return 0},r.listenerCount=function(e,t){return e.listenerCount(t)}}),function(e,t){"object"==typeof exports&&exports&&"string"!=typeof exports.nodeName?t(exports):"function"==typeof define&&define.amd?define("mustache",["exports"],t):(e.Mustache={},t(e.Mustache))}(this,function(e){function t(e){return"function"==typeof e}function n(e){return h(e)?"array":typeof e}function r(e){return e.replace(/[\-\[\]{}()*+?.,\\\^$|#\s]/g,"\\$&")}function o(e,t){return null!=e&&"object"==typeof e&&t in e}function i(e,t){return v.call(e,t)}function s(e){return!i(m,e)}function a(t,n){function o(e){if("string"==typeof e&&(e=e.split(g,2)),!h(e)||2!==e.length)throw new Error("Invalid tags: "+e);i=new RegExp(r(e[0])+"\\s*"),a=new RegExp("\\s*"+r(e[1])),p=new RegExp("\\s*"+r("}"+e[1]))}if(!t)return[];var i,a,p,f=[],d=[],v=[],m=!1,_=!1;o(n||e.tags);for(var k,C,E,L,S,T,N=new c(t);!N.eos();){if(k=N.pos,E=N.scanUntil(i))for(var U=0,M=E.length;U<M;++U)s(L=E.charAt(U))?v.push(d.length):_=!0,d.push(["text",L,k,k+1]),k+=1,"\n"===L&&function(){if(m&&!_)for(;v.length;)delete d[v.pop()];else v=[];m=!1,_=!1}();if(!N.scan(i))break;if(m=!0,C=N.scan(x)||"name",N.scan(y),"="===C?(E=N.scanUntil(b),N.scan(b),N.scanUntil(a)):"{"===C?(E=N.scanUntil(p),N.scan(w),N.scanUntil(a),C="&"):E=N.scanUntil(a),!N.scan(a))throw new Error("Unclosed tag at "+N.pos);if(S=[C,E,k,N.pos],d.push(S),"#"===C||"^"===C)f.push(S);else if("/"===C){if(!(T=f.pop()))throw new Error('Unopened section "'+E+'" at '+k);if(T[1]!==E)throw new Error('Unclosed section "'+T[1]+'" at '+k)}else"name"===C||"{"===C||"&"===C?_=!0:"="===C&&o(E)}if(T=f.pop())throw new Error('Unclosed section "'+T[1]+'" at '+N.pos);return u(l(d))}function l(e){for(var t,n,r=[],o=0,i=e.length;o<i;++o)(t=e[o])&&("text"===t[0]&&n&&"text"===n[0]?(n[1]+=t[1],n[3]=t[3]):(r.push(t),n=t));return r}function u(e){for(var t,n=[],r=n,o=[],i=0,s=e.length;i<s;++i)switch((t=e[i])[0]){case"#":case"^":r.push(t),o.push(t),r=t[4]=[];break;case"/":o.pop()[5]=t[2],r=o.length>0?o[o.length-1][4]:n;break;default:r.push(t)}return n}function c(e){this.string=e,this.tail=e,this.pos=0}function p(e,t){this.view=e,this.cache={".":this.view},this.parent=t}function f(){this.cache={}}var d=Object.prototype.toString,h=Array.isArray||function(e){return"[object Array]"===d.call(e)},v=RegExp.prototype.test,m=/\S/,_={"&":"&amp;","<":"&lt;",">":"&gt;",'"':"&quot;","'":"&#39;","/":"&#x2F;","`":"&#x60;","=":"&#x3D;"},y=/\s*/,g=/\s+/,b=/\s*=/,w=/\s*\}/,x=/#|\^|\/|>|\{|&|=|!/;c.prototype.eos=function(){return""===this.tail},c.prototype.scan=function(e){var t=this.tail.match(e);if(!t||0!==t.index)return"";var n=t[0];return this.tail=this.tail.substring(n.length),this.pos+=n.length,n},c.prototype.scanUntil=function(e){var t,n=this.tail.search(e);switch(n){case-1:t=this.tail,this.tail="";break;case 0:t="";break;default:t=this.tail.substring(0,n),this.tail=this.tail.substring(n)}return this.pos+=t.length,t},p.prototype.push=function(e){return new p(e,this)},p.prototype.lookup=function(e){var n,r=this.cache;if(r.hasOwnProperty(e))n=r[e];else{for(var i,s,a=this,l=!1;a;){if(e.indexOf(".")>0)for(n=a.view,i=e.split("."),s=0;null!=n&&s<i.length;)s===i.length-1&&(l=o(n,i[s])),n=n[i[s++]];else n=a.view[e],l=o(a.view,e);if(l)break;a=a.parent}r[e]=n}return t(n)&&(n=n.call(this.view)),n},f.prototype.clearCache=function(){this.cache={}},f.prototype.parse=function(e,t){var n=this.cache,r=n[e];return null==r&&(r=n[e]=a(e,t)),r},f.prototype.render=function(e,t,n){var r=this.parse(e),o=t instanceof p?t:new p(t);return this.renderTokens(r,o,n,e)},f.prototype.renderTokens=function(e,t,n,r){for(var o,i,s,a="",l=0,u=e.length;l<u;++l)s=void 0,"#"===(i=(o=e[l])[0])?s=this.renderSection(o,t,n,r):"^"===i?s=this.renderInverted(o,t,n,r):">"===i?s=this.renderPartial(o,t,n,r):"&"===i?s=this.unescapedValue(o,t):"name"===i?s=this.escapedValue(o,t):"text"===i&&(s=this.rawValue(o)),void 0!==s&&(a+=s);return a},f.prototype.renderSection=function(e,n,r,o){var i=this,s="",a=n.lookup(e[1]);if(a){if(h(a))for(var l=0,u=a.length;l<u;++l)s+=this.renderTokens(e[4],n.push(a[l]),r,o);else if("object"==typeof a||"string"==typeof a||"number"==typeof a)s+=this.renderTokens(e[4],n.push(a),r,o);else if(t(a)){if("string"!=typeof o)throw new Error("Cannot use higher-order sections without the original template");null!=(a=a.call(n.view,o.slice(e[3],e[5]),function(e){return i.render(e,n,r)}))&&(s+=a)}else s+=this.renderTokens(e[4],n,r,o);return s}},f.prototype.renderInverted=function(e,t,n,r){var o=t.lookup(e[1]);if(!o||h(o)&&0===o.length)return this.renderTokens(e[4],t,n,r)},f.prototype.renderPartial=function(e,n,r){if(r){var o=t(r)?r(e[1]):r[e[1]];return null!=o?this.renderTokens(this.parse(o),n,r,o):void 0}},f.prototype.unescapedValue=function(e,t){var n=t.lookup(e[1]);if(null!=n)return n},f.prototype.escapedValue=function(t,n){var r=n.lookup(t[1]);if(null!=r)return e.escape(r)},f.prototype.rawValue=function(e){return e[1]},e.name="mustache.js",e.version="2.3.0",e.tags=["{{","}}"];var k=new f;return e.clearCache=function(){return k.clearCache()},e.parse=function(e,t){return k.parse(e,t)},e.render=function(e,t,r){if("string"!=typeof e)throw new TypeError('Invalid template! Template should be a "string" but "'+n(e)+'" was given as the first argument for mustache#render(template, view, partials)');return k.render(e,t,r)},e.to_html=function(n,r,o,i){var s=e.render(n,r,o);if(!t(i))return s;i(s)},e.escape=function(e){return String(e).replace(/[&<>"'`=\/]/g,function(e){return _[e]})},e.Scanner=c,e.Context=p,e.Writer=f,e}),function(){"use strict";function e(){for(var n=[],r=0;r<arguments.length;r++){var o=arguments[r];if(o){var i=typeof o;if("string"===i||"number"===i)n.push(o);else if(Array.isArray(o))n.push(e.apply(null,o));else if("object"===i)for(var s in o)t.call(o,s)&&o[s]&&n.push(s)}}return n.join(" ")}var t={}.hasOwnProperty;"undefined"!=typeof module&&module.exports?module.exports=e:"function"==typeof define&&"object"==typeof define.amd&&define.amd?define("classnames",[],function(){return e}):window.classNames=e}(),define("preact",["require","exports","module"],function(e,t,n){!function(){"use strict";function e(){}function t(t,n){var r,o,i,s,a=M;for(s=arguments.length;s-- >2;)U.push(arguments[s]);for(n&&null!=n.children&&(U.length||U.push(n.children),delete n.children);U.length;)if((o=U.pop())&&void 0!==o.pop)for(s=o.length;s--;)U.push(o[s]);else"boolean"==typeof o&&(o=null),(i="function"!=typeof t)&&(null==o?o="":"number"==typeof o?o=String(o):"string"!=typeof o&&(i=!1)),i&&r?a[a.length-1]+=o:a===M?a=[o]:a.push(o),r=i;var l=new e;return l.nodeName=t,l.children=a,l.attributes=null==n?void 0:n,l.key=null==n?void 0:n.key,void 0!==N.vnode&&N.vnode(l),l}function r(e,t){for(var n in t)e[n]=t[n];return e}function o(e){!e.__d&&(e.__d=!0)&&1==D.push(e)&&(N.debounceRendering||j)(i)}function i(){var e,t=D;for(D=[];e=t.pop();)e.__d&&E(e)}function s(e,t,n){return"string"==typeof t||"number"==typeof t?void 0!==e.splitText:"string"==typeof t.nodeName?!e._componentConstructor&&a(e,t.nodeName):n||e._componentConstructor===t.nodeName}function a(e,t){return e.__n===t||e.nodeName.toLowerCase()===t.toLowerCase()}function l(e){var t=r({},e.attributes);t.children=e.children;var n=e.nodeName.defaultProps;if(void 0!==n)for(var o in n)void 0===t[o]&&(t[o]=n[o]);return t}function u(e,t){var n=t?document.createElementNS("http://www.w3.org/2000/svg",e):document.createElement(e);return n.__n=e,n}function c(e){var t=e.parentNode;t&&t.removeChild(e)}function p(e,t,n,r,o){if("className"===t&&(t="class"),"key"===t);else if("ref"===t)n&&n(null),r&&r(e);else if("class"!==t||o)if("style"===t){if(r&&"string"!=typeof r&&"string"!=typeof n||(e.style.cssText=r||""),r&&"object"==typeof r){if("string"!=typeof n)for(var i in n)i in r||(e.style[i]="");for(var i in r)e.style[i]="number"==typeof r[i]&&!1===A.test(i)?r[i]+"px":r[i]}}else if("dangerouslySetInnerHTML"===t)r&&(e.innerHTML=r.__html||"");else if("o"==t[0]&&"n"==t[1]){var s=t!==(t=t.replace(/Capture$/,""));t=t.toLowerCase().substring(2),r?n||e.addEventListener(t,d,s):e.removeEventListener(t,d,s),(e.__l||(e.__l={}))[t]=r}else if("list"!==t&&"type"!==t&&!o&&t in e)f(e,t,null==r?"":r),null!=r&&!1!==r||e.removeAttribute(t);else{var a=o&&t!==(t=t.replace(/^xlink\:?/,""));null==r||!1===r?a?e.removeAttributeNS("http://www.w3.org/1999/xlink",t.toLowerCase()):e.removeAttribute(t):"function"!=typeof r&&(a?e.setAttributeNS("http://www.w3.org/1999/xlink",t.toLowerCase(),r):e.setAttribute(t,r))}else e.className=r||""}function f(e,t,n){try{e[t]=n}catch(e){}}function d(e){return this.__l[e.type](N.event&&N.event(e)||e)}function h(){for(var e;e=q.pop();)N.afterMount&&N.afterMount(e),e.componentDidMount&&e.componentDidMount()}function v(e,t,n,r,o,i){W++||(O=null!=o&&void 0!==o.ownerSVGElement,P=null!=e&&!("__preactattr_"in e));var s=m(e,t,n,r,i);return o&&s.parentNode!==o&&o.appendChild(s),--W||(P=!1,i||h()),s}function m(e,t,n,r,o){var i=e,s=O;if(null!=t&&"boolean"!=typeof t||(t=""),"string"==typeof t||"number"==typeof t)return e&&void 0!==e.splitText&&e.parentNode&&(!e._component||o)?e.nodeValue!=t&&(e.nodeValue=t):(i=document.createTextNode(t),e&&(e.parentNode&&e.parentNode.replaceChild(i,e),y(e,!0))),i.__preactattr_=!0,i;var l=t.nodeName;if("function"==typeof l)return L(e,t,n,r);if(O="svg"===l||"foreignObject"!==l&&O,l=String(l),(!e||!a(e,l))&&(i=u(l,O),e)){for(;e.firstChild;)i.appendChild(e.firstChild);e.parentNode&&e.parentNode.replaceChild(i,e),y(e,!0)}var c=i.firstChild,p=i.__preactattr_,f=t.children;if(null==p){p=i.__preactattr_={};for(var d=i.attributes,h=d.length;h--;)p[d[h].name]=d[h].value}return!P&&f&&1===f.length&&"string"==typeof f[0]&&null!=c&&void 0!==c.splitText&&null==c.nextSibling?c.nodeValue!=f[0]&&(c.nodeValue=f[0]):(f&&f.length||null!=c)&&_(i,f,n,r,P||null!=p.dangerouslySetInnerHTML),b(i,t.attributes,p),O=s,i}function _(e,t,n,r,o){var i,a,l,u,p,f=e.childNodes,d=[],h={},v=0,_=0,g=f.length,b=0,w=t?t.length:0;if(0!==g)for(E=0;E<g;E++){var x=f[E],k=x.__preactattr_;null!=(C=w&&k?x._component?x._component.__k:k.key:null)?(v++,h[C]=x):(k||(void 0!==x.splitText?!o||x.nodeValue.trim():o))&&(d[b++]=x)}if(0!==w)for(E=0;E<w;E++){p=null;var C=(u=t[E]).key;if(null!=C)v&&void 0!==h[C]&&(p=h[C],h[C]=void 0,v--);else if(!p&&_<b)for(i=_;i<b;i++)if(void 0!==d[i]&&s(a=d[i],u,o)){p=a,d[i]=void 0,i===b-1&&b--,i===_&&_++;break}p=m(p,u,n,r),l=f[E],p&&p!==e&&p!==l&&(null==l?e.appendChild(p):p===l.nextSibling?c(l):e.insertBefore(p,l))}if(v)for(var E in h)void 0!==h[E]&&y(h[E],!1);for(;_<=b;)void 0!==(p=d[b--])&&y(p,!1)}function y(e,t){var n=e._component;n?S(n):(null!=e.__preactattr_&&e.__preactattr_.ref&&e.__preactattr_.ref(null),!1!==t&&null!=e.__preactattr_||c(e),g(e))}function g(e){for(e=e.lastChild;e;){var t=e.previousSibling;y(e,!0),e=t}}function b(e,t,n){var r;for(r in n)t&&null!=t[r]||null==n[r]||p(e,r,n[r],n[r]=void 0,O);for(r in t)"children"===r||"innerHTML"===r||r in n&&t[r]===("value"===r||"checked"===r?e[r]:n[r])||p(e,r,n[r],n[r]=t[r],O)}function w(e){var t=e.constructor.name;(z[t]||(z[t]=[])).push(e)}function x(e,t,n){var r,o=z[e.name];if(e.prototype&&e.prototype.render?(r=new e(t,n),T.call(r,t,n)):((r=new T(t,n)).constructor=e,r.render=k),o)for(var i=o.length;i--;)if(o[i].constructor===e){r.__b=o[i].__b,o.splice(i,1);break}return r}function k(e,t,n){return this.constructor(e,n)}function C(e,t,n,r,i){e.__x||(e.__x=!0,(e.__r=t.ref)&&delete t.ref,(e.__k=t.key)&&delete t.key,!e.base||i?e.componentWillMount&&e.componentWillMount():e.componentWillReceiveProps&&e.componentWillReceiveProps(t,r),r&&r!==e.context&&(e.__c||(e.__c=e.context),e.context=r),e.__p||(e.__p=e.props),e.props=t,e.__x=!1,0!==n&&(1!==n&&!1===N.syncComponentUpdates&&e.base?o(e):E(e,1,i)),e.__r&&e.__r(e))}function E(e,t,n,o){if(!e.__x){var i,s,a,u=e.props,c=e.state,p=e.context,f=e.__p||u,d=e.__s||c,m=e.__c||p,_=e.base,g=e.__b,b=_||g,w=e._component,k=!1;if(_&&(e.props=f,e.state=d,e.context=m,2!==t&&e.shouldComponentUpdate&&!1===e.shouldComponentUpdate(u,c,p)?k=!0:e.componentWillUpdate&&e.componentWillUpdate(u,c,p),e.props=u,e.state=c,e.context=p),e.__p=e.__s=e.__c=e.__b=null,e.__d=!1,!k){i=e.render(u,c,p),e.getChildContext&&(p=r(r({},p),e.getChildContext()));var L,T,U=i&&i.nodeName;if("function"==typeof U){var M=l(i);(s=w)&&s.constructor===U&&M.key==s.__k?C(s,M,1,p,!1):(L=s,e._component=s=x(U,M,p),s.__b=s.__b||g,s.__u=e,C(s,M,0,p,!1),E(s,1,n,!0)),T=s.base}else a=b,(L=w)&&(a=e._component=null),(b||1===t)&&(a&&(a._component=null),T=v(a,i,p,n||!_,b&&b.parentNode,!0));if(b&&T!==b&&s!==w){var j=b.parentNode;j&&T!==j&&(j.replaceChild(T,b),L||(b._component=null,y(b,!1)))}if(L&&S(L),e.base=T,T&&!o){for(var A=e,D=e;D=D.__u;)(A=D).base=T;T._component=A,T._componentConstructor=A.constructor}}if(!_||n?q.unshift(e):k||(e.componentDidUpdate&&e.componentDidUpdate(f,d,m),N.afterUpdate&&N.afterUpdate(e)),null!=e.__h)for(;e.__h.length;)e.__h.pop().call(e);W||o||h()}}function L(e,t,n,r){for(var o=e&&e._component,i=o,s=e,a=o&&e._componentConstructor===t.nodeName,u=a,c=l(t);o&&!u&&(o=o.__u);)u=o.constructor===t.nodeName;return o&&u&&(!r||o._component)?(C(o,c,3,n,r),e=o.base):(i&&!a&&(S(i),e=s=null),o=x(t.nodeName,c,n),e&&!o.__b&&(o.__b=e,s=null),C(o,c,1,n,r),e=o.base,s&&e!==s&&(s._component=null,y(s,!1))),e}function S(e){N.beforeUnmount&&N.beforeUnmount(e);var t=e.base;e.__x=!0,e.componentWillUnmount&&e.componentWillUnmount(),e.base=null;var n=e._component;n?S(n):t&&(t.__preactattr_&&t.__preactattr_.ref&&t.__preactattr_.ref(null),e.__b=t,c(t),w(e),g(t)),e.__r&&e.__r(null)}function T(e,t){this.__d=!0,this.context=t,this.props=e,this.state=this.state||{}}var N={},U=[],M=[],j="function"==typeof Promise?Promise.resolve().then.bind(Promise.resolve()):setTimeout,A=/acit|ex(?:s|g|n|p|$)|rph|ows|mnc|ntw|ine[ch]|zoo|^ord/i,D=[],q=[],W=0,O=!1,P=!1,z={};r(T.prototype,{setState:function(e,t){var n=this.state;this.__s||(this.__s=r({},n)),r(n,"function"==typeof e?e(n,this.props):e),t&&(this.__h=this.__h||[]).push(t),o(this)},forceUpdate:function(e){e&&(this.__h=this.__h||[]).push(e),E(this,2)},render:function(){}});var I={h:t,createElement:t,cloneElement:function(e,n){return t(e.nodeName,r(r({},e.attributes),n),arguments.length>2?[].slice.call(arguments,2):e.children)},Component:T,render:function(e,t,n){return v(n,e,{},!1,t,!1)},rerender:i,options:N};void 0!==n?n.exports=I:self.preact=I}()}),define("textarea-caret",["require","exports","module"],function(e,t,n){!function(){function e(e,n,i){if(!r)throw new Error("textarea-caret-position#getCaretCoordinates should only be called in a browser");var s=i&&i.debug||!1;if(s){var a=document.querySelector("#input-textarea-caret-position-mirror-div");a&&a.parentNode.removeChild(a)}var l=document.createElement("div");l.id="input-textarea-caret-position-mirror-div",document.body.appendChild(l);var u=l.style,c=window.getComputedStyle?getComputedStyle(e):e.currentStyle;u.whiteSpace="pre-wrap","INPUT"!==e.nodeName&&(u.wordWrap="break-word"),u.position="absolute",s||(u.visibility="hidden"),t.forEach(function(e){u[e]=c[e]}),o?e.scrollHeight>parseInt(c.height)&&(u.overflowY="scroll"):u.overflow="hidden",l.textContent=e.value.substring(0,n),"INPUT"===e.nodeName&&(l.textContent=l.textContent.replace(/\s/g," "));var p=document.createElement("span");p.textContent=e.value.substring(n)||".",l.appendChild(p);var f={top:p.offsetTop+parseInt(c.borderTopWidth),left:p.offsetLeft+parseInt(c.borderLeftWidth)};return s?p.style.backgroundColor="#aaa":document.body.removeChild(l),f}var t=["direction","boxSizing","width","height","overflowX","overflowY","borderTopWidth","borderRightWidth","borderBottomWidth","borderLeftWidth","borderStyle","paddingTop","paddingRight","paddingBottom","paddingLeft","fontStyle","fontVariant","fontWeight","fontStretch","fontSize","fontSizeAdjust","lineHeight","fontFamily","textAlign","textTransform","textIndent","textDecoration","letterSpacing","wordSpacing","tabSize","MozTabSize"],r="undefined"!=typeof window,o=r&&null!=window.mozInnerScreenX;void 0!==n&&void 0!==n.exports?n.exports=e:r&&(window.getCaretCoordinates=e)}()}),define("loader",["almond","events","mustache","classnames","preact","textarea-caret"],function(){function check(func){try{return eval("(function(){"+func+"})()")}catch(e){return!1}}function checkFunction(func){try{return"function"==typeof eval(func)}catch(e){return!1}}function loadScript(e){var t=document.createElement("script");return t.src="/static/js/"+e+".js",t.async=!0,document.body.appendChild(t),t}function checkAllLoaded(){0==--scriptCount&&requirejs("app")}for(var scriptCount=0,scripts=[],es6Tests=["return (()=>5)()===5;",'"use strict";  const bar = 123; {const bar = 456;} return bar===123;','"use strict"; let bar = 123;{ let bar = 456; }return bar === 123;',"var x='y';return ({ [x]: 1 }).y === 1;","var a=7,b=8,c={a,b};return c.a===7 && c.b===8;",'var a = "ba"; return `foo bar${a + "z"}` === "foo barbaz";',"var arr = [5]; for (var item of arr) return item === 5;","return Math.max(...[1, 2, 3]) === 3",'"use strict"; class C {}; return typeof C === "function"','"use strict"; var passed = false;class B {constructor(a) {  passed = (a === "barbaz")}};class C extends B {constructor(a) {super("bar" + a)}};new C("baz"); return passed;',"return (function (a = 1, b = 2) { return a === 3 && b === 2; }(3));","var [a,,[b],c] = [5,null,[6]];return a===5 && b===6 && c===undefined","return function([a,,[b],c]){return a===5 && b===6 && c===undefined;}([5,null,[6]])","function * generator(){yield 5; yield 6};var iterator = generator();var item = iterator.next();var passed = item.value === 5 && item.done === false;item = iterator.next();passed &= item.value === 6 && item.done === false;item = iterator.next();passed &= item.value === undefined && item.done === true;return passed;"],i=0;i<es6Tests.length;i++)if(!check(es6Tests[i])){window.legacy=!0;break}for(var stdlibTests=["Set","Map","Promise","Symbol","Array.from","Array.prototype.includes","String.prototype.includes","String.prototype.repeat"],i=0;i<stdlibTests.length;i++)if(!checkFunction(stdlibTests[i])){scripts.push("core.min");break}checkFunction("Proxy")||scripts.push("proxy.min");for(var DOMMethods=["Element.prototype.remove","Element.prototype.contains","Element.prototype.matches","Element.prototype.after","Element.prototype.before","Element.prototype.append","Element.prototype.prepend","Element.prototype.replaceWith","Element.prototype.querySelector","Element.prototype.querySelectorAll"],DOMUpToDate=!0,i=0;i<DOMMethods.length;i++)if(!checkFunction(DOMMethods[i])){DOMUpToDate=!1;break}if(DOMUpToDate){var s='var a = document.createElement("a");var ctr = 0;a.addEventListener("click", () => ctr++, {once: true});a.click(); a.click();return ctr === 1;';DOMUpToDate=check(s)}DOMUpToDate||scripts.push("dom4"),checkFunction("fetch")||scripts.push("fetch"),window.legacy||checkFunction("NodeList.prototype[Symbol.iterator]")||(NodeList.prototype[Symbol.iterator]=Array.prototype[Symbol.iterator]),checkFunction("window.crypto.subtle.digest")||(checkFunction("window.crypto.webkitSubtle.digest")?window.crypto.subtle=window.crypto.webkitSubtle:checkFunction("window.msCrypto.subtle.digest")&&(window.crypto=window.msCrypto)),scripts.push("app"+(window.legacy?".es5":""));for(var i=0;i<scripts.length;i++)scriptCount++,loadScript(scripts[i]).onload=checkAllLoaded}),requirejs("loader");