<?php

namespace App\Http\Controllers;

use App\Models\PacienteVacinado;
use App\Repositories\Contracts\PacienteRepositoryInterface;
use App\Repositories\Contracts\VacinaRepositoryInterface;
use Illuminate\Http\Request;

class PacienteController extends Controller
{
    protected $paciente;
    protected $vacina;

    public function __construct(
        PacienteRepositoryInterface $paciente, 
        VacinaRepositoryInterface $vacina
    )
    {
        $this->paciente = $paciente;
        $this->vacina   = $vacina;
    }

    public function index()
    {
        return view('paciente.cadastro');
    }

   
    public function create()
    {
        return view('paciente.cadastro');
    }

    public function store(Request $request)
    {
        $paciente = $request->all();
        $this->paciente->store($paciente);        
        return response()->json($paciente);
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $paciente = $request->except('_token', 'id', 'loading', 'errors');

        if($id){
            $paciente = $this->paciente->upPaciente($id,$paciente);
        }

        return response()->json($paciente);
    }

    public function show()
    {
        $pacientes = $this->paciente->getAll();
        return response()->json($pacientes, 201);

    }

    public function edit($id)
    {
        $paciente = $this->paciente->edit($id);
        return view('paciente/editar', compact('paciente'));
    }
    

    public function delete($id)
    {
        $paciente = $this->paciente->destroy($id);
        return response()->json($paciente);
    }

    public function bootstrap(){
        return view('bootstrap');
    }

    public function registrarVacina(Request $request){
        $vac_pac = $request->all();
        $vac_nome = $this->vacina->edit($vac_pac['vacina_id']);
        $vacina = $this->vacina->registraVacina($vac_nome->nome ,$vac_pac);
        return response()->json($vacina);
    }

    public function pacientesVacinados($id){

        $dos_tomadas = $this->paciente->getVacinado($id);
    
        $qnt_doses = $this->paciente->dosesPaciente($id);

        $vac_tomada = $this->paciente->vacinaPaciente($id);

        return response()->json([$dos_tomadas, $qnt_doses, $vac_tomada]);
    }

    public function vacina($id){
        $vacina = $this->vacina->getAll();
        $paciente = $this->paciente->edit($id);
        $paciente_vacinado = PacienteVacinado::where('paciente_id',$id)->get();

        return view('paciente.vacinados.index', compact('paciente', 'vacina', 'paciente_vacinado'));
    }
    
}
