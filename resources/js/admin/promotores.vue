
<template>
    <div>
        <div class="navbar mb-2 bg-base-300 rounded-box">

            <div class="flex-1 px-2 lg:flex-none">
                <a class="text-lg font-bold">
                        Promotores
                    </a>
            </div> 

            <div class="flex justify-end flex-1 px-2">
                <div class="flex items-stretch">

                <div class="dropdown dropdown-end">
                    <div tabindex="0" class="btn btn-ghost rounded-btn">Menu</div> 
                    <ul tabindex="0" class="p-2 shadow menu dropdown-content bg-base-100 rounded-box w-52">
                <label for="pro-adicionar">  
                    <li>
                        <a>Adicionar</a>
                        </li> 
                    </label> 
                    <li>
                        <a>Relatório</a>
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
                            <thead v-if="promotores">
                            <tr>
                                <th>Nome</th>
                                <th>CPF</th>
                                <th>Cadastros</th>
                                <th>Ativo</th>
                                
                            </tr>
                            </thead>

                            <tbody>
                            
                            <tr  v-for="(item, index) in promotores" :key="index" class="mb-2">
                                <td @click="show(item.id)" class="modal-button" href="#modalCadastro" >
                                    <label for="my-modal-2" >{{item.name}}</label> </td>
                                <td @click="show(item.id)"><label for="my-modal-2" >{{item.cpf}}</label></td>
                                <td @click="show(item.id)"><label for="my-modal-2" >{{item.cadastros}}</label></td>
                                <td>
                                    <div class="bordered">
                                        <div class="form-control">
                                            <label class="cursor-pointer label">
                                                <input type="checkbox" checked="checked" class="toggle toggle-accent">
                                            </label>
                                        </div>
                                    </div>                            
                                </td>
                                
                            
                            </tr>
                            
                            </tbody>
                        </table>  
                        
                    </div>             
                
                </div>  

            </div>             
        </div>




        <input type="checkbox" id="my-modal-2" class="modal-toggle"> 
        <div class="modal ">
        <div class="modal-box h-4/5" style="max-width:80%">
            <div class="flex flex-col">
                <div class="w-full" v-if="promotor">

                        <h1 class="p-2 font-semibold text-lg">{{promotor.name}}</h1>

                        <div class="tabs">
                        <a class="tab tab-lifted tab-active" id="nav_1" @click="tab(1)">Cadastro</a> 
                        <a class="tab tab-lifted " id="nav_2" @click="tab(2)">Cadastrados</a> 
                        <a class="tab tab-lifted " id="nav_3" @click="tab(3)">Links QrCode</a> 
                        <!-- <a class="tab tab-lifted">Transações</a> -->
                        </div>


                        <div class="grid grid-cols-12 bg-base-200">
                            <div class="col-span-12">

                                <div class="p-2 card " id="tab_1">
                                    <div class="flex flex-wrap">

                                        <div class="flex-1 p-1 w-2">
                                            <label class="label">
                                            <span class="label-text  text-gray-400">Nome</span>
                                            </label> 
                                            <input type="text" placeholder="Nome" v-model="promotor.name" class="input w-full h-9">
                                        </div>

                                        <div class="flex-initial p-1">
                                            <label class="label">
                                            <span class="label-text  text-gray-400">CPF</span>
                                            </label> 
                                            <input type="text" placeholder="CPF" v-model="promotor.cpf" class="input w-full h-9">
                                        </div>

                                        <div class="flex-initial p-1">
                                            <label class="label">
                                            <span class="label-text  text-gray-400">RG</span>
                                            </label> 
                                            <input type="text" placeholder="RG" v-model="promotor.rg" class="input w-full h-9">
                                        </div>       

                                    </div>

                                    <div class="flex flex-wrap">

        
                                        <div class="flex-1 p-1">
                                            <label class="label">
                                            <span class="label-text  text-gray-400">Sexo</span>
                                            </label> 
                                            <select class="select select-bordered w-full max-w-xs h-9 min-h-0" v-model="promotor.sexo" id="sexo" >
                                                <option disabled="disabled" selected="selected">Sexo</option> 
                                                <option value="1">Feminino</option>
                                                <option value="2">Masculino</option>
                                            </select>                                      
                                        </div>  

                                        <div class="flex-1 p-1">
                                            <label class="label">
                                            <span class="label-text  text-gray-400">Estado Civil</span>
                                            </label> 
                                            <select class="select select-bordered w-full max-w-xs h-9 min-h-0" v-model="promotor.ecivil" id="ecivil" >
                                                <option disabled="disabled" selected="selected">Estado Civil</option> 
                                                <option value="0">Solteiro</option>
                                                <option value="1">Casado</option>
                                                <option value="2">Separado</option>
                                                <option value="3">Divorciado</option>
                                                <option value="4">Viúvo</option>
                                                <option value="5">Amasiado</option>
                                            </select>                                    
                                        </div>   

                                        <div class="flex-1 p-1">
                                            <label class="label">
                                            <span class="label-text  text-gray-400">Nascimento</span>
                                            </label> 
                                            <input type="text" placeholder="Nascimento" class="input w-full h-9">
                                        </div>   

                                        <div class="flex-1 p-1">
                                            <label class="label">
                                            <span class="label-text  text-gray-400">Profissão</span>
                                            </label> 
                                            <input type="text" placeholder="Profissão" v-model="promotor.profissao" class="input w-full h-9">
                                        </div>                                  
                                                

                                    </div>   


                                    <div class="flex flex-wrap">

                                        <div class="flex-1 p-1 w-2">
                                            <label class="label">
                                            <span class="label-text  text-gray-400">Endereço</span>
                                            </label> 
                                            <input type="text" placeholder="Endereço" v-model="promotor.endereco"  class="input w-full h-9">
                                        </div>  

                                        <div class="flex-initial p-1">
                                            <label class="label">
                                            <span class="label-text  text-gray-400">Numero</span>
                                            </label> 
                                            <input type="text" placeholder="Número" v-model="promotor.numero"  class="input  h-9">
                                        </div>   

                                        <div class="flex-initial p-1">
                                            <label class="label">
                                            <span class="label-text  text-gray-400">Complemento</span>
                                            </label> 
                                            <input type="text" placeholder="Complemento" v-model="promotor.complemento"  class="input w-full h-9">
                                        </div>   

                                    </div>       

                                    <div class="flex flex-wrap">
            
                                        <div class="flex-1 p-1">
                                            <label class="label">
                                            <span class="label-text  text-gray-400">Celular</span>
                                            </label> 
                                            <input type="text" placeholder="Celular" v-model="promotor.celular"  class="input w-full h-9">
                                        </div>  

                                        <div class="flex-1 p-1">
                                            <label class="label">
                                            <span class="label-text  text-gray-400">email</span>
                                            </label> 
                                            <input type="text" placeholder="email" v-model="promotor.email"  class="input w-full h-9">
                                        </div>   

                                    </div>   

                                    <div class="flex flex-wrap">

                                        <!-- <div class="flex-1 p-2 w-1">
                                            <label class="label">
                                            <span class="label-text  text-gray-400">Plano</span>
                                            </label> 
                                            <input type="text" placeholder="Plano"  v-model="promotor.plano"  class="input w-full h-9">
                                        </div>  

                                        <div class="flex-1 p-2">
                                            <label class="label">
                                            <span class="label-text  text-gray-400">Status</span>
                                            </label> 
                                            <input type="text" placeholder="Status" v-model="promotor.status_detail"  class="input w-full h-9">
                                        </div>                                  
        
                                        <div class="flex-1 p-2">
                                            <label class="label">
                                            <span class="label-text  text-gray-400">Promotor</span>
                                            </label> 
                                            <input type="text" placeholder="username" v-model="promotor.promotor"  class="input w-full h-9">
                                        </div>   -->

                                    </div>                                                                              

                                </div>
                                <div class="p-2 card " id="tab_2">Cadastros </div>
                                <div class="p-2 card " id="tab_3"> 
                                <div class="flex flex-wrap">

                                        <div class="p-2 w-full">
                                            <div class="form-control">
                                            <label class="label">
                                                <span class="label-text  text-gray-400">Link</span>
                                            </label> 
                                            <div class="relative">
                                                <input type="text" id = "link_promotor" placeholder="Link" :value="'https://casfpic.org.br/p/'+promotor.link"  class="w-full pr-16 input input-primary input-bordered"> 
                                                <button class="absolute top-0 right-0 rounded-l-none btn btn-primary" onclick="copiarLinkPromotor()">Copiar</button>
                                            </div>
                                            </div> 
                                            
                                        </div>


                                        <div class="flex p-2 w-2">
                                            <div class="flex-1 p-4">
                                                <qrcode-vue :value="'https://casfpic.org.br/p/'+promotor.link" size="100" level="H" />    
                                            </div>
                                            <div class="flex-1 p-4">
                                                <qrcode-vue :value="'https://casfpic.org.br/p/'+promotor.link" size="200" level="H" />    
                                            </div>
                                            <div class="flex-1 p-4">
                                                <qrcode-vue :value="'https://casfpic.org.br/p/'+promotor.link" size="300" level="H" />    
                                            </div>                                                                        
                    
                                        </div>

                                    </div>                            
                                </div>                        
                                
                            </div>

                
                        </div>
                        


                </div>

            </div>
            <div class="modal-action">
            <!-- <label for="my-modal-2" class="btn btn-primary">Salvar</label>  -->
            <label for="my-modal-2" class="btn">Fechar</label>
            </div>
        </div>
        </div>

        <pro-adicionar></pro-adicionar>

    </div>

</template>

<script>

import CpM from './m.vue'


import QrcodeVue from 'qrcode.vue'
import ProAdicionar from './promotores_adicionar.vue'

export default {
    data: function(){
        return{
            promotores:[],
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
        QrcodeVue,
        ProAdicionar
    },
    methods:{
        
        getPromotores: function (){

            let set = this;
            axios.get('get/promotores').then(response => {
                console.log(response.data);
                set.promotores = response.data;
            });
        },        
        show: function (id){
            let set = this;
            axios.get('get/promotor/'+id).then(response => {
                console.log(response.data);
                set.promotor = response.data;
            });
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
        this.getPromotores();
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