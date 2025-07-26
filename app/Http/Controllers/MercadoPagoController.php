<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MercadoPago\SDK;
use MercadoPago\Preference;
use MercadoPago\Item;

class MercadoPagoController extends Controller
{
    public function pagar()
    {
        // Configura o SDK com o token
        SDK::setAccessToken(config('services.mercadopago.access_token'));

        // Cria item do pagamento
        $item = new Item();
        $item->title = 'Reserva de Sala';
        $item->quantity = 1;
        $item->unit_price = 250.00;

        // Cria preferência
        $preference = new Preference();
        $preference->items = [$item];

        $preference->back_urls = [
            "success" => route('pagamento.sucesso'),
            "failure" => route('pagamento.erro'),
            "pending" => route('pagamento.pendente'),
        ];
        $preference->auto_return = "approved";

        $preference->save();

        // Redireciona o usuário para o pagamento
        return redirect($preference->init_point);
    }

    public function sucesso()
    {
        return view('pagamento.sucesso');
    }

    public function erro()
    {
        return view('pagamento.erro');
    }

    public function pendente()
    {
        return view('pagamento.pendente');
    }
}
