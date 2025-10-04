<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;
class CategoryController extends Controller {
    public function __construct(){ $this->middleware('auth'); $this->middleware('is_admin'); }

    public function index(){ $categories = Category::with('parent')->paginate(20); return view('admin.categories.index', compact('categories')); }
    public function create(){ $parents = Category::whereNull('parent_id')->get(); return view('admin.categories.create', compact('parents')); }

    public function store(Request $r){
        $r->validate([
            'name'=>'required|string|max:255',
            'parent_id'=>'nullable|exists:categories,id',
            'image'=>'nullable|image|max:2048'
        ]);
        $data = $r->only(['name','parent_id','description']);
        $data['slug'] = Str::slug($r->name);
        if ($r->hasFile('image')) {
            $img = $r->file('image');
            $path = 'uploads/categories/' . time() . '_' . $img->getClientOriginalName();
            Image::make($img)->fit(600, 400)->save(public_path($path));
            $data['image'] = $path;
        }
        Category::create($data);
        return redirect()->route('admin.categories.index')->with('success','Категория создана');
    }

    public function edit(Category $category){ $parents = Category::whereNull('parent_id')->where('id','!=',$category->id)->get(); return view('admin.categories.edit', compact('category','parents')); }

    public function update(Request $r, Category $category){
        $r->validate(['name'=>'required','parent_id'=>'nullable|exists:categories,id']);
        if ($r->parent_id == $category->id) return back()->withErrors('Нельзя назначить категорией саму себя');
        $data = $r->only(['name','parent_id','description']);
        $data['slug'] = Str::slug($r->name);
        if ($r->hasFile('image')) {
            $img = $r->file('image');
            $path = 'uploads/categories/' . time() . '_' . $img->getClientOriginalName();
            Image::make($img)->fit(600,400)->save(public_path($path));
            $data['image'] = $path;
        }
        $category->update($data);
        return redirect()->route('admin.categories.index')->with('success','Категория обновлена');
    }

    public function destroy(Category $category){ $category->delete(); return back()->with('success','Категория удалена'); }
}
