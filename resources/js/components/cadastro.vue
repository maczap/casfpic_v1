<template lang="">
    <div>
        <section id="cadastro1">
            <div class="header">
      

                <div class="card" style="width: 28rem;">

                    <!-- etapa 1 -->
                    <div class="card-body" id="etapa1">
                        <h5 class="card-title">Seja sócio e participe</h5>

                        <div class="input-group mb-3">
                            <span class="input-group-text">Plano</span>
                            <select class="form-select" v-model="plano" id="plano"  >
                                <option value="" disabled selected>Plano</option>
                                <option value="bronze">Bronze</option>
                                <option value="prata">Prata</option>
                                <option value="ouro">Ouro</option>
                                <option value="diamante">Diamante</option>
                            </select>

                            <span class="input-group-text">Período</span>
                            <select class="form-select" v-model="periodo" id="periodo"  >
                                <option value="" disabled selected>Período</option>
                                <option value="mensal">Mensal</option>
                                <option value="anual">Anual</option>
                            </select>  

                        </div>  
                        <div class="input-group mb-3">
                                       
                        </div>                              
                
                        <div class="input-group mb-3">
                            <input type="text" v-model="cpf" id="cpf" v-mask="'###.###.###-##'" class="form-control" placeholder="CPF" aria-label="CPF" aria-describedby="addon-wrapping">
                        </div>
                        
                        <div class="input-group mb-3">
                            
                            <input type="text" class="form-control" v-model="nome" placeholder="Nome/Nome Social" aria-label="nome" aria-describedby="addon-wrapping">
                        </div>    
                        
                        <div class="input-group mb-3">
                            <input type="email" v-model="email" id="email" class="form-control" placeholder="E-mail" aria-label="e-mail" aria-describedby="addon-wrapping">
                        </div>   
                        <div class="input-group mb-3">
                            <input type="phone" v-model="celular" class="form-control"  id="celular" v-mask="'(##) #####-####'" placeholder="Celular" aria-label="celular" aria-describedby="addon-wrapping">
                        </div>  
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" v-model="password" placeholder="Crie sua senha mínimo 6 caracteres" aria-label="celular" aria-describedby="addon-wrapping">
                        </div> 
                        <div class="alert alert-danger" role="alert" id="alert1">
                        
                        </div>                                 
                        <div class="d-grid gap-2">
                            <button type="button" class="btn btn-primary" @click="steps(2)">Iniciar Cadastro</button>
                        </div>
                    </div>

                    <!-- etapa 2 -->
                    <div class="card-body" id="etapa2">
                        <h5 class="card-title">Dados Cadastrais</h5>

                       
                
                        <div class="input-group mb-3">
                            <input type="phone" id="rg" v-model="rg" class="form-control col-xl-6" placeholder="RG" aria-label="rg" aria-describedby="addon-wrapping">
                            <input type="phone" id="nascimento" v-mask="'##/##/####'" v-model="nascimento" class="form-control col-xl-6" placeholder="Nascimento" aria-label="nascimento" aria-describedby="addon-wrapping">

                        </div>    

                        
                        <div class="input-group mb-3">
                            <select class="form-select col-xl-6" v-model="sexo" id="sexo" aria-label="Default select example">
                                <option value="" disabled selected>Sexo</option>
                                <option value="1">Feminino</option>
                                <option value="2">Masculino</option>
                            </select>                                    
                        </div>   

                        <div class="input-group mb-3">
                            <select class="form-select" v-model="ecivil" id="ecivil"  aria-label="Default select example">
                                <option value="" disabled selected>Estado Civil</option>
                                <option value="0">Solteiro</option>
                                <option value="1">Casado</option>
                                <option value="2">Separado</option>
                                <option value="3">Divorciado</option>
                                <option value="4">Viúvo</option>
                                <option value="5">Amasiado</option>
                            </select>
                        </div>

                        <div class="input-group mb-3">
                            <select class="form-select col-xl-6" v-model="area" id="area" aria-label="Default select example">
                                <option value="" disabled selected>Àrea de atuação</option>
                                <option value="1">Comercio</option>
                                <option value="2">Indústria</option>
                                <option value="3">Funcionalismo Público Municipal</option>
                                <option value="4">Funcionalismo Público Estadual</option>
                                <option value="5">Funcionalismo Público Federal</option>
             
                            </select>                                    
                        </div>                           

                        <div class="input-group mb-3">
                            <input type="text" class="form-control col-xl-6" v-model="profissao" id="profissao" placeholder="Profissão" aria-label="rg" aria-describedby="addon-wrapping">                     
                        </div>  
                        <div class="input-group mb-3">
                            <input type="text" class="form-control col-xl-12" v-model="nomemae" id="nomemae" placeholder="Nome da Mãe" aria-label="nomemae" aria-describedby="addon-wrapping">                     
                        </div>                           
                        <div class="alert alert-danger" role="alert" id="alert2">
                        
                        </div>   
                        <div class="d-grid gap-2">
                            <button type="button" class="btn btn-primary" @click="steps(3)">Continuar</button>
                        </div>

                    </div>



                    <!-- etapa 3 -->
                    <div class="card-body" id="etapa3">
                        <h5 class="card-title">Endereço</h5>
                
                        <div class="input-group mb-3">
                            <input type="text" class="form-control col-xl-6" v-mask="'#####-###'" v-model="cep" id="cep" placeholder="CEP" aria-label="cep" aria-describedby="addon-wrapping">
                            <button type="button" class="btn btn-primary" @click="buscaCep">Buscar</button>
                        </div>    
                        <div class="input-group mb-3">
                            <input type="text" class="form-control col-xl-12" v-model="end" id="end" placeholder="Endereço" aria-label="endereco" aria-describedby="addon-wrapping">
                        </div>  
                        <div class="input-group mb-3">
                            <input type="text" class="form-control col-xl-12" v-model="bairro" id="bairro" placeholder="Bairro" aria-label="endereco" aria-describedby="addon-wrapping">
                        </div>  
                        <div class="row">
                            <div class="input-group mb-3 ">
                                <input type="text" class="form-control col-xl-2" v-model="numero" id = "numero" placeholder="Número" aria-label="numero" aria-describedby="addon-wrapping">

                                <input type="text" class="form-control col-xl-10" v-model="complemento" id = "complemento" placeholder="Complemento" aria-label="complemento" aria-describedby="addon-wrapping">
                            </div>   
                        </div>
                        <div class="row">
                            <div class="input-group mb-3 col-xl-10">
                                <input type="text" class="form-control" v-model="cidade" id = "cidade" placeholder="Cidade" aria-label="cidade" aria-describedby="addon-wrapping">
                                
                            </div>

                            <div class="mb-3">
                                <select class="form-select col-xl-4" aria-label="" v-model="uf" id = "uf">
                                    <option selected >UF</option>
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

                        <div class="alert alert-danger" role="alert" id="alert3">
                        
                        </div>                     
                        <div class="d-grid gap-2">
                            <button type="button" class="btn btn-primary" @click="steps(4)">Continuar</button>
                        </div>

                    </div>  

                    <!-- etapa 4 -->
                    <div class="card-body" id="etapa4">
                        <h5 class="card-title">Forma de Pagamento</h5>

                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Cartão de Crédito</a>
                                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Boleto Bancário</a>
                                
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                
                                <div class="row">
                                    <div class="input-group mb-3 mt-3">
                                        <input type="phone" class="form-control col-xl-10" v-mask="'#### #### #### ####'" v-model="cartao_numero" id="cartao_numero" placeholder="Número Cartão" aria-label="cartao_numero" aria-describedby="addon-wrapping">
                                    </div>   

                                    <div class="input-group mb-3 ">
                                        <input type="text" class="form-control col-xl-10" v-model="cartao_nome" id="cartao_nome" placeholder="Nome no Cartão" aria-label="cartao_nome" aria-describedby="addon-wrapping">
                                    </div>   

                                    <div class="input-group mb-3 ">
                                        <input type="phone" class="form-control col-xl-6" v-mask="'###.###.###-##'" v-model="cartao_cpf" id="cartao_cpf" placeholder="CPF" aria-label="cartao_cpf" aria-describedby="addon-wrapping">
                                        <input type="phone" class="form-control col-xl-6" v-mask="'##/##/####'" v-model="cartao_nasc" id="cartao_nasc" placeholder="Nascimento" aria-label="cartao_nascimento" aria-describedby="addon-wrapping">
                                    </div>  

                                    <div class="input-group mb-3 ">
                                        <input type="phone" class="form-control col-xl-10" v-mask="'(##) #####-####'" v-model="cartao_celular" id="cartao_celular" placeholder="Celular" aria-label="cartao_celular" aria-describedby="addon-wrapping">
                                    </div> 

                                    <div class="input-group mb-3 ">
                                        <input type="phone" class="form-control col-xl-10" v-mask="'##/##'" v-model="cartao_validade" id="cartao_validade" placeholder="Validade" aria-label="cartao_validade" aria-describedby="addon-wrapping">
                                        <input type="phone" class="form-control col-xl-10" v-mask="'####'" v-model="cartao_cvv" id="cartao_cvv" placeholder="CVV" aria-label="cartao_cvv" aria-describedby="addon-wrapping">
                                    </div>            
                                    <div class="alert alert-danger" role="alert" id="alert4">
                                    
                                    </div>                                                                                                                                              
                                    <div class="d-grid gap-2">
                                        <button type="button" class="btn btn-primary" @click="steps(5)">Finalizar Cadastro</button>
                                    </div>                                                                                                                                                                                          
                                        
                                </div>
                                
                            </div>
                            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">boleto</div>
                        </div>                        
                    </div>                          


                </div> 
  
            </div>
        </section>         
    </div>
