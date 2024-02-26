import{B as Y,s as U,m as h,o as i,c as r,a as _,n as g,r as R,b,t as x,d as B,e as t,F as P,f as L,g as Z,h as w,i as V,j as T,k as j,u as ee,l as te,p as E,w as $,q as S,v as ie,x as q,y as H,z as W,A as F,C as ae,D as z,E as ne,G as se,T as oe,S as le}from"./app-1d827472.js";import{s as ue}from"./index.esm-f1ecf030.js";import{_ as G}from"./_plugin-vue_export-helper-c27b6911.js";var re={root:"p-breadcrumb p-component",menu:"p-breadcrumb-list",home:"p-breadcrumb-home",separator:"p-menuitem-separator",menuitem:function(o){var a=o.instance;return["p-menuitem",{"p-disabled":a.disabled()}]},action:"p-menuitem-link",icon:"p-menuitem-icon",label:"p-menuitem-text"},ce=Y.extend({name:"breadcrumb",classes:re}),me={name:"BaseBreadcrumb",extends:U,props:{model:{type:Array,default:null},home:{type:null,default:null}},style:ce,provide:function(){return{$parentInstance:this}}},J={name:"BreadcrumbItem",hostName:"Breadcrumb",extends:U,props:{item:null,templates:null,index:null},methods:{onClick:function(o){this.item.command&&this.item.command({originalEvent:o,item:this.item})},visible:function(){return typeof this.item.visible=="function"?this.item.visible():this.item.visible!==!1},disabled:function(){return typeof this.item.disabled=="function"?this.item.disabled():this.item.disabled},label:function(){return typeof this.item.label=="function"?this.item.label():this.item.label},isCurrentUrl:function(){var o=this.item,a=o.to,p=o.url,l=typeof window<"u"?window.location.pathname:"";return a===l||p===l?"page":void 0}},computed:{ptmOptions:function(){return{context:{item:this.item,index:this.index}}},getMenuItemProps:function(){var o=this;return{action:h({class:this.cx("action"),"aria-current":this.isCurrentUrl(),onClick:function(p){return o.onClick(p)}},this.ptm("action",this.ptmOptions)),icon:h({class:[this.cx("icon"),this.item.icon]},this.ptm("icon",this.ptmOptions)),label:h({class:this.cx("label")},this.ptm("label",this.ptmOptions))}}}},de=["href","target","aria-current"];function pe(e,o,a,p,l,n){return n.visible()?(i(),r("li",h({key:0,class:[e.cx("menuitem"),a.item.class]},e.ptm("menuitem",n.ptmOptions)),[a.templates.item?(i(),_(R(a.templates.item),{key:1,item:a.item,label:n.label(),props:n.getMenuItemProps},null,8,["item","label","props"])):(i(),r("a",h({key:0,href:a.item.url||"#",class:e.cx("action"),target:a.item.target,"aria-current":n.isCurrentUrl(),onClick:o[0]||(o[0]=function(){return n.onClick&&n.onClick.apply(n,arguments)})},e.ptm("action",n.ptmOptions)),[a.templates&&a.templates.itemicon?(i(),_(R(a.templates.itemicon),{key:0,item:a.item,class:g(e.cx("icon",n.ptmOptions))},null,8,["item","class"])):a.item.icon?(i(),r("span",h({key:1,class:[e.cx("icon"),a.item.icon]},e.ptm("icon",n.ptmOptions)),null,16)):b("",!0),a.item.label?(i(),r("span",h({key:2,class:e.cx("label")},e.ptm("label",n.ptmOptions)),x(n.label()),17)):b("",!0)],16,de))],16)):b("",!0)}J.render=pe;var Q={name:"Breadcrumb",extends:me,inheritAttrs:!1,components:{BreadcrumbItem:J,ChevronRightIcon:ue}};function ve(e,o,a,p,l,n){var m=B("BreadcrumbItem"),c=B("ChevronRightIcon");return i(),r("nav",h({class:e.cx("root")},e.ptmi("root")),[t("ol",h({class:e.cx("menu")},e.ptm("menu")),[e.home?(i(),_(m,h({key:0,item:e.home,class:e.cx("home"),templates:e.$slots,pt:e.pt,unstyled:e.unstyled},e.ptm("home")),null,16,["item","class","templates","pt","unstyled"])):b("",!0),(i(!0),r(P,null,L(e.model,function(y,v){return i(),r(P,{key:y.label+"_"+v},[e.home||v!==0?(i(),r("li",h({key:0,class:e.cx("separator")},e.ptm("separator")),[Z(e.$slots,"separator",{},function(){return[w(c,h({"aria-hidden":"true"},e.ptm("separatorIcon")),null,16)]})],16)):b("",!0),w(m,{item:y,index:v,templates:e.$slots,pt:e.pt,unstyled:e.unstyled},null,8,["item","index","templates","pt","unstyled"])],64)}),128))],16)],16)}Q.render=ve;const I=V({ripple:!1,darkTheme:!1,inputStyle:"outlined",menuMode:"static",theme:"lara-light-indigo",scale:14,activeMenuItem:null}),C=V({staticMenuDesktopInactive:!1,overlayMenuActive:!1,profileSidebarVisible:!1,configSidebarVisible:!1,staticMenuMobileActive:!1,menuHoverActive:!1});function N(){const e=(m,c)=>{I.darkTheme=c,I.theme=m},o=m=>{I.scale=m},a=m=>{I.activeMenuItem=m.value||m},p=()=>{I.menuMode==="overlay"&&(C.overlayMenuActive=!C.overlayMenuActive),window.innerWidth>991?C.staticMenuDesktopInactive=!C.staticMenuDesktopInactive:C.staticMenuMobileActive=!C.staticMenuMobileActive},l=T(()=>C.overlayMenuActive||C.staticMenuMobileActive),n=T(()=>I.darkTheme);return{layoutConfig:j(I),layoutState:j(C),changeThemeSettings:e,setScale:o,onMenuToggle:p,isSidebarActive:l,isDarkTheme:n,setActiveMenuItem:a}}const O=e=>(q("data-v-5616f71a"),e=e(),H(),e),be={class:"layout-topbar"},he=O(()=>t("img",{src:"/images/logo.svg",alt:"logo"},null,-1)),fe=O(()=>t("span",null,null,-1)),ye=O(()=>t("i",{class:"pi pi-bars"},null,-1)),ke=[ye],ge=O(()=>t("i",{class:"pi pi-ellipsis-v"},null,-1)),_e=[ge],Me={class:"p-link layout-topbar-button layout-topbar-button-c nav-item dropdown",role:"button","data-bs-toggle":"dropdown"},Ce=O(()=>t("i",{class:"pi pi-user"},null,-1)),we={class:"dropdown-menu dropdown-menu-end border-0 shadow-sm"},Ae=O(()=>t("li",null,[t("a",{class:"dropdown-item",href:"#"},"Preferencias")],-1)),Ie=O(()=>t("li",null,[t("hr",{class:"dropdown-divider"})],-1)),Se=["disabled"],xe={class:"nav-link dropdown-toggle ms-3 me-2",href:"#",role:"button","data-bs-toggle":"dropdown","aria-expanded":"false"},$e={__name:"AppTopbar",setup(e){const{onMenuToggle:o}=N(),a=ee(),p=T(()=>a.state.auth.user),{processing:l,logout:n}=te(),m=E(!1),c=()=>{m.value=!m.value},y=T(()=>({"layout-topbar-menu-mobile-active":m.value}));return(v,k)=>{const D=B("router-link");return i(),r("div",be,[w(D,{to:"/",class:"layout-topbar-logo"},{default:$(()=>[he,fe]),_:1}),t("button",{class:"p-link layout-menu-button layout-topbar-button",onClick:k[0]||(k[0]=s=>S(o)())},ke),t("button",{class:"p-link layout-topbar-menu-button layout-topbar-button",onClick:k[1]||(k[1]=s=>c())},_e),t("div",{class:g(["layout-topbar-menu",y.value])},[t("button",Me,[Ce,t("ul",we,[t("li",null,[w(D,{to:{name:"profile.index"},class:"dropdown-item"},{default:$(()=>[ie("Perfil")]),_:1},8,["to"])]),Ae,Ie,t("li",null,[t("a",{class:g(["dropdown-item",{"opacity-25":S(l)}]),disabled:S(l),href:"javascript:void(0)",onClick:k[2]||(k[2]=(...s)=>S(n)&&S(n)(...s))},"Cerrar sessión",10,Se)])]),t("span",xe," Hola, "+x(p.value.name),1)])],2)])}}},Be=G($e,[["__scopeId","data-v-5616f71a"]]),Te={class:"layout-footer"},Oe=t("span",{class:"font-medium ml-2"},"Ejemplo DAW2",-1),De=[Oe],Ee={__name:"AppFooter",setup(e){const{layoutConfig:o}=N();return T(()=>`layout/images/${o.darkTheme.value?"logo-white":"logo-dark"}.svg`),(a,p)=>(i(),r("div",Te,De))}},Pe={key:0},Ke={key:0,class:"layout-menuitem-root-text"},Ne=["href","target"],Le={class:"layout-menuitem-text"},Re={key:0,class:"pi pi-fw pi-angle-down layout-submenu-toggler"},je={class:"layout-menuitem-text"},Ue={key:0,class:"pi pi-fw pi-angle-down layout-submenu-toggler"},Ve={class:"layout-submenu"},qe={__name:"AppMenuItem",props:{item:{type:Object,default:()=>({})},index:{type:Number,default:0},root:{type:Boolean,default:!0},parentItemKey:{type:String,default:null}},setup(e){const{can:o}=W(),a=F(),{layoutConfig:p,layoutState:l,setActiveMenuItem:n,onMenuToggle:m}=N(),c=e,y=E(!1),v=E(null);ae(()=>{v.value=c.parentItemKey?c.parentItemKey+"-"+c.index:String(c.index);const s=l.activeMenuItem;y.value=s===v.value||s?s.startsWith(v.value+"-"):!1}),z(()=>p.activeMenuItem.value,s=>{y.value=s===v.value||s.startsWith(v.value+"-")});const k=(s,d)=>{if(d.disabled){s.preventDefault();return}const{overlayMenuActive:f,staticMenuMobileActive:M}=l;(d.to||d.url)&&(M.value||f.value)&&m(),d.command&&d.command({originalEvent:s,item:d});const u=d.items?y.value?c.parentItemKey:v:v.value;n(u)},D=s=>a.path===s.to;return(s,d)=>{const f=B("router-link"),M=B("app-menu-item",!0);return e.root||e.item.permision==="all"||S(o)(e.item.permision)?(i(),r("div",Pe,[t("li",{class:g({"layout-root-menuitem":e.root,"active-menuitem":y.value})},[e.root&&e.item.visible!==!1?(i(),r("div",Ke,x(e.item.label),1)):b("",!0),(!e.item.to||e.item.items)&&e.item.visible!==!1?(i(),r("a",{key:1,href:e.item.url,onClick:d[0]||(d[0]=u=>k(u,e.item,e.index)),class:g(e.item.class),target:e.item.target,tabindex:"0"},[t("i",{class:g([e.item.icon,"layout-menuitem-icon"])},null,2),t("span",Le,x(e.item.label),1),e.item.items?(i(),r("i",Re)):b("",!0)],10,Ne)):b("",!0),e.item.to&&!e.item.items&&e.item.visible!==!1?(i(),_(f,{key:2,onClick:d[1]||(d[1]=u=>k(u,e.item,e.index)),class:g([e.item.class,{"active-route":D(e.item)}]),tabindex:"0",to:e.item.to},{default:$(()=>[t("i",{class:g([e.item.icon,"layout-menuitem-icon"])},null,2),t("span",je,x(e.item.label),1),e.item.items?(i(),r("i",Ue)):b("",!0)]),_:1},8,["class","to"])):b("",!0),e.item.items&&e.item.visible!==!1?(i(),_(oe,{key:3,name:"layout-submenu"},{default:$(()=>[ne(t("ul",Ve,[(i(!0),r(P,null,L(e.item.items,(u,A)=>(i(),_(M,{key:u,index:A,item:u,parentItemKey:v.value,root:!1},null,8,["index","item","parentItemKey"]))),128))],512),[[se,e.root?!0:y.value]])]),_:1})):b("",!0)],2)])):b("",!0)}}},He={class:"layout-menu"},We={key:1,class:"menu-separator"},Fe={__name:"AppMenu",setup(e){W();const o=E([{label:"Home",items:[{label:"Dashboard",icon:"pi pi-fw pi-home",to:"/admin",permision:"all"}]},{label:"Usuarios",items:[{label:"Users",icon:"pi pi-fw pi-id-card",to:"/admin/users",permision:"user-list"},{label:"Roles",icon:"pi pi-fw pi-check-square",to:"/admin/roles",permision:"role-list"},{label:"Permisos",icon:"pi pi-fw pi-bookmark",to:"/admin/permissions",permision:"permission-list"}]},{label:"Ejercicios",items:[{label:"Ejercicios",icon:"pi pi-fw pi-id-card",to:"/admin/exercises",permision:"exercise-list"},{label:"Categorias",icon:"pi pi-fw pi-id-card",to:"/admin/categories",permision:"category-list"}]},{label:"Posts",items:[{label:"Posts",icon:"pi pi-fw pi-id-card",to:"/admin/posts",permision:"post-list"}]}]);return(a,p)=>(i(),r("ul",He,[(i(!0),r(P,null,L(o.value,(l,n)=>(i(),r(P,{key:l},[l.separator?b("",!0):(i(),_(qe,{key:0,item:l,index:n},null,8,["item","index"])),l.separator?(i(),r("li",We)):b("",!0)],64))),128))]))}},ze={__name:"AppSidebar",setup(e){return(o,a)=>(i(),_(Fe))}};const Ge=e=>(q("data-v-c3af34bd"),e=e(),H(),e),Je={class:"layout-sidebar"},Qe={class:"layout-main-container"},Xe=["href","onClick"],Ye={class:"text-primary font-semibold"},Ze=["href","target"],et={class:"text-color"},tt={class:"layout-main"},it=Ge(()=>t("div",{class:"layout-mask"},null,-1)),at={__name:"Authenticated",setup(e){const o=F(),a=E({icon:"pi pi-home",route:"/admin"}),p=T(()=>{let s=o.path.split("/");return s.shift(),s.reduce((f,M,u)=>{var A,K;return f.push({route:f[u-1]?""+f[u-1].route+"/"+M:"/"+M,label:((A=o.matched[u])==null?void 0:A.meta.breadCrumb)||M,disabled:u+1===s.length||((K=o.matched[u])==null?void 0:K.meta.linked)===!1}),f},[])}),{layoutConfig:l,layoutState:n,isSidebarActive:m}=N(),c=E(null);z(m,s=>{s?v():k()});const y=T(()=>({"layout-theme-light":l.darkTheme.value==="light","layout-theme-dark":l.darkTheme.value==="dark","layout-overlay":l.menuMode.value==="overlay","layout-static":l.menuMode.value==="static","layout-static-inactive":n.staticMenuDesktopInactive.value&&l.menuMode.value==="static","layout-overlay-active":n.overlayMenuActive.value,"layout-mobile-active":n.staticMenuMobileActive.value,"p-input-filled":l.inputStyle.value==="filled","p-ripple-disabled":!l.ripple.value})),v=()=>{c.value||(c.value=s=>{D(s)&&(n.overlayMenuActive.value=!1,n.staticMenuMobileActive.value=!1,n.menuHoverActive.value=!1)},document.addEventListener("click",c.value))},k=()=>{c.value&&(document.removeEventListener("click",c),c.value=null)},D=s=>{const d=document.querySelector(".layout-sidebar"),f=document.querySelector(".layout-menu-button");return!(d.isSameNode(s.target)||d.contains(s.target)||f.isSameNode(s.target)||f.contains(s.target))};return(s,d)=>{const f=B("router-link"),M=B("router-view");return i(),r("div",{class:g(["layout-wrapper",y.value])},[w(Be),t("div",Je,[w(ze)]),t("div",Qe,[w(S(Q),{home:a.value,model:p.value,class:"mb-2"},{item:$(({item:u,props:A})=>[u.route?(i(),_(f,{key:0,to:u.route,custom:""},{default:$(({href:K,navigate:X})=>[t("a",h({href:K},A.action,{class:"btn btn-link",onClick:X}),[t("span",{class:g([u.icon,"text-color"])},null,2),t("span",Ye,x(u.label),1)],16,Xe)]),_:2},1032,["to"])):(i(),r("a",h({key:1,href:u.url,target:u.target},A.action),[t("span",et,x(u.label),1)],16,Ze))]),_:1},8,["home","model"]),t("div",tt,[(i(),_(le,null,{default:$(()=>[w(M)]),_:1}))]),w(Ee)]),it],2)}}},lt=G(at,[["__scopeId","data-v-c3af34bd"]]);export{lt as default};
