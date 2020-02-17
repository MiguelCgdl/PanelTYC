@extends('layouts.app', ['title' => __('User Profile')])

@section('content')
    @include('users.partials.header', [
        'title' => __('Hello') . ' '. auth()->user()->name,
        'description' => __('This is your profile page. You can see the progress you\'ve made with your work and manage your projects or assigned tasks'),
        'class' => 'col-lg-7'
    ])   

    <form method="GET" action="{{url('pdf')}}" class="was-validated" >
   <?php 

    $i=0;

    ?>


    <?php 
    if ($custom_datos){
    ?>
      @foreach ($custom_datos as $dato)
      <?php
       $fact = array("P00");
      $string = $dato->CardCode;
      $rest1 = str_replace($fact, "", $string);  // devuelve "abcde"
      ?>        
      @endforeach
            <div class="position-ref container form-group" style=" width: 50%;">  
                                            <table class="table table-dark table-striped  table-responsive" style ="border: solid 3px #123;text-align: center;">
                             

    <thead>
      <tr>
        <th  style="border-bottom: solid 2px #100;">Factura</th>
        <th style="border-bottom: solid 2px #100;">Proveedor</th>
      </tr>
    </thead>
    <tr>
        <td style="text-align: center;">{{$dato->NumAtCard}}</td>
        <td style="text-align: center;">{{$rest1}}</td>
      </tr>
    </table>
  </div>
<div class="position-ref container form-group" > 
      <table class="table table-dark table-striped table-responsive "style ="border: solid 3px #000; text-align: center;">
    <thead>
      <tr>
        <th style="border-bottom: solid 2px #100;">Codigo</th>
        <th style="border-bottom: solid 2px #100;">Descripción</th>
        <th style="border-bottom: solid 2px #100;">Grupo</th>
        <th style="border-bottom: solid 2px #100;">Cantidad</th>
        <th style="border-bottom: solid 2px #100;">Unit p/box</label></th>
        <th style="border-bottom: solid 2px #100;">Imprimir</label></th>           

      </tr>

    <tbody>
      
      @foreach ($custom_datos as $dato)
      <?php
      $vowels = array("-1", "-2", "@N");
      $string = $dato->ItemCode;
      $rest = str_replace($vowels, "", $string);  // devuelve "abcde"
      $i+=1;
      ?>        
        <tr> 
        <td style="text-align: center;">{{$rest}}</td>
        <td style="text-align: center;">{{$dato->dscription}}</td>
        <td style="text-align: center;">{{$dato->ItmsGrpNam}}</td>
        <td style="text-align: center">{{number_format($dato->quantity),10}}</td>
        <td><input type='number' name='upc{{$i}}' value='1' requiered size='3'> </td>

        <input name= 'code{{$i}}' value= '{{$rest}}' type='text' hidden="true" >
        <input name= 'name{{$i}}' value= '{{$dato->dscription}}' type='text' hidden="true" >
        <input name= 'group{{$i}}' value= '{{$dato->ItmsGrpNam}}' type='text' hidden="true" >
        <input name= 'provider{{$i}}' value= '{{$rest1}}' type='text' hidden="true" >
        <input name= 'fact{{$i}}' value= '{{$dato->NumAtCard}}' type='text' hidden="true" >
        <input name= 'cantidad{{$i}}' value= '{{number_format($dato->quantity),10}}' type='text' hidden="true">

        <td><input class= "case" style="text-align: center" type='checkbox' name='checar[]' value={{$i}}></td> 
      </tr>
      @endforeach
      
      <input name="total" value= '{{$i}}' type="text" hidden="true">
    
    </tbody>
  </table>
  </div>

                       
      <div class="flex-center container">        
          <button href= "{{url('pdf')}}" type="submit" class="btn btn-primary" type="submit">Imprimir </button>  

        <input type="checkbox" id="selectall";> Seleccionar todos
            <script type="text/javascript">
                $("#selectall").on("click", function() {  
                $(".case").prop("checked", this.checked);  
              });
            </script>                          
      <?php 
        }else {
        echo "no hay datos";
}

      ?>
        </div> 

</form>
@endsection