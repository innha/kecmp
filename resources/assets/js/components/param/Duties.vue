<template>

	<div class="container">

		<h1 class="text-center">
			<button class="btn btn-primary" @click.prevent="createDuty()">Create New Duty</button>
		</h1>

<!-- https://mdbootstrap.com/content/tables/ -->

		<!-- <div class=""> -->
			<!-- <ul class="list-group d-flex"> -->
			<table class="table table-hover table-bordered table-condensed"> <!-- table-sm -->
				<!-- <caption>Categories</caption> -->
				<thead class="thead-inverse"><tr><th width="80%">Duty Name</th><th width="20%">Edit/Delete</th></tr></thead>
				<tbody class="tbody">
					<!-- <li class="list-group-item d-flex justify-content-between" v-for="duty, key in duties"> -->
					<tr v-for="duty, key in duties">
						<!-- <p> -->
						<td>{{ duty.name }}</td>
						<td>
							<button class="btn btn-warning btn-sm" @click.prevent="editDuty(duty)">Edit</button>
							<button class="btn btn-danger btn-sm" @click.prevent="deleteDuty(duty.id, key)">Delete</button>							
						<!-- </p> -->
						</td>
					<!-- </li> -->
					</tr>
				</tbody>
			<!-- </ul>-->
			</table>

			<create-duty></create-duty>

		<!-- </div> -->
	</div>

</template>

<script>

	import Vue from 'vue'
	import axios from 'axios'
	import VueAxios from 'vue-axios'

	Vue.use (VueAxios, axios)

	export default {

		props: ['default_duties'],

		mounted() {
			console.log('Parent component mounted.');

			this.$on('duty_created', (duty) => {

				// alert('on inside parent -> duty: ' + JSON.stringify(duty))

				window.noty({

					message: 'Duty created successfully',
					type: 'success'
				})

				this.duties.push(duty)
			})

			this.$on('duty_updated', (duty) => {

				let dutyIndex = this.duties.findIndex(l => {

					return duty.id == l.id
				})

				this.duties.splice(dutyIndex, 1, duty)

				window.noty({

					message: 'Duty id ' + duty.id + ' updated successfully',
					type: 'success'
				})				
			})

			this.$on('duty_deleted', (id) => {

				// alert('on deleted inside parent -> id: ' + id)
				
				window.noty({

					message: 'Duty id ' + id + ' deleted successfully',
					type: 'success'
				})
			})			
		},

		components: {

			'create-duty': require('./children/Duty.vue')
		},

		data() {

			let self = this

			return {

				duties: JSON.parse(self.default_duties),
			}
		},

		computed: {

		},

		methods: {

			createDuty() {

				// alert('createDuty')

				this.$emit('create_duty')

				// alert('create_duty event emitted')
			},

			deleteDuty(id, key) {

				let self = this

				if(confirm('Are you sure you want delete duty id ' + id + ', key ' + key + ' ?')) {

					this.axios.delete(`duties/${id}`).then((resp) => {

						console.log(resp)

						self.duties.splice(key, 1)

						self.$emit('duty_deleted', id)

					}).catch((e) => {

						console.log(e)

						window.handleError(e)
					})
				}
			},

			editDuty(duty) {

				// alert('editDuty duty ' + JSON.stringify(duty))

				// let dutyId = this.duty.id

				this.$emit('edit_duty', { duty })

				// alert('editDuty emitted')
			}
		}
	}
</script>