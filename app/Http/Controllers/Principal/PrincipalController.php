<?php

namespace App\Http\Controllers\Principal;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Boleto;
use App\Cartao;
use App\CartaoProcess;
use App\Terceiros;
use App\Associado;
use App\Http\Requests\PrincipalRequest;

use DB;

class PrincipalController extends Controller
{
    private $request;
    private $boleto;
    private $cartao;
    private $cartaoProcess;
    private $terceiros;
    private $associado;

    public function __construct(Request $request, Boleto $boleto,
                                Cartao $cartao, CartaoProcess $cartaoProcess,
                                Terceiros $terceiros, Associado $associado)
    {
        $this->request = $request;
        $this->boleto = $boleto;
        $this->cartao = $cartao;
        $this->cartaoProcess = $cartaoProcess;
        $this->terceiros = $terceiros;
        $this->associado = $associado;

    }

    public function index()
    {
        return view('center.index');
    }


    public function ofertaViewFirst()
    {

        return view('center.formfirst');
    }

    public function ofertaViewSecond()
    {

        return view('center.formsecond');
    }

    public function ofertaViewFinish()
    {
        $cpf = preg_replace('/\D/', '', $this->request->get('ter_cpf'));
        $associado = $this->associado->select('*')->where('as_cpf','=',$cpf)->first();
        $saveBol = false;
            $saveCard = false;
                $saveTer = false;

        if(count($associado) > 0) // SE ACHAR UM ASSOCIADO, INSERE A OFERTA COM BASE NOS DADOS DELE
        {
            if($this->request->get('type') == 'BB')
            {
                $boleto = $this->boleto;

                $boleto->idcliente = $associado->as_cod;
                $boleto->tipo_cliente = $associado->as_tipo;
                $boleto->tipo_boleto = "D";
                $boleto->dt_vencto = date('Y-m-d', strtotime("+18 days"));
                $pattern = array('.',',');
                $replace = array('','.');
                $boleto->valor = str_replace($pattern,$replace,$this->request->get('valor'));
                $boleto->idbanco = 6;
                $boleto->st_instrucao = "PARA PAGAR EM OUTRO BANCO APÓS O VENCIMENTO, Atualize o boleto em WWW.BRADESCO.COM.BR/BOLETOS.";
                $boleto->st_descricao = "Oferta comemorativa de 60 anos (Um presente para Os Gideões)";
                $boleto->idtipo = 20;

               $saveBol = $boleto->save();

            }
            else
            {

                $cartao = $this->cartao;
                $cartaoProcess = $this->cartaoProcess;

                $cartao->as_cod = $associado->as_cod;
                $cartao->as_tipo = $associado->as_tipo;
                $cartao->ip = $this->request->ip();
                $cartao->as_login = $associado->new_as_cod;
                $cartao->cc_refer = 'OF_60ANOS';
                $cartao->cc_number = 0;
                $cartao->cc_nome = $this->request->get('cartao_nome');
                $pattern = array('.',',');
                $replace = array('','.');
                $cartao->cc_value= str_replace($pattern,$replace,$this->request->get('valor'));

               $saveCard = $cartao->save();

                $cartaoProcess->cc_id = $cartao->cc_id;
                $cartaoProcess->cc_field1 = base64_encode($this->request->get('numero_cartao'));
                $cartaoProcess->cc_field2 = $this->request->get('validade');
                $cartaoProcess->cc_field3 = md5("Gideoes".$associado->as_cod.$associado->as_tipo."Anui");
                $cartaoProcess->cc_field4 = base64_encode($this->request->get('cod_sec'));

                $cartaoProcess->save();

            }

        }
        else
        {
            if($this->request->get('type') == 'BB')
            {
                $terceiros = $this->terceiros;
                $terceiros->ter_nome = $this->request->get('nome');
                $terceiros->ter_end = $this->request->get('logradouro');
                $terceiros->ter_num = $this->request->get('numero');
                $terceiros->ter_compl = $this->request->get('complemento');
                $terceiros->ter_bairro = $this->request->get('bairro');
                $terceiros->ter_cidade = $this->request->get('cidade');
                $terceiros->ter_estado = $this->request->get('uf');
                $terceiros->ter_cep = $this->request->get('cep');
                $terceiros->ter_email = $this->request->get('email');
                $terceiros->ter_cpf = $cpf;

                $saveTer = $terceiros->save();


                // SAVE BOLETO
                $boleto = $this->boleto;
                $boleto->idcliente = $terceiros->ter_id;
                $boleto->tipo_cliente = 'T';
                $boleto->tipo_boleto = "D";
                $boleto->dt_vencto = date('Y-m-d', strtotime("+18 days"));
                $pattern = array('.',',');
                $replace = array('','.');
                $boleto->valor = str_replace($pattern,$replace,$this->request->get('valor'));
                $boleto->idbanco = 6;
                $boleto->st_instrucao = "PARA PAGAR EM OUTRO BANCO APÓS O VENCIMENTO, Atualize o boleto em WWW.BRADESCO.COM.BR/BOLETOS.";
                $boleto->st_descricao = "Oferta comemorativa de 60 anos (Um presente para Os Gideões)";
                $boleto->idtipo = 20;
                $saveBol = $boleto->save();
                ///////

            }
            else
            {

                $terceiros = $this->terceiros;
                $terceiros->ter_nome = $this->request->get('ter_nome');
                $terceiros->ter_email = $this->request->get('ter_email');
                $terceiros->ter_cpf = $this->request->get('ter_cpf');
                $terceiros->save();

                $cartao = $this->cartao;
                $cartaoProcess = $this->cartaoProcess;

                $cartao->as_cod = $terceiros->ter_id;
                $cartao->as_tipo = 'T';
                $cartao->ip = $this->request->ip();
                $cartao->as_login = $associado->new_as_cod;
                $cartao->cc_refer = 'OF_60ANOS';
                $cartao->cc_number = 0;
                $cartao->cc_nome = $this->request->get('cartao_nome');
                $pattern = array('.',',');
                $replace = array('','.');
                $cartao->cc_value= str_replace($pattern,$replace,$this->request->get('valor'));

                $saveCard = $cartao->save();

                $cartaoProcess->cc_id = $cartao->cc_id;
                $cartaoProcess->cc_field1 = base64_encode($this->request->get('numero_cartao'));
                $cartaoProcess->cc_field2 = $this->request->get('validade');
                $cartaoProcess->cc_field3 = md5("Gideoes".$terceiros->ter_id."TAnui");
                $cartaoProcess->cc_field4 = base64_encode($this->request->get('cod_sec'));

                $cartaoProcess->save();

            }

        }

        if(count($associado) > 0)
        {
            if($saveBol || $saveCard)
            {
                $this->request->session()->flash('alert-green', 'Oferta Recebida com sucesso, para consultar digite seu CPF na página "Minhas Ofertas". Em caso de Boleto Bancário, você receberá em seu email em até 2 dias úteis!');
                return redirect("/ofertaformfirst");
            }
            else
            {
                $this->request->session()->flash('alert-red', 'Não foi possível registrar a sua oferta, por favor tente novamente.');
                return redirect("/ofertaformfirst");
            }

        }
        else
        {
            if(($saveTer && $saveBol) || ($saveTer && $saveCard))
            {
                $this->request->session()->flash('alert-green', 'Oferta Recebida com sucesso, para consultar digite seu CPF na página "Minhas Ofertas". Em caso de Boleto Bancário, você receberá em seu email em até 2 dias úteis!');
                return redirect("/ofertaformfirst");
            }
            else
            {
                $this->request->session()->flash('alert-red', 'Não foi possível registrar a sua oferta, por favor tente novamente.');
                return redirect("/ofertaformfirst");
            }
        }


    }

