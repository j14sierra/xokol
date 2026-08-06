<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactFormRequest;
use illuminate\View\View;
use App\Models\Service;
use App\Models\Project;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;


class HomeController extends Controller
{
    public function index(Request $request) : View
    {

        $selectedService = $request['service'];
        // Obtenga los servicios que estén activos y tengan al menos un proyecto activo.
        $services = Service::where('is_active', true)
            ->whereHas('projects', function ($query) {
                $query->where('projects.is_active', true);
            })
            ->orderBy('sort_order')
            ->get();

        $projectQuery = Project::where('is_active', true);

        if ($selectedService) {
            $projectQuery->whereHas('services', function ($query) use ($selectedService) {
                $query->where('services.id', $selectedService);
            });
        }
        $projects = $projectQuery->take(12)->get();

        return view('home', compact('services', 'projects', 'selectedService'));
    }

    public function sendContactEmail(ContactFormRequest $request) 
    {
    
        $data = $request->validated();



        // Aquí puedes enviar el correo electrónico usando Mail::to()->send() o cualquier otra lógica que necesites.
        
        Mail::to(config('mail.from.address'))
            ->send(new ContactFormMail($data));

        return redirect()->route('index')->with('success', '¡Gracias por contactarnos! Nos pondremos en contacto contigo pronto.');
    }   
}
