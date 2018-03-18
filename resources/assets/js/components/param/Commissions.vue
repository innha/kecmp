<template>

	<div class="container">

		<h1 class="text-center">
			<button class="btn btn-primary" @click.prevent="createCommission()">Create New Commission</button>
		</h1>

<!-- https://mdbootstrap.com/content/tables/ -->

		<!-- <div class=""> -->
			<!-- <ul class="list-group d-flex"> -->
			<table class="table table-hover table-bordered table-condensed"> <!-- table-sm -->
				<!-- <caption>Categories</caption> -->
				<thead class="thead-inverse"><tr><th width="80%">Commission Name</th><th width="20%">Edit/Delete</th></tr></thead>
				<tbody class="tbody">
					<!-- <li class="list-group-item d-flex justify-content-between" v-for="commission, key in commissions"> -->
					<tr v-for="commission, key in commissions">
						<!-- <p> -->
						<td>{{ commission.name }}</td>
						<td>
							<button class="btn btn-warning btn-sm" @click.prevent="editCommission(commission)">Edit</button>
							<button class="btn btn-danger btn-sm" @click.prevent="deleteCommission(commission.id, key)">Delete</button>							
						<!-- </p> -->
						</td>
					<!-- </li> -->
					</tr>
				</tbody>
			<!-- </ul>-->
			</table>

			<create-commission></create-commission>

		<!-- </div> -->
	</div>

</template>

<script>

	import Vue from 'vue'
	import axios from 'axios'
	import VueAxios from 'vue-axios'

	Vue.use (VueAxios, axios)

	export default {

		props: ['default_commissions'],

		mounted() {
			console.log('Parent component mounted.');

			this.$on('commission_created', (commission) => {

				// alert('on inside parent -> commission: ' + JSON.stringify(commission))

				window.noty({

					message: 'Commission created successfully',
					type: 'success'
				})

				this.commissions.push(commission)
			})

			this.$on('commission_updated', (commission) => {

				let commissionIndex = this.commissions.findIndex(l => {

					return commission.id == l.id
				})

				this.commissions.splice(commissionIndex, 1, commission)

				window.noty({

					message: 'Commission id ' + commission.id + ' updated successfully',
					type: 'success'
				})				
			})

			this.$on('commission_deleted', (id) => {

				// alert('on deleted inside parent -> id: ' + id)
				
				window.noty({

					message: 'Commission id ' + id + ' deleted successfully',
					type: 'success'
				})
			})			
		},

		components: {

			'create-commission': require('./children/Commission.vue')
		},

		data() {

			let self = this

			return {

				commissions: JSON.parse(self.default_commissions),
			}
		},

		computed: {

		},

		methods: {

			createCommission() {

				// alert('createCommission')

				this.$emit('create_commission')

				// alert('create_commission event emitted')
			},

			deleteCommission(id, key) {

				let self = this

				if(confirm('Are you sure you want delete commission id ' + id + ', key ' + key + ' ?')) {

					this.axios.delete(`commissions/${id}`).then((resp) => {

						console.log(resp)

						self.commissions.splice(key, 1)

						self.$emit('commission_deleted', id)

					}).catch((e) => {

						console.log(e)

						window.handleError(e)
					})
				}
			},

			editCommission(commission) {

				// alert('editCommission commission ' + JSON.stringify(commission))

				// let commissionId = this.commission.id

				this.$emit('edit_commission', { commission })

				// alert('editCommission emitted')
			}
		}
	}
</script>