    public function listOferta($cpf)
    {
        $cpf = preg_replace('/\D/', '', $cpf);
        $associado = $this->associado->select('*')->where('as_cpf','=',$cpf)->first();

        if(count($associado) > 0)
        {
            $arrayBB = DB::table('boleto_reg as b')
                ->select(DB::raw("to_char(dt_vencto,'DD/MM/YYYY') as vencimento"),'b.valor','a.as_nome',DB::raw("'Boleto' as tipo"))
                ->leftjoin('associado as a', function ($join) {
                    $join->on('a.as_cod', '=', 'b.idcliente')
                        ->where('a.as_tipo', '=', 'b.tipo_cliente');
                })
                ->where('b.tipo_boleto','=','D')
                ->where('b.st_descricao','ilike','%60 anos%')
                ->where('a.as_cpf','=',$cpf)
                ->whereIn('b.status',['A','B','N'])
                ->get();
        }
        else{
            $arrayBB = DB::table('boleto_reg as b')
                ->select(DB::raw("to_char(dt_vencto,'DD/MM/YYYY') as vencimento"),'b.valor','t.ter_nome as as_nome',DB::raw("'Boleto' as tipo"))
                ->leftjoin('terceiros as t', function ($join) {
                    $join->on('t.ter_id', '=', 'b.idcliente')
                        ->where('b.tipo_cliente', '=', 'T');
            })
                ->where('b.tipo_boleto','=','D')
                ->where('b.st_descricao','ilike','%60 anos%')
                ->where('t.ter_cpf','=',$cpf)
                ->whereIn('b.status',['A','B','N'])
                ->get();
        }


        if(count($associado) > 0)
        {
            $arrayCC = DB::table('cartao as c')
                ->select(DB::raw("to_char(cc_vencto,'DD/MM/YYYY') as vencimento"),'c.cc_value','a.as_nome',DB::raw("'Cartão' as tipo"))
                ->leftjoin('associado as a', function ($join) {
                    $join->on('a.as_cod', '=', 'c.as_cod')
                        ->where('a.as_tipo', '=', 'c.as_tipo');
                })
                ->where('c.cc_refer','=','OF_60ANOS')
                ->where('a.as_cpf','=',$cpf)
                ->whereIn('c.cc_status',['0','1'])
                ->get();
        }
        else{
            $arrayCC = DB::table('cartao as c')
                ->select(DB::raw("to_char(cc_vencto,'DD/MM/YYYY') as vencimento"),'c.cc_value','t.ter_nome as as_nome',DB::raw("'Cartão' as tipo"))
                ->leftjoin('terceiros as t', function ($join) {
                    $join->on('t.ter_id', '=', 'c.as_cod')
                        ->where('c.as_tipo', '=', 'T');
                })
                ->where('c.cc_refer','=','OF_60ANOS')
                ->where('t.ter_cpf','=',$cpf)
                ->whereIn('c.cc_status',['0','1'])
                ->get();
        }

        return view('htmlrequest.listof',compact('arrayBB','arrayCC'));

    }

