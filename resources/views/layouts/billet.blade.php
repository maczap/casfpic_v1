		
        @extends('layouts.app')
        <!-- hero start -->
        @section('content')
             <section>
                <div class="container" style="margin-top:80px; margin-bottom:180px;">

                <div class="card" style="margin:0;padding:0;">
                    <div class="card-body" style="margin:0;padding:0;">
                        <div class="d-flex flex-column header justify-content-center align-items-center bg-info" style="height:200px;padding:40px;">
                            <h3 class="card-title text-white">{{$nome}}, desejamos boas-vindas à CASFPIC. </br>Que bom ter você com a gente!</h3>
                        </div>
                        
                        <div style="padding:40px;">
                            <h5 style="text-align:center;margin-bottom:40px;">Para concluir seu cadastro, efetue o pagamento do boleto</h5>

                            <p style="text-align:center;">Imprime o boleto clicando no botão abaixo ou copie o código de barras</p>

                            <p style="text-align:center;">
                                <a href="{{$boleto_url}}" target="_blank">
                                    <button type="button" class="btn btn-success btn-lg">Imprimir Boleto</button>
                                </a>
                            </p>
                            <div class="container" style="padding:20px;">
                                <div class="row">
                                    <div class="col-md-6 offset-md-3">
                                    <label for="cd_barra">Código de barras</label>
                                        <div class="input-group">
                                           
                                            <input type="text" class="form-control" id="cd_barra" value="{{$boleto_barcode}}"> 
                                            <span class="input-group-text" onclick="copiarCdBarra()" style="cursor:pointer;" id="basic-addon1">Copiar</span>
                                            
                                        </div>             
                                    </div>
                                </div> 
                            </div> 
                            <p>Ah, e após a compensação do boleto, você poderá acompanhar o envido do manual de utilização e carteirinha por e-mail, e se tiver alguma dúvida, utilize os canais de comunicação abaixo sempre que quiser! 📲</p>                           
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