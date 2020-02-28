<!DOCTYPE html>
<html lang="en">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link rel="stylesheet" type="text/css" href="print.css" media="print" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<style>
  @page {
      size:131mm 78mm;
      margin: 2mm;
      margin-right: 2mm;
      
    }
    @media print {
  footer {page-break-after: always;}
}
                .rotate {
                 transform: rotate(90deg);
                }

                .grid-container {
                  width: 450px;
                  padding:2px;
                  margin: 3mm;
                }

                .grid-item {
                  text-align: center;
                  padding: 3px;
                  }

                  .row {
                  clear: both;
                }

                .col {
                  float:left;
                  width: 200px;
                  
                }

                .distribution{
                  /*font-family: 'Nunito', sans-serif;*/
                  font-size: 12px;
                  text-align:left;
                  text-decoration: underline;
                  font-weight: bold;
                }

                .unitpbox{
                  /*font-family: 'Nunito', sans-serif;*/
                  font-size: 12px;
                  text-align:right;
                  font-weight: bold;
                 
                }

                .dscrption {
                  /*font-family: 'Nunito', sans-serif;*/
                  font-size: 12px;
                  text-align:center;
                  color:white;
                  font-weight: bold;
                  background: black;
                }

                .line{
                  /*font-family: 'Nunito', sans-serif;*/
                  font-size: 12px;
                  text-align:left;
                  color:white;
                  font-weight: bold;
                  background: black

                }

                .codebarnum {
                  /*font-family: 'Nunito', sans-serif;*/
                  font-size: 30px;
                  text-align:center;
                  font-weight: bold;

                }

                .barcode {
                  float: center;
                  /*padding-left: 20mm;*/
                }

                .provider {
                  /*font-family: 'Nunito', sans-serif;*/
                  font-size: 10px;
                  text-align:center;
                  font-weight: bold;
                 
                }

                .fact{
                  font-family: 'Nunito', sans-serif;
                  font-size: 10px;
                  text-align:center;
                  font-weight: bold;
                  }

                .origen{
                  grid-column: 1 / span ;
                  grid-row: 5;
                  page-break-after: always;
                }

                .col.span1 { 
                  width: 200px; 
                }
                /* Dos columnas de ancho (120px) y un carril (20px) */
                .col.span2 { 
                  width: 240px; 
                }

                /* Tres columnas de ancho (180px) y dos carriles (40px) */
                .col.span3 { 
                  width: 320px; 
                }

                /* Y asi sucesivamente ... */
                .col.span4 { 
                  width: 440px; 
                }

</style>      

              @foreach ($datos as $dato) 
                  @for ($i=0; $i < $fields['cantidad'.$dato]; $i++)
            <!-- <div class="rotate"> -->
              <div class="grid-container">
                <div class="row">
                  <div class="grid-item col distribution">Distribution Center</div>
                  <div class="grid-item col span2 unitpbox">Unit p/Box: {{ $fields['upc'.$dato]}}</div>  
                  </div>

                  <div class="row">
                  <div class="grid-item col span4 codebarnum">{{ $fields['code'.$dato]}} </div>
                  </div>

                  <div class="row">
                  <div class="grid-item col span4 dscrption" >{{ $fields['name'.$dato]}}</div>
                  </div>

                  <div class="row">
                  <div class="grid-item col span2 line">{{ $fields['group'.$dato]}}</div>
                  <br>                 
                  </div>
                  
                  <div>
                  <br>                 
                  </div>

                  <div class="row"> 
                  <div class=" grid-item col span4 barcode" ><img src="data:image/png;base64,{{DNS1D::getBarcodePNG($fields['code'.$dato], 'C128', 1,44,)}}" alt="barcode" /></div>
                  </div> 

                  <div class="row">
                  <div class="grid-item col span1 provider">Proveedor: {{ $fields['provider'.$dato]}} </div>
                  <div class="grid-item col span2 fact">Factura: {{ $fields['fact'.$dato]}}</div>

                  </div>

                  </div>


                  
                 
                  

              </div> 
            
            

            
               
               
       @endfor

    @endforeach
      
    
</html>

