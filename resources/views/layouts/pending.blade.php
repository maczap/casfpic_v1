		
        @extends('layouts.app')
        <!-- hero start -->
        @section('content')
             <section>
                <div class="container" style="margin-top:100px; margin-bottom:180px;">
             
                    <div class="row">
                        <div class="col-sm-12">
                        <h2 class='pgh2smart' style="margin-bottom:40px;">Pagamento Pendente</h2>
                        
                            <p style="font-weight:normal;"> <strong>{{$nome}}</strong> Desejamos boas-vindas à CASFPIC Que bom ter você com a gente!</p>
                            <p>Seu pagamento ainda está pendende, aguarde novas informações no seu e-mail.</p>

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