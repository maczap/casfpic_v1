		
        @extends('layouts.app')
        <!-- hero start -->
        @section('content')
             <section>
                <div class="container" style="margin-top:100px; margin-bottom:180px;">
             
                    <div class="row">
                        <div class="col-sm-12">
                        <h2 class='pgh2smart' style="margin-bottom:40px;">Pagamento efetuado com sucesso</h2>
                        
                        <p style="font-weight:normal;"> <strong>{{$nome}}</strong>, a ativação do seu plano <strong> {{$plano}}</strong> foi concluída com sucesso.</br>Desejamos boas-vindas à CASFPIC Que bom ter você com a gente!</p>
                        <p style="font-weight:normal;" >Para utilizar seu plano, basta seguir o passo a passo abaixo: </p>

                            <ul>
                                <li>Passo 1</li>
                                <li>Passo 2</li>
                                <li>Passo 3</li>
                                <li>Passo 4</li>
                                <li>Passo 5</li>
                            </ul>                        
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