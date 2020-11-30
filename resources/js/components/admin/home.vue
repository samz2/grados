<template>
    <div class="container">
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{tramites}}</h3>

                <p>Trámites</p>
              </div>
              <div class="icon">
                <i class="ion ion-clipboard"></i>
              </div>
              <!--<a href="#" class="small-box-footer">-->
                <router-link to="#" class="small-box-footer" title="Trámites en proceso">
                    <i class="fas fa-minus-circle"></i>      
                </router-link>  
              <!--</a>-->
              <!--<a href="#" class="small-box-footer"><i class="fas fa-arrow-circle-right"></i></a>-->
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{egresados}}</h3>

                <p>Egresados</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-stalker"></i>
              </div>
              <router-link to="egresados" class="small-box-footer" title="Ir a interfaz de egresados..">
                    Más <i class="fas fa-arrow-circle-right"></i>      
                </router-link>  
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{expeditob}}</h3>

                <p>Bachilleres</p>
              </div>
              <div class="icon">
                <i class="ion ion-university"></i>
              </div>
              <router-link to="expeditobachiller" class="small-box-footer" title="Ir a interfaz de expeditos bachiller..">
                    Más <i class="fas fa-arrow-circle-right"></i>      
                </router-link>  
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-indigo">
              <div class="inner">
                <h3>{{expeditot}}</h3>

                <p>Titulados</p>
              </div>
              <div class="icon">
                <i class="ion ion-ribbon-a"></i>
              </div>
              <router-link to="expeditotitulo" class="small-box-footer" title="Ir a interfaz de expeditos título..">
                    Más <i class="fas fa-arrow-circle-right"></i>      
                </router-link> 
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
            tipo:null,
            tramites:null,
            egresados:null,
            expeditob:null,
            expeditot:null
		}
	},
	mounted()
	{
		
	},
	created()
    {
      this.countTramites();
      this.countEgresados();
      this.countExpeditos();
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
    countTramites()
    {
            this.$Progress.start();
                  axios.get("numTramites")
                  .then(data=>
                  {
                      this.tramites = data.data.expeditos;
                      this.$Progress.finish();
                  }
                  ).catch(error=>{
                      console.log(error);
                  });
    },
    countEgresados()
    {
            this.$Progress.start();
                  axios.get("numEgresados")
                  .then(data=>
                  {
                      this.egresados = data.data.egresados;
                      this.$Progress.finish();
                  }
                  ).catch(error=>{
                      console.log(error);
                  });
    },
    countExpeditos()
    {
            this.$Progress.start();
                  axios.get("numExpeditos")
                  .then(data=>
                  {
                      this.expeditob = data.data.expeditosb;
                      this.expeditot = data.data.expeditost;
                      this.$Progress.finish();
                  }
                  ).catch(error=>{
                      console.log(error);
                  });
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

