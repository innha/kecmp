
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('bootstrap');

window.Vue = require('vue');

window.$ = jQuery;

window.events = new Vue()

window.noty = function(notification) {

	window.events.$emit('notification', notification)
}

window.handleError = function(error) {

	alert(JSON.stringify(error.response.data))

	if(error.response.status == 422) {

		window.noty({

			message: 'You have validation errors. Please try again.',
			type: 'danger'
		})
	}

	window.noty({

		message: error.response.data.message,
		type: 'danger'
	})
}

window.axios = require('axios');

window.axios.defaults.headers.common = {
    'X-Requested-With': 'XMLHttpRequest'
};


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('vue-noty', require('./components/Noty.vue'));

Vue.component('vue-login', require('./components/Login.vue'));

Vue.component('vue-villages', require('./components/param/Villages.vue'));
Vue.component('vue-village', require('./components/param/children/Village.vue'));

Vue.component('vue-cells', require('./components/param/Cells.vue'));
Vue.component('vue-cell', require('./components/param/children/Cell.vue'));

Vue.component('vue-sectors', require('./components/param/Sectors.vue'));
Vue.component('vue-sector', require('./components/param/children/Sector.vue'));

Vue.component('vue-districts', require('./components/param/Districts.vue'));
Vue.component('vue-district', require('./components/param/children/District.vue'));

Vue.component('vue-provinces', require('./components/param/Provinces.vue'));
Vue.component('vue-province', require('./components/param/children/Province.vue'));

Vue.component('vue-zones', require('./components/param/Zones.vue'));
Vue.component('vue-zone', require('./components/param/children/Zone.vue'));

Vue.component('vue-chapelles', require('./components/param/Chapelles.vue'));
Vue.component('vue-chapelle', require('./components/param/children/Chapelle.vue'));

Vue.component('vue-parishes', require('./components/param/Parishes.vue'));
Vue.component('vue-parish', require('./components/param/children/Parish.vue'));

Vue.component('vue-dioceses', require('./components/param/Dioceses.vue'));
Vue.component('vue-diocese', require('./components/param/children/Diocese.vue'));

Vue.component('vue-categories', require('./components/param/Categories.vue'));
Vue.component('vue-category', require('./components/param/children/Category.vue'));

Vue.component('vue-choirs', require('./components/param/Choirs.vue'));
Vue.component('vue-choir', require('./components/param/children/Choir.vue'));

Vue.component('vue-commissions', require('./components/param/Commissions.vue'));
Vue.component('vue-commission', require('./components/param/children/Commission.vue'));

Vue.component('vue-degrees', require('./components/param/Degrees.vue'));
Vue.component('vue-degree', require('./components/param/children/Degree.vue'));

Vue.component('vue-duties', require('./components/param/Duties.vue'));
Vue.component('vue-duty', require('./components/param/children/Duty.vue'));

Vue.component('vue-privileges', require('./components/param/Privileges.vue'));
Vue.component('vue-privilege', require('./components/param/children/Privilege.vue'));

Vue.component('vue-roles', require('./components/param/Roles.vue'));
Vue.component('vue-role', require('./components/param/children/Role.vue'));

Vue.component('vue-services', require('./components/param/Services.vue'));
Vue.component('vue-service', require('./components/param/children/Service.vue'));

Vue.component('vue-statuses', require('./components/param/Statuses.vue'));
Vue.component('vue-status', require('./components/param/children/Status.vue'));

Vue.component('vue-types', require('./components/param/Types.vue'));
Vue.component('vue-type', require('./components/param/children/Type.vue'));

Vue.component('vue-tasks', require('./components/param/Tasks.vue'));
Vue.component('vue-task', require('./components/param/children/Task.vue'));

const app = new Vue({
    el: '#app'
});


/*
alert('reset modal')

$('body').on('hidden.bs.modal', '.modal', function () {

    alert('test 1')

    // $('.modal-body').find('textarea, input').val('');

    // $('.modal').remove();

    alert('end test 1')
});
*/

$("#status_id").on('change', function(event) {

	// alert('onChange');

	console.log(event);

 	$("#suspension").toggleClass("hidden visible");  

 	var selected = $("#status_id").val();

 	console.log(selected); 	

 	if(selected == 3) { //suspended
 		$("#suspension").removeClass("hidden", 5000);
 		$("#suspension").addClass("visible", 5000);

		$("#reinstated").removeClass("visible");
		$("#reinstated").addClass("hidden");
		$("#dead").removeClass("visible");
		$("#dead").addClass("hidden");

 	} else if (selected == 4) { //reinstated
 		$("#reinstated").removeClass("hidden");
 		$("#reinstated").addClass("visible");

		$("#suspension").removeClass("visible");
		$("#suspension").addClass("hidden");
		$("#dead").removeClass("visible");
		$("#dead").addClass("hidden");

 	} else if (selected == 5) { //dead
 		$("#dead").removeClass("hidden");
 		$("#dead").addClass("visible");

		$("#suspension").removeClass("visible");
		$("#suspension").addClass("hidden");
		$("#reinstated").removeClass("visible");
		$("#reinstated").addClass("hidden");

 	} else {
		$("#suspension").removeClass("visible");
		$("#suspension").addClass("hidden");
		$("#reinstated").removeClass("visible");
		$("#reinstated").addClass("hidden");
 		$("#dead").removeClass("visible");
 		$("#dead").addClass("hidden");		
 	}
});
