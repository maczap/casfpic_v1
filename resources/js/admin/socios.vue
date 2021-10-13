
<template>
    <div>
        <div class='w-full bg-gray-200 p-4 topo'>
            <h1>Associados</h1>
            
        </div>
        <div class='grid grid-cols-12 grid-flow-col  p-4 bg-white h-screen'>



            <div class="col-span-12 overflow-auto">
                 <!-- <pagination totalPerPage="4" resource ="listaFiltered"></pagination>  -->

                <table class="table w-full table-zebra">
                <thead v-if="socios">
                <tr>
                    <th>Nome</th>
                    <th>PLANO</th>
                    <th>PROMOTOR(A)</th>
                    <th>STATUS</th>

                </tr>
                </thead>

                <tbody>
                
                <tr  v-for="(item, index) in socios" :key="index" class="mb-2" 
                :class="{'bdp': item.status == 'paid', 'bdu': item.status == 'unpaid'}">
                    <td class="modal-button" href="#modalCadastro" @click="show(item.id)">
                        <label for="my-modal-2" >{{item.name}}</label> </td>
      
                    <td @click="show(item.id)"><label for="my-modal-2" >{{item.plano}}</label></td>
                    <td @click="show(item.id)"><label for="my-modal-2" >{{item.promotor}}</label></td>
                    <td @click="show(item.id)"><label for="my-modal-2" >{{item.status_detail}}</label></td>
                   
                </tr>
                
                </tbody>
            </table>  
            
            </div>             
        
        </div>




