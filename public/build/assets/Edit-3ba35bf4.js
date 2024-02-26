import{i as P,A as j,K as A,M as C,d as G,o as a,c as l,e,I,E as c,L as f,t as n,q as o,F as u,f as _,h as K,G as T}from"./app-1d827472.js";import{u as z}from"./roles-0a24af2f.js";import{u as H}from"./users-fe298258.js";import{d as V,u as J,a as v,r as O,m as Q}from"./rules-1dfda01e.js";const W={class:"row justify-content-center my-5"},X={class:"col-md-10"},Y={class:"card border-0 shadow-sm"},Z={class:"card-body"},$={class:"mb-3"},ee=e("label",{for:"user-title",class:"form-label"},"Name",-1),se={class:"text-danger mt-1"},te={class:"text-danger mt-1"},oe={class:"mb-3"},ae=e("label",{for:"email",class:"form-label"},"Email",-1),le={class:"text-danger mt-1"},ie={class:"text-danger mt-1"},ne={class:"mb-3"},re=e("label",{for:"password",class:"form-label"},"Password",-1),de={class:"text-danger mt-1"},me={class:"text-danger mt-1"},ce={class:"mb-3"},ue=e("label",{for:"user-category",class:"form-label"}," Role ",-1),_e={class:"text-danger mt-1"},ve={class:"text-danger mt-1"},pe={class:"mt-4"},fe=["disabled"],he={class:""},be={key:0},we={key:1},Fe={__name:"Edit",setup(ge){const{roleList:y,getRoleList:U}=z(),{updateUser:E,getUser:F,user:r,validationErrors:d,isLoading:p}=H();V("required",O),V("min",Q);const q={name:"required",email:"required",password:"min:8"},{validate:L,errors:m,resetForm:xe}=J({validationSchema:q}),{value:R}=v("name",null,{initialValue:""}),{value:S}=v("email",null,{initialValue:""}),{value:k}=v("password",null,{initialValue:""}),{value:M}=v("role_id",null,{initialValue:"",label:"role"}),t=P({name:R,email:S,password:k,role_id:M}),B=j();function D(){L().then(h=>{h.valid&&E(t)})}return A(()=>{F(B.params.id),U()}),C(()=>{t.id=r.value.id,t.name=r.value.name,t.email=r.value.email,t.role_id=r.value.role_id}),(h,i)=>{var b,w,g,x;const N=G("v-select");return a(),l("div",W,[e("div",X,[e("div",Y,[e("div",Z,[e("form",{onSubmit:I(D,["prevent"])},[e("div",$,[ee,c(e("input",{"onUpdate:modelValue":i[0]||(i[0]=s=>t.name=s),id:"user-title",type:"text",class:"form-control"},null,512),[[f,t.name]]),e("div",se,n(o(m).name),1),e("div",te,[(a(!0),l(u,null,_((b=o(d))==null?void 0:b.name,s=>(a(),l("div",null,n(s),1))),256))])]),e("div",oe,[ae,c(e("input",{"onUpdate:modelValue":i[1]||(i[1]=s=>t.email=s),id:"email",type:"email",class:"form-control"},null,512),[[f,t.email]]),e("div",le,n(o(m).email),1),e("div",ie,[(a(!0),l(u,null,_((w=o(d))==null?void 0:w.email,s=>(a(),l("div",null,n(s),1))),256))])]),e("div",ne,[re,c(e("input",{"onUpdate:modelValue":i[2]||(i[2]=s=>t.password=s),id:"password",type:"password",class:"form-control"},null,512),[[f,t.password]]),e("div",de,n(o(m).password),1),e("div",me,[(a(!0),l(u,null,_((g=o(d))==null?void 0:g.password,s=>(a(),l("div",null,n(s),1))),256))])]),e("div",ce,[ue,K(N,{multiple:"",modelValue:t.role_id,"onUpdate:modelValue":i[3]||(i[3]=s=>t.role_id=s),options:o(y),reduce:s=>s.id,label:"name",class:"form-control"},null,8,["modelValue","options","reduce"]),e("div",_e,n(o(m).role_id),1),e("div",ve,[(a(!0),l(u,null,_((x=o(d))==null?void 0:x.role_id,s=>(a(),l("div",null,n(s),1))),256))])]),e("div",pe,[e("button",{disabled:o(p),class:"btn btn-primary"},[c(e("div",he,null,512),[[T,o(p)]]),o(p)?(a(),l("span",be,"Processing...")):(a(),l("span",we,"Save"))],8,fe)])],32)])])])])}}};export{Fe as default};
