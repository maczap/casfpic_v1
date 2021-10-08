<template lang="">
    <div>
        <section>
            <div class="header">
      

                <div class="card" >

                    <!-- etapa 1 -->
                    <div class="card-body" id="etapa1">
                        
                        <h5 class="card-title">Seja sócio e participe</h5>
                            

                        <div class="input-group mb-3 d-sm-block d-md-none">
                            <span class="input-group-text ">Plano</span>
                            <select class="form-select" v-model="plano" id="plano"  @change="setPlan">
                                <option value="bronze">Bronze</option>
                                <option value="prata">Prata</option>
                                <option value="ouro">Ouro</option>
                                <option value="diamante">Diamante</option>
                            </select>
                        </div>
                        <div class="input-group mb-3 d-sm-block d-md-none">
                            <span class="input-group-text">Período</span>
                            <select class="form-select" v-model="periodo" id="periodo" @change="setPlan" >
                                <option value="mensal">Mensal</option>
                                <option value="anual">Anual</option>
                            </select>  
                        </div>  

                        <div class="d-none d-md-block">
                            <div class="input-group mb-3  ">
                                <div class="input-group-prepend" style="width:20%">
                                    <label class="input-group-text" for="inputGroupSelect01">Plano</label>
                                </div>
                                <select class="custom-select" v-model="plano" id="plano"  style="width:30%" @change="setPlan">
                                        <option value="bronze">Bronze</option>
                                        <option value="prata">Prata</option>
                                        <option value="ouro">Ouro</option>
                                        <option value="diamante">Diamante</option>
                                </select>
                
                                <div class="input-group-prepend" style="width:20%">
                                    <span class="input-group-text">Período</span>
                                </div>
                                <select class="custom-select" v-model="periodo" id="periodo" style="width:30%" @change="setPlan">
                                    <option value="mensal">Mensal</option>
                                    <option value="anual">Anual</option>
                                </select>  
                            </div> 
                        </div> 

                                         

                        <div class="input-group" >
                                       <p style="text-align: center;" v-if="valorProposta">PLANO: {{dados_plano.descricao}}  R$ {{valorProposta.amount}}</p>
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
                        <div class='voltar'><i class="fas fa-angle-left"></i> Voltar</div>
                        <h5 class="card-title">Dados Cadastrais</h5>

                     
                
                        <div class="input-group mb-3">
                            <input type="phone" id="rg" v-model="rg" class="form-control col-xl-6" placeholder="RG" aria-label="rg" aria-describedby="addon-wrapping">
                            <input type="phone" id="nascimento" v-mask="'##/##/####'" v-model="nascimento" class="form-control col-xl-6" placeholder="Nascimento" aria-label="nascimento" aria-describedby="addon-wrapping">

                        </div>    

                        
                        <div class="input-group mb-3">
                            <select class="form-select col-xl-6" v-model="sexo" id="sexo" aria-label="Default select example">
                                <option value="" disabled selected>Sexo</option>
                                <option value="F">Feminino</option>
                                <option value="M">Masculino</option>
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
                        <h5 class="card-title">Termos</h5>
                        <p v-if="dados_plano"><strong>{{dados_plano.descricao}} - {{dados_plano.amount}} - {{dados_plano.periodo}}</strong></p> 
                        <div style="max-height:240px; overflow:auto;margin-bottom:20px;" >
                            <p>Declaro para todos os fins de direito, estar ciente e DE acordo com as seguintes normas, às quais me obrigo, por mim e por meus Dependentes e/ou Agregados:</p>
                            <p>a) Conhecer o Estatuto da CASFPIC, o qual está disponível para todos os associados no site   Associação, bem como respeitá-lo em toda a sua plenitude.</p>
                            <p>&nbsp&nbsp  a.1) A nome CASFPIC poderá ser utilizada com a marca SERVCLUBE DE BENEFICIOS em conjunto ou isoladamente em todos os meios de divulgação disponíveis no mercado publicitário e nas propostas/contratos firmados com os parceiros/associados.</p>
                            <p>b) A filiação se dará opcionalmente em uma das seguintes categorias:</p>
                            <p>&nbsp&nbsp  b.1) Associado Bronze: Garantida a Cobertura do Plano Odontológico Rol Mínimo de coberturas estipulado junto a ANS- Agencia Nacional de Saúde Suplementar em contratos firmados juntos a 01 (uma) Operadora de Planos Odontológico Privados;</p>
                            <p>&nbsp&nbsp  b.2) Associado Prata: Garantida a Cobertura do Plano Odontológico Rol Mínimo de coberturas estipulado junto a ANS- Agencia Nacional de Saúde Suplementar em contratos firmados juntos as 02(duas) Operadoras de Planos Odontológico Privados;</p>
                            <p>&nbsp&nbsp  b.3) Associado Ouro: Garantida a Cobertura do Plano Odontológico além Rol Mínimo de coberturas estipulado junto a ANS- Agencia Nacional de Saúde Suplementar em contratos firmados juntos a 01(uma) Operadora de Planos Odontológico Privados;</p>
                            <p>&nbsp&nbsp  b.4) Associado Diamante: Garantida a Cobertura do Plano Odontológico além Rol Mínimo de coberturas estipulado junto a ANS- Agencia Nacional de Saúde Suplementar em contratos firmados juntos as 02(duas) Operadoras de Planos Odontológico Privados.</p>
                            <p>c) Os beneficiários Dependentes e os Agregados, estão adstritos à mesma categoria, benefícios, direitos e obrigações do titular. </p>
                            <p>d) O valor da Taxa Anual/Mensal Individual será reajustado na forma e nas condições determinadas no Contrato de Plano Privado de Assistência à Saúde Plano Odontológico, celebrado entre a CASFPIC e a (s) parceira (s) mantenedora (s) do Plano/Benefício. </p>
                            <p>e) Perante a todo os envolvidos, sou o(a) único(a) responsável pela correta utilização dos serviços concedidos pela CASFPIC, além do respectivo Plano Odontológico, respondendo integralmente pelos atos por mim ou por qualquer de meus Dependentes e/ou Agregados.</p>
                            <p>f) A CASFPIC poderá recusar a adesão de qualquer pretendente que não atenda aos critérios de aceitação.</p>
                            <p>g) Mediante a aceitação da adesão e quitação da Taxa de Adesão, quando for o caso, poderá ser fornecido CARTÃO DE IDENTIFICAÇÃO aos USUÁRIOS, confeccionado pela CASFPIC, com validade de um (01) ano.</p>
                            <p>h) Para cobrir custos de emissão do cartão, impressos e postagens, será cobrada uma Taxa de Adesão, conforme tabela da CASFPIC, a qual deverá ser paga por ocasião da adesão e nas renovações.</p>
                            <p>i) A CASFPIC poderá, a seu critério exclusivo, abonar os ASSOCIADOS da Taxa de Adesão, mediante a aquisição e manutenção de produtos e serviços vinculados à “CASFPIC”.</p>
                            <p>j) Caso o ASSOCIADO, por solicitação, cancelamento decorrente do descumprimento deste regulamento ou por inadimplência de qualquer produto ou serviço vinculado à CASFPIC, deixe de fazer parte do quadro de associados, o valor da taxa de administração, não lhe será devolvido, independentemente do tempo em que permaneceu como ASSOCIADO.</p>
                            <p>k) Em produtos ou serviços cuja contratação com o fornecedor esteja vinculada diretamente à “CASFPIC”, poderá haver cobrança complementar ou agravamento do valor de aquisição, correspondente à administração e operacionalização da atividade.</p>
                            <p>l) Aceita a adesão e de posse do CARTÃO DE IDENTIFICAÇÃO, o ASSOCIADO e/ou USUÁRIO passarão a usufruir as vantagens e benefícios diretamente nos produtos e serviços oferecidos pela CASFPIC, bem como pelos “PARCEIROS”.</p>
                            <p>m) A CASFPIC, a seu critério, definirá o quadro de PARCEIROS, podendo a qualquer tempo, promover a entrada ou saída de PARCEIROS, que não atendam mais ao propósito da parceria ou aos critérios de permanência.</p>
                            <p>n) O ASSOCIADO ou USUÁRIO que na utilização dos serviços ou benefícios propostos pelos PARCEIROS sentir-se prejudicado ou mal atendido deverá, além de utilizar de seus próprios meios de questionamento, informar a CASFPIC para que conste nos critérios de avaliação e permanência de PARCEIROS, podendo, conforme a gravidade e incidência da ocorrência levá-lo à exclusão do sistema.</p>
                            <p>o) A apresentação do CARTÃO DE IDENTIFICAÇÃO, dentro de sua validade, é indispensável para a obtenção das vantagens e benefícios concedidos.</p>
                            <p>p) Os “PARCEIROS” poderão, a seu critério, além da apresentação do CARTÃO DE IDENTIFICAÇÃO, exigir outro documento que identifique o USUÁRIO ou ASSOCIADO.</p>
                            <p>q) A CASFPIC não se responsabiliza por produtos, serviços, defeitos, atendimento, omissões ou não concessão de vantagens e benefícios devidos por parte dos PARCEIROS aos ASSOCIADOS, cabendo a ele apenas o monitoramento das parcerias com vista à permanência no sistema proposto.</p>
                            <p>r) A CASFPIC não será responsável por qualquer promessa, propaganda ou divulgação que por ventura venha a ser realizada pelos PARCEIROS, cabendo aos ASSOCIADOS a verificação e aceitação dos produtos e serviços oferecidos.</p>
                            <p>s) Em caso de perda, furto, roubo ou extravio do CARTÃO DE IDENTIFICAÇÃO, caberá ao ASSOCIADO a obrigação de comunicação da ocorrência à CASFPIC, solicitando a emissão de outro cartão, mediante ao pagamento da taxa de reemissão.</p>
                            <p>t) A CASFPIC não se responsabiliza perante aos ASSOCIADOS e aos PARCEIROS pela utilização indevida do CARTÃO DE IDENTIFICAÇÃO.</p>
                            <p>u) O ASSOCIADO reconhece que o CARTÃO DE IDENTIFICAÇÃO é de propriedade do CASFPIC e se obriga a conservá-lo sob sua guarda para seu uso exclusivo, sendo nominativo e intransferível e ao devolvê-lo, caso perda a condição de ASSOCIADO.</p>
                            <p>v) O ASSOCIADO no ato de sua adesão autoriza a CASFPIC, utilizar para fins administrativos e de marketing, bem como para a execução do programa de benefícios, todos os dados fornecidos, sem a incidência de qualquer tipo de ônus, ficando o mesmo, comprometido a comunicar qualquer alteração desses dados, sob pena de exclusão da CASFPIC.</p>
                            <p>w) Todas as condições do regulamento poderão, a qualquer tempo, ser alteradas total ou parcialmente, exclusivamente a critério da CASFPIC.</p>
                            <p>x) Em caso de dúvidas sobre o Plano Odontológico, deverei entrar em contato com a CASFPIC. </p>
                            <p>y) Para a aceitação, por parte da CASFPIC, de meu pedido de exclusão, deverei ter permanecido por um período mínimo de 12 (doze) meses, juntamente com meus dependentes, se o caso e, comunica-la com antecedência mínima de 30 (trinta) dias.  Estou ciente que se, ao solicitar o cancelamento antes de 12 (doze) meses, será de minha responsabilidade a manutenção do valor do pagamento, eventuais mensalidades faltantes, até complementação do período. </p>
                            <p>z) A exclusão do ASSOCIADO e/ou seus dependentes, por parte da CASFPIC, se dará em observância ao firmado no Estatuto.</p>
                        </div>
                        <input type="checkbox" id="termos" name="termos" style = "margin-bottom:20px;">
                        <label for="termos">Aceito o Termos</label>                        

                        <div class="d-grid gap-2">
                            <button type="button" class="btn btn-primary" id="finalizar_pagto" @click="steps(5,'termos')">Ir para Pagamento</button>
                        </div>
                    </div>   
                    <div class="card-body" id="etapa5">

                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="cartao-tab" data-toggle="tab" href="#cartao" role="tab" aria-controls="cartao" arielected="true">Cartão</a>
                            </li>
                            <li class="nav-item" v-if="this.periodo == 'anual'">
                                <a class="nav-link" id="pix-tab" data-toggle="tab" href="#pix" role="tab" aria-controls="pix" aria-selected="false">PIX</a>
                            </li>                            
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#boleto" role="tab" aria-controls="profile" aria-selected="false">Boleto</a>
                            </li>
                        </ul>    

                        <div class="tab-content" style="margin-top:20px;min-height:300px">
                            <div class="tab-pane active" id="cartao" role="tabpanel" aria-labelledby="cartao-tab">
                                <div class="">
                                    <input type="phone" class="form-control" v-model="card_number" maxlength="19" id="card_number"  placeholder="Número do Cartão">
                                </div> 
                                <div class="mt-20">
                                    <input type="text" class="form-control" v-model="card_nome"  id="card_name"  placeholder="Nome do Titular do Cartão">
                                </div>    

                                <div class="input-group mt-20">
                                    <input type="phone"  id="cartao_vencimento" v-model="card_vencimento" v-mask="'##/##'"  class="form-control col-xl-6" placeholder="Vencimento" >
                                    <input type="phone" id="cartao_cvv"  v-model="card_cvv" class="form-control col-xl-6" placeholder="CVV" >

                                </div>        

                                <div class="d-grid gap-2 mt-20">
                                    <button type="button" class="btn btn-primary efetuar_pagto" id="efetuar_pagto" @click="steps(6)" >Efetuar Pagamento</button>                                                        
                                </div>
                            </div>

                            <div class="tab-pane" id="pix" role="tabpanel" aria-labelledby="pix-tab">
                                <div class="d-grid gap-2 mt-20">
                                    <button type="button" class="btn btn-primary efetuar_pagto" id="efetuar_pagto_pix" @click="steps(8)" >Gerar PIX</button>                                                        
                                </div>                                
                            </div>                               

                            <div class="tab-pane" id="boleto" role="tabpanel" aria-labelledby="boleto-tab">
                                <div class="d-grid gap-2 mt-20">
                                    <button type="button" class="btn btn-primary efetuar_pagto" id="efetuar_pagto_boleto" @click="steps(7)" >Gerar Boleto</button>                                                        
                                </div>                                
                            </div>                            
                        </div>

                    </div> 


                </div> 
  
            </div>
        </section>         
    </div>
