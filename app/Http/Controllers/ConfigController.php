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
            "*"=>"required"
        ]);
        $array = Config::get('configurations');

        //Configuracion de API
        $array['api']['api_key_enviaya']=$request->api_enviaya;
        $array['api']['api_key_openpay']=$request->api_openpay;

        //Configuración general
        $array['paginate_general']=$request->paginate;
        $array['general']['company_name']=$request->company_name;

        $data = var_export($array, 1);
        if(File::put(base_path().'\config\configurations.php', "<?php\n return $data ;")) 
        {
             return redirect("/admin/config/index")->with("success","Cambios guardados");
        }
    }
}
