<template>
    <div class="container">
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>150</h3>

                <p>Trámites</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer">Mas <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>53</h3>

                <p>Egresados</p>
              </div>
              <div class="icon">
                <i class="ion ion-university"></i>
              </div>
              <a href="#" class="small-box-footer">Mas <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>44</h3>

                <p>Bachilleres</p>
              </div>
              <div class="icon">
                <i class="ion ion-university"></i>
              </div>
              <a href="#" class="small-box-footer">Mas <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>65</h3>

                <p>Titulados</p>
              </div>
              <div class="icon">
                <i class="ion ion-university"></i>
              </div>
              <a href="#" class="small-box-footer">Mas <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
    </div>
</template>

<script>
    export default {
    data() {
        return {
            user: {
              user:null,
              nombre:null,
              tipo:null,
			      },
            tipo:null
		}
	},
	mounted()
	{
		
	},
	created()
    {
		
    },
    methods: {
    agregar()
		{
			axios.post("addUser",{
				user:this.user
			}).then(data=>{
				console.log(data);
                // setTimeout(() => {
                //     location.reload();
                // }, 1500);
			}).catch(error=>{
				console.log(error);	
			})
		},
		getAutenticacion()
        {
            this.$Progress.start();
            axios.get("autenticacion")
            .then(data=>
            {
                this.tipo = data.data.id;
                this.$Progress.finish();
            }
            ).catch(error=>{
                console.log(error);
            });
            
        },
		getMatriculados()
		{
			this.$Progress.start();
			axios.get("getNummatriculados")
			.then(data=>
			{
				this.matriculados = data.data.cantidad;
				this.$Progress.finish();
				console.log(data.data);
			}
			).catch(error=>
			{
				console.log(error);
			})
		},

		
    }
}

</script>

