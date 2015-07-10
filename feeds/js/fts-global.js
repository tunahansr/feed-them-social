jQuery(document).ready(function(){jQuery("video").click(function(){jQuery(this).trigger(this.paused?this.paused?"play":"play":"pause")});var e=function(){var t=/d{1,4}|m{1,4}|yy(?:yy)?|([HhMsTt])\1?|[LloSZ]|"[^"]*"|'[^']*'/g,a=/\b(?:[PMCEA][SDP]T|(?:Pacific|Mountain|Central|Eastern|Atlantic) (?:Standard|Daylight|Prevailing) Time|(?:GMT|UTC)(?:[-+]\d{4})?)\b/g,n=/[^-+\dA-Z]/g,r=function(e,t){for(e=String(e),t=t||2;e.length<t;)e="0"+e;return e};return function(s,i,m){var y=e;if(1!=arguments.length||"[object String]"!=Object.prototype.toString.call(s)||/\d/.test(s)||(i=s,s=void 0),s=s?new Date(s):new Date,isNaN(s))throw SyntaxError("invalid date");i=String(y.masks[i]||i||y.masks["default"]),"UTC:"==i.slice(0,4)&&(i=i.slice(4),m=!0);var d=m?"getUTC":"get",o=s[d+"Date"](),u=s[d+"Day"](),l=s[d+"Month"](),c=s[d+"FullYear"](),M=s[d+"Hours"](),h=s[d+"Minutes"](),T=s[d+"Seconds"](),g=s[d+"Milliseconds"](),f=m?0:s.getTimezoneOffset(),p={d:o,dd:r(o),ddd:y.i18n.dayNames[u],dddd:y.i18n.dayNames[u+7],m:l+1,mm:r(l+1),mmm:y.i18n.monthNames[l],mmmm:y.i18n.monthNames[l+12],yy:String(c).slice(2),yyyy:c,h:M%12||12,hh:r(M%12||12),H:M,HH:r(M),M:h,MM:r(h),s:T,ss:r(T),l:r(g,3),L:r(g>99?Math.round(g/10):g),t:12>M?"a":"p",tt:12>M?"am":"pm",T:12>M?"A":"P",TT:12>M?"AM":"PM",Z:m?"UTC":(String(s).match(a)||[""]).pop().replace(n,""),o:(f>0?"-":"+")+r(100*Math.floor(Math.abs(f)/60)+Math.abs(f)%60,4),S:["th","st","nd","rd"][o%10>3?0:(o%100-o%10!=10)*o%10]};return i.replace(t,function(e){return e in p?p[e]:e.slice(1,e.length-1)})}}();e.masks={"default":"ddd mmm dd yyyy HH:MM:ss",shortDate:"m/d/yy",mediumDate:"mmm d, yyyy",longDate:"mmmm d, yyyy",fullDate:"dddd, mmmm d, yyyy",shortTime:"h:MM TT",mediumTime:"h:MM:ss TT",longTime:"h:MM:ss TT Z",isoDate:"yyyy-mm-dd",isoTime:"HH:MM:ss",isoDateTime:"yyyy-mm-dd'T'HH:MM:ss",isoUtcDateTime:"UTC:yyyy-mm-dd'T'HH:MM:ss'Z'"},e.i18n={dayNames:["Sun","Mon","Tue","Wed","Thu","Fri","Sat","Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"],monthNames:["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec","January","February","March","April","May","June","July","August","September","October","November","December"]},Date.prototype.format=function(t,a){return e(this,t,a)},jQuery(window).load(function(){jQuery(".fts-slicker-instagram").masonry({itemSelector:".slicker-instagram-placeholder"});var e=jQuery(".fts-pins-wrapper");e.imagesLoaded(function(){e.masonry()});var t=jQuery(".fts-slicker-facebook-posts");t.imagesLoaded(function(){t.masonry()})})});