    public function htmlrequest($type)
    {
        if($type == 'BB')
        {
            return view('htmlrequest.bb');
        }
        else
        {
            return view('htmlrequest.cc');
        }

    }

    public function getMember($cpf)
    {
        $cpf = preg_replace('/\D/', '', $cpf);

        $array = DB::table('associado')
            ->select('as_nome','as_email','as_cep','as_end','as_num','as_bairro',DB::raw('trim(as_cidade) as as_cidade'),'as_estado','as_compl')
            ->where('as_cpf','=',$cpf)
            ->whereIn('mot_cod',[1,6,7,8])
            ->first();

        if(count($array) < 1)
        {
            if(isset($cpf))
            {
               $array = DB::table('terceiros')
                    ->select(DB::raw('trim(ter_nome) as as_nome'),DB::raw('trim(ter_email) as as_email'),
                        DB::raw('trim(ter_cep) as as_cep'),DB::raw('trim(ter_end) as as_end'),
                        DB::raw('ter_num as as_num'),DB::raw('trim(ter_compl) as as_compl'),
                        DB::raw('trim(ter_bairro) as as_bairro'),DB::raw('trim(ter_cidade) as as_cidade'),
                        DB::raw('trim(ter_estado) as as_estado'))
                    ->where('ter_cpf','=',$cpf)
                    ->first();
            }

        }

        return response()->json($array);
    }

    public function getOfertas($cpf)
    {
        $cpf = preg_replace('/\D/', '', $cpf);

        $array = DB::table('');

        return response()->json($array);
    }




}
