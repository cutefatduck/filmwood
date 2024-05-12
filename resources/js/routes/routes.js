import Cookies from 'js-cookie'
import store from "../store";

const AuthenticatedLayout = () => import('../layouts/Authenticated.vue')
const GuestLayout = ()  => import('../layouts/Guest.vue');

const MediaIndex = () => import('../views/admin/media/Index.vue')
const MediaShows = () => import('../views/media/MediaShows.vue')
const MediaCreate = () => import('../views/admin/media/Create.vue')
const MediaEdit = () => import('../views/admin/media/Edit.vue')
const MediaAdminView = () => import('../views/admin/media/View.vue')
const MediaView = () => import('../views/media/View.vue')
const PerfilView = () => import('../views/users/View.vue')
const SavedUser = () => import('../views/users/Saved.vue')

function requireLogin(to, from, next) {
    let isLogin = false;
    isLogin = !!store.state.auth.authenticated;

    if (isLogin) {
        next()
    } else {
        next('/login')
    }
}

function guest(to, from, next) {
    let isLogin;
    isLogin = !!store.state.auth.authenticated;

    if (isLogin) {
        next('/')
    } else {
        next()
    }
}

export default [
    {
        path: '/',
        // redirect: { name: 'login' },
        component: GuestLayout,
        children: [
           
            {
                path: '/',
                name: 'home',
                component: () => import('../views/home/index.vue'),
            },
            {
                path: 'user/perfil',
                name: 'perfil.view',
                component: PerfilView,
            },
            {
                path: 'user/saved',
                name: 'saved.view',
                component: SavedUser,
            },
            {
                path: 'media/peliculas',
                name: 'media.peliculas',
                component: MediaShows,
            },
            {
                path: 'media/series',
                name: 'media.series',
                component: MediaShows,
            },
            
            {
                path: '/view/:id',
                name: 'media.view',
                meta: { breadCrumb: 'Ver el media show', linked: false },
                component: MediaView,
            },
            {
                path: 'login',
                name: 'auth.login',
                component: () => import('../views/login/Login.vue'),
                beforeEnter: guest,
            },
            {
                path: 'register',
                name: 'auth.register',
                component: () => import('../views/register/register.vue'),
                beforeEnter: guest,
            },
            {
                path: 'forgot-password',
                name: 'auth.forgot-password',
                component: () => import('../views/auth/passwords/Email.vue'),
                beforeEnter: guest,
            },
            {
                path: 'reset-password/:token',
                name: 'auth.reset-password',
                component: () => import('../views/auth/passwords/Reset.vue'),
                beforeEnter: guest,
            },
        ]
    },
    {
        path: '/admin',
        component: AuthenticatedLayout,
        // redirect: {
        //     name: 'admin.index'
        // },
        beforeEnter: requireLogin,
        meta: { breadCrumb: 'Panel' },
        children: [
            {
                name: 'admin.index',
                path: '',
                component: () => import('../views/admin/media/Index.vue'),
                meta: { breadCrumb: 'Admin' }
            },
            {
                name: 'profile.index',
                path: 'profile',
                component: () => import('../views/admin/profile/index.vue'),
                meta: { breadCrumb: 'Profile' }
            },
            {
                name: 'media',
                path: 'media',
                meta: { breadCrumb: 'Media'},
                children: [
                    {
                        name: 'media.index',
                        path: '',
                        component: MediaIndex,
                        meta: { breadCrumb: 'View' },
                        beforeEnter: requireLogin
                    },

                    {
                        path: 'view/:id',
                        name: 'admin.media.view',
                        meta: { breadCrumb: 'Ver el media show', linked: false },
                        component: MediaAdminView
                    },
        
                    {
                        name: 'media.create',
                        path: 'create', 
                        component: MediaCreate,
                        meta: { breadCrumb: 'Creando un nuevo media show', linked: false },
                        beforeEnter: requireLogin
                    },
                    
                    {
                        path: 'edit/:id',
                        name: 'admin.media.edit',
                        meta: { breadCrumb: 'Editando un media show', linked: false },
                        component: MediaEdit,
                        beforeEnter: requireLogin
                    }
                ]
            },
            {
                name: 'permissions',
                path: 'permissions',
                meta: { breadCrumb: 'Permisos'},
                children: [
                    {
                        name: 'permissions.index',
                        path: '',
                        component: () => import('../views/admin/permissions/Index.vue'),
                        meta: { breadCrumb: 'Permissions' }
                    },
                    {
                        name: 'permissions.create',
                        path: 'create',
                        component: () => import('../views/admin/permissions/Create.vue'),
                        meta: { 
                            breadCrumb: 'Create Permission',
                            linked: false,  
                        }
                    },
                    {
                        name: 'permissions.edit',
                        path: 'edit/:id',
                        component: () => import('../views/admin/permissions/Edit.vue'),
                        meta: { 
                            breadCrumb: 'Permission Edit',
                            linked: false,
                        }
                    }
                ]
            },

            //TODO Organizar rutas
            {
                name: 'roles.index',
                path: 'roles',
                component: () => import('../views/admin/roles/Index.vue'),
                meta: { breadCrumb: 'Roles' }
            },
            {
                name: 'roles.create',
                path: 'roles/create',
                component: () => import('../views/admin/roles/Create.vue'),
                meta: { breadCrumb: 'Create Role' }
            },
            {
                name: 'roles.edit',
                path: 'roles/edit/:id',
                component: () => import('../views/admin/roles/Edit.vue'),
                meta: { breadCrumb: 'Role Edit' }
            },
            {
                name: 'users.index',
                path: 'users',
                component: () => import('../views/admin/users/Index.vue'),
                meta: { breadCrumb: 'Users' }
            },
            {
                name: 'users.create',
                path: 'users/create',
                component: () => import('../views/admin/users/Create.vue'),
                meta: { breadCrumb: 'Add New' }
            },
            {
                name: 'users.edit',
                path: 'users/edit/:id',
                component: () => import('../views/admin/users/Edit.vue'),
                meta: { breadCrumb: 'User Edit' }
            },
        ]
    },
    {
        path: "/:pathMatch(.*)*",
        name: 'NotFound',
        component: () => import("../views/errors/404.vue"),
    },
];
