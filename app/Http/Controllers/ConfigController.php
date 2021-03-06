<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Config;
use File;
class ConfigController extends Controller
{
    public function index()
    {
        return view("admin.config.index");
    }

    public function update(Request $request)
    {
        
        $request->validate([
            'main_logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'mini_logo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'carrusel_1' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'carrusel_2' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'carrusel_3' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ],
        [
            'api_key_private_openpay.required'=>'Ingresar la api privada de Open Pay',
            'api_key_public_openpay.required'=>'Ingresar la api publica de Open Pay',
        ]);

        
        $array = Config::get('configurations');
        
        //Configuracion de API
        $array['api']['api_key_enviaya']=$request->api_enviaya;
        $array['api']['api_key_private_openpay']=$request->api_private_openpay;
        $array['api']['api_key_public_openpay']=$request->api_public_openpay;
        $array['api']['openpay_client_id']=$request->openpay_clientId;
        $array['api']['paypal-type']=$request->mode_paypal;
        $array['api']['pay-pal-key']=$request->api_paypal;


        //Configuración general
        $array['paginate_general']=$request->paginate;
        $array['general']['store_name']=$request->store_name;
        $array['general']['pct']=$request->pct;

        $array['company']['name']=$request->company_name;
        $array['company']['country_code']=$request->country;
        $array['company']['postal_code']=$request->cp;
        $array['company']['direction_1']=$request->street_1;
        $array['company']['city']=$request->city;
        $array['company']['phone']=$request->phone;
        

        if($request->file('main_logo')!=null)
        {
            $file=$request->file('main_logo')->store('/images');
            $array['general']['main_logo']="/".$file;
        }
        if($request->file('mini_logo')!=null)
        {
            $file=$request->file('mini_logo')->store('/images');
            $array['general']['mini_logo']="/".$file;
        }

        //Carrusel principal
        $array['general']['carrusel_slogan']=$request->carrusel_slogan;
        if($request->file('carrusel_1')!=null)
        {
            $file=$request->file('carrusel_1')->store('/images');
            $array['general']['carrusel_1']="/".$file;
        }
        if($request->file('carrusel_2')!=null)
        {
            $file=$request->file('carrusel_2')->store('/images');
            $array['general']['carrusel_2']="/".$file;
        }
        if($request->file('carrusel_3')!=null)
        {
            $file=$request->file('carrusel_3')->store('/images');
            $array['general']['carrusel_3']="/".$file;
        }

        //Configuración pdf
        $array['mk']['slogan']=$request->slogan;
        $array['mk']['information_final']=$request->information_final;
        $array['mk']['information_final_2']=$request->information_final_2;
        $array['mk']['information_final_3']=$request->information_final_3;
        $array['mk']['greetings']=$request->greetings;
        

        $data = var_export($array, 1);
        if(File::put(base_path().'\config\configurations.php', "<?php\n return $data ;")) 
        {
             return redirect("/admin/config/index")->with("success","Cambios guardados");
        }
    }
}
