/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

//Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('empresas', require('./components/Empresas.vue').default);
Vue.component('usuarios', require('./components/Usuarios.vue').default);
Vue.component('clientes', require('./components/Clientes.vue').default);
Vue.component('vendedores', require('./components/Vendedores.vue').default);
Vue.component('serviciosempresas', require('./components/ServiciosEmpresas.vue').default);
Vue.component('articulosempresas', require('./components/ArticulosEmpresas.vue').default);
Vue.component('servicios', require('./components/Servicios.vue').default);
Vue.component('articulos', require('./components/Articulos.vue').default);
Vue.component('categorias', require('./components/Categorias.vue').default);
Vue.component('ventas', require('./components/Ventas.vue').default);

Vue.component('miproductos', require('./components/vendedor/Miarticulos.vue').default);
Vue.component('perfil', require('./components/vendedor/perfil.vue').default);
Vue.component('cuentav', require('./components/vendedor/Micuenta.vue').default);
Vue.component('miempresa', require('./components/vendedor/Miempresa.vue').default);
Vue.component('miservicios', require('./components/vendedor/Miservicios.vue').default);
Vue.component('miventap', require('./components/vendedor/Miventap.vue').default);
Vue.component('miventas', require('./components/vendedor/Miventas.vue').default);

Vue.component('perfilv', require('./components/clientes/perfil.vue').default);
Vue.component('cuentac', require('./components/clientes/MiCuenta.vue').default);
Vue.component('comprass', require('./components/clientes/Micomprass.vue').default);
Vue.component('comprasp', require('./components/clientes/Micomprasp.vue').default);
Vue.component('carrito', require('./components/clientes/Carrito.vue').default);
Vue.component('mapa', require('./components/clientes/Mapa.vue').default);

Vue.component('prueba', require('./components/Prueba.vue').default);

Vue.component('mics', require('./components/MicrositioServicios.vue').default);
Vue.component('micp', require('./components/MicrositioProductos.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    data: {
        menu: 0
    }
});