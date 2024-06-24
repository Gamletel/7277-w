(()=>{var e,t={7750:(e,t,r)=>{"use strict";r.r(t);var o=r(9196);const n=window.wp.blocks;var c=r(2911),i=r(1231);const a=window.wc.wcSettings;var l,s,u,p,m,d,g,w,f,E;const _=(0,a.getSetting)("wcBlocksConfig",{buildPhase:1,pluginUrl:"",productCount:0,defaultAvatar:"",restApiRoutes:{},wordCountType:"words"}),b=(_.pluginUrl,_.pluginUrl,_.buildPhase),y=(null===(l=a.STORE_PAGES.shop)||void 0===l||l.permalink,null===(s=a.STORE_PAGES.checkout)||void 0===s||s.id,null===(u=a.STORE_PAGES.checkout)||void 0===u||u.permalink,null===(p=a.STORE_PAGES.privacy)||void 0===p||p.permalink,null===(m=a.STORE_PAGES.privacy)||void 0===m||m.title,null===(d=a.STORE_PAGES.terms)||void 0===d||d.permalink,null===(g=a.STORE_PAGES.terms)||void 0===g||g.title,null===(w=a.STORE_PAGES.cart)||void 0===w||w.id,null===(f=a.STORE_PAGES.cart)||void 0===f||f.permalink,null!==(E=a.STORE_PAGES.myaccount)&&void 0!==E&&E.permalink?a.STORE_PAGES.myaccount.permalink:(0,a.getSetting)("wpLoginUrl","/wp-login.php"),(0,a.getSetting)("localPickupEnabled",!1),(0,a.getSetting)("countries",{})),v=(0,a.getSetting)("countryData",{}),S=(Object.fromEntries(Object.keys(v).filter((e=>!0===v[e].allowBilling)).map((e=>[e,y[e]||""]))),Object.fromEntries(Object.keys(v).filter((e=>!0===v[e].allowBilling)).map((e=>[e,v[e].states||[]]))),Object.fromEntries(Object.keys(v).filter((e=>!0===v[e].allowShipping)).map((e=>[e,y[e]||""]))),Object.fromEntries(Object.keys(v).filter((e=>!0===v[e].allowShipping)).map((e=>[e,v[e].states||[]]))),Object.fromEntries(Object.keys(v).map((e=>[e,v[e].locale||[]]))),{address:["first_name","last_name","company","address_1","address_2","city","postcode","country","state","phone"],contact:["email"],additional:[]});(0,a.getSetting)("addressFieldsLocations",S).address,(0,a.getSetting)("addressFieldsLocations",S).contact,(0,a.getSetting)("addressFieldsLocations",S).additional,(0,a.getSetting)("additionalFields",{}),(0,a.getSetting)("additionalContactFields",{}),(0,a.getSetting)("additionalAddressFields",{}),r(1508);const h=JSON.parse('{"$schema":"https://schemas.wp.org/trunk/block.json","name":"woocommerce/product-filter-price","version":"1.0.0","title":"Product Filter: Price (Beta)","description":"Enable customers to filter the product collection by choosing a price range.","category":"woocommerce","keywords":["WooCommerce"],"textdomain":"woocommerce","apiVersion":2,"ancestor":["woocommerce/product-filter"],"supports":{"interactivity":true,"inserter":false},"usesContext":["query","queryId"],"attributes":{"showInputFields":{"type":"boolean","default":true},"inlineInput":{"type":"boolean","default":false}}}'),k=window.wp.blockEditor,x=window.wp.components;var O=r(9307),P=r(2600);function T(e,t){return!(e=>null===e)(r=e)&&r instanceof Object&&r.constructor===Object&&t in e;var r}var C=r(4167),R=r(9127),j=r.n(R);function A(e){const t=(0,O.useRef)(e);return j()(e,t.current)||(t.current=e),t.current}const F=window.wc.wcBlocksData,N=window.wp.data,q=(0,O.createContext)("page"),G=()=>(0,O.useContext)(q),I=(q.Provider,e=>{const t=G();e=e||t;const r=(0,N.useSelect)((t=>t(F.QUERY_STATE_STORE_KEY).getValueForQueryContext(e,void 0)),[e]),{setValueForQueryContext:o}=(0,N.useDispatch)(F.QUERY_STATE_STORE_KEY);return[r,(0,O.useCallback)((t=>{o(e,t)}),[e,o])]}),B=(e,t,r)=>{const o=G();r=r||o;const n=(0,N.useSelect)((o=>o(F.QUERY_STATE_STORE_KEY).getValueForQueryKey(r,e,t)),[r,e]),{setQueryValue:c}=(0,N.useDispatch)(F.QUERY_STATE_STORE_KEY);return[n,(0,O.useCallback)((t=>{c(r,e,t)}),[r,e,c])]},M=({queryAttribute:e,queryPrices:t,queryStock:r,queryRating:o,queryState:n,isEditor:c=!1})=>{let i=G();i=`${i}-collection-data`;const[a]=I(i),[l,s]=B("calculate_attribute_counts",[],i),[u,p]=B("calculate_price_range",null,i),[m,d]=B("calculate_stock_status_counts",null,i),[g,w]=B("calculate_rating_counts",null,i),f=A(e||{}),E=A(t),_=A(r),b=A(o);(0,O.useEffect)((()=>{"object"==typeof f&&Object.keys(f).length&&(l.find((e=>T(f,"taxonomy")&&e.taxonomy===f.taxonomy))||s([...l,f]))}),[f,l,s]),(0,O.useEffect)((()=>{u!==E&&void 0!==E&&p(E)}),[E,p,u]),(0,O.useEffect)((()=>{m!==_&&void 0!==_&&d(_)}),[_,d,m]),(0,O.useEffect)((()=>{g!==b&&void 0!==b&&w(b)}),[b,w,g]);const[y,v]=(0,O.useState)(c),[S]=(0,P.Nr)(y,200);y||v(!0);const h=(0,O.useMemo)((()=>(e=>{const t=e;return Array.isArray(e.calculate_attribute_counts)&&(t.calculate_attribute_counts=(0,C.DY)(e.calculate_attribute_counts.map((({taxonomy:e,queryType:t})=>({taxonomy:e,query_type:t})))).asc(["taxonomy","query_type"])),t})(a)),[a]);return(e=>{const{namespace:t,resourceName:r,resourceValues:o=[],query:n={},shouldSelect:c=!0}=e;if(!t||!r)throw new Error("The options object must have valid values for the namespace and the resource properties.");const i=(0,O.useRef)({results:[],isLoading:!0}),a=A(n),l=A(o),s=(()=>{const[,e]=(0,O.useState)();return(0,O.useCallback)((t=>{e((()=>{throw t}))}),[])})(),u=(0,N.useSelect)((e=>{if(!c)return null;const o=e(F.COLLECTIONS_STORE_KEY),n=[t,r,a,l],i=o.getCollectionError(...n);if(i){if(!(i instanceof Error))throw new Error("TypeError: `error` object is not an instance of Error constructor");s(i)}return{results:o.getCollection(...n),isLoading:!o.hasFinishedResolution("getCollection",n)}}),[t,r,l,a,c]);return null!==u&&(i.current=u),i.current})({namespace:"/wc/store/v1",resourceName:"products/collection-data",query:{...n,page:void 0,per_page:void 0,orderby:void 0,order:void 0,...h},shouldSelect:S})};var U=r(3849),Y=r.n(U);const L=window.wc.priceFormat,Q=e=>"string"==typeof e;function D(e,t){return("number"==typeof e?e:parseInt(e,10))/10**t.minorUnit}const K=({attributes:e})=>{const{inlineInput:t,showInputFields:r}=e,{results:n,isLoading:c}=M({queryPrices:!0,queryState:{},isEditor:!0});if(c)return null;const{minPrice:i,maxPrice:a,formattedMinPrice:l,formattedMaxPrice:s}=function(e){const t=(0,L.getCurrency)({minorUnit:0});if(!T(e,"price_range"))return{minPrice:0,maxPrice:0,minRange:0,maxRange:0,formattedMinPrice:(0,L.formatPrice)(0,t),formattedMaxPrice:(0,L.formatPrice)(0,t)};const r=(0,L.getCurrencyFromPriceResponse)(e.price_range),o=T(e.price_range,"min_price")&&Q(e.price_range.min_price)?D(e.price_range.min_price,r):0,n=T(e.price_range,"max_price")&&Q(e.price_range.max_price)?D(e.price_range.max_price,r):0;return{minPrice:o,maxPrice:n,minRange:o,maxRange:n,formattedMinPrice:(0,L.formatPrice)(o,t),formattedMaxPrice:(0,L.formatPrice)(n,t)}}(n),u=()=>null,p=r?(0,o.createElement)("input",{className:"min",type:"text",value:l,onChange:u}):(0,o.createElement)("span",null,l),m=r?(0,o.createElement)("input",{className:"max",type:"text",value:s,onChange:u}):(0,o.createElement)("span",null,s);return(0,o.createElement)("div",{className:Y()("wp-block-woocommerce-product-filter-price-content",{"wp-block-woocommerce-product-filter-price-content--inline":t&&r})},(0,o.createElement)("div",{className:"wp-block-woocommerce-product-filter-price-content-left-input text"},p),(0,o.createElement)("div",{className:"wp-block-woocommerce-product-filter-price-content-price-range-slider range"},(0,o.createElement)("div",{className:"range-bar"}),(0,o.createElement)("input",{type:"range",className:"min",min:i,max:a,value:i,onChange:u}),(0,o.createElement)("input",{type:"range",className:"max",min:i,max:a,value:a,onChange:u})),(0,o.createElement)("div",{className:"wp-block-woocommerce-product-filter-price-content-right-input text"},m))};var V=r(5736);const J=({attributes:e,setAttributes:t})=>{const{showInputFields:r,inlineInput:n}=e;return(0,o.createElement)(k.InspectorControls,null,(0,o.createElement)(x.PanelBody,{title:(0,V.__)("Settings","woocommerce")},(0,o.createElement)(x.__experimentalToggleGroupControl,{label:(0,V.__)("Price Slider","woocommerce"),value:r?"editable":"text",onChange:e=>t({showInputFields:"editable"===e}),className:"wc-block-price-filter__price-range-toggle"},(0,o.createElement)(x.__experimentalToggleGroupControlOption,{value:"editable",label:(0,V.__)("Editable","woocommerce")}),(0,o.createElement)(x.__experimentalToggleGroupControlOption,{value:"text",label:(0,V.__)("Text","woocommerce")})),r&&(0,o.createElement)(x.ToggleControl,{label:(0,V.__)("Inline input fields","woocommerce"),checked:n,onChange:()=>t({inlineInput:!n}),help:(0,V.__)("Show input fields inline with the slider.","woocommerce")})))};b>2&&(0,n.registerBlockType)(h,{icon:{src:(0,o.createElement)(c.Z,{icon:i.Z,className:"wc-block-editor-components-block-icon"})},edit:e=>{const t=(0,k.useBlockProps)();return(0,o.createElement)("div",{...t},(0,o.createElement)(J,{...e}),(0,o.createElement)(x.Disabled,null,(0,o.createElement)(K,{...e})))}})},1508:()=>{},9196:e=>{"use strict";e.exports=window.React},9307:e=>{"use strict";e.exports=window.wp.element},5736:e=>{"use strict";e.exports=window.wp.i18n},9127:e=>{"use strict";e.exports=window.wp.isShallowEqual},444:e=>{"use strict";e.exports=window.wp.primitives}},r={};function o(e){var n=r[e];if(void 0!==n)return n.exports;var c=r[e]={exports:{}};return t[e].call(c.exports,c,c.exports,o),c.exports}o.m=t,e=[],o.O=(t,r,n,c)=>{if(!r){var i=1/0;for(u=0;u<e.length;u++){for(var[r,n,c]=e[u],a=!0,l=0;l<r.length;l++)(!1&c||i>=c)&&Object.keys(o.O).every((e=>o.O[e](r[l])))?r.splice(l--,1):(a=!1,c<i&&(i=c));if(a){e.splice(u--,1);var s=n();void 0!==s&&(t=s)}}return t}c=c||0;for(var u=e.length;u>0&&e[u-1][2]>c;u--)e[u]=e[u-1];e[u]=[r,n,c]},o.n=e=>{var t=e&&e.__esModule?()=>e.default:()=>e;return o.d(t,{a:t}),t},o.d=(e,t)=>{for(var r in t)o.o(t,r)&&!o.o(e,r)&&Object.defineProperty(e,r,{enumerable:!0,get:t[r]})},o.o=(e,t)=>Object.prototype.hasOwnProperty.call(e,t),o.r=e=>{"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},o.j=4555,(()=>{var e={4555:0};o.O.j=t=>0===e[t];var t=(t,r)=>{var n,c,[i,a,l]=r,s=0;if(i.some((t=>0!==e[t]))){for(n in a)o.o(a,n)&&(o.m[n]=a[n]);if(l)var u=l(o)}for(t&&t(r);s<i.length;s++)c=i[s],o.o(e,c)&&e[c]&&e[c][0](),e[c]=0;return o.O(u)},r=self.webpackChunkwebpackWcBlocksJsonp=self.webpackChunkwebpackWcBlocksJsonp||[];r.forEach(t.bind(null,0)),r.push=t.bind(null,r.push.bind(r))})();var n=o.O(void 0,[2869],(()=>o(7750)));n=o.O(n),((this.wc=this.wc||{}).blocks=this.wc.blocks||{})["product-filter-price"]=n})();