<input type="checkbox" id="my-modal-2" class="modal-toggle"> 
<div class="modal ">
  <div class="modal-box h-4/5" style="max-width:80%">
    <div class="flex flex-col">
        <div class="w-full" v-if="socio">

                <h1 class="p-2 font-semibold text-lg">{{socio.name}}</h1>

                <div class="tabs">
                <a id="nav_1" class="tab tab-lifted tab-active" @click="tab(1)">Cadastro</a> 
                <a id="nav_8" class="tab tab-lifted " @click="tab(8)">Plano</a> 
                <a id="nav_6" class="tab tab-lifted " @click="tab(6), getDependend(socio.id)">Dependentes</a> 
                <a id="nav_4" class="tab tab-lifted " @click="tab(4)">Atendimento</a> 
                <a id="nav_5" class="tab tab-lifted " @click="tab(5)">Carteirinhas</a> 
                <!-- <a id="nav_2" class="tab tab-lifted " @click="tab(2)">Pagamentos</a>  -->
                <!-- <a id="nav_3" class="tab tab-lifted" @click="tab(3)">Transações</a> -->
                </div>


                <div class="grid grid-cols-12 bg-base-200">
                    <div class="col-span-12">

                        <div class="p-2 card " id="tab_1">
                            <div class="flex flex-wrap min-h-96 p-1">

                                <div class="p-1 w-1/4">
                                    <label class="label">
                                    <span class="label-text  text-gray-400">Nome</span>
                                    </label> 
                                    <input type="text" placeholder="Nome" v-model="socio.name" class="input h-8 p-1 w-full ">
                                </div>

                                <div class="flex-initial w-30  p-1">
                                    <label class="label">
                                    <span class="label-text  text-gray-400">CPF</span>
                                    </label> 
                                    <input type="text" placeholder="CPF" v-model="socio.cpf" class="input h-8 w-full p-1">
                                </div>

                                <div class="flex-initial w-28 p-1">
                                    <label class="label">
                                    <span class="label-text  text-gray-400">RG</span>
                                    </label> 
                                    <input type="text" placeholder="RG" v-model="socio.rg" class="input h-8 w-full p-1">
                                </div>      

                                <div class="flex-1 p-1">
                                    <label class="label">
                                    <span class="label-text  text-gray-400">Sexo</span>
                                    </label> 
                                        <select class="select select-bordered  h-8 min-h-8 w-full max-w-xs" v-model="socio.sexo" id="sexo" >
                                            <option disabled="disabled" selected="selected">Sexo</option> 
                                            <option value="F">Feminino</option>
                                            <option value="M">Masculino</option>
                                        </select>  
                                </div>  

                                <div class="flex-1 p-1">
                                    <label class="label">
                                    <span class="label-text  text-gray-400">Estado Civil</span>
                                    </label> 

                                    <select class="select select-bordered w-full max-w-xs h-8 min-h-8" v-model="socio.ecivil" id="ecivil" >
                                        <option disabled="disabled" selected="selected">Estado Civil</option> 
                                        <option value="0">Solteiro</option>
                                        <option value="1">Casado</option>
                                        <option value="2">Separado</option>
                                        <option value="3">Divorciado</option>
                                        <option value="4">Viúvo</option>
                                        <option value="5">Amasiado</option>
                                    </select>


                                </div>                                    

                            </div>

                            <div class="flex flex-wrap">

                                <div class="flex-1 p-1">
                                    <label class="label">
                                    <span class="label-text  text-gray-400">Nascimento</span>
                                    </label> 
                                    <input type="text" placeholder="username"  :value="socio.nascimento | formatDate" class="input h-8 w-full">
                                </div>   

                                <div class="flex-1 p-1">
                                    <label class="label">
                                    <span class="label-text  text-gray-400">Profissão</span>
                                    </label> 
                                    <input type="text" placeholder="Profissão" v-model="socio.profissao" class="input h-8 w-full">
                                </div>                                  
                                          
                                <div class="flex-1 p-1 w-1">
                                    <label class="label">
                                    <span class="label-text  text-gray-400">Nome da Mãe</span>
                                    </label> 
                                    <input type="text" placeholder="Nome da Mãe" v-model="socio.nomemae"  class="input h-8 w-full">
                                </div>  
  
                                <div class="flex-1 p-1">
                                    <label class="label">
                                    <span class="label-text  text-gray-400">Promotor</span>
                                    </label> 
                                    <input type="text" placeholder="username" v-model="socio.promotor"  class="input h-8 w-full">
                                </div>                                  

                            </div>   
           

                            <div class="flex flex-wrap">

  
                                <div class="flex--initial p-1 w-72">
                                    <label class="label">
                                    <span class="label-text  text-gray-400">Endereço</span>
                                    </label> 
                                    <input type="text" placeholder="Endereço" v-model="socio.endereco"  class="input h-8 w-full">
                                </div>  

                                <div class="flex-initial p-1 w-32">
                                    <label class="label">
                                    <span class="label-text  text-gray-400">Numero</span>
                                    </label> 
                                    <input type="text" placeholder="Número" v-model="socio.numero"  class="input h-8 w-full">
                                </div>   

                                <div class="flex-initial p-1 w-40">
                                    <label class="label">
                                    <span class="label-text  text-gray-400">Complemento</span>
                                    </label> 
                                    <input type="text" placeholder="Complemento" v-model="socio.complemento"  class="input h-8 w-full">
                                </div>   
                                <div class="flex-initial p-1 w-52">
                                    <label class="label">
                                    <span class="label-text  text-gray-400">Bairro</span>
                                    </label> 
                                    <input type="text" placeholder="Bairro" v-model="socio.bairro"  class="input h-8 w-full">
                                </div>      
                                <div class="flex-initial p-1 w-36">
                                    <label class="label">
                                    <span class="label-text  text-gray-400">CEP</span>
                                    </label> 
                                    <input type="text" placeholder="Bairro" v-model="socio.cep"  class="input h-8 w-full">
                                </div>                                                              

                            </div>       

                            <div class="flex flex-wrap">


  
                                <div class="flex-initial p-1 w-30">
                                    <label class="label">
                                    <span class="label-text  text-gray-400">Celular</span>
                                    </label> 
                                    <input type="text" placeholder="Celular" v-model="socio.celular"  class="input h-8 w-full">
                                </div>  

                                <div class="flex-initial p-1 w-56">
                                    <label class="label">
                                    <span class="label-text  text-gray-400">email</span>
                                    </label> 
                                    <input type="text" placeholder="email" v-model="socio.email"  class="input h-8 w-full">
                                </div>   

                                <div class="flex-initial p-1 w-30">
                                    <label class="label">
                                    <span class="label-text  text-gray-400">Plano</span>
                                    </label> 
                                    <input type="text" placeholder="Plano"  v-model="socio.plano"  class="input h-8 w-full">
                                </div>  

                                <div class="flex-initial p-1 w-30">
                                    <label class="label">
                                    <span class="label-text  text-gray-400">Status</span>
                                    </label> 
                                    <input type="text" placeholder="Status" v-model="socio.status_detail"  class="input h-8 w-full">
                                </div>                                        

                            </div>   
                                                                          

                        </div>

                        <div class="p-2 card " id="tab_2">Pagamentos </div>
                        <div class="p-2 card " id="tab_3"> Transações</div>
                        <div class="p-2 card " id="tab_4"> Atendimento</div>
                        <div class="p-2 card " id="tab_5"> Carteirinhas</div>
                        <div class="p-2 card " id="tab_6">

                            <div class="overflow-x-auto" v-if="dependents.length > 0">
                                <table class="table w-full">
                                    <thead>
                                    <tr>
                                        <th></th> 
                                        <th>Nome</th> 
                                        <th>CPF</th> 
                                        <th>Nascimento</th>
                                        <th>Sexo</th>
                                        <th>Nome da Mãe</th>
                                    </tr>
                                    </thead> 
                                    <tbody>
                                    <tr v-for="(item, index) in dependents" :key="index">
                                        <th>1</th> 
                                        <td>{{item.nome}}</td> 
                                        <td>{{item.cpf}}</td> 
                                        <td>{{item.nascimento}}</td>
                                        <td>{{item.sexo}}</td>
                                        <td>{{item.nomemae}}</td>
                                    </tr>
                                  
                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <div class="p-2 card " id="tab_8"> Plano</div>
                        
                    </div>

        
                </div>
                


        </div>

    </div>
    <div class="modal-action">
      <!-- <label for="my-modal-2" class="btn btn-primary">Salvar</label>  -->
      <label for="my-modal-2" class="btn btn-sm">Fechar</label>
    </div>
  </div>
