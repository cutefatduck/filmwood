import{p as v,N as M,O as U,an as w,i as B,K as D,M as N,o as i,c as l,e,I as R,E as h,L as S,t as f,q as o,F as q,f as F,G as T}from"./app-1d827472.js";import{d as V,u as j,a as k,r as G,m as I}from"./rules-1dfda01e.js";function K(){const _=v({name:"",email:""});M();const r=v({}),n=v(!1),d=U("$swal");return{profile:_,getProfile:async()=>{_.value=w.getters["auth/user"]},updateProfile:async c=>{n.value||(n.value=!0,r.value={},axios.put("/api/user",c).then(({data:s})=>{s.success&&(w.commit("auth/SET_USER",s.data),d({icon:"success",title:"Profile updated successfully"}))}).catch(s=>{var u;(u=s.response)!=null&&u.data&&(r.value=s.response.data.errors)}).finally(()=>n.value=!1))},validationErrors:r,isLoading:n}}const O={class:"card border-0"},$=e("div",{class:"card-header bg-transparent"},[e("h5",{class:"float-start"},"Profile")],-1),z={class:"card-body"},A={class:"mb-3"},C=e("label",{for:"name",class:"form-label"},"Name",-1),H={class:"text-danger mt-1"},J={class:"text-danger mt-1"},Q={class:"mb-3"},W=e("label",{for:"email",class:"form-label"},"Email",-1),X={class:"text-danger mt-1"},Y={class:"text-danger mt-1"},Z={class:"mb-3"},ee=["disabled"],se={class:""},ae={key:0},te={key:1},oe={__name:"index",setup(_){V("required",G),V("min",I);const r={name:"required|min:3",email:"required"},{validate:n,errors:d}=j({validationSchema:r}),{value:b}=k("name",null,{initialValue:""}),{value:g}=k("email",null,{initialValue:""}),{profile:c,getProfile:s,updateProfile:u,validationErrors:y,isLoading:p}=K(),a=B({name:b,email:g});function L(){n().then(x=>{x.valid&&u(a)})}return D(()=>{s()}),N(()=>{a.name=c.value.name,a.email=c.value.email}),(x,m)=>{var P,E;return i(),l("div",O,[$,e("div",z,[e("form",{onSubmit:R(L,["prevent"])},[e("div",A,[C,h(e("input",{type:"text","onUpdate:modelValue":m[0]||(m[0]=t=>a.name=t),class:"form-control",id:"name"},null,512),[[S,a.name]]),e("div",H,f(o(d).name),1),e("div",J,[(i(!0),l(q,null,F((P=o(y))==null?void 0:P.name,t=>(i(),l("div",null,f(t),1))),256))])]),e("div",Q,[W,h(e("input",{type:"email","onUpdate:modelValue":m[1]||(m[1]=t=>a.email=t),class:"form-control",id:"email"},null,512),[[S,a.email]]),e("div",X,f(o(d).email),1),e("div",Y,[(i(!0),l(q,null,F((E=o(y))==null?void 0:E.email,t=>(i(),l("div",null,f(t),1))),256))])]),e("div",Z,[e("button",{disabled:o(p),class:"btn btn-primary"},[h(e("div",se,null,512),[[T,o(p)]]),o(p)?(i(),l("span",ae,"Processing...")):(i(),l("span",te,"Update"))],8,ee)])],32)])])}}};export{oe as default};
