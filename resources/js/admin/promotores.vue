
<template>
    <div>
        <div class='w-full bg-gray-200 p-4 topo'>
            <h1>Promotores1</h1>

                <div class="dropdown dropdown-top">
                    <div tabindex="0" class="m-1 btn">Dropdown</div> 
                    <ul tabindex="0" class="p-2 shadow menu dropdown-content bg-base-100 rounded-box w-52">
                    <li>
                        <a>Item 1</a>
                    </li> 
                    <li>
                        <a>Item 2</a>
                    </li> 
                    <li>
                        <a>Item 3</a>
                    </li>
                    </ul>
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

                                <div class="flex-1 p-2 w-2">
                                    <label class="label">
                                    <span class="label-text">Nome</span>
                                    </label> 
                                    <input type="text" placeholder="Nome" v-model="promotor.name" class="input w-full">
                                </div>

                                <div class="flex-initial p-2">
                                    <label class="label">
                                    <span class="label-text">CPF</span>
                                    </label> 
                                    <input type="text" placeholder="CPF" v-model="promotor.cpf" class="input w-full">
                                </div>

                                <div class="flex-initial p-2">
                                    <label class="label">
                                    <span class="label-text">RG</span>
                                    </label> 
                                    <input type="text" placeholder="RG" v-model="promotor.rg" class="input w-full">
                                </div>       

                            </div>

                            <div class="flex flex-wrap">

  
                                <div class="flex-1 p-2">
                                    <label class="label">
                                    <span class="label-text">Sexo</span>
                                    </label> 
                                    <select class="select select-bordered w-full max-w-xs" v-model="promotor.sexo" id="sexo" >
                                        <option disabled="disabled" selected="selected">Sexo</option> 
                                        <option value="1">Feminino</option>
                                        <option value="2">Masculino</option>
                                    </select>                                      
                                </div>  

                                <div class="flex-1 p-2">
                                    <label class="label">
                                    <span class="label-text">Estado Civil</span>
                                    </label> 
                                    <select class="select select-bordered w-full max-w-xs" v-model="promotor.ecivil" id="ecivil" >
                                        <option disabled="disabled" selected="selected">Estado Civil</option> 
                                        <option value="0">Solteiro</option>
                                        <option value="1">Casado</option>
                                        <option value="2">Separado</option>
                                        <option value="3">Divorciado</option>
                                        <option value="4">Viúvo</option>
                                        <option value="5">Amasiado</option>
                                    </select>                                    
                                </div>   

                                <div class="flex-1 p-2">
                                    <label class="label">
                                    <span class="label-text">Nascimento</span>
                                    </label> 
                                    <input type="text" placeholder="username" class="input w-full">
                                </div>   

                                <div class="flex-1 p-2">
                                    <label class="label">
                                    <span class="label-text">Profissão</span>
                                    </label> 
                                    <input type="text" placeholder="Profissão" v-model="promotor.profissao" class="input w-full">
                                </div>                                  
                                          

                            </div>   


                            <div class="flex flex-wrap">

  
                                <div class="flex-1 p-2 w-2">
                                    <label class="label">
                                    <span class="label-text">Endereço</span>
                                    </label> 
                                    <input type="text" placeholder="Endereço" v-model="promotor.endereco"  class="input w-full">
                                </div>  

                                <div class="flex-initial p-2">
                                    <label class="label">
                                    <span class="label-text">Numero</span>
                                    </label> 
                                    <input type="text" placeholder="Número" v-model="promotor.numero"  class="input">
                                </div>   

                                <div class="flex-initial p-2">
                                    <label class="label">
                                    <span class="label-text">Complemento</span>
                                    </label> 
                                    <input type="text" placeholder="Complemento" v-model="promotor.complemento"  class="input w-full">
                                </div>   

                            </div>       

                            <div class="flex flex-wrap">
    
                                <div class="flex-1 p-2">
                                    <label class="label">
                                    <span class="label-text">Celular</span>
                                    </label> 
                                    <input type="text" placeholder="Celular" v-model="promotor.celular"  class="input w-full">
                                </div>  

                                <div class="flex-1 p-2">
                                    <label class="label">
                                    <span class="label-text">email</span>
                                    </label> 
                                    <input type="text" placeholder="email" v-model="promotor.email"  class="input w-full">
                                </div>   

                            </div>   

                            <div class="flex flex-wrap">

                                <!-- <div class="flex-1 p-2 w-1">
                                    <label class="label">
                                    <span class="label-text">Plano</span>
                                    </label> 
                                    <input type="text" placeholder="Plano"  v-model="promotor.plano"  class="input w-full">
                                </div>  

                                <div class="flex-1 p-2">
                                    <label class="label">
                                    <span class="label-text">Status</span>
                                    </label> 
                                    <input type="text" placeholder="Status" v-model="promotor.status_detail"  class="input w-full">
                                </div>                                  
  
                                <div class="flex-1 p-2">
                                    <label class="label">
                                    <span class="label-text">Promotor</span>
                                    </label> 
                                    <input type="text" placeholder="username" v-model="promotor.promotor"  class="input w-full">
                                </div>   -->

                            </div>                                                                              

                        </div>
                        <div class="p-2 card " id="tab_2">Cadastros </div>
                        <div class="p-2 card " id="tab_3"> 
                          <div class="flex flex-wrap">

                                <div class="p-2 w-full">
                                    <div class="form-control">
                                    <label class="label">
                                        <span class="label-text">Link</span>
                                    </label> 
                                    <div class="relative">
                                        <input type="text" placeholder="Link" :value="'https://casfpic.org.br/p/'+promotor.link"  class="w-full pr-16 input input-primary input-bordered"> 
                                        <button class="absolute top-0 right-0 rounded-l-none btn btn-primary">Copiar</button>
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

    </div>

</template>

<script>

import CpM from './m.vue'


import QrcodeVue from 'qrcode.vue'

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