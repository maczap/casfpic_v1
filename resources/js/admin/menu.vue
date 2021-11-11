<template>
   
            <div class="col-span-2 p-4 row-span-10 h-screen text-bg" id="menu_principal">
                
                    <ul class="menu p-4  ">
                        <router-link to="/admin">  
                        <li class="menu-title">
                        <span class="font-bold"><i class="fas fa-home"></i> Início</span>
                        </li> 
                        </router-link>
                    </ul>

                    <ul class="menu p-4  ">
                        
                        <li class="menu-title">
                        <span class="font-bold"><i class="fas fa-user"></i> Cadastros</span>
                        </li> 
                        <router-link to="/admin/promotores">  
                            <li> <a>Promotores</a></li>
                        </router-link>

                        <router-link to="/admin/associados"> 
                            <li> <a>Associados</a></li>
                        </router-link>

                        <router-link to="/admin/splits"> 
                            <li> <a>Split</a></li>
                        </router-link>
                        
                    </ul>            

        
                
            </div>

</template>

<script>


export default {
  components: {
    
  }    
}
</script>

<style scoped>
/* Extra small devices (phones, 600px and down) */
@media only screen and (max-width: 1028px) {
    #menu_principal{
        display: none;
    }
}

/* Small devices (portrait tablets and large phones, 600px and up) */
@media only screen and (min-width: 600px) {

}

/* Medium devices (landscape tablets, 768px and up) */
@media only screen and (min-width: 768px) {

}

/* Large devices (laptops/desktops, 992px and up) */
@media only screen and (min-width: 992px) {

}

/* Extra large devices (large laptops and desktops, 1200px and up) */
@media only screen and (min-width: 1200px) {

}
</style>