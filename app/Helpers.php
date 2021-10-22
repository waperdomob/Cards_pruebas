<?php

use App\Models\Bug;
use App\Models\Card;
use App\Models\Game;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\AssignOp\Concat;

function barajar_cartas()
    {
    
        $cards_program = DB::select('select id from cards where category_id = ?', [1]);
        $cards_moduls = DB::select('select id from cards where category_id = ?', [2]);
        $cards_errors = DB::select('select id from cards where category_id = ?', [3]);
    
        $bug = [ 0 => array_rand($cards_program),
        1 => array_rand($cards_moduls),
        2 => array_rand($cards_errors)];
        
        unset($cards_program[$bug[0]]);
        unset($cards_moduls[$bug[1]]);
        unset($cards_errors[$bug[2]]);

        $cards = array_merge($cards_program,$cards_moduls,$cards_errors);
        
        $player1 = generarCartasJugadores($cards); 
        actualizarDB($player1,$cards);
        $cards = reducirVector($player1, $cards);
        $player2 = generarCartasJugadores($cards);
        actualizarDB($player2,$cards);        
        $cards = reducirVector($player2, $cards);
        $player3 = generarCartasJugadores($cards);
        actualizarDB($player3,$cards);      
        $cards = reducirVector($player3, $cards);
        $player4 = generarCartasJugadores($cards);
        actualizarDB($player4,$cards);
        
         if ($player4) {        

            Card::where('id','=',$bug[0]+1)->update(['bug_id' => 1]);
            Card::where('id','=',$bug[1]+8)->update(['bug_id' => 1]);
            Card::where('id','=',$bug[2]+14)->update(['bug_id' => 1]);
         
        }      
        return $player4;
        
    }

    function generarCartasJugadores($cards){
        $i = 0;

        while($i<4) { 

            $player[$i] = array_rand($cards);
            if ($i==0) {
                //$player[$i] = array_rand($cards); 
                $i++;
            }
            elseif($i==1){          
                if ($player[$i] == $player[$i-1] ) {
                    $player[$i] = array_rand($cards);            
                }                
                else {
                    $i++;
                } 
            }
            elseif($i==2){          
                if ($player[$i] == $player[$i-1] || $player[$i] == $player[$i-2]) {
                    $player1[$i] = array_rand($cards);            
                }
                else {
                    $i++;
                }           
            }
            else {
                if ($player[$i] == $player[$i-1] || $player[$i] == $player[$i-2] || $player[$i] == $player[$i-3]) {
                    $player[$i] = array_rand($cards);            
                }                
                else {
                    $i++;
                }  
            }
        }
        return $player;
    }

    function actualizarDB ($player, $cards){
            $users = User::pluck('id'); 
        
            for ($i=0; $i < 4; $i++) { 
                $card = $cards[$player[$i]];
                foreach ($card as $key => $value) {
                    $dato = $value;
                    $update = Card::where('id','=',$dato)->update(['user_id' => $users[$i]]);
                }
                
            }
        
        return $update;
    }
    function reducirVector($player, $cards){

        for ($i=0; $i < 4; $i++) { 
            unset($cards[$player[$i]]);
        }
        
        return $cards;
    }

    function gestionarTurnos($id){
       
        $jugador = DB::table('users')->select('id','name','turno')->where('position', '=', $id)->first();

        if ($jugador->turno == 1){
            
           return 1;
        }
        else {
            return 0;
        }
        
    }
    function cambiarTurno($id){

        User::where('id','=',$id)->update(['turno'=> 0]);

        $id2 = $id+1;

        if ($id2>4) {
            $id2=1;
            User::where('id','=',$id2)->update(['turno'=> 1]);
            return 0;
        }
        else{
            User::where('id','=',$id2)->update(['turno'=> 1]);
            return 0;
        }
        
    }

    function traerJugadores(){

        $players = DB::select('select name from users ');

        return $players;

    }
?>