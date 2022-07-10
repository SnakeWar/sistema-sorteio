<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Http\Requests\WorkwithusRequest;
use App\Models\Lawyer;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Gallery;
use App\Models\Page;
use App\Models\Post;
use App\Models\Product;
use App\Models\Response;
use App\Models\Subsection;
use App\Models\Workwithus;
use App\Traits\UploadTraits;

class PagesController extends Controller
{
    use UploadTraits;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /**
     * @var Category
     */
    private $category;
    /**
     * @var Lawyer
     */
    private $lawyer;
    /**
     * @var Post
     */
    private $post;
    /**
     * @var Gallery
     */
    private $gallery;
    /**
     * @var Response
     */
    private $response;
    /**
     * @var Page
     */
    private $page;
    /**
     * @var Product
     */
    private $product;
    /**
     * @var Subsection
     */
    private $subsections;

    public function __construct(Category   $category,
                                Post       $post,
                                Gallery    $gallery,
                                Response   $response,
                                Subsection $subsecoes,
                                Page       $page,
                                Lawyer     $lawyer
    )
    {
        $this->category = $category;
        $this->post = $post;
        $this->gallery = $gallery;
        $this->response = $response;
        $this->subsections = $subsecoes;
        $this->page = $page;
        $this->lawyer = $lawyer;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //dd(date('Y-m-d'));
        $highlight = $this->post->whereStatus(1)
            ->whereHighlight(1)
            ->whereDate('published_at', '<=', date('Y-m-d'))
            ->orderBy('id', 'desc')
            ->limit(3)
            ->get();


        $galleries = $this->gallery->whereStatus(1)
            ->whereHighlight(1)
            ->orderBy('id', 'desc')
            ->limit(6)->get();
        return view('pages.index', [
            'highlight' => $highlight,
            'pagina' => 'Home',
            'galleries' => $galleries,

            'galleries' => $galleries
        ]);
    }

    public function page($slug)
    {

        $page = $this->page
            ->whereStatus(1)
            ->whereSlug($slug)
            ->first();

        return view('pages.page_detail', [
            'page' => $page,

            'pagina' => $page->title,
            'secao' => 'Institucional',
        ]);
    }

    public function posts()
    {
        $posts = $this->post->whereStatus(1)
            ->orderBy('id', 'desc')
            ->paginate(16);

        return view('pages.posts', [
            'posts' => $posts,
            'secao' => 'Comunicação',
            'pagina' => 'Notícias',

        ]);
    }

    public function news($subsection_name, $subsection_id)
    {
        $posts = $this->post
            ->whereStatus(1)
            ->where('subsection_id', $subsection_id)
            ->paginate(16);
        $page = $this->page
            //->whereStatus(1)
            ->where('title', 'like', '%' . $subsection_name . '%')
            ->where('title', 'like', '%diretoria%')
            ->first();
        if (!$page) {
            $data['title'] = '404';
            $data['name'] = 'Page not found';
            return response()->view('errors.404', $data, 404);
        }
        //dd($title);
        return view('pages.news', [
            'posts' => $posts,
            'diretoria' => $page->slug,
            'subsection_name' => $subsection_name,

        ]);
    }

    public function post($slug)
    {

        $post = $this->post->whereSlug($slug)->first();
        return view('pages.post_detail', [
            'post' => $post,
            'secao' => 'Comunicação',
            'pagina' => 'Notícias',
            'title' => env('APP_NAME', '') . ' - ' . $post->title,
            'img' => env('APP_URL') . '/storage/' . $post->photo,
            'description' => $post->description
        ]);
    }

    public function galleries($busca = null)
    {
        if ($busca == null || $busca == '') {
            $galleries = $this->gallery->with('photos')->whereStatus(1)
                ->paginate(16);
        } else {
            $galleries = $this->gallery->with('photos')->whereStatus(1)
                ->where('title', 'like', '%' . $busca . '%')
                ->orWhere('body', 'like', '%' . $busca . '%')
                ->paginate(16);
        }


        return view('pages.albuns', [
            'galleries' => $galleries,
            'secao' => 'Comunicação',
            'pagina' => 'Álbuns',

        ]);
    }

