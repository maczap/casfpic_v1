		
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
                            <h4 style="text-align:center;margin-bottom:40px;">Recebemos seu cadastro! Nas próximas horas enviaremos o boleto da sua mensalidade por WhatsApp</h4>

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