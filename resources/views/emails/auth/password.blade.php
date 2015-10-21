<?php $url = str_replace('token',$token,str_replace('email',$user->email,$callBackUrl)); ?>

Olá {{$user->name}},</br>
<p>
Altere sua senha clicando  <a href="{{$url}}"> aqui </a></br></br>
Ou copie e cole o link abaixo na barra de endereços de seu navegador.
</br></br>
{{$url}}
</p>
