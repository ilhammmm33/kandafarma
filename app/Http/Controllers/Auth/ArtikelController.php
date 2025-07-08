public function index()
{
    $artikels = \App\Models\Artikel::latest()->paginate(10);
    return view('admin.artikel.index', compact('artikels'));
}
