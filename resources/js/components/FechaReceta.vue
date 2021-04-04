<template>
	<span> {{formatDate}} </span>

</template>

<script>
	export default {
		props: ['date'],

		computed: {
			formatDate(){
				return moment(this.date).locale('es').format('DD [de] MMMM [del] YYYY');
			},

		},
	}
</script>