</div>


    </div>

</template>

<script>

import CpM from './m.vue'
import Pagination from './pagination.vue'
export default {
    data: function(){
        return{
            socios:[],
            socio:[],
            dependents:[],
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
        Pagination
    },
    methods:{
        navegacao: function(){
           $("#tab_1").css("display","block");
            $("#tab_2").css("display","none");
            $("#tab_3").css("display","none");
            $("#tab_4").css("display","none");
            $("#tab_5").css("display","none");
            $("#tab_6").css("display","none");
            $("#tab_8").css("display","none");

            $( "#nav_1" ).addClass( "tab-active" );
            $( "#nav_2" ).removeClass( "tab-active" );
            $( "#nav_3" ).removeClass( "tab-active" );
            $( "#nav_4" ).removeClass( "tab-active" );
            $( "#nav_5" ).removeClass( "tab-active" );
            $( "#nav_6" ).removeClass( "tab-active" );
            $( "#nav_8" ).removeClass( "tab-active" );
        },
        getDependend: function(id){
            let set = this;
            axios.get('get_dependent/'+id).then(response => {
                console.log(response.data);
                set.dependents = response.data;
            });
        },
        getSocios: function (){
            let set = this;
            
            axios.get('dash/cadastros').then(response => {
                console.log(response.data);
                set.socios = response.data;
            });
        },
        show: function (id){
            let set = this;
            this.navegacao();
            this.dependents = [];

            axios.get('get/cadastros/'+id).then(response => {
                console.log(response.data);
                set.socio = response.data;
            });
        },
        tab: function (id){

            $("#tab_1").css("display","none");
            $("#tab_2").css("display","none");
            $("#tab_3").css("display","none");
            $("#tab_4").css("display","none");
            $("#tab_5").css("display","none");
            $("#tab_6").css("display","none");
            $("#tab_8").css("display","none");

            $( "#nav_1" ).removeClass( "tab-active" );
            $( "#nav_2" ).removeClass( "tab-active" );
            $( "#nav_3" ).removeClass( "tab-active" );
            $( "#nav_4" ).removeClass( "tab-active" );
            $( "#nav_5" ).removeClass( "tab-active" );
            $( "#nav_6" ).removeClass( "tab-active" );
            $( "#nav_8" ).removeClass( "tab-active" );

            $( "#nav_"+id ).addClass( "tab-active" );

            $("#tab_"+id).css("display","block");
            
        }
    },
    computed:{

        listaFiltered: function (){

            const filter = this.configs.filter.toUpperCase()
            let list = _.orderBy(this.socios, this.configs.orderBy, this.configs.order);

                if (_.isEmpty(filter)) {
                       list =  this.lista;
                }

                list = _.filter(list, item => item.nome.indexOf(filter) >= 0);   


            if(list.length >0){

              this.resultCount = list.length

	            if (this.currentPg >= this.totalPages) {
	              this.currentPg = this.totalPages
              }
              var index = this.currentPg * this.itemsPerPage

            }
          return list.slice(index,index + this.itemsPerPage);
        },

    },
    mounted: function(){
        this.getSocios();
        
            $("#tab_2").css("display","none");
            $("#tab_3").css("display","none");
            $("#tab_4").css("display","none");
            $("#tab_5").css("display","none");
            $("#tab_6").css("display","none");
            $("#tab_8").css("display","none");
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

.bdp{
    border-left: 4px solid green;
}
.bdu{
    border-left: 4px solid orange;
}
tr td label{
    cursor: pointer;
}
</style>