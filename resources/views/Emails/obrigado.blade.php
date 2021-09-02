<table style="background: #f5f5f5;" border="0" width="100%" cellspacing="0" cellpadding="12">
<tbody>
<tr>
<td>
<div style="overflow: hidden;">
<table style="background-color: #ffffff; font-family: Arial,sans-serif; height: 55px; max-width: 600px;" width="100%" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr>
<td style="padding: 8px 24px;"><img style="display: block; max-height: 100%; width: 86px; border: 0px;" src="https://casfpic.org.br/images/hero/logo-email.png" alt="logo afuse" border="0" /></td>
</tr>
<tr>
<td style="padding: 8px 24px; background-color: #f35a24;">
<table style="width: 100%; max-width: 482px; margin: 0px auto;" role="presentation" border="0" width="100%" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr>
<td style="margin: 0px; padding: 48px 10px;" align="center" valign="middle"><span style="color: #ffffff; font-family: 'Proxima Nova',_apple_system,'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif; font-size: 26px; font-weight: 600; line-height: 1.21;">Ol&aacute; {{$nome}} <br />Seja muito bem vindo(a)</span></td>
</tr>
</tbody>
</table>
</td>
</tr>
<tr>
<td style="border: 0px; font-size: 12px; margin: 0px; padding: 0px; vertical-align: top; text-align: center; background: url('http://casfpic.org.br/images/email-barra-vertical.png') left top repeat-x; background-color: #f35a241;" align="center" width="100%" height="100%">
<table style="width: 100%; max-width: 560px; overflow: hidden; margin: 0px auto;" role="presentation" width="100%" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr>
<td class="content" style="background: #ffffff; padding: 5px 34px; border-top-left-radius: 10px; border-top-right-radius: 10px; text-align: left;" align="center">
<p>&nbsp;</p>
<p style="text-align: center;"><strong>Seu Cadastro foi realizado com sucesso</strong></p>
<p>&nbsp;</p>
@if ($method == "boleto")
<p><strong>*IMPORTANTE:</strong> Após a compensação do boleto, voc&ecirc; receber&aacute; outro e-mail avisando sobre a libera&ccedil;&atilde;o do seu plano.&nbsp;</p>
<p>Clique no link abaixo para imprimir seu boleto.</p>
<p style="text-align: center; padding: 10px;">
<span style="color: #000000;"><strong><a class="waves-effect waves-light btn" style="color:rgb(67,122,212);padding:0px;line-height:1.6" href="{{$boleto_url}}" target="blank">Imprimir Boleto</a></strong></span></p>

<p style="text-align: center; padding: 10px;"><span style="color: #000000;"><strong>C&oacute;digo de Barra</strong></span>
<br> <span style="text-align: center; padding: 10px;">{{$boleto_barcode}}</span>
</p>

@else
<p><strong>*IMPORTANTE:</strong> Ap&oacute;s a confirma&ccedil;&atilde;o de pagamento, voc&ecirc; receber&aacute; (ou j&aacute; recebeu) outro e-mail avisando sobre a libera&ccedil;&atilde;o do seu plano.&nbsp;</p>
@endif
<p>Se voc&ecirc; tiver alguma d&uacute;vida sobre o plano escolhido, fale conosco!<br /><br />Whatsapp: (11) 94019-4371<br />Email: contato@casfpic.org.br</p>
<p>&nbsp;</p>
</td>
</tr>
<tr>
<td style="padding: 0px 34px; background-color: #ffffff;">
<p>&nbsp;</p>
<p>&nbsp;</p>
</td>
</tr>
</tbody>
</table>
</td>
</tr>
</tbody>
</table>
<table style="max-width: 600px; height: 108px; width: 100%;" width="100%" cellspacing="0" cellpadding="0" align="center">
<tbody>
<tr style="height: 18px; text-align: center;">
<td style="height: 18px;">&nbsp;</td>
</tr>
<tr style="height: 18px;">
<td style="height: 18px; text-align: center;"><span style="color: #808080;">Rua Sete de Setembro 270</span><br /><span style="color: #808080;">Centro</span><br /><span style="color: #808080;">CEP: 1876O-037</span><br /><span style="color: #808080;">Cerqueira Cesar - SP</span></td>
</tr>
</tbody>
</table>
</div>
</td>
</tr>
</tbody>
</table>