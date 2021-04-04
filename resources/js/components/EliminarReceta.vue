<template>
	<input 
	type ="submit" 
	value="Eliminar x" 
	class="btn btn-danger d-block w-100 mb-2"
	@click= "deleteRecipe">
</template>

<script>
	export default {
		props: ['recetaId'],
		methods: {

			deleteRecipe(){
				this.$swal({
					title: '¿Desas eliminar esta receta?',
					text: "Una vez eliminada, no se puede recuperar",
					icon: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Si',
					cancelButtonText: 'No'
				}).then((result) => {
					if (result.isConfirmed) {
						const params = {
							id: this.recetaId
						} 

						axios.post(`/recetas/${this.recetaId}`, {params, _method:'delete'})

						.then(response => {
							this.$swal(
							'Receta Eliminada',
							'Se elimino la receta',
							'success'
							)
							//Eliminar del DOM
							this.$el.parentNode.parentNode.parentNode.removeChild(this.$el.parentNode.parentNode);


						})
						.catch(error =>{
							console.log(error);
						})

					}
				})
			}
		}
	}
</script>