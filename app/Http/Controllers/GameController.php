<?php

namespace App\Http\Controllers;


use App\Models\Card;
use App\Models\Game;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return view('game.index2');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('game.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $id_user = auth()->user()->id;//Se valida el id del usuario que está logueado
        $datos = request()->except('_token'); 
        $game_id= $datos['id'];
        /* if ($game_id >10000) {//se valida que el codigo del juego no tenga mas de 5 caracteres
            return redirect()->route('game.create')->with('mensaje','El codigo tiene que tener cinco caracteres');
        } */
        $game = DB::table('games')->where('id', $game_id)->first();//Se consulta si ya existe un juego con el codigo ingresado
        if ($game) {
            return redirect()->route('game.create')->with('mensaje','Ya existe un juego con ese codigo');
        }
        //Se crea el juego en la DB 
        else{

            Game::insert($datos);

            User::where('id','=',$id_user)->update(['game_id' => $game_id]);            
            Game::where('id','=',$game_id)->update(['count' => 1]);
            User::where('game_id','=',$game_id)->update(['position' => 1,'turno'=>1]);
            
                return redirect()->route('game.index')->with('mensaje','Espere mientras se completa el grupo');
        }
        
    }

    public function store2(Request $request)
    {   
        //Ingresa un usuario a la sala del juego
        $id_user = auth()->user()->id;
        
        $datos = request()->except(['_token','_method']); 
        $game_id= $datos['id'];
        
        $game = DB::table('games')->where('id', $game_id)->first();      
        
        //se valida que exista un juego con el codigo ingresado
        if ($game) {

            $user_check = DB::table('users')->where('id',$id_user)->where('game_id', $game_id)->first();
            
            //se valida que el usuario ya se haya registrado al juego con aterioridad
            if ($user_check) {

                $count = $game->count;

                if ($count == 4)
                {//Se inicia la partida

                   // Card::where('id','!=',NULL)->update(['bug_id'=>NULL, 'user_id' =>NULL]);
                    
                    $user = User::find($id_user);                               
                    $cards = Card::where('user_id',$id_user)->get();
                    $position = $user['position'];
                    $turno = gestionarTurnos($position);
                    $players = traerJugadores();

                        return view('cards.index',['user'=>$user,'cards'=>$cards,'players'=>$players,'turno'=>$turno]);       
                         
                  
                }
                else {
                    return redirect()->route('game.index')->with('mensaje','Espere mientras se completa el grupo');
                }
            }
            
            //se agrega al jugador a la partida
            else{               
                $count = $game->count;
                
                if ($count < 4) 
                {
                    $count = $count + 1;
                    User::where('id','=',$id_user)->update(['game_id' => $game_id,'turno' => 0,'position'=>$count]);
                                        
                    Game::where('id','=',$game_id)->update(['count'=>$count ]);

                    return redirect()->route('game.index')->with('mensaje','Espere mientras se completa el grupo');
                    
                    //Se inicia la partida
                if ($count == 4) {

                    Card::where('id','!=',NULL)->update(['bug_id'=>NULL, 'user_id' =>NULL]);
                    barajar_cartas(); //se llama la funcion para barajar las cartas 

                    $user = User::find($id_user);                               
                    $cards = Card::where('user_id',$id_user)->get();
                    $turno = gestionarTurnos($id_user);
                    $players = traerJugadores();

                    
                        return view('cards.index',['user'=>$user,'cards'=>$cards,'players'=>$players,'turno'=>$turno]);                
                                     
                }
                else {
                    return redirect()->route('game.index')->with('mensaje','Espere mientras se completa el grupo');
                }
                }
                
               /*  //si el contador es mayor que 4 no se puede ingresar al juego
                else {
                    return redirect()->route('game.index')->with('mensaje','Esta sala está llena ');
                } */
            }
        }
        else {
            return redirect()->route('game.index')->with('mensaje','Esta sala no existe ');
        }

    }
    

    public function store3(Request $request)
    {
        
        $datos = request()->except('_token');
        $bugs = DB::select('select name from cards where bug_id = ?', [1]);
        $cuenta_bug = 0;
        
        
        if ($datos['programador'] == $bugs[0]->name && $datos['modulo'] == $bugs[1]->name && $datos['modulo'] == $bugs[1]->name) {

            DB::update('update users set turno = 0 ');
            DB::update('update cards set user_id = NULL, bug_id = NULL ');
            
            return view('/')->with('mensaje','¡Haz ganado!!');
        }
        else {

        }

    }
    public function show( $id)
    {
        //return $id;
        $user = User::find($id);                               
        $cards = Card::where('user_id',$id)->get();
        
        $turno = cambiarTurno($id);
        
        $players = traerJugadores();
                   
        return view('cards.index',['user'=>$user,'cards'=>$cards,'players'=>$players,'turno'=>$turno]);  
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('cards.acusacion',['id'=>$id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $id;
    }
    
}
