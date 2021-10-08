
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
                                            <input type="text" placeholder="" v-model="promotor.name" class="input w-full h-9">
                                        </div>

                                        <div class="flex-initial p-1">
                                            <label class="label">
                                            <span class="label-text  text-gray-400">CPF</span>
                                            </label> 
                                            <input type="text" placeholder="" v-model="promotor.cpf" class="input w-full h-9">
                                        </div>

                                        <div class="flex-initial p-1">
                                            <label class="label">
                                            <span class="label-text  text-gray-400">RG</span>
                                            </label> 
                                            <input type="text" placeholder="" v-model="promotor.rg" class="input w-full h-9">
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
                                            <input type="text" placeholder="" class="input w-full h-9">
                                        </div>   

                                        <div class="flex-1 p-1">
                                            <label class="label">
                                            <span class="label-text  text-gray-400">Profissão</span>
                                            </label> 
                                            <input type="text" placeholder="" v-model="promotor.profissao" class="input w-full h-9">
                                        </div>                                  
                                                

                                    </div>   


                                    <div class="flex flex-wrap">

                                        <div class="flex-1 p-1 w-2">
                                            <label class="label">
                                            <span class="label-text  text-gray-400">Endereço</span>
                                            </label> 
                                            <input type="text" placeholder="" v-model="promotor.endereco"  class="input w-full h-9">
                                        </div>  

                                        <div class="flex-initial p-1">
                                            <label class="label">
                                            <span class="label-text  text-gray-400">Numero</span>
                                            </label> 
                                            <input type="text" placeholder="" v-model="promotor.numero"  class="input  h-9">
                                        </div>   

                                        <div class="flex-initial p-1">
                                            <label class="label">
                                            <span class="label-text  text-gray-400">Complemento</span>
                                            </label> 
                                            <input type="text" placeholder="" v-model="promotor.complemento"  class="input w-full h-9">
                                        </div>   

                                    </div>       


                            <div class="flex flex-wrap">

                                <div class="flex-1 p-1">
                                    <label class="label">
                                    <span class="label-text  text-gray-400">Banco</span>
                                    </label> 
                                    <select class="select select-bordered w-full h-9 min-h-0" v-model="promotor.banco" id="banco" >
                                        <option disabled="disabled" selected="selected">Selecione o Banco</option> 
                                        <option value="001">001 - Banco do Brasil</option>
                                        <option value="003">003 - Banco da Amazônia</option>
                                        <option value="004">004 - Banco do Nordeste</option>
                                        <option value="021">021 - Banestes</option>
                                        <option value="025">025 - Banco Alfa</option>
                                        <option value="027">027 - Besc</option>
                                        <option value="029">029 - Banerj</option>
                                        <option value="031">031 - Banco Beg</option>
                                        <option value="033">033 - Banco Santander Banespa</option>
                                        <option value="036">036 - Banco Bem</option>
                                        <option value="037">037 - Banpará</option>
                                        <option value="038">038 - Banestado</option>
                                        <option value="039">039 - BEP</option>
                                        <option value="040">040 - Banco Cargill</option>
                                        <option value="041">041 - Banrisul</option>
                                        <option value="044">044 - BVA</option>
                                        <option value="045">045 - Banco Opportunity</option>
                                        <option value="047">047 - Banese</option>
                                        <option value="062">062 - Hipercard</option>
                                        <option value="063">063 - Ibibank</option>
                                        <option value="065">065 - Lemon Bank</option>
                                        <option value="066">066 - Banco Morgan Stanley Dean Witter</option>
                                        <option value="069">069 - BPN Brasil</option>
                                        <option value="070">070 - Banco de Brasília – BRB</option>
                                        <option value="072">072 - Banco Rural</option>
                                        <option value="073">073 - Banco Popular</option>
                                        <option value="074">074 - Banco J. Safra</option>
                                        <option value="075">075 - Banco CR2</option>
                                        <option value="076">076 - Banco KDB</option>
                                        <option value="096">096 - Banco BMF</option>
                                        <option value="104">104 - Caixa Econômica Federal</option>
                                        <option value="107">107 - Banco BBM</option>
                                        <option value="116">116 - Banco Único</option>
                                        <option value="175">175 - Banco Finasa</option>
                                        <option value="184">184 - Banco Itaú BBA</option>
                                        <option value="204">204 - American Express Bank</option>
                                        <option value="208">208 - Banco Pactual</option>
                                        <option value="212">212 - Banco Matone</option>
                                        <option value="213">213 - Banco Arbi</option>
                                        <option value="214">214 - Banco Dibens</option>
                                        <option value="217">217 - Banco Joh Deere</option>
                                        <option value="218">218 - Banco Bonsucesso</option>
                                        <option value="222">222 - Banco Calyon Brasil</option>
                                        <option value="224">224 - Banco Fibra</option>
                                        <option value="225">225 - Banco Brascan</option>
                                        <option value="229">229 - Banco Cruzeiro</option>
                                        <option value="230">230 - Unicard</option>
                                        <option value="233">233 - Banco GE Capital</option>
                                        <option value="237">237 - Bradesco</option>
                                        <option value="241">241 - Banco Clássico</option>
                                        <option value="243">243 - Banco Stock Máxima</option>
                                        <option value="246">246 - Banco ABC Brasil</option>
                                        <option value="248">248 - Banco Boavista Interatlântico</option>
                                        <option value="249">249 - Investcred Unibanco</option>
                                        <option value="250">250 - Banco Schahin</option>
                                        <option value="252">252 - Fininvest</option>
                                        <option value="254">254 - Paraná Banco</option>
                                        <option value="263">263 - Banco Cacique</option>
                                        <option value="265">265 - Banco Fator</option>
                                        <option value="266">266 - Banco Cédula</option>
                                        <option value="300">300 - Banco de la Nación Argentina</option>
                                        <option value="318">318 - Banco BMG</option>
                                        <option value="320">320 - Banco Industrial e Comercial</option>
                                        <option value="356">356 - ABN Amro Real</option>
                                        <option value="341">341 - Itau</option>
                                        <option value="347">347 - Sudameris</option>
                                        <option value="351">351 - Banco Santander</option>
                                        <option value="353">353 - Banco Santander Brasil</option>
                                        <option value="366">366 - Banco Societe Generale Brasil</option>
                                        <option value="370">370 - Banco WestLB</option>
                                        <option value="376">376 - JP Morgan</option>
                                        <option value="389">389 - Banco Mercantil do Brasil</option>
                                        <option value="394">394 - anco Mercantil de Crédito</option>
                                        <option value="399">399 - HSBC</option>
                                        <option value="409">409 - Unibanco</option>
                                        <option value="412">412 - Banco Capital</option>
                                        <option value="422">422 - Banco Safra</option>
                                        <option value="453">453 - Banco Rural</option>
                                        <option value="456">456 - Banco Tokyo Mitsubishi UFJ</option>
                                        <option value="464">464 - Banco Sumitomo Mitsui Brasileiro</option>
                                        <option value="477">477 - Citibank</option>
                                        <option value="479">479 - Itaubank (antigo Bank Boston)</option>
                                        <option value="487">487 - Deutsche Bank</option>
                                        <option value="488">488 - Banco Morgan Guaranty</option>
                                        <option value="492">492 - Banco NMB Postbank</option>
                                        <option value="494">494 - Banco la República Oriental del Uruguay</option>
                                        <option value="495">495 - Banco La Provincia de Buenos Aires</option>
                                        <option value="495">495 - Banco Credit Suisse</option>
                                        <option value="600">600 - Banco Luso Brasileiro</option>
                                        <option value="604">604 - Banco Industrial</option>
                                        <option value="610">610 - Banco VR</option>
                                        <option value="611">611 - Banco Paulista</option>
                                        <option value="612">612 - Banco Guanabara</option>
                                        <option value="613">613 - Banco Pecunia</option>
                                        <option value="623">623 - Banco Panamericano</option>
                                        <option value="626">626 - Banco Ficsa</option>
                                        <option value="630">630 - Banco Intercap</option>
                                        <option value="633">633 - Banco Rendimento</option>
                                        <option value="634">634 - Banco Triângulo</option>
                                        <option value="637">637 - Banco Sofisa</option>
                                        <option value="638">638 - Banco Prosper</option>
                                        <option value="643">643 - Banco Pine</option>
                                        <option value="652">652 - Itaú Holding Financeira</option>
                                        <option value="653">653 - Banco Indusval</option>
                                        <option value="654">654 - Banco A.J. Renner</option>
                                        <option value="655">655 - Banco Votorantim</option>
                                        <option value="707">707 - Banco Daycoval</option>
                                        <option value="719">719 - Banif</option>
                                        <option value="721">721 - Banco Credibel</option>
                                        <option value="734">734 - Banco Gerdau</option>
                                        <option value="735">735 - Banco Pottencial</option>
                                        <option value="738">738 - Banco Morada</option>
                                        <option value="739">739 - Banco Galvão de Negócios</option>
                                        <option value="740">740 - Banco Barclays</option>
                                        <option value="741">741 - BRP</option>
                                        <option value="743">743 - Banco Semear</option>
                                        <option value="745">745 - Banco Citibank</option>
                                        <option value="746">746 - Banco Modal</option>
                                        <option value="747">747 - Banco Rabobank International</option>
                                        <option value="748">748 - Banco Cooperativo Sicredi</option>
                                        <option value="749">749 - Banco Simples</option>
                                        <option value="751">751 - Dresdner Bank</option>
                                        <option value="752">752 - BNP Paribas</option>
                                        <option value="753">753 - Banco Comercial Uruguai</option>
                                        <option value="755">755 - Banco Merrill Lynch</option>
                                        <option value="756">756 - Banco Cooperativo do Brasil</option>
                                        <option value="757">757 - KEB</option>
                                    </select>                                    
                                </div>      


                                <div class="flex-initial p-1">
                                    <label class="label">
                                    <span class="label-text  text-gray-400">Agência</span>
                                    </label> 
                                    <input type="text" placeholder="" v-model="promotor.agencia"  class="input w-36 h-9 border-1 border-gray-300">
                                </div>   

                                <div class="flex-initial p-1">
                                    <label class="label">
                                    <span class="label-text  text-gray-400">Dígito</span>
                                    </label> 
                                    <input type="text" placeholder="" v-model="promotor.agencia_dig"  class="input w-16 h-9 border-1 border-gray-300">
                                </div> 


                                <div class="flex-initial p-1">
                                    <label class="label">
                                    <span class="label-text  text-gray-400">Conta</span>
                                    </label> 
                                    <input type="text" placeholder="" v-model="promotor.conta"  class="input w-40 h-9 border-1 border-gray-300">
                                </div>    

                                <div class="flex-initial p-1">
                                    <label class="label">
                                    <span class="label-text  text-gray-400">Dígito</span>
                                    </label> 
                                    <input type="text" placeholder="" v-model="promotor.conta_dig"  class="input w-16 h-9 border-1 border-gray-300">
                                </div>        

                                <div class="flex-1 p-1">
                                    <label class="label">
                                    <span class="label-text  text-gray-400">Tipo</span>
                                    </label> 
                                    <select class="select select-bordered w-40 max-w-xs h-9 min-h-0" v-model="promotor.conta_tipo"  >
                                        <option disabled="disabled" selected="selected">Tipo</option> 
                                        <option value="conta_corrente">Corrente</option>
                                        <option value="conta_poupanca">Poupanca</option>
         
                                    </select>                                    
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