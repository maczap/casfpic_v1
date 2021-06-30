		
        @extends('layouts.app')
        <!-- hero start -->
        @section('content')
        <div >
            <section id="cadastro">
		        <div class="container header">
                     <div class="row justify-content-md-center ">
                         <div class="col-xl-5 col-sm-12 col-md-12 col-lg-7">
                            <h1>Faça parte de uma associação forte. </h1>
                            <p>A Caixa Assistencial, nasceu com o objetivo de propiciar as melhores condições de bem-estar e benefícios em Planos Odontológicos aos funcionários públicos, da Indústria e Comércio no Estado de São Paulo.</p>
                         </div>
                         <div class="col-xl-1"></div>
                         <div class="col-xl-5 col-sm-12 col-md-12 col-lg-7">

                          <!-- form -->
                          <cp-cadastro></cp-cadastro>   
                         </div>  
                                             
                     </div>     
                </div>
                
		    </section>
			<!-- hero end -->

            <!-- Service start -->
            <section id="cadastro-service-section" >
                <div class="container pt-60">
                    <div class="row justify-content-md-center ">
                        <div class="col-xl-5 col-sm-12 col-md-12 col-lg-7">
                            <h2>Benefícios para o sócio. </h2>
                            <p>Planos odontológicos e rede de descontos</p>
                            <div class="row pt-30">
                                <div class="col-xl-6">
                                   <h5>Benefícios 1</h5> 
                                   <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's</p>
                                </div>
                                <div class="col-xl-6">
                                    <h5>Benefícios 2</h5> 
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's</p>
                                </div>
                                <div class="col-xl-6">
                                    <h5>Benefícios 3</h5> 
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's</p>
                                </div>
                                <div class="col-xl-6">
                                    <h5>Benefícios 4</h5> 
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's</p>
                                </div>
                             </div>                                       
                        </div>

             
                        <div class="col-xl-5 col-sm-12 col-md-12 col-lg-5">
                        </div>
                        <div class="col-xl-12">                            

                        </div>
                    </div>
                </div>
            </section>
            <section id="contato-footer">
                <div class="container pt-60">
                    <div class="row justify-content-md-center">
                        <div class="col-xl-5 col-sm-12 col-md-12 col-lg-7">
                            <h2 class="ft-marrom">Ficou com alguma dúvida? Fale Conosco!</h2>

                        <div class="row">
                            <div class="col-xl-3">
                            <img src="http://casfpic.org.br/images/icons/whatsapp.png" style="width:50px;" alt="">
                                
                            </div>
                            <div class="col-xl-6 ">
                                <h5 class="ft-marrom">Whatsapp</h5>
                                <p class="ft-marrom">(11) 2840-1377</p>
                            </div>
                        </div>  

                        <div class="row">
                            <div class="col-xl-3">
                            <img src="http://casfpic.org.br/images/icons/phone.png" style="width:50px;" alt="">
                                
                            </div>
                            <div class="col-xl-6 ">
                                <h5 class="ft-marrom">Telefone</h5>
                                <p class="ft-marrom">(11) 2840-1377</p>
                            </div>
                        </div>   

                        <div class="row">
                            <div class="col-xl-3">
                            <img src="http://casfpic.org.br/images/icons/email.png" style="width:50px;" alt="">
                                
                            </div>
                            <div class="col-xl-6 ">
                                <h5 class="ft-marrom">E-mail</h5>
                                <p class="ft-marrom">contato@casfpic.org.br</p>
                            </div>
                        </div>  

                        <div class="row">
    
                            <div class="col-xl-12 ">
                                <p class="ft-marrom">Atendimento: Seg à Sex – 09h às 17h</p>
                                
                            </div>
                        </div>                                                                         

                        </div>
                        <div class="col-xl-5 col-sm-12 col-md-12 col-lg-5">
                        </div>                        
                    </div>
                </div>
            </section>    
            

            @endsection

            

            @section('footer')
                

            @endsection
        