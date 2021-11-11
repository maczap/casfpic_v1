
<template>
    <div>
        <div class="navbar mb-2 bg-base-300 rounded-box">

            <div class="flex-1 px-2 lg:flex-none">
                <a class="text-lg font-bold">
                        Splits
                    </a>
            </div> 

            <div class="flex justify-end flex-1 px-2">
                <div class="flex items-stretch">

                <div class="dropdown dropdown-end">
                    <div tabindex="0" class="btn btn-ghost rounded-btn">Menu</div> 
                    <ul tabindex="0" class="p-2 shadow menu dropdown-content bg-base-100 rounded-box w-52">
                <label for="pro-adicionar">  
                    <li>
                        <a></a>
                        </li> 
                    </label> 
                    <li>
                        <a></a>
                    </li> 

                    </ul>
                </div>
                </div>
            </div>

        </div>

        <div class='grid grid-cols-12 grid-flow-col  p-4 bg-white h-screen'>

            <div class="col-span-12">

                <div class='grid grid-cols-12 grid-flow-col  p-4 bg-white h-screen'>

                    <div class="col-span-12 overflow-auto">
                            <!-- <pagination totalPerPage="4" resource ="listaFiltered"></pagination>  -->

                            <table class="table w-full table-zebra">
                            <thead v-if="splits">
                            <tr>
                                <th>Nome</th>
                                <th>Valor</th>
                            
                                
                            </tr>
                            </thead>

                            <tbody>
                            
                            <tr  v-for="(item, index) in splits" :key="index" class="mb-2">
                                <td @click="show(item.id)" class="modal-button" href="#modalCadastro" >

                                    <label for="my-modal-2" >{{item.nome}}</label> </td>
                                <td @click="show(item.id)"><label for="my-modal-2" >R$ {{item.valor}}</label></td>
                                <td @click="show(item.id)"><label for="my-modal-2" >R$ {{item.data}}</label></td>

                                <td>
<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
  <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd" />
</svg>                                   
                                </td>
                                
                
                                
                            
                            </tr>
                            
                            </tbody>
                        </table>  
                        
                    </div>             
                
                </div>  

            </div>             
        </div>




    </div>

</template>

<script>

import CpM from './m.vue'

export default {
    data: function(){
        return{
            splits:[],
            promotor:[],
            configs: {
                orderBy: 'nome',
                order: '',
                filter: '',
            },      
            currentPg: 0,
            itemsPerPage: 8,
            resultCount: 0,        
        }
    },    
    components:{
        CpM,
  
    },
    methods:{
        
        getSplits: function (){

            let set = this;
            axios.get('pagamento/split').then(response => {
                
                set.splits = response.data;
            });
        },        
        show: function (){

        },
        tab: function (id){

            $("#tab_1").css("display","none");
            $("#tab_2").css("display","none");
            $("#tab_3").css("display","none");


            $( "#nav_1" ).removeClass( "tab-active" );
            $( "#nav_2" ).removeClass( "tab-active" );
            $( "#nav_3" ).removeClass( "tab-active" );


            $( "#nav_"+id ).addClass( "tab-active" );

            $("#tab_"+id).css("display","block");
            
        }                  
    },
    mounted: function(){
        this.getSplits();
            $("#tab_2").css("display","none");
            $("#tab_3").css("display","none");
                 
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
tr td label{
    cursor: pointer;
} 
</style>