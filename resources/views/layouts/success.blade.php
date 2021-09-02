		
        @extends('layouts.app')
        <!-- hero start -->
        @section('content')
             <section>
                <div class="container" style="margin-top:80px; margin-bottom:180px;">

                <div class="card" style="margin:0;padding:0;">
                    <div class="card-body" style="margin:0;padding:0;">
                    @if ($status == "paid" && $periodo == "anual")
                        <div class="d-flex flex-column header justify-content-center align-items-center bg-success" style="height:200px;padding:40px;">
                            <h3 class="card-title text-white">Pronto! Você já contratou {{$plano}}</h3>
                        </div>
                    @endif

                    @if ($status == "paid" && $periodo == "mensal")
                        <div class="d-flex flex-column header justify-content-center align-items-center bg-success" style="height:200px;padding:40px;">
                            <h3 class="card-title text-white">Pronto! Você já assinou {{$plano}}</h3>
                        </div>
                    @endif                    

                    @if ($status != "paid" && $status != "refunded" )
                        <div class="d-flex flex-column header justify-content-center align-items-center bg-primary" style="height:200px;padding:40px;">
                            <h3 class="card-title text-white">{{$nome}}, estamos processando seu pagamento</h3>
                            <h5 class="text-white">No momento ele está com o status ({{$status_detail}})</h5>
                            <p class="text-white">Aguarde! Novas atualizações do seu pagamento será enviada por e-mail.</p>

                        </div>
                    @endif                    

                    @if ($status == "refunded")
                        <div class="d-flex flex-column header justify-content-center align-items-center bg-danger" style="height:200px;padding:40px;">
                            <h3 class="card-title text-white">{{$nome}}, Tivemos problema com sua transação</h3>

                            <h5 class="text-white">Mas não se preocupe, entre em contato para tentarmos com outra forma de pagamento </h5>
                        </div>
                    @endif                    
                        <div style="padding:40px;">
                        <p>{{$nome}}, desejamos boas-vindas à CASFPIC. Que bom ter você com a gente!</p>
                        @if ($status == "paid")
                           
                            <p>A partir do 1° dia do mês subsequente você já poderá usufruir do primeiro benefício de Assistência Odontológica Privada com base nos regulamentos junto ANS – AGÊNCIA NACIONAL DE SAÚDE SUPLEMENTAR – www.ans.gov.br</p></p>
                            <p>Até o último dia do mês vigente receberá via correio eletrônico ou via postal as seguintes informações:</p>
                            <p>
                            <ul>
                                <li>1. Documento de identificação (carteirinha) eletrônica ou plástica.</li>
                                <li>2. Garantias de atendimentos conforme a Adesão Associativa, digo, BRONZE, PRATA, OURO E DIAMANTE – www.casfpic.org.br</li>
                                <li>3. Rede credenciada dos profissionais disponíveis na sua cidade ou região na qual a sua utilização é sem carências e em conformidade com os agendamentos dos profissionais credenciados, ratificando que o atendimento eletivo é em âmbito NACIONAL.</li>
                                <li>4. Boleto ou outras formas de pagamento caso a sua opção for mensal.</li>
                                
                            </ul>   
                            
                            </p>
                            <p>O estatuto e as regras associativas da caixa estão disponíveis no nosso website www.casfpic.org.br</p>                      
                            <p>Ah, e você pode acompanhar o envido do manual de utilização e carteirinha por e-mail, e se tiver alguma dúvida, utilize os canais de comunicação abaixo sempre que quiser! 📲</p>                           
                        @endif
                            <p>Para maiores esclarecimentos disponibilizamos os seguintes canais:</p>
                            <ul>
                                <li>Telefone: (11) 2840-1377</li>
                                <li>WhatsApp: (11) 94022-7390</li>
                                <li>E-mail: contato@casfpic.org.br</li>
                            </ul>
                        </div>
                        
                        
                    </div>
                </div>                
             

                </div>
             </section>
        @endsection