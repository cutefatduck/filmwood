import{p,A as k,K as x,ak as h,d as M,o as s,c as t,e,t as l,v as g,F as b,f as v,b as C,h as N,w as V}from"./app-1d827472.js";const w={class:"container"},B={class:"row g-5 mt-4"},L={class:"col-md-8"},T={class:"pb-4 mb-4 fst-italic border-bottom"},D={class:"blog-post-meta"},E={href:"#"},F={class:"blog-post"},H=["src"],P=["innerHTML"],S=e("nav",{class:"blog-pagination","aria-label":"Pagination"},[e("a",{class:"btn btn-outline-primary rounded-pill",href:"#"},"Más antigua"),e("a",{class:"btn btn-outline-secondary rounded-pill disabled"},"Más nueva")],-1),z={class:"col-md-4"},A={class:"position-sticky",style:{top:"2rem"}},K=e("div",{class:"p-4 mb-3 bg-light rounded"},[e("h4",{class:"fst-italic"},"Sobre"),e("p",{class:"mb-0"},"Personaliza esta sección para dar más información sobre la publicación, escritores, contenido o algo completamente diferente. Depende totalmente de ti.")],-1),R={class:"p-4"},j=e("h4",{class:"fst-italic"},"Categorias",-1),q={key:0,class:"list-unstyled"},O={__name:"details",setup(G){const a=p(),i=p(),f=k();return x(()=>{h.get("/api/get-post/"+f.params.id).then(({data:n})=>{a.value=n}),h.get("/api/category-list").then(({data:n})=>{i.value=n.data})}),(n,I)=>{var c,r,d,_,u,m;const y=M("router-link");return s(),t("div",w,[e("div",B,[e("div",L,[e("h3",T,l((c=a.value)==null?void 0:c.title),1),e("p",D,[g("1 de Enero de 2024 by "),e("a",E,l((d=(r=a.value)==null?void 0:r.user)==null?void 0:d.name),1)]),e("article",F,[(s(!0),t(b,null,v((_=a.value)==null?void 0:_.media,o=>(s(),t("div",null,[e("img",{src:o.original_url,alt:"image",class:"img-fluid"},null,8,H)]))),256)),e("div",{class:"mt-4",innerHTML:(u=a.value)==null?void 0:u.content},null,8,P)]),S]),e("div",z,[e("div",A,[K,e("div",R,[j,((m=i.value)==null?void 0:m.length)>0?(s(),t("ol",q,[(s(!0),t(b,null,v(i.value,o=>(s(),t("li",{key:o.id},[N(y,{to:{name:"category-posts.index",params:{id:o.id}}},{default:V(()=>[g(l(o.name),1)]),_:2},1032,["to"])]))),128))])):C("",!0)])])])])])}}};export{O as default};
