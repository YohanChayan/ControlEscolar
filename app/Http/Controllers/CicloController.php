<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ciclo;

class CicloController extends Controller
{
    public function index()
    {
        $ciclos = Ciclo::orderBy('semestre', 'desc')->get();
        $html_table = view('admin.ciclos.ajax.index_ciclosTable')->with('ciclos', $ciclos);
        return view('admin.ciclos.index')->with('data', $html_table);
    }

    public function store(Request $request)
    {
        // $this->authorize('coordi');
        $request->validate([
           'anio' => 'required',
           'ciclo' => 'required',
           'matricula' => 'required',
        ]);

        $semestre = $request->input('anio') . $request->input('ciclo');
        $matricula = $request->input('matricula');

        $alreadyExist = Ciclo::where('semestre', $semestre)->first();

        if(isset($alreadyExist)){
            $answer = [ 'message' => 'Ciclo ya existente!', 'say' => 'No' ];
            return $answer;
        }


        $oldCiclo = Ciclo::where('selected' , true)->first();
        if(isset($oldCiclo)){
            $oldCiclo->selected = false;
            $oldCiclo->save();
        }

        $newCiclo = new Ciclo();
        $newCiclo->semestre = $semestre;
        $newCiclo->matricula = $matricula;
        $newCiclo->selected = true;
        $newCiclo->save();

        $ciclos = Ciclo::orderBy('semestre', 'desc')->get();
        $html_table = view('admin.ciclos.ajax.index_ciclosTable')->with('ciclos', $ciclos)->render();

        $answer = [
            'message' => 'Ciclo establecido correctamente!',
            'say' => 'Yes',
            'newCiclo' => $newCiclo,
            // 'oldCiclo' => $oldCiclo,
            'data' => $html_table
        ];

        return $answer;
    }

    public function destroy($id)
    {
        $ciclo = Ciclo::find($id);
        if(isset($ciclo)){
            $ciclo->delete();

            // se activa el ciclo anterior
            $oldCiclo = Ciclo::orderBy('semestre' , 'desc')->first();
            $oldCiclo->selected = true;
            $oldCiclo->save();

            return ['say' => 'Yes', 'oldCiclo' => $oldCiclo];
        }
        return ['say' => 'No'];
    }

    // update only matricula
    public function update(Request $request, $id)
    {
        $matricula = $request->input('matricula');
        $ciclo = Ciclo::find($id);

        if(!isset($ciclo)){
            return ['say' => 'No'];
        }

        $ciclo->matricula = $matricula;
        $ciclo->save();

        return [
            'say' => 'Yes',
            'id' => $id,
            'updatedCiclo' => $ciclo
        ];
    }

}