</template>

<script>
// import $ from 'jquery';
import ViaCep from 'vue-viacep';
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
                card_number:"",
                card_nome:"",
                card_vencimento:"",
                card_cvv:"",
                
                bandeira:null,
                cardToken:null,
                method:null,
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
         
  
            createForm2(){

                 let issuerSelect = document.getElementById('issuer');
                     issuerSelect.setAttribute("name", "issuer2");
                     issuerSelect.setAttribute("id", "issuer2");
                                                      
                
      
                this.formSend.appendChild(issuerSelect); 

                
                
            },
         
            buscaCep(){
                let set = this;
                let cep = $("#cep").val();
                    cep.replace(/-/g, "");

                    
                    if(cep.length == 9){
                        this.$viaCep.buscarCep(cep).then((obj) => {
                        set.end = obj.logradouro;
                        set.bairro = obj.bairro;
                        set.cidade = obj.localidade;
                        set.uf = obj.uf;
                        
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
                        $("#etapa4").css('display','none');
                        $("#etapa5").css('display','block');
                        
                    }
                    if(item == 6){
                        let validacaoCard = this.validacaoCard();
                        if(validacaoCard){
                            this.cadastro("cartao");
                        }
                    }                    

                    if(item == 7){
                        this.cadastro("boleto");
                    }   
                    if(item == 8){
                        this.cadastro("pix");
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
            validacaoCard(){
                if(this.card_number == '' || this.card_number == null){
                        swal({
                            title: "Informe o Número do Cartão",
                            text: "Preencha todas as informações para continuar",
                            icon: "error",
                            button: "OK",
                        });                        
                        return false;
                }
                if(this.card_number.length <10){
                        swal({
                            title: "Número do Cartão Incompleto",
                            text: "Preencha todas as informações para continuar",
                            icon: "error",
                            button: "OK",
                        });                        
                        return false;
                }

                if(this.card_nome == '' || this.card_nome == null){
                        swal({
                            title: "Informe o Nome no Cartão",
                            text: "Preencha todas as informações para continuar",
                            icon: "error",
                            button: "OK",
                        });                        
                        return false;
                }       
                if(this.card_vencimento == '' || this.card_vencimento == null){
                        swal({
                            title: "Informe o Vencimento",
                            text: "Preencha todas as informações para continuar",
                            icon: "error",
                            button: "OK",
                        });                        
                        return false;
                }                  
                if(this.card_cvv == '' || this.card_cvv == null){
                        swal({
                            title: "Informe o CVV",
                            text: "Preencha todas as informações para continuar",
                            icon: "error",
                            button: "OK",
                        });                        
                        return false;
                }         
                
                return true;
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
            setPlan(){

                if(this.plano && this.periodo){

                    let dados = {
                        'plano': this.plano,
                        'periodo': this.periodo
                    }

                    this.$store.dispatch('get_plan', dados);

                } 
            },
            cadastro: function(paymentMethod){
                
                $('#efetuar_pagto').text('Aguarde...');
                $('#efetuar_pagto').prop('disabled', true);

                $('#efetuar_pagto_boleto').text('Aguarde...');
                $('#efetuar_pagto_boleto').prop('disabled', true);    

                $('#efetuar_pagto_pix').text('Aguarde...');
                $('#efetuar_pagto_pix').prop('disabled', true);                   

                finalizar_pagto
                 
                let set = this;
                let plano     = this.plano;
                let periodo   = this.periodo;
                let cpf       = this.cpf;
                let nome      = this.nome;
                let nomemae      = this.nomemae;
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
                let method    = this.method;

                let card_nome   = this.card_nome;
                let card_number = this.card_number;
                let card_vencimento = this.card_vencimento;
                let card_cvv = this.card_cvv;
                
                let dados = null;
                if(paymentMethod == "cartao"){
                    dados = {
                        plano:          plano,
                        periodo:        periodo,
                        cpf:            cpf,
                        name:           nome,
                        nomemae:        nomemae,
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

                        card_nome:      card_nome,
                        card_number:    card_number,
                        card_vencimento:card_vencimento,
                        card_cvv:       card_cvv,

                        paymentMethod:  paymentMethod,
                        _token:         csrfToken                    
                    };
                } 
                if(paymentMethod == "boleto" || paymentMethod == "pix" ){
                    dados = {
                        plano:          plano,
                        periodo:        periodo,
                        cpf:            cpf,
                        name:           nome,
                        nomemae:        nomemae,
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
                        paymentMethod:  paymentMethod,
                        _token:         csrfToken                    
                    };
                }                 

                this.$http.post('payment/credit', dados).then(response => {

                    
                    
                    if(response.body.errors){
                           Object.entries(response.body.errors).forEach(([key, value]) => {
   
                                swal({
                                        title: key,
                                        text: value[0],
                                        icon: "error",
                                        button: "OK",
                                });                                              
                            });   
                            $('#efetuar_pagto').text('Ir para Pagamentos');
                            $('#efetuar_pagto').prop('disabled', false);    
                            
                            $('#efetuar_pagto_boleto').text('Gerar Boleto');
                            $('#efetuar_pagto_boleto').prop('disabled', false);   
                            
                            $('#efetuar_pagto_pix').text('Gerar PIX');
                            $('#efetuar_pagto_pix').prop('disabled', false);                              
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
                            $('#efetuar_pagto').text('Ir para Pagamentos');
                            $('#efetuar_pagto').prop('disabled', false);   
                            $('#efetuar_pagto_boleto').text('Gerar Boleto');
                            $('#efetuar_pagto_boleto').prop('disabled', false);  
                            
                            $('#efetuar_pagto_pix').text('Gerar PIX');
                            $('#efetuar_pagto_pix').prop('disabled', false);                             
                        return false;
                        
                    }    
                    else {
                        
                         window.location.href = response.body;
                    }     
                    $('#efetuar_pagto').text('Finalizar Cadastro');
                    $('#efetuar_pagto').prop('disabled', false);   
                    $('#efetuar_pagto_boleto').text('Gerar Boleto');
                    $('#efetuar_pagto_boleto').prop('disabled', false);   
                    $('#efetuar_pagto_pix').text('Gerar PIX');
                    $('#efetuar_pagto_pix').prop('disabled', false);                                                        
                }).catch(error => {
                    if(error.body){
                        swal({
                            title: "Erro",
                            text: error.body.message,
                            icon: "error",
                            button: "OK",
                        });      
                    }                
                            $('#efetuar_pagto').text('Ir para Pagamentos');
                            $('#efetuar_pagto').prop('disabled', false);      
                            $('#efetuar_pagto_boleto').text('Gerar Boleto');
                            $('#efetuar_pagto_boleto').prop('disabled', false);   
                            $('#efetuar_pagto_pix').text('Gerar PIX');
                            $('#efetuar_pagto_pix').prop('disabled', false);                                                                 
                });

                
            },     

            async carregarBoleto(){
                let set = this;

    
                if(this.sessionId != null ){
                    PagSeguroDirectPayment.onSenderHashReady(function(response){
                        
                        if(response.status =="error"){
                            
                            
                            return false;
                        }
                        set.hash = response.senderHash;

                        set.setSessionId(set.sessionId);
                        set.boleto();
            

                    });
                    
                }
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


            this.plano   = this.$route.query.plano
            this.periodo = this.$route.query.periodo
            if(this.$route.query.method){
                this.method = this.$route.query.method
            }
            
            if(!this.plano == '' || !this.plano == null){

                let dados = {
                    'plano': this.plano,
                    'periodo': this.periodo
                }
                
                this.$store.dispatch('get_plan', dados);

            }



            $(document).ready(function(){
                  

                $("#etapa1").css('display','block');
                $("#etapa2").css('display','none');
                $("#etapa3").css('display','none');
                $("#etapa4").css('display','none');
                $("#etapa5").css('display','none');
                

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
