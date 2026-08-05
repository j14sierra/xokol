@props(['services'])
<div class="bg-card-dark p-8 md:p-12 rounded-3xl border border-border-dark">
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
            <strong class="font-bold">¡Éxito!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif
    <form method="POST" action="{{ route('contact') }}" class="space-y-8">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="space-y-2">
                <label class="text-xs font-bold uppercase tracking-widest text-slate-500">Nombre Completo <span class="text-red-500">*</span></label>
                <input
                    class="w-full bg-transparent border-0 border-b border-slate-700 focus:border-primary focus:ring-0 py-2 placeholder:text-slate-700 transition-colors"
                    placeholder="John Doe" type="text" name="name" required/>
            </div>
            <div class="space-y-2">
                <label class="text-xs font-bold uppercase tracking-widest text-slate-500">
                    Teléfono <span class="text-red-500">*</span>
                </label>

                    <input
                        id="phone"
                        name="phone"
                        type="tel"
                        class="w-full bg-transparent border-0 border-b border-slate-700 focus:border-primary focus:ring-0 py-2 transition-colors"
                        name="phone"
                        required />
                        <p id="phoneError" class="mt-2 text-sm text-red-500 hidden"></p>
            </div>
            <div class="space-y-2">
                <label class="text-xs font-bold uppercase tracking-widest text-slate-500">Correo Electrónico <span class="text-red-500">*</span></label>
                <input
                    class="w-full bg-transparent border-0 border-b border-slate-700 focus:border-primary focus:ring-0 py-2 placeholder:text-slate-700 transition-colors"
                    placeholder="john.doe@example.com" type="email" name="email" required/>
                    <p id="emailError" class="mt-2 text-sm text-red-500 hidden"></p>
            </div>

            <div class="space-y-2">
            <label class="text-xs font-bold uppercase tracking-widest text-slate-500">Compañía / Empresa <span class="text-red-500">*</span></label>
            <input
                class="w-full bg-transparent border-0 border-b border-slate-700 focus:border-primary focus:ring-0 py-2 placeholder:text-slate-700 transition-colors"
                placeholder="Awesome Inc." type="text" name="company" required />
        </div>
        </div>

        

        <div class="space-y-4">
            <label class="text-xs font-bold uppercase tracking-widest text-slate-500">Servicios Requeridos</label>
            <div class="flex flex-wrap gap-2">
                @foreach ($services as $service)
                    <label class="cursor-pointer">
                        <input class="hidden peer" type="checkbox" name="services[]" value="{{ $service->name }}" />
                        <span
                            class="px-4 py-2 rounded-lg border border-slate-700 text-sm peer-checked:bg-primary peer-checked:text-background-dark peer-checked:border-primary transition-all inline-block">{{ $service->name }}</span>
                    </label>
                @endforeach
            </div>
        </div>

        <div class="space-y-2">
            <label class="text-xs font-bold uppercase tracking-widest text-slate-500 optional">Mensaje</label>
            <textarea
                class="w-full bg-transparent border-0 border-b border-slate-700 focus:border-primary focus:ring-0 py-2 placeholder:text-slate-700 transition-colors"
                placeholder="Escribe tu mensaje aquí..." name="message" rows="4"></textarea>
        </div>

        <button class="w-full bg-primary text-background-dark py-4 rounded-xl font-bold text-lg hover:opacity-90 transition-all">
            Enviar Propuesta
        </button>
    </form>
</div>

<script>
    const input = document.querySelector("#phone");
    const phoneError = document.querySelector("#phoneError");
    const form = document.querySelector("form");
    // const email = document.querySelector("#email");
    // const emailError = document.querySelector("#emailError");

    const iti = window.intlTelInput(input, {
        initialCountry: "auto",
        i18n: {
            searchPlaceholder: "Buscar país",
            noCountrySelected: "Ningún país seleccionado",
            zeroSearchResults: "No se encontraron resultados",
            oneSearchResult: "1 resultado encontrado",
            multipleSearchResults: "${count} resultados encontrados",
        },
        geoIpLookup: function(callback) {
            fetch("https://ipapi.co/json/")
                .then(res => res.json())
                .then(data => callback(data.country_code))
                .catch(() => callback("co"));
        },
        separateDialCode: true,    // Muestra la bandera y el indicativo separados
        nationalMode: false, 
        loadUtils: () => import("https://cdn.jsdelivr.net/npm/intl-tel-input@25.3.1/build/js/utils.js")
    });

    form.addEventListener("submit", function(e) {

        phoneError.classList.add("hidden");
        phoneError.textContent = "";

        if (!iti.isValidNumber()) {

            e.preventDefault();

            switch (iti.getValidationError()) {

                case intlTelInput.utils.validationError.TOO_SHORT:
                    phoneError.textContent = "El número es demasiado corto.";
                    break;

                case intlTelInput.utils.validationError.TOO_LONG:
                    phoneError.textContent = "El número es demasiado largo.";
                    break;

                case intlTelInput.utils.validationError.INVALID_COUNTRY_CODE:
                    phoneError.textContent = "El indicativo del país no es válido.";
                    break;

                case intlTelInput.utils.validationError.NOT_A_NUMBER:
                    phoneError.textContent = "Ingrese un número válido.";
                    break;

                default:
                    phoneError.textContent = "El número de teléfono no es válido.";
            }

            phoneError.classList.remove("hidden");
            input.focus();
            return;
        }

        input.value = iti.getNumber();
    });

    input.addEventListener("input", () => {
    phoneError.textContent = "";
    phoneError.classList.add("hidden");
    });

    input.addEventListener("countrychange", () => {
    phoneError.textContent = "";
    phoneError.classList.add("hidden");
    });

</script>