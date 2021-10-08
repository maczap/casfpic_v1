<template>
    <div>
               
        <input type="checkbox" id="pro-adicionar" class="modal-toggle"> 
        <div class="modal">
            <div class="modal-box h-4/5" style="max-width:80%">
                <h1 class="p-2 font-semibold text-lg">Cadastro de promotores</h1>
                <div class="grid grid-cols-12 bg-base-200">
                    <div class="col-span-12">

                        <div class="p-2 card " id="tab_1">

                            <div class="flex flex-wrap">

                                <div class="flex-1 p-1 w-2">
                                    <label class="label">
                                    <span class="label-text  text-gray-400 ">Nome</span>
                                    </label> 
                                    <input type="text" placeholder="Nome" v-model="promotor.name" class="input w-full h-9 b-1 border-1 border-gray-300">
                                </div>

                                <div class="flex-initial p-1">
                                    <label class="label">
                                    <span class="label-text  text-gray-400">CPF</span>
                                    </label> 
                                    <input type="text" placeholder="" v-mask="'###.###.###-##'"  v-model="promotor.cpf" class="input w-full h-9  border-1 border-gray-300">
                                </div>

                                <div class="flex-initial p-1">
                                    <label class="label">
                                    <span class="label-text  text-gray-400">RG</span>
                                    </label> 
                                    <input type="text" placeholder="RG" v-model="promotor.rg" class="input w-full h-9  border-1 border-gray-300">
                                </div>                                  

                            </div>

                            <div class="flex flex-wrap">

                                <div class="flex-1 p-1">
                                    <label class="label">
                                    <span class="label-text  text-gray-400">Sexo</span>
                                    </label> 
                                    <select class="select select-bordered w-full max-w-xs h-9 min-h-0" v-model="promotor.sexo" id="sexo" >
                                        <option disabled="disabled" selected="selected">Sexo</option> 
                                        <option value="F">Feminino</option>
                                        <option value="M">Masculino</option>
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
                                    <input type="phone" placeholder="" v-mask="'##/##/####'" v-model="promotor.nascimento"  class="input w-full h-9  border-1 border-gray-300">
                                </div>   

                                <div class="flex-1 p-1">
                                    <label class="label">
                                    <span class="label-text  text-gray-400">Profissão</span>
                                    </label> 
                                    <input type="text" placeholder="Profissão" v-model="promotor.profissao" class="input w-full h-9  border-1 border-gray-300">
                                </div>        


                                <div class="flex-initial p-1 ">
                                   
                                        <label class="label">
                                        <span class="label-text  text-gray-400">CEP</span>
                                        </label> 
                                     <div class="relative">
                                        <input type="text" placeholder="" v-mask="'#####-###'"  v-model="promotor.cep"  class="input h-9  border-1 border-gray-300">
                                        <button class="absolute top-0 right-0 rounded-l-none btn btn-primary min-h-0 h-9 " @click="buscaCep">Buscar</button>
                                    </div>
                                </div>                                                                

                            </div>    


                            <div class="flex flex-wrap">
                             

                                <div class="flex-1 p-1">
                                    <label class="label">
                                    <span class="label-text  text-gray-400">Endereço</span>
                                    </label> 
                                    <input type="text" placeholder="" v-model="promotor.endereco"  class="input w-full h-9  border-1 border-gray-300">
                                </div>  

                                <div class="flex-initial p-1">
                                    <label class="label">
                                    <span class="label-text  text-gray-400">Numero</span>
                                    </label> 
                                    <input type="text" placeholder="" v-model="promotor.numero"  class="input w-24 h-9  border-1 border-gray-300">
                                </div>   

                                <div class="flex-1 p-1">
                                    <label class="label">
                                    <span class="label-text  text-gray-400">Complemento</span>
                                    </label> 
                                    <input type="text" placeholder="" v-model="promotor.complemento"  class="input w-full h-9 border-1 border-gray-300">
                                </div>   

                            </div>
                            <div class="flex flex-wrap">                 

                                <div class="flex-1 p-1">
                                    <label class="label">
                                    <span class="label-text  text-gray-400">Bairro</span>
                                    </label> 
                                    <input type="text" placeholder="" v-model="promotor.bairro"  class="input w-full h-9 border-1 border-gray-300">
                                </div>      
                                <div class="flex-1 p-1">
                                    <label class="label">
                                    <span class="label-text  text-gray-400">Cidade</span>
                                    </label> 
                                    <input type="text" placeholder="" v-model="promotor.cidade"  class="input w-full h-9 border-1 border-gray-300">
                                </div>  

                                <div class="flex-1 p-1">
                                    <label class="label">
                                    <span class="label-text  text-gray-400">UF</span>
                                    </label> 
                                        <select class="select select-bordered w-full max-w-xs h-9 min-h-0 " v-model="promotor.uf" id="uf" >
                                            <option value="">Selecione</option>
                                            <option value="AC">Acre</option>
                                            <option value="AL">Alagoas</option>
                                            <option value="AP">Amapá</option>
                                            <option value="AM">Amazonas</option>
                                            <option value="BA">Bahia</option>
                                            <option value="CE">Ceará</option>
                                            <option value="DF">Distrito Federal</option>
                                            <option value="ES">Espirito Santo</option>
                                            <option value="GO">Goiás</option>
                                            <option value="MA">Maranhão</option>
                                            <option value="MS">Mato Grosso do Sul</option>
                                            <option value="MT">Mato Grosso</option>
                                            <option value="MG">Minas Gerais</option>
                                            <option value="PA">Pará</option>
                                            <option value="PB">Paraíba</option>
                                            <option value="PR">Paraná</option>
                                            <option value="PE">Pernambuco</option>
                                            <option value="PI">Piauí</option>
                                            <option value="RJ">Rio de Janeiro</option>
                                            <option value="RN">Rio Grande do Norte</option>
                                            <option value="RS">Rio Grande do Sul</option>
                                            <option value="RO">Rondônia</option>
                                            <option value="RR">Roraima</option>
                                            <option value="SC">Santa Catarina</option>
                                            <option value="SP">São Paulo</option>
                                            <option value="SE">Sergipe</option>
                                            <option value="TO">Tocantins</option>
                                        </select>                                    
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
                                    <span class="label-text  text-gray-400">PIX</span>
                                    </label> 
                                    <input type="text" placeholder="" v-model="promotor.pix"  class="input w-full h-9 border-1 border-gray-300">
                                </div>   

                               <div class="flex-1 p-1">
                                    <label class="label">
                                    <span class="label-text  text-gray-400">Celular</span>
                                    </label> 
                                    <input type="text" placeholder="" v-mask="'(##) #####-####'" v-model="promotor.celular"  class="input w-full h-9 border-1 border-gray-300">
                                </div>  

                               <div class="flex-1 p-1">
                                    <label class="label">
                                    <span class="label-text  text-gray-400">E-mail</span>
                                    </label> 
                                    <input type="text" placeholder="" v-model="promotor.email"  class="input w-full h-9 border-1 border-gray-300">
                                </div>                                                                                                  

                            </div>

                        </div>
                    </div>
                </div>

            <div class="modal-action">
            <!-- <label for="my-modal-2" class="btn btn-primary">Salvar</label>  -->
            <label class="btn btn-primary" @click="cadastro()">Cadastrar</label>
            <label for="pro-adicionar" class="btn ">Fechar</label>
            </div>                

            </div>
        </div>


    </div>
