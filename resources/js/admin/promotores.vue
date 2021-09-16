
<template>
    <div>
        <div class='w-full bg-gray-200 p-4 topo'>
            <h1>Promotores</h1>

            <cp-m></cp-m>





        </div>
        <div class='grid grid-cols-12 grid-flow-col  p-4 bg-white h-screen'>

            <div class="col-span-2">
                menu
            
            </div>    

            <div class="col-span-10">

            meio
            </div>             
        
        </div>
    </div>

</template>

<script>

import CpM from './m.vue'
export default {
    components:{
        CpM
    }
}
</script>

<style scoped>
.topo{
    position: relative;
}
.menu1{
    position: absolute;
    right: 10px;
    top:10px;
    
}
 
</style>