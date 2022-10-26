<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tramite;
use App\Models\Carrera;
use App\Models\TramiteSolicitado;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ChartController extends Controller
{
    public function charts_index()
    {
        // $a = $this->tramites_perCareer();
        // dd($a);
        return view('admin.graficas.index');
    }

    // POST -AJAX: load specific chart -when clicking bootstrap-Tabs
    public function getChart(Request $request)
    {
        $request->validate([
           'chart_indetifier' => 'required',
        ]);

        // Charts indetifiers: tramites_mes-tab, top_tramites-tab, summary_tramites-tab, tramites_perCareer-tab

        $chart_indetifier = $request->input('chart_indetifier');

        if($chart_indetifier == 'tramites_mes-tab'){
            // Total Tramites por mes
            return ['type' => 'tramites_mes' , 'dataChart' => $this->chart_tramites_mes() ];
        }
        else if($chart_indetifier == 'top_tramites-tab'){
            // Top tramites solicitados
            return ['type' => 'top_tramites' , 'dataChart' => $this->top_tramites() ];
        }
        else if($chart_indetifier == 'summary_tramites-tab'){
            // Top tramites solicitados
            return ['type' => 'summary_tramites' , 'dataChart' => $this->summary_tramites() ];
        }
        else if($chart_indetifier == 'tramites_perCareer-tab'){
            // tramites por carrera
            return ['type' => 'tramites_perCareer' , 'dataChart' => $this->tramites_perCareer() ];
        }
        else
            return 'nothing selected';

    }

    // invoke from $this->getChart
    private function chart_tramites_mes()
    {
        // Working
        $tramites_mes = TramiteSolicitado::with('tramite')
        ->select( DB::raw('EXTRACT(MONTH FROM created_at) AS Mes, COUNT(*) as CantidadMes'), 'tramite_id'  )
        ->whereYear('created_at', Carbon::now()->format('Y'))
        ->groupBy('Mes', 'tramite_id')
        ->get();
        $arr_tramites_mes = [];

        $tramites_names = Tramite::select('nombre_tramite')->get()->toArray();

        for($i = 0; $i < 12; $i++){

            $arrInfo = [];
            $arrInfo['Total'] = 0;
            foreach($tramites_names as $tn){
                $arrInfo[ $tn['nombre_tramite'] ] = 0;
            }
            // dd($arrInfo);

            $arr_tramites_mes[$i] = $arrInfo;

            // $arr_tramites_mes[$i] = array(
            //     'Total' => 0,
            //     'Certificado parcial de estudio' => 0,
            //     'Certificado total de estudio' => 0,
            //     'Certificado de graduado' => 0,
            //     'Acta de titulación' => 0
            // );

            // dd($arr_tramites_mes[$i]);

        }

        foreach($tramites_mes as $tm){
            $key = intval($tm->Mes-1);
            $arr_tramites_mes[$key][$tm->tramite->nombre_tramite] = $tm->CantidadMes;

            $total = 0;
            foreach($tramites_names as $tn){
                $total += $arr_tramites_mes[$key][$tn['nombre_tramite']];
                // $arr_tramites_mes[$key]['Total'] += $arr_tramites_mes[$key][$tn['nombre_tramite']];
            }

            // dd($total);

            $arr_tramites_mes[$key]['Total'] = $total;

            // $arr_tramites_mes[$key]['Total'] =
            //     $arr_tramites_mes[$key]['Certificado parcial de estudio'] +
            //     $arr_tramites_mes[$key]['Certificado total de estudio'] +
            //     $arr_tramites_mes[$key]['Certificado de graduado'] +
            //     $arr_tramites_mes[$key]['Acta de titulación'];
        }


        return  $arr_tramites_mes;
    }

    // invoke from $this->getChart
    private function top_tramites()
    {
        $general_total_tramites = TramiteSolicitado::with('tramite')->select(DB::raw('COUNT(*) AS Total'), 'tramite_id')->groupBy('tramite_id')->orderBy('Total', 'desc')->get();

        return $general_total_tramites;
    }

    // invoke from $this->getChart
    private function summary_tramites()
    {
        $summary_tramites = TramiteSolicitado::with('tramite')->select(DB::raw('COUNT(*) AS Total'), 'tramite_id', 'categoria')
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy('categoria')->orderBy('Total', 'desc')->get();

        return $summary_tramites;
    }

    // invoke from $this->getChart
    private function tramites_perCareer()
    {
        $arr_total_per_career = [];
        // $careers = Carrera::groupBy('wrapperID')->get()->toArray();
        $careers = Carrera::get()->toArray();

        $wrapperIDs_done = [];

        foreach($careers as $oneCareer){
            $careers_byWrapper = Carrera::where('wrapperID', $oneCareer['wrapperID'] )->get()->toArray();

            // dd($careers_byWrapper);

            if(!in_array($oneCareer['wrapperID'], $wrapperIDs_done)){

                $total_byWrapper = 0;
                foreach($careers_byWrapper as $cw){
                    $total_oneCareeer_wrapper = TramiteSolicitado::with('student')->
                                    whereHas('student' , function($query) use ($cw){
                                        // $query->where('clave_carrera', 'LANT');
                                        $query->where('clave_carrera', $cw['clave']);
                                    })
                                    ->select(DB::raw('COUNT(*) AS total'), 'student_id')
                                    ->orderBy('total')
                                    ->first();

                    // dd($total_oneCareeer_wrapper);

                    //sumatoria por cada clave de una respectiva carrera
                    $total_byWrapper += $total_oneCareeer_wrapper['total'];
                }
                array_push($arr_total_per_career, [ $oneCareer['nombre'], $total_byWrapper] );

                // dd($arr_total_per_career);

//             $total_oneCareeer = TramiteSolicitado::with('student')->
//                             whereHas('student' , function($query) use ($oneCareer){
//                                 $query->where('clave_carrera', $oneCareer['clave']);
//                             })
//                             ->select(DB::raw('COUNT(*) AS total'), 'student_id')
//                             ->orderBy('total')
//                             ->get();
//
                // array_push($arr_total_per_career, [$oneCareer['clave'], $oneCareer['nombre'], $total_oneCareeer[0]['total'] ]);

                array_push($wrapperIDs_done, $oneCareer['wrapperID']);
            }
        }

        $toSort_byTotal = array_column($arr_total_per_career, 1);
        array_multisort($toSort_byTotal, SORT_DESC, $arr_total_per_career);

        return $arr_total_per_career;
    }



}