</template>

<script>

import ViaCep from 'vue-viacep';
import swal from 'sweetalert';

export default {
    
    data: function(){
        return{
            promotor:{
                name:'',
                cpf:'',
                rg:'',
                sexo:'',
                ecivil:'',
                nascimento:'',
                profissao:'',
                cep:'',
                endereco:'',
                numero:'',
                complemento:'',
                bairro:'',
                cidade:'',
                uf:'',
                banco:'',
                agencia:'',
                agencia_dig:'',
                conta:'',
                conta_dig:'',
                conta_tipo:'',
                pix:'',
                celular:'',
                email:'',
                _token: csrfToken                   
                
            }
     
        }
    },  

    methods: {

        reset(){
            this.promotor.name = null;
            this.promotor.cpf = null;
            this.promotor.rg = null;
            this.promotor.sexo = null;
            this.promotor.ecivil = null;
            this.promotor.nascimento = null;
            this.promotor.profissao = null;
            this.promotor.cep = null;
            this.promotor.endereco = null;
            this.promotor.numero = null;
            this.promotor.complemento = null;
            this.promotor.bairro = null;
            this.promotor.cidade = null;
            this.promotor.uf = null;
            this.promotor.banco = null;
            this.promotor.agencia = null;
            this.promotor.agencia_dig = null;
            this.promotor.conta = null;
            this.promotor.conta_dig = null;
            this.promotor.conta_tipo = null;
            this.promotor.pix = null;
            this.promotor.celular = null;
            this.promotor.email = null;                 
                
            
        },

        cadastro(){
            let validacao = this.validacao();
            let set = this;
            if(validacao){

                  let dados = {
                        cpf:        this.promotor.cpf,
                        rg:         this.promotor.rg,
                        name:       this.promotor.name,
                        sexo:       this.promotor.sexo,
                        ecivil:     this.promotor.ecivil,
                        nascimento: this.promotor.nascimento,
                        profissao:  this.promotor.profissao,
                        cep:        this.promotor.cep,
                        endereco:   this.promotor.endereco,
                        numero:     this.promotor.numero,
                        complemento:this.promotor.complemento,
                        bairro:     this.promotor.bairro,
                        cidade:     this.promotor.cidade,
                        uf:         this.promotor.uf,
                        banco:      this.promotor.banco,
                        agencia:    this.promotor.agencia,
                        agencia_dig:this.promotor.agencia_dig,
                        conta:      this.promotor.conta,
                        conta_dig:  this.promotor.conta_dig,
                        conta_tipo: this.promotor.conta_tipo,
                        pix:        this.promotor.pix,
                        celular:    this.promotor.celular,
                        email:      this.promotor.email,
                        _token: csrfToken                    
                    };                
                this.$http.post('cadastro/promotor', dados).then(response => {
                    console.log(response);
                    
                    if(response.body.errors){
                           Object.entries(response.body.errors).forEach(([key, value]) => {
   
                                swal({
                                        title: key,
                                        text: value[0],
                                        icon: "error",
                                        button: "OK",
                                });                                              
                            });   
                         
                            return false;    
                    } else {
                        set.reset();
                        swal("Good job!", "Cadastro realizado com sucesso", "success");
                    }
                  
   
                                                    
                }).catch(error => {
                    if(error.body){
                        swal({
                            title: "Erro",
                            text: error.body.message,
                            icon: "error",
                            button: "OK",
                        });      
                    }                
                                                               
                });
            }
        },

        buscaCep(){
            let set = this;
            let cep = this.promotor.cep;
                cep.replace(/-/g, "");

                
                if(cep.length == 9){
                    this.$viaCep.buscarCep(cep).then((obj) => {
                    set.promotor.endereco = obj.logradouro;
                    set.promotor.bairro = obj.bairro;
                    set.promotor.cidade = obj.localidade;
                    set.promotor.uf = obj.uf;
                    
                    });
                }
        },             
        validacao(){

                let cpf = this.validaCPF();

                if(this.promotor.name == '' || this.promotor.name== null){
                    swal({
                        title: "Informe o Nome",
                        text: "Preencha todas as informações para continuar",
                        icon: "error",
                        button: "OK",
                    });                        
                    return false;
                }       
                
                if(this.promotor.cpf == '' || this.promotor.cpf== null){
                    swal({
                        title: "Informe o CPF",
                        text: "Preencha todas as informações para continuar",
                        icon: "error",
                        button: "OK",
                    });                        
                    return false;
                }    
                if(!cpf){
                    swal({
                        title: "Informe um CPF Válido",
                        text: "Preencha todas as informações para continuar",
                        icon: "error",
                        button: "OK",
                    });                        
                    return false;                    
                }
                
                if(this.promotor.rg == '' || this.promotor.rg== null){
                    swal({
                        title: "Informe o RG",
                        text: "Preencha todas as informações para continuar",
                        icon: "error",
                        button: "OK",
                    });                        
                    return false;
                }           
                if(this.promotor.sexo == '' || this.promotor.sexo== null){
                    swal({
                        title: "Informe o Sexo",
                        text: "Preencha todas as informações para continuar",
                        icon: "error",
                        button: "OK",
                    });                        
                    return false;
                }     
                
                if(this.promotor.ecivil == '' || this.promotor.ecivil== null){
                    swal({
                        title: "Informe o Estado Civil",
                        text: "Preencha todas as informações para continuar",
                        icon: "error",
                        button: "OK",
                    });                        
                    return false;
                }    
                if(this.promotor.nascimento == '' || this.promotor.nascimento== null){
                    swal({
                        title: "Informe o Nascimento",
                        text: "Preencha todas as informações para continuar",
                        icon: "error",
                        button: "OK",
                    });                        
                    return false;
                }     
                if(this.promotor.profissao == '' || this.promotor.profissao== null){
                    swal({
                        title: "Informe a Profissão",
                        text: "Preencha todas as informações para continuar",
                        icon: "error",
                        button: "OK",
                    });                        
                    return false;
                }      
                
                if(this.promotor.cep == '' || this.promotor.cep== null){
                    swal({
                        title: "Informe o CEP",
                        text: "Preencha todas as informações para continuar",
                        icon: "error",
                        button: "OK",
                    });                        
                    return false;
                }      
                if(this.promotor.endereco == '' || this.promotor.endereco== null){
                    swal({
                        title: "Informe o Endereço",
                        text: "Preencha todas as informações para continuar",
                        icon: "error",
                        button: "OK",
                    });                        
                    return false;
                }    
                if(this.promotor.numero == '' || this.promotor.numero== null){
                    swal({
                        title: "Informe o Número",
                        text: "Preencha todas as informações para continuar",
                        icon: "error",
                        button: "OK",
                    });                        
                    return false;
                }       
                if(this.promotor.bairro == '' || this.promotor.bairro== null){
                    swal({
                        title: "Informe o Bairro",
                        text: "Preencha todas as informações para continuar",
                        icon: "error",
                        button: "OK",
                    });                        
                    return false;
                }   

                if(this.promotor.cidade == '' || this.promotor.cidade== null){
                    swal({
                        title: "Informe a Cidade",
                        text: "Preencha todas as informações para continuar",
                        icon: "error",
                        button: "OK",
                    });                        
                    return false;
                }   
                if(this.promotor.uf == '' || this.promotor.uf== null){
                    swal({
                        title: "Informe a UF",
                        text: "Preencha todas as informações para continuar",
                        icon: "error",
                        button: "OK",
                    });                        
                    return false;
                }   
                if(this.promotor.banco == '' || this.promotor.banco== null){
                    swal({
                        title: "Informe o Banco",
                        text: "Preencha todas as informações para continuar",
                        icon: "error",
                        button: "OK",
                    });                        
                    return false;
                }           
                
                if(this.promotor.agencia == '' || this.promotor.agencia== null){
                    swal({
                        title: "Informe a Agência",
                        text: "Preencha todas as informações para continuar",
                        icon: "error",
                        button: "OK",
                    });                        
                    return false;
                }   
                if(this.promotor.conta == '' || this.promotor.conta== null){
                    swal({
                        title: "Informe a Conta",
                        text: "Preencha todas as informações para continuar",
                        icon: "error",
                        button: "OK",
                    });                        
                    return false;
                }      
                 if(this.promotor.conta_tipo == '' || this.promotor.conta_tipo== null){
                    swal({
                        title: "Informe o Tipo da conta",
                        text: "Preencha todas as informações para continuar",
                        icon: "error",
                        button: "OK",
                    });                        
                    return false;
                }                       
                if(this.promotor.pix == '' || this.promotor.pix== null){
                    swal({
                        title: "Informe o PIX",
                        text: "Preencha todas as informações para continuar",
                        icon: "error",
                        button: "OK",
                    });                        
                    return false;
                }            
                if(this.promotor.celular == '' || this.promotor.celular== null){
                    swal({
                        title: "Informe o Celular",
                        text: "Preencha todas as informações para continuar",
                        icon: "error",
                        button: "OK",
                    });                        
                    return false;
                }            
                
                if(this.promotor.email == '' || this.promotor.email== null){
                    swal({
                        title: "Informe o E-mail",
                        text: "Preencha todas as informações para continuar",
                        icon: "error",
                        button: "OK",
                    });                        
                    return false;
                }                    
                
                return true;

        },
        validaCPF: function(){
                let cpf = this.promotor.cpf;
                cpf = cpf.replace(/\./g, "");
                cpf = cpf.replace(/-/g, "");
                
                
                var numeros, digitos, soma, i, resultado, digitos_iguais;
                digitos_iguais = 1;
                if (cpf.length < 11)
                    return false;
                for (i = 0; i < cpf.length - 1; i++)
                    if (cpf.charAt(i) != cpf.charAt(i + 1))
                            {
                            digitos_iguais = 0;
                            break;
                            }
                    if (!digitos_iguais)
                    {
                    numeros = cpf.substring(0,9);
                    digitos = cpf.substring(9);
                    soma = 0;
                    for (i = 10; i > 1; i--)
                            soma += numeros.charAt(10 - i) * i;
                    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
                    if (resultado != digitos.charAt(0))
                            return false;
                    numeros = cpf.substring(0,10);
                    soma = 0;
                    for (i = 11; i > 1; i--)
                            soma += numeros.charAt(11 - i) * i;
                    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
                    if (resultado != digitos.charAt(1))
                            return false;
                    return true;
                    }
                else
                    return false;
                    
            },           
    }

}
</script>