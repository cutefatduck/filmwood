import{p as i,N as v,O as P}from"./app-1d827472.js";function b(){const l=i({}),u=i({title:"",content:"",category_id:"",thumbnail:""}),c=v(),a=i({}),o=i(!1),n=P("$swal"),d=async(t=1,s="",e="",r="",f="",h="",m="created_at",g="desc")=>{axios.get("/api/posts?page="+t+"&search_category="+s+"&search_id="+e+"&search_title="+r+"&search_content="+f+"&search_global="+h+"&order_column="+m+"&order_direction="+g).then(p=>{console.log(p.data),l.value=p.data})};return{posts:l,post:u,getPosts:d,getPost:async t=>{axios.get("/api/posts/"+t).then(s=>{u.value=s.data.data})},storePost:async t=>{if(o.value)return;o.value=!0,a.value={};let s=new FormData;for(let e in t)t.hasOwnProperty(e)&&s.append(e,t[e]);axios.post("/api/posts",s,{headers:{"content-type":"multipart/form-data"}}).then(e=>{c.push({name:"posts.index"}),n({icon:"success",title:"Post saved successfully"})}).catch(e=>{var r;(r=e.response)!=null&&r.data&&(a.value=e.response.data.errors)}).finally(()=>o.value=!1)},updatePost:async t=>{o.value||(o.value=!0,a.value={},console.log(t),axios.put("/api/posts/"+t.id,t).then(s=>{c.push({name:"posts.index"}),n({icon:"success",title:"Post updated successfully"})}).catch(s=>{var e;(e=s.response)!=null&&e.data&&(a.value=s.response.data.errors)}).finally(()=>o.value=!1))},deletePost:async t=>{n({title:"Are you sure?",text:"You won't be able to revert this action!",icon:"warning",showCancelButton:!0,confirmButtonText:"Yes, delete it!",confirmButtonColor:"#ef4444",timer:2e4,timerProgressBar:!0,reverseButtons:!0}).then(s=>{s.isConfirmed&&axios.delete("/api/posts/"+t).then(e=>{d(),c.push({name:"posts.index"}),n({icon:"success",title:"Post deleted successfully"})}).catch(e=>{n({icon:"error",title:"Something went wrong"})})})},validationErrors:a,isLoading:o}}export{b as u};