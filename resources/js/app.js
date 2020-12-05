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

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('landing', require('./components/Landing.vue').default);
Vue.component('navbar', require('./components/Navbar.vue').default);
Vue.component('docs-menu', require('./components/DocsMenu.vue').default);

Vue.component('items', require('./components/Items.vue').default);
Vue.component('item-modal', require('./components/ItemModal.vue').default);

Vue.component('post-articles', require('./components/Guide.vue').default);
Vue.component('post', require('./components/GuideShow.vue').default);

Vue.component('monsters', require('./components/Monster.vue').default);

Vue.component('dungeons', require('./components/Dungeon.vue').default);



// ADMINISTRATOR SECTION
Vue.component('login', require('./components/Login.vue').default);
Vue.component('Sidebar', require('./components/Admin/Sidebar.vue').default);


Vue.component('widgets', require('./components/Admin/Widgets.vue').default);
Vue.component('dashboard', require('./components/Admin/Dashboard.vue').default);

Vue.component('category', require('./components/Admin/Category.vue').default);
Vue.component('category-create', require('./components/Admin/CategoryCreate.vue').default);
Vue.component('category-edit', require('./components/Admin/CategoryEdit.vue').default);

Vue.component('sub-category', require('./components/Admin/SubCategory.vue').default);
Vue.component('sub-category-create', require('./components/Admin/SubCategoryCreate.vue').default);
Vue.component('sub-category-edit', require('./components/Admin/SubCategoryEdit.vue').default);


Vue.component('item-list', require('./components/Admin/Item.vue').default);
Vue.component('item-create', require('./components/Admin/ItemCreate.vue').default);
Vue.component('item-edit', require('./components/Admin/ItemEdit.vue').default);


Vue.component('sets', require('./components/Admin/Sets.vue').default);
Vue.component('set-create', require('./components/Admin/SetCreate.vue').default);
Vue.component('set-edit', require('./components/Admin/SetEdit.vue').default);


Vue.component('list-article', require('./components/Admin/Article.vue').default);
Vue.component('article-create', require('./components/Admin/ArticleCreate.vue').default);
Vue.component('article-edit', require('./components/Admin/ArticleEdit.vue').default);

Vue.component('list-monster', require('./components/Admin/Monsters.vue').default);
Vue.component('monster-create', require('./components/Admin/MonsterCreate.vue').default);
Vue.component('monster-edit', require('./components/Admin/MonsterEdit.vue').default);

Vue.component('list-dungeon', require('./components/Admin/Dungeons.vue').default);
Vue.component('dungeon-create', require('./components/Admin/DungeonCreate.vue').default);
Vue.component('dungeon-edit', require('./components/Admin/DungeonEdit.vue').default);






/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});

