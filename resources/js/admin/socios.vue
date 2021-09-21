
<template>
    <div>
        <div class='w-full bg-gray-200 p-4 topo'>
            <h1>Associados</h1>
            <cp-m></cp-m>
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
  <div class="modal-box" style="max-width:80%">
    <div class="flex flex-col">
        <div class="w-full" v-if="socio">

                <h1 class="p-2 font-semibold text-lg">{{socio.name}}</h1>

                <div class="tabs">
                <a class="tab tab-lifted tab-active">Cadastro</a> 
                <a class="tab tab-lifted ">Pagamentos</a> 
                <a class="tab tab-lifted">Transações</a>
                </div>


                <div class="grid grid-cols-12 bg-base-200">
                    <div class="col-span-12">

                        <div class="p-2 card ">
                            <div class="flex flex-wrap">

                                <div class="flex-1 p-2 w-2">
                                    <label class="label">
                                    <span class="label-text">Nome</span>
                                    </label> 
                                    <input type="text" placeholder="Nome" v-model="socio.name" class="input w-full">
                                </div>

                                <div class="flex-initial p-2">
                                    <label class="label">
                                    <span class="label-text">CPF</span>
                                    </label> 
                                    <input type="text" placeholder="CPF" v-model="socio.cpf" class="input w-full">
                                </div>

                                <div class="flex-initial p-2">
                                    <label class="label">
                                    <span class="label-text">RG</span>
                                    </label> 
                                    <input type="text" placeholder="RG" v-model="socio.rg" class="input w-full">
                                </div>       

                            </div>

                            <div class="flex flex-wrap">

  
                                <div class="flex-1 p-2">
                                    <label class="label">
                                    <span class="label-text">Sexo</span>
                                    </label> 
                                    <input type="text" placeholder="username" class="input w-full">
                                </div>  

                                <div class="flex-1 p-2">
                                    <label class="label">
                                    <span class="label-text">Estado Civil</span>
                                    </label> 
                                    <input type="text" placeholder="username" class="input w-full">
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
                                    <input type="text" placeholder="Profissão" v-model="socio.profissao" class="input w-full">
                                </div>                                  
                                          

                            </div>   


                            <div class="flex flex-wrap">

  
                                <div class="flex-1 p-2 w-2">
                                    <label class="label">
                                    <span class="label-text">Endereço</span>
                                    </label> 
                                    <input type="text" placeholder="Endereço" v-model="socio.endereco"  class="input w-full">
                                </div>  

                                <div class="flex-initial p-2">
                                    <label class="label">
                                    <span class="label-text">Numero</span>
                                    </label> 
                                    <input type="text" placeholder="Número" v-model="socio.numero"  class="input">
                                </div>   

                                <div class="flex-initial p-2">
                                    <label class="label">
                                    <span class="label-text">Complemento</span>
                                    </label> 
                                    <input type="text" placeholder="Complemento" v-model="socio.complemento"  class="input w-full">
                                </div>   

                            </div>       

                            <div class="flex flex-wrap">

                                <div class="flex-1 p-2 w-1">
                                    <label class="label">
                                    <span class="label-text">Nome da Mãe</span>
                                    </label> 
                                    <input type="text" placeholder="Nome da Mãe" v-model="socio.nomemae"  class="input w-full">
                                </div>  
  
                                <div class="flex-1 p-2">
                                    <label class="label">
                                    <span class="label-text">Celular</span>
                                    </label> 
                                    <input type="text" placeholder="Celular" v-model="socio.celular"  class="input w-full">
                                </div>  

                                <div class="flex-1 p-2">
                                    <label class="label">
                                    <span class="label-text">email</span>
                                    </label> 
                                    <input type="text" placeholder="email" v-model="socio.email"  class="input w-full">
                                </div>   

                            </div>   

                            <div class="flex flex-wrap">

                                <div class="flex-1 p-2 w-1">
                                    <label class="label">
                                    <span class="label-text">Plano</span>
                                    </label> 
                                    <input type="text" placeholder="Plano"  v-model="socio.plano"  class="input w-full">
                                </div>  

                                <div class="flex-1 p-2">
                                    <label class="label">
                                    <span class="label-text">Status</span>
                                    </label> 
                                    <input type="text" placeholder="Status" v-model="socio.status_detail"  class="input w-full">
                                </div>                                  
  
                                <div class="flex-1 p-2">
                                    <label class="label">
                                    <span class="label-text">Promotor</span>
                                    </label> 
                                    <input type="text" placeholder="username" v-model="socio.promotor"  class="input w-full">
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
import Pagination from './pagination.vue'
export default {
    data: function(){
        return{
            socios:[],
            socio:[],
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
        getSocios: function (){
            let set = this;
            axios.get('dash/cadastros').then(response => {
                console.log(response.data);
                set.socios = response.data;
            });
        },

        show: function (id){
            let set = this;
            axios.get('get/cadastros/'+id).then(response => {
                console.log(response.data);
                set.socio = response.data;
            });
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