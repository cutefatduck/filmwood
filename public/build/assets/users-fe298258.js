import{p as i,N as v,O as m}from"./app-1d827472.js";function _(){const c=i([]),l=i({name:""}),u=v(),a=i({}),r=i(!1),n=m("$swal"),d=async(s=1,t="",e="",o="",p="created_at",f="desc")=>{axios.get("/api/users?page="+s+"&search_id="+t+"&search_title="+e+"&search_global="+o+"&order_column="+p+"&order_direction="+f).then(h=>{c.value=h.data})};return{users:c,user:l,getUsers:d,getUser:async s=>{axios.get("/api/users/"+s).then(t=>{l.value=t.data.data})},storeUser:async s=>{if(r.value)return;r.value=!0,a.value={};let t=new FormData;for(let e in s)s.hasOwnProperty(e)&&t.append(e,s[e]);axios.post("/api/users",t).then(e=>{u.push({name:"users.index"}),n({icon:"success",title:"User saved successfully"})}).catch(e=>{var o;(o=e.response)!=null&&o.data&&(a.value=e.response.data.errors)}).finally(()=>r.value=!1)},updateUser:async s=>{r.value||(r.value=!0,a.value={},axios.put("/api/users/"+s.id,s).then(t=>{u.push({name:"users.index"}),n({icon:"success",title:"User updated successfully"})}).catch(t=>{var e;(e=t.response)!=null&&e.data&&(a.value=t.response.data.errors)}).finally(()=>r.value=!1))},deleteUser:async s=>{n({title:"Are you sure?",text:"You won't be able to revert this action!",icon:"warning",showCancelButton:!0,confirmButtonText:"Yes, delete it!",confirmButtonColor:"#ef4444",timer:2e4,timerProgressBar:!0,reverseButtons:!0}).then(t=>{t.isConfirmed&&axios.delete("/api/users/"+s).then(e=>{d(),u.push({name:"users.index"}),n({icon:"success",title:"User deleted successfully"})}).catch(e=>{n({icon:"error",title:"Something went wrong"})})})},validationErrors:a,isLoading:r}}export{_ as u};