</template>

<script>
import ViaCep from 'vue-viacep'
export default {
        data() {
            return {
                plano:"",
                periodo:"",
                area:"",
                nomemae:"",
                cpf:"",
                celular:"",
                nome:"",
                password:"",
                email:"",
                rg:"",
                nascimento:"",
                sexo:"",
                ecivil:"",
                profissao:"",
                cep:"",
                end:"",
                numero:"",
                complemento:"",
                bairro:"",
                cidade:"",
                uf:"",
                cartao_numero:"",
                cartao_nome:"",
                cartao_cpf:"",
                cartao_nasc:"",
                cartao_cvv:"",
                cartao_validade:"",
                cartao_celular:"",

            }
        },    
        methods: {
            buscaCep(){
                let set = this;
                let cep = $("#cep").val();
                    cep.replace(/-/g, "");

                    console.log("cep "+cep);
                    if(cep.length == 9){
                        this.$viaCep.buscarCep(cep).then((obj) => {
                        set.end = obj.logradouro;
                        set.bairro = obj.bairro;
                        set.cidade = obj.localidade;
                        set.uf = obj.uf;
                        console.log(obj.uf);
                        });
                    }
            },            
            steps(item) {
                
                let validacao = this.validacaoForm(item);
                if(validacao){
                   
                    $("#etapa1").css('display','none');
                    $("#etapa2").css('display','none');
                    $("#etapa3").css('display','none');
                    $("#etapa4").css('display','none');

                    $("#etapa"+item).css('display','block');

                    if(item == 5){
                        $("#etapa4").css('display','block');
                    }
                }
            },

            validacaoForm(item){

                $("#alert1").css('display','none');
                $("#alert1").html("");     
                $("#alert2").css('display','none'); 
                $("#alert2").html("");                    
                $("#alert3").css('display','none');    
                $("#alert3").html("");   
                $("#alert4").css('display','none');    
                $("#alert4").html("");                     
                
                if(item == 2){
                    let cpf      = this.validaCPF();
                    if(this.plano == '' || this.plano == null){
                        $("#alert1").css('display','block');
                        $("#alert1").html("Selecione um plano");
                        return false;
                    }                        
                    else if(this.periodo == '' || this.periodo == null){
                        $("#alert1").css('display','block');
                        $("#alert1").html("Selecione um período");
                        return false;
                    }                       
                    else if (!cpf) {
                        $("#alert1").css('display','block');
                        $("#alert1").html("CPF Inválido");
                    
                        return false;
                    }
                    else if(this.nome == ''){
                        $("#alert1").css('display','block');
                        $("#alert1").html("Nome Inválido");
                        return false;
                    }                
                    else if(!this.validaEmail() || this.email == ''){
                        $("#alert1").css('display','block');
                        $("#alert1").html("E-mail Inválido");          
                        return false;
                    }
                    else if(this.celular.length <15){
                        $("#alert1").css('display','block');
                        $("#alert1").html("Celular Inválido");
                        return false;
                    }  
                    else if(this.password.length <6){
                        $("#alert1").css('display','block');
                        $("#alert1").html("Senha Inválida");             
                        return false;
                    }       
                } else if(item == 3){
                    let ecivil   = $( "#ecivil option:selected" ).val();
                    let sexo     = $( "#sexo option:selected" ).val();
      
                    if(this.rg == ''){
                        $("#alert2").css('display','block');
                        $("#alert2").html("RG Inválido");
                        return false;
                    }                    
                    else if(this.nascimento.length <10){
                        $("#alert2").css('display','block');
                        $("#alert2").html("Nascimento Inválido");             
                        return false;
                    }          
                    else if(this.sexo == null || this.sexo == ""){
                        $("#alert2").css('display','block');
                        $("#alert2").html("Sexo Inválido");             
                        return false;
                    }  
                    else if(this.ecivil == null || this.ecivil == ""){
                        $("#alert2").css('display','block');
                        $("#alert2").html("Estado Civil Inválido");             
                        return false;
                    }   
                    else if(this.profissao == '' || this.profissao == null){
                        $("#alert2").css('display','block');
                        $("#alert2").html("Profissão Inválida");
                        return false;
                    }                        
                } else if(item == 4){
                    // $("#etapa3").css('display','block');
                    console.log("etapas "+item);
                    if(this.cep == '' || this.cep == null){
                        $("#alert3").css('display','block');
                        $("#alert3").html("CEP Inválido");
                        return false;
                    }     
                    else if(this.end == '' || this.end == null){
                        $("#alert3").css('display','block');
                        $("#alert3").html("Endereço Inválido");
                        return false;
                    }         
                    else if(this.bairro == '' || this.bairro == null){
                        $("#alert3").css('display','block');
                        $("#alert3").html("Bairro Inválido");
                        return false;
                    }    
                    else if(this.numero == '' || this.numero == null){
                        $("#alert3").css('display','block');
                        $("#alert3").html("Numero Inválido");
                        return false;
                    }   
                    else if(this.cidade == '' || this.cidade == null){
                        $("#alert3").css('display','block');
                        $("#alert3").html("Cidade Inválida");
                        return false;
                    }      
                    else if(this.uf == '' || this.uf == null){
                        $("#alert3").css('display','block');
                        $("#alert3").html("UF Inválida");
                        return false;
                    }                                                                                                   
                } else if(item == 5){

                    let numero_cartao = this.cartao_numero.replace(/\s/g, '');
                    let validade_cartao = this.cartao_validade.replace(/\//g, '');
                    let cpf_cartao = this.validaCPFCARTAO();
                    let cvv_cartao        = $("#cartao_cvv").val();
                    if(numero_cartao.length < 16){
                            $("#alert4").css('display','block');
                            $("#alert4").html("Cartão Inválido");                                  
                        return false;
                    }       
                    else if(this.cartao_nome == '' || this.cartao_nome == null){
                        $("#alert4").css('display','block');
                        $("#alert4").html("Informe ao nome no cartão");
                        return false;
                    }          
                    else if (!cpf_cartao) {
                        $("#alert4").css('display','block');
                        $("#alert4").html("CPF no cartão Inválido");
                        return false;
                    }            
                    else if(this.cartao_nasc.length <10){
                        $("#alert4").css('display','block');
                        $("#alert4").html("Nascimento Inválido");             
                        return false;
                    }            
                    else if(this.cartao_celular.length <15){
                        $("#alert4").css('display','block');
                        $("#alert4").html("Celular Inválido");
                        return false;
                    }                                   
                    else if(validade_cartao.length < 4){
                        $("#alert4").css('display','block');
                        $("#alert4").html("Validade Inválida");
                        return false;
                    }    
                    else if(cvv_cartao.length < 3){
                        $("#alert4").css('display','block');
                        $("#alert4").html("CVV Inválido");
                        return false;
                    }      
                    else{
                        this.cadastro();
                        return true;
                    }                 
                    
                }
                return true;
                
  
            },    
            cadastro:function(){
                //  $("#etapa3").css('display','block');
                let plano     = this.plano;
                let periodo   = this.periodo;
                let cpf       = this.cpf;
                let nome      = this.nome;
                let email     = this.email;
                let celular   = this.celular;
                let senha     = this.password;

                let rg        = this.rg;
                let nascimento= this.nascimento;
                let sexo      = this.sexo;
                let ecivil    = this.ecivil;
                let profissao = this.profissao;

                let cep       = this.cep;
                
                let endereco  = this.end
                let numero    = this.numero;
                let complemento   = this.complemento;
                let bairro    = this.bairro;
                let cidade    = this.cidade;
                let uf        = this.uf;
                

                this.$http.post('/cadastro', {
                    plano:          plano,
                    periodo:        periodo,
                    cpf:            cpf,
                    name:           nome,
                    email:          email,
                    celular:        celular,
                    senha:          senha,

                    rg:             rg,
                    nascimento:     nascimento,
                    sexo:           sexo,
                    ecivil:         ecivil,
                    profissao:      profissao,

                    cep:            cep,
                    endereco:       endereco,
                    bairro:         bairro,
                    numero:         numero,
                    complemento:    complemento,
                    cidade:         cidade,
                    uf:             uf,

                    payment_method: 'credit_card',
                                        
                    _token:         csrfToken
                }).then(response => {
                    console.log(response);
                }).catch(error => {
      
                });
            },     
            validaCPF: function(){
                let cpf = $("#cpf").val();
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
            validaCPFCARTAO: function(){
                let cpf = $("#cartao_cpf").val();
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
            validaEmail: function(){
                let email = $("#email").val();
                var filter  = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                if (filter.test(email)) {
                    return true;
                }
                return false;
            },                          

        },
        created: function(){

        },
        mounted: function() {

            this.plano   = this.$route.query.plano
            this.periodo = this.$route.query.periodo
            // console.log(this.plano + " " + this.periodo)

            $(document).ready(function($){

                // $("#etapa1").css('display','none');
                $("#etapa2").css('display','none');
                $("#etapa3").css('display','none');
                $("#etapa4").css('display','none');

                $("#alert1").css('display','none');
                $("#alert2").css('display','none');
                $("#alert3").css('display','none');
                $("#alert4").css('display','none');

                
            });
        }
}
</script>
