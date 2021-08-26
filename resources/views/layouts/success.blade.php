		
        @extends('layouts.app')
        <!-- hero start -->
        @section('content')
             <section>
                <div class="container" style="margin-top:100px; margin-bottom:180px;">
             
                    <div class="row">
                        <div class="col-sm-12">
                        <h2 class='pgh2smart' style="margin-bottom:40px;">Pagamento efetuado com sucesso</h2>
                        
                        <p style="font-weight:normal;"> <strong>{{$nome}}</strong>, a ativação do seu plano <strong> {{$plano}}</strong> foi concluída com sucesso.</br>Desejamos boas-vindas à CASFPIC Que bom ter você com a gente!</p>
                        <p>A partir do 1° dia do mês subsequente você já poderá usufruir do primeiro benefício de Assistência Odontológica Privada com base nos regulamentos junto ANS – AGÊNCIA NACIONAL DE SAÚDE SUPLEMENTAR – www.ans.gov.br</p>
                        <p>Até o ultimo dia do mês vigente receberá via correio eletrônico ou via postal as seguintes informações:</p>

                            <ul>
                                <li>1. Documento de identificação (carteirinha) eletrônica ou plástica.</li>
                                <li>2. Garantias de atendimentos conforme a Adesão Associativa, digo, BRONZE, PRATA, OURO E DIAMANTE – www.casfpic.org.br</li>
                                <li>3. Rede credenciada dos profissionais disponíveis na sua cidade ou região na qual a sua utilização é sem carências e em conformidade com os agendamentos dos profissionais credenciados, ratificando que o atendimento eletivo é em âmbito NACIONAL.</li>
                                <li>4. Boleto ou outras formas de pagamento caso a sua opção for mensal.</li>
                                
                            </ul>  
                            <p>O estatuto e as regras associativas da caixa estão disponíveis no nosso website www.casfpic.org.br</p>                      
                        </div>
                    </div>

                    <div class="row">

                    </div>     

                    <div class="row" style="margin-top:40px;">
                        <div class="col-sm-12">
                        <h5 style="font-weight:normal;">Para maiores esclarecimentos disponibilizamos os seguintes canais:</h5>
                            <p>Telefone: (11) 2840-1377</p>
                            <p>WhatsApp: (11) 94022-7390</p>
                            <p>E-mail: contato@casfpic.org.br</p>

                        <p>Atenciosamente, </br>Equipe CASFPIC </p>

                            
                        </div>
                    </div>

                </div>
             </section>
        @endsection