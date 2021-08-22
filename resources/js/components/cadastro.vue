<template lang="">
    <div>
        <section id="cadastro1">
            <div class="header">
      

                <div class="card" >

                    <!-- etapa 1 -->
                    <div class="card-body" id="etapa1">
                        <h5 class="card-title">Seja sócio e participe</h5>
                            <p v-if="valorProposta">{{valorProposta.amount}}</p>

                        <div class="input-group mb-3 d-sm-block d-md-none">
                            <span class="input-group-text ">Plano</span>
                            <select class="form-select" v-model="plano" id="plano"  >
                                <option disabled selected>Plano</option>
                                <option value="bronze">Bronze</option>
                                <option value="prata">Prata</option>
                                <option value="ouro">Ouro</option>
                                <option value="diamante">Diamante</option>
                            </select>
                        </div>
                        <div class="input-group mb-3 d-sm-block d-md-none">
                            <span class="input-group-text">Período</span>
                            <select class="form-select" v-model="periodo" id="periodo"  >
                                <option  disabled selected>Período</option>
                                <option value="mensal">Mensal</option>
                                <option value="anual">Anual</option>
                            </select>  
                        </div>  

                        <div class="d-none d-md-block">
                            <div class="input-group mb-3  ">
                                <div class="input-group-prepend" style="width:20%">
                                    <label class="input-group-text" for="inputGroupSelect01">Plano</label>
                                </div>
                                <select class="custom-select" v-model="plano" id="plano"  style="width:30%">
                                        <option value="bronze">Bronze</option>
                                        <option value="prata">Prata</option>
                                        <option value="ouro">Ouro</option>
                                        <option value="diamante">Diamante</option>
                                </select>
                
                                <div class="input-group-prepend" style="width:20%">
                                    <span class="input-group-text">Período</span>
                                </div>
                                <select class="custom-select" v-model="periodo" id="periodo" style="width:30%" >
                                    <option value="mensal">Mensal</option>
                                    <option value="anual">Anual</option>
                                </select>  
                            </div> 
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
                            <button type="button" class="btn btn-primary" @click="steps(4)">Ir para</button>
                        </div>

                    </div>  

                    <!-- etapa 4 -->
                    <div class="card-body" id="etapa4">
                        <h5 class="card-title">Termos</h5>
                        <p v-if="dados_plano"><strong>{{dados_plano.descricao}} - {{dados_plano.amount}} - {{dados_plano.periodo}}</strong></p> 
                        <div style="max-height:240px; overflow:auto;margin-bottom:20px;" >
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                        </div>
                        <input type="checkbox" id="termos" name="termos" style = "margin-bottom:20px;">
                        <label for="termos">Aceito o Termos</label>                        

                        <div class="d-grid gap-2">
                            <button type="button" class="btn btn-primary" id="finalizar_boleto" @click="steps(5,'termos')">Ir para Pagamento</button>
                        </div>
                    </div>    


                </div> 
  
            </div>
        </section>         
    </div>
</template>

<script>
import ViaCep from 'vue-viacep'
import swal from 'sweetalert';

