<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\PasswordRequest;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\ServiceProvider;


class LabelsController extends Controller
{
    /**
     * Show the form for editing the profile.
     *
     * @return \Illuminate\View\View
     */
    public function find()
    {
        return view('label.label');
    }

    /**
     * Update the profile
     *
     * @param  \App\Http\Requests\ProfileRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function print(Request $request)    {

        $fields = $request->all();
             
        if($fields['checar'] == 'entrada'){
            $tipo= 'entrada';
        }else{
            $tipo= 'factura';
        }
        // dd($tipo);
        if ($tipo=='entrada' ){
            if ($request->get('CardCode')){
                $id = $request->get('CardCode');
        // try  
        {   
                $custom_datos = DB::select (DB::raw ("SELECT Opch.DocNum, Opch.CardCode, opch.CardName, opch.NumAtCard, pch1.ItemCode, pch1.dscription, pch1.quantity, oitb.ItmsGrpNam, oitm.suppCatNum from OITB,OITM,OPCH,pch1 where OpcH.DocEntry= pch1.DocEntry and pch1.ItemCode = oitm.ItemCode and oitm.itmsGrpCod = oitb.ItmsGrpCod and OpcH.Docnum = '$id'"));
                //  dd($custom_datos);
                return view('label.print' ,['custom_datos' => $custom_datos, 'tipo'=>$tipo ]);
                
                  }
            //  catch (\Exception $e) {
                //     return back()->with('error','Valida los datos nuevamente!');
            
                // }
    
    
            }
        }elseif($tipo=='factura'){
            if ($request->get('CardCode')){
                $id = $request->get('CardCode');
             try  {  
                $custom_datos = DB::select (DB::raw ("SELECT Opch.DocNum, Opch.CardCode, opch.CardName, opch.NumAtCard, pch1.ItemCode, pch1.dscription, pch1.quantity, oitb.ItmsGrpNam, oitm.suppCatNum from OITB,OITM,OPCH,pch1 where OpcH.DocEntry= pch1.DocEntry and pch1.ItemCode = oitm.ItemCode and oitm.itmsGrpCod = oitb.ItmsGrpCod and OpcH.NumAtCard = '$id';"));
                // dd($custom_datos);
        return view('label.print' ,['custom_datos' => $custom_datos, 'tipo'=>$tipo ]);
    
                 }catch (\Exception $e){
                    return back()->with('error','Valida los datos nuevamente!');
                }
    
            } 
        }
                //dd($custom_datos);
    
        }
        
        public function invoice(Request $request) 
        {
            $fields = $request->all();
            //dd($fields);
            $count = count($request->input('checar'));
            $datos =$request->input('checar');
            $view =  \View::make('impresion.invoice', compact('datos','fields'))->render();
            $pdf = \App::make('dompdf.wrapper');
            $pdf->loadHTML($view,);
            
    
            // $pdf->setPaper([0,0,99,224],'landscape');
           
            return $pdf->stream('impresion.invoice');
           
        }
    public function update(ProfileRequest $request)
    {
        auth()->user()->update($request->all());

        return back()->withStatus(__('Profile successfully updated.'));
    }

    /**
     * Change the password
     *
     * @param  \App\Http\Requests\PasswordRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function password(PasswordRequest $request)
    {
        auth()->user()->update(['password' => Hash::make($request->get('password'))]);

        return back()->withPasswordStatus(__('Password successfully updated.'));
    }
}
