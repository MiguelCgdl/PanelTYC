@extends('layouts.app', ['title' => __('User Profile')])

@section('content')
    @include('users.partials.header', [
        'title' => __('Hello') . ' '. auth()->user()->name,
        'description' => __('This is your profile page. You can see the progress you\'ve made with your work and manage your projects or assigned tasks'),
        'class' => 'col-lg-7'
    ])  

    <div class="container-fluid mt--7">
      <div class="col-xl-16 order-xl-1">
        <div class="card bg-secondary shadow">
          <div class="card-header bg-white border-0">
            <div class=" align-items-center">
              <div class="card-body">
              <form method="get" action="{{ route('impresion.invoice') }}" class="was-validated" target="_blank" >
                            <!-- Metodo Php para la impresion de los datos -->
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
                              <!--Termina foreach datos  -->

                    <!-- Nuevo Diseño Facturacion  -->
                    <div class="position-ref container form-group" style=" width: 40%;">
                      <div class="table-responsive">
                        <table class="table align-items-center table-dark">
                                  <thead class="thead-dark">
                                      <tr>
                                          <th scope="col" style="text-align: center;">
                                              FACTURA
                                          </th>
                                          <th scope="col">
                                              PROVEEDOR
                                          </th>
                                      </tr>
                                  </thead>          
                                <tr>
                                    <th scope="row" class="name">
                                      <div class="media align-items-center" style="text-align: center;">
                                        <div class="media-body">
                                          <span class="mb-0 text-sm">{{$dato->NumAtCard}}</span>
                                        </div>
                                      </div>
                                    </th>
                                    <th scope="row" class="name">
                                        <div class="media align-items-center">
                                            <div class="media-body" style="text-align: center;">
                                                <span class="mb-0 text-sm ">{{$rest1}}</span>
                                            </div>
                                        </div>
                                    </th>
                                  </tr>  
                          </table>
                        </div>
                      </div>
                      <!-- Final Diseño Facturacion -->

                      <!-- Nuevo Diseño tabla -->
                    <div class="table-responsive">
                        <table class="table align-items-center table-dark">
                          <thead class="thead-dark">
                            <tr>
                                <th scope="col">
                                    CODIGO
                                </th>
                                <th scope="col">
                                    DESCRIPCION
                                </th>
                                <th scope="col">
                                    GRUPO
                                </th>
                                <th scope="col">
                                    CANTIDAD
                                </th>
                                <th scope="col">
                                    UNIT P/BOX
                                </th>
                                <th scope="col">
                                    IMPRIMIR
                                </th>
                    
                              <!-- foreach para recorrer los datos -->
                              @foreach ($custom_datos as $dato)
                              <?php
                              $vowels = array("-1", "-2", "@N");
                              $string = $dato->ItemCode;
                              $rest = str_replace($vowels, "", $string);  // devuelve "abcde"
                              $i+=1;
                              ?>   
                                <tr> 
                                <td style="text-align: center;">{{$rest}}</td>
                                <td style="text-align: left;">{{$dato->dscription}}</td>
                                <td style="text-align: left;">{{$dato->ItmsGrpNam}}</td>
                                <td style="text-align: center">{{number_format($dato->quantity),10}}</td>
                                <td ><input type='number' name='upc{{$i}}' value='1' requiered style="width : 40px;"></td>
                                <input name= 'code{{$i}}' value= '{{$rest}}' type='text' hidden="true" >
                                <input name= 'name{{$i}}' value= '{{$dato->dscription}}' type='text' hidden="true" >
                                <input name= 'group{{$i}}' value= '{{$dato->ItmsGrpNam}}' type='text' hidden="true" >
                                <input name= 'provider{{$i}}' value= '{{$rest1}}' type='text' hidden="true" >
                                <input name= 'fact{{$i}}' value= '{{$dato->NumAtCard}}' type='text' hidden="true" >
                                <input name= 'cantidad{{$i}}' value= '{{number_format($dato->quantity),10}}' type='text' hidden="true">
                                <td><input class= "case" style="text-align: left" type='checkbox' name='checar[]' value={{$i}}></td> 
                                </tr>
                              @endforeach
                              <!-- termina foreach -->
                              <input name="total" value= '{{$i}}' type="text" hidden="true">
                            </tr>
                          </thead>
                        </table> 
                    </div> 
                    </div>
                    <div class="position-ref container form-group" style=" width: 40%;">
                      <div class="flex-center container">        
                          <button href="{{ route('impresion.invoice') }}"class="btn btn-primary" type="submit">Print </button> 
                          <button href="{{ route('home') }}" class="btn btn-primary" type="button">Button</button>
                            <input type="checkbox" id="selectall";> Seleccionar todos
                                <script type="text/javascript">
                                    $("#selectall").on("click", function() {  
                                    $(".case").prop("checked", this.checked);  
                                  });
                                </script>                          
                                  <?php 
                                    } else 
                                    {
                                      echo "no hay datos"; 
                                    }
                                  ?>
                </form>
                        </div>
                      </div>      
                </div>
              </div>
           </div>
          </div>
        </div>
        



        
      
<!-- termina nuevo diseño tabla --> 
       
    @include('layouts.footers.auth')
@endsection 
