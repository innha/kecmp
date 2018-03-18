<template>

	<div class="container">

		<h1 class="text-center">
			<button class="btn btn-primary" @click.prevent="createCategory()">Create New Category</button>
		</h1>

<!-- https://mdbootstrap.com/content/tables/ -->

		<!-- <div class=""> -->
			<!-- <ul class="list-group d-flex"> -->
			<table class="table table-hover table-bordered table-condensed"> <!-- table-sm -->
				<!-- <caption>Categories</caption> -->
				<thead class="thead-inverse"><tr><th width="80%">Category Name</th><th width="20%">Edit/Delete</th></tr></thead>
				<tbody class="tbody">
					<!-- <li class="list-group-item d-flex justify-content-between" v-for="category, key in categories"> -->
					<tr v-for="category, key in categories">
						<!-- <p> -->
						<td>{{ category.name }}</td>
						<td>
							<button class="btn btn-warning btn-sm" @click.prevent="editCategory(category)">Edit</button>
							<button class="btn btn-danger btn-sm" @click.prevent="deleteCategory(category.id, key)">Delete</button>							
						<!-- </p> -->
						</td>
					<!-- </li> -->
					</tr>
				</tbody>
			<!-- </ul>-->
			</table>

			<create-category></create-category>

		<!-- </div> -->
	</div>

</template>

<script>

	import Vue from 'vue'
	import axios from 'axios'
	import VueAxios from 'vue-axios'

	Vue.use (VueAxios, axios)

	export default {

		props: ['default_categories'],

		mounted() {
			console.log('Parent component mounted.');

			this.$on('category_created', (category) => {

				// alert('on inside parent -> category: ' + JSON.stringify(category))

				window.noty({

					message: 'Category created successfully',
					type: 'success'
				})

				this.categories.push(category)
			})

			this.$on('category_updated', (category) => {

				let categoryIndex = this.categories.findIndex(l => {

					return category.id == l.id
				})

				this.categories.splice(categoryIndex, 1, category)

				window.noty({

					message: 'Category id ' + category.id + ' updated successfully',
					type: 'success'
				})				
			})

			this.$on('category_deleted', (id) => {

				// alert('on deleted inside parent -> id: ' + id)
				
				window.noty({

					message: 'Category id ' + id + ' deleted successfully',
					type: 'success'
				})
			})			
		},

		components: {

			'create-category': require('./children/Category.vue')
		},

		data() {

			let self = this

			return {

				categories: JSON.parse(self.default_categories),
			}
		},

		computed: {

		},

		methods: {

			createCategory() {

				// alert('createCategory')

				this.$emit('create_category')

				// alert('create_category event emitted')
			},

			deleteCategory(id, key) {

				let self = this

				if(confirm('Are you sure you want delete category id ' + id + ', key ' + key + ' ?')) {

					this.axios.delete(`categories/${id}`).then((resp) => {

						console.log(resp)

						self.categories.splice(key, 1)

						self.$emit('category_deleted', id)

					}).catch((e) => {

						console.log(e)

						window.handleError(e)
					})
				}
			},

			editCategory(category) {

				// alert('editCategory category ' + JSON.stringify(category))

				// let categoryId = this.category.id

				this.$emit('edit_category', { category })

				// alert('editCategory emitted')
			}
		}
	}
</script>