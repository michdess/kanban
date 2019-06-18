/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
window.Vue = require('vue');

import PortalVue from 'portal-vue';
Vue.use(PortalVue);

import moment from 'moment';
Vue.use(moment);

Vue.use(require('vue-moment'));
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));
Vue.component('tasks', require('./components/Tasks.vue').default);
Vue.component('date-picker', require('./components/DatePicker.vue').default);
Vue.component('edit-task-modal', require('./components/EditTaskModal.vue').default);
Vue.component('create-task-modal', require('./components/CreateTaskModal.vue').default);
Vue.component('create-task-button', require('./components/CreateTaskButton.vue').default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
const app = new Vue({
    el: '#app',
  provide() {
    return {
      taskListState: this.sharedState
    }
  },
  data() {
    return {
      sharedState: {
        tasks: [],
      }
    }
  },
  mounted(){
    this.getTasks();
  },
  methods: {
      getTasks(){
        let self = this;
            axios.get('tasks')
            .then(function (response) {
              self.sharedState.tasks = response.data;
                // commit('SET_TASKS', response.data);
            })
            .catch(function (error) {
               console.log("Tasks could not be retrieved "+error);
            }); 
      }
    },
});