    public function gallery($slug)
    {

        $gallery = $this->gallery
            ->whereSlug($slug)
            ->whereStatus(1)
            ->first();
        return view('pages.album', [
            'gallery' => $gallery,
            'secao' => 'Comunicação',
            'pagina' => 'Álbum',
            'title' => env('APP_NAME', 'Título') . ' - ' . $gallery->title,
            'img' => env('APP_URL') . '/storage/' . $gallery->photo,
            'description' => $gallery->description
        ]);
    }

    public function directors()
    {

        return view('pages.directors', [
            'secao' => 'Institucional',
            'pagina' => 'Diretores',

        ]);
    }

    public function statistics()
    {

        return view('pages.estatisticas', [
            'secao' => 'Exame de Ordem',
            'pagina' => 'Estatísticas',

        ]);
    }

    public function subsections()
    {
        $subsecoes = $this->subsections->whereStatus(1)
            ->paginate(8);

        return view('pages.subsecoes', [
            'secao' => 'Institucional',
            'pagina' => 'Subseções',
            'subsecoes' => $subsecoes,

        ]);
    }

    public function subsection($slug)
    {
        $subsection = $this->subsections->whereStatus(1)
            ->whereSlug($slug)
            ->first();

        return view('pages.subsecao', [
            'secao' => 'Institucional',
            'pagina' => 'Subseções',
            'subsection' => $subsection,

        ]);
    }

    public function fale_conosco()
    {

        return view('pages.fale_conosco', [
            'pagina' => '',

        ]);
    }

    public function trabalhe_conosco()
    {
        return view('pages.trabalhe_conosco', [
            'pagina' => ''
        ]);
    }

    public function enviar_trabalhe_conosco(WorkwithusRequest $request)
    {
        $data = $request->all();
        //dd($data);
        if ($request->hasFile('attach')) {
            $data['attach'] = $this->imageUpload($data['attach'], 'trabalhe_conosco');
        }
        $contact = Workwithus::create($data);

        if ($contact) {
            flash(' Mensagem enviada com sucesso!')->success();
            return redirect()->back();
        } else {
            flash(' Erro ao enviar a mensagem!')->warning();
            return redirect()->back();
        }
    }

    public function enviar_fale_conosco(ContactRequest $request)
    {
        $data = $request->all();

        $contact = Contact::create($data);

        if ($contact) {
            flash(' Mensagem enviada com sucesso!')->success();
            return redirect()->back();
        } else {
            flash(' Erro ao enviar a mensagem!')->warning();
            return redirect()->back();
        }
    }

    public function enviar_busca(Request $request)
    {
        $busca = $request->all();
        if (!isset($busca['q'])) {
            return redirect('/');
        }
        $posts = $this->post->where('title', 'like', '%' . $busca['q'] . '%')->orWhere('description', 'like', '%' . $busca['q'] . '%')->orWhere('body', 'like', '%' . $busca['q'] . '%')->limit(5)->get();
        $pages = $this->page->where('title', 'like', '%' . $busca['q'] . '%')->orWhere('body', 'like', '%' . $busca['q'] . '%')->limit(5)->get();
        $galleries = $this->gallery->where('title', 'like', '%' . $busca['q'] . '%')->orWhere('description', 'like', '%' . $busca['q'] . '%')->limit(5)->get();
        return view('pages.busca', [
            'posts' => $posts,
            'pages' => $pages,
            'galleries' => $galleries,
            'pagina' => 'Busca',
            'secao' => '',
            'buscaPor' => $busca['q']
        ]);
    }

    public function subscriptions(Request $request)
    {
        $lawyers = $this->lawyer->whereStatus(1);
        if ($request->busca) {
            $lawyers->where('name', 'like', '%'.$request->busca.'%');
        }
        return view('pages.subscriptions', [
            'lawyers' => $lawyers->paginate(15)->appends(['busca' => $request->busca]),
            'secao' => 'Inscição',
            'pagina' => 'Advogados',
        ]);
    }
}