export default {
        data() {
            return {
                formSend:"",
                optIssue: null,
                installments:null,
                hash:null,
                plano:null,
                periodo:"",
                parcelas:"",
                area:"",
                nomemae:"",
                cpf:"26460284822",
                celular:"(11) 98648-6514",
                nome:"",
                password:"florida1809",
                email:"kinho2000@gmail.com",
                rg:"302552352",
                nascimento:"18/05/1979",
                sexo:"",
                ecivil:"",
                profissao:"PROGRAMADOR",
                cep:"",
                end:"",
                numero:"",
                complemento:"",
                bairro:"",
                cidade:"",
                uf:"",
                cartao_numero:"5031433215406351",
                cartao_nome:"",
                cartao_cpf:"26460284822",
                cartao_nasc:"18/05/1979",
                cartao_cvv:"123",
                cartao_validade_mes:"11/25",
                cartao_validade_ano:"25",
                cartao_celular:"(11) 99999-9999",
                bandeira:null,
                cardToken:null,
                url:'http://127.0.0.1:8000/',
                // url:'https://casfpic.org.br/',
                

            }
        },    
        methods: {

        
            async carregar(){
                let set = this;

    
                if(this.sessionId != null ){
                    PagSeguroDirectPayment.onSenderHashReady(function(response){
                        
                        if(response.status =="error"){
                            console.log(response.message);
                            
                            return false;
                        }
                        set.hash = response.senderHash;

                        set.setSessionId(set.sessionId);
                        set.getPaymentMethods();
            

                    });
                    
                }
            },             
            setSessionId(hash){
                PagSeguroDirectPayment.setSessionId(hash);
            },     
            getPaymentMethods(){ //pagseguro 1

                let numero = this.cartao_numero;
                    numero = numero.replace(/\s+/g, '');
                    numero = numero.substring(6,0);

                let cardnumber = numero
                if (cardnumber.length >= 6) {
                    let bin = cardnumber.substring(0,6);
                    window.Mercadopago.getPaymentMethod({
                        "bin": bin
                    }, this.setPaymentMethod);
                }          

            },      
            setPaymentMethod(status, response) { //pagseguro 2
                if (status == 200) {
                    let paymentMethod = response[0];
                    document.getElementById('paymentMethodId').value = paymentMethod.id;
                    this.bandeira = paymentMethod.id;
                    this.getIssuers(paymentMethod.id);
                } else {
                    alert(`payment method info error: ${response}`);
                }
            },           
            getIssuers(paymentMethodId) { //pagseguro 3
                window.Mercadopago.getIssuers(
                    paymentMethodId,
                    this.setIssuers
                );
            },         
            setIssuers(status, response) { //pagseguro 4
                if (status == 200) {
                    
      

                    let issuerSelect = document.getElementById('issuer');
                    let opt = document.createElement('option');
                        opt.text = "Banco Emissor";
                        opt.value = "";
                        opt.selected = "selected";                  
                        opt.disabled = true;
                        issuerSelect.appendChild(opt);  
                    response.forEach( issuer => {
                        opt = document.createElement('option');
                        opt.text = issuer.name;
                        opt.value = issuer.id;
                        issuerSelect.appendChild(opt);
                        // this.issuerSet.appendChild(opt);
                    });

                    this.getInstallments(
                        document.getElementById('paymentMethodId').value,
                        document.getElementById('transactionAmount').value,
                        issuerSelect.value
                    );

                    this.issuerSelect = issuerSelect;
                } else {
                    alert(`issuers method info error: ${response}`);
                }
            },          
            getInstallments(paymentMethodId, transactionAmount, issuerId){
                window.Mercadopago.getInstallments({
                    "payment_method_id": paymentMethodId,
                    "amount": parseFloat(transactionAmount),
                    "issuer_id": parseInt(issuerId)
                }, this.setInstallments);
            },     
            setInstallments(status, response){
                if (status == 200) {
                    document.getElementById('installments').options.length = 0;
                    

                   let opt = document.createElement('option');
                        opt.text = "Selecione a Parcela";
                        opt.value = "";
                        opt.selected = "selected";                  
                        opt.disabled = true;
                        document.getElementById('installments').appendChild(opt);
                    response[0].payer_costs.forEach( payerCost => {
                        opt = document.createElement('option');
                        opt.text = payerCost.recommended_message;
                        opt.value = payerCost.installments;
                        document.getElementById('installments').appendChild(opt);
                    });
                    this.createForm();
                } else {
                    alert(`installments method info error: ${response}`);
                }
            },       
            async getCardToken(){
                let $form = document.getElementById('paymentForm');
               await window.Mercadopago.createToken($form, this.setCardTokenAndPay);
                return false;
            },               
            setCardTokenAndPay(status, response) {
                if (status == 200 || status == 201) {
                    let form = document.getElementById('paymentForm');
                    let card = document.createElement('input');
                    card.setAttribute('name', 'token');
                    card.setAttribute('type', 'hidden');
                    card.setAttribute('value', response.id);
                    form.appendChild(card);
                    this.cardToken = response.id;
                    this.cadastro();
                } else {
                    alert("Verify filled data!\n"+JSON.stringify(response, null, 4));
                }
            },                  
         
            createForm(){
                        
                let form = document.getElementById('paymentForm');
                console.log(form);

                    
            },   
            createForm2(){

                 let issuerSelect = document.getElementById('issuer');
                     issuerSelect.setAttribute("name", "issuer2");
                     issuerSelect.setAttribute("id", "issuer2");
                                                      
                
      
                this.formSend.appendChild(issuerSelect); 

                console.log(this.formSend);
                // console.log(banco);
            },
            getBrand(){
                let set = this;
                
                let numero = this.cartao_numero;
                    numero = numero.replace(/\s+/g, '');
                    numero = numero.substring(6,0);

                    // console.log("numero "+numero);
                
                PagSeguroDirectPayment.getBrand({
                    cardBin: numero,
                    success: function(response) {
                        console.log("bandeira "+ response.brand.name);
                        
                        set.bandeira = response.brand.name;
                        if(set.periodo == "anual"){
                            console.log("periodo "+ set.periodo);
                            set.getInstallments(response.brand.name);
                        }                         
                    },
                    error: function(response) {

      
                    Object.entries(response.errors).forEach(([key, value]) => {
                        swal({
                            title: "Erro nos dados do cartão",
                            text: value,
                            icon: "error",
                            button: "OK",
                        });                                        
                    });                       
                            
                            
                                    
                    },
                    complete: function(response) {
                      
                    }
                });
            },          
                   
            async createCardToken(){
                let set = this;


                    if(this.cartao_validade){
                        let numero = this.cartao_numero;
                            numero = numero.replace(/\s+/g, '');  
                        
                        let parte = this.cartao_validade.split("/",2);
                        let mes = parte[0];
                        let ano = "20"+parte[1];
                        
                        await PagSeguroDirectPayment.createCardToken({
                            cardNumber:         numero, // Número do cartão de crédito
                            brand:              set.bandeira, // Bandeira do cartão
                            cvv:                set.cartao_cvv, // CVV do cartão
                            expirationMonth:    mes, // Mês da expiração do cartão
                            expirationYear:     ano, // Ano da expiração do cartão, é necessário os 4 dígitos.
                            success: function(response) {
                                console.log(response.card.token);
                                set.cardToken = response.card.token;
                                set.cadastro();
                            },
                            error: function(response) {
                                Object.entries(response.errors).forEach(([key, value]) => {
                                    swal({
                                        title: "Erro nos dados do cartão",
                                        text: value,
                                        icon: "error",
                                        button: "OK",
                                    });                                        
                                });     
                            },
                            complete: function(response) {
                            
                                    
                            }
                        });
                    }
                
            },   
            async pagarCartao(cardtoken){
                
            },
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
            steps(item, tipo = "") {
                
                let validacao = this.validacaoForm(item, tipo);
                if(validacao){
                   
                    $("#etapa1").css('display','none');
                    $("#etapa2").css('display','none');
                    $("#etapa3").css('display','none');
                    $("#etapa4").css('display','none');
                    $("#etapa4").css('display','none');
                    
                        $("#etapa"+item).css('display','block');

                    if(item == 5){
                        $("#etapa4").css('display','block');
                        this.cadastro();
                    }
                    if(item == 6){
                        // $("#etapa4").css('display','block');
                        // this.carregarBoleto();
                    }                    
                }
            },
            formatPrice: function(value) {
                let val = (value/1).toFixed(2).replace('.', ',')
                return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
            },      
            formatPrice2: function(value) {
                let val = (value).toFixed(2);
                return val;
            },  
            validacaoForm(item, tipo){

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

                        swal({
                            title: "Erro Informe o Plano",
                            text: "Selecione seu plano para continuar",
                            icon: "error",
                            button: "OK",
                        });                        
                        return false;
                    }                        
                    else if(this.periodo == '' || this.periodo == null){
                        swal({
                            title: "Informe o Período",
                            text: "Informe o período para continuar",
                            icon: "error",
                            button: "OK",
                        });    
                        return false;
                    }                       
                    else if (!cpf) {
                        swal({
                            title: "Informe o CPF",
                            text: "Informe o cpf para continuar",
                            icon: "error",
                            button: "OK",
                        });    
                    
                        return false;
                    }
                    else if(this.nome == ''){
                        swal({
                            title: "Informe o Nome",
                            text: "Informe o nome para continuar",
                            icon: "error",
                            button: "OK",
                        });    
                        return false;
                    }                
                    else if(!this.validaEmail() || this.email == ''){
                        swal({
                            title: "Informe o E-mail",
                            text: "Informe o e-mail para continuar",
                            icon: "error",
                            button: "OK",
                        });          
                        return false;
                    }
                    else if(this.celular.length <15){
                        swal({
                            title: "Informe o Celular",
                            text: "Informe o celular para continuar",
                            icon: "error",
                            button: "OK",
                        });    
                        return false;
                    }  
                    else if(this.password.length <6){
                        swal({
                            title: "Informe o Senha",
                            text: "Informe o senha para continuar",
                            icon: "error",
                            button: "OK",
                        });                
                        return false;
                    }       
                } else if(item == 3){
                    let ecivil   = $( "#ecivil option:selected" ).val();
                    let sexo     = $( "#sexo option:selected" ).val();
      
                    if(this.rg == ''){
                        swal({
                            title: "Informe o RG",
                            text: "Informe o rg para continuar",
                            icon: "error",
                            button: "OK",
                        });    
                        return false;
                    }                    
                    else if(this.nascimento.length <10){
                        swal({
                            title: "Informe o Nascimento",
                            text: "Informe o nascimento para continuar",
                            icon: "error",
                            button: "OK",
                        });                
                        return false;
                    }          
                    else if(this.sexo == null || this.sexo == ""){
                        swal({
                            title: "Informe o Sexo",
                            text: "Informe o sexo para continuar",
                            icon: "error",
                            button: "OK",
                        });              
                        return false;
                    }  
                    else if(this.ecivil == null || this.ecivil == ""){
                        swal({
                            title: "Informe o Estado Civil",
                            text: "Informe o estado civil para continuar",
                            icon: "error",
                            button: "OK",
                        });              
                        return false;
                    }   
                    else if(this.area == null || this.area == ""){
                        swal({
                            title: "Informe a àrea de atuação",
                            text: "Informe a àrea de atuacao para continuar",
                            icon: "error",
                            button: "OK",
                        });              
                        return false;
                    }                       
                    else if(this.profissao == '' || this.profissao == null){
                        swal({
                            title: "Informe a Profissão",
                            text: "Informe a profissão para continuar",
                            icon: "error",
                            button: "OK",
                        });    
                        return false;
                    }       
                    else if(this.nomemae == '' || this.nomemae == null){
                        swal({
                            title: "Informe o Nome da Mãe",
                            text: "Informe o Nome da Mãe para continuar",
                            icon: "error",
                            button: "OK",
                        });    
                        return false;
                    }                                      
                } else if(item == 4){
                    
                    if(this.cep == '' || this.cep == null){
                        swal({
                            title: "Informe o CEP",
                            text: "Informe o CEP para continuar",
                            icon: "error",
                            button: "OK",
                        });    
                        return false;
                    }     
                    else if(this.end == '' || this.end == null){
                        swal({
                            title: "Informe o Endereço",
                            text: "Informe o endereço para continuar",
                            icon: "error",
                            button: "OK",
                        });    
                        return false;
                    }         
                    else if(this.bairro == '' || this.bairro == null){
                        swal({
                            title: "Informe o Bairro",
                            text: "Informe o bairro para continuar",
                            icon: "error",
                            button: "OK",
                        });    
                        return false;
                    }    
                    else if(this.numero == '' || this.numero == null){
                        swal({
                            title: "Informe o Número",
                            text: "Informe o número para continuar",
                            icon: "error",
                            button: "OK",
                        });    
                        return false;
                    }   
                    else if(this.cidade == '' || this.cidade == null){
                        swal({
                            title: "Informe a Cidade",
                            text: "Informe a cidade para continuar",
                            icon: "error",
                            button: "OK",
                        });    
                        return false;
                    }      
                    else if(this.uf == '' || this.uf == null){
                        swal({
                            title: "Informe o Estado",
                            text: "Informe o estado para continuar",
                            icon: "error",
                            button: "OK",
                        });    
                        return false;
                    }                                                                                                   
                } else if(item == 5){
                    
                    if (!$('#termos').prop('checked')){
                        swal({
                            title: "Aceite os Termos",
                            text: "É necessário aceitar os termos para continuar",
                            icon: "error",
                            button: "OK",
                        });                            
                        return false;
                    }
                    

                    
                }
                
                return true;
                
  
            },    
            cadastro: function(){
                console.log("entrou cartao");
                // $('#finalizar').text('Enviando...');
                // $('#finalizar').prop('disabled', true);
                 
                let set = this;
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
                let area      = this.area;

                let cep       = this.cep;
                
                let endereco  = this.end
                let numero    = this.numero;
                let complemento   = this.complemento;
                let bairro    = this.bairro;
                let cidade    = this.cidade;
                let uf        = this.uf;



                if(this.periodo == "anual"){

                 
                  
                  
                }     

                this.$http.post(this.url+'payment/credit', {
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
                    area:           area,

                    cep:            cep,
                    endereco:       endereco,
                    bairro:         bairro,
                    numero:         numero,
                    complemento:    complemento,
                    cidade:         cidade,
                    uf:             uf,

                    _token:         csrfToken
                }).then(response => {

                    
                    
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
                    }         
                  
                    else if(response.body.error){
                        
                        Object.entries(response.body.error).forEach(([key, value]) => {
                            swal({
                                title: "Erro",
                                text: value,
                                icon: "error",
                                button: "OK",
                            });  
                            
                        });      
                        return false;
                        
                    }    
                    else {
                        
                         window.location.href = response.body;
                    }     
                    $('#finalizar').text('Finalizar Cadastro');
                    $('#finalizar').prop('disabled', false);                    
                }).catch(error => {
                    if(error.body){
                        swal({
                            title: "Erro",
                            text: error.body.message,
                            icon: "error",
                            button: "OK",
                        });      
                    }                
                    $('#finalizar').text('Finalizar Cadastro');
                    $('#finalizar').prop('disabled', false);                    
                });

                console.log("saiu cadastro");
            },     

            async carregarBoleto(){
                let set = this;

    
                if(this.sessionId != null ){
                    PagSeguroDirectPayment.onSenderHashReady(function(response){
                        
                        if(response.status =="error"){
                            console.log(response.message);
                            
                            return false;
                        }
                        set.hash = response.senderHash;

                        set.setSessionId(set.sessionId);
                        set.boleto();
            

                    });
                    
                }
            },
            boleto: function(){
                let set = this;
                  

                // $('#finalizar_boleto').text('Aguarde...');
                // $('#finalizar_boleto').prop('disabled', true);
                 
                
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
                let area      = this.area;

                let cep       = this.cep;
                
                let endereco  = this.end
                let numero    = this.numero;
                let complemento   = this.complemento;
                let bairro    = this.bairro;
                let cidade    = this.cidade;
                let uf        = this.uf;


                this.$http.post(this.url+'payment/boleto', {
                    plano:          plano,
                    periodo:        periodo,

                    payment_method: 'boleto',

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
                    profissao:      profissao,

                    cep:            cep,
                    endereco:       endereco,
                    bairro:         bairro,
                    numero:         numero,
                    complemento:    complemento,
                    cidade:         cidade,
                    uf:             uf,
                    hashseller:     set.hash,
                    
                    _token:         csrfToken
                }).then(response => {
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
                    }         
                  
                    else if(response.body.error){
                        
                        Object.entries(response.body.error).forEach(([key, value]) => {
                            swal({
                                title: "Erro",
                                text: value,
                                icon: "error",
                                button: "OK",
                            });  
                            
                        });      
                        return false;
                        
                    }    
                    else {
                        console.log(response.body);
                        // window.location.href = 'http://127.0.0.1:8000/success';
                    }     
                    $('#finalizar_boleto').text('Gerar Boleto');
                    $('#finalizar_boleto').prop('disabled', false);                    
                }).catch(error => {
                    console.log(error);
                    $('#finalizar_boleto').text('Gerar Boleto');
                    $('#finalizar_boleto').prop('disabled', false);                    
                });

                console.log("saiu cadastro boleto");
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
                let cpf = $("#docNumber").val();
  
                
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
        computed:{
            sessionId() {
                return this.$store.state.sessionId;
            },   
            dados_plano() {
                return this.$store.state.plan;
            },      
            valorProposta() {
                let total=0;
                total = this.$store.state.plan;
                return total;
            },                   
        },
        mounted: function() {

            

            // this.$store.dispatch('session_id');

            this.plano   = this.$route.query.plano
            this.periodo = this.$route.query.periodo

            console.log("periodo inicial "+ this.$route.query.periodo);

            let dados = {
                'plano': this.plano,
                'periodo': this.periodo
            }

            this.$store.dispatch('get_plan', dados);
            // console.log(this.plano + " " + this.periodo)

            $(document).ready(function($){


                $("#etapa1").css('display','block');
                $("#etapa2").css('display','none');
                $("#etapa3").css('display','none');
                $("#etapa4").css('display','none');
                

                $("#alert4_boleto").css('display','none');

                $("#alert1").css('display','none');
                $("#alert2").css('display','none');
                $("#alert3").css('display','none');
                $("#alert4").css('display','none');
                $("#alert5").css('display','none');

                
            });
        }
}
</script>
