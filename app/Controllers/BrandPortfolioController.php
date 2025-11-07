<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class BrandPortfolioController extends BaseController
{

    use ResponseTrait;

    protected $dataTable;
    protected $data;
    protected $registers;
    protected $clasesNiza;
    protected $search;
    protected $eventos_sic;

    public function __construct(){

        helper('info');

        $this->dataTable    = (object) [
            'draw'      => $_GET['draw'] ?? 1,
            'length'    => $length = $_GET['length'] ?? 10,
            'start'     => $start = $_GET['start'] ?? 1,
            'page'      => $_GET['page'] ?? ceil(($start - 1) / $length + 1)
        ];
        $this->search = $_GET['search'] ?? [];

        $title = 'Portafolio de Marcas';
        $this->data = (object) [
            'title'         => $title,
            'breadcrumbs'   => [
                (object) ['name'    => 'Home', 'url' => base_url(['dashboard'])],
                (object) ['name'    => $title],
            ]
        ];

        $this->registers = getBrands();

        $icons = ['<i class="fa-duotone fa-light fa-circle-d"></i>', '<i class="fa-duotone fa-solid fa-images"></i>', '<i class="fa-duotone fa-light fa-circle-m"></i>'];
        $types = ['Denominativa', 'Figurativa', 'Mixta'];

        $this->states_companies = [
            (object)['id' => 1, 'title' => 'Activa', 'description' => 'La empresa está operando normalmente.'],
            (object)['id' => 2, 'title' => 'Inactiva', 'description' => 'La empresa está registrada pero no realiza operaciones.'],
            (object)['id' => 3, 'title' => 'Suspendida', 'description' => 'La empresa fue suspendida temporalmente.'],
            (object)['id' => 4, 'title' => 'En liquidación', 'description' => 'En proceso de liquidar sus activos.'],
            // (object)['id' => 5, 'title' => 'Disuelta', 'description' => 'La empresa fue cerrada oficialmente.'],
            // (object)['id' => 6, 'title' => 'Bloqueada', 'description' => 'Acceso bloqueado por incumplimiento o revisión.'],
            // (object)['id' => 7, 'title' => 'Pendiente de aprobación', 'description' => 'Esperando validación o aprobación administrativa.'],
            // (object)['id' => 8, 'title' => 'Eliminada', 'description' => 'Marcada como eliminada, pero conservada para registro histórico.']
        ];

        $this->states_entities = [
            (object)['id' => 1, 'title' => 'Presentada', 'description' => 'La empresa está operando normalmente.'],
            (object)['id' => 2, 'title' => 'Publicada', 'description' => 'La empresa está registrada pero no realiza operaciones.'],
            (object)['id' => 3, 'title' => 'Registrada', 'description' => 'La empresa fue suspendida temporalmente.']
        ];

        $this->clasesNiza = [
            (object)[ "id" => 1, "title" => "Productos químicos", "description" => "Productos químicos para la industria, la ciencia y la fotografía; productos químicos para la agricultura, la horticultura y la silvicultura; resinas artificiales en bruto, materias plásticas en bruto; abonos; composiciones extinguidoras; preparaciones para templar y soldar metales; productos para conservar alimentos; adhesivos (pegamentos) para la industria." ],
            (object)[ "id" => 2, "title" => "Pinturas y barnices", "description" => "Pinturas, barnices, lacas; productos contra el óxido y el deterioro de la madera; colorantes; tintes; resinas naturales en bruto; metales en hojas y en polvo para pintores, decoradores, impresores y artistas." ],
            (object)[ "id" => 3, "title" => "Productos cosméticos y de limpieza", "description" => "Preparaciones para blanquear y otras sustancias para la colada; preparaciones para limpiar, pulir, desengrasar y raspar; jabones; perfumería, aceites esenciales, cosméticos, lociones capilares; dentífricos." ],
            (object)[ "id" => 4, "title" => "Aceites y combustibles", "description" => "Aceites y grasas para uso industrial; lubricantes; productos para absorber, regar y solidificar el polvo; combustibles (incluidos los carburantes) e iluminantes; velas y mechas para iluminación." ],
            (object)[ "id" => 5, "title" => "Productos farmacéuticos", "description" => "Productos farmacéuticos y veterinarios; productos higiénicos y sanitarios para uso médico; alimentos y sustancias dietéticas para uso médico o veterinario; alimentos para bebés; suplementos alimenticios para personas o animales; emplastos, material para curas; material para empastes e improntas dentales; desinfectantes; productos para eliminar animales dañinos; fungicidas, herbicidas." ],
            (object)[ "id" => 6, "title" => "Metales comunes", "description" => "Metales comunes y sus aleaciones; materiales de construcción metálicos; construcciones transportables metálicas; materiales metálicos para vías férreas; cables y alambres metálicos no eléctricos; cerrajería y artículos de ferretería metálicos; tubos metálicos; cofres fuertes; productos metálicos no comprendidos en otras clases; minerales." ],
            (object)[ "id" => 7, "title" => "Máquinas y motores", "description" => "Máquinas y máquinas herramientas; motores (excepto los motores para vehículos terrestres); acoplamientos y elementos de transmisión (excepto los para vehículos terrestres); instrumentos agrícolas que no sean herramientas de mano accionadas manualmente; incubadoras de huevos; distribuidores automáticos." ],
            (object)[ "id" => 8, "title" => "Herramientas manuales", "description" => "Herramientas e instrumentos de mano accionados manualmente; artículos de cuchillería, tenedores y cucharas; armas blancas; maquinillas de afeitar." ],
            (object)[ "id" => 9, "title" => "Aparatos electrónicos y científicos", "description" => "Aparatos e instrumentos científicos, náuticos, geodésicos, fotográficos, cinematográficos, ópticos, de pesaje, de medida, de señalización, de control (inspección), de socorro (salvamento) y de enseñanza; aparatos e instrumentos para la conducción, distribución, transformación, acumulación, regulación o control de la electricidad; aparatos para el registro, transmisión, reproducción de sonido o imágenes; soportes de registro magnéticos, discos acústicos; máquinas de registrar, calcular y procesar datos; equipos de extinción de incendios." ],
            (object)[ "id" => 10, "title" => "Aparatos médicos", "description" => "Aparatos e instrumentos quirúrgicos, médicos, odontológicos y veterinarios, así como sus partes y accesorios; artículos ortopédicos; material de sutura; aparatos de masaje; prótesis, implantes e instrumentos de diagnóstico." ],
            (object)[ "id" => 11, "title" => "Aparatos de iluminación y calefacción", "description" => "Aparatos de alumbrado, calefacción, producción de vapor, cocción, refrigeración, secado, ventilación, distribución de agua e instalaciones sanitarias." ],
            (object)[ "id" => 12, "title" => "Vehículos", "description" => "Vehículos; aparatos de locomoción terrestre, aérea o acuática." ],
            (object)[ "id" => 13, "title" => "Armas de fuego", "description" => "Armas de fuego; municiones y proyectiles; explosivos; fuegos artificiales." ],
            (object)[ "id" => 14, "title" => "Joyería y relojería", "description" => "Metales preciosos y sus aleaciones, así como productos de estas materias o chapados no comprendidos en otras clases; joyería, bisutería, piedras preciosas; relojería e instrumentos cronométricos." ],
            (object)[ "id" => 15, "title" => "Instrumentos musicales", "description" => "Instrumentos de música." ],
            (object)[ "id" => 16, "title" => "Papelería y material de oficina", "description" => "Papel, cartón y productos de estas materias no comprendidos en otras clases; productos de imprenta; artículos para encuadernar; fotografías; artículos de papelería; adhesivos (pegamentos) para la papelería o uso doméstico; material para artistas; pinceles; máquinas de escribir y artículos de oficina (excepto muebles); material de instrucción o de enseñanza (excepto aparatos); materias plásticas para embalar; caracteres de imprenta; clichés de imprenta." ],
            (object)[ "id" => 17, "title" => "Caucho y plásticos", "description" => "Caucho, gutapercha, goma, amianto, mica y productos de estas materias no comprendidos en otras clases; productos en materias plásticas semielaboradas; materiales para calafatear, estopar y aislar; tubos flexibles no metálicos." ],
            (object)[ "id" => 18, "title" => "Artículos de cuero", "description" => "Cuero e imitaciones de cuero, productos de estas materias no comprendidos en otras clases; pieles de animales; baúles y maletas; paraguas, sombrillas y bastones; fustas y artículos de guarnicionería." ],
            (object)[ "id" => 19, "title" => "Materiales de construcción no metálicos", "description" => "Materiales de construcción no metálicos; tuberías rígidas no metálicas para la construcción; asfalto, pez y betún; construcciones transportables no metálicas; monumentos no metálicos." ],
            (object)[ "id" => 20, "title" => "Muebles", "description" => "Muebles, espejos, marcos; productos de madera, corcho, caña, junco, mimbre, cuerno, hueso, marfil, concha, ámbar, nácar, espuma de mar y sucedáneos de todas estas materias o de plásticos no comprendidos en otras clases." ],
            (object)[ "id" => 21, "title" => "Utensilios de cocina", "description" => "Utensilios y recipientes para el menaje o la cocina; peines y esponjas; cepillos (excepto pinceles); material para fabricar cepillos; material de limpieza; lana de acero; vidrio en bruto o semielaborado (excepto el vidrio de construcción); artículos de cristalería, porcelana y loza no comprendidos en otras clases." ],
            (object)[ "id" => 22, "title" => "Cuerdas y fibras textiles", "description" => "Cuerdas, cordeles, redes, tiendas de campaña, lonas, velas (para embarcaciones), sacos y bolsas (no comprendidos en otras clases); materiales de acolchado y relleno (excepto caucho o plásticos); materias textiles fibrosas en bruto." ],
            (object)[ "id" => 23, "title" => "Hilos para uso textil", "description" => "Hilos para uso textil." ],
            (object)[ "id" => 24, "title" => "Tejidos", "description" => "Tejidos y productos textiles no comprendidos en otras clases; ropa de cama y de mesa." ],
            (object)[ "id" => 25, "title" => "Ropa, calzado y sombrerería", "description" => "Prendas de vestir, calzado y artículos de sombrerería." ],
            (object)[ "id" => 26, "title" => "Encajes y bordados", "description" => "Encajes, bordados, cintas y cordones; botones, ganchos y ojetes, alfileres y agujas; flores artificiales." ],
            (object)[ "id" => 27, "title" => "Alfombras y tapices", "description" => "Alfombras, felpudos, esteras, linóleos y otros revestimientos de suelos; tapices murales no de materias textiles." ],
            (object)[ "id" => 28, "title" => "Juegos y juguetes", "description" => "Juegos, juguetes; artículos de gimnasia y deporte no comprendidos en otras clases; decoraciones para árboles de Navidad." ],
            (object)[ "id" => 29, "title" => "Productos alimenticios", "description" => "Carne, pescado, aves y caza; extractos de carne; frutas y legumbres en conserva, congeladas, secas y cocidas; jaleas, mermeladas, compotas; huevos; leche y productos lácteos; aceites y grasas comestibles." ],
            (object)[ "id" => 30, "title" => "Productos de panadería", "description" => "Café, té, cacao y sucedáneos del café; arroz; tapioca y sagú; harinas y preparaciones hechas de cereales; pan, pastelería y confitería; helados comestibles; azúcar, miel, jarabe de melaza; levadura, polvos de hornear; sal, mostaza; vinagre, salsas (condimentos); especias; hielo." ],
            (object)[ "id" => 31, "title" => "Productos agrícolas y hortícolas", "description" => "Productos agrícolas, hortícolas, forestales y granos no comprendidos en otras clases; animales vivos; frutas y legumbres frescas; semillas, plantas y flores naturales; alimentos para animales; malta." ],
            (object)[ "id" => 32, "title" => "Bebidas sin alcohol", "description" => "Cervezas; aguas minerales y gaseosas; bebidas no alcohólicas; zumos de frutas; siropes y otras preparaciones para elaborar bebidas." ],
            (object)[ "id" => 33, "title" => "Bebidas alcohólicas", "description" => "Bebidas alcohólicas (excepto cervezas)." ],
            (object)[ "id" => 34, "title" => "Tabaco", "description" => "Tabaco; artículos para fumadores; cerillas." ],
            (object)[ "id" => 35, "title" => "Publicidad y gestión", "description" => "Publicidad; gestión de negocios comerciales; administración comercial; trabajos de oficina." ],
            (object)[ "id" => 36, "title" => "Servicios financieros", "description" => "Seguros; operaciones financieras; operaciones monetarias; negocios inmobiliarios." ],
            (object)[ "id" => 37, "title" => "Construcción y reparación", "description" => "Construcción; reparación; servicios de instalación." ],
            (object)[ "id" => 38, "title" => "Telecomunicaciones", "description" => "Telecomunicaciones." ],
            (object)[ "id" => 39, "title" => "Transporte y almacenamiento", "description" => "Transporte; embalaje y almacenamiento de mercancías; organización de viajes." ],
            (object)[ "id" => 40, "title" => "Tratamiento de materiales", "description" => "Tratamiento de materiales." ],
            (object)[ "id" => 41, "title" => "Educación y formación", "description" => "Educación; formación; servicios de entretenimiento; actividades deportivas y culturales." ],
            (object)[ "id" => 42, "title" => "Servicios científicos y tecnológicos", "description" => "Servicios científicos y tecnológicos, así como servicios de investigación y diseño en estos ámbitos; servicios de análisis industrial y de investigación industrial; diseño y desarrollo de equipos informáticos y software." ],
            (object)[ "id" => 43, "title" => "Servicios de restauración y hospedaje", "description" => "Servicios de restauración (alimentación); hospedaje temporal." ],
            (object)[ "id" => 44, "title" => "Servicios médicos y agrícolas", "description" => "Servicios médicos y veterinarios; servicios de higiene y belleza; servicios agrícolas, hortícolas y silvícolas."],
            (object)[ "id" => 45, "title" => "Servicios personales y legales", "description" => "Servicios jurídicos; seguridad para protección de bienes y personas; servicios personales y sociales prestados por terceros."]
        ];

        $this->eventos_sic = [
            (object)[
                'fecha' => '2025-09-30',
                'tipo' => 'Creación',
                'descripcion' => 'Radicación inicial de la solicitud de marca “CAFÉ DEL HUILA” ante la SIC.',
                'usuario' => 'William Bonilla',
                'documento' => 'https://sic.gov.co/expedientes/solicitud-2025-091.pdf',
                'color' => 'azul',
                'tiempo' => '<small class="text-muted">hace 30 días</small>'
            ],
            (object)[
                'fecha' => '2025-10-03',
                'tipo' => 'Requerimiento',
                'descripcion' => 'La SIC solicita aclaración sobre el tipo de producto declarado en la solicitud.',
                'usuario' => 'Analista SIC - División Signos Distintivos',
                'documento' => 'https://sic.gov.co/expedientes/requerimiento-2025-091.pdf',
                'color' => 'rojo',
                'tiempo' => '<small class="text-muted">hace 27 días</small>'
            ],
            (object)[
                'fecha' => '2025-10-06',
                'tipo' => 'Aprobación',
                'descripcion' => 'Se aprueba el examen de forma tras la respuesta al requerimiento.',
                'usuario' => 'Revisor jurídico SIC',
                'documento' => 'https://sic.gov.co/expedientes/aprobacion-forma-2025-091.pdf',
                'color' => 'verde',
                'tiempo' => '<small class="text-muted">hace 24 días</small>'
            ],
            (object)[
                'fecha' => '2025-10-10',
                'tipo' => 'Publicación',
                'descripcion' => 'Publicación del extracto en la Gaceta de Propiedad Industrial No. 2041.',
                'usuario' => 'Sistema SIC',
                'documento' => 'https://sic.gov.co/gaceta/2041.pdf',
                'color' => 'verde',
                'tiempo' => '<small class="text-muted">hace 20 días</small>'
            ],
            (object)[
                'fecha' => '2025-10-14',
                'tipo' => 'Alerta',
                'descripcion' => 'Inicio del periodo de oposiciones (30 días hábiles).',
                'usuario' => 'Sistema automático SIC',
                'documento' => 'https://sic.gov.co/expedientes/alerta-oposicion-2025-091.pdf',
                'color' => 'naranja',
                'tiempo' => '<small class="text-muted">hace 16 días</small>'
            ],
            (object)[
                'fecha' => '2025-10-20',
                'tipo' => 'Requerimiento',
                'descripcion' => 'Se recibe oposición por parte de la empresa “Café Andino S.A.S.”.',
                'usuario' => 'Abogado SIC - Signos Distintivos',
                'documento' => 'https://sic.gov.co/expedientes/oposicion-2025-091.pdf',
                'color' => 'rojo',
                'tiempo' => '<small class="text-muted">hace 10 días</small>'
            ],
            (object)[
                'fecha' => '2025-10-26',
                'tipo' => 'Aprobación',
                'descripcion' => 'Resolución favorable al solicitante tras revisar la oposición presentada.',
                'usuario' => 'Dirección de Signos Distintivos',
                'documento' => 'https://sic.gov.co/expedientes/resolucion-favorable-2025-091.pdf',
                'color' => 'verde',
                'tiempo' => '<small class="text-muted">hace 4 días</small>'
            ],
            (object)[
                'fecha' => '2025-10-31',
                'tipo' => 'Registro',
                'descripcion' => 'Emisión del certificado de registro de marca “CAFÉ DEL HUILA”.',
                'usuario' => 'Superintendencia de Industria y Comercio',
                'documento' => 'https://sic.gov.co/expedientes/certificado-2025-091.pdf',
                'color' => 'verde',
                'tiempo' => '<small class="text-muted">hoy</small>'
            ]
        ];
    }

    public function index()
    {
        return view('brand_portfolio/index', [
            'data'          => $this->data,
            'clasesNiza'    => $this->clasesNiza
        ]);
    }

    public function getData(){
        $total = count($this->registers);

        // if (!empty($search)) {
        //     $builder->groupStart();
        //     foreach ($columns as $col) {
        //         $builder->orLike($col, $search);
        //     }
        //     $builder->groupEnd();
        // }

        $filteredData = array_reverse($this->registers);
        
        $pagedData = $this->dataTable->length >= 0
            ? array_slice($filteredData, $this->dataTable->start, $this->dataTable->length)
            : $filteredData;

        $return = (object) [
            'data'              => $pagedData,
            'draw'              => $this->dataTable->draw,
            'recordsTotal'      => $total,
            'recordsFiltered'   => count($filteredData),
            'post'              => $this->dataTable
        ];

        return $this->respond($return);
    }

    public function detail($id){

        $detail = array_values(array_filter($this->registers, function($item) use ($id) {
            return $item->id == $id;
        }))[0] ?? null;
        
        $this->data = (object) [
            'title'         => "{$this->data->title}  <span class=\"text-muted ms-1\"><small>| {$detail->Marca}</small></span>",
            'breadcrumbs'   => [
                (object) ['name'    => 'Home', 'url' => base_url(['dashboard'])],
                (object) ['name'    => $this->data->title, 'url' => base_url(['dashboard', 'brand_portfolio'])],
                (object) ['name'    => $detail->nombre_corto],
            ],
            'tablists'      => [
                (object) ['id' => 1, 'name' => "Resumen general", 'icon' => "ri-file-paper-2-line"],
                (object) ['id' => 2, 'name' => "Clases Niza", 'icon' => "ri-file-list-3-line"],
                (object) ['id' => 3, 'name' => "Titular y Agente", 'icon' => "ri-user-2-line"],
                (object) ['id' => 4, 'name' => "Documentos Vinculados", 'icon' => "ri-file-copy-2-line"],
                (object) ['id' => 5, 'name' => "Evidencias y Pruebas de Uso", 'icon' => "ri-folder-shield-line"],
                (object) ['id' => 6, 'name' => "Costos & ROI", 'icon' => "ri-currency-line"],
                (object) ['id' => 7, 'name' => "Flujo de Disclosure", 'icon' => "ri-flow-chart"],
                (object) ['id' => 8, 'name' => "Línea de Tiempo", 'icon' => "ri-git-commit-line"],
            ]
        ];

        return view('brand_portfolio/detail', [
            'detail'        => $detail,
            'data'          => $this->data,
            'clasesNiza'    => $this->clasesNiza,
            'states_companies'   => $this->states_companies,
            'states_entities'    =>  $this->states_entities,
            'eventos_sic'       => array_reverse($this->eventos_sic)
        ]);
    }
}
