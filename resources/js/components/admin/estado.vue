<template>
    <div class="content">
	    <div class="container-fluid" v-if="tipo != null && tipo == 1">
            <estado></estado>
        </div>
        <div class="container-fluid" v-if="tipo != null && tipo != 1">
            <error></error>
        </div>
    </div>	
</template>

<script>
    export default {
    data() {
        return {
            tipo:null,
        }
	},
	created(){
		this.getAutenticacion();
     
	},
	mounted(){
     
	},
    methods: {
        getAutenticacion()
        {
            this.$Progress.start();
            axios.get("autenticacion")
            .then(data=>
            {
                this.tipo = data.data.tipo;
                console.log(data.data);
                this.$Progress.finish();
            }
            ).catch(error=>{
                console.log(error);
            });
        },
       
       
    }
}
</script>